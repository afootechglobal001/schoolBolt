<?php if($page=='faq_page'){?>
    <div class="page-title-back-div other-pages-title-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="page-title-div">
            <div class="main-title title"><i class="bi-patch-question"></i> <strong>Freqently Asked Questions</strong></div>
            <div class="bottom-title">
                Active: <span id="active-staff">10</span> |
                Suspended: <span>5</span>
            </div>
        </div>

        <div class="other-pages-filter-div">
            <div class="text-field-wrapper">
                <div class="text_field_container search_field_container">
                    <input class="text_field dash_text_field" type="text" id="searchFaq" onkeyup="filters('Faq')" placeholder="" title="Type here to serach faq..." />
                    <div class="placeholder dash_placeholder"><i class="bi-search"></i> Type here to search faq...</div>
                </div>
            </div>

            <div class="btn-div">
                <button class="btn" type="button" title="ADD NEW FAQ" onclick="_getForm({page: 'faq_reg', url: adminPortalLocalUrl});">
                    <i class="bi-plus-square"></i> ADD NEW FAQ
                </button>
            </div>
        </div>
    </div>

    <div class="pages-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="other-pg-back-div faq-other-pg-back-div" id="fetchAllFaq">
            <div class="faq-back-div">
                <div class="title-div">
                    <div class="num">1</div>
                    <button class="btn" onclick=""><i class="bi-pencil-square"></i> <span>What types of products can I find on Get Food Stuffs?</span></button>
                </div>
                <div class="answer-div">Get Food Stuffs offers a variety of products, including fresh raw foods, grains, vegetables, fruits, and packaged provisions. Our platform provides everything you need to stock up your kitchen or pantry, all available for convenient online shopping.</div>
            </div>

            <div class="faq-back-div">
                <div class="title-div">
                    <div class="num">2</div>
                    <button class="btn" onclick=""><i class="bi-pencil-square"></i> <span>How much do the products on Get Food Stuffs cost?</span></button>
                </div>
                <div class="answer-div">The cost of products on Get Food Stuffs varies depending on the item and quantity. We offer competitive prices on all raw foods, groceries, and provisions. You can explore our product catalog to find affordable options that suit your budget.</div>
            </div>

            <div class="faq-back-div">
                <div class="title-div">
                    <div class="num">3</div>
                    <button class="btn" onclick=""><i class="bi-pencil-square"></i> <span>Do you offer customer support for orders?</span></button>
                </div>
                <div class="answer-div">Yes, we provide full customer support to ensure your shopping experience is seamless. If you have questions about your order, delivery, or any product, our support team is available to assist you through phone, email, or live chat.</div>
            </div>
            
        </div>
    </div>
<?php }?>

<?php if ($page=='faq_reg'){ ?>
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD A NEW FAQ</span>
                <div class="close" title="Close" onclick="_alertClose();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly fill the form below to <span> ADD A NEW FAQ</span></div>
                </div>

                <div class="text_field_container" id="searchBlogCat_container">
                    <script>
                        selectField({
                            id: 'searchBlogCat',
                            title: 'searchBlogCat'
                        });
                        _getSelectBlogCategory('searchBlogCat');
                    </script>
                </div>
                
                <div class="text_field_container" id="faqTitle_container">
                    <script>
                        textField({
                            id: 'faqTitle',
                            title: 'FAQ Title'
                        });
                    </script>
                </div>
                
                <script src="<?php echo $websiteUrl?>/js/admin/portal/TextEditor.js" referrerpolicy="origin"></script>
                <script>tinymce.init({selector:'#faq_answer',  // change this value according to your HTML
                plugins: "link, image, table"
                });</script>
                <div style="margin-bottom: 20px;"> 
                    <textarea class="text_field" rows="5" id="faq_answer" title="TYPE FULL PAGE CONTENT HERE" type="text" maxlength="167" placeholder=""></textarea>          
                </div>

                <div class="text_field_container" id="searchStatus_container">
                    <script>
                        selectField({
                            id: 'searchStatus',
                            title: 'sSelect Status'
                        });
                        _getSelectStatus('searchStatus');
                    </script>
                </div>

                <div>    
                    <button class="btn" title="SUBMIT" id="submit_btn" onclick=""> <i class="bi-check"></i> SUBMIT </button>             
                </div>
            </div>
        </div>  
    </div>
<?php } ?>