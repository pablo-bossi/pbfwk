<?php
namespace fwk\validators;

class Fwk_Validators_Validate
{
  private $field;
  private $value;
  private $errorMessage;
  private $success = true;

  public function __construct($field, $value) {
    $this->field = $field;
    $this->value = $value;
    $this->errorMessage = '';
  }

  public function validate($validator) {
    try {
      $validator->validate($this->field, $this->value);
    } catch (\Exception $ex) {
      $this->errorMessage .= "- ".$ex->getMessage()."\n";
      $this->success = false;
    }
    return $this;
  }
  
  public function isValid() {
    return $this->success;
  }
  
  public function getErrors() {
    return $this->errorMessage;
  }
}
?>