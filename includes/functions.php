<?php
function confirm_query($result_set)
{
        if (!$result_set)
        {
            die("Database query failed");
        }
}
function find_all_admins()
{
            global $connection;
            $query = "SELECT * ";
            $query .= "FROM admins ";
           //$query .= "WHERE visible = 1 ";
            $query .= "order by id ASC";
            $admin_set = mysqli_query($connection , $query); 
            confirm_query($admin_set);
            return $admin_set;
}
function find_all_highlights()
{
            global $connection;
            $query = "SELECT * ";
            $query .= "FROM highlight ";
           //$query .= "WHERE visible = 1 ";
            $query .= "order by id ASC";
            $highlight_set = mysqli_query($connection , $query); 
            confirm_query($highlight_set);
            return $highlight_set;
}
function navigation($subject_array,$page_array)
{
    $output= '<ul class="subjects">';
             $subject_set = find_all_subjects(); 
            
                while($subject= mysqli_fetch_assoc($subject_set))
                {
                    $output.= "<li ";
                    if ($subject_array && $subject_array['id'] == $subject['id'])
                    {
                        $output.= "class='selected' ";
                    }
                    $output.= "> ";
                    $output.= "<a href='manage_content.php?subject=".urlencode($subject['id'])."'> ".  htmlentities($subject['menu_name']) . "</a>" ;
                    $pages_set = find_pages_for_subject($subject['id']);
                    $output.= "<ul class='pages'>";
                     while($page= mysqli_fetch_assoc($pages_set))
                    {
                        $output.= "<li ";
                        if ($page_array && $page_array['id'] == $page['id'])
                        {
                            $output.= "class='selected'";
                        }
                        $output.= "> ";
                        $output.= "<a href='manage_content.php?page=".urlencode($page['id'])."'> ".  htmlentities($page['menu_name'])." </a></li> ";
                    }
                    
                    
                    
                    $output.= "</ul>
                    </li>";    
                }
                
           
             mysqli_free_result($subject_set); 
             mysqli_free_result($pages_set); 
         $output.='</ul>';
    return $output;
}
function find_admin_by_id($id)
{
            //very important to escape the variable
            global $connection;
            $escaped_id = mysqli_real_escape_string($connection,$id);
            $query = "SELECT * ";
            $query .= "FROM admins ";
            $query .= "WHERE id = ".$escaped_id." " ;
            $query .= "LIMIT 1";
            $admin_set = mysqli_query($connection , $query); 
            confirm_query($admin_set);
            if ($admin = mysqli_fetch_assoc($admin_set))
            {
                return $admin;
            }
            else
            {
                return null;
            }
}
function find_project_by_id($id)
{
            //very important to escape the variable
            global $connection;
            $escaped_id = mysqli_real_escape_string($connection,$id);
            $query = "SELECT * ";
            $query .= "FROM ";
            $query .= "projects" ;
            $query .= " WHERE project_id = ".$escaped_id." " ;
            $query .= "LIMIT 1";
            $item_set = mysqli_query($connection , $query); 
            confirm_query($item_set);
            if ($item = mysqli_fetch_assoc($item_set))
            {
                return $item;
            }
            else
            {
                return null;
            }
}

