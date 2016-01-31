<?php include_once( "../includes/db_connection.php"); ?>
<?php include_once( "../includes/functions.php"); ?>
<!DOCTYPE html>
<html>
<?php
//if (isset($_POST['chooseT']))
//         { 
            $query = "SELECT * FROM meta ORDER BY id desc";
            $result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
            $output = "";
            
          
                    //test if there is query error
                   while ($row = mysqli_fetch_assoc($result)) {
                // output data of each row
                
                   // $id = $row['id'];
                    $keywords= $row['keywords'];
                    $keywords = strip_tags($keywords);
                    $description = $row['description'];  
                    $description = strip_tags($description);
                   }
?>
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?=$keywords?>" />
    <meta name="description" content="<?=$description?>" />
    <meta name="author" content="Syrian Eyes">
    <title>Syrian Eyes</title>
    <link rel="stylesheet" href="includes/style-ar.css">
    <link rel="stylesheet" href="includes/bootstrap.css">
    <link rel="stylesheet" href="includes/style-dots-ar.css">
    <link rel="stylesheet" href="includes/style-lang.css">
    <link rel="stylesheet" type="text/css" href="includes/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
    <link rel="stylesheet" type="text/css" href="includes/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
    <link rel="stylesheet" type="text/css" href="includes/normalize.css" />
    <link rel="stylesheet" type="text/css" href="includes/texthover/demo.css" />
	<link rel="stylesheet" type="text/css" href="includes/texthover/linkstyles.css" />
    <link rel="stylesheet" type="text/css" href="includes/circle-hover/css/style1.css" />
    
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

<script>
    function emptyAjaxDiv() {
        $('#ajax').empty()
    }
    $(document).ready(function() {
        (function() {
            $('form > input').keyup(function() {

                var empty = false;
                $('form > input').each(function() {
                    if ($(this).val() == '') {
                        empty = true;
                    }
                });

                if (empty) {
                    $('#register').attr('disabled', 'disabled'); // updated according to http://stackoverflow.com/questions/7637790/how-to-remove-disabled-attribute-with-jquery-ie
                } else {
                    $('#register').removeAttr('disabled'); // updated according to http://stackoverflow.com/questions/7637790/how-to-remove-disabled-attribute-with-jquery-ie
                }
            });
        })()
        $(".show-gallery").click(function() {
            //  $(".view-project-nav").show();
            var p = $(this).prev().val();
            $.post("public/projects-content.php", {
                    project: p
                },
                function(data) {
                    $("#ajax").html(data);
                });
            $('html, body').animate({
                scrollTop: $("#ajax").offset().top
            }, 1000);
            $(".hide-project").show();
        });
        $(".hide-project").click(function() {
            $(".view-project-nav").hide();
            $('html, body').animate({
                scrollTop: $("#projects").offset().top
            }, 1000);
            setTimeout(emptyAjaxDiv, 1000);
            $(this).hide();
        });


    });



    $(document).ready(function() {
        function emptyInvolvedDiv() {
            $('.involved-load').empty();
        }
        $(".gallery-video-background").hover(function() {
            $(".video-button").attr("src", "includes/uploads/gallery-video-button-hover.png");
        }, function() {
            $(".video-button").attr("src", "includes/uploads/gallery-video-button.png");
        });
        $(".gallery-photo-background").hover(function() {
            $(".photo-button").attr("src", "includes/uploads/gallery-photo-button-hover.png");
        }, function() {
            $(".photo-button").attr("src", "includes/uploads/gallery-photo-button.png");
        });
        $(".ideas-link").click(function() {
            $('.involved-load').empty();
            $(".involved-load").load("public/ideas.php");
            $(".involved-load").fadeIn(1000);

        });
        $(".volunteer-link").click(function() {
            $('.involved-load').empty();
            $(".involved-load").load("public/volunteer.php");
            $(".involved-load").fadeIn(1000);

        });
        $(".donate-link").click(function() {
            $('.involved-load').empty();
            $(".involved-load").load("public/donate.php");
            $(".involved-load").fadeIn(1000);

        });
        $(".gallery-video-background").click(function() {
            $(".gallery-video-background , .gallery-photo-background").fadeOut(700);
            $(".load-contents").load("public/gallery-videos.php");
            $(".load-contents").delay(1000).fadeIn(1000);

        });
        $(".gallery-photo-background").click(function() {
            $(".gallery-video-background , .gallery-photo-background").fadeOut(700);
            $(".load-contents").load("public/gallery-photos.php");
            $(".load-contents").delay(700).fadeIn(700);

        });
        $(".media-media-background").click(function() {
            $(".media-media-background , .media-story-background").fadeOut(700);
            $(".load-contents-media").load("public/media-media.php");
            $(".load-contents-media").delay(1000).fadeIn(1000);

        });
        $(".media-story-background").click(function() {
            $(".media-media-background , .media-story-background").fadeOut(700);
            $(".load-contents-media").load("public/media-story.php");
            $(".load-contents-media").delay(700).fadeIn(700);

        });

        $(".back-to-media-main").click(function() {
            $(".media-media-background , .media-story-background").fadeIn(700);
            $('.load-contents-media').empty();
        });
        //  $(".view-project-nav").show();
        $(".back-to-gallery-main").click(function() {
            $(".gallery-video-background , .gallery-photo-background").fadeIn(700);
            $('.load-contents-media').empty();
        });
        $(".main-media-menu").click(function() {
            $(".media-media-background , .media-story-background").fadeIn(700);
            $('.load-contents-media').empty();
        });
        
        $(".main-gallery-menu").click(function() {
            $(".gallery-video-background , .gallery-photo-background").fadeIn(700);
            $('.load-contents-media').empty();
        });
        $(".main-involved-menu").click(function() {
            
            $('.involved-load').empty();
        });
    });
