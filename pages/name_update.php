<?php session_start();

include("../config/db_connection.php");
include("../config/functions.php");

if(empty($_SESSION['user'])){
 header("location:../index.php");
}

$date =  date("d-M-Y");
$user = $_SESSION['user'];
$position = $_SESSION['position'];

$errors = ['option'=>'','new_name'=>'','email'=>''];
$email=$new_name="";

$sms='';   

if(isset($_POST["update"])){
    $option = sanitize($_POST['option']);
    $email =   sanitize($_POST["email"]);
    $new_name =   sanitize($_POST["new"]);

        //option validator
        if($option=="select"){
             $errors['option'] = "name part can not be empty";
        }

        //email validator
        if(empty($email)){
            $errors['email'] = "email can not be empty";
        }else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = "provide a valid email address";
            }
            elseif(!value_taking($email,'email','staffs')){
                $errors['email'] = "invalid email address";
            }
            
        }

          //new validator
        if(empty($new_name)){
            $errors['new_name'] = "new name can not be empty";
        }else{
            if(!preg_match('/^[a-zA-Z]+$/', $new_name)){
                $errors['new_name'] = "invalid new name";
            }
           
        }




    if(!array_filter($errors)){
        
        $sql = "UPDATE staffs SET $option='$new_name' WHERE email='$email'";
        $sql_query = mysqli_query($conn, $sql);

        if(!$sql){
            echo "erro".mysqli_error($conn);
        }else{
             $sms ="<h5 class='indigo-text' style='margin-top:0px;'>$option is updated to $new_name</h5>";
             $email=$new_name="";
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
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
    <div class="row">
         <div class="col l6 s12 m5 offset-m1 offset-l3">
            <div class="card">
                <div class="card-content">
                    <div class="center"><?php echo $sms; ?></div>
                    <div class="input-field" style=" margin-bottom:0px !important;">
                    <select name="option">
                        <option value="select">--select name part--</option>
                         <option value="firstname">firstname</option>
                         <option value="lastname">lastname</option>
                    </select>
                  <div class="right-align">
                           <p class="left-align red-text"style="margin-bottom: 10px !important; margin-top:0px !important;">
                            <?php  echo $errors['option']; ?>
                        </p>   
                    </div>
                </div>
                    <div class="input-field" style=" margin-bottom:0px !important;">
                        <input type="text" name="email" class="input"
                         id="email" value="<?php echo $email; ?>">
                        <label class="label" for="email">enter email</label>
                        <div class="right-align">
                               <p class="left-align red-text"style="margin-bottom: 10px !important; margin-top:0px !important;">
                                <?php  echo $errors['email']; ?>
                            </p>   
                        </div>
                    </div>

                    <div class="input-field" style=" margin-bottom:0px !important;">
                        <input type="text" name="new" class="input"
                         id="new" value="<?php echo $new_name; ?>">
                        <label class="label" for="new">enter new name</label>
                        <div class="right-align">
                               <p class="left-align red-text"style="margin-bottom: 10px !important; margin-top:0px !important;">
                                <?php  echo $errors['new_name']; ?>
                            </p>
                             <button name="update"class="btn indigo darken-4 btn-brand z-depth-0">
                              update name
                             </button>   
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>



    </div>

   

 </form>

  <div class="center red-text">
        <h6 style="font-weight: 500;">
          <i class="bi bi-exclamation-circle"></i>
            word of warning <?php echo $user ?> if you 
            update your name all record associated with it will change as well
        </h6>
    </div>

   <div class="center" style="margin:10px !important;">

            <?php if ($position=='ceo'): ?>
                <a href="ceo_settings.php" class="btn btn-brand indigo darken-4 z-depth-0">back</a>
            <?php endif ?>
            <?php if ($position=='manager'): ?>
                <a href="manager_setting.php" class="btn btn-brand indigo darken-4 z-depth-0">back</a>
            <?php endif ?>

             <?php if ($position=='collector'): ?>
                <a href="collector_settings.php" class="btn btn-brand indigo darken-4 z-depth-0">back</a>
            <?php endif ?>



        
    </div>


   
</main>


   
<?php include('../templates/footer.php')?>