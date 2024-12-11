<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require "BaseController.php";

class AdminLogin extends BaseController {
    
	private $SelfController = 'AdminLogin';
	public $HomeController = 'AdminPanel/dashboard';
    
    public function __construct()
    {
        parent::__construct();
//		echo cryptPassowrd("123456");
//		exit();
    }


    function index(){
        $website_url="home";
        $header_data['page_title']='University Of Sindh Jamshoro';
        $nav_data['navbar_list']  =  $this->Configuration_model->get_actual_navbar_by_website_url($website_url);
        $this->load->view('includes/header',$header_data);
        $this->load->view('includes/navbar',$nav_data);
        $this->load->view('admin_login');
        $this->load->view('includes/footer');
        $this->load->view('includes/footer_link');

    }

	function set_admission_role ($user_admission_role)
	{
		$this->session->set_userdata($this->user_role, $user_admission_role[0]);
	}
    function adminLoginHandler(){

        if(isset($_POST['login'])
            &&isset($_POST['password'])
            &&isset($_POST['cnic'])){

            $cnic =isValidData($this->input->post('cnic',TRUE));
            $password = isValidData($this->input->post('password',TRUE));

            $hashpassword = cryptPassowrd($password);

            if($cnic&&$password){

                $user = $this->User_model->getUserByCnic($cnic);
				
                if($user){
                    if($user['ACTIVE']!=1){
                           $error =array('TYPE'=>'ERROR','MSG'=>'Your are account is deactivate');
                            $this->session->set_flashdata('ALERT_MSG', $error);
                            redirect(base_url().$this->SelfController);
                            exit();
                    }
                    if(strcmp($hashpassword,$user['PASSWORD'])===0){
						$userId=$user['USER_ID']; // recieved user_id, now pass this id to get and verify user_role.
                        //$user_role_object = $this->User_model->getUserRoleByUserId($userId);
                        $user_admission_role = $this->User_model->getUserAdmissionRoleByUserId($userId);
						
						if($user_admission_role!=null || !(empty($user_admission_role))){
									
                            $session_data=$this->getSessionData($user_admission_role[0],$user);
                            
							$this->session->set_userdata($this->SessionName, $session_data);
                            $this->set_admission_role($user_admission_role);
                           	redirect(base_url().$this->HomeController);

                        }else{
                            $error =array('TYPE'=>'ERROR','MSG'=>'Your are un-authorized person, please stay away');
                            $this->session->set_flashdata('ALERT_MSG', $error);
                            redirect(base_url().$this->SelfController);
                            exit();
                            //UN-AUTHORIZED USER
                        }
                    }else{
                        $error =array('TYPE'=>'ERROR','MSG'=>'Invalid Password');
                        $this->session->set_flashdata('ALERT_MSG', $error);
                        redirect(base_url().$this->SelfController);
                        //invalid password
                    }
                }else{
                    $error =array('TYPE'=>'ERROR','MSG'=>'Invalid Cnic No');
                    $this->session->set_flashdata('ALERT_MSG', $error);
                    redirect(base_url().$this->SelfController);
                    //invalid Cnic
                }
            }
            else{
                $error =array('TYPE'=>'ERROR','MSG'=>'Invalid Request Please Must Enter Cnic And Password ');
                $this->session->set_flashdata('ALERT_MSG', $error);
                redirect(base_url().$this->SelfController);
            }
        }else{
            $error =array('TYPE'=>'ERROR','MSG'=>'Invalid Form Request ');
            $this->session->set_flashdata('ALERT_MSG', $error);
            redirect(base_url().$this->SelfController);
        }
    }

    private function getSessionData($user,$user_profile)
	{
        $session_data =array('USER_ID'=>$user['USER_ID'],'ROLE_NAME'=>$user['ROLE_NAME'],'KEYWORD'=>$user['KEYWORD'],'DEPT_ID'=>$user['DEPT_ID'],'ACTIVE'=>$user['ACTIVE'],'FIRST_NAME'=>$user_profile['FIRST_NAME'],'LAST_NAME'=>$user_profile['LAST_NAME'],'EMAIL'=>$user_profile['EMAIL'],'CNIC_NO'=>$user_profile['CNIC_NO'],'PROFILE_IMAGE'=>$user_profile['PROFILE_IMAGE'],'PROFILE'=>$user_profile);
        return $session_data;
    }

    protected function verify_login()
	{
		if((!$this->session->has_userdata($this->SessionName))){
			redirect(base_url().$this->SelfController);
			exit();
		}
	}
	
	
	protected function verify_path ($path=null,$side_bar_data)
	{
			foreach ($side_bar_data as $p){
				if ($path == null)
				{
					$self = $_SERVER['REQUEST_URI'];
					$path = str_replace('/usindh/',$self);
				}
				prePrint($self);
				if ($p['link'] == $path)
				{
					return true;
				}
			}
			exit("<h2>Access Prohibited</h2>");
	}
	

	
}//class