function parseVideos($url = null)
{
    $html_returned = '';
  if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) 
  {
    $video_id = $match[1];
      $video_id = 'https://img.youtube.com/vi/'.$video_id.'/0.jpg';
  }
    else
    {
        
        
        $video_id = str_replace('https://vimeo.com/', 'https://vimeo.com/api/v2/video/', $url) . '.php';
        $video_id = unserialize(file_get_contents($video_id));

        $video_id =  $video_id[0]['thumbnail_small'];  
        
        
        
    }
    return $video_id;
}
function find_by_id($table,$id)
{
            //very important to escape the variable
            global $connection;
            $escaped_id = mysqli_real_escape_string($connection,$id);
            $escaped_table = mysqli_real_escape_string($connection,$table);
            $query = "SELECT * ";
            $query .= "FROM ";
            $query .= "`{$escaped_table}`" ;
            $query .= " WHERE id = ".$escaped_id." " ;
            $query .= "LIMIT 1";
            file_put_contents('2.txt',$query);
            $item_set = mysqli_query($connection , $query); 
            confirm_query($item_set);
            if ($item = mysqli_fetch_assoc($item_set))
            {
                return $item;
            }
            else
            {
                return null;
            }
}
function find_photo_album_by_id($id)
{
            //very important to escape the variable
            global $connection;
            $escaped_id = mysqli_real_escape_string($connection,$id);
            $query = "SELECT * ";
            $query .= "FROM ";
            $query .= "`photo-albums`" ;
            $query .= " WHERE id = ".$escaped_id." " ;
            $query .= "LIMIT 1";
            $item_set = mysqli_query($connection , $query); 
            confirm_query($item_set);
            if ($item = mysqli_fetch_assoc($item_set))
            {
                return $item;
            }
            else
            {
                return null;
            }
}
function find_video_album_by_id($id)
{
            //very important to escape the variable
            global $connection;
            $escaped_id = mysqli_real_escape_string($connection,$id);
            $query = "SELECT * ";
            $query .= "FROM ";
            $query .= "`video-albums`" ;
            $query .= " WHERE id = ".$escaped_id." " ;
            $query .= "LIMIT 1";
            $item_set = mysqli_query($connection , $query); 
            confirm_query($item_set);
            if ($item = mysqli_fetch_assoc($item_set))
            {
                return $item;
            }
            else
            {
                return null;
            }
}
function find_paragraph_by_id($page_id , $paragraph_id )
{
            //very important to escape the variable
            global $connection;
            $escaped_id = mysqli_real_escape_string($connection,$page_id);
            $escaped_p_id = mysqli_real_escape_string($connection,$paragraph_id);
            $query = "SELECT * ";
            $query .= "FROM ";
            $query .= "pages_text" ;
            $query .= " WHERE page_id = ".$escaped_id." AND p_id = ".$escaped_p_id." " ;
            $query .= "LIMIT 1";
            $item_set = mysqli_query($connection , $query); 
            confirm_query($item_set);
            if ($item = mysqli_fetch_assoc($item_set))
            {
                return $item;
            }
            else
            {
                return null;
            }
}
function find_page_by_id($id)
{
            //very important to escape the variable
            global $connection;
            $escaped_id = mysqli_real_escape_string($connection,$id);
            $query = "SELECT * ";
            $query .= "FROM pages ";
            $query .= "WHERE id = ".$escaped_id." " ;
            $query .= "LIMIT 1";
            $page_set = mysqli_query($connection , $query); 
            confirm_query($page_set);
            if ($page = mysqli_fetch_assoc($page_set))
            {
                return $page;
            }
            else
            {
                return null;
            }
}
function deleteDir($dir) {
  
    $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
    $files = new RecursiveIteratorIterator($it,
                 RecursiveIteratorIterator::CHILD_FIRST);
    foreach($files as $file) {
        if ($file->isDir()){
            rmdir($file->getRealPath());
        } else {
            unlink($file->getRealPath());
        }
    }
    rmdir($dir);
    return;
}
function find_selected_page()
{
    global $current_subject;
    global $current_page;
    if (isset($_GET['subject']))
    {
        $current_subject = find_subject_by_id($_GET['subject']); 
        $current_page=null;
    }
    else if (isset($_GET['page']))    
    {
        $current_page = find_page_by_id( $_GET['page']); 

        $current_subject=null;
    }else
    {
        $current_subject=null;
        $current_page=null;
    }
}

function find_selected_page_edit()
{
    global $current_subject;
    global $current_page;
    
     if (isset($_GET['page']))    
    {
        $current_page = find_page_by_id( $_GET['page']); 

        $current_subject=null;
    }else
    {
        $current_subject=null;
        $current_page=null;
    }
}
function redirect_to($new_location)
{
    header("Location: " . $new_location);
    exit;
}
function mysql_prep($string)
{
    global $connection;
    
    $escaped_string = mysqli_real_escape_string($connection,$string);
    return $escaped_string;
}
function form_errors($errors=array())
        {
            $output="";
        if (!empty($errors))
            {
             $output.= '<div class="error">
             Please fix the following errors:
             <ul>';
             foreach ($errors as $key =>$error)
             {
             $output.= '<li>'.htmlentities($error).'</li>';
             }
            $output.= '</ul></div>';
                
            }
            return $output;
        }
function password_encrypt($password)
{
 
        $hash_format = "$2y$10$";  //this tells PHP that we are using Blowfish, 2y=Blowfish, 10=cost diameter. meaning, how many times to run the algorithm; the more you run it the slower it is; 10 is good
        $salt_length = 22;
        $salt = generate_salt($salt_length); //Salt uses strings that have 22 characters or more exclusively 
        $format_and_salt = $hash_format . $salt;
        $hash  = crypt($password , $format_and_salt);
        
        return $hash;

}
function generate_salt($length)
    {
 
        $unique_random_string = md5(uniqid(mt_rand(), true));
        //valid characters for a salt are [a-zA-Z0-9./]
        $base64_string = base64_encode($unique_random_string);
        //But not + which is valid in base64encoding
        $modified_base64_string = str_replace('+','.',$base64_string);  
        //make string in the right length
        $salt = substr($modified_base64_string,0,$length);
        return $salt;
    }
