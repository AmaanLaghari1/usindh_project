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
    <section>
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="thumb">
                            <?php
                            $image = base_url() . EXTRA_IMAGE_PATH . $department['DIRECTOR_IMAGE'];
                            //$image= $slider['IMAGE'];
                             
                            echo "<img style='width:360px;height:360px;'src='{$image}' alt=''/>";
                            ?>

                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4 class="name font-24 mt-0 mb-0"><?=$department['DIRECTOR_NAME']?></h4>
                        <h5 class="mt-5 text-theme-color-2"><?=$department['DIRECTOR_DESIGNATION']?></h5>
                        <p><?=urldecode($department['DIRECTOR_MESSAGE'])?></p>

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
