<?php include_once('../common/admin-header.php');?>
<?php confirm_logged_in();?>
<?php
$query = "SELECT * FROM whoweare";
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
$output = "<h1 class='text-center'>Who We Are</h1>";
        //test if there is query error
       while ($row = mysqli_fetch_assoc($result)) {
    // output data of each row
        $id = $row['id'];
        $whotext = $row['whotext'];
        $whotext_arabic = $row['whotext_arabic'];
           $output .= '<div class="col-md-12 paragraphContainer" style="padding-top:30px"><form name="submit" action="who.php" method="post">
         
        <div class="cmsalbum col-sm-9">
                           <input type="hidden" name="id" value="'.$id.'" />
                 
                  <div class="row">    <span class="col-sm-10">Who Are We? </span></div>
                  <div class="row"><textarea class="col-sm-11" name="whotext" value="'.htmlspecialchars($whotext).'" />'.$whotext.' </textarea></div><br/>
                  <div class="row"><textarea class="col-sm-11" name="whotext_arabic" value="'.htmlspecialchars($whotext_arabic).'" />'.$whotext_arabic.' </textarea></div><br/>
                    <input class="col-sm-offset-9" type="submit" name="submit" value="Submit" />
       
        </form><br/><br/></div></div>';
                    }


?>  
<?php
if (isset($_POST['submit']) )
         {  
            
            $whotext = $_POST['whotext'];
            $whotext_arabic = $_POST['whotext_arabic'];
            $query = "UPDATE whoweare SET
            whotext = '".$whotext."' , 
            whotext_arabic = '".$whotext_arabic."'
            LIMIT 1";
            file_put_contents('test.txt',$query);
            $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
            //test if there is query error
            if ($result && mysqli_affected_rows($connection)>=0)
            {
                $_SESSION['message'] = "item Edited";
                 $_SESSION['message'];
               redirect_to('who.php');
            }
            else
            {
                $_SESSION['message']= "item edit failed";
            }

}
?>

        
        <?php include_once('..'.DS.'menu'.DS.'cmsmenu.php'); ?>
          
        <div class="col-sm-9 infocontainer">
       <?= $output?>
            </div>
            </div>
    
    </div>
