<?php if ($page == 'studentProfile') { ?>
    <script> getEachStudentSession = JSON.parse(sessionStorage.getItem("getEachStudentSession"));</script>
    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="top-panel-div">
            <div class="inner-top">
                <span><i class="bi-person-check-fill"></i> STUDENT DETAILS</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="profile-content-div">
            <div class="bg-img" id="profileTitle">
                <div class="mini-profile">
                    <label>
                        <div class="img-div" id="headerImage">
                            <script>$("#headerImage").html('<img src="'+websiteUrl+'/uploaded_files/studentPix/'+getEachStudentSession.studentData.passport+'" alt="'+getEachStudentSession.studentData.surName+'"/>');</script>
                        </div>
                    </label>

                    <div class="text-back-div">
                        <div class="inner-text">
                            <div class="text-div">
                                <div class="name" id="headerSurname">
                                    <script>$("#headerSurname").html(capitalizeFirstLetterOfEachWord(getEachStudentSession.studentData.surName+' '+getEachStudentSession.studentData.firstName +' '+getEachStudentSession.studentData.otherNames));</script>
                                </div>

                                <div class="text">
                                    ID:<strong id="headerStudentId"><script>$("#headerStudentId").html(getEachStudentSession.studentId);</script></strong> | 
                                    <strong id="headerClass">
                                        <script>$("#headerClass").html(getEachStudentSession.departmentData.departmentName+' - '+getEachStudentSession.classData.className+' '+getEachStudentSession.armData.armName);</script>
                                    </strong>
                                    <div id="headerStatus">
                                         <script>$("#headerStatus").html('<div id="statusBtn" class="status-btn '+getEachStudentSession.studentData.statusName+'"><span>'+getEachStudentSession.studentData.statusName+'</span></div>')</script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-div">
                <div class="div-in">
                    <ul>
                        <li class="active" title="Dashboard" id="dashboard" onclick=" _getActiveStudentPage({divid: 'studentDashbaord', page: 'studentDashbaord', url: parentPortalLocalUrl});"><i class="bi-speedometer2"></i> Dashboard</li>
                        <li title="Pay Fees" id="payFees" onclick=""><i class="bi-mortarboard"></i> Pay Fees</li>
                        <!-- <li title="Attendance" id="attendance" onclick=""><i class="bi-person-bounding-box"></i> Attendance</li>
                        <li title="Time Table" id="timeTable" onclick=""><i class="bi-bell"></i> Time Table</li>
                        <li title="Print Result" id="printResult" onclick=""><i class="bi-bell"></i> Print Result</li>
                        <li title="Assignment" id="assignment" onclick=""><i class="bi-bell"></i> Assignment</li> -->
                    </ul>
                </div>
            </div>

            <div class="field-back-div">
                <div class="field-inner-div" id="getStudentDetails">
                    <script>
                        _getActiveStudentPage({
                            divid: 'studentDashbaord',
                            page: 'studentDashbaord',
                            url: parentPortalLocalUrl
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
<?php } ?>



<!-- For Student Modal Pages -->
<?php if ($page == 'studentDashbaord') { ?>
    <script> getEachStudentSession = JSON.parse(sessionStorage.getItem("getEachStudentSession"));</script>
    <div class="detail-container">  
        <div class="profile-details">
            <div class="title">
                <i class="bi-person-lines-fill"></i>
                <span>STUDENT DETAILS</span>
            </div>

            <div class="details-div" id="student-details">
                <div class="details"><span>STUDENT ID</span>
                    <div id="studentId"><script>$("#studentId").html(getEachStudentSession.studentData.studentId);</script></div>
                </div>

                <div class="details"><span>FULLNAME</span>
                    <div id="fullName"><script>$("#fullName").html(capitalizeFirstLetterOfEachWord(getEachStudentSession.studentData.surName+' '+getEachStudentSession.studentData.firstName +' '+getEachStudentSession.studentData.otherNames));</script></div>
                </div>

                <div class="details"><span>CURRENT CLASS</span>
                    <div id="className"><script>$("#className").html(getEachStudentSession.classData.className);</script></div>
                </div>

                <div class="details"><span>DATE OF BIRTH</span>
                    <div id="dateOfBirth"><script>$("#dateOfBirth").html(getEachStudentSession.studentData.dateOfBirth);</script></div>
                </div>

                <div class="details"><span>GENDER</span>
                    <div id="genderName"><script>$("#genderName").html(getEachStudentSession.studentData.genderName);</script></div>
                </div>

                <div class="details"><span>STUDENT CATEGORY</span>
                    <div id="accommodationId"><script>$("#accommodationId").html(getEachStudentSession.studentData.accommodationId);</script></div>
                </div>

                <div class="details"><span>ADDRESS</span>
                    <div id="address"><script>$("#address").html(getEachStudentSession.studentData.address);</script></div>
                </div>

                <div class="details"><span>DATE OF REGISTRATION</span>
                    <div id="createdTime"><script>$("#createdTime").html(getEachStudentSession.studentData.createdTime);</script></div>
                </div>
            </div>
        </div>

        <div class="profile-details">
            <div class="title">
                <i class="bi-person-lines-fill"></i>
                <span>SCHOOL DETAILS</span>
            </div>

            <div class="details-div" id="student-details">
                <div class="details"><span>SCHOOL NAME</span>
                    <div id="branchName"><script>$("#branchName").html(getEachStudentSession.branchData.branchName);</script></div>
                </div>

                <div class="details"><span>SCHOOL OFFICIAL EMAIL</span>
                   <div id="email"><script>$("#email").html(getEachStudentSession.branchData.email);</script></div>
                </div>

                <div class="details"><span>ADDRESS</span>
                   <div id="address2"><script>$("#address2").html(getEachStudentSession.branchData.address);</script></div>
                </div>

                <div class="details"><span>PHONE NUMBER</span>
                   <div id="mobileNumber"><script>$("#mobileNumber").html(getEachStudentSession.branchData.mobileNumber);</script></div>
                </div>

                <div class="details"><span>SESSION</span>
                   <div id="currentSession"><script>$("#currentSession").html(getEachStudentSession.branchData.currentSession);</script></div>
                </div>

                <div class="details"><span>TERM</span>
                   <div id="currentTerm"><script>$("#currentTerm").html(getEachStudentSession.branchData.termData.currentTerm);</script></div>
                </div>
            </div>
        </div>

        <div class="card-back-div">
            <div class="card-div">
                <div class="pix"><img src="<?php echo $websiteUrl?>/images/online-payment.jpg" alt="Pay Fees"></div>
                <div class="text">Pay Fees</div>
            </div>
        </div>
    </div>   
<?php } ?>