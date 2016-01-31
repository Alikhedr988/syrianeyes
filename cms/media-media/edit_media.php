<?php include_once('../common/admin-header.php');?>
<?php confirm_logged_in();?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#file_upload').uploadify({
            'uploader'  : '../../includes/uploadify/uploadify.swf',
            'script'    : './../includes/uploadify/uploadify.php',
            'cancelImg' : '../../includes/uploadify/cancel.png',
            'folder'    : '../../includes/uploads/p-cover/',
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
$media_id= $_GET['media_id'];

$query = "SELECT * FROM `media-media` where `id` =".$media_id." LIMIT 1";
//file_put_contents('1.txt',$query);
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
$output = "";
$projectImages = "";
global $message; 
while ($row = mysqli_fetch_assoc($result)) {
    $media_id= $row['id'];
    $media_title= $row['media_title'];
    $media_desc = $row['media_desc'];
    $media_link = $row['media_link'];
    $media_cover = $row['media_cover'];

    
  
        $dirOrFolder = "Folder: ";

    $input = '<input class="col-sm-4" style="padding-top:30px;"  type="file" name="fileToUpload" id="fileToUpload" value="">';
    $output .= '<div class="rp row"><form action="edit_media.php?media_id='.$media_id.'" method="post" enctype="multipart/form-data">
         
        <div class="cmsalbum col-sm-9">
        <h1 class="text-center col-md-offset-4">Edit Photo Album</h1>
                           
              <div class="row">     <span class="col-sm-4"> Media Name: </span><input class="col-sm-8" type="text" name="media_title" value="'.$media_title.'" /> <br/></div>
              
                <div class="row">     <span class="col-sm-4"> Media Description : </span><textarea type="text" name="media_desc" value="$media_desc" /> '.$media_desc.' </textarea> <br/></div>
                <div class=" row"> <span class="col-sm-4" style="padding-top:30px;">Link: </span>
                   <input style="margin-top:30px;" type="text" class="col-md-8" name="media_link" value="'.$media_link.'" />
                    </div> <br/>
                 <div class=" row"> <span class="col-sm-3" style="padding-top:30px;">Media Cover Photo: </span>
                 <img class="cover-display" src="../../includes/uploads/p-cover/'.$media_cover .'" style="width:20%" />
                   '.$input.' </div> <br/>
                     ';
    

        $folder_name = str_replace(' ', '_', $media_title);
   
    
    
                     $output .='<input class="col-sm-offset-4" type="submit" name="submit" value="Edit" />
                    <a href="media.php"><img src="../../includes/cancel.png" style="width:20px;"/><span class="parawho alert-link" style="font-size:15px;margin-left:0">Cancel</span></a>
                    </form></div>';

                              
                             
                              
                          
}

?>


<?php
 

        
    
if (isset($_POST['submit']))
{
    
    
    
    
     if (isset($_POST['media_title']))
                  {

                      if ($_FILES['fileToUpload']['size'] != 0) {
                          if (unlink('../../includes/uploads/p-cover/' . $media_cover)) {
                              $target_dir = '../../includes/uploads/p-cover' . '/';
                              $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                              $uploadOk = 1;
                              $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                              $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                              if ($check !== false) {
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
                              }
                              // Check file size
                              if ($_FILES["fileToUpload"]["size"] > 5000000) {
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
                                      echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                                  } else {
                                      echo "Sorry, there was an error uploading your file.";
                                  }
                              }
                          }
                      }

  
         
                      $media_title = mysql_prep($_POST['media_title']);
                      $media_link = mysql_prep($_POST['media_link']);
                      $media_desc = mysql_prep($_POST['media_desc']);

                      $date = date('Y-m-d H:i:s');
						
						if (basename($_FILES["fileToUpload"]["name"]))
						{
                          $query = "UPDATE `media-media`
                                    SET `media_title`='".$media_title."',`media_cover`='".basename($_FILES["fileToUpload"]["name"])."', `media_desc`='".$media_desc."', `media_link`='".$media_link."', publish_date='".$date."'
                                    WHERE `id`='".$media_id."' ;";
						}
						else
						{
							 $query = "UPDATE `media-media`
                                    SET `media_title`='".$media_title."', `media_desc`='".$media_desc."', `media_link`='".$media_link."', publish_date='".$date."'
                                    WHERE `id`='".$media_id."' ;";
						}
                        file_put_contents('1.txt',$query);
                        $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
                        if ($result)
                        {
							
                             $message = "Success" ;
                            file_put_contents('1.txt',$query);
                            redirect_to("edit_media.php?media_id={$media_id}");                            
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
  

         <div class="col-sm-offset-5 infocontainer galleryThumbs">
             
         <?=$displayVid?>
           
            </div>
 
    </div>