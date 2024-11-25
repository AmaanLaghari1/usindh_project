<?php
/**
 * Created by PhpStorm.
 * User: Kashif Shaikh
 * Date: 3/28/2022
 * Time: 9:12 PM
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class BaseController extends CI_Controller
{

    public $HomeController = 'dashboard';
    public $SessionName = 'USER_LOGIN_FOR_JOB';
    public $file_size = 300;
    public $LoginController = "login";
    public $AdminLoginController = "AdminLogin";
	
	public $user_role	= 'ADMIN_ROLE';
    public function __construct()
    {
        parent::__construct();
       // exit();

    }
          // Callback function to check for password mismatch
        public function password_mismatch($password) {
            if ($password != $this->input->post('confirm_user_password')) {
                return false;
            } else {
                return true;
            }
        }
    public function view($view,$data){
        if(!isset($data['side_bar_values'])){
            $data['side_bar_values'] =$this->getSideBarValues();
        }
        $this->load->view('include/header',$data);
        $this->load->view('include/preloder');
        $this->load->view('include/side_bar',$data);
        $this->load->view('include/nav',$data);
        $this->load->view($view,$data);
        $this->load->view('include/footer_area',$data);
        $this->load->view('include/footer',$data);

    }
    public function getSideBarValues(){
        $side_bar_values = array(
            array('is_submenu' => 0,
            'is_tab_base'=>'N',
            'value' => 'Dashboard',
            'link' => "dashboard",
            'class' =>'educate-icon educate-home icon-wrap'),
            array('is_submenu' => 0,
            'is_tab_base'=>'N',
            'value' => 'Logout',
            'link' => "logout",
            'class' =>'educate-icon educate-pages icon-wrap')
        );

        return $side_bar_values;

    }
    public function upload_image($index_name,$image_name,$max_size = 2000,$path = 'resource/images/',$con_array=array(),$type='gif|jpg|png|jpeg')
    {

        if (!is_dir($path)) {
            mkdir($path, 0777, TRUE);

        }
        $config['upload_path']          = $path;
        $config['allowed_types']        = $type;
        $config['max_size']             = $max_size;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        $config['file_name']			= $image_name;
        $config['overwrite']			= true;

        if(isset($this->upload)){
            $this->upload =  null;
        }
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($index_name))
        {
            return array("STATUS"=>false,"MESSAGE"=> $config['upload_path'].$this->upload->display_errors());
        }
        else
        {
            $image_data = $this->upload->data();

            $image_path = $image_data['full_path'];

            $config['image_library'] = 'gd2';
            $config['source_image'] = $image_path;
            $config['create_thumb'] = FALSE;
//            if(!count($con_array)){
//                $config['maintain_ratio'] = TRUE;
//                $config['width']         = 180;
//                $config['height']       = 260;
//            }
//            else{
//                if(isset($con_array['maintain_ratio'])){
//                    $config['maintain_ratio']=$con_array['maintain_ratio'];
//                }
//
//                if(isset($con_array['width'])){
//                    $config['width']=$con_array['width'];
//                }
//
//                if(isset($con_array['height'])){
//                    $config['height']=$con_array['height'];
//                }
//            }

            if(isset($this->image_lib)){
                $this->image_lib =  null;
            }

            if(isset($con_array['resize'])){
                if($con_array['resize']===true){
                    $this->load->library('image_lib',$config);

                    $this->image_lib->resize();
                }
            }
            else{
                $this->load->library('image_lib',$config);

                $this->image_lib->resize();

            }



            // exit("YES");
            return array("STATUS"=>true,"IMAGE_NAME"=>$image_data['file_name']);

        }
    }


}