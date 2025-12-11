<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl ?>/images/icon.png" rel="shortcut icon" type="image-png" />
    <link href="<?php echo $websiteUrl ?>/style/report-style.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl ?>/style/paramount.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl ?>/js/jquery-v3.6.1.min.js"></script>
    <script src="<?php echo $websiteUrl ?>/js/admin/chart.min.js"></script>
    <script src="<?php echo $websiteUrl?>/js/scripts.js?v=<?php echo $codeVersion?>"></script>
    <title>All Student Terminal Result | <?php echo $clientName ?></title>
</head>

<body>
    <script>
        printAllStudentTerminalResultSession = JSON.parse(sessionStorage.getItem("printAllStudentTerminalResultSession"));
    </script>

    <div id="pageContainer">
        <script>
            $(document).ready(function() {
                if (printAllStudentTerminalResultSession && printAllStudentTerminalResultSession.success === true) {
                    const sessionData = printAllStudentTerminalResultSession;
                    const branch = sessionData.branchData;
                    const term = sessionData.termData;
                    const department = sessionData.departmentData;
                    const classData = sessionData.classData;
                    const arm = sessionData.armData;
                    const sessionName = sessionData.session;
                    const fetchedStudent = sessionData.eachStudentResultData;

                    let sectionHtml = '';

                    for (let i = 0; i < fetchedStudent.length; i++) {
                        const studentResultData = fetchedStudent[i];
                        const items = studentResultData.studentData;
                        const fullName =
                            `${items.surName} ${items.firstName} ${items.otherNames}`;
                        const studentId = items.studentId;
                        const officialStudentId = items.officialStudentId;
                        const genderName = items.genderName;

                        const schoolHeader = branch.terminalResultHeader;
                        const headerUrl = schoolHeader ? `${terminalResultHeaderPixPath}/${schoolHeader}` :
                        `${websiteUrl}/images/report/terminal-result-header.png`;

                        const tableTitles = printAllStudentTerminalResultSession?.tableTitles.split(',').map(x => x.trim());
                        const assessments = printAllStudentTerminalResultSession?.subjectAssessmentData;
                        const subjectList = studentResultData?.studentSubjectAssessmentData;

                        const scoreMap = {};
                        const summaryFields = [];

                        // Create a map of assessmentId -> readable name (e.g., "1ST CA (15.00)")
                        const assessmentTitleMap = {};
                        assessments.forEach(assessment => {
                            const title = `${assessment.assessmentName} (${assessment.assessmentTotalScore})`;
                            assessmentTitleMap[assessment.assessmentId] = title;
                        });

                        // Build scoreMap dynamically from all subject entries
                        subjectList.forEach(subject => {
                            const subjectName = subject.subjectName;

                            // First add all assessment scores
                            Object.keys(assessmentTitleMap).forEach(assessmentId => {
                                const title = assessmentTitleMap[assessmentId];
                                if (!scoreMap[title]) {
                                    scoreMap[title] = {};
                                }
                                const mark = subject[assessmentId]?.markObtained || '';
                                scoreMap[title][subjectName] = mark;
                            });

                            // Then handle summary fields dynamically
                            Object.keys(subject).forEach(key => {
                                if (!scoreMap[key]) {
                                    scoreMap[key] = {};
                                    summaryFields.push(key);
                                }
                                scoreMap[key][subjectName] = subject[key];
                            });
                        });

                        // Fuzzy matching helper
                        function normalizeWords(str) {
                            return str
                                .replace(/[\W_]+/g, ' ')
                                .replace(/([a-z])([A-Z])/g, '$1 $2')
                                .toLowerCase()
                                .split(' ')
                                .filter(Boolean);
                        }

                        // Map tableTitles to correct scoreMap keys
                        tableTitles.forEach(title => {
                            if (scoreMap[title]) return; // already present

                            const titleWords = normalizeWords(title);
                            let bestMatch = null;
                            let bestScore = 0;

                            summaryFields.forEach(field => {
                                const fieldWords = normalizeWords(field);
                                const matchCount = titleWords.filter(word => fieldWords.includes(word)).length;
                                if (matchCount > bestScore) {
                                    bestMatch = field;
                                    bestScore = matchCount;
                                }
                            });

                            if (bestMatch && !scoreMap[title]) {
                                scoreMap[title] = scoreMap[bestMatch];
                            } else if (!scoreMap[title]) {
                                // Check lowercase direct match (e.g., "remarks" vs "remark")
                                const lowerTitle = title.toLowerCase().replace(/s$/, ''); // remove trailing 's'
                                const fieldMatch = summaryFields.find(field => field.toLowerCase() === lowerTitle);
                                if (fieldMatch) {
                                    scoreMap[title] = scoreMap[fieldMatch];
                                }
                            }
                        });

                        // Build table head
                        let subjectTable = `<thead><tr class="tb-col table-col">`;
                        tableTitles.forEach(title => {
                            subjectTable += `<th>${title}</th>`;
                        });
                        subjectTable += `</tr></thead><tbody>`;

                        // Extract unique subjects
                        const uniqueSubjects = [...new Set(subjectList.map(s => s.subjectName))];
                        // Build table rows
                        uniqueSubjects.forEach((subjectName, index) => {
                            subjectTable += `<tr class="tb-row table-row">`;
                            // SN
                            subjectTable += `<td>${index + 1}</td>`;
                            // SUBJECTS
                            subjectTable += `<td>${subjectName}</td>`;

                            // Remaining dynamic titles (starting from index 2)
                            for (let i = 2; i < tableTitles.length; i++) {
                                const title = tableTitles[i];
                                const value = scoreMap[title]?.[subjectName] || '';
                                subjectTable += `<td>${value}</td>`;
                            }
                            subjectTable += `</tr>`;
                        });
                        subjectTable += `</tbody>`;

                        sectionHtml += `
                            <section class="body-div backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat; page-break-after: always;">
                                <div class="header-back-div">
                                    <div class="header-image">
                                        <img src="${headerUrl}" alt="${branch.branchName} Report Header" style="width: 100%; height: auto;" />
                                    </div>

                                    <div class="school-info-div">
                                        <div class="text">School Address: <strong>${branch.address}</strong></div>
                                        <div class="text">Phone: <strong>${branch.mobileNumber}</strong> | Email: <strong>${branch.supportEmail}</strong></div>
                                        <div class="text">Website: <strong>${sessionData.clientWebsite}</strong></div>
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
                                                <img src="${studentPixPath}/${items.passport}" alt="${fullName}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="inner-content">
                                    <div class="table-div">
                                        <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                                            ${subjectTable}
                                        </table>
                                    </div>

                                    <div class="bottom-content-back-div" id="bottomContainer">`;
                                        let content='';
                                        if (term.termId==='3') {
                                            content += `
                                                <div class="inner-container">
                                                <div class="content-container">
                                                    <div class="list-content">
                                                        <span>NUMBER OF SUBJECTS:</span>
                                                        <p>${studentResultData.totalSubjects}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>STUDENTS IN CLASS:</span>
                                                        <p>${studentResultData.noOfStudentsInArm}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>MARKS OBTAINABLE:</span>
                                                        <p>${studentResultData.totalMarkObtainable}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>MARKS OBTAINED:</span>
                                                        <p>${studentResultData.totalMarkObtained}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>PERCENTAGE:</span>
                                                        <p>${studentResultData.totalPercentage + '%'}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>POSITION IN CLASS:</span>
                                                        <p>${studentResultData.positionInClass}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>NUMBER OF SITTING(S):</span>
                                                        <p>${studentResultData.noOfStudentsInClass}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>1ST TERM OVERALL (%):</span>
                                                        <p id="">45.82 %</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>2ND TERM OVERALL (%):</span>
                                                        <p id="">48.78</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>3RD TERM OVERALL (%):</span>
                                                        <p id="">47.42 %</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>AVERAGE (%):</span>
                                                        <p id="">48.78</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>ANNUAL POSITION IN CLASS:</span>
                                                        <p id="">33RD</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>ANNUAL OVERALL POSITION:</span>
                                                        <p id="">143RD(166)</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>TIMES SCHOOL OPENED:</span>
                                                        <p>${studentResultData?.attendanceData?.timeSchoolOpened}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>TIMES PRESENT:</span>
                                                        <p>${studentResultData?.attendanceData?.numberOfDaysPresents}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>TIMES ABSENT:</span>
                                                        <p>${studentResultData?.attendanceData?.numberOfDaysAbsents}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>SCHOOL REOPENS ON:</span>
                                                        <p>${formatDate(branch.schoolResumptionDate)}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>CLASS TEACHER'S COMMENT:</span>
                                                        <p>${studentResultData?.classTeachersComment}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>PRINCIPAL'S COMMENT:</span>
                                                        <p>${studentResultData?.principalComment}</p>
                                                    </div>
                                                </div>

                                                <div class="signature">
                                                    <img src="${principalSignaturePixPath}/${branch.principalSignature}" alt="${branch.branchName} PRINCIPAL SIGNATURE"/>
                                                </div>
                                            </div>`;
                                        } else{
                                            content += `
                                                <div class="inner-container">
                                                <div class="content-container">
                                                    <div class="list-content">
                                                        <span>NUMBER OF SUBJECTS:</span>
                                                        <p>${studentResultData.totalSubjects}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>MARKS OBTAINABLE:</span>
                                                        <p>${studentResultData.totalMarkObtainable}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>MARKS OBTAINED:</span>
                                                        <p>${studentResultData.totalMarkObtained}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>PERCENTAGE:</span>
                                                        <p>${studentResultData.totalPercentage + '%'}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>STUDENT IN CLASS:</span>
                                                        <p>${studentResultData.noOfStudentsInArm}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>POSITION:</span>
                                                        <p>${studentResultData.positionInClass}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>TIMES SCHOOL OPENED:</span>
                                                        <p>${studentResultData?.attendanceData?.timeSchoolOpened}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>TIMES PRESENT:</span>
                                                        <p>${studentResultData?.attendanceData?.numberOfDaysPresents}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>TIMES ABSENT:</span>
                                                        <p>${studentResultData?.attendanceData?.numberOfDaysAbsents}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>CLASS TEACHER'S COMMENT:</span>
                                                        <p>${studentResultData?.classTeachersComment}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>PRINCIPAL'S COMMENT:</span>
                                                        <p>${studentResultData?.principalComment}</p>
                                                    </div>

                                                    <div class="list-content">
                                                        <span>SCHOOL REOPENS ON:</span>
                                                        <p>${formatDate(branch?.schoolResumptionDate)}</p>
                                                    </div>
                                                </div>

                                                <div class="signature">
                                                    <img src="${principalSignaturePixPath}/${branch.principalSignature}" alt="${branch.branchName} PRINCIPAL SIGNATURE"/>
                                                </div>
                                            </div>
                                            `;
                                        }
                                       sectionHtml += content + `
                                    </div>
                                </div>
                            </section>
                        `;
                    }
                    $('#pageContainer').html(sectionHtml);

                    // Set watermark
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