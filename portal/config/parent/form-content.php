<?php if ($page == 'studentProfile') { ?>
    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="top-panel-div">
            <div class="inner-top">
                <span><i class="bi-person-check-fill"></i> STUDENT DETAILS</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="profile-content-div">
            <div class="bg-img">
                <!-- <div class="mini-profile">
                    <label>
                        <div class="img-div" onClick="takeSnapShot('updateStaffPix')" id="cam-pix">
                            <img src="<?php //echo $websiteUrl ?>/uploaded_files/staffPix/default.jpg" alt="Profile Image">
                        </div>
                    </label>

                    <div class="text-back-div">
                        <div class="inner-text">
                            <div class="text-div">
                                <div class="name" id="fullNameText"></div>

                                <div class="text">
                                    ID:<strong>STUDENT05020250328113504</strong> | <strong>Junior - JSS 2 B</strong>
                                    <div>
                                        <div id="statusBtn" class="status-btn ACTIVE"><span>ACTIVE</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>

            <div class="btn-div">
                <div class="div-in">
                    <ul>
                        <li class="active" title="Dashboard" id="dashboard" onclick=""><i class="bi-speedometer2"></i> Dashboard</li>
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
                            url: parentPortalLocalUrl,
                            ids: ids
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <script>
  _getFetchEachStudentDetails(ids);
</script>

<?php } ?>



<!-- For Student Modal Pages -->
<?php if ($page == 'studentDashbaord') { ?>
    <div class="profile-details">
        <div class="title">
            <i class="bi-person-lines-fill"></i>
            <span>STUDENT DETAILS</span>
        </div>

        <div class="details-div" id="student-details">
            <div class="details"><span>STUDENT ID</span>
                <div>STUDENT05020250328113504</div>
            </div>

            <div class="details"><span>FULLNAME</span>
                <div>Paul Emmanuel James</div>
            </div>

            <div class="details"><span>CURRENT CLASS</span>
                <div>ACTIVE</div>
            </div>

            <div class="details"><span>DATE OF BIRTH</span>
                <div>24 - June - 2000</div>
            </div>

            <div class="details"><span>GENDER</span>
                <div>MALE</div>
            </div>

            <div class="details"><span>STUDENT CATEGORY</span>
                <div>DAY</div>
            </div>

            <div class="details"><span>ADDRESS</span>
                <div>43, GRA QUATERS SAGAMU</div>
            </div>

            <div class="details"><span>DATE OF REGISTRATION</span>
                <div>Tuesday, 23rd-January-2025</div>
            </div>
        </div>
    </div>

    <div class="card-back-div">
        <div class="card-div">
            <div class="pix"><img src="<?php echo $websiteUrl?>/images/online-payment.jpg" alt="Pay Fees"></div>
            <div class="text">Pay Fees</div>
        </div>
    </div>
<?php } ?>