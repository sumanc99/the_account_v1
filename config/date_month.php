<?php date_default_timezone_set("Africa/lagos"); 

$date =  date("d-M-Y"); 
$date_array = date_parse($date);
$current_month = $date_array['month'];

$month = strtolower(date('M'));
$months_names = [1=>'jan', 2=>'feb', 3=>'mar', 4=>'apr', 5=>'may', 6=>'jun', 7=>'jul', 8=>'aug', 9=>'sep', 10=>'oct', 11=>'nov', 12=>'dec'];
$months_days = [ 'jan'=>31,'feb'=>28,'mar'=>31,'apr'=>30,'may'=>31,'jun'=>30,'jul'=>31,'aug'=>31,'sep'=>30,'oct'=>31,'nov'=>30,'dec'=>31];







?>