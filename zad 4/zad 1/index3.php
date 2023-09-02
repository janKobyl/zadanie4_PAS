<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Kobyliński</title>
</head>

<BODY>

    Formularz logowania
    <form method="post" action="weryfikuj3.php">
        Login:<input type="text" name="user" maxlength="20" size="20"><br>
        Hasło:<input type="password" name="pass" maxlength="20" size="20"><br>
        <input type="submit" id="submicik" value="Send" />

    </form>
    <a href="index5.php">wróc</a><br>
    <?php
ini_set('display_errors',"1");
    //wiadomość o tym ile zostało czasu do kolejnej próby
    //aktualizuje się tylko przy submitowaniu

    session_start();
    if (isset($_SESSION['locked']) and $_SESSION['FaultTimer']>2) {

        if (isset($_SESSION['difference'])) {
            if ($_SESSION['difference'] < 30) {
                echo "poczekaj ". (30-$_SESSION['difference'])." sekund<br>";
            } else{
                echo "możesz się zalogować<br>";
                unset($_SESSION['difference']);
                unset($_SESSION['locked']);
                unset($_SESSION['FaultTimer']);
            }
        }


    }
    if (isset($_SESSION['FaultTimer'])){
        if ($_SESSION['FaultTimer']>2){
            echo "Przekroczono ilość błędnych prób<br>";
        }
        else{
            echo "Ilość błędnych prób:".$_SESSION['FaultTimer']."<br>";
        }
        
        
    }
    
    ?>
</BODY>

</HTML>