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
                            echo $website_obj['WEBSITE_NAME'];
                            ?>

                        </h2>
                        <p style="overflow-wrap: anywhere;">
                            <?php
                             if (isset($website_obj['ABOUT'])){
                                 echo urldecode($website_obj['ABOUT']);
                             }
                             ?>
                           </p>
                     
                    </div>
                    <div class="col-md-6">
                        <div class="thumb">

                            <img style="max-height: 350px;max-width: 600px;    margin: auto;" alt="" src="<?=$website_obj['ABOUT_IMAGE']?>" class="img-responsive img-fullwidth">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: About -->
   

</div>
