<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl?>/images/icon.png" rel="shortcut icon" type="image-png"/>
    <link href="<?php echo $websiteUrl?>/style/report-style.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
    <title>Terminal Result Summary | <?php echo $clientName ?></title>
</head>

<body>
    <script> printAssessmentSession = JSON.parse(sessionStorage.getItem("printAssessmentSession"));</script>

    <section class="body-div terminal-body">
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
            <div class="title-div"><span id="titleDetails">2023/2024</span> - <span id="">THIRD TERM</span> - <span id="">KINDERGARTEN</span> - <span id="">KG 1 A</span> TERMINAL RESULT SUMMARY</div>
        </div>
    
        <div class="inner-content">
            <div class="table-div computation-table animated fadeIn">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <thead>
                        <tr class="tb-col">
                            <th class="font">sn</th>
                            <th class="font">Full Name</th>
                            <th class="font">No. Of Subjects</th>
                            <th class="font">Mark Obtainable (%)</th>
                            <th class="font">Mark Obtained (%)</th>
                            <th class="font">Total Percentage</th>
                            <th class="font">Postn. In Class</th>
                            <th class="font">Overall Position</th>
                            <th class="font">Teacher's Comment</th>
                            <th class="font">Remark</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="tb-row report-tb-row">
                            <td class="td">1</td>
                            <td class="td">AFOLABI MIKE OLUWAGBENGA</td>
                            <td class="td">20</td>
                            <td class="td">2000</td>
                            <td class="td">1273.34</td>
                            <td class="td">63.67%</td>
                            <td class="td">7TH(7)</td>
                            <td class="td">48TH(165)</td>
                            <td class="td">GOOD RESULT</td>
                            <td class="td">GOOD</td>
                        </tr>  
                        
                        <tr class="tb-row report-tb-row">
                            <td class="td">2</td>
                            <td class="td">AFOLABI MIKE OLUWAGBENGA</td>
                            <td class="td">20</td>
                            <td class="td">2000</td>
                            <td class="td">1273.34</td>
                            <td class="td">63.67%</td>
                            <td class="td">7TH(7)</td>
                            <td class="td">48TH(165)</td>
                            <td class="td">GOOD RESULT</td>
                            <td class="td">GOOD</td>
                        </tr>  

                        <tr class="tb-row report-tb-row">
                            <td class="td">3</td>
                            <td class="td">AFOLABI MIKE OLUWAGBENGA</td>
                            <td class="td">20</td>
                            <td class="td">2000</td>
                            <td class="td">1273.34</td>
                            <td class="td">63.67%</td>
                            <td class="td">7TH(7)</td>
                            <td class="td">48TH(165)</td>
                            <td class="td">GOOD RESULT</td>
                            <td class="td">GOOD</td>
                        </tr>  

                        <tr class="tb-row report-tb-row">
                            <td class="td">4</td>
                            <td class="td">AFOLABI MIKE OLUWAGBENGA</td>
                            <td class="td">20</td>
                            <td class="td">2000</td>
                            <td class="td">1273.34</td>
                            <td class="td">63.67%</td>
                            <td class="td">7TH(7)</td>
                            <td class="td">48TH(165)</td>
                            <td class="td">GOOD RESULT</td>
                            <td class="td">GOOD</td>
                        </tr>  
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
</html>