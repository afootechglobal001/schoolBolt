<div class="user-profile-div animated fadeInUp">
    <div class="top-panel-div">
        <span><i class="bi-person-check-fill"></i> ADMINISTRATIVE PROFILE</span>
        <div class="close" title="Close" onclick="_alert_close();">X</div>
    </div>

    <div class="profile-content-div">
        <div class="bg-img">
            <div class="mini-profile">
                <label>
                    <div class="img-div" id="current_user_passport2">
                        <img src="<?php echo $website_url ?>/admin/a/all-images/images/avatar.jpg" alt="Profile Image">
                    </div>
                    <input type="file" id="profile_pix" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="Staff.UpdatePreview(this);" />
                </label>

                <div class="text-div">
                    <h2 id="login_user_fullname">Loading...</h2>
                    <div class="text">STATUS: <strong id="login_user_status_name">Loading...</strong> | LAST LOGIN DATE: <strong id="login_user_last_time">Loading...</strong></div>
                </div>
            </div>
        </div>

        <div class="field-back-div">
            <div class="user-in">
                <div class="title">BASIC INFORMATION</div>

                <div class="profile-segment-div">
                    <div class="text_field_container col-2">
                        <input class="text_field" type="text" id="updt_fullname" placeholder="" />
                        <div class="placeholder">Full Name:</div>
                    </div>

                    <div class="text_field_container col-1">
                        <input class="text_field" type="text" id="updt_email" placeholder="" />
                        <div class="placeholder">Email Address:</div>
                    </div>

                    <div class="text_field_container col-1">
                        <input class="text_field" type="text" id="updt_address" placeholder="" />
                        <div class="placeholder">Home Address:</div>
                    </div>

                    <div class="text_field_container col-1">
                        <input class="text_field" type="text" id="updt_position" placeholder="" />
                        <div class="placeholder">Position:</div>
                    </div>

                    <div class="text_field_container col-1">
                        <input class="text_field" type="text" id="updt_mobile" placeholder="" />
                        <div class="placeholder">Phone Number:</div>
                    </div> 
                </div>
            </div>


            <div class="user-in">
                <div class="title">ACCOUNT INFORMATION</div>

                <div class="profile-segment-div">
                    <div class="text_field_container col-2">
                        <input class="text_field" type="text" id="s_staff_id" placeholder="" readonly="readonly" />
                        <div class="placeholder">Staff ID:</div>
                        <div class="lock-container"><i class="bi-lock"></i></div>
                    </div>

                    <div class="text_field_container col-1">
                        <input class="text_field" type="text" id="s_created_time" placeholder="" readonly="readonly" />
                        <div class="placeholder">Date Of Registration:</div>
                        <div class="lock-container"><i class="bi-lock"></i></div>
                    </div>

                    <div class="text_field_container col-1">
                        <input class="text_field" type="text" id="s_last_login" placeholder="" readonly="readonly" />
                        <div class="placeholder">Last Login Date:</div>
                        <div class="lock-container"><i class="bi-lock"></i></div>
                    </div>
                </div>
            </div>

            <div class="user-in">
                <div class="title">ADMINISTRATIVE INFORMATION</div>

                <div class="profile-segment-div ">
                    <div class="text_field_container col-1">
                        <select id="updt_role_id" class="text_field" placeholder="">
                            <option value="">-Select here</option>
                            <script>
                                _getSelectRole('updt_role_id');
                            </script>
                        </select>
                        <div class="placeholder">--Select Role--</div>
                    </div>

                    <div class="text_field_container col-1">
                        <select id="updt_status_id" class="text_field" placeholder="">
                            <option value="">-Select here</option>
                            <script>
                                _getSelectStataus('updt_status_id', '1,2');
                            </script>
                        </select>
                        <div class="placeholder">--Select Status--</div>
                    </div>
                </div>
                <div class="btn-div">
                    <button class="btn" id="update_btn" onclick="_updateLoginStaff();"> UPDATE PROFILE <i class="bi-check"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>_upload_pix_();</script>
<script>_fetchLoginUser();</script>