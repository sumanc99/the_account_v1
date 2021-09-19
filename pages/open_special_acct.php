<?php session_start();
include("../config/db_connection.php");
include("../config/functions.php");
$user = $_SESSION['user'];
$position = $_SESSION['position'];

$acct_types = acct_types();
$acct_plans = acct_plans();

// error displayers && holders
$errors = ['fname'=>'', 'lname'=>'', 'phone'=>'','acct_type'=>'','acct_plan'=>'','date'=>''];
$fname=$lname=$phone=$date_plan='';

$prob='';   

if(isset($_POST["proceed"])){
    
    $_SESSION['fname'] =   sanitize($_POST["fname"]);
    $_SESSION['lname'] = sanitize($_POST["lname"]);
    $_SESSION['phone'] = sanitize($_POST["phone"]);
    $_SESSION['acct_type'] = $_POST["acct_type"];
    $_SESSION['date'] = $_POST["date"];

    $fname =   $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $phone = $_SESSION['phone'];
    $acct_type = $_SESSION['acct_type'];
    $date_plan = $_SESSION['date'];
    
    
    
        //fname validator
        if(empty($fname)){
            $errors['fname'] = "firstname can not be empty";
        }else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $fname)){
                $errors['fname'] = "fistname Must Be Letters Only";
            }
        }


        //lname validator
        if(empty($lname)){
            $errors['lname'] = "lastname can not be empty";
        }else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $lname)){
                $errors['motor'] = "lastname Must Be Letters Only";
            }
        }

          //phonenumber validator
        if(empty($phone)){
            $errors['phone'] = "phonenumber can not be empty";
        }else{
            if(!preg_match('/^[\d]{11}$/', $phone)){
                $errors['phone'] = "phonenumber Must be 11-digit long Only";
            }
            elseif(value_taking($phone,'phonenumber','customers')){
                $errors['phone'] = "phonenumber is already in use";
            }
           
        }

          //acct_type validation
        if($acct_type=='select'){
            $errors['acct_type'] = "account type can not be empty";
        }

            //acct_type validation
        if(empty($date_plan)){
            $errors['date'] = "date can not be empty";
        }

      
      

    if(!array_filter($errors)){

        $sql ="INSERT INTO customers(phonenumber,firstname,lastname) VALUES('$phone','$fname','$lname')";
        $sql_query = mysqli_query($conn, $sql);

        if(!$sql_query){
             $prob ="Error registering customer";      
        }else{
            header("location:open_special_acct_svn_acct_id.php");
        }
    }

}


?>
<?php include('..\templates\header.php');?>
<div class="right text-muted" style="margin:20px; font-weight: bold;">
        <span><?php echo "today is: ".$day." ".$date;  ?></span>
</div>
<main class="container box" style="margin-top:20px !important;">

   <div class="container" style="padding:px;">

      <div class="">
            <?php if ($position=='manager'): ?>
                <a href="manager.php" class="btn btn-brand indigo darken-4 z-depth-0">back</a>
            <?php endif ?>

             <?php if ($position=='collector'): ?>
                <a href="collector.php" class="btn btn-brand indigo darken-4 z-depth-0">back</a>
            <?php endif ?>
        </div>

      <h6 class="red-text center" style="font-size:18px; margin-bottom:0px !important;">
      <?php echo $prob; ?>
      </h6>
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
         

        <div class="row">
            <div class="col s12 l8 push-l2">
                <div class="input-field" style=" margin-bottom:0px !important;">
                    <input type="text" name="fname" class="input"
                     id="fname" value="<?php echo $fname; ?>">
                    <label class="label" for="fname">firstname</label>
                </div>
                <p class="red-text"style="height: 0px; margin-top:0px !important;">
                    <?php  echo $errors['fname']; ?>
                </p>

                 <div class="input-field" style=" margin-bottom:0px !important;">
                    <input type="text" name="lname" class="input"
                     id="lname" value="<?php echo $lname; ?>">
                    <label class="label" for="lname">Lastname</label>
                </div>
                <p class="red-text"style="height: 0px; margin-top:0px !important;">
                    <?php  echo $errors['lname']; ?>
                </p>

                 <div class="input-field" style=" margin-bottom:0px !important;">
                    <input type="text" name="phone" class="input"
                     id="phone" value="<?php echo $phone; ?>">
                    <label class="label" for="phone">phonenumber</label>
                </div>
                <p class="red-text"style="height: 0px; margin-top:0px !important;">
                    <?php  echo $errors['phone']; ?>
                </p>

                <div class="input-field" style=" margin-bottom:0px !important;">
                    <select name="acct_type">
                        <option value="select">--select account type--</option>
                        <?php foreach ($acct_types as $acct_type): ?>
                    <option value="<?php echo $acct_type['acct_type']; ?>"><?php echo $acct_type['acct_type']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <p class="red-text"style="height: 0px; margin-top:0px !important;">
                    <?php  echo $errors['acct_type']; ?>
                </p>
                 <div class="input-field" style=" margin-bottom:0px !important;">
                    <input type="text" name="date" class="input datepicker"
                     id="date" value="<?php echo $date_plan; ?>">
                    <label class="label" for="date">Date</label>
                </div>
                <p class="red-text"style="height: 10px; margin-top:0px !important; margin-bottom:30px;">
                     <?php  echo $errors['date']; ?>
                </p>
                <div class="right">
                    <button name="proceed"class="btn btn-brand indigo darken-4 z-depth-0">
                     Proceed
                    </button>
                </div>
           
            </div>
        </div>
      </form> 
 
     </div>





</main>


   
<?php include('../templates/footer.php')?>