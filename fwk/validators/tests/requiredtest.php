<?php
namespace fwk\validators;

require_once(__DIR__.'/../base.php');
require_once(__DIR__.'/../required.php');
require_once(__DIR__.'/../../exceptions/invalidinput.php');
$_SERVER['DOCUMENT_ROOT']  = __DIR__.'/../../..';

class ValidatorRequiredTest extends \PHPUnit_Framework_TestCase
{
  public function test_validate() {
    $validator = new Fwk_Validators_Required();
    $this->assertTrue($validator->validate('required', 'Some value'));
    
    $this->setExpectedException('\fwk\exceptions\Fwk_Exceptions_InvalidInput');
    $validator->validate('required', '');
  }
}