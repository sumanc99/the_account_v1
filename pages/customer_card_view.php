<?php session_start();
include("../config/db_connection.php");
include("../config/functions.php");

if(empty($_SESSION['user']) && empty($_SESSION['acct'])){
 header("location:../index.php");
}

$user = $_SESSION['user'];
$acct = $_SESSION['acct'];




$months_names = [1=>'january', 2=>'february', 3=>'march', 4=>'april', 5=>'may', 6=>'june', 
7=>'july', 8=>'august', 9=>'september', 10=>'october', 11=>'november', 12=>'december'];
$months_short_names = [1=>'jan', 2=>'feb', 3=>'mar', 4=>'apr', 5=>'may', 6=>'jun',
 7=>'jul', 8=>'aug', 9=>'sep', 10=>'oct', 11=>'nov', 12=>'decem'];

$svn = acct_svn_returner($acct);



?>

<?php include('..\templates\header.php');?>

<main class="container box" style="margin-top:20px !important; border: 1px solid #6c757d; padding: 10px;">
 

    <div class="center-align">
        <h4 style="margin:0px;"><?php echo brandname(); ?></h3>
         <h5 style="margin:5px;">Motor: <?php echo brandmotor(); ?></h5>
    </div>
<hr/>
    <div class="" style="width:100%" >
        <h5 class="acct-details" style="">
          name: <?php echo customer_name($svn); ?>
        </h5>
        <h5 class="acct-details" style="">
        account no: <?php echo $acct; ?>
        </h5>
        <h5 class="acct-details">
        account type: <?php echo acct_type_returner($acct)." naira"; ?>
        </h5>
        <h5 class=" right acct-details" style="/*margin-right:10px;*/ ">
         date created: <?php echo date_acct_created_returner($acct); ?>
        </h5>
       
    </div>

    <table>
        <tr>
          <td  style="border: none !important;"></td>
          <td style="border: none !important;"></td>
          <td colspan="31" class="days">days</td>
        </tr>
         <tr>
            <td class="sn">s/n</td>
            <td class="months">months</td>
        <?php $i = 1; while($i <= 31){?>
                <td class="day"><?php echo $i++; ?></td>
          <?php } ?>  
        </tr>

   <?php $month_num = 0; while($month_num < 12){?>
         <tr>
            <td class="sn"><?php echo ++$month_num;  ?></td>
            <td class="month" style="width:200px;"><?php echo $months_names[$month_num]; ?></td>

    <?php $month_short_name = $months_short_names[$month_num];
    $sql = "SELECT * FROM $month_short_name WHERE svn='$svn' AND acct_id='$acct'";
    $sql_query = mysqli_query($conn, $sql);
   ?>
        <?php while($result = mysqli_fetch_assoc($sql_query)){?>
                <td class="day"><?php echo marked($result['day1']);  ?> </td>
                <td class="day"><?php echo marked($result['day2']);  ?> </td>
                <td class="day"><?php echo marked($result['day3']);  ?> </td>
                <td class="day"><?php echo marked($result['day4']);  ?> </td>
                <td class="day"><?php echo marked($result['day5']);  ?> </td>
                <td class="day"><?php echo marked($result['day6']);  ?> </td>
                <td class="day"><?php echo marked($result['day7']);  ?> </td>
                <td class="day"><?php echo marked($result['day8']);  ?> </td>
                <td class="day"><?php echo marked($result['day9']);  ?> </td>
                <td class="day"><?php echo marked($result['day10']);  ?> </td>
                <td class="day"><?php echo marked($result['day11']);  ?> </td>
                <td class="day"><?php echo marked($result['day12']);  ?> </td>
                <td class="day"><?php echo marked($result['day13']);  ?> </td>
                <td class="day"><?php echo marked($result['day14']);  ?> </td>
                <td class="day"><?php echo marked($result['day15']);  ?> </td>
                <td class="day"><?php echo marked($result['day16']);  ?> </td>
                <td class="day"><?php echo marked($result['day17']);  ?> </td>
                <td class="day"><?php echo marked($result['day18']);  ?> </td>
                <td class="day"><?php echo marked($result['day19']);  ?> </td>
                <td class="day"><?php echo marked($result['day20']);  ?> </td>
                <td class="day"><?php echo marked($result['day21']);  ?> </td>
                <td class="day"><?php echo marked($result['day22']);  ?> </td>
                <td class="day"><?php echo marked($result['day23']);  ?> </td>
                <td class="day"><?php echo marked($result['day24']);  ?> </td>
                <td class="day"><?php echo marked($result['day25']);  ?> </td>
                <td class="day"><?php echo marked($result['day26']);  ?> </td>
                <td class="day"><?php echo marked($result['day27']);  ?> </td>
                <td class="day"><?php echo marked($result['day28']);  ?> </td>
                <td class="day"><?php echo marked($result['day29']);  ?> </td>
                <td class="day"><?php echo marked($result['day30']);  ?> </td>
                <td class="day"><?php echo marked($result['day31']);  ?> </td>
          <?php } ?> 

        </tr>

    <?php } ?> 
    </table>
 
  
<div class="center">
    <h5>available balance: <?php echo "<span>&#8358</span>".acct_balance($svn, $acct); ?></h5>
</div>
   
</main>

 <div class="center" style="margin:0px !important;">
        <a href="customer_card.php" class="btn indigo darken-4 btn-brand z-depth-0 action">
          back
        </a>
    </div>

   
<?php include('../templates/footer.php')?>