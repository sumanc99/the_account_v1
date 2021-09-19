<?php

//use to sanitize
function sanitize($input){
    global $conn;
  $sanitize =mysqli_real_escape_string($conn,htmlspecialchars(trim($input)));
  return strtolower($sanitize);
}
//use to check if brand name is empty
function brand_empty(){
global $conn;
    $sql = "SELECT * FROM brand_details";

    $check_sql = mysqli_query($conn,$sql);

    $num = mysqli_num_rows($check_sql);

    if($num > 0){
     $ans = false;
    }else{
        $ans= true;
    }

 return $ans;
}

// use to check for ceo
function ceo_empty(){
global $conn;
    $sql = "SELECT position FROM staffs WHERE position='ceo'";

    $check_sql = mysqli_query($conn,$sql);

    $num = mysqli_num_rows($check_sql);

    if($num > 0){
     $ans = false;
    }else{
        $ans= true;
    }

 return $ans;
}

// use to check for value if taking/already exist
function value_taking($value, $column, $table){
global $conn;
    $sql = "SELECT $column FROM $table WHERE $column='$value'";

    $check_sql = mysqli_query($conn,$sql);

    $num = mysqli_num_rows($check_sql);

    if($num > 0){
     $ans = true;
    }else{
        $ans= false;
    }

 return $ans;
}



//use to make svn no 
function svn_maker($phone){
    global $conn;
   for ($i=0; $i < 1000; $i++) { 
        $svn_no=$phone;
        $svn_shuffle = str_shuffle($svn_no);
        $svn_holder = substr($svn_shuffle, 0,7);
    
        $sql = "SELECT svn FROM customers WHERE svn='$svn_holder'";
        $sql_query = mysqli_query($conn, $sql);
        $result = mysqli_num_rows($sql_query);
    
        if($result > 0){
            continue;
        }else{
            break;
        }
    }

    return "32".$svn_holder;
}




//use to make acct_no 
function acct_id_maker($phone){
 global $conn;
    global $conn;
    for ($i=0; $i < 1000; $i++) { 
        $acct_no=$phone;
        $acct_shuffle = str_shuffle($acct_no);
        $acct_id = substr($acct_shuffle, 0,4);
    
        $sql = "SELECT acct_id FROM accounts WHERE acct_id='$acct_id'";
        $sql_query = mysqli_query($conn, $sql);
        $result = mysqli_num_rows($sql_query);
    
        if($result > 0){
            continue;
        }else{
            break;
        }
    }
    return $acct_id;
}

// use to return acct types
function acct_types(){
 global $conn;
    $sql = "SELECT acct_type FROM account_types";
    $sql_query = mysqli_query($conn, $sql);
    if(!$sql_query){
        $result = ["account types not found"];
    }else{
        $result = mysqli_fetch_all($sql_query, MYSQLI_ASSOC);
    }



    return $result;
}

// use to return acct plans
function acct_plans(){
 global $conn;
    $sql = "SELECT acct_plan FROM account_plans";
    $sql_query = mysqli_query($conn, $sql);
    if(!$sql_query){
        $result = ["account plans not found"];
    }else{
        $result = mysqli_fetch_all($sql_query, MYSQLI_ASSOC);
    }



    return $result;
}

//use to return svn of the customer
function svn($phone){
    global $conn;

    $sql = "SELECT svn FROM customers WHERE phonenumber='$phone'";
    $sql_query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($sql_query);

    return $result['svn'];
}

//use to return customer acct_id
function acct($svn){
    global $conn;

    $sql = "SELECT acct_id FROM accounts WHERE svn='$svn' ";
    $sql_query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($sql_query);

    return $result['acct_id'];
}
//use to return cashout_date of the user
// function cashout_date($svn,$acct){
//     global $conn;

//     $sql = "SELECT cashout_date FROM accounts WHERE svn='$svn' AND acct_id='$acct'";
//     $sql_query = mysqli_query($conn, $sql);
//     $result = mysqli_fetch_assoc($sql_query);

//     return $result['cashout_date'];
// }

//use to reg user into months of the year that is 12
function months_reg($svn, $acct){
    global $conn;
    $months_names = ['jan','feb','mar', 'apr','may','jun','jul','aug','sep','oct','nov','decem'];

    foreach ($months_names as $month_name){
      $sql ="INSERT INTO $month_name(svn,acct_id,day1,day2,day3,day4,day5,day6,day7,day8,day9,day10,day11,day12,day13,day14,day15,day16,day17,day18,day19,day20,day21,day22,day23,day24,day25,day26,day27,day28,day29,day30,day31) 
 VALUES('$svn','$acct','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0')";
      $sql_query = mysqli_query($conn, $sql);
    }


}

//use to return svn base on acct no
function acct_svn_returner($acct){
    global $conn;

    $sql = "SELECT svn FROM accounts WHERE acct_id='$acct' ";
    $sql_query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($sql_query);

    return $result['svn'];
}

//use to return acct type base on acct no
function acct_type_returner($acct){
    global $conn;

    $sql = "SELECT acct_type FROM accounts WHERE acct_id='$acct' ";
    $sql_query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($sql_query);

    return $result['acct_type'];
}

//use to return acct date created base on acct no
function date_acct_created_returner($acct){
    global $conn;

    $sql = "SELECT date_acct_created FROM accounts WHERE acct_id='$acct' ";
    $sql_query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($sql_query);

    return $result['date_acct_created'];
}


//use to return brandname
function brandname(){
    global $conn;

    $sql = "SELECT brand_name FROM brand_details";
    $sql_query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($sql_query);

    return $result['brand_name'];
}

//use to return brandmotor
function brandmotor(){
    global $conn;

    $sql = "SELECT motor FROM brand_details";
    $sql_query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($sql_query);

    return $result['motor'];
}

