
<?php
include("../config/db_connection.php");
include("../config/functions.php");

$fname=$lname=$phone=$email=$address=$user='';

$prob='';   

$created_already = "<span class='grey-text'>Sorry you already create an Account<span>";

// error displayers && holders
$errors = ['fname'=>'', 'lname'=>'', 'phone'=>'', 'email'=>'', 'address'=>'','username'=>'','pass'=>''];

if(isset($_POST["reg_ceo"])){
    
    $fname =   sanitize($_POST["fname"]);
    $lname = sanitize($_POST["lname"]);
    $phone = sanitize($_POST["phone"]);
    $email = sanitize($_POST["email"]);
    $address =   sanitize($_POST["address"]);
    $user =   sanitize($_POST["username"]);
    $pass =  sanitize($_POST["pass"]);

    
    
    
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
        }

        //email validator
        if(empty($email)){
            $errors['email'] = "address can not be empty";
        }else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = "provide a valid email";
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

        //username validator
        if(empty($user)){
            $errors['username'] = "username can not be empty";
        }else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $user)){
                $errors['username'] = "username";
            }
        }

        //password validation
        if(empty($pass)){
            $errors['pass'] = "password can not be empty";
        }else{
            if(!preg_match('/^[\d]+$/', $pass)){
                $errors['pass'] = "password must be numbers only";
            }
        }

      

    if(!array_filter($errors)){


        $sql = "INSERT INTO staffs(phonenumber,firstname, lastname,email, address, position)
        VALUES('$phone','$fname','$lname','$email','$address','ceo')";
        $sql_query = mysqli_query($conn, $sql);

        if($sql_query){
             $sql = "INSERT INTO users(phonenumber,username,password,status)
        VALUES('$phone','$user','$pass','active')";
        $sql_query = mysqli_query($conn, $sql);
            if($sql_query){
                $created = "<span class='green-text'>account is created</span>";
                $created_already = null;
            }
        }else{
          echo "erro:".mysqli_error($conn);  
        }

    }

}
?>

<?php include('..\templates\header.php');?>



<main class="container ">


     <div class="container" style="padding:px;">
<?php if (ceo_empty()): ?>

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
                    <input type="text" name="email" class="input"
                     id="email" value="<?php echo $email; ?>">
                    <label class="label" for="email">email</label>
                </div>
                <p class="red-text"style="height: 0px; margin-top:0px !important;">
                    <?php  echo $errors['email']; ?>
                </p>

                <div class="input-field" style=" margin-bottom:0px !important;">
                    <textarea name="address" class="input materialize-textarea" id="address" ></textarea>
                    <label class="label" for="address">Address</label>
                </div>
                <p class="red-text"style="height: 0px; margin-top:0px !important;">
                     <?php  echo $errors['address']; ?>
                </p>

              
                 <div class="input-field" style=" margin-bottom:0px !important;">
                    <input type="text" name="username" class="input"
                     id="username" value="<?php echo $user; ?>">
                    <label class="label" for="username">username</label>
                </div>
                <p class="red-text"style="height: 0px; margin-top:0px !important;">
                    <?php  echo $errors['username']; ?>
                </p>

                 <div class="input-field" style=" margin-bottom:0px !important;">
                    <input type="password" name="pass" class="input"
                     id="pass" >
                    <label class="label" for="pass">password</label>
                </div>
                <p class="red-text"style="height: 10px; margin-top:0px !important;">
                    <?php  echo $errors['pass']; ?>
                </p>
                <div class="right">
                    <button name="reg_ceo"class="btn btn-brand indigo darken-4 z-depth-0">
                     Register
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
      <h4><?php echo $created_already ?? $created; ?></h4>
        <div class="right-align">
        <a href="ceo.php" class="btn btn-brand indigo darken-4 z-depth-0">back</a>
        </div>
    </div>
          
<?php endif ?>

 </div>


</main>


<?php include('..\templates\footer.php');?>