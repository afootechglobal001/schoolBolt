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
        printStaffByClassSession = JSON.parse(sessionStorage.getItem("printStaffByClassSession"));
    </script>

    <section class="body-div" id="backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat;">
        <div class="header-back-div">
            <div class="header-image">
                <img id="classListHeader" src="<?php echo $websiteUrl ?>/images/report/general.png"
                    alt="Report Header" style="width: 100%; height: auto;" />

                <script>
                    $(document).ready(function() {
                        const printStaffByClassSession = JSON.parse(sessionStorage.getItem("printStaffByClassSession"));
                        const schoolHeader = printStaffByClassSession?.branchData?.classListHeader;
                        const headerUrl = schoolHeader ?
                            `${studentListHeaderPixPath}/${schoolHeader}` :
                            `<?php echo $websiteUrl ?>/images/report/general.png`;
                        $("#classListHeader")
                            .attr("src", headerUrl)
                            .attr("alt", `${printStaffByClassSession?.branchData?.branchName} Report Header`);

                        const backendWatermark = printStaffByClassSession?.branchData?.watermark;
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
                <h3>CLASS TEACHERS'S LIST</h3>
            </div>
        </div>

        <div class="inner-content">
            <div class="table-div" id="backgroundTable" style="background: url(../images/report/watermark.jpg) center no-repeat;">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent"></table>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                const printStaffByClassSession = JSON.parse(sessionStorage.getItem("printStaffByClassSession"));
                
                if (printStaffByClassSession && printStaffByClassSession.success === true) {
                    const data = printStaffByClassSession.data;
                    let html = `
                    <thead>
                        <tr class="tb-col">
                        <th>SN</th>
                        <th>DEPARTMENT</th>
                        <th>CLASS</th>
                        <th>TEACHER</th>
                        </tr>
                    </thead>
                    <tbody>`;

                    let sn = 0;

                    data.forEach(department => {
                        const departmentName = department.departmentData.departmentName;

                        if (department.classData && department.classData.length > 0) {
                            department.classData.forEach(classItem => {
                                const className = classItem.className;
                                const classId = classItem.classId;

                                if (classItem.armData && classItem.armData.length > 0) {
                                    classItem.armData.forEach(armItem => {
                                        sn++;
                                        const arm = armItem.armName;
                                        const armId = armItem.armId;
                                        const teacherData = armItem.teacherData;

                                        html += `
                                            <tr class="tb-row">
                                            <td>${sn}</td>
                                            <td>${departmentName}</td>
                                            <td>${className} ${arm}</td>`;

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
                                    sn++;
                                    html += `
                                    <tr class="tb-row">
                                        <td>${sn}</td>
                                        <td>${departmentName}</td>
                                        <td>${className} (No Arm)</td>
                                        <td colspan="2">No Teacher Assigned</td>
                                    </tr>`;
                                }
                            });
                        }
                    });

                    html += `</tbody>`;
                    $('#pageContent').html(html);
                }
            });
        </script>
    </section>
</body>
</html>