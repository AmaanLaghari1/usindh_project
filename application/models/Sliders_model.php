<?php
/**
 * Created by PhpStorm.
 * User: Irfan Rajput
 * Date: 7/10/2020
 * Time: 10:54 PM
 */

class Sliders_model extends CI_model
{
    function __construct()
    {
        parent::__construct();


    }

    function getSliders($dept_id = 0 ){
        if($dept_id>0){
            $this->db->where('DEPT_ID',$dept_id);
        }
        $sliders = $this->db->get('sliders')->result_array();
        return $sliders;

    }
    function getSliderById($id){
        $this->db->where('ID',$id);

        $sliders = $this->db->get('sliders')->row_array();
        return $sliders;

    }
    function getCarousel($dept_id=0){
        $this->db->where('ACTIVE','1');
        $this->db->order_by('ID','DESC');
        $this->db->where('DEPT_ID',$dept_id);
        
        $this->db->limit(5);

        $sliders = $this->db->get('sliders')->result_array();
        return $sliders;

    }
    function addOrUpdateSlider($form_array){
        if($form_array['ID']){
            $this->db->where('ID',$form_array['ID']);
           return $this->db->update('sliders',$form_array);

        }else{
            unset($form_array['ID']);
            return $this->db->insert('sliders', $form_array);
        }



    }
}