function decorate() {

  this.validate = function (targetElement, key) {

    var decorateType = targetElement.attr('decoration');
    var decorator = this[decorateType];
    
    return decorator(targetElement, key);
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
    var notAcceptedChars = new Array(32, 34, 40, 41, 44, 58, 59, 60, 62, 91, 92, 93, 188, 190);
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
  
  function checkAccept(validChars, key) {
    return (validChars.indexOf(key) > -1);
  }
}
  
$(document).ready(function() {
  $("[decoration]").keypress(function(event) {
    var validator = new decorate();
    return validator.validate($(event.target), event.which);
  });
});