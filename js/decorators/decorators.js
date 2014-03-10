function decorate() {

  this.validate = function (type, targetElement, key) {

    var decorateType = targetElement.attr('decoration');
    if ((type == 'keypress' && decorateType != 'maxlength') || (type == 'keydown' && decorateType == 'maxlength')) {
      var decorator = this[decorateType];
      return decorator(targetElement, key);
    } else {
      return true;
    }
  }

  this.int = function (element, key) {
    var acceptedKeys = new Array(48, 49, 50, 51, 52, 53, 54, 55, 56, 57);
    return checkAccept(acceptedKeys, key);
  }
  
  this.number = function (element, key) {
    var acceptedKeys = new Array(32, 46, 44, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57);
    return checkAccept(acceptedKeys, key);
  }
  
  this.email = function(element, key) {
    var notAcceptedChars = new Array(32, 34, 40, 41, 44, 58, 59, 60, 62, 91, 92, 93, 188);
    var ok = ! checkAccept(notAcceptedChars, key);
    
    if (! ok) {
      return false;
    }
    if (key == 64) {
      if (element.val().indexOf('@') > -1) {
        return false;
      }
    }
  }
  
  this.maxlength = function(element, key) {
    var deleteKeys = new Array(8, 46);
    var value = element.val();
    var length = value.length;
    var maxlenght = element.attr('maxlength');
    var available = (maxlenght-length);

    if (available == 0) {
      if (deleteKeys.indexOf(key) == -1) {
        return false;
      }
    }
    if (deleteKeys.indexOf(key) > -1) {
      if (available < maxlenght) {
        available++;
      }
    } else {
      available--;
    }
    $('#' + element.attr('id') + 'LengthMsg').html('<br />' + available + ' available characters');
    return true;
  }
  
  function checkAccept(validChars, key) {
    return (validChars.indexOf(key) > -1);
  }
}

function bindDecorators() {
  $("[decoration]").bind('keypress', function(event) { 
      return applyDecoration(event); 
  });
  $("[decoration~='maxlength']").bind('keydown', function(event) { 
      return applyDecoration(event); 
  });
}

function applyDecoration(event) {
  var validator = new decorate();
  return validator.validate(event.type, $(event.target), event.which);
}

$(document).ready(function() {
  bindDecorators();
  var mlsetups = $("[decoration~='maxlength']");
  for (var i = 0; i < mlsetups.length; i++) {
    var element = $(mlsetups[i]);
    element.after('<span class="infoMsg" id="' + element.attr('id') + 'LengthMsg"><br />' + (element.attr('maxlength') - element.val().length) + ' available characters</span>');
  }
});