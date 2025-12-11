<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl?>/images/icon.png" rel="shortcut icon" type="image-png"/>
    <link href="<?php echo $websiteUrl?>/style/report-style.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
    <script src="<?php echo $websiteUrl?>/js/admin/chart.min.js"></script>
    <title>Contemporary Mark Book Per Subject | <?php echo $clientName ?></title>
</head>

<body>
    <script> printContemporaryMarkBookSession = JSON.parse(sessionStorage.getItem("printContemporaryMarkBookSession"));</script>

    <section class="body-div broadsheet-body" id="backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat;">
        <div class="header-back-div">
            <div class="header-image">
                <img id="cummulativeMarkBookHeader" src="<?php echo $websiteUrl ?>/images/report/cummulative-mark-book-header.png" alt="Report Header" style="width: 100%; height: auto;"/>

                <script>
                    $(document).ready(function () {
                        const schoolHeader = printContemporaryMarkBookSession?.branchData?.cummulativeMarkBookHeader;
                        const headerUrl = schoolHeader ? `${cummulativeMarkBookHeaderPixPath}/${schoolHeader}` : `<?php echo $websiteUrl ?>/images/report/cummulative-mark-book-header.png`;
                        $("#cummulativeMarkBookHeader").attr("src", headerUrl).attr("alt", `${printContemporaryMarkBookSession?.branchData?.branchName} Report Header`);

                        const backendWatermark = printContemporaryMarkBookSession?.branchData?.watermark;
                        const defaultWatermark = '../images/report/watermark.jpg';
                        const watermarkUrl = backendWatermark ? `${watermarkPixPath}/${backendWatermark}` : defaultWatermark;

                        $('#backgroundTable').css({
                            'background': `url(${watermarkUrl}) center no-repeat`,
                            'background-size': 'cover'
                        });
                    });
                </script>
            </div>

            <div class="title-div">
                <h3 id="titleDetails"></h3>
                <script>
                $("#titleDetails").html(printContemporaryMarkBookSession?.session + ' - ' +
                    printContemporaryMarkBookSession?.departmentData?.departmentName + ' - ' +
                    printContemporaryMarkBookSession?.classData?.className + ' - ' +
                    printContemporaryMarkBookSession?.armData?.armName + ' - ' +
                    printContemporaryMarkBookSession?.subjectData?.subjectName);
                </script>
            </div>
        </div>
    
        <div class="inner-content">
            <div class="table-div">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                        $(document).ready(function () {
                            const data = JSON.parse(sessionStorage.getItem("printContemporaryMarkBookSession"));
                            if (!data) return;

                            const tableTitles = data.tableTitles.split(',').map(x => x.trim());
                            const assessments = data.subjectAssessmentData || [];
                            const markBookData = data.markBookData || [];

                            // Build a set of backend assessment labels (e.g. "1ST CA (15.00)")
                            const assessmentTitleSet = new Set();
                            assessments.forEach(a => {
                                const lab = `${a.assessmentName} (${a.assessmentTotalScore})`;
                                assessmentTitleSet.add(lab.toUpperCase());
                                assessmentTitleSet.add(a.assessmentName.toUpperCase());
                            });

                            // 1) GROUP HEADERS (dynamic per-term width)
                            //    perTerm = number of assessments per term + TOTAL + POST.IN CLASS
                            // ===========================================================
                            function groupTermColumnsDynamic(titles) {
                                const groups = { term1: [], term2: [], term3: [], cumulative: [] };

                                // Skip SN and FULLNAME at indexes 0 and 1
                                let pointer = 2;

                                // dynamic per-term column count
                                const perTerm = Math.max( (assessments.length) + 2, 2 ); // fallback to at least 2

                                // slice by computed width (keeps original order)
                                groups.term1 = titles.slice(pointer, pointer + perTerm);
                                pointer += perTerm;

                                groups.term2 = titles.slice(pointer, pointer + perTerm);
                                pointer += perTerm;

                                groups.term3 = titles.slice(pointer, pointer + perTerm);
                                pointer += perTerm;

                                groups.cumulative = titles.slice(pointer);

                                return { groups, perTerm };
                            }

                            const { groups: grouped, perTerm } = groupTermColumnsDynamic(tableTitles);

                            // Build index ranges for term membership detection
                            function buildTermIndexRanges(groups) {
                                let start = 2;
                                const ranges = {};
                                ranges[1] = [start, start + groups.term1.length];
                                start += groups.term1.length;
                                ranges[2] = [start, start + groups.term2.length];
                                start += groups.term2.length;
                                ranges[3] = [start, start + groups.term3.length];
                                start += groups.term3.length;
                                ranges[0] = [start, tableTitles.length]; // cumulative
                                return ranges;
                            }
                            const termIndexRanges = buildTermIndexRanges(grouped);

                            // 2) BUILD scoreMap FROM backend (term-prefixed keys: T1__..., T2__...)
                            // ===========================================================
                            const scoreMap = {};
                            const allTitles = [];

                            // assessmentId -> label map
                            const assessmentTitleMap = {};
                            assessments.forEach(a => {
                                const label = `${a.assessmentName} (${a.assessmentTotalScore})`;
                                assessmentTitleMap[a.assessmentId] = label;
                            });

                            markBookData.forEach(student => {
                                const sid = student.studentId;

                                // terminalAssessments -> per-term keys
                                (student.terminalAssessments || []).forEach(termBlock => {
                                    const t = termBlock.term;
                                    (termBlock.assessments || []).forEach(a => {
                                        const base = assessmentTitleMap[a.assessmentId] || a.assessmentId;
                                        const k = `T${t}__${base}`;
                                        if (!scoreMap[k]) { scoreMap[k] = {}; allTitles.push(k); }
                                        scoreMap[k][sid] = a.markObtained ?? "";
                                    });

                                    const totalK = `T${t}__TOTAL`;
                                    if (!scoreMap[totalK]) { scoreMap[totalK] = {}; allTitles.push(totalK); }
                                    scoreMap[totalK][sid] = termBlock.totalMarkObtained ?? "";

                                    const posK = `T${t}__POST.IN CLASS`;
                                    if (!scoreMap[posK]) { scoreMap[posK] = {}; allTitles.push(posK); }
                                    scoreMap[posK][sid] = termBlock.positionInClass ?? "";
                                });

                                // cumulative / summary fields (firstTermScore etc.)
                                Object.keys(student).forEach(k => {
                                    if (k === 'terminalAssessments') return;
                                    if (!scoreMap[k]) { scoreMap[k] = {}; allTitles.push(k); }
                                    scoreMap[k][student.studentId] = student[k];
                                });
                            });

                            // 3) TERM-AWARE fuzzy matching helpers
                            // ===========================================================
                            function stripPrefix(s) { return s.replace(/^T\d+__/, ""); }
                            function normalize(s) {
                                return stripPrefix(s)
                                    .replace(/[\W_]+/g, " ")
                                    .replace(/([a-z])([A-Z])/g, "$1 $2")
                                    .toLowerCase()
                                    .split(" ")
                                    .filter(Boolean);
                            }

                            function getTermContext(colIndex) {
                                if (colIndex < termIndexRanges[1][1]) return 1;
                                if (colIndex < termIndexRanges[2][1]) return 2;
                                if (colIndex < termIndexRanges[3][1]) return 3;
                                return 0; // cumulative
                            }

                            function getMatchingKey(title, colIndex) {
                                const term = getTermContext(colIndex);
                                const tWords = normalize(title);

                                // restrict candidates by term
                                let candidates;
                                if (term === 1) candidates = allTitles.filter(k => k.startsWith("T1__"));
                                else if (term === 2) candidates = allTitles.filter(k => k.startsWith("T2__"));
                                else if (term === 3) candidates = allTitles.filter(k => k.startsWith("T3__"));
                                else candidates = allTitles.filter(k => !k.startsWith("T"));

                                let best = null;
                                let bestScore = -1;

                                candidates.forEach(c => {
                                    const raw = stripPrefix(c).toUpperCase();

                                    const cWords = normalize(c);

                                    // ---- 1) base fuzzy score ----
                                    let score = tWords.filter(w => cWords.includes(w)).length;

                                    // ---- 2) semantic BONUS: CA titles contain "CA", term TOTAL does not ----
                                    const titleHasCA = title.toUpperCase().includes("CA");
                                    const candidateHasCA = raw.includes("CA");

                                    if (titleHasCA && candidateHasCA) score += 3;   // CA <-> CA strong boost
                                    if (!titleHasCA && !candidateHasCA) score += 3; // NON CA <-> NON CA boost

                                    // ---- 3) semantic penalty: avoid matching term TOTAL with CA TOTAL ----
                                    const isTitlePlainTotal = title.toUpperCase() === "TOTAL";
                                    const isCandidateCA = raw.includes("CA");

                                    if (isTitlePlainTotal && isCandidateCA) {
                                        score -= 5; // punish wrong matches
                                    }

                                    // ---- 4) semantic boost: EXAM matches EXAM ----
                                    if (raw.includes("EXAM") && title.toUpperCase().includes("EXAM")) {
                                        score += 4;
                                    }

                                    // pick best
                                    if (score > bestScore) {
                                        bestScore = score;
                                        best = c;
                                    }
                                });

                                return best;
                            }

                            // 4) BUILD TABLE HTML
                            // ===========================================================
                            const thead = $('<thead></thead>');
                            const groupTR = $('<tr class="tb-col table-col"></tr>');
                            groupTR.append('<th></th>');
                            groupTR.append('<th></th>');
                            if (grouped.term1.length) groupTR.append(`<th colspan="${grouped.term1.length}">FIRST TERM OBTAINABLE MARKS</th>`);
                            if (grouped.term2.length) groupTR.append(`<th colspan="${grouped.term2.length}">SECOND TERM OBTAINABLE MARKS</th>`);
                            if (grouped.term3.length) groupTR.append(`<th colspan="${grouped.term3.length}">THIRD TERM OBTAINABLE MARKS</th>`);
                            if (grouped.cumulative.length) groupTR.append(`<th colspan="${grouped.cumulative.length}">CUMULATIVE OBTAINABLE MARKS</th>`);
                            thead.append(groupTR);

                            const titleTR = $('<tr class="tb-col table-col"></tr>');
                            tableTitles.forEach(t => titleTR.append(`<th>${t}</th>`));
                            thead.append(titleTR);

                            const tbody = $('<tbody></tbody>');
                            markBookData.forEach((student, idx) => {
                                const tr = $('<tr class="tb-row table-row"></tr>');
                                const name = `${student.surName} ${student.firstName} ${student.otherNames || ""}`.trim();
                                tr.append(`<td>${idx + 1}</td>`);
                                tr.append(`<td>${name}</td>`);

                                for (let i = 2; i < tableTitles.length; i++) {
                                    const header = tableTitles[i];
                                    const key = getMatchingKey(header, i);
                                    const val = key ? scoreMap[key]?.[student.studentId] ?? "" : "";
                                    tr.append(`<td>${val}</td>`);
                                }
                                tbody.append(tr);
                            });

                            $("#pageContent").empty().append(thead).append(tbody);
                        });
                    </script>
                </table>
            </div>
        </div>
    </section>
</body>
</html>