<?php
namespace fwk;

class Fwk_Controller
{
  protected $response;

  public function __construct($response) {
    $this->response = $response;
  }

  public function initialize()
  {
    //This function is always call in the constructor
    //Can be used to setup things before the execution of the action
    return true;
  }

  public function finalize()
  {
    //Always called after the action has been executed
    //Can be used for cleaning up stuff after action execution
    return true;
  }
}

?>