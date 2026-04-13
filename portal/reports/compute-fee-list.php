<?php include '../config/constants.php'; ?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl ?>/images/icon.png" rel="shortcut icon" type="image-png" />
    <link href="<?php echo $websiteUrl ?>/style/report-style.css?v=<?php echo $codeVersion ?>" type="text/css"
        rel="stylesheet" />
    <link href="<?php echo $websiteUrl ?>/style/paramount.css?v=<?php echo $codeVersion ?>" type="text/css"
        rel="stylesheet" />
    <script src="<?php echo $websiteUrl ?>/js/jquery-v3.6.1.min.js"></script>
    <script src="<?php echo $websiteUrl ?>/js/paramount.js"></script>
    <title>Compute Fee List | <?php echo $clientName ?></title>
</head>

<body>
    <script>
        printComputeFeeByClassSession = JSON.parse(sessionStorage.getItem("printComputeFeeByClassSession"));
    </script>

    <section class="body-div" id="backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat;">
        <div class="header-back-div">
            <div class="header-image">
                <img id="general" src="<?php echo $websiteUrl ?>/images/report/general.png" alt="Report Header" style="width: 100%; height: auto;"/>

                <script>
                    $(document).ready(function () {
                        const schoolHeader = printComputeFeeByClassSession?.branchData?.general;
                        const headerUrl = schoolHeader ? `${caBroadSheetHeaderPixPath}/${schoolHeader}` : `<?php echo $websiteUrl ?>/images/report/general.png`;
                        $("#general").attr("src", headerUrl).attr("alt", `${printComputeFeeByClassSession?.branchData?.branchName} Report Header`);
                        
                        const backendWatermark = printComputeFeeByClassSession?.branchData?.watermark;
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
                    $("#titleDetails").html(printComputeFeeByClassSession?.currentSession + ' - ' +
                        printComputeFeeByClassSession?.termData?.currentTerm + ' - ' +
                        printComputeFeeByClassSession?.departmentData?.departmentName + ' - ' +
                        printComputeFeeByClassSession?.classData?.className + ' FEES LIST');
                </script>
            </div>
        </div>

        <div class="inner-content">
            <div class="table-div">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                        $(document).ready(function() {
                            const printComputeFeeByClassSession = JSON.parse(sessionStorage.getItem("printComputeFeeByClassSession"));

                            let text = '';
                            let no = 0;
                            text = `
                                <thead>
                                    <tr class="tb-col">
                                        <th>SN</th>
                                        <th>CLASS</th>
                                        <th>FEES</th>
                                        <th>FEES OPTION</th>
                                        <th>AMOUNT</th>
                                    </tr>
                                </thead>`;

                            if (printComputeFeeByClassSession && printComputeFeeByClassSession.success === true) {
                                const fetchedFees = printComputeFeeByClassSession.data;
                                const currentSession = printComputeFeeByClassSession.currentSession;
                                const termName = printComputeFeeByClassSession.termData.currentTerm;
                                const departmentName = printComputeFeeByClassSession.departmentData.departmentName;
                                const className = printComputeFeeByClassSession.classData.className;

                                for (let i = 0; i < fetchedFees.length; i++) {

                                    const fetchFeesData = fetchedFees[i];
                                    const feesName = fetchFeesData.feesName;
                                    const feesOption = fetchFeesData.feesOption;
                                    const NewFeesOption = (feesOption === "TRUE") ? "MANDATORY" : "NOT MANDATORY";
                                    const feesOptionColor = (feesOption === "TRUE") ? "green-color" :
                                        "orange-color";
                                    const amount = fetchFeesData.amount;
                                    const formattedAmount = amount ? thousandSeperator(amount) : "00:00";
                                    const updatedTime = fetchFeesData.updatedTime;

                                    amount && (no++, text += `
                                        <tr class="tb-row">
                                            <td>${no}</td>
                                            <td>${className}</td>
                                            <td>${feesName}</td>
                                            <td class="${feesOptionColor}">${NewFeesOption}</td>
                                            <td><s>N</s>${formattedAmount}</td>
                                        </tr>`);
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