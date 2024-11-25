<?php
/**
 * Created by PhpStorm.
 * User: Kashif Shaikh
 * Date: 3/30/2022
 * Time: 12:28 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require "BaseController.php";
class Authentication extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata($this->SessionName)){
            redirect(base_url().$this->LoginController);
            exit();
        }else{
            $this->user = $this->session->userdata($this->SessionName);
            $this->user = $this->User_model->getUserFullDetailById($this->user['USER_ID']);
            if(!$this->user){
                redirect(base_url('logout'));
                exit();
            }
        }
    }

}