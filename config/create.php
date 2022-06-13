<?php
//Config data
$datas = fopen('../.config', 'rb');

while(!feof($datas)){
    $ligne = fgets($datas);
    if(!strpos($ligne, '#') || !strpos($ligne, '  ')){
        $name = strstr($ligne, '=', true);
        $value = substr(strstr($ligne, '='), 1);
        define(''.$name.'', ''.$value.'');
        // echo $name .' <br>';
        // echo $value .' <br>';
    }
}

fclose($datas);