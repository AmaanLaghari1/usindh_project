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

    <section id="team">
        <div class="container">
             <?php
             $k = 0;
                foreach ($faculty_members as $faculty_member) {
                    
                    if($faculty_member['FLAG']==0){
                        continue;
                    }
                    if($faculty_member['PROFILE_IMAGE']){
                        $image_path = ITSC_BASE_URL."eportal_resource/images/applicants_profile_image/".$faculty_member['PROFILE_IMAGE'];
                    }else{
                        $image_path = base_url()."dash_assets/img/avatar/default-avatar.png";
                    }
                      $m_id = $this->encryption->encrypt($faculty_member['USER_ID']);
                     // prePrint($faculty_member);
                      $prefixs = json_decode('[{"PREFIX_ID":"2","PREFIX":"MR."},
                                                {"PREFIX_ID":"3","PREFIX":"MS."},
                                                {"PREFIX_ID":"4","PREFIX":"MRS."},
                                                {"PREFIX_ID":"1","PREFIX":"DR."},
                                                {"PREFIX_ID":"5","PREFIX":"PROF."},
                                                {"PREFIX_ID":"6","PREFIX":"PROF. DR."},
                                                {"PREFIX_ID":"7","PREFIX":"ENGR."}]',true);
                                                $pre="";
                        foreach($prefixs as $prefix){
                             if($prefix['PREFIX_ID'] == $faculty_member['PREFIX_ID']){
                                $pre = $prefix['PREFIX'] ;
                            }
                        }
                        if($k==0 || $k%4==0){
                            if($k!=0){
                                echo "$k</div  >";  
                            }
                            echo "<div  $k class='row'>"; 
                        }
                    ?>
               
               
                    <div class="col-xs-12 col-sm-6 col-md-3 sm-text-center mb-30 mb-sm-30">
                        <div class="team-members maxwidth400">
                            <div class="team-thumb">
                                <img  style="height: 300px;width:260px;"  class="img-fullwidth" alt="" src="<?=$image_path?>">
                            </div>
                            <div
                                class="team-bottom-part border-bottom-theme-color-2-2px bg-lighter border-1px text-center p-10 pt-20 pb-10">
                                <h4 class="text-uppercase font-raleway font-weight-600 m-0"><a
                                        class="text-theme-color-2" href="<?=base_url()."faculty_member_detail/$id?researcher=".$m_id?>"><?=$pre." ".ucwords(strtolower($faculty_member['FIRST_NAME']." ".$faculty_member['LAST_NAME']))?></a>
                                </h4>
                                <h5 class="text-theme-color"><?=$faculty_member['TITLE']==null?"Teacher":ucwords(strtolower($faculty_member['TITLE']))?> </h5>
                                <!--<ul class="styled-icons icon-sm icon-dark icon-theme-colored">-->
                                <!--    <li><a href="#"><i class="fa fa-facebook"></i></a></li>-->
                                <!--    <li><a href="#"><i class="fa fa-twitter"></i></a></li>-->
                                <!--    <li><a href="#"><i class="fa fa-instagram"></i></a></li>-->
                                <!--    <li><a href="#"><i class="fa fa-skype"></i></a></li>-->
                                <!--</ul>-->
                            </div>
                        </div>
                    </div>
                   
            
            
             <?php
                    
                        $k++;
                }
                echo "</div>";
                ?>
        </div>
    </section>


</div>
