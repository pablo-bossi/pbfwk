<?php

namespace fwk\validators;

/**
* Validator class to check wether an input is a valid email or not
* @author Pablo Bossi
*/
class Fwk_Validators_Email extends Fwk_Validators_Base {

  /**
  * Method to execute the email validation
  * @param String field Name of the field to be validated
  * @param String value Value to be validated
  * @returns true on success
  *          Throws an \fwk\exceptions\Fwk_Exceptions_InvalidInput exception in case the validation is not successfull
  */
  public function validate($field, $value) {
    if (! empty($value) && ($value != '')) {
      $pattern = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/";
      if (preg_match($pattern, $value) == 0) {
        throw new \fwk\exceptions\Fwk_Exceptions_InvalidInput(sprintf(_('%s should be a valid email'), $field));
      }
    }
    return true;
  }
}

?>