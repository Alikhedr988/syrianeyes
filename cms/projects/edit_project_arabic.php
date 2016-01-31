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
    $project_name_arabic = $row['project_name_arabic'];
    $project_desc_title_arabic = $row['project_desc_title_arabic'];
    $project_desc_arabic = $row['project_desc_arabic'];
    
  
        $dirOrFolder = "Folder: ";
                   
    
    $output .= '<div class="rp row"><form action="edit_project_arabic.php?project_id='.$project_id.'" method="post" enctype="multipart/form-data">
         
        <div class="cmsalbum col-sm-9">
        <h1 class="text-center">Add/Edit Arabic - Projects</h1>
                           
              <div class="row">     <span class="col-sm-4"> اسم المشروع: </span><input class="col-sm-8" type="text" name="project_name_arabic" value="'.$project_name_arabic.'" /> <br/></div>
               <div class="row">     <span class="col-sm-4"> عنوان المشروع : </span><input class="col-sm-8" type="text" name="project_desc_title_arabic" value="'.$project_desc_title_arabic.'" /> <br/></div>
                <div class="row">     <span class="col-sm-4"> شرح عن المشروع : </span><textarea type="text" name="project_desc_arabic" value="'.$project_desc_arabic.'" /> '.$project_desc_arabic.' </textarea> <br/></div>
                   <div class="rp row"> ';
    

        
    
    
    
                     $output .='<input class="col-sm-offset-7" type="submit" name="submit" value="Edit" />
                    <a href="projects.php"><img src="../../includes/cancel.png" style="width:20px;"/><span class="parawho alert-link" style="font-                          size:15px;margin-left:0">Cancel</span></a>
                    </form></div>';

                              
                          
                              
                          
}

?>


<?php

if (isset($_POST['submit']))
{
    
   
     if (isset($_POST['project_name_arabic']))
                  {
                    $project_name_arabic = mysql_prep($_POST['project_name_arabic']);
                          $project_desc_title_arabic = mysql_prep($_POST['project_desc_title_arabic']);
                      $project_desc_arabic = mysql_prep($_POST['project_desc_arabic']);
                      $date = date('Y-m-d H:i:s');
         
         
                          $query = "UPDATE projects
                                    SET project_name_arabic='".$project_name_arabic."', project_desc_arabic='".$project_desc_arabic."', project_desc_title_arabic='".$project_desc_title_arabic."', publish_date='".$date."'
                                    WHERE project_id='".$project_id."' ;";
                        file_put_contents('1.txt',$query);
                        $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
                        if ($result)
                        {
                             $message = "Success" ;
                            file_put_contents('1.txt',$query);
                            redirect_to("edit_project_arabic.php?project_id={$project_id}");                            
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
        
    
    </div>