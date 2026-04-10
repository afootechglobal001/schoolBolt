<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'branchLoadWalletForm') { ?>
    <div class="caption-div animated zoomIn">
        <div class="title-div">
            <div class="title"><i class="bi bi-wallet-fill"></i> LOAD WALLET</div>
            <button class="close-btn" onclick="_alertClose(<?php echo $modalLayer ?>);" title="Close"><i
                    class="bi-x-lg"></i></button>
        </div>

        <div class="div-in animated fadeIn">
            <div class="alert alert-success form-alert">
                <i class="bi-wallet-fill"></i> You’re about to fund your wallet. Enter the <span>amount</span> and proceed
                to complete your payment securely.
            </div>

            <div class="text_field_container" id="amount_container">
                <script>
                    textField({
                        id: 'amount',
                        title: 'Enter Amount',
                        type: 'number',
                        onKeyPressFunction: 'isNumberCheck(event);',
                        autocomplete: "off"
                    });
                </script>
            </div>

            <div class="text_area_container" id="description_container">
                <script>
                    textField({
                        id: 'description',
                        title: 'Wallet Description',
                        type: 'textarea',
                        rows: 1,
                        maxlength: '50',
                    });
                </script>
            </div>

            <div class="text_field_container" id="paymentMethodId_container">
                <script>
                    selectField({
                        id: 'paymentMethodId',
                        title: 'Select Payment Method'
                    });
                    _getSelectPaymentMethod('paymentMethodId');
                </script>
            </div>

            <button class="btn" id="loadWalletBtn" title="Proceed To Load Wallet"
                onclick="loadBranchWallet(<?php echo $modalLayer ?>);"> PROCEED <i class="bi bi-arrow-right"></i></button>
        </div>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'branchWalletHistory') { ?>
    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="top-panel-div">
            <div class="inner-top">
                <span><i class="bi-clock"></i> SCHOOLBOLT WALLET HISTORY</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="profile-content-div">
            <div class="field-back-div">
                <div class="field-inner-div student-result-field-inner-div">

                    <div class="chart-div-notifications user-details-notf">
                        <div class="text-back-div">
                            <div class="text"><i class="bi-graph-up-arrow"></i> Showing Wallet History for </div>

                            <div class="text text-right" onclick="wallet_select_search()">
                                <span id="srch-wallet-text">Last 30 Days</span>
                                <div class="icon-div"><i class="bi-caret-down"></i></div>

                                <div class="srch-select alert-srch-select">
                                    <div id="srch-today" onclick="_fetchBranchWalletFiltering('srch-today', 'Today');">Today
                                    </div>
                                    <div id="srch-week" onclick="_fetchBranchWalletFiltering('srch-week', 'This Week');">
                                        This Week</div>
                                    <div id="srch-7" onclick="_fetchBranchWalletFiltering('srch-7', 'Last 7 Days');">Last 7
                                        Days</div>
                                    <div id="srch-month" onclick="_fetchBranchWalletFiltering('srch-month', 'This Month');">
                                        This Month</div>
                                    <div id="srch-30" onclick="_fetchBranchWalletFiltering('srch-30', 'Last 30 Days');">Last
                                        30 Days</div>
                                    <div id="srch-90" onclick="_fetchBranchWalletFiltering('srch-90', 'Last 90 Days');">Last
                                        90 Days</div>
                                    <div id="srch-year" onclick="_fetchBranchWalletFiltering('srch-year', 'This Year');">
                                        This Year</div>
                                    <div id="srch-1year"
                                        onclick="_fetchBranchWalletFiltering('srch-1year', 'Last 1 Year');">Last 1 Year
                                    </div>
                                    <div onclick="wallet_srch_custom('Custom Search')">Custom Search</div>
                                </div>
                            </div>

                            <div class="text">
                                <div class="custom-srch-div branch-wallet-custom-srch-div">
                                    <div class="custom-srch-div-in">
                                        <div class="text_field_container dash_field_container">
                                            <input class="text_field bar_cust_text_field" type="text"
                                                id="wallet-datepickers-from" placeholder="" />
                                            <div class="placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> From
                                            </div>
                                            <div class="issueText" id="issue_wallet-datepickers-from"></div>
                                        </div>

                                        <div class="text_field_container dash_field_container">
                                            <input class="text_field bar_cust_text_field" type="text"
                                                id="wallet-datepickers-to" placeholder="" />
                                            <div class="placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> To
                                            </div>
                                            <div class="issueText" id="issue_wallet-datepickers-to"></div>
                                        </div>
                                        <button type="button" class="btn" id="applyWalletCustomSearchBtn"
                                            onclick="_fetchCustomWalletHistoryFiltering();">Apply</button>
                                    </div>
                                </div>
                            </div>

                            <script language="javascript">
                                $('#wallet-datepickers-from').datetimepicker({
                                    lang: 'en',
                                    timepicker: false,
                                    format: 'Y-m-d',
                                    formatDate: 'Y-M-d',
                                });

                                $('#wallet-datepickers-to').datetimepicker({
                                    lang: 'en',
                                    timepicker: false,
                                    format: 'Y-m-d',
                                    formatDate: 'Y-M-d',
                                });
                            </script>
                        </div>

                        <div class="wallet-balance">
                            Wallet Balance: <span class="balance" id="branchWalletBalance"><s>N</s>0.00</span>
                        </div>
                    </div>

                    <div class="alert alert-success top-alert-div animated fadeIn">
                        <div><i class="bi-info-circle"></i> Wallet history between <span id="dateFrom">Loading...</span> and
                            <span id="dateTo">Loading...</span>
                        </div>

                        <div class="btn-container">
                            <button class="btn" title="LOAD WALLET"
                                onclick="_getForm({page: 'branchLoadWalletForm', layer:3,  url: adminPortalLocalUrl});"><i
                                    class="bi bi-wallet-fill"></i> LOAD WALLET</button>
                                    <button class="btn" title="WALLET TRANSFER"
                                onclick="_getForm({page: 'branchWalletTransferForm', layer:3,  url: adminPortalLocalUrl});"><i
                                    class="bi bi-wallet-fill"></i> WALLET TRANSFER</button>
                            <button class="btn" title="EXPORT RECORDS" id="" onclick=""><i
                                    class="bi-file-earmark-excel"></i>
                                EXPORT</button>
                        </div>
                    </div>

                    <div class="table-div animated fadeIn">
                        <table class="table" cellspacing="0" style="width:100%">
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

                            <tbody id="fetchBranchWalletTransactions">
                                <script>
                                    _fetchBranchWalletFiltering('srch-30', 'Last 30 Days');
                                </script>

                                <tr>
                                    <td colspan="20">
                                        <div class="content-loading-div">
                                            <img src="<?php echo $websiteUrl ?>/images/spinner.gif" alt="Loading" />
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <div id="fetchBranchWalletTransactionsPaginationControls" class="pagination-div"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'branchWalletTransferForm') { ?>
    <div class="caption-div animated zoomIn">
        <div class="title-div">
            <div class="title"><i class="bi bi-wallet-fill"></i> WALLET TRANSFER</div>
            <button class="close-btn" onclick="_alertClose(<?php echo $modalLayer ?>);" title="Close"><i
                    class="bi-x-lg"></i></button>
        </div>

        <div class="div-in animated fadeIn">
            <div class="alert alert-success form-alert">
                <i class="bi-wallet-fill"></i> You’re about to transfer funds between branches. Enter the <span>amount</span> and proceed
                to complete your transfer securely.
            </div>

            <div class="text_field_container" id="amount_container">
                <script>
                    textField({
                        id: 'amount',
                        title: 'Enter Amount',
                        type: 'number',
                        onKeyPressFunction: 'isNumberCheck(event);',
                        autocomplete: "off"
                    });
                </script>
            </div>

            <div class="text_area_container" id="description_container">
                <script>
                    textField({
                        id: 'description',
                        title: 'Fund Transfer Description',
                        type: 'textarea',
                        rows: 1,
                        maxlength: '50',
                    });
                </script>
            </div>

            <div class="text_field_container" id="newBranchId_container">
                <script>
                    selectField({
                        id: 'newBranchId',
                        title: 'Select Branch To Transfer To'
                    });
                    _getSelectFundTransferBranch('newBranchId');
                </script>
            </div>

            <button class="btn" id="fundTransferBtn" title="Proceed To Transfer Funds"
                onclick="_transferBranchFunds();"> PROCEED <i class="bi bi-arrow-right"></i></button>
        </div>
    </div>
<?php } ?>