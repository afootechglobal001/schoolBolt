<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl?>/images/icon.png" rel="shortcut icon" type="image-png"/>
    <link href="<?php echo $websiteUrl?>/style/report-style.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
    <script src="<?php echo $websiteUrl?>/js/scripts.js?v=<?php echo $codeVersion?>"></script>
    <title>Student List | <?php echo $clientName ?></title>
</head>

<body>
    <script> printStudentByClassSession = JSON.parse(sessionStorage.getItem("printStudentByClassSession"));</script>

    <section class="body-div" id="backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat;">
        <div class="header-back-div">
            <div class="header-image">
                <img id="studentListHeader" src="<?php echo $websiteUrl ?>/images/report/student-list-header.png" alt="Report Header" style="width: 100%; height: auto;"/>

                <script>
                    $(document).ready(function () {
                        const schoolHeader = printStudentByClassSession?.branchData?.studentListHeader;
                        const headerUrl = schoolHeader ? `${studentListHeaderPixPath}/${schoolHeader}` : `<?php echo $websiteUrl ?>/images/report/student-list-header.png`;
                        $("#studentListHeader").attr("src", headerUrl).attr("alt", `${printStudentByClassSession?.branchData?.branchName} Report Header`);

                        const backendWatermark = printStudentByClassSession?.branchData?.watermark;
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
                    $("#titleDetails").html(printStudentByClassSession?.session + ' - ' +
                    printStudentByClassSession?.termData?.termName + ' - ' +
                    printStudentByClassSession?.departmentData?.departmentName + ' - ' + 
                    printStudentByClassSession?.classData?.className + ' - ' + 
                   printStudentByClassSession?.armData?.armName);
                </script>
            </div>
        </div>

        <div class="inner-content">
            <div class="table-div">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                        $(document).ready(function() {
                            const printStudentByClassSession = JSON.parse(sessionStorage.getItem("printStudentByClassSession"));

                            let text = '';
                            let no=0;
                            text =`
                                <thead>
                                    <tr class="tb-col">
                                        <th>SN</th>
                                        <th>STUDENT INFO</th>
                                        <th>SESSION</th>
                                        <th>TERM</th>
                                        <th>GENDER</th>
                                        <th>AGE</th>
                                        <th>ACCOMODATION</th>
                                    </tr>
                                </thead>
                                <tbody>`;

                                if (printStudentByClassSession && printStudentByClassSession.success === true) {
                                    const students = printStudentByClassSession.data;
                                    const session = printStudentByClassSession.session;
                                    const termName = printStudentByClassSession.termData.termName;

                                    for (let i = 0; i < students.length; i++) {
                                        no++;

                                        const fetchStudentData = students[i].studentData;
                                        const fetchAccommodationData=students[i].accommodationData; 
                                        
                                        const studentId = fetchStudentData.studentId;
                                        const passport = fetchStudentData.passport || 'default.jpg';
                                        const surName = fetchStudentData.surName;
                                        const firstName = fetchStudentData.firstName;
                                        const otherNames = fetchStudentData.otherNames;
                                        const fullname = surName+ ' ' +firstName+ ' ' +otherNames;
                                        const genderName = fetchStudentData.genderName;
                                        const accommodationName = fetchAccommodationData.accommodationName;
                                        const age = _calculateAge(fetchStudentData.dateOfBirth);

                                        text +=`
                                            <tr class="tb-row">
                                                <td>${no}</td>
                                                <td>
                                                    <div class="text-back-div">
                                                        <div class="image-div general-passport">
                                                            <img src="${studentPixPath}/${passport}" alt="${fullname}"/>
                                                        </div>

                                                        <div class="text-div">
                                                            <div class="bold-font">${fullname}</div>
                                                            <div><span>${studentId}</span></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>${session}</td>
                                                <td>${termName}</td>
                                                <td>${genderName}</td>
                                                <td>${age}</td>
                                                <td>${accommodationName}</td>
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