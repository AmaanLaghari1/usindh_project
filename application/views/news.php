<!-- Start main-content -->
<div class="main-content">
    <!-- Section: home -->
    <style>
        #home{
            height: 350px;
        }
    </style>
    <?php
    if(count($sliders)>0) {
        require('./application/views/includes/sliders.php');
    }
    ?>

    <!-- Section: About -->


    <section id="upcoming-events" class="divider parallax layer-overlay overlay-white-8" data-bg-img="images/bg/bg1.jpg" style="background-image: url(&quot;images/bg/bg1.jpg&quot;); background-position: 50% 55px;">

        <?php
        if($marquee){
            $marquee = html_entity_decode($marquee,ENT_QUOTES);
            echo "<div class='marquee'>
              <p>$marquee</p>
          </div>";
        }
        ?>
        <div class="container pb-50" style="padding-top: 0px;">
            <div class="section-content">
                <div class="row">
                    <?php

                    foreach($posts  as $k=>$post) {

                        $url =base_url()."news/".$post['POST_ID'];
                        //$image= $post['IMAGE_PATH'];
                        $type_id = $post['TYPE_ID'];
                        $image= base_url().EXTRA_IMAGE_PATH.$post['IMAGE_PATH'];
                        ?>
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="schedule-box maxwidth500 bg-light mb-30">
                                <div class="thumb">
                                    <a href="<?=$url?>">
                                        <?php
                                            if($type_id==1){
                                                echo "<img style='    height: 220px' class=\"img-fullwidth\" alt=\"\" src=\"$image\">";
                                            }else if($type_id == 2){
                                                $image = $post['IMAGE_PATH'];
                                                echo "<iframe style='    height: 220px' width=\"560\" height=\"315\" src=\"$image\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>";
                                            }else if($type_id == 3){

                                                echo "<div class=\"fluid-video-wrapper\">
                                                      <iframe  style='   height: 220px' src=\"$image\" width=\"640\" height=\"360\" allowfullscreen></iframe>
                                                    </div>";
                                            }

                                        ?>
                                    </a>
                                </div>
                                <div class="schedule-details clearfix p-15 pt-10">
                                    <h5 class="font-16 title"><a href="<?=$url?>"><?=$post['TITLE']?></a></h5>
                                    <ul class="list-inline font-11 mb-20">
                                        <li><i class="fa fa-calendar mr-5"></i> <?=getDateCustomeView($post['CREATE_AT'],'d-m-Y')?></li>
                                        <li><i class="fa fa-map-marker mr-5"></i> <?=$post['NAME']?></li>
                                    </ul>
                                    <p><?=urldecode($post['DESCRIPTION'])?></p>
                                    <div class="mt-10">
                                        <a href="<?=$url?>" class="btn btn-dark btn-sm mt-10">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>


                </div>
            </div>
        </div>
    </section>
</div>
