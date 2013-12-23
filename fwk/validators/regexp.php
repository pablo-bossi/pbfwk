<?php

namespace fwk\validators;

class Fwk_Validators_Regexp extends Fwk_Validators_Base {

  const MATCH = 0;
  const NOT_MATCH = 1;

  private $pattern;
  private $type;

  public function __construct($type, $pattern) {
    $this->pattern = $pattern;
    $this->type = $type;
  }

  public function validate($field, $value) {
    if (! empty($value) && ($value != '')) {
      if (preg_match($this->pattern, $value) == $this->type) {
        throw new \fwk\exceptions\Fwk_Exceptions_InvalidInput($field.' does not match expected format');
      }
    }
    return true;
  }
}

?>