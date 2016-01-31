<?php 
session_start();
function message()
{
      if (isset($_SESSION['message']))
    {
        $output= '<div class="message">';
        $output.= htmlspecialchars($_SESSION['message']);
        $output.='</div>';
        //clear msg after use
        $_SESSION['message']=null;
        
        return $output;
    }
}
function errors()
{
    
     if (isset($_SESSION['errors']))
    {
        $errors= $_SESSION['errors'];
        
        
        $_SESSION['errors']=null;
        
        return $errors;
    }
}
?>