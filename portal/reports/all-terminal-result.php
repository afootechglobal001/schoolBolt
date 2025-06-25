<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl?>/images/icon.png" rel="shortcut icon" type="image-png"/>
    <link href="<?php echo $websiteUrl?>/style/report-style.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
    <title>All Terminal Result | <?php echo $clientName ?></title>
</head>

<body>
    <script> printAssessmentSession = JSON.parse(sessionStorage.getItem("printAssessmentSession"));</script>

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
                        <tr class="tb-col">
                            <th class="th">SN</th>
                            <th class="th">SUBJECT</th>
                            <th class="th">1ST TERM SCORE(100)</th>
                            <th class="th">2ND TERM SCORE(100)</th>
                            <th class="th">1ST TEST SCORE(15)</th>
                            <th class="th">2ND TEST SCORE(15)</th>
                            <th class="th">EXAM SCORE(70)</th>
                            <th class="th">3RD TERM SCORE(100)</th>
                            <th class="th">POSN. IN CLASS</th>
                            <th class="th">CLASS MIN SCORE</th>
                            <th class="th">CLASS MAX SCORE</th>
                            <th class="th">CLASS AVERAGE</th>
                            <th class="th">ANNUAL SCORE</th>
                            <th class="th">ANNUAL SCORE GRADE</th>
                            <th class="th">REMARK</th>
                            <th class="th">OVERAL POSN.</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="tb-row report-tb-row">
                            <td class="td">1</td>
                            <td class="td">AGRICULTURAL SCIENCE</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr>  
                        
                        <tr class="tb-row report-tb-row">
                            <td class="td">2</td>
                            <td class="td">BASIC SCIENCE</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr>  

                       <tr class="tb-row report-tb-row">
                            <td class="td">3</td>
                            <td class="td">BASIC TECHNOLOGY</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr>  

                        <tr class="tb-row report-tb-row">
                            <td class="td">4</td>
                            <td class="td">CIVIC EDUCATION</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr>
                        <tr class="tb-row report-tb-row">
                            <td class="td">4</td>
                            <td class="td">CIVIC EDUCATION</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 
                        
                        <tr class="tb-row report-tb-row">
                            <td class="td">5</td>
                            <td class="td">COMPUTER STUDIES</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td class="td">6</td>
                            <td class="td">ENGLISH LANGUAGE</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td class="td">7</td>
                            <td class="td">FRENCH</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td class="td">8</td>
                            <td class="td">MATHEMATICS</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td class="td">9</td>
                            <td class="td">SOCIAL STUDIES</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                         <tr class="tb-row report-tb-row">
                            <td class="td">10</td>
                            <td class="td">YORUBA LANGUAGE</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
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
    <script> printAssessmentSession = JSON.parse(sessionStorage.getItem("printAssessmentSession"));</script>

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
                        <tr class="tb-col">
                            <th class="th">SN</th>
                            <th class="th">SUBJECT</th>
                            <th class="th">1ST TERM SCORE(100)</th>
                            <th class="th">2ND TERM SCORE(100)</th>
                            <th class="th">1ST TEST SCORE(15)</th>
                            <th class="th">2ND TEST SCORE(15)</th>
                            <th class="th">EXAM SCORE(70)</th>
                            <th class="th">3RD TERM SCORE(100)</th>
                            <th class="th">POSN. IN CLASS</th>
                            <th class="th">CLASS MIN SCORE</th>
                            <th class="th">CLASS MAX SCORE</th>
                            <th class="th">CLASS AVERAGE</th>
                            <th class="th">ANNUAL SCORE</th>
                            <th class="th">ANNUAL SCORE GRADE</th>
                            <th class="th">REMARK</th>
                            <th class="th">OVERAL POSN.</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="tb-row report-tb-row">
                            <td class="td">1</td>
                            <td class="td">AGRICULTURAL SCIENCE</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr>  
                        
                        <tr class="tb-row report-tb-row">
                            <td class="td">2</td>
                            <td class="td">BASIC SCIENCE</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr>  

                       <tr class="tb-row report-tb-row">
                            <td class="td">3</td>
                            <td class="td">BASIC TECHNOLOGY</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr>  

                        <tr class="tb-row report-tb-row">
                            <td class="td">4</td>
                            <td class="td">CIVIC EDUCATION</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr>
                        <tr class="tb-row report-tb-row">
                            <td class="td">4</td>
                            <td class="td">CIVIC EDUCATION</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 
                        
                        <tr class="tb-row report-tb-row">
                            <td class="td">5</td>
                            <td class="td">COMPUTER STUDIES</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td class="td">6</td>
                            <td class="td">ENGLISH LANGUAGE</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td class="td">7</td>
                            <td class="td">FRENCH</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td class="td">8</td>
                            <td class="td">MATHEMATICS</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td class="td">9</td>
                            <td class="td">SOCIAL STUDIES</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                         <tr class="tb-row report-tb-row">
                            <td class="td">10</td>
                            <td class="td">YORUBA LANGUAGE</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
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
    <script> printAssessmentSession = JSON.parse(sessionStorage.getItem("printAssessmentSession"));</script>

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
                        <tr class="tb-col">
                            <th class="th">SN</th>
                            <th class="th">SUBJECT</th>
                            <th class="th">1ST TERM SCORE(100)</th>
                            <th class="th">2ND TERM SCORE(100)</th>
                            <th class="th">1ST TEST SCORE(15)</th>
                            <th class="th">2ND TEST SCORE(15)</th>
                            <th class="th">EXAM SCORE(70)</th>
                            <th class="th">3RD TERM SCORE(100)</th>
                            <th class="th">POSN. IN CLASS</th>
                            <th class="th">CLASS MIN SCORE</th>
                            <th class="th">CLASS MAX SCORE</th>
                            <th class="th">CLASS AVERAGE</th>
                            <th class="th">ANNUAL SCORE</th>
                            <th class="th">ANNUAL SCORE GRADE</th>
                            <th class="th">REMARK</th>
                            <th class="th">OVERAL POSN.</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="tb-row report-tb-row">
                            <td class="td">1</td>
                            <td class="td">AGRICULTURAL SCIENCE</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr>  
                        
                        <tr class="tb-row report-tb-row">
                            <td class="td">2</td>
                            <td class="td">BASIC SCIENCE</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr>  

                       <tr class="tb-row report-tb-row">
                            <td class="td">3</td>
                            <td class="td">BASIC TECHNOLOGY</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr>  

                        <tr class="tb-row report-tb-row">
                            <td class="td">4</td>
                            <td class="td">CIVIC EDUCATION</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr>
                        <tr class="tb-row report-tb-row">
                            <td class="td">4</td>
                            <td class="td">CIVIC EDUCATION</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 
                        
                        <tr class="tb-row report-tb-row">
                            <td class="td">5</td>
                            <td class="td">COMPUTER STUDIES</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td class="td">6</td>
                            <td class="td">ENGLISH LANGUAGE</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td class="td">7</td>
                            <td class="td">FRENCH</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td class="td">8</td>
                            <td class="td">MATHEMATICS</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td class="td">9</td>
                            <td class="td">SOCIAL STUDIES</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                         <tr class="tb-row report-tb-row">
                            <td class="td">10</td>
                            <td class="td">YORUBA LANGUAGE</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
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
    <script> printAssessmentSession = JSON.parse(sessionStorage.getItem("printAssessmentSession"));</script>

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
                        <tr class="tb-col">
                            <th class="th">SN</th>
                            <th class="th">SUBJECT</th>
                            <th class="th">1ST TERM SCORE(100)</th>
                            <th class="th">2ND TERM SCORE(100)</th>
                            <th class="th">1ST TEST SCORE(15)</th>
                            <th class="th">2ND TEST SCORE(15)</th>
                            <th class="th">EXAM SCORE(70)</th>
                            <th class="th">3RD TERM SCORE(100)</th>
                            <th class="th">POSN. IN CLASS</th>
                            <th class="th">CLASS MIN SCORE</th>
                            <th class="th">CLASS MAX SCORE</th>
                            <th class="th">CLASS AVERAGE</th>
                            <th class="th">ANNUAL SCORE</th>
                            <th class="th">ANNUAL SCORE GRADE</th>
                            <th class="th">REMARK</th>
                            <th class="th">OVERAL POSN.</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="tb-row report-tb-row">
                            <td class="td">1</td>
                            <td class="td">AGRICULTURAL SCIENCE</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr>  
                        
                        <tr class="tb-row report-tb-row">
                            <td class="td">2</td>
                            <td class="td">BASIC SCIENCE</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr>  

                       <tr class="tb-row report-tb-row">
                            <td class="td">3</td>
                            <td class="td">BASIC TECHNOLOGY</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr>  

                        <tr class="tb-row report-tb-row">
                            <td class="td">4</td>
                            <td class="td">CIVIC EDUCATION</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr>
                        <tr class="tb-row report-tb-row">
                            <td class="td">4</td>
                            <td class="td">CIVIC EDUCATION</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 
                        
                        <tr class="tb-row report-tb-row">
                            <td class="td">5</td>
                            <td class="td">COMPUTER STUDIES</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td class="td">6</td>
                            <td class="td">ENGLISH LANGUAGE</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td class="td">7</td>
                            <td class="td">FRENCH</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td class="td">8</td>
                            <td class="td">MATHEMATICS</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td class="td">9</td>
                            <td class="td">SOCIAL STUDIES</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                         <tr class="tb-row report-tb-row">
                            <td class="td">10</td>
                            <td class="td">YORUBA LANGUAGE</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
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
    <script> printAssessmentSession = JSON.parse(sessionStorage.getItem("printAssessmentSession"));</script>

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
                        <tr class="tb-col">
                            <th class="th">SN</th>
                            <th class="th">SUBJECT</th>
                            <th class="th">1ST TERM SCORE(100)</th>
                            <th class="th">2ND TERM SCORE(100)</th>
                            <th class="th">1ST TEST SCORE(15)</th>
                            <th class="th">2ND TEST SCORE(15)</th>
                            <th class="th">EXAM SCORE(70)</th>
                            <th class="th">3RD TERM SCORE(100)</th>
                            <th class="th">POSN. IN CLASS</th>
                            <th class="th">CLASS MIN SCORE</th>
                            <th class="th">CLASS MAX SCORE</th>
                            <th class="th">CLASS AVERAGE</th>
                            <th class="th">ANNUAL SCORE</th>
                            <th class="th">ANNUAL SCORE GRADE</th>
                            <th class="th">REMARK</th>
                            <th class="th">OVERAL POSN.</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="tb-row report-tb-row">
                            <td class="td">1</td>
                            <td class="td">AGRICULTURAL SCIENCE</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr>  
                        
                        <tr class="tb-row report-tb-row">
                            <td class="td">2</td>
                            <td class="td">BASIC SCIENCE</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr>  

                       <tr class="tb-row report-tb-row">
                            <td class="td">3</td>
                            <td class="td">BASIC TECHNOLOGY</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr>  

                        <tr class="tb-row report-tb-row">
                            <td class="td">4</td>
                            <td class="td">CIVIC EDUCATION</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr>
                        <tr class="tb-row report-tb-row">
                            <td class="td">4</td>
                            <td class="td">CIVIC EDUCATION</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 
                        
                        <tr class="tb-row report-tb-row">
                            <td class="td">5</td>
                            <td class="td">COMPUTER STUDIES</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td class="td">6</td>
                            <td class="td">ENGLISH LANGUAGE</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td class="td">7</td>
                            <td class="td">FRENCH</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td class="td">8</td>
                            <td class="td">MATHEMATICS</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                        <tr class="tb-row report-tb-row">
                            <td class="td">9</td>
                            <td class="td">SOCIAL STUDIES</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
                        </tr> 

                         <tr class="tb-row report-tb-row">
                            <td class="td">10</td>
                            <td class="td">YORUBA LANGUAGE</td>
                            <td class="td">37</td>
                            <td class="td">47.1</td>
                            <td class="td">7</td>
                            <td class="td">6</td>
                            <td class="td">31</td>
                            <td class="td">44</td>
                            <td class="td">28TH(33)</td>
                            <td class="td">29.3</td>
                            <td class="td">88</td>
                            <td class="td">55.5</td>
                            <td class="td">42.7</td>
                            <td class="td">E8</td>
                            <td class="td">PASS</td>
                            <td class="td">134TH(166)</td>
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
</html>