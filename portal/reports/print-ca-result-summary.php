<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl?>/images/icon.png" rel="shortcut icon" type="image-png"/>
    <link href="<?php echo $websiteUrl?>/style/report-style.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
    <title>Continuous Assessment Result Summary | <?php echo $clientName ?></title>
</head>

<body>
    <script> printResultSummarySession = JSON.parse(sessionStorage.getItem("printResultSummarySession"));</script>

    <section class="body-div all-terminal-body">
        <div class="header-back-div">
            <div class="header-div">
                <div class="inner-div">
                    <div class="logo-div">
                        <img id="profileSchoolLogoImg" src="<?php echo $websiteUrl?>/images/report/icon.png" alt="<?php echo $clientName?> Logo"/>   
                    </div>

                    <script>
                        $(document).ready(function () {
                            const schoolLogo = printResultSummarySession?.branchData?.schoolLogo;
                            const logoUrl = schoolLogo ? `${schoolLogoPixPath}/${schoolLogo}` : "<?php echo $websiteUrl ?>/images/report/icon.png";

                            $("#profileSchoolLogoImg").attr("src", logoUrl).attr("alt", printResultSummarySession?.branchData?.branchName + " Logo");
                        });
                    </script>
                    
                    <div class="text-div">
                        <h3 id="branchName"><script>$("#branchName").html(printResultSummarySession?.branchData?.branchName);</script></h3>
                        <div class="text">Address: <strong id="address"><script>$("#address").html(printResultSummarySession?.branchData?.address);</script></strong></div>
                        <div class="text">Phone: <strong id="mobileNumber"><script>$("#mobileNumber").html(printResultSummarySession?.branchData?.mobileNumber);</script></strong> | Official Email: <strong id="smtpUsername"><script>$("#smtpUsername").html(printResultSummarySession?.branchData?.smtpUsername);</script></strong></div> 
                    </div>
                </div>
            </div>
            <div class="title-div"><span id="titleDetails">Loading...</span>RESULT SUMMARY</div>
             <script>
                $("#titleDetails").html(printResultSummarySession?.session + ' - ' +
                printResultSummarySession?.termData?.termName + ' - ' +
                printResultSummarySession?.departmentData?.departmentName + ' - ' +
                printResultSummarySession?.classData?.className + ' ' +
                printResultSummarySession?.armData?.armName + ' - ' +
                printResultSummarySession?.assessmentData?.assessmentName);
            </script>
        </div>
    
        <div class="inner-content">
            <div class="table-div computation-table animated fadeIn">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                        $(document).ready(function() {
                            const printResultSummarySession = JSON.parse(sessionStorage.getItem("printResultSummarySession"));
                            if (!printResultSummarySession) return;

                            const tableTitles = printResultSummarySession?.tableTitles.split(',').map(x => x.trim());
                            const studentList = printResultSummarySession?.studentData;

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
                            const headerRow = $('<tr class="tb-col"></tr>');


                            tableTitles.forEach(title => {
                                headerRow.append($('<th class="font"></th>').text(title));
                            });

                            thead.append(headerRow);

                            const tbody = $('<tbody></tbody>');

                            studentList.forEach((student, index) => {
                                const row = $('<tr class="tb-row report-tb-row"></tr>');
                                const fullName = `${student.surName} ${student.otherNames || ''}`.trim();

                                row.append($('<td class="td"></td>').text(index + 1));
                                row.append($('<td class="td"></td>').text(fullName));

                                for (let i = 2; i < tableTitles.length; i++) {
                                    const title = tableTitles[i];
                                    const score = scoreMap[title] && scoreMap[title][student.studentId] ? scoreMap[title][student.studentId] : '';
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