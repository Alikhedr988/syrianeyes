<?php

$query = "SELECT * FROM projects where project_type_id = 1 ORDER BY publish_date desc";
$result = mysqli_query($connection , $query); //this is excuted in case of insert and delete and update as well
$project_list = '';
$items = '';
        //test if there is query error
$i = 0;
       while ($row = mysqli_fetch_assoc($result)) {
    $y = $i +1;
    // output data of each row
        $project_id = $row['project_id'];
        $project_name_arabic = $row['project_name_arabic'];
        $project_name = $row['project_name'];
        $project_desc_title = $row['project_desc_title_arabic'];
        $project_desc = $row['project_desc_arabic'];
        $project_cover = $row['project_cover'];
        $project_folder = str_replace(' ', '_', $project_name);   
           
           if ($i ==0)
           {
               $project_list .= '<li class="active col-md-4 col-xs-4"><a href="#'.$y.'">';
               
               $items .= '<div class="active item project-1">
                    <img class="row project-cover" src="../includes/uploads/p-cover/'.$project_cover.'" />
                    <div class="project-description project-desc-1 row">
                        <div class="background-container col-md-6">
                          <div class="row">  <h1 class="col-md-9 project-title text-center">'.$project_desc_title.' </h1></div>
                            <div class="col-md-offset-1 col-md-11 col-xs-offset-1 col-xs-11">'.$project_desc.'</div>
                                <br/>
                                <input type="hidden" value="'.$project_folder.'"/>
                                <a  class="btn btn-default btn-lg show-gallery project"  value="" >View Gallery
                                </a>
                            
                        </div>
                    </div>
                </div>';
           }
           else
           {
                 $project_list .= '<li class="col-md-4 col-xs-4"><a href="#'.$y.'" >';
               
               $items .= '  <div class="item  project-1">
                   <img class="row project-cover" src="../includes/uploads/p-cover/'.$project_cover.'" />
                    <div class="project-description project-desc-1 row">
                        <div class="background-container col-md-6">
                          <div class="row">   <h1 class="col-md-9 project-title text-center">'.$project_desc_title.' </h1></div>
                         <div class="col-md-offset-1 col-md-11 col-xs-offset-1 col-xs-11">  '.$project_desc.'</div>
                                <br/>
                                <input type="hidden" value="'.$project_folder.'"/>
                                <a  class="btn btn-default btn-lg show-gallery project"  value="" >View Gallery
                                </a>
                            
                        </div>
                    </div>
                </div>';
           }
        $project_name = str_replace('_', ' ', $project_name);  
        $project_name = strtoupper($project_name);
           
        $project_list .= $project_name_arabic . "</a></li>";

        $i++;
       }
       
?>
<section id="section3" class="cd-section">
    <div class="row projects-main background" id="projects">
        <h1 class="text-center projects-title">المشاريع</h1>
        <div id="myCarousel" class="carousel slide" style="height:85vh !important">
              
            <ol class="carousel-linked-nav pagination col-md-9 col-xs-10">
                <?=$project_list?>
            </ol>
            <!-- Carousel items -->
            <div class="carousel-inner" style="left:-75%">
                <?=$items?>
            </div>
               <a class="left carousel-control" href="#myCarousel   " role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
            <!-- Carousel nav -->
        </div>
        <!-- LINKED NAV -->


    </div>

</section>