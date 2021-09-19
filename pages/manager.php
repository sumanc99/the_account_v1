<?php session_start();
include("../config/db_connection.php");
include("../config/functions.php");

$user = $_SESSION['user'];
$position = $_SESSION['position'];





?>
<?php include('..\templates\header.php');?>
<div class="right text-muted" style="margin:20px; font-weight: bold;">
        <span class="hide-on-med-and-down"><?php echo "today is: ".$day." ".$date;  ?></span>
</div>
<main class="container box" style="margin-top:20px !important;">
<div class="center" style="margin:10px !important;">
    <h4 class="text-muted">Welcome <?php echo $user; ?></h4>
    <a href="transactions.php" class="btn indigo darken-4 btn-brand z-depth-0 action">
     Transactions
    </a>
    <a href="accounts_list.php" class="btn indigo darken-4 btn-brand z-depth-0 action">
    accounts list
    </a>
    <a href="open_acct.php" class="btn indigo darken-4 btn-brand z-depth-0 action">
    open account
    </a>
    <a href="#" class="dropdown-trigger btn indigo darken-4 btn-brand z-depth-0 action" data-target='menu'>
      menu
    </a>
    <ul id='menu' class="dropdown-content">
        <li><a href="#">special withdraw</a></li>
        <li><a href="open_special_acct.php">open special account</a></li>
        <li><a href="acct_upgrade.php">upgrade account</a></li>
       <!--  <li><a href="#">collectors</a></li> -->
        <li><a href="delete_acct.php">delete account</a></li>
        <li><a href="block_staff.php">block staff</a></li>
        <li><a href="un_block_staff.php">un-block staff</a></li>
        <li class="divider"></li>
        <li><a href="manager_setting.php">updates</a></li>
    </ul>
</div>
    <div class="row">

         <div class="col l4 s12 m5 offset-m1">
            <div class="card center">
                <div class="card-content">
                    <h6 class="left-align card-title indigo-text text-darken-4"></h6>
                   <i class=" center text-muted bi bi-person-lines-fill" style="font-size:100px;"></i>
                </div>
                <div class="card-action right-align">
                    <a href="workers.php" class="btn indigo darken-4 btn-brand z-depth-0">workers list</a>
                </div>
            </div>
        </div>

         <div class="col l4 s12 m5 offset-m1">
            <div class="card center">
                <div class="card-content">
                    <h6 class="left-align card-title indigo-text text-darken-4"></h6>
                   <i class=" center text-muted bi bi-people-fill" style="font-size:100px;"></i>
                </div>
                <div class="card-action right-align">
                    <a href="customers.php" class="btn indigo darken-4 btn-brand z-depth-0">customers list</a>
                </div>
            </div>
        </div>
       
         <div class="col l4 s12 m5 offset-m1">
            <div class="card center">
                <div class="card-content">
                    <h6 class="left-align card-title indigo-text text-darken-4"></h6>
                   <i class=" center text-muted bi bi-person-fill" style="font-size:100px;"></i>
                </div>
                <div class="card-action right-align">
                    <a href="staff_reg.php" class="btn indigo darken-4 btn-brand z-depth-0">register staff</a>
                </div>
            </div>
        </div>
    </div>





   
</main>


   
<?php include('../templates/footer.php')?>