<?php
class allClass
{

    function _statistics($website_url) { ?>
        <section class="body-div statistics-body">
                <div class="body-div-in statistics-body-div-in">
                        <div class="statistics-back-div">
                        <div class="statistics-div" data-aos="fade-up" data-aos-duration="1000">
                                <div class="image-div">
                                <img src="<?php echo $website_url?>/all-images/body-pix/subject.svg" alt="Subjects" />
                                </div>
                                <div class="text-div">
                                <h2 data-count="220">0<span>+</span></h2>
                                <h4>+ Total Subjects</h4>
                                </div>
                        </div>

                        <div class="statistics-div" data-aos="fade-up" data-aos-duration="1200">
                                <div class="image-div">
                                <img src="<?php echo $website_url?>/all-images/body-pix/student.svg" alt="Students" />
                                </div>
                                <div class="text-div">
                                <h2 data-count="2000">0</h2>
                                <h4>+ Our Students</h4>
                                </div>
                        </div>

                        <div class="statistics-div" data-aos="fade-up" data-aos-duration="1400">
                                <div class="image-div">
                                <img src="<?php echo $website_url?>/all-images/body-pix/teachers.svg" alt="Teachers" />
                                </div>
                                <div class="text-div">
                                <h2 data-count="66">0</h2>
                                <h4>+ Skilled Teachers</h4>
                                </div>
                        </div>

                        <div class="statistics-div" data-aos="fade-up" data-aos-duration="1600">
                                <div class="image-div">
                                <img src="<?php echo $website_url?>/all-images/body-pix/award.svg" alt="Award" />
                                </div>
                                <div class="text-div">
                                <h2 data-count="20">0</h2>
                                <h4>+ Win Awards</h4>
                                </div>
                        </div>
                        </div>
                </div>
                <script>_countStatistics();</script>
        </section>

    <?php }


        function _otherPagesBtn($website_url) { ?>
                <div class="other-pages-btn-div">
                    <a href="<?php echo $website_url?>" title="Apply For Admission">
                    <button class="btn" title="Apply For Admission"><i class="bi-mortarboard-fill"></i> Apply For Admission</button></a> 
                    <a href="<?php echo $website_url?>" title="Student Portal">
                    <button class="btn center-btn" title="Student Portal"><i class="bi-person-fill-check"></i>Student Portal</button></a>     
                    <a href="https://arrahmangroupofschools.com/portal/parent/login" title="Parent Portal">
                    <button class="btn"><i class="bi-people-fill"></i> Parent Portal</button></a> 
                </div>
        <?php }

} //end of class
$callclass = new allClass();
?>