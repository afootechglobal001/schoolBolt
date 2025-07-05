<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl?>/images/icon.png" rel="shortcut icon" type="image-png"/>
    <link href="<?php echo $websiteUrl?>/style/report-style.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
    <title>PRINT CA RESULT | <?php echo $clientName ?></title>
</head>

<body>
    <script> printSingleAssessementSession = JSON.parse(sessionStorage.getItem("printSingleAssessementSession"));</script>

    <section class="body-div all-terminal-body">
        <div class="header-back-div">
            <div class="header-div">
                <div class="inner-div">
                    <div class="logo-div">
                        <img src="<?php echo $websiteUrl?>/images/report/icon.png" alt="<?php echo $clientName?> Logo"/>   
                    </div> 
                    
                    <div class="text-div">
                        <h3 id="branchName">
                            <script>
                            $("#branchName").html(printSingleAssessementSession?.branchData?.branchName);
                            </script>
                        </h3>
                        <div class="text">Address: <strong id="address">
                                <script>
                                $("#address").html(printSingleAssessementSession?.branchData?.address);
                                </script>
                            </strong></div>
                        <div class="text">Phone: <strong id="mobileNumber">
                                <script>
                                $("#mobileNumber").html(printSingleAssessementSession?.branchData?.mobileNumber);
                                </script>
                            </strong> | Official Email: <strong id="smtpUsername">
                                <script>
                                $("#smtpUsername").html(printSingleAssessementSession?.branchData?.smtpUsername);
                                </script>
                            </strong></div>
                    </div>
                </div>
            </div>
            <div class="title-div"><span id="titleDetails">Loading...</span>MID-TERM RESULT
                <script>
                    $("#titleDetails").html(
                        printSingleAssessementSession?.session + ' ACADEMIC SESSION - ' +
                        printSingleAssessementSession?.termData?.termName + ' - ' +
                        printSingleAssessementSession?.departmentData?.departmentName + ' - ' +
                        printSingleAssessementSession?.classData?.className + ' - ' +
                        printSingleAssessementSession?.armData?.armName + ' - ' +
                        printSingleAssessementSession?.assessmentData?.assessmentName
                    );
                </script>
            </div>

            <div class="top-containner-back-div">
                <div class="inner-div-cont">
                    <div class="content-div">
                        <div class="details">
                            <span>STUDENT NAME</span>
                            <div id="fullName"><script>$("#fullName").html(printSingleAssessementSession?.studentData?.surName + ' ' + printSingleAssessementSession?.studentData?.firstName+ ' ' + printSingleAssessementSession?.studentData?.otherNames);</script></div>
                        </div>

                        <div class="details">
                            <span>STUDENT ID</span>
                            <div id="studentId"><script>$("#studentId").html(printSingleAssessementSession?.studentData?.studentId);</script></div>
                        </div>

                        <div class="details"><span>CLASS</span>
                            <div id="className"><script>$("#className").html(printSingleAssessementSession?.classData?.className + ' ' + printSingleAssessementSession?.armData?.armName);</script></div>
                        </div>

                        <div class="details"><span>GENDER</span>
                            <div id="genderName"><script>$("#genderName").html(printSingleAssessementSession?.studentData?.genderName);</script></div>
                        </div>
                    </div>

                    <div class="image-div" id="studentPix">
                        <script>
                            $("#studentPix").html('<img src="<?php echo $websiteUrl ?>/uploaded_files/studentPix/' +
                            printSingleAssessementSession?.studentData?.passport + '" alt="Student Profile Image">');
                        </script>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="inner-content">
            <div class="table-div computation-table animated fadeIn">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                     <script>
                        $(document).ready(function() {
                            const printSingleAssessementSession = JSON.parse(sessionStorage.getItem("printSingleAssessementSession"));
                            
                            let text = '';
                            let no=0;
                            text =`
                                <thead>
                                    <tr class="tb-col font">
                                        <th>SN</th>
                                        <th>SUBJECT</th>
                                        <th>SCORE(15)</th>
                                        <th>PERCENTAGE (%)</th>
                                        <th>POSN. IN CLASS</th>
                                        <th>GRADE</th>
                                        <th>REMARK</th>
                                    </tr>
                                </thead>`;

                            if (printSingleAssessementSession && printSingleAssessementSession.success === true) {
                                const subjectDataList = printSingleAssessementSession.data;

                                for (let i = 0; i < subjectDataList.length; i++) {
                                    no++;
                                    const subject = subjectDataList[i];
                                    const subjectName = subject.subjectName;
                                    const assessment = subject.subjectAssessment;

                                    text += `
                                        <tbody>
                                            <tr class="tb-row report-tb-row">
                                                <td>${no}</td>
                                                <td>${subjectName}</td>
                                                <td>20</td>
                                                <td>${assessment.percentage ? assessment.percentage : '-'}</td>
                                                <td>${assessment.position ? assessment.position : '-'}</td>
                                                <td>${assessment.grade ? assessment.grade : '-'}</td>
                                                <td>${assessment.remark ? assessment.remark  : '-'}</td>
                                            </tr>
                                        </tbody>`;
                                }
                                $('#pageContent').html(text);
                            }
                        });
                    </script>
                </table>
            </div>

            <div class="top-containner-back-div">
                <div class="inner-div-cont">
                    <div class="content-div">
                        <div class="details">
                            <span>NUMBER ON ROLL</span>
                            <div id="numberOfStudents"><script>$("#numberOfStudents").html(printSingleAssessementSession?.numberOfStudents);</script></div>
                        </div>

                        <div class="details">
                            <span>NUMBER OF SUBJECT</span>
                            <div id="numOfSubjects"><script>$("#numOfSubjects").html(printSingleAssessementSession?.numOfSubjects);</script></div>
                        </div>

                        <div class="details">
                            <span>MARKS OBTAINABLE</span>
                            <div id="totalMarkObtainable"><script>$("#totalMarkObtainable").html(printSingleAssessementSession?.totalMarkObtainable);</script></div>
                        </div>

                        <div class="details">
                            <span>MARKS OBTAINED</span>
                            <div id="totalMarkObtained"><script>$("#totalMarkObtained").html(printSingleAssessementSession?.totalMarkObtained);</script></div>
                        </div>

                        <div class="details"><span>PERCENTAGE</span>
                            <div id="totalPercentage"><script>$("#totalPercentage").html(printSingleAssessementSession?.totalPercentage);</script></div>
                        </div>

                        <div class="details">
                            <span>CLASS TEACHER'S COMMENT</span>
                            <div id="">HE RELATES WELL.</div>
                        </div>

                        <div class="details">
                            <span>PRINCIPAL'S COMMENT</span>
                            <div id="principalsComment"><script>$("#principalsComment").html(printSingleAssessementSession?.principalsComment);</script></div>
                        </div>

                        <div class="details">
                            <span>SCHOOL REOPENS ON</span>
                            <div id="">MONDAY 16TH June, 2025</div>
                        </div>
                    </div>

                    <div class="image-div signature">
                        <img src="<?php echo $websiteUrl?>/images/principal_signature.png" alt="Avatar"/>   
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>