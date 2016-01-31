<?php include_once('../../includes/initialize.php');?>
<?php
//v1:simple logout
//session_start() done in session.php
//$_SESSION['admin_id'] = null;
//$_SESSION['usename'] = null;
//redirect_to('admin-login.php');
?>

<?php
//v2:destroys the session
//assumes nothing else in session is kept
session_start();
$_SESSION = array();
//first we get rid of the cookie, which is a pointer to the session file that resides on the server-side
if (isset($_COOKIE[session_name()]))
{
    setcookie(session_name(),'',time()-42000,'/');
}
//then we destroy the session
session_destroy();
//lastly,we redirect
redirect_to('admin-login.php');
?>