<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl ?>/images/icon.png" rel="shortcut icon" type="image-png" />
    <link href="<?php echo $websiteUrl ?>/style/report-style.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl ?>/style/paramount.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl ?>/js/jquery-v3.6.1.min.js"></script>
    <title>Terminal Result Summary | <?php echo $clientName ?></title>
</head>

<body>
    <script>
        printTerminalResultSummarySession = JSON.parse(sessionStorage.getItem("printTerminalResultSummarySession"));
    </script>

    <section class="body-div all-terminal-body" id="backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat;">
        <div class="header-back-div">
            <div class="header-image">
                <img id="terminalResultSummaryHeader" src="<?php echo $websiteUrl ?>/images/report/terminal-result-summary-header.png" alt="Report Header" style="width: 100%; height: auto;"/>

                <script>
                    $(document).ready(function () {
                        const schoolHeader = printTerminalResultSummarySession?.branchData?.terminalResultSummaryHeader;
                        const headerUrl = schoolHeader ? `${terminalResultSummaryHeaderPixPath}/${schoolHeader}` : `<?php echo $websiteUrl ?>/images/report/terminal-result-summary-header.png`;
                        $("#terminalResultSummaryHeader").attr("src", headerUrl).attr("alt", `${printTerminalResultSummarySession?.branchData?.branchName} Report Header`);

                        const backendWatermark = printTerminalResultSummarySession?.branchData?.watermark;
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
                    $("#titleDetails").html(printTerminalResultSummarySession?.session + ' - ' +
                    printTerminalResultSummarySession?.termData?.termName + ' - ' +
                    printTerminalResultSummarySession?.departmentData?.departmentName + ' - ' +
                    printTerminalResultSummarySession?.classData?.className + ' ' +
                    printTerminalResultSummarySession?.armData?.armName);
                </script>
            </div>
        </div>

        <div class="inner-content">
            <div class="table-div">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                        $(document).ready(function() {
                            const printTerminalResultSummarySession = JSON.parse(sessionStorage.getItem("printTerminalResultSummarySession"));
                            if (!printTerminalResultSummarySession) return;

                            const tableTitles = printTerminalResultSummarySession?.tableTitles.split(',').map(x => x.trim());
                            const studentList = printTerminalResultSummarySession?.studentData;

                            // Dynamically extract all unique keys from student data
                            const summaryFields = Object.keys(studentList[0] || {});
                            const scoreMap = {};

                            // Build scoreMap for summary fields (from studentList)
                            summaryFields.forEach(field => {
                                scoreMap[field] = {};
                                studentList.forEach(student => {
                                    scoreMap[field][student.studentId] = student[field];
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

                                const titleWords = normalizeWords(title).map(w => w.replace(/['s]+$/g, '').replace(/s$/, '')); // remove plurals & possessives
                                let bestMatch = null;
                                let bestMatchScore = 0;

                                summaryFields.forEach(field => {
                                    const fieldWords = normalizeWords(field).map(w => w.replace(/['s]+$/g, '').replace(/s$/, ''));
                                    const overlapCount = titleWords.filter(word => fieldWords.includes(word)).length;

                                    // Compute a ratio of overlap instead of a fixed score
                                    const similarity = overlapCount / Math.max(titleWords.length, fieldWords.length);

                                    if (similarity > bestMatchScore) {
                                        bestMatch = field;
                                        bestMatchScore = similarity;
                                    }
                                });

                                // Assign best fuzzy match
                                if (bestMatch && !scoreMap[title]) {
                                    scoreMap[title] = scoreMap[bestMatch];
                                } else if (!scoreMap[title]) {
                                    // lowercase direct match fallback (handles remark vs remarks)
                                    const lowerTitle = title.toLowerCase().replace(/['s]+$/g, '').replace(/s$/, '');
                                    const fieldMatch = summaryFields.find(field =>
                                        field.toLowerCase().replace(/['s]+$/g, '').replace(/s$/, '') === lowerTitle
                                    );
                                    if (fieldMatch) {
                                        scoreMap[title] = scoreMap[fieldMatch];
                                    }
                                }
                            });


                            // Build the table
                            const thead = $('<thead></thead>');
                            const headerRow = $('<tr class="tb-col table-col"></tr>');


                            tableTitles.forEach(title => {
                                headerRow.append($('<th></th>').text(title));
                            });

                            thead.append(headerRow);

                            const tbody = $('<tbody></tbody>');

                            studentList.forEach((student, index) => {
                                const row = $('<tr class="tb-row table-row"></tr>');
                                const fullName = `${student.surName} ${student.otherNames || ''}`.trim();

                                row.append($('<td></td>').text(index + 1));
                                row.append($('<td></td>').text(fullName));

                                for (let i = 2; i < tableTitles.length; i++) {
                                    const title = tableTitles[i];
                                    const score = scoreMap[title] && scoreMap[title][student.studentId] ? scoreMap[title][student.studentId] : '';
                                    if (score === null || score === "null" || score === undefined) score = '';
                                    row.append($('<td></td>').text(score));
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