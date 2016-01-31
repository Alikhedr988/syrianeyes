<?php include_once( "../../includes/db_connection.php"); ?>
<?php include_once( "../../includes/functions.php"); ?>
<?php

$query = "SELECT * FROM `media-story` ORDER BY publish_date desc";
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
$albums_container = '<div class="galleries-container col-md-10 col-md-offset-1 col-xs-12">
    <div class="row gallery-row-container" style="padding-left:1%;padding-top:10px;">';

        //test if there is query error
$i = 0;
       while ($row = mysqli_fetch_assoc($result)) {
           $album_photos ="";
        $new_row = $i % 4;
    // output data of each row
        
           $story_id= $row['id'];
           $story_title= $row['story_title'];
           $story_title_arabic= $row['story_title_arabic'];
           $story_desc_arabic = $row['story_desc_arabic'];
           $story_cover = $row['story_cover'];
        $album_folder = str_replace(' ', '_', $story_title);   
           $directory = "../../includes/uploads/story/";
           $dir_from_index = '../includes/uploads/story/';
           $full_dir = $directory . $album_folder ;
          if (is_dir($full_dir)) {
    if ($dh = opendir($full_dir)) {
        

        while (($file = readdir($dh)) !== false) {
            if (!is_dir($full_dir.$file)) {
                 $path_parts = pathinfo($file);
                 $query2 = "SELECT * FROM `story_imgs` where `story_id` =".$story_id." AND img_name = '".$path_parts['basename']."'";
                    file_put_contents('1.txt',$query2);
                    $result2 = mysqli_query($connection , $query2); //this is excuted in case of insert and delete and update as well
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $img_name = $row['img_name'];
                        
                        $img_desc_ar = $row['img_desc_ar'];
                        $img_desc_ar = strip_tags($img_desc_ar);
                        }
                 $album_photos .= '<a class="fancybox photo-gallery-hide" href="'.$dir_from_index.$album_folder . '/' .$file.'" data-fancybox-group="gallery'.$i.'" title="'.$img_desc_ar.'"></a>';
                
            }
        }

        closedir($dh);
        
        
    }
}
        
           
        $story_title = str_replace('_', ' ', $story_title);  
        $story_title = strtoupper($story_title);
           
           if ($i != 0 && $new_row ==0)
           {    
                $albums_container .='</div> <div class="row gallery-row-container" style="padding-left:1%;padding-top:10px;">';
           }
             $albums_container.=   '<div class="gallery-container col-md-3 col-xs-12">
            <div class="grid col-xs-12">
                <figure class="effect-oscar">

                    <img class="img-responsive cover-photo-gallery" src="../includes/uploads/p-cover/'.$story_cover.'" alt="" />
                    <figcaption>
                        <h2>'.$story_title_arabic.'</h2>
                        '.$story_desc_arabic.'
                        <a class="fancybox cover-photo-gallery" href="../includes/uploads/p-cover/'.$story_cover.'" data-fancybox-group="gallery'.$i.'" title=""></a>
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
            type: "image",
                helpers		: {
			title	: { type : 'inside' }
		}
        });
    });
</script>
<div class="row gallery-row-container">
    <div class="back col-md-1 col-xs-2">
        <img class="img-responsive back-to-media-main pointer" src="../includes/uploads/back-arrow.png" />
    </div>
    <div class="col-md-11 col-xs-10">
        <h1 class="text-center gallery-title"> القصص </h1>
    </div>
</div>
<?=$albums_container?>