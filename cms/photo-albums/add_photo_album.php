<?php include_once('../common/admin-header.php');?>
<?php confirm_logged_in();?>
<?php 
    $folder = '../../includes/uploads/photo-albums/';
?>
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
<?php

$output = "";
$message="";

if(isset($_POST['submit']))
{
        if (isset($_POST['ph_album_title']))
            {
             
            $ph_album_title= $_POST['ph_album_title'];
            $ph_album_desc = $_POST['ph_album_desc'];    
           
            $ph_album_title = preg_replace('/\s+/', '_', $ph_album_title);
                    if (!file_exists($folder . $ph_album_title)) 
                    {
                        file_put_contents('2.txt','here');
                        if (!mkdir('../../includes/uploads/photo-albums/'. $ph_album_title, 0777, true)) {
                            die('Failed to create folders...');
                        }

                       
                    }
            }
    
     if (isset($_POST['ph_album_title']))
     {
             if ($_FILES['fileToUpload']['size'] != 0)
                    {
                        $target_dir ='../../includes/uploads/p-cover' . '/';
                        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
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
                        echo "The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
             }
         
                      $ph_album_title = mysql_prep($_POST['ph_album_title']);
                      $ph_album_desc = mysql_prep($_POST['ph_album_desc']);
                     $date = date('Y-m-d H:i:s');
                     
                      $query = "INSERT INTO `photo-albums` (`ph_album_title`,`ph_album_desc`,`ph_album_cover`,`publish_date`)
VALUES ('".$ph_album_title."','".$ph_album_desc."','". basename($_FILES["fileToUpload"]["name"]) ."','".$date."');";
            file_put_contents('1.txt',$query);
                        $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
                        if ($result)
                        {
                             $message = "Success" ;
                            file_put_contents('1.txt',$message);
                            redirect_to("photo_albums.php");
                            
                        }
                      else
                      {
                            file_put_contents('1.txt',$query);
                          
                      }
                  }
}




$input = '<input class="col-sm-4" style="padding-top:30px;"  type="file" name="fileToUpload" id="fileToUpload" value="">';

 $output .= '<div class="rp row"><form name="submit" action="add_photo_album.php" method="post" enctype="multipart/form-data">
         
        <div class="cmsalbum col-sm-12">
        <h1 class="text-center">New Photo Album</h1>
                           
              <div class="row">     <span class="col-sm-3">Photo Album Title: </span><input class="col-sm-9" type="text" name="ph_album_title" value="" /> <br/><br/></div>
              
              <div class="row">     <span class="col-sm-3">Photo Album Description: </span><textarea class="col-sm-2" type="text" name="ph_album_desc" value="" /> </textarea></div>
                   <div class=" row"> <span class="col-sm-3" style="padding-top:30px;">Photo Album Cover Photo: </span>
                   
                   '.$input.' </div> <br/>
                     <input class="col-sm-offset-5" type="submit" name="submit" value="Add" />
                    <a href="photo_albums.php"><span class="glyphicon glyphicon-arrow-left"> Cancel </span></a>
        </form></div>';

?>  

        
        <?php include_once('..'.DS.'menu'.DS.'cmsmenu.php'); ?>
          
        <div class="col-sm-9 infocontainer">
       <?= $output?>
            </div>
            </div>
    
    </div>