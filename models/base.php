<?php

namespace fwk\models;

abstract class Models_Base {
  protected $loaded = false;
  protected $dirty = false;
  //Format: dbName => attributeName
  protected $fieldsMapping;
  //Format: attributeName => array (
  //                              array('type' => 'validationtype', params => array()),
  //                              array('type' => 'validationClass2'),
  //                            )
  protected $validationRules;

  public function __construct() {
    $this->_setFieldsMapping();
    $this->_setValidationRules();
  }

  protected function _setFieldsMapping() {
    return true;
  }
  
  protected function _setValidationRules() {
    return true;
  }
  
  public function fillData($data) {
    if (is_array($this->fieldsMapping)) {
      foreach ($this->fieldsMapping as $dbName => $fieldName) {
        $this->__set($fieldName, $data[$dbName]);
      }
    } else {
      $keys = array_keys($data);
      foreach ($keys as $key) {
        $this->__set($key, $data[$key]);
      }
    }
    $this->loaded = true;
  }
  
  public function save() {
    //if dirty update, if not loaded insert (Can pass the values based on the mapping)
  }

  public function __get($key) {
    return $this->$key;
  }
  
  public function __set($key, $value) {
    if ($key != 'loaded') {
      //TODO: Validate you can't set attributes which are not in the list.
      if (is_array($this->validationRules) && isset($this->validationRules[$key])) {
        $validation = new \fwk\validators\Fwk_Validators_Validate($key, $value);
        $iCounter = 0;
        //Aborts in case some of the validations fails
        while (($iCounter < count($this->validationRules[$key])) && ($validation->isValid())) {
          //Build validator class name
          $class = '\fwk\validators\Fwk_Validators_'.ucfirst(strtolower($this->validationRules[$key][$iCounter]['type']));
          $hasParameters = isset($this->validationRules[$key][$iCounter]['params']);
          if ($hasParameters) {
            $params = $this->validationRules[$key][$iCounter]['params'];
            $validation->validate(new $class($params));
          } else {
            $validation->validate(new $class);
          }
          $iCounter++;
        }
        if ($validation->isValid()) {
          $this->$key = $value;
          $this->dirty = true;
        } else {
          throw new \fwk\exceptions\Fwk_Exceptions_InvalidInput(sprintf(_('Invalid value (%s) for property %s'), $value, $key));
        }
      } else {
        $this->$key = $value;
        $this->dirty = true;
      }
    }
  }
}