<?php session_start();

include("../config/db_connection.php");
include("../config/functions.php");

if(empty($_SESSION['user'])){
 header("location:../index.php");
}

$date =  date("d-M-Y");
$user = $_SESSION['user'];
$position = $_SESSION['position'];

$errors = ['option'=>'','new_name'=>''];
$email=$new_name="";

$sms='';   

if(isset($_POST["update"])){
    $option = sanitize($_POST['option']);
    $new_name =   sanitize($_POST["new"]);

        //option validator
        if($option=="select"){
             $errors['option'] = "name part can not be empty";
        }

      

          //new validator
        if(empty($new_name)){
            $errors['new_name'] = "new name can not be empty";
        }else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $new_name)){
                $errors['new_name'] = "invalid new name";
            }
           
        }




    if(!array_filter($errors)){
        
        $sql = "UPDATE brand_details SET $option='$new_name'";
        $sql_query = mysqli_query($conn, $sql);

        if(!$sql){
            echo "erro".mysqli_error($conn);
        }else{
             $sms ="<h5 class='indigo-text' style='margin-top:0px;'>$option is updated to $new_name</h5>";
             $new_name="";
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
<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>"> 
    <div class="row">
         <div class="col l6 s12 m5 offset-m1 offset-l3">
            <div class="card">
                <div class="card-content">
                    <div class="input-field" style=" margin-bottom:0px !important;">
                    <select name="option">
                        <option value="select">--select brandname part--</option>
                         <option value="brand_name">brandname</option>
                         <option value="motor">motor</option>
                         <option value="address">address</option>
                    </select>
                  <div class="right-align">
                           <p class="left-align red-text"style="margin-bottom: 10px !important; margin-top:0px !important;">
                            <?php  echo $errors['option']; ?>
                        </p>   
                    </div>
                </div>
                   

                    <div class="input-field" style=" margin-bottom:0px !important;">
                        <input type="text" name="new" class="input"
                         id="new" value="<?php echo $new_name; ?>">
                        <label class="label" for="new">enter new value</label>
                        <div class="right-align">
                               <p class="left-align red-text"style="margin-bottom: 10px !important; margin-top:0px !important;">
                                <?php  echo $errors['new_name']; ?>
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


<div class="center" style="margin:10px !important;">

  <a href="ceo_settings.php" class="btn btn-brand indigo darken-4 z-depth-0">back</a>

</div>


   
</main>


   
<?php include('../templates/footer.php')?>