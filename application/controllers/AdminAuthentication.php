<?php
/**
 * Created by PhpStorm.
 * User: Kashif Shaikh
 * Date: 3/30/2022
 * Time: 12:28 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require "BaseController.php";
class AdminAuthentication extends BaseController
{
    private $script_name = "";
    private $SelfController = 'AdminLogin';
    public $side_bar_values = array();

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->has_userdata($this->SessionName)) {
            redirect(base_url() . $this->AdminLoginController);
            exit();
        } else {

            $path = ltrim($_SERVER['REQUEST_URI'],'/');
             $index = strpos($path,'?');
              // var_dump($index);
               if($index!==false){
                   $path = explode('?', $path)[0];
               }
            $this->script_name = $path;

            $this->user = $this->session->userdata($this->SessionName);
            $this->user = $this->User_model->getUserFullDetailById($this->user['USER_ID']);
       
            $this->user_role = $this->session->userdata($this->user_role);
            //   prePrint($this->user );
            // exit();
            $user_id =$this->user['users_reg']['USER_ID'];
            $role_id = $this->user_role['ROLE_ID'];
            $this->dept_id= $this->user_role['DEPT_ID'];

            $privilages = $this->Configuration_model->get_privilages($user_id, $role_id);
        //   prePrint($this->script_name);
        //     prePrint($role_id);
        //     exit();

            $bol = $this->verify_path($this->script_name, $privilages);
           // $bol = true;

            if ($bol == true) {
                $this->side_bar_values = $this->get_side_bar_data($privilages);
            } else {
                redirect(base_url() . $this->SelfController);
                exit();
            }

        }
    }


    private function verify_path($path = null, $privilages)
    {
         if ($path == null) {
                $path = ltrim($_SERVER['REQUEST_URI'],'/');
               // $path = explode('index.php/', $self);
               $index = strpos($path,'?');
              // var_dump($index);
               if($index!==false){
                   $path = explode('?', $path)[0];
               }
            }
        //  prePrint($path );
          //prePrint($privilages);
        foreach ($privilages as $p) {
           
            if ($p['LINK'] == $path) {
                return true;
            }else{
                $index = strpos($p['LINK'],'/?');
                
                if($index!==false){
                    $new_link = str_replace("/?","",$p['LINK']);
                    $index = strpos($path,$new_link);
                    var_dump($index);
                    prePrint($new_link);
                      prePrint($new_link);
                    exit();
                  
                    if($index!==false){
                      //  
                        //prePrint($path);
                    //    prePrint($new_link);
                     //   exit();
                       return true;  
                    }
                }
            }
        }
        exit("<h2>Access Prohibited</h2>");
    }

    private function get_side_bar_data($rows)
    {
        //$rows = $this->get_privilages($user_id,$role_id);
        $dummy = array();
        foreach ($rows as $p) {
            if ($p['IS_PARENT'] == 'Y' && $p['IS_DASHBOARD_ITEM'] == 1) {
                $sub_item = array();
                foreach ($rows as $k) {
                    if ($p['PRIVILAGE_ID'] == $k['PARENT_ID']) {
                        $sub_item[] = array(
                            'is_tab_base' => $p['IS_TAB_BASE'],
                            'value' => $k['NAME'],
                            'link' => $k['LINK']);
                    }
                }

                $dum = array('is_submenu' => 1,
                    'is_tab_base' => $p['IS_TAB_BASE'],
                    'value' => $p['NAME'],
                    'link' => $p['LINK'],
                    'class' => $p['SIDE_ICON'],
                    'sub_menu' => $sub_item);
                $dummy[] = $dum;
            } else if ($p['PARENT_ID'] == '0' && $p['IS_DASHBOARD_ITEM'] == 1) {

                $dum = array('is_submenu' => 0,
                    'is_tab_base' => $p['IS_TAB_BASE'],
                    'value' => $p['NAME'],
                    'link' => $p['LINK'],
                    'class' => $p['SIDE_ICON']);
                $dummy[] = $dum;
            }

        }
        array_push($dummy,array('is_submenu' => 0,
            'is_tab_base'=>'N',
            'value' => 'Logout',
            'link' => "logout",
            'class' =>'educate-icon educate-pages icon-wrap'));
        return $dummy;
    }
    
    function set_admission_role ($user_admission_role)
	{
		$this->session->set_userdata($this->user_role, $user_admission_role[0]);
	}
	 function getSessionData($user,$user_profile)
	{
	   // prePrint($user);
	   // exit();
        $session_data =array('USER_ID'=>$user['USER_ID'],'ROLE_NAME'=>$user['ROLE_NAME'],'KEYWORD'=>$user['KEYWORD'],'DEPT_ID'=>$user['DEPT_ID'],'ACTIVE'=>$user['ACTIVE'],'FIRST_NAME'=>$user_profile['FIRST_NAME'],'LAST_NAME'=>$user_profile['LAST_NAME'],'EMAIL'=>$user_profile['EMAIL'],'CNIC_NO'=>$user_profile['CNIC_NO'],'PROFILE_IMAGE'=>$user_profile['PROFILE_IMAGE'],'PROFILE'=>$user_profile);
        return $session_data;
    }
}