<?php
include_once("../includes/db_connection.php");
$query = "SELECT * FROM emails where id=1";
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
        $output = "";
     
       while ($row = mysqli_fetch_assoc($result)) {
    // output data of each row
         
        $email = $row['email'];
      

        
       }
?>
<script>
    $(document).ready(function() {
        
        $(".back-to-involved-main , .main-involved-menu").click(function() {
			$('.animate-up').animate({marginTop : '13%'});
			$('.volunteer-link').show(500);
			$('.ideas-link').animate({marginLeft : '25%'});
            $(".involved-load ").fadeOut(1000);
            
            $('.involved-load').empty()
        });
    });
</script>
 <div class="back col-md-1 col-xs-2" style="z-index:999999999999999999999999">
        <img class="img-responsive back-to-involved-main pointer" src="includes/uploads/back-arrow.png" />
    </div>
<div class="row">
<span class="involved-title text-center col-md-7 col-xs-7 col-md-offset-2 col-xs-offset-3">Aida, Ahmad, and Ansar shared their ideas</span>
    <div class="col-md-9 col-md-offset-2 col-xs-10 col-xs-offset-1 all-ideas-imgs">
        <div class="col-md-2 col-xs-4 idea-img-holder">
             <img class="col-md-10 col-xs-10 img-circle" src="includes/uploads/ideas/1.png"/>
        </div>
        <div class="col-md-2 col-xs-4 idea-img-holder">
             <img class="col-md-10 col-xs-10 img-circle" src="includes/uploads/ideas/1.png"/>
        </div>
        <div class="col-md-2 col-xs-4 idea-img-holder">
             <img class="col-md-10 col-xs-10 img-circle" src="includes/uploads/ideas/1.png"/>
        </div>
        <div class="col-md-2 col-xs-4 idea-img-holder">
             <img class="col-md-10 col-xs-10 img-circle" src="includes/uploads/ideas/1.png"/>
        </div>
        <div class="col-md-2 col-xs-4 idea-img-holder">
             <img  class="col-md-10 col-xs-10 img-circle" src="includes/uploads/ideas/1.png"/>
        </div>
        <div class="col-md-2 col-xs-4 idea-img-holder">
             <img class="col-md-10 col-xs-10 img-circle" src="includes/uploads/ideas/1.png"/>
        </div>
        
   
        
    </div>
 <div class="col-md-9 col-md-offset-3 col-xs-9 col-xs-offset-3 contact-form form-group">
                <form data-toggle="validator" name="idea-form" method="post" action="public/idea-form.php">
                    <input type="hidden" name="email-to" value="<?=$email?>" />
                    <div class="row">
                        <textarea placeholder="SHAKE OUR BRAINS,SHARE YOUR IDEAS WITH US" name="message" rows="4" class="col-md-5 col-md-offset-1 col-xs-8 volunteer-form"></textarea>
                        <input class="idea-form-submit col-xs-8 col-md-1" type="submit" value="Send">
                        
                    </div>
                </form>
            </div>
</div>