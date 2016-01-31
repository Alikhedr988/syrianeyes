<?php include_once('../common/admin-header.php');?>
<?php confirm_logged_in();?>
<script type="text/javascript">
$(document).ready(function() {
  $('#file_upload').uploadify({
    'uploader'  : '../../includes/uploadify/uploadify.swf',
    'script'    : './../inc/uploadify/uploadify.php',
    'cancelImg' : '../../includes/uploadify/cancel.png',
    'folder'    : '../../Data/partners/',
    'auto'      : true
  });
});
</script>

<?php
$subject_type = $_GET['type'];
$query = "SELECT * FROM subject where subject_type = {$subject_type}";
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
$output = "";
 if ($subject_type==1)
{
     $output .="<h1> Partner </h1>";
     $target_dir = "../../Data/partners/";
     $type = 'Link'; 
}
else if ($subject_type==2)
{
    $output .="<h1> Latest News</h1>";
    $target_dir = "../../Data/latest/";
    $type = 'Description';
}
        //test if there is query error
       while ($row = mysqli_fetch_assoc($result)) {
    // output data of each row
        $id = $row['id'];
        $title = $row['title'];
        $photo = $row['photo'];
        $content = $row['content'];
           $output .= '<div class="col-md-9 paragraphContainer" style="padding-top:30px"><form name="submit" action="viewsubject.php?type='.$subject_type.'" method="post" enctype="multipart/form-data">
         
        <div class="cmsalbum col-sm-9">
                           <input type="hidden" name="id" value="'.$id.'" />
                           <div class="row">  <span class="col-sm-3"> Title: </span><input class="col-sm-9" type="text" name="title" value="'.htmlspecialchars($title).'" /> <br/></div><br/>
                 <div class="row">  <span class="col-sm-3"> Photo: </span>
                  <input class="col-sm-5"  type="file" name="fileToUpload" id="fileToUpload" value="'.$photo.'">
                 <img class="col-sm-4 img-rounded" class="displaySelected" src="'.$target_dir.$photo.'" />
                 <br/></div><br/>
                  <div class="row">    <span class="col-sm-3">';
           if ($subject_type==1)
           {
           $output .= 'Link: '; 
           $output .='</span><input class="col-sm-5" type="text" name="content" value="'.htmlspecialchars($content).'" /> <br/>';
           }
           else if ($subject_type==2)
           {
           $output .= 'Description: '; 
           $output .='</span><textarea class="col-sm-5 description"  name="content" value="'.htmlspecialchars($content).'" >'.htmlspecialchars($content).' </textarea><br/>';
           }
           
           $output .='</div>
                    <input class="col-sm-offset-5" type="submit" name="submit" value="Submit" />
        
        </form><br/><br/></div></div>';
                    }

 $output .= '<div class="col-md-8"><hr class="newpartnerdivider"/></div><div class="col-md-8 paragraphContainer"><form name="new" action="viewsubject.php?type='.$subject_type.'" method="post" enctype="multipart/form-data">
         
        <div class="cmsalbum col-sm-9">';
           if ($subject_type==1)
           {
           $output .= '<h1 class="col-sm-offset-4">New Partner</h1>'; 
               $output.='<div class="row">     <span class="col-sm-3"> Title: </span><input class="col-sm-8" type="text" name="newtitle" value="" /> <br/></div>
            <div class="row">     <span class="col-sm-3"> Photo: </span>
            <input class="col-sm-4"  type="file" name="fileToUploadNew" id="fileToUploadNew" >
                 <img class="col-sm-2 img-rounded" class="displaySelected"  />
            
            <br/></div>
                   <div class="rp row"> <span class="col-sm-3">'.$type.': </span><input type="text" class="col-sm-8" type="text" name="newcontent" value="" > </div> <br/>
                     <input class="col-sm-offset-5" type="submit" name="new" value="Add" />
        
        </form></div>';
           }
           else if ($subject_type==2)
           {
           
           }
                           
            

?>  
<?php
if (isset($_POST['submit']))
         {  
  
    if ($_FILES['fileToUpload']['size'] != 0)
            {
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
            $id = $_POST['id'];
            $title = $_POST['title'];
             if ($_FILES['fileToUpload']['size'] != 0)
            {
            $photo = basename($_FILES["fileToUpload"]["name"]);
             }
    echo 'here ' .$photo;
            $content = $_POST['content'];
           
            $query = "UPDATE subject SET
            title = '".$title."',
            photo = '".$photo."',
            content='".$content."',
            subject_type='".$subject_type."'
            where id = ".$id."
            LIMIT 1";
            file_put_contents('test.txt',$query);
            $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
            //test if there is query error
            if ($result && mysqli_affected_rows($connection)>=0)
            {
                $_SESSION['message'] = "item Edited";
                 $_SESSION['message'];
               redirect_to('viewsubject.php?type='.$subject_type.'');
            }
            else
            {
                $_SESSION['message']= "item edit failed";
            }


        }

?>
<?php
if (isset($_POST['new']))
         {  
    if ($_FILES['fileToUpload']['size'] != 0)
    {
    $target_file = $target_dir . basename($_FILES["fileToUploadNew"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $check = getimagesize($_FILES["fileToUploadNew"]["tmp_name"]);
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
if ($_FILES["fileToUploadNew"]["size"] > 5000000) {
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUploadNew"]["tmp_name"], $target_file)) {
        echo "The file ". basename($_FILES["fileToUploadNew"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
    }
            $newtitle = mysql_prep($_POST['newtitle']);   
            $newphoto = mysql_prep($_POST['newphoto']);
            $newcontent = mysql_prep($_POST['newcontent']);
            
            $query = "INSERT INTO subject (`title`,`photo`,`content`,`subject_type`) values ('".$newtitle."','".$newphoto."','".$newcontent."','".$subject_type."')";
            file_put_contents('test.txt',$query);
            $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
            //test if there is query error
            if ($result && mysqli_affected_rows($connection)>=0)
            {
                $_SESSION['message'] = "Subject created";
                 
               redirect_to('viewsubject.php?type='.$subject_type.'');
            }
            else
            {
                $_SESSION['message']= "New subject failed";
            }


        }

?>

        <div class="col-sm-3">
        <?php include_once('..'.DS.'menu'.DS.'cmsmenu.php'); ?>
           </div>
        <div class="col-sm-9 infocontainer">
       <?= $output?>
            </div>
            </div>
    
    </div>