<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl?>/images/icon.png" rel="shortcut icon" type="image-png"/>
    <link href="<?php echo $websiteUrl?>/style/report-style.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
    <script src="<?php echo $websiteUrl?>/js/paramount.js"></script>
    <title>Fees Settings List | <?php echo $clientName ?></title>
</head>

<body>
    <script> printFeesSettingsSession = JSON.parse(sessionStorage.getItem("printFeesSettingsSession"));</script>

    <section class="body-div">
        <div class="header-back-div">
            <div class="header-div">
                <div class="inner-div">
                    <div class="logo-div">
                        <img id="profileSchoolLogoImg" src="<?php echo $websiteUrl?>/images/report/icon.png" alt="<?php echo $clientName?> Logo"/>   
                    </div> 

                    <script>
                        $(document).ready(function () {
                            const schoolLogo = printFeesSettingsSession?.branchData?.schoolLogo;
                            const logoUrl = schoolLogo ? `${schoolLogoPixPath}/${schoolLogo}` : "<?php echo $websiteUrl ?>/images/report/icon.png";

                            $("#profileSchoolLogoImg").attr("src", logoUrl).attr("alt", printFeesSettingsSession?.branchData?.branchName + " Logo");
                        });
                    </script>
                    
                    <div class="text-div">
                        <h3 id="branchName"><script>$("#branchName").html(printFeesSettingsSession?.branchData?.branchName);</script></h3>
                        <div class="text">Address: <strong id="address"><script>$("#address").html(printFeesSettingsSession?.branchData?.address);</script></strong></div>
                        <div class="text">Phone: <strong id="mobileNumber"><script>$("#mobileNumber").html(printFeesSettingsSession?.branchData?.mobileNumber);</script></strong> | Official Email: <strong id="smtpUsername"><script>$("#smtpUsername").html(printFeesSettingsSession?.branchData?.supportEmail);</script></strong></div> 
                    </div>
                </div>
            </div>
            <div class="title-div"><span id="titleDetails">Loading...  </span>FEES LIST</div>
            <script>
                $("#titleDetails").html(printFeesSettingsSession?.branchData?.session + ' - ' +
                printFeesSettingsSession?.branchData?.termName);
            </script>
        </div>
    
        <div class="inner-content">
            <div class="table-div animated fadeIn">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                        $(document).ready(function() {
                            const printFeesSettingsSession = JSON.parse(sessionStorage.getItem("printFeesSettingsSession"));

                            let text = '';
                            let no=0;
                            text =`
                                <thead>
                                    <tr class="tb-col">
                                        <th>sn</th>
                                        <th>Fees</th>
                                        <th>Fee Option</th>
                                    </tr>
                                </thead>`;

                                if (printFeesSettingsSession && printFeesSettingsSession.success === true) {
                                    const fetchedFees = printFeesSettingsSession.data;

                                    for (let i = 0; i < fetchedFees.length; i++) {
                                        no++;
                                        const fetchFeesData = fetchedFees[i];
                                        const feesName = fetchFeesData.feesName;
                                        const feesOption = fetchFeesData.feesOption;
                                        const NewFeesOption = (feesOption === "TRUE") ? "MANDATORY" : "NOT MANDATORY";
	                                    const feesOptionColor = (feesOption === "TRUE") ? "green-color" : "orange-color";

                                        text +=`
                                            <tbody>
                                                <tr class="tb-row">
                                                    <td>${no}</td>
                                                    <td>${feesName}</td>
                                                    <td class="${feesOptionColor}">${NewFeesOption}</td>
                                                </tr>                                        
                                            </tbody>`;
                                    }
                                    $('#pageContent').html(text);
                                }
                        });
                    </script>
                </table>
            </div>
        </div>
    </section>
</body>
</html>