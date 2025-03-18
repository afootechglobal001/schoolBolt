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
                    <span>BASIC INFORMATIONS</span>
                    <div class="text_field_back_container">
                        <div class="text_field_container" id="surname_container">
                            <script>
                                textField({
                                    id: 'surname',
                                    title: 'SURNAME NAME'
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
                                    title: 'DATE OF BIRTH',
                                    type: 'date'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="nationalityId_container">
                            <script>
                                selectField({
                                    id: 'nationalityId',
                                    title: 'Select Nationality'
                                });
                                _getSelectNationlaity('nationalityId');
                            </script>
                        </div>

                        <div class="text_field_container" id="branchStateId_container">
                            <script>
                                selectField({
                                    id: 'branchStateId',
                                    title: 'Select Branch State',
                                });
                                _getSelectBranchState('branchStateId');
                            </script>
                        </div>

                        <div class="text_field_container" id="branchLgaId_container">
                            <script>
                                selectField({
                                    id: 'branchLgaId',
                                    title: 'Select Branch Local Govt Area'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="address_container">
                            <script>
                                textField({
                                    id: 'address',
                                    title: 'HOME ADDRESS'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="emailAddress_container">
                            <script>
                                textField({
                                    id: 'emailAddress',
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

                <div class="alert alert-success form-alert">
                    <span>FATHER's INFORMATIONS</span>
                    <div class="text_field_back_container">
                        <div class="col-back-div">
                            <div class="text_field_container col-1" id="titleId_container">
                                <script>
                                    selectField({
                                        id: 'titleId',
                                        title: 'Select Title'
                                    });
                                    _getSelectTitle('titleId');
                                </script>
                            </div>

                            <div class="text_field_container col-1" id="fsurname_container">
                                <script>
                                    textField({
                                        id: 'fsurname',
                                        title: 'SURNAME'
                                    });
                                </script>
                            </div>
                        </div>

                        <div class="text_field_container" id="ffirstName_container">
                            <script>
                                textField({
                                    id: 'ffirstName',
                                    title: 'OTHERS NAME'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="faddress_container">
                            <script>
                                textField({
                                    id: 'faddress',
                                    title: 'HOME ADDRESS',
                                    onKeyUpFunction: 'copyAddress()'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="femailAddress_container">
                            <script>
                                textField({
                                    id: 'femailAddress',
                                    title: 'EMAIL ADDRESS',
                                    type: 'email'
                                });
                            </script>
                        </div>
                       
                        <div class="text_field_container" id="fmobileNumber_container">
                            <script>
                                textField({
                                    id: 'fmobileNumber',
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

                            <div class="text_field_container col-1" id="birthMonth_container">
                                <script>
                                    selectField({
                                        id: 'birthMonth',
                                        title: 'Select Birth Month'
                                    });
                                    _getSelectBirthMonth('birthMonth');
                                </script>
                            </div>
                        </div>

                        <div class="text_field_container" id="occupation_container">
                            <script>
                                textField({
                                    id: 'occupation',
                                    title: 'OCCUPATION'
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="alert alert-success form-alert">
                    <span>MOTHER's INFORMATIONS</span>
                    <div class="text_field_back_container">
                        <div class="col-back-div">
                            <div class="text_field_container col-1" id="mTitleId_container">
                                <script>
                                    selectField({
                                        id: 'mTitleId',
                                        title: 'Select Title'
                                    });
                                    _getSelectTitle('mTitleId');
                                </script>
                            </div>

                            <div class="text_field_container col-1" id="msurname_container">
                                <script>
                                    textField({
                                        id: 'msurname',
                                        title: 'SURNAME'
                                    });
                                </script>
                            </div>
                        </div>

                        <div class="text_field_container" id="mfirstName_container">
                            <script>
                                textField({
                                    id: 'mfirstName',
                                    title: 'OTHERS NAME'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="maddress_container">
                            <script>
                                textField({
                                    id: 'maddress',
                                    title: 'HOME ADDRESS',
                                    onKeyPressFunction: ''
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="memailAddress_container">
                            <script>
                                textField({
                                    id: 'memailAddress',
                                    title: 'EMAIL ADDRESS',
                                    type: 'email'
                                });
                            </script>
                        </div>
                       
                        <div class="text_field_container" id="mmobileNumber_container">
                            <script>
                                textField({
                                    id: 'mmobileNumber',
                                    title: 'PHONE NUMBER',
                                    type: 'tel',
                                    onKeyPressFunction: 'isNumberCheck(event);'
                                });
                            </script>
                        </div>

                        <div class="col-back-div">
                            <div class="text_field_container col-1" id="mBirthDay_container">
                                <script>
                                    selectField({
                                        id: 'mBirthDay',
                                        title: 'Select Birth Day'
                                    });
                                    _getSelectBirthDay('mBirthDay');
                                </script>
                            </div>

                            <div class="text_field_container col-1" id="mbirthMonth_container">
                                <script>
                                    selectField({
                                        id: 'mbirthMonth',
                                        title: 'Select Birth Month'
                                    });
                                    _getSelectBirthMonth('mbirthMonth');
                                </script>
                            </div>
                        </div>

                        <div class="text_field_container" id="moccupation_container">
                            <script>
                                textField({
                                    id: 'moccupation',
                                    title: 'OCCUPATION'
                                });
                            </script>
                        </div>
                    </div>
                </div>
               
                <div class="alert alert-success form-alert">
                    <span>STUDENT's ACADEMIC INFORMATIONS</span>
                    <div class="text_field_back_container">
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
                                _getSelectClass('classId');
                            </script>
                        </div>

                        <div class="text_field_container" id="armId_container">
                            <script>
                                selectField({
                                    id: 'armId',
                                    title: 'Select Arm'
                                });
                                _getSelectClass('armId');
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
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createStaff();"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>