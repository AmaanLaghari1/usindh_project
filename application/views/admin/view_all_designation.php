<?php
/**
 * Created by PhpStorm.
 * User: Kashif Shaikh
 * Date: 03/10/2022
 * Time: 12:45 PM
 */
$order = $name = $id='';
if($designation_obj){
    $name = $designation_obj['DESIGNATION_NAME'];
    $order = $designation_obj['ORDER'];
    $id = $designation_obj['ID'];
}
?>
<div id = "min-height" class="container-fluid" style="padding:30px">
    <div class='card'>
        <div class='card-body'>
            <form action='<?=base_url()."AdminPanel/designation_handler"?>' enctype="multipart/form-data" onsubmit='return confirm("Are You Sure?")' method='post'>

                <div class='row'>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Designation Name<span class="text-danger">*</span></label>
                            <input required value='<?=$name?>' type='text' name='name' class='form-control'/>
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Order<span class="text-danger">*</span></label>
                            <input required value='<?=$order?>' type='number' name='order' class='form-control'/>
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
                            <th>NAME</th>
                            <th>ORDER</th>
                           
                            
                            <th colspan='2'>ACTION</th>
                             
                        </tr>";
                foreach($designations as $designation){
                    if($designation['ACTIVE']==1){
                        $btn = "<a onclick='return confirm(\"Are You sure? Do you want to Deactive Slider\")' class='btn btn-danger' href='".base_url()."AdminPanel/designation_handler?id={$designation['ID']}&action=delete' >Click For Deactive</a>";
                    }else{
                        $btn = "<a onclick='return confirm(\"Are You sure? Do you want to Active Slider\")' class='btn btn-success' href='".base_url()."AdminPanel/designation_handler?id={$designation['ID']}&action=revoke' >Click For Active</a>";
                    }
                    echo "<tr>
                            <td>{$designation['ID']}</td>
                            <td>{$designation['DESIGNATION_NAME']}</td>
                             <td>{$designation['ORDER']}</td>
                            
                        
                            <td><a href='".base_url()."AdminPanel/view_all_designation?id={$designation['ID']}'>Edit</a></td>
                            <td>{$btn}</td>
                        </tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>