<?php
// Config data
$datas = fopen('../.config', 'rb');

$sys = '<?php ';
$sys .= "\r";
$sys .= '#Environnement';
while(!feof($datas)){
    $ligne = fgets($datas);
    if(!strpos($ligne, '#')){
        $name = strstr($ligne, '=', true);
        $value = substr(strstr($ligne, '='), 1);
        $value = trim($value, $characters = " \t\n\r\0\x0B");
        if($name){
            $sys .= "\r";
            $sys .= "define('$name', '$value');";
        }
    }
}

file_put_contents('../config/env.php', $sys);

fclose($datas);
