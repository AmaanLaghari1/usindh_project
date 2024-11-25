<style>
    *    {
        text-align: left;
    }
</style>

<div style="height:100px"></div>

 
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4" style="padding-left: 40px;">
            <div class="card" style="margin-top: 20px;margin-bottom: 50px;min-height: 400px;">
           <div class="card-header card-header-primary text-center">
                    <h3 class="card-title ">Login</h3>
               
                </div>
                <div class="card-body">
                    <div class="login">
                        <?=form_open('AdminLogin/adminLoginHandler')?>
                            <div id="cnic_view" style="width:100%">

                                <div class="col-12">
                                    <label for="" style="font-size:17px">CNIC No.<span class="text-danger">* (without dashes)</span></label>
                                    <input  type="text" class="form-control mb-3" id="cnic" name="cnic" placeholder="CNIC (xxxxxxxxxxxxx) ">
                                </div>

                            </div>
                            <div class="col-12">
                                <label for="" style="font-size:17px">Password<span class="text-danger">* </span></label>
                                <input  type="password" class="form-control mb-3" id="password" name="password" placeholder="Password">
                            </div>

                            <div class="col-12">
                                <button type="submit" id="login" name='login' class="btn btn-primary btn-md"><span class='fa fa-unlock'></span>&nbsp;&nbsp;Login</button>
                            

                            </div>
                        <hr/>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
<br/>
<br/>


</div>

