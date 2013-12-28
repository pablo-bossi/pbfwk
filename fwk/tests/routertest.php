<?php
namespace fwk;

$_SERVER['DOCUMENT_ROOT']  = __DIR__.'/../..';

require __DIR__.'/../router.php';

use fwk as fwk;

class RouterTest extends \PHPUnit_Framework_TestCase
{
  public function setUp() {
    $this->urlPatters = array();
    $this->urlPatterns[] = array('pattern' => '/^\/$/' ,'handlerFile' => __DIR__.'/../../controllers/main.php', 'handlerClass' => 'controllers\Controllers_main', 'handlerMethod' => 'index');
    $this->urlPatterns[] = array('pattern' => '/^\/micasa\/$/' ,'handlerFile' => __DIR__.'/../../controllers/homes.php', 'handlerClass' => 'controllers\Controllers_Homes', 'handlerMethod' => 'buy');
    $this->urlPatterns[] = array('pattern' => '/\/la\/micasa\/fea/' ,'handlerFile' => __DIR__.'/../../controllers/homes.php', 'handlerClass' => 'controllers\Controllers_Homes', 'handlerMethod' => 'belleza', 'extraParams' => array('type' => 'fea'));
    $this->urlPatterns[] = array('pattern' => '/\/pais\/([a-z]*)\/viajar/' ,'handlerFile' => __DIR__.'/../../controllers/countries.php', 'handlerClass' => 'controllers\Controllers_Countries', 'handlerMethod' => 'go', 'extraParams' => array('param1' => 'viajar', 'country' => '$1'));

    $this->staticContentPaths = array();
    $this->staticContentPaths[] = '/templates/';
    $this->staticContentPaths[] = '/js/';
    $this->staticContentPaths[] = '/css/';    

    $this->request = array('user' => 1);
  }

  /**
  * @dataProvider uriProvider
  */
  public function testconstructor($uri, $file, $class, $method, $params = array()) {
    $router = new fwk\Fwk_Router($uri, $this->urlPatterns, $_SERVER["DOCUMENT_ROOT"].'/controllers', $this->staticContentPaths, $this->request);
    
    $this->assertEquals($file, $router->controllerFile);
    $this->assertEquals($class, $router->className);
    $this->assertEquals($method, $router->action);
    $this->assertEquals($params, $router->params);
  }

  public function uriProvider()
  {
    return array(
      array('/', __DIR__.'/../../controllers/main.php', 'controllers\Controllers_main', 'index', array('user' => 1)),
      array('/micasa/', __DIR__.'/../../controllers/homes.php', 'controllers\Controllers_Homes', 'buy', array('user' => 1)),
      array('/la/micasa/fea', __DIR__.'/../../controllers/homes.php', 'controllers\Controllers_Homes', 'belleza', array('user' => 1, 'type' => 'fea')),
      array('/pais/argentina/viajar', __DIR__.'/../../controllers/countries.php', 'controllers\Controllers_Countries', 'go', array('user' => 1, 'param1' => 'viajar', 'country' => 'argentina')),
      array('/user/', $_SERVER["DOCUMENT_ROOT"].'/controllers/user.php', 'controllers\Controllers_user', 'index', array('user' => 1)),
      array('/user/list', $_SERVER["DOCUMENT_ROOT"].'/controllers/user.php', 'controllers\Controllers_user', 'list', array('user' => 1)),
      array('/user/customer/list', $_SERVER["DOCUMENT_ROOT"].'/controllers/user/customer.php', 'controllers\user\Controllers_customer', 'list', array('user' => 1)),
      array('/templates/test.php', '/home/projects/genericFwk/fwk/staticfilesrenderer.php', '\fwk\Fwk_StaticFilesRenderer', 'render', array('user' => 1, 'viewFile' => $_SERVER["DOCUMENT_ROOT"].'/templates/test.php')),
      array('/css/test.css', '/home/projects/genericFwk/fwk/staticfilesrenderer.php', '\fwk\Fwk_StaticFilesRenderer', 'render', array('user' => 1, 'viewFile' => $_SERVER["DOCUMENT_ROOT"].'/css/test.css')),
      array('/js/jquery.js', '/home/projects/genericFwk/fwk/staticfilesrenderer.php', '\fwk\Fwk_StaticFilesRenderer', 'render', array('user' => 1, 'viewFile' => $_SERVER["DOCUMENT_ROOT"].'/js/jquery.js')),
    );
  }
}