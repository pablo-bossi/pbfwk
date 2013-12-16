<?php
namespace fwk;

class Fwk_JsEnqueuer
{
  const JS_FILE = 1;
  const JS_CODE = 2;

  private static $instance = null;
  private $chunks = array();
  
  public static function getInstance() {
    if (self::$instance == null) {
      self::$instance = new Fwk_JsEnqueuer();
    }
    return self::$instance;
  }
  
  private function __construct() {
    $this->chunks = array();
  }

  public function enqueue($type, $content, $attributes = array())
  {
    $scriptAttrs = "";
    foreach ($attributes as $attrib => $value) {
      if (($attrib != "type") && ($attrib != "src")) {
        $scriptAttrs .= $attrib .'="'.$value.'" ';
      }
    }
    if ($type == self::JS_FILE) {
        $this->chunks[] = '<script type="text/javascript" src="'.$content.'" '.$scriptAttrs.'></script>';
    } elseif ($type == self::JS_CODE) {
        $this->chunks[] = '<script type="text/javascript" '.$scriptAttrs.'>'.$content.'</script>';
    }
  }
  
  public function flushAll() {
    foreach ($this->chunks as $chunk) {
      echo $chunk;
    }
    $this->clean();
  }
  
  public function clean() {
    $done = false;
    while (! $done) {
      if (array_pop($this->chunks) === null) {
        $done = true;
      }
    }
  }
}
