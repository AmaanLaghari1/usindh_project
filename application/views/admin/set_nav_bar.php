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
                        <h1>Map Navbar Link </h1>

                        <hr>
                        <div class="row">
                            <div class="col-md-4 ">
                                <div class="form-group-inner">
                                    <label>Select Department<span class="text-danger">*</span></label>
                                    <select class="js-example-basic-single form-control" onchange="loadNavbar()" name="dept_id" id="dept_id">
                                        <option value='-1'>--Choose--</option>
                                        <?php
                                        if($dept_id==0){
                                            echo "<option value='0'>** University of Sindh **</option>";
                                        }
                                        ?>
                                        
                                        <?php
                                        foreach ($departments as $department){
                                            echo  "<option value='{$department['DEPT_ID']}'>{$department['DEPT_NAME']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group-inner">
                                    <label>Navbar Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group-inner">
                                    <label>Navbar Url <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="url" id="url">
                                </div>
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group-inner">
                                    <label>Navbar Link Id <span class="text-danger"><br>(if you want to add new link leave it blank)</span></label>
                                    <input type="text" class="form-control" name="navbar_link_id_txt" id="link_id">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group-inner">
                                    <label>Navbar Link Parent Id <span class="text-danger">*</span><br><br></label>
                                    <input type="text"  class="form-control" name="parent_id" id="parent_id">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group-inner">
                                    <label>Level No <span class="text-danger">*</span><br><br></label>
                                    <input type="text"  class="form-control" name="level_no" id="level_no">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group-inner">
                                    <label>Order No <span class="text-danger">*</span><br><br></label>
                                    <input type="text"  class="form-control" name="order_no" id="order_no">
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group-inner">
                                    <button class="btn  btn-success" onclick="save_data('add')" id="map_nav_bar_link_btn">Add</button>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group-inner">
                                    <button class="btn  btn-warning" onclick="save_data('update')" id="map_nav_bar_link_btn">Update</button>
                                    
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group-inner">
                                    <button class="btn  btn-danger" onclick="save_data('delete')" id="map_nav_bar_link_btn">Delete</button>
                                   <span id="webpage_loading1"><img src="<?=base_url()?>dash_assets/img/loading.gif" alt="preloader">
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="tree-viewer-area mg-b-15">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="sparkline10-list sparkel-pro-mg-t-30 shadow-reset">
                        <div class="sparkline10-hd">
                            <div class="main-sparkline10-hd">
                                <h1>Navbar Link</h1>
                            </div>
                        </div>
                        <div class="sparkline10-graph">
                            <div class="edu-content">
                                <div id="tree"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
<script type="text/javascript">

    var result_tree = [];


    function loadNavbar(){
        $('#title').val("");
        $('#url').val("");
        $('#link_id').val("");
        $('#parent_id').val("");
        $('#level_no').val("");
        $('#order_no').val("");

        $('#using_json_navbar').html("");

        let dept_id = $('#dept_id').val();
        if(dept_id>=0){
            $('#mapped_webpage_loading').show();
            $("#table_body").html("");
            jQuery.ajax({
                url: "<?=base_url()?>AdminPanel/getNavbarByDeptId?DEPT_ID="+dept_id,
                async:true,
                success: function (data, status) {

                    $('#mapped_webpage_loading').hide();
                    //console.log(data);
                    let new_array = [];
                    for (const key in data) {
                        new_array.push(data[key]);
                    }
                   // console.log();
                     result_tree = makeTree(new_array);
                    console.log(result_tree);
                    $("#tree").jstree().settings.core.data = result_tree;
                   // console.log(result_tree);
                    $("#tree").jstree().refresh(true);
                   // console.log(result_tree);
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
            $("#table_body").html("");
            console.log("error");
        }
    }

    function showNavData(){
        $('#nav_data').hide();
        let NAVBAR_LINK_ID = $('#NAVBAR_LINK_ID').val();
        nav_bar_links.forEach(function (item,index) {
            if(item['NAVBAR_LINK_ID'] == NAVBAR_LINK_ID){
               // console.log(item);
                $('#nav_data').show();
                $('#view_navbar_link_id').html(item['NAVBAR_LINK_ID']);
                $('#view_navbar_title').html(item['NAVBAR_TITLE']);
                $('#view_navbar_link').html(item['URL']);
                $('#navbar_link_id_txt').val(item['NAVBAR_LINK_ID']);
            }
        });

    }




    $('#add_nav_bar_link_btn').click(function (event) {
        event.preventDefault();
        var form = $('#add_nav_bar_link_from')[0];

        // Create an FormData object
        var data = new FormData(form);



        $('#webpage_loading').show();
        // disabled the submit button
        $("#add_nav_bar_link_btn").prop("disabled", true);

        jQuery.ajax({
            url: "<?=base_url();?>admin/add_navbar_link_handler",
            type: "POST",
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            data: data,
            success: function (data, status) {

                //console.log(data);
                $('#webpage_loading').hide();
                $("#add_nav_bar_link_btn").prop("disabled", false);


                var value = data;
                alertMsg(value.RESPONSE,value.MESSAGE);
                nav_bar_links = value.NAVBAR;

                console.log(nav_bar_links);
            },
            beforeSend:function (data, status) {


            },
            error:function (data, status) {

                //console.log(data.responseJSON);
                $("#add_nav_bar_link_btn").prop("disabled", false);
                $('#webpage_loading').hide();
                var value = data.responseJSON;
                alertMsg(value.RESPONSE,value.MESSAGE);
                nav_bar_links =value.NAVBAR;
                console.log(nav_bar_links);



            },
        })

    });

    function makeTree(data){
        //console.log(data);
       let  new_array = [];
        data.forEach(function(item, index){
            //   console.log(item);
            if("CHILDREN" in item){
                new_array.push({
                    'text':  item['NAVBAR_TITLE'],
                    'url':  item['URL'],
                    'id':  item['LINK_ID'],
                    'parent_id':  item['PARENT_ID'],
                    'level_no':  item['LEVEL_NO'],
                    'order_no':  item['ORDER_NO'],
                    'children':  makeTree(item['CHILDREN']),
                    'state': {
                    'opened': true
                    }
                });
            }else{
                new_array.push({
                    'id':  item['LINK_ID'],
                    'parent_id':  item['PARENT_ID'],
                    'level_no':  item['LEVEL_NO'],
                    'order_no':  item['ORDER_NO'],
                    'text': item['NAVBAR_TITLE'],
                    'url': item['URL']
                });

            }
        });
        return new_array;
    }

    $('#tree').on("select_node.jstree", function (e, data) {

            $('#link_id').val(data.node.original.id);
            $('#parent_id').val(data.node.original.parent_id);
            $('#level_no').val(Number(data.node.original.level_no));
            $('#order_no').val(data.node.original.order_no);
             $('#title').val(data.node.original.text);
            $('#url').val(data.node.original.url);

        });

    $(document).ready(function () {
          $('#nav_data').hide();
          $('#webpage_loading').hide();
          $('#webpage_loading1').hide();

          $("#tree")
              .jstree({
                  "core" : {
                      "data" : result_tree
                  }
              });
      });

    $("#map_nav_bar_link_btn").click(function (event) {


    });

    function save_data(flag){
        //stop submit the form, we will post it manually.
        event.preventDefault();
        if(!confirm('Are you sure do you want to '+flag)){
            return;
        }
        let dept_id = $("#dept_id").val();
        if(!(dept_id>=0)){
            alertMsg("Warning","Department must be select.");
            return;
        }

        var form = $('#nav_bar_mapping_form')[0];

        // Create an FormData object
        var data = new FormData(form);




        $('#webpage_loading1').show();
        //disabled the submit button
        $("#map_nav_bar_link_btn").prop("disabled", true);

        data.append("dept_id",dept_id);

        data.append("flag",flag);

        jQuery.ajax({
            url: "<?=base_url();?>AdminPanel/navbar_link_handler",
            type: "POST",
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            data: data,
            success: function (data, status) {

                //console.log(data);
                $("#map_nav_bar_link_btn").prop("disabled", false);
                $('#webpage_loading1').hide();
                var value = data;
                alertMsg(value.TYPE,value.MSG);
                loadNavbar();
            },
            beforeSend:function (data, status) {


            },
            error:function (data, status) {

                //console.log(data.responseJSON);
                $("#map_nav_bar_link_btn").prop("disabled", false);

                $('#webpage_loading1').hide();
                var value = data.responseJSON;
                alertMsg(value.TYPE,value.MSG);
                loadNavbar();



            },
        })

    }

</script>
