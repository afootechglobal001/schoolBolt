<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl ?>/images/icon.png" rel="shortcut icon" type="image-png" />
    <link href="<?php echo $websiteUrl ?>/style/payment-reciept-style.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl ?>/style/paramount.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl ?>/js/jquery-v3.6.1.min.js"></script>
    <script src="<?php echo $websiteUrl ?>/js/paramount.js"></script>
    <title>Payment Receipt| <?php echo $clientName ?></title>
</head>

<body class="receipt-body">
    <script> printGeneralPaymentRecieptBreakdownSession = JSON.parse(sessionStorage.getItem("printGeneralPaymentRecieptBreakdownSession"));</script>

    <div class="receipt-container">
    <h1>PAYMENT RECEIPT</h1>

    <div class="section">
        <h2>BRANCH INFORMATION</h2>
        <div class="details-cont">
            <div class="details">
                <div>Branch Name:</div> 
                <span id="branchName"><script>
                    $("#branchName").html(printGeneralPaymentRecieptBreakdownSession?.branchData?.branchName);
                </script></span>
            </div>
            <div class="details">
                <div>Branch Mobile:</div> 
                <span id="branchMobile"><script>
                    $("#branchMobile").html(printGeneralPaymentRecieptBreakdownSession?.branchData?.mobileNumber);
                </script></span>
            </div>
        </div>
    </div>
    
    <div class="section" id="parentSection">
    <h2>PARENT INFORMATION</h2>
    <div class="details-cont">
        <div class="details">
            <div>Parent Full Name:</div> 
            <span id="parentName">
                <script>
                    $("#parentName").html(
                        capitalizeFirstLetterOfEachWord(
                            (printGeneralPaymentRecieptBreakdownSession?.parentData?.titleId ?? '') + ' ' +
                            (printGeneralPaymentRecieptBreakdownSession?.parentData?.surName ?? '') + ' ' +
                            (printGeneralPaymentRecieptBreakdownSession?.parentData?.otherNames ?? '')
                        )
                    );
                </script>
            </span>
        </div>

        <div class="details">
            <div>Parent Email:</div> 
            <span id="parentEmail">
                <script>
                    $("#parentEmail").html(printGeneralPaymentRecieptBreakdownSession?.parentData?.email);
                </script>
            </span>
        </div>

        <div class="details">
            <div>Relationship:</div> 
            <span id="relationship">
                <script>
                    $("#relationship").html(printGeneralPaymentRecieptBreakdownSession?.parentData?.relationship);
                </script>
            </span>
        </div>
    </div>
