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

    <section class="body-div all-terminal-body">
        <div class="header-back-div">
            <div class="header-div">
                <div class="inner-div">
                    <div class="logo-div">
                        <img id="profileSchoolLogoImg" src="<?php echo $websiteUrl?>/images/report/icon.png" alt="<?php echo $clientName?> Logo"/>   
                    </div>

                    <script>
                        $(document).ready(function () {
                            const schoolLogo = printEachStudentTerminalResultSession?.branchData?.schoolLogo;
                            const logoUrl = schoolLogo ? `${schoolLogoPixPath}/${schoolLogo}` : "<?php echo $websiteUrl ?>/images/report/icon.png";

                            $("#profileSchoolLogoImg").attr("src", logoUrl).attr("alt", printEachStudentTerminalResultSession?.branchData?.branchName + " Logo");
                        });
                    </script>
                    
                    <div class="text-div">
                        <h3 id="branchName">
                            <script>
                            $("#branchName").html(printEachStudentTerminalResultSession?.branchData?.branchName);
                            </script>
                        </h3>
                        <div class="text">Address: <strong id="address">
                                <script>
                                $("#address").html(printEachStudentTerminalResultSession?.branchData?.address);
                                </script>
                            </strong></div>
                        <div class="text">Phone: <strong id="mobileNumber">
                                <script>
                                $("#mobileNumber").html(printEachStudentTerminalResultSession?.branchData?.mobileNumber);
                                </script>
                            </strong> | Official Email: <strong id="smtpUsername">
                                <script>
                                $("#smtpUsername").html(printEachStudentTerminalResultSession?.branchData?.smtpUsername);
                                </script>
                            </strong></div>
                    </div>
                </div>
            </div>
            <div class="title-div"><span id="titleDetails">Loading...</span>TERMINAL RESULT
                <script>
                    $("#titleDetails").html(
                        printEachStudentTerminalResultSession?.session + ' ACADEMIC SESSION - ' +
                        printEachStudentTerminalResultSession?.termData?.termName + ' - ' +
                        printEachStudentTerminalResultSession?.departmentData?.departmentName + ' - ' +
                        printEachStudentTerminalResultSession?.classData?.className + ' - ' +
                        printEachStudentTerminalResultSession?.armData?.armName);
                </script>
            </div>
            <div class="top-containner-back-div">
                <div class="inner-div-cont">
                    <div class="content-div">
                        <div class="details">
                            <span>STUDENT NAME</span>
                            <div id="fullName"><script>$("#fullName").html(printEachStudentTerminalResultSession?.studentData?.surName + ' ' + printEachStudentTerminalResultSession?.studentData?.firstName+ ' ' + printEachStudentTerminalResultSession?.studentData?.otherNames);</script></div>
                        </div>

                        <div class="details">
                            <span>STUDENT ID</span>
                            <div id="studentId"><script>$("#studentId").html(printEachStudentTerminalResultSession?.studentData?.studentId);</script></div>
                        </div>

                        <div class="details"><span>CLASS</span>
                            <div id="className"><script>$("#className").html(printEachStudentTerminalResultSession?.classData?.className + ' ' + printEachStudentTerminalResultSession?.armData?.armName);</script></div>
                        </div>

                        <div class="details"><span>GENDER</span>
                            <div id="genderName"><script>$("#genderName").html(printEachStudentTerminalResultSession?.studentData?.genderName);</script></div>
                        </div>
                    </div>

                    <div class="image-div" id="studentPix">
                        <script>
                            $("#studentPix").html('<img src="<?php echo $websiteUrl ?>/uploaded_files/studentPix/' +
                            printEachStudentTerminalResultSession?.studentData?.passport + '" alt="Student Profile Image">');
                        </script>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="inner-content">
            <div class="table-div computation-table animated fadeIn">
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
                            const headerRow = $('<tr class="tb-col"></tr>');
                            tableTitles.forEach(title => {
                                headerRow.append($('<th class="th"></th>').text(title));
                            });
                            thead.append(headerRow);

                            const tbody = $('<tbody></tbody>');
                            const uniqueSubjects = [...new Set(subjectList.map(item => item.subjectName))];

                            uniqueSubjects.forEach((subjectName, index) => {
                                const row = $('<tr class="tb-row report-tb-row"></tr>');
                                row.append($('<td class="td"></td>').text(index + 1));
                                row.append($('<td class="td"></td>').text(subjectName));

                                for (let i = 2; i < tableTitles.length; i++) {
                                    const title = tableTitles[i];
                                    const value = scoreMap[title]?.[subjectName] || '';
                                    row.append($('<td class="td"></td>').text(value));
                                }
                                tbody.append(row);
                            });
                            $('#pageContent').empty().append(thead).append(tbody);
                        });
                    </script>
                </table>
            </div>

            <div class="top-containner-back-div" id="bottomContainer">
                <script>
                    $(document).ready(function () {
                        const termId = printEachStudentTerminalResultSession?.termData?.termId;
                        const items = printEachStudentTerminalResultSession?.resultSummary;
                        const branchItems = printEachStudentTerminalResultSession?.branchData;

                        let text='';
                        if(termId==='3'){
                            text +=`
                                <div class="inner-div-cont">
                                    <div class="content-div">
                                        <div class="details">
                                            <span>NUMBER OF SUBJECTS</span>
                                            <div>${items.totalSubjects}</div>
                                        </div>

                                        <div class="details">
                                            <span>STUDENTS IN CLASS</span>
                                            <div>${items.noOfStudentsInArm}</div>
                                        </div>

                                        <div class="details">
                                            <span>MARKS OBTAINABLE</span>
                                            <div>${items.totalMarkObtainable}</div>
                                        </div>

                                        <div class="details">
                                            <span>MARKS OBTAINED</span>
                                            <div>${items.totalMarkObtained}</div>
                                        </div>

                                        <div class="details"><span>PERCENTAGE</span>
                                            <div>${items.totalPercentage + '%'}</div>
                                        </div>

                                        <div class="details">
                                            <span>POSITION IN CLASS</span>
                                            <div>${items.positionInClass}</div>
                                        </div>

                                        <div class="details">
                                            <span>NUMBER OF SITTING(S)</span>
                                            <div>${items.noOfStudentsInClass}</div>
                                        </div>

                                        <div class="details">
                                            <span>1ST TERM OVERALL (%)</span>
                                            <div id="">45.82 %</div>
                                        </div>

                                        <div class="details">
                                            <span>2ND TERM OVERALL (%)</span>
                                            <div id="">48.78</div>
                                        </div>

                                        <div class="details">
                                            <span>3RD TERM OVERALL (%)</span>
                                            <div id="">47.42 %</div>
                                        </div>

                                        <div class="details">
                                            <span>AVERAGE (%)</span>
                                            <div id="">48.78</div>
                                        </div>

                                        <div class="details">
                                            <span>ANNUAL POSITION IN CLASS</span>
                                            <div id="">33RD</div>
                                        </div>

                                        <div class="details">
                                            <span>ANNUAL OVERALL POSITION</span>
                                            <div id="">143RD(166)</div>
                                        </div>

                                        <div class="details">
                                            <span>TIMES SCHOOL OPENED</span>
                                            <div>${branchItems.timeSchoolOpened}</div>
                                        </div>

                                        <div class="details">
                                            <span>TIMES PRESENT</span>
                                            <div id="">92</div>
                                        </div>

                                        <div class="details">
                                            <span>TIMES ABSENT</span>
                                            <div id="">24</div>
                                        </div>

                                        <div class="details">
                                            <span>SCHOOL REOPENS ON</span>
                                            <div>${formatDate(branchItems.schoolResumptionDate)}</div>
                                        </div>

                                        <div class="details">
                                            <span>CLASS TEACHER'S COMMENT</span>
                                            <div>${items.principalComment}</div>
                                        </div>

                                        <div class="details">
                                            <span>PRINCIPAL'S COMMENT</span>
                                            <div>${items.principalComment}</div>
                                        </div>
                                    </div>

                                    <div class="image-div signature">
                                        <img src="${principalSignaturePixPath}/${branchItems.principalSignature}" alt="${branchItems.branchName} PRINCIPAL SIGNATURE"/>
                                    </div>
                                </div>
                            `;
                        }else{
                            text +=`
                                <div class="inner-div-cont">
                                    <div class="content-div">
                                        <div class="details">
                                            <span>NUMBER OF SUBJECTS</span>
                                            <div>${items.totalSubjects}</div>
                                        </div>

                                        <div class="details">
                                            <span>MARKS OBTAINABLE</span>
                                            <div>${items.totalMarkObtainable}</div>
                                        </div>

                                        <div class="details">
                                            <span>MARKS OBTAINED</span>
                                            <div>${items.totalMarkObtained}</div>
                                        </div>

                                        <div class="details"><span>PERCENTAGE</span>
                                            <div>${items.totalPercentage + '%'}</div>
                                        </div>

                                        <div class="details">
                                            <span>STUDENT IN CLASS</span>
                                            <div>${items.noOfStudentsInClass}</div>
                                        </div>

                                        <div class="details">
                                            <span>POSITION</span>
                                            <div>${items.positionInClass}</div>
                                        </div>

                                        <div class="details">
                                            <span>TIMES SCHOOL OPENED</span>
                                            <div>${branchItems.timeSchoolOpened}</div>
                                        </div>

                                        <div class="details">
                                            <span>TIMES PRESENT</span>
                                            <div id="">92</div>
                                        </div>

                                        <div class="details">
                                            <span>TIMES ABSENT</span>
                                            <div id="">24</div>
                                        </div>

                                        <div class="details">
                                            <span>CLASS TEACHER'S COMMENT</span>
                                            <div>${items.principalComment}</div>
                                        </div>

                                        <div class="details">
                                            <span>PRINCIPAL'S COMMENT</span>
                                            <div>${items.principalComment}</div>
                                        </div>

                                        <div class="details">
                                            <span>SCHOOL REOPENS ON</span>
                                            <div>${formatDate(branchItems.schoolResumptionDate)}</div>
                                        </div>
                                    </div>

                                    <div class="image-div signature">
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

    <section class="body-div all-terminal-body">
        <div class="header-back-div">
            <div class="header-div">
                <div class="inner-div">
                    <div class="logo-div">
                        <img src="<?php echo $websiteUrl?>/images/report/icon.png" alt="<?php echo $clientName?> Logo"/>   
                    </div> 
                    
                    <div class="text-div">
                        <h3 id="reportBranchName">
                            <script>
                            $("#reportBranchName").html(printEachStudentTerminalResultSession?.branchData?.branchName);
                            </script>
                        </h3>
                        <div class="text">Address: <strong id="reportAddress">
                                <script>
                                $("#reportAddress").html(printEachStudentTerminalResultSession?.branchData?.address);
                                </script>
                            </strong></div>
                        <div class="text">Phone: <strong id="reportMobileNumber">
                                <script>
                                $("#reportMobileNumber").html(printEachStudentTerminalResultSession?.branchData?.mobileNumber);
                                </script>
                            </strong> | Official Email: <strong id="reportSmtpUsername">
                                <script>
                                $("#reportSmtpUsername").html(printEachStudentTerminalResultSession?.branchData?.smtpUsername);
                                </script>
                            </strong></div>
                    </div>
                </div>
            </div>
            <div class="title-div"><span>STUDENT PROGRESS REPORT</span></div>
            <div class="top-containner-back-div">
                <div class="inner-div-cont">
                    <div class="content-div progress-content-div">
                        <div class="details">
                            <span>STUDENT NAME</span>
                            <div id="reportFullName"><script>$("#reportFullName").html(printEachStudentTerminalResultSession?.studentData?.surName + ' ' + printEachStudentTerminalResultSession?.studentData?.firstName+ ' ' + printEachStudentTerminalResultSession?.studentData?.otherNames);</script></div>
                        </div>

                        <div class="details">
                            <span>STUDENT ID</span>
                            <div id="reportStudentId"><script>$("#reportStudentId").html(printEachStudentTerminalResultSession?.studentData?.studentId);</script></div>
                        </div>

                        <div class="details"><span>CLASS</span>
                            <div id="reportClassName"><script>$("#reportClassName").html(printEachStudentTerminalResultSession?.classData?.className + ' ' + printEachStudentTerminalResultSession?.armData?.armName);</script></div>
                        </div>

                        <div class="details"><span>GENDER</span>
                            <div id="reportGenderName"><script>$("#reportGenderName").html(printEachStudentTerminalResultSession?.studentData?.genderName);</script></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="inner-content">
            <div class="table-div computation-table animated fadeIn">
                <table class="table" cellspacing="0" style="width:100%" id="">
                    <thead>
                        <tr class="tb-col report-tb-col">
                            <th></th>
                            <th></th>
                            <th colspan="3">SSS 1 (2023/2024)</th>
                            <th colspan="3">SSS 2 (NULL)</th>
                            <th colspan="3">SSS 3 (NULL)</th>
                        </tr>

                        <tr class="tb-col report-tb-col">
                            <th>SN</th>
                            <th>SUBJECT</th>
                            <th>1ST TERM SCORE (100)</th>
                            <th>2ND TERM SCORE (100)</th>
                            <th>3RD TERM SCORE (100)</th>
                            <th>1ST TERM SCORE (100)</th>
                            <th>2ND TERM SCORE (100)</th>
                            <th>3RD TERM SCORE (100)</th>
                            <th>1ST TERM SCORE (100)</th>
                            <th>2ND TERM SCORE (100)</th>
                            <th>3RD TERM SCORE (100)</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="tb-row report-tb-row">
                            <td>1</td>
                            <td>AGRICULTURAL SCIENCE</td>
                            <td>37 %</td>
                            <td>47.1 %</td>
                            <td>44%</td>
                            <td>42.5 %</td>
                            <td>32.6 %</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>  
                        
                        <tr class="tb-row report-tb-row">
                            <td>2</td>
                            <td>BASIC SCIENCE</td>
                            <td>37 %</td>
                            <td>47.1 %</td>
                            <td>44%</td>
                            <td>42.5 %</td>
                            <td>32.6 %</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>  

                       <tr class="tb-row report-tb-row">
                            <td>3</td>
                            <td>BASIC TECHNOLOGY</td>
                            <td>37 %</td>
                            <td>47.1 %</td>
                            <td>44%</td>
                            <td>42.5 %</td>
                            <td>32.6 %</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>  

                        <tr class="tb-row report-tb-row">
                            <td>4</td>
                            <td>CIVIC EDUCATION</td>
                            <td>37 %</td>
                            <td>47.1 %</td>
                            <td>44%</td>
                            <td>42.5 %</td>
                            <td>32.6 %</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="tb-row report-tb-row">
                            <td>4</td>
                            <td>CIVIC EDUCATION</td>
                            <td>37 %</td>
                            <td>47.1 %</td>
                            <td>44%</td>
                            <td>42.5 %</td>
                            <td>32.6 %</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr> 
                        
                        <tr class="tb-row report-tb-row">
                            <td>5</td>
                            <td>COMPUTER STUDIES</td>
                            <td>37 %</td>
                            <td>47.1 %</td>
                            <td>44%</td>
                            <td>42.5 %</td>
                            <td>32.6 %</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td>6</td>
                            <td>ENGLISH LANGUAGE</td>
                            <td>37 %</td>
                            <td>47.1 %</td>
                            <td>44%</td>
                            <td>42.5 %</td>
                            <td>32.6 %</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td>7</td>
                            <td>FRENCH</td>
                            <td>37 %</td>
                            <td>47.1 %</td>
                            <td>44%</td>
                            <td>42.5 %</td>
                            <td>32.6 %</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td>8</td>
                            <td>MATHEMATICS</td>
                            <td>37 %</td>
                            <td>47.1 %</td>
                            <td>44%</td>
                            <td>42.5 %</td>
                            <td>32.6 %</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td>9</td>
                            <td>SOCIAL STUDIES</td>
                            <td>37 %</td>
                            <td>47.1 %</td>
                            <td>44%</td>
                            <td>42.5 %</td>
                            <td>32.6 %</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td>10</td>
                            <td>YORUBA LANGUAGE</td>
                            <td>37 %</td>
                            <td>47.1 %</td>
                            <td>44%</td>
                            <td>42.5 %</td>
                            <td>42.5 %</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td>-</td>
                            <td>TOTAL PERCENTAGE</td>
                            <td>37 %</td>
                            <td>47.1 %</td>
                            <td>44%</td>
                            <td>42.5 %</td>
                            <td>42.5 %</td>
                            <td>0%</td>
                            <td>0%</td>
                            <td>0%</td>
                            <td>0%</td>
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>

        <div class="top-containner-back-div bottom-containner-back-div">
            <div class="inner-div-cont">
                <canvas id="progressChart" width="700"  height="250">
                    <script>
                        $(document).ready(function () {
                            const labels = [
                                ['JSS 1', '1ST TERM'],
                                ['JSS 1', '2ND TERM'],
                                ['JSS 1', '3RD TERM'],
                                ['JSS 2', '1ST TERM'],
                                ['JSS 2', '2ND TERM'],
                                ['JSS 2', '3RD TERM'],
                                ['JSS 3', '1ST TERM'],
                                ['JSS 3', '2ND TERM'],
                                ['JSS 3', '3RD TERM'],
                            ];

                            const testData = [45.82, 48.78, 47.42, 44.36, 45.1];

                            const backgroundColors = [
                                'rgba(78, 115, 223, 0.7)',
                                'rgba(231, 74, 59, 0.7)',
                                'rgba(28, 200, 138, 0.7)',
                                'rgba(54, 185, 204, 0.7)',
                                'rgba(111, 66, 193, 0.7)'
                            ];

                            const borderColors = [
                                'rgb(78, 115, 223)',
                                'rgb(231, 74, 59)',
                                'rgb(28, 200, 138)',
                                'rgb(54, 185, 204)',
                                'rgb(111, 66, 193)'
                            ];

                            const ctx = document.getElementById('progressChart').getContext('2d');

                            new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'SchoolBolt Progress Report',
                                    data: testData,
                                    backgroundColor: backgroundColors,
                                    borderColor: borderColors,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                },
                                scales: {
                                    x: {
                                        ticks: {
                                            maxRotation: 0,
                                            minRotation: 0,
                                            autoSkip: false
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            callback: function (value) {
                                                return value + '%';
                                            },
                                            stepSize: 10,
                                            min: 0,
                                            max: 50
                                        }
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
                                                const value = dataset.data[index];
                                                const x = bar.x;
                                                const y = bar.y;
                                                const barHeight = bar.base - y;

                                                ctx.fillStyle = '#fff'; // white inside bar
                                                ctx.fillText(value + '%', x, y + barHeight / 2);
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
    </section>
</body>
</html>