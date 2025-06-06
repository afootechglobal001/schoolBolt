<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl ?>/images/icon.png" rel="shortcut icon" type="image-png" />
    <link href="<?php echo $websiteUrl ?>/style/report-style.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl ?>/style/paramount.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl ?>/js/jquery-v3.6.1.min.js"></script>
    <title>Score | <?php echo $clientName ?></title>
</head>

<body>
    <script>
        printStudentByClassSession = JSON.parse(sessionStorage.getItem("printStudentByClassSession"));
    </script>

    <section class="body-div">
        <div class="header-back-div">
            <div class="header-div">
                <div class="inner-div">
                    <div class="logo-div">
                        <img src="<?php echo $websiteUrl ?>/images/report/icon.png" alt="<?php echo $clientName ?> Logo" />
                    </div>

                    <div class="text-div">
                        <h3 id="branchName">
                            <script>
                                $("#branchName").html(printStudentByClassSession?.branchData?.branchName);
                            </script>
                        </h3>
                        <div class="text">Address: <strong id="address">
                                <script>
                                    $("#address").html(printStudentByClassSession?.branchData?.address);
                                </script>
                            </strong></div>
                        <div class="text">Phone: <strong id="mobileNumber">
                                <script>
                                    $("#mobileNumber").html(printStudentByClassSession?.branchData?.mobileNumber);
                                </script>
                            </strong> | Official Email: <strong id="smtpUsername">
                                <script>
                                    $("#smtpUsername").html(printStudentByClassSession?.branchData?.smtpUsername);
                                </script>
                            </strong></div>
                    </div>
                </div>
            </div>
            <div class="title-div"><span id="titleDetails">Loading... </span>STUDENT'S LIST</div>
            <script>
                $("#titleDetails").html(printStudentByClassSession?.session + ' - ' +
                    printStudentByClassSession?.termData?.termName + ' - ' +
                    printStudentByClassSession?.departmentData?.departmentName + ' - ' +
                    printStudentByClassSession?.classData?.className + ' - ' +
                    printStudentByClassSession?.armData?.armName);
            </script>
        </div>

        <div class="inner-content">
            <div class="table-div animated fadeIn">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                        $(document).ready(function() {
                            const printStudentByClassSession = JSON.parse(sessionStorage.getItem("printStudentByClassSession"));

                            if (!printStudentByClassSession || printStudentByClassSession.success !== true) {
                                $('#pageContent').html('<tr><td colspan="100%">No data available.</td></tr>');
                                return;
                            }

                            const students = printStudentByClassSession.data;

                            if (!Array.isArray(students) || students.length === 0) {
                                $('#pageContent').html('<tr><td colspan="100%">No data available.</td></tr>');
                                return;
                            }

                            const columns = Object.keys(students[0].studentData);

                            let thead = $('<thead></thead>');
                            let headerRow = $('<tr class="tb-col"></tr>');

                            columns.forEach(function(col) {
                                headerRow.append($('<th></th>').text(col));
                            });

                            thead.append(headerRow);

                            let tbody = $('<tbody></tbody>');

                            students.forEach(function(row) {
                                let tr = $('<tr class="tb-row"></tr>');
                                columns.forEach(function(col) {
                                    tr.append($('<td></td>').text(row.studentData[col] !== undefined ? row.studentData[col] : ''));
                                });
                                tbody.append(tr);
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