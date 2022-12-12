<head>
<script src="../../js/functions.js"></script>
</head>
 
<?php
 //username
 if (isset($_GET['u']) && isset($_GET['cod'])) {
  if(!empty($_GET['u']));
  $user = $_GET['u'];
  if(!empty($_GET['cod']));
  $cod = $_GET['cod'];
 }
 $action = "?page=recreatepassword&u='$user'&cod='$cod'";
  $GetRecoveryStat = SQLSRV_QUERY($dbcn,"SELECT * FROM SK_USER Where isRecover = 1 and username = '$user' and RecoverCode = '$cod'",array(),array('scrollable' => SQLSRV_CURSOR_KEYSET));
  if(SQLSRV_NUM_ROWS($GetRecoveryStat) > 0 && !isset($_SESSION['loggedin'])){

    echo'
    <span style=" margin-left:5px; color:#fff !important; font-size:40px; ">Re-Create Password</span>;
    <div  class="changepsform"><form  class="changepsform" method="post">
   <span>New Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
   <input type="password" id="text2" name="changepstext2"><br>
   <span>Repeat Password &nbsp;&nbsp;&nbsp;</span>
   <input type="password" id="text3" name="changepstext3"><br>
   <button class="btn-site myaccount-btn" name="Changepasswordbtn">Change Password</button>
       </form> </div>
    ';

    if(isset($_POST['Changepasswordbtn'])){
      $new1ps= $sec->secure($_POST['changepstext2']);
      $rps= $sec->secure($_POST['changepstext3']);
      $newps = md5($new1ps);
      $repeatps = md5($rps);
      $error1 = null;
      $error2 = null;
      if(empty($new1ps)){
        $error1 = "Please, Enter the password";
      }elseif(!Checkpassword($new1ps)){
          $error1 = "the password between 8 ~ 32 letters and nummbers only";
      }
      if(empty($rps)){
          $error2 = "Please, Enter the password";
      }elseif(!Checkpassword($rps)){
          $error2 = "the password between 8 ~ 32 letters and nummbers only";
      }
      
  
      if( $error1 == null && $error2 == null){

            if($newps === $repeatps){
              $updatepassword = SQLSRV_QUERY($dbcn,"UPDATE SK_USER SET [Password] = '".$newps."', Realpassword = '$new1ps', RecoverCode = '0', isRecover = 0 Where Username = '$user'");
              if(sqlsrv_rows_affected($updatepassword) > 0){
              echo '<script>alert("the Password has been changed");window.location.href="?page=login";</script>';
              }
            }else{
              echo '<script>alert("The repeated password not the same such as the new password or your current password equal to the new password.");</script>';
             }
      }else{
        if(empty($new1ps)){
          ?><script> 
              changepsjs("text2", "Please, Enter the password");
          </script> <?php
        } elseif(!Checkpassword($new1ps)){
            ?><script> 
                changepsjs("text2", "The password between 8 ~ 32 letters and numbers only");
            </script> <?php
        }elseif(empty($rps)){
            ?><script> 
                changepsjs("text3", "Please, Enter the password");
            </script> <?php
        }elseif(!Checkpassword($rps)){
            ?><script> 
                changepsjs("text3", "The password between 8 ~ 32 letters and numbers only");
            </script> <?php
        }
    }
  }
}else{
    SwalfireApanel2("<span style='color:#fff;'>Sorry, Page Not Found</span>","#111B2F","black");
  }



?>