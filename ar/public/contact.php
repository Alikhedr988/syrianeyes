<?php
include_once("../includes/db_connection.php");
$query = "SELECT * FROM social";
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
        $output = "";
     
       while ($row = mysqli_fetch_assoc($result)) {
    // output data of each row
         
        $title = $row['title'];
        $icon = $row['icon'];
        $link = $row['link'];
        if ($icon != 'yt-icon.png')
        {
            $output .= ' <a target="_blank" href="http://'.$link.'"><img class="col-md-1 col-xs-3 img-responsive" src="../includes/uploads/'.$icon.'" /></a>';
        }
           else
           {
               $output .= ' <a target="_blank" href="http://'.$link.'"><img class="col-md-2 col-xs-4 img-responsive" src="../includes/uploads/'.$icon.'" /></a>';
           }
       }
?> 
<?php
$query = "SELECT * FROM team ORDER BY id asc";
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
        $members = "";
     
       while ($row = mysqli_fetch_assoc($result)) {
    // output data of each row
         
        $name_arabic = $row['name_arabic'];
        $position_arabic = $row['position_arabic'];
        $phone = $row['phone'];
           $member_email = $row['email'];
           $image = $row['image'];
           
           $position_arabic = strtoupper($position_arabic); 
        
            $members .= '<div class="col-md-4 col-xs-10" style="margin-top:10px">
                   <span class="member-title">'.$position_arabic.'</span>
                    <img style="margin-top:10px;" class="img-circle  col-md-4 contact-image" src="../includes/uploads/team/'.$image.'" />
                    <div class="contact-info-text-container col-md-8">
                        <p class="contact-info-text">'.$name_arabic.': '.$phone.' '.$member_email.'
                        </p>
                    </div>
                </div>';
        
       }
?> 
<?php
$query = "SELECT * FROM emails where id=3";
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
        
     
       while ($row = mysqli_fetch_assoc($result)) {
    // output data of each row
         
        $email = $row['email'];
      

        
       }
?>
<section id="section9" class="cd-section">
    <div class="row contact-background background">
        <h1 class="text-center contact-title hideme2">إتصل بنا</h1>
        <p class="text-center contact-title hideme2 grey stay">ضل معنا واتواصل</p>
        <div class="contact-info-container">
            <div class="contact-info col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1 hideme3">
            <?=$members?>
                
            </div>
        </div>
        <div class="get-in-touch-container hideme2">
            <div class="col-md-5 col-md-offset-1 col-xs-10 col-xs-offset-1 get-in-touch">
                <h2 class="col-md-10">حاكينا</h2>
                <p class="get-in-touch-text col-md-10">We are very approachable and would love to speak to you.
                    <br/> Feel free to call, send us an email, Tweet us or simply complete the enquiry form.</p>
            </div>
            <div class="col-md-5 col-md-offset-1 col-xs-9 col-xs-offset-2 contact-form form-group">
                <form data-toggle="validator" name="contactform" method="post" action="public/contact-form.php">
                    <input type="hidden" name="email-to" value="<?=$email?>" />
                    <div class="row">
                        <span>الاسم</span>
                        <br/>
                        <input type="text" maxlength="100" name="name" class="col-md-9 form-control" />
                    </div>
                    <div class="row">
                        <span>الإيميل</span>
                        <br/>
                        <input type="email" maxlength="80" name="email" class="col-md-9 form-control" />
                    </div>
                    <div class="row">
                        <span>الرسالة</span>
                        <br/>
                        <textarea name="message" class="col-md-9 "> </textarea>
                    </div>
                    <br/>
                    <div class="row">
                        <input class="contact-form-submit" type="submit" value="أرسل">
                    </div>
                </form>
            </div>
            <div class="col-md-6 col-md-offset-1 col-xs-6 col-xs-offset-1 social-container">
              <?=$output?>
            </div>
        </div>

    </div>
</section>