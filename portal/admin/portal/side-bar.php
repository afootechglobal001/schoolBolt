<div class="side-nav-div animated fadeInLeft">
    <div class="nav-back-div">
        <div class="nav-div active-li" title="Dashboard" onclick="_getActivePage({page:'dashboard', divid:'dashboard'});" id="side-dashboard">           
            <div class="icon"><i class="bi-speedometer2"></i> Dashboard</div> 
            <div class="hidden" id="_dashboard"><i class="bi-speedometer2"></i> Admin Dashboard Overview</div>
        </div>
        <script>
            $(document).ready(function() {
                let myPermissions = '7,10,13,15,34,41'.split(',');  // Convert to an array
                rolePermissionIds.split(',').forEach(permissionId => {
                    if (myPermissions.includes(permissionId) && permissionElements[permissionId]) {
                    $(".nav-back-div").append(permissionElements[permissionId]); // Append dynamically
                }
                });
            });
        </script>
        <!-- <script>
            if (typeof rolePermissionIds !== "undefined" && rolePermissionIds.split(",").includes("7")) {
                $(".nav-back-div").append(permissionElements[7]);
            }
        </script> -->
    </div>
</div>



<!--------------------------for nav sub div view----------------------------------------->

<div class="side-nav-bg-sub-div">
	<div class="nav-div animated fadeInLeft" id="link-products">
        <div class="link" title="Product Categories" onclick="_getActivePage({page:'product_category', divid:'products'});">- Parent Reviews <div class="num" id="">0</div></div>
        <div class="hidden" id="_products"><i class="bi-boxes"></i> Parent Reviews</div>

        <div class="link" title="Combo" onclick="">- Student Reviews <div class="num" id="">0</div></div>
        <div class="hidden" id="_combo"><i class="bi-basket"></i> Student Reviews</div>

        <div class="link" title="Combo" onclick="">- Visitor's Reviews <div class="num" id="">0</div></div>
        <div class="hidden" id="_combo"><i class="bi-basket"></i> Visitor's Reviews</div>
    </div>

    <div class="nav-div animated fadeInLeft" id="link-publish">
        <div class="link" title="News & Blogs" onclick="_getActivePage({page:'blog_page', divid:'publish'});">- News & Blogs <div class="num" id="">0</div></div>
        <div class="hidden" id="_blog_page"><i class="bi-journals"></i> News & Blogs</div>

        <div class="link" title="FAQs" onclick="_getActivePage({page:'faq_page', divid:'publish'});">- FAQs <div class="num" id="">0</div></div>
        <div class="hidden" id="_all_faqs"><i class="bi-patch-question"></i> Frequently Asked Question</div>
    </div>

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