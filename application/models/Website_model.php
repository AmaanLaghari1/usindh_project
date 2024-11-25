<?php
/**
 * Created by PhpStorm.
 * User: Irfan Rajput
 * Date: 7/10/2020
 * Time: 10:54 PM
 */

class Website_model extends CI_model
{
    function __construct()
    {
        parent::__construct();


    }

    function getWebsites($limit=0,$active=1){

        $this->db->select("*");
        $this->db->from("websites w");
         if($active==1){
            $this->db->where('w.ACTIVE',$active);
        }
        if($limit>0){
            $this->db->limit($limit);
        }
        $websites = $this->db->get()->result_array();

        return $websites;

    }

    function getWebsiteId($post_id,$active=1){

        $this->db->select("*");
        $this->db->from("websites w");


        if($active==1){
            $this->db->where('w.ACTIVE',$active);
        }
        $this->db->where('w.WEBSITE_ID ',$post_id);

        $website = $this->db->get()->row_array();

        return $website;

    }

    function getWebsiteByUrl($url,$active=1){

        $this->db->select("*");
        $this->db->from("websites w");


        if($active==1){
            $this->db->where('w.ACTIVE',$active);
        }
        $this->db->where('w.WEBSITE_URL ',$url);

        $website = $this->db->get()->row_array();

        return $website;

    }

    function addOrUpdateWebsite($form_array){
        if($form_array['WEBSITE_ID']){
            $this->db->where('WEBSITE_ID',$form_array['WEBSITE_ID']);
            return $this->db->update('websites',$form_array);

        }else{
            unset($form_array['WEBSITE_ID']);
            return $this->db->insert('websites', $form_array);
        }



    }

    function getFaculty($limit=0,$active=1){

        $this->db->select("*");
        $this->db->from("faculty f");
        if($active==1){
            $this->db->where('f.ACTIVE',$active);
        }
        if($limit>0){
            $this->db->limit($limit);
        }
        $faculty = $this->db->get()->result_array();

        return $faculty;

    }

    function getFacultyByID($fac_id,$active=1){

        $this->db->select("*");
        $this->db->from("faculty f");


        if($active==1){
            $this->db->where('f.ACTIVE',$active);
        }
        if(is_numeric($fac_id)){
             $this->db->where('f.FAC_ID ',$fac_id);
        }else{
          $this->db->where('f.URL',$fac_id);  
        }
        

        $faculty = $this->db->get()->row_array();

        return $faculty;

    }

    function addOrUpdateFaculty($form_array){
        if($form_array['FAC_ID']){
            $this->db->where('FAC_ID',$form_array['FAC_ID']);
            return $this->db->update('faculty',$form_array);

        }else{
            unset($form_array['FAC_ID']);
            return $this->db->insert('faculty', $form_array);
        }



    }

    function getDepartments($limit=0,$active=1){

        $this->db->select("d.*,f.FAC_NAME,i.DEPT_NAME AS INSTITUTE_NAME");
        $this->db->from("department d");
        $this->db->join("faculty f","f.FAC_ID = d.FAC_ID");
        $this->db->join("department i","d.INST_ID = i.DEPT_ID","LEFT");
        if($active==1){
            $this->db->where('d.ACTIVE',$active);
        }
        if($limit>0){
            $this->db->limit($limit);
        }
        $faculty = $this->db->get()->result_array();

        return $faculty;

    }

    function getDepartmentByID($dept_id,$active=1){


        $this->db->select("d.*,f.FAC_NAME,i.DEPT_NAME AS INSTITUTE_NAME");
        $this->db->from("department d");
        $this->db->join("faculty f","f.FAC_ID = d.FAC_ID");
        $this->db->join("department i","d.INST_ID = i.DEPT_ID","LEFT");

        if($active==1){
            $this->db->where('d.ACTIVE',$active);
        }
        $this->db->where('d.DEPT_ID ',$dept_id);
        $this->db->or_where('d.CODE ',$dept_id);

        $faculty = $this->db->get()->row_array();

        return $faculty;

    }

    function getDepartmentByCondition($condition=1,$active=1){


        $ql = "";
        if($active==1){
            $ql = "d.ACTIVE =1 AND";
        }

        $sql = "select d.*,f.FAC_NAME,i.DEPT_NAME AS INSTITUTE_NAME from  department d join faculty f  on (f.FAC_ID = d.FAC_ID) left join department i on (d.INST_ID = i.DEPT_ID)";
        $sql.="where $ql $condition";
        $q = $this->db->query($sql);
        $faculty = $q->result_array();

        return $faculty;

    }

