<?php

/**
* This file is used to configure friendly urls to be handled on the Fwk_Router class, mapping urls into controllers
* @example: array('pattern' => [regexp to match against the uri], 'handlerFile' => [Path to the class handling the request], 'handlerClass' => [Name of the controller class including the namespace], 'handlerMethod' => [Method to handle the request])
*/
$urlPatters = array();

$urlPatterns[] = array('pattern' => '/\/jsvalidators/' ,'handlerFile' => __DIR__.'/../controllers/main.php', 'handlerClass' => 'controllers\Controllers_main', 'handlerMethod' => 'jsvalidators');
$urlPatterns[] = array('pattern' => '/\/phpvalidators/' ,'handlerFile' => __DIR__.'/../controllers/main.php', 'handlerClass' => 'controllers\Controllers_main', 'handlerMethod' => 'testphpvalidators');
$urlPatterns[] = array('pattern' => '/\/models/' ,'handlerFile' => __DIR__.'/../controllers/main.php', 'handlerClass' => 'controllers\Controllers_main', 'handlerMethod' => 'modelExample');
$urlPatterns[] = array('pattern' => '/\//' ,'handlerFile' => __DIR__.'/../controllers/main.php', 'handlerClass' => 'controllers\Controllers_main', 'handlerMethod' => 'index');

/**
* Files included in the array staticContentPaths will we rendered as they are without exceuting actions
*
*/
$staticContentPaths = array();
$staticContentPaths[] = '/templates/';
$staticContentPaths[] = '/js/';
$staticContentPaths[] = '/css/';