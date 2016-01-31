<?php include_once('../../includes/db_connection.php');?>
<?php include_once('../../includes/functions.php');?>

<?php 

$current_project=find_by_id('team',$_GET['team_id']);
if (!$current_project)
 {
     redirect_to('team.php');
 }

// the id in the $current_project array is from the DB so it's name is the same as the column

$image = $current_project['image'];



$cover_dir = '../../includes/uploads/team/';
$current_album_cover = $cover_dir . $image;
if (!unlink($current_album_cover))
  {
  echo ("Error deleting $current_album_cover");
  }

$team_id = $current_project['id'];
$query = 'DELETE FROM `team` where id = '.$team_id.'  LIMIT 1';
file_put_contents('tes.txt',$query);
$result = mysqli_query($connection,$query);

 if ($result && mysqli_affected_rows($connection)==1)
            {
                $_SESSION['message'] = "Project Deleted";
                redirect_to('team.php');
            }
            else
            {
                $_SESSION['message']= "Project deletion failed";
                redirect_to('team.php');              

            }



?>