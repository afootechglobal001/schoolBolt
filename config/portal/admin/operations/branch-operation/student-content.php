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
                            <div class="text_field_container col-1" id="birthDay_container">
                                <script>
                                    selectField({
                                        id: 'birthDay',
                                        title: 'Select Birth Day'
                                    });
                                    _getSelectBirthDay('birthDay');
                                </script>
                            </div>

                            <div class="text_field_container col-1" id="birthMonthId_container">
                                <script>
                                    selectField({
                                        id: 'birthMonthId',
                                        title: 'Select Birth Month'
                                    });
                                    _getSelectBirthMonth('birthMonthId');
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
                            <div class="text_field_container col-1" id="mbirthDay_container">
                                <script>
                                    selectField({
                                        id: 'mbirthDay',
                                        title: 'Select Birth Day'
                                    });
                                    _getSelectBirthDay('mmbirthDay');
                                </script>
                            </div>

                            <div class="text_field_container col-1" id="mbirthMonthId_container">
                                <script>
                                    selectField({
                                        id: 'mbirthMonthId',
                                        title: 'Select Birth Month'
                                    });
                                    _getSelectBirthMonth('fbirthMonthId');
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
                        <div class="text_field_container" id="studentOfficialId_container">
                            <script>
                                textField({
                                    id: 'studentOfficialId',
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
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick=""> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>