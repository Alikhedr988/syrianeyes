<?php include_once('../common/admin-header.php');?>
<?php confirm_logged_in();
$output = "";
$add_gallery ="";
?>
<?php
if (isset($_POST['submit']) )
         {  
            
            $id = $_POST['id'];
            $link =mysqli_real_escape_string($connection, $_POST['link']);
            
           
            $query = "UPDATE social SET
            link = '".$link."' 
            where id='".$id."'
            LIMIT 1";
            file_put_contents('test.txt',$query);
            $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
            //test if there is query error
            if ($result && mysqli_affected_rows($connection)>=0)
            {
                $_SESSION['message'] = "item Edited";
                 
               redirect_to('social-media.php');
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
            $query = "SELECT * FROM social ORDER BY id desc";
            $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
            $output = "";
            
            
                    //test if there is query error
                   while ($row = mysqli_fetch_assoc($result)) {
                // output data of each row
                
                    $id = $row['id'];
                    $title= $row['title'];
                    $link = $row['link'];    
                   
                       
                   
                   $output .= '<div class="rp paragraphContainer col-sm-12" >';
                       $output .= "<form method='post' action='social-media.php'>";
                    $output.= '<input type="hidden" name="id" value="'.$id.'" />';
                   $output .='<div class="row" style="padding-top:30px"><span class="col-md-4">Email For: </span><span  class="col-sm-5 pageTitle" name="title" >'.htmlspecialchars($title).'</span> <br/></div>
                   <div class="row" style="padding-top:30px"><span class="col-md-4">Email address: </span><input type="text" class="col-sm-5 pageTitle" name="link" value="'.htmlspecialchars($link).'" /> <br/></div>
                   <div class="row" style="padding-top:30px"> <br/>
                 <div class="col-md-offset-5"> <input class="edit alert-link" type="submit" name="submit">
                   </div>
                   </div></form></div>';
                   // $output .='<div class="row" style="padding-top:30px"><span class="col-md-2">Content: </span><textarea class="col-sm-5 pageContent" type="text" name="content" value="'.htmlspecialchars($content).'" >'.htmlspecialchars($content).'</textarea> <br/></div>';
                       
           
       }

//        }

?>


        
        <?php include_once('..'.DS.'menu'.DS.'cmsmenu.php'); ?>

        <div class="col-sm-10 infocontainer">
            
            
              
                <div class="row" style="margin-top:10px">
        

                    </div>
                   
                
                <div class="row" style="margin-top:10px">
                <?=$output?>
                    
                </div>
                </form>
            </div>
            </div>
    
    </div>

