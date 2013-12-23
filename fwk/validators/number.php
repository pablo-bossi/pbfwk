<?php

namespace fwk\validators;

class Fwk_Validators_Number extends Fwk_Validators_Base {

  public function validate($field, $value) {
    if (! empty($value) && ($value != '')) {
      if (! is_numeric($value)) {
        throw new \fwk\exceptions\Fwk_Exceptions_InvalidInput($field.' should be a numeric value');
      }
    }
    return true;
  }
}

?>