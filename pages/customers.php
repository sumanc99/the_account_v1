
<?php session_start();
include("../config/db_connection.php");
include("../config/functions.php");

$sql ="SELECT firstname,lastname FROM customers";
$sql_query=mysqli_query($conn, $sql);




$user = $_SESSION['user'];
$position = $_SESSION['position'];

if(empty($_SESSION['user'])){
 header("location:../index.php");
}
?>

<?php include('..\templates\header.php');?>



<main class="container  box">

<!-- <div class="center">
   <a href="ceo.php" class="btn btn-brand indigo darken-4 z-depth-0">back</a>
   <a href="ceo.php" class="btn btn-brand indigo darken-4 z-depth-0">back</a>
</div> -->
   <div class="container">

      <ul class="collection with-header z-depth-2">
          <li class="collection-header center">
            <h5>customers list</h5>
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