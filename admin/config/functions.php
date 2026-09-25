<?php
function _leftSideSection($websiteUrl, $appName)
{ ?>
    <div class="login-image-div">
        <div class="image-overlay"></div>
        <div class="logo-div">
            <a href="<?php echo $websiteUrl ?>">
            <img src="<?php echo $websiteUrl ?>/all-images/images/icon.png" alt="<?php echo $appName ?> Icon"></a>
        </div>
        <div class="bottom-container">
            <h1>
                <?php echo $appName ?> -
                <span>Admin Portal</span>
            </h1>
            <p>
                Manage <?php echo $appName ?> from one centralized admin dashboard.
            </p>
        </div>
    </div>
<?php } ?>