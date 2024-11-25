<?php
/**
 * Created by PhpStorm.
 * User: Kashif Shaikh
 * Date: 03/10/2022
 * Time: 12:45 PM
 */
$CONTACT = $about_image = $LOGO=$image=$ABOUT=$MISSION=$DIRECTOR_MESSAGE=$FAC_ID =$INST_ID= $IS_INST=$CODE=$DEPT_NAME=$DIRECTOR_NAME=$DIRECTOR_DESIGNATION=$id=$read_only='';
if($department_obj){


    $FAC_ID = $department_obj['FAC_ID'];
    $INST_ID = $department_obj['INST_ID'];
    $IS_INST = $department_obj['IS_INST'];
    $CODE = $department_obj['CODE'];
    $DEPT_NAME = $department_obj['DEPT_NAME'];
    $DIRECTOR_NAME = $department_obj['DIRECTOR_NAME'];
    $DIRECTOR_DESIGNATION = $department_obj['DIRECTOR_DESIGNATION'];
    $DIRECTOR_MESSAGE = $department_obj['DIRECTOR_MESSAGE'];
    $MISSION = $department_obj['MISSION'];
    $ABOUT = $department_obj['ABOUT'];
    $image = $department_obj['DIRECTOR_IMAGE'];
    $id = $department_obj['DEPT_ID'];
    $LOGO = $department_obj['LOGO'];
    $about_image = $department_obj['ABOUT_IMAGE'];
    $CONTACT = $department_obj['CONTACT'];
    $read_only="readonly";
    
}
?>
<div id = "min-height" class="container-fluid" style="padding:30px">
    <div class='card'>
        <div class='card-body'>
            <form action='<?=base_url()."AdminPanel/department_handler"?>' enctype="multipart/form-data" onsubmit='return confirmForm()'  method='post'>

                <div class='row'>
                    <div class='col-md-3'>
                        <div class='form-group'>
                            <label>Faculty<span class="text-danger">*</span></label>
                            <select <?=$read_only?> name="FAC_ID" id="FAC_ID" class="form-control">
                                <option value="0">Choose</option>
                                <?php
                                foreach($faculty as $fac){
                                    $selected ="";
                                    if($fac['FAC_ID'] == $FAC_ID){
                                        $selected = "selected";
                                    }
                                    echo "<option value=\"{$fac['FAC_ID']}\" $selected>{$fac['FAC_NAME']}</option>";


                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class='col-md-3'>
                        <div class='form-group'>
                            <label>Institute Name<span class="text-danger"></span></label>
                            <select <?=$read_only?> name="INST_ID" id="" class="form-control">
                                <option value="0">Choose</option>
                                <?php
                                foreach($institutes as $institute){
                                    $selected ="";
                                    if($institute['DEPT_ID'] == $INST_ID){
                                        $selected = "selected";
                                    }
                                    echo "<option value=\"{$institute['DEPT_ID']}\" $selected>{$institute['DEPT_NAME']}</option>";


                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class='col-md-3'>
                        <div class='form-group'>

                            <label> Department Contact<span class="text-danger"></span></label>
                            <input  value='<?=$CONTACT?>' type='number' name='CONTACT' class='form-control'/>
                        </div>
                    </div>
                    <div class='col-md-3'>
                        <div class='form-group'>
                            <label>Is Institute?<span class="text-danger">*</span></label>
                            <select   <?=$read_only?> class="form-control" name="IS_INST" id="IS_INST">
                                <option value="N" <?=$IS_INST!='Y'?'SELECTED':''?> >NO</option>
                                <option value="Y" <?=$IS_INST=='Y'?'SELECTED':''?> >YES</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-3'>
                        <div class='form-group'>

                            <label> Department Code<span class="text-danger"></span></label>
                            <input required value='<?=$CODE?>' type='text' name='CODE' class='form-control'/>
                        </div>
                    </div>
                    <div class='col-md-3'>
                        <div class='form-group'>

                            <label>Department Name<span class="text-danger">*</span></label>
                            <input required value='<?=$DEPT_NAME?>' type='text' name='DEPT_NAME' class='form-control'/>
                        </div>
                    </div>
                    <div class='col-md-3'>
                        <div class='form-group'>

                            <label> Director Name<span class="text-danger">*</span></label>
                            <input required value='<?=$DIRECTOR_NAME?>' type='text' name='DIRECTOR_NAME' class='form-control'/>
                        </div>
                    </div>
                    <div class='col-md-3'>
                        <div class='form-group'>
                            <label>Director Designation<span class="text-danger">*</span></label>
                            <input required value='<?=$DIRECTOR_DESIGNATION?>' type='text' name='DIRECTOR_DESIGNATION' class='form-control'/>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="tinymce-single responsive-mg-b-30">
                            <label>Director Message<span class="text-danger">*</span></label>
                            <div id="summernote1">
                                <?=urldecode($DIRECTOR_MESSAGE)?>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-4' style="display: none">
                        <div class='form-group'>
                            <label>Director Message<span class="text-danger">*</span></label>
                            <textarea name="DIRECTOR_MESSAGE" class="form-control" id="DIRECTOR_MESSAGE" cols="30" rows="10"><?=$DIRECTOR_MESSAGE?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="tinymce-single responsive-mg-b-30">
                            <label> Department Mission<span class="text-danger">*</span></label>
                            <div id="summernote3">
                                <?=urldecode($MISSION)?>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-4' style="display: none">

                        <div class='form-group'>
                            <label>Department Mission<span class="text-danger">*</span></label>
                            <textarea name="MISSION" class="form-control" id="MISSION" cols="30" rows="10"><?=$MISSION?></textarea>
                        </div>
                    </div>

                </div>
                <div class='row'>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                        <div class="tinymce-single responsive-mg-b-30">
                            <label>Department About<span class="text-danger">*</span></label>
                            <div id="summernote2">
                                <?=urldecode($ABOUT)?>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-4" style="display: none">
                        <div class='form-group'>
                            <br>
                            <br>

                            <label>Department About<span class="text-danger">*</span></label>
                            <textarea name="ABOUT" class="form-control" id="ABOUT" cols="30" rows="10"><?=$ABOUT?></textarea>
                        </div>
                    </div>
                    
                     </div>
                <div class="row">
                   
                    <div class="col-md-4" id="about_image">
                        <div class="form-group ">
                            <br>
                            <br>
                            <label for="exampleInput1" class="bmd-label-floating">Department About Image
                                <span class="text-danger"></span>
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


                    <div class="col-md-4" id="logo_image">
                        <div class="form-group ">
                            <br>
                            <br>
                            <label for="exampleInput1" class="bmd-label-floating">Department Logo
                                <span class="text-danger"></span>
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
                            <span class="text-danger">Image size should be less than 1mb <br>130px X 550px</span>

                        </div>
                    </div>

            
                    <div class="col-md-4" id="dean_image">
                        <div class="form-group ">
                            <br>
                            <br>
                            <label for="exampleInput1" class="bmd-label-floating">Director Profile Image
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
                                    onchange="changeImage(this,'post_image','post-image-view',1000)"
                                    accept=".jpg,.png,.jpeg" value="<?php echo $image_path; ?>">
                            <input type="text" name="post_image1" id="post_image1"
                                   value="<?php echo $image_path; ?>" hidden>
                            <span class="text-danger">Image size should be less than 1mb</span>

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
                            <th>DEPARTMENT NAME</th>
                            <th>DEPARTMENT LOGO</th>
                            <th>DEPARTMENT CODE</th>
                            <th>IS INST</th>
                            <th>INSTITUTE NAME</th>
                            <th>DEPARTMENT ABOUT</th>
                            <th>DEPARTMENT MISSION</th>
                            <th>DIRECTOR NAME</th>
                             <th>DIRECTOR DESIGNATION</th>
                            <th>DIRECTOR MESSAGE</th>
                           
                            <th>DIRECTOR IMAGE</th>
                           
                            
                            <th colspan='2'>ACTION</th>
                             
                        </tr>";
                foreach($departments as $department){
                    if($dept_id>0&&$dept_id!=$department['DEPT_ID']){
                        continue;
                    }
                    if($department['ACTIVE']==1){
                        $btn = "<a onclick='return confirm(\"Are You sure? Do you want to Deactive Department \")' class='btn btn-danger' href='".base_url()."AdminPanel/department_handler?id={$department['DEPT_ID']}&action=delete' >Click For Deactive</a>";
                    }else{
                        $btn = "<a onclick='return confirm(\"Are You sure? Do you want to Active Department\")' class='btn btn-success' href='".base_url()."AdminPanel/department_handler?id={$department['DEPT_ID']}&action=revoke' >Click For Active</a>";
                    }

                    echo "<tr>
                            <td>{$department['DEPT_ID']}</td>
                             <td>{$department['FAC_NAME']}</td>
                             <td>{$department['DEPT_NAME']}</td>
                             <td>{$department['LOGO']}</td>
                             <td>{$department['CODE']}</td>
                             <td>{$department['IS_INST']}</td>
                             <td>{$department['INSTITUTE_NAME']}</td>
                             <td><textarea cols='30' rows='7'>".urldecode($department['ABOUT'])."</textarea></td>
                             <td><textarea cols='30' rows='7'>".urldecode($department['MISSION'])."</textarea></td>
                            <td>{$department['DIRECTOR_NAME']}</td>
                            <td>{$department['DIRECTOR_DESIGNATION']}</td>
                            <td><textarea cols='30' rows='7'>".urldecode($department['DIRECTOR_MESSAGE'])."</textarea></td>
                              
                            <td>{$department['DIRECTOR_IMAGE']}</td>
                            
                        
                            <td><a href='".base_url()."AdminPanel/view_all_department?id={$department['DEPT_ID']}'>Edit</a></td>
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
        let about  = encodeURI($('#summernote2').summernote('code'));
        let mission  = encodeURI($('#summernote3').summernote('code'));
        $('#MISSION').html(mission);
        $('#DIRECTOR_MESSAGE').html(dean_message);
        $('#ABOUT').html(about);
        return confirm("Are You Sure?")
    }
</script>