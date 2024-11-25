<?php
/**
 * Created by PhpStorm.
 * User: Irfan Rajput
 * Date: 7/10/2020
 * Time: 9:42 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');
require "BaseController.php";
class Alumni extends BaseController {
    /**
     * Login constructor.
     */

    private $SelfController = 'home';


    public function __construct()
    {
        parent::__construct();


    }
    public function register()
    {
      $website_obj =  $this->Website_model->getWebsiteByUrl($website_url);
        $faculty =  $this->Website_model->getFaculty(0,1);
        $data['sliders'] =array();//$this->Sliders_model->getCarousel();
        $footer= $this->Website_model->getFooterByCondition(" p.DEPT_ID = 0 ",1);
        $data['dept_list'] =  $this->Website_model->getDepartmentByCondition("d.ACTIVE = 1 and f.FAC_ID in (2,5,6,7,8,9,11,12,16) ORDER BY d.DEPT_NAME ");
        if(count($footer)>0){
            $footer = $footer[0];
            $footer = urldecode($footer['DETAIL']);
            $footer = str_replace('<?=base_url()?>',base_url(),$footer);
            $data['footer'] =  $footer ;
        }else{
            $data['footer'] = null;
        }
        
        $data['navbar_list']  =  $this->Configuration_model->get_actual_navbar_by_website_url(0);
        $pop_message = $marquee = "";

        $configurations = $this->Configuration_model->getConfiguration(0,0);
        foreach($configurations as $config){

            if($config['DESCRIPTION']=="MARQUEE_MSG" && $config['ACTIVE']==1){
                $marquee= $config['VALUE'];


            }else if($config['DESCRIPTION']=="POP_MESSAGE"  && $config['ACTIVE']==1){
                $pop_message  = $config['VALUE'];
            }
        }

        $data['marquee'] = $marquee;
        $data['fac'] = $faculty;
        $data['pop_message'] = null;
        $data['website_obj'] = $website_obj;



        $this->load->view('includes/header',$data);
        $this->load->view('includes/navbar',$data );
        $this->load->view('alumni/register',$data);
        $this->load->view('includes/footer',$data);
        $this->load->view('includes/footer_link',$data);
    }
    
    public function register_handler(){
          $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('cnic_no', 'CNIC No', 'trim|required');
        //$this->form_validation->set_rules('user_password', 'Password', 'trim|required');
        //$this->form_validation->set_rules('confirm_user_password', 'Confirm Password', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required');
        $this->form_validation->set_rules('roll_no', 'Roll No', 'trim|required');
        $this->form_validation->set_rules('department', 'Department', 'trim|required');
        $this->form_validation->set_rules('occupation', 'Occupation', 'trim|required');
        $this->form_validation->set_rules('organization', 'Organization', 'trim|required');
        $this->form_validation->set_message('password_mismatch', 'The passwords do not match.');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required');
        $this->form_validation->set_rules('confirm_user_password', 'Confirm Password', 'trim|required|callback_password_mismatch');

        // if($this->input->post('user_password') != $this->input->post('confirm_user_password')){
            
        // }
        if ($this->form_validation->run() == FALSE) {
            // Validation failed, reload the form
            $this->register();
         
        } else {
            // Validation passed, proceed to data saving
             $user_reg = array(
                'FIRST_NAME' => $this->input->post('first_name') ,
                'EMAIL' => $this->input->post('user_email'),
                'PASSWORD' => cryptPassowrd($this->input->post('user_password')),
                'MOBILE_NO' => $this->input->post('mobile_no'),
                'CNIC_NO' => $this->input->post('cnic_no')
            );
            $alumni = array('ROLL_NO' => $this->input->post('roll_no'),
                'DEPT_ID' => $this->input->post('department'),
                'OCCUPATION' => $this->input->post('occupation'),
                'ORGANIZATION' => $this->input->post('organization')
                );
            $data= array("users_reg"=>$user_reg,"alumni"=>$alumni);
            // Save data using the model
            $result = $this->Website_model->saveAlumni($data);
            if($result['STATUS']==200){
                //redirect(base_url("Alumni/register"));
                $this->session->set_flashdata('ALERT_MSG', array("TYPE"=>"SUCCESS","MSG"=>$result['MESSAGE']));
            }else{
                $this->session->set_flashdata('ALERT_MSG', array("TYPE"=>"ERROR","MSG"=>$result['MESSAGE']));
            }
           // prePrint($result);
             redirect(base_url("Alumni/register"));
             exit();
            
        }
    }
}
    
    ?>