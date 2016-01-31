<?php include_once('../../includes/db_connection.php');?>
<?php include_once('../../includes/functions.php');?>

<?php 

$current_project=find_video_album_by_id($_GET['video_album_id']);
if (!$current_project)
 {
     redirect_to('video_albums.php');
 }
// the id in the $current_project array is from the DB so it's name is the same as the column
$video_album_id = $current_project['id'];
$query = 'DELETE FROM `video-albums` where id = '.$video_album_id.'  LIMIT 1';
file_put_contents('tes.txt',$query);
$result = mysqli_query($connection,$query);

 if ($result && mysqli_affected_rows($connection)==1)
            {
                $_SESSION['message'] = "Project Deleted";
                redirect_to('video_albums.php');
            }
            else
            {
                $_SESSION['message']= "Project deletion failed";
                file_put_contents('test.txt',$_SESSION['message']);
                redirect_to('video_albums.php');              

            }



?>