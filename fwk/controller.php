<?php
namespace fwk;

/**
* This class is in charge to control the execution flow of a request, it always returns a response object to be rendered
* @author Pablo Bossi
*/
class Fwk_Controller
{
  protected $response;

  /**
  * Cronstructor for the class
  * @param Fwk_Response $response object were the result of execution will be set
  * @returns Fwk_Controller object
  */
  public function __construct($response) {
    $this->response = $response;
  }

  /**
  * This function is always call in the constructor. Can be used to setup things before the requested action (Example, checked the user is logged in)
  */
  public function initialize()
  {
    return true;
  }

  /**
  * Always called after the action has been executed. Can be used for cleaning up stuff after action execution
  */
  public function finalize()
  {
    return true;
  }
}

?>