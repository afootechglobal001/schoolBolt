<div class="side-nav-div animated fadeInLeft">
    <div class="nav-back-div">
        <div class="nav-div active-li" title="Dashboard" onclick="_getActivePage({page:'dashboard', divid:'dashboard'});" id="side-dashboard">           
            <div class="icon"><i class="bi-speedometer2"></i> Dashboard</div> 
            <div class="hidden" id="_dashboard"><i class="bi-speedometer2"></i> Admin Dashboard Overview</div>
        </div>
        <script>
            if (userRoles.canViewBranch) {
                document.write(`
                    <div class="nav-div" title="Branches" onclick="_getActivePage({page:'branches', divid:'branches'});" id="side-branches">
                        <div class="icon"><i class="bi-diagram-3"></i> Branches</div> 
                        <div class="hidden" id="_branches"><i class="bi-diagram-3"></i> Branches</div>
                    </div>
                `);
            }
        </script>

        <script>
            if (userRoles.canViewSuperAdminDashboard && userRoles.canViewStaff) {
                document.write(`
                    <div class="nav-div" title="Staff" onclick="_getActivePage({page:'staff', divid:'staff'});" id="side-staff">
                        <div class="icon"><i class="bi-people"></i> Staff</div> 
                        <div class="hidden" id="_staff"><i class="bi-people"></i> Active Staff</div>
                    </div>
                `);
            }
        </script>

        <script>
            if (userRoles.canViewSuperAdminDashboard) {
                document.write(`
                    <div class="nav-div" title="Report" onclick="_getActivePage({nav:'reports', divid:'reports'});" id="side-reports">
                        <div class="icon"><i class="bi-graph-up-arrow"></i> Report</div> 
                    </div>
                `);
            }
        </script>
    </div>
</div>

<!--------------------------for nav sub div view----------------------------------------->

<div class="side-nav-bg-sub-div">

    <div class="nav-div animated fadeInLeft" id="link-reports">
        <div class="link" title="Product Report" onclick="_getPage('product_report','publish','');">- Income Report</div>
        <div class="hidden" id="_product_report"><i class="bi-boxes"></i> Income Report</div>

        <div class="link" title="Sales Report" onclick="_getPage('sales_report','products','');">- Expenses Report</div>
        <div class="hidden" id="_sales_report"><i class="bi-boxes"></i> Expenses Report</div>

        <div class="link" title="Wallet Report" onclick="_getPage('wallet_report','products','');">- Wallet Report</div>
        <div class="hidden" id="_wallet_report"><i class="bi-credit-card"></i> Wallet Report</div>

        <div class="link" title="Wallet Report" onclick="_getPage('wallet_report','products','');">- Staff Loans</div>
        <div class="hidden" id="_wallet_report"><i class="bi-credit-card"></i> Staff Loans</div>
    </div>
    
    <div class="nav-back-container" onclick="_closeNav();"></div>
</div>