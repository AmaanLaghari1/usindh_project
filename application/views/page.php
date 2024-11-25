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
                        <h3 class="letter-space-4 text-gray-darkgray text-uppercase mt-0 mb-0"><?=$page['PAGE_NAME']?></h3>
                        <p>
                            <?php
                            if (isset($page['DESCRIPTION'])){
                                $page_data = urldecode($page['DESCRIPTION']);
                                //prePrint($list_of_component);
                                for($i=count($list_of_component);$i>=1;$i--){
                                   // echo "\$COMPONENT_".$k;
                                    $component = $list_of_component[$i];
                                   $page_data = str_replace("\$COMPONENT_".$i,$component,$page_data); 
                                }
                                $page_data = str_replace('<?=base_url()?>',base_url(),$page_data);
                                
                                echo $page_data;
                            }
                            ?>
                        </p>

                    </div>

                </div>
            </div>
        </div>
    </section>

</div>




 
