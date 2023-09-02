<?php declare(strict_types=1); // włączenie typowania zmiennych w PHP >=7
session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
include "db_conn.php";
if (!isset($_SESSION['loggedin'])) {
    header('Location: index5.php');
    exit();
} else {

}

ini_set('display_errors', "1");
$ipaddress = $_SERVER["REMOTE_ADDR"];
$result = mysqli_query($connection, "Select datetime from break_ins where ip='$ipaddress' and seen='0'") or die("DB error: $dbname");
if (mysqli_num_rows($result) != 0) {
    echo "<div style='color:red'> na podanym ip: " . $ipaddress . " próbowano się włamać do pewnych kont o godzinach:<br>";
    while ($row = mysqli_fetch_array($result)) {
        echo $row[0] . "<br>";

    }
    echo "</div>";

    $result = mysqli_query($connection, "update break_ins set seen='1' where ip='$ipaddress' and seen='0' ") or die("DB error: $dbname");

}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Kobyliński</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    </link>
</head>

<body>
    <script>
        function enlarge(element) {
            if (element.style.height > '140px') {
                element.style.height = '100px';
                element.style.width = '100px';
            }
            else {
                element.style.height = '200px';
                element.style.width = '200px';
            }

        }
    </script>
    <div class="left">

        <form method="post" action="add.php" enctype="multipart/form-data">
            Nick:
            <?php echo $_SESSION['user'] ?>
            <div class="image-upload">
                <label for="file-input">
                    <img style="height:70px;width:80px;" src="upload.png" />
                </label>


                <input type="file" name="fileToUpload" id="file-input"><br>
            </div>

            <?php





            ?>
            <input type="submit" value="Send" name="submit" />
        </form>
        <?php
        $target_dir = $_SESSION['user'];



        function formatSizeUnits($bytes)
        {
            if ($bytes >= 1073741824) {
                $bytes = number_format($bytes / 1073741824, 2) . ' GB';
            } elseif ($bytes >= 1048576) {
                $bytes = number_format($bytes / 1048576, 2) . ' MB';
            } elseif ($bytes >= 1024) {
                $bytes = number_format($bytes / 1024, 2) . ' KB';
            } elseif ($bytes > 1) {
                $bytes = $bytes . ' bytes';
            } elseif ($bytes == 1) {
                $bytes = $bytes . ' byte';
            } else {
                $bytes = '0 bytes';
            }

            return $bytes;
        }

        if (isset($_GET['subfolder'])) {
            $target_dir = $target_dir . "/" . $_GET['subfolder'];
            echo "katalog:$target_dir";
            $_SESSION['subfolder'] = $_GET['subfolder'];
        } else {
            unset($_SESSION['subfolder']);
            echo "katalog:$target_dir";
        }
        echo "<br><a href='logout.php'>wyloguj</a>";
        print "<TABLE CELLPADDING=5 BORDER=1 id='MessagesTable'>";
        print "<TR><TD>nazwa pliku/folderu</TD><TD>Usuń</TD><TD>Data</TD><TD>Rozmiar</TD><TD>Podgląd</TD></TR>\n";
        if (is_dir($target_dir)) {
            if ($dir_open = opendir($target_dir)) {
                while ($files = readdir($dir_open)) {
                    if ($files != "." and $files != "..") {
                        $imageFileType = strtolower(pathinfo($target_dir . "/" . $files, PATHINFO_EXTENSION));
                        if ($imageFileType == '') {
                            echo "<TR><TD>$files</TD>
                            <TD><a href='https://hosting2353503.online.pro/zad4/zad1/deleteFile.php?file=$files'><img src='deleteFile.png' style='height:50px;width:50px;hover:pointer;'><a></TD>
                            <TD>" . date("F d Y H:i:s.", filectime($target_dir . "/" . $files)) . "</TD>
                            <TD>" . formatSizeUnits(filesize($target_dir . "/" . $files)) . "</TD>";

                        } else {
                            echo "<TR>
                            <TD><a href='$target_dir/$files'Download='' >" . $files . "</a></TD>
                            <TD><a href='https://hosting2353503.online.pro/zad4/zad1/deleteFile.php?file=$files'><img src='deleteFile.png' style='height:50px;width:50px;hover:pointer;'><a></TD>
                            <TD>" . date("F d Y H:i:s.", filectime($target_dir . "/" . $files)) . "</TD>
                            <TD>" . formatSizeUnits(filesize($target_dir . "/" . $files)) . "</TD>";

                        }



                        echo "<td>";

                        if ($imageFileType == 'jpg' or $imageFileType == 'png' or $imageFileType == 'jpeg' or $imageFileType == 'gif') {
                            print "<img style='width:100px;height:100px;cursor:pointer;' onclick='enlarge(this)' src='https://hosting2353503.online.pro/zad4/zad1/$target_dir/$files' />";
                        } else if ($imageFileType == 'mp4') {
                            print "<video controls width='250'> <source src='https://hosting2353503.online.pro/zad4/zad1/$target_dir/$files' /> </video> ";
                        } else if ($imageFileType == 'wav' or $imageFileType == 'mp3') {
                            print "<figure><audio style='width:250px;margin-left:-30px' controls src='https://hosting2353503.online.pro/zad4/zad1/$target_dir/$files'></audio></figure>";
                        } else if ($imageFileType == '') {
                            echo "<a href='https://hosting2353503.online.pro/zad4/zad1/index1.php?subfolder=$files'>wejdź do podfolderu</a>";
                        } else {
                            echo "podgląd niedostępny";
                        }
                        echo "</td>";
                        print "</TR>\n";
                    }

                    #echo $files . " data:" . "rozmiar" . filesize($target_dir . "/".$files) . "<br>";
                }
            }
        }

        print "</TABLE>";
        ?>
    </div>
    <div class="right">
        <?php
        if ($target_dir == $_SESSION['user']) {
            echo "<a href='https://hosting2353503.online.pro/zad4/zad1/addSubfolder.php'><img src='addFolder.png' style='height:80px;width:80px;hover:pointer;'><a>";
        } else {
            echo "<a href='https://hosting2353503.online.pro/zad4/zad1/index1.php'><img src='upFolder.png' style='height:80px;width:80px;hover:pointer;'><a>";
        }
        ?>


    </div>

</body>

</html>