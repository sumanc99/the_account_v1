<?php session_start();
include("../config/db_connection.php");
include("../config/functions.php");

if(empty($_SESSION['user']) && empty($_SESSION['position'])){
 header("location:../index.php");
}
$user = $_SESSION['user'];
$position = $_SESSION['position'];



$user = $_SESSION['user'];
$date =  date("d-M-Y");
$errors = ['acct'=>'','date_input'=>''];
$acct=$date_input="";

$sms='';   

if(isset($_POST["upgrade"])){
    
    
    $acct =   sanitize($_POST["acct"]);
    $date_input =   sanitize($_POST["date_input"]);

        //acct validator
        if(empty($acct)){
            $errors['acct'] = "account number can not be empty";
        }else{
            if(!preg_match('/^[\d]+$/', $acct)){
                $errors['acct'] = "account number Be  numbers Only";
            }
            if(!value_taking($acct, 'acct_id', 'accounts')){
                $errors['acct'] = "invalid account number";
            }
        }


        //amount validator
        if(empty($date_input)){
            $errors['date_input'] = "date can not be empty";
        }


    if(!array_filter($errors)){

        $sql ="SELECT acct_id FROM accounts WHERE acct_id='$acct' AND cashout_date=''";
        $sql_query = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($sql_query);
        if($num > 0){
            $sql = "UPDATE accounts SET cashout_date='$date_input' WHERE acct_id='$acct'";
            $sql_query = mysqli_query($conn, $sql);

            if(!$sql){
                echo "erro".mysqli_error($conn);
            }else{
                $sms ="<h5 class='indigo-text' style='margin-top:0px;'>Account $acct is upgraded</h5>";
                $acct=$date_input="";
            }
        }else{
            $sms ="<h5 class='red-text' style='margin-top:0px;'>account $acct is already  upgraded</h5>";
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
                        <input type="text" name="acct" class="input"
                         id="acct" value="<?php echo $acct; ?>">
                        <label class="label" for="acct">enter account number</label>
                        <div class="right-align">
                               <p class="left-align red-text"style="margin-bottom: 10px !important; margin-top:0px !important;">
                                <?php  echo $errors['acct']; ?>
                            </p>   
                        </div>
                    </div>

                    <div class="input-field" style=" margin-bottom:0px !important;">
                        <input type="text" name="date_input" class="input datepicker"
                        id="date_input" value="<?php echo $date_input; ?>">
                        <label class="label" for="date_input">enter date</label>
                        <div class="right-align">
                               <p class="left-align red-text"style="margin-bottom: 10px !important; margin-top:0px !important;">
                                <?php  echo $errors['date_input']; ?>
                            </p>
                             <button name="upgrade"class="btn indigo darken-4 btn-brand z-depth-0">
                              upgrade account
                             </button>  
                               
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>



    </div>

 </form>

 
   <div class="center" style="margin:10px !important;">
        <?php if ($position=='manager'): ?>
            <a href="manager.php" class="btn btn-brand indigo darken-4 z-depth-0">back</a>
        <?php endif ?>

         <?php if ($position=='collector'): ?>
            <a href="collector.php" class="btn btn-brand indigo darken-4 z-depth-0">back</a>
        <?php endif ?>
    </div>


   
</main>


   
<?php include('../templates/footer.php')?>               
