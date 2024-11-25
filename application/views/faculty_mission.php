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
    <section class="">
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12" style="overflow-wrap: anywhere;">
                        <h3 class="letter-space-4 text-gray-darkgray text-uppercase mt-0 mb-0"><?=$faculty['FAC_NAME']?></h3>
                        <p>
                            <?php
                            if (isset($faculty['MISSION'])){
                                echo urldecode($faculty['MISSION']);
                            }
                            ?>
                        </p>

                    </div>

                </div>
            </div>
        </div>
    </section>

</div>
