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
                            $dept_id = 0;
                            if(isset($department)){
                                if($department['IS_INST']=="Y"){
                                    //$webname =ucwords(strtolower($department['DEPT_NAME']));
                                    $webname =$department['DEPT_NAME'];
                                }else{
                                    //$webname ="Department of " .ucwords(strtolower($department['DEPT_NAME']));
                                     $webname =$department['DEPT_NAME'];
                                }

                            $about = $department['ABOUT'];
                            $logo = base_url().EXTRA_IMAGE_PATH.$department['ABOUT_IMAGE'];
                            $dept_id = strtolower($department['DEPT_ID']);//$department['DEPT_ID'];
                            }
                            echo $webname;
                            ?>

                        </h2>
                          <p style="overflow-wrap: anywhere;">
                              <?php
                              
                              echo truncate_html(urldecode($about));
                              ?>
                          </p>
                        <a class="btn btn-theme-colored btn-flat btn-lg mt-10 mb-sm-30" href="<?=base_url("/dept_about/$dept_id")?>">Know More →</a>
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
    if($department['IS_ADMIN']==0&&count($programs)){
    ?>
    <!-- Section: COURSES -->
    <section id="courses" class="bg-lighter">
        <div class="container pb-60">
            <div class="section-title mb-10">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="mt-0 text-uppercase font-28 line-bottom line-height-1">Our <span class="text-theme-color-2 font-weight-400">PROGRAMS</span></h2>
                    </div>
                </div>
            </div>
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <div  class="owl-carousel-4col" data-dots="true">
                            <?php
                            
                            if($programs && $programs!="NUll"){
                                $k=0;
                                foreach($programs as $program) {
                                   /*
                                    $list_of_title = explode(' ',$program['PROGRAM_TITLE']);

                                    $prog  =array();
                                    foreach ($list_of_title as $title){

                                        $check = true;
                                        //echo $title."--<br>";
                                        $arr = array('BS','M.Phil','Ph.D');
                                        foreach ($arr as $a){
//                                            echo $a;
//                                            echo "**";
//                                            echo $title;
//                                            echo "==";
                                            $v = strpos($title,$a);
                                         //   var_dump($v);
                                            if(!($v==false)){
                                               // echo $a;
                                                $check = false;
                                                break;
                                            }
                                        }
                                        if($check){
                                            //echo "____ $title ___";
                                            $title = ucwords(strtolower($title));
                                        }
                                        $prog[]=$title;



                                    }
                                    $program_title = implode(' ',$prog);
                                   */
                                    $program_title = $program['PROGRAM_TITLE'];
                                    if($k>3){
                                        $k=0;

                                    }
                                    ?>
                                    <div class="item ">
                                        <div class="service-block bg-white">
                                            <div class="thumb"> <img alt="featured project" src="<?=base_url()?>images/project/<?=$k++?>.jpg" class="img-fullwidth">
                                                <h4 class="text-white mt-0 mb-0"><span class="price"><?=$program_title?></span></h4>
                                            </div>
                                            <div class="content text-left flip p-25 pt-0">
                                                  <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="<?=base_url('/program/'.$program['PROG_ID'])?>">view details</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
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
    $file_name = './application/views/dept_content/page_'.$department['DEPT_ID'].'.txt';
    if(file_exists($file_name)){
        $content = file_get_contents($file_name);
        $content = str_replace("<?=base_url()?>",base_url(),$content);
        echo $content;
        
    }
    
 



    
?>  

   

</div>
