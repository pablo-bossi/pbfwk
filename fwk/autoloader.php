<?php

namespace fwk;

/**
* This class is in charge of loading the classes as long as are requested.
* In order to work properly class names should follow the standar which is [Folder1]_[Folder2]_..._[FolderN]_filename
* @author Pablo Bossi
*/
class Fwk_Autoloader {

  /**
  * Includes the file holding the class to make it available
  * @param String ClassName (Including namespace)
  */
  public static function Loader($className) {
    $class = self::_removeNamespace($className);

    include(self::_getFilePath($class));
  }
  
  /**
  * Removes the namespace from the classname received and returns just the classname
  * @param String ClassName (Including namespace)
  * @returns string with the class name without the namespace
  */
  private static function _removeNamespace($className) {
    $namespaceEnd = strpos($className, "\\");
    $class = $className;
    $i = 0;
    while ($namespaceEnd !== false) {
      $class = substr($class, ($namespaceEnd + 1));
      $namespaceEnd = strpos($class, "\\");
      $i++;
      if ($i > 20) throw new Exception('Invalid class name');
    }
    
    return $class;
  }
  
  /**
  * Gets the filepath for a specific class
  * @param String ClassName (without namespace)
  * @returns the path to the file were the class is stored
  */
  private static function _getFilePath($class) {

    $path = self::_checkSpecialCases($class);
    
    if (empty($path)) {
      $directories = explode("_", $class);
      $path = strtolower(implode("/", $directories));
      $path .= ".php";
      $path = $_SERVER["DOCUMENT_ROOT"]."/".$path;
    }
    
    return $path;
  }
  
  /**
  * Gets the filepath for specific clases which does not follow the naming standard
  * @param String ClassName (without namespace)
  * @returns the path to the file were the class is stored
  */
  private static function _checkSpecialCases($className) {
    if (($className == "cache") || ($className == "cacheKeyParameters")) {
      return $_SERVER["DOCUMENT_ROOT"].'/dataaccess/cacheconn.php';
    }
    if ($className == "dbConnProvider") {
      return $_SERVER["DOCUMENT_ROOT"].'/dataaccess/dbconn.php';
    }
    return "";
  }
}
