<?php session_start();
include("../config/db_connection.php");
include("../config/functions.php");

if(empty($_SESSION['user']) && empty($_SESSION['acct'])){
 header("location:../index.php");
}

$user = $_SESSION['user'];



$errors = ['acct_enter'=>''];
$acct_enter="";

$sql = "SELECT svn,acct_id,acct_type,acct_balance,date_acct_created FROM accounts";
$sql_query = mysqli_query($conn, $sql);
$accts_list_num = mysqli_num_rows($sql_query); 
$asset = true;
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
$sql = "SELECT svn,acct_id,acct_type,acct_balance,date_acct_created FROM accounts WHERE acct_id='$acct_enter'";
    $sql_query = mysqli_query($conn, $sql);

    $asset = false;
 }


}
      





?>

<?php include('..\templates\header.php');?>

<main class="container box" style="margin-top:20px !important; border: 1px solid #6c757d; padding: 10px;">
 

    <div class="center-align">
        <h4 style="margin:0px;"><?php echo brandname(); ?></h3>
         <h5 style="margin:5px;">Motor: <?php echo brandmotor(); ?></h5>
    </div>
<hr/>
<div class="right">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

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
    </form>
</div>
<h5><?php echo "you have $accts_list_num accounts" ?></h5>
    <table >
   
         <tr>
            <td class="sn">s/n</td>
            <td class="name-head">name</td>
            <td class="svn">svn</td>
            <td class="acct-id">acct no</td>
           <!--  <td class="">acct type</td> -->
            <td class="acct-balance">acct blance</td>
            <td class="acct-balance">date acct created</td>
        </tr>
        <?php $sn=0; $total=0; while($result = mysqli_fetch_assoc($sql_query)){?>
        <tr>
            <td ><?php echo ++$sn; ?></td>
            <td class="names"><?php echo customer_name($result['svn']); ?></td>
            <td class="svn-no"><?php echo $result['svn'];  ?> </td>
            <td class=""><?php echo $result['acct_id'];  ?> </td>
            <td class=""><?php echo $result['acct_balance'];  ?> </td>
            <td class=""><?php echo $result['date_acct_created'];  ?> </td>
            <?php $total += $result['acct_balance']; ?>
        </tr>
        <?php } ?> 

    </table>
 
  
<div class="center">
    <h5><?php echo $asset ?"total asset: <span>&#8358</span>".$total:""; ?></h5>
</div>
   
</main>

 <div class="center" style="margin:0px !important;">
        <a href="manager.php" class="btn indigo darken-4 btn-brand z-depth-0 action">
          back
        </a>
    </div>

   
<?php include('../templates/footer.php')?>