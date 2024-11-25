<?php
class EmailRequest_model extends CI_Model
{
	protected $table = 'official_email_account_requests';
	protected $primaryKey = 'EMAIL_REQUEST_ID';

	protected $allowedFields = array(
		'STUDENT_ID',
		'STAFF_OR_FACULTY_ID',
		'CNIC_NO',
		'EMAIL',
		'FIRST_NAME',
		'LAST_NAME',
		'DEPARTMENT_ID',
		'DEGREE_PROGRAM',
		'PROGRAM_TITLE',
		'RESEARCH_AREA',
		'DATE_OF_BIRTH',
		'DATE_OF_APPOINTMENT',
		'EDUCATION_LEVEL',
		'ADDITIONAL_QUALIFICATION',
		'ADDITIONAL_CHARGE',
		'OFFICE_PHONE',
		'MOBILE_PHONE',
		'WHATSAPP_NO',
		'ADDRESS',
		'CITY',
		'PROVINCE',
		'POSTAL_CODE',
		'APPLICANT_PICTURE',
		'ROLE',
		'DESIGNATION_ID',
		'REQUEST_STATUS_ID'
	);

	public function get() {
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function getEmailRequestById($emailRequestId) {
		$this->db->where($this->primaryKey, $emailRequestId);
		$query = $this->db->get($this->table);
		return $query->row(); // Use row() for a single result
	}

	public function ifExists($col, $val) {
		return $this->db->where($col, $val)
				->count_all_results($this->table) > 0;
	}

	public function create($data) {
		return $this->db->insert($this->table, $data);
	}

	public function update($id, $data) {
		$this->db->where($this->primaryKey, $id);
		return $this->db->update($this->table, $data);
	}

	public function soft_delete($id) {
		$data = array('deleted_at' => date('Y-m-d H:i:s'));
		$this->db->where($this->primaryKey, $id);
		return $this->db->update($this->table, $data);
	}

	public function restore($id) {
		$data = array('deleted_at' => NULL);
		$this->db->where($this->primaryKey, $id);
		return $this->db->update($this->table, $data);
	}

	public function delete_permanently($id) {
		$this->db->where($this->primaryKey, $id);
		return $this->db->delete($this->table);
	}
}