</script>



<script>
    $(document).ready(function() {

        /*set the class 'active' to the first element 
         this will serve as our indicator*/
        $('section').first().addClass('active');

        /* handle the mousewheel event together with 
         DOMMouseScroll to work on cross browser */
        $(document).on('mousewheel DOMMouseScroll', function(e) {
            e.preventDefault(); //prevent the default mousewheel scrolling
            var active = $('section.active');
            //get the delta to determine the mousewheel scrol UP and DOWN
            var delta = e.originalEvent.detail < 0 || e.originalEvent.wheelDelta > 0 ? 1 : -1;

            //if the delta value is negative, the user is scrolling down
            if (delta < 0) {
                //mousewheel down handler
                next = active.next();
                //check if the next section exist and animate the anchoring
                if (next.length) {
                    /*setTimeout is here to prevent the scrolling animation
                     to jump to the topmost or bottom when 
                     the user scrolled very fast.*/
                    var timer = setTimeout(function() {
                        /* animate the scrollTop by passing 
                        the elements offset top value */
                        $('body, html').animate({
                            scrollTop: next.offset().top
                        }, 'slow');

                        // move the indicator 'active' class
                        next.addClass('active')
                            .siblings().removeClass('active');

                        clearTimeout(timer);
                    }, 800);
                }

            } else {
                //mousewheel up handler
                /*similar logic to the mousewheel down handler 
                except that we are animate the anchoring 
                to the previous sibling element*/
                prev = active.prev();

                if (prev.length) {
                    var timer = setTimeout(function() {
                        $('body, html').animate({
                            scrollTop: prev.offset().top
                        }, 'slow');

                        prev.addClass('active')
                            .siblings().removeClass('active');

                        clearTimeout(timer);
                    }, 800);
                }

            }
        });
        // invoke the carousel
        $('#myCarousel').carousel({

        });

        /* SLIDE ON CLICK */

        $('.carousel-linked-nav > li > a').click(function() {

            // grab href, remove pound sign, convert to number
            var item = Number($(this).attr('href').substring(1));

            // slide to number -1 (account for zero indexing)
            $('#myCarousel').carousel(item - 1);

            // remove current active class
            $('.carousel-linked-nav .active').removeClass('active');

            // add active class to just clicked on item
            $(this).parent().addClass('active');

            // don't follow the link
            return false;
        });

        /* AUTOPLAY NAV HIGHLIGHT */

        // bind 'slid' function
        $('#myCarousel').bind('slid.bs.carousel', function() {

            // remove active class
            $('.carousel-linked-nav .active').removeClass('active');

            // get index of currently active item
            var idx = $('#myCarousel .item.active').index();

            // select currently active item and add active class
            $('.carousel-linked-nav li:eq(' + idx + ')').addClass('active');

        });
        $(".no-touch #cd-vertical-nav .cd-label , .no-touch #cd-vertical-lang .cd-label , .cd-dot").stop().animate({
            zoom: 1.8
        });
        $("#menu").menuOnScroll();
        $(document).scroll(function() {
            if (window.scrollY > 50) {
                $(".no-touch #cd-vertical-nav .cd-label , .no-touch #cd-vertical-lang .cd-label , .cd-dot").stop().animate({
                    zoom: 1.1
                });
            } else {
                $(".no-touch #cd-vertical-nav .cd-label , .no-touch #cd-vertical-lang .cd-label , .cd-dot").stop().animate({
                    zoom: 1.8
                });
            }
        });
        
            $(".project-1").hover(function() {
                $(this).find('.project-desc-1').fadeIn(500);
            }, function() {
                $(this).find('.project-desc-1').fadeOut(500);
            });
       
    });
</script>

<body>
    <div class="main container-fluid">
        <section id="section1" class="cd-section">

            <div class="row header-main background">
                <div class="header-img-container col-md-8 col-md-offset-2 col-xs-12">
                    <img class="img-responsive" src="includes/uploads/header-img.png" />
                </div>
                <div class="col-md-2 col-xs-2" style="margin-top:10%;">
                    <?php include( 'widgets/lang.php') ?>
                </div>
                <div class="col-md-3 col-xs-4" style="margin-top:-5%">
                    <?php include( 'widgets/navigation.php') ?>

        </section>