<?php
include_once("../../includes/db_connection.php");
include_once("../../includes/functions.php");


$query = "SELECT * FROM `video-albums` ORDER BY publish_date desc";
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
$videos_container = '<div class="galleries-container col-md-10 col-md-offset-1 col-xs-12">
    <div class="row gallery-row-container" style="padding-left:1%;padding-top:10px;">';

        //test if there is query error
$i = 0;
       while ($row = mysqli_fetch_assoc($result)) {
          
        $new_row = $i % 4;
    // output data of each row
        
           $video_album_id= $row['id'];
           $video_album_title= $row['video_album_title_arabic'];
           $video_album_desc = $row['video_album_desc_arabic'];
           $video_url = $row['video_url'];
           if ($video_url)
               
           {
               $video_id = parseVideos($video_url);
               
               
           }
       
        
        
           
        $video_album_title = str_replace('_', ' ', $video_album_title);  
        $video_album_title = strtoupper($video_album_title);
           
               
               
           if ($i != 0 && $new_row ==0)
           {    
                $videos_container .='</div> <div class="row gallery-row-container" style="padding-left:1%;padding-top:10px;">';
           }
             $videos_container.=   '<div class="gallery-container col-md-3 col-xs-12">
            <div class="grid">
                <figure class="effect-oscar">

                    <img class="img-responsive cover-photo-gallery" src="'.$video_id.'" alt="" />
                    <figcaption>
                        <h2>'.$video_album_title.'</h2>
                        '.$video_album_desc.'
                        <a class="video" href="'.$video_url.'" ></a>
                    </figcaption>
                </figure>

            ';

           
        $videos_container .="</div></div>";

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
	jQuery(document).ready(function() {

	$(".video").click(function() {
		$.fancybox({
			'padding'		: 0,
			'autoScale'		: false,
			'transitionIn'	: 'none',
			'transitionOut'	: 'none',
			'title'			: this.title,
			'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
			'type'			: 'swf',
			'swf'			: {
			'wmode'				: 'transparent',
			'allowfullscreen'	: 'true'
			}
		});

		return false;
	});
});
</script>
<div class="row gallery-row-container">
    <div class="back col-md-1 col-xs-2">
        <img class="img-responsive back-to-gallery-main" src="../includes/uploads/back-arrow.png" />
    </div>
    <div class="col-md-11 col-xs-10">
        <h1 class="text-center gallery-title"> ألبوم الفيديو</h1>
    </div>
</div>
<?=$videos_container?>