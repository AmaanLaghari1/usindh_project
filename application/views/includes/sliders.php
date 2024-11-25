<style>
 @media screen and (max-width: 767px) {
                          #home {
                            height: 200px; /* Set a different height for mobile devices */
                          }
                           .mc-image {
                            width: 100%; /* Set the image width to 100% of its container on mobile */
                            height: auto; /* Allow the height to adjust proportionally based on the width */
                          }
                        }
                        
</style>
<section id="home" class="divider parallax">
    <?php
    $slider = isset($sliders[0])?$sliders[0]:null;
    
    if($slider&&$slider['IS_VIDEO']){
    ?>
     <div class="bg-video">
        <div id="home-video" class="video">
          <div class="player video-container" data-property="{videoURL:'<?=$slider['IMAGE']?>',containment:'#home-video',autoPlay:true, showControls:false, mute:true, startAt:0, opacity:1}"></div>
        </div>
      </div>
     <?php
    }else{
    ?>
       <div class="maximage-slider">
        <div id="maximage">
            <?php


            foreach ($sliders as $slider) {
                $image = base_url() . EXTRA_IMAGE_PATH . $slider['IMAGE'];
                //$image= $slider['IMAGE'];
                echo "<img src='{$image}' alt=''/>";
            }

            ?>

        </div>
        <div class="fullscreen-controls"><a class="img-prev"><i class="pe-7s-angle-left"></i></a> <a
                class="img-next"><i class="pe-7s-angle-right"></i></a></div>
    </div>
    <?php
    }
     ?>
    <div class="display-table">
        <div class="display-table-cell" style='vertical-align: bottom;'>
            <div class="container m-0 p-0 mb-20">
                
                <div class="row">
                    <div class="col-md-8 ">
                        <div class="inline-block "
                             data-bg-color="rgba(255,255,255, 0.8)">
                          
                            <p class="font-16 text-black font-raleway letter-spacing-1 pt-10 pl-100 pr-10" style='font-weight: 500;'><?= $slider['DESCRIPTION'] ?></p>

                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</section>
   