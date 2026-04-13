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

    <section class="body-div" id="backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat;">
        <div class="header-back-div">
            <div class="header-image">
                <img id="general" src="<?php echo $websiteUrl ?>/images/report/general.png" alt="Report Header" style="width: 100%; height: auto;"/>

                <script>
                    $(document).ready(function () {
                        const schoolHeader = printFeesSettingsSession?.branchData?.general;
                        const headerUrl = schoolHeader ? `${caBroadSheetHeaderPixPath}/${schoolHeader}` : `<?php echo $websiteUrl ?>/images/report/general.png`;
                        $("#general").attr("src", headerUrl).attr("alt", `${printFeesSettingsSession?.branchData?.branchName} Report Header`);

                        const backendWatermark = printFeesSettingsSession?.branchData?.watermark;
                        const defaultWatermark = '../images/report/watermark.jpg';
                        const watermarkUrl = backendWatermark ? `${watermarkPixPath}/${backendWatermark}` : defaultWatermark;

                        $('#backgroundTable').css({
                            'background': `url(${watermarkUrl}) center no-repeat`,
                            'background-size': 'cover'
                        });
                    });
                </script>
            </div>

            <div class="title-div">
                <h3 id="titleDetails"></h3>
                <script>
                    $("#titleDetails").html(printFeesSettingsSession?.branchData?.termName+ ' ' +
                        printFeesSettingsSession?.branchData?.session);
                </script>
            </div>
        </div>
    
        <div class="inner-content">
            <div class="table-div">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                        $(document).ready(function() {
                            const printFeesSettingsSession = JSON.parse(sessionStorage.getItem("printFeesSettingsSession"));

                            let text = '';
                            let no=0;
                            text =`
                                <thead>
                                    <tr class="tb-col">
                                        <th>SN</th>
                                        <th>FEES</th>
                                        <th>FEES OPTION</th>
                                    </tr>
                                </thead>
                                <tbody>`;

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
                                            <tr class="tb-row">
                                                <td>${no}</td>
                                                <td>${feesName}</td>
                                                <td class="${feesOptionColor}">${NewFeesOption}</td>
                                            </tr>`;
                                    }
                                    text += `</tbody>`;
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