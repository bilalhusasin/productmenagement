<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MCustomers extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_by_id($id)
	{
		$data = array();
		$this->db->where('id', $id);
		$this->db->where('company_id', $this->session->userdata('user_company'));
		$q = $this->db->get('customers');
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

	public function get_by_name($id)
	{
		$this->db->where('company_id', $this->session->userdata('user_company'));
		$this->db->where('id', $id);
		$q = $this->db->get('customers');
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row['full_name'];
			}
		}

		$q->free_result();
		return $data;
	}

	public function get_latest()
	{
		$data = array();
		$this->db->where('company_id', $this->session->userdata('user_company'));
		$this->db->order_by('code', 'DESC');
		$this->db->limit(1);
		$q = $this->db->get('customers');
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

	public function getCustomerNameBySalesID($id)
	{
		//$data = array();
		$this->db->select('customers.id, customers.name');
		$this->db->from('customers');
		$this->db->join('sales_master', 'customers.id=sales_master.customer_id');
		$this->db->where('sales_master.id', $id);
		$this->db->where('customers.company_id', $this->session->userdata('user_company'));
		$q = $this->db->get();
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

	public function get_all()
	{
		$data = array();
		$this->db->where('company_id', $this->session->userdata('user_company'));
		$q = $this->db->get('customers');
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

	public function create($code, $ac_id)
	{
		$data = array(
			'company_id' => $this->session->userdata('user_company'),
			'code' => $code,
			'name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'city' => $this->input->post('city'),
			'zip' => $this->input->post('zip'),
			'country' => $this->input->post('country'),
			'mobile' => $this->input->post('mobile'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
			'dob' => $this->input->post('dob'),
			'web' => $this->input->post('web'),
			'notes' => $this->input->post('notes'),
			'ac_id' => $ac_id,
			'created' => date('Y-m-d H:i:s', time()),
			'created_by' => $this->session->userdata('user_id')
			);
		$this->db->insert('customers', $data);

		return $this->db->insert_id();
	}

	public function update($code)
	{
		$data = array(
			'code' => $code,
			'name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'city' => $this->input->post('city'),
			'zip' => $this->input->post('zip'),
			'country' => $this->input->post('country'),
			'mobile' => $this->input->post('mobile'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
			'dob' => $this->input->post('dob'),
			'web' => $this->input->post('web'),
			'notes' => $this->input->post('notes'),
			'modified' => date('Y-m-d H:i:s', time()),
			'modified_by' => $this->session->userdata('user_id')
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('customers', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('customers');
	}

	public function delete_by_cmp($cmp_id)
	{
		$this->db->where('company_id', $cmp_id);
		$this->db->delete('customers');
	}

}
