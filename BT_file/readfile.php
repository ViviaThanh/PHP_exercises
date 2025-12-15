<?php 
$file = fopen ('data.txt','r');


echo filesize('data.txt') . "<br>";
echo fread($file,filesize('data.txt')) ."<br>";
//echo file_get_contents($file); // k an toàn đọc ghi file


/*while (!feof ($file)){
    echo fgets($file);
    echo'<br>';
}*/

/*
$txt1 = " new content 1". "<br>";
fwrite($file,$txt1);
$txt2 = "new content 2". "<br>";
fwrite($file,$txt2);
echo "complete";
*/

fclose ($file);
?>