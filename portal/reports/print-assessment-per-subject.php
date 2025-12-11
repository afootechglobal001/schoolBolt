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

    <section class="body-div" id="backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat;">
        <div class="header-back-div">
            <div class="header-image">
                <img id="markBookHeader" src="<?php echo $websiteUrl ?>/images/report/mark-book-header.png" alt="Report Header" style="width: 100%; height: auto;"/>

                <script>
                    $(document).ready(function () {
                        const schoolHeader = printAssessmentSession?.branchData?.markBookHeader;
                        const headerUrl = schoolHeader ? `${markBookHeaderPixPath}/${schoolHeader}` : `<?php echo $websiteUrl ?>/images/report/mark-book-header.png`;
                        $("#markBookHeader").attr("src", headerUrl).attr("alt", `${printAssessmentSession?.branchData?.branchName} Report Header`);

                        const backendWatermark = printAssessmentSession?.branchData?.watermark;
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
                    $("#titleDetails").html(printAssessmentSession?.session + ' - ' +
                    printAssessmentSession?.termData?.termName + ' - ' +
                    printAssessmentSession?.departmentData?.departmentName + ' - ' + 
                    printAssessmentSession?.classData?.className + ' - ' + 
                    printAssessmentSession?.armData?.armName + ' - ' +
                    printAssessmentSession?.subjectData?.subjectName +' - '+printAssessmentSession?.assessmentData?.assessmentName);
                </script>
            </div>
        </div>
    
        <div class="inner-content">
            <div class="table-div">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                        $(document).ready(function() {
                            const printAssessmentSession = JSON.parse(sessionStorage.getItem("printAssessmentSession"));

                            let text = '';
                            let no=0;
                            text =`
                                <thead>
                                    <tr class="tb-col">
                                        <th>SN</th>
                                        <th>FULL NAME</th>
                                        <th>x/${printAssessmentSession?.assessmentData?.assessmentTotalScore}</th>
                                        <th>PERCENTAGE (%)</th>
                                        <th>POSITION</th>
                                        <th>GRADE</th>
                                        <th>REMARK</th>
                                    </tr>
                                </thead>
                                <tbody>`;

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
                                            <tr class="tb-row">
                                                <td>${no}</td>
                                                <td>${fullname}</td>
                                                <td>${markObtained}</td>
                                                <td>${percentage}</td>
                                                <td>${position}</td>
                                                <td>${grade}</td>
                                                <td>${remark}</td>
                                            </tr>`;
                                    }
                                    text += `</tbody>`;
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