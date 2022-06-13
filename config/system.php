<?php

//CORS POLICY
header("Access-Control-Allow-Origin: *");

//Resources directory path
define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
define('ASSETS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR . '../ressources' . DIRECTORY_SEPARATOR);

define('CSS', ASSETS . 'css' . DIRECTORY_SEPARATOR . 'app.css');
define('JS', ASSETS . 'js' . DIRECTORY_SEPARATOR . 'app.js');
define('MEDIA', ASSETS . 'media' . DIRECTORY_SEPARATOR);

//Environnement
