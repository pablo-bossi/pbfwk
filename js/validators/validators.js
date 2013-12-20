function validateField(event) {
  this.event = event;
  
  this.validate = function (event) {

    var targetElement = $(event.target);
    var requiredvalidations = targetElement.attr('validation');
    var validations = requiredvalidations.split(' ');
    var error = '';
    var validationResult = '';
    
    for (var i = 0; i < validations.length; i++) {
      validator = this[validations[i]];
      validationResult = validator(targetElement);
      if (validationResult.trim() != '') {
        error += validationResult + '<br />';
      }
    }
    
    if (error.trim() != '') {
      showError(targetElement, error);
    } else {
      hideError(targetElement);
    }
  }

  this.required = function(element) {
    var value = element.val();
    var name = element.attr('name');
    if (value.trim() == '') {
      return errorRequired.replace('[%fieldname%]', name);
    } else {
      return '';
    }
  }
  
  this.isNumber = function (element) {return isNumber(element);};
  
  this.isInt = function(element) {
    var value = element.val();
    var name = element.attr('name');
    
    if (value.trim() == '') {
      return '';
    }
    if (isNumber(element) != '') {
      return errorIsInt.replace('[%fieldname%]', name);
    } else {
      var isInt = (parseFloat(value) == parseInt(value, 10));
      if (! isInt) {
        return errorIsInt.replace('[%fieldname%]', name);
      } else {
        return '';
      }
    }
  }

  this.numericRange = function(element) {

    var value = element.val();
    var name = element.attr('name');
    var minValue = element.attr('minValue');
    var maxValue = element.attr('maxValue');
    
    if (value.trim() == '') {
      return '';
    }
    if (isNumber(element) != '') {
      return errorNumber.replace('[%fieldname%]', name);
    } else {
      var error = '';
      if ((minValue) && (parseFloat(value) < parseFloat(minValue))) {
        error += errorNumericRangeMin.replace('[%fieldname%]', name).replace('[%minValue%]', minValue);
      }
      if ((maxValue) && (parseFloat(value) > parseFloat(maxValue))) {
        error += errorNumericRangeMax.replace('[%fieldname%]', name).replace('[%maxValue%]', maxValue);
      }
      return error;
    }
  }
  
  this.length = function (element) {
    var value = element.val();
    var name = element.attr('name');
    var minLength = element.attr('minlength');
    var maxLength = element.attr('maxlength');

    var error = '';
    if ((minLength) && (parseInt(value.length) < parseInt(minLength))) {
      error += errorLengthMin.replace('[%fieldname%]', name).replace('[%minLength%]', minLength);
    }
    if ((maxLength) && (parseInt(value.length) > parseInt(maxLength))) {
      error += errorLengthMax.replace('[%fieldname%]', name).replace('[%maxLength%]', maxLength);
    }
    return error;
  }
  

  function isNumber(element) {

    var value = element.val();
    var name = element.attr('name');
    
    var pattern = '/[^0-9.,]+/';
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
  
  function showError(element, message) {
    var name = element.attr('name');
    var errorTag = $('#' + name + 'error');

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

$(document).ready(function() {
  $("[validation]").blur(function(event) {
    var validator = new validateField(event);
    validator.validate(event);
  });
});