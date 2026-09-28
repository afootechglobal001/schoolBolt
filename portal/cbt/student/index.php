<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include '../config/constants.php';?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'meta.php'?>
<title>Portal Management | <?php echo $appName;?></title>
</head>
<body>
    <?php include 'header.php'?>

    <main id="page-content">
        <script>
            $(document).ready(function () {
                let savedPage = sessionStorage.getItem("currentDashboardPage") ?? "dashboard";

                _getActivePage({
                    page: savedPage, 
                    divid: savedPage
                });

                let savedForm = sessionStorage.getItem("currentDashboardForm") ?? '';
                if (savedForm) {
                    _getForm(JSON.parse(savedForm));
                }
            });
        </script>
    </main>
    <?php include 'bottom-scripts.php'?>
</body>
</html>


