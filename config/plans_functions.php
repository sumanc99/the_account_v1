<?php 
// use for 1day, 2weeks and 1month plans
// function week_day_plan($svn,$acct,$plan){
//     global $conn;

// //use to include names of month and their days
// include("date_month.php");

//     $days_of_month = $months_days[$month];
//     $days_passed = $date_array['day'];
//     $days_remain = ($days_of_month - $days_passed) - $plan;
   



// if($days_remain < 0){
    
//     if($month === 'dec'){
//        $sql ="INSERT INTO decem(svn,acct_id) VALUES('$svn','$acct')";
//        $sql_query = mysqli_query($conn, $sql);
//     }else{
//         $sql ="INSERT INTO $month(svn,acct_id) VALUES('$svn','$acct')";
//         $sql_query = mysqli_query($conn, $sql);
//     }
    
        
//     if(!$sql_query){
//     // echo "erro".mysqli_error($conn);       
//     }else{
//         $next_month = $months_names[$current_month + 1];
//         $days_of_month = $months_days[$next_month];

//         $days_remain_new = ($days_of_month + $days_remain);
//         $day_cash_out = $days_of_month - $days_remain_new;

//          if($month === 'dec'){
//             $sql ="INSERT INTO decem(svn,acct_id) VALUES('$svn','$acct')";
//             $sql_query = mysqli_query($conn, $sql);
//          }else{
//              $sql ="INSERT INTO $next_month(svn,acct_id) VALUES('$svn','$acct')";
//              $sql_query = mysqli_query($conn, $sql);
//          }

//         if(!$sql_query){
//             // echo "erro".mysqli_error($conn);       
//         }else{
//             return $day_cash_out."-".$next_month."-".date('Y');
//         }
//     }
//     }else{

//         $day_cash_out = $days_of_month - $days_remain;

          
//         if($month === 'dec'){
//            $sql ="INSERT INTO decem(svn,acct_id) VALUES('$svn','$acct')";
//            $sql_query = mysqli_query($conn, $sql);
//         }else{
//             $sql ="INSERT INTO $month(svn,acct_id) VALUES('$svn','$acct')";
//             $sql_query = mysqli_query($conn, $sql);
//         }
 
//        if(!$sql_query){
//        // echo "erro".mysqli_error($conn);       
//        }else{
//            return $day_cash_out."-".date("M-Y");
//        }
//     }

// }


// //use for two month plan
// function two_month_plan($svn, $acct){

//     global $conn;
//     $record_table = [];

//     //use to include names of month and their days
//     include("month_days_names.php");
//     $current_month = $date_array['month'];//in number form eg 9..12
    
//     if($current_month ==12){
//             $days_of_months = $months_days[$current_month] + $months_days[1];

//             $plan = $days_of_months;
//             $days_passed = $date_array['day'];
//             $days_remain = ($days_of_months - $days_passed) - $plan;

//             array_push($record_table,$months_names[$current_month]);
//             array_push($record_table, $months_names[1]);
            
            
//             // echo $days_of_months."<br>";

//             if($days_remain < 0){

//                 $new_month = $months_days[2];
//                 $new_month_days_remain = $new_month + ($days_remain);
//                 array_push($record_table, $months_names[2]);
            
//                 if( $new_month_days_remain  < 0){

//                     $new_month_short =   $new_month + ($new_month_days_remain);//that means there is remaining days
//                     $final_month = $months_days[3] -  $new_month_short;
//                     array_push($record_table, $months_names[3]);

//                     foreach ($record_table as $table) {

//                         if($table==='dec'){
//                             $sql ="INSERT INTO decem(svn,acct_id) VALUES('$svn','$acct')";
//                             $sql_query = mysqli_query($conn, $sql);
//                         }else{
//                             $sql ="INSERT INTO $table(svn,acct_id) VALUES('$svn','$acct')";
//                             $sql_query = mysqli_query($conn, $sql);
//                         }
                        
//                     }

//                     return $final_month."-".$months_names[3]."-".date("Y");
//                     // echo  $new_month_days_remain;

                  
            
//                 }else{
//                     $cashout_date =   $new_month - ($new_month_days_remain);

//                     foreach ($record_table as $table) {

//                         if($table==='dec'){
//                             $sql ="INSERT INTO decem(svn,acct_id) VALUES('$svn','$acct')";
//                             $sql_query = mysqli_query($conn, $sql);
//                         }else{
//                             $sql ="INSERT INTO $table(svn,acct_id) VALUES('$svn','$acct')";
//                             $sql_query = mysqli_query($conn, $sql);
//                         }
                        
//                     }

