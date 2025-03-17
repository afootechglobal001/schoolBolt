<?php
class allClass
{
        function _pagesButtons($websiteUrl) { ?>
                <div class="btn-div">
                <a href="<?php echo $websiteUrl?>">
                        <button class="btn" title="Request For A Demo">Request For A Demo <i class="bi-chevron-right"></i></button></a>
                <a href="<?php echo $websiteUrl?>">
                        <button class="btn right-btn" title="Recomend Us And Earn"><strong>Recomend Us  <span>And Earn</span></strong> <i class="bi-chevron-right"></i></button></a>
                </div>        
        <?php }

        function _pagesAgentContent($websiteUrl, $appName) { ?>
               <section class="body-div agent-body-div">
                        <div class="body-div-in">
                                <div class="agent-back-div">
                                        <div class="left-container">
                                                <h2>Become an Agent on <span> SchoolBolt</span></h2>
                                                <p>Become an agent on <strong>“SchoolBolt”</strong> and unlock exciting opportunities to connect with schools, grow your network, and make a meaningful impact in the education sector.</p>

                                                <div>
                                                <a href="<?php echo $websiteUrl ?>">
                                                        <button class="btn" title="Apply Now">Apply Now <i class="bi-chevron-right"></i></button></a>
                                                </div>
                                        </div>

                                        <div class="right-container">
                                                <div class="image-div">
                                                <img src="<?php echo $websiteUrl ?>/all-images/body-pix/agent.png"
                                                        alt="<?php echo $appName ?> Company" />
                                                </div>
                                        </div>
                                </div>
                        </div>
                </section>       
        <?php }
    
} //end of class
$callclass = new allClass();
?>