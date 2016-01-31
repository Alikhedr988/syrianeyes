<?php include_once('../../includes/initialize.php'); ?>
<?php 

$current_admin=find_admin_by_id($_GET['admin'] , false);
if (!$current_admin)
 {
     redirect_to('..'.DS.'admins'.DS.'manage_admins.php');
 }

$id = $current_admin['id'];

$query = 'DELETE FROM admins where id = '.$id.' LIMIT 1';
$result = mysqli_query($connection,$query);

 if ($result && mysqli_affected_rows($connection)==1)
            {
                $_SESSION['message'] = "Page Deleted";
                redirect_to('../admins/manage_admins.php');
            }
            else
            {
                $_SESSION['message']= "Page deletion failed";
                redirect_to('../admins/manage_admins.php?admin="'.$id.'"');              

            }



?>