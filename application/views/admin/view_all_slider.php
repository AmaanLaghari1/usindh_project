<?php
/**
 * Created by PhpStorm.
 * User: Kashif Shaikh
 * Date: 03/10/2022
 * Time: 12:45 PM
 */
$is_video = $desctiption = $title=$image=$dept_id=$id='';

if($slider_obj){
    $title = $slider_obj['TITLE'];
    $desctiption = $slider_obj['DESCRIPTION'];
    $image = $slider_obj['IMAGE'];
    $id = $slider_obj['ID'];
    $is_video = $slider_obj['IS_VIDEO'];
    $dept_id = $slider_obj['DEPT_ID'];
}
?>
<div id = "min-height" class="container-fluid" style="padding:30px">
    <div class='card'>
        <div class='card-body'>
            <form action='<?=base_url()."AdminPanel/slider_handler"?>' enctype="multipart/form-data" onsubmit='return confirm("Are You Sure?")' method='post'>

                <div class='row'>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Departments <span class="text-danger"></span></label>
                            <select  name="DEPT_ID" id="DEPT_ID" class="form-control">
                                <option value="-1">Choose</option>

                                <?php
                                if($DEPT_ID==0){

                                    $selected = "";
                                    if($dept_id==0){
                                        $selected = "selected";
                                    }
                                    echo "<option value='0' $selected>Main Website</option>";
                                }
                                foreach($departments as $department){
                                    $selected ="";
                                    if($department['DEPT_ID'] == $dept_id){
                                        $selected = "selected";
                                    }
                                    echo "<option value=\"{$department['DEPT_ID']}\" $selected>{$department['DEPT_NAME']}</option>";


                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Title<span class="text-danger">*</span></label>
                            <input required value='<?=$title?>' type='text' name='title' class='form-control'/>
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Description<span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" id="" cols="30" rows="10"><?=$desctiption?></textarea>
                        </div>
                    </div>
                     <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Choose Slider Type<span class="text-danger">*</span></label>
                            <select onchange='show_input()' class='form-control'name='slider_type' id='slider_type'>
                                <option value="0">Image</option>
                                <option <?=($is_video==1)?'selected':''?> value="1">Video</option>
                            </select>
                        </div>
                    </div>
                    <div id='url_div' class='col-md-4'>
                        <div class='form-group'>
                            <label>Enter Video Url<span class="text-danger">*</span></label>
                              <input  class='form-control' type="text" name="slider_video" id="slider_video"  value="<?=$image?>">
                        </div>
                    </div>

                    <div id='img_div' class="col-md-4">
                        <div class="form-group res-mg-t-15">
                            <label for="exampleInput1" class="bmd-label-floating">Slider Image
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
                            <img src="<?php echo $image_path_default; ?>" alt="Slider Image" class="" id="slider-image-view"  width="150px" height="150px" name="slider-image-view" >

                            <input  type="file" name="slider_image" id="slider_image"
                                   onchange="changeImage(this,'slider_image','slider-image-view',2000)"
                                   accept=".jpg,.png,.jpeg" value="<?php echo $image_path; ?>">
                            <input type="text" name="slider_image1" id="slider_image1"
                                   value="<?php echo $image_path; ?>" hidden>
                            <span class="text-danger">Image size should be less than 2mb 250px X 1400px</span>

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
                            <th>TITLE</th>
                            <th>DESCRIPTION</th>
                            <th>IMAGE</th>
                           
                            
                            <th colspan='2'>ACTION</th>
                             
                        </tr>";
                foreach($sliders as $slider){
                    if($slider['ACTIVE']==1){
                        $btn = "<a onclick='return confirm(\"Are You sure? Do you want to Deactive Slider\")' class='btn btn-danger' href='".base_url()."AdminPanel/slider_handler?id={$slider['ID']}&action=delete' >Click For Deactive</a>";
                    }else{
                        $btn = "<a onclick='return confirm(\"Are You sure? Do you want to Active Slider\")' class='btn btn-success' href='".base_url()."AdminPanel/slider_handler?id={$slider['ID']}&action=revoke' >Click For Active</a>";
                    }
                    echo "<tr>
                            <td>{$slider['ID']}</td>
                            <td>{$slider['TITLE']}</td>
                            <td>{$slider['DESCRIPTION']}</td>
                            <td>{$slider['IMAGE']}</td>
                            
                        
                            <td><a href='".base_url()."AdminPanel/view_all_slider?id={$slider['ID']}'>Edit</a></td>
                            <td>{$btn}</td>
                        </tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>
<script>
     
function show_input(){
   let type =  $('#slider_type').val();
   if(type==1){
       $('#img_div').hide();
       $('#url_div').show();
   }else{
       $('#img_div').show();
       $('#url_div').hide(); 
   }
}

show_input();
</script>