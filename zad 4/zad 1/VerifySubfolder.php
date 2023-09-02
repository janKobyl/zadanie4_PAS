<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

<HEAD>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title>Kobyliński</title>
</HEAD>

<BODY>
    <?php
    session_start();
ini_set('display_errors', "1");
    $SubfolderName = htmlentities($_POST['SubfolderName'], ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $user
    $user = htmlentities($_SESSION['user'], ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $user
   
    $match = 0;
    
    if (preg_match("/^[A-Za-z0-9_]{3,20}$/", $SubfolderName)) {
        $match = 1;
    } 

    if ($match == 1) {
        
        if (!file_exists($user."/".$SubfolderName)) {
            mkdir($user."/".$SubfolderName, 0777, true);
            header("Location: index1.php");
        }
        else{
            header("Location: addSubfolder.php?error=podana nazwa katalogu już istnieje!!!");
        }
        
    }
    
    
    if ($match == 0) {
       # echo "<script>alert('Podano różne hasła')</script>";
      
        header("Location: addSubfolder.php?error=podana nazwa katalogu nie zgadza się z zasadami poprawnej nazwy katalogu. Najedź na zasady, aby je przeczytać!!!");

    }
    
   





    ?>
</BODY>

</HTML>