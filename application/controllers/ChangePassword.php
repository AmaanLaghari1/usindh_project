<?php
/**
 * Created by PhpStorm.
 * User: Kashif Shaikh
 * Date: 7/11/2020
 * Time: 6:53 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require "AdminAuthentication.php";

class ChangePassword extends AdminAuthentication
{

    public $SelfController = 'changePassword';
    public $LoginController = 'login';

    public function __construct()
    {
        parent::__construct();

    }
    
    function index(){
        //$user = $this->session->userdata($this->SessionName);
        
        $user_fulldata = $this->user;
        //prePrint($user_fulldata);
        //exit();
        if($user_fulldata){
             $data['side_bar_values'] = $this->side_bar_values;
            $data['profile_url'] = $user_fulldata['users_reg']['PROFILE_IMAGE'];
            $data['user'] = $user_fulldata['users_reg'];
            $this->view('change_password',$data);

            }else{
                redirect(base_url().$this->LoginController);
                exit();
        }
    }



    function changePasswordHandler(){
        //$this->load->model('User_model');
        //$user = $this->session->userdata($this->SessionName);
        
        $user_fulldata = $this->user;
        if($user_fulldata) {
            $error = "";
                if (isset($_POST['submit'])&&isset($_POST['current_password']) && isset($_POST['new_password']) && isset($_POST['re_type_password'])) {

                    $curr_password = isValidData($_POST['current_password']);
                    $p1 = isValidData($_POST['re_type_password']);
                    $password = isValidData($_POST['new_password']);
                    //echo "yes1";
                    if (!empty($p1) && !empty($curr_password) && !empty($password)) {
                        //echo "yes2";
                        if ($p1 == $password) {
                            //echo "yes3";
                                //if (passwordRule($password)) {
                                    //echo "yes4";
                                    

                                    $id = $user_fulldata['users_reg']['USER_ID'];
                                
                                    $password = cryptPassowrd($password);
                                    
                                    $curr_password = cryptPassowrd($curr_password);
                                    
                                    // prePrint($password);
                                    // prePrint($curr_password);
                                    // prePrint($user_fulldata);
                                    // exit();
                                    $result = $this->User_model->changePassword($id,$curr_password,$password);
                                   // $result = "";
                                    if($result){
                                        $error =array('TYPE'=>'SUCCESS','MSG'=>'Password has been change successfully');
                                        $this->session->set_flashdata('ALERT_MSG', $error);
                                        redirect(base_url().$this->SelfController);
                                        exit();
                                    }else{
                                        $error .= "<div class='text-danger'>Provided Current Password is Wrong..!</div>";
                                    }


                                /*} else {
                                    $error .= "<div class='text-danger'>At least one digit ...!</div>";
                                    $error .= "<div class='text-danger'>At least one lowercase character ...!</div>";
                                    $error .= "<div class='text-danger'>At least one uppercase character ...!</div>";
                                    $error .= "<div class='text-danger'>At least one special character ...!</div>";
                                    $error .= "<div class='text-danger'>At least 8 characters in length, but no more than 50 ...!</div>";


                                }*/
                            }else {
                                $error .= "<div class='text-danger'>New password and confirmed password are missmatched. Please try again...!</div>";
                             }
                        }
                    else {
                            $error .= "<div class='text-danger'>password feild  must fill...!</div>";

                        }
                    }
                else {
                        $error .= "<div class='text-danger'>index undefined...!</div>";

                    }


                if($error!=""){
                        $error =array('TYPE'=>'ERROR','MSG'=>$error);
                        $this->session->set_flashdata('ALERT_MSG', $error);
                        redirect(base_url().$this->SelfController);
                        exit();
                    }
            }
            else{
                redirect(base_url().$this->LoginController);
                exit();
            }

    }
}