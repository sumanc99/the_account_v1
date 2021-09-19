<?php session_start();
include("../config/db_connection.php");
include("../config/functions.php");

if(empty($_SESSION['user']) && empty($_SESSION['acct'])){
 header("location:../index.php");
}




$user = $_SESSION['user'];
$errors = ['acct_enter'=>''];
$acct_enter="";

 $sql = "SELECT acct_id,amount,status,date_of_tran,timeline,collector FROM transactions LIMIT 100";
 $sql_query = mysqli_query($conn, $sql);

 if (isset($_POST['search'])) {

 $acct_enter =   sanitize($_POST["acct"]);
    
    //acct validator
    if(empty($acct_enter)){
        $errors['acct_enter'] = "account number can not be empty";
    }else{
        if(!preg_match('/^[\d]+$/', $acct_enter)){
            $errors['acct_enter'] = "account number Be  numbers Only";
        }
        if(!value_taking($acct_enter, 'acct_id', 'accounts')){
            $errors['acct_enter'] = "invalid account number";
        }
    }


 if(!array_filter($errors)){
    $sql = "SELECT acct_id,amount,status,date_of_tran,timeline,collector FROM transactions WHERE acct_id='$acct_enter'";
    $sql_query = mysqli_query($conn, $sql);
 }


}
      

 if (isset($_POST['today'])) {
    $today = date('d-M-Y');
$sql = "SELECT acct_id,amount,status,date_of_tran,timeline,collector FROM transactions WHERE date_of_tran='$today'";
    $sql_query = mysqli_query($conn, $sql);
 }
?>

<?php include('..\templates\header.php');?>

<main class="container box" style="margin-top:20px !important; border: 1px solid #6c757d; padding: 10px;">
 

    <div class="center-align">
        <h4 style="margin:0px;"><?php echo brandname(); ?></h3>
         <h5 style="margin:5px;">Motor: <?php echo brandmotor(); ?></h5>
    </div>
<hr/>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div class="input-field search-box">
    <button name="today"class="btn indigo darken-4 btn-brand z-depth-0">
    todays transactions  <i class=" center  bi bi-search"></i>
    </button>
</div>
<div class="right">
        <div class="input-field search-box">
            <input type="text" name="acct" class="input" id="acct" value="<?php echo $acct_enter; ?>">
            <label class="label" for="acct">enter account number</label>
        </div>
        <button name="search"class="btn indigo darken-4 btn-brand z-depth-0">
            <i class=" center  bi bi-search"></i>
        </button> 
        
        <div class="right-align">
            <p class="left red-text search-p">
            <?php  echo $errors['acct_enter']; ?>
            </p>
         </div>

    </div>
</form>
    <table >
   
         <tr>
            <td class="sn">s/n</td>
            <td class="acct-id">acct no</td>
            <td class="acct-id">amount</td>
            <td class="acct-id">collector</td>
            <td class="acct-balance">transaction type</td>
            <td class="acct-balance">date</td>
            <td class="acct-balance">time</td>
        </tr>
        <?php $sn=0; $total=0; while($result = mysqli_fetch_assoc($sql_query)){?>
        <tr>
            <td ><?php echo ++$sn; ?></td>
            <td class="svn-no"><?php echo $result['acct_id'];  ?> </td>
            <td class=""><?php echo "<span>&#8358</span>".$result['amount'];  ?> </td>
            <td class=""><?php echo $result['collector'];  ?> </td>
            <td class=""><?php echo $result['status'];  ?> </td>
            <td class=""><?php echo $result['date_of_tran'];  ?> </td>
            <td class=""><?php echo $result['timeline'];  ?> </td>
        </tr>
        <?php } ?> 

    </table>
 
  
<div class="center">
    <h5></h5>
</div>
   
</main>

 <div class="center" style="margin:0px !important;">
        <a href="manager.php" class="btn indigo darken-4 btn-brand z-depth-0 action">
          back
        </a>
    </div>

   
<?php include('../templates/footer.php')?>