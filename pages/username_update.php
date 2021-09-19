<?php session_start();

include("../config/db_connection.php");
include("../config/functions.php");

if(empty($_SESSION['user'])){
 header("location:../index.php");
}

$date =  date("d-M-Y");
$user = $_SESSION['user'];
$position = $_SESSION['position'];

$errors = ['new_username'=>'','old_username'=>''];
$old_username=$new_username="";

$sms='';   

if(isset($_POST["update"])){
    
    $old_username =   sanitize($_POST["old"]);
    $new_username =   sanitize($_POST["new"]);



        //old validator
        if(empty($old_username)){
            $errors['old_username'] = "old username can not be empty";
        }else{
            if(!preg_match('/^[\w]+$/', $old_username)){
                $errors['old_username'] = "invalid old username";
            }
            if(!value_taking($old_username, 'username', 'users')){
                $errors['old_username'] = "invalid old username";
            }
        }

          //new validator
        if(empty($new_username)){
            $errors['new_username'] = "new username can not be empty";
        }else{
            if(!preg_match('/^[\w]+$/', $new_username)){
                $errors['new_username'] = "invalid new username";
            }
            if(value_taking($new_username, 'username', 'users')){
                $errors['new_username'] = "username already been taking";
            }
        }




if(!array_filter($errors)){
    $tables = ['users','accounts','transactions'];

    foreach ($tables as $table) {

        if($table =='users'){
            $column = 'username';
        }

        if($table =='accounts'){
             $column = 'created_by';
        }

        if($table =='transactions'){
             $column = 'collector';
        }
        $sql = "UPDATE $table SET $column='$new_username' WHERE $column='$old_username'";
        $sql_query = mysqli_query($conn, $sql);

        if(!$sql){
            echo "erro".mysqli_error($conn);
        }else{
             $sms ="<h5 class='indigo-text' style='margin-top:0px;'>username is updated from $old_username to 
             $new_username</h5>";
            
        }
    }
    $old_username=$new_username="";
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
                        <input type="text" name="old" class="input"
                         id="old" value="<?php echo $old_username; ?>">
                        <label class="label" for="old">enter old username</label>
                        <div class="right-align">
                               <p class="left-align red-text"style="margin-bottom: 10px !important; margin-top:0px !important;">
                                <?php  echo $errors['old_username']; ?>
                            </p>   
                        </div>
                    </div>

                    <div class="input-field" style=" margin-bottom:0px !important;">
                        <input type="text" name="new" class="input"
                         id="new" value="<?php echo $new_username; ?>">
                        <label class="label" for="new">enter new username</label>
                        <div class="right-align">
                               <p class="left-align red-text"style="margin-bottom: 10px !important; margin-top:0px !important;">
                                <?php  echo $errors['new_username']; ?>
                            </p>
                             <button name="update"class="btn indigo darken-4 btn-brand z-depth-0">
                              update username
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
            update your username all record associated with it will change as well
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