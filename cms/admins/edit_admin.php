<?php include_once('../../includes/initialize.php');?>
<?php include_once('..'.DS.'common'.DS.'admin-header.php');?>
<?php confirm_logged_in();?>
<?php 
            global $message ;
            $oldusername = "";
            $oldpassword = "" ;   
        if (isset($_GET['admin']))
                  {
                  $id = $_GET['admin'];
                $q1 = "SELECT * from admins where id = ".$id."";
                    $res =  mysqli_query($connection , $q1);
                    while ($oldinfo = mysqli_fetch_assoc($res))
                    {
                        $id = $oldinfo['id'];
                        $oldusername = $oldinfo['username'];
                        $oldpassword = $oldinfo['password'];
                    }
                      if(isset($_POST['submit']))
                         {
                          echo "<h1> HERE</h1>";
                      $username = $_POST['newuser'];
                      $password = password_encrypt($_POST['newpass']);
                      $query = "UPDATE admins
SET username='".$username."', password='".$password."'
WHERE id='".$id."';";
                        $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
                        if ($result)
                        {
                             $message = "Success" ;
                            //file_put_contents("1.txt",$query);
                            redirect_to('../admins/manage_admins.php');
                            
                        }
                      else
                      {
                            
                            $message = "There was an error with your edit";
                      }
                  }
                }
                else
                {
                    
                   // redirect_to("manage_admins.php");
                    
                }

?>
<?php echo $message ?>
    <?php include_once('..'.DS.'menu'.DS.'cmsmenu.php'); ?>
        <div style="margin-top:20px">
        <form name="submit" action="edit_admin.php?admin=<?=$id?>" method="post">
          <div class="col-md-8"> <span style="color:#fff;" class="col-sm-3">  New Username: </span> <input class="col-sm-6" type="text" name="newuser" value="<?=$oldusername ?>" /><br/></div>
            <div class="col-md-8"> <span style="color:#fff;" class="col-sm-3"> New Password: </span> <input class="col-sm-6" type="password" name="newpass" value="<?=$oldpassword ?>" /> </div>
    
    <input class="col-sm-offset-5" type="submit" name="submit" value="Edit" />
        
        </form>
        </div>
            </div>
        
    </div>