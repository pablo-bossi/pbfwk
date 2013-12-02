<?php
namespace controllers;

use fwk as Fwk;
use models as Models;

class Controllers_main extends Fwk\Fwk_Controller {

  public function index($params) {

    $viewName = "index";
    $view = new Fwk\Fwk_View($viewName);

    $view->message = 'Hello World';
    
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }
}