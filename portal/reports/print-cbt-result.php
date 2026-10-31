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
    <title>Print CBT Result | <?php echo $clientName ?></title>
</head>

<body>
    <script>printStudentsCbtResultSession = JSON.parse(sessionStorage.getItem("printStudentsCbtResultSession"));</script>

    <section class="body-div broadsheet-body" id="backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat;">
        <div class="header-back-div">
            <div class="header-image">
                <img id="terminalBroadSheetHeader" src="<?php echo $websiteUrl ?>/images/report/terminal-broad-sheet-header.png" alt="Report Header" style="width: 100%; height: auto;"/>

                <script>
                    $(document).ready(function () {
                        const schoolHeader = printStudentsCbtResultSession?.branchData?.cbtResultHeader;
                        const headerUrl = schoolHeader ? `${cbtResultHeaderPixPath}/${schoolHeader}` : `<?php echo $websiteUrl ?>/images/report/cbt-result.png`;
                        $("#terminalBroadSheetHeader").attr("src", headerUrl).attr("alt", `${printStudentsCbtResultSession?.branchData?.branchName} Report Header`);

                        const backendWatermark = printStudentsCbtResultSession?.branchData?.watermark;
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
                $("#titleDetails").html(printStudentsCbtResultSession?.branchData?.session + ' - ' +
                    printStudentsCbtResultSession?.termData?.termName + ' - ' +
                    printStudentsCbtResultSession?.departmentData?.departmentName + ' - ' +
                    printStudentsCbtResultSession?.classData?.className + ' - ' +
                    printStudentsCbtResultSession?.armData?.armName);
                </script>
            </div>
        </div>
        
        <div class="inner-content">
            <div class="table-div">
                <table class="table" cellspacing="0" style="width:100%" id="cbtPageContent">
                    <script>
                        $(document).ready(function() {
                            const printStudentsCbtResultSession = JSON.parse(
                                sessionStorage.getItem("printStudentsCbtResultSession")
                            );

                            let text = '';
                            let no = 0;

                            text = `
                                <thead>
                                    <tr class="tb-col table-col">
                                        <th>SN</th>
                                        <th>STUDENT NAME</th>
                                        <th>CLASS</th>
                                        <th>TOTAL QUESTION</th>
                                        <th>TOTAL SCORE</th>
                                        <th>TIME ALLOWED</th>
                                        <th>QUESTION ATTEMPTED</th>
                                        <th>QUESTION NOT ATTEMPTED</th>
                                        <th>QUESTION PASSED</th>
                                        <th>QUESTION FAILED</th>
                                        <th>PERCENTAGE</th>
                                        <th>SCORE</th>
                                        <th>TIME TAKEN</th>
                                        <th>START TIME</th>
                                        <th>END TIME</th>
                                    </tr>
                                </thead>
                                <tbody>`;

                            if ( printStudentsCbtResultSession && printStudentsCbtResultSession?.success === true) {
                                const students = printStudentsCbtResultSession?.data || [];
                                const className = printStudentsCbtResultSession?.classData?.className || '';
                                const armName = printStudentsCbtResultSession?.armData?.armName || '';

                                for (let i = 0; i < students.length; i++) {
                                    no++;

                                    const student = students[i] || {};
                                    const fetchStudentData = student?.cbtResultData || {};
                                    const studentId = student?.studentId || fetchStudentData?.studentId || '';
                                    const surName = student?.surName || '';
                                    const firstName = student?.firstName || '';
                                    const fullname = `${surName} ${firstName}`.trim();
                                    const totalQuestions = fetchStudentData?.totalQuestions ?? '-';
                                    const totalScore =  fetchStudentData?.totalScore ?? '-';
                                    const timeAllowed = fetchStudentData?.timeAllowed ?? '-';
                                    const questionsAttempted =  fetchStudentData?.questionsAttempted ?? '-';
                                    const questionNotAttempted = fetchStudentData?.questionNotAttempted ?? '-';
                                    const questionsPassed = fetchStudentData?.questionsPassed ?? '-';
                                    const questionsFailed = fetchStudentData?.questionsFailed ?? '-';
                                    const quizPercentage =  fetchStudentData?.quizPercentage ?? '-';
                                    const quizScore = fetchStudentData?.quizScore ?? '-';
                                    const timeTaken =  fetchStudentData?.timeTaken ?? '-';
                                    const startTime = fetchStudentData?.startTime ?? '-';
                                    const endTime =  fetchStudentData?.endTime ?? '-';

                                    text += `
                                        <tr class="tb-row table-row">
                                            <td class="th-small">${no}</td>
                                            <td class="name-td th-name">
                                                <div class="text-back-div">
                                                    <div class="text-div">
                                                        <span>${fullname}</span>
                                                        <div>
                                                            <span>${studentId}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="th-medium">${className} - ${armName}</td>
                                            <td>${totalQuestions}</td>
                                            <td>${totalScore}</td>
                                            <td>${timeAllowed}</td>
                                            <td>${questionsAttempted}</td>
                                            <td>${questionNotAttempted}</td>
                                            <td>${questionsPassed}</td>
                                            <td>${questionsFailed}</td>
                                            <td>${quizPercentage}%</td>
                                            <td>${quizScore}</td>
                                            <td>${timeTaken}</td>
                                            <td>${startTime}</td>
                                            <td>${endTime}</td>
                                        </tr>`;
                                }
                                text += `</tbody>`;
                                $('#cbtPageContent').html(text);
                            }
                        });
                    </script>
                </table>
            </div>
        </div>
    </section>
</body>
</html>