<?php

function clean($string) {
   $string = str_replace('-', ' ', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string);// Removes special chars.
}

date_default_timezone_set("Asia/Manila");
//$time = date("");



$nine = strtotime(date("2018-06-15 21:00:00"));

$sam1 = strtotime(date("2018-06-9 19:55:30"));//convert to unix
$sam2 = strtotime(date("123:10:00:00"));

$pen = time() - $sam1;		// get unix and minus current time(unix)
$fin = gmdate("z:H:i:s",$pen);//convert

$backtime = strtotime(date("2018-07-07 10:52:40"));

$back = strtotime(date("2018-07-06 21:00:00"));
$logout = strtotime(date("2018-07-07 10:52:40"));

$final = $logout - $back;
$final2 = gmdate("z:H:i:s",$final);

$min = $pen / 60;
$hour = $min / 60;//hours
$penal = $hour * 24;//hours
$min2 = $penal * 60; 
$sec2 = $min2 * 60; 
//$sec2 =2127024;
//$finsec = $pen - $sec2;

//$dtF = new \DateTime('@0');
//$dtT = new \DateTime("@$sec2");
//$time2 = $dtF->diff($dtT)->format('%a:%h:%i:%s');
$time2 = gmdate("z:H:i:s",$sec2);

echo"current date:".date("z-Y-m-d H:i:s");
echo"<br>";echo"<br>";

echo"current time:".time();
echo"<br>";echo"<br>";

/* echo"time1:".$pen;
echo"<br>";echo"<br>";

echo"converted:".$fin;
echo"<br>";echo"<br>";

echo"minutes:".$min;
echo"<br>";echo"<br>";

echo"penal:".$penal;
echo"<br>";echo"<br>";

echo"days:".$time2;
echo"<br>";echo"<br>";

echo"nine:".$nine;
echo"<br>";echo"<br>"; */
echo"runpenalty:".$backtime;
echo"<br>";echo"<br>";
echo"finpenalty:".$final;
echo"<br>";echo"<br>";
echo"final:".$final2;

?>