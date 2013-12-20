<html>
<head>
  <title>Test js validators</title>
</head>
<body>
  <input type="text" name="requiredText" id="requiredText" value="" placeholder="required field" validation="required isNumber isInt numericRange" minValue="5" maxValue="10" />
  <br /><input type="text" name="requiredText2" id="requiredText2" value="" placeholder="required field 2" validation="required length" minlength="3" maxlength="20" />
  <br /><input type="button" value="Does nothing" />
  <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
  <script type="text/javascript" src="/js/validators/locals/errors-en.js"></script>
  <script type="text/javascript" src="/js/validators/validators.js"></script>
</body>
</html>