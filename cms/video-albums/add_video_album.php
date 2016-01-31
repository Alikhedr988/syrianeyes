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

$output = "";
$message="";

if(isset($_POST['submit']))
{
        if (isset($_POST['video_album_title']))
            {
             
            $video_album_title= $_POST['video_album_title'];
            $video_album_desc = $_POST['video_album_desc'];
            $video_url = $_POST['video_url'];
           
                     $date = date('Y-m-d H:i:s');
                     
                      $query = "INSERT INTO `video-albums` (`video_album_title`,`video_album_desc`,`video_url`,`publish_date`)
VALUES ('".$video_album_title."','".$video_album_desc."','".$video_url."','".$date."');";
            file_put_contents('1.txt',$query);
                        $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
                        if ($result)
                        {
                             $message = "Success" ;
                            file_put_contents('1.txt',$message);
                            redirect_to("video_albums.php");
                            
                        }
                      else
                      {
                            file_put_contents('1.txt',$query);
                          
                      }
                  }
}




$input = '<input class="col-sm-4" style="padding-top:30px;"  type="file" name="fileToUpload" id="fileToUpload" value="">';

 $output .= '<div class="rp row"><form name="submit" action="add_video_album.php" method="post">
         
        <div class="cmsalbum col-sm-12">
        <h1 class="text-center">New Video</h1>
                           
              <div class="row">     <span class="col-sm-3">Video Title: </span><input class="col-sm-9" type="text" name="video_album_title" value="" /> <br/><br/></div>
               <div class="row">     <span class="col-sm-3">Video URL: </span><input class="col-sm-9" type="text" name="video_url" value="" /> <br/><br/></div>
              <div class="row">     <span class="col-sm-3">Video Description: </span><textarea class="col-sm-2" type="text" name="video_album_desc" value="" /> </textarea></div>
                  
                     <input class="col-sm-offset-5" type="submit" name="submit" value="Add" />
                    <a href="video_albums.php"><span class="glyphicon glyphicon-arrow-left"> Cancel </span></a>
        </form></div>';

?>  

        
        <?php include_once('..'.DS.'menu'.DS.'cmsmenu.php'); ?>
          
        <div class="col-sm-9 infocontainer">
       <?= $output?>
            </div>
            </div>
    
    </div>