<?php
/**
 * Created by PhpStorm.
 * User: Kashif Shaikh
 * Date: 7/10/2020
 * Time: 10:54 PM
 */

class User_model extends CI_model
{
    function __construct()
    {
        parent::__construct();


    }
   // function getUsers(){
        // $this->db->where("PASSWORD_TOKEN IS NOT NULL");
        // $data =  $this->db->get('users_reg')->result_array();
        
        // foreach($data as $row){
        //     $password = cryptPassowrd($row['PASSWORD_TOKEN']);
        //   $this->db->where("USER_ID ",$row['USER_ID']);
        //   $this->db->set("PASSWORD",$password);
        //   $this->db->update('users_reg');
        // }


  //  }


    function getUserFullDetailById($user_id){
        $user_reg  = $this->getUserById($user_id);
        return array("users_reg"=>$user_reg);


    }

    function getUserByCnicAndPassword($cnic,$password){
        $this->db->where('CNIC_NO',$cnic);
        $this->db->where('PASSWORD',$password);
        $user = $this->db->get('users_reg')->row_array();
        return $user;

    }
    function getUserByPassportAndPassword($passport,$password){
        $this->db->where('PASSPORT_NO',$passport);
        $this->db->where('PASSWORD',$password);
        $user = $this->db->get('users_reg')->row_array();
        return $user;

    }
    function getUserByCnic($cnic){
        $this->db->where('CNIC_NO',$cnic);
        $user = $this->db->get('users_reg')->row_array();
        return $user;

    }
    function getUserByCnicLegacyDb($cnic){
        $this->db->where('CNIC_NO',$cnic);
        $user = $this->db->get('users_reg')->row_array();
        return $user;

    }
    function getUserByUserIdLegacyDb($user_id){
        $this->db->where('USER_ID',$user_id);
        $user = $this->db->get('users_reg')->row_array();
        return $user;

    }
    function getUserByPassportNo($passport_no){
        $this->db->where('PASSPORT_NO',$passport_no);
        $user = $this->db->get('users_reg')->row_array();
        return $user;

    }
    /*	function getUserById($user_id){
            $this->db->select("*,ur.REMARKS");
            $this->db->from("users_reg ur");
            $this->db->join('districts AS d', 'ur.DISTRICT_ID = d.DISTRICT_ID');
            $this->db->where('USER_ID',$user_id);

            $user = $this->db->get()->row_array();
            return $user;

        }

    */
//this is method updated 5-nov-2020
    function getUserById($user_id){
        $this->db->select("*");
        $this->db->from("users_reg ur");
        $this->db->where('USER_ID',$user_id);

        $user = $this->db->get()->row_array();
        return $user;

    }
     function getUsers(){
        $this->db->select("*");
        $this->db->from("users_reg ur");
      //  $this->db->where('USER_ID',$user_id);

        $user = $this->db->get()->result_array();
        return $user;

    }
    function getUserByIdForAdmin($user_id){
        $this->db->select("*,ur.REMARKS");
        $this->db->from("users_reg ur");
        $this->db->where('USER_ID',$user_id);

        $user = $this->db->get()->row_array();
        return $user;

    }
    function getUserByIdWithProfilePhoto($user_id){
        $this->db->select("*,ur.REMARKS");
        $this->db->from("users_reg ur");
        $this->db->join('districts AS d', 'ur.DISTRICT_ID = d.DISTRICT_ID');
        $this->db->join('provinces AS p', 'p.PROVINCE_ID = d.PROVINCE_ID');
        $this->db->join('countries AS c', 'c.COUNTRY_ID = p.COUNTRY_ID');
        $this->db->join('profile_photo AS pp', 'pp.USER_ID = ur.USER_ID');


        $this->db->where('ur.USER_ID',$user_id);

        $user = $this->db->get()->row_array();
        //echo $this->db->last_query();
        //exit();
        return $user;

    }
    // JOIN QUERY TO GET USER ROLE FROM ROLE AND ROLE_RELATION TABLE
    // SELECT r.`ROLE_NAME`,r.`ACTIVE`, rr.`USER_ID`, r.`KEYWORD` from role r, role_relation rr where rr.USER_ID=93774 AND r.ROLE_ID=rr.ROLE_ID
    function getUserRoleByUserId($user_id,$role_id=0){
           $this->db->select('r.ROLE_ID, rr.R_R_ID, r.`ROLE_NAME`,r.`ACTIVE`, rr.`USER_ID`, r.`KEYWORD`,r.DEPT_ID,rr.ACTIVE as IS_ACTIVE');
        $this->db->from('role_relation rr');
        $this->db->join('role AS r', 'rr.ROLE_ID = r.ROLE_ID');
        $this->db->where('rr.USER_ID',$user_id);
        if($role_id>0){
        $this->db->where('r.ROLE_ID',$role_id);    
        }
        $this->db->where('r.ACTIVE','1');
     //   $this->db->where('rr.ACTIVE','1');
        $user = $this->db->get()->result_array();
        return $user;

        //echo $this->db->last_query();
//        return $user;

    }
     public function updateUserRoles($user_id,$role_id,$status){

  
        $this->db->trans_start();
        $this->db->where(array("USER_ID"=>$user_id,"ROLE_ID"=>$role_id));
        $this->db->update('role_relation', array('ACTIVE' => $status));

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            return true;
        }
    }
    function addUserRoles($user_id,$role_id){
         $this->db->trans_start();
        $data =  array("USER_ID"=>$user_id,'ROLE_ID'=>$role_id,"ACTIVE"=>1);
        $this->db->insert('role_relation', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            return true;
        }
    }
    function getRoles(){
        $this->db->from('role');
        $roles = $this->db->get()->result_array();
        return $roles;
    }
    function getUserAdmissionRoleByUserId($user_id){

        $this->db->select('r.ROLE_ID, rr.R_R_ID, r.`ROLE_NAME`,r.`ACTIVE`, rr.`USER_ID`, r.`KEYWORD`,r.DEPT_ID');
        $this->db->from('role_relation rr');
        $this->db->join('role AS r', 'rr.ROLE_ID = r.ROLE_ID');
        $this->db->where('rr.USER_ID',$user_id);
//		$this->db->where('r.KEYWORD','UG_A');
        $this->db->where('r.ACTIVE','1');
        $user = $this->db->get()->result_array();
        return $user;
    }

    function getQulificatinByUserId($user_id){
        $this->db->select('q.*,d.DEGREE_ID,p.DEGREE_TITLE,d.DISCIPLINE_NAME,o.INSTITUTE_NAME ORGANIZATION');
        $this->db->from('qualifications q');
        //$this->db->join('institute AS i', 'q.INSTITUTE_ID = i.INSTITUTE_ID');
        $this->db->join('institute AS o', 'q.ORGANIZATION_ID = o.INSTITUTE_ID');
        $this->db->join('discipline AS d', 'q.DISCIPLINE_ID = d.DISCIPLINE_ID');
        $this->db->join('degree_program AS p', 'd.DEGREE_ID = p.DEGREE_ID');
        $this->db->where('q.USER_ID',$user_id);
        $this->db->where('q.ACTIVE',1);
        $this->db->order_by('p.DEGREE_ID', 'DESC');
//        $this->db->select('*');
//        $this->db->from('qualifications q');
//        $this->db->join('institute AS i', 'q.INSTITUTE_ID = i.INSTITUTE_ID');
//        $this->db->join('institute AS o', 'q.ORGANIZATION_ID = o.INSTITUTE_ID');
//        $this->db->join('discipline AS d', 'q.DISCIPLINE_ID = d.DISCIPLINE_ID');
//        $this->db->join('degree_program AS p', 'd.DEGREE_ID = p.DEGREE_ID');
//        $this->db->where('q.USER_ID',$user_id);
//        $this->db->where('q.ACTIVE',1);
//        $this->db->order_by('p.DEGREE_ID', 'DESC');
        $qulification_list = $this->db->get()->result_array();
        return $qulification_list;

    }

    function getQulificatinByUserID_DEGREE_ID($user_id,$degree_id){
        $this->db->select('q.*,d.DEGREE_ID,p.DEGREE_TITLE,d.DISCIPLINE_NAME,i.INSTITUTE_NAME INSTITUTE,o.INSTITUTE_NAME ORGANIZATION');
        $this->db->from('qualifications q');
        $this->db->join('institute AS i', 'q.INSTITUTE_ID = i.INSTITUTE_ID');
        $this->db->join('institute AS o', 'q.ORGANIZATION_ID = o.INSTITUTE_ID');
        $this->db->join('discipline AS d', 'q.DISCIPLINE_ID = d.DISCIPLINE_ID');
        $this->db->join('degree_program AS p', 'd.DEGREE_ID = p.DEGREE_ID');
        $this->db->where('q.USER_ID',$user_id);
        $this->db->where('d.DEGREE_ID',$degree_id);
        $this->db->where('q.ACTIVE',1);
        $this->db->order_by('p.DEGREE_ID', 'DESC');
        $qulification_list = $this->db->get()->result_array();
        return $qulification_list;

    }



    function changePasswordByCNIC($cnic,$password){
        $formArray = array('PASSWORD'=>$password);
        $this->db->trans_begin();
       

        $this->db->where('CNIC_NO',$cnic);
        $this->db->update('users_reg',$formArray);


        if($this->db->affected_rows() ==1){
            $this->db->trans_commit();
            //	$this->db->trans_commit();
            return true;
        }else{
            $this->db->trans_rollback();
            //		$this->db->trans_rollback();
            return false;
        }
    }

    function resetPassword($user_id,$password){
        //load loging model
        $this->load->model('log_model');
        $this->db->where('USER_ID',$user_id);
        $PRE_RECORD =  $this->db->get('users_reg')->row_array();


        $formArray = array('PASSWORD'=>$password,'PASSWORD_TOKEN'=>'');
        $this->db->trans_begin();
        //$this->db->trans_begin();
        // $this->db->where('PASSWORD',$curr_password);
        $this->db->where('USER_ID',$user_id);
        $this->db->update('users_reg',$formArray);
        //$this->db->where('USER_ID',$user_id);
        //$this->db->update('users_reg',$formArray);

        //this code is use for loging
        $QUERY = $this->db->last_query();

        if($this->db->affected_rows() ==1){
            $this->db->trans_commit();
            //$this->db->trans_commit();
            //this code is use for loging
            $this->db->where('USER_ID',$user_id);
            $CURRENT_RECORD =  $this->db->get('users_reg')->row_array();
            $this->log_model->create_log($user_id,$user_id,$PRE_RECORD,$CURRENT_RECORD,"CHANGE_PASSWORD_SUCCESS",'users_reg',24,$user_id);
            //  $this->log_model->itsc_log("CHANGE_PASSWORD","SUCCESS",$QUERY,'CANDIDATE',$user_id,$CURRENT_RECORD,$PRE_RECORD,$user_id,'users_reg');

            return true;
        }else{
            $this->db->trans_rollback();
            //$this->db->trans_rollback();
            //this code is use for loging
            $this->db->where('USER_ID',$user_id);
            $CURRENT_RECORD =  $this->db->get('users_reg')->row_array();
            $this->log_model->create_log($user_id,$user_id,$PRE_RECORD,$CURRENT_RECORD,"CHANGE_PASSWORD_FAILED",'users_reg',24,$user_id);
//            $this->log_model->itsc_log("CHANGE_PASSWORD","FAILED",$QUERY,'CANDIDATE',$user_id,$CURRENT_RECORD,$PRE_RECORD,$user_id,'users_reg');

            return false;
        }

    }

    function changePassword($user_id,$curr_password,$password){
        //load loging model
       
        $this->db->where('USER_ID',$user_id);
        $PRE_RECORD =  $this->db->get('users_reg')->row_array();


        $formArray = array('PASSWORD'=>$password);
        //$this->db->trans_begin();
        $this->db->trans_begin();
        $this->db->where('PASSWORD',$curr_password);
        $this->db->where('USER_ID',$user_id);
        
        //$this->db->where('PASSWORD',$curr_password);
        //$this->db->where('USER_ID',$user_id);
        $this->db->update('users_reg',$formArray);

        //this code is use for loging
        $QUERY = $this->db->last_query();

        if($this->db->affected_rows() ==1){
            $this->db->trans_commit();
                 return true;
        }else{
            $this->db->trans_rollback();
           
            return false;
        }

    }

    function updateUserById($user_id,$formArray,$admin_id=0){
        if($admin_id == 0){
            $user_type='CANDIDATE';
            $edititor_id=$user_id;
        }else{
            $user_type='ADMIN';
            $edititor_id=$admin_id;
        }
        //load loging model
        $this->load->model('log_model');
        $this->db->where('USER_ID',$user_id);
        $PRE_RECORD =  $this->db->get('users_reg')->row_array();

        $this->db->trans_begin();

        $this->db->where('USER_ID',$user_id);
        $this->db->update('users_reg',$formArray);

        //this code is use for loging
        $QUERY = $this->db->last_query();

        if($this->db->affected_rows() ==1){
            $this->db->trans_commit();

            //this code is use for loging
            $this->db->where('USER_ID',$user_id);
            $CURRENT_RECORD =  $this->db->get('users_reg')->row_array();
            $this->log_model->create_log($user_id,$user_id,$PRE_RECORD,$CURRENT_RECORD,"UPDATE_USER_INFORMATION",'users_reg',12,$edititor_id);


            return 1;
        }elseif($this->db->affected_rows() ==0){
            $this->db->trans_commit();
            //this code is use for loging
            $this->db->where('USER_ID',$user_id);
            $CURRENT_RECORD =  $this->db->get('users_reg')->row_array();
            $this->log_model->create_log($user_id,$user_id,$PRE_RECORD,$CURRENT_RECORD,"UPDATE_USER_INFORMATION",'users_reg',12,$edititor_id);


            return 0;
        }else{
            $this->db->trans_rollback();

            //this code is use for loging
            $this->db->where('USER_ID',$user_id);
            $CURRENT_RECORD =  $this->db->get('users_reg')->row_array();
            $this->log_model->create_log($user_id,$user_id,$PRE_RECORD,$CURRENT_RECORD,"UPDATE_USER_INFORMATION",'users_reg',12,$edititor_id);

            return -1;
        }

    }

    function updateUserByIdLagecyDb($user_id,$formArray,$admin_id=0){
        if($admin_id == 0){
            $user_type='CANDIDATE';
            $edititor_id=$user_id;
        }else{
            $user_type='ADMIN';
            $edititor_id=$admin_id;
        }
        //load loging model
        $this->load->model('log_model');
        //$this->db->where('USER_ID',$user_id);
        //$PRE_RECORD =  $this->db->get('users_reg')->row_array();

        $this->db->trans_begin();

        $this->db->where('USER_ID',$user_id);
        $this->db->update('users_reg',$formArray);

        //this code is use for loging
        //$QUERY = $this->db->last_query();

        if($this->db->affected_rows() ==1){
            //$this->db->trans_commit();
            $this->db->trans_commit();
            //this code is use for loging
            //    $this->db->where('USER_ID',$user_id);
            //   $CURRENT_RECORD =  $this->db->get('users_reg')->row_array();
            // $this->log_model->create_log($user_id,$user_id,$PRE_RECORD,$CURRENT_RECORD,"UPDATE_USER_INFORMATION",'users_reg',12,$edititor_id);
            //    $this->log_model->itsc_log("UPDATE_USER_INFORMATION","SUCCESS",$QUERY,$user_type,$edititor_id,$CURRENT_RECORD,$PRE_RECORD,$user_id,'users_reg');

            // $this->log_model->create_log($user_id,$user_id,$PRE_RECORD,$CURRENT_RECORD,"UPDATE_USER_INFORMATION",'users_reg',12,$user_id);
            // $this->log_model->itsc_log("UPDATE_USER_INFORMATION","SUCCESS",$QUERY,'CANDIDATE',$user_id,$CURRENT_RECORD,$PRE_RECORD,$user_id,'users_reg');

            return 1;
        }elseif($this->db->affected_rows() ==0){
            //  $this->db->trans_commit();
            $this->db->trans_commit();
            //this code is use for loging
            //$this->db->where('USER_ID',$user_id);
            // $CURRENT_RECORD =  $this->db->get('users_reg')->row_array();
            //   $this->log_model->create_log($user_id,$user_id,$PRE_RECORD,$CURRENT_RECORD,"UPDATE_USER_INFORMATION",'users_reg',12,$edititor_id);
            //  $this->log_model->itsc_log("UPDATE_USER_INFORMATION","SUCCESS",$QUERY,$user_type,$edititor_id,$CURRENT_RECORD,$PRE_RECORD,$user_id,'users_reg');

            // $this->log_model->create_log($user_id,$user_id,$PRE_RECORD,$CURRENT_RECORD,"UPDATE_USER_INFORMATION",'users_reg',12,$user_id);
            // $this->log_model->itsc_log("UPDATE_USER_INFORMATION","SUCCESS",$QUERY,'CANDIDATE',$user_id,$CURRENT_RECORD,$PRE_RECORD,$user_id,'users_reg');

            return 0;
        }else{
            //    $this->db->trans_rollback();
            $this->db->trans_rollback();
            //this code is use for loging
            //$this->db->where('USER_ID',$user_id);
            //$CURRENT_RECORD =  $this->db->get('users_reg')->row_array();
            // $this->log_model->create_log($user_id,$user_id,$PRE_RECORD,$CURRENT_RECORD,"UPDATE_USER_INFORMATION",'users_reg',12,$edititor_id);
            //$this->log_model->itsc_log("UPDATE_USER_INFORMATION","FAILED",$QUERY,$user_type,$edititor_id,$CURRENT_RECORD,$PRE_RECORD,$user_id,'users_reg');


            return -1;
        }

    }
    function getExperiancesByUserId($user_id){

        $this->db->where('USER_ID',$user_id);
        $this->db->where('ACTIVE',1);
        $this->db->from('experiances');
        $experiances_list = $this->db->get()->result_array();
        return $experiances_list;
    }

    function addExperiances($form_array){
        //load loging model
        $this->load->model('log_model');

        $this->db->trans_begin();
        $this->db->insert('experiances', $form_array);

        //this code is use for loging
        $QUERY = $this->db->last_query();
        $id = $this->db->insert_id();


        if($this->db->affected_rows() != 1){
            $this->db->trans_rollback();

            //this code is use for loging
            $this->log_model->create_log(0,$id,"","","ADD_EXPERIANCE",'experiances',11,$form_array['USER_ID']);
            $this->log_model->itsc_log("ADD_EXPERIANCE","FAILED",$QUERY,'CANDIDATE',$form_array['USER_ID'],"","",$id,'experiances');



            return false;
        }else {
            $this->db->trans_commit();

            //this code is use for loging

            $this->db->where('EXPERIANCE_ID',$id);
            $CURRENT_RECORD =  $this->db->get('experiances')->row_array();
            $this->log_model->create_log(0,$id,"","","ADD_EXPERIANCE",'experiances',11,$form_array['USER_ID']);
            $this->log_model->itsc_log("ADD_EXPERIANCE","SUCCESS",$QUERY,'CANDIDATE',$form_array['USER_ID'],$CURRENT_RECORD,"",$id,'experiances');

            return true;
        }
    }

    function deleteExperiance($USER_ID,$experiance_id){
        //load loging model
        $this->load->model('log_model');
        $this->db->where('EXPERIANCE_ID',$experiance_id);
        $PRE_RECORD =  $this->db->get('experiances')->row_array();


        $this->db->trans_begin();

        $formArray = array('ACTIVE'=>0);

        $this->db->where('EXPERIANCE_ID',$experiance_id);
        $this->db->where('USER_ID',$USER_ID);
        $this->db->where('ACTIVE',1);
        $this->db->update('experiances',$formArray);
        //this code is use for loging
        $QUERY = $this->db->last_query();


        if($this->db->affected_rows() != 1){
            $this->db->trans_rollback();

            //this code is use for loging
            $this->db->where('EXPERIANCE_ID',$experiance_id);
            $CURRENT_RECORD =  $this->db->get('experiances')->row_array();
            $this->log_model->create_log($experiance_id,$experiance_id,$PRE_RECORD,$CURRENT_RECORD,"DELETE_EXPERIANCE",'experiances',13,$CURRENT_RECORD['USER_ID']);
            // $this->log_model->itsc_log("DELETE_EXPERIANCE","FAILED",$QUERY,'CANDIDATE',$USER_ID,$CURRENT_RECORD,$PRE_RECORD,$experiance_id,'experiances');


            return false;
        }else {
            $this->db->trans_commit();

            //this code is use for loging
            $this->db->where('EXPERIANCE_ID',$experiance_id);
            $CURRENT_RECORD =  $this->db->get('experiances')->row_array();
            $this->log_model->create_log($experiance_id,$experiance_id,$PRE_RECORD,$CURRENT_RECORD,"DELETE_EXPERIANCE",'experiances',13,$CURRENT_RECORD['USER_ID']);
            // $this->log_model->itsc_log("DELETE_EXPERIANCE","SUCCESS",$QUERY,'CANDIDATE',$USER_ID,$CURRENT_RECORD,$PRE_RECORD,$experiance_id,'experiances');

            return true;
        }
    }

    function addUser($form_array){

        $this->db->trans_begin();
        $this->db->db_debug = true;
        if($this->db->insert('users_reg', $form_array)){

      
            if ($this->db->affected_rows() != 1) {
                $this->db->trans_rollback();
                       return false;
            } else {
                $this->db->trans_commit();
               
                return true;
            }
        }
        else{
           
            return false;
        }

    }

    function getUserByEmailAddress($email){
        $this->db->where('EMAIL',$email);
        $user = $this->db->get('users_reg')->result_array();
        return $user;
    }
    function getInvgAppAuthByKey($key){
        $this->db->where('AUTH_KEY',$key);
        $this->db->where('ACTIVE','1');
        $data = $this->db->get('invg_app_auth')->row_array();
        return $data;
    }
    function updateInvgAppAuthByKey($key,$formArray){

        $this->db->where('AUTH_KEY',$key);
        $this->db->update('invg_app_auth',$formArray);
        if($this->db->affected_rows() ==1){
            $this->db->trans_commit();
            return  true;
        }else{
            $this->db->roll_back();
            return  false;
        }

    }
    
     function addOrUpdateUser($form_array){
        if($form_array['USER_ID']){
            $this->db->where('USER_ID',$form_array['USER_ID']);
            return $this->db->update('users_reg',$form_array);

        }else{
            unset($form_array['USER_ID']);
            return $this->db->insert('users_reg', $form_array);
        }
    }
}