<?php if ($page == 'customers') { ?>
    <div class="page-title-back-div other-pages-title-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="page-title-div">
            <div class="main-title title"><i class="bi-people"></i> <strong>Users</strong></div>
            <div class="bottom-title">
                Active: <span id="">10</span> |
                Suspended: <span>5</span>
            </div>
        </div>

        <div class="other-pages-filter-div">
            <div class="text-field-wrapper">
                <div class="text_field_container search_field_container">
                    <input class="text_field dash_text_field" type="text" id="searchCustomers" onkeyup="filters('Customers')" placeholder="" title="Type here to serach role..." />
                    <div class="placeholder dash_placeholder"><i class="bi-search"></i> Type here to search branch...</div>
                </div>
            </div>
        </div>
    </div>

    <div class="pages-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="table-div animated fadeIn">
            <table class="table" cellspacing="0" style="width:100%" id="fetchAllCustomers">
                <thead>
                    <tr class="tb-col">
                        <th>sn</th>
                        <th>User Name</th>
                        <th>Email Address</th>
                        <th>Phone Number</th>
                        <th>Wallet Balance</th>
                        <th>Last Login</th>
                        <th>Date of Reg.</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="tb-row">
                        <td>1</td>
                        <td class="clickable-td" title="Click to view user" onclick="_getForm({page: 'customers_profile', url: adminPortalLocalUrl});">
                            <div class="text-back-div">
                                <div class="image-div">
                                    <img src="<?php echo $websiteUrl ?>/all-images/images/avatar.jpg" alt="Johnson Agida" />
                                </div>

                                <div class="text-div">
                                    <div class="first-class">JOHNSON AGIDA</div>
                                    <div class="second-class">BM20220605070858002</div>
                                </div>
                            </div>
                        </td>
                        <td>johnson120@gmail.com</td>
                        <td>09029148593</td>
                        <td class="clickable-td">NGN 100,000.00</td>
                        <td>2024-11-18 03:28:41</td>
                        <td>2024-11-18 03:28:41</td>
                        <td>
                            <div class="status-div ACTIVE">ACTIVE</div>
                        </td>
                    </tr>

                    <tr class="tb-row">
                        <td>2</td>
                        <td class="clickable-td" title="Click to view user">
                            <div class="text-back-div">
                                <div class="image-div">
                                    <img src="<?php echo $websiteUrl ?>/all-images/images/avatar.jpg" alt="Clement Smith" />
                                </div>

                                <div class="text-div">
                                    <div class="first-class">CLEMENT SMITH</div>
                                    <div class="second-class">BM20220605070858003</div>
                                </div>
                            </div>
                        </td>
                        <td>clement@gmail.com</td>
                        <td>070394859435</td>
                        <td class="clickable-td">NGN 200,000.00</td>
                        <td>2024-11-18 03:28:41</td>
                        <td>2024-11-18 03:28:41</td>
                        <td>
                            <div>
                                <div class="status-div ACTIVE">ACTIVE</div>
                            </div>
                        </td>
                    </tr>

                    <tr class="tb-row">
                        <td>3</td>
                        <td class="clickable-td" title="Click to view user">
                            <div class="text-back-div">
                                <div class="image-div">
                                    <img src="<?php echo $websiteUrl ?>/all-images/images/avatar.jpg" alt="Yakubu Ezekiel<" />
                                </div>

                                <div class="text-div">
                                    <div class="first-class">YAKUBU EZEKIEL</div>
                                    <div class="second-class">BM20220605070858004</div>
                                </div>
                            </div>
                        </td>
                        <td>yakubu200@gmail.com</td>
                        <td>09029172837</td>
                        <td class="clickable-td">NGN 300,000.00</td>
                        <td>2024-11-18 03:28:41</td>
                        <td>2024-11-18 03:28:41</td>
                        <td>
                            <div>
                                <div class="status-div ACTIVE">ACTIVE</div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'customers_profile') { ?>
    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="top-panel-div">
            <div class="inner-top">
                <span><i class="bi-person-check-fill"></i> USER PROFILE</span>
                <div class="close" title="Close" onclick="_alertClose();">X</div>
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
                                <div class="name" id="staff_login_fullname">HON. EMMANUEL PAUL</div>
                                <div class="text">
                                    <div>
                                        <div class="status-btn ACTIVE"><span>ACTIVE</span></div>
                                    </div> 
                                    | LAST LOGIN DATE: <strong id="last_login_time">2024-11-18 03:28:41</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-div">
                <div class="div-in">
                    <ul>
                        <li class="active" title="Dashboard" id="customer_dashboard" onclick="_getActiveCustomerPage({divid:'customer_dashboard', page: 'customer_dashboard', url: adminPortalLocalUrl});"><i class="bi-speedometer2"></i> Dashboard</li>
                        <li title="Order History" id="order_history" onclick="_getActiveCustomerPage({divid:'order_history', page: 'order_history', url: adminPortalLocalUrl});"><i class="bi-clock"></i> Order History</li>
                        <li title="Wallet History" id="wallet_history" onclick="_getActiveCustomerPage({divid:'wallet_history', page: 'wallet_history', url: adminPortalLocalUrl});"><i class="bi-credit-card"></i> Wallet History</li>
                        <li title="Customer Profile" id="customer_profile_details" onclick="_getActiveCustomerPage({divid:'customer_profile_details', page: 'customer_profile_details', url: adminPortalLocalUrl});"><i class="bi-person-bounding-box"></i> Customer Profile</li>
                        <li title="Customer Activities" id="cutomer_activities" onclick="_getActiveCustomerPage({divid:'cutomer_activities', page: 'cutomer_activities', url: adminPortalLocalUrl});"><i class="bi-bell"></i> Customer Activities</li>
                    </ul>
                </div>
            </div>

            <div class="field-back-div">
                <div class="field-inner-div" id="get_customer_details">
                    <script>
                        _getActiveCustomerPage({
                            divid: 'customer_dashboard',
                            page: 'customer_dashboard',
                            url: adminPortalLocalUrl
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- For Customers Modal Pages -->
<?php if ($page == 'customer_dashboard') { ?>
    <div class="user-dashboard-list-wrapper">
        <div class="dashboard-list-div">
            <div class="inner-div">
                <div class="top-container">
                    <div class="top-title">
                        <h3>WALLET BALANCE</h3>
                    </div>
                    <button class="btn" title="Load Wallet" onclick="_getForm('load_user_wallet');"><i class="bi-credit-card"></i> Load Wallet</button>
                </div>

                <div class="wallet-details-wrapper">
                    <div class="wallet-details">
                        <h3>NGN 640,000.00</h3>
                        <h4>TOTAL AMOUNT RECEIVED</h4>
                    </div>

                    <div class="wallet-details">
                        <h3>NGN 466,484.92</h3>
                        <h4>TOTAL AMOUNT SPENT</h4>
                    </div>

                    <div class="wallet-details border-none">
                        <h3>NGN 173,515.08</h3>
                        <h4>AVAILABLE BALANCE</h4>
                    </div>
                </div>

                <div class="top-container">
                    <div class="top-title">
                        <h3>WALLET ACTIVITIES</h3>
                    </div>
                </div>

                <div class="table-div animated fadeIn">
                    <table class="table" cellspacing="0" style="width:100%" id="fetchAllHosting">
                        <thead>
                            <tr class="tb-col">
                                <th>Date</th>
                                <th>Trans ID</th>
                                <th>Balance Before</th>
                                <th>(₦)Amount Loaded</th>
                                <th>Balance After</th>
                                <th>Trans Type</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="tb-row">
                                <td>2025-02-12 17:03:46</td>
                                <td>TRC23220250213</td>
                                <td><span>NGN 10,000.00</span></td>
                                <td>NGN 5,000.00</td>
                                <td><span>NGN 15,000.00</span></td>
                                <td>CREDIT</td>
                                <td>
                                    <div class="status-div SUCCESS">SUCCESS</div>
                                </td>
                            </tr>

                            <tr class="tb-row">
                                <td>2025-02-12 17:03:46</td>
                                <td>TRC23220250233</td>
                                <td><span>NGN 0.00</span></td>
                                <td><span class="CANCELLED">NGN 5,000.00</span></td>
                                <td><span>NGN 0.00</span></td>
                                <td>CREDIT</td>
                                <td>
                                    <div class="status-div CANCELLED">CANCELLED</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="dashboard-list-div">
            <div class="inner-div">
                <div class="top-container">
                    <div class="top-title">
                        <h3>RECENT ORDER HISTORY</h3>
                    </div>
                </div>

                <div class="table-div animated fadeIn">
                    <table class="table" cellspacing="0" style="width:100%" id="fetchAllHosting">
                        <thead>
                            <tr class="tb-col">
                                <th>Date</th>
                                <th>Order ID</th>
                                <th>Items</th>
                                <th>(₦)Amount</th>
                                <th>Logistics</th>
                                <th>Order Status</th>
                                <th>Payment Method</th>
                                <th>Payment Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="tb-row">
                                <td>2025-02-14 17:03:46</td>
                                <td><span title="Click to view order details" onclick="_getFormWithId('get_order_items');">SHOP5964620250203090426</span></td>
                                <td>10</td>
                                <td><span>₦60,000.00</span></td>
                                <td>DELIVERY</td>
                                <td class="order-status DELIVERED">DELIVERED</td>
                                <td>DEBIT/CREDIT CARD</td>
                                <td>
                                    <div class="status-div SUCCESS">SUCCESS</div>
                                </td>
                            </tr>

                            <tr class="tb-row">
                                <td>2025-02-12 17:03:46</td>
                                <td><span>SHOP5964620250203090431</span></td>
                                <td>20</td>
                                <td><span>₦120,000.00</span></td>
                                <td>PICK-UP</td>
                                <td class="order-status READY">READY</td>
                                <td>DEBIT/CREDIT CARD</td>
                                <td>
                                    <div class="status-div SUCCESS">SUCCESS</div>
                                </td>
                            </tr>

                            <tr class="tb-row">
                                <td>2025-02-22 17:03:46</td>
                                <td><span>SHOP5964620250203090411</span></td>
                                <td>15</td>
                                <td><span>₦100,000.00</span></td>
                                <td>DELIVERY</td>
                                <td class="order-status PENDING">PENDING</td>
                                <td>BANK TRANSFER</td>
                                <td>
                                    <div class="status-div SUCCESS">SUCCESS</div>
                                </td>
                            </tr>
                            <tr class="tb-row">
                                <td>2025-02-15 17:03:46</td>
                                <td><span>SHOP5964620250203090427</span></td>
                                <td>10</td>
                                <td><span>₦10,000.00</span></td>
                                <td>DELIVERY</td>
                                <td class="order-status READY">READY</td>
                                <td>DEBIT/CREDIT CARD</td>
                                <td>
                                    <div class="status-div SUCCESS">SUCCESS</div>
                                </td>
                            </tr>

                            <tr class="tb-row">
                                <td>2025-02-11 17:03:46</td>
                                <td><span>SHOP5964620250203090478</span></td>
                                <td>12</td>
                                <td><span>₦5,000.00</span></td>
                                <td>PICK-UP</td>
                                <td class="order-status DELIVERED">DELIVERED</td>
                                <td>BANK TRANSFER</td>
                                <td>
                                    <div class="status-div PENDING">PENDING</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'customer_profile_details') { ?>
    <div class="user-in">
        <div class="title">CUSTOMER BASIC INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-1" id="fullName_container">
                <script>
                    textField({
                        id: 'fullName',
                        title: 'First Name'
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="email_container">
                <script>
                    textField({
                        id: 'email',
                        title: 'Email Address',
                        type: 'email'
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="phoneNumber_container">
                <script>
                    textField({
                        id: 'phoneNumber',
                        title: 'Phone Number',
                        type: 'tel'
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="address_container">
                <script>
                    textField({
                        id: 'address',
                        title: 'Home Address'
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="user-in">
        <div class="title">CUSTOMER ACCOUNT INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-1" id="customerId_container">
                <script>
                    textField({
                        id: 'customerId',
                        title: 'Customer ID'
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="createdTime_container">
                <script>
                    textField({
                        id: 'createdTime',
                        title: 'Date Of Registration'
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="lastLogin_container">
                <script>
                    textField({
                        id: 'lastLogin',
                        title: 'Last Login Date'
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="searchStatus_container">
                <script>
                    selectField({
                        id: 'searchStatus',
                        title: 'Select Status'
                    });
                    _getSelectStatus('searchStatus');
                </script>
            </div>
        </div>

        <div class="btn-div">
            <button class="btn" type="button" title="UPDATE PROFILE" id="update_btn" onclick=""> UPDATE PROFILE <i class="bi-check"></i></button>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'order_history') { ?>
    <div class="chart-div-notifications user-details-notf">
        <div class="text"><i class="bi-graph-up-arrow"></i> Showing Order History for </div>

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

    <div class="table-div pages-table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="">
            <thead>
                <tr class="tb-col">
                    <th>Date</th>
                    <th>Order ID</th>
                    <th>Items</th>
                    <th>(₦)Amount</th>
                    <th>Logistics</th>
                    <th>Order Status</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                </tr>
            </thead>

            <tbody>
                <tr class="tb-row">
                    <td>2025-02-14 17:03:46</td>
                    <td><span onclick="_getFormWithId('get_customer_order_items');">SHOP5964620250203090426</span></td>
                    <td>10</td>
                    <td><span>₦60,000.00</span></td>
                    <td>DELIVERY</td>
                    <td class="order-status DELIVERED">DELIVERED</td>
                    <td>DEBIT/CREDIT CARD</td>
                    <td>
                        <div class="status-div SUCCESS">SUCCESS</div>
                    </td>
                </tr>

                <tr class="tb-row">
                    <td>2025-02-12 17:03:46</td>
                    <td><span>SHOP5964620250203090431</span></td>
                    <td>20</td>
                    <td><span>₦120,000.00</span></td>
                    <td>PICK-UP</td>
                    <td class="order-status READY">READY</td>
                    <td>DEBIT/CREDIT CARD</td>
                    <td>
                        <div class="status-div SUCCESS">SUCCESS</div>
                    </td>
                </tr>

                <tr class="tb-row">
                    <td>2025-02-22 17:03:46</td>
                    <td><span>SHOP5964620250203090411</span></td>
                    <td>15</td>
                    <td><span>₦100,000.00</span></td>
                    <td>DELIVERY</td>
                    <td class="order-status PENDING">PENDING</td>
                    <td>BANK TRANSFER</td>
                    <td>
                        <div class="status-div SUCCESS">SUCCESS</div>
                    </td>
                </tr>
                <tr class="tb-row">
                    <td>2025-02-15 17:03:46</td>
                    <td><span>SHOP5964620250203090427</span></td>
                    <td>10</td>
                    <td><span>₦10,000.00</span></td>
                    <td>DELIVERY</td>
                    <td class="order-status READY">READY</td>
                    <td>DEBIT/CREDIT CARD</td>
                    <td>
                        <div class="status-div SUCCESS">SUCCESS</div>
                    </td>
                </tr>

                <tr class="tb-row">
                    <td>2025-02-11 17:03:46</td>
                    <td><span>SHOP5964620250203090478</span></td>
                    <td>12</td>
                    <td><span>₦5,000.00</span></td>
                    <td>PICK-UP</td>
                    <td class="order-status DELIVERED">DELIVERED</td>
                    <td>BANK TRANSFER</td>
                    <td>
                        <div class="status-div PENDING">PENDING</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<?php } ?>

<?php if ($page == 'wallet_history') { ?>
    <div class="chart-div-notifications user-details-notf">
        <div class="text"><i class="bi-graph-up-arrow"></i> Showing Wallet History for </div>

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

    <div class="table-div pages-table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="">
            <thead>
                <tr class="tb-col">
                    <th>Date</th>
                    <th>Trans ID</th>
                    <th>Balance Before</th>
                    <th>(₦)Amount Loaded</th>
                    <th>Balance After</th>
                    <th>Trans Type</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <tr class="tb-row">
                    <td>2025-02-12 17:03:46</td>
                    <td>TRC23220250213</td>
                    <td><span>NGN 10,000.00</span></td>
                    <td>NGN 5,000.00</td>
                    <td><span>NGN 15,000.00</span></td>
                    <td>CREDIT</td>
                    <td>
                        <div class="status-div SUCCESS">SUCCESS</div>
                    </td>
                </tr>

                <tr class="tb-row">
                    <td>2025-02-12 17:03:46</td>
                    <td>TRC23220250233</td>
                    <td><span>NGN 0.00</span></td>
                    <td><span class="CANCELLED">NGN 5,000.00</span></td>
                    <td><span>NGN 0.00</span></td>
                    <td>CREDIT</td>
                    <td>
                        <div class="status-div CANCELLED">CANCELLED</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<?php } ?>

<?php if ($page == 'cutomer_activities') { ?>
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