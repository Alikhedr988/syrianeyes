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
    left: -20px;
    }
#mceu_40
    {
        left:0px !important;
    }
</style>
<?php
$displayVid = "";
$story_id= $_GET['story_id'];

$query = "SELECT * FROM `media-story` where `id` =".$story_id." LIMIT 1";
//file_put_contents('1.txt',$query);
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well

$output = "";
$projectImages = "";
global $message; 

while ($row = mysqli_fetch_assoc($result)) {
    $story_id= $row['id'];
    $story_title= $row['story_title'];
    $story_desc= $row['story_desc'];

    
  
        $dirOrFolder = "Folder: ";
                   
    
    $output .= '<div class="rp row"><form action="edit_story.php?story_id='.$story_id.'" method="post" enctype="multipart/form-data">
         
        <div class="cmsalbum col-sm-9">
        <h1 class="text-center col-md-offset-4">Edit Story</h1>
                           
              <div class="row">     <span class="col-sm-4"> Story Name: </span><input class="col-sm-8" type="text" name="story_title" value="'.$story_title.'" /> <br/></div>
              
                <div class="row">     <span class="col-sm-4"> Story Description : </span><textarea type="text" name="story_desc" value="" /> '.$story_desc.' </textarea> <br/></div>
                   <div class="rp row"> <span class="col-sm-3"> Add photos </span>';
    

        $folder_name = str_replace(' ', '_', $story_title);
        $folder = '../../includes/uploads/story/' . $folder_name;
        $input = '<input class="col-sm-4"  type="file" name="fileToUpload" id="fileToUpload" value="'.$folder_name.'">';
        $desc_temp = "";
    foreach (new DirectoryIterator($folder) as $file) {
                if ($file->isDot()) continue;

                if ($file->isFile()) {
                   
                    $query2 = "SELECT * FROM `story_imgs` where `story_id` =".$story_id." AND img_name = '".$file->getFilename()."'";
                    file_put_contents('1.txt',$query2);
                    $result2 = mysqli_query($connection , $query2); //this is excuted in case of insert and delete and update as well
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $img_desc = $row['img_desc'];
                        $img_desc_ar = $row['img_desc_ar'];
                        }
                     
                    $imgsSrc =  $folder . '/' . $file->getFilename();
                        $path_parts = pathinfo($imgsSrc);
                    $projectImages .= "<div class='thumbContainer col-sm-9'>
                        <form class='thumb_form' method='post' action='edit_story.php?story_id={$story_id}'>
                            <div class='thumb_img_container row'> 
                                <img src='{$imgsSrc}' class='galleryImageTemp col-md-6 img-responsive' />
                            </div>
                            <br/>
                            <div class='row'>
                          <span class='col-sm-4 thumb_desc'> Description </span> <textarea  type='text' name='img_desc' value='{$img_desc}' >{$img_desc} </textarea><br/>
                          </div>
                            <br/>
                            <div class='row'>
                            <span class='col-md-12 thumb_desc'>Description Arabic </span> <textarea  type='text' name='img_desc_ar'  value='{$img_desc_ar}' >{$img_desc_ar}</textarea>
                            </div>
                            <br/>
                            <button type='sub' name='delete' value='{$imgsSrc}' style='margin-left:25%' >Delete Photo</button>
                            <br/>
                            <button  name='add_desc' value='".$path_parts['basename'] ."' style='margin-left:25%' >Add Description</button>
                        </form>
                    </div>";

                    
                }
            }
    
    $output .= $input."</div> <br/>";
                     $output .='<input class="col-sm-offset-3" type="submit" name="submit" value="Edit" />
                    <a href="story.php"><img src="../../includes/cancel.png" style="width:20px;"/><span class="parawho alert-link" style="font-size:15px;margin-left:0">Cancel</span></a>
                    </form></div>';

                              
                              $folder = array_slice(explode('/',$folder),4);
                              $folder=  $folder[0];
                              
                          
}

?>


<?php
 if(isset($_POST['delete']))
    {
            $temp_name = $_POST['delete'];
            $temp_name = explode('/', $temp_name );
            $temp_name = array_pop($temp_name);
        if(unlink($_POST['delete'] ))
          
            $query = "DELETE from story_imgs where img_name = '".$temp_name."';";
            file_put_contents('1.txt',$query);
            if($result = mysqli_query($connection , $query)) //this is excuted in case of insert and delete and update as well
            {
                redirect_to("edit_story.php?story_id={$story_id}");  
            }
    }
if(isset($_POST['add_desc']))
{
   $img_desc =  mysql_prep($_POST['img_desc']);
    $img_desc_ar =  mysql_prep($_POST['img_desc_ar']);
    $img_desc_name =  $_POST['add_desc'];
    $query = "UPDATE `story_imgs` SET `img_desc`='".$img_desc."',`img_desc_ar`='".$img_desc_ar."' WHERE `story_id`='".$story_id."' AND  `img_name`='".$img_desc_name."'";
            file_put_contents('1.txt',$query);
            if($result = mysqli_query($connection , $query)) //this is excuted in case of insert and delete and update as well
            {
                redirect_to("edit_story.php?story_id={$story_id}");  
            }
    
}

    
if (isset($_POST['submit']))
{
    
    $folder = '../../includes/uploads/story/' . $folder_name;
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
            //echo "Sorry, file already exists.";
            $uploadOk = 0;
            echo "File exists";
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000000000) {
            //echo "Sorry, your file is too large.";
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
            if ($uploadOk !=0)
            {
                 $query = "INSERT INTO `story_imgs`  (`img_name`,  `story_id`) VALUES ('".basename($_FILES["fileToUpload"]["name"])."',  '".$story_id."')";
                        
                        $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
                
            }
        }
    
     if (isset($_POST['story_title']))
                  {
        
          $target_dir = '../../' . $folder . '/';
             

  
         
                      $story_title = mysql_prep($_POST['story_title']);
                          
                      $story_desc = mysql_prep($_POST['story_desc']);
                      $date = date('Y-m-d H:i:s');
         
         
                          $query = "UPDATE `media-story`
                                    SET `story_title`='".$story_title."', `story_desc`='".$story_desc."', publish_date='".$date."'
                                    WHERE `id`='".$story_id."' ;";
                        file_put_contents('1.txt',$query);
                        $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
                        if ($result)
                        {
                             $message = "Success" ;
                            file_put_contents('1.txt',$query);
                            redirect_to("edit_story.php?story_id={$story_id}");                            
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
            <h1 class="text-center">Story Images</h1>
            <br/>
            <?=$projectImages?>
           
            </div>

         <div class="col-sm-offset-5 infocontainer galleryThumbs">
             
         <?=$displayVid?>
           
            </div>
 
    </div>