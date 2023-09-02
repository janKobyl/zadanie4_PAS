<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

<HEAD>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Kobyliński</title>
</HEAD>

<BODY>
   <?php
   ini_set('display_errors', "1");
   $user = htmlentities($_POST['user'], ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $user
   $pass = htmlentities($_POST['pass'], ENT_QUOTES, "UTF-8");
   $ipaddress = $_SERVER["REMOTE_ADDR"];
   include "db_conn.php";


   if (!$connection) {
      echo "Błąd: " . mysqli_connect_errno() . " " . mysqli_connect_error();
   } // obsługa błędu połączenia z BD
   mysqli_query($connection, "SET NAMES 'utf8'"); // ustawienie polskich znaków
   $result = mysqli_query($connection, "SELECT * FROM users WHERE username='$user'"); // wiersza, w którym login=login z formularza
   $rekord = mysqli_fetch_array($result); // wiersza z BD, struktura zmiennej jak w BD
   session_start();
   if (isset($_SESSION['FaultTimer']) == false) {

      $_SESSION['FaultTimer'] = 0;
   }

   function CheckFaultTimer($connection, $ipaddress)
   {

      if ($_SESSION['FaultTimer'] > 2) {
         
         if (isset($_SESSION['locked'])) {
            $_SESSION['difference'] = time() - $_SESSION['locked'];
         } else {
            $result = mysqli_query($connection, "insert break_ins (ip, seen) values('$ipaddress', 0) ");
            $_SESSION['locked'] = time();
            $_SESSION['difference'] = time() - $_SESSION['locked'];
         }
      }
   }
   if (!$rekord) //Jeśli brak, to nie ma użytkownika o podanym loginie
   {
      
      $_SESSION['FaultTimer'] += 1;
      CheckFaultTimer($connection, $ipaddress);
      mysqli_close($connection); // zamknięcie połączenia z BD
      header("Location: index3.php");
   } else { // jeśli $rekord istnieje
      if ($rekord['password'] == $pass) // czy hasło zgadza się z BD
      {

         $_SESSION['difference'] = time() - $_SESSION['locked'];
         if ($_SESSION['difference'] < 30) {
            header("Location: index3.php");
         } else {
            $_SESSION['loggedin'] = true;
            $_SESSION['user'] = $user;
            $_SESSION['justLoggedIn'] = true;
            unset($_SESSION['FaultTimer']);
            header("Location: index1.php");
         }

      } else {

         
         $_SESSION['FaultTimer'] += 1;
         
         CheckFaultTimer($connection, $ipaddress);
         mysqli_close($connection); // zamknięcie połączenia z BD
         header("Location: index3.php");

      }
   }
   ?>
</BODY>

</HTML>