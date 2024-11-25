<div class="main-content">

    <?php
    $image= base_url().EXTRA_IMAGE_PATH.$post['IMAGE_PATH'];
    ?>
    <section>
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="product">
                        <div class="col-md-5">
                            <div class="product-image">
                                <div class="zoom-gallery">
                                    <?php
                                    $type_id = $post['TYPE_ID'];
                                    $image = base_url().EXTRA_IMAGE_PATH.$post['IMAGE_PATH'];
                                    if($type_id==1){

                                        echo " <img class=\"img-fluid\" alt=\"\" src=\"$image\">";
                                    }else if($type_id == 2){
                                        $image = $post['IMAGE_PATH'];
                                        echo "<iframe width=\"560\" height=\"315\" src=\"$image\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>";
                                    }else if($type_id == 3){

                                        echo "<div class=\"fluid-video-wrapper\">
                                         <iframe src=\"$image\" width=\"640\" height=\"360\" allowfullscreen></iframe>
                                       </div>";
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="product-summary">
                                <h2 class="product-title"><?=$post['TITLE']?></h2>
                                <div class="product_review">
                                    <ul class="review_text list-inline">
                                        <li>
                                            <div title="Rated 4.50 out of 5" class="star-rating"><span style="width: 90%;">4.50</span></div>
                                        </li>
                                        <li><a href="#"><span>2</span>view</a></li>

                                    </ul>
                                </div>
                                <div class="short-description">
                                    <p><?=urldecode($post['DESCRIPTION'])?></p>
                                </div>
                                <div class="category"><strong>Category:</strong> <a href="#"><?=$post['NAME']?></a></div>
                                <div class="post_date"><strong>Posted Date:</strong> <a href="#"><?=getDateCustomeView($post['CREATE_AT'],'d-m-Y')?></a></div>


                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="horizontal-tab product-tab">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab1" data-toggle="tab">Description</a></li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab1">
                                        <h3>Description</h3>
                                        <p><?=urldecode($post['DESCRIPTION'])?></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h3 class="line-bottom">Latest News</h3>
                        <div class="row multi-row-clearfix">
                            <div class="products related">
                                <?php

                                foreach($posts  as $k=>$post) {

                                    $url =base_url()."news/".$post['POST_ID'];
                                    //$image= $post['IMAGE_PATH'];
                                    $image= base_url().EXTRA_IMAGE_PATH.$post['IMAGE_PATH'];
                                    ?>

                                    <div class="col-sm-6 col-md-3 col-lg-3 mb-sm-30">
                                        <div class="product">
                                            <span class="tag-sale">NEW!</span>
                                            <div class="product-thumb">
                                                <?php
                                                $type_id = $post['TYPE_ID'];
                                                if($type_id==1){
                                                    echo "<img style='    height: 150px' class=\"img-responsive img-fullwidth\" alt=\"\" src=\"$image\">";
                                                }else if($type_id == 2){
                                                    $image = $post['IMAGE_PATH'];
                                                    echo "<iframe style='    height: 150px' width=\"560\" height=\"315\" src=\"$image\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>";
                                                }else if($type_id == 3){

                                                    echo "<div class=\"fluid-video-wrapper\">
                                                      <iframe  style='   height: 150px' src=\"$image\" width=\"640\" height=\"360\" allowfullscreen></iframe>
                                                    </div>";
                                                }

                                                ?>

                                                <div class="overlay">

                                                    <div class="btn-product-view-details">
                                                        <a class="btn btn-default btn-theme-colored btn-sm btn-flat pl-20 pr-20 btn-add-to-cart text-uppercase font-weight-700" href="<?=$url?>">View detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-details text-center">
                                                <a href="<?=$url?>"><h5 class="product-title"><?=$post['TITLE']?></h5></a>

                                            </div>
                                        </div>
                                    </div>


                                    <?php
                                }
                                ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>