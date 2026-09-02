<?php if ($page == 'faqPage') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi bi-patch-question"></i></div>
            </div>
            <div class="text-div">
                <h3>Frequently Asked Questions</h3>
                <p>Organize and manage all Frequently Asked Questions to ensure smooth listing and browsing.</p>
            </div>
        </div>

        <div class="btn-div">
            <div class="search-div">
                <input type="text" onkeyup="_filtersFaq(this.value);" placeholder="Search FAQ Here...">
                <i class="bi bi-search"></i>
            </div>
            <button class="btn" title="ADD NEW FAQ" onclick="sessionStorage.removeItem('useEachFaqSession'); _getForm({page: 'faqReg', url: portalMiddleWareUrl});">
                <i class="bi-plus-square"></i> ADD NEW FAQ
            </button>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="tables-content-div">
            <div class="content-title">
                <div class="title">
                    <i class="bi bi-patch-question"></i>
                    <p>Frequently Asked Questions</p>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="faq-back-wrapper" id="faqPageContent">
                    <script>_fetchFaqData();</script> 

                    <div class="content-loading-div">
                        <img src="<?php echo $websiteUrl ?>/all-images/images/spinner.gif" alt="Loading" />
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'faqReg') { ?>
    <script>
        useEachFaqSession = JSON.parse(sessionStorage.getItem("useEachFaqSession"));
        $('#pageTitle').html(useEachFaqSession?.faqId ? 'UPDATE FAQ' : 'CREATE NEW FAQ');
        $('#subTitle, #subTitle2').html(useEachFaqSession?.faqId ? 'update this faq' : 'create new faq');
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="form-title-div">
            <div class="title-div">
                <div class="icon-div"><i class="bi bi-patch-question"></i></div>
                <h3 id="pageTitle">CREATE A NEW FAQ</h3>
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
                <p>You are about to <span id="subTitle"></span>. Please complete the form below with accurate details to successfully <span id="subTitle2"></span>.</p>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-table-content-div">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-patch-question"></i>
                            <p>FAQ</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="text_field_container" id="categoryId_container">
                            <script>
                                selectField({
                                    id: 'categoryId',
                                    title: 'Select FAQ Category',
                                    fieldValue: useEachFaqSession?.categoryData?.categoryId ?? '',
                                    fieldLabel: useEachFaqSession?.categoryData?.categoryName ?? ''
                                });
                                _getSelectCategory('categoryId');
                            </script>
                        </div>

                        <div class="text_field_container" id="faqQuestion_container">
                            <script>
                                textField({
                                    id: 'faqQuestion',
                                    title: 'FAQ Question',
                                    value: useEachFaqSession?.faqQuestion ?? '',
                                });
                            </script>
                        </div>

                        <div class="title-div">FAQ ANSWER</div>
                        <script src="<?php echo $websiteUrl ?>/portal/js/TextEditor.js" referrerpolicy="origin"></script>
                        <script>
                            $(document).ready(function () {
                                tinymce.init({
                                    selector: '#faqAnswer',
                                    skin: $('html').hasClass('dark-mode') ? 'oxide-dark' : 'oxide',
                                    content_css: $('html').hasClass('dark-mode') ? 'dark' : 'default',
                                    plugins: "link image table",
                                    setup: function (editor) {
                                        editor.on('init', function () {
                                            setTimeout(function () {
                                                editor.setContent(useEachFaqSession?.faqAnswer ?? '');
                                            }, 300);
                                        });
                                    }
                                });
                            });
                        </script>
                        <div style="margin-bottom: 20px;">
                            <div class="page-content-back-div">
                                <textarea class="text_field" rows="20" id="faqAnswer" title="TYPE FULL PAGE CONTENT HERE" type="text" maxlength="167" placeholder=""></textarea>
                                <div class="issueText" id="issue_faqAnswer"></div>
                            </div>
                        </div>

                        <div class="text_field_container" id="statusId_container">
                            <script>
                                selectField({
                                    id: 'statusId',
                                    title: 'Select Status',
                                    fieldValue: useEachFaqSession?.statusData?.statusId ?? '',
                                    fieldLabel: useEachFaqSession?.statusData?.statusName ?? ''
                                });
                                _getSelectStatusId('statusId', '1,2');
                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-div">
                <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createAndUpdatefaq()"> <i class="bi-check"></i> SUBMIT </button>
            </div>
        </div>
    </div>
<?php } ?>