</div>

    <div class="section">
        <h2>STUDENT INFORMATION</h2>
        <div class="details-cont">
            <div class="details">
                <div>Student Full Name:</div> 
                    <span id="studentFullName">
                        <script>
                            $("#studentFullName").html(capitalizeFirstLetterOfEachWord(printGeneralPaymentRecieptBreakdownSession?.studentData?.surName + ' ' + printGeneralPaymentRecieptBreakdownSession?.studentData?.firstName + ' ' + printGeneralPaymentRecieptBreakdownSession?.studentData?.otherNames));
                        </script>
                    </span>
                </div>
            <div class="details">
                <div>Student Id:</div> 
                <span id="studentId">
                    <script>
                        $("#studentId").html(printGeneralPaymentRecieptBreakdownSession?.studentData?.studentId);
                    </script>
                </span>
            </div>
            <div class="details">
                <div>Session:</div> 
                <span id="sessionName">
                    <script>
                        $("#sessionName").html(printGeneralPaymentRecieptBreakdownSession?.session);
                    </script>
                </span>
            </div>
            <div class="details">
                <div>Term:</div> 
                <span id="termName"><script>
                        $("#termName").html(printGeneralPaymentRecieptBreakdownSession?.termData?.termName);
                    </script></span>
            </div>
            <div class="details">
                <div>Department:</div> 
                <span id="departmentName"><script>
                        $("#departmentName").html(printGeneralPaymentRecieptBreakdownSession?.departmentData?.departmentName);
                    </script></span>
            </div>
            <div class="details">
                <div>Class and Arm:</div> 
                <span id="classInfo">
                    <script>
                        $("#classInfo").html(printGeneralPaymentRecieptBreakdownSession?.classData?.className + ' ' + printGeneralPaymentRecieptBreakdownSession?.armData?.armName);
                    </script>
                </span>
            </div>
        </div> 
    </div>
    
    <div class="section">
        <h2>PAYMENT INFORMATION</h2>
        <div class="details-cont">
            <div class="details">
                <div>Payment ID:</div>
                <span id="paymentId2">
                    <script>
                        $("#paymentId2").html(printGeneralPaymentRecieptBreakdownSession?.paymentId);
                    </script>
                </span>
            </div>

            <div class="details">
                <div>Payment Method:</div>
                <span id="paymentMethodName2">
                    <script>
                        $("#paymentMethodName2").html(printGeneralPaymentRecieptBreakdownSession?.paymentMethodData?.paymentMethodName);
                    </script>
                </span>
            </div>

            <div class="details">
                <div>Payment Status:</div>
                <strong id="statusName2" style="color: green;">
                    <script>
                        const status = printGeneralPaymentRecieptBreakdownSession?.statusData?.statusName;

                        let color = "red";

                        if (status === "SUCCESSFUL") {
                            color = "green";
                        } else if (status === "PENDING") {
                            color = "orange";
                        }
                        $("#statusName2")
                            .html(status)
                            .css("color", color);
                    </script>
                </strong>
            </div>

            <div class="details">
                <div>Date Initiated:</div>
                <span id="createdTime2">
                    <script>
                        $("#createdTime2").html(printGeneralPaymentRecieptBreakdownSession?.createdTime);
                    </script>
                </span>
            </div>

            <div class="details">
                <div>Date Confirmed:</div>
                <span id="payDate2">
                    <script>
                        $("#payDate2").html(printGeneralPaymentRecieptBreakdownSession?.payDate);
                    </script>
                </span>
            </div>
        </div>
    </div>
    
    <div class="section">
        <h2>FEES BREAKDOWN</h2>
        <div class="reciept-table">
            <table cellspacing="0" style="width:100%" id="recieptContent">
                <script>
                    $(document).ready(function () {
                        const printGeneralPaymentRecieptBreakdownSession = JSON.parse(sessionStorage.getItem("printGeneralPaymentRecieptBreakdownSession"));
                        const fetchedFees = printGeneralPaymentRecieptBreakdownSession?.paymentBreakdownData;
                        const totalFeesPaid = printGeneralPaymentRecieptBreakdownSession?.totalFeesPaid

                        let text = '';
                        let no = 0;
                        content = `
                            <thead>
                                <tr>
                                <th>Fee Name</th>
                                <th>Amount</th>
                                </tr>
                            </thead>`;

                        for (let i = 0; i < fetchedFees.length; i++) {
                            const fetchFeesData = fetchedFees[i];
                            const feesName = fetchFeesData.feesName;
                            const amount = thousandSeperator(fetchFeesData.amount);

                            content += `
                                <tr>
                                    <td>${feesName}</td>
                                    <td><s>N</s>${amount}</td>
                                </tr>
                            `;
                        }

                        content += `
                            <tr class="total">
                                <td class="total-td"><strong>TOTAL AMOUNT PAID:</strong></td>
                                <td class="total-td"><strong><s>N</s>${thousandSeperator(totalFeesPaid)}</strong></td>
                            </tr>
                        `;
                        content += `</tbody>`;
                        $('#recieptContent').html(content);
                    });
                </script>
            </table>
        </div>
    </div>
    
    <div class="disclaimer">
        This receipt serves as proof of payment.
    </div>
    </div>
</body>
</html>