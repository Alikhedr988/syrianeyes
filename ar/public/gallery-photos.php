<?php include_once( "../../includes/db_connection.php"); ?>
<?php include_once( "../../includes/functions.php"); ?>
<?php

$query = "SELECT * FROM `photo-albums` ORDER BY publish_date desc";
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
$albums_container = '<div class="galleries-container col-md-10 col-md-offset-1 col-xs-12">
    <div class="row gallery-row-container" style="padding-left:1%;padding-top:10px;">';

        //test if there is query error
$i = 0;
       while ($row = mysqli_fetch_assoc($result)) {
           $album_photos ="";
        $new_row = $i % 4;
    // output data of each row
        
           $ph_album_id= $row['id'];
           $ph_album_title= $row['ph_album_title'];
           $ph_album_title_arabic= $row['ph_album_title_arabic'];
           $ph_album_desc_arabic = $row['ph_album_desc_arabic'];
           $ph_album_cover = $row['ph_album_cover'];
        $album_folder = str_replace(' ', '_', $ph_album_title);   
           $directory = "../../includes/uploads/photo-albums/";
           $dir_from_index = '../includes/uploads/photo-albums/';
           $full_dir = $directory . $album_folder ;
            $ph_album_desc_arabic = strip_tags($ph_album_desc_arabic);
          if (is_dir($full_dir)) {
    if ($dh = opendir($full_dir)) {
        

        while (($file = readdir($dh)) !== false) {
            if (!is_dir($full_dir.$file)) {
                 $album_photos .= '<a class="fancybox photo-gallery-hide" href="'.$dir_from_index.$album_folder . '/' .$file.'" data-fancybox-group="gallery'.$i.'" title="'.$ph_album_desc_arabic.'"></a>';
                
            }
        }

        closedir($dh);
        
        
    }
}
        
           
        $ph_album_title = str_replace('_', ' ', $ph_album_title);  
        $ph_album_title = strtoupper($ph_album_title);
          
           if ($i != 0 && $new_row ==0)
           {    
                $albums_container .='</div> <div class="row gallery-row-container" style="padding-left:1%;padding-top:10px;">';
           }
             $albums_container.=   '<div class="gallery-container col-md-3 col-xs-12">
            <div class="grid">
                <figure class="effect-oscar">

                    <img class="img-responsive cover-photo-gallery" src="../includes/uploads/p-cover/'.$ph_album_cover.'" alt="" />
                    <figcaption>
                        <h2>'.$ph_album_title_arabic.'</h2>
                        
                        <a class="fancybox cover-photo-gallery" href="../includes/uploads/p-cover/'.$ph_album_cover.'" data-fancybox-group="gallery'.$i.'" title="'.$ph_album_desc_arabic.'"></a>
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
        $(".gallery-container").hover(function() {
            $(".photo-caption", this).animate({
                marginTop: '-50px'
            });
        }, function() {
            $(".photo-caption", this).animate({
                marginTop: '0px'
            });
        });
        $(".back-to-gallery-main").click(function() {
            $(".load-contents").fadeOut(1000);
            $(".gallery-video-background , .gallery-photo-background").fadeIn(1000);
            $('.load-contents').empty()
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox(
            { 
            openEffect: "fade",
            closeEffect: "fade",
            type: "image",
                helpers		: {
			title	: { type : 'inside' }
		}
        }
                               );
    });
</script>
<div class="row gallery-row-container">
    <div class="back col-md-1 col-xs-2">
        <img class="img-responsive back-to-gallery-main" src="../includes/uploads/back-arrow.png" />
    </div>
    <div class="col-md-11 col-xs-10">
        <h1 class="text-center gallery-title"> ألبومات الصور</h1>
    </div>
</div>
<?=$albums_container?>