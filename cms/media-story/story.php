<?php include_once('../common/admin-header.php');?>
<?php confirm_logged_in();
$output = "";
$add_gallery ="";
?>

<?php
//if (isset($_POST['chooseT']))
//         { 
            $query = "SELECT * FROM `media-story` ORDER BY publish_date desc";
            file_put_contents('1.txt',$query);
            if ($result = mysqli_query($connection , $query)); //this is excuted in case of insert and delete and update as well
            $output = "";
            
            $add_project = '<a href="add_story.php"><span class="glyphicon glyphicon-plus" style="font-size:20px">Add Story</span></a>';
                    //test if there is query error
                   while ($row = mysqli_fetch_assoc($result)) {
                // output data of each row
                
                    $story_id = $row['id'];
                    $story_title= $row['story_title'];
                    $story_desc = $row['story_desc'];    
                    $story_cover = $row['story_cover'];    
                    $story_folder = str_replace('_', ' ', $story_title);  
                       
                   
                   $output .= '<div class="rp paragraphContainer col-sm-12" >';
                    $output.= '<input type="hidden" name="story_id" value="'.$story_id.'" />';
                   $output .='<div class="row" style="padding-top:30px"><span class="col-md-4">Album Title: </span><span class="col-sm-5 pageTitle" type="text" name="title" value="" >'.htmlspecialchars($story_folder).'</span> <br/></div>
                   <div class="row" style="padding-top:30px"><span class="col-md-4">Share Link: </span><span class="col-sm-8 pageTitle" type="text" name="title" value="" >http://www.syrianeyes.org/shared-link.php?table=media-story&id='.$story_id.'</span> <br/></div>
                   <div class="row" style="padding-top:30px"> <br/>
                 <div class="col-md-offset-4"> <a href="edit_story.php?story_id='.$story_id.'"><img src="../../includes/edit.png" style="width:12px;margin-left:17px"/><span class="edit alert-link" style="font-size:15px">Edit</span></a>
                 <a href="edit_story_arabic.php?story_id='.$story_id.'"><img src="../../includes/edit.png" style="width:12px;margin-left:17px"/><span class="edit alert-link" style="font-size:15px">Add/Edit Arabic</span></a>
                    <a href="delete_story.php?story_id='.$story_id.'"><img src="../../includes/delete.png" style="width:12px;margin-left:20px"/><span class="edit alert-link" style="font-size:15px;margin-left:0px">Delete</span></a></div>
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

