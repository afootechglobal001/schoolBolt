<?php if ($page == 'branches') { ?>
    <div class="page-title-back-div other-pages-title-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="page-title-div">
            <div class="main-title title"><i class="bi-diagram-3"></i> <strong>Branches</strong></div>
            <div class="bottom-title">
                Active: <span id="active-staff">10</span> |
                Suspended: <span>5</span>
            </div>
        </div>

        <div class="other-pages-filter-div">
            <div class="text-field-wrapper">
                <div class="text_field_container search_field_container">
                    <input class="text_field dash_text_field" type="text" id="searchBranches" onkeyup="filters('Branches')" placeholder="" title="Type here to serach role..." />
                    <div class="placeholder dash_placeholder"><i class="bi-search"></i> Type here to search branch...</div>
                </div>
            </div>

            <div class="btn-div">
                <button class="btn" type="button" title="ADD NEW BRANCH" onclick="_getForm({page: 'branch_reg', url: adminPortalLocalUrl});">
                    <i class="bi-plus-square"></i> ADD NEW BRANCH
                </button>
            </div>

        </div>
    </div>

    <div class="pages-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="table-div animated fadeIn">
            <table class="table" cellspacing="0" style="width:100%" id="fetchAllBranches">
                <script>
                    _fetchBranches();
                </script>
            </table>
        </div>
    </div>
<?php } ?>


