<?php if ($page == 'reviewPage') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi-chat-quote-fill"></i></div>
            </div>
            <div class="text-div">
                <h3>Reviews</h3>
                <p>Share and manage student and parent reviews to highlight real experiences. Build trust and inspire others through authentic stories and feedback.</p>    
            </div>
        </div>

        <div class="btn-div">
            <div class="search-div">
                <input type="text" id="searchContent" onkeyup="filters('Content');" placeholder="Search Reviews Here...">
                <i class="bi bi-search"></i>
            </div>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="tables-content-div">
            <div class="content-title">
                <div class="title">
                    <i class="bi bi-chat-quote-fill"></i>
                    <p>Reviews</p>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="review-back-div" id="fetchPageReviewContent">
                    <script>
                        _getReviewList({
                            pageContainer: 'fetchPageReviewContent',
                            crFlag: 'REVIEW',
                            paginationContainer: 'reviewPaginationControls',
                        });
                    </script>

                    <div class="content-loading-div">
                        <img src="<?php echo $websiteUrl ?>/all-images/images/spinner.gif" alt="Loading" />
                    </div>
                </div>
                <!-- Pagination -->
                <div id="reviewPaginationControls" class="pagination-div"></div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'updateReview') { ?>
    <script>getEachReviewDetailsSession = JSON.parse(sessionStorage.getItem("getEachReviewDetailsSession"));</script>
    
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="form-title-div">
            <div class="title-div">
                <div class="icon-div"><i class="bi bi-chat-left-text"></i></div>
                <h3>UPDATE REVIEW</h3>  
            </div>
            <div class="btn-div">
                <button class="btn" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">
                    <i class="bi bi-x-lg"></i> Close
                </button>
            </div>
        </div>

        <!-- /////////// Title ////////////////////////////// -->
        <div class="container-back-div">
            <div class="form-notification">
                <p>You are about to update this review. Please confirm the form below with accurate details to successfully update review.
                </p>
            </div>

            <div class="main-content-div">
                <div class="tables-content-div form-content-div">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-chat-left-text"></i>
                            <p>Update review</p>
                        </div>
                    </div>

                    <div class="form-container">                     
                        <div class="main-content-div form-main-content" data-aos="fade-in" data-aos-duration="1500">
                            <div class="tables-content-div form-content-div">
                                <div class="content-title">
                                    <div class="title">
                                        <i class="bi bi-envelope"></i>
                                        <p>Email Address</p>
                                    </div>
                                </div>

                                <div class="inner-table-content">
                                    <span id="fullName"><script>$("#fullName").html(getEachReviewDetailsSession?.fullName);</script></span>
                                </div>
                            </div>
                        </div>

                        <div class="main-content-div form-main-content" data-aos="fade-in" data-aos-duration="1500">
                            <div class="tables-content-div form-content-div">
                                <div class="content-title">
                                    <div class="title">
                                        <i class="bi bi-telephone"></i>
                                        <p>Phone Number</p>
                                    </div>
                                </div>

                                <div class="inner-table-content">
                                    <span id="phoneNumber"><script>$("#phoneNumber").html(getEachReviewDetailsSession?.phoneNumber);</script></span>
                                </div>
                            </div>
                        </div>

                        <div class="main-content-div form-main-content" data-aos="fade-in" data-aos-duration="1500">
                            <div class="tables-content-div form-content-div">
                                <div class="content-title">
                                    <div class="title">
                                        <i class="bi bi-chat-left-quote"></i>
                                        <p>Review</p>
                                    </div>
                                </div>

                                <div class="inner-table-content">
                                <span id="message"><script>$("#message").html(getEachReviewDetailsSession?.message);</script></span> 
                                </div>
                            </div>
                        </div>

                        <div class="text_field_container" id="statusId_container">
                            <script>
                                selectField({
                                    id: 'statusId',
                                    title: 'Select Status',
                                    fieldValue: getEachReviewDetailsSession?.statusData?.statusId ?? '',
                                    fieldLabel: getEachReviewDetailsSession?.statusData?.statusName ?? ''   
                                });
                               _getSelectStatusId('statusId', '1,2');
                            </script>
                        </div>
                    </div>
                </div>

                <div class="btn-div">
                    <button class="btn" title="SUBMIT" id="updateBtn" onclick="_updateReview()"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>