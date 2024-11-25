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

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row mb-15">

                        <div class="col-sm-6 col-md-8">
                            <h4 class="line-bottom mt-0 mt-sm-20"><?=$degree_title ?></h4>
                            <ul class="review_text list-inline">
                                <li><h4 class="mt-0"><span class="text-theme-color-2"><?=$program_title?></span> </h4></li>

                            </ul>
                            </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="sidebar sidebar-left mt-sm-30">
                        <div class="widget">
                            <h5 class="widget-title line-bottom">Search <span class="text-theme-color-2">Scheme</span></h5>
                            <div class="search-form">
                                <form>
                                    <div class="input-group">
                                        <select id='year'class="form-control">
                                            <?php
                                            for ($i=date("Y");$i>=2004;$i--){
                                                echo "<option value='$i'>$i</option>";
                                            }
                                            ?>
                                            
                                        </select>
                                        <span class="input-group-btn">
                                      <button onclick="search_scheme()" type="button" class="btn search-button"><i class="fa fa-search"></i></button>
                                      </span>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <section>
        <div class="container pt-0" >
            <div class="row">
                <div class="col-md-12" id="scheme_table">
                </div>
            </div>
        </div>
    </section>
</div>
<script>
   function search_scheme() {
       $('#scheme_table').html("");
       let p_id = <?=$program_id?>;
       let year = $("#year").val();

       var f =new  FormData();
       f.append('program_id',p_id);
       f.append('scheme_year',year);
       jQuery.ajax({
           url: "<?=EXAM_BASE_URL?>course_scheme_request_handler.php",
           type: "POST",
           data:f,
           enctype: 'multipart/form-data',
           processData: false,
           contentType: false,
           success: function (dat, status) {

               $('#scheme_table').html(dat);


           },
           beforeSend:function (data, status) {
           },
           error:function (data, status) {
           },
       });
   } 
</script>
