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

                            $about =  getLimitText($about);
                            echo $about?></p>
                        <a class="btn btn-theme-colored btn-flat btn-lg mt-10 mb-sm-30" href="<?=base_url("/fac_about/$fac_id")?>">Know More →</a>
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
 <?php
    
    if(count($institutes)){
    ?>
    <!-- Section: COURSES -->
    <section id="courses" class="bg-lighter">
        <div class="container pb-60">
            <div class="section-title mb-10">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="mt-0 text-uppercase font-28 line-bottom line-height-1">Our <span class="text-theme-color-2 font-weight-400">Institutes</span></h2>
                    </div>
                </div>
            </div>
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="owl-carousel-4col" data-dots="true">

                            <?php
                            $k=0;
                            foreach($institutes as  $institute ){
                            if($k>3){
                                $k=0;

                            }
                             $dept_name = str_replace("Of","of",ucwords(strtolower($institute['DEPT_NAME'])));
                                               $dept_name = str_replace("M.a.","M.A.",$dept_name);
                                                   $dept_name = str_replace("For","for",$dept_name);
                                ?>
                                <div class="item ">
                                    <div class="service-block bg-white">
                                        <div class="thumb"> <img alt="featured project" src="<?=base_url()?>images/project/<?=$k++?>.jpg" class="img-fullwidth">
                                            <h4 class="text-white mt-0 mb-0"><span class="price"><?=$dept_name?></span></h4>
                                        </div>
                                        <div class="content text-left flip p-25 pt-0">
                                            <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="<?=base_url("dept/".strtolower($institute['CODE']))?>">view details</a>
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
    </section>
   
    <?php
    }
    if(count($departments)){
    ?>
    <section id="courses" class="bg-lighter">
        <div class="container pb-60">
            <div class="section-title mb-10">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="mt-0 text-uppercase font-28 line-bottom line-height-1">Our <span class="text-theme-color-2 font-weight-400">Departments</span></h2>
                    </div>
                </div>
            </div>
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="owl-carousel-4col" data-dots="true">

                            <?php
                            $k=0;
                            foreach($departments as  $department ){
                                if($k>3){
                                    $k=0;

                                }
                                   $dept_name = str_replace("Of","of",ucwords(strtolower($department['DEPT_NAME'])));
                                           
                                                   $dept_name = str_replace("For","for",$dept_name);
                                ?>
                                <div class="item ">
                            <div class="service-block bg-white">
                                <div class="thumb"> <img alt="featured project" src="<?=base_url()?>images/project/<?=$k++?>.jpg" class="img-fullwidth">
                                    <h4 class="text-white mt-0 mb-0"><span class="price"><?=$dept_name?></span></h4>
                                </div>
                                <div class="content text-left flip p-25 pt-0">
                                    <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="<?=base_url("dept/".strtolower($department['CODE']))?>">view details</a>
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
    </section>
    <?php
    }
     if(count($centers)){
         ?>
         <section id="courses" class="bg-lighter">
        <div class="container pb-60">
            <div class="section-title mb-10">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="mt-0 text-uppercase font-28 line-bottom line-height-1">Our <span class="text-theme-color-2 font-weight-400">Centres</span></h2>
                    </div>
                </div>
            </div>
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="owl-carousel-4col" data-dots="true">

                            <?php
                            $k=0;
                            foreach($centers as  $department ){
                                if($k>3){
                                    $k=0;

                                }
                              //  $dept_name = ucwords(strtolower($department['DEPT_NAME']));
                                  $dept_name = str_replace("Of","of",ucwords(strtolower($department['DEPT_NAME'])));
                                                $dept_name = str_replace("A.h.s","A.H.S",$dept_name);
                                                  $dept_name = str_replace("For","for",$dept_name);
                                ?>
                                <div class="item ">
                            <div class="service-block bg-white">
                                <div class="thumb"> <img alt="featured project" src="<?=base_url()?>images/project/<?=$k++?>.jpg" class="img-fullwidth">
                                    <h4 class="text-white mt-0 mb-0"><span class="price"><?=$dept_name?></span></h4>
                                </div>
                                <div class="content text-left flip p-25 pt-0">
                                    <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="<?=base_url("dept/".strtolower($department['CODE']))?>">view details</a>
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
    </section>  
         
    <?php
     
     }
    ?>

    <!-- Divider: Funfact -->
    <section class="divider parallax layer-overlay overlay-theme-colored-9" data-bg-img="<?=base_url()?>images/bg/bg2.jpg" data-parallax-ratio="0.7">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                    <div class="funfact text-center">
                        <i class="pe-7s-smile mt-5 text-theme-color-2"></i>
                        <h2 data-animation-duration="2000" data-value="5248" class="animate-number text-white mt-0 font-38 font-weight-500">0</h2>
                        <h5 class="text-white text-uppercase mb-0">Happy Students</h5>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                    <div class="funfact text-center">
                        <i class="pe-7s-note2 mt-5 text-theme-color-2"></i>
                        <h2 data-animation-duration="2000" data-value="675" class="animate-number text-white mt-0 font-38 font-weight-500">0</h2>
                        <h5 class="text-white text-uppercase mb-0">Our Courses</h5>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                    <div class="funfact text-center">
                        <i class="pe-7s-users mt-5 text-theme-color-2"></i>
                        <h2 data-animation-duration="2000" data-value="248" class="animate-number text-white mt-0 font-38 font-weight-500">0</h2>
                        <h5 class="text-white text-uppercase mb-0">Our Teachers</h5>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 mb-md-0">
                    <div class="funfact text-center">
                        <i class="pe-7s-cup mt-5 text-theme-color-2"></i>
                        <h2 data-animation-duration="2000" data-value="24" class="animate-number text-white mt-0 font-38 font-weight-500">0</h2>
                        <h5 class="text-white text-uppercase mb-0">Awards Won</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>


<!--    <!-- Section: blog -->-->
<!--    <section id="blog" class="bg-lighter">-->
<!--        <div class="container">-->
<!--            <div class="section-title mb-10">-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12">-->
<!--                        <h2 class="mt-0 text-uppercase font-28 line-bottom line-height-1">Latest <span class="text-theme-color-2 font-weight-400">News</span></h2>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="section-content">-->
<!--                <div class="row">-->
<!--                    <div class="col-xs-12 col-sm-6 col-md-4 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">-->
<!--                        <article class="post clearfix mb-sm-30">-->
<!--                            <div class="entry-header">-->
<!--                                <div class="post-thumb thumb">-->
<!--                                    <img src="--><?//=base_url()?><!--images/blog/7.jpg" alt="" class="img-responsive img-fullwidth">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="entry-content p-20 pr-10 bg-white">-->
<!--                                <div class="entry-meta media mt-0 no-bg no-border">-->
<!--                                    <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">-->
<!--                                        <ul>-->
<!--                                            <li class="font-16 text-white font-weight-600 border-bottom">28</li>-->
<!--                                            <li class="font-12 text-white text-uppercase">Feb</li>-->
<!--                                        </ul>-->
<!--                                    </div>-->
<!--                                    <div class="media-body pl-15">-->
<!--                                        <div class="event-content pull-left flip">-->
<!--                                            <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a href="#">Post title here</a></h4>-->
<!--                                            <span class="mb-10 text-gray-darkgray mr-10 font-13"><i class="fa fa-commenting-o mr-5 text-theme-colored"></i> 214 Comments</span>-->
<!--                                            <span class="mb-10 text-gray-darkgray mr-10 font-13"><i class="fa fa-heart-o mr-5 text-theme-colored"></i> 895 Likes</span>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <p class="mt-10">Lorem ipsum dolor sit amet, consectetur adipisi cing elit. Molestias eius illum libero dolor nobis deleniti, sint assumenda Pariatur iste.</p>-->
<!--                                <a href="#" class="btn-read-more">Read more</a>-->
<!--                                <div class="clearfix"></div>-->
<!--                            </div>-->
<!--                        </article>-->
<!--                    </div>-->
<!--                    <div class="col-xs-12 col-sm-6 col-md-4 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.4s">-->
<!--                        <article class="post clearfix mb-sm-30">-->
<!--                            <div class="entry-header">-->
<!--                                <div class="post-thumb thumb">-->
<!--                                    <img src="--><?//=base_url()?><!--images/blog/2.jpg" alt="" class="img-responsive img-fullwidth">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="entry-content p-20 pr-10 bg-white">-->
<!--                                <div class="entry-meta media mt-0 no-bg no-border">-->
<!--                                    <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">-->
<!--                                        <ul>-->
<!--                                            <li class="font-16 text-white font-weight-600 border-bottom">28</li>-->
<!--                                            <li class="font-12 text-white text-uppercase">Feb</li>-->
<!--                                        </ul>-->
<!--                                    </div>-->
<!--                                    <div class="media-body pl-15">-->
<!--                                        <div class="event-content pull-left flip">-->
<!--                                            <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a href="#">Post title here</a></h4>-->
<!--                                            <span class="mb-10 text-gray-darkgray mr-10 font-13"><i class="fa fa-commenting-o mr-5 text-theme-colored"></i> 214 Comments</span>-->
<!--                                            <span class="mb-10 text-gray-darkgray mr-10 font-13"><i class="fa fa-heart-o mr-5 text-theme-colored"></i> 895 Likes</span>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <p class="mt-10">Lorem ipsum dolor sit amet, consectetur adipisi cing elit. Molestias eius illum libero dolor nobis deleniti, sint assumenda Pariatur iste.</p>-->
<!--                                <a href="#" class="btn-read-more">Read more</a>-->
<!--                                <div class="clearfix"></div>-->
<!--                            </div>-->
<!--                        </article>-->
<!--                    </div>-->
<!--                    <div class="col-xs-12 col-sm-6 col-md-4 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.4s">-->
<!--                        <article class="post clearfix">-->
<!--                            <div class="entry-header">-->
<!--                                <div class="post-thumb thumb">-->
<!--                                    <img src="--><?//=base_url()?><!--images/blog/5.jpg" alt="" class="img-responsive img-fullwidth">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="entry-content p-20 pr-10 bg-white">-->
<!--                                <div class="entry-meta media mt-0 no-bg no-border">-->
<!--                                    <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">-->
<!--                                        <ul>-->
<!--                                            <li class="font-16 text-white font-weight-600 border-bottom">28</li>-->
<!--                                            <li class="font-12 text-white text-uppercase">Feb</li>-->
<!--                                        </ul>-->
<!--                                    </div>-->
<!--                                    <div class="media-body pl-15">-->
<!--                                        <div class="event-content pull-left flip">-->
<!--                                            <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a href="#">Post title here</a></h4>-->
<!--                                            <span class="mb-10 text-gray-darkgray mr-10 font-13"><i class="fa fa-commenting-o mr-5 text-theme-colored"></i> 214 Comments</span>-->
<!--                                            <span class="mb-10 text-gray-darkgray mr-10 font-13"><i class="fa fa-heart-o mr-5 text-theme-colored"></i> 895 Likes</span>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <p class="mt-10">Lorem ipsum dolor sit amet, consectetur adipisi cing elit. Molestias eius illum libero dolor nobis deleniti, sint assumenda Pariatur iste.</p>-->
<!--                                <a href="#" class="btn-read-more">Read more</a>-->
<!--                                <div class="clearfix"></div>-->
<!--                            </div>-->
<!--                        </article>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->




</div>
