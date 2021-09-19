<?php session_start();
include("../config/db_connection.php");
include("../config/functions.php");
$date =  date("d-M-Y");
$month = date("M");

//staff details
$user = $_SESSION['user'];
$position = $_SESSION['position'];

//customer details
 $fname =   $_SESSION['fname'];
 $lname = $_SESSION['lname'];
 $phone = $_SESSION['phone'];
 $acct_type = $_SESSION['acct_type'];
 // $acct_plan = $_SESSION['acct_plan'];

//sql to check if customer svn is empty
$sql = "SELECT svn FROM customers WHERE svn='' AND phonenumber='$phone'";
$sql_query = mysqli_query($conn, $sql);
$result = mysqli_num_rows($sql_query);

if($result > 0){
 $svn = svn_maker($phone);
 $acct = acct_id_maker($phone);

     //sql to update svn of the customer
     $sql_update = "UPDATE  customers SET svn='$svn'  WHERE  phonenumber='$phone'";
     $sql_query = mysqli_query($conn, $sql_update);

     if(!$sql_query){

     }else{

        $sql ="INSERT INTO accounts(svn,acct_id,acct_type,acct_balance,created_by,date_acct_created) 
          VALUES('$svn','$acct','$acct_type','0','$user','$date')";
        $sql_query = mysqli_query($conn, $sql);

        if(!$sql_query){
           // echo "erro".mysqli_error($conn);       
        }else{
            $sms ="Account is created";
            months_reg($svn, $acct);
        }
    }
}else{
     $svn = svn($phone);
     $acct = acct($svn);
     $sms ="Account is created";
}



            

         

?>
<?php include('..\templates\header.php');?>
<div class="right text-muted" style="margin:20px; font-weight: bold;">
        <span><?php echo "today is: ".$day." ".$date;  ?></span>
</div>
<main class="container box" style="margin-top:20px !important;">
<h5 class="text-muted center"><?php echo $sms; ?></h5>
<div class="row">
   <div class="col l6 push-l3">
        <div class="card" style="letter-spacing: 0.5px;">
            <div class="card-content text-muted">
               <div class="center"><i class=" text-muted bi bi-person-fill" style="font-size:100px;"></i></div>
               <div class="card-action">
                    <h5>Name: <?php echo $fname; ?> <?php echo $lname; ?></h5>
                    <h5>SVN: <?php echo $svn; ?><h5>
                    <h5>account no: <?php echo $acct; ?></h4>
                    <h5>account type: <?php echo  $acct_type." naira"; ?></h4>
                       
               </div>
               
            </div>
            <div class="card-action right-align">
                <?php if ($position=='manager'): ?>
                <a href="manager.php" class="btn btn-brand indigo darken-4 z-depth-0">Done</a>
                <?php endif ?>

                 <?php if ($position=='collector'): ?>
                    <a href="collector.php" class="btn btn-brand indigo darken-4 z-depth-0">Done</a>
                 <?php endif ?>
                 
                <a href="open_acct.php" class="btn indigo darken-4 btn-brand z-depth-0" style="margin-left:5px;">
                back</a>
            </div>
        </div>
   </div> 
</div>

</main>


   
<?php include('../templates/footer.php')?>