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
            $query = "SELECT * FROM `team` ORDER BY id desc";
            file_put_contents('1.txt',$query);
            if ($result = mysqli_query($connection , $query)); //this is excuted in case of insert and delete and update as well
            $output = "";
            
            $add_project = '<a href="add_team.php"><span class="glyphicon glyphicon-plus" style="font-size:20px">Add a Team Member</span></a>';
                    //test if there is query error
                   while ($row = mysqli_fetch_assoc($result)) {
                // output data of each row
                
                    $team_id = $row['id'];
                    $name= $row['name'];
                    $position = $row['position'];   
                    $name_arabic= $row['name_arabic'];
                    $position_arabic = $row['position_arabic'];    
                    $phone = $row['phone'];    
                    $email = $row['email'];    
                    $image = $row['image'];    
                    
                       
                   
                   $output .= '<div class="rp paragraphContainer col-sm-12" >';
                    $output.= '<input type="hidden" name="team_id" value="'.$team_id.'" />';
                   $output .='<div class="row" style="padding-top:30px"><span class="col-md-4">Name: </span><span class="col-sm-5 pageTitle" type="text" name="title" value="" >'.htmlspecialchars($name).'</span><img class="img-circle col-md-1" src="../../includes/uploads/team/'.$image.'" <br/></div>
                   <div class="row" style="padding-top:30px"><span class="col-md-4">Position: </span><span class="col-sm-5 pageTitle" type="text" name="title" value="" >'.htmlspecialchars($position).'</span> <br/></div>
                   <div class="row" style="padding-top:30px"><span class="col-md-4">Name Arabic: </span><span class="col-sm-5 pageTitle" type="text" name="title" value="" >'.htmlspecialchars($name_arabic).'</span></div>
                   <div class="row" style="padding-top:30px"><span class="col-md-4">Position Arabic: </span><span class="col-sm-5 pageTitle" type="text" name="title" value="" >'.htmlspecialchars($position_arabic).'</span> <br/></div>
                   <div class="row" style="padding-top:30px"><span class="col-md-4">Phone Number: </span><span class="col-sm-5 pageTitle" type="text" name="title" value="" >'.htmlspecialchars($phone).'</span> <br/></div>
                   <div class="row" style="padding-top:30px"><span class="col-md-4">E-mail: </span><span class="col-sm-5 pageTitle" type="text" name="title" value="" >'.htmlspecialchars($email).'</span> <br/></div>
                   <div class="row" style="padding-top:30px"> <br/>
                 <div class="col-md-offset-4"> <a href="edit_team.php?team_id='.$team_id.'"><img src="../../includes/edit.png" style="width:12px;margin-left:17px"/><span class="edit alert-link" style="font-size:15px">Edit</span></a>
                    <a href="delete_team.php?team_id='.$team_id.'"><img src="../../includes/delete.png" style="width:12px;margin-left:20px"/><span class="edit alert-link" style="font-size:15px;margin-left:0px">Delete</span></a></div>
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

