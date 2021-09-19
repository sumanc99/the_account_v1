<?php session_start();
include("../config/db_connection.php");
include("../config/functions.php");

$user = $_SESSION['user'];
$position = $_SESSION['position'];





?>

<?php include('..\templates\header.php');?>


<?php if (brand_empty()): ?>
    <div class="center grey darken-4" style="padding:1px; margin-top: 3px;">
    <p class="yellow-text"style="padding:0px; margin: 0px; font-size: 20px;">
        <i class="yellow-text bi bi-exclamation-circle"></i> 
        warning you have to provide brand information
    </p>
  </div>
<?php endif ?>

<div class="right text-muted" style="margin:20px; font-weight: bold;">
        <span class="hide-on-med-and-down"><?php echo "today is: ".$day." ".$date;  ?></span>
</div>

<main class="container box">
<div class="center" style="margin:10px !important;">
    <h4 class="text-muted">Welcome <?php echo $user; ?></h4>
   <a href="staff_reg.php" class="btn indigo darken-4 btn-brand z-depth-0 action">
   register staff
   </a>
    <a href="#" class="dropdown-trigger btn indigo darken-4 btn-brand z-depth-0 action" data-target='menu'>
      menu
    </a>
    <ul id='menu' class="dropdown-content">
        <li><a href="delete_staff.php">delete staff</a></li>
        <li><a href="block_staff.php">block staff</a></li>
         <li><a href="un_block_staff.php">un-block staff</a></li>
        <li class="divider"></li>
        <li><a href="ceo_settings.php">updates</a></li>
    </ul>
</div>

    <div class="row">
        <div class="col l4 s12 m5 offset-m1">
            <div class="card center">
                <div class="card-content">
                    <h6 class="left-align card-title indigo-text text-darken-4"></h6>
                   <i class=" center text-muted bi bi-file-earmark-text" style="font-size:100px;"></i>
                </div>
                <div class="card-action right-align">
                    <a href="brand_reg.php" class="btn indigo darken-4 btn-brand z-depth-0">Brand info</a>
                </div>
            </div>
        </div>

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
       
        
    </div>
   
</main>


   
<?php include('../templates/footer.php')?>