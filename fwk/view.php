<?php
namespace fwk;

class Fwk_View
{
  private $viewName = null;
  private $variables = null;
  private $masterPage = null;
  private static $generalVariables = array();
  
  public function __construct($viewName, $variables = null)
  {
    $this->variables = $variables;
    $this->viewName = $viewName;
  }
  
  public function setMasterView($masterTemplate) {
    $this->masterPage = $masterTemplate;
  }

  public function render()
  {
     //Move globals to the class
     foreach (self::$generalVariables as $key => $value) {
        $this->$key = $value;
     }

     ob_start();

     if ($this->masterPage != null) {
        $this->childModule = strtolower($this->viewName);
        include('templates/masters/'.strtolower($this->masterPage).'.php');
        unset($this->childModule);
     } else {
        //Include view file
        include('templates/'.strtolower($this->viewName).'.php');
     }
     $content = ob_get_contents(); 
     ob_end_clean();

     return $content;
  }

  public function renderSubModule($moduleName, $params = null)
  {
     $moduleView = new View($moduleName, $this->variables);
     if ($params !== null) {
        foreach ($params as $key => $value) {
          $moduleView->$key = $value;
        }
     }
     return $moduleView->render();
     unset ($moduleView);

     return $content;
  }

  public function __set($key, $value) {
    if (! is_array($this->variables)) {
      $this->variables = array();
    }
    
    $this->variables[$key] = $value;
  }
  
  public function __get($key) {
    if (isset($this->variables[$key])) {
      return $this->variables[$key];
    } else {
      return null;
    }
  }
  
  public function setGlobal($key, $value) {
    //Used to set variables which will be required on every view and are available before view creation (I.E: logged In User)
    self::$generalVariables[$key] = $value;
  }
}
