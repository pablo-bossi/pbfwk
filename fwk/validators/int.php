<?php

namespace fwk\validators;

class Fwk_Validators_Int extends Fwk_Validators_Base {

  public function validate($field, $value) {
    if (! empty($value) && ($value != '')) {
      if ((! is_numeric($value)) || (is_numeric($value) && (floatval($value) != intval($value)))) {
        throw new \fwk\exceptions\Fwk_Exceptions_InvalidInput($field.' should be a valid int');
      }
    }
    return true;
  }
}

?>