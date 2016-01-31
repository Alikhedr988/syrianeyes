<?php include_once('../../includes/db_connection.php');?>
<?php include_once('../../includes/functions.php');?>

<?php 

$current_project=find_project_by_id($_GET['project_id']);
if (!$current_project)
 {
     redirect_to('projects.php');
 }
$project_name = $current_project['project_name'];
$project_cover = $current_project['project_cover'];


$upload_dir = '../../includes/uploads/projects/';
$current_project_dir = $upload_dir . $project_name;
deleteDir($current_project_dir);

$cover_dir = '../../includes/uploads/p-cover/';
$current_project_cover = $cover_dir . $project_cover;
if (!unlink($current_project_cover))
  {
  echo ("Error deleting $current_project_cover");
  }

$project_id = $current_project['project_id'];
$query = 'DELETE FROM projects where project_id = '.$project_id.'  LIMIT 1';
file_put_contents('tes.txt',$project_id);
$result = mysqli_query($connection,$query);

 if ($result && mysqli_affected_rows($connection)==1)
            {
                $_SESSION['message'] = "Project Deleted";
                redirect_to('projects.php');
            }
            else
            {
                $_SESSION['message']= "Project deletion failed";
                redirect_to('projects.php');              

            }



?>