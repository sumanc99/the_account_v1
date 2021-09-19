<?php session_start();

include("../config/db_connection.php");
include("../config/functions.php");

if(empty($_SESSION['user'])){
 header("location:../index.php");
}

$date =  date("d-M-Y");
$user = $_SESSION['user'];
$position = $_SESSION['position'];

$errors = ['username'=>'','new_pass'=>'','com_pass'=>''];
$username=$new_pass=$com_pass="";

$sms='';   

if(isset($_POST["update"])){
    
    $username =   sanitize($_POST["username"]);
    $new_pass =   sanitize($_POST["new_pass"]);
    $com_pass =   sanitize($_POST["com_pass"]);



        //username validator
        if(empty($username)){
            $errors['username'] = "username can not be empty";
        }else{
            if(!preg_match('/^[\w]+$/', $username)){
                $errors['username'] = "provide a valid username";
            }
            if(!value_taking($username, 'username', 'users')){
                $errors['new_pass'] = "provide a valid username";
            }
        }

        //new password validator
        if(empty($new_pass)){
            $errors['new_pass'] = "new password can not be empty";
        }else{
            if(!preg_match('/^[\d]{4}$/', $new_pass)){
                $errors['new_pass'] = "provide a valid password";
            }
        }

        //confirm password validator
        if(empty($com_pass)){
            $errors['com_pass'] = "confirm password can not be empty";
        }else{
            if(!preg_match('/^[\d]{4}$/', $com_pass)){
                $errors['com_pass'] = "provide a valid password";
            }

            if($com_pass != $new_pass){
                $errors['com_pass'] = "confirm password must be equal to new password";
            }
        }




if(!array_filter($errors)){
   

   $sql ="UPDATE users SET password='$new_pass' WHERE username='$username'";
   $sql_query = mysqli_query($conn, $sql);

   if(!$sql_query){
    echo "erro".mysqli_error($conn);
   }else{

    $sms="<h5 class='indigo-text text-darken-3'>password is updated to $new_pass</h5>";
    $username=$new_pass=$com_pass="";
   }
    

}

}

?>
<?php include('..\templates\header.php');?>
   <div class="right text-muted" style="margin:20px; font-weight: bold;">
        <span><?php echo "today is: ".$day." ".$date;  ?></span>
    </div>
<main class="container box" style="margin-top:20px !important;">
 
   <div class="center" style="margin:10px !important;">
         <h4 class="text-muted">hello <?php echo $user; ?></h4>
    </div>
    <div class="center"><?php echo $sms; ?></div>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
    <div class="row">
         <div class="col l6 s12 m5 offset-m1 offset-l3">
            <div class="card">
                <div class="card-content">
                    <div class="input-field" style=" margin-bottom:0px !important;">
                        <input type="text" name="username" class="input"
                         id="username" value="<?php echo $username; ?>">
                        <label class="label" for="username">enter username</label>
                        <div class="right-align">
                               <p class="left-align red-text"style="line-height: 5px !important; margin-top:0px !important;">
                                <?php  echo $errors['username']; ?>
                            </p>   
                        </div>
                    </div>

                    <div class="input-field" style=" margin-bottom:0px !important;">
                        <input type="text" name="new_pass" class="input"
                         id="new" value="<?php echo $new_pass; ?>">
                        <label class="label" for="new">enter new password</label>
                        <div class="right-align">
                               <p class="left-align red-text"style="line-height: 5px !important; margin-top:0px !important;">
                                <?php  echo $errors['new_pass']; ?>
                            </p>
                            
                        </div>
                    </div>

                     <div class="input-field" style=" margin-bottom:0px !important;">
                        <input type="text" name="com_pass" class="input"
                         id="com" value="<?php echo $com_pass; ?>">
                        <label class="label" for="com">enter confirm password</label>
                        <div class="right-align">
                               <p class="left-align red-text"style="line-height: 5px !important;margin-bottom: 10px !important; margin-top:0px !important;">
                                <?php  echo $errors['com_pass']; ?>
                            </p>
                             <button name="update"class="btn indigo darken-4 btn-brand z-depth-0">
                              update password
                             </button>   
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>



    </div>

   

 </form>


   <div class="center" style="margin:10px !important;">

   
        <?php if ($position=='ceo'): ?>
            <a href="ceo_settings.php" class="btn btn-brand indigo darken-4 z-depth-0">back</a>
        <?php endif ?>

         <?php if ($position=='manager'): ?>
             <a href="manager_setting.php" class="btn btn-brand indigo darken-4 z-depth-0 action">back</a>
        <?php endif ?>
          
    </div>


   
</main>


   
<?php include('../templates/footer.php')?>