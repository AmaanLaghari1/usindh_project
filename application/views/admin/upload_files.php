<div id = "min-height" class="container-fluid" style="padding:30px">
    <div class='card'>
        <div class='card-body'>
     
                <?php echo validation_errors(); ?>
                <?php echo form_open_multipart(base_url().'AdminPanel/upload_files'); ?>
                  <div class='row'>
                    <div class="col-md-4" id="news_image">
                        <div class="form-group res-mg-t-15">
                            <label for="exampleInput1" class="bmd-label-floating">Upload Files
                                <span class="text-danger">*</span>
                            <input required class='form-control' type="file" name="file" />
                        </div>
                    </div>
                      <div class="col-md-4" id="news_image">
                        <div class="form-group res-mg-t-15">
                            <br><br>
                      <input  class='btn btn-success' type="submit" value="Upload File" />
                       </div>
                    </div>
                    </div>
            </form>
            
        </div>
    </div>
    <div class='card'>
        <div class='card-header'>
            <h3>Image File</h3>
            </div>
        <div class='card-body'>
            <table class='table table-border'>
                <tr>
                    <th>File Path</th>
                    <th>Base Url</th>
                     <th>View</th>
                </tr>
                <?php
                foreach($image_file_names as $image_file_name){
                    echo "<tr>
                            <td>".base_url().$image_file_name."</td>
                            <td>&lt;?=base_url()?&gt;".$image_file_name."</td>
                            <td><a target='_blank' href='".base_url().$image_file_name."'>Click Here</a></td>
                         </tr>";
                }
                ?>
                
            </table>    
         </div>
    </div>
    <div class='card'>
        <div class='card-header'>
            <h3>Pdf File</h3>
            </div>
        <div class='card-body'>
            <table class='table table-border'>
                <tr>
                    <th>File Path</th>
                    <th>Base Url</th>
                    <th>View</th>
                </tr>
                <?php
                foreach($pdf_file_names as $pdf_file_name){
                    echo "<tr>
                            <td>".base_url().$pdf_file_name."</td>
                            <td>&lt;?=base_url()?&gt;".$pdf_file_name."</td>
                            <td><a target='_blank' href='".base_url().$pdf_file_name."'>Click Here</a></td>
                             <td><a  class='btn btn-danger' href='".base_url()."/upload_files'>Delete</a></td>
                         </tr>";
                }
                ?>
                
            </table>    
         </div>
    </div>
</div>

