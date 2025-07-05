<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl?>/images/icon.png" rel="shortcut icon" type="image-png"/>
    <link href="<?php echo $websiteUrl?>/style/report-style.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
    <script src="<?php echo $websiteUrl?>/js/admin/chart.min.js"></script>
    <title>Each Terminal Result | <?php echo $clientName ?></title>
</head>

<body>
    <section class="body-div all-terminal-body">
        <div class="header-back-div">
            <div class="header-div">
                <div class="inner-div">
                    <div class="logo-div">
                        <img src="<?php echo $websiteUrl?>/images/report/icon.png" alt="<?php echo $clientName?> Logo"/>   
                    </div> 
                    
                    <div class="text-div">
                        <h3 id="branchName">SCHOOLBOLT NUR/PRY SCHOOL, ODE REMO</h3>
                        <div class="text">Address: <strong id="address">8, ABAREN CLOSE, OFF LOVEALL IKOSI, KETU, LAGOS</strong></div>
                        <div class="text">Phone: <strong id="mobileNumber">08050202261</strong> | Official Email: <strong id="smtpUsername">school_1@schoolbolt.com</strong></div> 
                    </div>
                </div>
            </div>
            <div class="title-div"><span id="titleDetails">2023/2024</span> - <span id="">THIRD TERM</span> - <span id="">ACADEMIC SESSION</span> TERMINAL RESULT</div>
            <div class="top-containner-back-div">
                <div class="inner-div-cont">
                    <div class="content-div">
                        <div class="details">
                            <span>STUDENT NAME</span>
                            <div id="">MIKE AFOLABI OLUWAGBENGA</div>
                        </div>

                        <div class="details">
                            <span>STUDENT ID</span>
                            <div id="">STUDENT00220250321124557</div>
                        </div>

                        <div class="details"><span>CLASS</span>
                            <div id="">KINDERGARTEN - KG 1</div>
                        </div>

                        <div class="details"><span>GENDER</span>
                            <div id="">MALE</div>
                        </div>
                    </div>

                    <div class="image-div">
                        <img src="<?php echo $websiteUrl?>/images/student.jpg" alt="Avatar"/>   
                    </div>
                </div>
            </div>
        </div>
    
        <div class="inner-content">
            <div class="table-div computation-table animated fadeIn">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <thead>
                        <tr class="tb-col report-tb-col">
                            <th>SN</th>
                            <th>SUBJECT</th>
                            <th>1ST TERM SCORE(100)</th>
                            <th>2ND TERM SCORE(100)</th>
                            <th>1ST TEST SCORE(15)</th>
                            <th>2ND TEST SCORE(15)</th>
                            <th>EXAM SCORE(70)</th>
                            <th>3RD TERM SCORE(100)</th>
                            <th>POSN. IN CLASS</th>
                            <th>CLASS MIN SCORE</th>
                            <th>CLASS MAX SCORE</th>
                            <th>CLASS AVERAGE</th>
                            <th>ANNUAL SCORE</th>
                            <th>ANNUAL SCORE GRADE</th>
                            <th>REMARK</th>
                            <th>OVERAL POSN.</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="tb-row report-tb-row">
                            <td>1</td>
                            <td>AGRICULTURAL SCIENCE</td>
                            <td>37</td>
                            <td>47.1</td>
                            <td>7</td>
                            <td>6</td>
                            <td>31</td>
                            <td>44</td>
                            <td>28TH(33)</td>
                            <td>29.3</td>
                            <td>88</td>
                            <td>55.5</td>
                            <td>42.7</td>
                            <td>E8</td>
                            <td>PASS</td>
                            <td>134TH(166)</td>
                        </tr>  
                        
                        <tr class="tb-row report-tb-row">
                            <td>2</td>
                            <td>BASIC SCIENCE</td>
                            <td>37</td>
                            <td>47.1</td>
                            <td>7</td>
                            <td>6</td>
                            <td>31</td>
                            <td>44</td>
                            <td>28TH(33)</td>
                            <td>29.3</td>
                            <td>88</td>
                            <td>55.5</td>
                            <td>42.7</td>
                            <td>E8</td>
                            <td>PASS</td>
                            <td>134TH(166)</td>
                        </tr>  

                       <tr class="tb-row report-tb-row">
                            <td>3</td>
                            <td>BASIC TECHNOLOGY</td>
                            <td>37</td>
                            <td>47.1</td>
                            <td>7</td>
                            <td>6</td>
                            <td>31</td>
                            <td>44</td>
                            <td>28TH(33)</td>
                            <td>29.3</td>
                            <td>88</td>
                            <td>55.5</td>
                            <td>42.7</td>
                            <td>E8</td>
                            <td>PASS</td>
                            <td>134TH(166)</td>
                        </tr>  

                        <tr class="tb-row report-tb-row">
                            <td>4</td>
                            <td>CIVIC EDUCATION</td>
                            <td>37</td>
                            <td>47.1</td>
                            <td>7</td>
                            <td>6</td>
                            <td>31</td>
                            <td>44</td>
                            <td>28TH(33)</td>
                            <td>29.3</td>
                            <td>88</td>
                            <td>55.5</td>
                            <td>42.7</td>
                            <td>E8</td>
                            <td>PASS</td>
                            <td>134TH(166)</td>
                        </tr>
                        <tr class="tb-row report-tb-row">
                            <td>4</td>
                            <td>CIVIC EDUCATION</td>
                            <td>37</td>
                            <td>47.1</td>
                            <td>7</td>
                            <td>6</td>
                            <td>31</td>
                            <td>44</td>
                            <td>28TH(33)</td>
                            <td>29.3</td>
                            <td>88</td>
                            <td>55.5</td>
                            <td>42.7</td>
                            <td>E8</td>
                            <td>PASS</td>
                            <td>134TH(166)</td>
                        </tr> 
                        
                        <tr class="tb-row report-tb-row">
                            <td>5</td>
                            <td>COMPUTER STUDIES</td>
                            <td>37</td>
                            <td>47.1</td>
                            <td>7</td>
                            <td>6</td>
                            <td>31</td>
                            <td>44</td>
                            <td>28TH(33)</td>
                            <td>29.3</td>
                            <td>88</td>
                            <td>55.5</td>
                            <td>42.7</td>
                            <td>E8</td>
                            <td>PASS</td>
                            <td>134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td>6</td>
                            <td>ENGLISH LANGUAGE</td>
                            <td>37</td>
                            <td>47.1</td>
                            <td>7</td>
                            <td>6</td>
                            <td>31</td>
                            <td>44</td>
                            <td>28TH(33)</td>
                            <td>29.3</td>
                            <td>88</td>
                            <td>55.5</td>
                            <td>42.7</td>
                            <td>E8</td>
                            <td>PASS</td>
                            <td>134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td>7</td>
                            <td>FRENCH</td>
                            <td>37</td>
                            <td>47.1</td>
                            <td>7</td>
                            <td>6</td>
                            <td>31</td>
                            <td>44</td>
                            <td>28TH(33)</td>
                            <td>29.3</td>
                            <td>88</td>
                            <td>55.5</td>
                            <td>42.7</td>
                            <td>E8</td>
                            <td>PASS</td>
                            <td>134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td>8</td>
                            <td>MATHEMATICS</td>
                            <td>37</td>
                            <td>47.1</td>
                            <td>7</td>
                            <td>6</td>
                            <td>31</td>
                            <td>44</td>
                            <td>28TH(33)</td>
                            <td>29.3</td>
                            <td>88</td>
                            <td>55.5</td>
                            <td>42.7</td>
                            <td>E8</td>
                            <td>PASS</td>
                            <td>134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td>9</td>
                            <td>SOCIAL STUDIES</td>
                            <td>37</td>
                            <td>47.1</td>
                            <td>7</td>
                            <td>6</td>
                            <td>31</td>
                            <td>44</td>
                            <td>28TH(33)</td>
                            <td>29.3</td>
                            <td>88</td>
                            <td>55.5</td>
                            <td>42.7</td>
                            <td>E8</td>
                            <td>PASS</td>
                            <td>134TH(166)</td>
                        </tr> 

                         <tr class="tb-row report-tb-row">
                            <td>10</td>
                            <td>YORUBA LANGUAGE</td>
                            <td>37</td>
                            <td>47.1</td>
                            <td>7</td>
                            <td>6</td>
                            <td>31</td>
                            <td>44</td>
                            <td>28TH(33)</td>
                            <td>29.3</td>
                            <td>88</td>
                            <td>55.5</td>
                            <td>42.7</td>
                            <td>E8</td>
                            <td>PASS</td>
                            <td>134TH(166)</td>
                        </tr> 
                    </tbody>
                </table>
            </div>

            <div class="top-containner-back-div">
                <div class="inner-div-cont">
                    <div class="content-div">
                        <div class="details">
                            <span>STUDENTS IN CLASS</span>
                            <div id="">33</div>
                        </div>

                        <div class="details">
                            <span>MARKS OBTAINABLE</span>
                            <div id="">1600</div>
                        </div>

                        <div class="details">
                            <span>MARKS OBTAINED</span>
                            <div id="">758.75</div>
                        </div>

                        <div class="details"><span>PERCENTAGE</span>
                            <div id="">47.42 %</div>
                        </div>

                        <div class="details">
                            <span>POSITION IN CLASS</span>
                            <div id="">33RD</div>
                        </div>

                        <div class="details">
                            <span>NUMBER OF SITTING(S)</span>
                            <div id="">3</div>
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
                            <div id="">116</div>
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
                            <div id="">HE RELATES WELL.</div>
                        </div>

                        <div class="details">
                            <span>PRINCIPAL'S COMMENT</span>
                            <div id="">FAIR RESULT. PROMOTED TO JSS 2</div>
                        </div>

                        <div class="details">
                            <span>SCHOOL REOPENS ON</span>
                            <div id="">MONDAY 16TH June, 2025</div>
                        </div>
                    </div>

                    <div class="image-div signature">
                        <img src="<?php echo $websiteUrl?>/images/principal_signature.png" alt="Avatar"/>   
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<body>
    <section class="body-div all-terminal-body">
        <div class="header-back-div">
            <div class="header-div">
                <div class="inner-div">
                    <div class="logo-div">
                        <img src="<?php echo $websiteUrl?>/images/report/icon.png" alt="<?php echo $clientName?> Logo"/>   
                    </div> 
                    
                    <div class="text-div">
                        <h3 id="branchName">SCHOOLBOLT NUR/PRY SCHOOL, ODE REMO</h3>
                        <div class="text">Address: <strong id="address">8, ABAREN CLOSE, OFF LOVEALL IKOSI, KETU, LAGOS</strong></div>
                        <div class="text">Phone: <strong id="mobileNumber">08050202261</strong> | Official Email: <strong id="smtpUsername">school_1@schoolbolt.com</strong></div> 
                    </div>
                </div>
            </div>
            <div class="title-div"><span>STUDENT PROGRESS REPORT</span></div>
            <div class="top-containner-back-div">
                <div class="inner-div-cont">
                    <div class="content-div progress-content-div">
                        <div class="details">
                            <span>STUDENT NAME</span>
                            <div id="">MIKE AFOLABI OLUWAGBENGA</div>
                        </div>

                        <div class="details">
                            <span>STUDENT ID</span>
                            <div id="">STUDENT00220250321124557</div>
                        </div>

                        <div class="details"><span>CLASS</span>
                            <div id="">KINDERGARTEN - KG 1</div>
                        </div>

                        <div class="details"><span>GENDER</span>
                            <div id="">MALE</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="inner-content">
            <div class="table-div computation-table animated fadeIn">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
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