<?php include_once('../common/admin-header.php');?>
<?php confirm_logged_in();?>
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
$video_album_id= $_GET['video_album_id'];

$query = "SELECT * FROM `video-albums` where `id` =".$video_album_id." LIMIT 1";
//file_put_contents('1.txt',$query);
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
$output = "";
global $message; 
while ($row = mysqli_fetch_assoc($result)) {
    $video_album_id= $row['id'];
    $video_album_title= $row['video_album_title'];
    $video_album_desc = $row['video_album_desc'];
    $video_url = $row['video_url'];
    
    
  
        
                   
    
    $output .= '<div class="rp row"><form action="edit_video_album.php?video_album_id='.$video_album_id.'" method="post" enctype="multipart/form-data">
         
        <div class="cmsalbum col-sm-9">
        <h1 class="col-md-offset-4 text-center">Edit Video</h1>
                           
              <div class="row">     <span class="col-sm-4"> Video Title: </span><input class="col-sm-8" type="text" name="video_album_title" value="'.$video_album_title.'" /> <br/></div>
              <div class="row">     <span class="col-sm-4"> Video URL: </span><input class="col-sm-8" type="text" name="video_url" value="'.$video_url.'" /> <br/></div>
              
                <div class="row">     <span class="col-sm-4"> Video Description : </span><textarea type="text" name="video_album_desc" value="'.$video_album_desc.'" /> '.$video_album_desc.' </textarea> <br/></div>';
      
    
    $output .='<div class="row">
    <input class="col-sm-offset-7" type="submit" name="submit" value="Edit" />
                    <a href="video_albums.php"><img src="../../includes/cancel.png" style="width:20px;"/><span class="parawho alert-link" style="font-size:15px;margin-left:0">Cancel</span></a>
                    </div></form></div>';

                              
                             
                          
}

?>


<?php

if (isset($_POST['submit']))
{
     if (isset($_POST['video_album_title']))
                  {
        
         
             

  
         
                      $video_album_title = mysql_prep($_POST['video_album_title']);
                          
                      $video_album_desc = mysql_prep($_POST['video_album_desc']);
                      $video_url = mysql_prep($_POST['video_url']);
                      $date = date('Y-m-d H:i:s');
         
         
                          $query = "UPDATE `video-albums`
                                    SET `video_album_title`='".$video_album_title."', `video_album_desc`='".$video_album_desc."', `video_url`='".$video_url."', publish_date='".$date."'
                                    WHERE `id`='".$video_album_id."' ;";
                        file_put_contents('1.txt',$query);
                        $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
                        if ($result)
                        {
                             $message = "Success" ;
                            file_put_contents('1.txt',$query);
                            redirect_to("edit_video_album.php?video_album_id={$video_album_id}");                            
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