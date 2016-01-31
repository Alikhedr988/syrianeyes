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
$story_id= $_GET['story_id'];

$query = "SELECT * FROM `media-story` where `id` =".$story_id." LIMIT 1";
//file_put_contents('1.txt',$query);
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well

$output = "";
$projectImages = "";
global $message; 

while ($row = mysqli_fetch_assoc($result)) {
    $story_id= $row['id'];
    $story_title_arabic= $row['story_title_arabic'];
    $story_desc_arabic= $row['story_desc_arabic'];

    
  
        $dirOrFolder = "Folder: ";
                   
    
    $output .= '<div class="rp row"><form action="edit_story_arabic.php?story_id='.$story_id.'" method="post" enctype="multipart/form-data">
         
        <div class="cmsalbum col-sm-9">
        <h1 class="text-center col-md-offset-4">Edit Story</h1>
                           
              <div class="row">     <span class="col-sm-4"> Story Name: </span><input class="col-sm-8" type="text" name="story_title_arabic" value="'.$story_title_arabic.'" /> <br/></div>
              
                <div class="row">     <span class="col-sm-4"> Story Description : </span><textarea type="text" name="story_desc_arabic" value="'.$story_desc_arabic.'" /> '.$story_desc_arabic.' </textarea> <br/></div> ';
    

      
    
    
    
                     $output .='<input class="col-sm-offset-7" type="submit" name="submit" value="Edit" />
                    <a href="story.php"><img src="../../includes/cancel.png" style="width:20px;"/><span class="parawho alert-link" style="font-size:15px;margin-left:0">Cancel</span></a>
                    </form></div>';
}

?>


<?php


    
if (isset($_POST['submit']))
{
     if (isset($_POST['story_title_arabic']))
                  {
                      $story_title_arabic = mysql_prep($_POST['story_title_arabic']);
                          
                      $story_desc_arabic = mysql_prep($_POST['story_desc_arabic']);
                      $date = date('Y-m-d H:i:s');
         
         
                          $query = "UPDATE `media-story`
                                    SET `story_title_arabic`='".$story_title_arabic."', `story_desc_arabic`='".$story_desc_arabic."', publish_date='".$date."'
                                    WHERE `id`='".$story_id."' ;";
                        file_put_contents('1.txt',$query);
                        $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
                        if ($result)
                        {
                             $message = "Success" ;
                            file_put_contents('1.txt',$query);
                            redirect_to("edit_story_arabic.php?story_id={$story_id}");                            
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