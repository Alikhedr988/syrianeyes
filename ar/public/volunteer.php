<script>
    var myfile = "";

    $('#resume_link').click(function(e) {
        e.preventDefault();
        $('#resume').trigger('click');
    });

    $('#resume').on('change', function() {
        myfile = $(this).val();
        var ext = myfile.split('.').pop();
        {
            if (ext == "pdf" || ext == "docx" || ext == "doc") {
                $('.contact-form-submit').attr('disabled', false);
            }
            else
            {
                alert("Please insert a DOC,DOCX, or PDF file");
            }
        }
    });
</script>
<script>
    $(document).ready(function() {
        
        $(".back-to-involved-main").click(function() {
            $(".involved-load ").fadeOut(1000);
            
            $('.involved-load').empty()
        });
    });
</script>
<?php
include_once("../../includes/db_connection.php");
$query = "SELECT * FROM emails where id=2";
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
        $output = "";
     
       while ($row = mysqli_fetch_assoc($result)) {
    // output data of each row
         
        $email = $row['email'];
      

        
       }
?>
 <div class="back col-md-1 col-md-offset-1 col-xs-2">
        <img class="img-responsive back-to-involved-main pointer" src="../includes/uploads/back-arrow.png" />
    </div>
<div class="row">
    
    <span class="involved-title text-center col-md-3 col-xs-3 col-md-offset-3 col-xs-offset-5">التطوع</span>
    <div class="col-md-9 col-md-offset-3 col-xs-9 col-xs-offset-3 contact-form form-group">
        <form data-toggle="validator" class="volunteer-form" name="contactform" method="post" action="public/volunteer-form.php">
            <input type="hidden" name="email-to" value="<?=$email?>" />
            <div class="row">
                <span>الاسم</span>
                <br/>
                <input type="text" maxlength="100" name="name" class="col-md-9 form-control volunteer-form" />
            </div>
            <div class="row">
                <span>الإيميل</span>
                <br/>
                <input type="email" maxlength="80" name="email" class="col-md-9 form-control volunteer-form" />
            </div>
            <div class="row">
                <span>الرسالة</span>
                <br/>
                <textarea name="message" class="col-md-9 volunteer-form"> </textarea>
            </div>
            <br/>
            <div class="row">
                <input class="contact-form-submit" type="submit" value="أرسل" disabled="true">
                <div class="cv"> ألحق سيرتك الذاتية : <a href="" id="resume_link">إضغط هنا</a></div>
                <input name="userfile" type="file" id="resume" style="visibility: hidden">
            </div>
        </form>
    </div>
</div>