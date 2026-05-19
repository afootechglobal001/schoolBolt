<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl?>/images/icon.png" rel="shortcut icon" type="image-png"/>
    <link href="<?php echo $websiteUrl?>/style/report-style.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
    <title>Session Promotional Broad Sheet | <?php echo $clientName ?></title>
</head>

<body>
    <script>printPromotionalBroadSheetSession = JSON.parse(sessionStorage.getItem("printPromotionalBroadSheetSession"));</script>

    <section class="body-div broadsheet-body" id="backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat;">
        <div class="header-back-div">
            <div class="header-image">
                <img id="promotionalBroadSheetHeader" src="<?php echo $websiteUrl ?>/images/report/cummulative-mark-book-header.png" alt="Report Header" style="width: 100%; height: auto;"/>

                <script>
                    $(document).ready(function () {
                        const schoolHeader = printPromotionalBroadSheetSession?.branchData?.cummulativeBroadsheetHeader;
                        const headerUrl = schoolHeader ? `${cummulativeBroadsheetHeaderPixPath}/${schoolHeader}` : `<?php echo $websiteUrl ?>/images/report/cummulative-mark-book-header.png`;
                        $("#promotionalBroadSheetHeader").attr("src", headerUrl).attr("alt", `${printPromotionalBroadSheetSession?.branchData?.branchName} Report Header`);

                        const backendWatermark = printPromotionalBroadSheetSession?.branchData?.watermark;
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
                <h3 id="titleDetails">
                    <script>
                        $("#titleDetails").html(printPromotionalBroadSheetSession?.session + ' - ' +
                        printPromotionalBroadSheetSession?.departmentData?.departmentName + ' - ' +
                        printPromotionalBroadSheetSession?.classData?.className + ' - ' +
                        printPromotionalBroadSheetSession?.armData?.armName + ' - ' +
                        'ACADEMIC SESSION');
                    </script>
                </h3>
            </div>
        </div>
    
        <div class="inner-content">
            <div class="table-div">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                        $(document).ready(function () {
                            const printPromotionalBroadSheetSession = JSON.parse(sessionStorage.getItem("printPromotionalBroadSheetSession"));
                            if (!printPromotionalBroadSheetSession) return;

                            const tableTitles = printPromotionalBroadSheetSession?.tableTitles.split(',').map(x => x.trim());
                            const studentList = printPromotionalBroadSheetSession?.studentData;

                            const scoreMap = {};
                            const summaryFields = [];

                            // Generate scoreMap for subjects and summaries from student structure
                            studentList.forEach(student => {
                                student.studentScorePerSubject?.forEach(subject => {
                                    const abbr = subject.subjectAbbreviation;
                                    if (!scoreMap[abbr]) scoreMap[abbr] = {};
                                    scoreMap[abbr][student.studentId] = subject.averageScore;
                                });

                                // Extract Result summary fields 
                                Object.keys(student).forEach(key => {
                                    if (!scoreMap[key]) {
                                        scoreMap[key] = {};
                                        summaryFields.push(key);
                                    }
                                    scoreMap[key][student.studentId] = student[key];
                                });
                            });

                            // Normalize for fuzzy matching
                            function normalizeWords(str) {
                                return str
                                    .replace(/[\W_]+/g, ' ') // Remove punctuation and underscores
                                    .replace(/([a-z])([A-Z])/g, '$1 $2') // Split camelCase
                                    .toLowerCase()
                                    .split(' ')
                                    .filter(Boolean);
                            }

                            // Map tableTitles to scoreMap fields (summary or subject)
                            tableTitles.forEach(title => {
                                // First try exact match
                                if (summaryFields.includes(title)) {
                                    scoreMap[title] = scoreMap[title];
                                    return;
                                }

                                // Try fuzzy matching
                                const titleWords = normalizeWords(title);
                                let bestMatch = null;
                                let bestMatchScore = 0;

                                summaryFields.forEach(field => {
                                    const fieldWords = normalizeWords(field);
                                    const overlapCount = titleWords.filter(word => fieldWords.includes(word)).length;

                                    if (overlapCount > bestMatchScore) {
                                        bestMatch = field;
                                        bestMatchScore = overlapCount;
                                    }
                                });

                                if (bestMatch && !scoreMap[title]) {
                                        scoreMap[title] = scoreMap[bestMatch];
                                    } else if (!scoreMap[title]) {
                                        // Check lowercase direct match (e.g., "remarks" vs "remark")
                                        const lowerTitle = title.toLowerCase().replace(/s$/, ''); // remove trailing 's'
                                        const fieldMatch = summaryFields.find(field => field.toLowerCase() === lowerTitle);
                                        if (fieldMatch) {
                                            scoreMap[title] = scoreMap[fieldMatch];
                                        }
                                    }
                            });

                            // Build the table
                            const thead = $('<thead></thead>');
                            const headerRow = $('<tr class="tb-col table-col cumulative-col"></tr>');

                            tableTitles.forEach(title => {
                                let thClass = "th-medium";
                                if (title === "SN") thClass = "th-small";
                                if (title === "FULL NAME") thClass = "th-name";
                                headerRow.append($(`<th class="${thClass}">${title}</th>`));
                            });
                            thead.append(headerRow);

                            const tbody = $('<tbody></tbody>');
                            studentList.forEach((student, index) => {
                                const row = $('<tr class="tb-row table-row"></tr>');
                                const fullName = `${student.surName} ${student.firstName} ${student.otherNames || ''}`.trim();

                                row.append($(`<td>${index + 1}</td>`));
                                row.append($(`<td class="name-td">${fullName}</td>` ));

                                for (let i = 2; i < tableTitles.length; i++) {
                                    const subjectAbbr = tableTitles[i];
                                    const score = scoreMap[subjectAbbr] && scoreMap[subjectAbbr][student.studentId] ? scoreMap[subjectAbbr][student.studentId] : '';
                                    row.append($(`<td>${score}</td>`));
                                }
                                tbody.append(row);
                            });
                            $('#pageContent').empty().append(thead).append(tbody);
                        });
                    </script>
                </table>
            </div>
        </div>
    </section>
</body>
</html>