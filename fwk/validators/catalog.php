<?php

namespace fwk\validators;

/**
* Validator class to check wether an input is a text with a lenght between a prefedined range
* @author Pablo Bossi
*/
class Fwk_Validators_Catalog extends Fwk_Validators_Base {
  private $options;

  /**
  * Constructor for the class
  * @param mixed Array which contains the list of valid values to compare against the input
  * @returns Fwk_Validators_NumberRange object
  */
  public function __construct(Array $options) {
    $this->options = $options;
  }

  /**
  * Method to execute the validations
  * @param String field Name of the field to be validated
  * @param String value Value to be validated
  * @returns true on success
  *          Throws an \fwk\exceptions\Fwk_Exceptions_InvalidInput exception in case the validation is not successfull
  */
  public function validate($field, $value) {
    if (! in_array($value, $this->options)) {
        throw new \fwk\exceptions\Fwk_Exceptions_InvalidInput(sprintf(_('%s is not a valid value'), $field));
    }
    return true;
  }
}

?>