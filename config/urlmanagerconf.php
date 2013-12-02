<?php

/**
* This file is used to configure friendly urls to be handled on the Fwk_Router class, mapping urls into controllers
* @example: array('pattern' => [regexp to match against the uri], 'handlerFile' => [Path to the class handling the request], 'handlerClass' => [Name of the controller class including the namespace], 'handlerMethod' => [Method to handle the request])
*/
$urlPatters = array();

$urlPatterns[] = array('pattern' => '/\//' ,'handlerFile' => __DIR__.'/../controllers/main.php', 'handlerClass' => 'controllers\Controllers_main', 'handlerMethod' => 'index');
