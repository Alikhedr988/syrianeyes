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
$media_id= $_GET['media_id'];

$query = "SELECT * FROM `media-media` where `id` =".$media_id." LIMIT 1";
//file_put_contents('1.txt',$query);
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
$output = "";
$projectImages = "";
global $message; 
while ($row = mysqli_fetch_assoc($result)) {
    $media_id= $row['id'];
    $media_title_arabic= $row['media_title_arabic'];
    $media_desc_arabic = $row['media_desc_arabic'];
    
    
    
                   
    
    $output .= '<div class="rp row"><form action="edit_media_arabic.php?media_id='.$media_id.'" method="post" enctype="multipart/form-data">
         
        <div class="cmsalbum col-sm-9">
        <h1 class="text-center col-md-offset-4">Edit Media Arabic</h1>
                           
              <div class="row">     <span class="col-sm-4"> Media Name: </span><input class="col-sm-8" type="text" name="media_title_arabic" value="'.$media_title_arabic.'" /> <br/></div>
              
                <div class="row">     <span class="col-sm-4"> Media Description : </span><textarea type="text" name="media_desc_arabic" value="'.$media_desc_arabic.'" /> '.$media_desc_arabic.' </textarea> <br/></div>';
    

  
    
                     $output .='<input class="col-sm-offset-4" type="submit" name="submit" value="Edit" />
                    <a href="media.php"><img src="../../includes/cancel.png" style="width:20px;"/><span class="parawho alert-link" style="font-size:15px;margin-left:0">Cancel</span></a>
                    </form></div>';

                              
                       
                          
}

?>


<?php
    
    
if (isset($_POST['submit']))
{
    
  
    
    
     if (isset($_POST['media_title_arabic']))
                  {
        
         
         
                      $media_title_arabic = mysql_prep($_POST['media_title_arabic']);
                      $media_desc_arabic = mysql_prep($_POST['media_desc_arabic']);
                      $date = date('Y-m-d H:i:s');
         
         
                          $query = "UPDATE `media-media`
                                    SET `media_title_arabic`='".$media_title_arabic."', `media_desc_arabic`='".$media_desc_arabic."', publish_date='".$date."'
                                    WHERE `id`='".$media_id."' ;";
                        file_put_contents('1.txt',$query);
                        $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
                        if ($result)
                        {
                             $message = "Success" ;
                            file_put_contents('1.txt',$query);
                            redirect_to("edit_media_arabic.php?media_id={$media_id}");                            
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