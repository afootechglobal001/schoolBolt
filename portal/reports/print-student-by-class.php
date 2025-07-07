<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="<?php echo $websiteUrl?>/images/icon.png" rel="shortcut icon" type="image-png"/>
    <link href="<?php echo $websiteUrl?>/style/report-style.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
    <title>Student List | <?php echo $clientName ?></title>
</head>

<body>
    <script> printStudentByClassSession = JSON.parse(sessionStorage.getItem("printStudentByClassSession"));</script>

    <section class="body-div">
        <div class="header-back-div">
            <div class="header-div">
                <div class="inner-div">
                    <div class="logo-div">
                        <img src="<?php echo $websiteUrl?>/images/report/icon.png" alt="<?php echo $clientName?> Logo"/>   
                    </div> 
                    
                    <div class="text-div">
                        <h3 id="branchName"><script>$("#branchName").html(printStudentByClassSession?.branchData?.branchName);</script></h3>
                        <div class="text">Address: <strong id="address"><script>$("#address").html(printStudentByClassSession?.branchData?.address);</script></strong></div>
                        <div class="text">Phone: <strong id="mobileNumber"><script>$("#mobileNumber").html(printStudentByClassSession?.branchData?.mobileNumber);</script></strong> | Official Email: <strong id="smtpUsername"><script>$("#smtpUsername").html(printStudentByClassSession?.branchData?.smtpUsername);</script></strong></div> 
                    </div>
                </div>
            </div>
            <div class="title-div"><span id="titleDetails">Loading...  </span>STUDENT'S LIST</div>
            <script>
                $("#titleDetails").html(printStudentByClassSession?.session + ' - ' +
                printStudentByClassSession?.termData?.termName + ' - ' +
                printStudentByClassSession?.departmentData?.departmentName + ' - ' + 
                printStudentByClassSession?.classData?.className + ' - ' + 
                printStudentByClassSession?.armData?.armName);
            </script>
        </div>
    
        <div class="inner-content">
            <div class="table-div animated fadeIn">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                        $(document).ready(function() {
                            const printStudentByClassSession = JSON.parse(sessionStorage.getItem("printStudentByClassSession"));
                            let text = '';
                            let no=0;
                            text =`
                                <thead>
                                    <tr class="tb-col">
                                        <th>sn</th>
                                        <th>Student Info</th>
                                        <th>Session</th>
                                        <th>Term</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <th>Accomodation</th>
                                    </tr>
                                </thead>`;

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
                                            <tbody>
                                                <tr class="tb-row">
                                                    <td>${no}</td>
                                                    <td>
                                                        <div class="text-back-div">
                                                            <div class="image-div general-passport">
                                                                <img src="${studentPixPath}/${passport}" alt="${fullname}"/>
                                                            </div>

                                                            <div class="text-div">
                                                                <div class="first-class">${fullname}</div>
                                                                <div class="second-class">${studentId}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>${session}</td>
                                                    <td>${termName}</td>
                                                    <td>${genderName}</td>
                                                    <td>${age}</td>
                                                    <td>${accommodationName}</td>
                                                </tr>                                        
                                            </tbody>`;
                                    }
                                    $('#pageContent').html(text);
                                }
                        });
                    </script>
                    
                    <script>
                        function _calculateAge(dateString) {
                            if (!dateString) return "N/A";

                            let dob;
                            if (dateString.includes("/")) {
                                let parts = dateString.split("/");
                                dob = `${parts[2]}-${parts[1]}-${parts[0]}`;
                            } else {
                                dob = dateString;
                            }

                            let birthDate = new Date(dob);
                            if (isNaN(birthDate)) return "Invalid date";

                            let today = new Date();
                            let age = today.getFullYear() - birthDate.getFullYear();

                            if (today < new Date(today.getFullYear(), birthDate.getMonth(), birthDate.getDate())) {
                                age--;
                            }
                            return age;
                        }
                    </script>
                </table>
            </div>
        </div>
    </section>
</body>
</html>