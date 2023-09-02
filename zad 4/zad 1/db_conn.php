<?php

$sname= "mysql8";
$uname= "00888236_z4";
$password = "eMW2iRKD";

$db_name = "00888236_z4";

$connection= mysqli_connect($sname, $uname, $password, $db_name);

if (!$connection) {
	echo "Connection failed!";
}