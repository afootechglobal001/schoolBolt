<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl?>/images/icon.png" rel="shortcut icon" type="image-png"/>
    <link href="<?php echo $websiteUrl?>/style/report-style.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
    <title>Assessment Score Sheet | <?php echo $clientName ?></title>
</head>

<body>
    <script> printAssessmentSession = JSON.parse(sessionStorage.getItem("printAssessmentSession"));</script>

    <section class="body-div">
        <div class="header-back-div">
            <div class="header-div">
                <div class="inner-div">
                    <div class="logo-div">
                        <img id="profileSchoolLogoImg" src="<?php echo $websiteUrl?>/images/report/icon.png" alt="<?php echo $clientName?> Logo"/>   
                    </div>

                    <script>
                        $(document).ready(function () {
                            const schoolLogo = printAssessmentSession?.branchData?.schoolLogo;
                            const logoUrl = schoolLogo ? `${schoolLogoPixPath}/${schoolLogo}` : "<?php echo $websiteUrl ?>/images/report/icon.png";

                            $("#profileSchoolLogoImg").attr("src", logoUrl).attr("alt", printAssessmentSession?.branchData?.branchName + " Logo");
                        });
                    </script>
                    
                    <div class="text-div">
                        <h3 id="branchName"><script>$("#branchName").html(printAssessmentSession?.branchData?.branchName);</script></h3>
                        <div class="text">Address: <strong id="address"><script>$("#address").html(printAssessmentSession?.branchData?.address);</script></strong></div>
                        <div class="text">Phone: <strong id="mobileNumber"><script>$("#mobileNumber").html(printAssessmentSession?.branchData?.mobileNumber);</script></strong> | Official Email: <strong id="smtpUsername"><script>$("#smtpUsername").html(printAssessmentSession?.branchData?.supportEmail);</script></strong></div> 
                    </div>
                </div>
            </div>
            <div class="title-div"><span id="titleDetails">Loading... </span>-- <span id="assessmentName"><script>$("#assessmentName").html(printAssessmentSession?.assessmentData?.assessmentName);</script></span> MARK BOOK</div>
            <script>
                $("#titleDetails").html(printAssessmentSession?.session + ' - ' +
                printAssessmentSession?.termData?.termName + ' - ' +
                printAssessmentSession?.departmentData?.departmentName + ' - ' + 
                printAssessmentSession?.classData?.className + ' - ' + 
                printAssessmentSession?.armData?.armName + ' - ' +
                printAssessmentSession?.subjectData?.subjectName);
            </script>
        </div>
    
        <div class="inner-content">
            <div class="table-div computation-table animated fadeIn">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                        $(document).ready(function() {
                            const printAssessmentSession = JSON.parse(sessionStorage.getItem("printAssessmentSession"));
                            let text = '';
                            let no=0;
                            text =`
                                <thead>
                                    <tr class="tb-col">
                                        <th class="font">sn</th>
                                        <th class="font">Full Name</th>
                                        <th class="font">x/${printAssessmentSession?.assessmentData?.assessmentTotalScore}</th>
                                        <th class="font">Percentage (%)</th>
                                        <th class="font">Position</th>
                                        <th class="font">Grade</th>
                                        <th class="font">Remark</th>
                                    </tr>
                                </thead>`;

                                if (printAssessmentSession && printAssessmentSession.success === true) {
                                    const students = printAssessmentSession.studentsData;

                                    for (let i = 0; i < students.length; i++) {
                                        no++;

                                        const fetchStudentData = students[i];
                                        const studentId = fetchStudentData.studentId;
                                        const surName = fetchStudentData.surName;
                                        const firstName = fetchStudentData.firstName;
                                        const otherNames = fetchStudentData.otherNames;
                                        const fullname = surName+ ' ' +firstName+ ' ' +otherNames;
                                        const markObtained = fetchStudentData.markObtained;
                                        const percentage = fetchStudentData.percentage;
                                        const position = fetchStudentData.position;
                                        const grade = fetchStudentData.grade;
                                        const remark = fetchStudentData.remark;

                                        text +=`
                                            <tbody>
                                                <tr class="tb-row report-tb-row">
                                                    <td class="td">${no}</td>
                                                    <td class="td">${fullname}</td>
                                                    <td class="td">${markObtained}</td>
                                                    <td class="td">${percentage}</td>
                                                    <td class="td">${position}</td>
                                                    <td class="td">${grade}</td>
                                                    <td class="td">${remark}</td>
                                                </tr>                                        
                                            </tbody>`;
                                    }
                                    $('#pageContent').html(text);
                                }
                        });
                    </script>
                </table>
            </div>
        </div>
    </section>
</body>
</html>