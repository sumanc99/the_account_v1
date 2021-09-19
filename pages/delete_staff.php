<?php session_start();

if(empty($_SESSION['user'])){
 header("location:../index.php");
}

$user = $_SESSION['user'];
$position = $_SESSION['position'];

include("../config/db_connection.php");
include("../config/functions.php");

$errors = ['phone'=>''];
$phone="";

$sms='';   

if(isset($_POST["delete"])){
    
    $phone =   sanitize($_POST["phone"]);



        //phone validator
        if(empty($phone)){
            $errors['phone'] = "phonenumber can not be empty";
        }else{
            if(!preg_match('/^[\d]{11}$/', $phone)){
                $errors['phone'] = "phonenumber Must Be numbers Only";
            }
            if(!value_taking($phone, 'phonenumber', 'users')){
                $errors['phone'] = "invalid phonenumber";
            }
        }


    if(!array_filter($errors)){
        $sql="DELETE FROM staffs  WHERE phonenumber='$phone'";
        $sql_query = mysqli_query($conn, $sql);

        if(!$sql_query){
            echo"error".mysqli_error($conn);
        }else{
            $sql="DELETE FROM users  WHERE phonenumber='$phone'";
            $sql_query = mysqli_query($conn, $sql);
            if(!$sql_query){
                echo"error".mysqli_error($conn);
            }else{
                $sms='staff is deleted successfully';
                $phone='';
            }
           
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

    <div class="center"><h5 class="indigo-text text-darken-3"><?php  echo $sms ?></h5></div>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
    <div class="row">
         <div class="col l6 s12 m5 offset-m1 offset-l3">
            <div class="card">
                <div class="card-content">
                    <div class="input-field" style=" margin-bottom:0px !important;">
                        <input type="text" name="phone" class="input"
                         id="phone" value="<?php echo $phone; ?>">
                        <label class="label" for="phone">enter staff phonenumber</label>
                        <div class="right-align">
                               <p class="center red-text"style="margin-bottom: 10px !important; margin-top:0px !important;">
                                <?php  echo $errors['phone']; ?>
                            </p>
                             <button name="delete"class="btn red darken-3 btn-brand-danger z-depth-0">
                                delete staff
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
        <a href="ceo.php" class="btn btn-brand indigo darken-4 z-depth-0 action">back</a>
    <?php endif ?>
    <?php if ($position=='manager'): ?>
     <a href="manager.php" class="btn btn-brand indigo darken-4 z-depth-0 action">back</a>
    <?php endif ?>
    
    </div>

   
</main>


   
<?php include('../templates/footer.php')?>