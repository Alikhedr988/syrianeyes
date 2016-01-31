<?php include_once( "includes/db_connection.php"); ?>
<?php include_once( "includes/functions.php"); ?>
<!DOCTYPE html>
<html>
<?php
if (isset($_GET['table']) && isset($_GET['id']))
         { 
            
            $table = $_GET['table'];
            $id = $_GET['id'];
            $query = "SELECT * FROM `{$table}` WHERE id = {$id} LIMIT 1 ";
            $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
            $output = "";
            switch ($table)
            {
                case "photo-albums":
                $album_photos ="";
                $albums_container="";
                while ($row = mysqli_fetch_assoc($result)) {
                // output data of each row
                
                   // $id = $row['id'];
                    $title= $row['ph_album_title'];
                    $desc= $row['ph_album_desc'];
                    $cover = $row['ph_album_cover'];
                    $album_folder = str_replace(' ', '_', $title);   
                   $directory = "includes/uploads/photo-albums/";
                   $dir_from_index = 'includes/uploads/photo-albums/';
                    file_put_contents("1.txt",$dir_from_index);
                   $full_dir = $directory . $album_folder ;
                    
                    $desc = strip_tags($desc);
                  if (is_dir($full_dir)) {
            if ($dh = opendir($full_dir)) {


                while (($file = readdir($dh)) !== false) {
                    if (!is_dir($full_dir.$file)) {
                         $album_photos .= '<a class="fancybox photo-gallery-hide" href="'.$dir_from_index.$album_folder . '/' .$file.'" data-fancybox-group="gallery1" title="'.$desc.'"></a>';

                    }
                }

                closedir($dh);


            }
                    }
                    
              $title = str_replace('_', ' ', $title);  
            $title = strtoupper($title);
                $albums_container.=   '<div class="gallery-container  col-md-3 col-md-offset-4 col-xs-12" style="margin-top:10%;left:3%;">
                <div class="grid">
                    <figure class="effect-oscar">

                        <img class="img-responsive cover-photo-gallery" src="includes/uploads/p-cover/'.$cover.'" alt="" />
                        <figcaption>
                            <h2>'.$title.'</h2>

                            <a class="fancybox cover-photo-gallery" href="includes/uploads/p-cover/'.$cover.'" data-fancybox-group="gallery1" title="'.$desc.'"></a>
                        </figcaption>
                    </figure>

                ';

                  $albums_container .=  $album_photos;


            $albums_container .="</div></div>";

                }

                        //test if there is query error
             break;


            case "video-albums":
                $albums_container = '<div class="row gallery-row-container" style="padding-left:1%;padding-top:10px;">';

                //test if there is query error
        
               while ($row = mysqli_fetch_assoc($result)) {

                
            // output data of each row

                   $id= $row['id'];
                   $title= $row['video_album_title'];
                   $desc = $row['video_album_desc'];
                   $video_url = $row['video_url'];
                   if ($video_url)

                   {
                       $video_id = parseVideos($video_url);


                   }




                $title = str_replace('_', ' ', $title);  
                $title = strtoupper($title);



                 
                     $albums_container.=   '<div class="gallery-container col-md-3 col-md-offset-4 col-xs-12" style="margin-top:10%;left:3%;">
                    <div class="grid">
                        <figure class="effect-oscar">

                            <img class="img-responsive cover-photo-gallery" src="'.$video_id.'" alt="" />
                            <figcaption>
                                <h2>'.$title.'</h2>
                                '.$desc.'
                                <a class="video" href="'.$video_url.'" ></a>
                            </figcaption>
                        </figure>

                    ';


                $albums_container .="</div></div>";

                
               }
                break;
                case "media-story":
                    $albums_container = '<div class="row gallery-row-container" style="padding-left:1%;padding-top:10px;">';

                        //test if there is query error
               
                       while ($row = mysqli_fetch_assoc($result)) {
                           $album_photos ="";
               
                    // output data of each row

                           $id= $row['id'];
                           $title= $row['story_title'];
                           $desc = $row['story_desc'];
                           $cover = $row['story_cover'];
                        $album_folder = str_replace(' ', '_', $title);   
                           $directory = "includes/uploads/story/";
                           $dir_from_index = 'includes/uploads/story/';
                           $full_dir = $directory . $album_folder ;
                          if (is_dir($full_dir)) {
                    if ($dh = opendir($full_dir)) {


                        while (($file = readdir($dh)) !== false) {
                            if (!is_dir($full_dir.$file)) {
                                 $path_parts = pathinfo($file);
                                 $query2 = "SELECT * FROM `story_imgs` where `story_id` =".$id." AND img_name = '".$path_parts['basename']."'";
                                    file_put_contents('1.txt',$query2);
                                    $result2 = mysqli_query($connection , $query2); //this is excuted in case of insert and delete and update as well
                                    while ($row = mysqli_fetch_assoc($result2)) {
                                        $img_name = $row['img_name'];
                                        $img_desc = $row['img_desc'];
                                        $img_desc = strip_tags($img_desc);
                                        $img_desc_ar = $row['img_desc_ar'];
                                        }
                                 $album_photos .= '<a class="fancybox photo-gallery-hide" href="'.$dir_from_index.$album_folder . '/' .$file.'" data-fancybox-group="gallery1" title="'.$img_desc.'"></a>';

                            }
                        }

                        closedir($dh);


                    }
                }


                        $title = str_replace('_', ' ', $title);  
                        $title = strtoupper($title);

                          
                             $albums_container.=   '<div class="gallery-container col-md-offset-4 col-md-3 col-xs-12" style="margin-top:10%;left:3%;">
                            <div class="grid col-xs-12">
                                <figure class="effect-oscar">

                                    <img class="img-responsive cover-photo-gallery" src="includes/uploads/p-cover/'.$cover.'" alt="" />
                                    <figcaption>
                                        <h2>'.$title.'</h2>
                                        '.$desc.'
                                        <a class="fancybox cover-photo-gallery" href="includes/uploads/p-cover/'.$cover.'" data-fancybox-group="gallery1" title=""></a>
                                    </figcaption>
                                </figure>

                            ';

                              $albums_container .=  $album_photos;


                        $albums_container .="</div></div>";

                        
                       }
                break;
                case "media-media":
                $albums_container = '<div class="galleries-container col-md-12 col-xs-12">
                    <div class="row gallery-row-container" style="padding-left:1%;padding-top:10px;">';

                        //test if there is query error
                $i = 0;
                       while ($row = mysqli_fetch_assoc($result)) {
                           $album_photos ="";
                        $new_row = $i % 4;
                    // output data of each row

                           $id= $row['id'];
                           $title= $row['media_title'];
                           $desc = $row['media_desc'];
                           $media_link = $row['media_link'];
                           $cover = $row['media_cover'];
                        $album_folder = str_replace(' ', '_', $title);   
                           $directory = "includes/uploads/media/";
                           $dir_from_index = 'includes/uploads/media/';
                           $full_dir = $directory . $album_folder ;
                          if (is_dir($full_dir)) {
                    if ($dh = opendir($full_dir)) {


                        while (($file = readdir($dh)) !== false) {
                            if (!is_dir($full_dir.$file)) {
                                 $album_photos .= '<a class="fancybox photo-gallery-hide" href="'.$dir_from_index.$album_folder . '/' .$file.'" data-fancybox-group="galleryMedia1" title=""></a>';

                            }
                        }

                        closedir($dh);


                    }
                }


                        $title = str_replace('_', ' ', $title);  
                        $title = strtoupper($title);

                           
                             $albums_container.=   '<div class="gallery-container col-md-offset-4 col-md-3 col-xs-12" style="margin-top:10%;left:3%;">
                            <div class="grid">
                                <figure class="effect-oscar">

                                    <img class="img-responsive cover-photo-gallery" src="includes/uploads/p-cover/'.$cover.'" alt="" />
                                    <figcaption>
                                        <h2>'.$title.'</h2>
                                        '.$desc.'
                                        <a class=" cover-photo-gallery" href="'.$media_link.'" target="_blank" title="'.$title.'"></a>
                                    </figcaption>
                                </figure>

                            ';

                              $albums_container .=  $album_photos;


                        $albums_container .="</div></div>";

                        break;
                       }
               
        }
}
       
