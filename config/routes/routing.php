<?php

use Router\Router;
use Config\common\Exceptions\NotFoundException;

$router = new Router($_GET['url']);
$directories = ['auth','app', 'config/common'];
foreach ($directories as $directory) {
    
    $directory = '../' . $directory . '/Routes';
    
    $router->getRoutes($directory);
}

try {
    $router->run();
} catch (NotFoundException $e) {
    return $e->error404();
}
