<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MUsers extends CI_Model {

	/**
     * Class constructor
     *
     * @return  void
     */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Verify user
	 *
	 * @param  string 	$email
	 * @param  string 	$pw
	 * @return void
	 */
	public function verify($email, $pw)
	{
		$this->db->where('email', $email);
		$this->db->where('password', $pw);
		$this->db->where('status', 'active');
		$this->db->limit(1);
		$q = $this->db->get('users');
		if ($q->num_rows() > 0)
		{
			$row = $q->row_array();
			$data['user_id'] = $row['id'];
			$data['user_name'] = $row['name'];
			$data['user_email'] = $row['email'];
			$data['user_type'] = $row['type'];
			$data['user_company'] = $row['company_id'];
			$company = $this->MCompanies->get_by_id($row['company_id']);
			$data['company_name'] = $company['name'];
			if ($company['logo'] != '')
			{
				$data['company_logo'] = 'uploads/companies/' . $company['logo'];
			}
			else
			{
				$data['company_logo'] = 'assets/images/logo.png';
			}
			$data['currency_symbol_position'] = $company['currency_symbol_position'];
			$currency = $this->MCurrencies->get_by_id($company['currency_id']);
			$data['currency_name'] = $currency['shortname'];
			$data['currency_symbol'] = $currency['symbol'];
			$data['version'] = file_get_contents('config.ini');

			$this->session->set_userdata($data);
		}
	}

	/**
	 * Get user by id
	 *
	 * @param  integer 	$id
	 * @return array 	$data
	 */
	public function get_by_id($id)
	{
		$data = array();
		$this->db->select('users.*, companies.name as company_name');
		$this->db->join('companies', 'users.company_id = companies.id', 'left');
		$this->db->where('users.id', $id);
		$this->db->limit(1);
		$q = $this->db->get('users');
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row;
			}
		}

		$q->free_result();
		return $data;
	}

	/**
	 * Get user by email
	 *
	 * @param  string 	$email
	 * @return array 	$data
	 */
	public function get_by_email($email)
	{
		$data = array();
		$this->db->where('email', $email);
		$this->db->limit(1);
		$q = $this->db->get('users');
		if ($q->num_rows() > 0)
		{
			$data = $q->row_array();
		}

		$q->free_result();
		return $data;
	}

	/**
	 * Get user by code
	 *
	 * @param  string 	$code
	 * @return array 	$data
	 */
	public function get_by_code($code)
	{
		$data = array();
		$this->db->where('code', $code);
		$this->db->limit(1);
		$q = $this->db->get('users');
		if ($q->num_rows() > 0)
		{
			$data = $q->row_array();
		}

		$q->free_result();
		return $data;
	}

	/**
	 * Get all user
	 *
	 * @return array 	$data
	 */
	public function get_all()
	{
		$data = array();
		$this->db->select('u.id, u.email, u.name, u.type, u.status, u.created, c.name as c_name');
		$this->db->from('users as u');
		$this->db->join('companies as c', 'u.company_id = c.id', 'left');
		if ($this->session->userdata('user_type') != 'Admin')
		{
			$this->db->where('u.company_id', $this->session->user_company);
		}
		if ($this->session->userdata('user_type') == 'Power User')
		{
			$this->db->where('u.type !=', 'Admin');
		}
		if ($this->session->userdata('user_type') == 'User')
		{
			$this->db->where('u.type =', 'User');
		}
		$q = $this->db->get();
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data[] = $row;
			}
		}

		$q->free_result();
		return $data;
	}

	/**
	 * Add new user
	 *
	 * @param  integer 	$company_id
	 * @param  string 	$name
	 * @param  string 	$type
	 * @param  string 	$status
	 * @return integer 	insert_id
	 */
	public function create($company_id, $name, $type, $status = 'Inactive')
	{
		$data = array(
			'company_id' => $company_id,
			'email' => $this->input->post('email'),
			'password' => substr(do_hash($this->input->post('password')), 0, 16),
			'name' => $name,
			'type' => $type,
			'status' => $status,
			'code' => substr(do_hash($this->input->post('email')), 0, 32),
			'created' => date('Y-m-d H:i:s', time()),
			'created_by' => $this->session->userdata('user_id')
		);
		$this->db->insert('users', $data);

		return $this->db->insert_id();
	}

	/**
	 * Active user by user id
	 *
	 * @param  integer 	$id
	 * @return void
	 */
	public function active_user($id)
	{
		$data = array(
			'status' => 'Active',
			'code' => ''
		);

		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}

	/**
	 * Update user by user id
	 *
	 * @param  integer 	$id
	 * @return void
	 */
	public function update($id = NULL)
	{
		$data = array(
			'email' => $this->input->post('email'),
			'name' => $this->input->post('name'),
			'status' => $this->input->post('status'),
			'modified' => date('Y-m-d H:i:s', time()),
			'modified_by' => $this->session->user_id
		);
		if ($this->input->post('company_id'))
		{
			$data['company_id'] = $this->input->post('company_id');
		}
		if ($this->input->post('password'))
		{
			$data['password'] = substr(do_hash($this->input->post('password')), 0, 16);
		}
		if ($this->input->post('type'))
		{
			$data['type'] = $this->input->post('type');
		}

		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}

	/**
	 * Update user password by user id
	 *
	 * @param  integer 	$id
	 * @return void
	 */
	public function update_password($id = NULL)
	{
		$data = array(
			'password' => substr(do_hash($this->input->post('new_password')), 0, 16),
			'modified' => date('Y-m-d H:i:s', time()),
			'modified_by' => $this->session->user_id
		);

		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}

	/**
	 * Update user code by user id and code
	 *
	 * @param  integer 	$id
	 * @param  string 	$code
	 * @return void
	 */
	public function update_code($id, $code)
	{
		$data = array(
			'code' => $code,
			'modified' => date('Y-m-d H:i:s', time())
		);

		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}

	/**
	 * Delete user by user id
	 *
	 * @param  integer 	$id
	 * @return void
	 */
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('users');
	}

	/**
	 * Delete user by company id
	 *
	 * @param  integer 	$company_id
	 * @return void
	 */
	public function delete_by_cmp($company_id)
	{
		$this->db->where('company_id', $company_id);
		$this->db->delete('users');
	}

}
