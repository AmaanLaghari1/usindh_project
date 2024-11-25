<?php
/**
 * Created by PhpStorm.
 * User: Kashif Shaikh
 * Date: 03/10/2022
 * Time: 12:45 PM
 */
$website_logo = $image = $hod_name = $hod_designation = $contact = $website_url = $website_name = $about = $mission=$id='';
if($website_obj){
    $mission = $website_obj['MISSION'];
    $website_name = $website_obj['WEBSITE_NAME'];
    $website_url = $website_obj['WEBSITE_URL'];
    $about = $website_obj['ABOUT'];
    $id = $website_obj['WEBSITE_ID'];
    $contact = $website_obj['CONTACT'];
    $hod_name = $website_obj['HOD_NAME'];
    $hod_designation = $website_obj['HOD_DESIGNATION'];
    $website_logo = $website_obj['LOGO'];
    $image = $website_obj['HOD_PHOTO'];
}
?>
<div id = "min-height" class="container-fluid" style="padding:30px">
    <div class='card'>
        <div class='card-body'>
            <form action='<?=base_url()."AdminPanel/website_handler"?>' enctype="multipart/form-data" onsubmit='return confirmForm()' method='post'>

                <div class="row">

                </div>
                <div class='row'>

                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Website Name<span class="text-danger">*</span></label>
                            <input required value='<?=$website_name?>' type='text' name='website_name' class='form-control'/>

                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Website Url<span class="text-danger">*</span></label>
                            <input required value='<?=$website_url?>' type='text' name='website_url' class='form-control'/>

                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Contact<span class="text-danger">*</span></label>
                            <input required value='<?=$contact?>' type='text' name='contact' class='form-control'/>

                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="tinymce-single responsive-mg-b-30">
                            <label>Mission<span class="text-danger">*</span></label>
                            <div id="summernote1">
                                <?=urldecode($mission)?>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-6' style="display: none">
                        <div class='form-group'>
                            <label>Mission<span class="text-danger">*</span></label>
                            <textarea name="mission" class="form-control" id="mission" cols="30" rows="10"><?=$mission?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="tinymce-single responsive-mg-b-30">
                            <label>About<span class="text-danger">*</span></label>
                            <div id="summernote2">
                                <?=urldecode($about)?>
                            </div>
                        </div>
                    </div>

                    <div class='col-md-6' style="display: none">

                        <div class='form-group'>
                            <label>About<span class="text-danger">*</span></label>
                            <textarea name="about" class="form-control" id="about" cols="30" rows="10"><?=$about?></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group res-mg-t-15">
                            <label for="exampleInput1" class="bmd-label-floating">Website Logo
                                <span class="text-danger">*</span>
                            </label><br>
                            <?php

                            $image_path_default =base_url()."dash_assets/img/avatar/docavtar.png";
                            $image_path = "";
                            if($website_logo != ""){
                                $image_path_default = base_url().EXTRA_IMAGE_PATH.$website_logo;
                                $image_path = base_url().EXTRA_IMAGE_PATH.$website_logo;

                            }
                            ?>
                            <img src="<?php echo $image_path_default; ?>" alt="Logo Image" class="" id="logo-image-view"  width="150px" height="150px" name="logo-image-view" >

                            <input  type="file" name="logo_image" id="logo_image"
                                   onchange="changeImage(this,'logo_image','logo-image-view',2000)"
                                   accept=".jpg,.png,.jpeg" value="<?php echo $image_path; ?>">
                            <input type="text" name="logo_image1" id="logo_image1"
                                   value="<?php echo $image_path; ?>" hidden>
                            <span class="text-danger">Image size should be less than 2mb</span>

                        </div>
                    </div>

                </div>
                <hr>
                <div class='row'>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Head Of Department Name<span class="text-danger">*</span></label>
                            <input required value='<?=$hod_name?>' type='text' name='hod_name' class='form-control'/>

                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Head Of Department Designation<span class="text-danger">*</span></label>
                            <input required value='<?=$hod_designation?>' type='text' name='hod_designation' class='form-control'/>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group res-mg-t-15">
                            <label for="exampleInput1" class="bmd-label-floating">Head Of Department Photo
                                <span class="text-danger">*</span>
                            </label><br>
                            <?php

                            $image_path_default =base_url()."dash_assets/img/avatar/docavtar.png";
                            $image_path = "";
                            if($image != ""){
                                $image_path_default = base_url().EXTRA_IMAGE_PATH.$image;
                                $image_path = base_url().EXTRA_IMAGE_PATH.$image;

                            }
                            ?>
                            <img src="<?php echo $image_path_default; ?>" alt="HOD Image" class="" id="hod-image-view"  width="150px" height="150px" name="hod-image-view" >

                            <input  type="file" name="hod_image" id="hod_image"
                                   onchange="changeImage(this,'hod_image','hod-image-view',2000)"
                                   accept=".jpg,.png,.jpeg" value="<?php echo $image_path; ?>">
                            <input type="text" name="hod_image1" id="hod_image1"
                                   value="<?php echo $image_path; ?>" hidden>
                            <span class="text-danger">Image size should be less than 2mb</span>

                        </div>
                    </div>


                </div>


                <div class='row'>
                    <div class='col-md-4'>
                        <br><br>
                        <?php
                        if($id){
                            echo "<input name='id' value='$id' hidden/>";
                            echo "<button  class='btn btn-warning' name='update' type='submit'>Update</button>";
                        }else{
                            echo "<button  class='btn btn-success' name='add' type='submit'>Add</button>";
                        }
                        ?>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class='card'>
        <div class='card-body'>
            <table class='table table-borderd'>
                <?php
                echo "<tr>
                            <th> ID</th> 
                            <th> LOGO  </th> 
                            <th> WEBSITE NAME</th> 
                            <th> WEBSITE URL</th> 
                            <th> CONTACT</th> 
                            <th> HOD NAME</th> 
                            <th> HOD DESIGNATION</th> 
                            <th> HOD PHOTO</th> 
                            <th>MISSION</th>
                            <th>ABOUT</th>
                            <th colspan='2'>ACTION</th>
                             
                        </tr>";
                foreach($websites as $website){

                    if($website['ACTIVE']==1){
                        $btn = "<a onclick='return confirm(\"Are You sure? Do you want to Deactive Website\")' class='btn btn-danger' href='".base_url()."AdminPanel/website_handler?id={$website['WEBSITE_ID']}&action=delete' >Click For Deactive</a>";
                    }else{
                        $btn = "<a onclick='return confirm(\"Are You sure? Do you want to Active Website\")' class='btn btn-success' href='".base_url()."AdminPanel/website_handler?id={$website['WEBSITE_ID']}&action=revoke' >Click For Active</a>";
                    }
                    echo "<tr>
                            <td>{$website['WEBSITE_ID']}</td>
                            <td>{$website['LOGO']}</td>
                             <td>{$website['WEBSITE_NAME']}</td>
                              <td>{$website['WEBSITE_URL']}</td>
                               <td>{$website['CONTACT']}</td>
                               <td>{$website['HOD_NAME']}</td>
                               <td>{$website['HOD_DESIGNATION']}</td>
                               <td>{$website['HOD_PHOTO']}</td>
                               
                             
                    
                            <td><textarea cols='30' rows='7'>".urldecode($website['MISSION'])."</textarea></td>
                            <td><textarea cols='30' rows='7'>".urldecode($website['ABOUT'])."</textarea></td>
                            
                            
                        
                            <td><a href='".base_url()."AdminPanel/view_all_website?id={$website['WEBSITE_ID']}'>Edit</a></td>
                            <td>{$btn}</td>
                        </tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>
<script>
function confirmForm(){
    let mission = encodeURI($('#summernote1').summernote('code'));
    let about  = encodeURI($('#summernote2').summernote('code'));
    $('#mission').html(mission);
    $('#about').html(about);
    return confirm("Are You Sure?")
}
</script>

