<?php include_once('../common/admin-header.php');?>
<?php confirm_logged_in();?>
<?php 
    $folder = '../../includes/uploads/team/';
?>
<script type="text/javascript">
$(document).ready(function() {
  $('#file_upload').uploadify({
    'uploader'  : '../../includes/uploadify/uploadify.swf',
    'script'    : './../includes/uploadify/uploadify.php',
    'cancelImg' : '../../includes/uploadify/cancel.png',
    'folder'    : '../../includes/uploads/team/',
    'auto'      : true
  });
});
</script>
<?php

$output = "";
$message="";

if(isset($_POST['submit']))
{
        if (isset($_POST['name']))
            {
             
            $name= mysql_prep($_POST['name']);
            $position = mysql_prep($_POST['position']);
            
            $name_arabic= mysql_prep($_POST['name_arabic']);
            $position_arabic = mysql_prep($_POST['position_arabic']);
            
            $email = mysql_prep($_POST['email']);    
            $phone =mysql_prep($_POST['phone']);    
            
            
             if ($_FILES['fileToUpload']['size'] != 0)
                    {
                        $target_dir ='../../includes/uploads/team' . '/';
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
         
                      $query = "INSERT INTO `team` (`name`,`position`,`name_arabic`,`position_arabic`,`email`,`phone`,`image`)
VALUES ('".$name."','".$position."','".$name_arabic."','".$position_arabic."','".$email."','".$phone."','". basename($_FILES["fileToUpload"]["name"]) ."');";
            file_put_contents('1.txt',$query);
                        $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
                        if ($result)
                        {
                             $message = "Success" ;
                            file_put_contents('1.txt',$message);
                            redirect_to("team.php");
                            
                        }
                      else
                      {
                            file_put_contents('1.txt',$query);
                          
                      }
                  }
}




$input = '<input class="col-sm-4" style="padding-top:30px;"  type="file" name="fileToUpload" id="fileToUpload" value="">';

 $output .= '<div class="rp row"><form name="submit" action="add_team.php" method="post" enctype="multipart/form-data">
         
        <div class="cmsalbum col-sm-12">
        <h1 class="text-center">New Team Member</h1>
                           
              <div class="row">     <span class="col-sm-3">Name: </span><input class="col-sm-9" type="text" name="name" value="" /> <br/><br/></div>
              <div class="row">     <span class="col-sm-3">Position: </span><input class="col-sm-9" type="text" name="position" value="" /> <br/><br/></div>
                      <div class="row">     <span class="col-sm-3">Name Arabic: </span><input class="col-sm-9" type="text" name="name_arabic" value="" /> <br/><br/></div>
              <div class="row">     <span class="col-sm-3">Position Arabic: </span><input class="col-sm-9" type="text" name="position_arabic" value="" /> <br/><br/></div>
              <div class="row">     <span class="col-sm-3">Phone: </span><input class="col-sm-9" type="text" name="phone" value="" /> <br/><br/></div>
              <div class="row">     <span class="col-sm-3">E-mail: </span><input class="col-sm-9" type="text" name="email" value="" /> <br/><br/></div>
                   <div class=" row"> <span class="col-sm-3" style="padding-top:30px;">Member Photo: </span>
                   
                   '.$input.' </div> <br/>
                     <input class="col-sm-offset-5" type="submit" name="submit" value="Add" />
                    <a href="team.php"><span class="glyphicon glyphicon-arrow-left"> Cancel </span></a>
        </form></div>';

?>  

        
        <?php include_once('..'.DS.'menu'.DS.'cmsmenu.php'); ?>
          
        <div class="col-sm-9 infocontainer">
       <?= $output?>
            </div>
            </div>
    
    </div>