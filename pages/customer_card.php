<?php session_start();

if(empty($_SESSION['user'])){
 header("location:../index.php");
}

$user = $_SESSION['user'];

include("../config/db_connection.php");
include("../config/functions.php");

$errors = ['acct'=>''];
$acct="";

$prob='';   

if(isset($_POST["view"])){
    
    $_SESSION['acct'] =   sanitize($_POST["acct"]);

    $acct =   $_SESSION['acct'];

        //acct validator
        if(empty($acct)){
            $errors['acct'] = "account number can not be empty";
        }else{
            if(!preg_match('/^[\d]+$/', $acct)){
                $errors['acct'] = "account number Must Be numbers Only";
            }
            if(!value_taking($acct, 'acct_id', 'accounts')){
                $errors['acct'] = "invalid account number";
            }
        }


    if(!array_filter($errors)){

        header("location:customer_card_view.php");

    }

}

?>
<?php include('..\templates\header.php');?>
   <div class="right text-muted" style="margin:20px; font-weight: bold;">
        <span><?php echo "today is: ".$day." ".$date;  ?></span>
    </div>
<main class="container box" style="margin-top:20px !important;">
 
   <div class="center" style="margin:10px !important;">
         <h4 class="text-muted">hello <?php echo $user; ?></h4>
    </div>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
    <div class="row">
         <div class="col l6 s12 m5 offset-m1 offset-l3">
            <div class="card">
                <div class="card-content">
                    <div class="input-field" style=" margin-bottom:0px !important;">
                        <input type="text" name="acct" class="input"
                         id="acct" value="<?php echo $acct; ?>">
                        <label class="label" for="acct">account number</label>
                        <div class="right-align">
                               <p class="center red-text"style="margin-bottom: 10px !important; margin-top:0px !important;">
                                <?php  echo $errors['acct']; ?>
                            </p>
                             <button name="view"class="btn indigo darken-4 btn-brand z-depth-0">
                             View card
                             </button>   
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>



    </div>

 </form>

 
   <div class="center" style="margin:10px !important;">
        <a href="collector.php" class="btn indigo darken-4 btn-brand z-depth-0 action">
          back
        </a>
    </div>


   
</main>


   
<?php include('../templates/footer.php')?>