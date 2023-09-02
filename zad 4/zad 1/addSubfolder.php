<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <title>Kobyliński</title>
</head>
<BODY>

<form method="post" action="VerifySubfolder.php">
 Nazwa podkatalogu:<input type="text" name="SubfolderName" minlength="3" maxlength="20" size="20"><br>
 <input type="submit" value="Send"/>
 <?php
 echo "<br><a href='https://hosting2353503.online.pro/zad4/zad1/index1.php' >Anuluj</a>";
 echo "<br><div style='color:red;'>".$_GET['error']."</div>";
 ?>

 <u style="cursor: pointer;" title="Podana nazwa podfolderu nie może być krótsza niż 3 znaki i nie dłuższa niż 20 znaków oraz nie może zawierać znaków specjalnych jak @#$ (poza _ )">zasady nazwy podfolderu</u>
</form>
</BODY>
</HTML>