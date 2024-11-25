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
    $image = $post_obj['PATH'];
    $id = $post_obj['POST_ID'];
}
?>
<div id = "min-height" class="container-fluid" style="padding:30px">
    <div class='card'>
        <div class='card-body'>
            <form action='<?=base_url()."AdminPanel/youtube_post_handler"?>' enctype="multipart/form-data" onsubmit='return confirm("Are You Sure?")' method='post'>

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
                            <label>Description<span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" id="" cols="30" rows="10"><?=$desctiption?></textarea>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class="col-md-4">
                        <div class='form-group'>
                            <label>Youtube Link Path<span class="text-danger">*</span></label>
                            <textarea required name="path" class="form-control" id="" cols="30" rows="10"><?=$image?></textarea>
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
                            <th>PATH</th>
                           
                            
                            <th colspan='2'>ACTION</th>
                             
                        </tr>";
                foreach($posts as $post){
                    if($post['ACTIVE']==1){
                        $btn = "<a onclick='return confirm(\"Are You sure? Do you want to Deactive Slider\")' class='btn btn-danger' href='".base_url()."AdminPanel/youtube_post_handler?id={$post['POST_ID']}&action=delete' >Click For Deactive</a>";
                    }else{
                        $btn = "<a onclick='return confirm(\"Are You sure? Do you want to Active Slider\")' class='btn btn-success' href='".base_url()."AdminPanel/youtube_post_handler?id={$post['POST_ID']}&action=revoke' >Click For Active</a>";
                    }
                    echo "<tr>
                            <td>{$post['POST_ID']}</td>
                             <td>{$post['NAME']}</td>
                            <td>{$post['TITLE']}</td>
                            <td><textarea cols='30' rows='7'>{$post['DESCRIPTION']}</textarea></td>
                            <td>{$post['PATH']}</td>
                            
                        
                            <td><a href='".base_url()."AdminPanel/view_all_youtube_post?id={$post['POST_ID']}'>Edit</a></td>
                            <td>{$btn}</td>
                        </tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>