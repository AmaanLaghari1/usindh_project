<style>

     #logo {
            margin-left: -40px;
        }



</style>
<body class="">
    <div class="body-overlay"></div>
<div id="side-panel" class="dark layer-overlay overlay-white-9" data-bg-img="images/bg/bg5.jpg">
  <div class="side-panel-wrap">
    <div id="side-panel-trigger-close" class="side-panel-trigger"><a href="#"><i class="icon_close font-30"></i></a></div>
    <a href="javascript:void(0)"><img alt="logo" src="images/logo-wide.png"></a>
    <div class="side-panel-nav mt-30">
      <div class="widget no-border">
        <nav>
          <ul class="nav nav-list">
            <li><a href="#">Home</a></li>
            <li><a href="#">Services</a></li>
            <li><a class="tree-toggler nav-header">Pages <i class="fa fa-angle-down"></i></a>
              <ul class="nav nav-list tree">
                <li><a href="#">About</a></li>
                <li><a href="#">Terms</a></li>
                <li><a href="#">FAQ</a></li>
              </ul>
            </li>
            <li><a href="#">Contact</a></li>
          </ul>
        </nav>        
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="side-panel-widget mt-30">
      <div class="widget no-border">
        <ul>
          <li class="font-14 mb-5"> <i class="fa fa-phone text-theme-colored"></i> <a href="#" class="text-gray">123-456-789</a> </li>
          <li class="font-14 mb-5"> <i class="fa fa-clock-o text-theme-colored"></i> Mon-Fri 8:00 to 2:00 </li>
          <li class="font-14 mb-5"> <i class="fa fa-envelope-o text-theme-colored"></i> <a href="#" class="text-gray">contact@yourdomain.com</a> </li>
        </ul>      
      </div>
      <div class="widget">
        <ul class="styled-icons icon-dark icon-theme-colored icon-sm">
          <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
          <li><a href="#"><i class="fa fa-facebook"></i></a></li>
          <li><a href="#"><i class="fa fa-twitter"></i></a></li>
        </ul>
      </div>
      <p>Copyright &copy;2016 ThemeMascot</p>
    </div>
  </div>
</div>
<button type="button"  style="display: none" hidden id="small_modal_btn" class="btn btn-dark btn-flat" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="small_modal_title">Modal title</h4>
                </div>
                <div class="modal-body" id="small_modal_body">

                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-primary text-white" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
