

<?php
class Programs_model extends CI_Model 
{
    protected $table = 'affiliation_program';
    protected $primaryKey = 'PROGRAM_ID';
    
    protected $allowedFields = ['PROGRAM_NAME', 'COLLEGE_ID', 'PROGRAM_SEAT'];
    
    public function get() {
        $query = $this->db->get($this->table);
        return $query->result();
    } 
    
    public function getProgramsByCollegeId($collegeId) {
        $this->db->where('COLLEGE_ID', $collegeId);
        $query = $this->db->get($this->table);
        return $query->result();
    } 
}
?>

