
<?php
$query = "SELECT * FROM whoweare LIMIT 1";
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
     
       while ($row = mysqli_fetch_assoc($result)) {
    // output data of each row
        $whotext = $row['whotext'];
       }
?> 

<section id="section2" class="cd-section">
    <script>
    $(document).ready(function() {
        $(window).scroll(function() {

            /* Check the location of each desired element */
            $('.hideme').each(function(i) {

                var bottom_of_object = $(this).offset().top + $(this).outerHeight();
                var bottom_of_window = $(window).scrollTop() + $(window).height() + 200;

                /* If the object is completely visible in the window, fade it it */
                if (bottom_of_window > bottom_of_object) {

                    $(this).stop().animate({
                        'opacity': '1',
                        'marginTop': '50'
                    }, 1000);
				

                }
				

            });
            $('.hideme2').each(function(i) {

                var bottom_of_object = $(this).offset().top + $(this).outerHeight();
                var bottom_of_window = $(window).scrollTop() + $(window).height() + 300;

                /* If the object is completely visible in the window, fade it it */
                if (bottom_of_window > bottom_of_object) {

                    $(this).stop().stop().animate({
                        'opacity': '1'
                    }, 1000);

                }
				
            });
                 $('.hideme3').each(function(i) {

                var bottom_of_object = $(this).offset().top + $(this).outerHeight();
                var bottom_of_window = $(window).scrollTop() + $(window).height() + 200;

                /* If the object is completely visible in the window, fade it it */
                if (bottom_of_window > bottom_of_object) {

                    $(this).stop().animate({
                        'opacity': '1',
                        'left': '0%'
                    }, 1000);
                


                }
				

            });
        });
    });
</script>
    <div class="row who-main background" id="who">
        <h1 class="text-center title hideme">WHO WE ARE</h1>
        <h3 class="text-center hideme">WE ARE</h3>
        <div class="who-text hideme">
            <?=$whotext?>
        </div>
    </div>

</section>