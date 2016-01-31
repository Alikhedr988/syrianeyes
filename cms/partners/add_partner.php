<?php include_once('../common/admin-header.php');?>
<?php confirm_logged_in();?>
<?php

$output = "";
$message="";

if(isset($_POST['submit']))
{   
     if (isset($_POST['partners_name']) && isset($_POST['partners_link'])  )
     {
         
                      $partners_name = mysql_prep($_POST['partners_name']);
                      $partners_link = mysql_prep($_POST['partners_link']);
                     $date = date('Y-m-d H:i:s');
                     
                      $query = "INSERT INTO `partners` (`partners_name`,`partners_link`,`publish_date`)
VALUES ('".$partners_name."','".$partners_link."','".$date."');";
            file_put_contents('1.txt',$query);
                        $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
                        if ($result)
                        {
                             $message = "Success" ;
                            file_put_contents('1.txt',$message);
                            redirect_to("partners.php");
                            
                        }
                      else
                      {
                            file_put_contents('1.txt',$query);
                          
                      }
                  }
}


 $output .= '<div class="rp paragraphContainer col-sm-12" >';
                       $output .= "<form method='post' action='add_partner.php'>";
                       $output .='<div class="row" style="padding-top:30px"><span class="col-md-4">Partner Name: </span><input type="text" class="col-sm-5 pageTitle" name="partners_name" value="" /> <br/></div>
                   <div class="row" style="padding-top:30px"><span class="col-md-4">Page Link: </span><input type="text" class="col-sm-5 pageTitle" name="partners_link" value="" /> <br/></div>
                   <div class="row" style="padding-top:30px"> <br/>
                 <div class="col-md-offset-4"> <input class="edit alert-link" type="submit" name="submit">
                    </div>
                   </div></form></div>';
?>  

        
        <?php include_once('..'.DS.'menu'.DS.'cmsmenu.php'); ?>
          
        <div class="col-sm-9 infocontainer">
       <?= $output?>
            </div>
            </div>
    
    </div>