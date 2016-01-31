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

$team_id= $_GET['team_id'];

$query = "SELECT * FROM `team` where `id` =".$team_id." LIMIT 1";
//file_put_contents('1.txt',$query);
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
$output = "";
$projectImages = "";
global $message; 
while ($row = mysqli_fetch_assoc($result)) {
    $team_id = $row['id'];
    $name= $row['name'];
    $position = $row['position'];   
    $name_arabic= $row['name_arabic'];
    $position_arabic = $row['position_arabic'];   
    $phone = $row['phone'];    
    $email = $row['email'];    
    $image = $row['image'];  
    
  
        $dirOrFolder = "Folder: ";
                   
    
    $output .= '<div class="rp row"><form action="edit_team.php?team_id='.$team_id.'" method="post" enctype="multipart/form-data">
         
        <div class="cmsalbum col-sm-9">
        <h1 class="text-center col-md-offset-4">Edit Team Member</h1>
                           
              <div class="row">     <span class="col-sm-4"> Name: </span><input class="col-sm-8" type="text" name="name" value="'.$name.'" /> <br/></div>
              <div class="row">     <span class="col-sm-4"> Position: </span><input class="col-sm-8" type="text" name="position" value="'.$position.'" /> <br/></div>
               <div class="row">     <span class="col-sm-4"> Name Arabic: </span><input class="col-sm-8" type="text" name="name_arabic" value="'.$name_arabic.'" /> <br/></div>
              <div class="row">     <span class="col-sm-4"> Position Arabic: </span><input class="col-sm-8" type="text" name="position_arabic" value="'.$position_arabic.'" /> <br/></div>
              <div class="row">     <span class="col-sm-4"> Phone Number: </span><input class="col-sm-8" type="text" name="phone" value="'.$phone.'" /> <br/></div>
              <div class="row">     <span class="col-sm-4"> E-mail: </span><input class="col-sm-8" type="text" name="email" value="'.$email.'" /> <br/></div>
              

                   <div class="rp row"> <span class="col-sm-3"> Change Image </span>';
    

        
        $folder = '../../includes/uploads/team/';
        $input = '<input class="col-sm-4"  type="file" name="fileToUpload" id="fileToUpload" value="">';
      $input .="<img src='{$folder}{$image}' class='img-circle col-md-3' style='float:right' />";
    
    $output .= $input."</div> <br/>";
                     $output .='<input class="col-sm-offset-3" type="submit" name="submit" value="Edit" />
                    <a href="team.php"><img src="../../includes/cancel.png" style="width:20px;"/><span class="parawho alert-link" style="font-size:15px;margin-left:0">Cancel</span></a>
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
            redirect_to("edit_team.php?team_id={$team_id}");  
        }
    }

        
    
if (isset($_POST['submit']))
{
    
    $folder = '../../includes/uploads/team';
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
                //echo "The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
            }
        }
    
     if (isset($_POST['name']))
                  {
        
          
  
         
                      $name= mysql_prep($_POST['name']);
            $position = mysql_prep($_POST['position']);
          
            $name_arabic= mysql_prep($_POST['name_arabic']);
            $position_arabic = mysql_prep($_POST['position_arabic']);
            
            $email = mysql_prep($_POST['email']);    
            $phone =mysql_prep($_POST['phone']);   
            if (basename($_FILES["fileToUpload"]["name"]) != "")
            {
                          $query = "UPDATE `team`
                                    SET `name`='".$name."', `position`='".$position."',`name_arabic`='".$name_arabic."', `position_arabic`='".$position_arabic."', email='".$email."', phone='".$phone."', image='". basename($_FILES["fileToUpload"]["name"])."'
                                    WHERE `id`='".$team_id."' ;";
            }
            else
            {
                $query = "UPDATE `team`
                                    SET `name`='".$name."', `position`='".$position."',`name_arabic`='".$name_arabic."', `position_arabic`='".$position_arabic."', email='".$email."', phone='".$phone."'
                                    WHERE `id`='".$team_id."' ;";
            }
                        file_put_contents('1.txt',$query);
                        $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
                        if ($result)
                        {
                             $message = "Success" ;
                            file_put_contents('1.txt',$query);
                            redirect_to("team.php");                            
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