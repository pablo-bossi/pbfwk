<?php
namespace fwk\validators;

/**
* This class for validating user input
* @author Pablo Bossi
*/
class Fwk_Validators_Validate
{
  private $field;
  private $value;
  private $errorMessage;
  private $success = true;

  /**
  * Constructor for the validator class
  * @param String field field name being validated
  * @param Mixed value value received for the field
  */
  public function __construct($field, $value) {
    $this->field = $field;
    $this->value = $value;
    $this->errorMessage = '';
  }

  /**
  * Method to execute a validation
  * @param Class Validator class (Inherits from Fwk_Validators_Base), which implements the validation method
  * @returns Fwk_Validators_Validate it returns this, in order to be able to chain several calls to validation, in case the validation fails, the property
  *                                  success is stated to false and the the description get stored on errorMessage property.
  */
  public function validate($validator) {
    try {
      $validator->validate($this->field, $this->value);
    } catch (\Exception $ex) {
      $this->errorMessage .= "- ".$ex->getMessage().PHP_EOL;
      $this->success = false;
    }
    return $this;
  }
  
  /**
  * Method to check wether the validation was successfull or not
  * @returns Bool results of applying the validations to the field
  */
  public function isValid() {
    return $this->success;
  }
  
  /**
  * Method to get the description of the errors obtained after validating the field
  * @returns String description of the errors gotten on the validation
  */
  public function getErrors() {
    return $this->errorMessage;
  }
}
?>