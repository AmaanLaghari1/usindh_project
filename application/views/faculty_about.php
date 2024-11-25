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
    <section id="about" class="">
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="letter-space-4 text-gray-darkgray text-uppercase mt-0 mb-0">About</h6>
                        <h2 class=" font-weight-600 mt-0 font-28 line-bottom">
                            <?php
                            $fac_id = 0;
                            if(isset($faculty)){
                                $webname = str_replace("Of","of",ucwords(strtolower($faculty['FAC_NAME'])));
                                $about = $faculty['ABOUT'];
                                if($faculty['ABOUT_IMAGE']){
                                    $logo = base_url().EXTRA_IMAGE_PATH.$faculty['ABOUT_IMAGE'];
                                }else{
                                    $logo = base_url().'images/usindh/logo.png';
                                }

                                $fac_id = $faculty['FAC_ID'];
                            }
                            echo $webname;
                            ?>

                        </h2>
                        <p style="overflow-wrap: anywhere;"><?php

                           // $about =  getLimitText($about);
                            echo $about?></p>
                     
                    </div>
                    <div class="col-md-6">
                        <div class="thumb">

                            <img style="max-height: 350px;max-width: 600px;    margin: auto;" alt="" src="<?=$logo?>" class="img-responsive img-fullwidth">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
