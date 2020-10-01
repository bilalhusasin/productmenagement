<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
	 * User landing
	 *
	 * @return 	void
	 */
	public function index()
	{
		$data['title'] = 'POS System';
		$data['menu'] = 'user';
		$data['content'] = 'admin/user/home';
		$data['users'] = $this->MUsers->get_all();
		$data['privileges'] = $this->privileges;
		$this->load->view('admin/template', $data);
	}

	/**
	 * All user list
	 *
	 * @return 	void
	 */
	public function list_all()
	{
		$data['title'] = 'POS System';
		$data['menu'] = 'user';
		$data['content'] = 'admin/user/list';
		$data['users'] = $this->MUsers->get_all();
		$data['privileges'] = $this->privileges;
		$this->load->view('admin/template', $data);
	}

	/**
	 * Add new user or edit user by id
	 *
	 * @param  integer 	$id
	 * @return void
	 */
	public function save($id = NULL)
	{
		if ($this->input->post())
		{
			if ($this->input->post('id'))
			{
				$this->MUsers->update($this->input->post('id'));
				$this->session->set_flashdata('success', 'User updated successfully.');
				redirect('user/list-all', 'refresh');
			}
			else
			{
				$user = $this->MUsers->get_by_email($this->input->post('email'));
				if (count($user) > 0)
				{
					$this->session->set_flashdata('error', 'Email already exists, Please try with another email.');
					redirect('user/list-all', 'refresh');
				}
				else
				{
					$name = $this->input->post('name');
					$type = $this->input->post('type');
					$status = $this->input->post('status');

					if ($this->session->user_type == 'Admin')
					{
						$company_id = $this->input->post('company_id');
					}
					else
					{
						$company_id = $this->session->user_company;
					}
					if ($this->session->user_type == 'User')
					{
						$type = 'User';
						$status = 'Inactive';
					}

					$user_id = $this->MUsers->create($company_id, $name, $type, $status);
					if ($this->session->user_type == 'User')
					{
						$this->session->set_flashdata('success', 'User created successfully. Currently the user is inactive and has no privilege, an Admin or Power User need to active and give privileges before the user can login.');
						redirect('user', 'refresh');
					}
					$this->session->set_flashdata('success', 'User created successfully. Now give the user your desire privileges.');
					redirect('user/privileges/' . $user_id, 'refresh');
				}
			}
		}
		else
		{
			$data['title'] = 'POS System';
			$data['menu'] = 'user';
			$data['content'] = 'admin/user/save';
			$data['user'] = $this->MUsers->get_by_id($id);
			$data['companies'] = $this->MCompanies->get_all();
			$data['privileges'] = $this->privileges;
			$this->load->view('admin/template', $data);
		}
	}

	/**
	 * Delete user by id
	 *
	 * @param  integer 	$id
	 * @return void
	 */
	public function delete($id)
	{
		$this->MUsers->delete($id);
		$this->MUser_privileges->delete_by_ref_user($id);
		$this->session->set_flashdata('success', 'User deleted successfully.');

		redirect('user/list-all', 'refresh');
	}

	/**
	 * Change own password
	 *
	 * @param  integer 	$id
	 * @return void
	 */
	public function change_password($id = NULL)
	{
		if ($this->input->post())
		{
			$password = substr(do_hash($this->input->post('current_password')), 0, 16);
			$user = $this->MUsers->get_by_id($this->session->user_id);
			if ($user['password'] != $password)
			{
				$this->session->set_flashdata('error', 'Wrong current password.');
				redirect('user/change-password', 'refresh');
			}
			else if ($this->input->post('new_password') != $this->input->post('confirm_new_password'))
			{
				$this->session->set_flashdata('error', 'Confirm password mismatch.');
				redirect('user/change-password', 'refresh');
			}
			else
			{
				$this->MUsers->update_password($this->session->user_id);
				$this->session->set_flashdata('success', 'Password changed successfully.');
				redirect('user/change-password', 'refresh');
			}
		}
		else
		{
			$data['title'] = 'POS System';
			$data['menu'] = 'change_password';
			$data['content'] = 'admin/user/change_password';
			$data['privileges'] = $this->privileges;
			$this->load->view('admin/template', $data);
		}
	}

	/**
	 * Update user privileges by ref. user id
	 *
	 * @param  integer 	$ref_user
	 * @return void
	 */
	public function privileges($ref_user = NULL)
	{
		if ($this->input->post())
		{
			if ($this->MUser_privileges->get_by_ref_user($this->input->post('ref_user')))
			{
				$this->MUser_privileges->update();
				$this->session->set_flashdata('success', 'Privileges updated successfully.');
			}
			else
			{
				$this->MUser_privileges->create();
				$this->session->set_flashdata('success', 'Privileges created successfully.');
			}
			redirect('user/list-all', 'refresh');
		}
		else
		{
			$data['title'] = 'POS System';
			$data['menu'] = 'user';
			$data['content'] = 'admin/user/privileges';
			$data['privilege'] = $this->MUser_privileges->get_by_ref_user($ref_user);
			$data['ref_user'] = $this->MUsers->get_by_id($ref_user);
			$data['privileges'] = $this->privileges;
			$this->load->view('admin/template', $data);
		}
	}

}
