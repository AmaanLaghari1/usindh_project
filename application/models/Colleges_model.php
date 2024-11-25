<?php

class Colleges_model extends CI_Model 
{
    protected $table = 'affiliation_college';
    protected $primaryKey = 'COLLEGE_ID';
    
    protected $allowedFields = ['COLLEGE_NAME', 'TYPE'];
    
    public function get_data() {
        $query = $this->db->get('affiliation_college');
        return $query->result();
    }
}
