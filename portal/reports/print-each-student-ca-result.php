<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl ?>/images/icon.png" rel="shortcut icon" type="image-png" />
    <link href="<?php echo $websiteUrl ?>/style/report-style.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl ?>/style/paramount.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl ?>/js/jquery-v3.6.1.min.js"></script>
    <script src="<?php echo $websiteUrl ?>/js/scripts.js?v=<?php echo $codeVersion ?>"></script>
    <title>PRINT CA RESULT | <?php echo $clientName ?></title>
</head>

<body>
    <script>
        printSingleAssessementSession = JSON.parse(sessionStorage.getItem("printSingleAssessementSession"));
    </script>

    <section class="body-div all-terminal-body">
        <div class="header-back-div">
            <div class="header-div">
                <div class="inner-div">
                    <div class="logo-div">
                        <img id="profileSchoolLogoImg" src="<?php echo $websiteUrl ?>/images/report/icon.png" alt="<?php echo $clientName ?> Logo" />
                    </div>

                    <script>
                        $(document).ready(function() {
                            const schoolLogo = printSingleAssessementSession?.branchData?.schoolLogo;
                            const logoUrl = schoolLogo ? `${schoolLogoPixPath}/${schoolLogo}` : "<?php echo $websiteUrl ?>/images/report/icon.png";

                            $("#profileSchoolLogoImg").attr("src", logoUrl).attr("alt", printSingleAssessementSession?.branchData?.branchName + " Logo");
                        });
                    </script>

                    <div class="text-div">
                        <h1 id="branchName">
                            <script>
                                $("#branchName").html(printSingleAssessementSession?.branchData?.branchName);
                            </script>
                        </h1>
                        <div>
                            <div class="text"><span>Address:</span> <strong id="address">
                                    <script>
                                        $("#address").html(printSingleAssessementSession?.branchData?.address);
                                    </script>
                                </strong></div>
                            <div class="text"><span>Phone:</span> <strong id="mobileNumber">
                                    <script>
                                        $("#mobileNumber").html(printSingleAssessementSession?.branchData?.mobileNumber);
                                    </script>
                                </strong> | <span>Official Email:</span> <strong id="smtpUsername">
                                    <script>
                                        $("#smtpUsername").html(printSingleAssessementSession?.branchData?.supportEmail);
                                    </script>
                                </strong></div>
                            <div class="text"><span>Website:</span> <strong id="clientWebsite">
                                <script>
                                    $("#clientWebsite").html(printSingleAssessementSession?.clientWebsite);
                                </script>
                                </strong></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="title-back-div">
                <div class="title-div">
                    <h2>Mid-Term Result</h2>
                </div>
                <div class="title-div grey-title">
                    <h3 id="titleDetails"></h3>
                    <script>
                        $("#titleDetails").html(
                            printSingleAssessementSession?.termData?.termName + ' ' +
                            printSingleAssessementSession?.session + ' ACADEMIC SESSION'
                        );
                    </script>
                </div>
            </div>
            <div class="top-containner-back-div">
                <div class="inner-div-cont">
                    <div class="content-div">
                        <div>
                            <div class="name">
                                <div id="fullName">
                                    <script>
                                        $("#fullName").html(printSingleAssessementSession?.studentData?.surName + ' ' + printSingleAssessementSession?.studentData?.firstName + ' ' + printSingleAssessementSession?.studentData?.otherNames);
                                    </script>
                                </div>
                            </div>
                        </div>

                        <div class="bottom-details">
                            <div class="details">
                                <p>STUDENT ID: <span id="studentId">
                                        <script>
                                            $("#studentId").html(printSingleAssessementSession?.studentData?.officialStudentId ? printSingleAssessementSession?.studentData?.officialStudentId : printSingleAssessementSession?.studentData?.studentId);
                                        </script>
                                    </span></p>

                            </div>

                            <div class="details">
                                <p>CLASS: <span id="className">
                                        <script>
                                            $("#className").html(printSingleAssessementSession?.classData?.className + ' ' + printSingleAssessementSession?.armData?.armName);
                                        </script>
                                    </span></p>
                            </div>

                            <div class="details">
                                <p>GENDER: <span id="genderName">
                                        <script>
                                            $("#genderName").html(printSingleAssessementSession?.studentData?.genderName);
                                        </script>
                                    </span></p>
                            </div>
                        </div>
                    </div>

                    <div class="image-div" id="studentPix">
                        <script>
                            $("#studentPix").html('<img src="' + studentPixPath + '/' + printSingleAssessementSession?.studentData?.passport + '" alt="' + printSingleAssessementSession?.studentData?.surName + '">');
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <div class="inner-content">
            <div class="table-div animated fadeIn">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                        $(document).ready(function() {
                            const printSingleAssessementSession = JSON.parse(sessionStorage.getItem("printSingleAssessementSession"));

                            let text = `
                            <thead>
                                <tr class="tb-col">
                                    <th>SN</th>
                                    <th>SUBJECT</th>
                                    <th>MARK OBTAINABLE</th>
                                    <th>MARK OBTAINED</th>
                                    <th>PERCENTAGE (%)</th>
                                    <th>POSN. IN CLASS</th>
                                    <th>GRADE</th>
                                    <th>REMARK</th>
                                </tr>
                            </thead>
                            <tbody>`;

                            if (printSingleAssessementSession && printSingleAssessementSession.success === true) {
                                const subjectDataList = printSingleAssessementSession.data?.subjectData || [];
                                const summary = printSingleAssessementSession?.data?.summary || {};

                                for (let i = 0; i < subjectDataList.length; i++) {
                                    const no = i + 1;
                                    const subject = subjectDataList[i];
                                    const assessment = subject.subjectAssessment || {};

                                    text += `
                                    <tr class="tb-row">
                                    <td>${no}</td>
                                    <td>${subject.subjectName || '-'}</td>
                                    <td>${assessment.markObtainable || '-'}</td>
                                    <td>${assessment.markObtained || '-'}</td>
                                    <td>${assessment.percentage ? assessment.percentage + '%' : '-'}</td>
                                    <td>${assessment.positionInClass || '-'}</td>
                                    <td>${assessment.grade || '-'}</td>
                                    <td>${assessment.remark || '-'}</td>
                                    </tr>`;
                                }

                                text += `</tbody>`;
                                $('#pageContent').html(text);

                                // Example data filling for summary
                                $('#numberOfStudents').html(printSingleAssessementSession?.data?.numberOfStudents || '-');
                                $('#numOfSubjects').html(summary.totalSubjects || '-');
                                $('#totalMarkObtainable').html(summary.totalMarkObtainable || '-');
                                $('#totalMarkObtained').html(summary.totalMarkObtained || '-');
                                $('#totalPercentage').html(summary.totalPercentage ? summary.totalPercentage + '%' : '-');
                                $('#principalsComment').html(summary.principalComment || '-');
                                $('#classTeacherComment').html(printSingleAssessementSession?.classTeachersComment?.classTeachersComment || '-');
                                $('#formatDate').html(formatDate(printSingleAssessementSession?.branchData?.schoolResumptionDate));
                            }
                        });
                    </script>
                </table>
            </div>

            <div class="bottom-content-back-div">
                <div class="inner-container">
                    <div class="content-container">
                        <div class="list-content">
                            <span>NUMBER ON ROLL:</span>
                            <p id="numberOfStudents"></p>
                        </div>

                        <div class="list-content">
                            <span>NUMBER OF SUBJECT:</span>
                            <p id="numOfSubjects"></p>
                        </div>

                        <div class="list-content">
                            <span>MARKS OBTAINABLE:</span>
                            <p id="totalMarkObtainable"></p>
                        </div>

                        <div class="list-content">
                            <span>MARKS OBTAINED:</span>
                            <p id="totalMarkObtained"></p>
                        </div>

                        <div class="list-content">
                            <span>PERCENTAGE:</span>
                            <p id="totalPercentage"></p>
                        </div>

                        <div class="list-content">
                            <span>CLASS TEACHER'S COMMENT:</span>
                            <p id="classTeacherComment"></p>
                        </div>

                        <div class="list-content">
                            <span>PRINCIPAL'S COMMENT:</span>
                            <p id="principalsComment"></p>
                        </div>

                        <div class="list-content">
                            <span>SCHOOL REOPENS ON:</span>
                            <p id="formatDate"></p>
                        </div>
                    </div>

                    <div class="signature" id="principalSignature">
                        <script>
                            $("#principalSignature").html('<img src="' + principalSignaturePixPath + '/' + printSingleAssessementSession?.branchData?.principalSignature + '" alt="' + printSingleAssessementSession?.branchData?.branchName + ' PRINCIPAL SIGNATURE">');
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>