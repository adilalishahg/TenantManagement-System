<?php
// application/models/Your_model.php

class Db_Model extends CI_Model
{

	public function booking_detail($user, $select = '*')
	{

		$this->db->select(TBL_RENT . '.*');
		// $this->db->select(TBL_USER . '.*');
		$this->db->select(TBL_FLAT . '.*');
		// $this->db->join(TBL_FLAT, TBL_FLAT . '.flat_id =' . TBL_RENT . ' .flat_id', 'left');
		$this->db->join(TBL_USER, TBL_RENT . '.tenant_id =' . TBL_USER . ' .user_id', 'left');
		$this->db->join(TBL_FLAT, TBL_RENT . '.flat_id =' . TBL_FLAT . ' .flat_id', 'left');
		$get = $this->db->get(TBL_RENT);
		return ($get->result_array());
	}
	public function get_booked_flat_by_user($where = '')
	{

		// Your SQL query using the Query Builder
		// $this->db->select(TBL_RENT . '.*,' . TBL_FLAT . ' .*');
		// $this->db->from(TBL_RENT);
		// $this->db->join(TBL_FLAT, TBL_FLAT . '.flat_id = ' . TBL_RENT . '.flat_id', 'left');
		// $this->db->where($where);

		// Your SQL query using the Query Builder
		$this->db->select(TBL_RENT . '.* ,' . TBL_FLAT . '.* ');
		$this->db->from(TBL_RENT);
		$this->db->join(TBL_FLAT, TBL_FLAT . '.flat_id = ' . TBL_RENT . '.flat_id', 'left');
		$this->db->where(TBL_FLAT . '.owner_id', $_SESSION['user_id']);
		// $this->db->select(TBL_RENT . '.*');
		// $this->db->select(TBL_FLAT . '.*');
		// $this->db->join(TBL_RENT, TBL_FLAT . '.flat_id =' . TBL_RENT . ' .flat_id', 'left');
		// $this->db->where($where);

		$get = $this->db->get();


		$result = ($get->result_array());


		// Get the count of records
		$count = $this->db->count_all_results('monthly_rent');

		return ['count' => $count, 'result' => $result];
	}
	public function get_data($table, $where = array(), $order_by = null, $limit = null, $type = 0, $select = '*')
	{
		$this->db->select($select);
		$this->db->from($table);

		if (!empty($where)) {
			$this->db->where($where);
		}

		if ($order_by) {
			$this->db->order_by($order_by);
		}

		if ($limit) {
			$this->db->limit($limit);
		}

		$query = $this->db->get();
		if ($type == 1) {

			return ($query->result_array());
		}
		return $query->result();
	}
	public function getCurrentUser($tbl, $array = array())
	{
		$this->db->select('*');
		$this->db->from($tbl);
		$this->db->where($array);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function getHashedPassword($email = array(), $table)
	{
		// Query the database to get the hashed password based on email or username
		$this->db->select('password');  // Assuming the column name is 'password'
		$this->db->where($email); // Adjust based on your database schema
		// Or $this->db->where('username', $email);

		$query = $this->db->get($table);  // Assuming the table name is 'users'

		if ($query->num_rows() == 1) {
			$row = $query->row();
			return $row->password;
		} else {
			// Handle the case where the user is not found
			return null;
		}
	}
	public function insert_data($table, $data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function update_data($table, $data, $where)
	{

		$this->db->update($table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_data($table, $where)
	{
		$this->db->delete($table, $where);
		return $this->db->affected_rows();
	}

	public function save_data($table, $data)
	{
		// Save user data to the database


		$this->db->insert($table, $data);

		// Return the inserted user ID
		return $this->db->insert_id();
	}
	public function is_email_unique($tbl, $email, $user_id)
	{
		$this->db->where('email', $email);
		$this->db->where('user_id !=', $user_id);
		$query = $this->db->get($tbl);
		if ($query->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}
}
