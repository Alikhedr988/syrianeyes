<?php include_once('../../includes/db_connection.php');?>
<?php include_once('../../includes/functions.php');?>

<?php 

$current_project=find_photo_album_by_id($_GET['ph_album_id']);
if (!$current_project)
 {
     redirect_to('photo_albums.php');
 }

// the id in the $current_project array is from the DB so it's name is the same as the column
$ph_album_title = $current_project['ph_album_title'];
$ph_album_cover = $current_project['ph_album_cover'];

$ph_album_folder = str_replace(' ', '_', $ph_album_title);  
$upload_dir = '../../includes/uploads/photo-albums/';
$current_album_dir = $upload_dir . $ph_album_folder;
deleteDir($current_album_dir);

$cover_dir = '../../includes/uploads/p-cover/';
$current_album_cover = $cover_dir . $ph_album_cover;
if (!unlink($current_album_cover))
  {
  echo ("Error deleting $current_album_cover");
  }

$ph_album_id = $current_project['id'];
$query = 'DELETE FROM `photo-albums` where id = '.$ph_album_id.'  LIMIT 1';
file_put_contents('tes.txt',$query);
$result = mysqli_query($connection,$query);

 if ($result && mysqli_affected_rows($connection)==1)
            {
                $_SESSION['message'] = "Project Deleted";
                redirect_to('photo_albums.php');
            }
            else
            {
                $_SESSION['message']= "Project deletion failed";
                redirect_to('photo_albums.php');              

            }



?>