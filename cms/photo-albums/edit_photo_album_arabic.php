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
$ph_album_id= $_GET['ph_album_id'];

$query = "SELECT * FROM `photo-albums` where `id` =".$ph_album_id." LIMIT 1";
//file_put_contents('1.txt',$query);
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
$output = "";
$projectImages = "";
global $message; 
while ($row = mysqli_fetch_assoc($result)) {
    $ph_album_id= $row['id'];
    $ph_album_title_arabic= $row['ph_album_title_arabic'];
    $ph_album_desc_arabic = $row['ph_album_desc_arabic'];
    
    
  
        $dirOrFolder = "Folder: ";
                   
    
    $output .= '<div class="rp row"><form action="edit_photo_album_arabic.php?ph_album_id='.$ph_album_id.'" method="post" enctype="multipart/form-data">
         
        <div class="cmsalbum col-sm-9">
        <h1 class="text-center col-md-offset-4">Add/Edit Photo Album Arabic</h1>
                           
              <div class="row">     <span class="col-sm-4"> Photo Album Name: </span><input class="col-sm-8" type="text" name="ph_album_title_arabic" value="'.$ph_album_title_arabic.'" /> <br/></div>
              
                <div class="row">     <span class="col-sm-4"> Photo Album Description : </span><textarea type="text" name="ph_album_desc_arabic" value="'.$ph_album_desc_arabic.'" /> '.$ph_album_desc_arabic.' </textarea> <br/></div>';
    

        
    
   
                     $output .='<input class="col-sm-offset-7" type="submit" name="submit" value="Edit" />
                    <a href="photo_albums.php"><img src="../../includes/cancel.png" style="width:20px;"/><span class="parawho alert-link" style="font-size:15px;margin-left:0">Cancel</span></a>
                    </form></div>';

}

?>


<?php
 
    
if (isset($_POST['submit']))
{
    
  
    
     if (isset($_POST['ph_album_title_arabic']))
                  {
        
        
             

  
         
                      $ph_album_title_arabic = mysql_prep($_POST['ph_album_title_arabic']);
                          
                      $ph_album_desc_arabic = mysql_prep($_POST['ph_album_desc_arabic']);
                      $date = date('Y-m-d H:i:s');
         
         
                          $query = "UPDATE `photo-albums`
                                    SET `ph_album_title_arabic`='".$ph_album_title_arabic."', `ph_album_desc_arabic`='".$ph_album_desc_arabic."', publish_date='".$date."'
                                    WHERE `id`='".$ph_album_id."' ;";
                        file_put_contents('1.txt',$query);
                        $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
                        if ($result)
                        {
                             $message = "Success" ;
                            file_put_contents('1.txt',$query);
                            redirect_to("edit_photo_album_arabic.php?ph_album_id={$ph_album_id}");                            
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