<?php
/**
 * Created by PhpStorm.
 * User: Kashif Shaikh
 * Date: 7/13/2020
 * Time: 12:42 PM
 */

class Configuration_model extends CI_Model
{

    private function get_navbar_by_website_url($dept_id=0)
    {
        $this->db->select("nl.*");
        $this->db->from('navbar_links nl');
        $this->db->where("nl.DEPT_ID",$dept_id);


        $this->db->order_by('nl.LEVEL_NO DESC,nl.ORDER_NO');
        $result = $this->db->get()->result_array();

        $new_array = array();
        foreach ($result as $data){
            $new_array[$data['LINK_ID']] =  $data;
        }
        return $new_array;
    }

    public function get_actual_navbar_by_website_url($dept_id=0){

        $reverse_navbar_list =  $this->get_navbar_by_website_url($dept_id);
        $key_array = array_keys($reverse_navbar_list);
        foreach ($key_array as $key){
            $nav_bar = &$reverse_navbar_list[$key];
            if($nav_bar['PARENT_ID']>0){
                $parent_id =$nav_bar['PARENT_ID'];
                if(!isset($reverse_navbar_list[$parent_id]['CHILDREN'])){
                    $reverse_navbar_list[$parent_id]['CHILDREN'] = array();
                }
                array_push($reverse_navbar_list[$parent_id]['CHILDREN'],$nav_bar);
                unset($reverse_navbar_list[$key]);

            }
        }

        return $reverse_navbar_list;
    }
	function get_privilages($user_id,$role_id){

		//$this->legacy_db = $this->load->database('admission_db',true);
		$this->db->select("p.*");
		$this->db->from("privilages p");
		
		$this->db->join("privilage_relation pr","p.PRIVILAGE_ID=pr.PRIVILAGE_ID AND (pr.USER_ID={$user_id} OR pr.ROLE IN ($role_id) OR pr.ROLE=-1) ORDER BY ORD","INNER");
		return($this->db->get()->result_array());

	}
	function getConfiguration($limit=0,$active=1){

        $this->db->select("*");
        $this->db->from("configurations c");
    
       if($active==1){
            $this->db->where('c.ACTIVE',$active);
        }
        $this->db->order_by('c.ID DESC');
        if($limit>0){
            $this->db->limit($limit);
        }
        $posts = $this->db->get()->result_array();

        return $posts;

    }

    function getConfigurationById($post_id,$active=1){

        $this->db->select("*");
           $this->db->from("configurations c");


        if($active==1){
            $this->db->where('c.ACTIVE',$active);
        }
        $this->db->where('c.ID ',$post_id);

        $posts = $this->db->get()->row_array();

        return $posts;

    }

    function addOrUpdateConfiguration($form_array){
        if($form_array['ID']){
            $this->db->where('ID',$form_array['ID']);
            return $this->db->update('configurations',$form_array);

        }else{
            unset($form_array['ID']);
            return $this->db->insert('configurations', $form_array);
        }
    }
    function addOrUpdatNavbar($form_array){

        if($form_array['LINK_ID']){
            $this->db->where('LINK_ID',$form_array['LINK_ID']);
            return $this->db->update('navbar_links',$form_array);
        }else{
            unset($form_array['LINK_ID']);
            return $this->db->insert('navbar_links', $form_array);
        }

    }
    function deleteNavbar($form_array){

        if($form_array['LINK_ID']){
            $this->db->where('PARENT_ID',$form_array['LINK_ID']);
            $data = $this->db->get('navbar_links')->result_array();
            
            if(count($data)==0){
                
                $this->db->where('LINK_ID', $form_array['LINK_ID']);
                $this->db->delete('navbar_links');
                return true;
            }else{
               return false;
            }
            
        }

    }
}
