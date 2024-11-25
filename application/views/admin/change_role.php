  <div id = "min-height" class="container-fluid" style="padding:30px">

            <?php
              
            ?>
            <div class="container">
                <div class="row" style="padding-bottom: 20px;">
                    <div class="col-md-6">

                        <div class="calender-inner">
                            <h3>Change  ROLE</h3>
                            <form action="" method="post">
                                <div id="pwd-container1">
                                    <div class="form-group">
                                        <label for="password1">Select Role</label>
                                        <select class="form-control" name="ROLE" id="ROLE">
                                            <?php
                                           // $role_list = getDataStaticQuery("*","role_relation rr  JOIN role r ON (r.`ROLE_ID`= rr.`ROLE_ID`)","USER_ID={$user['USER_ID']} AND rr.ACTIVE=1");
                                            foreach ($role_list as $ro){
                                                if($ro['IS_ACTIVE']==0){
                                                    continue;
                                                }
                                                if($ro['ROLE_ID']==$role){
                                                    echo "<option value='{$ro['ROLE_ID']}' selected>{$ro['ROLE_NAME']}</option>";
                                                }else
                                                echo "<option value='{$ro['ROLE_ID']}'>{$ro['ROLE_NAME']}</option>";
                                            }
                                           
                                            ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" name="submit" value="Change Role">
                                </div>
                            </form>
                        </div>



                    </div>



                    <div class="col-md-6">
                        <div class="calender-inner">
                            <div id='calendar'></div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
