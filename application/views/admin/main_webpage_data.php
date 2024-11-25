<?php
?>
<div id = "min-height" class="container-fluid" style="padding:30px">
    <div class='card'>
        <div class='card-body'>
            <form action='<?=base_url()."AdminPanel/main_webpage_data"?>' enctype="multipart/form-data" onsubmit='return confirmForm()'  method='post'>


                <div class='row'>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <div class="tinymce-single responsive-mg-b-30">
                            <label>Description<span class="text-danger">*</span></label>
                            <div id="summernote1">
                                <?=urldecode($description)?>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-10'  style="display: none" >
                        <div class='form-group'>
                            <label>Description<span class="text-danger" >*</span></label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="10"><?=$description?></textarea>
                        </div>
                    </div>
                    <?php
                    if($id==="") {
                        ?>
                        <div class='col-md-2'>
                            <br>
                            <div class='form-group '>
                                <label>Index<span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="order" min="1"
                                       max="<?= count($list_of_section) + 1 ?>">
                            </div>
                        </div>
                        <?php
                    }
                    ?>


                </div>
                <div class='row'>

                    <div class='col-md-4'>
                        <br><br>

                            <?php
                            if($id===""){
                                echo "<button  class='btn btn-warning' name='add' type='submit'>Add</button>";
                            }else{
                                echo "<input value='$id' name='index' hidden>";
                                echo "<button  class='btn btn-warning' name='update' type='submit'>Update</button>";
                            }


                        ?>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class='card'>
        <div class='card-body'>
            <table class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Content</th>
                    <th colspan="2">Action</th>
                </tr>
                <?php
                foreach($list_of_section as $k=>$section){
                    $k++;
                    echo "<tr>
                            <td>$k</td>
                            <td><textarea>{$section}</textarea></td>
                            <td><a href='".base_url()."AdminPanel/main_webpage_data?index=$k&action=edit' class='btn btn-warning'>Edit</a></td>  
                            <td><a href='".base_url()."AdminPanel/main_webpage_data?index=$k&action=delete'  onclick='return confirm(\"Are you sure? Do you want to delete?\")'class='btn btn-danger'>Delete</a></td>    
                          </tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmForm(){
        let desctiption = $('#summernote1').summernote('code');

        $('#description').html(desctiption);

        return confirm("Are You Sure?")
    }
    $(document).ready(()=>{
        $('.note-insert').hide();
    });
</script>