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
    <script> windowBranchStudentsSession = JSON.parse(sessionStorage.getItem("windowBranchStudentsSession"));</script>

    <section class="body-div">
        <div class="header-back-div">
            <div class="header-div">
                <div class="inner-div">
                    <div class="logo-div">
                        <img src="<?php echo $websiteUrl?>/images/report/logo.png" alt="<?php echo $clientName?> Logo"/>   
                    </div> 
                    
                    <div class="text-div">
                        <h3>ARRAHMAN MONTESSORI SCHOOL, KETU LAGOS</h3>
                        <div class="text">Address: <strong>8, Abaren Close, Off Loveall Ikosi, Ketu, Lagos</strong></div>
                        <div class="text">Phone: <strong>08050202261</strong> | Official Email: <strong>AMS-ketu@arrahmanmontessori.com</strong></div> 
                    </div>
                </div>
            </div>
            <div class="title-div"><span id="titleDetails">Loading...  </span>STUDENTS LIST</div>
            <script>
                $("#titleDetails").html(windowBranchStudentsSession?.departmentData?.departmentName + ' ' + 
                windowBranchStudentsSession?.classData?.className + ' ' + 
                windowBranchStudentsSession?.armData?.armName);
            </script>
        </div>
    
        <div class="inner-content">
            <div class="table-div animated fadeIn">
                <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                    <script>
                         $(document).ready(function() {
                        var windowBranchStudentsSession = JSON.parse(sessionStorage.getItem("windowBranchStudentsSession"));
                        let text = '';
                        let no=0;
                        text =`
                            <thead>
                                <tr class="tb-col">
                                    <th>sn</th>
                                    <th>Student Info</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Accomodation</th>
                                </tr>
                            </thead>`;

                            if (windowBranchStudentsSession && windowBranchStudentsSession.success === true) {
                                const fetch = windowBranchStudentsSession.data;
                                const students = windowBranchStudentsSession.data;

                                for (let i = 0; i < students.length; i++) {
                                    no++;

                                    const fetchStudentData = students[i].studentData?.[0];
                                    const fetchAccommodationData=students[i].accommodationData?.[0]; 
                                    
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