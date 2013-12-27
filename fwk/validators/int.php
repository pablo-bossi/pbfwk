<?php

namespace fwk\validators;

/**
* Validator class to check wether an input is a valid int
* @author Pablo Bossi
*/
class Fwk_Validators_Int extends Fwk_Validators_Base {

  /**
  * Method to execute the int validation
  * @param String field Name of the field to be validated
  * @param String value Value to be validated
  * @returns true on success
  *          Throws an \fwk\exceptions\Fwk_Exceptions_InvalidInput exception in case the validation is not successfull
  */
  public function validate($field, $value) {
    if (! empty($value) && ($value != '')) {
      if ((! is_numeric($value)) || (is_numeric($value) && (floatval($value) != intval($value)))) {
        throw new \fwk\exceptions\Fwk_Exceptions_InvalidInput(sprintf(_('%s should be a valid int'), $field));
      }
    }
    return true;
  }
}

?>