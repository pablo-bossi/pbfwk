<?php
/**
* This is the main page for the fwk, all dynamic requests goes through this page.
* The flow for the framework is:
*   1- Instantiatie Router class which checks the url pattern and returns the info to instantiate proper controller
*   2- Response object is created (The fwk works populating the Response object and always renders the response)
*   3- Instantiate the controller which receives the Response object as a parameters
*   4- Calls to initialize method for the controller (This method is used execute commands needed before any action)
*   5- Call the controller method which executes the requested action, this method always receives the request as a parameters
*   6- Call the finalize method for the controlle (This methos is used for executing commands after every action, for example closing all DB connections)
*   7- Render the response
* The flow is also in a try catch sentence so every exception can be trapped at this level
*/
session_start();

require "constants/constants.php";
require "config/urlmanagerconf.php";
require "config/i18n.php";
require "fwk/autoloader.php";
require "fwk/i18n.php";

spl_autoload_register('fwk\Fwk_Autoloader::Loader');

try {
  if (! empty($localeManager)) {
    $localizationManager = new $localeManager($defaultLocale);
  } else {
    $localizationManager = null;
  }

  \fwk\Fwk_I18N::setup($validLocales, $defaultLocale, $translationDomains, $localizationManager);
  \fwk\Fwk_I18N::set();
  
  $router = new fwk\Fwk_Router($_SERVER["REQUEST_URI"], $urlPatterns, $_SERVER["DOCUMENT_ROOT"].'/controllers', $_REQUEST);
  
  $file       = $router->controllerFile;
  $className  = $router->className;
  $method     = $router->action;
  $params     = $router->params;

  include($file);
  //TODO config to read parameters required to construct or run each class (like dependency injection)
  $response = new fwk\Fwk_Response();
  $class = new $className($response);

  $result = $class->initialize();
  if ($result) {
    $class->$method($params);
  }
  $class->finalize();
  
  echo $response->render();
  
} catch (Exception $ex) {
  $response = new fwk\Fwk_Response();
  $response->setResponseCode("200");
  $response->setHeader("Content-Type", "text/html; charset=utf-8");
  $response->setBody($ex->getMessage());
  echo $response->render();
}