<?php
include(__DIR__ ."/../MailSetting.php");
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function




if(isset($_POST['Sendemail'])){
    
    if($sec->checkEmail($_POST['enteredemail'])){
        $em = $sec->secure($_POST['enteredemail']);
        $data = SQLSRV_QUERY($dbcn,"SELECT * FROM SK_USER Where Email = '$em'",array(),array('scrollable' => SQLSRV_CURSOR_KEYSET));
        if(SQLSRV_NUM_ROWS($data) > 0){
            $datafetch = SQLSRV_FETCH_ARRAY($data);
            $name = $datafetch['Name'];
            $us = $datafetch['username'];
            $pw = $datafetch['Realpassword'];
            $confirmcode = md5(uniqid(rand()));
            //Recipients
            
            // Content
            $updatedata = SQLSRV_QUERY($dbcn,"UPDATE SK_USER SET RecoverCode = '$confirmcode', isRecover = 1 Where Email = '$em'");
            if(sqlsrv_rows_affected($updatedata) > 0){
                $gethost = $_SERVER['HTTP_HOST'];
                $recoverurl = "http://$gethost?page=recreatepassword&u=$us&cod=$confirmcode";
                
                $mail->addAddress("$em", "$name");     // Add a recipient
                $mail->Subject = 'Silkroad Online Recover Password';
                $mail->Body    = "<h1>Hello $name.</h1><br><br><br>  
                <span style='font-size:16px; font-style:italic;'>This a message from your favorite game Silkroad Online<br>
                To Recover Your Password, Please Click on Below Link : <br>
                <a href='$recoverurl'>$recoverurl</a><br><br>
                </span>";
                $mail->AltBody = 'Silkroad Online Recover Password';
                try {
                $mail->send();
                moveto('?page=news&success=2');
                } catch (Exception $e) {
                moveto('?page=recoverps&failed=2');
                }
            }
        }else{
            SwalfireApanel2("<span style='color:#fff;'>Sorry, This E-mail not found</span>","#111B2F","black");
        }
    }else{
        SwalfireApanel2("Please, Enter a valid E-mail");
    }
}
if(isset($_GET['failed']) && isset($_SESSION['StatusMSG'])){
    if($_GET['failed'] == 2){
        unset($_SESSION['StatusMSG']);
        SwalfireApanel2("<span style='color:#fff;'>Error, Please Try to contact with the administrator</span>","#111B2F","black");
    }
}

?>


<html>
<head>
</head>
<body>
<span style=' margin-left:5px; color:#fff !important; font-size:40px; '>Password Recovery</span>
<form method='POST'>
<div class='forget-password-div'>
<input  type="Email" class='forget-ps-input' placeholder='Enter Your Email Address' name='enteredemail' autocomplete='OFF'>
<button name='Sendemail' class='btn-site btn-recoverps'>Send an email</button>
</div>
</form>
</body>
</html>