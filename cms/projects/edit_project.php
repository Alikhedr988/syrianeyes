<?php include_once('../common/admin-header.php');?>
<?php confirm_logged_in();?>
<script type="text/javascript">
$(document).ready(function() {
  $('#file_upload').uploadify({
    'uploader'  : '../../includes/uploadify/uploadify.swf',
    'script'    : './../inc/uploadify/uploadify.php',
    'cancelImg' : '../../includes/uploadify/cancel.png',
    'folder'    : '<?=$folder?>',
    'auto'      : true
  });
});
</script>
<style>
.mce-container
    {
/*        width: 66.5% !important;*/
    left: 42px;
    }
#mceu_40
    {
        left:0px !important;
    }
</style>
<?php
$displayVid = "";
$project_id = $_GET['project_id'];

$query = "SELECT * FROM projects where project_id =".$project_id." LIMIT 1";
//file_put_contents('1.txt',$query);
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
$output = "";
$projectImages = "";
global $message; 
while ($row = mysqli_fetch_assoc($result)) {
    $project_id= $row['project_id'];
    $project_name = $row['project_name'];
    $project_desc_title = $row['project_desc_title'];
    $project_desc = $row['project_desc'];
    
  
        $dirOrFolder = "Folder: ";
                   
    
    $output .= '<div class="rp row"><form action="edit_project.php?project_id='.$project_id.'" method="post" enctype="multipart/form-data">
         
        <div class="cmsalbum col-sm-9">
        <h1 class="text-center">Edit Project</h1>
                           
              <div class="row">     <span class="col-sm-4"> Project name: </span><input class="col-sm-8" type="text" name="project_name" value="'.$project_name.'" /> <br/></div>
               <div class="row">     <span class="col-sm-4"> Project Description Title: </span><input class="col-sm-8" type="text" name="project_desc_title" value="'.$project_desc_title.'" /> <br/></div>
                <div class="row">     <span class="col-sm-4"> Project Description : </span><textarea type="text" name="project_desc" value="'.$project_desc.'" /> '.$project_desc.' </textarea> <br/></div>
                   <div class="rp row"> <span class="col-sm-3"> Add photos </span>';
    

        $folder_name = str_replace(' ', '_', $project_name);
        $folder = '../../includes/uploads/projects/' . $folder_name;
        $input = '<input class="col-sm-4"  type="file" name="fileToUpload" id="fileToUpload" value="'.$folder_name.'">';
      
    foreach (new DirectoryIterator($folder) as $file) {
                if ($file->isDot()) continue;

                if ($file->isFile()) {
                    if ($file->getFilename() != 't.jpg')
                    {
                    $imgsSrc =  $folder . '/' . $file->getFilename();
                    $projectImages .= "<div class='thumbContainer col-sm-4'><form method='post' action='edit_project.php?project_id={$project_id}'><img src={$imgsSrc} class='galleryImageTemp col-md-12 img-responsive' /><br/><button type='sub' name='delete' value='{$imgsSrc}' style='margin-left:25%' >Delete Photo</button></form></div>";

                    }
                }
            }
    
    $output .= $input."</div> <br/>";
                     $output .='<input class="col-sm-offset-3" type="submit" name="submit" value="Edit" />
                    <a href="projects.php"><img src="../../includes/cancel.png" style="width:20px;"/><span class="parawho alert-link" style="font-                          size:15px;margin-left:0">Cancel</span></a>
                    </form></div>';

                              
                              $folder = array_slice(explode('/',$folder),4);
                              $folder=  $folder[0];
                              
                          
}

?>


<?php
 if(isset($_POST['delete']))
    {
        if(unlink($_POST['delete'] ))
        {
            redirect_to("edit_project.php?project_id={$project_id}");  
        }
    }

        
    
if (isset($_POST['submit']))
{
    
    $folder = '../../includes/uploads/projects/' . $folder_name;
        if ($_FILES['fileToUpload']['size'] != 0)
            {
                $target_file = $folder . '/' . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
            echo "File exists";
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                //echo "The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
            }
        }
    
     if (isset($_POST['project_name']))
                  {
        
          $target_dir = '../../' . $folder . '/';
             

  
         
                      $project_name = mysql_prep($_POST['project_name']);
                          $project_desc_title = mysql_prep($_POST['project_desc_title']);
                      $project_desc = mysql_prep($_POST['project_desc']);
					  $project_desc = strip_tags($project_desc);
                      $date = date('Y-m-d H:i:s');
         
         
                          $query = "UPDATE projects
                                    SET project_name='".$project_name."', project_desc='".$project_desc."', project_desc_title='".$project_desc_title."', publish_date='".$date."'
                                    WHERE project_id='".$project_id."' ;";
                        file_put_contents('1.txt',$query);
                        $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
                        if ($result)
                        {
                             $message = "Success" ;
                            file_put_contents('1.txt',$query);
                            redirect_to("edit_project.php?project_id={$project_id}");                            
                        }
                      else
                      {
                            file_put_contents('1.txt',$query);
                      }
                  
                }
        }
    
?>  

        
        <?php include_once('..'.DS.'menu'.DS.'cmsmenu.php'); ?>
           
        <div class="col-sm-9 infocontainer">
   
       <?= $output?>
            
            </div>
        <div class="col-sm-12 infocontainer galleryThumbs">
            <h1 class="text-center">Project Images</h1>
            <br/>
            <?=$projectImages?>
           
            </div>

         <div class="col-sm-offset-5 infocontainer galleryThumbs">
             
         <?=$displayVid?>
           
            </div>
 
    </div>