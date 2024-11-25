<?php
/**
 * Created by PhpStorm.
 * User: Kashif Shaikh
 * Date: 03/10/2022
 * Time: 12:45 PM
 */

$page_name = "";
$description = "";
$id ="";
$dept_id ="";
$is_rnd ="0";
if($page_obj){

    $description = $page_obj['DESCRIPTION'];
    $page_name = $page_obj['PAGE_NAME'];

    $id = $page_obj['PAGE_ID'];
    $dept_id = $page_obj['DEPT_ID'];
    $is_rnd = $page_obj['IS_RND'];
}

?>
<div id = "min-height" class="container-fluid" style="padding:30px">
    <div class='card'>
        <div class='card-body'>
            <form action='<?=base_url()."AdminPanel/page_handler"?>' enctype="multipart/form-data" onsubmit='return confirmForm()'  method='post'>

                <div class='row'>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Departments<span class="text-danger"></span></label>
                            <select  onchange="apiGetPage()" name="DEPT_ID" id="DEPT_ID" class="form-control">
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
                            <label>Page Name<span class="text-danger">*</span></label>
                            <input required value='<?=$page_name?>' type='text' name='page_name' class='form-control'/>
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Is Research & Development<span class="text-danger">*</span></label>
                            <input  <?=$is_rnd==1?'checked':'';?> type='checkbox' name='is_rnd' class='form-control'/>
                        </div>
                    </div>
                </div>

                <div class='row'>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="tinymce-single responsive-mg-b-30">
                                <label>Description<span class="text-danger">*</span></label>
                                <div id="summernote1">
                                    <?=urldecode($description)?>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-4' style="display: none">
                            <div class='form-group'>
                                <label>Description<span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" id="description" cols="30" rows="10"><?=$description?></textarea>
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
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Page Name</th>
                    <th>Page Description</th>
                    <th>Page Url</th>
                    <th colspan='2'>ACTION</th>
                </tr>
                </thead>
                <tbody id="tbody">

                </tbody>
            </table>
        </div>
    </div>

</div>
<script>

    function apiGetPage(){
        $("#tbody").html("");
        let dept_id = $('#DEPT_ID').val();
        if(dept_id>=0){
            jQuery.ajax({
                url: "<?=base_url()?>AdminPanel/apiGetPages?dept_id="+dept_id,
                async:true,
                success: function (data, status) {
                    $('#alert_msg_for_ajax_call').html("");

                    let list_of_pages = data['DATA']
                    list_of_pages.forEach((page)=>{
                        //console.log(page);
                        let btn="";
                        if(page['ACTIVE']==1){
                            btn = "<a onclick='return confirm(\"Are You sure? Do you want to Deactive Page\")' class='btn btn-danger' href='<?=base_url()?>AdminPanel/page_handler?id="+page['PAGE_ID']+"&action=delete' >Click For Deactive</a>";
                        }else{
                            btn = "<a onclick='return confirm(\"Are You sure? Do you want to Active Page\")' class='btn btn-success' href='<?=base_url()?>AdminPanel/page_handler?id="+page['PAGE_ID']+"&action=revoke' >Click For Active</a>";
                        }
                        let row = "<tr>" +
                            "<td>"+page['PAGE_ID']+"</td>" +
                            "<td>"+page['PAGE_NAME']+"</td>" +
                            "<td><textarea >"+page['DESCRIPTION']+"</textarea ></td>" +
                            "<td>&lt;?=base_url()?&gt;page/"+page['PAGE_ID']+"</td>" +
                            "<td><a href='<?=base_url()?>AdminPanel/view_all_pages?id="+page['PAGE_ID']+"'>Edit</a></td>" +
                            
                            "<td>"+btn+"</td>" +
                            "</tr>";
                        $("#tbody").append(row);
                    })


                },
                beforeSend:function (data, status) {


                    $('#alert_msg_for_ajax_call').html("LOADING...!");
                },
                error:function (data, status) {

                    $('#alert_msg_for_ajax_call').html("Something went worng..!");
                },
            });
        }else{

        }
    }
    function confirmForm(){
        let desctiption = encodeURI($('#summernote1').summernote('code'));

        $('#description').html(desctiption);

        return confirm("Are You Sure?")
    }
    $(document).ready(function(){
        apiGetPage();
    });
</script>