<html>
<head>
  <title>Test js validators</title>
</head>
<body>
  <form id="testForm" />
    <input type="text" name="requiredText" id="requiredText" value="" placeholder="required field" validation="required isNumber isInt numericRange" minValue="5" maxValue="10" />
    <br /><input type="text" name="requiredText2" id="requiredText2" value="" placeholder="required field 2" validation="required length" minlength="3" maxlength="20" />
    <br /><input type="text" name="requiredText3" id="requiredText3" value="" placeholder="Integer" validation="required isInt" decoration="int" />
    <br /><input type="text" name="requiredText4" id="requiredText4" value="" placeholder="Number" validation="required isNumber" decoration="number" />
    <br /><input type="text" name="requiredText5" id="requiredText5" value="" placeholder="email" validation="required email" decoration="email" />
    <br /><input type="text" name="requiredText6" id="requiredText6" value="" placeholder="custom not accept numbers" validation="required" decoration="custom" />
    <br /><input type="button" value="Does nothing" id="submitBtn"/>
  </form>
  <?php fwk\Fwk_JsEnqueuer::getInstance()->enqueue(fwk\Fwk_JsEnqueuer::JS_FILE, "http://code.jquery.com/jquery-2.0.3.min.js"); ?>
  <?php fwk\Fwk_JsEnqueuer::getInstance()->enqueue(fwk\Fwk_JsEnqueuer::JS_FILE, "/js/validators/locals/errors-en.js"); ?>
  <?php fwk\Fwk_JsEnqueuer::getInstance()->enqueue(fwk\Fwk_JsEnqueuer::JS_FILE, "/js/validators/validators.js"); ?>
  <?php fwk\Fwk_JsEnqueuer::getInstance()->enqueue(fwk\Fwk_JsEnqueuer::JS_FILE, "/js/decorators/decorators.js"); ?>
  <?php
    $script = "
    $(document).ready(function() {
      $(\"[validation]\").blur(function(event) {
        var validator = new validateField();
        validator.validate($(event.target));
      }),
      $('#submitBtn').click(function(event) {
        var validator = new validateField();
        validator.checkForm('testForm');
      }),
      //Example on adding custom decorators, same method could be used for custom validators (Can always add it to decorators.js file)
      decorate.prototype.custom = function (element, key) {
        var acceptedKeys = new Array(32, 46, 44, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57);
        return (acceptedKeys.indexOf(key) <= -1);
      };
    });";
  fwk\Fwk_JsEnqueuer::getInstance()->enqueue(fwk\Fwk_JsEnqueuer::JS_CODE, $script);
  fwk\Fwk_JsEnqueuer::getInstance()->flushAll();
  ?>  
</body>
</html>