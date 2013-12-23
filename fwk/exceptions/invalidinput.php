<?php
namespace fwk\exceptions;

class Fwk_Exceptions_InvalidInput extends \Exception
{
  public function __construct($message, $code = 0, Exception $previous = null) {
    parent::__construct($message, $code, $previous);
  }
}

?>