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
         <h4 class="text-muted">hello <?php echo $user; ?> what do you like to update</h5>
    </div>
    <hr>

  
    <div class="row">
        <div class="col l6 s12 m12  ">
            <div class="card">
             <div class="center" style="margin:0px !important;padding-top:10px;">          
                 <h5 class="text-muted" style="margin:0px !important; height: 10px;">personal update</h5>
             </div>
                <div class="card-content center">
                 <a href="username_update.php" class="btn indigo darken-4 btn-brand z-depth-0 btn-card">
                   username
                 </a>
                 <a href="name_update.php" class="btn indigo darken-4 btn-brand z-depth-0 btn-card">
                   name
                 </a>

                  <a href="email_update.php" class="btn indigo darken-4 btn-brand z-depth-0 btn-card">
                   email
                 </a>

                  <a href="phonenumber_update.php" class="btn indigo darken-4 btn-brand z-depth-0 btn-card">
                   phone num
                 </a>
                </div>
            </div>
        </div>


        <div class="col l6 s12 m12  ">
            <div class="card">
             <div class="center" style="margin:0px !important; padding-top:10px;">
                 <h5 class="text-muted" style="margin:0px !important;  height: 10px;">collector update</h5>
             </div>
                <div class="card-content center">
                 <a href="password_update.php" class="btn indigo darken-4 btn-brand z-depth-0 btn-card">
                  password
                 </a>
                 <a href="email_update.php" class="btn indigo darken-4 btn-brand z-depth-0 btn-card">
                  email
                 </a>

                <a href="phonenumber_update.php" class="btn indigo darken-4 btn-brand z-depth-0 btn-card">
                 phonenumber
                </a>

                </div>
            </div>
        </div>


         <div class="col l12 s12 m12  ">
            <div class="card">
             <div class="center" style="margin:0px !important; padding-top:10px;">
                 <h5 class="text-muted" style="margin:0px !important;  height: 10px;">customer update</h5>
             </div>
                <div class="card-content center">
                 <a href="customer_phone_update.php" class="btn indigo darken-4 btn-brand z-depth-0 btn-card action">
                  phonenumber 
                 </a>

                 <a href="customer_name_update.php" class="btn indigo darken-4 btn-brand z-depth-0 btn-card ">
                  name
                 </a>

                 <a href="customer_acct_unupgrade.php" class="btn indigo darken-4 btn-brand z-depth-0 btn-card action">
                  un-upgrade account
                 </a>

                 <a href="extend_spec_acct.php" class="btn indigo darken-4 btn-brand z-depth-0 btn-card action">
                  extend special acct
                 </a>

                 <a href="#" class="btn indigo darken-4 btn-brand z-depth-0 btn-card">
                  account type
                 </a>

                
                </div>
            </div>
        </div>


    </div>


 
   <div class="center" style="margin:10px !important;">
        <a href="manager.php" class="btn indigo darken-4 btn-brand z-depth-0 action">
          back
        </a>
    </div>


   
</main>


   
<?php include('../templates/footer.php')?>