<section id="home" class="divider parallax">
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
   