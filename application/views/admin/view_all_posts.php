<?php
/**
 * Created by PhpStorm.
 * User: Kashif Shaikh
 * Date: 03/10/2022
 * Time: 12:45 PM
 */
$desctiption = $title=$image=$id='';
if($post_obj){
    $title = $post_obj['TITLE'];
    $desctiption = $post_obj['DESCRIPTION'];
    $image = $post_obj['IMAGE_PATH'];
    $type_id = $post_obj['TYPE_ID'];
    $id = $post_obj['POST_ID'];
}
?>
<div id = "min-height" class="container-fluid" style="padding:30px">
    <div class='card'>
        <div class='card-body'>
            <form action='<?=base_url()."AdminPanel/post_handler"?>' enctype="multipart/form-data" onsubmit='return confirmForm()'  method='post'>

                <div class='row'>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Category<span class="text-danger">*</span></label>
                            <select name="category_id" id="" class="form-control">
                                <?php
                                foreach($categories as $category){

                                    echo "<option value=\"{$category['CATEGORY_ID']}\">{$category['NAME']}</option>";


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
                            <label>File Type<span class="text-danger">*</span></label>
                            <select name="type_id" onchange="file_type()" id="type_id" class="form-control">
                                <?php
                                $types = array(
                                    array('TYPE_ID'=>1,"NAME"=>"IMAGE"),
                                    array('TYPE_ID'=>2,"NAME"=>"YOUTUBE LINK"),
                                    array('TYPE_ID'=>3,"NAME"=>"VIDEO"),
                                );
                                foreach($types as $type){

                                    echo "<option value=\"{$type['TYPE_ID']}\">{$type['NAME']}</option>";


                                }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>
                <div class='row'>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="tinymce-single responsive-mg-b-30">
                            <label>Description<span class="text-danger">*</span></label>
                            <div id="summernote1">
                                <?=urldecode($desctiption)?>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-4' style="display: none">
                        <div class='form-group'>
                            <label>Description<span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="10"><?=$desctiption?></textarea>
                        </div>
                    </div>
                    <div class="col-md-4" id="news_image">
                        <div class="form-group res-mg-t-15">
                            <label for="exampleInput1" class="bmd-label-floating">News Image
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
                    <div class="col-md-4" id="youtube_clip">
                        <div class="form-group res-mg-t-15">
                            <label for="exampleInput1" class="bmd-label-floating">Youtube Link
                                <span class="text-danger">*</span>
                            </label><br>
                            <input type="text" name="youtube_link" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4" id="video_clip">
                        <div class="form-group res-mg-t-15">
                            <label for="exampleInput1" class="bmd-label-floating">News Clip
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

                            <input  type="file" name="post_clip" id="post_clip"
                                 accept=".mp4,.3gp,.mkv,.flv" value="<?php echo $image_path; ?>">

                            <span class="text-danger">clip size should be less than 20mb</span>

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
                            <th>CATEGORY</th>
                            <th>TITLE</th>
                            <th>DESCRIPTION</th>
                            <th>IMAGE</th>
                           
                            
                            <th colspan='2'>ACTION</th>
                             
                        </tr>";
                foreach($posts as $post){
                    if($post['ACTIVE']==1){
                        $btn = "<a onclick='return confirm(\"Are You sure? Do you want to Deactive Slider\")' class='btn btn-danger' href='".base_url()."AdminPanel/post_handler?id={$post['POST_ID']}&action=delete' >Click For Deactive</a>";
                    }else{
                        $btn = "<a onclick='return confirm(\"Are You sure? Do you want to Active Slider\")' class='btn btn-success' href='".base_url()."AdminPanel/post_handler?id={$post['POST_ID']}&action=revoke' >Click For Active</a>";
                    }
                    echo "<tr>
                            <td>{$post['POST_ID']}</td>
                             <td>{$post['NAME']}</td>
                            <td>{$post['TITLE']}</td>
                            <td><textarea cols='30' rows='7'>".urldecode($post['DESCRIPTION'])."</textarea></td>
                            <td>{$post['IMAGE_PATH']}</td>
                            
                        
                            <td><a href='".base_url()."AdminPanel/view_all_post?id={$post['POST_ID']}'>Edit</a></td>
                            <td>{$btn}</td>
                        </tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>
<script>
    function file_type(){
        let type_id = $('#type_id').val();
        if(type_id == 1){
            $('#news_image').show();
            $('#youtube_clip').hide();
            $('#video_clip').hide();
        }else if(type_id == 2){
            $('#news_image').hide();
            $('#youtube_clip').show();
            $('#video_clip').hide();
        }else if(type_id == 3){
            $('#news_image').hide();
            $('#youtube_clip').hide();
            $('#video_clip').show();
        }

    }
    function confirmForm(){
        let description = encodeURI($('#summernote1').summernote('code'));
        $('#description').html(description);
        return confirm("Are You Sure?")
    }
    $(document).ready(function(){
        $('#youtube_clip').hide();
        $('#video_clip').hide();
    });
</script>