<?php if ($page == 'branch_student_reg') { ?>
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD A NEW STUDENT</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly fill the form below to <span> ADD A NEW STUDENT</span></div>
                </div>

                <div class="cam-pix" onClick="takeSnapShot()" id="cam-pix">
                    <img src="<?php echo $websiteUrl?>/all-images/images/sample.jpg"/>
                </div>           

                <div class="alert alert-success form-alert">
                    <span>STUDENT BASIC INFORMATIONS</span>
                    <div class="text_field_back_container">
                        <div class="text_field_container" id="surName_container">
                            <script>
                                textField({
                                    id: 'surName',
                                    title: 'SURNAME NAME',
                                    onKeyUpFunction: 'copyTextbox()'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="firstName_container">
                            <script>
                                textField({
                                    id: 'firstName',
                                    title: 'FIRST NAME'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="otherNames_container">
                            <script>
                                textField({
                                    id: 'otherNames',
                                    title: 'OTHER NAMES'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="genderId_container">
                            <script>
                                selectField({
                                    id: 'genderId',
                                    title: 'Select Gender'
                                });
                                _getSelectGender('genderId');
                            </script>
                        </div>

                        <div class="text_field_container" id="maritalStatusId_container">
                            <script>
                                selectField({
                                    id: 'maritalStatusId',
                                    title: 'Select Marital Status'
                                });
                                _getSelectMaritalStatus('maritalStatusId');
                            </script>
                        </div>

                        <div class="text_field_container" id="dateOfBirth_container">
                            <script>
                                textField({
                                    id: 'dateOfBirth',
                                    title: 'Dtae Of Birth',
                                    type: 'date'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="countryId_container">
                            <script>
                                selectField({
                                    id: 'countryId',
                                    title: 'Select Nationality'
                                });
                                _getSelectNationlaity('countryId');
                            </script>
                        </div>

                        <div class="text_field_container" id="stateId_container">
                            <script>
                                selectField({
                                    id: 'stateId',
                                    title: 'Select State Of Origin',
                                });
                                _getSelectBranchState('stateId');
                            </script>
                        </div>

                        <div class="text_field_container" id="lgaId_container">
                            <script>
                                selectField({
                                    id: 'lgaId',
                                    title: 'Select Local Govt Area'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="address_container">
                            <script>
                                textField({
                                    id: 'address',
                                    title: 'HOME ADDRESS',
                                    onKeyUpFunction: 'copyTextbox()'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="email_container">
                            <script>
                                textField({
                                    id: 'email',
                                    title: 'EMAIL ADDRESS',
                                    type: 'email'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="mobileNumber_container">
                            <script>
                                textField({
                                    id: 'mobileNumber',
                                    title: 'PHONE NUMBER',
                                    type: 'tel',
                                    onKeyPressFunction: 'isNumberCheck(event);'
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="alert alert-success form-alert">
                    <span>FATHER's INFORMATIONS</span>
                    <div class="text_field_back_container">
                        <div class="text_field_container" id="fatherTitleId_container">
                            <script>
                                selectField({
                                    id: 'fatherTitleId',
                                    title: 'Select Title'
                                });
                                _getSelectTitle('fatherTitleId');
                            </script>
                        </div>

                        <div class="text_field_container" id="fatherSurName_container">
                            <script>
                                textField({
                                    id: 'fatherSurName',
                                    title: 'SURNAME'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="fatherOtherNames_container">
                            <script>
                                textField({
                                    id: 'fatherOtherNames',
                                    title: 'OTHERS NAME'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="fatherAddress_container">
                            <script>
                                textField({
                                    id: 'fatherAddress',
                                    title: 'HOME ADDRESS'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="fatherEmail_container">
                            <script>
                                textField({
                                    id: 'fatherEmail',
                                    title: 'EMAIL ADDRESS',
                                    type: 'email'
                                });
                            </script>
                        </div>
                       
                        <div class="text_field_container" id="fatherMobileNumber_container">
                            <script>
                                textField({
                                    id: 'fatherMobileNumber',
                                    title: 'PHONE NUMBER',
                                    type: 'tel',
                                    onKeyPressFunction: 'isNumberCheck(event);'
                                });
                            </script>
                        </div>

                        <div class="col-back-div">
                            <div class="text_field_container col-1" id="fatherDayOfBirth_container">
                                <script>
                                    selectField({
                                        id: 'fatherDayOfBirth',
                                        title: 'Select Birth Day'
                                    });
                                    _getSelectBirthDay('fatherDayOfBirth');
                                </script>
                            </div>

                            <div class="text_field_container col-1" id="fatherMonthOfBirth_container">
                                <script>
                                    selectField({
                                        id: 'fatherMonthOfBirth',
                                        title: 'Select Birth Month'
                                    });
                                    _getSelectBirthMonth('fatherMonthOfBirth');
                                </script>
                            </div>
                        </div>

                        <div class="text_field_container" id="fatherOccupation_container">
                            <script>
                                textField({
                                    id: 'fatherOccupation',
                                    title: 'OCCUPATION'
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="alert alert-success form-alert">
                    <span>MOTHER's INFORMATIONS</span>
                    <div class="text_field_back_container">
                        <div class="text_field_container" id="motherTitleId_container">
                            <script>
                                selectField({
                                    id: 'motherTitleId',
                                    title: 'Select Title'
                                });
                                _getSelectTitle('motherTitleId');
                            </script>
                        </div>

                        <div class="text_field_container" id="motherSurName_container">
                            <script>
                                textField({
                                    id: 'motherSurName',
                                    title: 'SURNAME'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="motherOtherNames_container">
                            <script>
                                textField({
                                    id: 'motherOtherNames',
                                    title: 'OTHERS NAME'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="motherAddress_container">
                            <script>
                                textField({
                                    id: 'motherAddress',
                                    title: 'HOME ADDRESS'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="motherEmail_container">
                            <script>
                                textField({
                                    id: 'motherEmail',
                                    title: 'EMAIL ADDRESS',
                                    type: 'email'
                                });
                            </script>
                        </div>
                       
                        <div class="text_field_container" id="motherMobileNumber_container">
                            <script>
                                textField({
                                    id: 'motherMobileNumber',
                                    title: 'PHONE NUMBER',
                                    type: 'tel',
                                    onKeyPressFunction: 'isNumberCheck(event);'
                                });
                            </script>
                        </div>

                        <div class="col-back-div">
                            <div class="text_field_container col-1" id="motherDayOfBirth_container">
                                <script>
                                    selectField({
                                        id: 'motherDayOfBirth',
                                        title: 'Select Birth Day'
                                    });
                                    _getSelectBirthDay('motherDayOfBirth');
                                </script>
                            </div>

                            <div class="text_field_container col-1" id="motherMonthOfBirth_container">
                                <script>
                                    selectField({
                                        id: 'motherMonthOfBirth',
                                        title: 'Select Birth Month'
                                    });
                                    _getSelectBirthMonth('motherMonthOfBirth');
                                </script>
                            </div>
                        </div>

                        <div class="text_field_container" id="motherOccupation_container">
                            <script>
                                textField({
                                    id: 'motherOccupation',
                                    title: 'OCCUPATION'
                                });
                            </script>
                        </div>
                    </div>
                </div>
               
                <div class="alert alert-success form-alert">
                    <span>STUDENT's ACADEMIC INFORMATIONS</span>
                    <div class="text_field_back_container">
                        <div class="text_field_container" id="officialStudentId_container">
                            <script>
                                textField({
                                    id: 'officialStudentId',
                                    title: 'Student Official ID'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="departmentId_container">
                            <script>
                                selectField({
                                    id: 'departmentId',
                                    title: 'Select Department'
                                });
                                _getSelectDepartment('departmentId');
                            </script>
                        </div>

                        <div class="text_field_container" id="classId_container">
                            <script>
                                selectField({
                                    id: 'classId',
                                    title: 'Select Class'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="armId_container">
                            <script>
                                selectField({
                                    id: 'armId',
                                    title: 'Select Arm'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="accommodationId_container">
                            <script>
                                selectField({
                                    id: 'accommodationId',
                                    title: 'Select Accomodation'
                                });
                                _getSelectAccomodation('accommodationId');
                            </script>
                        </div>
                    </div>
                </div>

                <div class="text_field_container" id="statusId_container">
                    <script>
                        selectField({
                            id: 'statusId',
                            title: 'Select Status'
                        });
                        _getSelectStatusId('statusId', '1,2');
                    </script>
                </div>
                
                <div>
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createStudent();"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page=='student_select_form'){?>
    <div class="caption-div animated zoomIn">
        <div class="title-div">
           <div class="title"><i class="bi-person-check"></i> VIEW STUDENT</div>
           <button class="close-btn" onclick="_alertClose(<?php echo $modalLayer?>);" title="Close"><i class="bi-x-lg"></i></button>
        </div>

        <div class="div-in animated fadeIn">
            <div class="alert alert-success form-alert"> <i class="bi-person"></i> Hello, you're about to view students by their <span>Department</span>, <span>Class</span>, and <span>Arm</span>. Please select the <span>Department</span>, <span>Class</span>, and <span>Arm</span> to proceed.</div>

            <div class="text_field_container" id="departmentId_container">
                <script>
                    selectField({
                        id: 'departmentId',
                        title: 'Select Department'
                    });
                    _getSelectDepartment('departmentId');
                </script>
            </div>

            <div class="text_field_container" id="classId_container">
                <script>
                    selectField({
                        id: 'classId',
                        title: 'Select Class'
                    });
                </script>
            </div>

            <div class="text_field_container" id="armId_container">
                <script>
                    selectField({
                        id: 'armId',
                        title: 'Select Arm'
                    });
                </script>
            </div>
            
            <button class="btn" type="button" id="submit_btn"  title="Proceed Request"  onclick="_getActiveBranchPage({divid:'branch_student_page', page: 'branch_student_page', url: adminPortalLocalUrl});">PROCEED <i class="bi-arrow-right"></i>  </button>
        </div>
    </div>
<?php } ?>

<?php if ($page=='branch_student_page') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <div><span><i class="bi-person-bounding-box"></i></span> BRANCH STUDENT'S LIST  ---- <span>BASIC</span> - <span> BASIC 1</span></div> 

        <div class="btn-container">
            <button class="btn" title="PRINT RECORDS" id="" onclick=""><i class="bi-printer"></i> PRINT</button>
            <button class="btn" title="EXPORT RECORDS" id="" onclick=""><i class="bi-file-earmark-excel"></i> EXPORT</button>
        </div>
    </div>

    <div class="table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="pageContent">
            <thead>
                <tr class="tb-col">
                    <th>sn</th>
                    <th>Student ID</th>
                    <th>Passport</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Department</th>
                    <th>Class</th>
                    <th>Status</th>
                    <th>View</th>
                </tr>
            </thead>

            <tbody>
                <tr class="tb-row">
                    <td>1</td>
                    <td class="clickable-td" title="Click to view staff profile" onclick="">
                        <div class="text-back-div">
                            <div class="text-div">
                                <div class="first-class">STAFF03520250317092429</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-back-div">
                            <div class="image-div student-passport">
                                <img src="<?php echo $websiteUrl?>/all-images/body-pix/student1.jpg" alt="PAUL EMMANUEL"/>
                            </div>
                        </div>
                    </td>
                    <td>PAUL EMMANUEL</td>
                    <td>MALE</td>
                    <td>15</td>
                    <td>BASIC</td>
                    <td>BASIC 1</td>
                    <td><div class="status-div ACTIVE">ACTIVE</div></td>
                    <td><button class="btn view-btn" title="VIEW STUDENT PROFILE" onclick="_getForm({page: 'student_profile', layer:2, url: adminPortalLocalUrl});">VIEW</button></td>
                </tr>

                <tr class="tb-row">
                    <td>2</td>
                    <td class="clickable-td" title="Click to view staff profile" onclick="">
                        <div class="text-back-div">
                            <div class="text-div">
                                <div class="first-class">STAFF03520250317092429</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-back-div">
                            <div class="image-div student-passport">
                                <img src="<?php echo $websiteUrl?>/all-images/body-pix/student2.jpg" alt="PAUL EMMANUEL"/>
                            </div>
                        </div>
                    </td>
                    <td>PAUL EMMANUEL</td>
                    <td>MALE</td>
                    <td>17</td>
                    <td>BASIC</td>
                    <td>BASIC 1</td>
                    <td><div class="status-div ACTIVE">ACTIVE</div></td>
                    <td><button class="btn view-btn" title="VIEW STUDENT PROFILE" onclick="">VIEW</button></td>
                </tr>

                <tr class="tb-row">
                    <td>3</td>
                    <td class="clickable-td" title="Click to view staff profile" onclick="">
                        <div class="text-back-div">
                            <div class="text-div">
                                <div class="first-class">STAFF03520250317092429</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-back-div">
                            <div class="image-div student-passport">
                                <img src="<?php echo $websiteUrl?>/all-images/body-pix/student3.jpg" alt="PAUL EMMANUEL"/>
                            </div>
                        </div>
                    </td>
                    <td>PAUL EMMANUEL</td>
                    <td>MALE</td>
                    <td>12</td>
                    <td>BASIC</td>
                    <td>BASIC 1</td>
                    <td><div class="status-div ACTIVE">ACTIVE</div></td>
                    <td><button class="btn view-btn" title="VIEW STUDENT PROFILE" onclick="">VIEW</button></td>
                </tr>

                <tr class="tb-row">
                    <td>4</td>
                    <td class="clickable-td" title="Click to view staff profile" onclick="">
                        <div class="text-back-div">
                            <div class="text-div">
                                <div class="first-class">STAFF03520250317092429</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-back-div">
                            <div class="image-div student-passport">
                                <img src="<?php echo $websiteUrl?>/all-images/body-pix/student2.jpg" alt="PAUL EMMANUEL"/>
                            </div>
                        </div>
                    </td>
                    <td>PAUL EMMANUEL</td>
                    <td>MALE</td>
                    <td>16</td>
                    <td>BASIC</td>
                    <td>BASIC 1</td>
                    <td><div class="status-div ACTIVE">ACTIVE</div></td>
                    <td><button class="btn view-btn" title="VIEW STUDENT PROFILE" onclick="">VIEW</button></td>
                </tr>

                <tr class="tb-row">
                    <td>5</td>
                    <td class="clickable-td" title="Click to view staff profile" onclick="">
                        <div class="text-back-div">
                            <div class="text-div">
                                <div class="first-class">STAFF03520250317092429</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-back-div">
                            <div class="image-div student-passport">
                                <img src="<?php echo $websiteUrl?>/all-images/body-pix/student1.jpg" alt="PAUL EMMANUEL"/>
                            </div>
                        </div>
                    </td>
                    <td>PAUL EMMANUEL</td>
                    <td>MALE</td>
                    <td>15</td>
                    <td>BASIC</td>
                    <td>BASIC 1</td>
                    <td><div class="status-div ACTIVE">ACTIVE</div></td>
                    <td><button class="btn view-btn" title="VIEW STUDENT PROFILE" onclick="">VIEW</button></td>
                </tr>

                <tr class="tb-row">
                    <td>6</td>
                    <td class="clickable-td" title="Click to view staff profile" onclick="">
                        <div class="text-back-div">
                            <div class="text-div">
                                <div class="first-class">STAFF03520250317092429</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-back-div">
                            <div class="image-div student-passport">
                                <img src="<?php echo $websiteUrl?>/all-images/body-pix/student2.jpg" alt="PAUL EMMANUEL"/>
                            </div>
                        </div>
                    </td>
                    <td>PAUL EMMANUEL</td>
                    <td>MALE</td>
                    <td>12</td>
                    <td>BASIC</td>
                    <td>BASIC 1</td>
                    <td><div class="status-div ACTIVE">ACTIVE</div></td>
                    <td><button class="btn view-btn" title="VIEW STUDENT PROFILE" onclick="">VIEW</button></td>
                </tr>
            </tbody>
        </table>
    </div>
   
<?php } ?>


<?php if ($page=='student_profile') { ?>
    <script>
        getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));
    </script>

    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="top-panel-div">
            <div class="inner-top">
                <span><i class="bi-person-check-fill"></i> STUDENT PROFILE</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer?>);">X</div>
            </div>
        </div>

        <div class="profile-content-div">
            <div class="bg-img">
                <div class="mini-profile">
                    <label>
                        <div class="img-div" id="current_user_passport1">
                            <img src="<?php echo $websiteUrl ?>/all-images/images/avatar.jpg" alt="Profile Image">
                        </div>
                    </label>

                    <div class="text-back-div">
                        <div class="inner-text">
                            <div class="text-div">
                                <div class="name" id="fullName">PAUL EMMANUEL</div>

                                <div class="text">
                                    <div>
                                        <div id="statusBtn" class="status-btn ACTIVE"><span id="statusName">ACTIVE</span></div>
                                    </div>
                                    | LAST LOGIN DATE:
                                    <strong id="lastLoginTime">00-00-00 00:00:00</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-div">
                <div class="div-in">
                    <ul>
                        <li class="active" title="Student Profile" id="student_profile_details" onclick="_getActiveStudentPage({divid:'student_profile_details', page: 'student_profile_details', url: adminPortalLocalUrl});"><i class="bi-person-bounding-box"></i> Student Profile</li>
                        <li title="Transcript" id="tanscript" onclick="_getActiveStudentPage({divid:'tanscript', page: 'tanscript', url: adminPortalLocalUrl});"><i class="bi-mortarboard"></i> Transcript</li>
                        <li title="Student Report" id="student_report" onclick="_getActiveStudentPage({divid:'student_report', page: 'student_report', url: adminPortalLocalUrl});"><i class="bi-mortarboard"></i> Student Report</li>
                        <li title="Student Activities" id="student_activities" onclick="_getActiveStudentPage({divid:'student_activities', page: 'student_activities', url: adminPortalLocalUrl});"><i class="bi-bell"></i> Student Activities</li>
                    </ul>
                </div>
            </div>

            <div class="field-back-div">
                <div class="field-inner-div" id="get_student_details">
                    <script>
                        _getActiveStudentPage({
                            divid: 'student_profile_details',
                            page: 'student_profile_details',
                            url: adminPortalLocalUrl
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

<?php } ?>


<!-- For Staffs Modal Pages -->
<?php if ($page == 'student_profile_details') { ?>
    <div class="user-in">
        <div class="title">STUDENT BASIC INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-3" id="updateFirstName_container">
                <script>
                    textField({
                        id: 'updateFirstName',
                        title: 'First Name'
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="updateMiddleName_container">
                <script>
                    textField({
                        id: 'updateMiddleName',
                        title: 'Middle Name'
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="updateLastName_container">
                <script>
                    textField({
                        id: 'updateLastName',
                        title: 'Last Name'
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateMobileNumber_container">
                <script>
                    textField({
                        id: 'updateMobileNumber',
                        title: 'Phone Number',
                        type: 'tel'
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateEmailAddress_container">
                <script>
                    textField({
                        id: 'updateEmailAddress',
                        title: 'Email Address',
                        type: 'email'
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateGenderId_container">
                <script>
                    selectField({
                        id: 'updateGenderId',
                        title: 'Select Gender',
                    });
                    _getSelectGender('updateGenderId');
                </script>
            </div>

            <div class="text_field_container col-1" id="updateDateOfBirth_container">
                <script>
                     textField({
                        id: 'updateDateOfBirth',
                        title: 'Date Of Birth',
                        type: 'date'
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="user-in">
        <div class="title">STUDENT RESIDENT INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-1" id="branchStateId_container">
                <script>
                    selectField({
                        id: 'branchStateId',
                        title: 'Select Branch State'
                    });
                    _getSelectBranchState('branchStateId');
                </script>
            </div>

            <div class="text_field_container col-1" id="branchLgaId_container">
                <script>
                    selectField({
                        id: 'branchLgaId',
                        title: 'Select Branch Local Govt Area'
                    });
                </script>
            </div>

            <div class="text_field_container col-2" id="updateAddress_container">
                <script>
                    textField({
                        id: 'updateAddress',
                        title: 'Home Address'
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="user-in">
        <div class="title">STUDENT ACCOUNT INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-3" id="staffId_container">
                <script>
                    textField({
                        id: 'staffId',
                        title: 'Staff ID',
                       
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="createdTime_container">
                <script>
                    textField({
                        id: 'createdTime',
                        title: 'Date Of Registration',
                        readonly: true
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="lastLogin_container">
                <script>
                    textField({
                        id: 'lastLogin',
                        title: 'Last Login Date',
                        readonly: true
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="user-in">
        <div class="title">ADMINISTRATIVE INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-3" id="updateBranchId_container">
                <script>
                    selectField({
                        id: 'updateBranchId',
                        title: 'Select Branch'
                    });
                    _getSelectBranch('updateBranchId');
                </script>
            </div>

            <div class="text_field_container col-3" id="updateRoleId_container">
                <script>
                    selectField({
                        id: 'updateRoleId',
                        title: 'Select Role'
                    });
                    _getSelectRole('updateRoleId');
                </script>
            </div>

            <div class="text_field_container col-3" id="updateStatusId_container">
                <script>
                    selectField({
                        id: 'updateStatusId',
                        title: 'Select Status'
                    });
                    _getSelectStatusId('updateStatusId', '1,2');
                </script>
            </div>
        </div>
        <div class="btn-div">
            <button class="btn" title="UPDATE PROFILE" id="updateBtn" onclick=""> UPDATE PROFILE <i class="bi-check"></i></button>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'student_activities') { ?>
    <div class="chart-div-notifications user-details-notf">
        <div class="text"><i class="bi-graph-up-arrow"></i> Showing Notification History for </div>

        <div class="text text-right" onclick="select_search()">
            <span id="srch-text">Last 30 Days</span>
            <div class="icon-div"><i class="bi-caret-down"></i></div>

            <div class="srch-select alert-srch-select">
                <div id="srch-today" onclick="_getAlertReport('srch-today', 'view_today_search');">Today</div>
                <div id="srch-week" onclick="_getAlertReport('srch-week', 'view_thisweek_search');">This Week</div>
                <div id="srch-7" onclick="_getAlertReport('srch-7', 'view_7days_search');">Last 7 Days</div>
                <div id="srch-month" onclick="_getAlertReport('srch-month', 'view_thismonth_search');">This Month</div>
                <div id="srch-30" onclick="_getAlertReport('srch-30', 'view_30days_search');">Last 30 Days</div>
                <div id="srch-90" onclick="_getAlertReport('srch-90', 'view_90days_search');">Last 90 Days</div>
                <div id="srch-year" onclick="_getAlertReport('srch-year', 'view_thisyear_search');">This Year</div>
                <div id="srch-1year" onclick="_getAlertReport('srch-1year', 'view_1year_search');">Last 1 Year</div>
                <div onclick="srch_custom('Custom Search')">Custom Search</div>
            </div>
        </div>

        <div class="text">
            <div class="custom-srch-div">
                <div class="custom-srch-div-in">
                    <div class="text_field_container dash_field_container">
                        <input class="text_field dash_text_field bar_cust_text_field" type="text" id="datepickers-from" placeholder="" />
                        <div class="placeholder dash_placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> From</div>
                    </div>

                    <div class="text_field_container dash_field_container">
                        <input class="text_field dash_text_field bar_cust_text_field" type="text" id="datepickers-to" placeholder="" />
                        <div class="placeholder dash_placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> To</div>
                    </div>
                    <button type="button" class="btn">Apply</button>
                </div>
            </div>
        </div>


        <script language="javascript">
            $('#datepickers-from').datetimepicker({
                lang: 'en',
                timepicker: false,
                format: 'Y-m-d',
                formatDate: 'Y-M-d',
            });

            $('#datepickers-to').datetimepicker({
                lang: 'en',
                timepicker: false,
                format: 'Y-m-d',
                formatDate: 'Y-M-d',
            });
        </script>
    </div>

    <div class="main-alert-div">
        <div class="system-alert" id="" onclick="_getSecondaryFormWithId('staff_alert_read');">
            <div class="alert-name"><i class="bi-person"></i>Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...</div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i>Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...</div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...</div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...</div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...</div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...</div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>
    </div>
<?php } ?>