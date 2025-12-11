<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl?>/images/icon.png" rel="shortcut icon" type="image-png"/>
    <link href="<?php echo $websiteUrl?>/style/report-style.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
    <script src="<?php echo $websiteUrl?>/js/admin/chart.min.js"></script>
    <script src="<?php echo $websiteUrl?>/js/scripts.js?v=<?php echo $codeVersion?>"></script>
    <title>Each Student Terminal Result | <?php echo $clientName ?></title>
</head>

<body>
    <script> printEachStudentTerminalResultSession = JSON.parse(sessionStorage.getItem("printEachStudentTerminalResultSession"));</script>
    <script>
        $(document).ready(function () {
            const schoolCategoryId = printEachStudentTerminalResultSession?.branchData?.schoolCategoryId;
            // Hide by default
            $("#progressReportSection").hide();

            // Show only if schoolCategory is COLLEGE
            if (schoolCategoryId && schoolCategoryId.toUpperCase() === "COLLEGE") {
                $("#progressReportSection").show();
            }
        });
    </script>

    <section class="body-div" id="backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat;">
        <div class="header-back-div">
            <div class="header-image">
                <img id="terminalResultHeader" src="<?php echo $websiteUrl ?>/images/report/terminal-result-header.png" alt="Report Header" style="width: 100%; height: auto;"/>

                <script>
                    $(document).ready(function () {
                        const schoolHeader = printEachStudentTerminalResultSession?.branchData?.terminalResultHeader;
                        const headerUrl = schoolHeader ? `${terminalResultHeaderPixPath}/${schoolHeader}` : `<?php echo $websiteUrl ?>/images/report/terminal-result-header.png`;
                        $("#terminalResultHeader").attr("src", headerUrl).attr("alt", `${printEachStudentTerminalResultSession?.branchData?.branchName} Report Header`);

                        const backendWatermark = printEachStudentTerminalResultSession?.branchData?.watermark;
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
                            $("#address").html(printEachStudentTerminalResultSession?.branchData?.address);
                        </script>
                    </strong></div>
                <div class="text">Phone: <strong id="mobileNumber">
                        <script>
                            $("#mobileNumber").html(printEachStudentTerminalResultSession?.branchData?.mobileNumber);
                        </script>
                    </strong> | Email: <strong id="supportEmail">
                        <script>
                            $("#supportEmail").html(printEachStudentTerminalResultSession?.branchData?.supportEmail);
                        </script>
                    </strong></div>
                    <div class="text">Website: <strong id="clientWebsite">
                        <script>
                            $("#clientWebsite").html(printEachStudentTerminalResultSession?.clientWebsite);
                        </script>
                    </strong></div>
            </div>

            <div class="title-div">
                <h3 id="titlelist-content"></h3>
                <script>
                $("#titlelist-content").html(
                    printEachStudentTerminalResultSession?.termData?.termName + ' ' +
                    printEachStudentTerminalResultSession?.session + ' ACADEMIC SESSION'
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
                                    $("#fullName").html(printEachStudentTerminalResultSession?.studentData?.surName + ' ' +
                                        printEachStudentTerminalResultSession?.studentData?.firstName + ' ' +
                                        printEachStudentTerminalResultSession?.studentData?.otherNames);
                                    </script>
                                </div>
                            </div>
                        </div>

                         <div class="bottom-details">
                            <div class="details">
                                <p>STUDENT ID: <span id="studentId">
                                        <script>
                                        $("#studentId").html(printEachStudentTerminalResultSession?.studentData
                                            ?.officialStudentId ? printEachStudentTerminalResultSession?.studentData
                                            ?.officialStudentId : printEachStudentTerminalResultSession?.studentData
                                            ?.studentId);
                                        </script>
                                    </span></p>

                            </div>

                            <div class="details">
                                <p>CLASS: <span id="className">
                                        <script>
                                        $("#className").html(printEachStudentTerminalResultSession?.classData?.className + ' ' +
                                            printEachStudentTerminalResultSession?.armData?.armName);
                                        </script>
                                    </span></p>
                            </div>

                            <div class="details">
                                <p>GENDER: <span id="genderName">
                                        <script>
                                        $("#genderName").html(printEachStudentTerminalResultSession?.studentData?.genderName);
                                        </script>
                                    </span></p>
                            </div>
                        </div>
                    </div>

                    <div class="image-div" id="studentPix">
                        <script>
                        $("#studentPix").html('<img src="' + studentPixPath + '/' + printEachStudentTerminalResultSession
                            ?.studentData?.passport + '" alt="' + printEachStudentTerminalResultSession?.studentData
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
                        $(document).ready(function () {
                            let printEachStudentTerminalResultSession = JSON.parse(sessionStorage.getItem("printEachStudentTerminalResultSession"));
                            if (!printEachStudentTerminalResultSession) return; 

                            const tableTitles = printEachStudentTerminalResultSession?.tableTitles.split(',').map(x => x.trim());
                            const assessments = printEachStudentTerminalResultSession?.subjectAssessmentData;
                            const subjectList = printEachStudentTerminalResultSession?.studentSubjectAssessmentData;

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

                            // Build the table
                            const thead = $('<thead></thead>');
                            const headerRow = $('<tr class="tb-col table-col"></tr>');
                            tableTitles.forEach(title => {
                                headerRow.append($('<th></th>').text(title));
                            });
                            thead.append(headerRow);

                            const tbody = $('<tbody></tbody>');
                            const uniqueSubjects = [...new Set(subjectList.map(item => item.subjectName))];

                            uniqueSubjects.forEach((subjectName, index) => {
                                const row = $('<tr class="tb-row table-row"></tr>');
                                row.append($('<td></td>').text(index + 1));
                                row.append($('<td></td>').text(subjectName));

                                for (let i = 2; i < tableTitles.length; i++) {
                                    const title = tableTitles[i];
                                    const value = scoreMap[title]?.[subjectName] || '';
                                    row.append($('<td></td>').text(value));
                                }
                                tbody.append(row);
                            });
                            $('#pageContent').empty().append(thead).append(tbody);
                        });
                    </script>
                </table>
            </div>

            <div class="bottom-content-back-div" id="bottomContainer">
                <script>
                    $(document).ready(function () {
                        const termId = printEachStudentTerminalResultSession?.termData?.termId;
                        const items = printEachStudentTerminalResultSession?.resultSummary;
                        const branchItems = printEachStudentTerminalResultSession?.branchData;
                        const attendanceItems = printEachStudentTerminalResultSession?.attendanceData;
                        const classTeachersComment = printEachStudentTerminalResultSession?.classTeachersComment;

                        let text='';
                        if(termId==='3'){
                            text +=`
                                <div class="inner-container">
                                    <div class="content-container">
                                        <div class="list-content">
                                            <span>NUMBER OF SUBJECTS:</span>
                                            <p>${items.totalSubjects}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>STUDENTS IN CLASS:</span>
                                            <p>${items.noOfStudentsInArm}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>MARKS OBTAINABLE:</span>
                                            <p>${items.totalMarkObtainable}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>MARKS OBTAINED:</span>
                                            <p>${items.totalMarkObtained}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>PERCENTAGE:</span>
                                            <p>${items.totalPercentage + '%'}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>POSITION IN CLASS:</span>
                                            <p>${items.positionInClass}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>NUMBER OF SITTING(S):</span>
                                            <p>${items.noOfStudentsInClass}</p>
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
                                            <p>${attendanceItems.timeSchoolOpened}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>TIMES PRESENT:</span>
                                            <p>${attendanceItems.numberOfDaysPresents}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>TIMES ABSENT:</span>
                                            <p>${attendanceItems.numberOfDaysAbsents}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>SCHOOL REOPENS ON:</span>
                                            <p>${formatDate(branchItems.schoolResumptionDate)}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>CLASS TEACHER'S COMMENT:</span>
                                            <p>${classTeachersComment}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>PRINCIPAL'S COMMENT:</span>
                                            <p>${items.principalComment}</p>
                                        </div>
                                    </div>

                                    <div class="signature">
                                        <img src="${principalSignaturePixPath}/${branchItems.principalSignature}" alt="${branchItems.branchName} PRINCIPAL SIGNATURE"/>
                                    </div>
                                </div>
                            `;
                        }else{
                            text +=`
                                <div class="inner-container">
                                    <div class="content-container">
                                        <div class="list-content">
                                            <span>NUMBER OF SUBJECTS:</span>
                                            <p>${items.totalSubjects}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>MARKS OBTAINABLE:</span>
                                            <p>${items.totalMarkObtainable}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>MARKS OBTAINED:</span>
                                            <p>${items.totalMarkObtained}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>PERCENTAGE:</span>
                                            <p>${items.totalPercentage + '%'}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>STUDENT IN CLASS:</span>
                                            <p>${items.noOfStudentsInArm}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>POSITION:</span>
                                            <p>${items.positionInClass}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>TIMES SCHOOL OPENED:</span>
                                            <p>${attendanceItems.timeSchoolOpened}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>TIMES PRESENT:</span>
                                            <p>${attendanceItems.numberOfDaysPresents}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>TIMES ABSENT:</span>
                                            <p>${attendanceItems.numberOfDaysAbsents}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>CLASS TEACHER'S COMMENT:</span>
                                            <p>${classTeachersComment}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>PRINCIPAL'S COMMENT:</span>
                                            <p>${items.principalComment}</p>
                                        </div>

                                        <div class="list-content">
                                            <span>SCHOOL REOPENS ON:</span>
                                            <p>${formatDate(branchItems.schoolResumptionDate)}</p>
                                        </div>
                                    </div>

                                    <div class="signature">
                                        <img src="${principalSignaturePixPath}/${branchItems.principalSignature}" alt="${branchItems.branchName} PRINCIPAL SIGNATURE"/>
                                    </div>
                                </div>
                            `;
                        }
                        $("#bottomContainer").html(text);
                    });
                </script>
            </div>
        </div>
    </section>

    <section class="body-div" id="progressReportSection">
        <div class="header-back-div">
            <div class="header-image">
                <img id="progressReportHeader" src="<?php echo $websiteUrl ?>/images/report/progress-report-header.png" alt="Report Header" style="width: 100%; height: auto;"/>

                <script>
                    $(document).ready(function () {
                        const schoolHeader = printEachStudentTerminalResultSession?.branchData?.progressReportHeader;
                        const headerUrl = schoolHeader ? `${progressReportHeaderPixPath}/${schoolHeader}` : `<?php echo $websiteUrl ?>/images/report/progress-report-header.png`;
                        $("#progressReportHeader").attr("src", headerUrl).attr("alt", `${printEachStudentTerminalResultSession?.branchData?.branchName} Report Header`);
                    });
                </script>
            </div>
            
            <div class="title-div">
                <h3 id="reportTitlelist-content"></h3>
                <script>
                $("#reportTitlelist-content").html(
                    printEachStudentTerminalResultSession?.termData?.termName + ' ' +
                    printEachStudentTerminalResultSession?.session + ' ACADEMIC SESSION'
                );
                </script>
            </div>
            
            <div class="top-containner-back-div">
                <div class="inner-div-cont">
                    <div class="content-div">
                        <div>
                            <div class="name">
                                <div id="reportFullName">
                                    <script>
                                    $("#reportFullName").html(printEachStudentTerminalResultSession?.studentData?.surName + ' ' +
                                        printEachStudentTerminalResultSession?.studentData?.firstName + ' ' +
                                        printEachStudentTerminalResultSession?.studentData?.otherNames);
                                    </script>
                                </div>
                            </div>
                        </div>

                         <div class="bottom-details">
                            <div class="details">
                                <p>STUDENT ID: <span id="reportStudentId">
                                    <script>
                                    $("#reportStudentId").html(printEachStudentTerminalResultSession?.studentData
                                        ?.officialStudentId ? printEachStudentTerminalResultSession?.studentData
                                        ?.officialStudentId : printEachStudentTerminalResultSession?.studentData
                                        ?.studentId);
                                    </script>
                                </span></p>
                            </div>

                            <div class="details">
                                <p>CLASS: <span id="reportClassName">
                                    <script>
                                    $("#reportClassName").html(printEachStudentTerminalResultSession?.classData?.className + ' ' +
                                        printEachStudentTerminalResultSession?.armData?.armName);
                                    </script>
                                    </span></p>
                            </div>

                            <div class="details">
                                <p>GENDER: <span id="reportGenderName">
                                    <script>
                                    $("#reportGenderName").html(printEachStudentTerminalResultSession?.studentData?.genderName);
                                    </script>
                                    </span></p>
                            </div>
                        </div>
                    </div>

                    <div class="image-div" id="reportStudentPix">
                        <script>
                        $("#reportStudentPix").html('<img src="' + studentPixPath + '/' + printEachStudentTerminalResultSession
                            ?.studentData?.passport + '" alt="' + printEachStudentTerminalResultSession?.studentData
                            ?.surName + '">');
                        </script>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="inner-content">
            <div class="table-div" id="backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat;">
                <table class="table" cellspacing="0" style="width:100%" id="reportPageContent">
                    <script>
                        $(document).ready(function () {

                            // FETCH DATA FROM SESSION
                            const data = JSON.parse(sessionStorage.getItem("printEachStudentTerminalResultSession"));
                            if (!data) return;

                            const backendWatermark = printEachStudentTerminalResultSession?.branchData?.watermark;
                            const defaultWatermark = '../images/report/watermark.jpg';
                            const watermarkUrl = backendWatermark ? `${watermarkPixPath}/${backendWatermark}` : defaultWatermark;

                            $('#backgroundTable').css({
                                'background': `url(${watermarkUrl}) center no-repeat`,
                                'background-size': 'cover'
                            });

                            let tableTitles = data.progressiveReportTableTitles;
                            const progressiveReportData = data.progressiveReportData || [];

                            // Convert titles if sent as a string
                            if (typeof tableTitles === "string") {
                                tableTitles = tableTitles.split(",").map(t => t.trim());
                            }

                            // Number of term columns per class
                            const groupsPerClass = 3; // firstTerm, secondTerm, thirdTerm

                            // 1. BUILD THEAD → GROUP HEADER ROW
                            const thead = $('<thead></thead>');
                            const groupTR = $('<tr class="tb-col table-col"></tr>');

                            // SN + SUBJECT
                            groupTR.append("<th></th>");
                            groupTR.append("<th></th>");

                            // Add class group headers dynamically
                            progressiveReportData.forEach(cls => {
                                groupTR.append(`
                                    <th colspan="${groupsPerClass}">
                                        ${cls.className} (${cls.session || "NULL"})
                                    </th>
                                `);
                            });

                            thead.append(groupTR);

                            // 2. TITLES ROW (the second TR)
                            const titleTR = $('<tr class="tb-col table-col"></tr>');
                            tableTitles.forEach(t => titleTR.append(`<th>${t}</th>`));
                            thead.append(titleTR);

                            // 3. COLLECT ALL UNIQUE SUBJECT NAMES ACROSS ALL CLASSES
                            const allSubjects = new Set();

                            progressiveReportData.forEach(cls => {
                                cls.subjectsScores.forEach(sub => {
                                    allSubjects.add(sub.subjectName);
                                });
                            });

                            const subjectList = Array.from(allSubjects);

                            // 4. BUILD TBODY → SUBJECT ROWS
                            const tbody = $('<tbody></tbody>');
                            
                            function formatScore(score) {
                                return score ? `${score} %` : "";
                            }

                            subjectList.forEach((subjectName, idx) => {
                                const tr = $('<tr class="tb-row table-row"></tr>');
                                tr.append(`<td>${idx + 1}</td>`);
                                tr.append(`<td>${subjectName}</td>`);

                                progressiveReportData.forEach(cls => {
                                    const subObj = cls.subjectsScores.find(s => s.subjectName === subjectName);

                                    if (subObj) {
                                        tr.append(`<td>${formatScore(subObj.firstTermScores)}</td>`);
                                        tr.append(`<td>${formatScore(subObj.secondTermScores)}</td>`);
                                        tr.append(`<td>${formatScore(subObj.thirdTermScores)}</td>`);
                                    } else {
                                        tr.append(`<td></td><td></td><td></td>`);
                                    }
                                });
                                tbody.append(tr);
                            });

                            // 5. ADD TOTAL PERCENTAGE ROW (ALWAYS LAST)
                            const totalTR = $('<tr class="tb-row table-row"></tr>');

                            totalTR.append(`<td>-</td>`);
                            totalTR.append(`<td>TOTAL PERCENTAGE</td>`);

                            progressiveReportData.forEach(cls => {
                                totalTR.append(`<td class="bold-font">${(cls.totalPercentage.firstTermTotalPercentage ?? 0)} %</td>`);
                                totalTR.append(`<td class="bold-font">${(cls.totalPercentage.secondTermTotalPercentage ?? 0)} %</td>`);
                                totalTR.append(`<td class="bold-font">${(cls.totalPercentage.thirdTermTotalPercentage ?? 0)} %</td>`);
                            });
                            tbody.append(totalTR);
                            $("#reportPageContent").empty().append(thead).append(tbody);
                        });
                    </script>
                </table>
            </div>
        
            <div class="bottom-content-back-div">
                <div class="inner-container">
                    <canvas id="progressChart" width="700"  height="250">
                        <script>
                            $(document).ready(function () {

                                const data = JSON.parse(sessionStorage.getItem("printEachStudentTerminalResultSession"));
                                const progressiveReportData = data.progressiveReportData || [];

                                // 1. BUILD LABELS DYNAMICALLY
                                let labels = [];
                                progressiveReportData.forEach(cls => {
                                    labels.push([cls.className, "1ST TERM"]);
                                    labels.push([cls.className, "2ND TERM"]);
                                    labels.push([cls.className, "3RD TERM"]);
                                });

                                // 2. BUILD DATA VALUES
                                let chartData = [];
                                progressiveReportData.forEach(cls => {
                                    const t = cls.totalPercentage;
                                    chartData.push(t.firstTermTotalPercentage ? parseFloat(t.firstTermTotalPercentage) : null);
                                    chartData.push(t.secondTermTotalPercentage ? parseFloat(t.secondTermTotalPercentage) : null);
                                    chartData.push(t.thirdTermTotalPercentage ? parseFloat(t.thirdTermTotalPercentage) : null);

                                });

                                // 3. COLORS (REPEAT AUTOMATICALLY)
                                const bg = [
                                    'rgba(78, 115, 223, 0.7)',
                                    'rgba(231, 74, 59, 0.7)',
                                    'rgba(28, 200, 138, 0.7)',
                                    'rgba(54, 185, 204, 0.7)',
                                    'rgba(111, 66, 193, 0.7)'
                                ];
                                const br = [
                                    'rgb(78, 115, 223)',
                                    'rgb(231, 74, 59)',
                                    'rgb(28, 200, 138)',
                                    'rgb(54, 185, 204)',
                                    'rgb(111, 66, 193)'
                                ];

                                let backgroundColors = [];
                                let borderColors = [];

                                for (let i = 0; i < chartData.length; i++) {
                                    const index = i % bg.length;
                                    backgroundColors.push(bg[index]);
                                    borderColors.push(br[index]);
                                }

                                // 4. RENDER CHART
                                const ctx = document.getElementById('progressChart').getContext('2d');

                                new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: printEachStudentTerminalResultSession?.studentData?.surName + ' ' + printEachStudentTerminalResultSession?.studentData?.firstName + ' PROGRESS REPORT PERFORMANCE',
                                            data: chartData,
                                            backgroundColor: backgroundColors,
                                            borderColor: borderColors,
                                            borderWidth: 1,
                                            barThickness: 85,
                                            barPercentage: 0.9,
                                            categoryPercentage: 0.8 
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: { legend: { display: false } },
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                min: 0,
                                                max: 100,
                                                ticks: {
                                                    stepSize: 20,
                                                    callback: value => value + '%'
                                                },
                                                grid: {
                                                    display: true
                                                }
                                            },
                                            x: {
                                                grid: {
                                                    display: false
                                                },
                                                ticks: {
                                                    font: { size: 11 }
                                                },
                                            }
                                        },
                                        animation: {
                                            onComplete: function () {
                                                const chart = this;
                                                const ctx = chart.ctx;

                                                ctx.save();
                                                ctx.font = 'bold 12px Arial';
                                                ctx.textAlign = 'center';
                                                ctx.textBaseline = 'middle';

                                                chart.data.datasets.forEach((dataset, i) => {
                                                    const meta = chart.getDatasetMeta(i);
                                                    meta.data.forEach((bar, index) => {
                                                        ctx.fillStyle = '#fff';
                                                        const value = dataset.data[index];
                                                        if (value !== null && !isNaN(value)) {
                                                            ctx.fillText(value + '%', bar.x, bar.y + (bar.base - bar.y) / 2);
                                                        }
                                                    });
                                                });
                                                ctx.restore();
                                            }
                                        }
                                    }
                                });
                            });
                        </script>
                    </canvas>
                </div>
            </div>
        </div>
    </section>
</body>
</html>