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
   
   public function setResponseCode($code)
   {
      $this->code = strval($code);
   }
   
   public function setBody($body) {
      $this->body = $body;
   }

   public function setHeader($name, $value) {
      $this->headers[] = $name.":".$value;
   }
   
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