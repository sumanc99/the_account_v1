<?php session_start();

include("../config/db_connection.php");
include("../config/functions.php");

if(empty($_SESSION['user'])){
 header("location:../index.php");
}

$date =  date("d-M-Y");
$user = $_SESSION['user'];
$position = $_SESSION['position'];

$errors = ['new_email'=>'','old_email'=>''];
$old_email=$new_email="";

$sms='';   

if(isset($_POST["update"])){
    
    $old_email =   sanitize($_POST["old"]);
    $new_email =   sanitize($_POST["new"]);



        //old validator
        if(empty($old_email)){
            $errors['old_email'] = "old email address can not be empty";
        }else{
            if(!filter_var($old_email, FILTER_VALIDATE_EMAIL)){
                $errors['old_email'] = "provide a valid email address";
            }
            if(!value_taking($old_email, 'email', 'staffs')){
                $errors['old_email'] = "provide a valid email address";
            }
        }

          //new validator
        if(empty($new_email)){
            $errors['new_email'] = "new email address can not be empty";
        }else{
            if(!filter_var($new_email, FILTER_VALIDATE_EMAIL)){
                $errors['new_email'] = "provide a valid email address";
            }
            if(value_taking($new_email, 'email', 'staffs')){
                $errors['new_email'] = "someone already use this email address";
            }
        }




if(!array_filter($errors)){
   

   $sql ="UPDATE staffs SET email='$new_email' WHERE email='$old_email'";
   $sql_query = mysqli_query($conn, $sql);

   if(!$sql_query){
    echo "erro".mysqli_error($conn);
   }else{

    $sms="<h5 class='indigo-text'>email address is updated from $old_email to $new_email</h5>";
    $old_email=$new_email="";
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
                        <input type="text" name="old" class="input"
                         id="old" value="<?php echo $old_email; ?>">
                        <label class="label" for="old">enter old email address</label>
                        <div class="right-align">
                               <p class="left-align red-text"style="margin-bottom: 10px !important; margin-top:0px !important;">
                                <?php  echo $errors['old_email']; ?>
                            </p>   
                        </div>
                    </div>

                    <div class="input-field" style=" margin-bottom:0px !important;">
                        <input type="text" name="new" class="input"
                         id="new" value="<?php echo $new_email; ?>">
                        <label class="label" for="new">enter new email address</label>
                        <div class="right-align">
                               <p class="left-align red-text"style="margin-bottom: 10px !important; margin-top:0px !important;">
                                <?php  echo $errors['new_email']; ?>
                            </p>
                             <button name="update"class="btn indigo darken-4 btn-brand z-depth-0">
                              update email
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