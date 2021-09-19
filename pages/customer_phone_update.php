<?php session_start();

include("../config/db_connection.php");
include("../config/functions.php");

if(empty($_SESSION['user'])){
 header("location:../index.php");
}

$date =  date("d-M-Y");
$user = $_SESSION['user'];
$position = $_SESSION['position'];

$errors = ['new_phone'=>'','old_phone'=>''];
$old_phone=$new_phone="";

$sms='';   

if(isset($_POST["update"])){
    
    $old_phone =   sanitize($_POST["old"]);
    $new_phone =   sanitize($_POST["new"]);



        //old validator
        if(empty($old_phone)){
            $errors['old_phone'] = "old phonenumber can not be empty";
        }else{
            if(!preg_match('/^[\d]{11}$/', $old_phone)){
                $errors['old_phone'] = "provide a valid phonenumber";
            }
            if(!value_taking($old_phone, 'phonenumber', 'customers')){
                $errors['old_phone'] = "provide a valid phonenumber";
            }
        }

          //new validator
        if(empty($new_phone)){
            $errors['new_phone'] = "new phonenumber can not be empty";
        }else{
            if(!preg_match('/^[\d]{11}$/', $new_phone)){
                $errors['new_phone'] = "provide a valid phonenumber";
            }
            if(value_taking($new_phone, 'phonenumber', 'customers')){
                $errors['new_phone'] = "someone already use this phonenumber";
            }
        }




if(!array_filter($errors)){
   

   $sql ="UPDATE customers SET phonenumber='$new_phone' WHERE phonenumber='$old_phone'";
   $sql_query = mysqli_query($conn, $sql);

   if(!$sql_query){
    echo "erro".mysqli_error($conn);
   }else{
    $sms="<h5 class='indigo-text'>phonenumber is updated from $old_phone to $new_phone</h5>";
    $old_phone=$new_phone="";
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
                         id="old" value="<?php echo $old_phone; ?>">
                        <label class="label" for="old">enter old phonenumber</label>
                        <div class="right-align">
                               <p class="left-align red-text"style="margin-bottom: 10px !important; margin-top:0px !important;">
                                <?php  echo $errors['old_phone']; ?>
                            </p>   
                        </div>
                    </div>

                    <div class="input-field" style=" margin-bottom:0px !important;">
                        <input type="text" name="new" class="input"
                         id="new" value="<?php echo $new_phone; ?>">
                        <label class="label" for="new">enter new phonenumber</label>
                        <div class="right-align">
                               <p class="left-align red-text"style="margin-bottom: 10px !important; margin-top:0px !important;">
                                <?php  echo $errors['new_phone']; ?>
                            </p>
                             <button name="update"class="btn indigo darken-4 btn-brand z-depth-0">
                              update 
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
            update customer phonenumber all record associated with it will change as well
        </h6>
    </div>
   <div class="center" style="margin:10px !important;">
           
     <a href="manager_setting.php" class="btn btn-brand indigo darken-4 z-depth-0 action">back</a>
          
    </div>


   
</main>


   
<?php include('../templates/footer.php')?>