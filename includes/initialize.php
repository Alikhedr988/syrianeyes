<?php
//define the DS as the file separator, DIRECTORY_SEPARATOR is a php function that converts the separator depending on the system a.k. in windows \ , in unix /
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
if( $_SERVER['HTTP_HOST']=="localhost"){
defined('SITE_ROOT') ? null : define('SITE_ROOT', 'D:'.DS.'wamp'.DS.'www'.DS.'Sites'.DS.'syrianeyes');
}
else
{
   define('SITE_ROOT', 'www.syrianeyes.org'); 
}
defined('INCLUDES') ? null : define('INCLUDES', SITE_ROOT.DS.'includes');
//order is important...

require_once(INCLUDES.DS.'functions.php');
require_once(INCLUDES.DS.'session.php');
require_once(INCLUDES.DS.'db_connection.php');
?>