function password_check($password , $existing_hash)
    {
        $hash = crypt($password,$existing_hash);
        if ($hash === $existing_hash)
        {
            return true;
        }
        else
        {
            return false; 
        }
    }
function attempt_login($username,$password)
{
    $admin = find_admin_by_username($username);
    if ($admin)
    {
        //admin found,check password
        if (password_check($password , $admin['password']))
        
            {
                //password matches
                return $admin;
            }
        else
            {
                return false;
            }
    }
    else
    {
        ///return false, admin not found
        return false;
    }
}
function find_admin_by_username($username)
{
            //very important to escape the variable
            global $connection;
            $escaped_username = mysqli_real_escape_string($connection,$username);
            $query = "SELECT * ";
            $query .= "FROM admins ";
            $query .= "WHERE username = '".$escaped_username."' " ;
            $query .= "LIMIT 1";
            echo $query;
            $admin_set = mysqli_query($connection , $query); 
            confirm_query($admin_set);
            if ($admin = mysqli_fetch_assoc($admin_set))
            {
                return $admin;
            }
            else
            {
                return null;
            }
}
function logged_in()
{
    return isset($_SESSION['admin_id']);
    
}
function confirm_logged_in()
{
if (!logged_in())
    {
        redirect_to("../admins/admin-login.php");
    }
}

 function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}  
function displaygallery($dir ="",$galname = "",$gnum=0)
	{
    $dir = 'Data/galleries/'.$dir;
    $i = -2; 
    if (!endsWith($dir,'/'))
    {
        $dir = $dir . '/';
    }
	$output = '<td class="g1">';
    if ($handle = opendir($dir)) {
        while (($file = readdir($handle)) !== false){
            if (!in_array($file, array('.', '..')) && !is_dir($dir.$file)) 
               
				if($i==0)
				{
					$output .= ' <a class="fancybox" data-fancybox-group="gallery'.$gnum.'" rel="group" title="" href="'.$dir.$file.'"><img style="width:200px;height:120px;display: inline;
margin: 0 10px;" src="'.$dir.'t.jpg" alt="" /></a>';
				}
				else
				{
                    if ($file != 't.jpg')
                    {
					$output .= ' <a class="fancybox" data-fancybox-group="gallery'.$gnum.'" rel="group" title="" href="'.$dir.$file.'"><img style="width:200px;height:120px;display: none;
margin: 0 10px;" src="'.$dir.$file.'" alt="" /></a>';
                    }
				}
                $i++;
				
			
        }
    }
	$output .= '<p class="g_title"> '.$galname.' </p> </div></td>';
	return $output;
	}

function displaycampaigngallery($photo ="")
{
	$output = '<td class="g2">       
   <a class="fancybox" data-fancybox-group="gallery" rel="group" title="" href="./Data/posters/'.$photo.'"><img class="poster" src="./Data/posters/'.$photo.'" alt="" /></a><p class="g_title">  </p></td>';
    
	$output .= '<p class="g_title">  </p> </div></td>';
	return $output;
}

// prints out how many were in the directory
   //echo "There were $i files";
 function partners($title="",$link="",$photo="")
 {
     $font_size = "style='font-size:11px'";
     if (strlen($title)>22)
     {
         $font_size = "style='font-size:9px'";
     }
     $output = ' <div class="partner_div col-sm-2 col-sm-offset-1">
        <a href="'.$link.'" target="_blank">        
        <div class="headline col-sm-12">
        <span '.$font_size.'>'.$title.'</span><br/>
        <hr class="line" />
        </div>
        <img src="./Data/partners/'.$photo.'" />
        </a>
        </div>';
     return $output;
 }
function lastestnews($title="" , $body="" , $photo="" ,$scroll = false)
{
            $body = strip_tags($body,'<b><i>');
            $output = '<td>
            <div class="latest col-md-12" >
            
            <h1> '.$title.' </h1>
            
            <img class="latestimg" src="./Data/latest/'.$photo.'"  />
            <div class="expand">
            <p class="paralatest"> '.$body.'  </p>
            </div>
            </div> 
            </td>';
        

    return $output;
}
function viewproject($title="",$content="",$photo="")
{
    $output = '<div class="parent_div" >
        <img class="plogo" src="./Data/projects_logos/'.$photo.'" />
        <h1 class="p_h1">'.$title.'  </h1>
        <p class="parapro">'.$content.'
 </p>
        </div>';
    return $output;
         
}
function convertYoutubeIframe($link) {
       return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "<iframe width='385' height='280' frameborder='0' src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
        $link
    );
}
function convertYoutube($link) {
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "\//www.youtube.com/embed/$2\ ",
        $link
    );
}
function videoGallery($link)
{
    $embedlink = convertYoutube($link);
    $output = $embedlink;
return $output;
}
?>
