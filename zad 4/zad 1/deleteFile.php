<?php

ini_set('display_errors',"1");

session_start();

if(isset($_SESSION['user'])){
    $user =  $_SESSION['user'];
}
else{
    header('Location: logout.php');
}
if (isset($_SESSION['subfolder'])){
    $subfolder=$_SESSION['subfolder'];
}
else{
    $subfolder='';
}

if (isset($_GET['file'])){
$file=$_GET['file'];
}
else{
    echo "błąd pobrania nazwy pliku";
    if($subfolder==''){
            
        header("refresh:5;url=index1.php");
       }
       else{
        
        header("refresh:5;url=index1.php?subfolder=$subfolder");
       
       }
}

$target_dir = $user;
if ($subfolder!="") {
    $target_dir = $target_dir . "/" . $subfolder;
    echo "// katalog:$target_dir";
    $_SESSION['subfolder'] = $subfolder;
} else {
    unset($_SESSION['subfolder']);
    echo "//  katalog :$target_dir";
}


$imageFileType = strtolower(pathinfo($target_dir . "/" . $file, PATHINFO_EXTENSION));
echo "<br>// ".$imageFileType;
echo "<br>// ".$file;
echo "<br>// ".$target_dir;
$target_file=$target_dir."/".$file;
if ($imageFileType!=""){
    unlink($target_file);
    
    if($subfolder==""){
        header ('Location: index1.php');
       }
       else{
        
        header("Location:index1.php?subfolder=$subfolder");
       
       }
}
else{
    $dirEmpty= (count(glob("$target_file/*")) === 0) ? 'Empty' : 'Not empty';
    if($dirEmpty=="Empty"){
        rmdir($target_file);
        if($subfolder==""){
            header ('Location: index1.php');
           }
           else{
            
            header("Location:index1.php?subfolder=$subfolder");
           
           }
    }
    else{
        echo "<br>"."Katalog nie jest pusty, usuń jego zawartość w celu usunięcia katalogu";
        if($subfolder==""){
            header ('refresh:5;url=index1.php');
           }
           else{
            
            header("refresh:5;url=index1.php?subfolder=$subfolder");
           
           }
    }
    
}
/*
$fileToUpload = $_FILES['fileToUpload']['name'];
$fileEmpty = 0;
if ($fileToUpload == "") {
    $fileEmpty = 1;
}

if (isset($_POST['post'])) {
    
   
    if (!$connection) {
        echo " MySQL Connection error." . PHP_EOL;
        echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }

}
?>

<?php
   $basename=str_replace("'","`",basename($_FILES["fileToUpload"]["name"]));
 
    if($subfolder==""){
        $target_file = "$user/".$basename."";
    }
    else{
        $target_file = "$user/$subfolder/".$basename."";
    }
   
   
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    echo $subfolder." sub<br>";
    echo $target_file."<br>";
    echo htmlspecialchars($basename)."<br>";
    // Check if file already exists
    if ((file_exists($target_file)) ) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 50000000 and $fileEmpty == 0) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "mp4" && $imageFileType != "mp3" && $imageFileType != "wav") {


        echo "Sorry, only JPG, JPEG, PNG, GIF, MP3, MP4, WAV files are allowed.";
        $uploadOk = 0;
    }

    // Check if image file is a actual image or fake image
    if ($imageFileType == "jpg" or $imageFileType == "png" or $imageFileType == "jpeg" or $imageFileType == "gif" && $imageFileType) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        if($subfolder==""){
            
            header("refresh:5;url=index1.php");
           }
           else{
            
            header("refresh:5;url=index1.php?subfolder=$subfolder");
           
           }
        
        
    } else
    // if everything is ok, try to upload file
    {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars($basename) . " has been uploaded.";
           if($subfolder==""){
           
            header('Location: index1.php');
            
           }
           else{
            
            header('Location: index1.php?subfolder='.$subfolder);
           }
            

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }



#header ('Location: index1.php');
#header( "refresh:5;url=admin.php" );
*/
?>