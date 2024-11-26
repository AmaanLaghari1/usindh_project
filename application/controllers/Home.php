<?php
/**
 * Created by PhpStorm.
 * User: Irfan Rajput
 * Date: 7/10/2020
 * Time: 9:42 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');
require "BaseController.php";


class Home extends BaseController {
    /**
     * Login constructor.
     */

    private $SelfController = 'home';


    public function __construct()
    {
        parent::__construct();


    }
    
    function setPassword(){
       $get_request = $this->input->get('researcher');
            // $user_id = $get_request['researcher'];
            // echo $user_id;
            $id_encoded = preg_replace('/\s+/', '+', $get_request);
            // echo $user_id
            $user_id = $this->encryption->decrypt($id_encoded);
            echo $user_id;
            
            $user_id = $this->encryption->encrypt($user_id);
            // prePrint( $user_id);
            // prePrint( $get_request);
            echo "<a href='https://oric.usindh.edu.pk/research/researchers/profile?researcher=$user_id'>clikc</a>";
      
    }
    function faculty($id){
        $faculty =  $this->Website_model->getFacultyByID($id);
        if($faculty) {
            $id = $faculty['FAC_ID'];
            $institutes =  $this->Website_model->getDepartmentByCondition("d.FAC_ID = $id AND d.IS_INST = 'Y' AND d.IS_ADMIN = 0 ");
            $departments =  $this->Website_model->getDepartmentByCondition("d.FAC_ID = $id AND d.IS_INST = 'N' AND d.IS_ADMIN = 0 ");
            $centers =  $this->Website_model->getDepartmentByCondition("d.FAC_ID = $id AND d.IS_INST = 'C' AND d.IS_ADMIN = 0 ");
            $footer= $this->Website_model->getFooterByCondition("  p.DEPT_ID = 0 ",1);
                    if(count($footer)>0){
                        $footer = $footer[0];
                        $footer = urldecode($footer['DETAIL']);
                        $footer = str_replace('<?=base_url()?>',base_url(),$footer);
                        $data['footer'] =  $footer ;
                    }else{
                        $data['footer'] = null;
                    }
            $data['sliders'] = $this->Sliders_model->getCarousel($id);

            $data['faculty'] = $faculty;
            $data['institutes'] = $institutes;
            $data['departments'] = $departments;
            $data['centers'] = $centers;


            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('faculty', $data);
            $this->load->view('includes/footer', $data);
            $this->load->view('includes/footer_link', $data);
        }else{
            exit("Invalid ID");
        }
    }
    
    function faculty_about($id){
        $faculty =  $this->Website_model->getFacultyByID($id);
        if($faculty) {
            $id = $faculty['FAC_ID'];
            $institutes =  $this->Website_model->getDepartmentByCondition("d.FAC_ID = $id AND d.IS_INST = 'Y' AND d.IS_ADMIN = 0");
            $departments =  $this->Website_model->getDepartmentByCondition("d.FAC_ID = $id AND d.IS_INST = 'N' AND d.IS_ADMIN = 0");
            $footer= $this->Website_model->getFooterByCondition("  p.DEPT_ID = 0 ",1);
                    if(count($footer)>0){
                        $footer = $footer[0];
                        $footer = urldecode($footer['DETAIL']);
                        $footer = str_replace('<?=base_url()?>',base_url(),$footer);
                        $data['footer'] =  $footer ;
                    }else{
                        $data['footer'] = null;
                    }
            $data['sliders'] = $this->Sliders_model->getCarousel($id);

            $data['faculty'] = $faculty;
            $data['institutes'] = $institutes;
            $data['departments'] = $departments;


            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('faculty_about', $data);
            $this->load->view('includes/footer', $data);
            $this->load->view('includes/footer_link', $data);
        }else{
            exit("Invalid ID");
        }
    }
    
    function faculty_message($id){
        $faculty =  $this->Website_model->getFacultyByID($id);
        if($faculty) {
            $id = $faculty['FAC_ID'];
            $institutes =  $this->Website_model->getDepartmentByCondition("d.FAC_ID = $id AND d.IS_INST = 'Y' AND d.IS_ADMIN = 0");
            $departments =  $this->Website_model->getDepartmentByCondition("d.FAC_ID = $id AND d.IS_INST = 'N' AND d.IS_ADMIN = 0");
            $footer= $this->Website_model->getFooterByCondition("  p.DEPT_ID = 0 ",1);
                    if(count($footer)>0){
                        $footer = $footer[0];
                        $footer = urldecode($footer['DETAIL']);
                        $footer = str_replace('<?=base_url()?>',base_url(),$footer);
                        $data['footer'] =  $footer ;
                    }else{
                        $data['footer'] = null;
                    }
            $data['sliders'] = $this->Sliders_model->getCarousel($id);

            $data['faculty'] = $faculty;
            $data['institutes'] = $institutes;
            $data['departments'] = $departments;


            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('faculty_message', $data);
            $this->load->view('includes/footer', $data);
            $this->load->view('includes/footer_link', $data);
        }else{
            exit("Invalid ID");
        }
    }

    function faculty_mission($id){
        $faculty =  $this->Website_model->getFacultyByID($id);
        if($faculty) {
            $id = $faculty['FAC_ID'];
            $institutes =  $this->Website_model->getDepartmentByCondition("d.FAC_ID = $id AND d.IS_INST = 'Y' AND d.IS_ADMIN = 0");
            $departments =  $this->Website_model->getDepartmentByCondition("d.FAC_ID = $id AND d.IS_INST = 'N' AND d.IS_ADMIN = 0");
            $footer= $this->Website_model->getFooterByCondition("  p.DEPT_ID = 0 ",1);
                    if(count($footer)>0){
                        $footer = $footer[0];
                        $footer = urldecode($footer['DETAIL']);
                        $footer = str_replace('<?=base_url()?>',base_url(),$footer);
                        $data['footer'] =  $footer ;
                    }else{
                        $data['footer'] = null;
                    }
            $data['sliders'] = $this->Sliders_model->getCarousel($id);

            $data['faculty'] = $faculty;
            $data['institutes'] = $institutes;
            $data['departments'] = $departments;


            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('faculty_mission', $data);
            $this->load->view('includes/footer', $data);
            $this->load->view('includes/footer_link', $data);
        }else{
            exit("Invalid ID");
        }
    }

    function institute($id){
        if(is_numeric($id)){

        }else{
            exit("Invalid ID");
        }
        $data = $this->department_helper($id);



        $this->load->view('includes/header',$data);
        $this->load->view('includes/navbar',$data );
        $this->load->view('department',$data);
        $this->load->view('includes/footer',$data);
        $this->load->view('includes/footer_link',$data);
    }



    function dept_about($id){
        $data = $this->department_helper($id);
        $this->load->view('includes/header',$data);
        $this->load->view('includes/navbar',$data );
        $this->load->view('department_about',$data);
        $this->load->view('includes/footer',$data);
        $this->load->view('includes/footer_link',$data);
    }

    function dept_mission($id){
        $data = $this->department_helper($id);

        $this->load->view('includes/header',$data);
        $this->load->view('includes/navbar',$data );
        $this->load->view('department_mission',$data);
        $this->load->view('includes/footer',$data);
        $this->load->view('includes/footer_link',$data);
    }

    function dept_message($id){

        $data = $this->department_helper($id);

        $this->load->view('includes/header',$data);
        $this->load->view('includes/navbar',$data );
        $this->load->view('department_message',$data);
        $this->load->view('includes/footer',$data);
        $this->load->view('includes/footer_link',$data);
    }

    function department($id){

        $data = $this->department_helper($id);
       // $fm = postCURL(ITSC_BASE_URL."request-receive/responseITSC.php", array("request"=>"getFacultyMemberByDeptID","dept_id"=>$id,"is_random"=>"Y","limit"=>"4"));
        $fm = null;
        if(isset($fm['response'])){
            $data['faculty_members'] =json_decode($fm['response'],true);
        }else{
            $data['faculty_members'] = array();
        }



        $this->load->view('includes/header',$data);
        $this->load->view('includes/navbar',$data );
        $this->load->view('department',$data);
        $this->load->view('includes/footer',$data);
        $this->load->view('includes/footer_link',$data);
    }

    function program($program_id){
        $data = postCURL(EXAM_BASE_URL."getProgram.php?prog_id=$program_id",array(),"GET");

        if($data['response_code']==200){
            $data = json_decode($data['response'],true);
            // prePrint($data);
            // exit();
            $dept_id =  $data[0]['DEPT_ID'];
            $program_title = $data[0]['PROGRAM_TITLE'];
            $degree_title = $data[0]['DEGREE_TITLE'];
        }else{
            exit("Rest API not working..!");
        }
        if(is_numeric($dept_id)){

        }else{
            exit("Invalid ID");
        }

        $data = $this->department_helper($dept_id);



        $data['degree_title'] = $degree_title;
        $data['program_title'] = $program_title;
        $data['program_id'] = $program_id;



        $this->load->view('includes/header',$data);
        $this->load->view('includes/navbar',$data );
        $this->load->view('programs',$data);
        $this->load->view('includes/footer',$data);
        $this->load->view('includes/footer_link',$data);
    }

    function index($website_url="usindh"){
        $website_obj =  $this->Website_model->getWebsiteByUrl($website_url);
        $faculty =  $this->Website_model->getFaculty(0,1);
        $data['sliders'] =$this->Sliders_model->getCarousel();
        $footer= $this->Website_model->getFooterByCondition(" p.DEPT_ID = 0 ",1);
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
        $this->load->view('home',$data);
        $this->load->view('includes/footer',$data);
        $this->load->view('includes/footer_link',$data);

    }

    function about($website_url="usindh"){
        $website_obj =  $this->Website_model->getWebsiteByUrl($website_url);
        $data['sliders'] =$this->Sliders_model->getCarousel();
        $data['navbar_list']  =  $this->Configuration_model->get_actual_navbar_by_website_url(0);
        $footer= $this->Website_model->getFooterByCondition("  p.DEPT_ID = 0 ",1);
                    if(count($footer)>0){
                        $footer = $footer[0];
                        $footer = urldecode($footer['DETAIL']);
                        $footer = str_replace('<?=base_url()?>',base_url(),$footer);
                        $data['footer'] =  $footer ;
                    }else{
                        $data['footer'] = null;
                    }
        $pop_message = $marquee = "";

        $data['marquee'] = $marquee;
        $data['pop_message'] = $pop_message;
        $data['website_obj'] = $website_obj;



        $this->load->view('includes/header',$data);
        $this->load->view('includes/navbar',$data );
        $this->load->view('about',$data);
        $this->load->view('includes/footer',$data);
        $this->load->view('includes/footer_link',$data);

    }
    function mission($website_url="usindh"){
        $website_obj =  $this->Website_model->getWebsiteByUrl($website_url);
        $data['sliders'] =$this->Sliders_model->getCarousel();
        $data['navbar_list']  =  $this->Configuration_model->get_actual_navbar_by_website_url($website_url);
        $footer= $this->Website_model->getFooterByCondition("  p.DEPT_ID = 0 ",1);
                    if(count($footer)>0){
                        $footer = $footer[0];
                        $footer = urldecode($footer['DETAIL']);
                        $footer = str_replace('<?=base_url()?>',base_url(),$footer);
                        $data['footer'] =  $footer ;
                    }else{
                        $data['footer'] = null;
                    }
        $pop_message = $marquee = "";


        $data['marquee'] = $marquee;
        $data['pop_message'] = $pop_message;
        $data['website_obj'] = $website_obj;



        $this->load->view('includes/header',$data);
        $this->load->view('includes/navbar',$data );
        $this->load->view('mission',$data);
        $this->load->view('includes/footer',$data);
        $this->load->view('includes/footer_link',$data);

    }
    function news(){
        $website_url="usindh";
        $configurations = $this->Configuration_model->getConfiguration(0,0);
        $data['sliders'] =$this->Sliders_model->getCarousel();
        $data['posts'] =$this->Post_model->getPosts(12);
        $data['categories'] =$this->Post_model->getCategories();
        $pop_message = $marquee = "";
        foreach($configurations as $config){

            if($config['DESCRIPTION']=="MARQUEE_MSG" && $config['ACTIVE']==1){
                $marquee= $config['VALUE'];


            }else if($config['DESCRIPTION']=="POP_MESSAGE"  && $config['ACTIVE']==1){
                $pop_message  = $config['VALUE'];
            }
        }
        $data['marquee'] = $marquee;
        $data['pop_message'] = $pop_message;
        $header_data['page_title']='University Of Sindh Jamshoro';


        $nav_data['navbar_list']  =  $this->Configuration_model->get_actual_navbar_by_website_url($website_url);
        //$nav_data['header_component'] = $header_component;

        $this->load->view('includes/header',$header_data);
        $this->load->view('includes/navbar',$nav_data);
        $this->load->view('news',$data);
        $this->load->view('includes/footer');
        $this->load->view('includes/footer_link');
    }

    function post($post_id){
        $website_url = "home";
        $data['sliders'] =$this->Sliders_model->getCarousel();
        $data['post'] =$this->Post_model->getPostById($post_id);
        $data['posts'] =$this->Post_model->getPosts(4);
        $data['categories'] =$this->Post_model->getCategories();

        $header_data['page_title']='University Of Sindh Jamshoro';


        $nav_data['navbar_list']  =  $this->Configuration_model->get_actual_navbar_by_website_url($website_url);
        //$nav_data['header_component'] = $header_component;

        $this->load->view('includes/header',$header_data);
        $this->load->view('includes/navbar',$nav_data);
        $this->load->view('single_news',$data);
        $this->load->view('includes/footer');
        $this->load->view('includes/footer_link');
    }

    function page($id){
        if(is_numeric($id)){
            $pages = $this->Website_model->getPageByCondition("p.PAGE_ID = $id");
            if(count($pages)==1){
                $page = $pages[0];
                $dept_id = $page['DEPT_ID'];

                if($dept_id>0){
                    $data = $this->department_helper($dept_id);
                }else
                {
                    $website_url ="usindh";
                    $website_obj =  $this->Website_model->getWebsiteByUrl($website_url);
                    $faculty =  $this->Website_model->getFaculty(0,1);
                    $data['sliders'] =$this->Sliders_model->getCarousel();
                    $data['navbar_list']  =  $this->Configuration_model->get_actual_navbar_by_website_url(0);
                     $footer= $this->Website_model->getFooterByCondition("  p.DEPT_ID = 0 ",1);
                    if(count($footer)>0){
                        $footer = $footer[0];
                        $footer = urldecode($footer['DETAIL']);
                        $footer = str_replace('<?=base_url()?>',base_url(),$footer);
                        $data['footer'] =  $footer ;
                    }else{
                        $data['footer'] = null;
                    }
                    $pop_message = $marquee = "";
                    $data['marquee'] = $marquee;
                    $data['fac'] = $faculty;
                    $data['pop_message'] = null;
                    $data['website_obj'] = $website_obj;

                }

            }else{
                exit("page id invalid");
            }
        }else{
            exit("Invalid ID");
        }
        $file_path = "./application/views/component/component.txt";
   
        
        $list_of_component = file_get_contents($file_path);
        $list_of_component = json_decode($list_of_component,true);
        $data['page'] = $page;
        $data['list_of_component'] = $list_of_component;
        $this->load->view('includes/header',$data);
        $this->load->view('includes/navbar',$data );
        $this->load->view('page',$data);
        $this->load->view('includes/footer',$data);
        $this->load->view('includes/footer_link',$data);
    }

    function logout(){

        $this->session->sess_destroy();

        redirect(base_url(),'refresh');
    }

    private function department_helper($id){
        $this->programs = array();
        $this->departments = array();
        if(isValidData($id)){
            $this->deparment = $this->Website_model->getDepartmentByID($id,0);
            $id = $this->deparment ['DEPT_ID'];
            if($this->deparment) {
                if ($this->deparment['IS_INST'] == 'Y') {
                    $key = 'inst_id';
                    $this->departments =  $this->Website_model->getDepartmentByCondition("d.INST_ID = $id AND d.IS_INST = 'N' ");

                } else {
                    $key = 'depId';
                }
                if($id==254){
                   $key = 'depId'; 
                }
                $url =EXAM_BASE_URL."getProgram.php?$key=$id&type=json";
                $d = postCURL($url, array(), "GET");
                // if(isset($_GET['user'])&&$_GET['user']=="K"){
                // prePrint($url);
                // prePrint($d);  
                // exit();
                // }
                
                if ($d['response_code'] == 200) {
                    $this->programs = json_decode($d['response'], true);
                }
            }else{
                exit("Invalid ID");
            }

        }else{
            exit("Invalid ID");
        }
        $data['navbar_list']   =  $this->Configuration_model->get_actual_navbar_by_website_url($id);

        $data['rnd'] = $this->Website_model->getPageByCondition("p.DEPT_ID = $id AND p.IS_RND = 1");
        $data['pages'] = $this->Website_model->getPageByCondition("p.DEPT_ID = $id AND p.IS_RND = 0 ");
        $data['sliders'] = $this->Sliders_model->getCarousel($id);
         $footer= $this->Website_model->getFooterByCondition(" p.DEPT_ID = $id OR p.DEPT_ID = 0 ORDER BY p.DEPT_ID DESC ",1);
        if(count($footer)>0){
            $footer = $footer[0];
            $footer = urldecode($footer['DETAIL']);
            $footer = str_replace('<?=base_url()?>',base_url(),$footer);
            $data['footer'] =  $footer ;
        }else{
            $data['footer'] = null;
        }

        $data['department'] = $this->deparment;
        $data['departments'] = $this->departments;
        $data['programs'] = $this->programs;

        return $data;

    }

    public function faculty_members($id){

        $data = $this->department_helper($id);
        $id = $this->deparment['DEPT_ID'];
      //  $fm = postCURL(ITSC_BASE_URL."request-receive/responseITSC.php", array("request"=>"getFacultyMemberByDeptID","dept_id"=>$id));
        $fm = postCURL(ITSC_BASE_URL."request-receive/responseITSC.php", array("request"=>"getFacultyMemberByDeptID","dept_id"=>$id));
        if(isset($fm['response'])){
            $faculty_members  =json_decode($fm['response'],true);
            //prePrint($faculty_members);
            //exit();
            if($faculty_members!="NUll"){
                $user_ids = implode(",", array_column($faculty_members, 'USER_ID'));
    
                $result = $this->Member_model->getMembersByIds($user_ids);
                //  prePrint($result);
                foreach($faculty_members as $k=>$faculty_member){
    
                    foreach ($result as $row){
                        if($row['MEMBER_ID']==$faculty_member['USER_ID']){
                            $faculty_members[$k]['FLAG'] = $row['ACTIVATE'];
                            
                            $faculty_members[$k]['ORDER_NO'] = $row['PREFIX_ID'];
                        }
                    }
                    if(!isset($faculty_members[$k]['FLAG'])){
                        $faculty_members[$k]['FLAG'] = 0;
                    }
    
                }
            }else{
                $faculty_members = array();
            }
        }else{
            $faculty_members = array();
            
        }
        $faculty_members = quicksort($faculty_members,"ORDER_NO");
        $data['faculty_members'] = $faculty_members;
        $data['id'] = $id;


        $this->load->view('includes/header',$data);
        $this->load->view('includes/navbar',$data );
        $this->load->view('faculty_members',$data);
        $this->load->view('includes/footer',$data);
        $this->load->view('includes/footer_link',$data);
    }
  public function faculty_member_detail($id){

        $data = $this->department_helper($id);
         $get_request = $this->input->get('researcher');
         
        $data['key'] = $get_request;
        $this->load->view('includes/header',$data);
        $this->load->view('includes/navbar',$data );
        $this->load->view('faculty_member_detail',$data);
        $this->load->view('includes/footer',$data);
        $this->load->view('includes/footer_link',$data);
    }
   
    public function colleges(){
        $this->load->model('Colleges_model');
        $data['result'] = $this->Colleges_model->get_data();
        
        // $this->load->model('Programs_model');
        // $data['programs'] = $this->Programs_model->get();
   
        // $collegeId = $this->input->post('COLLEGE_ID');
        // $this->load->model('Programs_model');
        // $programs = $this->Programs_model->getProgramsByCollegeId($collegeId);
    
       
       
       
        $website_url="usindh";
        $website_obj =  $this->Website_model->getWebsiteByUrl($website_url);
        $faculty =  $this->Website_model->getFaculty(0,1);
        $data['sliders'] =$this->Sliders_model->getCarousel();
        
        $footer= $this->Website_model->getFooterByCondition(" p.DEPT_ID = 0 ",1);
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
        $this->load->view('colleges',$data);
        $this->load->view('includes/footer',$data);
        $this->load->view('includes/footer_link',$data);
    
    }
    function college_prog(){
          $collegeId = $this->input->get('id');
        $this->load->model('Programs_model');
        $programs = $this->Programs_model->getProgramsByCollegeId($collegeId);
        $data['programs']=$programs;
         $website_url="usindh";
        $website_obj =  $this->Website_model->getWebsiteByUrl($website_url);
        $faculty =  $this->Website_model->getFaculty(0,1);
        $data['sliders'] =$this->Sliders_model->getCarousel();
        
        $footer= $this->Website_model->getFooterByCondition(" p.DEPT_ID = 0 ",1);
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
        $this->load->view('colleges_prog',$data);
        $this->load->view('includes/footer',$data);
        $this->load->view('includes/footer_link',$data);
    }


	public function email_request(){
		$website_url="usindh";
		$website_obj =  $this->Website_model->getWebsiteByUrl($website_url);
		$faculty =  $this->Website_model->getFaculty(0,1);
		$data['sliders'] =$this->Sliders_model->getCarousel();
		$data['departments'] = $this->Department_model->get();
		$footer= $this->Website_model->getFooterByCondition(" p.DEPT_ID = 0 ",1);
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


		$this->load->view('includes/header',$data);
		$this->load->view('includes/navbar',$data );
		$this->load->view('email_request',$data);
		$this->load->view('includes/footer',$data);
		$this->load->view('includes/footer_link',$data);

	}

	public function email_verify(){
		$website_url="usindh";
		$website_obj =  $this->Website_model->getWebsiteByUrl($website_url);
		$faculty =  $this->Website_model->getFaculty(0,1);
		$data['sliders'] =$this->Sliders_model->getCarousel();
		$data['departments'] = $this->Department_model->get();
		$footer= $this->Website_model->getFooterByCondition(" p.DEPT_ID = 0 ",1);
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


		$this->load->view('includes/header',$data);
		$this->load->view('includes/navbar',$data );
		$this->load->view('email_verify',$data);
		$this->load->view('includes/footer',$data);
		$this->load->view('includes/footer_link',$data);

	}

	public function verifyOTP() {
		$input_otp = $this->input->post('otp_input');
		$stored_otp = $this->session->userdata('otp_code');
		$expiry = $this->session->userdata('otp_expiry');

		// Ensure all necessary data exists
		if (!$stored_otp || !$expiry) {
			$this->session->set_flashdata('response', array(
				'type' => 'danger',
				'message' => 'OTP not found or expired.',
				'title' => 'Failed'
			));
			return redirect('email_verify');
		}

		// Use current timestamp to check expiry
		$current_time = time();
		if ($current_time > $expiry) {
			// OTP has expired
			$this->session->unset_userdata('otp_code');
			$this->session->unset_userdata('otp_expiry');
			$this->session->set_flashdata('response', array(
				'type' => 'danger',
				'message' => 'OTP has expired. Please request a new one.',
				'title' => 'Failed'
			));
			return redirect('email_verify');
		}

		// Validate the OTP
		if ($input_otp == $stored_otp) {
			// OTP is correct, proceed with your logic
			$this->session->unset_userdata('otp_code');
			$this->session->unset_userdata('otp_expiry');

			// Retrieve request data from the cookie
			$emailRequestData = get_cookie('email_request_data');
			if ($this->EmailRequest_model->create(json_decode($emailRequestData))) {
				$this->session->set_flashdata('response', array(
					'type' => 'success',
					'message' => 'Application submitted successfully.',
					'title' => 'Done'
				));
				return redirect('email_request');
			}
		} else {
			// OTP is incorrect
			$this->session->set_flashdata('response', array(
				'type' => 'danger',
				'message' => 'Invalid OTP. Please try again.',
				'title' => 'Failed'
			));
			return redirect('email_verify');
		}
	}

	public function emailRequestSendOTP(){
		$code = rand(1000, 9999);
		$expiry = time() + 30;
		$this->session->set_userdata('otp_code', $code);
		$this->session->set_userdata('otp_expiry', $expiry);
	}
	private function uploadImage($file)
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg';
		$config['max_size'] = 2048;
		$config['max_width'] = 1024;
		$config['max_height'] = 768;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		// Do the upload
		if (!$this->upload->do_upload('applicant_picture')) {
			// Return error message if upload fails
			$this->session->set_flashdata('response',
				array(
					'title' => 'Failed',
					'message' => $this->upload->display_errors(),
					'type' => 'danger'
				)
				);
			return redirect('email_request');
		} else {
			// Get file data if upload is successful
			$fileData = $this->upload->data();
			return $fileData;
		}
	}

	public function emailRequestSave(){
		$this->session->set_flashdata('old', $this->input->post());
		$role = $this->input->post('user_role');

		$data = array(
			'ROLE' => $role,
			'EMAIL' => $this->input->post('email'),
			'CNIC_NO' => $this->input->post('cnic_no'),
			'CNIC_EXPIRY' => $this->input->post('cnic_expiry'),
			'FIRST_NAME' => $this->input->post('first_name'),
			'LAST_NAME' => $this->input->post('last_name'),
			'DEPARTMENT' => $this->input->post('department'),
			'DATE_OF_BIRTH' => $this->input->post('date_of_birth'),
			'RESEARCH_AREA' => $this->input->post('research_area'),
			'MOBILE_PHONE' => $this->input->post('mobile_phone'),
			'WHATSAPP_NO' => $this->input->post('whatsapp_no'),
			'ADDRESS' => $this->input->post('address'),
			'CITY' => $this->input->post('city'),
			'PROVINCE' => $this->input->post('province'),
			'POSTAL_CODE' => $this->input->post('postal_code'),
			'REQUEST_STATUS_ID' => 1
		);

		if($role == 1){
			$data['STUDENT_ID'] = $this->input->post('roll_no');
			$data['DEGREE_PROGRAM'] = $this->input->post('degree_program');
			$data['EDUCATION_LEVEL'] = $this->input->post('education_level');
			$data['ADDITIONAL_QUALIFICATION'] = $this->input->post('additional_qualification');
		}
		else {
			$data['STAFF_OR_FACULTY_ID'] = $this->input->post('staff_or_faculty_id');
			$data['OFFICE_PHONE'] = $this->input->post('office_phone');
			$data['DATE_OF_APPOINTMENT'] = $this->input->post('date_of_appointment');
			$data['ADDITIONAL_CHARGE'] = $this->input->post('additional_charge');
		}

		if($this->EmailRequest_model->ifExists('EMAIL', $this->input->post('email'))){
			$this->session->set_flashdata('response', array(
				'type' => 'danger',
				'message' => 'Email already exists',
				'title' => 'Failed'
			));
			return redirect('email_request');
		}
		else {
			$this->session->set_userdata('isVerified', FALSE);
		}

		if($this->EmailRequest_model->ifExists('CNIC_NO', $this->input->post('cnic_no'))){
			$this->session->set_flashdata('response', array(
				'type' => 'danger',
				'message' => 'CNIC already exists',
				'title' => 'Failed'
			));
			return redirect('email_request');
		}

		$image = $_FILES['applicant_picture'];
		$file = $this->uploadImage($image);

		if(is_array($file)){
			$data['APPLICANT_PICTURE'] = $file['file_name'];
		}

		set_cookie('email_request_data', json_encode($data), 3600);

		$this->emailRequestSendOTP();

		return redirect('email_verify');

//		if($this->EmailRequest_model->create($data)){
//			$this->session->set_flashdata('response', array(
//				'type' => 'success',
//				'message' => 'application submitted successfully',
//				'title' => 'Done'
//			));
//			return redirect('email_request');
//		}
	}



}
