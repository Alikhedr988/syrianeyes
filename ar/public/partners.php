<?php
include_once("../includes/db_connection.php");
$query = "SELECT * FROM partners ORDER BY publish_date desc";
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
     $output='<ul class="partners-container col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1 hideme2">';
       while ($row = mysqli_fetch_assoc($result)) {
    // output data of each row
        $partners_name = $row['partners_name'];
        $partners_link = $row['partners_link'];
        $displayed_link='';
        $close_link='';
           if ($partners_link != null)
           {
           $displayed_link .='<a class="nav mobile-font-size" target="_blank" href="'.$partners_link.'">';
           $close_link .= '</a>';
               
           }
           $output .='<li>';
           $output .=$displayed_link;
           $output .=$partners_name;
           $output .=$close_link;
           $output .='</li>' ;
       }
$output .='</ul>';
?>  
<section id="section7" class="cd-section">
    <div class="row partners-background background">
       <h1 class="text-center partners-title hideme2">الشركاء</h1>
        <?=$output?>
    </div>
</section>