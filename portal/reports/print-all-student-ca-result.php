<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl?>/images/icon.png" rel="shortcut icon" type="image-png"/>
    <link href="<?php echo $websiteUrl?>/style/report-style.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
    <title>ALL STUDENT CA RESULT | <?php echo $clientName ?></title>
</head>

<body>
    <script> printAllStudentCaResultSession = JSON.parse(sessionStorage.getItem("printAllStudentCaResultSession"));</script>

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
                        const student = studentItems.studentData;
                        const fullName = `${student.surName} ${student.firstName} ${student.otherNames}`;
                        const studentId = student.studentId;
                        const genderName = student.genderName;
                        const studentSubjects = studentItems.data;

                        let no=0;
                        let subjectTable = `
                            <thead>
                                <tr class="tb-col font">
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
                        `;

                        for (let j = 0; j < studentSubjects.length; j++) {
                            no++;
                            const subject = studentSubjects[j];
                            const fetchedStudentSubjects= subject.subjectAssessment;
                            const markObtainable= fetchedStudentSubjects.markObtainable;
                            const markObtained= fetchedStudentSubjects.markObtained;
                            const percentage= fetchedStudentSubjects.percentage;
                            const positionInClass= fetchedStudentSubjects.positionInClass;
                            const grade= fetchedStudentSubjects.grade;
                            const remark= fetchedStudentSubjects.remark;

                            subjectTable += `
                                <tbody>
                                    <tr class="tb-row report-tb-row">
                                        <td>${no}</td>
                                        <td>${subject.subjectName}</td>
                                        <td>${markObtainable ? markObtainable : '-'}</td>
                                        <td>${markObtained ? markObtained : '-'}</td>
                                        <td>${percentage ? percentage + '%' : '-'}</td>
                                        <td>${positionInClass ? positionInClass : '-'}</td>
                                        <td>${grade ? grade : '-'}</td>
                                        <td>${remark ? remark : '-'}</td>
                                    </tr>
                                </tbody>
                            `;
                        }

                        sectionHtml += `
                            <section class="body-div all-terminal-body" style="page-break-after: always;">
                                <div class="header-back-div">
                                    <div class="header-div">
                                        <div class="inner-div">
                                            <div class="logo-div">
                                                <img src="${websiteUrl}/images/report/icon.png" alt="Logo"/>
                                            </div>
                                            <div class="text-div">
                                                <h3>${branch.branchName}</h3>
                                                <div class="text">Address: <strong>${branch.address}</strong></div>
                                                <div class="text">Phone: <strong>${branch.mobileNumber}</strong> | Official Email: <strong>${branch.smtpUsername}</strong></div> 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="title-div">
                                        ${sessionName} ACADEMIC SESSION - ${term.termName} - ${department.departmentName} - ${classData.className} - ${arm.armName} - ${assessment.assessmentName} MID-TERM RESULT
                                    </div>

                                    <div class="top-containner-back-div">
                                        <div class="inner-div-cont">
                                            <div class="content-div">
                                                <div class="details">
                                                    <span>STUDENT NAME</span>
                                                    <div>${fullName}</div>
                                                </div>
                                                <div class="details">
                                                    <span>STUDENT ID</span>
                                                    <div>${studentId}</div>
                                                </div>
                                                <div class="details">
                                                    <span>CLASS</span>
                                                    <div>${classData.className} ${arm.armName}</div>
                                                </div>
                                                <div class="details">
                                                    <span>GENDER</span>
                                                    <div>${genderName}</div>
                                                </div>
                                            </div>
                                            
                                            <div class="image-div">
                                                <img src="${websiteUrl}/uploaded_files/studentPix/${student.passport}" alt="Student Photo"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="inner-content">
                                    <div class="table-div computation-table animated fadeIn">
                                        <table class="table" cellspacing="0" style="width:100%">
                                            ${subjectTable}
                                        </table>
                                    </div>

                                    <div class="top-containner-back-div">
                                        <div class="inner-div-cont">
                                            <div class="content-div">
                                                <div class="details">
                                                    <span>NUMBER ON ROLL</span>
                                                    <div>${studentItems.numberOfStudents}</div>
                                                </div>
                                                <div class="details">
                                                    <span>NUMBER OF SUBJECT</span>
                                                    <div>${studentItems.numOfSubjects}</div>
                                                </div>
                                                <div class="details">
                                                    <span>MARKS OBTAINABLE</span>
                                                    <div>${studentItems.totalMarkObtainable}</div>
                                                </div>
                                                <div class="details">
                                                    <span>MARKS OBTAINED</span>
                                                    <div>${studentItems.totalMarkObtained}</div>
                                                </div>
                                                <div class="details">
                                                    <span>PERCENTAGE</span>
                                                    <div>${studentItems.totalPercentage}</div>
                                                </div>
                                                <div class="details">
                                                    <span>CLASS TEACHER'S COMMENT</span>
                                                    <div>HE RELATES WELL.</div>
                                                </div>
                                                <div class="details">
                                                    <span>PRINCIPAL'S COMMENT</span>
                                                    <div>${studentItems.principalsComment}</div>
                                                </div>
                                                <div class="details">
                                                    <span>SCHOOL REOPENS ON</span>
                                                    <div>MONDAY 16TH June, 2025</div>
                                                </div>
                                            </div>

                                            <div class="image-div signature">
                                                <img src="${websiteUrl}/images/principal_signature.png" alt="Principal Signature"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        `;
                    }
                    $('#pageContainer').html(sectionHtml);
                }
            });
        </script>
    </div>
</body>
</html>