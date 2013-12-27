<?php
namespace controllers;

use fwk as Fwk;
use models as Models;

class Controllers_main extends Fwk\Fwk_Controller {

  public function index($params) {

    $viewName = "index";
    $view = new Fwk\Fwk_View($viewName);

    $view->message = _('Hello World');
    
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }
  
  public function jsvalidators($params) {
    $viewName = "validationtest";
    $view = new Fwk\Fwk_View($viewName);
  
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }
  
  public function testphpvalidators($params) {
    $isValid = true;
   
    //Check every validators
    $validator1 = new \fwk\validators\Fwk_Validators_Validate('requiredText1', '');
    $error = $validator1->validate(new fwk\validators\Fwk_Validators_Required())->isValid();
    $isValid = ($isValid && $error);

    $validator2 = new \fwk\validators\Fwk_Validators_Validate('requiredText2', 'aa');
    $error = $validator2->validate(new fwk\validators\Fwk_Validators_Required())->validate(new fwk\validators\Fwk_Validators_Number())->isValid();
    $isValid = $isValid && $error;

    $validator3 = new \fwk\validators\Fwk_Validators_Validate('requiredText3', '123.12');
    $error = $validator3->validate(new fwk\validators\Fwk_Validators_Required())->validate(new fwk\validators\Fwk_Validators_Int())->isValid();
    $isValid = $isValid && $error;
    
    $validator4 = new \fwk\validators\Fwk_Validators_Validate('requiredText4', '3');
    $error = $validator4->validate(new fwk\validators\Fwk_Validators_Required())->validate(new fwk\validators\Fwk_Validators_NumberRange(array('min' => 5, 'max' => 10)))->isValid();
    $isValid = $isValid && $error;

    $validator5 = new \fwk\validators\Fwk_Validators_Validate('requiredText5', 'Hola');
    $error = $validator5->validate(new fwk\validators\Fwk_Validators_Required())->validate(new fwk\validators\Fwk_Validators_TextLength(array('min' => 5, 'max' => 10)))->isValid();
    $isValid = $isValid && $error;

    $validator6 = new \fwk\validators\Fwk_Validators_Validate('requiredText6', 'dada#<@fwefih');
    $error = $validator6->validate(new fwk\validators\Fwk_Validators_Required())->validate(new fwk\validators\Fwk_Validators_Email())->isValid();
    $isValid = $isValid && $error;

    $validator7 = new \fwk\validators\Fwk_Validators_Validate('requiredText7', 'foo');
    $error = $validator7->validate(new fwk\validators\Fwk_Validators_Required())->validate(new fwk\validators\Fwk_Validators_Regexp(fwk\validators\Fwk_Validators_Regexp::MATCH, '/[0-9]+/'))->isValid();
    $isValid = $isValid && $error;

    $validator8 = new \fwk\validators\Fwk_Validators_Validate('requiredText8', 'foo5343');
    $error = $validator8->validate(new fwk\validators\Fwk_Validators_Required())->validate(new fwk\validators\Fwk_Validators_Regexp(fwk\validators\Fwk_Validators_Regexp::NOT_MATCH, '/[0-9]+/'))->isValid();
    $isValid = $isValid && $error;
    
    $validator9 = new \fwk\validators\Fwk_Validators_Validate('requiredText9', 'Holas');
    $error = $validator9->validate(new fwk\validators\Fwk_Validators_Required())->validate(new fwk\validators\Fwk_Validators_Catalog(array('Hola', 'Chau')))->isValid();
    $isValid = $isValid && $error;
    
    $errorMsg = "";
    if (! $isValid) {
      $errorMsg = $validator1->getErrors();
      $errorMsg .= $validator2->getErrors();
      $errorMsg .= $validator3->getErrors();
      $errorMsg .= $validator4->getErrors();
      $errorMsg .= $validator5->getErrors();
      $errorMsg .= $validator6->getErrors();
      $errorMsg .= $validator7->getErrors();
      $errorMsg .= $validator8->getErrors();
      $errorMsg .= $validator9->getErrors();
    }
    
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody('<html><body>'.str_replace(PHP_EOL, '<br />', $errorMsg).'</body></html>');
  }
  
  public function modelExample($params) {
    $example = new \Models\Models_Example();
    $data = array(
      'user_id' => '1',
      'username' => 'dummy',
      'email_address' => 'dummy@mailcatch.com',
      'active' => '1',
      'access_level' => '1',
    );
    $example->fillData($data);
    $example->dummy = 'dummyVal';
  
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody('<html><body>'._('Hello World').'</body></html>');
  }
  
}