<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include '../config/constants.php'; ?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include 'meta.php' ?>
    <title>Parent Portal | <?php echo $appName; ?></title>
</head>
<script src="https://js.paystack.co/v1/inline.js"></script>
<body>
    <?php include 'header.php' ?>

    <div class="body-content-div" data-aos="fade-down" data-aos-duration="1200">
        <div class="mini-profile-div">
            <div class="profile-content">
                <span><i class="bi-speedometer2"></i> Parent Dashboard</span>
                <div class="main-profile">
                    <div class="inner-profile">
                        <div class="img-div"><img src="<?php echo $websiteUrl ?>/images/avatar.jpg" alt="Parent Profile" /></div>
                        <div class="pro-text-div">
                            <h2 id="fullName">👋 Hi, <span id="fullNameText"></span></h2>
                            <script>
                                $("#fullNameText").html(capitalizeFirstLetterOfEachWord(parentData.titleId + ' ' + parentData.surName + ' ' + parentData.otherNames));
                            </script>
                            <div class="info">
                                <div class="info-details">
                                    <p><span id="email">
                                            <script>
                                                $("#email").html(parentData.email);
                                            </script>
                                        </span></p> | <p><span id="mobileNumber">
                                            <script>
                                                $("#mobileNumber").html(parentData.mobileNumber);
                                            </script>
                                        </span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-div">
            <div class="dashboard-content">
                <h2>Student's List</h2>
                <div class="list" id="pageContent">

                    <script>
                        $(document).ready(function() {
                            let parentStudents = parentSessionData.students;
                            let content = '';
                            if (parentStudents.length > 0) {
                                for (let i = 0; i < parentStudents.length; i++) {
                                    const studentInfo = parentStudents[i];
                                    const studentId = studentInfo.studentData.studentId;
                                    const surName = studentInfo.studentData.surName;
                                    const firstName = studentInfo.studentData.firstName;
                                    const otherNames = studentInfo.studentData.otherNames;
                                    const fullname = capitalizeFirstLetterOfEachWord(surName + ' ' + firstName + ' ' + otherNames);
                                    const passport = studentInfo.studentData.passport || 'default.jpg';
                                    const className = studentInfo.classData.className;
                                    const armName = studentInfo.armData.armName;
                                    const statusName = studentInfo.studentData.statusName;

                                   content += `
                                        <div class="student-profile">
                                            <div class="details">
                                                <div class="pix">
                                                    <img src="${studentPixPath}/${passport}" alt="${fullname}" />
                                                </div>
                                                <div class="text">
                                                    <h3>${fullname}</h3>
                                                    <div class="info">
                                                        <p>Class: <span>${className}</span> - Arm: <span>${armName}</span></p>
                                                        <button class="status-btn ${statusName}">${statusName}</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn" onClick="_getFetchEachStudent('${studentId}')">VIEW DETAILS</button>
                                        </div>`;
                                }
			                    $('#pageContent').html(content);
                            }else{
                                content +=`
                                <div class="false-notification-div">
                                    <p>No Record Found!!!</p>
                                </div>`;
                                $('#pageContent').html(content);
                            }

                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <?php include '../bottom-scripts.php' ?>
    <script src="https://newwebpay.qa.interswitchng.com/inline-checkout.js"></script>
</body>

</html>