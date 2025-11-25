<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl ?>/images/icon.png" rel="shortcut icon" type="image-png" />
    <link href="<?php echo $websiteUrl ?>/style/report-style.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl ?>/style/paramount.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl ?>/js/jquery-v3.6.1.min.js"></script>
    <script src="<?php echo $websiteUrl ?>/js/admin/chart.min.js"></script>
    <title>All Student Terminal Result | <?php echo $clientName ?></title>
</head>

<body>
    <script>
        printAllStudentTerminalResultSession = JSON.parse(sessionStorage.getItem("printAllStudentTerminalResultSession"));
    </script>
    
    <section class="body-div all-terminal-body">
        <div class="header-back-div">
            <div class="header-image">
                <img src="<?php echo $websiteUrl ?>/images/report/terminal-result-header.png" alt="Report Header"
                style="width: 100%; height: auto;" />
            </div>

            <div class="school-info-div">
                <div class="text">School Address: <strong id="address">12, KOTCO ROAD, ODE REMO, OGUN STATE NIGERIA</strong></div>
                <div class="text">Phone: <strong id="mobileNumber">08050202261</strong> | Email: <strong id="supportEmail">schoolboltedusystem@gmail.com</strong></div>
                <div class="text">Website: <strong id="clientWebsite">https://schoolbolt.com</strong></div>
            </div>

            <div class="title-div">
                <h3 id="titleDetails">THIRD TERM 2023/2024 ACADEMIC SESSION</h3>
            </div>

            <div class="top-containner-back-div">
                <div class="inner-div-cont">
                    <div class="content-div">
                        <div>
                            <div class="name">
                                <div id="fullName">MIKE AFOLABI OLUWAGBENGA</div>
                            </div>
                        </div>

                        <div class="bottom-details">
                            <div class="details">
                                <p>STUDENT ID: <span id="studentId">STUDENT00220250321124557</span></p>

                            </div>

                            <div class="details">
                                <p>CLASS: <span id="className">KINDERGARTEN - KG 1</span></p>
                            </div>

                            <div class="details">
                                <p>GENDER: <span id="genderName">MALE</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="image-div" id="studentPix">
                        <img src="<?php echo $websiteUrl ?>/uploaded_files/studentPix/default.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="inner-content">
            <div class="table-div">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <thead>
                        <tr class="tb-col table-col">
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
                        <tr class="tb-row table-row">
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

                        <tr class="tb-row table-row">
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

                        <tr class="tb-row table-row">
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

                        <tr class="tb-row table-row">
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
                        <tr class="tb-row table-row">
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

                        <tr class="tb-row table-row">
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

                        <tr class="tb-row table-row">
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

                        <tr class="tb-row table-row">
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

                        <tr class="tb-row table-row">
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

                        <tr class="tb-row table-row">
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

                        <tr class="tb-row table-row">
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

            <div class="bottom-content-back-div" id="bottomContainer">
                <div class="inner-container">
                    <div class="content-container">
                        <div class="list-content">
                            <span>NUMBER OF SUBJECTS:</span>
                            <p>20</p>
                        </div>

                        <div class="list-content">
                            <span>STUDENTS IN CLASS:</span>
                            <p>25</p>
                        </div>

                        <div class="list-content">
                            <span>MARKS OBTAINABLE:</span>
                            <p>2000</p>
                        </div>

                        <div class="list-content">
                            <span>MARKS OBTAINED:</span>
                            <p>1420.03</p>
                        </div>

                        <div class="list-content">
                            <span>PERCENTAGE:</span>
                            <p>71%</p>
                        </div>

                        <div class="list-content">
                            <span>POSITION IN CLASS:</span>
                            <p>1ST (25)</p>
                        </div>

                        <div class="list-content">
                            <span>NUMBER OF SITTING(S):</span>
                            <p>3</p>
                        </div>

                        <div class="list-content">
                            <span>1ST TERM OVERALL (%):</span>
                            <p>68.42%</p>
                        </div>

                        <div class="list-content">
                            <span>2ND TERM OVERALL (%):</span>
                            <p>70.10%</p>
                        </div>

                        <div class="list-content">
                            <span>3RD TERM OVERALL (%):</span>
                            <p>71.00%</p>
                        </div>

                        <div class="list-content">
                            <span>AVERAGE (%):</span>
                            <p>69.84%</p>
                        </div>

                        <div class="list-content">
                            <span>ANNUAL POSITION IN CLASS:</span>
                            <p>2ND</p>
                        </div>

                        <div class="list-content">
                            <span>ANNUAL OVERALL POSITION:</span>
                            <p>15TH (200)</p>
                        </div>

                        <div class="list-content">
                            <span>TIMES SCHOOL OPENED:</span>
                            <p>72</p>
                        </div>

                        <div class="list-content">
                            <span>TIMES PRESENT:</span>
                            <p>70</p>
                        </div>

                        <div class="list-content">
                            <span>TIMES ABSENT:</span>
                            <p>2</p>
                        </div>

                        <div class="list-content">
                            <span>SCHOOL REOPENS ON:</span>
                            <p>MONDAY, SEPTEMBER 9, 2025</p>
                        </div>

                        <div class="list-content">
                            <span>CLASS TEACHER'S COMMENT:</span>
                            <p>An excellent term’s work!</p>
                        </div>

                        <div class="list-content">
                            <span>PRINCIPAL'S COMMENT:</span>
                            <p>Outstanding performance.</p>
                        </div>
                    </div>

                    <div class="signature">
                        <img src="<?php echo $websiteUrl ?>/uploaded_files/branchPrincipalSignature/BRANCH001689949a80d3fd.principal_signature.png" alt="Victory Christian School Principal Signature" />
                    </div>

                </div>
            </div>
        </div>
    </section>
</body>
</html>