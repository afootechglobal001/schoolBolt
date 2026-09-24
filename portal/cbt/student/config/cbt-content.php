<?php if ($page == 'cbtPageDetails') { ?>
    <script>useEachStudentCbtPageDetailsSession = JSON.parse(sessionStorage.getItem("useEachStudentCbtPageDetailsSession"));</script>

    <div class="cbt-creation-panel" data-aos="fade-in" data-aos-duration="1000">
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
                                        <script>$("#sessionName").html(useEachStudentCbtPageDetailsSession?.branchData?.session);</script>
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
                                <script>$("#termName").html(useEachStudentCbtPageDetailsSession?.termData?.termName);</script>
                            </span>
                        </div>

                        <div class="list-div">
                            <div class="list-label">
                                <i class="bi-building"></i>
                                <span>Department</span>
                            </div>
                            <span class="list-value" id="departmentName">
                                <script>$("#departmentName").html(useEachStudentCbtPageDetailsSession?.departmentData?.departmentName);</script>
                            </span>
                        </div>

                        <div class="list-div">
                            <div class="list-label">
                                <i class="bi-people"></i>
                                <span>Class</span>
                            </div>
                            <span class="list-value" id="className">
                                <script>$("#className").html(useEachStudentCbtPageDetailsSession?.classData?.className);</script>
                            </span>
                        </div>

                        <div class="list-div">
                            <div class="list-label">
                                <i class="bi-book"></i>
                                <span>Subject</span>
                            </div>
                            <span class="list-value" id="subjectName">
                                <script>$("#subjectName").html(useEachStudentCbtPageDetailsSession?.subjectData?.subjectName);</script>
                            </span>
                        </div>

                        <div class="list-div">
                            <div class="list-label">
                                <i class="bi-file-earmark-text"></i>
                                <span>CBT Title</span>
                            </div>
                            <span class="list-value" id="cbtTitle">
                                <script>$("#cbtTitle").html(useEachStudentCbtPageDetailsSession?.cbtData?.cbtTitle);</script>
                            </span>
                        </div>
                    </div>
                
                    <div class="question-count-card">
                        <div class="question-count-icon">
                            <i class="bi-question-lg"></i>
                        </div>

                        <div class="question-count-content">
                            <span>No of Questions</span>
                            <strong id="totalQuizQuestions">
                                <script>$("#totalQuizQuestions").html(useEachStudentCbtPageDetailsSession?.quizData?.totalQuizQuestions);</script>
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="cbt-content-div">
            <div class="title-div">
                <label>
                    <strong>Computer Based Test (CBT)</strong>
                    <div class="line">
                        <span>2026/2027</span> |
                        <span>THIRD TERM</span>
                    </div>
                </label>

                <div class="btn-div">
                    <button class="btn" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">
                        <i class="bi bi-x-lg"></i> Close
                    </button>
                </div>
            </div>

            <div id="getCbtExamPanel">
                <script>
                    _getCbtExamPagesTab({
                        page: 'cbtExamSummary',
                        url: cbtStudentPortalMiddleWareUrl
                    });
                </script>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'cbtExamSummary') { ?>
    <div class="exam-page-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="exam-page-back-div-in">
            <div class="exam-page-wrapper">
                <div class="exam-header">
                    <div class="exam-header-inner">
                        <div class="exam-title-div">
                            <div class="exam-icon-div">
                                <i class="bi bi-file-earmark-text-fill"></i>
                            </div>

                            <div class="exam-title-text">
                                <h2>MOCK EXAMINATION</h2>

                                <div class="exam-meta">
                                    <span>KINDERGARTEN</span>   
                                    <i class="bi bi-dot"></i>
                                    <span>KG</span>
                                    |
                                    <span>NUMERACY</span>
                                </div>
                            </div>
                        </div>

                        <div class="question-count-card">
                            <div class="question-count-icon">
                                <i class="bi-question-lg"></i>
                            </div>

                            <div class="question-count-content">
                                <span>No of Questions</span>
                                <strong id="totalQuizQuestions">
                                    30
                                </strong>
                            </div>
                        </div>
                    </div>

                    <div class="exam-countdown">
                        <div class="countdown-icon">
                            <i class="bi bi-clock-fill"></i>
                        </div>

                        <div class="countdown-content">
                            <p>Available Time</p>
                            <div class="countdown-time">
                                <span id="examHours">00</span>
                                <b>:</b>
                                <span id="examMinutes">30</span>
                                <b>:</b>
                                <span id="examSeconds">00</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="exam-main-content">
                    <div class="instructions-panel">
                        <div class="instructions-header">
                            <div class="instructions-icon">
                                <i class="bi bi-info-lg"></i>
                            </div>

                            <h3>Instructions</h3>
                        </div>

                        <div class="instructions-list">
                            <div class="instruction-item">
                                <div class="instruction-number">1</div>
                                <p>
                                    Read each question carefully before selecting
                                    your answer.
                                </p>
                            </div>

                            <div class="instruction-item">
                                <div class="instruction-number">2</div>
                                <p>
                                    Each question has only one correct answer.
                                </p>
                            </div>

                            <div class="instruction-item">
                                <div class="instruction-number">3</div>
                                <p>
                                    You go back to previous questions once
                                    you move to the next question.
                                </p>
                            </div>

                            <div class="instruction-item">
                                <div class="instruction-number">4</div>
                                <p>
                                    The exam is timed. The timer will start when
                                    you click the <strong>"Start Exam"</strong> button.
                                </p>
                            </div>

                            <div class="instruction-item">
                                <div class="instruction-number">6</div>
                                <p>
                                    Do not refresh the page or close the browser
                                    during the exam.
                                </p>
                            </div>
                        </div>

                        <div class="instruction-footer">
                            <div class="instruction-footer-icon">
                                <i class="bi bi-check-lg"></i>
                            </div>

                            <div>
                                <strong>You're all set!, Good Luck!</strong>
                                <p>
                                    Click the Start Exam button when you're ready.
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="exam-ready-panel">
                        <div class="ready-content">
                            <div class="ready-icon">
                                <img src="<?php echo $websiteUrl ?>/all-images/images/ready-icon.png" alt="Ready Icon">
                            </div>

                            <div class="ready-text">
                                <h1>Ready to Begin?</h1>

                                <p>
                                    You are about to start the
                                    <strong id="cbtTitle">WELCOME TEST</strong> for
                                    <strong id="cbtTitle">NUMERACY.</strong>
                                </p>

                                <div class="start-btn-div">
                                    <button class="start-btn" id="startExamBtn" title="Start Exam" onclick="_getCbtExamPagesTab({page: 'studentCbtExamPage', url: cbtStudentPortalMiddleWareUrl});">
                                        <i class="bi bi-play-fill"></i>
                                        <span>Start Exam</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'studentCbtExamPage') { ?>
    <div class="exam-page-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="exam-page-back-div-in exam-page-back-div-inner">
            <div class="exam-page-wrapper">
                <div class="exam-header">
                    <div class="exam-header-inner">
                        <div class="exam-title-div">
                            <div class="exam-icon-div">
                                <i class="bi bi-file-earmark-text-fill"></i>
                            </div>

                            <div class="exam-title-text">
                                <h2>MOCK EXAMINATION</h2>

                                <div class="exam-meta">
                                    <span>KINDERGARTEN</span>   
                                    <i class="bi bi-dot"></i>
                                    <span>KG</span>
                                    |
                                    <span>NUMERACY</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="exam-countdown">
                        <div class="countdown-icon">
                            <i class="bi bi-clock-fill"></i>
                        </div>

                        <div class="countdown-content">
                            <p>Time Remaining</p>
                            <div class="countdown-time">
                                <span id="examHours">00</span>
                                <b>:</b>
                                <span id="examMinutes">30</span>
                                <b>:</b>
                                <span id="examSeconds">00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="exam-question-body-div" id="questionBankContent">
                <div class="question-div">
                    <div class="div-in">
                        <div class="check-div">
                            <label>
                                <span>Question 1</span>
                            </label>
                        </div>

                        <div class="each-question">
                            <!-- <div class="pix-div">
                                <img src="<?php echo $websiteUrl ?>/uploaded_files/cbt/question-pix/QUES08920260922093326_pix.jpg" alt="Question Image"/>
                            </div> -->

                            <div class="text-div">
                                <div>
                                    <p>Which of the following is an electronic machine that accept data, process data and provide output?</p>
                                </div>

                                <div class="options-div">
                                    <label class="each-option">
                                        <div class="radio-wrapper">
                                            <div class="radio-div">
                                                <input type="radio" name="question_1" value="A">
                                                <span class="radio-custom"></span>
                                            </div>

                                            <div class="letter">A</div>
                                        </div>

                                        <!-- <div class="pix">
                                            <img src="<?php echo $websiteUrl ?>/uploaded_files/cbt/option-pix/QUES06520260918091747_option_A.jpg" alt="Option A"/>
                                        </div> -->

                                        <div>House</div>
                                    </label>

                                    <label class="each-option">
                                        <div class="radio-wrapper">
                                            <div class="radio-div">
                                                <input type="radio" name="question_1" value="B">
                                                <span class="radio-custom"></span>
                                            </div>

                                            <div class="letter">B</div>
                                        </div>

                                        <div>House</div>
                                    </label>

                                    <label class="each-option">
                                        <div class="radio-wrapper">
                                            <div class="radio-div">
                                                <input type="radio" name="question_1" value="C">
                                                <span class="radio-custom"></span>
                                            </div>

                                            <div class="letter">C</div>
                                        </div>

                                        <div>House</div>
                                    </label>

                                    <label class="each-option">
                                        <div class="radio-wrapper">
                                            <div class="radio-div">
                                                <input type="radio" name="question_1" value="D">
                                                <span class="radio-custom"></span>
                                            </div>

                                            <div class="letter">D</div>
                                        </div>

                                        <div>House</div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="question-bottom-div">
            <div class="div-in">
                <button class="prev-btn" id="prevButton" title="Previous"><i class="bi bi-arrow-left-circle"></i> Previous</button>
                <div class="question-num-div" id="numButtonContainerId">
                    <button class="num-btn active" id="numBtnId">1</button>
                    <button class="num-btn" id="numBtnId">2</button>
                    <!-- <button class="num-btn" id="numBtnId">3</button>
                    <button class="num-btn" id="numBtnId">4</button>
                    <button class="num-btn" id="numBtnId">5</button>
                    <button class="num-btn" id="numBtnId">6</button>
                    <button class="num-btn" id="numBtnId">7</button> -->
                </div>

                <button class="prev-btn next-btn" id="nextBtn" title="Next">Next <i class="bi bi-arrow-right-circle"></i></button>
            </div>
        </div>
    </div>
<?php } ?>