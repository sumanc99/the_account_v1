
<?php
include("../config/db_connection.php");
include("../config/functions.php");

$brand_name=$motor=$address=$date='';

$prob='';   

// error displayers && holders
$errors = ['brand_name'=>'', 'motor'=>'','address'=>'','date'=>''];

if(isset($_POST["reg_brand"])){
    
    $brand_name =   sanitize($_POST["brand_name"]);
    $motor = sanitize($_POST["motor"]);
    $address =   sanitize($_POST["address"]);
    $date =  sanitize($_POST["date"]);

    
    
    
        //brandname validator
        if(empty($brand_name)){
            $errors['brand_name'] = "BrandName can not be empty";
        }else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $brand_name)){
                $errors['brand_name'] = "BrandName Must Be Letters Only";
            }
        }


        //motor validator
        if(empty($motor)){
            $errors['motor'] = "motor can not be empty";
        }else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $motor)){
                $errors['motor'] = "motor Must Be Letters Only";
            }
        }


          //address validator
        if(empty($address)){
            $errors['address'] = "address can not be empty";
        }else{
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $address)){
                $errors['address'] = "address Must Be Letters Only";
            }
        }


         //date validator
        if(empty($date)){
            $errors['date'] = "date can not be empty";
        }else{
            // if(!preg_match('/^([a-zA-Z\s])+$/', $address)){
            //     $errors['address'] = "address Must Be Letters Only";
            // }
        }



    if(!array_filter($errors)){

        $sql = "INSERT INTO brand_details(brand_name, motor, address, date_create) 
        VALUES('$brand_name','$motor','$address','$date')";
        $sql_query = mysqli_query($conn, $sql);

        // if($sql_query){
           
        // }

    }

}
?>

<?php include('..\templates\header.php');?>



<main class="container  box">


     <div class="container" style="padding:20px;">

    <?php if (brand_empty()): ?>

     <h6 class="red-text center" style="font-size:18px; margin-bottom:0px !important;">
      <?php echo $prob; ?>
      </h6>
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
        <div class="row">
            <div class="col s12 l8 push-l2">
                <div class="input-field" style=" margin-bottom:0px !important;">
                    <input type="text" name="brand_name" class="input"
                     id="brand_name" value="<?php echo $brand_name; ?>">
                    <label class="label" for="brand_name">BrandName</label>
                </div>
                <p class="red-text"style="height: 0px; margin-top:0px !important;">
                    <?php  echo $errors['brand_name']; ?>
                </p>

                 <div class="input-field" style=" margin-bottom:0px !important;">
                    <input type="text" name="motor" class="input" id="motor" value="<?php echo $motor; ?>">
                    <label class="label" for="motor">Motor</label>
                </div>
                <p class="red-text"style="height: 0px; margin-top:0px !important;">
                     <?php  echo $errors['motor']; ?>
                </p>

                <div class="input-field" style=" margin-bottom:0px !important;">
                    <textarea name="address" class="input materialize-textarea" id="address" ></textarea>
                    <label class="label" for="address">Address</label>
                </div>
                <p class="red-text"style="height: 0px; margin-top:0px !important;">
                     <?php  echo $errors['address']; ?>
                </p>

                 <div class="input-field" style=" margin-bottom:0px !important;">
                    <input type="text" name="date" class="input datepicker"
                     id="date" value="<?php echo $date; ?>">
                    <label class="label" for="date">Date</label>
                </div>
                <p class="red-text"style="height: 0px; margin-top:0px !important; margin-bottom:30px;">
                     <?php  echo $errors['date']; ?>
                </p>

                <div class="right">
                    <button name="reg_brand"class="btn btn-brand indigo darken-4 z-depth-0">
                    apply brand information
                    </button>
                </div>
                <div class="left">
                    <a href="ceo.php" class="btn btn-brand indigo darken-4 z-depth-0">back</a>
                </div>
            </div>
        </div>
      </form> 

    <?php else: ?>
        <div class="center">
           <a href="ceo_reg.php" class="btn btn-large btn-brand indigo darken-4 z-depth-0">
           Create Account
           </a> 
           <a href="ceo.php" class="btn btn-large btn-brand indigo darken-4 z-depth-0">
           back
           </a>  
        </div>
    <?php endif ?>  
     </div>


</main>


<?php include('..\templates\footer.php');?>