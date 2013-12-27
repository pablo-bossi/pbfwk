<?php

namespace fwk\validators;

/**
* Validator class to check wether an input matches against a custom regular expresion. Accepts two modes, matches or not matches
* @author Pablo Bossi
*/
class Fwk_Validators_Regexp extends Fwk_Validators_Base {

  const MATCH = 0;
  const NOT_MATCH = 1;

  private $pattern;
  private $type;

  /**
  * Constructor for the class
  * @param Int type Defines the kind of match to be execute (Match or not Match) (Should be one of the Fwk_Validators_Regexp::MATCH or Fwk_Validators_Regexp::NOT_MATCH)
  * @param String pattern regular expresion to be executed against the input to be validated
  * @returns Fwk_Validators_Regexp object
  */
  public function __construct($type, $pattern) {
    $this->pattern = $pattern;
    $this->type = $type;
  }

  /**
  * Method to execute the generic regexp validation
  * @param String field Name of the field to be validated
  * @param String value Value to be validated
  * @returns true on success
  *          Throws an \fwk\exceptions\Fwk_Exceptions_InvalidInput exception in case the validation is not successfull
  */
  public function validate($field, $value) {
    if (! empty($value) && ($value != '')) {
      if (preg_match($this->pattern, $value) == $this->type) {
        throw new \fwk\exceptions\Fwk_Exceptions_InvalidInput(sprintf(_('%s does not match the expected format'), $field));
      }
    }
    return true;
  }
}

?>