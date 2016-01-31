<?php include_once('../../includes/db_connection.php');?>
<?php include_once('../../includes/functions.php');?>

<?php 

$current_partner=find_by_id('partners',$_GET['id']);
if (!$current_partner)
 {
     redirect_to('partners.php');
 }

// the id in the $current_project array is from the DB so it's name is the same as the column
$partner_name = $current_partner['partners_name'];
$partners_link = $current_partner['partners_link'];
$partners_id = $current_partner['id'];
$query = 'DELETE FROM `partners` where id = '.$partners_id.'  LIMIT 1';
file_put_contents('tes.txt',$query);
$result = mysqli_query($connection,$query);

 if ($result && mysqli_affected_rows($connection)==1)
            {
                $_SESSION['message'] = "Project Deleted";
                redirect_to('partners.php');
            }
            else
            {
                $_SESSION['message']= "Project deletion failed";
                redirect_to('partners.php');              

            }



?>