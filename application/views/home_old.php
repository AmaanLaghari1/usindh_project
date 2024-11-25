

  <main id="main">
     
<?php
if($marquee){
    echo "<div class='marquee'>
              <p>$marquee</p>
          </div>";
}
?>
    <!-- ======= Hero Slider Section ======= -->
    <section id="hero-slider" class="hero-slider">
      <div class="container-fluid" data-aos="fade-in">
        <div class="row">
          <div class="col-12">
            <div class="swiper sliderFeaturedPosts">
              <div class="swiper-wrapper">
                  <?php
                  foreach($sliders as $slider){
                     $image= base_url().EXTRA_IMAGE_PATH.$slider['IMAGE'];
                  ?>
                <div class="swiper-slide">
                  <a href="single-post.html" class="img-bg d-flex align-items-end" style="background-image: url('<?=$image?>');background-position: unset;">
                    <div class="img-bg-inner">
                      <h2><?=$slider['TITLE']?></h2>
                      <p><?=$slider['DESCRIPTION']?></p>
                    </div>
                  </a>
                </div>
                  <?php
                  }
                  ?>


              </div>
              <div class="custom-swiper-button-next">
                <span class="bi-chevron-right"></span>
              </div>
              <div class="custom-swiper-button-prev">
                <span class="bi-chevron-left"></span>
              </div>

              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Hero Slider Section -->
      <?php
      if(count($posts)>0){
      $post = $posts[0];
      $url =base_url()."posts/".$post['POST_ID'];
      $image= base_url().EXTRA_IMAGE_PATH.$post['IMAGE_PATH'];
      ?>
    <!-- ======= Post Grid Section ======= -->
    <section id="posts" class="posts">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">
          <div class="col-lg-4">
            <div class="post-entry-1 lg">
              <a href="<?=$url?>"><img src="<?=$image?>" alt="" class="img-fluid"></a>
              <div class="post-meta"><span class="date"><?=$post['NAME']?></span> <span class="mx-1">&bullet;</span> <span><?=getDateCustomeView($post['CREATE_AT'],'d-m-Y')?></span></div>
              <h2><a href="<?=$url?>"><?=$post['TITLE']?></a></h2>
              <p class="mb-4 d-block"><?=substr($post['DESCRIPTION'],0,800)?></p>

              <div class="d-flex align-items-center author">
                <div class="photo"><img src="assets/img/person-1.jpg" alt="" class="img-fluid"></div>
                <div class="name">
                  <h3 class="m-0 p-0">Dr Yasir Arfat Malkani</h3>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-8">
            <div class="row g-5">
              <div class="col-lg-6 border-start custom-border">
                  <?php
                  foreach($posts  as $k=>$post) {
                      if($k==0||$k%2==1){
                          continue;
                      }
                      $url =base_url()."posts/".$post['POST_ID'];
                      $image= base_url().EXTRA_IMAGE_PATH.$post['IMAGE_PATH'];
                      ?>
                      <div class="post-entry-1">
                          <a href="<?=$url?>"><img src="<?=$image?>" alt="" class="img-fluid"></a>
                          <div class="post-meta"><span class="date"><?=$post['NAME']?></span> <span class="mx-1">&bullet;</span>
                              <span><?=getDateCustomeView($post['CREATE_AT'],'d-m-Y')?></span></div>
                          <h2><a href="<?=$url?>"><?=$post['TITLE']?></a></h2>
                      </div>
                  <?php
                  }
                  ?>
              </div>
              <div class="col-lg-6 border-start custom-border">
                  <?php
                  foreach($posts  as $k=>$post) {
                      if($k%2==0){
                          continue;
                      }
                      $url =base_url()."posts/".$post['POST_ID'];
                      $image= base_url().EXTRA_IMAGE_PATH.$post['IMAGE_PATH'];
                      ?>
                      <div class="post-entry-1">
                          <a href="<?=$url?>"><img src="<?=$image?>" alt="" class="img-fluid"></a>
                          <div class="post-meta"><span class="date"><?=$post['NAME']?></span> <span class="mx-1">&bullet;</span>
                              <span><?=getDateCustomeView($post['CREATE_AT'],'d-m-Y')?></span></div>
                          <h2><a href="<?=$url?>"><?=$post['TITLE']?></a></h2>
                      </div>
                      <?php
                  }
                  ?>
              </div>


            </div>
          </div>

        </div> <!-- End .row -->
      </div>
    </section> <!-- End Post Grid Section -->
        <?php
      }
      
      ?>


  </main><!-- End #main -->

