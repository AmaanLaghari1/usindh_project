<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require "AdminAuthentication.php";
class AdminPanel extends AdminAuthentication
{
    private $script_name = "";
    
    public function __construct()
    {
        parent::__construct();
        //$this->dept_id = 0;
    }
    
   
    function dashboard(){
        $data['profile_url'] = $this->user['users_reg']['PROFILE_IMAGE'];
        $data['user'] = $this->user['users_reg'];
        $data['side_bar_values'] = $this->side_bar_values;
        $this->view('admin/dashboard',$data);
    }
    function view_all_slider(){
        $data['profile_url'] = $this->user['users_reg']['PROFILE_IMAGE'];
            $data['user'] = $this->user['users_reg'];
        $dept_id = $this->dept_id;
        $data['DEPT_ID'] = $dept_id;
        
        $data['side_bar_values'] = $this->side_bar_values;
        if($dept_id==0){
            $data['departments'] = $this->Website_model->getDepartmentByCondition(" 1 ORDER BY d.DEPT_NAME",1);
        }else{

            $data['departments'] = $this->Website_model->getDepartmentByCondition(" d.DEPT_ID = $dept_id ORDER BY d.DEPT_NAME",1);
        }
        $data['sliders'] = $this->Sliders_model->getSliders($dept_id);
        $data['slider_obj']  =  "";
        if(isset($_GET['id'])&&isValidData($_GET['id'])){
            $id = isValidData($_GET['id']);
            $data['slider_obj'] = $this->Sliders_model->getSliderById($id);
        }

        $this->view('admin/view_all_slider',$data);
    }


    function slider_handler(){
         $user_id  = $this->user['users_reg']['USER_ID'];
        $error = "";
        $dept_id = $this->dept_id;

        if(isset($_POST['update'])||isset($_POST['add'])){
            $id= $slider_image=$description=$title="";

            if(isset($_POST['update'])){
                if(isset($_POST['id'])&&isValidData($_POST['id'])){
                    $id =isValidData($_POST['id']);
                    $slider = $this->Sliders_model->getSliderById($id);

                    if($slider){
                        $slider_image = $slider['IMAGE'];
                        $description = $slider['DESCRIPTION'];
                        $title = $slider['TITLE'];
                        $DEPT_ID = $slider['DEPT_ID'];
                    }else{
                        $error .= "<div class='text-danger'>Something went wrong data  not found at this id $id </div>";
                    }
                }else{
                    $error .= "<div class='text-danger'>Something went wrong id not found</div>";
                }

            }
            //
            if(isset($_POST['DEPT_ID'])&&$_POST['DEPT_ID']>=0&&($dept_id==0 || $dept_id == $_POST['DEPT_ID'])){
                $DEPT_ID = $_POST['DEPT_ID'];
            }else{
                $error .= "<div class='text-danger'>Something went wrong in Department Id</div>";
            }

            $t=time();
            if (isset($_POST['title']) && isValidData($_POST['title'])) {
                $title = isValidData($_POST['title']);

            } else {
                if ($title == "")
                    $error .= "<div class='text-danger'>Title Must be Filled</div>";
            }
            if (isset($_POST['title']) && isValidData($_POST['title'])) {
                $dept_id = isValidData($_POST['title']);

            } else {
                if ($dept_id == "")
                    $error .= "<div class='text-danger'>Title Must be Filled</div>";
            }


            if (isset($_POST['description']) && isValidData($_POST['description'])) {
                $description = isValidData($_POST['description']);

            } else {
                if ($description == "")
                    $error .= "<div class='text-danger'>Description Must be Filled</div>";
            }
            
            if (isset($_POST['slider_type']) ) {
                $slider_type = isValidData($_POST['slider_type']);

            } 
            if($slider_type==0){
                
            
            if (isset($_FILES['slider_image'])) {
                // prePrint($_FILES['profile_image'][]);
                if (isValidData($_FILES['slider_image']['name'])) {

                    $res = $this->upload_image('slider_image', "slider_image_" .$t , 2000,$path = 'resource/images/slider');
                    if ($res['STATUS'] === true) {
                        $slider_image = "slider/".$res['IMAGE_NAME'];

                    } else {
                        $error .= "<div class='text-danger'>Error {$res['MESSAGE']}</div>";
                    }
                } else {
                    if ($slider_image) {
                        $slider_image = $slider_image;
                    } else {
                        $error .= "<div class='text-danger'>Must Upload Slider Picture</div>";
                    }
                }
            } else {
                if ($slider_image) {
                    $slider_image = $slider_image;

                } else {
                    $error .= "<div class='text-danger'>Must Upload Slider Picture</div>";
                }
            }
                
            }else{
                
                 if (isset($_POST['slider_video']) && isValidData($_POST['slider_video'])) {
                    $slider_image = isValidData($_POST['slider_video']);

                    } else {
                        if ($slider_image == "")
                            $error .= "<div class='text-danger'>Slider video URL must enter</div>";
                    }
            }

            if($error==""){
                $data = array("IS_VIDEO"=>$slider_type,"DEPT_ID"=>$DEPT_ID,"IMAGE"=>$slider_image,"DESCRIPTION"=>$description,"TITLE"=>$title,"ID"=>$id);
                $result = $this->Sliders_model->addOrUpdateSlider($data);
                if($result){
                    if($id){
                        $success = "<div class='text-success'> Succcessfully Update</div>";
                    }else{
                        $success = "<div class='text-success'> Succcessfully Add</div>";
                    }
                }else{
                    "<div class='text-danger'> Something went worng in add / update</div>";
                }

                $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_slider");
                exit();
            }else{
               // $error = "<div class='text-danger'> You are not authorized to change profile picture</div>";
                $alert = array('MSG'=>$error,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_slider");
                exit();
            }
        }else{
            if(isset($_GET['action'])&&$_GET['action']=='delete'||$_GET['action']=='revoke'){
                if(isset($_GET['id'])&&isValidData($_GET['id'])){
                    $id = isValidData($_GET['id']);
                    if($_GET['action']=='delete'){
                        $data = array("ACTIVE"=>0,"ID"=>$id);
                    }else if($_GET['action']=='revoke'){
                        $data = array("ACTIVE"=>1,"ID"=>$id);
                    }

                    $result = $this->Sliders_model->addOrUpdateSlider($data);
                    if($result) {
                        $success = "<div class='text-success'> Action Perform successfully</div>";

                    }else{
                            $success = "<div class='text-danger'> Something went worng in Action</div>";
                        }

                        $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                        $this->session->set_flashdata('ALERT_MSG',$alert);
                        redirect(base_url()."AdminPanel/view_all_slider");
                        exit();
                    }


            }else {
                $error = "<div class='text-danger'>Invalid Action</div>";
                $alert = array('MSG' => $error, 'TYPE' => 'ALERT');
                $this->session->set_flashdata('ALERT_MSG', $alert);
                redirect(base_url() . "AdminPanel/view_all_slider");
                exit();
            }

        }


    }

    
    function view_all_users(){
        $data['profile_url'] = $this->user['users_reg']['PROFILE_IMAGE'];
            $data['user'] = $this->user['users_reg'];
        $data['side_bar_values'] = $this->side_bar_values;
        $data['users'] = $this->User_model->getUsers();
          $data['roles'] =  $this->User_model->getRoles();
        $data['user_obj']  =  "";
        if(isset($_GET['id'])&&isValidData($_GET['id'])){
            $id = isValidData($_GET['id']);
            $data['user_obj'] = $this->User_model->getUserById($id);
        }

        $this->view('admin/view_all_users',$data);
    }
     public function get_user_role(){
        $postdata = file_get_contents("php://input");

        $request = json_decode($postdata);



        $user_id    = isValidData($request->user_id);


        if($user_id>0){
            $roles = $this->User_model->getUserRoleByUserId($user_id);

        }

        if ($roles){
            $result = json_encode($roles);
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output($result);
        }else{
            $this->output
                ->set_status_header(405)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode(array('error'=>"Record not found...")));
        }
    }

