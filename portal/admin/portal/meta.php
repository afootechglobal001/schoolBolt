<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="ROBOTS" content="ALL">
<meta name="Engine" content="all">
<meta name="distribution" content="global">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo $websiteUrl?>/images/icon.png" rel="shortcut icon" type="image-png" />
<link href="<?php echo $websiteUrl?>/style/icons-1.11.3/font/bootstrap-icons.css" type="text/css" rel="stylesheet">
<link href="<?php echo $websiteUrl?>/style/animate.css" type="text/css" rel="stylesheet" media="all">
<link href="<?php echo $websiteUrl?>/style/aos.css" type="text/css" rel="stylesheet" />
<link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css"
    rel="stylesheet" />
<link href="<?php echo $websiteUrl?>/style/admin/main-style.css?v=<?php echo $codeVersion?>" type="text/css"
    rel="stylesheet" />
<link href="<?php echo $websiteUrl?>/style/admin/jquery.datetimepicker.css" type="text/css" rel="stylesheet" />

<script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
<script src="<?php echo $websiteUrl?>/js/paramount.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/scripts.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/textfield-selectfield.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/webcam_library.js"></script>
<script>
let staffLoginData = JSON.parse(sessionStorage.getItem("staffLoginData"));
let userRoles = JSON.parse(sessionStorage.getItem("userRoles"));
const loginStaffId = staffLoginData.staffId;
const loginAccessKey = staffLoginData.accessKey;
const loginRoleId = staffLoginData.roleId;
const rolePermissionIds = staffLoginData.rolePermissionIds;
</script>

<script src="<?php echo $websiteUrl?>/js/admin/jquery.datetimepicker.js"></script>
<script src="<?php echo $websiteUrl?>/js/admin/chart.min.js"></script>
<script src="<?php echo $websiteUrl?>/js/admin/canvasjs.min.js" type="text/javascript"></script>

<script src="<?php echo $websiteUrl?>/js/admin/session_validation.js?v=<?php echo $codeVersion?>"></script>

<script src="<?php echo $websiteUrl?>/js/admin/useAdmin.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/admin/useBranch.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/admin/useStaff.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/admin/useRole.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/admin/useDepartment.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/admin/useClass.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/admin/useArm.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/admin/useSubject.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/admin/useChangePassword.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/branch/useStaff.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/branch/student/useStudent.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/branch/class/useClass.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/branch/department/useDepartment.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/branch/subject/useSubject.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/branch/report/useReport.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/reports/print-student-by-class.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/branch/fees/useFees.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/branch/assessment/useAssessment.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/reports/print-compute-fee-by-class.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/reports/print-score-sheet.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/reports/print-assessment-per-subject.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/reports/print-ca-broad-sheet.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/reports/print-terminal-broad-sheet.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/reports/print-ca-result-summary.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/reports/print-each-student-ca-result.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/reports/print-all-student-ca-result.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/reports/print-terminal-result-summary.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/reports/print-each-student-terminal-result.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/reports/print-fees-settings.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/branch/account/useAccount.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/account-report/useAccountReport.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/branch/settings/teachers-comment/useTeacherComment.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/reports/print-staff-by-class.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/reports/print-staff-by-subject.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/reports/print-all-student-terminal-result.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/reports/print-contemporary-markbook-per-subject.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/reports/print-all-student-progressive-result.js?v=<?php echo $codeVersion?>"></script>