?>
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>Syrian Eyes</title>
    <link rel="stylesheet" href="includes/style.css">
    <link rel="stylesheet" href="includes/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="includes/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
    <link rel="stylesheet" type="text/css" href="includes/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
    <link rel="stylesheet" type="text/css" href="includes/normalize.css" />
    <link rel="stylesheet" type="text/css" href="includes/texthover/demo.css" />
	<link rel="stylesheet" type="text/css" href="includes/texthover/linkstyles.css" />


    <link rel="stylesheet" type="text/css" href="includes/set1.css" />
    <link rel="stylesheet" type="text/css" href="includes/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="includes/slick/slick-theme.css" />
    <!-- Add fancyBox main JS and CSS files -->

    <!-- Add Button helper (this is optional) -->

    <script src="includes/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="includes/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <script type="text/javascript" src="includes/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
    <script type="text/javascript" src="includes/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script src="includes/site-jquery.js"></script>
    <script type="text/javascript" src="includes/bootstrap.js"></script>
    <script type="text/javascript" src="includes/jquery.menuOnScroll.js"></script>
    <script src="includes/modernizr.js"></script>
    <script src="includes/main.js"></script>


</head>

<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox(
            { 
            openEffect: "elastic",
            closeEffect: "elastic",
            type: "image",
                helpers		: {
			title	: { type : 'inside' }
		}
        }
                               );
    });
</script>
    <script type="text/javascript">
	jQuery(document).ready(function() {

	$(".video").click(function() {
		$.fancybox({
            openEffect: "elastic",
            closeEffect: "elastic",
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
<body>
    <div class="main container-fluid">
        

            <div class="row header-main background">
                <?=$albums_container?>
        </div>
                
    </div>

        