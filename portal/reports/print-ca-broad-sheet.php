<?php include '../config/constants.php'; ?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl ?>/images/icon.png" rel="shortcut icon" type="image-png" />
    <link href="<?php echo $websiteUrl ?>/style/report-style.css?v=<?php echo $codeVersion ?>" type="text/css"
        rel="stylesheet" />
    <link href="<?php echo $websiteUrl ?>/style/paramount.css?v=<?php echo $codeVersion ?>" type="text/css"
        rel="stylesheet" />
    <script src="<?php echo $websiteUrl ?>/js/jquery-v3.6.1.min.js"></script>
    <title>Broad Sheet| <?php echo $clientName ?></title>
</head>

<body>
    <script> printBroadSheetsession = JSON.parse(sessionStorage.getItem("printBroadSheetsession"));</script>

    <section class="body-div broadsheet-body" id="backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat;">
        <div class="header-back-div">
            <div class="header-image">
                <img id="caBroadSheetHeader" src="<?php echo $websiteUrl ?>/images/report/ca-broad-sheet-header.png" alt="Report Header" style="width: 100%; height: auto;"/>

                <script>
                    $(document).ready(function () {
                        const schoolHeader = printBroadSheetsession?.branchData?.caBroadSheetHeader;
                        const headerUrl = schoolHeader ? `${caBroadSheetHeaderPixPath}/${schoolHeader}` : `<?php echo $websiteUrl ?>/images/report/ca-broad-sheet-header.png`;
                        $("#caBroadSheetHeader").attr("src", headerUrl).attr("alt", `${printBroadSheetsession?.branchData?.branchName} Report Header`);

                        const backendWatermark = printBroadSheetsession?.branchData?.watermark;
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
                $("#titleDetails").html(printBroadSheetsession?.session + ' - ' +
                    printBroadSheetsession?.termData?.termName + ' - ' +
                    printBroadSheetsession?.departmentData?.departmentName + ' - ' +
                    printBroadSheetsession?.classData?.className + ' - ' +
                    printBroadSheetsession?.armData?.armName + ' - ' +
                    printBroadSheetsession?.assessmentData?.assessmentName);
                </script>
            </div>
        </div>

        <div class="inner-content">
            <div class="table-div">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                        $(document).ready(function () {
                            const printBroadSheetsession = JSON.parse(sessionStorage.getItem("printBroadSheetsession"));
                            if (!printBroadSheetsession) return;

                            const tableTitles = printBroadSheetsession?.tableTitles.split(',').map(x => x.trim());
                            const studentList = printBroadSheetsession?.studentData;
                            const scoreList = printBroadSheetsession?.scoreData;

                            // Dynamically extract all unique keys from student data
                            const summaryFields = Object.keys(studentList[0] || {});
                            const scoreMap = {};

                            // Build subject scores into scoreMap
                            scoreList.forEach(subject => {
                                const abbr = subject.subjectAbbreviation;
                                scoreMap[abbr] = {};

                                if (Array.isArray(subject.studentScorePerSubject)) {
                                    subject.studentScorePerSubject.forEach(scoreEntry => {
                                        scoreMap[abbr][scoreEntry.studentId] = scoreEntry.markObtained;
                                    });
                                }
                            });

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
                            const headerRow = $('<tr class="tb-col table-col"></tr>');

                            tableTitles.forEach(title => {
                                headerRow.append($('<th></th>').text(title));
                            });

                            thead.append(headerRow);
                            const tbody = $('<tbody></tbody>');

                            studentList.forEach((student, index) => {
                                const row = $('<tr class="tb-row table-row"></tr>');
                                const fullName = `${student.surName} ${student.firstName} ${student.otherNames || ''}`.trim();

                                row.append($('<td></td>').text(index + 1));
                                row.append($('<td></td>').text(fullName));

                                for (let i = 2; i < tableTitles.length; i++) {
                                    const columnKey = tableTitles[i];
                                    const score = scoreMap[columnKey] && scoreMap[columnKey][student.studentId] ? scoreMap[columnKey][student.studentId] : '';
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