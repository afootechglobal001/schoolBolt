<?php  include 'alert.php'?>
<header class="animated fadeInDown">
  <div class="inner-div">
    <div class="left-div">
      <div class="logo-div"><img src="<?php echo $websiteUrl?>/images/logo.png" alt="School logo"/></div>
      <ul>
        <a href="<?php echo $websiteUrl?>/parent" title="Parent Dashboard"><li>Parent Dashboard</li></a>
      </ul>
    </div>
    <button class="btn" title="Log-Out" onclick="_confirmLogOut();">Log-Out</button>
    <button class="mobile-logout" title="Log-Out" onclick="_confirmLogOut();"><i class="bi-box-arrow-in-right"></i></button>
  </div>
</header>