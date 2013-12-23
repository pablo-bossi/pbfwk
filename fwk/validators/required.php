<?php

namespace fwk\validators;

Class Fwk_Validators_Required extends Fwk_Validators_Base {

  public function validate($field, $value) {
    if (empty($value) || ($value == '')) {
      throw new \fwk\exceptions\Fwk_Exceptions_InvalidInput($field.' is required');
    }
    return true;
  }
}

?>