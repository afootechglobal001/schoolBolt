<?php if ($page == 'cbtPageDetails') { ?>
    <script>useEachCbtPageDetailsSession = JSON.parse(sessionStorage.getItem("useEachCbtPageDetailsSession"));</script>

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
                                    Session: <strong id="sessionName">
                                        <script>$("#sessionName").html(useEachCbtPageDetailsSession?.branchData?.session);</script>
                                    </strong>
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
                            <span class="list-value" id="termName">
                                <script>$("#termName").html(useEachCbtPageDetailsSession?.termData?.termName);</script>
                            </span>
                        </div>

                        <div class="list-div">
                            <div class="list-label">
                                <i class="bi-building"></i>
                                <span>Department</span>
                            </div>
                            <span class="list-value" id="departmentName">
                                <script>$("#departmentName").html(useEachCbtPageDetailsSession?.departmentData?.departmentName);</script>
                            </span>
                        </div>

                        <div class="list-div">
                            <div class="list-label">
                                <i class="bi-people"></i>
                                <span>Class</span>
                            </div>
                            <span class="list-value" id="className">
                                <script>$("#className").html(useEachCbtPageDetailsSession?.classData?.className);</script>
                            </span>
                        </div>

                        <div class="list-div">
                            <div class="list-label">
                                <i class="bi-book"></i>
                                <span>Subject</span>
                            </div>
                            <span class="list-value" id="subjectName">
                                <script>$("#subjectName").html(useEachCbtPageDetailsSession?.subjectData?.subjectName);</script>
                            </span>
                        </div>

                        <div class="list-div">
                            <div class="list-label">
                                <i class="bi-file-earmark-text"></i>
                                <span>CBT Title</span>
                            </div>
                            <span class="list-value" id="cbtTitle">
                                <script>$("#cbtTitle").html(useEachCbtPageDetailsSession?.cbtData?.cbtTitle);</script>
                            </span>
                        </div>
                    </div>
                
                    <div class="question-count-card">
                        <div class="question-count-icon">
                            <i class="bi-question-lg"></i>
                        </div>

                        <div class="question-count-content">
                            <span>Total Question Bank</span>
                            <strong id="totalQuestionsBank">
                                <script>$("#totalQuestionsBank").html(useEachCbtPageDetailsSession?.questionBankData?.totalQuestionBank);</script>
                            </strong>
                        </div>
                    </div>

                    <div class="question-count-card">
                        <div class="question-count-icon">
                            <i class="bi-question-lg"></i>
                        </div>

                        <div class="question-count-content">
                            <span>Total Quiz Questions</span>
                            <strong id="totalQuizQuestions">
                                <script>$("#totalQuizQuestions").html(useEachCbtPageDetailsSession?.quizData?.totalQuizQuestions);</script>
                            </strong>
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
                    <li title="Load Question Manually" id="loadQuestionManually" onclick="sessionStorage.removeItem('useEachCbtQuestionSession'); _getActiveCbtPagesTab({divid: 'loadQuestionManually', page: 'loadQuestionManually', url: cbtAdminMiddleWareUrl});">Load Questions Manually</li>
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
                <div class="search-div">
                    <input type="text"
                        onkeyup="_filtersCbtQuestionBankData(this.value);"
                        placeholder="Search Question Here...">
                    <i class="bi bi-search"></i>
                </div>

                <button class="btn" id="submitBtn" title="Set As Questions Quiz" onclick="_proceedSetQuizQuestions();"><i class="bi-check2-circle"></i> Set As Quiz Questions</button>
                <button class="btn del-btn" id="deleteBtn" title="Delete Quiz Questions" onclick=""><i class="bi-trash"></i> Delete Questions</button>
            </div>
        </div>

        <div class="question-body-div" id="questionBankContent">
            <script>
                _fetchCbtQuestionBankData();
            </script>

            <div class="content-loading-div">
                <img src="<?php echo $websiteUrl ?>/all-images/images/spinner.gif" alt="Loading" />
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'quizQuestion') { ?>
    <script>
        useSetSelectedQuizQuestions = JSON.parse(
            sessionStorage.getItem("useSetSelectedQuizQuestions") || "{}"
        );
    </script>
    <div class="question-back-div">
        <div class="top-div">
            <label>
                <span>Quiz Questions</span> |
                <div class="text"><i class="bi-clock"></i> Quiz Duration:</div>
                <span id="quiz_duration">
                    <script>$("#quiz_duration").html(useSetSelectedQuizQuestions?.timeAllowed || "00:00:00");</script>
                </span>
            </label>

            <div class="btn-div">
                <button class="btn" id="submitBtn" title="Approve Questions" onclick=""><i class="bi-check2-circle"></i> Approve Questions</button>
                <button class="btn del-btn" id="deleteBtn" title="Disapprove Questions" onclick=""><i class="bi-trash"></i> Disapprove Questions</button>
            </div>
        </div>

        <div class="question-body-div" id="quizQuestionContent">
            <script>
                _fetchCbtQuizQuestionData();
            </script>

            <div class="content-loading-div">
                <img src="<?php echo $websiteUrl ?>/all-images/images/spinner.gif" alt="Loading" />
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'loadQuestionManually') { ?>
    <script>
        useEachCbtQuestionSession = JSON.parse(
            sessionStorage.getItem("useEachCbtQuestionSession") || "{}"
        );

        // Question Image
        var questionPix = useEachCbtQuestionSession?.questionPix
            ? questionPixPath + "/" + useEachCbtQuestionSession.questionPix + '?t=' + new Date().getTime()
            : "<?php echo $websiteUrl; ?>/all-images/images/default-question.png";

        $("#quizQuestionPix")
        .attr("src", questionPix)
        .attr(
            "alt",
            (useEachCbtQuestionSession?.questionText || "Question") + " Image"
        );

        setTimeout(function() {
            tinymce.get('questionText').setContent(useEachCbtQuestionSession?.questionText ?? "");
        }, 2000);

        var optionsData = useEachCbtQuestionSession?.optionsData ?? [];

        optionsData.forEach(function(option) {
            var optionText = option?.optionText ?? "";
            var optionPix = option?.optionPix ?? "";

            // Image to use for the option
            var optionImage = optionPix
            ? optionPixPath + "/" + optionPix + '?t=' + new Date().getTime()
            : "<?php echo $websiteUrl; ?>/all-images/images/default-question.png";

            if (option.optionId === 'A') {
                $("#quizOptionAPix")
                .attr("src", optionImage)
                .attr("alt", optionText + " Image");

                setTimeout(function() {
                    tinymce.get('optionA').setContent(optionText);
                }, 2000);
            }

            if (option.optionId === 'B') {
                $("#quizOptionBPix")
                .attr("src", optionImage)
                .attr("alt", optionText + " Image");

                setTimeout(function() {
                    tinymce.get('optionB').setContent(optionText);
                }, 2000);
            }

            if (option.optionId === 'C') {
                $("#quizOptionCPix")
                .attr("src", optionImage)
                .attr("alt", optionText + " Image");

                setTimeout(function() {
                    tinymce.get('optionC').setContent(optionText);
                }, 2000);
            }

            if (option.optionId === 'D') {
                $("#quizOptionDPix")
                .attr("src", optionImage)
                .attr("alt", optionText + " Image");

                setTimeout(function() {
                    tinymce.get('optionD').setContent(optionText);
                }, 2000);
            }

            if (option.optionId === 'E') {
                $("#quizOptionEPix")
                .attr("src", optionImage)
                .attr("alt", optionText + " Image");

                setTimeout(function() {
                    tinymce.get('optionE').setContent(optionText);
                }, 2000);
            }
        });

        $('#pageTitle').html(
            useEachCbtQuestionSession?.questionId
                ? 'Update This Question'
                : 'Load Questions Manually'
        );

        $('#btnContainer').html(
            useEachCbtQuestionSession?.questionId
                ? '<button class="submit-btn" id="submitBtn" title="Update Question" onclick="_uploadQuestionsManually();"><i class="bi-check2-circle"></i> Update Question</button>'
                : '<button class="submit-btn" id="submitBtn" title="Upload Questions" onclick="_uploadQuestionsManually();"><i class="bi-cloud-upload"></i> Upload Questions</button>'
        );
    </script>
    <script src="js/TextEditor.js" referrerpolicy="origin"></script>

    <div class="question-back-div">
        <div class="top-div">
            <label>
                <span id="pageTitle">Load Questions Manually</span>
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
                        <div class="pix-div">
                            <label>
                                <img id="quizQuestionPix" src="<?php echo $websiteUrl; ?>/all-images/images/default-question.png" alt="Default Image">
                                <input type="file" id="questionPix" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="quizQuestionPixPreview.UpdatePreview(this);" />
                            </label>
                        </div>

                        <div class="text-div">
                            <script>
                                tinymce.init({
                                    selector: '#questionText',
                                    plugins: "link image table",
                                    skin: $('html').hasClass('dark-mode') ? 'oxide-dark' : 'oxide',
                                    content_css: $('html').hasClass('dark-mode') ? 'dark' : 'default',
                                });
                            </script>
                            <textarea style="width: 100%;" rows="10" id="questionText" title="QUIZ QUESTION" placeholder="QUIZ QUESTION"></textarea>
                            <div class="issueText" id="issue_questionText"></div>
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
                        <div class="pix-div">
                            <label>
                                <img id="quizOptionAPix" src="<?php echo $websiteUrl; ?>/all-images/images/default-option.png" alt="Default Image">
                                <input type="file" id="optionAPix" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="quizOptionAPixPreview.UpdatePreview(this);" />
                            </label>
                        </div>

                        <div class="text-div">
                            <script>
                                tinymce.init({
                                    selector: '#optionA',
                                    plugins: "link image table",
                                    skin: $('html').hasClass('dark-mode') ? 'oxide-dark' : 'oxide',
                                    content_css: $('html').hasClass('dark-mode') ? 'dark' : 'default',
                                });
                            </script>
                            <textarea style="width: 100%;" rows="10" id="optionA" title="OPTION A" placeholder="OPTION A"></textarea>
                            <div class="issueText" id="issue_optionA"></div>
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
                        <div class="pix-div">
                            <label>
                                <img id="quizOptionBPix" src="<?php echo $websiteUrl; ?>/all-images/images/default-option.png" alt="Default Image">
                                <input type="file" id="optionBPix" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="quizOptionBPixPreview.UpdatePreview(this);" />
                            </label>
                        </div>

                        <div class="text-div">
                            <script>
                                tinymce.init({
                                    selector: '#optionB',
                                    plugins: "link image table",
                                    skin: $('html').hasClass('dark-mode') ? 'oxide-dark' : 'oxide',
                                    content_css: $('html').hasClass('dark-mode') ? 'dark' : 'default',
                                });
                            </script>
                            <textarea style="width: 100%;" rows="10" id="optionB" title="OPTION B" placeholder="OPTION B"></textarea>
                            <div class="issueText" id="issue_optionB"></div>
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
                        <div class="pix-div">
                            <label>
                                <img id="quizOptionCPix" src="<?php echo $websiteUrl; ?>/all-images/images/default-option.png" alt="Default Image">
                                <input type="file" id="optionCPix" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="quizOptionCPixPreview.UpdatePreview(this);" />
                            </label>
                        </div>

                        <div class="text-div">
                            <script>
                                tinymce.init({
                                    selector: '#optionC',
                                    plugins: "link image table",
                                    skin: $('html').hasClass('dark-mode') ? 'oxide-dark' : 'oxide',
                                    content_css: $('html').hasClass('dark-mode') ? 'dark' : 'default',
                                });
                            </script>
                            <textarea style="width: 100%;" rows="10" id="optionC" title="OPTION C" placeholder="OPTION C"></textarea>
                            <div class="issueText" id="issue_optionC"></div>
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
                        <div class="pix-div">
                            <label>
                                <img id="quizOptionDPix" src="<?php echo $websiteUrl; ?>/all-images/images/default-option.png" alt="Default Image">
                                <input type="file" id="optionDPix" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="quizOptionDPixPreview.UpdatePreview(this);" />
                            </label>
                        </div>

                        <div class="text-div">
                            <script>
                                tinymce.init({
                                    selector: '#optionD',
                                    plugins: "link image table",
                                    skin: $('html').hasClass('dark-mode') ? 'oxide-dark' : 'oxide',
                                    content_css: $('html').hasClass('dark-mode') ? 'dark' : 'default',
                                });
                            </script>
                            <textarea style="width: 100%;" rows="10" id="optionD" title="OPTION D" placeholder="OPTION D"></textarea>
                            <div class="issueText" id="issue_optionD"></div>
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
                        <div class="pix-div">
                            <label>
                                <img id="quizOptionEPix" src="<?php echo $websiteUrl; ?>/all-images/images/default-option.png" alt="Default Image">
                                <input type="file" id="optionEPix" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="quizOptionEPixPreview.UpdatePreview(this);" />
                            </label>
                        </div>

                        <div class="text-div">
                            <script>
                                tinymce.init({
                                    selector: '#optionE',
                                    plugins: "link image table",
                                    skin: $('html').hasClass('dark-mode') ? 'oxide-dark' : 'oxide',
                                    content_css: $('html').hasClass('dark-mode') ? 'dark' : 'default',
                                });
                            </script>
                            <textarea style="width: 100%;" rows="10" id="optionE" title="OPTION E" placeholder="OPTION E"></textarea>
                            <div class="issueText" id="issue_optionE"></div>
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

                    <div class="text_field_container" id="questionAnswer_container">
                        <script>
                            textField({
                                id: 'questionAnswer',
                                title: 'A, B, C, D, E',
                                value: useEachCbtQuestionSession?.questionAnswer ?? "",
                            });
                        </script>
                    </div>

                    <div class="btn-div" id="btnContainer"></div>
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

                    <div class="input-wrapper">
                        <div class="input-container" id="issueBorder">
                            <input id="questionTemplate" name="questionTemplate" type="file" class="cbt_text_field" placeholder="Choose File (.CSV)" title="Choose File (.CSV)" accept=".csv" />
                        </div>
                        <div id="issues_questionTemplate" class="issueText"></div>
                    </div>

                    <div class="btn-div">
                        <button class="submit-btn" id="submitBtn" title="Upload Questions" onclick="_uploadQuestionAutomatically();"><i class="bi-cloud-upload"></i> Upload Questions</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'setQuizQuestionsForm') { ?>
    <script>useEachCbtPageDetailsSession = JSON.parse(sessionStorage.getItem("useEachCbtPageDetailsSession"));</script>
    <script>
        useSetSelectedQuizQuestions = JSON.parse(
            sessionStorage.getItem("useSetSelectedQuizQuestions") || "{}"
        );
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="form-title-div">
            <div class="title-div">
                <div class="icon-div">
                   <i class="bi bi-file-earmark-plus-fill"></i>
                </div>

                <h3>ACTIVATE QUIZ QUESTIONS</h3>
            </div>

            <div class="btn-div">
                <button class="btn" title="Close"
                    onclick="_alertClose(<?php echo $modalLayer ?>);">
                    <i class="bi bi-x-lg"></i> Close
                </button>
            </div>
        </div>

        <div class="container-back-div">
            <div class="form-notification">
                <p>
                    You are about to activate
                    quiz questions.
                    Please set the time allowed before activating the questions.
                </p>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-question-circle"></i>
                            <p>Question Details</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="alert alert-success form-alert-div">
                            <div class="alert-list-div">
                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Session:</div>
                                        <div>
                                            <strong id="activateSession">
                                                <script>$("#activateSession").html(useEachCbtPageDetailsSession?.branchData?.session);</script>
                                            </strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Term:</div>
                                        <div>
                                            <strong id="activateTermName">
                                                <script>$("#activateTermName").html(useEachCbtPageDetailsSession?.termData?.termName);</script>
                                            </strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Department:</div>
                                        <div>
                                            <strong id="activateDepartment">
                                                <script>$("#activateDepartment").html(useEachCbtPageDetailsSession?.departmentData?.departmentName);</script>
                                            </strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Class:</div>
                                        <div>
                                            <strong id="activateClass">
                                                <script>$("#activateClass").html(useEachCbtPageDetailsSession?.classData?.className);</script>
                                            </strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Subject:</div>
                                        <div>
                                            <strong id="activateSubject">
                                                <script>$("#activateSubject").html(useEachCbtPageDetailsSession?.subjectData?.subjectName);</script>
                                            </strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>CBT title:</div>
                                        <div>
                                            <strong id="activateCbtTitle">
                                                <script>$("#activateCbtTitle").html(useEachCbtPageDetailsSession?.cbtData?.cbtTitle);</script>
                                            </strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Total Questions Selected:</div>
                                        <div>
                                            <strong id="totalQuestions">
                                                <script>
                                                    $("#totalQuestions").html(useSetSelectedQuizQuestions?.totalQuestions ?? 0);
                                                </script>
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-table-content-div">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-clock-fill"></i>
                            <p>Time Allowed</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="flex-text-field">
                            <div class="text_field_container col-1" id="quizHour_container">
                                <script>
                                    selectField({
                                        id: 'quizHour',
                                        title: 'HH',
                                    });
                                    _fetchTimeCountOption('quizHour', 12);
                                </script>
                            </div>

                            <div class="text_field_container col-2" id="quizMinute_container">
                                <script>
                                    selectField({
                                        id: 'quizMinute',
                                        title: 'MM',
                                    });
                                    _fetchTimeCountOption('quizMinute', 60);
                                </script>
                            </div>

                            <div class="text_field_container col-3" id="quizSecond_container">
                                <script>
                                    selectField({
                                        id: 'quizSecond',
                                        title: 'SS',
                                    });
                                    _fetchTimeCountOption('quizSecond', 60);
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-div">
                <button class="btn" title="ACTIVATE" id="setBtn"
                    onclick="_setQuizQuestions();">
                    <i class="bi-check"></i> SET QUESTIONS
                </button>
            </div>
        </div>
        <script>
            $(".flex-text-field select option[value='']").html("--");
        </script>
    </div>
<?php } ?>