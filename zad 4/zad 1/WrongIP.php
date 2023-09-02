<?php declare(strict_types=1); // włączenie typowania zmiennych w PHP >=7
session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <title>Kobyliński</title>
</head>
<BODY>
Twoje IP nie jest polskie!!! Za 5 sekund zostaniesz wylogowany
<?php

header( "refresh:5;url=logout.php" );
?>

</BODY>
</HTML>