//use to return customer name base on svn 
function customer_name($svn){
    global $conn;

    $sql = "SELECT firstname, lastname FROM customers WHERE svn='$svn'";
    $sql_query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($sql_query);

    return $result['firstname']." ".$result['lastname'];
}

// use to marked if customer paid in customer card view
function marked($value){
    if($value > 0){
        return "<i class='center  bi bi-check-lg' ></i>";
    }
}

//use to validate if amount is valid to enter account 
function amount_validator($acct, $amount){
     global $conn;
    $sql = "SELECT acct_type FROM accounts WHERE acct_id='$acct'";
    $sql_query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($sql_query);
      
    $acct_type = $result['acct_type'];

    $days_payed = $amount / $acct_type;
      
    if(is_int($days_payed)){
        if($amount === $acct_type){
            return true;
        }else{
            return true;
        }
       
    }else{
        return false;
    }
}


//use to update acct balance 
function balance_update($acct, $amount){
    global $conn;
  
    $sql = "SELECT acct_balance FROM accounts WHERE acct_id='$acct'";
    $sql_query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($sql_query);
    $balance = $result['acct_balance'] + $amount;

    //acct balance update query
    $sql_balance_update = "UPDATE accounts SET acct_balance='$balance' WHERE acct_id='$acct'";
    $sql_balance_update_query = mysqli_query($conn, $sql_balance_update);

    if(!$sql_balance_update_query){
        return false;
    }else{
         return true;
    }
}


//use to record transaction deposit/withdraw 
function transaction_recorder($acct,$amount,$status,$date,$user){
    global $conn;
    date_default_timezone_set("Africa/lagos") ;
    $time = date("h:i:sa");

    $sql = "INSERT INTO transactions(acct_id,amount,status,date_of_tran,timeline,collector) 
    VALUES('$acct','$amount','$status','$date','$time','$user')";
    $sql_query = mysqli_query($conn, $sql);
      
      if(!$sql_query){
        return false;
      }else{
         return true;
      }
}


//use to record deposit in month_table eg.. sep day1 [1] 1 mean deposited for the day 
function month_deposite_day_recorder($acct,$amount){
    global $conn;

date_default_timezone_set("Africa/lagos") ;
$date_array = date_parse(date("d-M-Y"));
$current_month = strtolower(date('M'));
$current_day = "day".$date_array['day'];



 if($current_month==='dec'){
  $current_month = 'decem';
 }


    $sql_update = "UPDATE $current_month SET  $current_day='1' WHERE acct_id='$acct'";
    $sql_update_query = mysqli_query($conn, $sql_update);
    if(!$sql_update_query){
    return false;
    }else{
    return true;
    }

        
}


//use to return acct balance name base on svn and acct 
function acct_balance($svn, $acct){
    global $conn;

    $sql = "SELECT acct_balance FROM accounts WHERE svn='$svn' AND acct_id='$acct'";
    $sql_query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($sql_query);

    return $result['acct_balance'];
}

//use to check if acct have deposited for 7days to perform withdraw
function withdraw_days_validator($acct){

    global $conn;

    $sql = "SELECT acct_type, acct_balance FROM accounts WHERE acct_id='$acct'";
    $sql_query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($sql_query);
      
      $acct_type_withdraw = $result['acct_type'] * 7;
      $acct_balance = $result['acct_balance'];

      if($acct_balance < $acct_type_withdraw){
        return false;
      }else{
         
         return true;
      }

      
}
function withdraw_amount_validator($acct, $amount){
     global $conn;

    $sql = "SELECT acct_type, acct_balance FROM accounts WHERE acct_id='$acct'";
    $sql_query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($sql_query);
      
      $acct_balance = $result['acct_balance'];
         
      $withdraw = $acct_balance - $amount;

     if($withdraw ==0 || $withdraw < 0){
        return false;
     }else{
        return true;
     }
  

}
//use to check if acct have a cashout_date to withdraw
function withdraw_date_validator($acct){

    global $conn;
date_default_timezone_set("Africa/lagos"); 
$current_date =  date("d-M-Y"); 

    $sql = "SELECT cashout_date FROM accounts WHERE acct_id='$acct'";
    $sql_query = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($sql_query);
    $result = mysqli_fetch_assoc($sql_query);
      


      if(empty($result['cashout_date'])){
        return false;
      }else{
        $d = strtotime($result['cashout_date']);
        $cashout_date =date("d-M-Y",$d);
         if($cashout_date === $current_date){
            //acct balance update query
            $sql_balance_update = "UPDATE accounts SET cashout_date='' WHERE acct_id='$acct'";
            $sql_balance_update_query = mysqli_query($conn, $sql_balance_update);
             return false;
          }else{
             return true;
          }
      }
     

      
}


//use to update acct balance base on what user withdraw
function withdraw_balance_update($acct, $amount){
 global $conn;
    $sql = "SELECT acct_balance FROM accounts WHERE acct_id='$acct'";
    $sql_query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($sql_query);
    $balance = $result['acct_balance'] - $amount;

    //acct balance update query
    $sql_balance_update = "UPDATE accounts SET acct_balance='$balance' WHERE acct_id='$acct'";
    $sql_balance_update_query = mysqli_query($conn, $sql_balance_update);

    if(!$sql_balance_update_query){
        return false;
    }else{
         return true;
    }
}

//use to delete account from month tables
function delete_acct_in_month($acct){
    global $conn;
    $months_names = ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','decem'];

    foreach ($months_names as $month_name){
        $sql = "DELETE FROM $month_name  WHERE acct_id='$acct'";
        $sql_query = mysqli_query($conn, $sql);
    }

}
?>