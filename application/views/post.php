
<main id="main">

    <section class="single-post-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3 " data-aos="fade-up">
                </div>
                <div class="col-md-9 post-content" data-aos="fade-up">

                    <!-- ======= Single Post Content ======= -->
                    <div class="single-post">
                        <div class="post-meta"><span class="date"><?=$post['NAME']?></span> <span class="mx-1">&bullet;</span> <span><?=getDateCustomeView($post['CREATE_AT'],'d-m-Y')?></span></div>
                        <h1 class="mb-5"><?=$post['TITLE']?></h1>

                        <figure style="text-align: left;" class="my-4">

                            <?php
                            $type_id = $post['TYPE_ID'];
                            $image = base_url().EXTRA_IMAGE_PATH.$post['IMAGE_PATH'];
                            if($type_id==1){

                                echo "<img class=\"img-fluid\" alt=\"\" src=\"$image\">";
                            }else if($type_id == 2){
                                $image = $post['IMAGE_PATH'];
                                echo "<iframe width=\"560\" height=\"315\" src=\"$image\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>";
                            }else if($type_id == 3){

                                echo "<div class=\"fluid-video-wrapper\">
                                         <iframe src=\"$image\" width=\"640\" height=\"360\" allowfullscreen></iframe>
                                       </div>";
                            }

                            ?>
                        </figure>
                        <p><?=$post['DESCRIPTION']?></p>
                     </div><!-- End Single Post Content -->


                </div>

            </div>
        </div>
    </section>
</main><!-- End #main -->
