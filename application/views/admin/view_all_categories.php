<?php
/**
 * Created by PhpStorm.
 * User: Kashif Shaikh
 * Date: 03/10/2022
 * Time: 12:45 PM
 */
$name = $id='';
if($users_obj){
    $name = $users_obj['NAME'];
    $id = $users_obj['USER_ID'];
}
?>
<div id = "min-height" class="container-fluid" style="padding:30px">
    <div class='card'>
        <div class='card-body'>
            <form action='<?=base_url()."AdminPanel/users_handler"?>' enctype="multipart/form-data" onsubmit='return confirm("Are You Sure?")' method='post'>

                <div class='row'>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Name<span class="text-danger">*</span></label>
                            <input required value='<?=$name?>' type='text' name='name' class='form-control'/>
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
                           
                            
                            <th colspan='2'>ACTION</th>
                             
                        </tr>";
                foreach($categories as $category){
                    if($category['ACTIVE']==1){
                        $btn = "<a onclick='return confirm(\"Are You sure? Do you want to Deactive Slider\")' class='btn btn-danger' href='".base_url()."AdminPanel/category_handler?id={$category['CATEGORY_ID']}&action=delete' >Click For Deactive</a>";
                    }else{
                        $btn = "<a onclick='return confirm(\"Are You sure? Do you want to Active Slider\")' class='btn btn-success' href='".base_url()."AdminPanel/category_handler?id={$category['CATEGORY_ID']}&action=revoke' >Click For Active</a>";
                    }
                    echo "<tr>
                            <td>{$category['CATEGORY_ID']}</td>
                            <td>{$category['NAME']}</td>
                            
                        
                            <td><a href='".base_url()."AdminPanel/view_all_category?id={$category['CATEGORY_ID']}'>Edit</a></td>
                            <td>{$btn}</td>
                        </tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>