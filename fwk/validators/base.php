<?php

namespace fwk\validators;

/**
* Abstract class from which every validator will inherit
* @author Pablo Bossi
*/
abstract class Fwk_Validators_Base {

  public abstract function validate($field, $value);
  
}

?>