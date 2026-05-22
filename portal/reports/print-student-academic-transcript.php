<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl?>/images/icon.png" rel="shortcut icon" type="image-png"/>
    <link href="<?php echo $websiteUrl?>/style/report-style.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
    <script src="<?php echo $websiteUrl?>/js/scripts.js?v=<?php echo $codeVersion?>"></script>
    <title>Student Academic Transcript | <?php echo $clientName ?></title>
</head>

<body>
    <section class="body-div broadsheet-body" id="backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat;">
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
            <div class="table-div" id="backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat;">
                <table class="table" cellspacing="0" style="width:100%" id="reportPageContent">
                    <thead>
                        <tr class="tb-col table-col">
                            <th></th>
                            <th></th>
                            <th colspan="3">JSS 1 (2025/2026)</th>
                            <th colspan="3">JSS 2 (2025/2026)</th>
                            <th colspan="3">JSS 3 (2025/2026)</th>
                        </tr>

                        <tr class="tb-col table-col">
                            <th class="th-small">SN</th>
                            <th class="th-name">SUBJECT</th>
                            <th>FIRST TERM SCORE(100)</th>
                            <th>SECOND TERM SCORE(100)</th>
                            <th>THIRD TERM SCORE(100)</th>
                            <th>FIRST TERM SCORE(100)</th>
                            <th>SECOND TERM SCORE(100)</th>
                            <th>THIRD TERM SCORE(100)</th>
                            <th>FIRST TERM SCORE(100)</th>
                            <th>SECOND TERM SCORE(100)</th>
                            <th>THIRD TERM SCORE(100)</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="tb-row table-row">
                            <td>1</td>
                            <td class="name-td">Mathematics</td>

                            <td>65 %</td>
                            <td>70 %</td>
                            <td>75 %</td>

                            <td>75 %</td>
                            <td>80 %</td>
                            <td>85 %</td>

                            <td>75 %</td>
                            <td>80 %</td>
                            <td>85 %</td>
                        </tr>

                        <tr class="tb-row table-row">
                            <td>2</td>
                            <td class="name-td">English</td>

                            <td>60 %</td>
                            <td>68 %</td>
                            <td>72 %</td>

                            <td>70 %</td>
                            <td>78 %</td>
                            <td>82 %</td>

                            <td>75 %</td>
                            <td>80 %</td>
                            <td>85 %</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> 
    </section>
</body>
</html>