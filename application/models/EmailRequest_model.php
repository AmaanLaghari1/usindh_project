<?php
class EmailRequest_model extends CI_Model
{
	protected $table = 'official_email_account_requests';
	protected $primaryKey = 'REQUEST_ID';

	protected $allowedFields = array(
		'STUDENT_ID',
		'EMPLOYEE_ID',
		'CNIC_NO',
		'EMAIL',
		'FIRST_NAME',
		'LAST_NAME',
		'DEPARTMENT_ID',
		'DEGREE_PROGRAM',
		'BATCH',
		'DATE_OF_BIRTH',
		'DATE_OF_APPOINTMENT',
		'EDUCATION_LEVEL',
		'MOBILE_PHONE',
		'WHATSAPP_NO',
		'CITY',
		'APPLICANT_PICTURE',
		'ROLE',
		'DESIGNATION',
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

	public function getByColumnValue($column, $value) {
		$this->db->where($column, $value);
		$query = $this->db->get($this->table);
		return $query->row();
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

	public function emailRequestValidated($role){
		$config = array(
			array(
				'field' => 'first_name',
				'label' => 'First Name',
				'rules' => 'trim|required|min_length[3]'
			),
			array(
				'field' => 'cnic_no',
				'label' => 'CNIC',
				'rules' => 'required',
				'errors' => array(
					'required' => 'You must provide a %s.',
				),
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => array('required', 'email')
			),
			array(
				'field' => 'date_of_birth',
				'label' => 'Date of Birth',
				'rules' => 'required'
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required'
			),
			array(
				'field' => 'mobile_phone',
				'label' => 'Mobile Phone',
				'rules' => 'required'
			),
			array(
				'field' => 'whatsapp_no',
				'label' => 'Whatsapp No.',
				'rules' => 'required'
			),
			array(
				'field' => 'city',
				'label' => 'City',
				'rules' => 'required'
			),
			array(
				'field' => 'department',
				'label' => 'Department',
				'rules' => 'required'
			),
		);

		if($role == 1){
			$config[] = array(
				'field' => 'roll_no',
				'label' => 'Student ID',
				'rules' => 'required'
			);
			$config[] = array(
				'field' => 'degree_program',
				'label' => 'Degree Program',
				'rules' => 'required'
			);
		}
		else {
			$config[] = array(
				'field' => 'employee_id',
				'label' => 'Employee ID',
				'rules' => 'required'
			);
			$config[] = array(
				'field' => 'date_of_appointment',
				'label' => 'Date of Appointment',
				'rules' => 'required'
			);
		}

		$this->load->library('form_validation');

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE){
			return FALSE;
		}

		return TRUE;
	}
}
