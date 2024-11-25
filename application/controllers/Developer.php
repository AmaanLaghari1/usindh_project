<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require "BaseController.php";
class Developer extends BaseController
{
  function index(){
       
       // mail("kscsm32@gmail.com","My subject",'test');
        $this->load->view('include/login_header');
        $this->load->view('include/preloder');
        $this->load->view('include/login_nav');
        $this->load->view('developer');
        $this->load->view('include/login_footer');
    } 
  
 }