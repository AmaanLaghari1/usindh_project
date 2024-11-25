<?php
/**
 * Created by PhpStorm.
 * User: Irfan Rajput
 * Date: 7/10/2020
 * Time: 10:54 PM
 */

class Member_model extends CI_model
{
    function __construct()
    {
        parent::__construct();


    }




    function getDesignations($limit=0,$active=1){

        $this->db->select("*");
        $this->db->from("designations c");
        if($active==1){
            $this->db->where('c.ACTIVE',$active);
        }

        if($limit>0){
            $this->db->limit($limit);
        }
        $this->db->order_by("c.ORDER");
        $categories = $this->db->get()->result_array();

        return $categories;

    }

    function getDesignationById($id){
        $this->db->where('ID',$id);

        $category = $this->db->get('designations')->row_array();
        return $category;

    }

    function addOrUpdateDesignation($form_array){
        if($form_array['ID']){
            $this->db->where('ID',$form_array['ID']);
            return $this->db->update('designations',$form_array);

        }else{
            unset($form_array['ID']);
            return $this->db->insert('designations', $form_array);
        }
    }


    function getMembers($limit=0,$active=1){

        $this->db->select("*");
        $this->db->from("faculty_members fm");
        if($active==1){
            $this->db->where('fm.ACTIVE',$active);
        }

        if($limit>0){
            $this->db->limit($limit);
        }
        $this->db->order_by("fm.FIRST_NAME");
        $categories = $this->db->get()->result_array();

        return $categories;

    }

    function getMembersById($id){
        $this->db->where('MEMBER_ID',$id);

        $category = $this->db->get('faculty_members')->row_array();
        return $category;

    }
    function getMembersByIds($ids){
        $this->db->where("MEMBER_ID IN ($ids)");

        $category = $this->db->get('faculty_members')->result_array();
        return $category;

    }

    function addOrUpdateMember($form_array,$is_add =0 ){
        if($is_add==0){
            $this->db->where('MEMBER_ID',$form_array['MEMBER_ID']);
            return $this->db->update('faculty_members',$form_array);

        }else{
           // unset($form_array['ID']);
            return $this->db->insert('faculty_members', $form_array);
        }
    }



}