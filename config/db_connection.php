<?php

$conn;

$conn = mysqli_connect("localhost","root","", "the_account_v1");

 if(!$conn){
   echo "Connection Error".mysqli_connect_error();
 }

 date_default_timezone_set("Africa/lagos");

?>