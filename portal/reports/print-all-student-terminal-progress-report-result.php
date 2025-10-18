<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl?>/images/icon.png" rel="shortcut icon" type="image-png"/>
    <link href="<?php echo $websiteUrl?>/style/report-style.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
    <script src="<?php echo $websiteUrl?>/js/admin/chart.min.js"></script>
    <title>Each Student Terminal Result | <?php echo $clientName ?></title>
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
    </section>

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
    </section>

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
    </section>
</body>
</html>