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
    

            <!-- popup modal click trigger -->
            <a style='display:none;'href="#promoModal1" id='mclick' data-lightbox="inline" class="btn btn-default">Trigger Modal</a>

            <!-- popup modal -->
            <div id="promoModal1" class="modal-promo-box bg-img-cover mfp-hide" >
              
            <a href='http://convocation.usindh.edu.pk/'> <img src='images/bg/convocation.jpg'></a>

              <!-- Mailchimp Subscription Form Validation-->
              <script type="text/javascript">
                $('#mailchimp-subscription-form').ajaxChimp({
                    callback: mailChimpCallBack,
                    url: '//thememascot.us9.list-manage.com/subscribe/post?u=a01f440178e35febc8cf4e51f&amp;id=49d6d30e1e'
                });

                function mailChimpCallBack(resp) {
                    // Hide any previous response text
                    var $mailchimpform = $('#mailchimp-subscription-form'),
                        $response = '';
                    $mailchimpform.children(".alert").remove();
                    if (resp.result === 'success') {
                        $response = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.msg + '</div>';
                    } else if (resp.result === 'error') {
                        $response = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.msg + '</div>';
                    }
                    $mailchimpform.prepend($response);
                }
              </script>

              
            </div>

            <!-- popup modal onLoad trigger -->
            <div class="modal-on-load" data-target="#promoModal1"></div>

   
    <?php
    $content = file_get_contents('./application/views/page_data.txt');
    $content = str_replace("<?=base_url()?>",base_url(),$content);
    $news_section = file_get_contents("./application/views/news_section.php");
    $content = str_replace("#NEWS_SECTION",$news_section,$content);
    echo $content;
    ?>
   <?php
  // require('./application/views/news_section.php');
   ?>
</div>
 