<?php if ($page == 'branch_reg') { ?>
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD A NEW BRANCH</span>
                <div class="close" title="Close" onclick="_alertClose();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly fill the form below to <span> ADD A NEW BRANCH</span></div>
                </div>

                <div class="text_field_container" id="name_container">
                    <script>
                        textField({
                            id: 'name',
                            title: 'Branch Name'
                        });
                    </script>
                </div>

                <div class="text_field_container" id="mobileNumber_container">
                    <script>
                        textField({
                            id: 'mobileNumber',
                            title: 'Branch Phone Number',
                            type: 'tel',
                            onKeyPressFunction: 'isNumberCheck(event);'
                        });
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
                            title: 'Branch Address'
                        });
                    </script>
                </div>

                <div class="alert alert-success form-alert"><span>BRANCH SMTP INFORMATIONS</span>
                    <div class="text_field_back_container">
                        <div class="text_field_container" id="smtpHost_container">
                            <script>
                                textField({
                                    id: 'smtpHost',
                                    title: 'SMTP HOST'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="smtpUsername_container">
                            <script>
                                textField({
                                    id: 'smtpUsername',
                                    title: 'SMTP USERNAME'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="smtpPassword_container">
                            <script>
                                textField({
                                    id: 'smtpPassword',
                                    title: 'SMTP PASSWORD',
                                    type: 'password'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="smtpPort_container">
                            <script>
                                textField({
                                    id: 'smtpPort',
                                    title: 'SMTP PORT',
                                    type: 'number'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="supportEmail_container">
                            <script>
                                textField({
                                    id: 'supportEmail',
                                    title: 'SUPPORT EMAIL',
                                    type: 'email'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="paymentKey_container">
                            <script>
                                textField({
                                    id: 'paymentKey',
                                    title: 'PAYMENT KEY'
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="text_field_container" id="staffId_container">
                    <script>
                        selectField({
                            id: 'staffId',
                            title: 'Select Branch Manager'
                        });
                        _getSelectBranchManagerId('staffId');
                    </script>
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
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createBranch();"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'branch_profile') { ?>
    <script> getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession")); </script>

    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="top-panel-div">
            <div class="inner-top">
                <span><i class="bi-diagram-3"></i> BRANCH PROFILE</span>
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
                                <div class="name" id="name">
                                    <script>$("#name").html(getEachBranchDetailsSession.name);</script>
                                </div>
                                
                                <div class="text">
                                    <div>
                                        <div id="statusBtn" class="status-btn"><span id="statusName"></span></div>
                                    </div> 
                                    | OFFICIAL EMAIL: 
                                    <strong id="smtpUsername"><script>$("#smtpUsername").html(getEachBranchDetailsSession.smtpUsername);</script></strong>
                                </div>
                                
                                <script>
                                    $(document).ready(function() {
                                        const statusName = getEachBranchDetailsSession.statusName;
                                        $("#statusName").html(statusName);
                                        $("#statusBtn").addClass(statusName);
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-div branch-btn-div">
                <div class="div-in">
                    <ul>
                        <li class="active" title="Dashboard" id="branch_dashboard" onclick="_getActiveBranchPage({divid:'branch_dashboard', page: 'branch_dashboard', url: adminPortalLocalUrl});"><i class="bi-speedometer2"></i> Dashboard</li>
                        <li title="Products" id="branch_products" onclick="_getBranchModal('branch_products','branch_products','<?php echo $branch_id ?>')"><i class="bi-boxes"></i> Products</li>
                        <li id="dotted" title="Branch Order"><i class="bi-clock"></i> Order
                            <div class="expand-div animated fadeIn">
                                <ul class="ul-expand">
                                    <li class="active" id="branch_unpaid_orders" title="Unpaid Order"
                                        onclick="_getActiveBranchPage({divid:'branch_unpaid_orders', page: 'branch_unpaid_orders', url: adminPortalLocalUrl});"><i class="bi-basket"></i>Unpaid Order</li>

                                    <li id="branch_pending_orders" title="Unprocessed Order"
                                        onclick="_getActiveBranchPage({divid:'branch_pending_orders', page: 'branch_pending_orders', url: adminPortalLocalUrl});"><i class="bi-basket"></i>Unprocessed Order</li>

                                    <li id="branch_attending_orders" title="Order In Progress"
                                        onclick="_getActiveBranchPage({divid:'branch_attending_orders', page: 'branch_attending_orders', url: adminPortalLocalUrl});"><i class="bi-basket"></i>Order In Progress</li>

                                    <li id="branch_ready_orders" title="Ready Order"
                                        onclick="_getActiveBranchPage({divid:'branch_ready_orders', page: 'branch_ready_orders', url: adminPortalLocalUrl});"><i class="bi-basket"></i>Ready Order</li>

                                    <li id="branch_delivered_orders" title="Delivered Order"
                                        onclick="_getActiveBranchPage({divid:'branch_delivered_orders', page: 'branch_delivered_orders', url: adminPortalLocalUrl});"><i class="bi-basket"></i>Delivered Order</li>
                                </ul>
                            </div>
                        </li>

                        <li id="dotted" title="Branch Report"><i class="bi-graph-up-arrow"></i> Report
                            <div class="expand-div animated fadeIn">
                                <ul class="ul-expand">
                                    <li title="Product Report"><i class="bi-graph-up-arrow"></i>Product Report</li>
                                    <li title="Sales Report"><i class="bi-graph-up-arrow"></i>Sales Report</li>
                                    <li title="Wallet Report"><i class="bi-graph-up-arrow"></i>Wallet Report</li>
                                </ul>
                            </div>
                        </li>
                        <li title="Branch Staff" id="branch_staff"
                            onclick="_getActiveBranchPage({divid:'branch_staff', page: 'branch_staff', url: adminPortalLocalUrl});"><i class="bi-person-bounding-box"></i> Staff</li>

                        <li title="Branch Profile" id="branch_profile_details"
                            onclick="_getActiveBranchPage({divid:'branch_profile_details', page: 'branch_profile_details', url: adminPortalLocalUrl});"><i class="bi-diagram-3"></i> Profile</li>

                        <li title="Branch Activities" id="branch_activities"
                            onclick="_getActiveBranchPage({divid:'branch_activities', page: 'branch_activities', url: adminPortalLocalUrl});"><i class="bi-bell"></i> Activities</li>
                    </ul>
                </div>
            </div>

            <div class="field-back-div background-color">
                <div class="field-inner-div branch-field-inner-div" id="get_branch_details">
                    <script>
                        _getActiveBranchPage({
                            divid: 'branch_dashboard',
                            page: 'branch_dashboard',
                            url: adminPortalLocalUrl
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
<?php } ?>



<!-- For Branch Modal Pages -->
<?php if ($page == 'branch_dashboard') { ?>
    <div class="dashboard-statistics-wrapper">
        <div class="left-dashbaord-container">
            <div class="statistics-chart-back-div box-shadow">
                <div class="statistics-back-div">
                    <div class="statistics-div left-border font-size" title="Unpaid Order" onclick="_getBranchModal('branch_unpaid_orders','branch_unpaid_orders','');">
                        <h2>5</h2>
                        <span><i class="bi-basket"></i> Unpaid Order</span>
                    </div>

                    <div class="statistics-div left-border border-radius font-size" title="Unprocessed Order" onclick="_getBranchModal('branch_pending_orders','branch_pending_orders','');">
                        <h2>8</h2>
                        <span><i class="bi-basket"></i> Unprocessed Order</span>
                    </div>

                    <div class="statistics-div font-size" title="Ready Order" onclick="_getBranchModal('branch_ready_orders','branch_ready_orders','');">
                        <h2>10</h2>
                        <span><i class="bi-basket font-size"></i> Ready Order </span>
                    </div>

                    <div class="statistics-div right-border font-size" title="Delivered Order" onclick="_getBranchModal('branch_delivered_orders','branch_delivered_orders','');">
                        <h2>100</h2>
                        <span><i class="bi-basket"></i> Delivered Order</span>
                    </div>
                </div>

                <div class="chart-back-div">
                    <div class="chart-div-notifications no-border-top">
                        <div class="text"><i class="bi-graph-up-arrow"></i> Showing Matrix for </div>

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
                                        <input class="text_field bar_cust_text_field" type="text" id="datepickers-from" placeholder="" />
                                        <div class="placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> From</div>
                                    </div>

                                    <div class="text_field_container dash_field_container">
                                        <input class="text_field bar_cust_text_field" type="text" id="datepickers-to" placeholder="" />
                                        <div class="placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> To</div>
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

                    <div class="trending-back-div">
                        <div class="revenue-back-div">
                            <div class="revenue-div top-rev">Revenue For<span>January 18 2025</span>-<span>February 17 2025</span></div>
                            <div class="revenue-div">
                                <h3><span>₦1,343,581.63</span>(SALES)</h3>-<h3><span>₦256,000.00</span>(WALLET)</h3>
                            </div>
                        </div>

                        <div id="chartContainer" style="width:100%; height:300px; margin:auto;"></div>
                        <script>
                            $(document).ready(function() {
                                var chart = new CanvasJS.Chart("chartContainer", {
                                    animationEnabled: true,
                                    theme: "light1",
                                    title: {
                                        text: ""
                                    },
                                    axisX: {
                                        valueFormatString: "DD MMM",
                                        crosshair: {
                                            enabled: true,
                                            snapToDataPoint: true
                                        }
                                    },
                                    axisY: {
                                        title: "",
                                        includeZero: true,
                                        crosshair: {
                                            enabled: true
                                        }
                                    },
                                    toolTip: {
                                        shared: true
                                    },
                                    legend: {
                                        cursor: "pointer",
                                        verticalAlign: "bottom",
                                        horizontalAlign: "left",
                                        dockInsidePlotArea: true,
                                        itemclick: toogleDataSeries
                                    },
                                    data: [{
                                            type: "line",
                                            showInLegend: true,
                                            name: "Sales",
                                            markerType: "square",
                                            xValueFormatString: "DD MMM, YYYY",
                                            color: "#29BA00",
                                            dataPoints: [{
                                                    x: new Date(2025, 0, 1),
                                                    y: 250000
                                                },
                                                {
                                                    x: new Date(2025, 0, 2),
                                                    y: 180000
                                                },
                                                {
                                                    x: new Date(2025, 0, 3),
                                                    y: 100000
                                                },
                                                {
                                                    x: new Date(2025, 0, 4),
                                                    y: 300000
                                                },
                                                {
                                                    x: new Date(2025, 0, 5),
                                                    y: 120000
                                                },
                                                {
                                                    x: new Date(2025, 0, 6),
                                                    y: 150000
                                                },
                                                {
                                                    x: new Date(2025, 0, 7),
                                                    y: 275000
                                                },
                                                {
                                                    x: new Date(2025, 0, 8),
                                                    y: 160000
                                                },
                                                {
                                                    x: new Date(2025, 0, 9),
                                                    y: 350000
                                                },
                                                {
                                                    x: new Date(2025, 0, 10),
                                                    y: 380000
                                                },
                                                {
                                                    x: new Date(2025, 0, 11),
                                                    y: 0
                                                },
                                                {
                                                    x: new Date(2025, 0, 12),
                                                    y: 100000
                                                },
                                                {
                                                    x: new Date(2025, 0, 13),
                                                    y: 0
                                                },
                                                {
                                                    x: new Date(2025, 0, 14),
                                                    y: 180000
                                                },
                                                {
                                                    x: new Date(2025, 0, 15),
                                                    y: 270000
                                                },
                                            ]
                                        },
                                        {
                                            type: "line",
                                            showInLegend: true,
                                            name: "Wallet",
                                            lineDashType: "dash",
                                            dataPoints: [{
                                                    x: new Date(2025, 0, 1),
                                                    y: 180000
                                                },
                                                {
                                                    x: new Date(2025, 0, 2),
                                                    y: 50000
                                                },
                                                {
                                                    x: new Date(2025, 0, 3),
                                                    y: 80000
                                                },
                                                {
                                                    x: new Date(2025, 0, 4),
                                                    y: 0
                                                },
                                                {
                                                    x: new Date(2025, 0, 5),
                                                    y: 150000
                                                },
                                                {
                                                    x: new Date(2025, 0, 6),
                                                    y: 40000
                                                },
                                                {
                                                    x: new Date(2025, 0, 7),
                                                    y: 300000
                                                },
                                                {
                                                    x: new Date(2025, 0, 8),
                                                    y: 200000
                                                },
                                                {
                                                    x: new Date(2025, 0, 9),
                                                    y: 0
                                                },
                                                {
                                                    x: new Date(2025, 0, 10),
                                                    y: 120000
                                                },
                                                {
                                                    x: new Date(2025, 0, 11),
                                                    y: 90000
                                                },
                                                {
                                                    x: new Date(2025, 0, 12),
                                                    y: 200000
                                                },
                                                {
                                                    x: new Date(2025, 0, 13),
                                                    y: 0
                                                },
                                                {
                                                    x: new Date(2025, 0, 14),
                                                    y: 280000
                                                },
                                                {
                                                    x: new Date(2025, 0, 15),
                                                    y: 50000
                                                },

                                            ]
                                        }
                                    ]

                                });
                                chart.render();

                                function toogleDataSeries(e) {
                                    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                                        e.dataSeries.visible = false;
                                    } else {
                                        e.dataSeries.visible = true;
                                    }
                                    chart.render();
                                }
                            })
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <div class="right-dashbaord-container">
            <div class="matrix-div">
                <div class="inner-div">
                    <div class="title">
                        <h3>Order Matrix</h3>
                    </div>
                    <div id="chartContainer1" style="width:100%; height:200px; margin:auto;"></div>

                    <script type="text/javascript">
                        var options = {
                            title: {
                                text: "" /*My Performance*/
                            },
                            data: [{
                                type: "pie",
                                startAngle: 45,
                                showInLegend: "False",
                                legendText: "{label}",
                                indexLabel: "{label} ({y})",
                                yValueFormatString: "#,##0.#" % "",
                                dataPoints: [{
                                        label: "Outstanding",
                                        y: 5
                                    },
                                    {
                                        label: "Pending",
                                        y: 6
                                    },
                                    {
                                        label: "Processing",
                                        y: 4
                                    },
                                    {
                                        label: "Ready",
                                        y: 5
                                    },
                                    {
                                        label: "Delivered",
                                        y: 15
                                    },
                                ]
                            }]
                        };
                        $("#chartContainer1").CanvasJSChart(options);
                    </script>
                </div>
            </div>

            <div class="matrix-div">
                <div class="inner-div">
                    <div class="title">
                        <h3>Payment Matrix</h3>
                    </div>
                    <div id="chartContainer2" style="width:100%; height:200px; margin:auto;"></div>

                    <script type="text/javascript">
                        var options = {
                            title: {
                                text: "" /*My Performance*/
                            },
                            data: [{
                                type: "pie",
                                startAngle: 45,
                                showInLegend: "False",
                                legendText: "{label}",
                                indexLabel: "{label} ({y})",
                                yValueFormatString: "#,##0.#" % "",
                                dataPoints: [{
                                        label: "Debit/Credit Card",
                                        y: 3
                                    },
                                    {
                                        label: "Wallet",
                                        y: 2
                                    },
                                    {
                                        label: "Bank Transfer",
                                        y: 11
                                    },
                                ]
                            }]
                        };
                        $("#chartContainer2").CanvasJSChart(options);
                    </script>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'branch_unpaid_orders') { ?>
    <div class="alert alert-success form-alert animated fadeIn"><span><i class="bi-basket"></i> BRANCH UNPAID ORDER LIST</span></div>

    <div class="table-div pages-table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="">
            <thead>
                <tr class="tb-col">
                    <th>Sn</th>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Phone Number</th>
                    <th>Items</th>
                    <th>(₦)Amount</th>
                    <th>Logistics</th>
                    <th>Order Status</th>
                    <th>Payment Method</th>
                    <th>Date</th>
                    <th>View</th>
                </tr>
            </thead>

            <tbody>
                <tr class="tb-row">
                    <td>1</td>
                    <td><span onclick="_getFormWithId('get_customer_order_items');">SHOP5964620250203090426</span></td>
                    <td>Paul Emmanuel</td>
                    <td>09029159943</td>
                    <td>10</td>
                    <td><span>₦60,000.00</span></td>
                    <td>DELIVERY</td>
                    <td class="unpaid-status PENDING">PENDING</td>
                    <td>BANK TRANSFER</td>
                    <td>2025-02-14 17:03:46</td>
                    <td><button class="btn" title="VIEW">VIEW</button></td>
                </tr>

                <tr class="tb-row">
                    <td>2</td>
                    <td><span onclick="_getFormWithId('get_customer_order_items');">SHOP5964620250203090428</span></td>
                    <td>Yakubu Ezekiel</td>
                    <td>08134958697</td>
                    <td>3</td>
                    <td><span>₦120,000.00</span></td>
                    <td>DELIVERY</td>
                    <td class="unpaid-status PENDING">PENDING</td>
                    <td>BANK TRANSFER</td>
                    <td>2025-02-14 17:03:46</td>
                    <td><button class="btn" title="VIEW">VIEW</button></td>
                </tr>
                <tr class="tb-row">
                    <td>3</td>
                    <td><span onclick="_getFormWithId('get_customer_order_items');">SHOP596462025020309044</span></td>
                    <td>Paul Emmanuel</td>
                    <td>09029159943</td>
                    <td>13</td>
                    <td><span>₦20,000.00</span></td>
                    <td>DELIVERY</td>
                    <td class="unpaid-status PENDING">PENDING</td>
                    <td>BANK TRANSFER</td>
                    <td>2025-02-14 17:03:46</td>
                    <td><button class="btn">VIEW</button></td>
                </tr>
                <tr class="tb-row">
                    <td>4</td>
                    <td><span onclick="_getFormWithId('get_customer_order_items');">SHOP5964620250203090421</span></td>
                    <td>Paul Emmanuel</td>
                    <td>09029159943</td>
                    <td>7</td>
                    <td><span>₦100,000.00</span></td>
                    <td>DELIVERY</td>
                    <td class="unpaid-status PENDING">PENDING</td>
                    <td>BANK TRANSFER</td>
                    <td>2025-02-14 17:03:46</td>
                    <td><button class="btn" title="VIEW">VIEW</button></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php } ?>

<?php if ($page == 'branch_pending_orders') { ?>
    <div class="alert alert-success form-alert animated fadeIn"><span><i class="bi-basket"></i> BRANCH UNPROCESSED ORDER</span></div>

    <div class="table-div pages-table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="">
            <thead>
                <tr class="tb-col">
                    <th>Sn</th>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Phone Number</th>
                    <th>Items</th>
                    <th>(₦)Amount</th>
                    <th>Logistics</th>
                    <th>Order Status</th>
                    <th>Payment Method</th>
                    <th>Date</th>
                    <th>Attend</th>
                </tr>
            </thead>

            <tbody>
                <tr class="tb-row">
                    <td>1</td>
                    <td><span onclick="_getFormWithId('get_customer_order_items');">SHOP5964620250203090426</span></td>
                    <td>Paul Emmanuel</td>
                    <td>09029159943</td>
                    <td>10</td>
                    <td><span>₦60,000.00</span></td>
                    <td>DELIVERY</td>
                    <td class="unpaid-status PENDING">PENDING</td>
                    <td>BANK TRANSFER</td>
                    <td>2025-02-14 17:03:46</td>
                    <td><button class="btn" title="ATTEND">ATTEND</button></td>
                </tr>

                <tr class="tb-row">
                    <td>2</td>
                    <td><span onclick="_getFormWithId('get_customer_order_items');">SHOP5964620250203090428</span></td>
                    <td>Yakubu Ezekiel</td>
                    <td>08134958697</td>
                    <td>3</td>
                    <td><span>₦120,000.00</span></td>
                    <td>DELIVERY</td>
                    <td class="unpaid-status PENDING">PENDING</td>
                    <td>BANK TRANSFER</td>
                    <td>2025-02-14 17:03:46</td>
                    <td><button class="btn" title="ATTEND">ATTEND</button></td>
                </tr>
                <tr class="tb-row">
                    <td>3</td>
                    <td><span onclick="_getFormWithId('get_customer_order_items');">SHOP596462025020309044</span></td>
                    <td>Paul Emmanuel</td>
                    <td>09029159943</td>
                    <td>13</td>
                    <td><span>₦20,000.00</span></td>
                    <td>DELIVERY</td>
                    <td class="unpaid-status PENDING">PENDING</td>
                    <td>BANK TRANSFER</td>
                    <td>2025-02-14 17:03:46</td>
                    <td><button class="btn" title="ATTEND">ATTEND</button></td>
                </tr>
                <tr class="tb-row">
                    <td>4</td>
                    <td><span onclick="_getFormWithId('get_customer_order_items');">SHOP5964620250203090421</span></td>
                    <td>Paul Emmanuel</td>
                    <td>09029159943</td>
                    <td>7</td>
                    <td><span>₦100,000.00</span></td>
                    <td>DELIVERY</td>
                    <td class="unpaid-status PENDING">PENDING</td>
                    <td>BANK TRANSFER</td>
                    <td>2025-02-14 17:03:46</td>
                    <td><button class="btn" title="ATTEND">ATTEND</button></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php } ?>

<?php if ($page == 'branch_attending_orders') { ?>
    <div class="alert alert-success form-alert animated fadeIn"><span><i class="bi-basket"></i> BRANCH ORDER IN PROGRESS</span></div>

    <div class="table-div pages-table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="">
            <thead>
                <tr class="tb-col">
                    <th>Sn</th>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Phone Number</th>
                    <th>Items</th>
                    <th>(₦)Amount</th>
                    <th>Logistics</th>
                    <th>Order Status</th>
                    <th>Attendant</th>
                    <th>Date</th>
                    <th>View</th>
                </tr>
            </thead>

            <tbody>
                <tr class="tb-row">
                    <td>1</td>
                    <td><span onclick="_getFormWithId('get_customer_order_items');">SHOP5964620250203090426</span></td>
                    <td>Paul Emmanuel</td>
                    <td>09029159943</td>
                    <td>10</td>
                    <td><span>₦60,000.00</span></td>
                    <td>DELIVERY</td>
                    <td class="PROCESSING">PROCESSING</td>
                    <td>ABAYOMI TAIWO</td>
                    <td>2025-02-14 17:03:46</td>
                    <td><button class="btn" title="VIEW">VIEW</button></td>
                </tr>

                <tr class="tb-row">
                    <td>2</td>
                    <td><span onclick="_getFormWithId('get_customer_order_items');">SHOP5964620250203090428</span></td>
                    <td>Yakubu Ezekiel</td>
                    <td>08134958697</td>
                    <td>3</td>
                    <td><span>₦120,000.00</span></td>
                    <td>DELIVERY</td>
                    <td class="PROCESSING">PROCESSING</td>
                    <td>ABAYOMI TAIWO</td>
                    <td>2025-02-14 17:03:46</td>
                    <td><button class="btn" title="VIEW">VIEW</button></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php } ?>

<?php if ($page == 'branch_ready_orders') { ?>
    <div class="alert alert-success form-alert animated fadeIn"><span><i class="bi-basket"></i> BRANCH READY ORDER</span></div>

    <div class="table-div pages-table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="">
            <thead>
                <tr class="tb-col">
                    <th>Sn</th>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Phone Number</th>
                    <th>Items</th>
                    <th>(₦)Amount</th>
                    <th>Logistics</th>
                    <th>Order Status</th>
                    <th>Attendant</th>
                    <th>Date</th>
                    <th>Deliver</th>
                </tr>
            </thead>

            <tbody>
                <tr class="tb-row">
                    <td>1</td>
                    <td><span onclick="_getFormWithId('get_customer_order_items');">SHOP5964620250203090426</span></td>
                    <td>Paul Emmanuel</td>
                    <td>09029159943</td>
                    <td>10</td>
                    <td><span>₦60,000.00</span></td>
                    <td>DELIVERY</td>
                    <td class="READY">READY</td>
                    <td>ABAYOMI TAIWO</td>
                    <td>2025-02-14 17:03:46</td>
                    <td><button class="btn" title="DELIVER">DELIVER</button></td>
                </tr>

                <tr class="tb-row">
                    <td>2</td>
                    <td><span onclick="_getFormWithId('get_customer_order_items');">SHOP5964620250203090428</span></td>
                    <td>Yakubu Ezekiel</td>
                    <td>08134958697</td>
                    <td>3</td>
                    <td><span>₦120,000.00</span></td>
                    <td>PICK-UP</td>
                    <td class="READY">READY</td>
                    <td>ABAYOMI TAIWO</td>
                    <td>2025-02-14 17:03:46</td>
                    <td><button class="btn" title="DELIVER">DELIVER</button></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php } ?>

<?php if ($page == 'branch_delivered_orders') { ?>
    <div class="alert alert-success form-alert animated fadeIn"><span><i class="bi-basket"></i> BRANCH DELIVERED ORDER</span></div>

    <div class="table-div pages-table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="">
            <thead>
                <tr class="tb-col">
                    <th>Sn</th>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Phone Number</th>
                    <th>Items</th>
                    <th>(₦)Amount</th>
                    <th>Logistics</th>
                    <th>Order Status</th>
                    <th>Attendant</th>
                    <th>Date</th>
                    <th>Delivery Attendant</th>
                </tr>
            </thead>

            <tbody>
                <tr class="tb-row">
                    <td>1</td>
                    <td><span onclick="_getFormWithId('get_customer_order_items');">SHOP5964620250203090426</span></td>
                    <td>Paul Emmanuel</td>
                    <td>09029159943</td>
                    <td>10</td>
                    <td><span>₦60,000.00</span></td>
                    <td>DELIVERY</td>
                    <td class="DELIVERED">DELIVERED</td>
                    <td>ABAYOMI TAIWO</td>
                    <td>2025-02-14 17:03:46</td>
                    <td>ABAYOMI TAIWO</td>
                </tr>

                <tr class="tb-row">
                    <td>2</td>
                    <td><span onclick="_getFormWithId('get_customer_order_items');">SHOP5964620250203090428</span></td>
                    <td>Yakubu Ezekiel</td>
                    <td>08134958697</td>
                    <td>3</td>
                    <td><span>₦120,000.00</span></td>
                    <td>PICK-UP</td>
                    <td class="DELIVERED">DELIVERED</td>
                    <td>ABAYOMI TAIWO</td>
                    <td>2025-02-14 17:03:46</td>
                    <td>ABAYOMI TAIWO</td>
                </tr>

                <tr class="tb-row">
                    <td>3</td>
                    <td><span onclick="_getFormWithId('get_customer_order_items');">SHOP5964620250203090428</span></td>
                    <td>Yakubu Ezekiel</td>
                    <td>08134958697</td>
                    <td>3</td>
                    <td><span>₦120,000.00</span></td>
                    <td>PICK-UP</td>
                    <td class="DELIVERED">DELIVERED</td>
                    <td>ABAYOMI TAIWO</td>
                    <td>2025-02-14 17:03:46</td>
                    <td>ABAYOMI TAIWO</td>
                </tr>

                <tr class="tb-row">
                    <td>4</td>
                    <td><span onclick="_getFormWithId('get_customer_order_items');">SHOP5964620250203090428</span></td>
                    <td>Yakubu Ezekiel</td>
                    <td>08134958697</td>
                    <td>3</td>
                    <td><span>₦120,000.00</span></td>
                    <td>PICK-UP</td>
                    <td class="DELIVERED">DELIVERED</td>
                    <td>ABAYOMI TAIWO</td>
                    <td>2025-02-14 17:03:46</td>
                    <td>ABAYOMI TAIWO</td>
                </tr>
            </tbody>
        </table>
    </div>
<?php } ?>

<?php if ($page == 'branch_activities') { ?>
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

<?php if ($page == 'branch_profile_details') { ?>
    <div class="user-in branch-user-in">
        <div class="title">BRANCH BASIC INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-1" id="updateName_container">
                <script>
                    textField({
                        id: 'updateName',
                        title: 'Branch Name',
                        value: getEachBranchDetailsSession?.name ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateMobileNumber_container">
                <script>
                    textField({
                        id: 'updateMobileNumber',
                        title: 'Branch Phone Number',
                        type: 'tel',
                        value: getEachBranchDetailsSession?.mobileNumber ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="branchStateId_container">
                <script>
                    selectField({
                        id: 'branchStateId',
                        title: 'Select Branch State',
                        fieldValue: getEachBranchDetailsSession?.stateId?? '',
                        fieldLabel: getEachBranchDetailsSession?.stateName?? ''
                    });
                    _getSelectBranchState('branchStateId');
                </script>
            </div>

            <div class="text_field_container col-1" id="branchLgaId_container">
                <script>
                    selectField({
                        id: 'branchLgaId',
                        title: 'Select Branch Local Govt Area',
                        fieldValue: getEachBranchDetailsSession?.lgaId?? '',
                        fieldLabel: getEachBranchDetailsSession?.lgaName?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-2" id="updateAddress_container">
                <script>
                    textField({
                        id: 'updateAddress',
                        title: 'Branch Address',
                        value: getEachBranchDetailsSession?.address ?? ''
                    });
                </script>
            </div>

        </div>
    </div>

    <div class="user-in branch-user-in">
        <div class="title">BRANCH SMTP INFORMATIONS</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-1" id="updateSmtpHost_container">
                <script>
                    textField({
                        id: 'updateSmtpHost',
                        title: 'SMTP HOST',
                        value: getEachBranchDetailsSession?.smtpHost ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateSmtpUsername_container">
                <script>
                    textField({
                        id: 'updateSmtpUsername',
                        title: 'SMTP USERNAME',
                        value: getEachBranchDetailsSession?.smtpUsername ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateSmtpPassword_container">
                <script>
                    textField({
                        id: 'updateSmtpPassword',
                        title: 'SMTP PASSWORD',
                        type: 'password',
                        value: getEachBranchDetailsSession?.smtpPassword ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateSmtpPort_container">
                <script>
                    textField({
                        id: 'updateSmtpPort',
                        title: 'SMTP PORT',
                        type: 'number',
                        value: getEachBranchDetailsSession?.smtpPort ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateSupportEmail_container">
                <script>
                    textField({
                        id: 'updateSupportEmail',
                        title: 'SUPPORT EMAIL',
                        type: 'email',
                        value: getEachBranchDetailsSession?.supportEmail ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updatePaymentKey_container">
                <script>
                    textField({
                        id: 'updatePaymentKey',
                        title: 'PAYMENT KEY',
                        value: getEachBranchDetailsSession?.paymentKey ?? ''
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="user-in branch-user-in">
        <div class="title">BRANCH ACCOUNT INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-1" id="staffId_container">
                <script>
                    textField({
                        id: 'staffId',
                        title: 'Branch ID',
                        value: getEachBranchDetailsSession?.branchId ?? '',
                        readonly: true
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="createdTime_container">
                <script>
                    textField({
                        id: 'createdTime',
                        title: 'Date Of Registration',
                        value: getEachBranchDetailsSession?.createdTime ?? '',
                        readonly: true
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateStaffId_container">
                <script>
                    selectField({
                        id: 'updateStaffId',
                        title: 'Select Branch Manager',
                        fieldValue: getEachBranchDetailsSession?.managerId?? '',
                        fieldLabel: getEachBranchDetailsSession?.managerName?? ''
                    });
                    _getSelectBranchManagerId('updateStaffId');
                </script>
            </div>

            <div class="text_field_container col-1" id="updateStatusId_container">
                <script>
                    selectField({
                        id: 'updateStatusId',
                        title: 'Select Status',
                        fieldValue: getEachBranchDetailsSession?.statusId?? '',
                        fieldLabel: getEachBranchDetailsSession?.statusName?? ''
                    });
                    _getSelectStatusId('updateStatusId', '1,2');
                </script>
            </div>
        </div>

        <div class="btn-div">
            <button class="btn" title="UPDATE PROFILE" id="updateBtn" onclick="_updateBranch();"> UPDATE PROFILE <i class="bi-check"></i></button>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'branch_staff') { ?>
    <div class="alert alert-success form-alert animated fadeIn"><span><i class="bi-person-bounding-box"></i> BRANCH STAFF LIST</span></div>

    <div class="table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="fetchAllStaff">
            <thead>
                <tr class="tb-col">
                    <th>sn</th>
                    <th>User Name</th>
                    <th>Email Address</th>
                    <th>Role</th>
                    <th>Last Login</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <tr class="tb-row">
                    <td>1</td>
                    <td class="clickable-td" title="Click to view staff profile" onclick="_getFormWithId('update_staff','');">
                        <div class="image-div"><img src="<?php echo $websiteUrl ?>/all-images/images/avatar.jpg" alt="Paul Emmanuel" /></div> Paul Emmanuel
                    </td>
    </div>
    <td>seuemmanuel107@gmail.com</td>
    <td>Super Admin</td>
    <td>2024-11-18 03:28:41</td>
    <td>
        <div class="status-div ACTIVE">ACTIVE</div>
    </td>
    </tr>

    <tr class="tb-row">
        <td>2</td>
        <td class="clickable-td" title="Click to view staff profile">
            <div class="image-div"><img src="<?php echo $websiteUrl ?>/all-images/images/avatar.jpg" alt="Arinsola Olutayo" /></div> Arinsola Olutayo
        </td>
        </div>
        <td>arinsola@gmail.com</td>
        <td>Admin</td>
        <td>2024-11-18 03:28:41</td>
        <td>
            <div>
                <div class="status-div ACTIVE">ACTIVE</div>
            </div>
        </td>
    </tr>

    <tr class="tb-row">
        <td>3</td>
        <td class="clickable-td" title="Click to view staff profile">
            <div class="image-div"><img src="<?php echo $websiteUrl ?>/all-images/images/avatar.jpg" alt="Paul Emmanuel" /></div> Yakubu Ezekiel
        </td>
        </div>
        <td>yakubu200@gmail.com</td>
        <td>Staff</td>
        <td>2024-11-18 03:28:41</td>
        <td>
            <div>
                <div class="status-div ACTIVE">ACTIVE</div>
            </div>
        </td>
    </tr>

    <tr class="tb-row">
        <td>4</td>
        <td class="clickable-td" title="Click to view staff profile">
            <div class="image-div"><img src="<?php echo $websiteUrl ?>/all-images/images/avatar.jpg" alt="Balogun Samuel" /></div> Balogun Samuel
        </td>
        </div>
        <td>balogun200@gmail.com</td>
        <td>Staff</td>
        <td>2024-11-18 03:28:41</td>
        <td>
            <div>
                <div class="status-div SUSPENDED">SUSPENDED</div>
            </div>
        </td>
    </tr>
    </tbody>
    </table>
    </div>
<?php } ?>