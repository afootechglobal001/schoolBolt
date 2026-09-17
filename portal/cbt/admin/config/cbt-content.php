<?php if ($page == 'cbtPageDetails') { ?>
    <div class="cbt-creation-panel">
        <div class="cbt-side-bar">
            <div class="div-in">
                <div class="side-container-wrapper">
                    <div class="side-details-header">
                        <div class="side-details-title">
                            <div class="side-details-icon">
                                <i class="bi-file-earmark-text"></i>
                            </div>

                            <div>
                                <h4>Question Details</h4>
                                <span class="session-badge">
                                    Session: <strong id="sessionName">2026/2027</strong>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="details-list">
                        <div class="list-div">
                            <div class="list-label">
                                <i class="bi-calendar3"></i>
                                <span>Term</span>
                            </div>
                            <span class="list-value" id="termName">FIRST TERM</span>
                        </div>

                        <div class="list-div">
                            <div class="list-label">
                                <i class="bi-building"></i>
                                <span>Department</span>
                            </div>
                            <span class="list-value" id="departmentName">JUNIOR</span>
                        </div>

                        <div class="list-div">
                            <div class="list-label">
                                <i class="bi-people"></i>
                                <span>Class</span>
                            </div>
                            <span class="list-value" id="className">JS 1</span>
                        </div>

                        <div class="list-div">
                            <div class="list-label">
                                <i class="bi-shield-check"></i>
                                <span>Arm</span>
                            </div>
                            <span class="list-value" id="armName">A</span>
                        </div>

                        <div class="list-div">
                            <div class="list-label">
                                <i class="bi-book"></i>
                                <span>Subject</span>
                            </div>
                            <span class="list-value" id="subjectName">MATHEMATICS</span>
                        </div>

                        <div class="list-div">
                            <div class="list-label">
                                <i class="bi-file-earmark-text"></i>
                                <span>CBT Title</span>
                            </div>
                            <span class="list-value" id="cbtTitle">WELCOME TEST</span>
                        </div>
                    </div>
                
                    <div class="question-count-card">
                        <div class="question-count-icon">
                            <i class="bi-question-lg"></i>
                        </div>

                        <div class="question-count-content">
                            <span>Total Question Bank</span>
                            <strong id="totalQuestions">50</strong>
                        </div>
                    </div>

                    <div class="question-count-card">
                        <div class="question-count-icon">
                            <i class="bi-question-lg"></i>
                        </div>

                        <div class="question-count-content">
                            <span>Total Quiz Questions</span>
                            <strong id="totalQuestions">10</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="cbt-content-div">
            <div class="title-div">
                <ul>
                    <li class="active-li" title="Question Bank" id="questionBank" onclick="_getActiveCbtPagesTab({divid: 'questionBank', page: 'questionBank', url: cbtAdminMiddleWareUrl});">Question Bank </li>
                    <li title="Quiz Questions" id="quizQuestion" onclick="_getActiveCbtPagesTab({divid: 'quizQuestion', page: 'quizQuestion', url: cbtAdminMiddleWareUrl});">Quiz Questions</li>
                    <li title="Load Question Manually" id="loadQuestionManually" onclick="_getActiveCbtPagesTab({divid: 'loadQuestionManually', page: 'loadQuestionManually', url: cbtAdminMiddleWareUrl});">Load Questions Manually</li>
                    <li title="Load Question Automatically" id="loadQuestionAutomatically" onclick="_getActiveCbtPagesTab({divid: 'loadQuestionAutomatically', page: 'loadQuestionAutomatically', url: cbtAdminMiddleWareUrl});">Load Questions Automatically</li>
                </ul>

                <div class="btn-div">
                    <button class="btn" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">
                        <i class="bi bi-x-lg"></i> Close
                    </button>
                </div>
            </div>

            <div id="getCbtPagesDetails">
                <script>
                    _getActiveCbtPagesTab({
                        divid: 'questionBank',
                        page: 'questionBank',
                        url: cbtAdminMiddleWareUrl
                    });
                </script>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'questionBank') { ?>
    <script>
        _checkAll();
    </script>
    <div class="question-back-div">
        <div class="top-div">
            <label>
                <input type="checkbox" id="parent">
                <span>All Questions</span>
            </label>
            
            <div class="btn-div">
                <button class="btn" id="submitBtn" title="Set As Questions Quiz" onclick=""><i class="bi-check2-circle"></i> Set As Quiz Questions</button>
                <button class="btn del-btn" id="deleteBtn" title="Delete Quiz Questions" onclick=""><i class="bi-trash"></i> Delete Questions</button>
            </div>
        </div>

        <div class="question-body-div">
            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                            <span>Question 1</span>
                        </label>
                        <div class="btn-div">
                            <button class="btn" title="Edit Question"><i class="bi-pencil-square"></i> Edit</button>
                        </div>
                    </div>

                    <div class="each-question">
                        <div class="pix-div">
                            <img src="<?php echo $websiteUrl?>/uploaded_files/cbt/question-images/computer.jpg" alt="Computer"/>
                        </div>

                        <div class="text-div">
                            <div>
                                <p>The image above shows a __________.</p>
                            </div>

                            <div class="options-div">
                                <div class="each-option">
                                    <div class="letter">A</div>
                                    <div>Television</div>
                                </div>

                                <div class="each-option correct-option">
                                    <div class="letter correct-letter">B</div>
                                    <div>Computer</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">C</div>
                                    <div>Radio</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">D</div>
                                    <div>Calculator</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                            <span>Question 2</span>
                        </label>
                        <div class="btn-div">
                            <button class="btn" title="Edit Question"><i class="bi-pencil-square"></i> Edit</button>
                        </div>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <div>
                                <p>Which of the following is a computer mouse?</p>
                            </div>

                            <div class="options-div">
                                <div class="each-option">
                                    <div class="letter">A</div>
                                    <div class="pix">
                                        <img src="<?php echo $websiteUrl?>/uploaded_files/cbt/question-images/keyboard.jpg" alt="Keyboard"/>
                                    </div>
                                    <div>Keyboard</div>
                                </div>

                                <div class="each-option correct-option">
                                    <div class="letter correct-letter">B</div>
                                    <div class="pix">
                                        <img src="<?php echo $websiteUrl?>/uploaded_files/cbt/question-images/mouse.jpg" alt="Computer Mouse"/>
                                    </div>
                                    <div>Computer Mouse</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">C</div>
                                    <div class="pix">
                                        <img src="<?php echo $websiteUrl?>/uploaded_files/cbt/question-images/monitor.jpg" alt="Monitor"/>
                                    </div>
                                    <div>Monitor</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">D</div>
                                    <div class="pix">
                                        <img src="<?php echo $websiteUrl?>/uploaded_files/cbt/question-images/printer.jpg" alt="Printer"/>
                                    </div>
                                    <div>Printer</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                            <span>Question 3</span>
                        </label>
                        <div class="btn-div">
                            <button class="btn" title="Edit Question"><i class="bi-pencil-square"></i> Edit</button>
                        </div>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <div>
                                <p>______________ is an electronic machine that accept data, process data and provide output.</p>
                            </div>
                            <div class="options-div">

                                <div class="each-option">
                                    <div class="letter">A</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option correct-option">
                                    <div class="letter correct-letter">B</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">C</div>

                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">D</div>
                                    <div>House</div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                            <span>Question 4</span>
                        </label>
                        <div class="btn-div">
                            <button class="btn" title="Edit Question"><i class="bi-pencil-square"></i> Edit</button>
                        </div>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <div>
                                <p>______________ is an electronic machine that accept data, process data and provide output.</p>
                            </div>
                            <div class="options-div">

                                <div class="each-option">
                                    <div class="letter">A</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option correct-option">
                                    <div class="letter correct-letter">B</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">C</div>

                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">D</div>
                                    <div>House</div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'quizQuestion') { ?>
    <div class="question-back-div">
        <div class="top-div">
            <label>
                <span>Quiz Questions</span> |
                <div class="text"><i class="bi-clock"></i> Quiz Duration:</div>
                <span id="quiz_duration">00:00:00</span>
            </label>

            <div class="btn-div">
                <button class="btn del-btn" id="deleteBtn" title="Remove All Quiz Questions" onclick=""><i class="bi-trash"></i> Remove All</button>
            </div>
        </div>

        <div class="question-body-div">
            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                            <span>Question 1</span>
                        </label>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <div>
                                <p>______________ is an electronic machine that accept data, process data and provide output.</p>
                            </div>
                            <div class="options-div">

                                <div class="each-option">
                                    <div class="letter">A</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option correct-option">
                                    <div class="letter correct-letter">B</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">C</div>

                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">D</div>
                                    <div>House</div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                            <span>Question 1</span>
                        </label>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <div>
                                <p>______________ is an electronic machine that accept data, process data and provide output.</p>
                            </div>
                            <div class="options-div">

                                <div class="each-option">
                                    <div class="letter">A</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option correct-option">
                                    <div class="letter correct-letter">B</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">C</div>

                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">D</div>
                                    <div>House</div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                            <span>Question 1</span>
                        </label>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <div>
                                <p>______________ is an electronic machine that accept data, process data and provide output.</p>
                            </div>
                            <div class="options-div">

                                <div class="each-option">
                                    <div class="letter">A</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option correct-option">
                                    <div class="letter correct-letter">B</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">C</div>

                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">D</div>
                                    <div>House</div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                            <span>Question 1</span>
                        </label>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <div>
                                <p>______________ is an electronic machine that accept data, process data and provide output.</p>
                            </div>
                            <div class="options-div">

                                <div class="each-option">
                                    <div class="letter">A</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option correct-option">
                                    <div class="letter correct-letter">B</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">C</div>

                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">D</div>
                                    <div>House</div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'loadQuestionManually') { ?>
    <script src="js/TextEditor.js" referrerpolicy="origin"></script>

    <div class="question-back-div">
        <div class="top-div">
            <label>
                <?php if (empty($question_id)) {
                    $pageTitle = "Load Questions Manually";
                } else {
                    $pageTitle = "Update This Question";
                } ?>
                <span><?php echo $pageTitle; ?></span>
            </label>
        </div>

        <div class="question-body-div">
            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <span>Set Question</span>
                        </label>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <script>
                                tinymce.init({
                                    selector: '#question_text',
                                    plugins: "link image table",
                                    skin: $('html').hasClass('dark-mode') ? 'oxide-dark' : 'oxide',
                                    content_css: $('html').hasClass('dark-mode') ? 'dark' : 'default',

                                    setup: function (editor) {
                                        editor.on('init', function () {
                                            setTimeout(function () {
                                                editor.setContent(question_text);
                                            }, 300);
                                        });
                                    }
                                });
                            </script>
                            <textarea style="width: 100%;" rows="10" id="question_text" title="QUIZ QUESTION" placeholder="QUIZ QUESTION"></textarea>
                        </div>
                    </div>
                </div>
            </div>


            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <span>Option A</span>
                        </label>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <script>
                                tinymce.init({
                                    selector: '#option_a',
                                    plugins: "link image table",
                                    skin: $('html').hasClass('dark-mode') ? 'oxide-dark' : 'oxide',
                                    content_css: $('html').hasClass('dark-mode') ? 'dark' : 'default',

                                    setup: function (editor) {
                                        editor.on('init', function () {
                                            setTimeout(function () {
                                                editor.setContent(option_a);
                                            }, 300);
                                        });
                                    }
                                });
                            </script>
                            <textarea style="width: 100%;" rows="10" id="option_a" title="OPTION A" placeholder="OPTION A"></textarea>
                        </div>
                    </div>
                </div>
            </div>


            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <span>Option B</span>
                        </label>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <script>
                                tinymce.init({
                                    selector: '#option_b',
                                    plugins: "link image table",
                                    skin: $('html').hasClass('dark-mode') ? 'oxide-dark' : 'oxide',
                                    content_css: $('html').hasClass('dark-mode') ? 'dark' : 'default',

                                    setup: function (editor) {
                                        editor.on('init', function () {
                                            setTimeout(function () {
                                                editor.setContent(option_b);
                                            }, 300);
                                        });
                                    }
                                });
                            </script>
                            <textarea style="width: 100%;" rows="10" id="option_b" title="OPTION B" placeholder="OPTION BY"></textarea>
                        </div>
                    </div>

                </div>
            </div>

            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <span>Option C</span>
                        </label>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <script>
                                tinymce.init({
                                    selector: '#option_c',
                                    plugins: "link image table",
                                    skin: $('html').hasClass('dark-mode') ? 'oxide-dark' : 'oxide',
                                    content_css: $('html').hasClass('dark-mode') ? 'dark' : 'default',

                                    setup: function (editor) {
                                        editor.on('init', function () {
                                            setTimeout(function () {
                                                editor.setContent(option_c);
                                            }, 300);
                                        });
                                    }
                                });
                            </script>
                            <textarea style="width: 100%;" rows="10" id="option_c" title="OPTION C" placeholder="OPTION C"></textarea>
                        </div>
                    </div>

                </div>
            </div>

            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <span>Option D</span>
                        </label>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <script>
                                tinymce.init({
                                    selector: '#option_d',
                                    plugins: "link image table",
                                    skin: $('html').hasClass('dark-mode') ? 'oxide-dark' : 'oxide',
                                    content_css: $('html').hasClass('dark-mode') ? 'dark' : 'default',

                                    setup: function (editor) {
                                        editor.on('init', function () {
                                            setTimeout(function () {
                                                editor.setContent(option_d);
                                            }, 300);
                                        });
                                    }
                                });
                            </script>
                            <textarea style="width: 100%;" rows="10" id="option_d" title="OPTION D" placeholder="OPTION D"></textarea>
                        </div>
                    </div>

                </div>
            </div>

            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <span>Option E</span>
                        </label>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <script>
                                tinymce.init({
                                    selector: '#option_e',
                                    plugins: "link image table",
                                    skin: $('html').hasClass('dark-mode') ? 'oxide-dark' : 'oxide',
                                    content_css: $('html').hasClass('dark-mode') ? 'dark' : 'default',

                                    setup: function (editor) {
                                        editor.on('init', function () {
                                            setTimeout(function () {
                                                editor.setContent(option_e);
                                            }, 300);
                                        });
                                    }
                                });
                            </script>
                            <textarea style="width: 100%;" rows="10" id="option_e" title="OPTION E" placeholder="OPTION E"></textarea>
                        </div>
                    </div>

                </div>
            </div>

            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <span>Set Correct Option</span>
                        </label>
                    </div>

                    <div class="text_field_container" id="answer_container">
                        <script>
                            textField({
                                id: 'answer',
                                title: 'A, B, C, D, E',
                            });
                        </script>
                    </div>

                    <div class="btn-div">
                        <button class="submit-btn" id="submit_btn" title="Upload Questions" onclick=""><i class="bi-cloud-upload"></i> Upload Questions</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'loadQuestionAutomatically') { ?>
    <div class="question-back-div">
        <div class="top-div">
            <label>
                <span>Load Questions Automatically</span>
            </label>
        </div>

        <div class="question-body-div">
            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <span>Upload <i>(CSV Format Only)</i></span>
                        </label>
                        <div class="btn-div">
                            <button class="btn" type="button" id="downloadBtn" title="Download Question Template" onclick="_downloadQuestionTemplate();"><i class="bi-download"></i> Download Question Template</button>
                        </div>
                    </div>

                    <div class="input-container">
                        <input id="quiz_question_template" name="quiz_question_template" type="file" class="cbt_text_field" placeholder="Choose File (.CSV)" title="Choose File (.CSV)" accept=".csv" />
                    </div>

                    <div class="btn-div">
                        <button class="submit-btn" id="submit_btn" title="Upload Questions" onclick=""><i class="bi-cloud-upload"></i> Upload Questions</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>