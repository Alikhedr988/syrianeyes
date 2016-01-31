<?php include_once('../common/admin-header.php');?>
<?php confirm_logged_in();
$output = "";
$add_gallery ="";
?>

<?php
//$query = "SELECT * FROM projects ORDER BY id";
//$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
//$selectPage = "<select name='chooseT' id='chooseT' class='col-sm-2' >";
//        //test if there is query error
//       while ($row = mysqli_fetch_assoc($result)) {
//    // output data of each row
//       
//        $id = $row['project_id'];
//           //$photo = $row['photo'];
//        //$description = $row['description'];
//          $selectPage .=" <option value ='".$id."' >".$row['gal_name']."</option>";
//           
//       }
//$selectPage .= "</select>";
?>
<?php
//if (isset($_POST['chooseT']))
//         { 
            $query = "SELECT * FROM `video-albums` ORDER BY publish_date desc";
            file_put_contents('1.txt',$query);
            $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
            $output = "";
            
            $add_project = '<a href="add_video_album.php"><span class="glyphicon glyphicon-plus" style="font-size:20px">Add Video</span></a>';
                    //test if there is query error
                   while ($row = mysqli_fetch_assoc($result)) {
                // output data of each row
                
                    $video_album_id = $row['id'];
                    $video_album_title= $row['video_album_title'];
                    $video_album_desc = $row['video_album_desc'];    
                    $video_url = $row['video_url'];    
                    
                   $output .= '<div class="rp paragraphContainer col-sm-12" >';
                    $output.= '<input type="hidden" name="video_album_id" value="'.$video_album_id.'" />';
                   $output .='<div class="row" style="padding-top:30px"><span class="col-md-4">Project Name: </span><span class="col-sm-5 pageTitle" type="text" name="title" value="" >'.htmlspecialchars($video_album_title).'</span> <br/></div>
                    <div class="row" style="padding-top:30px"><span class="col-md-4">Share Link: </span><span class="col-sm-8 pageTitle" type="text" name="title" value="" >http://www.syrianeyes.org/shared-link.php?table=video-albums&id='.$video_album_id.'</span> <br/></div>
                   <div class="row" style="padding-top:30px"> <br/>
                 <div class="col-md-offset-4"> <a href="edit_video_album.php?video_album_id='.$video_album_id.'"><img src="../../includes/edit.png" style="width:12px;margin-left:17px"/><span class="edit alert-link" style="font-size:15px">Edit</span></a>
                 <a href="edit_video_album_arabic.php?video_album_id='.$video_album_id.'"><img src="../../includes/edit.png" style="width:12px;margin-left:17px"/><span class="edit alert-link" style="font-size:15px">Add/Edit Arabic</span></a>
                    <a href="delete_video_album.php?video_album_id='.$video_album_id.'"><img src="../../includes/delete.png" style="width:12px;margin-left:20px"/><span class="edit alert-link" style="font-size:15px;margin-left:0px">Delete</span></a></div>
                   </div></div>';
                   // $output .='<div class="row" style="padding-top:30px"><span class="col-md-2">Content: </span><textarea class="col-sm-5 pageContent" type="text" name="content" value="'.htmlspecialchars($content).'" >'.htmlspecialchars($content).'</textarea> <br/></div>';
                       
           
       }

//        }

?>


        
        <?php include_once('..'.DS.'menu'.DS.'cmsmenu.php'); ?>

        <div class="col-sm-10 infocontainer">
            
            <form class="col-sm-12" name="submit" style='padding-top:30px' action="galleries.php" method="POST" >
              
                <div class="row" style="margin-top:10px">
        

                    </div>
                   
                <?=$add_project?>
                <div class="row" style="margin-top:10px">
                <?=$output?>
                    
                </div>
                </form>
            </div>
            </div>
    
    </div>

