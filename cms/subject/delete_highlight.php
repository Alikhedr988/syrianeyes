<?php include_once('../../includes/initialize.php');?>

<?php 

$current_highlight=find_by_id($_GET['highlight']  , "highlight");
if (!$current_highlight)
 {
     redirect_to('..'.DS.'manage'.DS.'manage_content.php');
 }

$id = $current_highlight['id'];

$query = 'DELETE FROM highlight where id = '.$id.' LIMIT 1';
//file_put_contents('tes.txt',$query);
$result = mysqli_query($connection,$query);

 if ($result && mysqli_affected_rows($connection)==1)
            {
                $_SESSION['message'] = "highlight Deleted";
                redirect_to('highlight.php');
            }
            else
            {
                $_SESSION['message']= "highlight deletion failed";
                redirect_to('highlight.php');              

            }



?>