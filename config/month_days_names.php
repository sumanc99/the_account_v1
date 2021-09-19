<?php

$date =  date("d-M-Y"); 
$date_array = date_parse($date);
$current_month = $date_array['month'];
$months_names = [1=>'jan', 2=>'feb', 3=>'mar', 4=>'apr', 5=>'may', 6=>'jun', 7=>'jul', 8=>'aug', 9=>'sep', 10=>'oct', 11=>'nov', 12=>'dec'];
$months_days = [1=>31, 2=>28, 3=>31, 4=>30, 5=>31, 6=>30, 7=>31, 8=>31, 9=>30, 10=>31, 11=>30, 12=>31];

?>