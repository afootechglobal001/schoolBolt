<?php require_once 'config/connection.php';?>
<?php

 
    ////// print result /////////////////////////////////
    $response = [
        'response'=> 200,
        'success'=> true,
        'userOsBrowser'=> $userOsBrowser,
        'userIpAddress'=> $userIpAddress,
        'userDeviceId'=> $userDeviceId,
        'frontEndApiKey'=> $frontEndApiKey,
        'backEndApiKey'=> $backEndApiKey,
    ]; 


//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>