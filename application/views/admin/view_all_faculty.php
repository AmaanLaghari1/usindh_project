<?php
/**
 * Created by PhpStorm.
 * User: Kashif Shaikh
 * Date: 03/10/2022
 * Time: 12:45 PM
 */
$URL = $about_image =$LOGO =$fac_name =$fac_title= $dean_name=$dean_message=$dean_desg=$about=$image=$id='';
if($faculty_obj){

    $fac_name = $faculty_obj['FAC_NAME'];
    $fac_title = $faculty_obj['FAC_TITLE'];
    $dean_name = $faculty_obj['DEAN_NAME'];
    $dean_message = $faculty_obj['DEAN_MESSAGE'];
    $dean_desg = $faculty_obj['DEAN_DESIGNATION'];
    $about = $faculty_obj['ABOUT'];
    $image = $faculty_obj['DEAN_IMAGE'];
    $id = $faculty_obj['FAC_ID'];
    $LOGO = $faculty_obj['LOGO'];
    $URL = $faculty_obj['URL'];
    
    $about_image = $faculty_obj['ABOUT_IMAGE'];
}
?>
<div id = "min-height" class="container-fluid" style="padding:30px">
    <div class='card'>
        <div class='card-body'>
            <form action='<?=base_url()."AdminPanel/faculty_handler"?>' enctype="multipart/form-data" onsubmit='return confirmForm()'  method='post'>

                <div class='row'>
                    <div class='col-md-4'>
                        <div class='form-group'>

                            <label>Faculty Name<span class="text-danger">*</span></label>
                            <input required value='<?=$fac_name?>' type='text' name='fac_name' class='form-control'/>
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class='form-group'>

                            <label>Faculty Title<span class="text-danger">*</span></label>
                            <input required value='<?=$fac_title?>' type='text' name='fac_title' class='form-control'/>
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class='form-group'>

                            <label>Faculty URL<span class="text-danger">*</span></label>
                            <input required value='<?=$URL?>' type='text' name='url' class='form-control'/>
                        </div>
                    </div>
                      </div>

 <div class='row'>
                    <div class='col-md-6'>
                        <div class='form-group'>
                            <label>Dean Name<span class="text-danger">*</span></label>
                            <input required value='<?=$dean_name?>' type='text' name='dean_name' class='form-control'/>
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div class='form-group'>
                            <label>Dean Designation<span class="text-danger">*</span></label>
                            <input required value='<?=$dean_desg?>' type='text' name='dean_desg' class='form-control'/>
                        </div>
                    </div>


                </div>
                <div class='row'>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="tinymce-single responsive-mg-b-30">
                            <label>Dean Message<span class="text-danger">*</span></label>
                            <div id="summernote1">
                                <?=urldecode($dean_message)?>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-4' style="display: none">
                        <div class='form-group'>
                            <label>Dean Message<span class="text-danger">*</span></label>
                            <textarea name="dean_massage" class="form-control" id="dean_massage" cols="30" rows="10"><?=$dean_message?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="display: none">
                        <div class="tinymce-single responsive-mg-b-30">
                            <label>Faculty About<span class="text-danger">*</span></label>
                            <div id="summernote2">
                                <?=urldecode($about)?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class='form-group'>
                            <br>

                            <label>Faculty About<span class="text-danger">*</span></label>
                            <textarea name="about" class="form-control" id="about" cols="30" rows="30"><?=$about?></textarea>
                        </div>
                    </div>


                </div>
                <div class="row">

                    <div class="col-md-4" id="dean_image">
                        <div class="form-group res-mg-t-15">
                            <label for="exampleInput1" class="bmd-label-floating">Dean Image
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
                            <img src="<?php echo $image_path_default; ?>" alt="Post Image" class="" id="post-image-view"  width="150px" height="150px" name="post-image-view" >

                            <input  type="file" name="post_image" id="post_image"
                                    onchange="changeImage(this,'post_image','post-image-view',2000)"
                                    accept=".jpg,.png,.jpeg" value="<?php echo $image_path; ?>">
                            <input type="text" name="post_image1" id="post_image1"
                                   value="<?php echo $image_path; ?>" hidden>
                            <span class="text-danger">Image size should be less than 2mb</span>

                        </div>
                    </div>
                         <div class="col-md-4" id="logo_image">
                        <div class="form-group ">
                         
                            <br>
                            <label for="exampleInput1" class="bmd-label-floating">Faculty Logo
                                <span class="text-danger">*</span>
                            </label><br>
                            <?php

                            $image_path_default =base_url()."dash_assets/img/avatar/docavtar.png";
                            $image_path = "";
                            if($LOGO != ""){
                                $image_path_default = base_url().EXTRA_IMAGE_PATH.$LOGO;
                                $image_path = base_url().EXTRA_IMAGE_PATH.$LOGO;

                            }
                            ?>
                            <img src="<?php echo $image_path_default; ?>" alt="Department Image" class="" id="dept-image-view"  width="150px" height="150px" name="dept-image-view" >

                            <input  type="file" name="dept_image" id="dept_image"
                                    onchange="changeImage(this,'dept_image','dept-image-view',1000)"
                                    accept=".jpg,.png,.jpeg" value="<?php echo $image_path; ?>">
                            <input type="text" name="dept_image1" id="dept_image1"
                                   value="<?php echo $image_path; ?>" hidden>
                            <span class="text-danger">Image size should be less than 1mb </span>

                        </div>
                    </div>
                     <div class="col-md-4" id="about_image">
                        <div class="form-group ">
                            <br>
                            
                            <label for="exampleInput1" class="bmd-label-floating">Faculty About Image
                                <span class="text-danger">*</span>
                            </label><br>
                            <?php

                            $image_path_default =base_url()."dash_assets/img/avatar/docavtar.png";
                            $image_path = "";
                            if($about_image != ""){
                                $image_path_default = base_url().EXTRA_IMAGE_PATH.$about_image;
                                $image_path = base_url().EXTRA_IMAGE_PATH.$about_image;

                            }
                            ?>
                            <img src="<?php echo $image_path_default; ?>" alt="Department About Image" class="" id="dept-about-image-view"  width="150px" height="150px" name="dept-about-image-view" >

                            <input  type="file" name="dept_about_image" id="dept_about_image"
                                    onchange="changeImage(this,'dept_about_image','dept-about-image-view',1000)"
                                    accept=".jpg,.png,.jpeg" value="<?php echo $image_path; ?>">
                            <input type="text" name="dept_about_image1" id="dept_about_image1"
                                   value="<?php echo $image_path; ?>" hidden>
                            <span class="text-danger">Image size should be less than 1mb <br>600px X 350px</span>

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

    <div class='card' style="    width: fit-content;">
        <div class='card-body'  style="    width: fit-content;" >
            <table class='table table-borderd'>
                <?php
                echo "<tr>
                            <th> ID</th>
                            <th>FACULTY NAME</th>
                            <th>FACULTY TITLE</th>
                            <th>FACULTY ABOUT</th>
                            <th>DEAN NAME</th>
                             <th>DEAN DESIGNATION</th>
                            <th>DEAN MESSAGE</th>
                           
                            <th>IMAGE</th>
                           
                            
                            <th colspan='2'>ACTION</th>
                             
                        </tr>";
                foreach($faculty as $faculty_object){

                    if($faculty_object['ACTIVE']==1){
                        $btn = "<a onclick='return confirm(\"Are You sure? Do you want to Deactive Faculty \")' class='btn btn-danger' href='".base_url()."AdminPanel/faculty_handler?id={$faculty_object['FAC_ID']}&action=delete' >Click For Deactive</a>";
                    }else{
                        $btn = "<a onclick='return confirm(\"Are You sure? Do you want to Active Faculty\")' class='btn btn-success' href='".base_url()."AdminPanel/faculty_handler?id={$faculty_object['FAC_ID']}&action=revoke' >Click For Active</a>";
                    }
                    echo "<tr>
                            <td>{$faculty_object['FAC_ID']}</td>
                             <td>{$faculty_object['FAC_NAME']}</td>
                             <td>{$faculty_object['FAC_TITLE']}</td>
                             <td><textarea cols='30' rows='7'>".urldecode($faculty_object['ABOUT'])."</textarea></td>
                            <td>{$faculty_object['DEAN_NAME']}</td>
                            <td>{$faculty_object['DEAN_DESIGNATION']}</td>
                            <td><textarea cols='30' rows='7'>".urldecode($faculty_object['DEAN_MESSAGE'])."</textarea></td>
                              
                            <td>{$faculty_object['DEAN_IMAGE']}</td>
                            
                        
                            <td><a href='".base_url()."AdminPanel/view_all_faculty?id={$faculty_object['FAC_ID']}'>Edit</a></td>
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
        let dean_message = encodeURI($('#summernote1').summernote('code'));
       // let about  = encodeURI($('#summernote2').summernote('code'));
        $('#dean_massage').html(dean_message);
       // $('#about').html(about);
        return confirm("Are You Sure?")
    }
</script>