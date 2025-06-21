<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl ?>/images/icon.png" rel="shortcut icon" type="image-png" />
    <link href="<?php echo $websiteUrl ?>/style/report-style.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl ?>/style/paramount.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl ?>/js/jquery-v3.6.1.min.js"></script>
    <title>Broad Sheet| <?php echo $clientName ?></title>
</head>

<body>
    <script>
        printBroadSheetsession = JSON.parse(sessionStorage.getItem("printBroadSheetsession"));
    </script>

    <section class="body-div broadsheet-body">
        <div class="header-back-div">
            <div class="header-div">
                <div class="inner-div">
                    <div class="logo-div">
                        <img src="<?php echo $websiteUrl ?>/images/report/icon.png" alt="<?php echo $clientName ?> Logo" />
                    </div>

                    <div class="text-div">
                        <h3 id="branchName">
                            <script>
                                $("#branchName").html(printBroadSheetsession?.branchData?.branchName);
                            </script>
                        </h3>
                        <div class="text">Address: <strong id="address">
                                <script>
                                    $("#address").html(printBroadSheetsession?.branchData?.address);
                                </script>
                            </strong></div>
                        <div class="text">Phone: <strong id="mobileNumber">
                                <script>
                                    $("#mobileNumber").html(printBroadSheetsession?.branchData?.mobileNumber);
                                </script>
                            </strong> | Official Email: <strong id="smtpUsername">
                                <script>
                                    $("#smtpUsername").html(printBroadSheetsession?.branchData?.smtpUsername);
                                </script>
                            </strong></div>
                    </div>
                </div>
            </div>
            <div class="title-div"><span id="titleDetails">Loading... </span>BROAD SHEET</div>
            <script>
                $("#titleDetails").html(printBroadSheetsession?.session + ' - ' +
                    printBroadSheetsession?.termData?.termName + ' - ' +
                    printBroadSheetsession?.departmentData?.departmentName + ' - ' +
                    printBroadSheetsession?.classData?.className + ' - ' +
                    printBroadSheetsession?.armData?.armName + ' - ' +
                    printBroadSheetsession?.assessmentData?.assessmentName);
            </script>
        </div>

        <div class="inner-content broadsheet-inner-content">
            <div class="table-div computation-table broadsheet-table  animated fadeIn">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                        $(document).ready(function() {
                            const printBroadSheetsession = JSON.parse(sessionStorage.getItem("printBroadSheetsession"));
                            if (!printBroadSheetsession) return;

                            const tableTitles = printBroadSheetsession?.tableTitles.split(',').map(x => x.trim());
                            const studentList = printBroadSheetsession?.studentData;
                            const scoreList = printBroadSheetsession?.scoreData;
                            const summaryData = printBroadSheetsession?.summaryData;

                            const scoreMap = {};

                            // Build scoreMap from subjects
                            scoreList.forEach(subject => {
                                const abbr = subject.subjectAbbreviation;
                                scoreMap[abbr] = {};

                                if (Array.isArray(subject.studentScorePerSubject)) {
                                    subject.studentScorePerSubject.forEach(scoreEntry => {
                                        scoreMap[abbr][scoreEntry.studentId] = scoreEntry.markObtained;
                                    });
                                }
                            });

                            // Add summary data into scoreMap
                            const studentKeys = Object.keys(studentList[0]);
                            const summaryFields = Object.keys(summaryData[0]).filter(k =>
                                !studentKeys.includes(k)
                            );

                            summaryFields.forEach(field => {
                                scoreMap[field] = {}; // Prepare a new entry for summaryField key
                                summaryData.forEach(summary => {
                                    scoreMap[field][summary.studentId] = summary[field];
                                });
                            });

                            function normalizeWords(str) {
                                return str.replace(/[\W_]+/g, ' ') // Remove punctuation
                                    .replace(/([a-z])([A-Z])/g, '$1 $2') // Split camelCase
                                    .toLowerCase()
                                    .split(' ')
                                    .filter(Boolean);
                            }

                            tableTitles.forEach(title => {
                                const titleWords = normalizeWords(title);

                                summaryFields.forEach(field => {
                                    const fieldWords = normalizeWords(field);

                                    // Match if at least one word overlaps
                                    const hasOverlap = titleWords.some(word => fieldWords.includes(word));

                                    if (hasOverlap) {
                                        scoreMap[title] = scoreMap[field];
                                    }
                                });
                            });

                            const thead = $('<thead></thead>');
                            const headerRow = $('<tr class="tb-col"></tr>');

                            tableTitles.forEach(title => {
                                headerRow.append($('<th class="th"></th>').text(title));
                            });

                            thead.append(headerRow);

                            const tbody = $('<tbody></tbody>');

                            studentList.forEach((student, index) => {
                                const row = $('<tr class="tb-row report-tb-row"></tr>');
                                const fullName = `${student.surName} ${student.firstName} ${student.otherNames || ''}`.trim();

                                row.append($('<td class="td"></td>').text(index + 1));
                                row.append($('<td class="td"></td>').text(fullName));

                                for (let i = 2; i < tableTitles.length; i++) {
                                    const subjectAbbr = tableTitles[i];
                                    const score = scoreMap[subjectAbbr] && scoreMap[subjectAbbr][student.studentId] ? scoreMap[subjectAbbr][student.studentId] : '';
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