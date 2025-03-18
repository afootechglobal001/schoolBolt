<?php if ($page=='dashboard'){?>
    <div class="page-title-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="page-title-div">
            <div class="top-title"><span id="page-title"><i class="bi-speedometer2"></i> Admin Dashboard Overview</span></div>
            <div class="main-title">👋 Hi, <span id="loginUserName">
                <script>$("#loginUserName").html(capitalizeFirstLetterOfEachWord(staffLoginData.fullName));</script>
            </span></div>
            <div class="bottom-title"><i class="bi-clock"></i> Last Login Date |  <span id="loginUserLastLogin">
                <script>$("#loginUserLastLogin").html(staffLoginData.lastLoginTime);</script></span>
            </div>
        </div>

        <div class="dashbaord-right-wrapper">
            <ul>
                <li title="Staff" onclick="_getActivePage({page:'staff', divid:'staff'});"><i class="bi-people"></i> Staff <div class="num" id="">150</div></li>
                <li title="Blog" onclick="_getPage('all_blogs','publish', '');"><i class="bi-journal"></i> Blog <div class="num" id="">50</div></li>
                <li title="Frequently Asked Questions" onclick="_getPage('all_faqs','publish', '');"><i class="bi-patch-question"></i> FAQS <div class="num" id="">10</div></li>
            </ul> 
        </div>
    </div>

    <div class="dashboard-statistics-wrapper">
        <div class="left-dashbaord-container">
            <div class="statistics-chart-back-div" data-aos="fade-in" data-aos-duration="1500">
                <div class="statistics-back-div">
                    <div class="statistics-div left-border" title="Branches" onclick="_getActivePage({page:'branches', divid:'branches'});">
                        <h2>12</h2> 
                        <span><i class="bi-diagram-3"></i> Branches</span>
                    </div>

                    <div class="statistics-div left-border border-radius" title="Customers" onclick="_getPage('customers','customers','');">
                        <h2>250</h2> 
                        <span><i class="bi-person"></i> Customers</span>
                    </div>

                    <div class="statistics-div" title="Products">
                        <h2>700</h2> 
                        <span><i class="bi-boxes"></i> Products </span>
                    </div>

                    <div class="statistics-div right-border" title="Combo">
                        <h2>20</h2> 
                        <span><i class="bi-basket"></i> Combo</span>
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
                                        <input class="text_field bar_cust_text_field" type="text" id="datepickers-from" placeholder=""/>
                                        <div class="placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> From</div>
                                    </div>

                                    <div class="text_field_container dash_field_container">
                                        <input class="text_field bar_cust_text_field" type="text" id="datepickers-to" placeholder=""/>
                                        <div class="placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> To</div>
                                    </div>
                                    <button type="button" class="btn">Apply</button>
                                </div>
                            </div>
                        </div>


                        <script language="javascript">
                            $('#datepickers-from').datetimepicker({
                                lang:'en',
                                timepicker:false,
                                format:'Y-m-d',
                                formatDate:'Y-M-d',
                            });
                            
                            $('#datepickers-to').datetimepicker({
                                lang:'en',
                                timepicker:false,
                                format:'Y-m-d',
                                formatDate:'Y-M-d',
                            });
                        </script>
                    </div>

                    <div class="trending-back-div">
                        <div class="revenue-back-div">
                            <div class="revenue-div top-rev">Revenue For<span>January 18 2025</span>-<span>February 17 2025</span></div>
                            <div class="revenue-div"><h3><span>₦1,343,581.63</span>(SALES)</h3>-<h3><span>₦256,000.00</span>(WALLET)</h3></div>
                        </div>

                        <div id="chartContainer" style="width:100%; height:300px; margin:auto;"></div>
                        <script>
                            $(document).ready(function() {
                                var chart = new CanvasJS.Chart("chartContainer", {
                                    animationEnabled: true,
                                    theme: "light1",
                                    title:{
                                        text: ""
                                    },
                                    axisX:{
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
                                    toolTip:{
                                        shared:true
                                    },  
                                    legend:{
                                        cursor:"pointer",
                                        verticalAlign: "bottom",
                                        horizontalAlign: "left",
                                        dockInsidePlotArea: true,
                                        itemclick: toogleDataSeries
                                    },
                                    data: [
                                    {
                                        type: "line",
                                        showInLegend: true,
                                        name: "Sales",
                                        markerType: "square",
                                        xValueFormatString: "DD MMM, YYYY",
                                        color: "#29BA00",
                                        dataPoints: [
                                            { x: new Date(2025, 0, 1), y: 250000 },
                                            { x: new Date(2025, 0, 2), y: 180000 },
                                            { x: new Date(2025, 0, 3), y: 100000 },
                                            { x: new Date(2025, 0, 4), y: 300000 },
                                            { x: new Date(2025, 0, 5), y: 120000 },
                                            { x: new Date(2025, 0, 6), y: 150000 },
                                            { x: new Date(2025, 0, 7), y: 275000 },
                                            { x: new Date(2025, 0, 8), y: 160000 },
                                            { x: new Date(2025, 0, 9), y: 350000 },
                                            { x: new Date(2025, 0, 10), y: 380000 },
                                            { x: new Date(2025, 0, 11), y: 0 },
                                            { x: new Date(2025, 0, 12), y: 100000 },
                                            { x: new Date(2025, 0, 13), y: 0 },
                                            { x: new Date(2025, 0, 14), y: 180000 },
                                            { x: new Date(2025, 0, 15), y: 270000 },
                                        ]
                                    },
                                    {
                                        type: "line",
                                        showInLegend: true,
                                        name: "Wallet",
                                        lineDashType: "dash",
                                        dataPoints: [
                                            { x: new Date(2025, 0, 1), y: 180000 },
                                            { x: new Date(2025, 0, 2), y: 50000 },
                                            { x: new Date(2025, 0, 3), y: 80000 },
                                            { x: new Date(2025, 0, 4), y: 0 },
                                            { x: new Date(2025, 0, 5), y: 150000 },
                                            { x: new Date(2025, 0, 6), y: 40000 },
                                            { x: new Date(2025, 0, 7), y: 300000 },
                                            { x: new Date(2025, 0, 8), y: 200000 },
                                            { x: new Date(2025, 0, 9), y: 0 },
                                            { x: new Date(2025, 0, 10), y: 120000 },
                                            { x: new Date(2025, 0, 11), y: 90000 },
                                            { x: new Date(2025, 0, 12), y: 200000 },
                                            { x: new Date(2025, 0, 13), y: 0 },
                                            { x: new Date(2025, 0, 14), y: 280000 },
                                            { x: new Date(2025, 0, 15), y: 50000 },
                                        
                                        ]
                                    }
                                ]

                                });
                                chart.render();

                                function toogleDataSeries(e){
                                    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                                        e.dataSeries.visible = false;
                                    } else{
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

        <div class="right-dashbaord-container" data-aos="fade-in" data-aos-duration="1500">
            <div class="matrix-div">
                <div class="inner-div">
                    <div class="title"><h3>Order Matrix</h3></div>
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
                            yValueFormatString:"#,##0.#"%"",
                            dataPoints: [
                            { label: "Outstanding", y: 5},
                            { label: "Pending", y: 6},
                            { label: "Processing", y: 4},
                            { label: "Ready", y: 5},
                            { label: "Delivered", y: 15},
                            ]
                            }]
                            };
                        $("#chartContainer1").CanvasJSChart(options);
                    </script>
                </div>                     
            </div>

            <div class="matrix-div">
                <div class="inner-div">
                    <div class="title"><h3>Payment Matrix</h3></div>
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
                            yValueFormatString:"#,##0.#"%"",
                            dataPoints: [
                            { label: "Debit/Credit Card", y: 3},
                            { label: "Wallet", y: 2},
                            { label: "Bank Transfer", y: 11},
                            ]
                            }]
                        };
                        $("#chartContainer2").CanvasJSChart(options);
                    </script>
                </div>                     
            </div>
        </div>
    </div>
<?php }?>

<?php if ($page == 'logout_confirm_form') { ?>
    <div class="caption-success-div animated zoomIn">
        <div class="div-in">
            <div class="img"><img src="<?php echo $websiteUrl?>/all-images/images/warning.gif"/></div>
            <h2>Are you sure to log-out?</h2>
            Please, confirm your log-out action.
            <div class="btn-div">
                <button class="btn" onclick="_logOut();">YES</button>
                <button class="btn no-btn" onclick="_alertClose(<?php echo $modalLayer?>);">NO</button>
            </div>
        </div>
    </div>
<?php } ?>