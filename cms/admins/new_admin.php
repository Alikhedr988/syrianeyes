<?php include_once('../../includes/initialize.php');?>
<?php include_once('..'.DS.'common'.DS.'admin-header.php');?>
<?php confirm_logged_in();?>
<?php 
if (isset($_POST['submit']))
    {
    global $message;
    global $connection;
        if (isset($_POST['newuser']) && isset($_POST['newpass']))
                  {
                      $username = mysql_prep($_POST['newuser']);
                      $password = password_encrypt($_POST['newpass']);
                      $query = "INSERT INTO admins (`username`,`password`)
VALUES ('".$username."','".$password."');";
           // file_put_contents('1.txt',$query);
                        $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
                        if ($result)
                        {
                             $message = "Success" ;
                            file_put_contents('1.txt',$message);
                            redirect_to('../admins/manage_admins.php');
                            
                        }
                      else
                      {
                            file_put_contents('1.txt',$message);
                      }
                  }
    }


?>

<body>

        <form class="col-sm-offset-3" style="margin-top:80px;position:absolute" name="submit" action="new_admin.php" method="post">
		<div class="row">
         <span class="col-sm-4">Username:</span>    <input class="col-sm-7" type="text" name="newuser" value="" /> <br/>
		 </div>
		 <div class="row">
            <span  class="col-sm-4">Password:</span>  <input class="col-sm-7" type="password" name="newpass" value="" /> <br/>
			</div>
    <br/>
    <input class="col-sm-offset-5" type="submit" name="submit" value="+ Add new admin" />
        
        </form>
      <?php include_once('..'.DS.'menu'.DS.'cmsmenu.php'); ?>
        
           
        
    </div>