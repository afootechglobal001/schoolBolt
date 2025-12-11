<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl ?>/images/icon.png" rel="shortcut icon" type="image-png" />
    <link href="<?php echo $websiteUrl ?>/style/report-style.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl ?>/style/paramount.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl ?>/js/jquery-v3.6.1.min.js"></script>
    <title>Score Sheet| <?php echo $clientName ?></title>
</head>

<body>
    <script> printStudentScoreSheetSession = JSON.parse(sessionStorage.getItem("printStudentScoreSheetSession"));</script>

    <section class="body-div" id="backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat;">
        <div class="header-back-div">
            <div class="header-image">
                <img id="scoreSheetHeader" src="<?php echo $websiteUrl ?>/images/report/score-sheet-header.png" alt="Report Header" style="width: 100%; height: auto;"/>

                <script>
                    $(document).ready(function () {
                        const schoolHeader = printStudentScoreSheetSession?.branchData?.scoreSheetHeader;
                        const headerUrl = schoolHeader ? `${scoreSheetHeaderPixPath}/${schoolHeader}` : `<?php echo $websiteUrl ?>/images/report/score-sheet-header.png`;
                        $("#scoreSheetHeader").attr("src", headerUrl).attr("alt", `${printStudentScoreSheetSession?.branchData?.branchName} Report Header`);
                    
                        const backendWatermark = printStudentScoreSheetSession?.branchData?.watermark;
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
                    $("#titleDetails").html(printStudentScoreSheetSession?.session + ' - ' +
                    printStudentScoreSheetSession?.termData?.termName + ' - ' +
                    printStudentScoreSheetSession?.departmentData?.departmentName + ' - ' +
                    printStudentScoreSheetSession?.classData?.className + ' - ' +
                    printStudentScoreSheetSession?.armData?.armName + ' - ' +
                    printStudentScoreSheetSession?.subjectData?.subjectName);
                </script>
            </div>
        </div>

        <div class="inner-content">
            <div class="table-div">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                        $(document).ready(function () {
                            const printStudentScoreSheetSession = JSON.parse(sessionStorage.getItem("printStudentScoreSheetSession"));

                            if (!printStudentScoreSheetSession) return;
                            
                            const tableTitles = printStudentScoreSheetSession.tableTitles.split(',').map(title => title.trim());
                            const students = printStudentScoreSheetSession.studentsData;

                            if (!Array.isArray(students) || students.length === 0) {
                                $('#pageContent').html('<tr><td colspan="100%">No data available.</td></tr>');
                                return;
                            }

                            const thead = $('<thead></thead>');
                            const headerRow = $('<tr class="tb-col table-col"></tr>');

                            tableTitles.forEach(title => {
                                headerRow.append($('<th></th>').text(title));
                            });

                            thead.append(headerRow);

                            const tbody = $('<tbody></tbody>');

                            students.forEach((student, index) => {
                                const row = $('<tr class="tb-row table-row"></tr>');
                                const fullName = `${student.surName} ${student.firstName} ${student.otherNames || ''}`.trim();

                                row.append($('<td></td>').text(index + 1)); // SN
                                row.append($('<td></td>').text(fullName));  // Full Name

                                for (let i = 2; i < tableTitles.length; i++) {
                                    row.append($('<td></td>').text('')); // Empty cells
                                }

                                tbody.append(row);
                            });

                            for (let j = 0; j < 3; j++) {
                                const emptyRow = $('<tr class="tb-row"></tr>');
                                for (let i = 0; i < tableTitles.length; i++) {
                                    emptyRow.append($('<td></td>').text(''));
                                }
                                tbody.append(emptyRow);
                            }
                            $('#pageContent').empty().append(thead).append(tbody);
                        });
                    </script>
                </table>
            </div>
        </div>
    </section>
</body>

</html>