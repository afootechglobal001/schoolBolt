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
    <title>Terminal Broad Sheet| <?php echo $clientName ?></title>
</head>

<body>
    <script>
    printTerminalBroadSheetsession = JSON.parse(sessionStorage.getItem("printTerminalBroadSheetsession"));
    </script>

    <section class="body-div broadsheet-body">
        <div class="header-back-div">
            <div class="header-div">
                <div class="inner-div">
                    <div class="logo-div">
                        <img src="<?php echo $websiteUrl ?>/images/report/icon.png"
                            alt="<?php echo $clientName ?> Logo" />
                    </div>

                    <div class="text-div">
                        <h3 id="branchName">
                            <script>
                            $("#branchName").html(printTerminalBroadSheetsession?.branchData?.branchName);
                            </script>
                        </h3>
                        <div class="text">Address: <strong id="address">
                                <script>
                                $("#address").html(printTerminalBroadSheetsession?.branchData?.address);
                                </script>
                            </strong></div>
                        <div class="text">Phone: <strong id="mobileNumber">
                                <script>
                                $("#mobileNumber").html(printTerminalBroadSheetsession?.branchData?.mobileNumber);
                                </script>
                            </strong> | Official Email: <strong id="smtpUsername">
                                <script>
                                $("#smtpUsername").html(printTerminalBroadSheetsession?.branchData?.smtpUsername);
                                </script>
                            </strong></div>
                    </div>
                </div>
            </div>
            <div class="title-div"><span id="titleDetails">Loading... </span>TERMINAL BROAD SHEET</div>
            <script>
            $("#titleDetails").html(printTerminalBroadSheetsession?.session + ' - ' +
                printTerminalBroadSheetsession?.termData?.termName + ' - ' +
                printTerminalBroadSheetsession?.departmentData?.departmentName + ' - ' +
                printTerminalBroadSheetsession?.classData?.className + ' - ' +
                printTerminalBroadSheetsession?.armData?.armName);
            </script>
        </div>

        <div class="inner-content broadsheet-inner-content">
            <div class="table-div computation-table broadsheet-table  animated fadeIn">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                    $(document).ready(function() {
                        const printTerminalBroadSheetsession = JSON.parse(sessionStorage.getItem(
                            "printTerminalBroadSheetsession"));
                        if (!printTerminalBroadSheetsession) return;

                        const tableTitles = printTerminalBroadSheetsession?.tableTitles.split(',').map(x => x.trim());
                        const studentList = printTerminalBroadSheetsession?.studentData;
                        const scoreList = printTerminalBroadSheetsession?.scoreData;
                        const summaryData = printTerminalBroadSheetsession?.summaryData;

                        const scoreMap = {};

                        // Build subject scores into scoreMap
                        scoreList.forEach(subject => {
                            const abbr = subject.subjectAbbreviation;
                            scoreMap[abbr] = {};

                            if (Array.isArray(subject.studentScorePerSubject)) {
                                subject.studentScorePerSubject.forEach(scoreEntry => {
                                    scoreMap[abbr][scoreEntry.studentId] = scoreEntry
                                        .totalMark;
                                });
                            }
                        });

                        // Extract summary fields
                        const studentKeys = Object.keys(studentList[0] || {});
                        const summaryFields = Object.keys(summaryData[0] || {}).filter(k => !studentKeys
                            .includes(k));

                        // Build scoreMap for summary fields
                        summaryFields.forEach(field => {
                            scoreMap[field] = {};
                            summaryData.forEach(summary => {
                                scoreMap[field][summary.studentId] = summary[field];
                            });
                        });

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
                                const overlapCount = titleWords.filter(word => fieldWords
                                    .includes(word)).length;

                                if (overlapCount > bestMatchScore) {
                                    bestMatch = field;
                                    bestMatchScore = overlapCount;
                                }
                            });

                            if (bestMatch && !scoreMap[title]) {
                                scoreMap[title] = scoreMap[bestMatch];
                            }
                        });

                        // Build the table
                        const thead = $('<thead></thead>');
                        const headerRow = $('<tr class="tb-col"></tr>');

                        tableTitles.forEach(title => {
                            headerRow.append($('<th class="th"></th>').text(title));
                        });

                        thead.append(headerRow);

                        const tbody = $('<tbody></tbody>');

                        studentList.forEach((student, index) => {
                            const row = $('<tr class="tb-row report-tb-row"></tr>');
                            const fullName =
                                `${student.surName} ${student.firstName} ${student.otherNames || ''}`
                                .trim();

                            row.append($('<td class="td"></td>').text(index + 1));
                            row.append($('<td class="td"></td>').text(fullName));

                            for (let i = 2; i < tableTitles.length; i++) {
                                const subjectAbbr = tableTitles[i];
                                const score = scoreMap[subjectAbbr] && scoreMap[subjectAbbr][student
                                        .studentId
                                    ] ?
                                    scoreMap[subjectAbbr][student.studentId] :
                                    '';
                                row.append($('<td class="td"></td>').text(score));
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