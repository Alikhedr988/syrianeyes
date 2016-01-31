<?php include_once('../common/admin-header.php');?>
<?php confirm_logged_in();
$output = "";
$add_gallery ="";
?>
<?php
if (isset($_POST['submit']) )
         {  
            
            $id = mysqli_real_escape_string($connection,$_POST['id']);
            $partners_name =mysqli_real_escape_string($connection, $_POST['partners_name']);
            $partners_link = mysqli_real_escape_string($connection, $_POST['partners_link']);
           
            $query = "UPDATE partners SET
            partners_name = '".$partners_name."' , partners_link = '".$partners_link."' , publish_date= now()
            where id='".$id."'
            LIMIT 1";
            file_put_contents('test.txt',$query);
            $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
            //test if there is query error
            if ($result && mysqli_affected_rows($connection)>=0)
            {
                $_SESSION['message'] = "item Edited";
                 $_SESSION['message'];
               redirect_to('partners.php');
            }
            else
            {
                $_SESSION['message']= "item edit failed";
            }

}
?>
<?php
//if (isset($_POST['chooseT']))
//         { 
            $query = "SELECT * FROM partners ORDER BY publish_date desc";
            $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
            $output = "";
            
            $add_partner = '<a href="add_partner.php"><span class="glyphicon glyphicon-plus" style="font-size:20px">Add a Partner</span></a>';
                    //test if there is query error
                   while ($row = mysqli_fetch_assoc($result)) {
                // output data of each row
                
                    $id = $row['id'];
                    $partners_name= $row['partners_name'];
                    $partners_link = $row['partners_link'];    
                   
                       
                   
                   $output .= '<div class="rp paragraphContainer col-sm-12" >';
                       $output .= "<form method='post' action='partners.php'>";
                    $output.= '<input type="hidden" name="id" value="'.$id.'" />';
                   $output .='<div class="row" style="padding-top:30px"><span class="col-md-4">Partner Name: </span><input type="text" class="col-sm-5 pageTitle" name="partners_name" value="'.htmlspecialchars($partners_name).'" /> <br/></div>
                   <div class="row" style="padding-top:30px"><span class="col-md-4">Page Link: </span><input type="text" class="col-sm-5 pageTitle" name="partners_link" value="'.htmlspecialchars($partners_link).'" /> <br/></div>
                   <div class="row" style="padding-top:30px"> <br/>
                 <div class="col-md-offset-5"> <input class="edit alert-link" type="submit" name="submit">
                    <a href="delete_partner.php?id='.$id.'"><img src="../../includes/delete.png" style="width:12px;margin-left:20px"/><span class="edit alert-link" style="font-size:15px;margin-left:0px">Delete</span></a></div>
                   </div></form></div>';
                   // $output .='<div class="row" style="padding-top:30px"><span class="col-md-2">Content: </span><textarea class="col-sm-5 pageContent" type="text" name="content" value="'.htmlspecialchars($content).'" >'.htmlspecialchars($content).'</textarea> <br/></div>';
                       
           
       }

//        }

?>


        
        <?php include_once('..'.DS.'menu'.DS.'cmsmenu.php'); ?>

        <div class="col-sm-10 infocontainer">
            
            
              
                <div class="row" style="margin-top:10px">
        

                    </div>
                   
                <?=$add_partner?>
                <div class="row" style="margin-top:10px">
                <?=$output?>
                    
                </div>
                </form>
            </div>
            </div>
    
    </div>

