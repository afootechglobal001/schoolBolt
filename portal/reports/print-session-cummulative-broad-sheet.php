<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl?>/images/icon.png" rel="shortcut icon" type="image-png"/>
    <link href="<?php echo $websiteUrl?>/style/report-style.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
    <title>Cumulative Broad Sheet | <?php echo $clientName ?></title>
</head>

<body>
    <script> printSessionCumulativeBroadSheetSession = JSON.parse(sessionStorage.getItem("printSessionCumulativeBroadSheetSession"));</script>

    <section class="body-div broadsheet-body" id="backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat;">
        <div class="header-back-div">
            <div class="header-image">
                <img id="cummulativeBroadsheetHeader" src="<?php echo $websiteUrl ?>/images/report/cummulative-mark-book-header.png" alt="Report Header" style="width: 100%; height: auto;"/>
            </div>
            
            <script>
                $(document).ready(function () {
                    const schoolHeader = printSessionCumulativeBroadSheetSession?.branchData?.cummulativeBroadsheetHeader;
                    const headerUrl = schoolHeader ? `${cummulativeBroadsheetHeaderPixPath}/${schoolHeader}` : `<?php echo $websiteUrl ?>/images/report/cummulative-mark-book-header.png`;
                    $("#cummulativeBroadsheetHeader").attr("src", headerUrl).attr("alt", `${printSessionCumulativeBroadSheetSession?.branchData?.branchName} Report Header`);

                    const backendWatermark = printSessionCumulativeBroadSheetSession?.branchData?.watermark;
                    const defaultWatermark = '../images/report/watermark.jpg';
                    const watermarkUrl = backendWatermark ? `${watermarkPixPath}/${backendWatermark}` : defaultWatermark;

                    $('#backgroundTable').css({
                        'background': `url(${watermarkUrl}) center no-repeat`,
                        'background-size': 'cover'
                    });
                });
            </script>
            
            <div class="title-div">
                <h3 id="titleDetails"></h3>
                <script>
                    $("#titleDetails").html(printSessionCumulativeBroadSheetSession?.session + ' - ' +
                    printSessionCumulativeBroadSheetSession?.departmentData?.departmentName + ' - ' +
                    printSessionCumulativeBroadSheetSession?.classData?.className + ' - ' +
                    printSessionCumulativeBroadSheetSession?.armData?.armName + ' - ' +
                    'ACADEMIC SESSION');
                </script>
            </div>
        </div>
    
        <div class="inner-content">
            <div class="table-div">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                        $(document).ready(function () {
                            const data = JSON.parse(sessionStorage.getItem("printSessionCumulativeBroadSheetSession"));
                            if (!data) return;

                            const studentData = data.data || [];

                            // 1) BUILD TABLE HTML
                            // ===========================================================
                            const thead = $('<thead></thead>');
                            const groupTR = $('<tr class="tb-col table-col"></tr>');
                            groupTR.append('<th></th>');
                            groupTR.append('<th></th>');
                            groupTR.append(`<th colspan="5">FIRST TERM TERMINAL RESULT</th>`);
                            groupTR.append(`<th colspan="5">SECOND TERM TERMINAL RESULT</th>`);
                            groupTR.append(`<th colspan="5">THIRD TERM TERMINAL RESULT</th>`);
                            groupTR.append(`<th colspan="9">CUMULATIVE RESULT</th>`);
                            thead.append(groupTR);

                            const tableTitles = [
                                "SN", "FULL NAME",
                                "NO. OF SUBJECT", "MARK OBTAINABLE", "MARK OBTAINED", "PERCENTAGE %", "POST. IN CLASS",
                                "NO. OF SUBJECT", "MARK OBTAINABLE", "MARK OBTAINED", "PERCENTAGE %", "POST. IN CLASS",
                                "NO. OF SUBJECT", "MARK OBTAINABLE", "MARK OBTAINED", "PERCENTAGE %", "POST. IN CLASS",
                                "NO. OF SITTING(S)", "FIRST TERM %", "SECOND TERM %", "THIRD TERM %", "AVERAGE", 
                                "AVERAGE POST. IN CLASS", "OVERALL POST.", "AVERAGE REMARK", "PROMOTION STATUS"
                            ];

                            const titleTR = $('<tr class="tb-col table-col cumulative-col"></tr>');
                            tableTitles.forEach(t => {
                                let thClass = "th-medium";
                                if (t === "SN") thClass = "th-small";
                                if (t === "FULL NAME") thClass = "th-name";
                                titleTR.append(`<th class="${thClass}">${t}</th>`);
                            });
                            thead.append(titleTR);

                            const tbody = $('<tbody></tbody>');
                            studentData.forEach((student, idx) => {
                                const tr = $('<tr class="tb-row table-row"></tr>');
                                tr.append(`<td>${idx + 1}</td>`);
                                tr.append(`<td class="name-td">${student.fullName || ""}</td>`);
                        
                                const values = [
                                    // FIRST TERM
                                    student.firstTermResult?.numberOfSubjects ?? "",
                                    student.firstTermResult?.markObtainable ?? "",
                                    student.firstTermResult?.markObtained ?? "",
                                    student.firstTermResult?.percentage ?? "",
                                    student.firstTermResult?.positionInClass ?? "",

                                    // SECOND TERM
                                    student.secondTermResult?.numberOfSubjects ?? "",
                                    student.secondTermResult?.markObtainable ?? "",
                                    student.secondTermResult?.markObtained ?? "",
                                    student.secondTermResult?.percentage ?? "",
                                    student.secondTermResult?.positionInClass ?? "",

                                    // THIRD TERM
                                    student.thirdTermResult?.numberOfSubjects ?? "",
                                    student.thirdTermResult?.markObtainable ?? "",
                                    student.thirdTermResult?.markObtained ?? "",
                                    student.thirdTermResult?.percentage ?? "",
                                    student.thirdTermResult?.positionInClass ?? "",

                                    // CUMULATIVE
                                    student.numberOfSittings ?? "",
                                    student.firstTermPercentage ?? "",
                                    student.secondTermPercentage ?? "",
                                    student.thirdTermPercentage ?? "",
                                    student.averagePercentage ?? "",
                                    student.averagePositionInClass ?? "",
                                    student.averageOverallPosition ?? "",
                                    student.averageRemark ?? "",
                                    student.promotionStatus ?? ""
                                ];

                                values.forEach(val => {
                                    tr.append(`<td>${val}</td>`);
                                });
                                tbody.append(tr);
                            });
                            $("#pageContent").empty().append(thead).append(tbody);
                        });
                    </script>
                </table>
            </div>
        </div>
    </section>
</body>
</html>