<?php
if ($view_report=='view_today_search'){//////////////////////////
    /// get presentation values
    $date_from= date('F d Y');
    $date_to= date('F d Y');	
    /// get chat values
    $db_date_from= date('Y-m-d');
    $db_date_to= date('Y-m-d');
}elseif ($view_report=='view_thisweek_search'){/////////////////////
    /// get presentation values
    $date_from= date('F d Y', strtotime('sunday - 1 week'));
    $date_to= date('F d Y');	
    /// get chat values
    $db_date_from= date('Y-m-d', strtotime('sunday - 1 week'));
    $db_date_to= date('Y-m-d');
}elseif ($view_report=='view_7days_search'){///////////////////////////////
    /// get presentation values
    $date_from= date('F d Y', strtotime('today - 7 days'));
    $date_to= date('F d Y');	
    /// get chat values
    $db_date_from= date('Y-m-d', strtotime('today - 7 days'));
    $db_date_to= date('Y-m-d');
}elseif ($view_report=='view_thismonth_search'){/////////////////////////////
    /// get presentation values
    $date_from= date('F 01 Y', strtotime('this month'));
    $date_to= date('F d Y');	
    /// get chat values
    $db_date_from= date('Y-m-01', strtotime('this month'));
    $db_date_to= date('Y-m-d');
}elseif (($view_report=='view_30days_search') || ($view_report=='')){/////////////////////////////
    /// get presentation values
    $date_from= date('F d Y', strtotime('today - 30 days'));
    $date_to= date('F d Y');	
    /// get chat values
    $db_date_from= date('Y-m-d', strtotime('today - 30 days'));
    $db_date_to= date('Y-m-d');
}elseif ($view_report=='view_90days_search'){////////////////////////
    /// get presentation values
    $date_from= date('F d Y', strtotime('today - 90 days'));
    $date_to= date('F d Y');	
    /// get chat values
    $db_date_from= date('Y-m-d', strtotime('today - 90 days'));
    $db_date_to= date('Y-m-d');
}elseif ($view_report=='view_thisyear_search'){/////////////////////////////////
    /// get presentation values
    $date_from= date('F d Y', strtotime('first day of january this year'));
    $date_to= date('F d Y');	
    /// get chat values
    $db_date_from= date('Y-m-d', strtotime('first day of january this year'));
    $db_date_to= date('Y-m-d');
}elseif ($view_report=='view_1year_search'){/////////////////////////////
    /// get presentation values
    $date_from= date('F d Y', strtotime('today - 365 days'));
    $date_to= date('F d Y');	
    /// get chat values
    $db_date_from= date('Y-m-d', strtotime('today - 365 days'));
    $db_date_to= date('Y-m-d');
}elseif ($view_report=='custom_search'){/////////////////////////////
    $datefrom=$_POST['datefrom'];
    $dateto=$_POST['dateto'];
    /// get presentation values
    $date_from= date('F d Y', strtotime($datefrom));
    $date_to= date('F d Y', strtotime($dateto));	
    /// get chat values
    $db_date_from= date('Y-m-d', strtotime($datefrom));
    $db_date_to= date('Y-m-d', strtotime($dateto));
}

?>