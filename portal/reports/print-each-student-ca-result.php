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
    <script src="<?php echo $websiteUrl ?>/js/scripts.js?v=<?php echo $codeVersion ?>"></script>
    <title>PRINT CA RESULT | <?php echo $clientName ?></title>
</head>

<body>
    <script>
        printSingleAssessementSession = JSON.parse(sessionStorage.getItem("printSingleAssessementSession"));
    </script>

    <section class="body-div" id="backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat;">
        <div class="header-back-div">
            <div class="header-image">
                <img id="midTermResultHeader" src="<?php echo $websiteUrl ?>/images/report/mid-term-result-header.png" alt="Report Header" style="width: 100%; height: auto;"/>

                <script>
                    $(document).ready(function () {
                        const schoolHeader = printSingleAssessementSession?.branchData?.midTermResultHeader;
                        const headerUrl = schoolHeader ? `${midTermResultHeaderPixPath}/${schoolHeader}` : `<?php echo $websiteUrl ?>/images/report/mid-term-result-header.png`;
                        $("#midTermResultHeader").attr("src", headerUrl).attr("alt", `${printSingleAssessementSession?.branchData?.branchName} Report Header`);

                        const backendWatermark = printSingleAssessementSession?.branchData?.watermark;
                        const defaultWatermark = '../images/report/watermark.jpg';
                        const watermarkUrl = backendWatermark ? `${watermarkPixPath}/${backendWatermark}` : defaultWatermark;

                        $('#backgroundTable').css({
                            'background': `url(${watermarkUrl}) center no-repeat`,
                            'background-size': 'cover'
                        });
                    });
                </script>
            </div>

            <div class="school-info-div">
                <div class="text">School Address: <strong id="address">
                        <script>
                            $("#address").html(printSingleAssessementSession?.branchData?.address);
                        </script>
                    </strong></div>
                <div class="text">Phone: <strong id="mobileNumber">
                        <script>
                            $("#mobileNumber").html(printSingleAssessementSession?.branchData?.mobileNumber);
                        </script>
                    </strong> | Email: <strong id="supportEmail">
                        <script>
                            $("#supportEmail").html(printSingleAssessementSession?.branchData?.supportEmail);
                        </script>
                    </strong></div>
                    <div class="text">Website: <strong id="clientWebsite">
                        <script>
                            $("#clientWebsite").html(printSingleAssessementSession?.clientWebsite);
                        </script>
                    </strong></div>
            </div>

            <div class="title-div">
                <h3 id="titleDetails"></h3>
                <script>
                    $("#titleDetails").html(
                        printSingleAssessementSession?.termData?.termName + ' ' +
                        printSingleAssessementSession?.session + ' ACADEMIC SESSION'
                    );
                </script>
            </div>

            <div class="top-containner-back-div">
                <div class="inner-div-cont">
                    <div class="content-div">
                        <div>
                            <div class="name">
                                <div id="fullName">
                                    <script>
                                        $("#fullName").html(printSingleAssessementSession?.studentData?.surName + ' ' +
                                            printSingleAssessementSession?.studentData?.firstName + ' ' +
                                            printSingleAssessementSession?.studentData?.otherNames);
                                    </script>
                                </div>
                            </div>
                        </div>

                        <div class="bottom-details">
                            <div class="details">
                                <p>STUDENT ID: <span id="studentId">
                                        <script>
                                            $("#studentId").html(printSingleAssessementSession?.studentData
                                                ?.officialStudentId ? printSingleAssessementSession?.studentData
                                                ?.officialStudentId : printSingleAssessementSession?.studentData
                                                ?.studentId);
                                        </script>
                                    </span></p>

                            </div>

                            <div class="details">
                                <p>CLASS: <span id="className">
                                        <script>
                                            $("#className").html(printSingleAssessementSession?.classData?.className + ' ' +
                                                printSingleAssessementSession?.armData?.armName);
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
                            $("#studentPix").html('<img src="' + studentPixPath + '/' + printSingleAssessementSession
                                ?.studentData?.passport + '" alt="' + printSingleAssessementSession?.studentData
                                ?.surName + '">');
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <div class="inner-content">
            <div class="table-div">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                        $(document).ready(function() {
                            const printSingleAssessementSession = JSON.parse(sessionStorage.getItem("printSingleAssessementSession"));

                            let text = `
                            <thead>
                                <tr class="tb-col table-col">
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
                                    <tr class="tb-row table-row">
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
                                $('#numberOfStudents').html(printSingleAssessementSession?.data?.numberOfStudents ||
                                    '-');
                                $('#numOfSubjects').html(summary.totalSubjects || '-');
                                $('#totalMarkObtainable').html(summary.totalMarkObtainable || '-');
                                $('#totalMarkObtained').html(summary.totalMarkObtained || '-');
                                $('#totalPercentage').html(summary.totalPercentage ? summary.totalPercentage + '%' :
                                    '-');

                                $('#classTeacherComment').html(printSingleAssessementSession?.classTeachersComment
                                    ?.classTeachersComment || '-');
                                $('#formatDate').html(formatDate(printSingleAssessementSession?.branchData
                                    ?.schoolResumptionDate));

                                let commentContent = "";

                                if (printSingleAssessementSession?.branchData?.schoolCategoryId === "BASIC") {
                                commentContent = `
                                    <span>HEAD TEACHER'S COMMENT:</span>
                                    <p>${summary.principalComment || '-'}</p>
                                `;
                                } else {
                                commentContent = `
                                    <span>PRINCIPAL'S COMMENT:</span>
                                    <p>${summary.principalComment || '-'}</p>
                                `;
                                }
                                $('#commentContainer').html(commentContent);
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

                        <div class="list-content" id="commentContainer"></div>

                        <div class="list-content">
                            <span>SCHOOL REOPENS ON:</span>
                            <p id="formatDate"></p>
                        </div>
                    </div>

                    <div class="signature" id="principalSignature">
                        <script>
                            $("#principalSignature").html('<img src="' + principalSignaturePixPath + '/' +
                                printSingleAssessementSession?.branchData?.principalSignature + '" alt="' +
                                printSingleAssessementSession?.branchData?.branchName + ' PRINCIPAL SIGNATURE">');
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>