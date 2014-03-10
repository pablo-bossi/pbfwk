<?php
namespace fwk;

/**
* This class is used to deliver static files while keeping the structure of the fwk
* @author Pablo Bossi
*/
class Fwk_StaticFilesRenderer extends Fwk_Controller
{
  public function render($params) {
    try {
      ob_start();
      require(strtok($params['viewFile'], '?'));
      $content = ob_get_contents(); 
      ob_end_clean();
      $this->response->setResponseCode("200");
      $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
      $this->response->setBody($content);
    } catch (Exception $ex) {
      $this->response->setResponseCode("404");
      $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
      $this->response->setBody('Requested file ['.strtok($params['viewFile'], '?').'] does not exist. Referer: '.$_SERVER['HTTP_REFERER']);
    }
  }
}