    function addOrUpdateDepartment($form_array){
        if($form_array['DEPT_ID']){
            $this->db->where('DEPT_ID',$form_array['DEPT_ID']);
            return $this->db->update('department',$form_array);

        }else{
            unset($form_array['DEPT_ID']);
            $result = $this->db->insert('department', $form_array);
            $insert_id = $this->db->insert_id();
            $form_array =array("ROLE_NAME"=>$form_array['DEPT_NAME'],"DEPT_ID"=>$insert_id,"ACTIVE"=>"1","KEYWORD"=>"DIR_LOGIN");
            $result = $this->db->insert('role', $form_array);
            $role_id = $this->db->insert_id();
            $this->db->select("PRIVILAGE_ID,$role_id  AS ROLE");
            $this->db->from("privilage_relation");
            $this->db->where("ROLE",30);
            $privilage_relation = $this->db->get()->result_array();
            $this->db->insert_batch('privilage_relation', $privilage_relation);
            return $result;
        }



    }

    function getRnD($limit=0,$active=1){

        $this->db->select("*");
        $this->db->from("r_and_d rnd");
        $this->db->join("department d","d.DEPT_ID = rnd.DEPT_ID");
        if($active==1){
            $this->db->where('rnd.ACTIVE',$active);
        }

        if($limit>0){
            $this->db->limit($limit);
        }
        $rnd = $this->db->get()->result_array();

        return $rnd;

    }

    function getRnDByID($id,$active=1){


        $this->db->select("*");
        $this->db->from("r_and_d rnd");
        $this->db->join("department d","d.DEPT_ID = rnd.DEPT_ID");

        if($active==1){
            $this->db->where('rnd.ACTIVE',$active);
        }
        $this->db->where('rnd.RD_ID ',$id);

        $faculty = $this->db->get()->row_array();

        return $faculty;

    }

    function getRnDByCondition($condition,$active=1){



        $ql = "";
        if($active==1){
            $ql = "rnd.ACTIVE =1 AND";
        }

        $sql = "select * from  r_and_d rnd join department d on (d.DEPT_ID = rnd.DEPT_ID)";
        $sql.="where $ql $condition";
        $q = $this->db->query($sql);
        $faculty = $q->result_array();

        return $faculty;

    }

    function addOrUpdateRnD($form_array){
        if($form_array['RD_ID']){
            $this->db->where('RD_ID',$form_array['RD_ID']);
            return $this->db->update('r_and_d',$form_array);

        }else{
            unset($form_array['RD_ID']);
            return $this->db->insert('r_and_d', $form_array);
        }



    }
    function getPageByCondition($condition,$active=1){



        $ql = "";
        if($active==1){
            $ql = "p.ACTIVE =1 AND";
        }

        $sql = "select d.*,p.* from  pages p left join department d on (d.DEPT_ID = p.DEPT_ID)";
        $sql.="where $ql $condition";
        $q = $this->db->query($sql);
        $faculty = $q->result_array();

        return $faculty;

    }

    function getPageByID($page_id,$active=null){

        $ql = "";
        if($active!=null){
            $ql = "p.ACTIVE =$active AND";
        }

        $sql = "select d.*,p.* from  pages p left join department d on (d.DEPT_ID = p.DEPT_ID)";
        $condition = "PAGE_ID =$page_id";
        $sql.="where $ql $condition";
        $q = $this->db->query($sql);
        $faculty = $q->row_array();

        return $faculty;
    }
    function addOrUpdatePage($form_array){
        if($form_array['PAGE_ID']){
            $this->db->where('PAGE_ID',$form_array['PAGE_ID']);
            return $this->db->update('pages',$form_array);

        }else{
            unset($form_array['PAGE_ID']);
            return $this->db->insert('pages', $form_array);
        }



    }
    
    function getFooterByCondition($condition,$active=1){

        $ql = "";
        if($active==1){
            $ql = "p.ACTIVE =1 AND";
        }

        $sql = "select d.*,p.* from  footers p left join department d on (d.DEPT_ID = p.DEPT_ID)";
        $sql.="where $ql $condition";
        $q = $this->db->query($sql);
        $faculty = $q->result_array();

        return $faculty;

    }

