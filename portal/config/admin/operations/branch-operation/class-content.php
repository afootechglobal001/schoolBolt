<?php if ($page=='branch_department_class') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <span><i class="bi-people-fill"></i> BRANCH CLASS LIST</span>
    </div>

    <div class="pages-toggle-back-div">
        <div class="pages-toggle-div">
            <div class="pages-toggle-title" onclick="_collapse('view1');" title="Click to view class teachers">
                <h3>KINDERGARTEN</h3>
                <div class="expand-div" id="view1num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
            </div>
        
            <div class="toggle-expand-div" id="view1answer" style="display: none;">  
                <div class="alert alert-success top-alert-div class-top-alert-div animated fadeIn">
                    <span><i class="bi-people-fill"></i> <span>NURSERY</span> --  <span>NURSERY 1</span> CLASS TEACHERS</span> 

                    <div class="btn-container">
                        <button class="btn" title="PRINT RECORDS" id="" onclick=""><i class="bi-printer"></i> PRINT</button>
                        <button class="btn" title="EXPORT RECORDS" id="" onclick=""><i class="bi-file-earmark-excel"></i> EXPORT</button>
                    </div>
                </div>

                <div class="table-div animated fadeIn">
                    <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                        <thead>
                            <tr class="tb-col">
                                <th>sn</th>
                                <th>Department</th>
                                <th>Level</th>
                                <th>Teacher</th>
                                <th>Edit</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="tb-row">
                                <td>1</td>
                                <td>NURSERY</td>
                                <td>NURSERY 1 A</td> 
                                <td>
                                    <div class="text-back-div">
                                        <div class="image-div general-passport">
                                            <img src="<?php echo $websiteUrl ?>/uploaded_files/staffPix/teacher3.png" alt="MR AHMED ODELAKIN"/>
                                        </div>

                                        <div class="text-div">
											<div class="first-class">MR AHMED ODELAKIN</div>
											<div class="second-class">ahmedolumide20@gmail.com</div>
										</div>
                                    </div>
                                </td>
                                <td><button class="btn view-btn" title="Click to edit assign class teacher" onclick="_getForm({page: 'assign_staff', layer:2, url: adminPortalLocalUrl});"><i class="bi-bookmark-check"></i> ASSIGN</button></td>
                            </tr>

                            <tr class="tb-row">
                                <td>2</td>
                                <td>NURSERY</td>
                                <td>NURSERY 1 B</td> 
                                <td>
                                    <div class="text-back-div">
                                        <div class="image-div general-passport">
                                            <img src="<?php echo $websiteUrl ?>/uploaded_files/staffPix/teacher1.jpeg" alt="MISS KAFAYAT ADENIRAN"/>
                                        </div>

                                        <div class="text-div">
											<div class="first-class">MISS KAFAYAT ADENIRAN ADENIRAN</div>
											<div class="second-class">adeniranatinuke26@gmail.com</div>
										</div>
                                    </div>
                                </td>
                                <td><button class="btn view-btn" title="Click to edit assign class teacher" onclick=""><i class="bi-bookmark-check"></i> ASSIGN</button></td>
                            </tr>

                            <tr class="tb-row">
                                <td>3</td>
                                <td>NURSERY</td>
                                <td>NURSERY 1 C</td> 
                                <td>
                                    <div class="text-back-div">
                                        <div class="image-div general-passport">
                                            <img src="<?php echo $websiteUrl ?>/uploaded_files/staffPix/teacher2.jpeg" alt="MISS OGUNJIMI"/>
                                        </div>

                                        <div class="text-div">
											<div class="first-class">MISS OLUWASEUN SELUWA</div>
											<div class="second-class">seluwaoluwaseun@yahoo.com</div>
										</div>
                                    </div>
                                </td>
                                <td><button class="btn view-btn" title="Click to edit class teacher" onclick=""><i class="bi-pencil-square"></i> EDIT</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="pages-toggle-div">
            <div class="pages-toggle-title" onclick="_collapse('view2');" title="Click to view class teachers">
                <h3>NURSERY</h3>
                <div class="expand-div" id="view2num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
            </div>
        
            <div class="toggle-expand-div" id="view2answer" style="display: none;">  
                <div class="alert alert-success top-alert-div class-top-alert-div animated fadeIn">
                    <span><i class="bi-people-fill"></i> <span>NURSERY</span> --  <span>NURSERY 2</span> CLASS TEACHERS</span> 

                    <div class="btn-container">
                        <button class="btn" title="PRINT RECORDS" id="" onclick=""><i class="bi-printer"></i> PRINT</button>
                        <button class="btn" title="EXPORT RECORDS" id="" onclick=""><i class="bi-file-earmark-excel"></i> EXPORT</button>
                    </div>
                </div>

                <div class="table-div animated fadeIn">
                    <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                        <thead>
                            <tr class="tb-col">
                                <th>sn</th>
                                <th>Department</th>
                                <th>Level</th>
                                <th>Teacher</th>
                                <th>Edit</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="tb-row">
                                <td>1</td>
                                <td>NURSERY</td>
                                <td>NURSERY 2 A</td> 
                                <td>
                                    <div class="text-back-div">
                                        <div class="image-div general-passport">
                                            <img src="<?php echo $websiteUrl ?>/uploaded_files/staffPix/default.jpg" alt="MISS OGUNJIMI"/>
                                        </div>

                                        <div class="text-div">
											<div class="first-class">MR BUHARI BUSARI</div>
											<div class="second-class">omotoyosibukhari@gmail.com</div>
										</div>
                                    </div>
                                </td>
                                <td><button class="btn view-btn" title="Click to edit assign class teacher" onclick=""><i class="bi-bookmark-check"></i> ASSIGN</button></td>
                            </tr>

                            <tr class="tb-row">
                                <td>2</td>
                                <td>NURSERY</td>
                                <td>NURSERY 2 B</td> 
                                <td>
                                    <div class="text-back-div">
                                        <div class="image-div general-passport">
                                            <img src="<?php echo $websiteUrl ?>/uploaded_files/staffPix/default.jpg" alt="MISS OGUNJIMI"/>
                                        </div>

                                        <div class="text-div">
											<div class="first-class">MISS NAFISAT ADISA</div>
											<div class="second-class">nafisatmorenikeji19@gmail.com</div>
										</div>
                                    </div>
                                </td>
                                <td><button class="btn view-btn" title="Click to edit assign class teacher" onclick=""><i class="bi-bookmark-check"></i> ASSIGN</button></td>
                            </tr>

                            <tr class="tb-row">
                                <td>3</td>
                                <td>NURSERY</td>
                                <td>NURSERY 2 C</td> 
                                <td>
                                    <div class="text-back-div">
                                        <div class="image-div general-passport">
                                            <img src="<?php echo $websiteUrl ?>/uploaded_files/staffPix/default.jpg" alt="MISS OGUNJIMI"/>
                                        </div>

                                        <div class="text-div">
											<div class="first-class">MR MUSTAPHA SODIQ</div>
											<div class="second-class">omoabidolu27@gmail.com</div>
										</div>
                                    </div>
                                </td>
                                <td><button class="btn view-btn" title="Click to edit class teacher" onclick=""><i class="bi-pencil-square"></i> EDIT</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="pages-toggle-div">
            <div class="pages-toggle-title" onclick="_collapse('view3')" title="Click to view class teachers">
                <h3>BASIC</h3>
                <div class="expand-div" id="view3num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
            </div>
        
            <div class="toggle-expand-div" id="view3answer" style="display: none;">  
                <div class="alert alert-success top-alert-div class-top-alert-div animated fadeIn">
                    <span><i class="bi-people-fill"></i> <span>BASIC</span> --  <span>BASIC 1</span> CLASS TEACHERS</span> 

                    <div class="btn-container">
                        <button class="btn" title="PRINT RECORDS" id="" onclick=""><i class="bi-printer"></i> PRINT</button>
                        <button class="btn" title="EXPORT RECORDS" id="" onclick=""><i class="bi-file-earmark-excel"></i> EXPORT</button>
                    </div>
                </div>

                <div class="table-div animated fadeIn">
                    <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                        <thead>
                            <tr class="tb-col">
                                <th>sn</th>
                                <th>Department</th>
                                <th>Level</th>
                                <th>Teacher</th>
                                <th>Edit</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="tb-row">
                                <td>1</td>
                                <td>BASIC</td>
                                <td>BASIC 1 A</td> 
                                <td>
                                    <div class="text-back-div">
                                        <div class="image-div general-passport">
                                            <img src="<?php echo $websiteUrl ?>/uploaded_files/staffPix/default.jpg" alt="MISS OGUNJIMI"/>
                                        </div>

                                        <div class="text-div">
											<div class="first-class">MR PETER OLANIYAN</div>
											<div class="second-class">olaniyanpeter45@gmail.com</div>
										</div>
                                    </div>
                                </td>
                                <td><button class="btn view-btn" title="Click to view student profile" onclick=""><i class="bi-bookmark-check"></i> ASSIGN</button></td>
                            </tr>

                            <tr class="tb-row">
                                <td>2</td>
                                <td>BASIC</td>
                                <td>BASIC 1 B</td> 
                                <td>
                                    <div class="text-back-div">
                                        <div class="image-div general-passport">
                                            <img src="<?php echo $websiteUrl ?>/uploaded_files/staffPix/default.jpg" alt="MISS OGUNJIMI"/>
                                        </div>

                                        <div class="text-div">
											<div class="first-class">MR TAIWO ATIKU</div>
											<div class="second-class">atikutaiwohalimat@gmail.com</div>
										</div>
                                    </div>
                                </td>
                                <td><button class="btn view-btn" title="Click to view student profile" onclick=""><i class="bi-bookmark-check"></i> ASSIGN</button></td>
                            </tr>

                            <tr class="tb-row">
                                <td>3</td>
                                <td>BASIC</td>
                                <td>BASIC 1 C</td> 
                                <td>
                                    <div class="text-back-div">
                                        <div class="image-div general-passport">
                                            <img src="<?php echo $websiteUrl ?>/uploaded_files/staffPix/default.jpg" alt="MISS OGUNJIMI"/>
                                        </div>

                                        <div class="text-div">
											<div class="first-class">MISS ZAINAB SANUSI</div>
											<div class="second-class">temitayozaynab117@gmail.com</div>
										</div>
                                    </div>
                                </td>
                                <td><button class="btn view-btn" title="Click to view student profile" onclick=""><i class="bi-pencil-square"></i> EDIT</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page=='assign_staff') { ?>
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> UPDATE CLASS TEACHER</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly select staff below to <span> UPDATE CLASS TEACHER</span></div>
                </div>

                <div class="alert alert-success form-alert">
                    <div class="alert-list-div">
                        <div class="alert-list">
                            <div>Department:</div>
                            <div><span id="">NURSERY</span></div>
                        </div>
                        <div class="alert-list">
                            <div>Level:</div>
                            <div><span id="">NURSEY 1 A</span></div>
                        </div>
                    </div>
                </div>

                <div class="text_field_container" id="staffId_container">
                    <script>
                        selectField({
                            id: 'staffId',
                            title: 'Select Class Teacher'
                        });
                        _getSelectClassTeachers('staffId');
                    </script>
                </div>

                <div>
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick=""> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>