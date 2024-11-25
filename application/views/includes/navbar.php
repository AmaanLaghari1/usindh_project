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
                    
                    <div class="col-xs-12 col-sm-8 col-md-9">
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
                        $logo = base_url().'images/usindh/logo.png';

                    }
                    $home_link = base_url();
                    if(isset($website_obj)){
                        $webname ="University of Sindh</br>Jamshoro<br><span style='font-size:12px'>The oldest University of the country<span>";
                    }else if(isset($department)){
                        
                        if($department['IS_INST']=="Y"){
                            //$webname =ucwords(strtolower($department['DEPT_NAME']))."<br>University of Sindh, Jamshoro";
                        }else{
                        
                           // $dept_name =$department['DEPT_NAME'];
                         ///   $webname ="<h3 style='    font-weight: 800;margin-bottom: 0px;'>".$dept_name."</h3>"."<h4 style='    font-weight: 600;margin-top: 0px;'>University of Sindh, Jamshoro</h4>";
                        }
                         $webname =str_replace("Of","of",ucwords(strtolower($department['DEPT_NAME'])))."<br><span  style='font-size:12px'>University of Sindh, Jamshoro</span>";
                        $webname = str_replace("A.h.s","A.H.S",$webname);
                        $webname = str_replace("M.a.","M.A.",$webname);
                        $home_link = base_url('dept/'.strtolower($department['CODE']));

                    }
                    else if(isset($faculty)){
                         $home_link = base_url('faculty/'.$faculty['URL']);
                       // $webname ="<h3 style='    font-weight: 800;margin-bottom: 0px;'>" .ucwords(strtolower($faculty['FAC_NAME']))."</h3>"."<h4 style='    font-weight: 600;margin-top: 0px;'>University of Sindh, Jamshoro</h4>";
                   $webname =str_replace("Of","of",ucwords(strtolower($faculty['FAC_NAME'])))."<br><span style='font-size:12px'>University of Sindh, Jamshoro<span>                   ";
                    }else{
                        $webname="Universtiy of Sindh</br>Jamshoro<br><span style='font-size:12px'>The oldest University of the country<span>";
                    }
                    ?><style>
                    @media screen and (max-width: 767px) {
                          #home {
                            height: 200; /* Set a different height for mobile devices */
                          }
                        }
                       .nav-text {
                          font-size: 30px; /* default font size */
                         font-weight:700;
                          line-height: 0.5;
                        }
                       .nav-text:not(:has(span)) {
                     
                        }
                        /* Remove fixed positioning and use relative position for the header-nav */
                        .header-nav-wrapper {
                          position: relative;
                        }
                        
                        /* Increase the z-index to make sure the dropdown is on top of other elements */
                        .menuzord {
                          z-index: 1000;
                        }
                        
                        /* Optional: Set a max-height for the dropdown to make sure it doesn't extend too far */
                        .menuzord-menu {
                          max-height: 400px;
                          overflow-y: auto; /* Add a scrollbar if necessary */
                        }

                    </style>
                
                        <article class="post media-post clearfix pb-0 mb-0">
                            <a href="" class="post-thumb mr-0 mb-0"><img alt="" style='height:100px;widht:100px' src="<?=$logo?>"></a>
                            <div class="post-right" style='text-align:left;'>
                              <h4 class="mt-20 mb-5"><a href="#" class='nav-text text-theme-colored'><?=$webname?></a></h4>
                                 </div>
                          </article>

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
                                        <i class="fa fa-envelope-square text-theme-colored font-36 mt-5 sm-display-block"></i>
                                    </li>
                                    <li>
                                        <a href="#" class="font-12 text-gray text-uppercase">Email</a>
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
                                        $email = EMAIL;
                                        ?>
                                        <h5 class="font-14 m-0"> <?=$email ?></h5>
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
            <div class="header-nav-wrapper navbar-scrolltofixed bg-theme-colored " >
                <div class="container">
                    <nav id="menuzord" class="menuzord bg-theme-colored pull-left flip menuzord-responsive" style="z-index:1000px">
                        <ul class="menuzord-menu" >
                            <?php
                            //this method is declare in helper_function


                            if(isset($department))
                            {
                               $dept_id =  strtolower($department['CODE']);//$department['DEPT_ID'];
                               $fac_id =  $department['FAC_ID'];
                               $inst_id = $department['INST_ID'];
                               $fac_name =  $department['FAC_NAME'];
                               

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
                            if($inst_id>0){
                                   $dept_id = $inst_id;
                               }
                            if(isset($departments)&&count($departments)){
                             ?>
                                <li>
                                    <a href="#">Departments</a>
                                    <ul class="dropdown" style="max-height: 450px;overflow-y: scroll;right: auto; display: none;">
                                        <?php
                                        foreach($departments as $department){
                                            $dept_id = strtolower($department['CODE']);//$department['DEPT_ID'];
                                            echo" <li><a href=".base_url("dept/$dept_id").">".str_replace("Of","of",ucwords(strtolower($department['DEPT_NAME'])))."</a></li>";
                                        }
                                        ?>

                                    </ul>
                                </li>

                            <?php
                            }
                            if(isset($department )&&$department['IS_ADMIN']==0){
                        
                            ?>
                            <li>
                                <a href="#">Academic</a>
                                <ul class="dropdown" >
                                    <?php
                                    if(isset($programs)) {
                                        ?>
                                        <li><a href="#">Programs</a>
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

                                $fac_id =  $faculty['URL'];
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
                                        <a href="#">Institutes </a>
                                        <ul class="dropdown" >
                                            <?php
                                            foreach($institutes as $institute){
                                                $dept_id =strtolower($institute['CODE']);// $institute['DEPT_ID'];
                                                $inst_name = str_replace("Of","of",ucwords(strtolower($institute['DEPT_NAME'])));
                                                 $inst_name = str_replace("A.h.s","A.H.S",$inst_name);
                                                 $inst_name = str_replace("M.a.","M.A.",$inst_name);
                                                  $inst_name = str_replace("For","for",$inst_name);
                                                echo" <li><a href=".base_url("dept/$dept_id").">".$inst_name."</a></li>";
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
                                                $dept_id = strtolower($department['CODE']);//$department['DEPT_ID'];
                                                   $dept_name = str_replace("Of","of",ucwords(strtolower($department['DEPT_NAME'])));
                                                
                                                $dept_name = str_replace("For","for",$dept_name);
                                                echo" <li><a href=".base_url("dept/$dept_id").">".$dept_name."</a></li>";
                                            }
                                            ?>

                                        </ul>
                                    </li>

                                    <?php
                                }
                                if(isset($centers)&&count($centers)){
                                    ?>
                                    <li>
                                        <a href="#">Centres</a>
                                        <ul class="dropdown" >
                                            <?php
                                            foreach($centers as $center){
                                                $dept_id = strtolower($center['CODE']);//$center['DEPT_ID'];
                                                
                                                $dept_name = str_replace("Of","of",ucwords(strtolower($center['DEPT_NAME'])));
                                                $dept_name = str_replace("A.h.s","A.H.S",$dept_name);
                                                $dept_name = str_replace("For","for",$dept_name);
                                                
                                                echo" <li><a href=".base_url("dept/$dept_id").">".$dept_name."</a></li>";
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
                                        <a href="#">Faculties</a>
                                        <ul class="dropdown" >

                                            <?php
                                            foreach ($fac as $f){
                                                if($f['FAC_ID']==15)
                                                continue;
                                                echo  " <li><a href='".base_url("faculty/".$f['URL'])."'>".str_replace("Of","of",ucwords(strtolower($f['FAC_NAME'])))."</a></li>";
                                            }
                                            ?>

                                        </ul>
                                    </li>

                                    <?php

                                }
                            }

                            if(isset($faculty)){
                                echo "<li ><a href=".base_url().">  Usindh <span class='pe-7s-back'></span></a></li>";
                            }else if (isset($department )&&$department['IS_ADMIN']==0){
                                
                               echo "<li ><a href=".base_url("faculty/$fac_id")."> ".ucwords(strtolower($fac_name))." <span class='pe-7s-back'></span></a></li>
                                <li ><a href=".base_url()."> USindh <span class='pe-7s-back'></span></a></li>";
                            }else if (isset($department )&&$department['IS_ADMIN']==1)
                            {
                               echo " <li ><a href=".base_url()."> USindh <span class='pe-7s-back'></span></a></li>";
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
    </header >
  