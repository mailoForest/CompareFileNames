<?php
/**
 * Created by PhpStorm.
 * User: Dev-1
 * Date: 16.2.2017 г.
 * Time: 09:41 ч.
 */
    $msgUnsetFile = '';
    $msgUnexist1 = '';
    $msgUnexist2 = '';
    $msg = '';
    $filesUnequal = false;
    $file1 = '';
    $file2 = '';

    if (isset($_POST['submit'])){
        $file1 = $_POST['file1'];
        $file2 = $_POST['file2'];

        if ($file1 !== '' && $file2 !== ''){

            if (file_exists($file1) && file_exists($file2)){
                if (filesize($file1) === filesize($file2)){
                    $handle1 = fopen($file1, 'r');
                    $handle2 = fopen($file2, 'r');
                    //open files

                     while(!feof($handle1)){
                         $line1 = fgets($handle1);
                         $line2 = fgets($handle2);

                         if ($line1 !== $line2){
                             $msg = 'Files are not identical. Different chars found!';
                             $filesUnequal = true;
                             break;
                         }
                     }
                    if (!$filesUnequal) {
                        $msg = "Files are equal! :)";
                    }

                    //close files
                    fclose($handle1);
                    fclose($handle2);
                } else {
                    $msg = 'Files are not identical. Different size.';
                }
            }
            $msgUnexist1 = file_exists($file1) ? '' : "File $file1 doesn't exist!<br/>";
            $msgUnexist2 = file_exists($file2) ? '' : "File $file2 doesn't exist!<br/>";
        } else {
            $msgUnsetFile = 'Not given name of file.';
        }
    }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Compare Files</title>
    <style>
        output{
            font-size: 1.5em;
            font-weight: bold;
            color: #9b6600;
        }
    </style>
</head>
<body>
<fieldset>
    <legend>Compare The Files</legend>
    <form action="./compare-files.php" method="post">
        <label for="file1">1st file: </label><input type="text" name="file1" id="file1" value="<?=$file1?>"><br>
        <label for="file2">2nd file: </label><input type="text" name="file2" id="file2" value="<?=$file2?>"><br>
        <input type="submit" name="submit" value="Compare">
    </form>
    <output><?=$msg?></output>
    <output><?=$msgUnsetFile?></output>
    <output><?=$msgUnexist1?></output>
    <output><?=$msgUnexist2?></output>
</fieldset>
</body>
</html>
