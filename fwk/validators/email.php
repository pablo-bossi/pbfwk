<?php

namespace fwk\validators;

class Fwk_Validators_Email extends Fwk_Validators_Base {

  public function validate($field, $value) {
    if (! empty($value) && ($value != '')) {
      $pattern = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/";
      if (preg_match($pattern, $value) == 0) {
        throw new \fwk\exceptions\Fwk_Exceptions_InvalidInput($field.' should be a valid email');
      }
    }
    return true;
  }
}

?>