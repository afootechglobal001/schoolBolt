<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'branchLoadStudentFundForm') { ?>
    <script>
        useAccountFessToPaySession = JSON.parse(sessionStorage.getItem("useAccountFessToPaySession"));
        getEachAccountStudentSession = JSON.parse(sessionStorage.getItem("getEachAccountStudentSession"));
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <div class="icon-title-div">
                    <span id="panel-title"><span><i class="bi-plus-square"></i></span> LOAD STUDENT FUND</span>
                </div>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">
                        <span>Kindly follow the instructions below to load fund for;</span>
                        <div class="alert-list-div">
                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Student Name:</div>
                                    <div><span id="accountFormFullName">
                                            <script>
                                                $("#accountFormFullName").html(getEachAccountStudentSession?.studentData?.surName + ' ' + getEachAccountStudentSession?.studentData?.firstName + ' ' + getEachAccountStudentSession?.studentData?.otherNames);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>School Name:</div>
                                    <div><span id="accountFormBranchName">
                                            <script>
                                                $("#accountFormBranchName").html(useAccountFessToPaySession?.branchData?.branchName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Department:</div>
                                    <div><span id="accountFormDepartment">
                                            <script>
                                                $("#accountFormDepartment").html(useAccountFessToPaySession?.departmentData?.departmentName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Class:</div>
                                    <div><span id="accountFormClass">
                                            <script>
                                                $("#accountFormClass").html(useAccountFessToPaySession?.classData?.className + ' ' + useAccountFessToPaySession?.armData?.armName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Session:</div>
                                    <div><span id="accountFormCurrentSession">
                                            <script>
                                                $("#accountFormCurrentSession").html(useAccountFessToPaySession?.currentSession);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Term:</div>
                                    <div><span id="accountFormCurrentTerm">
                                            <script>
                                                $("#accountFormCurrentTerm").html(useAccountFessToPaySession?.termData?.currentTerm);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Previous Advanced Balance:</div>
                                    <div><span id="studentAdvancedBalance">
                                            <script>
                                                $("#studentAdvancedBalance").html('<s>N</s>' + thousandSeperator(getEachAccountStudentSession?.studentData?.advancedBalance));
                                            </script>
                                        </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="permission-form-back-div account-permission-form-back-div">
                    <div class="title-div">
                        <h4>Enter The Amount Received From Parent</h4>

                        <div class="text_field_container" id="amountReceivedFromParent_container">
                            <script>
                                textField({
                                    id: 'amountReceivedFromParent',
                                    title: 'Amount Recieved (#)',
                                    onKeyPressFunction: 'isNumberCheck(event);',
                                });
                            </script>
                        </div>

                        <div class="text_area_container" id="description_container">
                            <script>
                                textField({
                                    id: 'description',
                                    title: 'Fund Description',
                                    type: 'textarea',
                                    rows: 1,
                                    maxlength: '50',
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div>
                    <button class="btn" title="Pay Student Fund" id="submitBtn" onclick="_loadStudentFund();"> <i class="bi-check"></i> LOAD FUND </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- For Student Transaction History Page -->
<?php if ($page == 'fundWalletHistory') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <div><span><i class="bi-clock"></i></span> STUDENT FUND WALLET HISTORY</div>

        <div class="btn-container">
            <button class="btn" title="PRINT RECORDS" id="" onclick=""><i class="bi-printer"></i> PRINT</button>
            <button class="btn" title="EXPORT RECORDS" id="" onclick=""><i class="bi-file-earmark-excel"></i>
                EXPORT</button>
        </div>
    </div>

    <div class="chart-div-notifications user-details-notf">
        <div class="text-back-div">
            <div class="text"><i class="bi-graph-up-arrow"></i> Showing Fund Wallet History for </div>

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
                            <input class="text_field dash_text_field bar_cust_text_field" type="text" id="datepickers-from"
                                placeholder="" />
                            <div class="placeholder dash_placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> From
                            </div>
                        </div>

                        <div class="text_field_container dash_field_container">
                            <input class="text_field dash_text_field bar_cust_text_field" type="text" id="datepickers-to"
                                placeholder="" />
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

        <div class="wallet-balance">
            Wallet Balance: <span class="balance" id=""><s>N</s>200,000.00</span>
        </div>
    </div>

    <div class="table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="">
            <thead>
                <tr class="tb-col">
                    <th>sn</th>
                    <th>Date</th>
                    <th>Payment ID</th>
                    <th>Balance Before(<s>N</s>)</th>
                    <th>Amount(<s>N</s>)</th>
                    <th>Balance After(<s>N</s>)</th>
                    <th>Loaded By</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="tb-row">
                    <td>1</td>
                    <td class="clickable-td">2026-03-25 16:32:07</td>
                    <td class="clickable-td">PAY2200000000</td>
                    <td><s>N</s>200,000.00</td>
                    <td><s>N</s>100,000.00</td>
                    <td><s>N</s>300,000..00</td>
                    <td class="clickable-td">
                        <div class="text-back-div">
                            <div class="image-div general-passport">
                                <img src="${studentPixPath}/${passport}" alt="${fullname}" />
                            </div>

                            <div class="text-div">
                                <div class="first-class">Paul Emmanuel</div>
                                <div class="second-class">seunemmanuel107@gmail.com</div>
                            </div>
                        </div>
                    </td>
                    <td>CREDIT/DEBIT CARD</td>
                    <td>
                        <div class="status-div SUCCESSFUL">
                            SUCCESSFUL
                        </div>
                    </td>
                </tr>

                <tr class="tb-row">
                    <td>2</td>
                    <td class="clickable-td">2026-03-25 16:32:07</td>
                    <td class="clickable-td">PAY2200000000</td>
                    <td><s>N</s>200,000.00</td>
                    <td><s>N</s>100,000.00</td>
                    <td><s>N</s>300,000..00</td>
                    <td class="clickable-td">
                        <div class="text-back-div">
                            <div class="image-div general-passport">
                                <img src="${studentPixPath}/${passport}" alt="${fullname}" />
                            </div>

                            <div class="text-div">
                                <div class="first-class">Paul Emmanuel</div>
                                <div class="second-class">seunemmanuel107@gmail.com</div>
                            </div>
                        </div>
                    </td>
                    <td>CREDIT/DEBIT CARD</td>
                    <td>
                        <div class="status-div SUCCESSFUL">
                            SUCCESSFUL
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<?php } ?>