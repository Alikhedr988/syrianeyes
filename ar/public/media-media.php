<?php include_once( "../../includes/db_connection.php"); ?>
<?php include_once( "../../includes/functions.php"); ?>
<?php

$query = "SELECT * FROM `media-media` ORDER BY publish_date desc";
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
$albums_container = '<div class="galleries-container col-md-10 col-md-offset-1 col-xs-12">
    <div class="row gallery-row-container" style="padding-left:1%;padding-top:10px;">';

        //test if there is query error
$i = 0;
       while ($row = mysqli_fetch_assoc($result)) {
           $album_photos ="";
        $new_row = $i % 4;
    // output data of each row
        
           $media_id= $row['id'];
           $media_title= $row['media_title'];
           $media_title_arabic= $row['media_title_arabic'];
           $media_desc_arabic = $row['media_desc_arabic'];
           $media_desc_arabic = strip_tags($media_desc_arabic);
           $media_link = $row['media_link'];
           $media_cover = $row['media_cover'];
        $album_folder = str_replace(' ', '_', $media_title);   
           $directory = "../../includes/uploads/media/";
           $dir_from_index = '../includes/uploads/media/';
           $full_dir = $directory . $album_folder ;
          if (is_dir($full_dir)) {
    if ($dh = opendir($full_dir)) {
        

        while (($file = readdir($dh)) !== false) {
            if (!is_dir($full_dir.$file)) {
                 $album_photos .= '<a class="fancybox photo-gallery-hide" href="'.$dir_from_index.$album_folder . '/' .$file.'" data-fancybox-group="galleryMedia'.$i.'" title=""></a>';
                
            }
        }

        closedir($dh);
        
        
    }
}
        
           
        $media_title = str_replace('_', ' ', $media_title);  
        $media_title = strtoupper($media_title);
           
           if ($i != 0 && $new_row ==0)
           {    
                $albums_container .='</div> <div class="row gallery-row-container" style="padding-left:1%;padding-top:10px;">';
           }
             $albums_container.=   '<div class="gallery-container col-md-3 col-xs-12">
            <div class="grid">
                <figure class="effect-oscar">

                    <img class="img-responsive cover-photo-gallery" src="../includes/uploads/p-cover/'.$media_cover.'" alt="" />
                    <figcaption>
                        <h2>'.$media_title_arabic.'</h2>
                        '.$media_desc_arabic.'
                        <a class=" cover-photo-gallery" href="'.$media_link.'" target="_blank" title="'.$media_title_arabic.'"></a>
                    </figcaption>
                </figure>

            ';

              $albums_container .=  $album_photos;
              
           
        $albums_container .="</div></div>";

        $i++;
       }
       
?>
<script>
    $(document).ready(function() {
        
        $(".back-to-media-main").click(function() {
            $(".load-contents-media").fadeOut(1000);
            $(".media-media-background , .media-story-background").fadeIn(1000);
            $('.load-contents-media').empty()
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox({
            openEffect: "fade",
            closeEffect: "fade",
            type: "image"
        });
    });
</script>
<div class="row gallery-row-container">
    <div class="back col-md-1 col-xs-2">
        <img class="img-responsive back-to-media-main pointer" src="../includes/uploads/back-arrow.png" />
    </div>
    <div class="col-md-11 col-xs-10">
        <h1 class="text-center gallery-title"> الميديا </h1>
    </div>
</div>
<?=$albums_container?>