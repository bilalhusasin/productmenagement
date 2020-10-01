<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSettings extends CI_Model {

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
	 * Get by id
	 *
	 * @param  integer 	$id
	 * @return array 	$data
	 */
	public function get_by_id($id)
	{
		$data = array();
		$this->db->where('id', $id);
		$this->db->limit(1);
		$q = $this->db->get('settings');
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
	 * Get by company id
	 *
	 * @param  integer 	$company_id
	 * @return array 	$data
	 */
	public function get_by_company_id($company_id)
	{
		$data = array();
		$this->db->where('company_id', $company_id);
		$this->db->limit(1);
		$q = $this->db->get('settings');
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
	 * Get all
	 *
	 * @return array 	$data
	 */
	public function get_all()
	{
		$data = array();
		if ($this->session->user_type != 'Admin')
		{
			$this->db->where('company_id', $this->session->user_company);
		}
		$q = $this->db->get('settings');
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
	 * Create settings
	 *
	 * @param  integer 	$company_id
	 * @param  integer 	$ac_receivable
	 * @param  integer 	$ac_payable
	 * @param  integer 	$ac_cash
	 * @param  integer 	$ac_bank
	 * @param  integer 	$ac_sales
	 * @param  integer 	$ac_purchase
	 * @param  integer 	$ac_inventory
	 * @param  integer 	$ac_cogs
	 * @param  integer 	$ac_tax
	 * @return integer 	insert_id
	 */
	public function create($company_id, $ac_receivable, $ac_payable, $ac_cash, $ac_bank, $ac_sales, $ac_purchase, $ac_inventory, $ac_cogs, $ac_tax)
	{
		$data = array(
			'company_id' => $company_id,
			'ac_receivable' => $ac_receivable,
			'ac_payable' => $ac_payable,
			'ac_cash' => $ac_cash,
			'ac_bank' => $ac_bank,
			'ac_sales' => $ac_sales,
			'ac_purchase' => $ac_purchase,
			'ac_inventory' => $ac_inventory,
			'ac_cogs' => $ac_cogs,
			'ac_tax' => $ac_tax,
			'tax_rate' => 0,
			'created_at' => date('Y-m-d H:i:s', time()),
			'created_by' => $this->session->user_id
			);
		$this->db->insert('settings', $data);

		return $this->db->insert_id();
	}

	/**
	 * Update settings
	 *
	 * @return void
	 */
	public function update()
	{
		$data = array(
			'ac_receivable' => $this->input->post('ac_receivable'),
			'ac_payable' => $this->input->post('ac_payable'),
			'ac_cash' => $this->input->post('ac_cash'),
			'ac_bank' => $this->input->post('ac_bank'),
			'ac_sales' => $this->input->post('ac_sales'),
			'ac_purchase' => $this->input->post('ac_purchase'),
			'ac_inventory' => $this->input->post('ac_inventory'),
			'ac_cogs' => $this->input->post('ac_cogs'),
			'ac_tax' => $this->input->post('ac_tax'),
			'tax_rate' => $this->input->post('tax_rate'),
			'modified_at' => date('Y-m-d H:i:s', time()),
			'modified_by' => $this->session->user_id
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('settings', $data);
	}

	/**
	 * Delete by id
	 *
	 * @param  integer 	$id
	 * @return void
	 */
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('settings');
	}

	/**
	 * Delete by company id
	 *
	 * @param  integer 	$company_id
	 * @return void
	 */
	public function delete_by_cmp($company_id)
	{
		$this->db->where('company_id', $company_id);
		$this->db->delete('settings');
	}

}
