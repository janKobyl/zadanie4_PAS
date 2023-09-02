<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

<HEAD>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title>Kobyliński</title>
</HEAD>

<BODY>
    <?php
    include "db_conn.php";
    ini_set('display_errors', "1");
    $user = htmlentities($_POST['user'], ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $user
    $pass = htmlentities($_POST['pass'], ENT_QUOTES, "UTF-8");
    $pass_confirm = htmlentities($_POST['pass_confirm'], ENT_QUOTES, "UTF-8");
    $match = 0;
    $result = mysqli_query($connection, "select username from users where username='$user' ");
    $rekord = mysqli_fetch_array($result);
    if (!$rekord) //Jeśli brak, to nie ma użytkownika o podanym loginie
   {
      
    if (!$connection) {
        echo "Błąd: " . mysqli_connect_errno() . " " . mysqli_connect_error();
    } // obsługa błędu połączenia z BD
    mysqli_query($connection, "SET NAMES 'utf8'"); // ustawienie polskich znaków
    
    if (preg_match("/^[A-Za-z0-9_]{3,20}$/", $user)) {
        $match = 1;
    } 

    if ($pass_confirm == $pass and $match == 1) {
        $result = mysqli_query($connection, "INSERT INTO users (username, password) VALUES ('$user', '$pass');");
        if (!file_exists($user)) {
            mkdir($user, 0777, true);
        }
        header("Location: logout.php");
    }
    mysqli_close($connection);
    
    if ($match == 0) {
       # echo "<script>alert('Podano różne hasła')</script>";
      
        header("Location: rejestruj.php?error=podany login nie zgadza się z zasadami poprawnego loginu. Najedź na zasady loginu, aby je przeczytać!!!");

    }
    else if($pass_confirm != $pass){
        header("Location: rejestruj.php?error=podano różne hasła!!!");
    }
      
   } else { // jeśli $rekord istnieje
    header("Location: rejestruj.php?error=podany login istnieje!!!");
   }




   





    ?>
</BODY>

</HTML>