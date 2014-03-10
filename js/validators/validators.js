function validateField() {
  
  this.checkForm = function (formId) {
    var inputs = $('form#' + formId + ' :input');
    for (var i = 0; i < inputs.length; i++) {
      var input = $(inputs[i]);
      if (input.attr('validation')) {
        this.validate(input);
      }
    }
  }
  
  this.checkAll = function () {
    var inputs = $(':input');
    for (var i = 0; i < inputs.length; i++) {
      var input = $(inputs[i]);
      if (input.attr('validation')) {
        this.validate(input);
      }
    }
  }
  
  this.validate = function (targetElement) {

    var requiredvalidations = targetElement.attr('validation');
    var validations = requiredvalidations.split(' ');
    var error = new Array();
    var validationResult = '';
    
    for (var i = 0; i < validations.length; i++) {
      validator = this[validations[i]];
      validationResult = validator(targetElement);
      if (validationResult) {
        if (Array.isArray(validationResult)) {
          for (var j = 0; j < validationResult.length; j++) {
            error.push(validationResult[j]);
          }
        } else {
          error.push(validationResult);
        }
      }
    }
    if (error.length > 0) {
      showError(targetElement, error);
      return error;
    } else {
      hideError(targetElement);
      return;
    }
  }

  this.required = function(element) {
    var value = element.val();
    var name = element.attr('name');
    if (value.trim() == '') {
      return errorRequired.replace('[%fieldname%]', name);
    } else {
      return;
    }
  }
  
  this.isNumber = function (element) {return isNumber(element);};
  
  this.isInt = function(element) {
    var value = element.val();
    var name = element.attr('name');
    
    if (value.trim() == '') {
      return;
    }
    if (isNumber(element) != '') {
      return errorIsInt.replace('[%fieldname%]', name);
    } else {
      var isInt = (parseFloat(value) == parseInt(value, 10));
      if (! isInt) {
        return errorIsInt.replace('[%fieldname%]', name);
      } else {
        return;
      }
    }
  }

  this.numericRange = function(element) {
    var value = element.val();
    var name = element.attr('name');
    var minValue = element.attr('minValue');
    var maxValue = element.attr('maxValue');

    if (value.trim() == '') {
      return;
    }
    if (isNumber(element) != '') {
      return errorNumber.replace('[%fieldname%]', name);
    } else {
      var error = new Array();
      if ((minValue) && (parseFloat(value) < parseFloat(minValue))) {
        error.push(errorNumericRangeMin.replace('[%fieldname%]', name).replace('[%minValue%]', minValue));
      }
      if ((maxValue) && (parseFloat(value) > parseFloat(maxValue))) {
        error.push(errorNumericRangeMax.replace('[%fieldname%]', name).replace('[%maxValue%]', maxValue));
      }
      
      if (error.length > 0) {
        return error;
      }
      else
        return;
    }
  }
  
  this.length = function (element) {
    var value = element.val();
    var name = element.attr('name');
    var minLength = element.attr('minlength');
    var maxLength = element.attr('maxlength');

    var error = new Array();
    if ((minLength) && (parseInt(value.length) < parseInt(minLength))) {
      error.push(errorLengthMin.replace('[%fieldname%]', name).replace('[%minLength%]', minLength));
    }
    if ((maxLength) && (parseInt(value.length) > parseInt(maxLength))) {
      error.push(errorLengthMax.replace('[%fieldname%]', name).replace('[%maxLength%]', maxLength));
    }
    
    if (error.length > 0) {
      return error;
    } else {
      return;
    }
  }

  this.email = function (element) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (! re.test(element.val())) {
      return errorEmail.replace('[%fieldname%]', name);
    }
    return;
  }
  

  function isNumber(element) {

    var value = element.val();
    var name = element.attr('name');
    
    var pattern = '/[^0-9., ]+/';
    if (isNaN(value)) {
      return errorNumber.replace('[%fieldname%]', name);
    } else {
      if (value.search(pattern) > -1) {
        return errorNumber.replace('[%fieldname%]', name);
      } else {
        return '';
      }
    }
  }
  
  function showError(element, errors) {
    var name = element.attr('name');
    var errorTag = $('#' + name + 'error');
    var message = '';
    
    for (var i = 0; i < errors.length; i++) {
      message += errors[i] + '<br />';
    }
    
    if (errorTag.length == 0) {
      element.after('<span class="errorMsg" id="' + name + 'error"><img src="/imgs/error.jpg" border="0" /><br />' + message + '</span>');
    } else {
      errorTag.html('<img src="/imgs/error.jpg" border="0" /><br />' + message + '</span>');
      errorTag.show();
    }
  }

  function hideError(element) {
    var name = element.attr('name');
    var errorTag = $('#' + name + 'error');

    if (errorTag) {
      errorTag.hide();
    }
  }
}