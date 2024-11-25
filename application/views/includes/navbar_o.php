<style>

     #logo {
            margin-left: -40px;
        }



</style>
<body class="">
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
      </div>

  
    
  <!-- Header -->
  <header id="header" class="header">
    <div class="header-top bg-deep xs-text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="widget no-border m-0">
              <ul class="styled-icons icon-dark icon-circled icon-theme-colored icon-sm">
                 <li><a href="https://www.facebook.com/uosindh"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="https://twitter.com/uosindh"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="https://www.youtube.com/channel/UCt3oh4Zg4x725tH35OwV_4g"><i class="fa fa-youtube"></i></a></li>
                                    <li><a href="https://www.linkedin.com/school/university-of-sindh/"><i class="fa fa-fa fa-linkedin"></i></a></li>
                             
              </ul>
            </div>
          </div>
          <div class="col-md-9">
            <div class="widget no-border m-0">
              <ul class="list-inline xs-text-center text-right mt-5">
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
                                       
                <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-colored"></i> <a class="text-gray" href="#"><?=$CONTACT ?></a> </li>
                  <?php

                    if(isset($header_component['OPEN_TIME'])&&$header_component['OPEN_TIME']){
                    ?>
                <li class="m-0 pl-10 pr-10"> <i class="fa fa-clock-o text-theme-colored"></i> <?=$header_component['OPEN_TIME']?></li>
                <?php
                    }
                ?>
                <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-colored"></i> <a class="text-gray" href="#">info@usindh.edu.pk</a> </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-nav">
      <div class="header-nav-wrapper navbar-scrolltofixed  bg-theme-colored">
        <div class="container-fluid">
          <nav id="menuzord-right" class="menuzord bg-theme-colored" style=''>
            <a class="menuzord-brand pull-left flip mt-0 mr-0" style='display: flex;
      align-items: center;' href="javascript:void(0)">
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
                        $webname ="University of Sindh, Jamshoro";
                    }else if(isset($department)){
                        
                        if($department['IS_INST']=="Y"){
                            //$webname =ucwords(strtolower($department['DEPT_NAME']))."<br>University of Sindh, Jamshoro";
                        }else{
                        
                           // $dept_name =$department['DEPT_NAME'];
                         ///   $webname ="<h3 style='    font-weight: 800;margin-bottom: 0px;'>".$dept_name."</h3>"."<h4 style='    font-weight: 600;margin-top: 0px;'>University of Sindh, Jamshoro</h4>";
                        }
                         $webname =str_replace("Of","of",ucwords(strtolower($department['DEPT_NAME'])))."<br><span  style='font-size:12px'>University of Sindh, Jamshoro</span>";
                        $home_link = base_url('dept/'.$department['DEPT_ID']);

                    }
                    else if(isset($faculty)){
                         $home_link = base_url('faculty/'.$faculty['FAC_ID']);
                       // $webname ="<h3 style='    font-weight: 800;margin-bottom: 0px;'>" .ucwords(strtolower($faculty['FAC_NAME']))."</h3>"."<h4 style='    font-weight: 600;margin-top: 0px;'>University of Sindh, Jamshoro</h4>";
                   $webname =ucwords(strtolower($faculty['FAC_NAME']))."<br><span style='font-size:12px'>University of Sindh, Jamshoro<span>                   ";
                    }else{
                        $webname="Universtiy of Sindh, Jamshoro";
                    }
                    ?>
                     <img src="<?=$logo?>" alt="" style='width:80px;height:80px;'>
                        <style>
                       .nav-text {
                          font-size: 20px; /* default font size */
                          color:white;
                        }
                       .nav-text:not(:has(span)) {
                      line-height: normal;
                    }

                        </style>
                     <span class='nav-text' ><?=$webname?></span>
            
            </a>
             <ul class="menuzord-menu menuzord-right mt-15 " style=' '>
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
                               echo "<li ><a href=".base_url("faculty/$fac_id")."> ".str_replace("Of","of",ucwords(strtolower($fac_name)))." <span class='pe-7s-back'></span></a></li>
                                <li ><a href=".base_url()."> USindh <span class='pe-7s-back'></span></a></li>";
                            }

                            ?>

            </ul>
            <script>
                const ul = document.querySelector('nav ul');
const links = document.querySelectorAll('nav>ul>li');
const brand = document.querySelector('nav a span');

if (links.length >= 10) {
  brand.style.fontSize = '13px';
  brand.style.transform = 'scaleY(2)';
  brand.style.display = 'inline-block';
} else if (links.length >= 9) {
  brand.style.fontSize = '16px';
  brand.style.transform = 'scaleY(2)';
  brand.style.display = 'inline-block';
}
else if (links.length >= 8) {
  brand.style.fontSize = '18px';
    brand.style.transform = 'scaleY(1.5)';
  brand.style.display = 'inline-block';
}else{
     brand.style.fontSize = '20px';
    brand.style.transform = 'scaleY(1.5)';
  brand.style.display = 'inline-block';
}
const navText = document.querySelector('.nav-text');

if (navText.querySelector('span')) {
  navText.style.lineHeight = '0.8';
} else {
  navText.style.lineHeight = 'normal';
}
            </script>
          </nav>
        </div>
      </div>
    </div>
  </header>
  