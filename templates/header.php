<?php date_default_timezone_set("Africa/lagos"); 

$date =  date("d-M-Y");
$day =  date("D");
$time = date("h:i:sa");

$month = date('M');

if(isset($_POST['logout'])){
 session_unset($_SESSION['user']);
  session_unset($_SESSION['position']);
   header("location:../index.php");
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Account</title>
    <link rel='stylesheet' href='../style/materialize.min.css'>
    <script  src="../style/materialize.min.js"></script>
    <script  src="../style/app.js"></script>
    <link rel='stylesheet' href='../style/styles.css'>
    <link rel="stylesheet" href="../font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style/table_style.css">
</head>

<body class=''>
   <nav  class='nav-wrapper indigo darken-3 z-depth-0'>
    <div class="container">
        <a href="../index.php"class="brand-logo">The Account</a>
        <a href="#" class="sidenav-trigger" data-target="mobile-links">menu</a>
     
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
           <button name="logout"class="btn indigo darken-4 btn-brand z-depth-2 right hide-on-med-and-down" style="margin-top:15px;">
            Log out
          </button>  
        </form>
    </div>
   </nav>

   <ul class="sidenav" id="mobile-links">

         <form method="POST" action="ceo.php" class="center">
           <button name="logout"class="btn indigo darken-4 btn-brand z-depth-2 " style="margin-top:15px;">
            Log out
          </button>  
        </form>
</ul>