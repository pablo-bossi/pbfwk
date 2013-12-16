<?php

namespace fwk;

class Fwk_Response {
   private $code = null;
   private $body;
   private $headers = array();
   private $responseCodes = array(
      "200" => "OK",
      "301" => "Moved Permanently",
      "302" => "Found",
      "304" => "Not Modified",
      "400" => "Bad Request",
      "401" => "Unauthorized",
      "403" => "Forbidden",
      "404" => "Not Found",
      "500" => "Internal Server Error",
      "503" => "Service Unavailable",
   );

  /**
  * Sets the response code for the request. As the fwk is meant to work over Http it should be an http response code
  * @param String $code Http Response code
  */
   public function setResponseCode($code)
   {
      $this->code = strval($code);
   }
   
  /**
  * Sets the response body for the http message
  * @param String $body Body response
  */
   public function setBody($body) {
      $this->body = $body;
   }

  /**
  * Sets headers to be sent over htttp
  * @param String $name Header Name
  * @param String $value Value for the header
  */
   public function setHeader($name, $value) {
      $this->headers[] = $name.":".$value;
   }
   
  /**
  * Sends the response as an HTTP Message (Set requested headers and echoes the body)
  */
   public function render() {
      if (empty($this->code)) {
        $this->code = "500";
        header($this->code." ".$this->responseCodes[$this->code]);
        return false;
      } else {
        $description = "";
        if (isset($this->responseCodes[$this->code])) {
          $description = $this->responseCodes[$this->code];
        }
        header($this->code." ".$description);
      }
      
      foreach ($this->headers as $header) {
        header($header);
      }
      
      echo $this->body;
   }
}