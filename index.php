<?php session_start();

include("config/db_connection.php");
include("config/functions.php");

$errors = ['user'=>'', 'pass'=>''];
$user=$sms='';

if(isset($_POST['login'])){
 $_SESSION['user'] = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['username'])));
 $pass = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['password'])));

$user = $_SESSION['user'];
 //username validation
  if(empty($user)){
    $errors['user'] = "username is required";
  }else{
    if(!preg_match('/^[a-zA-Z\s]+$/', $user)){
        $errors['user'] = "username must be letters"; 
    }
  }

  //password validation
   if(empty($pass)){
    $errors['pass'] = "password is required";
  }else{
    if(!preg_match('/^[\d]+$/', $pass)){
        $errors['pass'] = "password must be numbers"; 
    }
  }


  if(!array_filter($errors)){
        
        $sql = "SELECT phonenumber FROM users WHERE (username='$user' AND password='$pass') AND status='active'";
        $sql_query = mysqli_query($conn, $sql);
        if(!$sql_query){
            $sms = "Invalid username or Password";
        }else{
              $result = mysqli_fetch_assoc($sql_query);
              $id = $result['phonenumber'];

            if($id){
                $sql_position = "SELECT position FROM staffs WHERE phonenumber='$id'";
                $sql_query_postion = mysqli_query($conn, $sql_position);
                $ans = mysqli_fetch_assoc($sql_query_postion);
                $_SESSION['position'] = $ans['position'];
                $position = $_SESSION['position'];
                if($position==='ceo'){
                   header("location:pages/ceo.php");
                }
                elseif($position==='manager'){
                  header("location:pages/manager.php");
                }
                elseif($position==='collector'){
                    header("location:pages/collector.php");
                }else{
                     $sms = "Invalid username or Password"; 
                }
            }else{
                $sms = "Invalid username or Password";
            }
        }
  }
}





?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Account</title>
    <link rel='stylesheet' href='style/materialize.min.css'>
<script  src="style/materialize.min.js"></script>
<script  src="style/app.js"></script>
    <link rel='stylesheet' href='style/styles.css'>
</head>

<body class=''>
    
   <nav  class='nav-wrapper indigo darken-3 z-depth-0'>
    <div class="container">
        <a class="brand-logo">The Account</a>
    </div>
   </nav>
<main class="container box">
<div class="center">
<h3 class="indigo-text text-darken-4" style="margin-bottom:0px;">The Acc...</h3>
<span class="grey-text" style="font-size:18px">save for the future</span>
 <!-- save today and dream for tomorrow -->
</div>
    <h6 class="red-text center" style="font-size:18px; margin-bottom:0px !important;">
      <?php echo $sms; ?>
    </h6>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
       <div class="row center">
           <div class="col s12 l6 push-l1 offset-l2 m9 offset-m2">
                   <div class="input-field">
                       <input type="text" name="username"  value="<?php echo $user?>" id="username" class="input">
                       <label for="username" class="label">Username</label>
                       <p class="red-text" style="margin:0px;"><?php echo $errors['user']; ?></p>
                   </div>
                   <div class="input-field">
                       <input type="password" name="password"   id="password" class="input">
                       <label for="password" class="label">Password</label>
                       <p class="red-text" style="margin:0px;"><?php echo $errors['pass']; ?></p>
                   </div>

                   <div class="center">
                     <input type="submit" name="login" value="log in" 
                     class="btn indigo darken-3 btn-brand">
                   </div>
           </div>
       </div>
    </form>
</main>


   
<?php include('templates/footer.php')?>