    function getFooterByID($page_id,$active=null){

        $ql = "";
        if($active!=null){
            $ql = "p.ACTIVE =$active AND";
        }

        $sql = "select d.*,p.* from  footers p left join department d on (d.DEPT_ID = p.DEPT_ID)";
        $condition = "ID =$page_id";
        $sql.="where $ql $condition";
        $q = $this->db->query($sql);
        $faculty = $q->row_array();

        return $faculty;
    }
    function addOrUpdateFooter($form_array){
        if($form_array['ID']){
            $this->db->where('ID',$form_array['ID']);
            return $this->db->update('footers',$form_array);

        }else{
            unset($form_array['ID']);
            return $this->db->insert('footers', $form_array);
        }



    }
    
    function saveAlumni($data){
       $users_reg =  $data['users_reg'];
        $alumni = $data['alumni'];
         $this->db->trans_begin();
        $this->db->where("CNIC_NO",$users_reg['CNIC_NO']);
        $user = $this->db->get("users_reg")->row_array();
        if($user){
            
                 $this->db->where("USER_ID",$user['USER_ID']);
                $alm = $this->db->get("alumni")->row_array();
                
                if($alm){
                    $this->db->where("USER_ID",$user['USER_ID']);
                    $this->db->where("ROLE_ID",8);
                    $rr = $this->db->get("role_relation")->row_array();
                   
                    if($rr){
                        $this->db->trans_rollback();
                            return array("STATUS"=>"403","MESSAGE"=>"ALREADY ADDED");
                    }else{
                       $role_relation = array("USER_ID"=>$user['USER_ID'],"ROLE_ID"=>8,"ACTIVE"=>1);
                        if($this->db->insert("role_relation",$role_relation)){
                              $this->db->trans_commit();
                              return array("STATUS"=>"200","MESSAGE"=>"NEW RECORED ADD SUCCESSFULLY");
                        }else{
                            $this->db->trans_rollback();
                            return array("STATUS"=>"403","MESSAGE"=>"ROlE NOT ADDED");
                        }  
                    }
                    
                }else{
                   $alumni['USER_ID'] = $user['USER_ID'];
                  $this->db->insert("alumni",$alumni);
                  $id = $this->db->insert_id();
                  
                  if($id){
                    
                    $this->db->where("USER_ID",$user['USER_ID']);
                    $this->db->where("ROLE_ID",8);
                    
                    $rr = $this->db->get("role_relation")->row_array();
                  
                    if($rr){
                        $this->db->trans_rollback();
                        return array("STATUS"=>"403","MESSAGE"=>"ALREADY ADDED");
                    }else{
                       $role_relation = array("USER_ID"=>$user['USER_ID'],"ROLE_ID"=>8,"ACTIVE"=>1);
                        if($this->db->insert("role_relation",$role_relation)){
                              $this->db->trans_commit();
                              return array("STATUS"=>"200","MESSAGE"=>"NEW RECORED ADD SUCCESSFULLY");
                        }else{
                            $this->db->trans_rollback();
                            return array("STATUS"=>"403","MESSAGE"=>"ROlE NOT ADDED");
                        }  
                    }
                  }else{
                       $this->db->trans_rollback();
                            return array("STATUS"=>"403","MESSAGE"=>"ALUMNI RECORD NOT ADDED");
                  } 
                }
        }else{
           
            $this->db->insert("users_reg",$users_reg);
             $user_id = $this->db->insert_id();
             if($user_id){
                  $alumni['USER_ID'] = $user_id;
                  $this->db->insert("alumni",$alumni);
                  $id = $this->db->insert_id();
                  if($id){
                      $role_relation = array("USER_ID"=>$user_id,"ROLE_ID"=>8);
                        if($this->db->insert("role_relation",$role_relation)){
                              $this->db->trans_commit();
                              return array("STATUS"=>"200","MESSAGE"=>"NEW RECORED ADD SUCCESSFULLY");
                        }else{
                            $this->db->trans_rollback();
                            return array("STATUS"=>"403","MESSAGE"=>"ROlE NOT ADDED");
                        }
                  }else{
                       $this->db->trans_rollback();
                            return array("STATUS"=>"403","MESSAGE"=>"ALUMNI RECORD NOT ADDED");
                  }
             }else{
                $this->db->trans_rollback();
                return array("STATUS"=>"403","MESSAGE"=>"USER RECORD NOT ADDED"); 
             }
        }
    }





}