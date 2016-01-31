<?php include_once('../../includes/initialize.php');?>
<?php include_once('..'.DS.'common'.DS.'admin-header.php');?>
<?php $layout_context = "admin"; ?>
<?php
    //another way is to detect if the submission has happened
  $username="";
        if (isset($_POST['submit'])){
            $username=$_POST['username'];
            $password=$_POST['password'];
            //file_put_contents('1.txt',$username);
            $found_admin = attempt_login($username,$password);
                    if ($found_admin)
                    {
                        $_SESSION['admin_id'] = $found_admin['id'];
                        $_SESSION['username'] = $found_admin['username'];
                        redirect_to('../manage/manage_content.php');
                    }
                    else
                    {
                        
                        $_SESSION['message']= "Username/Password not found";

                    }

                }
                else
                {
                }
        
              
?>

<div class="row login-container">
        <h1 class="col-sm-offset-5"> ADMIN Login</h1>
        
<br/>
    <div class="col-sm-6 col-sm-offset-3 loginbox" style="">
        <form name="submit" action="admin-login.php" method="post">
         <div class="row">  <span class="col-sm-2">  Username: </span> <input class="col-sm-8 col-sm-offset-1" type="text" name="username" value="<?=htmlentities($username)?>" /> <br/></div>
            <div class="row">
    <span class="col-sm-2">  Password: </span> <input class="col-sm-8 col-sm-offset-1" type="password" name="password" value="" /> <br/>
    <br/>
                </div>
    <input class="col-sm-offset-6" type="submit" name="submit" value="Login" />
        
        </form>
        </div>
            </div>
        
    </div>