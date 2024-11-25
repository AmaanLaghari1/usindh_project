<section><div class="container mt-10">
    <div class="row justify-content-center">
          <div class="col-md-8">
            </div>
        <div class="col-md-8">
            <div class="card p-15" style='background-color:#eaecc2;'>
                <div class="card-header">
                    <h2>Register</h2>
                </div>
                <div class="card-body" >
                    <form method="post" action="<?=base_url()."Alumni/register_handler"?>">
                        <?=validation_errors()?>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- First Name -->
                                <div class="form-group">
                                    <label for="first_name">Full Name <span class="text-danger">*</span></label>
                                    <input requied class="form-control" type="text" id="first_name" name="first_name">
                                </div>

                                <!-- Last Name -->
                                <div class="form-group">
                                    <label for="last_name">Surname <span class="text-danger">*</span></label>
                                    <input requied class="form-control" type="text" id="last_name" name="last_name">
                                </div>

                                <!-- Email Address -->
                                <div class="form-group">
                                    <label for="user_email">E-mail Address <span class="text-danger">*</span></label>
                                    <input requied class="form-control" type="email" id="user_email" name="user_email">
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label for="user_password">Password <span class="text-danger">*</span></label>
                                    <input requied class="form-control" type="password" id="user_password" name="user_password">
                                </div>
                            </div>
                            <div class="col-md-6">
                               
                                
                                <!-- Mobile No -->
                                <div class="form-group">
                                    <label for="mobile_no">Mobile No <span class="text-danger">*</span></label>
                                    <input requied class="form-control" type="number" id="mobile_no" name="mobile_no">
                                </div>
                                
                                <!-- Roll No -->
                                <div class="form-group">
                                    <label for="roll_no">Roll No <span class="text-danger">*</span></label>
                                    <input requied class="form-control" type="text" id="roll_no" name="roll_no">
                                </div>
                                
                                <!-- Department -->
                                <div class="form-group">
                                    <label for="department">Department <span class="text-danger">*</span></label>
                                    <select requied class="form-control" id="department" name="department">
                                        <option value='0'>--choose--</option>
                                        <?php
                                        foreach($dept_list as $dept){
                                            echo "<option value='{$dept['DEPT_ID']}'>{$dept['DEPT_NAME']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                 <!-- Confirm Password -->
                                <div class="form-group">
                                    <label for="confirm_user_password">Confirm Password <span class="text-danger">*</span></label>
                                    <input requied class="form-control" type="password" id="confirm_user_password" name="confirm_user_password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cnic_no">CNIC NO</label>
                            <input requied  class="form-control" type="text" id="cnic_no" name="cnic_no">
                        </div>
                        <!-- Current Occupation -->
                        <div class="form-group">
                            <label for="occupation">Current Occupation</label>
                            <input requied  class="form-control" type="text" id="occupation" name="occupation">
                        </div>
                        
                        <!-- Current Organization -->
                        <div class="form-group">
                            <label for="organization">Organization</label>
                            <input requied class="form-control" type="text" id="organization" name="organization">
                        </div>
                        
                        
                        
                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" value="Register" class="btn btn-primary btn-block" id="um-submit-btn">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>