<div class="side-nav-div" id="sideNav" data-aos="fade-right" data-aos-duration="900">
    <div class="side-in-div">
        <div class="nav-back-div">
            <div class="nav-div active-li" title="Dashboard" onClick="_get_page('dashboard', 'dashboard')" id="side-dashboard">           
                <div class="icon"><i class="bi-speedometer2"></i></div>
                <div class="txt-hidden">Dashboard</div>
                <div class="hidden" id="_dashboard"><i class="bi-speedometer2"></i> Admin Dashboard Overview</div>
            </div>

            <script>_side_admin_check('admin');</script>
        
            <div class="nav-div" title="Event" onClick="_get_page('event_category', 'event')" id="side-event">
                <div class="icon"><i class="bi-calendar2-event"></i></div> 
                <div class="txt-hidden">Events</div>
                <div class="hidden" id="_event"><i class="bi-calendar2-event"></i> All Active Event</div>
            </div>


            <div class="nav-div" title="Gallery" onClick="_get_page('gallery_category', 'gallery')" id="side-gallery">
                <div class="icon"><i class="bi-images"></i></div> 
                <div class="txt-hidden">Gallery</div>
                <div class="hidden" id="_gallery"><i class="bi-images"></i> All Active Gallery</div>
            </div>

            <div class="nav-div" title="Blog" onClick="_get_page('blog_category', 'blog')" id="side-blog">
                <div class="icon"><i class="bi-file-post"></i></div> 
                <div class="txt-hidden">Blog</div>
                <div class="hidden" id="_blog"><i class="bi-file-post"></i> All Active Blog</div>
            </div>

            <div class="nav-div" title="FAQ" onClick="_get_page('faq_category', 'faq')" id="side-faq">
                <div class="icon" ><i class="bi-patch-question"></i></div> 
                <div class="txt-hidden">FAQ</div>
                <div class="hidden" id="_faq"><i class="bi-patch-question"></i> All Active FAQ</div>
            </div>

            <div class="nav-div" title="FAQ" onClick="_get_page('testimony_category', 'test')" id="side-test">
                <div class="icon" ><i class="bi-chat-quote-fill"></i></div> 
                <div class="txt-hidden">Testimony</div>
                <div class="hidden" id="_test"><i class="bi-chat-quote-fill"></i> All Active Testimony</div>
            </div>
        </div>
       
    </div>
    
    <div class="toggle-icon" title="Expand" id="toggleNav">
        <div class="icon"><i class="bi-box-arrow-right"></i></div>
    </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const sideNav = document.getElementById('sideNav');
    const toggleNav = document.getElementById('toggleNav');
    let isExpanded = false;

    toggleNav.addEventListener('click', function() {
        isExpanded = !isExpanded;
        
        // Toggle the expanded class for width
        if (isExpanded) {
            sideNav.classList.add('expanded');
        } else {
            sideNav.classList.remove('expanded');
        }

        // Change the icon direction based on state
        const icon = toggleNav.querySelector('i');
        icon.classList.toggle('bi-box-arrow-right', !isExpanded);
        icon.classList.toggle('bi-box-arrow-left', isExpanded);
    });
});
</script>