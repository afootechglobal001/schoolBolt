<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl?>/images/icon.png" rel="shortcut icon" type="image-png"/>
    <link href="<?php echo $websiteUrl?>/style/report-style.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
    <title>Compute Fee List | <?php echo $clientName ?></title>
</head>

<body>
    <script> printComputeFeeByClassSession = JSON.parse(sessionStorage.getItem("printComputeFeeByClassSession"));</script>

    <section class="body-div">
        <div class="header-back-div">
            <div class="header-div">
                <div class="inner-div">
                    <div class="logo-div">
                        <img src="<?php echo $websiteUrl?>/images/report/icon.png" alt="<?php echo $clientName?> Logo"/>   
                    </div> 
                    
                    <div class="text-div">
                        <h3 id="branchName"><script>$("#branchName").html(printComputeFeeByClassSession?.branchData?.branchName);</script></h3>
                        <div class="text">Address: <strong id="address"><script>$("#address").html(printComputeFeeByClassSession?.branchData?.address);</script></strong></div>
                        <div class="text">Phone: <strong id="mobileNumber"><script>$("#mobileNumber").html(printComputeFeeByClassSession?.branchData?.mobileNumber);</script></strong> | Official Email: <strong id="smtpUsername"><script>$("#smtpUsername").html(printStudentByClassSession?.branchData?.smtpUsername);</script></strong></div> 
                    </div>
                </div>
            </div>
            <div class="title-div"><span id="titleDetails">Loading...  </span>STUDENT'S LIST</div>
            <script>
                $("#titleDetails").html(printComputeFeeByClassSession?.currentSession + ' - ' +
                printComputeFeeByClassSession?.termData?.currentTerm + ' - ' +
                printComputeFeeByClassSession?.departmentData?.departmentName + ' - ' + 
                printComputeFeeByClassSession?.classData?.className);
            </script>
        </div>
    
        <div class="inner-content">
            <div class="table-div animated fadeIn">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                        $(document).ready(function() {
                            const printComputeFeeByClassSession = JSON.parse(sessionStorage.getItem("printComputeFeeByClassSession"));

                            let text = '';
                            let no=0;
                            text =`
                                <thead>
                                    <tr class="tb-col">
                                        <th>sn</th>
                                        <th>Session</th>
                                        <th>Term</th>
                                        <th>Department</th>
                                        <th>Class</th>
                                        <th>Fee Name</th>
                                        <th>Fee Option</th>
                                        <th>Amount</th>
                                        <th>updatedTime</th>
                                    </tr>
                                </thead>`;

                                if (printComputeFeeByClassSession && printComputeFeeByClassSession.success === true) {
                                    const fetchedFees = printComputeFeeByClassSession.data;
                                    const currentSession = printComputeFeeByClassSession.currentSession;
                                    const termName = printComputeFeeByClassSession.termData.currentTerm;
                                    const departmentName = printComputeFeeByClassSession.departmentData.departmentName;
                                    const className = printComputeFeeByClassSession.classData.className;

                                    for (let i = 0; i < fetchedFees.length; i++) {
                                        no++;
                                        const fetchFeesData = fetchedFees[i];
                                        const feesName = fetchFeesData.feesName;
                                        const feesOption = fetchFeesData.feesOption;
                                        const NewFeesOption = (feesOption === "TRUE") ? "MANDATORY" : "NOT MANDATORY";
	                                    const feesOptionColor = (feesOption === "TRUE") ? "green-color" : "orange-color";
                                        const amount = fetchFeesData.amount;
                                        const updatedTime = fetchFeesData.updatedTime;

                                        text +=`
                                            <tbody>
                                                <tr class="tb-row">
                                                    <td>${no}</td>
                                                    <td>${currentSession}</td>
                                                    <td>${termName}</td>
                                                    <td>${departmentName}</td>
                                                    <td>${className}</td>
                                                    <td>${feesName}</td>
                                                    <td class="${feesOptionColor}">${NewFeesOption}</td>
                                                    <td>${amount}</td>
                                                    <td>${updatedTime}</td>
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