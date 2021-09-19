<?php session_start();
include("../config/db_connection.php");
include("../config/functions.php");

if(empty($_SESSION['user']) && empty($_SESSION['position'])){
 header("location:../index.php");
}
$user = $_SESSION['user'];
$position = $_SESSION['position'];





?>
<?php include('..\templates\header.php');?>
   <div class="right text-muted" style="margin:20px; font-weight: bold;">
        <span><?php echo "today is: ".$day." ".$date;  ?></span>
    </div>
<main class="container box" style="margin-top:20px !important;">
 
<div class="center" style="margin:10px !important;">
    <h4 class="text-muted">Welcome <?php echo $user; ?></h4>
      <a href="customer_card.php" class="btn indigo darken-4 btn-brand z-depth-0 action">
     customer card
    </a>
    <a href="#" class="dropdown-trigger btn indigo darken-4 btn-brand z-depth-0 action" data-target='menu'>
      menu
    </a>
    <ul id='menu' class="dropdown-content">
        <!-- <li><a href="#">special withdraw</a></li> -->
        <li><a href="open_special_acct.php">open special account</a></li>
         <li><a href="acct_upgrade.php">upgrade account</a></li>
        <!-- <li><a href="#">day details</a></li> -->
        <li class="divider"></li>
        <li><a href="collector_settings.php">updates</a></li>
    </ul>
  
</div>
    <div class="row">

         <div class="col l4 s12 m5 offset-m1">
            <div class="card center">
                <div class="card-content">
                    <h6 class="left-align card-title indigo-text text-darken-4"></h6>
                   <i class=" center text-muted bi bi-box-arrow-in-down" style="font-size:100px;"></i>
                </div>
                <div class="card-action right-align">
                    <a href="deposit.php" class="btn indigo darken-4 btn-brand z-depth-0">Deposit</a>
                </div>
            </div>
        </div>

         <div class="col l4 s12 m5 offset-m1">
            <div class="card center">
                <div class="card-content">
                    <h6 class="left-align card-title indigo-text text-darken-4"></h6>
                   <i class=" center text-muted bi bi-receipt" style="font-size:100px;"></i>
                </div>
                <div class="card-action right-align">
                    <a href="withdraw.php" class="btn indigo darken-4 btn-brand z-depth-0">withdraw</a>
                </div>
            </div>
        </div>
       
         <div class="col l4 s12 m5 offset-m1">
            <div class="card center">
                <div class="card-content">
                    <h6 class="left-align card-title indigo-text text-darken-4"></h6>
                   <i class=" center text-muted bi bi-wallet2" style="font-size:100px;"></i>
                </div>
                <div class="card-action right-align">
                    <a href="open_acct.php" class="btn indigo darken-4 btn-brand z-depth-0">open account</a>
                </div>
            </div>
        </div>
    </div>



<!-- 
<div class="center" style="margin:10px !important;">

    <a href="#" class="btn red  darken-2 btn-brand-danger z-depth-0 action">
     fre
    </a>

</div> -->
   
</main>


   
<?php include('../templates/footer.php')?>