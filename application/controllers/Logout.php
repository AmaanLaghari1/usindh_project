<?php
/**
 * Created by PhpStorm.
 * User: Kashif Shaikh
 * Date: 7/10/2020
 * Time: 9:42 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require "BaseController.php";
class Logout extends BaseController {
    /**
     * Login constructor.
     */


    function index(){


        $this->session->sess_destroy();
      redirect(base_url()."login");
    }


}