<script>
    function writeSidebarItems(navId) {
        document.write(`
            <div class="nav-div active-li" title="Dashboard" onclick="_getActivePage({page:'dashboard', divid:'dashboard'});" id="${navId}-dashboard">           
                <div class="icon"><i class="bi-speedometer2"></i> Dashboard</div> 
                <div class="hidden" id="_dashboard"><i class="bi-speedometer2"></i> Admin Dashboard Overview</div>
            </div>
        `);

        if (userRoles.canViewBranch) {
            document.write(`
                <div class="nav-div" title="Branches" onclick="_getActivePage({page:'branches', divid:'branches'});" id="${navId}-branches">
                    <div class="icon"><i class="bi-diagram-3"></i> Branches</div> 
                    <div class="hidden" id="_branches"><i class="bi-diagram-3"></i> Branches</div>
                </div>
            `);
        }

        if (userRoles.canViewSuperAdminDashboard && userRoles.canViewStaff) {
            document.write(`
                <div class="nav-div" title="Staff" onclick="_getActivePage({page:'staff', divid:'staff'});" id="${navId}-staff">
                    <div class="icon"><i class="bi-people"></i> Staff</div> 
                    <div class="hidden" id="_staff"><i class="bi-people"></i> Active Staff</div>
                </div>
            `);
        }

        if (userRoles.canViewSuperAdminDashboard) {
            document.write(`
                <div class="nav-div" title="Report" onclick="_getActivePage({nav:'reports', divid:'reports'});" id="${navId}-reports">
                    <div class="icon"><i class="bi-graph-up-arrow"></i> Report</div> 
                </div>
            `);
        }
    }
</script>

<!-- Desktop Sidebar -->
<div class="side-nav-div animated fadeInLeft">
    <div class="nav-back-div">
        <script>writeSidebarItems('side');</script>
    </div>
</div>

<!-- Mobile Sidebar -->
<div class="side-nav-div animated fadeInLeft" id="side-nav-div">
    <div class="nav-back-div">
        <script>writeSidebarItems('mobile');</script>
    </div>
</div>


<!--------------------------for nav sub div view----------------------------------------->

<div class="side-nav-bg-sub-div">

    <div class="nav-div animated fadeInLeft" id="link-reports">
        <div class="link" title="Product Report" onclick="">- Income Report</div>
        <div class="hidden" id="_product_report"><i class="bi-boxes"></i> Income Report</div>

        <div class="link" title="Sales Report" onclick="">- Expenses Report</div>
        <div class="hidden" id="_sales_report"><i class="bi-boxes"></i> Expenses Report</div>

        <div class="link" title="Wallet Report" onclick="">- Wallet Report</div>
        <div class="hidden" id="_wallet_report"><i class="bi-credit-card"></i> Wallet Report</div>

        <div class="link" title="Wallet Report" onclick="">- Staff Loans</div>
        <div class="hidden" id="_wallet_report"><i class="bi-credit-card"></i> Staff Loans</div>
    </div>
    
    <div class="nav-back-container" onclick="_closeNav();"></div>
</div>