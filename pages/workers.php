
<?php session_start();
$position = $_SESSION['position'];
include("../config/db_connection.php");
include("../config/functions.php");

if ($position=='ceo') {
 $sql ="SELECT firstname,lastname FROM staffs WHERE position <> 'ceo'";
$sql_query=mysqli_query($conn, $sql);
}

if ($position=='manager') {
 $sql ="SELECT firstname,lastname FROM staffs WHERE position <> 'manager' AND position <> 'ceo' ";
$sql_query=mysqli_query($conn, $sql);
}





?>

<?php include('..\templates\header.php');?>



<main class="container  box">


   <div class="container">

      <ul class="collection with-header z-depth-2">
          <li class="collection-header center">
            <h5 style="margin: 0px; height: 0px;">workers list</h5>
              <div class="input-field right-align" style="margin: 0px;">
                <input type="text" name="" style="width:200px" class="input" placeholder="Search worker">
              </div>
          </li>
          <?php $i=0; while ($result = mysqli_fetch_assoc($sql_query)) {?>
          <li class="collection-item">
            <h6><?php echo ++$i.". ".$result['firstname']." ".$result['lastname']; ?></h6>
          </li>
           <?php } ?>
      </ul>

        <div class="right-align">
          <?php if ($position=='ceo'): ?>
              <a href="ceo.php" class="btn btn-brand indigo darken-4 z-depth-0">back</a>
          <?php endif ?>

         <?php if ($position=='manager'): ?>
             <a href="manager.php" class="btn btn-brand indigo darken-4 z-depth-0">back</a>
          <?php endif ?>
        </div>
              

   </div>


</main>


<?php include('..\templates\footer.php');?>