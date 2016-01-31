        <?php

        $project="";

        if (isset($_POST['project']))
        {
            $project = $_POST['project'];
            
        }
        $project_images = '';
        $dir = "../../includes/uploads/projects/" . $project;
        $handle = opendir($dir);
        $i=1;
        $fi = new FilesystemIterator($dir, FilesystemIterator::SKIP_DOTS);
        $indicators = '';
        while($file = readdir($handle)){
            
            //this code is for creating indicators under the project slider
            $y = $i - 1;
            if ($i ==1)
            {
                $indicators .= '<li data-target="#myCarousel2" data-slide-to="'.$y.'" class="active"></li>';
            }
            else if ($i <= iterator_count($fi))
            {
                $indicators .= '<li data-target="#myCarousel2" data-slide-to="'.$y.'"></li>';
                        
            }
            
            // end of indicators code
            if($file !== '.' && $file !== '..'){
                if ($i ==3)
                {
                $project_images .= '<div class="active item project-1">';
                }
                else
                {
                    $project_images .= '<div class="item">';
                }
                $project_images .=  '<img class="row project-cover" src="../includes/uploads/projects/'.$project.'/'.$file.'" />';
                $project_images .="</div>";

            }
            $i++;
        }
       
        ?>


            <div class="row projects-slider-background background" id="projects-slider">
                
                <div id="myCarousel2" class="carousel slide" style="padding-top:10%">
                    <ol class="carousel-indicators">
                       <?=$indicators?>
                    </ol>
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <?=$project_images?>

                    </div>
                    <!-- Carousel nav -->

                    <a class="left carousel-control" href="#myCarousel2" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel2" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- LINKED NAV -->

            </div>