</div>
<div id="wrapper" class="clearfix">
    <!-- preloader -->
    <div id="preloader">
        <div id="spinner">
            <div class="preloader-dot-loading">
                <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
            </div>
        </div>
        <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
    </div>

    <!-- Header -->
    <header id="header" class="header">

        <div class="header-middle p-0 bg-lightest xs-text-center">
            <div class="container-fluid pt-0 pb-0">
                <div class="row">
                    <?php
                    if(isset($website_obj['LOGO'])&&$website_obj['LOGO']){
                        $logo = base_url().EXTRA_IMAGE_PATH.$website_obj['LOGO'];

                    }
                    else if(isset($department['LOGO'])&&$department['LOGO']){
                        $logo = base_url().EXTRA_IMAGE_PATH.$department['LOGO'];

                    }
                    else if(isset($faculty['LOGO'])&&$faculty['LOGO']){
                        $logo = base_url().EXTRA_IMAGE_PATH.$faculty['LOGO'];

                    }
                    else{
                        $logo = base_url().'images/us_logo.png';

                    }
                    $home_link = base_url();
                    if(isset($website_obj)){
                        $webname ="<h3 style='    font-weight: 800;margin-bottom: 0px;'>University of Sindh, Jamshoro</h3>";
                    }else if(isset($department)){
                        if($department['IS_INST']=="Y"){
                            $webname ="<h3 style='    font-weight: 800;margin-bottom: 0px;'>" .ucwords(strtolower($department['DEPT_NAME']))."</h3>"."<h4 style='    font-weight: 600;margin-top: 0px;'>University of Sindh, Jamshoro</h4>";
                        }else{
                            
                            // if (strpos(strtolower($department['DEPT_NAME']), "centre") !== false) {
                            //     $dept_name = ucwords(strtolower($department['DEPT_NAME']));
                            // }else{
                            //     $dept_name = "Department of " .ucwords(strtolower($department['DEPT_NAME']));
                            // }
                            $dept_name =$department['DEPT_NAME'];
                            $webname ="<h3 style='    font-weight: 800;margin-bottom: 0px;'>".$dept_name."</h3>"."<h4 style='    font-weight: 600;margin-top: 0px;'>University of Sindh, Jamshoro</h4>";
                        }
                        $home_link = base_url('dept/'.$department['DEPT_ID']);

                    }
                    else if(isset($faculty)){
                         $home_link = base_url('faculty/'.$faculty['FAC_ID']);
                        $webname ="<h3 style='    font-weight: 800;margin-bottom: 0px;'>" .ucwords(strtolower($faculty['FAC_NAME']))."</h3>"."<h4 style='    font-weight: 600;margin-top: 0px;'>University of Sindh, Jamshoro</h4>";
                    }else{
                        $webname="Universtiy of Sindh, Jamshoro";
                    }
                    ?>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <div class="widget no-border m-0">
                            <a  class="pull-left flip xs-pull-center mt-0 mb-0" href="javascript:void(0)"><img style="height: 130px;width: 550;" src="<?=$logo?>" alt=""></a>
                        </div>
                    </div>
                   
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <div class="widget no-border pull-right sm-pull-none sm-text-center  m-0">
                                <ul class="styled-icons icon-sm icon-bordered icon-circled clearfix mt-20">
                                    <li><a href="https://www.facebook.com/uosindh"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="https://twitter.com/uosindh"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="https://www.youtube.com/channel/UCt3oh4Zg4x725tH35OwV_4g"><i class="fa fa-youtube"></i></a></li>
                                    <li><a href="https://www.linkedin.com/school/university-of-sindh/"><i class="fa fa-fa fa-linkedin"></i></a></li>
                                    
                                </ul>
                                <ul class="list-inline">
                                    <li>
                                        <i class="fa fa-phone-square text-theme-colored font-36 mt-5 sm-display-block"></i>
                                    </li>
                                    <li>
                                        <a href="#" class="font-12 text-gray text-uppercase">Contact</a>
                                        <?php
                                        if(isset($website_obj['CONTACT'])&&$website_obj['CONTACT']){
                                            $CONTACT = $website_obj['CONTACT'];
                                        }
                                        else if(isset($department['CONTACT'])&&$department['CONTACT']){
                                            $CONTACT = $website_obj['CONTACT'];
                                        }else if(isset($faculty['CONTACT'])&&$faculty['CONTACT']){
                                            $CONTACT = $website_obj['CONTACT'];
                                        }else{
                                            $CONTACT = PHONE_NO;
                                        }
                                        ?>
                                        <h5 class="font-14 m-0"> <?=$CONTACT ?></h5>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <?php

                    if(isset($header_component['OPEN_TIME'])&&$header_component['OPEN_TIME']){
                    ?>

                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <div class="widget no-border pull-right sm-pull-none sm-text-center mt-30 mb-20 m-0">
                            <ul class="list-inline">
                                <li><i class="fa fa-clock-o text-theme-colored font-36 mt-5 sm-display-block"></i></li>
                                <li>
                                    <a href="#" class="font-12 text-gray text-uppercase">We are open!</a>
                                    <h5 class="font-13 text-black m-0"> <?=$header_component['OPEN_TIME']?></h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="header-nav" style="max-height: 50px;">
            <div class="header-nav-wrapper navbar-scrolltofixed bg-theme-colored border-bottom-theme-color-2-1px" style="max-height: 50px;">
                <div class="container">
                    <nav id="menuzord" class="menuzord bg-theme-colored pull-left flip menuzord-responsive">
                        <ul class="menuzord-menu">
                            <?php
                            //this method is declare in helper_function


                            if(isset($department))
                            {
                               $dept_id =  $department['DEPT_ID'];
                               $fac_id =  $department['FAC_ID'];
                               $inst_id = $department['INST_ID'];
                               $fac_name =  $department['FAC_NAME'];
                               if($inst_id>0){
                                   $dept_id = $inst_id;
                               }

                                ?>

                            <li><a href="<?=$home_link?>">Home</a></li>
                            <li>
                                <a href="#">About</a>
                                    <ul class="dropdown" >
                                        <li><a href="<?=base_url("/dept_about/$dept_id")?>">About</a></li>
                                        <li><a href="<?=base_url("/dept_mission/$dept_id")?>">Mission</a></li>
                                        <li><a href="<?=base_url("/dept_message/$dept_id")?>">HoD Message</a></li>
                                    </ul>
                            </li>
                            <?php
                            if(isset($departments)&&count($departments)){
                             ?>
                                <li>
                                    <a href="#">Departments</a>
                                    <ul class="dropdown" style="max-height: 450px;overflow-y: scroll;right: auto; display: none;">
                                        <?php
                                        foreach($departments as $department){
                                            $dept_id = $department['DEPT_ID'];
                                            echo" <li><a href=".base_url("dept/$dept_id").">".str_replace("Of","of",ucwords(strtolower($department['DEPT_NAME'])))."</a></li>";
                                        }
                                        ?>

                                    </ul>
                                </li>

                            <?php
                            }
                            ?>
                            <li>
                                <a href="#">Academic</a>
                                <ul class="dropdown" >
                                    <?php
                                    if(isset($programs)) {
                                        ?>
                                        <li><a href="#">Program</a>
                                            <ul  class="dropdown " >
                                                <?php
                                                if($programs!="NUll")
                                                foreach ($programs as $program) {
                                                    echo "<li><a href='" . base_url('/program/') . "" . $program['PROG_ID'] . "'>" . $program['PROGRAM_TITLE'] . "</a></li>";
                                                }

                                                ?>
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                    ?>


                                </ul>
                            </li>
                                <li><a href="#">Staff</a>
                                <ul id="staff_dropdown" class="dropdown" >
                                <li ><a href="<?=base_url("/faculty_members/$dept_id")?>">Teaching Staff<span class="indicator"></span></a></li>
                                </ul>
                            </li>
                            <?php

                             if(count($pages)>0){
                                 $list = "";
                                 foreach ($pages as $obj){
                                     $list .= " <li><a href='".base_url('page/'.$obj['PAGE_ID'])."'>{$obj['PAGE_NAME']}</a></li>";
                                 }
                                 echo " <li>
                                <a href='#'>Pages<span class='indicator'></span></a>
                                <ul class='dropdown' >
                                    $list
                                </ul>
                                </li>";
                             }
                            if(count($rnd)>0){
                                $list = "";
                                foreach ($rnd as $obj){
                                    $list .= " <li><a href='".base_url('page/'.$obj['PAGE_ID'])."'>{$obj['PAGE_NAME']}</a></li>";
                                }
                              echo " <li>
                                <a href='#'>R & D</a>
                                <ul class='dropdown' >
                                    $list
                                </ul>
                                </li>";
                            }
                            ?>

                            <?php
                            }
                            if(isset($faculty))
                            {

                                $fac_id =  $faculty['FAC_ID'];
                                $fac_name =  $faculty['FAC_NAME'];
                                ?>
                                <li><a href="<?=$home_link?>">Home</a></li>
                                <li>
                                    <a href="#">About</a>
                                    <ul class="dropdown">
                                        <li><a href="<?=base_url("/faculty_about/$fac_id")?>">About</a></li>
                                        <li><a href="<?=base_url("/faculty_message/$fac_id")?>">Dean Message</a></li>
                                    </ul>
                                </li>
                                <?php
                                if(count($institutes)){
                                ?>
                                    <li>
                                        <a href="#">Institute </a>
                                        <ul class="dropdown" >
                                            <?php
                                            foreach($institutes as $institute){
                                                $dept_id = $institute['DEPT_ID'];
                                                echo" <li><a href=".base_url("dept/$dept_id").">".str_replace("Of","of",ucwords(strtolower($institute['DEPT_NAME'])))."</a></li>";
                                            }
                                            ?>

                                        </ul>
                                    </li>
                                <?php
                                }
                                ?>
                                <?php
                                if(isset($departments)&&count($departments)){
                                    ?>
                                    <li>
                                        <a href="#">Departments</a>
                                        <ul class="dropdown" >
                                            <?php
                                            foreach($departments as $department){
                                                $dept_id = $department['DEPT_ID'];
                                                echo" <li><a href=".base_url("dept/$dept_id").">".str_replace("Of","of",ucwords(strtolower($department['DEPT_NAME'])))."</a></li>";
                                            }
                                            ?>

                                        </ul>
                                    </li>

                                    <?php
                                }
                                ?>





                                <?php
                            }
                            if(isset($navbar_list)){
                                makeNavbar($navbar_list);
                                if(isset($fac)){
                                    ?>
                                    <li>
                                        <a href="#">Faculty</a>
                                        <ul class="dropdown" >

                                            <?php
                                            foreach ($fac as $f){
                                                echo  " <li><a href='".base_url("faculty/".$f['FAC_ID'])."'>".str_replace("Of","of",ucwords(strtolower($f['FAC_NAME'])))."</a></li>";
                                            }
                                            ?>

                                        </ul>
                                    </li>

                                    <?php

                                }
                            }

                            if(isset($faculty)){
                                echo "<li ><a href=".base_url().">  Usindh <span class='pe-7s-back'></span></a></li>";
                            }else if (isset($department )){
                               echo "<li ><a href=".base_url("faculty/$fac_id")."> ".ucwords(strtolower($fac_name))." <span class='pe-7s-back'></span></a></li>
                                <li ><a href=".base_url()."> USindh <span class='pe-7s-back'></span></a></li>";
                            }

                            ?>



                        </ul>

                        <div id="top-search-bar" class="collapse">
                            <div class="container">
                                <form role="search" action="#" class="search_form_top" method="get">
                                    <input type="text" placeholder="Type text and press Enter..." name="s" class="form-control" autocomplete="off">
                                    <span class="search-close"><i class="fa fa-search"></i></span>
                                </form>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>