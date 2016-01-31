<?php
 include_once("../includes/functions.php");
if(isset($_POST['message'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "ali@syrianeyes.org";
 
    $email_subject = "Idea E-mail";
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
 
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
 
        echo "These errors appear below.<br /><br />";
 
        echo $error."<br /><br />";
 
        echo "Please go back and fix these errors.<br /><br />";
 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['message']))
        {
 
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
 
    }
 
     
 
    
 
    $message = $_POST['message']; // required
 
    

 
     
 
    $error_message = "";
 
 
  
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "Form details below.\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
       
    $email_message .= "Message: ".clean_string($message)."\n";
     
 
// create email headers
 
$headers = 'From: '."New idea "."\r\n".
 
'Reply-To: '."ali@syrianeyes.org"."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);  
    
    redirect_to("../index.php");
 
?>
 
 
 
<!-- include your own success html here -->
 
 
 

 
 
 
<?php
 
}
 
?>