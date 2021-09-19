<?php session_start();

include("../config/db_connection.php");
include("../config/functions.php");

if(empty($_SESSION['user'])){
 header("location:../index.php");
}



$date =  date("d-M-Y");
$user = $_SESSION['user'];
$errors = ['acct'=>'','amount'=>''];
$amount=$acct="";

$sms='';   

if(isset($_POST["withdraw"])){
    
    $amount =   sanitize($_POST["amount"]);
    $acct =   sanitize($_POST["acct"]);

          //acct validator
        if(empty($acct)){
            $errors['acct'] = "account number can not be empty";
        }else{
            if(!preg_match('/^[\d]+$/', $acct)){
                $errors['acct'] = "account number Be  numbers Only";
            }
            if(!value_taking($acct, 'acct_id', 'accounts')){
                $errors['acct'] = "invalid account number";
            }
        }


        //amount validator
        if(empty($amount)){
            $errors['amount'] = "amount can not be empty";
        }else{
            if(!preg_match('/^[\d]+$/', $amount)){
                $errors['amount'] = "amount Must Be in numbers Only";
            }
            
        }


if(!array_filter($errors)){

    if(withdraw_date_validator($acct)){
        $sms = "<h5 class='red-text text-darken-3' style='margin-top:0px;'>sorry you can't withdraw today</h5>";
    }else{
         if(withdraw_days_validator($acct)){
            if(withdraw_amount_validator($acct, $amount)){
                if(transaction_recorder($acct,$amount,'withdraw',$date,$user)){
                    if(withdraw_balance_update($acct, $amount)){
                            $sms = "<h5 class='indigo-text text-darken-3' style='margin-top:0px;'>
                            <span>&#8358</span>$amount is withdrawn  from $acct</h5>";
                            $amount=$acct="";
                    }else{
                         $sms = "withdraw pending";
                    }
                }else{
                     $sms = "try again withdraw not complete";
                }
            }else{
                $sms = "<h5 class='red-text text-darken-3' style='margin-top:0px;'>insufficient fund</h5>";
            }
            
        }else{
         $sms = "<h5 class='red-text text-darken-3' style='margin-top:0px;'>sorry you can't withdraw today</h5>";
        } 
     
    }
       

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
                    <div class="center"><?php echo $sms; ?></div>
                    <div class="input-field" style=" margin-bottom:0px !important;">
                        <input type="text" name="acct" class="input"
                         id="acct" value="<?php echo $acct; ?>">
                        <label class="label" for="acct">enter account number</label>
                        <div class="right-align">
                               <p class="left-align red-text"style="margin-bottom: 10px !important; margin-top:0px !important;">
                                <?php  echo $errors['acct']; ?>
                            </p>   
                        </div>
                    </div>

                    <div class="input-field" style=" margin-bottom:0px !important;">
                        <input type="text" name="amount" class="input"
                         id="amount" value="<?php echo $amount; ?>">
                        <label class="label" for="amount">enter amount</label>
                        <div class="right-align">
                               <p class="left-align red-text"style="margin-bottom: 10px !important; margin-top:0px !important;">
                                <?php  echo $errors['amount']; ?>
                            </p>
                             <button name="withdraw"class="btn indigo darken-4 btn-brand z-depth-0">
                              withdraw
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