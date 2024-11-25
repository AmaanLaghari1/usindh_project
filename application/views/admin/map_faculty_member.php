<?php
/**
 * Created by PhpStorm.
 * User: Kashif Shaikh
 * Date: 5/19/2021
 * Time: 11:08 AM
 */
?>
<div id = "min-height" class="container-fluid" style="padding:30px">

    <div class="row">


    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="card-body">
                    <form action="" id="nav_bar_mapping_form" >
                        <h1>Map Faculty Member </h1>

                        <hr>
                        <div class="row">
                            <div class="col-md-4 ">
                                <div class="form-group-inner">
                                    <label>Select Department<span class="text-danger">*</span></label>
                                    <select class="js-example-basic-single form-control" onchange="getFacultyMembers()" name="dept_id" id="dept_id">
                                        <option value='0'>--Choose--</option>

                                        <?php
                                        foreach ($departments as $department){
                                            echo  "<option value='{$department['DEPT_ID']}'>{$department['DEPT_NAME']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>



                        </div>
                        </br>


                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="tree-viewer-area mg-b-15">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline10-list sparkel-pro-mg-t-30 shadow-reset">
                        <div class="sparkline10-hd">
                            <div class="main-sparkline10-hd">
                                <h1>Faculty Member </h1>
                            </div>
                        </div>
                        <div class="sparkline10-graph">
                            <div class="edu-content">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Member ID</th>
                                            <th>Designation</th>
                                            <th>Full Name</th>
                                            <th>Surname</th>
                                            <th>Order</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody id="fac_member"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
<script type="text/javascript">
    function update_prefix(id){
            // Create an FormData object
        var fd = new FormData();
        //id = "123123";
        var order = $("#prefix_id_"+id).val();
        fd.append("ORDER",order);
        fd.append("MEMBER_ID",id);


        jQuery.ajax({
            url: "<?=base_url();?>AdminPanel/update_member_order",
            type: "POST",
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            data: fd,
            success: function (data, status) {
              //  getFacultyMembers();

            },
            beforeSend:function (data, status) {


            },
            error:function (data, status) {

                //console.log(data.responseJSON);

                alertMsg(value.RESPONSE,value.MESSAGE);




            },
        })
    }
    var result_tree = [];
    function change_status(status,id){
         // Create an FormData object
        var fd = new FormData();
        //id = "123123";
        fd.append("STATUS",status);
        fd.append("MEMBER_ID",id);


        jQuery.ajax({
            url: "<?=base_url();?>AdminPanel/update_member_status",
            type: "POST",
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            data: fd,
            success: function (data, status) {
                getFacultyMembers();

            },
            beforeSend:function (data, status) {


            },
            error:function (data, status) {

                //console.log(data.responseJSON);

                alertMsg(value.RESPONSE,value.MESSAGE);




            },
        })
    }
    function getFacultyMembers(){
        let dept_id = $('#dept_id').val();
        if(dept_id>=0){
            $("#fac_member").html("");
            $('#mapped_webpage_loading').show();
            $("#table_body").html("");
            jQuery.ajax({
                url: "<?=base_url()?>AdminPanel/getFacultyMemberByDeptId?DEPT_ID="+dept_id,
                async:true,
                success: function (data, status) {

                    $('#mapped_webpage_loading').hide();
                    //console.log(data);
                    let list  =  data.map((d)=>{
                       // console.log(d);TITLE
                        var btn;
                        if(d['FLAG']==1){
                             btn =  "<button  class='btn btn-danger' onclick =\"change_status('"+d['FLAG']+"','"+d['USER_ID']+"')\" >Click For Hide</button>";
                        }else{
                              btn =  "<button class='btn btn-warning' onclick =\"change_status('"+d['FLAG']+"','"+d['USER_ID']+"')\" >Click For Show</button>";
                        }
                        let row = "                             <tr>" +
                            "                                            <td>"+d['USER_ID']+"</td>\n" +
                            "                                            <td>"+(d['TITLE']==null?"N/A":d['TITLE'])+"</td>" +
                            "                                            <td>"+d['FIRST_NAME']+"</td>" +
                            "                                            <td>"+d['LAST_NAME']+"</td>" +
                               "                                         <td><input id='prefix_id_"+d['USER_ID']+"' value='"+d['PREFIX_ID']+"' onkeyup='update_prefix(\""+d['USER_ID']+"\")'></td>" +
                            "                                            <td>"+btn+"</td>" +

                            "                                        </tr>";

                        $("#fac_member").append(row);
                        return row;

                    })
                    //console.log(list);
                    //$("#fac_member").append(row);

                },
                beforeSend:function (data, status) {

                },
                error:function (data, status) {
                    $('#mapped_webpage_loading').hide();
                    alertMsg("Error",data.responseText);

                },
            });
        }else{
            $('#mapped_webpage_loading').hide();

            console.log("error");
        }
    }


</script>
