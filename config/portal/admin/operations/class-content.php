<?php if($page=='class_config'){?>
    <div class="page-title-back-div other-pages-title-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="page-title-div">
            <div class="back-div"><span onclick="_getActivePage({page:'settings'});"><i class="bi-arrow-left"></i> System Settings</span> Classess</div>
            <div class="main-title title"><i class="bi-mortarboard"></i> <strong>Classess</strong></div>
        </div>

        <div class="other-pages-filter-div">
            <div class="text-field-wrapper extended-text-field-wrapper">
                <div class="text_field_container search_field_container">
                    <input class="text_field dash_text_field" type="text" id="searchContent" onkeyup="filters('Content')" placeholder="" title="Type here to serach class..." />
                    <div class="placeholder dash_placeholder"><i class="bi-search"></i> Type here to search class...</div>
                </div>
            </div>
            
            <button class="btn" title="ADD NEW CLASS" onclick="_getForm({page: 'class_reg', url: adminPortalLocalUrl});">
                <i class="bi-plus-square"></i> ADD NEW CLASS
            </button>
        </div>
    </div>
    
    <div class="pages-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="table-div animated fadeIn">
            <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                <script></script>
                <thead>
                    <tr class="tb-col">
                        <th>sn</th>
                        <th>Class ID</th>
                        <th>Class Name</th>
                        <th>Created By</th>
                        <th>Updated By</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="tb-row">
                        <td>1</td>
                        <td class="clickable-td" title="Click to view branch profile">CLASS20220605070858002</td>
                        <td class="clickable-td">BASIC ONE</td>
                        <td>Emmanuel Paul</td>
                        <td>Emmanuel Paul</td>
                        <td>2024-11-18 03:28:41</td>
                        <td><div class="status-div ACTIVE">ACTIVE</div></td>
					</tr>

                    <tr class="tb-row">
                        <td>1</td>
                        <td class="clickable-td" title="Click to view branch profile">CLASS20220605070858002</td>
                        <td class="clickable-td">BASIC TWO</td>
                        <td>Emmanuel Paul</td>
                        <td>Emmanuel Paul</td>
                        <td>2024-11-18 03:28:41</td>
                        <td><div class="status-div ACTIVE">ACTIVE</div></td>
					</tr>

                    <tr class="tb-row">
                        <td>1</td>
                        <td class="clickable-td" title="Click to view branch profile">CLASS20220605070858002</td>
                        <td class="clickable-td">BASIC ONE</td>
                        <td>Emmanuel Paul</td>
                        <td>Emmanuel Paul</td>
                        <td>2024-11-18 03:28:41</td>
                        <td><div class="status-div ACTIVE">ACTIVE</div></td>
					</tr>
                </tbody>
            </table>
        </div>
    </div>
<?php }?>

<?php if ($page == 'class_reg') { ?>
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD A NEW CLASS</span>
                <div class="close" title="Close" onclick="_alertClose();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly fill the form below to <span> ADD A NEW CLASS</span></div>
                </div>

                <div class="text_field_container" id="name_container">
                    <script>
                        textField({
                            id: 'name',
                            title: 'Class Name'
                        });
                    </script>
                </div>
                
                <div class="text_field_container" id="statusId_container">
                    <script>
                        selectField({
                            id: 'statusId',
                            title: 'Select Status'
                        });
                        _getSelectStatusId('statusId', '1,2');
                    </script>
                </div>

                <div>
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick=""> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>