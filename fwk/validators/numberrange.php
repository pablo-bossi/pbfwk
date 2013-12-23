<?php

namespace fwk\validators;

/**
* Validator class to check wether an input is a number within a defined range
* @author Pablo Bossi
*/
class Fwk_Validators_NumberRange extends Fwk_Validators_Base {
  private $min;
  private $max;

  /**
  * Constructor for the class
  * @param mixed Array which can contains min, max or both values to define the range, if one of the options is not present, then that part won't be validated
  * @returns Fwk_Validators_NumberRange object
  */
  public function __construct($params) {
    $this->min = (isset($params['min'])?$params['min']:null);
    $this->max = (isset($params['max'])?$params['max']:null);
  }

  /**
  * Method to execute the number range validation
  * @param String field Name of the field to be validated
  * @param String value Value to be validated
  * @returns true on success
  *          Throws an \fwk\exceptions\Fwk_Exceptions_InvalidInput exception in case the validation is not successfull
  */
  public function validate($field, $value) {
    //If empty no validation happens (Required validator is for this purpose)
    if ((! empty($value)) && ($value != '')) {
      //Check value is numeric
      $numberValidation = new \fwk\validators\Fwk_Validators_Number();
      if ($numberValidation->validate($field, $value)) {
        //If is a valid numeric number check that is inside proper ranges
        $error = '';
        if ((! empty($this->min)) && ($this->min >= $value)) {
          $error = $field.' should be higher than '.$this->min.PHP_EOL;
        }
        if ((! empty($this->max)) && ($this->max <= $value)) {
          $error = $field.' should be lower than '.$this->max.PHP_EOL;
        }
      }
      if ($error != '') {
        throw new \fwk\exceptions\Fwk_Exceptions_InvalidInput($error);
      }
    }
    return true;
  }
}

?>