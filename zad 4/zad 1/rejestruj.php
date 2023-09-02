<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <title>Kobyliński</title>
</head>
<BODY>
Formularz logowania
<form method="post" action="adduser.php">
 Login:<input type="text" name="user" minlength="3" maxlength="20" size="20"><br>
 Hasło:<input type="password" name="pass"  maxlength="20" size="20"><br>
 Powtórz Hasło:<input type="password" name="pass_confirm" maxlength="20" size="20"><br>
 <input type="submit" value="Send"/>
 <?php
 echo "<br><div style='color:red;'>".$_GET['error']."</div>";
 ?>
 <u style="cursor: pointer;" title="Podany login nie może być krótszy niż 3 znaki i nie dłuższy niż 20 znaków i nie może zawierać znaków specjalnych jak @#$ (poza _ )">zasady loginu</u>
</form>
</BODY>
</HTML>