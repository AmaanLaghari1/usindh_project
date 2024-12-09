

<?php
class Department_model extends CI_Model
{
	protected $table = 'department';
	protected $primaryKey = 'DEPT_ID';

	protected $allowedFields =
		array(
			'FAC_ID',
			'INST_ID',
			'DEPT_NAME',
			'LOGO',
			'CODE',
			'DIRECTOR_NAME',
			'IS_INST',
			'DIRECTOR_DESIGNATION',
			'DIRECTOR_MESSAGE',
			'DIRECTOR_IMAGE',
			'ABOUT_IMAGE',
			'ABOUT',
			'MISSION',
			'CONTACT',
			'ACTIVE',
			'REMARKS',
			'IS_ADMIN'
		);

	public function get() {
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function getDepartmentById($departmentId) {
		$this->db->where('DEPT_ID', $departmentId);
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function create($data) {
		return $this->db->insert($this->table, $data);
	}

	// Function to update an existing user by ID
	public function update($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

	// Soft delete a record by setting the deleted_at timestamp
	public function soft_delete($id) {
		$data = array('deleted_at' => date('Y-m-d H:i:s'));
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

	// Restore a soft-deleted record by setting deleted_at to NULL
	public function restore($id) {
		$data = array('deleted_at' => NULL);
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

	// Completely delete a record from the database
	public function delete_permanently($id) {
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}
}
?>