    public function change_role_user(){
       // $this->get_side_bar();
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $user_id = isValidData($request->user_id);
        $role_id = isValidData($request->role_id);
        $status = isValidData($request->status);
        $roles = false;

        if($user_id>0&&$role_id>0){



            $roles = $this->User_model->updateUserRoles($user_id,$role_id,$status);
        }

        if ($roles){
            $result = json_encode($roles);
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output($result);
        }else{
            $this->output
                ->set_status_header(405)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode(array('error'=>"Record not found...")));
        }
    }

    public function  add_role(){
       // $this->get_side_bar();
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $user_id = isValidData($request->user_id);
        $role_id = isValidData($request->role_id);

        $roles = false;
        if($user_id>0&&$role_id>0){
            $role = $this->User_model->getUserRoleByUserId($user_id,$role_id);
            if(count($role)){
                $this->output
                    ->set_status_header(405)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(json_encode(array('error'=>"Role Already Exist")));
                return;
            }
            $roles = $this->User_model->addUserRoles($user_id,$role_id);
        }

        if ($roles){
            $result = json_encode($roles);
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output($result);
        }else{
            $this->output
                ->set_status_header(405)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode(array('error'=>"Something went wrong for adding role...")));
        }
    }
    function users_handler(){
        $error = "";
        if(isset($_POST['update'])||isset($_POST['add'])){
            $id=$name="";

            if(isset($_POST['update'])){
                if(isset($_POST['id'])&&isValidData($_POST['id'])){
                    $id =isValidData($_POST['id']);
                    $user_obj = $this->User_model->getUserById($id);

                    if($user_obj){
                        $name = $user_obj['FIRST_NAME'];
                        $last_name = $user_obj['LAST_NAME'];
                        $email = $user_obj['EMAIL'];
                        $cnic_no = $user_obj['CNIC_NO'];
                        $password = $user_obj['PASSWORD'];

                    }else{
                        $error .= "<div class='text-danger'>Something went wrong data  not found at this id $id </div>";
                    }
                }else{
                    $error .= "<div class='text-danger'>Something went wrong id not found</div>";
                }

            }
            //

            $t=time();
            if (isset($_POST['first_name']) && isValidData($_POST['first_name'])) {
                $name = isValidData($_POST['first_name']);

            } else {
                if ($name == "")
                    $error .= "<div class='text-danger'>First Name Must be Filled</div>";
            }
            if (isset($_POST['last_name']) && isValidData($_POST['last_name'])) {
                $last_name = isValidData($_POST['last_name']);

            } else {
                if ($last_name == "")
                    $error .= "<div class='text-danger'>Last Name Must be Filled</div>";
            }
           
            if (isset($_POST['email']) && isValidData($_POST['email'])) {
                $email = isValidData($_POST['email']);

            } else {
                if ($email == "")
                    $error .= "<div class='text-danger'>CNIC NO Must be Filled</div>";
            } 
            
            if (isset($_POST['cnic_no']) && isValidData($_POST['cnic_no'])) {
                $cnic_no = isValidData($_POST['cnic_no']);

            } else {
                if ($cnic_no == "")
                    $error .= "<div class='text-danger'>CNIC NO Must be Filled</div>";
            }
            if (isset($_POST['password']) && isValidData($_POST['password'])) {
                $password = isValidData($_POST['password']);
                $password = cryptPassowrd($password);

            } else {
                
                if ($password == "")
                    $error .= "<div class='text-danger'>Password Must be Filled</div>";
            }


            if($error==""){
                $data = array("FIRST_NAME"=>$name,"USER_ID"=>$id,"LAST_NAME"=>$last_name,"EMAIL"=>$email,"PASSWORD"=>$password,"CNIC_NO"=>$cnic_no);
                $result = $this->User_model->addOrUpdateUser($data);
                if($result){
                    if($id){
                        $success = "<div class='text-success'> Succcessfully Update</div>";
                    }else{
                        $success = "<div class='text-success'> Succcessfully Add</div>";
                    }
                }else{
                    "<div class='text-danger'> Something went worng in add / update</div>";
                }

                $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_users");
                exit();
            }else{
                // $error = "<div class='text-danger'> You are not authorized to change profile picture</div>";
                $alert = array('MSG'=>$error,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_users");
                exit();
            }
        }else{
            if(isset($_GET['action'])&&$_GET['action']=='delete'||$_GET['action']=='revoke'){
                if(isset($_GET['id'])&&isValidData($_GET['id'])){
                    $id = isValidData($_GET['id']);
                    if($_GET['action']=='delete'){
                        $data = array("ACTIVE"=>0,"USER_ID"=>$id);
                    }else if($_GET['action']=='revoke'){
                        $data = array("ACTIVE"=>1,"USER_ID"=>$id);
                    }

                   $result = $this->User_model->addOrUpdateUser($data);
                    if($result) {
                        $success = "<div class='text-success'> Action Perform successfully</div>";

                    }else{
                        $success = "<div class='text-danger'> Something went worng in Action</div>";
                    }

                    $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                    $this->session->set_flashdata('ALERT_MSG',$alert);
                    redirect(base_url()."AdminPanel/view_all_users");
                    exit();
                }
                else{
                      $error = "<div class='text-danger'>Invalid Action</div>";
                    $alert = array('MSG' => $error, 'TYPE' => 'ALERT');
                    $this->session->set_flashdata('ALERT_MSG', $alert);
                    redirect(base_url() . "AdminPanel/view_all_users");
                    exit();
                }


            }else {
                $error = "<div class='text-danger'>Invalid Action</div>";
                $alert = array('MSG' => $error, 'TYPE' => 'ALERT');
                $this->session->set_flashdata('ALERT_MSG', $alert);
                redirect(base_url() . "AdminPanel/view_all_users");
                exit();
            }

        }


    }
    function view_all_category(){
        $data['profile_url'] = $this->user['users_reg']['PROFILE_IMAGE'];
            $data['user'] = $this->user['users_reg'];
        $data['side_bar_values'] = $this->side_bar_values;
        $data['categories'] = $this->Post_model->getCategories();
        $data['category_obj']  =  "";
        if(isset($_GET['id'])&&isValidData($_GET['id'])){
            $id = isValidData($_GET['id']);
            $data['category_obj'] = $this->Post_model->getCategoryById($id);
        }

        $this->view('admin/view_all_categories',$data);
    }
    function category_handler(){
        $error = "";
        if(isset($_POST['update'])||isset($_POST['add'])){
            $id=$name="";

            if(isset($_POST['update'])){
                if(isset($_POST['id'])&&isValidData($_POST['id'])){
                    $id =isValidData($_POST['id']);
                    $category_obj = $this->Post_model->getCategoryById($id);

                    if($category_obj){
                        $name = $category_obj['NAME'];

                    }else{
                        $error .= "<div class='text-danger'>Something went wrong data  not found at this id $id </div>";
                    }
                }else{
                    $error .= "<div class='text-danger'>Something went wrong id not found</div>";
                }

            }
            //

            $t=time();
            if (isset($_POST['name']) && isValidData($_POST['name'])) {
                $name = isValidData($_POST['name']);

            } else {
                if ($name == "")
                    $error .= "<div class='text-danger'>Name Must be Filled</div>";
            }


            if($error==""){
                $data = array("NAME"=>$name,"CATEGORY_ID"=>$id);
                $result = $this->Post_model->addOrUpdateCategory($data);
                if($result){
                    if($id){
                        $success = "<div class='text-success'> Succcessfully Update</div>";
                    }else{
                        $success = "<div class='text-success'> Succcessfully Add</div>";
                    }
                }else{
                    "<div class='text-danger'> Something went worng in add / update</div>";
                }

                $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_category");
                exit();
            }else{
                // $error = "<div class='text-danger'> You are not authorized to change profile picture</div>";
                $alert = array('MSG'=>$error,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_category");
                exit();
            }
        }else{
            if(isset($_GET['action'])&&$_GET['action']=='delete'||$_GET['action']=='revoke'){
                if(isset($_GET['id'])&&isValidData($_GET['id'])){
                    $id = isValidData($_GET['id']);
                    if($_GET['action']=='delete'){
                        $data = array("ACTIVE"=>0,"CATEGORY_ID"=>$id);
                    }else if($_GET['action']=='revoke'){
                        $data = array("ACTIVE"=>1,"CATEGORY_ID"=>$id);
                    }

                    $result = $this->Post_model->addOrUpdateCategory($data);
                    if($result) {
                        $success = "<div class='text-success'> Action Perform successfully</div>";

                    }else{
                        $success = "<div class='text-danger'> Something went worng in Action</div>";
                    }

                    $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                    $this->session->set_flashdata('ALERT_MSG',$alert);
                    redirect(base_url()."AdminPanel/view_all_category");
                    exit();
                }


            }else {
                $error = "<div class='text-danger'>Invalid Action</div>";
                $alert = array('MSG' => $error, 'TYPE' => 'ALERT');
                $this->session->set_flashdata('ALERT_MSG', $alert);
                redirect(base_url() . "AdminPanel/view_all_category");
                exit();
            }

        }


    }


    function view_all_post(){
        $data['profile_url'] = $this->user['users_reg']['PROFILE_IMAGE'];
            $data['user'] = $this->user['users_reg'];
        $data['side_bar_values'] = $this->side_bar_values;
        $data['posts'] = $this->Post_model->getPosts(0,0);
        $data['categories'] = $this->Post_model->getCategories(0,0);
        $data['post_obj']  =  "";
        if(isset($_GET['id'])&&isValidData($_GET['id'])){
            $id = isValidData($_GET['id']);
            $data['post_obj'] = $this->Post_model->getPostById($id,0);
        }

        $this->view('admin/view_all_posts',$data);
    }
    function post_handler(){
        $error = "";
        if(isset($_POST['update'])||isset($_POST['add'])){
            $type_id=$id=$category_id= $post_image=$description=$title="";

            if(isset($_POST['update'])){
                if(isset($_POST['id'])&&isValidData($_POST['id'])){
                    $id =isValidData($_POST['id']);
                    $post =  $this->Post_model->getPostById($id,0);

                    if($post){
                        $post_image = $post['IMAGE_PATH'];
                        $category_id = $post['CATEGORY_ID'];
                        $description = $post['DESCRIPTION'];
                        $title = $post['TITLE'];
                        $type_id = $post['TYPE_ID'];
                    }else{
                        $error .= "<div class='text-danger'>Something went wrong data  not found at this id $id </div>";
                    }
                }else{
                    $error .= "<div class='text-danger'>Something went wrong id not found</div>";
                }

            }
            //

            $t=time();

            if (isset($_POST['title']) && isValidData($_POST['title'])) {
                $title = isValidData($_POST['title']);

            } else {
                if ($title == "")
                    $error .= "<div class='text-danger'>Title Must be Filled</div>";
            }
             if (isset($_POST['type_id']) && isValidData($_POST['type_id'])) {
                 $type_id = isValidData($_POST['type_id']);

             } else {
                 if ($type_id == "")
                     $error .= "<div class='text-danger'>Type Must be Select</div>";
             }
            if (isset($_POST['category_id']) && isValidData($_POST['category_id'])) {
                $category_id = isValidData($_POST['category_id']);

            } else {
                if ($category_id == "")
                    $error .= "<div class='text-danger'>Category Must be Select</div>";
            }
            if (isset($_POST['description']) && isValidData($_POST['description'])) {
                $description = isValidData($_POST['description']);

            } else {
                if ($description == "")
                    $error .= "<div class='text-danger'>Description Must be Filled</div>";
            }

            if($type_id==1) {
                if (isset($_FILES['post_image'])) {
                    // prePrint($_FILES['profile_image'][]);
                    if (isValidData($_FILES['post_image']['name'])) {

                        $res = $this->upload_image('post_image', "post_image_" . $t, 2000, 'resource/images/news');
                        if ($res['STATUS'] === true) {
                            $post_image = "news/" . $res['IMAGE_NAME'];

                        } else {
                            $error .= "<div class='text-danger'>Error {$res['MESSAGE']}</div>";
                        }
                    } else {
                        if ($post_image) {
                            $post_image = $post_image;
                        } else {
                            $error .= "<div class='text-danger'>Must Upload Post Picture</div>";
                        }
                    }
                } else {
                    if ($post_image) {
                        $post_image = $post_image;

                    } else {
                        $error .= "<div class='text-danger'>Must Upload Post Picture</div>";
                    }
                }
            }else if($type_id==2){

                if (isset($_POST['youtube_link']) && isValidData($_POST['youtube_link'])) {
                    $post_image = isValidData($_POST['youtube_link']);

                } else {
                    if ($post_image == "")
                        $error .= "<div class='text-danger'>Youtube Link Must be Filled</div>";
                }
            }else if($type_id==3){
                if (isset($_FILES['post_clip'])) {
                    // prePrint($_FILES['profile_image'][]);
                    if (isValidData($_FILES['post_clip']['name'])) {

                        $res = $this->upload_image('post_clip', "post_clip_" . $t, 20000, 'resource/images/news',$con_array=array(),$type='mp4|3gp|mkv|flv');
                        if ($res['STATUS'] === true) {
                            $post_image = "news/" . $res['IMAGE_NAME'];

                        } else {
                            $error .= "<div class='text-danger'>Error {$res['MESSAGE']}</div>";
                        }
                    } else {
                        if ($post_image) {
                            $post_image = $post_image;
                        } else {
                            $error .= "<div class='text-danger'>Must Upload News Clip</div>";
                        }
                    }
                } else {
                    if ($post_image) {
                        $post_image = $post_image;

                    } else {
                        $error .= "<div class='text-danger'>Must Upload News Clip</div>";
                    }
                }
            }
            if($error==""){
                $data = array("IMAGE_PATH"=>$post_image,"CATEGORY_ID"=>$category_id,"DESCRIPTION"=>$description,"TITLE"=>$title,"POST_ID"=>$id);
                $result = $this->Post_model->addOrUpdatePost($data);
                if($result){
                    if($id){
                        $success = "<div class='text-success'> Succcessfully Update</div>";
                    }else{
                        $success = "<div class='text-success'> Succcessfully Add</div>";
                    }
                }else{
                    "<div class='text-danger'> Something went worng in add / update</div>";
                }

                $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_post");
                exit();
            }else{
                // $error = "<div class='text-danger'> You are not authorized to change profile picture</div>";
                $alert = array('MSG'=>$error,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_post");
                exit();
            }
        }else{
            if(isset($_GET['action'])&&$_GET['action']=='delete'||$_GET['action']=='revoke'){
                if(isset($_GET['id'])&&isValidData($_GET['id'])){
                    $id = isValidData($_GET['id']);
                    if($_GET['action']=='delete'){
                        $data = array("ACTIVE"=>0,"POST_ID"=>$id);
                    }else if($_GET['action']=='revoke'){
                        $data = array("ACTIVE"=>1,"POST_ID"=>$id);
                    }

                    $result = $this->Post_model->addOrUpdatePost($data);
                    if($result) {
                        $success = "<div class='text-success'> Action Perform successfully</div>";

                    }else{
                        $success = "<div class='text-danger'> Something went worng in Action</div>";
                    }

                    $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                    $this->session->set_flashdata('ALERT_MSG',$alert);
                    redirect(base_url()."AdminPanel/view_all_post");
                    exit();
                }


            }else {
                $error = "<div class='text-danger'>Invalid Action</div>";
                $alert = array('MSG' => $error, 'TYPE' => 'ALERT');
                $this->session->set_flashdata('ALERT_MSG', $alert);
                redirect(base_url() . "AdminPanel/view_all_post");
                exit();
            }

        }


    }

    function view_all_config(){
        $data['profile_url'] = $this->user['users_reg']['PROFILE_IMAGE'];
            $data['user'] = $this->user['users_reg'];
        $data['side_bar_values'] = $this->side_bar_values;
        $data['configurations'] = $this->Configuration_model->getConfiguration(0,0);
      
        $data['config_obj']  =  "";
        if(isset($_GET['id'])&&isValidData($_GET['id'])){
            $id = isValidData($_GET['id']);
            $data['config_obj'] = $this->Configuration_model->getConfigurationById($id,0);
        }

        $this->view('admin/view_all_config',$data);
    }
    function config_handler(){
        $error = "";

        if(isset($_POST['update'])||isset($_POST['add'])){
            $id=$value=$description="";

            if(isset($_POST['update'])){
                if(isset($_POST['id'])&&isValidData($_POST['id'])){
                    $id =isValidData($_POST['id']);
                    $post =  $this->Configuration_model->getConfigurationById($id,0);

                    if($post){
                       
                        $description = $post['DESCRIPTION'];
                        $value = $post['VALUE'];
                    }else{
                        $error .= "<div class='text-danger'>Something went wrong data  not found at this id $id </div>";
                    }
                }else{
                    $error .= "<div class='text-danger'>Something went wrong id not found</div>";
                }

            }
            //

            $t=time();
            if (isset($_POST['value']) && isValidData($_POST['value'])) {
               // $char2 = htmlspecialchars($_POST['value']);
                //$char2 = htmlentities($_POST['value'], ENT_QUOTES);
                //$char3 = htmlentities($char2);
                $value = isValidData($_POST['value']);

            } else {
                if ($value == "")
                    $error .= "<div class='text-danger'>Value Must be Filled</div>";
            }

            if (isset($_POST['description']) && isValidData($_POST['description'])) {
                $description = isValidData($_POST['description']);

            } else {
                if ($description == "")
                    $error .= "<div class='text-danger'>Description Must be Filled</div>";
            }

          
            if($error==""){
                $data = array("DESCRIPTION"=>$description,"VALUE"=>$value,"ID"=>$id);
                $result = $this->Configuration_model->addOrUpdateConfiguration($data);
                if($result){
                    if($id){
                        $success = "<div class='text-success'> Succcessfully Update</div>";
                    }else{
                        $success = "<div class='text-success'> Succcessfully Add</div>";
                    }
                }else{
                    "<div class='text-danger'> Something went worng in add / update</div>";
                }

                $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_config");
                exit();
            }else{
                // $error = "<div class='text-danger'> You are not authorized to change profile picture</div>";
                $alert = array('MSG'=>$error,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_config");
                exit();
            }
        }else{
            if(isset($_GET['action'])&&$_GET['action']=='delete'||$_GET['action']=='revoke'){
                if(isset($_GET['id'])&&isValidData($_GET['id'])){
                    $id = isValidData($_GET['id']);
                    if($_GET['action']=='delete'){
                        $data = array("ACTIVE"=>0,"ID"=>$id);
                    }else if($_GET['action']=='revoke'){
                        $data = array("ACTIVE"=>1,"ID"=>$id);
                    }

                    $result = $this->Configuration_model->addOrUpdateConfiguration($data);
                    if($result) {
                        $success = "<div class='text-success'> Action Perform successfully</div>";

                    }else{
                        $success = "<div class='text-danger'> Something went worng in Action</div>";
                    }

                    $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                    $this->session->set_flashdata('ALERT_MSG',$alert);
                    redirect(base_url()."AdminPanel/view_all_config");
                    exit();
                }


            }else {
                $error = "<div class='text-danger'>Invalid Action</div>";
                $alert = array('MSG' => $error, 'TYPE' => 'ALERT');
                $this->session->set_flashdata('ALERT_MSG', $alert);
                redirect(base_url() . "AdminPanel/view_all_config");
                exit();
            }

        }


    }

    function view_all_website(){
        $data['profile_url'] = $this->user['users_reg']['PROFILE_IMAGE'];
            $data['user'] = $this->user['users_reg'];
        $data['side_bar_values'] = $this->side_bar_values;
        $data['websites'] = $this->Website_model->getWebsites(0,0);

        $data['website_obj']  =  "";
        if(isset($_GET['id'])&&isValidData($_GET['id'])){
            $id = isValidData($_GET['id']);
            $data['website_obj'] = $this->Website_model->getWebsiteId($id,0);
        }

        $this->view('admin/view_all_website',$data);
    }
    function website_handler(){
        $error = "";
       // prePrint($_POST);
        //exit();
        if(isset($_POST['update'])||isset($_POST['add'])){
            $id=$value=$description="";

            if(isset($_POST['update'])){
                if(isset($_POST['id'])&&isValidData($_POST['id'])){
                    $id =isValidData($_POST['id']);
                    $website_obj =  $this->Website_model->getWebsiteId($id,0);

                    if($website_obj){
                        $mission = $website_obj['MISSION'];
                        $website_name = $website_obj['WEBSITE_NAME'];
                        $website_url = $website_obj['WEBSITE_URL'];
                        $about = $website_obj['ABOUT'];
                        $id = $website_obj['WEBSITE_ID'];
                        $contact = $website_obj['CONTACT'];
                        $hod_name = $website_obj['HOD_NAME'];
                        $hod_designation = $website_obj['HOD_DESIGNATION'];
                        $website_logo = $website_obj['LOGO'];
                        $hod_image = $website_obj['HOD_PHOTO'];
                    }else{
                        $error .= "<div class='text-danger'>Something went wrong data  not found at this id $id </div>";
                    }
                }else{
                    $error .= "<div class='text-danger'>Something went wrong id not found</div>";
                }

            }
            //

            $t=time();
            if (isset($_POST['website_name']) && isValidData($_POST['website_name'])) {
                $website_name = isValidData($_POST['website_name']);

            } else {
                if ($website_name == "")
                    $error .= "<div class='text-danger'>Website Name Must be Filled</div>";
            }

            if (isset($_POST['website_url']) && isValidData($_POST['website_url'])) {
                $website_url = isValidData($_POST['website_url']);

            } else {
                if ($website_url == "")
                    $error .= "<div class='text-danger'>Website URL Must be Filled</div>";
            }
            if (isset($_POST['mission']) && isValidData($_POST['mission'])) {
                $mission = isValidData($_POST['mission']);

            } else {
                if ($mission == "")
                    $error .= "<div class='text-danger'>Mission Must be Filled</div>";
            }
            if (isset($_POST['about']) && isValidData($_POST['about'])) {
                $about = isValidData($_POST['about']);

            } else {
                if ($about == "")
                    $error .= "<div class='text-danger'>About Must be Filled</div>";
            }
            if (isset($_POST['contact']) && isValidData($_POST['contact'])) {
                $contact = isValidData($_POST['contact']);

            } else {
                if ($contact == "")
                    $error .= "<div class='text-danger'>Contact Must be Filled</div>";
            }
            if (isset($_POST['hod_name']) && isValidData($_POST['hod_name'])) {
                $hod_name = isValidData($_POST['hod_name']);

            } else {
                if ($hod_name == "")
                    $error .= "<div class='text-danger'>Head Of Department Name Must be Filled</div>";
            }
            if (isset($_POST['hod_designation']) && isValidData($_POST['hod_designation'])) {
                $hod_designation = isValidData($_POST['hod_designation']);

            } else {
                if ($hod_designation == "")
                    $error .= "<div class='text-danger'>Head Of Department Designation Must be Filled</div>";
            }
            if (isset($_FILES['hod_image'])) {
                // prePrint($_FILES['profile_image'][]);
                if (isValidData($_FILES['hod_image']['name'])) {

                    $res = $this->upload_image('hod_image', "hod_image_" . $t, 2000, 'resource/images/hod_image');
                    if ($res['STATUS'] === true) {
                        $hod_image = "hod_image/" . $res['IMAGE_NAME'];

                    } else {
                        $error .= "<div class='text-danger'>Error {$res['MESSAGE']}</div>";
                    }
                } else {
                    if ($hod_image) {
                        $hod_image = $hod_image;
                    } else {
                        $error .= "<div class='text-danger'>Must Upload HOD Picture</div>";
                    }
                }
            } else {
                if ($hod_image) {
                    $hod_image = $hod_image;

                } else {
                    $error .= "<div class='text-danger'>Must Upload HOD Picture</div>";
                }
            }
            if (isset($_FILES['logo_image'])) {
                // prePrint($_FILES['profile_image'][]);
                if (isValidData($_FILES['logo_image']['name'])) {

                    $res = $this->upload_image('logo_image', "logo_image_" . $t, 2000, 'resource/images/logo_image');
                    if ($res['STATUS'] === true) {
                        $website_logo = "logo_image/" . $res['IMAGE_NAME'];

                    } else {
                        $error .= "<div class='text-danger'>Error {$res['MESSAGE']}</div>";
                    }
                } else {
                    if ($website_logo) {
                        $website_logo = $website_logo;
                    } else {
                        $error .= "<div class='text-danger'>Must Upload Logo Picture</div>";
                    }
                }
            } else {
                if ($website_logo) {
                    $website_logo = $website_logo;

                } else {
                    $error .= "<div class='text-danger'>Must Upload Logo Picture</div>";
                }
            }



            if($error==""){

                $data = array("HOD_PHOTO"=>$hod_image,"CONTACT"=>$contact,"HOD_NAME"=>$hod_name,"HOD_DESIGNATION"=>$hod_designation,"LOGO"=>$website_logo,"MISSION"=>$mission,"WEBSITE_NAME"=>$website_name,'ABOUT'=>$about,"WEBSITE_URL"=>$website_url,"WEBSITE_ID"=>$id);
                $result = $this->Website_model->addOrUpdateWebsite($data);
                if($result){
                    if($id){
                        $success = "<div class='text-success'> Succcessfully Update</div>";
                    }else{
                        $success = "<div class='text-success'> Succcessfully Add</div>";
                    }
                }else{
                    "<div class='text-danger'> Something went worng in add / update</div>";
                }

                $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_website");
                exit();
            }else{
                // $error = "<div class='text-danger'> You are not authorized to change profile picture</div>";
                $alert = array('MSG'=>$error,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_website");
                exit();
            }
        }else{
            if(isset($_GET['action'])&&$_GET['action']=='delete'||$_GET['action']=='revoke'){
                if(isset($_GET['id'])&&isValidData($_GET['id'])){
                    $id = isValidData($_GET['id']);
                    if($_GET['action']=='delete'){
                        $data = array("ACTIVE"=>0,"WEBSITE_ID"=>$id);
                    }else if($_GET['action']=='revoke'){
                        $data = array("ACTIVE"=>1,"WEBSITE_ID"=>$id);
                    }

                    $result = $this->Website_model->addOrUpdateWebsite($data);
                    if($result) {
                        $success = "<div class='text-success'> Action Perform successfully</div>";

                    }else{
                        $success = "<div class='text-danger'> Something went worng in Action</div>";
                    }

                    $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                    $this->session->set_flashdata('ALERT_MSG',$alert);
                    redirect(base_url()."AdminPanel/view_all_website");
                    exit();
                }


            }else {
                $error = "<div class='text-danger'>Invalid Action</div>";
                $alert = array('MSG' => $error, 'TYPE' => 'ALERT');
                $this->session->set_flashdata('ALERT_MSG', $alert);
                redirect(base_url() . "AdminPanel/view_all_website");
                exit();
            }

        }


    }

    function view_all_designation(){
        $data['profile_url'] = $this->user['users_reg']['PROFILE_IMAGE'];
            $data['user'] = $this->user['users_reg'];
        $data['side_bar_values'] = $this->side_bar_values;
        $data['designations'] = $this->Member_model->getDesignations(0,0);
        $data['designation_obj']  =  "";
        if(isset($_GET['id'])&&isValidData($_GET['id'])){
            $id = isValidData($_GET['id']);
            $data['designation_obj'] = $this->Member_model->getDesignationById($id);
        }

        $this->view('admin/view_all_designation',$data);
    }
    function designation_handler(){
        $error = "";
        if(isset($_POST['update'])||isset($_POST['add'])){
            $id=$name="";

            if(isset($_POST['update'])){
                if(isset($_POST['id'])&&isValidData($_POST['id'])){
                    $id =isValidData($_POST['id']);
                    $designation_obj = $this->Member_model->getDesignationById($id);

                    if($designation_obj){
                        $name = $designation_obj['DESIGNATION_NAME'];
                        $order = $designation_obj['ORDER'];

                    }else{
                        $error .= "<div class='text-danger'>Something went wrong data  not found at this id $id </div>";
                    }
                }else{
                    $error .= "<div class='text-danger'>Something went wrong id not found</div>";
                }

            }
            //

            $t=time();
            if (isset($_POST['name']) && isValidData($_POST['name'])) {
                $name = isValidData($_POST['name']);

            } else {
                if ($name == "")
                    $error .= "<div class='text-danger'>Name Must be Filled</div>";
            }
            if (isset($_POST['order']) && isValidData($_POST['order'])) {
                $order = isValidData($_POST['order']);

            } else {
                if ($order == "")
                    $error .= "<div class='text-danger'>Order Must be Filled</div>";
            }


            if($error==""){
                $data = array("DESIGNATION_NAME"=>$name,"ORDER"=>$order,"ID"=>$id);
                $result = $this->Member_model->addOrUpdateDesignation($data);
                if($result){
                    if($id){
                        $success = "<div class='text-success'> Succcessfully Update</div>";
                    }else{
                        $success = "<div class='text-success'> Succcessfully Add</div>";
                    }
                }else{
                    $success = "<div class='text-danger'> Something went worng in add / update</div>";
                }

                $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_designation");
                exit();
            }else{
                // $error = "<div class='text-danger'> You are not authorized to change profile picture</div>";
                $alert = array('MSG'=>$error,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_designation");
                exit();
            }
        }else{
            if(isset($_GET['action'])&&$_GET['action']=='delete'||$_GET['action']=='revoke'){
                if(isset($_GET['id'])&&isValidData($_GET['id'])){
                    $id = isValidData($_GET['id']);
                    if($_GET['action']=='delete'){
                        $data = array("ACTIVE"=>0,"ID"=>$id);
                    }else if($_GET['action']=='revoke'){
                        $data = array("ACTIVE"=>1,"ID"=>$id);
                    }

                    $result = $this->Member_model->addOrUpdateDesignation($data);
                    if($result) {
                        $success = "<div class='text-success'> Action Perform successfully</div>";

                    }else{
                        $success = "<div class='text-danger'> Something went worng in Action</div>";
                    }

                    $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                    $this->session->set_flashdata('ALERT_MSG',$alert);
                    redirect(base_url()."AdminPanel/view_all_designation");
                    exit();
                }


            }else {
                $error = "<div class='text-danger'>Invalid Action</div>";
                $alert = array('MSG' => $error, 'TYPE' => 'ALERT');
                $this->session->set_flashdata('ALERT_MSG', $alert);
                redirect(base_url() . "AdminPanel/view_all_designation");
                exit();
            }

        }


    }

    function view_all_faculty(){
        $data['profile_url'] = $this->user['users_reg']['PROFILE_IMAGE'];
            $data['user'] = $this->user['users_reg'];
        $data['side_bar_values'] = $this->side_bar_values;
        $data['faculty'] = $this->Website_model->getFaculty(0,0);

        $data['faculty_obj']  =  "";
        if(isset($_GET['id'])&&isValidData($_GET['id'])){
            $id = isValidData($_GET['id']);
            $data['faculty_obj'] = $this->Website_model->getFacultyByID($id,0);
        }

        $this->view('admin/view_all_faculty',$data);
    }
    function faculty_handler(){
        $error = "";
        if(isset($_POST['update'])||isset($_POST['add'])){
           $about_image = $LOGO =$id =  $post_image = $about=$dean_desg=$dean_message= $dean_name=$fac_title=$fac_name="";

            if(isset($_POST['update'])){
                if(isset($_POST['id'])&&isValidData($_POST['id'])){
                    $id =isValidData($_POST['id']);
                    $faculty_obj =  $this->Website_model->getFacultyByID($id,0);

                    if($faculty_obj){
                        $fac_name = $faculty_obj['FAC_NAME'];
                        $fac_title = $faculty_obj['FAC_TITLE'];
                        $dean_name = $faculty_obj['DEAN_NAME'];
                        $dean_message = $faculty_obj['DEAN_MESSAGE'];
                        $dean_desg = $faculty_obj['DEAN_DESIGNATION'];
                        $about = $faculty_obj['ABOUT'];
                        $post_image = $faculty_obj['DEAN_IMAGE'];
                        $id = $faculty_obj['FAC_ID'];
                          $LOGO = $faculty_obj['LOGO'];
                           $URL = $faculty_obj['URL'];
    
                          $dept_about_image = $faculty_obj['ABOUT_IMAGE'];
                    }else{
                        $error .= "<div class='text-danger'>Something went wrong data  not found at this id $id </div>";
                    }
                }else{
                    $error .= "<div class='text-danger'>Something went wrong id not found</div>";
                }

            }
            //

            $t=time();
            if (isset($_POST['fac_name']) && isValidData($_POST['fac_name'])) {
                $fac_name = isValidData($_POST['fac_name']);

            } else {
                if ($fac_name == "")
                    $error .= "<div class='text-danger'>Faculty Name Must be Filled</div>";
            }

            if (isset($_POST['fac_title']) && isValidData($_POST['fac_title'])) {
                $fac_title = isValidData($_POST['fac_title']);

            } else {
                if ($fac_title == "")
                    $error .= "<div class='text-danger'>Faculty Title Must be Filled</div>";
            }

            if (isset($_POST['dean_name']) && isValidData($_POST['fac_title'])) {
                $dean_name = isValidData($_POST['dean_name']);

            } else {
                if ($dean_name == "")
                    $error .= "<div class='text-danger'>Dean Name Must be Filled</div>";
            }

            if (isset($_POST['dean_desg']) && isValidData($_POST['dean_desg'])) {
                $dean_desg = isValidData($_POST['dean_desg']);
            } else {
                if ($dean_desg == "")
                    $error .= "<div class='text-danger'>Dean Designation Must be Filled</div>";
            }

            if (isset($_POST['dean_massage']) && isValidData($_POST['dean_massage'])) {
                $dean_message = isValidData($_POST['dean_massage']);

            } else {
                if ($dean_message == "")
                    $error .= "<div class='text-danger'>Dean Message Must be Filled</div>";
            }

            if (isset($_POST['about']) && isValidData($_POST['about'])) {
                $about = isValidData($_POST['about']);

            } else {
                if ($about == "")
                    $error .= "<div class='text-danger'>About Must be Filled</div>";
            }
              if (isset($_POST['url']) && isValidData($_POST['url'])) {
                $URL = isValidData($_POST['url']);

            } else {
                if ($URL == "")
                    $error .= "<div class='text-danger'>URL Must be Filled</div>";
            }


            if (isset($_FILES['post_image'])) {
                // prePrint($_FILES['profile_image'][]);
                if (isValidData($_FILES['post_image']['name'])) {

                    $res = $this->upload_image('post_image', "dean_image" . $t, 1000, 'resource/images/deans');
                    if ($res['STATUS'] === true) {
                        $post_image = "deans/" . $res['IMAGE_NAME'];

                    } else {
                        $error .= "<div class='text-danger'>Error {$res['MESSAGE']}</div>";
                    }
                } else {
                    if ($post_image) {
                        $post_image = $post_image;
                    } else {
                        $error .= "<div class='text-danger'>Must Upload Dean Picture</div>";
                    }
                }
            } else {
                if ($post_image) {
                    $post_image = $post_image;
                } else {
                    $error .= "<div class='text-danger'>Must Upload Dean Picture</div>";
                }
            }
            
                 if (isset($_FILES['dept_image'])) {
                // prePrint($_FILES['profile_image'][]);
                if (isValidData($_FILES['dept_image']['name'])) {

                    $res = $this->upload_image('dept_image', "fac_logo" . $t, 1000, 'resource/images/fac');
                    if ($res['STATUS'] === true) {
                        $LOGO = "fac/" . $res['IMAGE_NAME'];

                    } else {
                        $error .= "<div class='text-danger'>Error {$res['MESSAGE']}</div>";
                    }
                } else {
                    if ($LOGO) {
                        $LOGO = $LOGO;
                    } else {
                        //$error .= "<div class='text-danger'>Must Upload Dean Picture</div>";
                    }
                }
            } else {
                if ($LOGO) {
                    $LOGO = $LOGO;
                } else {
                    $error .= "<div class='text-danger'>Must Upload Logo Picture</div>";
                }
            }
            if (isset($_FILES['dept_about_image'])) {
                // prePrint($_FILES['profile_image'][]);
                if (isValidData($_FILES['dept_about_image']['name'])) {

                    $res = $this->upload_image('dept_about_image', "fac_about_image" . $t, 1000, 'resource/images/fac');
                    if ($res['STATUS'] === true) {
                        $dept_about_image = "fac/" . $res['IMAGE_NAME'];

                    } else {
                        $error .= "<div class='text-danger'>Error {$res['MESSAGE']}</div>";
                    }
                } else {
                    if ($dept_about_image) {
                        $dept_about_image = $dept_about_image;
                    } else {
                        //$error .= "<div class='text-danger'>Must Upload Dean Picture</div>";
                    }
                }
            } else {
                if ($dept_about_image) {
                    $dept_about_image = $dept_about_image;
                } else {
                    $error .= "<div class='text-danger'>Must Upload Logo Picture</div>";
                }
            }


            if($error==""){

                $data = array("URL"=>$URL,"LOGO"=>$LOGO,"ABOUT_IMAGE"=>$dept_about_image,"DEAN_IMAGE"=>$post_image,"ABOUT"=>$about,"DEAN_DESIGNATION"=>$dean_desg,"DEAN_MESSAGE"=>$dean_message,"DEAN_NAME"=>$dean_name,"FAC_NAME"=>$fac_name,"FAC_TITLE"=>$fac_title,"FAC_ID"=>$id);
                $result = $this->Website_model->addOrUpdateFaculty($data);
                if($result){
                    if($id){
                        $success = "<div class='text-success'> Succcessfully Update</div>";
                    }else{
                        $success = "<div class='text-success'> Succcessfully Add</div>";
                    }
                }else{
                    $success = "<div class='text-danger'> Something went worng in add / update</div>";
                }

                $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_faculty");
                exit();
            }else{
                // $error = "<div class='text-danger'> You are not authorized to change profile picture</div>";
                $alert = array('MSG'=>$error,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_faculty");
                exit();
            }
        }else{
            if(isset($_GET['action'])&&$_GET['action']=='delete'||$_GET['action']=='revoke'){
                if(isset($_GET['id'])&&isValidData($_GET['id'])){
                    $id = isValidData($_GET['id']);
                    if($_GET['action']=='delete'){
                        $data = array("ACTIVE"=>0,"FAC_ID"=>$id);
                    }else if($_GET['action']=='revoke'){
                        $data = array("ACTIVE"=>1,"FAC_ID"=>$id);
                    }

                    $result = $this->Website_model->addOrUpdateFaculty($data);
                    if($result) {
                        $success = "<div class='text-success'> Action Perform successfully</div>";
                    }else{
                        $success = "<div class='text-danger'> Something went worng in Action</div>";
                    }

                    $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                    $this->session->set_flashdata('ALERT_MSG',$alert);
                    redirect(base_url()."AdminPanel/view_all_faculty");
                    exit();
                }


            }else {
                $error = "<div class='text-danger'>Invalid Action</div>";
                $alert = array('MSG' => $error, 'TYPE' => 'ALERT');
                $this->session->set_flashdata('ALERT_MSG', $alert);
                redirect(base_url() . "AdminPanel/view_all_faculty");
                exit();
            }

        }


    }

    function view_all_department(){
        $data['profile_url'] = $this->user['users_reg']['PROFILE_IMAGE'];
            $data['user'] = $this->user['users_reg'];
          $dept_id = $this->dept_id;
          if($dept_id>0){
             $_GET['id']=$dept_id; 
          }
           $data['dept_id']=$dept_id;
        $data['side_bar_values'] = $this->side_bar_values;
        $data['departments'] = $this->Website_model->getDepartments(0,0);
        $data['faculty'] = $this->Website_model->getFaculty(0,1);
        $data['institutes'] = $this->Website_model->getDepartmentByCondition("d.IS_INST = 'Y' ",1);

        $data['department_obj']  =  "";
        if(isset($_GET['id'])&&isValidData($_GET['id'])){
            $id = isValidData($_GET['id']);
            $data['department_obj'] = $this->Website_model->getDepartmentByID($id,0);
        }

        $this->view('admin/view_all_department',$data);
    }
    function department_handler(){
        $error = "";
        $dept_id = $this->dept_id;
          if($dept_id>0){
             $_POST['id']=$dept_id; 
          }
        if(isset($_POST['update'])||isset($_POST['add'])){
            $id = $dept_about_image = $LOGO= $post_image = $about=$FAC_ID= $IS_INST=$CODE=$MISSION=$ABOUT=$DIRECTOR_MESSAGE=$DIRECTOR_DESIGNATION=$DIRECTOR_NAME=$DEPT_NAME="";
            $INST_ID = 0;
            $IS_INST = 'N';
            if(isset($_POST['update'])){
                if(isset($_POST['id'])&&isValidData($_POST['id'])){
                    $id =isValidData($_POST['id']);
                    $department_obj =  $this->Website_model->getDepartmentByID($id,0);

                    if($department_obj){
                        $FAC_ID = $department_obj['FAC_ID'];
                        $INST_ID = $department_obj['INST_ID'];
                        $IS_INST = $department_obj['IS_INST'];
                        $CODE = $department_obj['CODE'];
                        $DEPT_NAME = $department_obj['DEPT_NAME'];
                        $DIRECTOR_NAME = $department_obj['DIRECTOR_NAME'];
                        $DIRECTOR_DESIGNATION = $department_obj['DIRECTOR_DESIGNATION'];
                        $DIRECTOR_MESSAGE = $department_obj['DIRECTOR_MESSAGE'];
                        $MISSION = $department_obj['MISSION'];
                        $ABOUT = $department_obj['ABOUT'];
                        $post_image = $department_obj['DIRECTOR_IMAGE'];
                        $id = $department_obj['DEPT_ID'];
                        $LOGO = $department_obj['LOGO'];
                        $dept_about_image = $department_obj['ABOUT_IMAGE'];
                    }else{
                        $error .= "<div class='text-danger'>Something went wrong data  not found at this id $id </div>";
                    }
                }else{
                    $error .= "<div class='text-danger'>Something went wrong id not found</div>";
                }

            }
            //

            $t=time();
            if (isset($_POST['FAC_ID']) && isValidData($_POST['FAC_ID'])) {
                $FAC_ID = isValidData($_POST['FAC_ID']);

            } else {
                if ($FAC_ID == "")
                    $error .= "<div class='text-danger'>Faculty Must be Select</div>";
            }

            if (isset($_POST['INST_ID']) && isValidData($_POST['INST_ID'])) {
                $INST_ID = isValidData($_POST['INST_ID']);

            } else {
                //$INST_ID = isValidData($_POST['INST_ID']);
            }

            if (isset($_POST['IS_INST']) && isValidData($_POST['IS_INST'])) {
                $IS_INST = isValidData($_POST['IS_INST']);

            } else {
                if ($IS_INST == "")
                    $error .= "<div class='text-danger'>Is Inst Must be Select</div>";
            }

            if (isset($_POST['CODE']) && isValidData($_POST['CODE'])) {
                $CODE = isValidData($_POST['CODE']);
            } else {
                //if ($CODE == "")
                    //$error .= "<div class='text-danger'>Code Must be Filled</div>";
            }

            if (isset($_POST['DEPT_NAME']) && isValidData($_POST['DEPT_NAME'])) {
                $DEPT_NAME = isValidData($_POST['DEPT_NAME']);

            } else {
                if ($DEPT_NAME == "")
                    $error .= "<div class='text-danger'>Department Name Must be Filled</div>";
            }

            if (isset($_POST['DIRECTOR_NAME']) && isValidData($_POST['DIRECTOR_NAME'])) {
                $DIRECTOR_NAME = isValidData($_POST['DIRECTOR_NAME']);

            } else {
                if ($DIRECTOR_NAME == "")
                    $error .= "<div class='text-danger'>Director Name Must be Filled</div>";
            }

            if (isset($_POST['DIRECTOR_DESIGNATION']) && isValidData($_POST['DIRECTOR_DESIGNATION'])) {
                $DIRECTOR_DESIGNATION = isValidData($_POST['DIRECTOR_DESIGNATION']);

            } else {
                if ($DIRECTOR_DESIGNATION == "")
                    $error .= "<div class='text-danger'>Director Designation Must be Filled</div>";
            }

            if (isset($_POST['DIRECTOR_MESSAGE']) && isValidData($_POST['DIRECTOR_MESSAGE'])) {
                $DIRECTOR_MESSAGE = isValidData($_POST['DIRECTOR_MESSAGE']);
            } else {
                if ($DIRECTOR_MESSAGE == "")
                    $error .= "<div class='text-danger'>Director Message Must be Filled</div>";
            }

            if (isset($_POST['MISSION']) && isValidData($_POST['MISSION'])) {
                $MISSION = isValidData($_POST['MISSION']);
            } else {
                if ($MISSION == "")
                    $error .= "<div class='text-danger'>Mission Must be Filled</div>";
            }

            if (isset($_POST['ABOUT']) && isValidData($_POST['ABOUT'])) {
                $ABOUT = isValidData($_POST['ABOUT']);
            } else {
                if ($ABOUT == "")
                    $error .= "<div class='text-danger'>About Must be Filled</div>";
            }



            if (isset($_FILES['post_image'])) {
                // prePrint($_FILES['profile_image'][]);
                if (isValidData($_FILES['post_image']['name'])) {

                    $res = $this->upload_image('post_image', "dir_image" . $t, 1000, 'resource/images/dept');
                    if ($res['STATUS'] === true) {
                        $post_image = "dept/" . $res['IMAGE_NAME'];

                    } else {
                        $error .= "<div class='text-danger'>Error {$res['MESSAGE']}</div>";
                    }
                } else {
                    if ($post_image) {
                        $post_image = $post_image;
                    } else {
                        $error .= "<div class='text-danger'>Must Upload Director Picture</div>";
                    }
                }
            } else {
                if ($post_image) {
                    $post_image = $post_image;
                } else {
                    $error .= "<div class='text-danger'>Must Upload Director Picture</div>";
                }
            }

            if (isset($_FILES['dept_image'])) {
                // prePrint($_FILES['profile_image'][]);
                if (isValidData($_FILES['dept_image']['name'])) {

                    $res = $this->upload_image('dept_image', "dept_logo" . $t, 1000, 'resource/images/dept');
                    if ($res['STATUS'] === true) {
                        $LOGO = "dept/" . $res['IMAGE_NAME'];

                    } else {
                        $error .= "<div class='text-danger'>Error {$res['MESSAGE']}</div>";
                    }
                } else {
                    if ($LOGO) {
                        $LOGO = $LOGO;
                    } else {
                        //$error .= "<div class='text-danger'>Must Upload Dean Picture</div>";
                    }
                }
            } else {
                if ($LOGO) {
                    $LOGO = $LOGO;
                } else {
                    $error .= "<div class='text-danger'>Must Upload Logo Picture</div>";
                }
            }
            if (isset($_FILES['dept_about_image'])) {
                // prePrint($_FILES['profile_image'][]);
                if (isValidData($_FILES['dept_about_image']['name'])) {

                    $res = $this->upload_image('dept_about_image', "dept_about_image" . $t, 1000, 'resource/images/dept');
                    if ($res['STATUS'] === true) {
                        $dept_about_image = "dept/" . $res['IMAGE_NAME'];

                    } else {
                        $error .= "<div class='text-danger'>Error {$res['MESSAGE']}</div>";
                    }
                } else {
                    if ($dept_about_image) {
                        $dept_about_image = $dept_about_image;
                    } else {
                        //$error .= "<div class='text-danger'>Must Upload Dean Picture</div>";
                    }
                }
            } else {
                if ($dept_about_image) {
                    $dept_about_image = $dept_about_image;
                } else {
                    $error .= "<div class='text-danger'>Must Upload Logo Picture</div>";
                }
            }

            if($error==""){
                
             $data = array("ABOUT_IMAGE"=>$dept_about_image,"DIRECTOR_IMAGE"=>$post_image,"ABOUT"=>$ABOUT,"DIRECTOR_DESIGNATION"=>$DIRECTOR_DESIGNATION,
                 "DIRECTOR_MESSAGE"=>$DIRECTOR_MESSAGE,"DIRECTOR_NAME"=>$DIRECTOR_NAME,"LOGO"=>$LOGO,
                "CODE"=>$CODE,"DEPT_NAME"=>$DEPT_NAME,"MISSION"=>$MISSION ,"DEPT_ID"=>$id,"IS_ADMIN"=>0);
                    
                if($dept_id==0){
                    $data['IS_INST'] = $IS_INST;
                    $data['FAC_ID'] = $FAC_ID;
                    $data['INST_ID'] = $INST_ID;
                }
                if($FAC_ID==15){
                    $data['IS_ADMIN'] = 1;
                }
                $result = $this->Website_model->addOrUpdateDepartment($data);
                if($result){
                    if($id){
                        $success = "<div class='text-success'> Succcessfully Update</div>";
                    }else{
                        $success = "<div class='text-success'> Succcessfully Add</div>";
                    }
                }else{
                    $success = "<div class='text-danger'> Something went worng in add / update</div>";
                }

                $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_department");
                exit();
            }
            else{
                // $error = "<div class='text-danger'> You are not authorized to change profile picture</div>";
                $alert = array('MSG'=>$error,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_department");
                exit();
            }
        }else{
            if(isset($_GET['action'])&&$_GET['action']=='delete'||$_GET['action']=='revoke'){
                if(isset($_GET['id'])&&isValidData($_GET['id'])){
                    $id = isValidData($_GET['id']);
                    if($_GET['action']=='delete'){
                        $data = array("ACTIVE"=>0,"DEPT_ID"=>$id);
                    }else if($_GET['action']=='revoke'){
                        $data = array("ACTIVE"=>1,"DEPT_ID"=>$id);
                    }

                    $result = $this->Website_model->addOrUpdateDepartment($data);
                    if($result) {
                        $success = "<div class='text-success'> Action Perform successfully</div>";
                    }else{
                        $success = "<div class='text-danger'> Something went worng in Action</div>";
                    }

                    $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                    $this->session->set_flashdata('ALERT_MSG',$alert);
                    redirect(base_url()."AdminPanel/view_all_department");
                    exit();
                }


            }else {
                $error = "<div class='text-danger'>Invalid Action</div>";
                $alert = array('MSG' => $error, 'TYPE' => 'ALERT');
                $this->session->set_flashdata('ALERT_MSG', $alert);
                redirect(base_url() . "AdminPanel/view_all_department");
                exit();
            }

        }


    }

    function view_all_r_and_d(){
        $data['profile_url'] = $this->user['users_reg']['PROFILE_IMAGE'];
            $data['user'] = $this->user['users_reg'];
        $data['side_bar_values'] = $this->side_bar_values;
        $data['departments'] = $this->Website_model->getDepartmentByCondition(" 1 ORDER BY d.DEPT_NAME",1);
        $this->view('admin/view_all_r_and_d',$data);
    }
    function apiGetRandD(){
        if(isset($_GET['dept_id'])&&is_numeric($_GET['dept_id'])&&$_GET['dept_id']>0){
            $dept_id = $_GET['dept_id'];
           $rnd =  $this->Website_model->getRnDByCondition(" rnd.DEPT_ID = $dept_id");
            $reponse['RESPONSE'] = "SUCCESS";
            $reponse['MESSAGE'] = "SUCCESSFULLY";
            $reponse['DATA'] = $rnd;
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($reponse));
        }
    }

    function view_all_pages(){
        $data['profile_url'] = $this->user['users_reg']['PROFILE_IMAGE'];
            $data['user'] = $this->user['users_reg'];
        $dept_id = $this->dept_id;
        $data['side_bar_values'] = $this->side_bar_values;
        if($dept_id==0){
            $data['departments'] = $this->Website_model->getDepartmentByCondition(" 1 ORDER BY d.DEPT_NAME",1);
        }else{

            $data['departments'] = $this->Website_model->getDepartmentByCondition(" d.DEPT_ID = $dept_id ORDER BY d.DEPT_NAME",1);
        }
        $data['DEPT_ID'] = $dept_id;
        $data['page_obj']  =  "";
        if(isset($_GET['id'])&&isValidData($_GET['id'])){
            $id = isValidData($_GET['id']);
            $data['page_obj'] = $this->Website_model->getPageByID($id);
            if(!($dept_id==0||$dept_id == $data['page_obj']['DEPT_ID'])) {
                $error = "Invalid Page Id";
                $alert = array('MSG' => $error, 'TYPE' => 'ALERT');
                $this->session->set_flashdata('ALERT_MSG', $alert);
                redirect(base_url() . "AdminPanel/view_all_pages");
                exit();
                }


        }
//        prePrint($data['page_obj']);
//        exit();
        $this->view('admin/view_all_pages',$data);
    }
    function apiGetPages(){
        $dept_id = $this->dept_id;

        if(isset($_GET['dept_id'])&&is_numeric($_GET['dept_id'])&&$_GET['dept_id']>=0){
            if($dept_id==0){
                $dept_id = $_GET['dept_id'];
            }

            $rnd =  $this->Website_model->getPageByCondition(" p.DEPT_ID = $dept_id");
            $reponse['RESPONSE'] = "SUCCESS";
            $reponse['MESSAGE'] = "SUCCESSFULLY";
            $reponse['DATA'] = $rnd;
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($reponse));
        }
    }

    function page_handler(){
        $error = "";
        $dept_id = $this->dept_id;

        if(isset($_POST['update'])||isset($_POST['add'])){
            $id =  $page_name = $description=$DEPT_ID="";

            if(isset($_POST['DEPT_ID'])&&$_POST['DEPT_ID']>=0&&($dept_id==0 || $dept_id == $_POST['DEPT_ID'])){
                $DEPT_ID = $_POST['DEPT_ID'];
            }else{
                $error .= "<div class='text-danger'>Something went wrong in Department Id</div>";
            }

            if(isset($_POST['update'])){
                if(isset($_POST['id'])&&isValidData($_POST['id'])){
                    $id =isValidData($_POST['id']);
                    $page_obj =  $this->Website_model->getPageByID($id,0);

                    if($page_obj){
                        $page_name = $page_obj['PAGE_NAME'];
                        $description = $page_obj['DESCRIPTION'];
                        $DEPT_ID = $page_obj['DEPT_ID'];
                    }else{
                        $error .= "<div class='text-danger'>Something went wrong data  not found at this id $id </div>";
                    }
                }else{
                    $error .= "<div class='text-danger'>Something went wrong id not found</div>";
                }

            }

            $t=time();
            if (isset($_POST['page_name']) && isValidData($_POST['page_name'])) {
                $page_name = isValidData($_POST['page_name']);

            } else {
                if ($page_name == "")
                    $error .= "<div class='text-danger'>Page Name Must be Enter</div>";
            }


            if (isset($_POST['description']) && isValidData($_POST['description'])) {
                $description = isValidData($_POST['description']);
            } else {
                if ($description == "")
                    $error .= "<div class='text-danger'>Description Must be Filled</div>";
            }
            if (isset($_POST['is_rnd'])) {
                $is_rnd = 1;
            } else {
                $is_rnd = 0;
            }


            if($error==""){

                $data = array("IS_RND"=>$is_rnd,"DESCRIPTION"=>$description,"PAGE_NAME"=>$page_name,"DEPT_ID"=>$DEPT_ID,
                   "PAGE_ID"=>$id);
                $result = $this->Website_model->addOrUpdatePage($data);
                if($result){
                    if($id){
                        $success = "<div class='text-success'> Succcessfully Update</div>";
                    }else{
                        $success = "<div class='text-success'> Succcessfully Add</div>";
                    }
                }else{
                    $success = "<div class='text-danger'> Something went worng in add / update</div>";
                }

                $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_pages");
                exit();
            }else{
                // $error = "<div class='text-danger'> You are not authorized to change profile picture</div>";
                $alert = array('MSG'=>$error,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_pages");
                exit();
            }
        }else{
            if(isset($_GET['action'])&&$_GET['action']=='delete'||$_GET['action']=='revoke'){
                if(isset($_GET['id'])&&isValidData($_GET['id'])){
                    $id = isValidData($_GET['id']);
                    if($_GET['action']=='delete'){
                        $data = array("ACTIVE"=>0,"PAGE_ID"=>$id);
                    }else if($_GET['action']=='revoke'){
                        $data = array("ACTIVE"=>1,"PAGE_ID"=>$id);
                    }

                    $result = $this->Website_model->addOrUpdatePage($data);
                    if($result) {
                        $success = "<div class='text-success'> Action Perform successfully</div>";
                    }else{
                        $success = "<div class='text-danger'> Something went worng in Action</div>";
                    }

                    $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                    $this->session->set_flashdata('ALERT_MSG',$alert);
                    redirect(base_url()."AdminPanel/view_all_pages");
                    exit();
                }


            }else {
                $error = "<div class='text-danger'>Invalid Action</div>";
                $alert = array('MSG' => $error, 'TYPE' => 'ALERT');
                $this->session->set_flashdata('ALERT_MSG', $alert);
                redirect(base_url() . "AdminPanel/view_all_pages");
                exit();
            }

        }


    }

    public function set_nav_bar(){
        $data['profile_url'] = $this->user['users_reg']['PROFILE_IMAGE'];
            $data['user'] = $this->user['users_reg'];
        $dept_id = $this->dept_id;
        $data['side_bar_values'] = $this->side_bar_values;
        if($dept_id==0){
            $data['departments'] = $this->Website_model->getDepartmentByCondition(" 1 ORDER BY d.DEPT_NAME",1);
        }else{

            $data['departments'] = $this->Website_model->getDepartmentByCondition(" d.DEPT_ID = $dept_id ORDER BY d.DEPT_NAME",1);
        }
         $data['dept_id'] =$dept_id;

        // This Method Call For Custom Load View
        $this->view('admin/set_nav_bar',$data);
    }
    public function getNavbarByDeptId(){
          $dept_id = $this->dept_id;
        if(isset($_GET['DEPT_ID'])&&is_numeric($_GET['DEPT_ID'])&&$_GET['DEPT_ID']>=0){
            if($dept_id>0){
                $_GET['DEPT_ID']=$dept_id;
            }
            $result = $this->Configuration_model->get_actual_navbar_by_website_url($_GET['DEPT_ID']);
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($result));
        }
    }
    public function navbar_link_handler(){
        $DEPT_ID = $this->dept_id;
        $error  = "";
        if(isset($_POST['dept_id'])&&is_numeric($_POST['dept_id'])&&$_POST['dept_id']>=0){
            if($DEPT_ID==0){
               $dept_id =  $_POST['dept_id'];
            }else if($DEPT_ID==$_POST['dept_id']){
                $dept_id =  $_POST['dept_id'];
            }else{
                $error .= "<div class='text-danger'>Invalid Department Id</div>";
            }
        }else{
            $error .= "<div class='text-danger'>Invalid Department Id</div>";
        }

        if(isset($_POST['title'])&&isValidData($_POST['title'])){
            $title = isValidData($_POST['title']);
        }else{
            $error .= "<div class='text-danger'>Title Must be Enter</div>";
        }
        if(isset($_POST['url'])&&isValidData($_POST['url'])){
            $url = isValidData($_POST['url']);
        }else{
            $error .= "<div class='text-danger'>Url Must be Enter</div>";
        }
        $nav_link_id = 0;
        if(isset($_POST['navbar_link_id_txt'])&&is_numeric($_POST['navbar_link_id_txt'])){
            $nav_link_id = isValidData($_POST['navbar_link_id_txt']);
        }else{
            if(isset($_POST['flag'])&&$_POST['flag']=='update'||$_POST['flag']=='delete'){
                $error .= "<div class='text-danger'>Nav Link Must be Enter</div>";
            }
        }
        if(isset($_POST['parent_id'])&&is_numeric($_POST['parent_id'])){
            $parent_id = isValidData($_POST['parent_id']);
        }else{
            $error .= "<div class='text-danger'>Parent ID Must be Enter</div>";
        }

        if(isset($_POST['level_no'])&&is_numeric($_POST['level_no'])){
            $level_no = isValidData($_POST['level_no']);
        }else{
            $error .= "<div class='text-danger'>Level No Must be Enter</div>";
        }
        if(isset($_POST['order_no'])&&is_numeric($_POST['order_no'])){
            $order_no = isValidData($_POST['order_no']);
        }else{
            $error .= "<div class='text-danger'>Order No Must be Enter</div>";
        }
        if($error==""){


            $data = array("ORDER_NO"=>$order_no,"LEVEL_NO"=>$level_no,"PARENT_ID"=>$parent_id,
                "LINK_ID"=>$nav_link_id,"URL"=>$url,"NAVBAR_TITLE"=>$title,"DEPT_ID"=>$dept_id);
                if($_POST['flag']=='delete'){
                  $result = $this->Configuration_model->deleteNavbar($data);  
                }else{
                    $result = $this->Configuration_model->addOrUpdatNavbar($data);
                }
            
            if($result){
                if($nav_link_id){
                    if($_POST['flag']=='delete'){
                         $success = "<div class='text-success'> Succcessfully delete</div>";
                    }else{
                      $success = "<div class='text-success'> Succcessfully Update</div>";   
                    }
                   
                }else{
                    $success = "<div class='text-success'> Succcessfully Add</div>";
                }
            }else{
                 if($_POST['flag']=='delete'){
                        $success = "<div class='text-danger'> You cannot delete any nav if they have any child first you must delete children nav link.</div>";
                    }else{
                      $success = "<div class='text-danger'> Something went worng in add / update</div>";
                    }
                
            }


            $result = array('MSG'=>$success,'TYPE'=>'ALERT');

            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($result));
           // exit();
        }
        else{
            // $error = "<div class='text-danger'> You are not authorized to change profile picture</div>";
            $result = array('MSG'=>$error,'TYPE'=>'ALERT');
            $this->output
                ->set_status_header(500)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($result));
           // exit();
        }

    }


    public function  main_webpage_data(){
        $data['profile_url'] = $this->user['users_reg']['PROFILE_IMAGE'];
            $data['user'] = $this->user['users_reg'];
        $dept_id = $this->dept_id;
        $data['side_bar_values'] = $this->side_bar_values;

        if($dept_id==0){
            $data['departments'] = $this->Website_model->getDepartmentByCondition(" 1 ORDER BY d.DEPT_NAME",1);
        }else{

            $data['departments'] = $this->Website_model->getDepartmentByCondition(" d.DEPT_ID = $dept_id ORDER BY d.DEPT_NAME",1);
        }

        $file_path = "./application/views/page_data.txt";
        $glue = '<!---END-SECTION--->';
        $data['description'] = file_get_contents($file_path);
        $list_of_sections =  explode($glue,$data['description']);

        if(isset($_POST['add'])&&isset($_POST['description'])){
            $description = $_POST['description'];
            $order = $_POST['order']-1;
            if($order<0&&count($list_of_sections)>=$order){
                $order = 0;
            }else if($order>count($list_of_sections)){
                $order = count($list_of_sections);
            }
            array_splice($list_of_sections, $order, 0, $description);
            $content = implode($glue,$list_of_sections);
            file_put_contents($file_path,$content);

        }else if(isset($_POST['update'])&&isset($_POST['description'])) {
            $index = $_POST['index'];
            $description = $_POST['description'];
            $list_of_sections[$index]= $description;

            $content = implode($glue,$list_of_sections);
            //             prePrint($index);

            // prePrint($description);
            // prePrint($content);
            // exit();
            file_put_contents($file_path,$content);
        }
        $data['description'] = $data['id']= '';
        if(isset($_GET['action'])&&$_GET['action']=='edit'&&isset($_GET['index'])&&is_numeric($_GET['index'])){
            $index = $_GET['index']-1;
            $data['description'] = $list_of_sections[$index];
            $data['id'] = $index;
        }
        if(isset($_GET['action'])&&$_GET['action']=='delete'&&isset($_GET['index'])&&is_numeric($_GET['index'])){
            $index = $_GET['index']-1;
            unset($list_of_sections[$index]);
            $content = implode($glue,$list_of_sections);
            file_put_contents($file_path,$content);
            redirect(base_url("AdminPanel/main_webpage_data"));

        }


        $data['list_of_section'] = $list_of_sections;


        /// This Method Call For Custom Load View
        $this->view('admin/main_webpage_data',$data);

    }
    public function map_faculty_member(){
        $data['profile_url'] = $this->user['users_reg']['PROFILE_IMAGE'];
            $data['user'] = $this->user['users_reg'];
        $dept_id = $this->dept_id;
        $data['side_bar_values'] = $this->side_bar_values;
        if($dept_id==0){
            $data['departments'] = $this->Website_model->getDepartmentByCondition(" 1 ORDER BY d.DEPT_NAME",1);
        }else{

            $data['departments'] = $this->Website_model->getDepartmentByCondition(" d.DEPT_ID = $dept_id ORDER BY d.DEPT_NAME",1);
        }

        // This Method Call For Custom Load View
        $this->view('admin/map_faculty_member',$data);
    }
    function getFacultyMemberByDeptId(){
        $dept_id = $this->dept_id;
        if(isset($_GET['DEPT_ID'])&&is_numeric($_GET['DEPT_ID'])&&$_GET['DEPT_ID']>0){
            $DEPT_ID = $_GET['DEPT_ID'];
            if($dept_id>0){
                $DEPT_ID = $dept_id;
            }
            $fm = postCURL(ITSC_BASE_URL."request-receive/responseITSC.php", array("request"=>"getFacultyMemberByDeptID","dept_id"=>$DEPT_ID));
            if(isset($fm['response'])){
               $faculty_members  =json_decode($fm['response'],true);
                $user_ids = implode(",", array_column($faculty_members, 'USER_ID'));

                $result = $this->Member_model->getMembersByIds($user_ids);
              //  prePrint($result);
                foreach($faculty_members as $k=>$faculty_member){

                    foreach ($result as $row){
                        if($row['MEMBER_ID']==$faculty_member['USER_ID']){
                            $faculty_members[$k]['FLAG'] = $row['ACTIVATE'];
                            $faculty_members[$k]['PREFIX_ID'] = $row['PREFIX_ID'];
                        }
                    }
                    if(!isset($faculty_members[$k]['FLAG'])){
                        $faculty_members[$k]['FLAG'] = 0;
                    }

                }
            }else{
                $faculty_members = array();
            }
            $result =$faculty_members;
            $result = quicksort($result,"PREFIX_ID");
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($result));
        }
    }
    public function update_member_status(){
        $dept_id = $this->dept_id;
        if(isset($_POST['STATUS'])&&isset($_POST["MEMBER_ID"])&&is_numeric($_POST["MEMBER_ID"])&& is_numeric($_POST["STATUS"])){

           $STATUS =  $_POST['STATUS'];
            $STATUS = !$STATUS;
           $MEMBER_ID =  $_POST['MEMBER_ID'];
            //$MEMBER_ID = "123123";
            $result = $this->Member_model->getMembersById($MEMBER_ID);


            if($result){
                $arr  = array("MEMBER_ID"=>$MEMBER_ID,"ACTIVATE"=>$STATUS);
                $this->Member_model->addOrUpdateMember($arr);
            }else{
                //response
                $MEMBER_ID =  $_POST['MEMBER_ID'];
                $fm = postCURL(ITSC_BASE_URL."request-receive/responseITSC.php", array("request"=>"getFacultyMemberByID","user_id"=>$MEMBER_ID));
                prePrint($fm['response']);
                if(isset($fm['response'])){
                    $fm_data = json_decode($fm['response'],true);
                    if(is_array($fm_data)){
                        //INSERT INTO `faculty_members` (`USER_ID`, `DEPT_ID`, `FIRST_NAME`, `FNAME`, `LAST_NAME`, `MOBILE_NO`, `CNIC_NO`, `ENTRY_LOCK_STATUS`, `EMAIL`, `URL_AUTHENTICATION_TOKEN`, `URL_TOKEN_DATETIME`, `TOKEN_EXPIRY_DURATION`, `ACTIVATE`) VALUES ('48', '27', 'Aijaz Ali', NULL, 'Kehar', '0', '48', '1', 'aijaz.kehar@usindh.edu.pk', NULL, NULL, NULL, 1)
                        $arr = $fm_data[0];
                        $arr["ACTIVATE"]=$STATUS;
                        $arr["MEMBER_ID"]=$arr['USER_ID'];
                        $arr["EMAIL_ADRESS"]=$arr['EMAIL'];
                        $arr["MOBILE"]=$arr['MOBILE_NO'];
                        unset($arr['USER_ID']);
                        unset($arr['MOBILE_NO']);
                        unset($arr['ENTRY_LOCK_STATUS']);
                        unset($arr['EMAIL']);
                        unset($arr['URL_AUTHENTICATION_TOKEN']);
                        unset($arr['TOKEN_EXPIRY_DURATION']);
                        unset($arr['URL_TOKEN_DATETIME']);
                        unset($arr['FNAME']);
                        unset($arr['CNIC_NO']);
                        $this->Member_model->addOrUpdateMember($arr,1);
                    }
                }


            }
        }else{
            exit("invalid");
        }
    }
     public function update_member_order(){
        $dept_id = $this->dept_id;
        if(isset($_POST['ORDER'])&&isset($_POST["MEMBER_ID"])&&is_numeric($_POST["MEMBER_ID"])&& is_numeric($_POST["ORDER"])){

           $ORDER =  $_POST['ORDER'];
            
           $MEMBER_ID =  $_POST['MEMBER_ID'];
            //$MEMBER_ID = "123123";
            $result = $this->Member_model->getMembersById($MEMBER_ID);


            if($result){
                $arr  = array("MEMBER_ID"=>$MEMBER_ID,"PREFIX_ID"=>$ORDER);
                $this->Member_model->addOrUpdateMember($arr);
            }else{
                //response
                $MEMBER_ID =  $_POST['MEMBER_ID'];
                $fm = postCURL(ITSC_BASE_URL."request-receive/responseITSC.php", array("request"=>"getFacultyMemberByID","user_id"=>$MEMBER_ID));
                prePrint($fm['response']);
                if(isset($fm['response'])){
                    $fm_data = json_decode($fm['response'],true);
                    if(is_array($fm_data)){
                        //INSERT INTO `faculty_members` (`USER_ID`, `DEPT_ID`, `FIRST_NAME`, `FNAME`, `LAST_NAME`, `MOBILE_NO`, `CNIC_NO`, `ENTRY_LOCK_STATUS`, `EMAIL`, `URL_AUTHENTICATION_TOKEN`, `URL_TOKEN_DATETIME`, `TOKEN_EXPIRY_DURATION`, `ACTIVATE`) VALUES ('48', '27', 'Aijaz Ali', NULL, 'Kehar', '0', '48', '1', 'aijaz.kehar@usindh.edu.pk', NULL, NULL, NULL, 1)
                        $arr = $fm_data[0];
                        $arr["ACTIVATE"]=$STATUS;
                        $arr["MEMBER_ID"]=$arr['USER_ID'];
                        $arr["EMAIL_ADRESS"]=$arr['EMAIL'];
                        $arr["MOBILE"]=$arr['MOBILE_NO'];
                        unset($arr['USER_ID']);
                        unset($arr['MOBILE_NO']);
                        unset($arr['ENTRY_LOCK_STATUS']);
                        unset($arr['EMAIL']);
                        unset($arr['URL_AUTHENTICATION_TOKEN']);
                        unset($arr['TOKEN_EXPIRY_DURATION']);
                        unset($arr['URL_TOKEN_DATETIME']);
                        unset($arr['FNAME']);
                        unset($arr['CNIC_NO']);
                        $this->Member_model->addOrUpdateMember($arr,1);
                    }
                }


            }
        }else{
            exit("invalid");
        }
    }
    

    public function upload_files(){
        $data['profile_url'] = $this->user['users_reg']['PROFILE_IMAGE'];
            $data['user'] = $this->user['users_reg'];
        $user_id  = $this->user['users_reg']['USER_ID'];
        $dept_id = $this->dept_id;
        $data['side_bar_values'] = $this->side_bar_values;
        
         // Load the upload library
       
        if(isset($_FILES['file']['name'])){
                $this->load->library('upload');
                $filename = $_FILES['file']['name'];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $fname = pathinfo($filename, PATHINFO_FILENAME);
                
                if ($ext == 'pdf' ) {
                     $file = "upload_pdfs";
                     $file_size = 5120;    
                   
                }else{
                      $file = "upload_images";
                      $file_size = 2048;
                }
                 $fname = $user_id."_".$fname."_".time() . '_';
                // Define the upload configuration
                 $config['file_name'] = $fname;
                $config['upload_path'] = 'resource/'.$file;
                $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                $config['max_size'] = $file_size; // 2MB
            
                // Initialize the upload library with the configuration
                $this->upload->initialize($config);
                 // Check if file was uploaded
                if (!$this->upload->do_upload('file')) {
                  // Handle upload errors
                  $error = $this->upload->display_errors();
                   $alert = array('MSG'=>$error,'TYPE'=>'ERROR');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                 redirect(base_url()."AdminPanel/upload_files");   
                } else {
                  // Upload successful
                $data['file'] = $this->upload->data('file');
                $alert = array('MSG'=>"SUCCESSFULLY UPLOAD",'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                 redirect(base_url()."AdminPanel/upload_files");
                }
                
        }else{
            if($dept_id>0){
                 $prefix = $user_id;
            }else{
                $prefix = "";
            }
            $dir_path = 'resource/upload_images';
           
            $image_file_names = glob($dir_path . DIRECTORY_SEPARATOR . $prefix . "*");
            
            $dir_path = 'resource/upload_pdfs';
           
            $pdf_file_names = glob($dir_path . DIRECTORY_SEPARATOR . $prefix . "*");
            $data['image_file_names'] = $image_file_names;
            $data['pdf_file_names'] = $pdf_file_names;
             $this->view('admin/upload_files',$data);
        }
        
       
    }
    public function  component_data(){
        $data['profile_url'] = $this->user['users_reg']['PROFILE_IMAGE'];
            $data['user'] = $this->user['users_reg'];
        $dept_id = $this->dept_id;
        $data['side_bar_values'] = $this->side_bar_values;

        if($dept_id==0){
            $data['departments'] = $this->Website_model->getDepartmentByCondition(" 1 ORDER BY d.DEPT_NAME",1);
        }else{

            $data['departments'] = $this->Website_model->getDepartmentByCondition(" d.DEPT_ID = $dept_id ORDER BY d.DEPT_NAME",1);
        }

        $file_path = "./application/views/component/component.txt";
        $glue = '<!---END-COMPONENT--->';
        
        $list_of_sections = file_get_contents($file_path);
         //   prePrint($d);
        $list_of_sections = json_decode($list_of_sections,true);
        //  prePrint($list_of_sections);
        //  exit();

        if(isset($_POST['add'])&&isset($_POST['description'])){
            $description = $_POST['description'];
            $order = $_POST['order'];
            if(isset($list_of_sections[$order])){
                
            }else{
                $list_of_sections[$order] = $description;
            $content = json_encode($list_of_sections);
            file_put_contents($file_path,$content);    
            }
            

        }else if(isset($_POST['update'])&&isset($_POST['description'])) {
             $description = $_POST['description'];
            $order=$_POST['index'];
          
            
           if(isset($list_of_sections[$order])){
               
                
                $list_of_sections[$order] = $description;
                
                $content = json_encode($list_of_sections);
                file_put_contents($file_path,$content); 
            }else{
                   
            }
       
               
        }
        $data['description'] = $data['id']= '';
        if(isset($_GET['action'])&&$_GET['action']=='edit'&&isset($_GET['index'])&&is_numeric($_GET['index'])){
            $index = $_GET['index'];
            $data['description'] = $list_of_sections[$index];
            $data['id'] = $index;
        }
        


        $data['list_of_section'] = $list_of_sections;


        /// This Method Call For Custom Load View
        $this->view('admin/component_data',$data);

    }
    function change_role(){
        $data['profile_url'] = $this->user['users_reg']['PROFILE_IMAGE'];
            $data['user'] = $this->user['users_reg'];
        $data['side_bar_values'] = $this->side_bar_values;
        $user_id =$this->user['users_reg']['USER_ID'];
          if(isset($_POST['submit'])&&isset($_POST['ROLE'])&&is_numeric($_POST['ROLE'])){
                    $bool=false;
                    //
                    
                   $user_role_data = $this->User_model->getUserRoleByUserId($user_id,$_POST['ROLE']);
                  //  $is_valid = getDataStaticQuery("*","role_relation","USER_ID={$user['USER_ID']} AND ROLE_ID={$_POST['ROLE']} AND ACTIVE = 1");
                    // prePrint($_POST);
                    // exit();
                    if(count($user_role_data)>0){
                        $this->user = $this->session->userdata($this->SessionName);
                        // prePrint($this->user);
                        // exit();
                          $session_data=$this->getSessionData($user_role_data[0],$this->user['PROFILE']);
                          
							$this->session->set_userdata($this->SessionName, $session_data);
							$this->user_role='ADMIN_ROLE';
                            $this->set_admission_role($user_role_data);
                            
                             $this->user_role = $this->session->userdata('ADMIN_ROLE');
                            // prePrint($user_role_data);
                            //prePrint(  $this->user_role);
                         redirect(base_url().'AdminPanel/dashboard');
                                                exit();
                    }else{
                        $error.="Warning you are tampering role it is illegale..!";
                    }

                }
        $data['role'] = $this->user_role['ROLE_ID'];
         
        $data['role_list']=$this->User_model->getUserRoleByUserId($user_id);
           if(count( $data['role_list'])<=1){
                redirect(base_url().'AdminPanel/dashboard');
                                                exit();
                                            }
        $this->view('admin/change_role',$data);

    }
    
    public function view_all_footers(){
        $data['profile_url'] = $this->user['users_reg']['PROFILE_IMAGE'];
            $data['user'] = $this->user['users_reg'];
         $dept_id = $this->dept_id;
        $data['side_bar_values'] = $this->side_bar_values;
        if($dept_id==0){
            $data['departments'] = $this->Website_model->getDepartmentByCondition(" 1 ORDER BY d.DEPT_NAME",1);
        }else{

            $data['departments'] = $this->Website_model->getDepartmentByCondition(" d.DEPT_ID = $dept_id ORDER BY d.DEPT_NAME",1);
        }
        $data['DEPT_ID'] = $dept_id;
        $data['footer_obj']  =  "";
        if(isset($_GET['id'])&&isValidData($_GET['id'])){
            $id = isValidData($_GET['id']);
            $data['footer_obj'] = $this->Website_model->getFooterByID($id);
            if(!($dept_id==0||$dept_id == $data['footer_obj']['DEPT_ID'])) {
                $error = "Invalid Page Id";
                $alert = array('MSG' => $error, 'TYPE' => 'ALERT');
                $this->session->set_flashdata('ALERT_MSG', $alert);
                redirect(base_url() . "AdminPanel/view_all_footers");
                exit();
                }


        }
//        prePrint($data['page_obj']);
//        exit();
        $this->view('admin/view_all_footers',$data);
    }
    public function apiGetFooter(){
        $dept_id = $this->dept_id;

        if(isset($_GET['dept_id'])&&is_numeric($_GET['dept_id'])&&$_GET['dept_id']>=0){
            if($dept_id==0){
                $dept_id = $_GET['dept_id'];
            }

            $rnd =  $this->Website_model->getFooterByCondition(" p.DEPT_ID = $dept_id  ",0);
            $reponse['RESPONSE'] = "SUCCESS";
            $reponse['MESSAGE'] = "SUCCESSFULLY";
            $reponse['DATA'] = $rnd;
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($reponse));
        }
    }
    public function footer_handler(){
        $error = "";
        $dept_id = $this->dept_id;
        if(isset($_POST['update'])||isset($_POST['add'])){
            $id =  $page_name = $description=$DEPT_ID="";

            if(isset($_POST['DEPT_ID'])&&$_POST['DEPT_ID']>=0&&($dept_id==0 || $dept_id == $_POST['DEPT_ID'])){
                $DEPT_ID = $_POST['DEPT_ID'];
            }else{
                $error .= "<div class='text-danger'>Something went wrong in Department Id</div>";
            }

            if(isset($_POST['update'])){
                if(isset($_POST['id'])&&isValidData($_POST['id'])){
                    $id =isValidData($_POST['id']);
                    $page_obj =  $this->Website_model->getFooterByID($id,0);

                    if($page_obj){
                        $page_name = $page_obj['FOOTER_NAME'];
                        $description = $page_obj['DETAIL'];
                        $DEPT_ID = $page_obj['DEPT_ID'];
                    }else{
                        $error .= "<div class='text-danger'>Something went wrong data  not found at this id $id </div>";
                    }
                }else{
                    $error .= "<div class='text-danger'>Something went wrong id not found</div>";
                }

            }

            $t=time();
            if (isset($_POST['page_name']) && isValidData($_POST['page_name'])) {
                $page_name = isValidData($_POST['page_name']);

            } else {
                if ($page_name == "")
                    $error .= "<div class='text-danger'>Footer Name Must be Enter</div>";
            }


            if (isset($_POST['description']) && isValidData($_POST['description'])) {
                $description = isValidData($_POST['description']);
            } else {
                if ($description == "")
                    $error .= "<div class='text-danger'>Description Must be Filled</div>";
            }
            


            if($error==""){

                $data = array("DETAIL"=>$description,"FOOTER_NAME"=>$page_name,"DEPT_ID"=>$DEPT_ID,
                   "ID"=>$id);
                $result = $this->Website_model->addOrUpdateFooter($data);
                if($result){
                    if($id){
                        $success = "<div class='text-success'> Succcessfully Update</div>";
                    }else{
                        $success = "<div class='text-success'> Succcessfully Add</div>";
                    }
                }else{
                    $success = "<div class='text-danger'> Something went worng in add / update</div>";
                }

                $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_footers");
                exit();
            }else{
                // $error = "<div class='text-danger'> You are not authorized to change profile picture</div>";
                $alert = array('MSG'=>$error,'TYPE'=>'ALERT');
                $this->session->set_flashdata('ALERT_MSG',$alert);
                redirect(base_url()."AdminPanel/view_all_footers");
                exit();
            }
        }else{
            if(isset($_GET['action'])&&$_GET['action']=='delete'||$_GET['action']=='revoke'){
                if(isset($_GET['id'])&&isValidData($_GET['id'])){
                    $id = isValidData($_GET['id']);
                    if($_GET['action']=='delete'){
                        $data = array("ACTIVE"=>0,"ID"=>$id);
                    }else if($_GET['action']=='revoke'){
                        $data = array("ACTIVE"=>1,"ID"=>$id);
                    }

                    $result = $this->Website_model->addOrUpdateFooter($data);
                    if($result) {
                        $success = "<div class='text-success'> Action Perform successfully</div>";
                    }else{
                        $success = "<div class='text-danger'> Something went worng in Action</div>";
                    }

                    $alert = array('MSG'=>$success,'TYPE'=>'ALERT');
                    $this->session->set_flashdata('ALERT_MSG',$alert);
                    redirect(base_url()."AdminPanel/view_all_footers");
                    exit();
                }


            }else {
                $error = "<div class='text-danger'>Invalid Action</div>";
                $alert = array('MSG' => $error, 'TYPE' => 'ALERT');
                $this->session->set_flashdata('ALERT_MSG', $alert);
                redirect(base_url() . "AdminPanel/view_all_footers");
                exit();
            }

        }


    }

	function view_all_email_request(){
		$data['profile_url'] = $this->user['users_reg']['PROFILE_IMAGE'];
		$data['user'] = $this->user['users_reg'];
		$data['side_bar_values'] = $this->side_bar_values;
		$data['email_requests'] = $this->EmailRequest_model->get();
//		echo "<pre>";
//		print_r($data['email_requests']);
//		die();

		$data['email_requests_obj']  =  "";
		if(isset($_GET['id'])&&isValidData($_GET['id'])){
			$id = isValidData($_GET['id']);
			$data['faculty_obj'] = $this->Website_model->getFacultyByID($id,0);
		}

		$this->view('admin/view_all_email_request',$data);
	}

	public function officialEmailRequestHandler(){
		$data['REQUEST_STATUS_ID'] = $this->input->post('request_status');
		$data['REMARKS'] = $this->input->post('remarks');
		$data['OFFICIAL_EMAIL_CREATED'] = $this->input->post('official_email');
		$data['OFFICIAL_EMAIL_CREATED_AT'] = date('Y-m-d');
		$applicationId = $this->input->post('request_id');

		if($data['REQUEST_STATUS_ID'] == 3 && $this->EmailRequest_model->ifExists('OFFICIAL_EMAIL_CREATED', $this->input->post('official_email'))){
			flashAlert('Failed', 'Account already exists with this email', 'danger');
			redirect(base_url()."AdminPanel/view_all_email_request");
			return 0;
		}

		if($this->EmailRequest_model->update($applicationId, $data)){
			flashAlert('Done', 'Status changed succefully', 'success');

			$userData = $this->EmailRequest_model->getEmailRequestByID($applicationId);

			if($userData && $data['REQUEST_STATUS_ID'] == 3){
				$param = array(
					'to' => $userData->EMAIL,
					'subject' => 'University of Sindh - Email Request Application',
					'email_body' => "Dear ". $userData->FIRST_NAME ." ". $userData->LAST_NAME .", Your official email account address is " . $userData->OFFICIAL_EMAIL_CREATED,
					'sender_id' => 1,
					'reply_to' => 'info@usindh.edu.pk',
				);

				$response = postCURL('https://itsc.usindh.edu.pk/sac/api/send_email_message', $param);

				if($response['response_code'] == 200){
					flashAlert('Account Created', 'Status changed successfully and email sent to the user', 'success');
				}
				else {
					flashAlert('Account Created', 'Unable to send the email', 'error');
				}
			}
		}
		else {
			flashAlert('Failed', 'Unable to change the status', 'error');
		}

		redirect(base_url()."AdminPanel/view_all_email_request");

		return 0;
	}


}
