<?php
/**
* Use this file to configure DB connection parameters, the naming conventions for the constants is {Connection_Name}_Param
* For using a connection then when creating a db connection object just ask for the name of the requested connection
* @example SITE_WRITE_HOST is the hosts for a connection called SITE_WRITE
* @example Fwk\dbConnProvider::getConnection("SITE_WRITE") will return a SITE_WRITE connection
*/

DEFINE("SITE_WRITE_HOST", "localhost");
DEFINE("SITE_WRITE_USER", "root");
DEFINE("SITE_WRITE_PASS", "XXXX");
DEFINE("SITE_WRITE_DB", "XXXX");

DEFINE("SITE_READ_HOST", "localhost");
DEFINE("SITE_READ_USER", "readonlyuser");
DEFINE("SITE_READ_PASS", "XXXX");
DEFINE("SITE_READ_DB", "XXXX");
?>
