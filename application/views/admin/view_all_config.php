<?php
/**
 * Created by PhpStorm.
 * User: Kashif Shaikh
 * Date: 03/10/2022
 * Time: 12:45 PM
 */
$desctiption = $value=$id='';
if($config_obj){
    $value = $config_obj['VALUE'];
    $desctiption = $config_obj['DESCRIPTION'];
    $id = $config_obj['ID'];
}
?>
<div id = "min-height" class="container-fluid" style="padding:30px">
    <div class='card'>
        <div class='card-body'>
            <form  action='<?=base_url()."AdminPanel/config_handler"?>' enctype="multipart/form-data" onsubmit='return confirmForm()' method='post'>

                <div class='row'>
                 
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <label>Description<span class="text-danger">*</span></label>
                            <input required value='<?=$desctiption?>' type='text' name='title' class='form-control'/>
                        </div>
                    </div>

                    <div class='col-md-5'>
                        <div class='form-group'>
                            <label>Value<span class="text-danger">*</span></label>
                            <textarea  name="value" class="form-control" id="value" cols="30" rows="10"><?=$value?></textarea>
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
                            
                            <th>DESCRIPTION</th>
                            <th>Value</th>
                           
                            
                            <th colspan='2'>ACTION</th>
                             
                        </tr>";
                foreach($configurations as $post){
                    if($post['ACTIVE']==1){
                        $btn = "<a onclick='return confirm(\"Are You sure? Do you want to Deactive Config\")' class='btn btn-danger' href='".base_url()."AdminPanel/config_handler?id={$post['ID']}&action=delete' >Click For Deactive</a>";
                    }else{
                        $btn = "<a onclick='return confirm(\"Are You sure? Do you want to Active Config\")' class='btn btn-success' href='".base_url()."AdminPanel/config_handler?id={$post['ID']}&action=revoke' >Click For Active</a>";
                    }
                    echo "<tr>
                            <td>{$post['ID']}</td>
                             
                            <td>{$post['DESCRIPTION']}</td>
                            <td><textarea cols='30' rows='7'>{$post['VALUE']}</textarea></td>
                            
                            
                        
                            <td><a href='".base_url()."AdminPanel/view_all_config?id={$post['ID']}'>Edit</a></td>
                            <td>{$btn}</td>
                        </tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>
