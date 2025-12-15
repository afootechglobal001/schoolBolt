<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl ?>/images/icon.png" rel="shortcut icon" type="image-png" />
    <link href="<?php echo $websiteUrl ?>/style/report-style.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl ?>/style/paramount.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl ?>/js/jquery-v3.6.1.min.js"></script>
    <script src="<?php echo $websiteUrl ?>/js/scripts.js?v=<?php echo $codeVersion ?>"></script>
    <title>Staff List | <?php echo $clientName ?></title>
</head>

<body>
    <script>
        printStaffBySubjectSession = JSON.parse(sessionStorage.getItem("printStaffBySubjectSession"));
    </script>

    <section class="body-div" id="backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat;">
        <div class="header-back-div">
            <div class="header-image">
                <img id="classListHeader" src="<?php echo $websiteUrl ?>/images/report/general.png"
                    alt="Report Header" style="width: 100%; height: auto;" />

                <script>
                    $(document).ready(function() {
                        const printStaffBySubjectSession = JSON.parse(sessionStorage.getItem("printStaffBySubjectSession"));
                        const schoolHeader = printStaffBySubjectSession?.branchData?.classListHeader;
                        const headerUrl = schoolHeader ?
                            `${studentListHeaderPixPath}/${schoolHeader}` :
                            `<?php echo $websiteUrl ?>/images/report/general.png`;
                        $("#classListHeader")
                            .attr("src", headerUrl)
                            .attr("alt", `${printStaffBySubjectSession?.branchData?.branchName} Report Header`);

                        const backendWatermark = printStaffBySubjectSession?.branchData?.watermark;
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
                <h3>SUBJECT TEACHERS'S LIST</h3>
            </div>
        </div>

        <div class="inner-content">
            <div class="table-div" id="backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat;">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent"></table>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                const printStaffBySubjectSession = JSON.parse(sessionStorage.getItem("printStaffBySubjectSession"));
                
                if (printStaffBySubjectSession && printStaffBySubjectSession.success === true) {
                    const fetch = printStaffBySubjectSession;
                    const data = fetch.data;

                    let html = `
                        <thead>
                            <tr class="tb-col table-col">
                                <th>SN</th>
                                <th>SESSION</th>
                                <th>TERM</th>
                                <th>DEPARTMENT</th>
                                <th>CLASS</th>
                                <th>ARM</th>
                                <th>SUBJECT</th>
                                <th>SUBJECT TEACHER</th>
                            </tr>
                        </thead>
                        <tbody>`;

                    let sn = 0;
                    const session = fetch.session;
                    const termName = fetch.termData?.termName;
                    const departmentName = fetch.departmentData?.departmentName;
                    const className = fetch.classData?.className;
                    const armName = fetch.armData?.armName;

                    if (Array.isArray(data) && data.length > 0) {
                        data.forEach(item => {
                            sn++;
                            const subjectName = item.subjectData?.subjectName;
                            const teacherData = item.teacherData;

                            html += `
                            <tr class="tb-row table-row">
                            <td>${sn}</td>
                            <td>${session}</td>
                            <td>${termName}</td>
                            <td>${departmentName}</td>
                            <td>${className}</td>
                            <td>${armName}</td>
                            <td>${subjectName}</td>`;

                            if (teacherData && typeof teacherData === "object") {
                                const fullname = teacherData.fullname;
                                const emailAddress = teacherData.emailAddress;
                                const profilePix = teacherData.profilePix ? teacherData.profilePix : "default.jpg";

                                html += `
                                    <td>
                                        <div class="text-back-div">
                                            <div class="image-div general-passport">
                                                <img src="${websiteUrl}/uploaded_files/staffPix/${profilePix}" alt="${fullname}" />
                                            </div>
                                            <div class="text-div">
                                                <div class="first-class">${fullname}</div>
                                                <div class="second-class">${emailAddress}</div>
                                            </div>
                                        </div>
                                    </td>`;
                            } else {
                                html += `<td>No Teacher Assigned</td>`;
                            }

                            html += `</tr>`;
                        });
                    } else {
                    html += `
                    <tr>
                        <td colspan="7" style="text-align:center;">No data available</td>
                    </tr>`;
                }
                    html += `</tbody>`;
                    $('#pageContent').html(html);
                }
            });
        </script>
    </section>
</body>
</html>