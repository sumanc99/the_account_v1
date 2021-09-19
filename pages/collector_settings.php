<?php session_start();
include("../config/db_connection.php");
include("../config/functions.php");

if(empty($_SESSION['user'])){
 header("location:../index.php");
}



$date =  date("d-M-Y");
$user = $_SESSION['user'];
$position = $_SESSION['position'];



?>
<?php include('..\templates\header.php');?>
   <div class="right text-muted" style="margin:20px; font-weight: bold;">
        <span><?php echo "today is: ".$day." ".$date;  ?></span>
    </div>
<main class="container box" style="margin-top:20px !important;">
 
   <div class="center" style="margin:10px !important;">
         <h5 class="text-muted">hello <?php echo $user; ?> what do you like to update</h5>
    </div>

    <div class="row">
         <div class="col l6 s12 m12  offset-l3">
            <div class="card">
                <div class="card-content center">
                 <a href="username_update.php" class="btn indigo darken-4 btn-brand z-depth-0">update username</a>
                 <a href="name_update.php" class="btn indigo darken-4 btn-brand z-depth-0">update name</a>
                </div>
            </div>
        </div>



    </div>



 
   <div class="center" style="margin:10px !important;">
        <a href="collector.php" class="btn indigo darken-4 btn-brand z-depth-0 action">
          back
        </a>
    </div>


   
</main>


   
<?php include('../templates/footer.php')?>