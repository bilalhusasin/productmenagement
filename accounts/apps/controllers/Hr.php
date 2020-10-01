<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr extends CI_Controller {

	/**
     * Class constructor and validate authenticate user
     *
     * @return  void
     */
	public function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler(TRUE);
		if ( ! $this->session->user_id)
		{
			redirect('', 'refresh');
		}
		$this->privileges = $this->MUser_privileges->get_by_ref_user($this->session->user_id);
	}

	/**
	 * HR landing
	 *
	 * @return void
	 */
	public function index()
	{
		$data['title'] = 'POS System';
		$data['menu'] = 'hr';
		$data['content'] = 'admin/hr/home';
		$data['privileges'] = $this->privileges;
		$this->load->view('admin/template', $data);
	}

	/* -------------- Employee Start ------------------ */

	/**
	 * All Employee list
	 *
	 * @return void
	 */
	public function emp_list()
	{
		$data['title'] = 'POS System';
		$data['menu'] = 'hr';
		$data['content'] = 'admin/hr/emp/list';
		$data['emps'] = $this->MEmps->get_all();
		$data['privileges'] = $this->privileges;
		$this->load->view('admin/template', $data);
	}

	/**
	 * View particular employee details by id
	 *
	 * @param  integer 	$id
	 * @return void
	 */
	public function emp_details($id)
	{
		$data['title'] = 'POS System';
		$data['menu'] = 'hr';
		$data['content'] = 'admin/hr/emp/details';
		$data['emp'] = $this->MEmps->get_by_id($id);
		$data['privileges'] = $this->privileges;
		$this->load->view('admin/template', $data);
	}

	/**
	 * Add new employee or edit employee details by id
	 *
	 * @param  integer 	$id
	 * @return void
	 */
	public function emp_save($id = NULL)
	{
		if ($this->input->post())
		{
			if ($this->input->post('id') == "")
			{
				$emp = $this->MEmps->get_latest();
				if (count($emp) > 0)
				{
					$code = (int) $emp['code'] + 1;
				}
				else
				{
					$code = 1001;
				}
				$this->MEmps->create($code);
			}
			else
			{
				$this->MEmps->update();
			}
			$this->session->set_flashdata('success', 'Employee saved successfully.');
			redirect('hr/emp-list', 'refresh');
		}
		else
		{
			$data['title'] = 'POS System';
			$data['menu'] = 'hr';
			$data['emp'] = $this->MEmps->get_by_id($id);
			$data['content'] = 'admin/hr/emp/save';
			$data['privileges'] = $this->privileges;
			$this->load->view('admin/template', $data);
		}
	}

	/**
	 * Delete employee by id
	 *
	 * @param  integer 	$id
	 * @return void
	 */
	public function emp_delete($id)
	{
		$this->MEmps->delete($id);
		$this->session->set_flashdata('success', 'Employee delete successfully.');
		redirect('hr/emp-list', 'refresh');
	}

	/* -------------- Employee End -------------------- */
}
