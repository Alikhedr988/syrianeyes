<?php include_once('../common/admin-header.php');?>
<?php confirm_logged_in();?>
<style>
.container1
    {
        left:40% !important;
    }

</style>
<?php 
    global $message;
    $admins_set = find_all_admins();
    $output = "<table style='margin-top:50px' class='table table-condensed borderless col-sm-4'><tr><th>Username</th><th>Action</th></tr>";
    while($admin= mysqli_fetch_assoc($admins_set))
            {
                $output .= "<tr><td>".  htmlentities($admin['username'])."</td><td><a href='edit_admin.php?admin=".urlencode($admin['id'])."'>Edit  </a><a href='delete_admin.php?admin=".urlencode($admin['id'])."' onclick='return confirm('Are You Sure?');' >  Delete</a></tr> </a>";
            }
     
        $output .=  '</table>';
        $output .=  '<a href="new_admin.php?">+ Add a new admin</a>';
        
       
?>
        <div class="row">
      <?php include_once('..'.DS.'menu'.DS.'cmsmenu.php'); ?>
            
        
        <div class="adminscontainer col-sm-8 col-sm-offset-1">
            <?= $message ?>
        <?=$output ?>
            </div>
            </div>
            </div>
        
    </div>