//                     return $cashout_date."-".$months_names[2]."-".date("Y");
//                     // echo  $new_month_days_remain;
//                 }
                
//             }


      
    
//     }elseif($current_month ==11){
//         $days_of_months = $months_days[$current_month] + $months_days[$current_month + 1];

//         $plan = $days_of_months;
//         $days_passed = $date_array['day'];
//         $days_remain = ($days_of_months - $days_passed) - $plan;

//         array_push($record_table,$months_names[$current_month]);
//         array_push($record_table, $months_names[$current_month + 1]);
        
        
//         // echo $days_of_months."<br>";

//         if($days_remain < 0){

//             $new_month = $months_days[1];
//             $new_month_days_remain = $new_month + ($days_remain);
//             array_push($record_table, $months_names[1]);
        
//             if( $new_month_days_remain  < 0){

//                 $new_month_short =   $new_month + ($new_month_days_remain);//that means there is remaining days
//                 $final_month = $months_days[2] -  $new_month_short;

//                 array_push($record_table, $months_names[2]);
                
//                 foreach ($record_table as $table) {

//                     if($table==='dec'){
//                         $sql ="INSERT INTO decem(svn,acct_id) VALUES('$svn','$acct')";
//                         $sql_query = mysqli_query($conn, $sql);
//                     }else{
//                         $sql ="INSERT INTO $table(svn,acct_id) VALUES('$svn','$acct')";
//                         $sql_query = mysqli_query($conn, $sql);
//                     }
                    
//                 }

//                 return $final_month."-".$months_names[2]."-".date("Y");
//                 // echo  $new_month_days_remain;

                
        
//             }else{
//                 $cashout_date =   $new_month - ($new_month_days_remain);
                
//                 foreach ($record_table as $table) {

//                     if($table==='dec'){
//                         $sql ="INSERT INTO decem(svn,acct_id) VALUES('$svn','$acct')";
//                         $sql_query = mysqli_query($conn, $sql);
//                     }else{
//                         $sql ="INSERT INTO $table(svn,acct_id) VALUES('$svn','$acct')";
//                         $sql_query = mysqli_query($conn, $sql);
//                     }
                    
//                 }

//                 return $cashout_date."-".$months_names[1]."-".date("Y");
//                 // echo  $new_month_days_remain;
//             }
            
//         }


  

//     }else{
//         $days_of_months = $months_days[$current_month] + $months_days[$current_month + 1];

//         $plan = $days_of_months;
//         $days_passed = $date_array['day'];
//         $days_remain = ($days_of_months - $days_passed) - $plan;

//         array_push($record_table,$months_names[$current_month]);
//         array_push($record_table, $months_names[$current_month + 1]);
        
        
//         // echo $days_of_months."<br>";

//         if($days_remain < 0){

//             $new_month = $months_days[$current_month + 2];
//             $new_month_days_remain = $new_month + ($days_remain);
//             array_push($record_table, $months_names[$current_month + 2]);
        
//             if( $new_month_days_remain  < 0){

//                 $new_month_short =   $new_month + ($new_month_days_remain);//thats means there is reamining days
//                 $final_month = $months_days[$current_month + 3] -  $new_month_short;
//                 array_push($record_table, $months_names[$current_month + 3]);
                
//                 foreach ($record_table as $table) {

//                     if($table==='dec'){
//                         $sql ="INSERT INTO decem(svn,acct_id) VALUES('$svn','$acct')";
//                         $sql_query = mysqli_query($conn, $sql);
//                     }else{
//                         $sql ="INSERT INTO $table(svn,acct_id) VALUES('$svn','$acct')";
//                         $sql_query = mysqli_query($conn, $sql);
//                     }
                    
//                 }
                
//                 return $final_month."-".$months_names[$current_month + 3]."-".date("Y");
//                 // echo  $new_month_days_remain;

             

        
//             }else{
//                 $cashout_date =   $new_month - ($new_month_days_remain);

//                 foreach ($record_table as $table) {

//                     if($table==='dec'){
//                         $sql ="INSERT INTO decem(svn,acct_id) VALUES('$svn','$acct')";
//                         $sql_query = mysqli_query($conn, $sql);
//                     }else{
//                         $sql ="INSERT INTO $table(svn,acct_id) VALUES('$svn','$acct')";
//                         $sql_query = mysqli_query($conn, $sql);
//                     }
                    
//                 }
                
//                 return $cashout_date."-".$months_names[$current_month + 2]."-".date("Y");
//                 // echo  $new_month_days_remain;
//             }
            
//         }


      
      
//     }
    


 
// }


























 ?>