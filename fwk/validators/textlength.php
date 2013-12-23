<?php

namespace fwk\validators;

class Fwk_Validators_TextLength extends Fwk_Validators_Base {
  private $min;
  private $max;

  public function __construct($params) {
    $this->min = (isset($params['min'])?$params['min']:null);
    $this->max = (isset($params['max'])?$params['max']:null);
  }

  public function validate($field, $value) {
    //If empty no validation happens (Required validator is for this purpose)
    if ((! empty($value)) && ($value != '')) {
      //If is a valid numeric number check that is inside proper ranges
      $error = '';
      if ((! empty($this->min)) && ($this->min >= strlen($value))) {
        $error = $field.' should be longer than '.$this->min.' characters'.PHP_EOL;
      }
      if ((! empty($this->max)) && ($this->max <= strlen($value))) {
        $error = $field.' should be shorter than '.$this->max.' characters'.PHP_EOL;
      }
      if ($error != '') {
        throw new \fwk\exceptions\Fwk_Exceptions_InvalidInput($error);
      }
    }
    return true;
  }
}

?>