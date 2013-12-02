<?php
namespace Fwk\Test;

require_once(__DIR__.'/../autoloader.php');
$_SERVER['DOCUMENT_ROOT']  = __DIR__.'/../..';

class AutoloaderTest extends \PHPUnit_Framework_TestCase
{
  /**
  * @dataProvider classesProvider
  */
  public function test_getFilePath($className, $file) {
    $method = $this->_getMethod('fwk\Fwk_Autoloader', '_getFilePath');
    $path = $method->invoke(null, $className);
    $this->assertEquals($file, $path);
  }

  /**
  * @dataProvider namespacesProvider
  */
  public function test_removeNamespace($classNameWithNamespace, $className) {
    $method = $this->_getMethod('fwk\Fwk_Autoloader', '_removeNamespace');
    $class = $method->invoke(null, $classNameWithNamespace);
    $this->assertEquals($className, $class);
  }

  private function _getMethod($className, $method) {
    $class = new \ReflectionClass($className);
    $method = $class->getMethod($method);
    $method->setAccessible(true);
    return $method;
  }
  
  public function classesProvider()
  {
    return array(
      array('Fwk_Router', $_SERVER["DOCUMENT_ROOT"].'/fwk/router.php'),
      array('Fwk_View', $_SERVER["DOCUMENT_ROOT"].'/fwk/view.php'),
      array('Fwk_Controller', $_SERVER["DOCUMENT_ROOT"].'/fwk/controller.php'),
      array('Fwk_JsEnqueuer', $_SERVER["DOCUMENT_ROOT"].'/fwk/jsenqueuer.php'),
      array('Fwk_Response', $_SERVER["DOCUMENT_ROOT"].'/fwk/response.php'),
      array('cache', $_SERVER["DOCUMENT_ROOT"].'/dataaccess/cacheconn.php'),
      array('dbConnProvider', $_SERVER["DOCUMENT_ROOT"].'/dataaccess/dbconn.php'),
      array('Controllers_user', $_SERVER["DOCUMENT_ROOT"].'/controllers/user.php'),
      array('Controllers_user_customer', $_SERVER["DOCUMENT_ROOT"].'/controllers/user/customer.php'),
      array('Lib_User', $_SERVER["DOCUMENT_ROOT"].'/lib/user.php'),
      array('Lib_User_Customer', $_SERVER["DOCUMENT_ROOT"].'/lib/user/customer.php'),
      array('Models_User', $_SERVER["DOCUMENT_ROOT"].'/models/user.php'),
    );
  }
  
  public function namespacesProvider()
  {
    return array(
      array('Fwk\Fwk_Router', 'Fwk_Router'),
      array('Fwk\Fwk_View', 'Fwk_View'),
      array('Fwk\Fwk_Controller', 'Fwk_Controller'),
      array('Fwk\Fwk_JsEnqueuer', 'Fwk_JsEnqueuer'),
      array('Fwk\Fwk_Response', 'Fwk_Response'),
      array('dataaccess\cache', 'cache'),
      array('dataaccess\dbConnProvider', 'dbConnProvider'),
      array('controllers\Controllers_user', 'Controllers_user'),
      array('controllers\Controllers_user_customer', 'Controllers_user_customer'),
      array('Lib\Lib_User', 'Lib_User'),
      array('Lib\Lib_User_Customer', 'Lib_User_Customer'),
      array('Models\Models_User', 'Models_User'),
    );
  }
  
}