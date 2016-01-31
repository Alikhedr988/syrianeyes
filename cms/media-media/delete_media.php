<?php include_once('../../includes/db_connection.php');?>
<?php include_once('../../includes/functions.php');?>

<?php 

$current_project=find_by_id('media-media',$_GET['media_id']);
if (!$current_project)
 {
     redirect_to('media.php');
 }

// the id in the $current_project array is from the DB so it's name is the same as the column
$media_title = $current_project['media_title'];
$media_cover = $current_project['media_cover'];


$cover_dir = '../../includes/uploads/p-cover/';
$current_album_cover = $cover_dir . $media_cover;
if (!unlink($current_album_cover))
  {
  echo ("Error deleting $current_album_cover");
  }

$media_id = $current_project['id'];
$query = 'DELETE FROM `media-media` where id = '.$media_id.'  LIMIT 1';
file_put_contents('tes.txt',$query);
$result = mysqli_query($connection,$query);

 if ($result && mysqli_affected_rows($connection)==1)
            {
                $_SESSION['message'] = "Project Deleted";
                redirect_to('media.php');
            }
            else
            {
                $_SESSION['message']= "Project deletion failed";
                redirect_to('media.php');              

            }



?>