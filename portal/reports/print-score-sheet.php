<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl ?>/images/icon.png" rel="shortcut icon" type="image-png" />
    <link href="<?php echo $websiteUrl ?>/style/report-style.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl ?>/style/paramount.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl ?>/js/jquery-v3.6.1.min.js"></script>
    <title>Score Sheet| <?php echo $clientName ?></title>
</head>

<body>
    <script> printStudentScoreSheetSession = JSON.parse(sessionStorage.getItem("printStudentScoreSheetSession"));</script>

    <section class="body-div">
        <div class="header-back-div">
            <div class="header-div">
                <div class="inner-div">
                    <div class="logo-div">
                        <img id="profileSchoolLogoImg" src="<?php echo $websiteUrl ?>/images/report/icon.png" alt="<?php echo $clientName ?> Logo" />
                    </div>

                    <script>
                        $(document).ready(function () {
                            const schoolLogo = printStudentScoreSheetSession?.branchData?.schoolLogo;
                            const logoUrl = schoolLogo ? `${schoolLogoPixPath}/${schoolLogo}` : "<?php echo $websiteUrl ?>/images/report/icon.png";

                            $("#profileSchoolLogoImg").attr("src", logoUrl).attr("alt", printStudentScoreSheetSession?.branchData?.branchName + " Logo");
                        });
                    </script>

                    <div class="text-div">
                        <h3 id="branchName">
                            <script>
                                $("#branchName").html(printStudentScoreSheetSession?.branchData?.branchName);
                            </script>
                        </h3>
                        <div class="text">Address: <strong id="address">
                                <script>
                                    $("#address").html(printStudentScoreSheetSession?.branchData?.address);
                                </script>
                            </strong></div>
                        <div class="text">Phone: <strong id="mobileNumber">
                                <script>
                                    $("#mobileNumber").html(printStudentScoreSheetSession?.branchData?.mobileNumber);
                                </script>
                            </strong> | Official Email: <strong id="smtpUsername">
                                <script>
                                    $("#smtpUsername").html(printStudentScoreSheetSession?.branchData?.supportEmail);
                                </script>
                            </strong></div>
                    </div>
                </div>
            </div>
            <div class="title-div"><span id="titleDetails">Loading... </span>SCORE SHEET</div>
            <script>
                $("#titleDetails").html(printStudentScoreSheetSession?.session + ' - ' +
                    printStudentScoreSheetSession?.termData?.termName + ' - ' +
                    printStudentScoreSheetSession?.departmentData?.departmentName + ' - ' +
                    printStudentScoreSheetSession?.classData?.className + ' - ' +
                    printStudentScoreSheetSession?.armData?.armName + ' - ' +
                    printStudentScoreSheetSession?.subjectData?.subjectName);
            </script>
        </div>

        <div class="inner-content">
            <div class="table-div computation-table animated fadeIn">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                        $(document).ready(function () {
                            const printStudentScoreSheetSession = JSON.parse(sessionStorage.getItem("printStudentScoreSheetSession"));

                            if (!printStudentScoreSheetSession) return;

                            const tableTitles = printStudentScoreSheetSession.tableTitles.split(',').map(title => title.trim());
                            const students = printStudentScoreSheetSession.studentsData;

                            if (!Array.isArray(students) || students.length === 0) {
                                $('#pageContent').html('<tr><td colspan="100%">No data available.</td></tr>');
                                return;
                            }

                            const thead = $('<thead></thead>');
                            const headerRow = $('<tr class="tb-col"></tr>');

                            tableTitles.forEach(title => {
                                headerRow.append($('<th class="th"></th>').text(title));
                            });

                            thead.append(headerRow);

                            const tbody = $('<tbody></tbody>');

                            students.forEach((student, index) => {
                                const row = $('<tr class="tb-row report-tb-row"></tr>');
                                const fullName = `${student.surName} ${student.firstName} ${student.otherNames || ''}`.trim();

                                row.append($('<td class="td"></td>').text(index + 1)); // SN
                                row.append($('<td class="td"></td>').text(fullName));  // Full Name

                                for (let i = 2; i < tableTitles.length; i++) {
                                    row.append($('<td class="td"></td>').text('')); // Empty cells
                                }

                                tbody.append(row);
                            });

                            for (let j = 0; j < 3; j++) {
                                const emptyRow = $('<tr class="tb-row report-tb-row"></tr>');
                                for (let i = 0; i < tableTitles.length; i++) {
                                    emptyRow.append($('<td class="td"></td>').text(''));
                                }
                                tbody.append(emptyRow);
                            }
                            $('#pageContent').empty().append(thead).append(tbody);
                        });
                    </script>
                </table>
            </div>
        </div>
    </section>
</body>

</html>