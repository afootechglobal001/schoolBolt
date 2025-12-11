<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl?>/images/icon.png" rel="shortcut icon" type="image-png"/>
    <link href="<?php echo $websiteUrl?>/style/report-style.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
    <script src="<?php echo $websiteUrl?>/js/admin/chart.min.js"></script>
    <title>All Student Progressive Result | <?php echo $clientName ?></title>
</head>

<body>
    <script>
        printAllStudentProgressResultSession = JSON.parse(sessionStorage.getItem("printAllStudentProgressResultSession"));
    </script>

    <div id="pageContainer">
        <script>
            $(document).ready(function () {

                if (printAllStudentProgressResultSession && printAllStudentProgressResultSession.success === true) {

                    const sessionData = printAllStudentProgressResultSession;
                    const branch = sessionData.branchData;
                    const term = sessionData.termData;
                    const department = sessionData.departmentData;
                    const classData = sessionData.classData;
                    const arm = sessionData.armData;
                    const sessionName = sessionData.session;
                    const fetchedStudent = sessionData.eachStudentResultData;

                    let sectionHtml = '';

                    /// Loop through each student result data ///
                    for (let i = 0; i < fetchedStudent.length; i++) {
                        const studentResultData = fetchedStudent[i];
                        const items = studentResultData.studentData;

                        const fullName = `${items.surName} ${items.firstName} ${items.otherNames}`;
                        const studentId = items.studentId;
                        const officialStudentId = items.officialStudentId;
                        const genderName = items.genderName;

                        /// get school header ///
                        const schoolHeader = branch.progressReportHeader;
                        const headerUrl = schoolHeader
                            ? `${progressReportHeaderPixPath}/${schoolHeader}`
                            : `${websiteUrl}/images/report/progress-report-header.png`;

                        let tableTitles = sessionData.progressiveReportTableTitles;
                        const progressiveReportData = studentResultData.progressiveReportData || [];

                        // Ensure tableTitles is an array //
                        if (typeof tableTitles === "string") {
                            tableTitles = tableTitles.split(",").map(t => t.trim());
                        }

                        // Groups per class //
                        const groupsPerClass = 3; // 1st, 2nd, 3rd term

                        let subjectTable = `
                            <thead><tr class="tb-col table-col">
                            <th></th>
                            <th></th>
                        `;

                        /// Build table header for each class ///
                        progressiveReportData.forEach(cls => {
                            subjectTable += `
                                <th colspan="${groupsPerClass}">
                                    ${cls.className} (${cls.session || "NULL"})
                                </th>
                            `;
                        });

                        // Close first header row //
                        subjectTable += `
                            </tr>
                            <tr class="tb-col table-col">
                        `;

                        /// Build second header row with term titles ///
                        tableTitles.forEach(t => subjectTable += `<th>${t}</th>`);

                        /// Close second header row ///
                        subjectTable += `
                            </tr>
                            </thead>
                            <tbody>
                        `;

                        /// Collect all unique subjects across classes ///
                        const allSubjects = new Set();
                        progressiveReportData.forEach(cls => {
                            cls.subjectsScores.forEach(sub => {
                                allSubjects.add(sub.subjectName);
                            });
                        });

                        const subjectList = Array.from(allSubjects);

                        /// Helper function to format score ///
                        function formatScore(score) {
                            return score ? `${score} %` : "";
                        }

                        /// Build table rows for each subject ///
                        subjectList.forEach((subjectName, idx) => {
                            subjectTable += `
                                <tr class="tb-row table-row">
                                <td>${idx + 1}</td>
                                <td>${subjectName}</td>
                            `;
                            
                            //// Fill in scores for each class ////
                            progressiveReportData.forEach(cls => {
                                const subObj = cls.subjectsScores.find(s => s.subjectName === subjectName);

                                if (subObj) {
                                    subjectTable += `
                                        <td>${formatScore(subObj.firstTermScores)}</td>
                                        <td>${formatScore(subObj.secondTermScores)}</td>
                                        <td>${formatScore(subObj.thirdTermScores)}</td>`;
                                } else {
                                    subjectTable += `<td></td><td></td><td></td>`;
                                }
                            });

                            subjectTable += `</tr>`;
                        });

                        /// Build TOTAL PERCENTAGE row ///
                        subjectTable += `
                            <tr class="tb-row table-row">
                            <td>-</td>
                            <td>TOTAL PERCENTAGE</td>
                        `;

                        /// Fill in total percentages for each class ///
                        progressiveReportData.forEach(cls => {
                            subjectTable += `
                                <td class="bold-font">${(cls.totalPercentage.firstTermTotalPercentage ?? 0)} %</td>
                                <td class="bold-font">${(cls.totalPercentage.secondTermTotalPercentage ?? 0)} %</td>
                                <td class="bold-font">${(cls.totalPercentage.thirdTermTotalPercentage ?? 0)} %</td>
                            `;
                        });

                        /// Close TOTAL PERCENTAGE row ///
                        subjectTable += `
                            </tr>
                            </tbody>
                        `;


                       /// BUILD CHART DATA ///
                        let labels = [];
                        progressiveReportData.forEach(cls => {
                            labels.push([cls.className, "1ST TERM"]);
                            labels.push([cls.className, "2ND TERM"]);
                            labels.push([cls.className, "3RD TERM"]);
                        });

                        let chartData = [];
                        progressiveReportData.forEach(cls => {
                            const t = cls.totalPercentage;
                            chartData.push(t.firstTermTotalPercentage ? parseFloat(t.firstTermTotalPercentage) : null);
                            chartData.push(t.secondTermTotalPercentage ? parseFloat(t.secondTermTotalPercentage) : null);
                            chartData.push(t.thirdTermTotalPercentage ? parseFloat(t.thirdTermTotalPercentage) : null);
                        });

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

                        const canvasId = `progressChart_${studentId}`;

                        sectionHtml += `
                            <section class="body-div backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat; page-break-after: always;">
                                <div class="header-back-div">
                                    <div class="header-image">
                                        <img src="${headerUrl}" alt="${branch.branchName} Report Header" style="width: 100%; height: auto;" />
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
                                        <table class="table" cellspacing="0" style="width:100%">
                                            ${subjectTable}
                                        </table>
                                    </div>

                                    <div class="bottom-content-back-div">
                                        <div class="inner-container">
                                            <canvas id="${canvasId}" width="700" height="250"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        `;

                        /// QUEUE CHART FOR RENDER AFTER DOM BUILD ///
                        setTimeout(() => {
                            const ctx = document.getElementById(canvasId).getContext('2d');

                            new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: `${items.surName} ${items.firstName} PROGRESS REPORT PERFORMANCE`,
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
                                            grid: { display: true }
                                        },
                                        x: {
                                            grid: { display: false },
                                            ticks: { font: { size: 11 } },
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

                        }, 400);

                    } // end loop

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