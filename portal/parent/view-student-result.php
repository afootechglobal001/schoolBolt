<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include 'auth-meta.php' ?>
    <title><?php echo $appName ?> | Parent View Result</title>
    <meta name="keywords" content="Parent View Result  - <?php echo $appName ?>" />
    <meta name="description" content="Parent View Result - <?php echo $appName ?>" />
</head>

<body>
    <?php include 'alert.php' ?>
    <section class="login-session">
        <script>
            $(document).ready(function() {
                let proceedViewResultSessionData = JSON.parse(localStorage.getItem("proceedViewResultSessionData"));
                if (!proceedViewResultSessionData) {
                    window.location.href = parentLoginUrl;
                }

                $("#fullName").html(proceedViewResultSessionData?.studentData?.fullName);
            });
        </script>

        <div class="login-div">
            <header class="animated fadeInDown">
                <div class="header-div-in">
                    <div class="logo-div">
                        <a href="<?php echo $clientWebsiteUrl ?>" title="<?php echo $clientName ?>">
                            <img src="<?php echo $websiteUrl ?>/images/logo.png" alt="<?php echo $clientName ?> Logo" class="animated zoomIn" /></a>
                    </div>

                    <ul>
                        <a href="<?php echo $clientWebsiteUrl ?>" title="<?php echo $clientName ?>">
                            <li>Back to website</li>
                        </a>
                    </ul>
                </div>
            </header>

            <div class="form-back-div">
                <div class="form-div view-result-form-div" data-aos="fade-in" data-aos-duration="1600">
                    <div class="top-div">
                        <h1 class="result-title">Available Student Results</h1>
                    </div>

                    <div class="inner-form">
                        <div class="alert alert-success login-form-alert">
                            <i class="bi-person"></i>
                            Hi <span id="fullName">Loading...</span>,
                            Your available results are listed below. 
                            Click on a class to view and print result.
                        </div>

                        <div class="pages-toggle-back-div" id="pageContent">
                            <script>
                                $(document).ready(function() {
                                    let sessionData = JSON.parse(localStorage.getItem("proceedViewResultSessionData"));
                                    let start = 0

                                    const content = sessionData.data
                                        .map((classes, index) => {
                                        const resultContent = classes.results
                                            .map(
                                            (resultItems) => `
                                        <div class="list-div">
                                            <h4>${resultItems.termName}</h4>
                                            <div class="btn-div">
                                            <button class="view-btn" title="VIEW RESULT" id="printStudentResultBtn_${classes.classId}_${resultItems.termId}"
                                                onclick="_printAuthStudentTerminalResult('${sessionData?.branchData?.branchId}', '${classes.session}', '${resultItems.termId}', '${classes.departmentId}', '${classes.classId}', '${resultItems.armId}', '${sessionData?.studentData?.studentId}');">
                                                <i class="bi-eye"></i> VIEW RESULT
                                            </button>
                                            </div>
                                        </div>
                                        `,
                                            )
                                            .join("");

                                        return `
                                        <div class="pages-toggle-div">
                                            <div class="pages-toggle-title" onclick="_collapseResult('view${start + index + 1}');" title="EXPAND TO VIEW ${classes.departmentName} (${classes.className}) RESULT">
                                            <h3>${classes.departmentName} (${classes.className}) - ${classes.session}</h3>
                                            <div class="expand-div" id="view${start + index + 1}num">&nbsp;<i class="bi-plus"></i>&nbsp;</div> 
                                            </div>

                                            <div class="toggle-expand-div" id="view${start + index + 1}answer" style="display: none;">  
                                            <div class="list-back-div">
                                                ${resultContent}
                                            </div>
                                            </div>
                                        </div>
                                        `;
                                        })
                                        .join("");

                                    $("#pageContent").html(content);
                                });
                            </script>
                        </div>
                    </div>
                    <p><a href="<?php echo $websiteUrl ?>/parent/verify-result" title="Go Back" title="Go Back"><span><i class="bi-arrow-left"></i> Go Back</span></a></p>
                </div>
            </div>
        </div>
        <div class="graphics-div">
            <div class="content" data-aos="fade-left" data-aos-duration="800">
                <div class="graphics" data-aos="fade-left" data-aos-duration="1200"><img src="<?php echo $websiteUrl ?>/images/check-result.webp" alt="ABCC Result checker" /></div>
                <h2>Your Client's Education<br> <span>is at Your Fingertips!</span></h2>
            </div>
        </div>
    </section>

    <?php include '../bottom-scripts.php' ?>
</body>

</html>