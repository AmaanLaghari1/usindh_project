<?php
/**
 * Created by PhpStorm.
 * User: Kashif Shaikh
 * Date: 03/10/2022
 * Time: 12:45 PM
 */
$DEPT_ID  = 0;
?>
<div id = "min-height" class="container-fluid" style="padding:30px">
    <div class='card'>
        <div class='card-body'>
            <form action='<?=base_url()."AdminPanel/department_handler"?>' enctype="multipart/form-data" onsubmit='return confirmForm()'  method='post'>

                <div class='row'>
                    <div class='col-md-3'>
                        <div class='form-group'>
                            <label>Departments<span class="text-danger"></span></label>
                            <select onchange="getRandD()" name="DEPT_ID" id="DEPT_ID" class="form-control">
                                <option value="0">Choose</option>
                                <?php
                                foreach($departments as $department){
                                    $selected ="";
                                    if($department['DEPT_ID'] == $DEPT_ID){
                                        $selected = "selected";
                                    }
                                    echo "<option value=\"{$department['DEPT_ID']}\" $selected>{$department['DEPT_NAME']}</option>";


                                }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>

    <div class='card' style="    width: fit-content;">
        <div class='card-body'  style="    width: fit-content;" >
            <table class='table table-borderd'>

            </table>
        </div>
    </div>

</div>
<script>

    function getRandD(){
        let dept_id = $('#DEPT_ID').val();
         if(dept_id>0){
             jQuery.ajax({
                 url: "<?=base_url()?>AdminPanel/apiGetRandD?dept_id="+dept_id,
                 async:true,
                 success: function (data, status) {
                     $('#alert_msg_for_ajax_call').html("");

                     list_of_r_n_d = data['DATA']



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
        let dean_message = encodeURI($('#summernote1').summernote('code'));
        let about  = encodeURI($('#summernote2').summernote('code'));
        let mission  = encodeURI($('#summernote3').summernote('code'));
        $('#MISSION').html(mission);
        $('#DIRECTOR_MESSAGE').html(dean_message);
        $('#ABOUT').html(about);
        return confirm("Are You Sure?")
    }
</script>