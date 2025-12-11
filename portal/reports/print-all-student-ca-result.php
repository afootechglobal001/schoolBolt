<?php include '../config/constants.php'; ?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl?>/images/icon.png" rel="shortcut icon" type="image-png" />
    <link href="<?php echo $websiteUrl?>/style/report-style.css?v=<?php echo $codeVersion?>" type="text/css"
        rel="stylesheet" />
    <link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css"
        rel="stylesheet" />
    <script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
    <script src="<?php echo $websiteUrl?>/js/scripts.js?v=<?php echo $codeVersion?>"></script>
    <title>ALL STUDENT CA RESULT | <?php echo $clientName ?></title>
</head>

<body>
    <script>
    printAllStudentCaResultSession = JSON.parse(sessionStorage.getItem("printAllStudentCaResultSession"));
    </script>

    <div id="pageContainer">
        <script>
        $(document).ready(function() {
            if (printAllStudentCaResultSession && printAllStudentCaResultSession.success === true) {
                const sessionData = printAllStudentCaResultSession;
                const branch = sessionData.branchData;
                const term = sessionData.termData;
                const department = sessionData.departmentData;
                const classData = sessionData.classData;
                const arm = sessionData.armData;
                const assessment = sessionData.assessmentData;
                const sessionName = sessionData.session;
                const fetchedStudent = sessionData.eachStudentData;

                let sectionHtml = '';

                for (let i = 0; i < fetchedStudent.length; i++) {
                    const studentItems = fetchedStudent[i];
                    const fullName =
                        `${studentItems.surName} ${studentItems.firstName} ${studentItems.otherNames}`;
                    const studentId = studentItems.studentId;
                    const officialStudentId = studentItems.officialStudentId;
                    const genderName = studentItems.genderName;
                    const studentSubjects = studentItems.data;

                    let no = 0;
                    let subjectTable = `
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

                    for (let j = 0; j < studentSubjects.length; j++) {
                        no++;
                        const subject = studentSubjects[j];
                        const fetchedStudentSubjects = subject.subjectAssessment;
                        const markObtainable = fetchedStudentSubjects.markObtainable;
                        const markObtained = fetchedStudentSubjects.markObtained;
                        const percentage = fetchedStudentSubjects.percentage;
                        const positionInClass = fetchedStudentSubjects.positionInClass;
                        const grade = fetchedStudentSubjects.grade;
                        const remark = fetchedStudentSubjects.remark;

                        subjectTable += `
                                <tr class="tb-row table-row">
                                    <td>${no}</td>
                                    <td>${subject.subjectName}</td>
                                    <td>${markObtainable ? markObtainable : '-'}</td>
                                    <td>${markObtained ? markObtained : '-'}</td>
                                    <td>${percentage ? percentage + '%' : '-'}</td>
                                    <td>${positionInClass ? positionInClass : '-'}</td>
                                    <td>${grade ? grade : '-'}</td>
                                    <td>${remark ? remark : '-'}</td>
                                </tr>
                            `;
                    }
                    subjectTable += `</tbody>`;

                    const schoolHeader = branch.midTermResultHeader;
                    const headerUrl = schoolHeader ? `${midTermResultHeaderPixPath}/${schoolHeader}` :
                        `${websiteUrl}/images/report/mid-term-result-header.png`;

                    sectionHtml += `
                            <section class="body-div backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat; page-break-after: always;">
                                <div class="header-back-div">
                                    <div class="header-image">
                                        <img src="${headerUrl}" alt="${branch.branchName} Report Header" style="width: 100%; height: auto;" />
                                    </div>

                                    <div class="school-info-div">
                                        <div class="text">School Address: <strong>${branch.address}</strong></div>
                                        <div class="text">Phone: <strong>${branch.mobileNumber}</strong> | Email: <strong>${branch.supportEmail}</strong></div>
                                        <div class="text">Website: <strong>${printAllStudentCaResultSession.clientWebsite}</strong></div>
                                    </div>

                                    <div class="title-div">
                                        <h3>${term.termName} ${sessionName} ACADEMIC SESSION</h3>
                                    </div>

                                    <div class="top-containner-back-div">
                                        <div class="inner-div-cont">
                                            <div class="content-div">
                                                <div>
                                                    <div class="name">
                                                        <div>${fullName}</div>
                                                    </div>
                                                </div>

                                                <div class="bottom-details">
                                                    <div class="details">
                                                        <p>STUDENT ID: 
                                                            <span>${officialStudentId ? officialStudentId : studentId}</span>
                                                        </p>
                                                    </div>
                                                    <div class="details">
                                                        <p>CLASS:
                                                            <span>${classData.className} ${arm.armName}</span>
                                                        </p>
                                                    </div>
                                                    <div class="details">
                                                        <p>GENDER
                                                            <span>${genderName}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="image-div">
                                                <img src="${studentPixPath}/${studentItems.passport}" alt="${fullName}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="inner-content">
                                    <div class="table-div">
                                        <table class="table" cellspacing="0" style="width:100%">
                                            ${subjectTable}
                                        </table>
                                    </div>

                                    <div class="bottom-content-back-div">
                                        <div class="inner-container">
                                            <div class="content-container">
                                                <div class="list-content">
                                                    <span>NUMBER ON ROLL:</span>
                                                    <p>${studentItems.numberOfStudents}</p>
                                                </div>

                                                <div class="list-content">
                                                    <span>NUMBER OF SUBJECT:</span>
                                                    <p>${studentItems.totalSubjects}</p>
                                                </div>

                                                <div class="list-content">
                                                    <span>MARKS OBTAINABLE:</span>
                                                    <p>${studentItems.totalMarkObtainable}</p>
                                                </div>

                                                <div class="list-content">
                                                    <span>MARKS OBTAINED:</span>
                                                    <p>${studentItems.totalMarkObtained}</p>
                                                </div>

                                                <div class="list-content">
                                                    <span>PERCENTAGE:</span>
                                                    <p>${studentItems.totalPercentage ? studentItems.totalPercentage + '%' : '-'}</p>
                                                </div>

                                                <div class="list-content">
                                                    <span>CLASS TEACHER'S COMMENT:</span>
                                                    <p>${studentItems.classTeachersComment}</p>
                                                </div>

                                                ${branch.schoolCategoryId === "BASIC"
                                                    ? `<div class="list-content">
                                                        <span>HEAD TEACHER'S COMMENT:</span>
                                                        <p>${studentItems.principalComment || '-'}</p>
                                                        </div>`
                                                    : `<div class="list-content">
                                                        <span>PRINCIPAL'S COMMENT:</span>
                                                        <p>${studentItems.principalComment || '-'}</p>
                                                        </div>`
                                                }
                                                
                                                <div class="list-content">
                                                    <span>SCHOOL REOPENS ON:</span>
                                                    <p>${formatDate(branch.schoolResumptionDate)}</p>
                                                </div>
                                            </div>

                                            <div class="signature">
                                                <img src="${principalSignaturePixPath}/${branch.principalSignature}" alt="${branch.branchName} PRINCIPAL SIGNATURE"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        `;
                }
                $('#pageContainer').html(sectionHtml);

                const backendWatermark = branch.watermark;
                const defaultWatermark = '../images/report/watermark.jpg';
                const watermarkUrl = backendWatermark ? `${watermarkPixPath}/${backendWatermark}` : defaultWatermark;

                $('.backgroundTable').css({
                    'background': `url(${watermarkUrl}) center no-repeat`,
                    'background-size': 'cover'
                });
            }
        });
        </script>
    </div>
</body>

</html>