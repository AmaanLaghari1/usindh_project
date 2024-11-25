<?php
/**
 * Created by PhpStorm.
 * User: Kashif Shaikh
 * Date: 03/10/2022
 * Time: 12:45 PM
 */
$cnic_no = $email = $last_name = $name ='';
$id=0;
if($user_obj){
    $name = $user_obj['FIRST_NAME'];
    $last_name = $user_obj['LAST_NAME'];
    $email = $user_obj['EMAIL'];
     $cnic_no = $user_obj['CNIC_NO'];
    $id = $user_obj['USER_ID'];
}
?>
<div id = "min-height" class="container-fluid" style="padding:30px">
    <div class='card'>
        <div class='card-body'>
            <form action='<?=base_url()."AdminPanel/users_handler"?>' enctype="multipart/form-data" onsubmit='return confirm("Are You Sure?")' method='post'>

                <div class='row'>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>First Name<span class="text-danger">*</span></label>
                            <input required value='<?=$name?>' type='text' name='first_name' class='form-control'/>
                        </div>
                    </div>
                     <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Last Name<span class="text-danger">*</span></label>
                            <input required value='<?=$last_name?>' type='text' name='last_name' class='form-control'/>
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Email<span class="text-danger">*</span></label>
                            <input required value='<?=$email?>' type='text' name='email' class='form-control'/>
                        </div>
                    </div>
                   
                   </div>
                   <div class='col-md-4'>
                        <div class='form-group'>
                            <label>CNIC NO<span class="text-danger">*</span></label>
                            <input required value='<?=$cnic_no?>' type='text' name='cnic_no' class='form-control'/>
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Password<span class="text-danger">*</span></label>
                            <input  value='' type='password' name='password' class='form-control'/>
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
         <div class='card-body' id='role_box'>
          <div class="box box-primary">
                <div class="box-header with-border text-center text-bold">
                    <h3 class="box-title" style="font-family: "Courier New", Courier, monospace"><b>Roles</b></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="chosen-select-single mg-b-20">
                                                <label>Basic Select</label>
                                                <select data-placeholder="Choose a Country..." class="chosen-select" id='role' name='role'tabindex="-1">
                                    <option value="0">--Choose--</option>
                                    <?php
                                    foreach ($roles as $role){
                                        if($role['ACTIVE']==0){
                                            continue;
                                        }
                                        echo "<option value='{$role['ROLE_ID']}'>{$role['ROLE_NAME']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button onclick="add_role()" class="btn btn-primary"> <i class="fa fa-save"></i><br>Add</button>
                        </div>
                        <div  class="col-md-6">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Role ID</th>
                                    <th>Role Name</th>
                                    <th>Role Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="view_role" ></tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            </div>
    </div>
    <div class='card'>
        <div class='card-body'>
             <div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    <h1>Projects <span class="table-project-n">Data</span> Table</h1>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div id="toolbar">
                                        <select class="form-control dt-tb">
											<option value="">Export Basic</option>
											<option value="all">Export All</option>
											<option value="selected">Export Selected</option>
										</select>
                                    </div>
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="id">ID</th>
                                                <th data-field="First Name" >First Name</th>
                                                <th data-field="Last Name" >Last Name</th>
                                                <th data-field="Email" >Email</th>
                                                <th data-field="Cnic No" >CNIC No</th>
                                               
                                                <th data-field="edit" >Edit</th>
                                                 <th data-field="delete" >Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
              
                foreach($users as $user){
                    if($user['ACTIVE']==1){
                        $btn = "<a onclick='return confirm(\"Are You sure? Do you want to Deactive Slider\")' class='btn btn-danger' href='".base_url()."AdminPanel/users_handler?id={$user['USER_ID']}&action=delete' >Click For Deactive</a>";
                    }else{
                        $btn = "<a onclick='return confirm(\"Are You sure? Do you want to Active Slider\")' class='btn btn-success' href='".base_url()."AdminPanel/users_handler?id={$user['USER_ID']}&action=revoke' >Click For Active</a>";
                    }
                    echo "<tr>
                            <td></td>
                            <td>{$user['USER_ID']}</td>
                            <td>{$user['FIRST_NAME']}</td>
                            <td>{$user['LAST_NAME']}</td>
                            <td>{$user['EMAIL']}</td>
                            <td>{$user['CNIC_NO']}</td>
                            <td><a href='".base_url()."AdminPanel/view_all_users?id={$user['USER_ID']}'>Edit</a></td>
                             <td>{$btn}</td>
                        </tr>";
                }
                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Static Table End -->
         
        </div>
    </div>
</div>
<script>
let id = <?=$id?>;

     function getUserRole(){
        let data = {
            user_id:<?=$id?>
        };
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>AdminPanel/get_user_role",
            data: JSON.stringify(data),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (response) {
                const table_row = response.map((role, index) => {
                    var button = status = "";
                    if(role.IS_ACTIVE==1){
                        status = "<span class='text-success'>Active</span>";
                        button = "<button class='btn btn-danger' onclick='change_status("+role.ROLE_ID+","+role.USER_ID+",0)'>Click for Deactive</button>";
                    }else if(role.IS_ACTIVE==0){
                        status = "<span class='text-danger'>Deactive </span>";
                        button = "<button class='btn btn-success' onclick='change_status("+role.ROLE_ID+","+role.USER_ID+",1)'>Click for Active</button>";
                    }


                    return `<tr>
                                <td>${role.ROLE_ID}</td>
                                <td>${role.ROLE_NAME}</td>
                                <td>${status}</td>
                                <td>${button}</td>
                            </tr>`;
                });
                $("#view_role")
                    .html(table_row);

            },
            error: function (response) {
                console.log("Error Fetching Role:", response);
                showNotification('error',"Error Fetching Role: "+response.responseJSON['error']);
            }
        });
    }

    function change_status(role_id,user_id,status){
        let data = {
            user_id:user_id,
            role_id:role_id,
            status:status
        };
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>AdminPanel/change_role_user",
            data: JSON.stringify(data),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (response) {
                showNotification('success',"Success");
                getUserRole();

            },
            error: function (response) {
                console.log("Error Fetching Role:", response);
                 showNotification('error',"Error Fetching Role: "+response.responseJSON['error']);
            }
        });
    }

    function add_role(){
        let role_id =  $('#role').val();
        if(role_id==0){
            toastr.error("Must Select Role");
            return;
        }
        let data = {
            user_id:<?=$id?>,
            role_id:role_id
        };
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>AdminPanel/add_role",
            data: JSON.stringify(data),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (response) {
                showNotification('success',"Success");
                getUserRole();

            },
            error: function (response) {
                console.log("Error :", response);
               showNotification('error',"Error  "+response.responseJSON['error']);
            }
        });
    }
    $(document).ready(()=>{
        
         if(id==0){
               $('#role_box').hide(); 
            }else{
                 getUserRole();
               $('#role_box').show();  
            }

    });
    
    </script>