<?php include_once('../../includes/db_connection.php');?>
<?php include_once('../../includes/functions.php');?>

<?php 

$current_project=find_by_id("media-story",$_GET['story_id']);
if (!$current_project)
 {
     redirect_to('story.php');
 }

// the id in the $current_project array is from the DB so it's name is the same as the column
$story_title = $current_project['story_title'];
$story_cover = $current_project['story_cover'];

$story_folder = str_replace(' ', '_', $story_title);  
$upload_dir = '../../includes/uploads/story/';
$current_album_dir = $upload_dir . $story_folder;
deleteDir($current_album_dir);

$cover_dir = '../../includes/uploads/p-cover/';
$current_album_cover = $cover_dir . $story_cover;
if (!unlink($current_album_cover))
  {
  echo ("Error deleting $current_album_cover");
  }

$story_id = $current_project['id'];
$query = 'DELETE FROM `media-story` where id = '.$story_id.'  LIMIT 1';
file_put_contents('tes.txt',$query);
$result = mysqli_query($connection,$query);

 if ($result && mysqli_affected_rows($connection)==1)
            {
                $_SESSION['message'] = "Project Deleted";
                redirect_to('story.php');
            }
            else
            {
                $_SESSION['message']= "Project deletion failed";
                redirect_to('story.php');              

            }



?>