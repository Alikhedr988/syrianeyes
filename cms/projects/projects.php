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
            $query = "SELECT * FROM projects ORDER BY publish_date desc";
            $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
            $output = "";
            
            $add_project = '<a href="add_project.php"><span class="glyphicon glyphicon-plus" style="font-size:20px">Add Project</span></a>';
                    //test if there is query error
                   while ($row = mysqli_fetch_assoc($result)) {
                // output data of each row
                
                    $project_id = $row['project_id'];
                    $project_name= $row['project_name'];
                    $project_type_id = $row['project_type_id'];    
                    $project_desc_title = $row['project_desc_title'];    
                    $project_desc = $row['project_desc'];    
                    $project_cover = $row['project_cover'];    
                    $project_folder = str_replace('_', ' ', $project_name);  
                       
                   
                   $output .= '<div class="rp paragraphContainer col-sm-12" >';
                    $output.= '<input type="hidden" name="project_id" value="'.$project_id.'" />';
                   $output .='<div class="row" style="padding-top:30px"><span class="col-md-4">Project Name: </span><span class="col-sm-5 pageTitle" type="text" name="title" value="" >'.htmlspecialchars($project_folder).'</span> <br/></div>
                   <div class="row" style="padding-top:30px"> <br/>
                 <div class="col-md-offset-3"> <a href="edit_project.php?project_id='.$project_id.'"><img src="../../includes/edit.png" style="width:12px;margin-left:17px"/><span class="edit alert-link" style="font-size:15px">Edit</span></a>
                  <a href="edit_project_arabic.php?project_id='.$project_id.'"><img src="../../includes/edit.png" style="width:12px;margin-left:17px"/><span class="edit alert-link" style="font-size:15px">Add/Edit Arabic</span></a>
                    <a href="delete_project.php?project_id='.$project_id.'"><img src="../../includes/delete.png" style="width:12px;margin-left:20px"/><span class="edit alert-link" style="font-size:15px;margin-left:0px">Delete</span></a></div>
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

