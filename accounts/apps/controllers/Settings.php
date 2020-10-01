<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

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
     * Settings landing
     *
     * @return void
     */
    public function index()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'settings';
        $data['content'] = 'admin/settings/home';
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Basic settings for company
     *
     * @return void
     */
    public function basic()
    {
        if ($this->input->post())
        {
            if ($this->input->post('id'))
            {
                $this->MSettings->update();
            }
            else
            {
                $this->MSettings->create($this->session->user_company);
            }
            $this->session->set_flashdata('success', 'Basic settings saved successfully.');
            redirect('settings', 'refresh');
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'settings';
            $data['content'] = 'admin/settings/basic';
            $data['settings'] = $this->MSettings->get_by_company_id($this->session->user_company);
            if ($data['settings'])
            {
                $data['payable_tree'] = $this->MAc_charts->get_coa_tree($data['settings']['ac_payable']);
                $data['receivable_tree'] = $this->MAc_charts->get_coa_tree($data['settings']['ac_receivable']);
                $data['cash_tree'] = $this->MAc_charts->get_coa_tree($data['settings']['ac_cash']);
                $data['bank_tree'] = $this->MAc_charts->get_coa_tree($data['settings']['ac_bank']);
                $data['sales_tree'] = $this->MAc_charts->get_coa_tree($data['settings']['ac_sales']);
                $data['purchase_tree'] = $this->MAc_charts->get_coa_tree($data['settings']['ac_purchase']);
                $data['inventory_tree'] = $this->MAc_charts->get_coa_tree($data['settings']['ac_inventory']);
                $data['cogs_tree'] = $this->MAc_charts->get_coa_tree($data['settings']['ac_cogs']);
                $data['tax_tree'] = $this->MAc_charts->get_coa_tree($data['settings']['ac_tax']);
                $data['tax_rate'] = $data['settings']['tax_rate'];
            }
            else
            {
                $data['payable_tree'] = $this->MAc_charts->get_coa_tree();
                $data['receivable_tree'] = $this->MAc_charts->get_coa_tree();
                $data['cash_tree'] = $this->MAc_charts->get_coa_tree();
                $data['bank_tree'] = $this->MAc_charts->get_coa_tree();
                $data['sales_tree'] = $this->MAc_charts->get_coa_tree();
                $data['purchase_tree'] = $this->MAc_charts->get_coa_tree();
                $data['inventory_tree'] = $this->MAc_charts->get_coa_tree();
                $data['cogs_tree'] = $this->MAc_charts->get_coa_tree();
                $data['tax_tree'] = $this->MAc_charts->get_coa_tree();
                $data['tax_rate'] = 0;
            }
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    /**
     * Company list
     *
     * @return void
     */
    public function cmp_list()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'settings';
        $data['content'] = 'admin/settings/company/list';
        $data['companies'] = $this->MCompanies->get_all();
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Add or edit company
     *
     * @param  integer  $id
     * @return void
     */
    public function cmp_save($id = NULL)
    {
        if ($this->input->post())
        {
            if ($this->input->post('id'))
            {
                $this->MCompanies->update();
                $company_id = $this->input->post('id');
            }
            else
            {
                $company_id = $this->MCompanies->create();
                $ref_user = $this->MUsers->create($company_id, $this->input->post('contact_person'), 'Power User', 'Active');
                $this->MUser_privileges->power_user($company_id, $ref_user);
                $this->MAc_charts->basic_setup($company_id, $ref_user);
            }

            // if ($_FILES['logo']['name'])
            // {
            //     $config['file_name'] = $company_id;
            //     $config['upload_path'] = './uploads/companies/';
            //     $config['allowed_types'] = 'gif|jpg|png';
            //     $config['overwrite'] = TRUE;
            //     $this->upload->initialize($config);

            //     if ( ! $this->upload->do_upload("logo"))
            //     {
            //         $error = array('error' => $this->upload->display_errors());
            //         print_r($error);
            //     }
            //     else
            //     {
            //         $filedata = $this->upload->data();
            //         $this->MCompanies->add_logo($filedata['file_name'], $company_id);

            //         $con['image_library'] = 'gd2';
            //         $con['source_image'] = './uploads/companies/' . $filedata['file_name'];
            //         $con['maintain_ratio'] = TRUE;
            //         $con['overwrite'] = TRUE;
            //         $con['width'] = 150;
            //         $con['height'] = 50;
            //         $this->load->library('image_lib', $con);
            //         $this->image_lib->resize();
            //         $this->image_lib->clear();
            //     }
            // }

            $this->session->set_flashdata('success', 'Company saved successfully.');
            redirect('settings/cmp-list', 'refresh');
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'settings';
            $data['content'] = 'admin/settings/company/save';
            $data['company'] = $this->MCompanies->get_by_id($id);
            $data['currencies'] = $this->MCurrencies->get_all();
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    /**
     * Delete company and all its related data
     *
     * @param  integer  $id
     * @return void
     */
    public function cmp_delete($id)
    {
        $this->MAc_charts->delete_by_cmp($id);
        $this->MAc_journal_details->delete_by_cmp($id);
        $this->MAc_journal_master->delete_by_cmp($id);
        $this->MAc_money_receipts->delete_by_cmp($id);
        $this->MAc_payment_receipts->delete_by_cmp($id);
        $this->MCustomers->delete_by_cmp($id);
        $this->MEmps->delete_by_cmp($id);
        $this->MItems->delete_by_cmp($id);
        $this->MPurchase_details->delete_by_cmp($id);
        $this->MPurchase_master->delete_by_cmp($id);
        $this->MSales_details->delete_by_cmp($id);
        $this->MSales_master->delete_by_cmp($id);
        $this->MSettings->delete_by_cmp($id);
        $this->MSuppliers->delete_by_cmp($id);
        $this->MUser_privileges->delete_by_cmp($id);
        $this->MUsers->delete_by_cmp($id);
        $this->MCompanies->delete($id);
        $this->session->set_flashdata('success', 'Company deleted successfully.');
        redirect('settings/cmp-list', 'refresh');
    }

    /**
     * Change current company, only if you are admin
     *
     * @param  integer  $id
     * @return void
     */
    public function cmp_set($id)
    {
        $this->session->unset_userdata('user_company');
        $this->session->set_userdata('user_company', $id);
        $this->session->set_flashdata('success', 'Company changed successfully.');
        redirect('settings', 'refresh');
    }

    //Chart of Accounts Start ---------------

    /**
     * Default chart of accounts list
     *
     * @return void
     */
    public function chart_list()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'settings';
        $data['content'] = 'admin/settings/chart/list';
        $data['charts'] = $this->MAc_default_charts->get_coa_list();
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Add or edit default chart of accounts
     *
     * @param  integer  $id
     * @return void
     */
    public function chart_save($id = NULL)
    {
        if ($this->input->post())
        {
            if ($this->input->post('id'))
            {
                $this->MAc_default_charts->update();
            }
            else
            {
                $this->MAc_default_charts->create();
            }
            $this->session->set_flashdata('success', 'Default A/C Head saved successfully.');
            redirect('settings/chart-list', 'refresh');
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'settings';
            $data['content'] = 'admin/settings/chart/save';
            $data['chart'] = $this->MAc_default_charts->get_by_id($id);
            if ($id)
            {
                $data['ac_chart_tree'] = $this->MAc_default_charts->get_coa_tree($data['chart']['parent_id']);
            }
            else
            {
                $data['ac_chart_tree'] = $this->MAc_default_charts->get_coa_tree();
            }
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    /**
     * Delete default chart of accounts
     *
     * @param  integer  $id
     * @return void
     */
    public function chart_delete($id)
    {
        $this->MAc_default_charts->delete($id);
        $this->session->set_flashdata('success', 'Default A/C Head deleted successfully.');
        redirect('settings/chart-list', 'refresh');
    }

    //Chart of Accounts End ---------------

    //Currency Start ---------------

    /**
     * Currently list
     *
     * @return void
     */
    public function currency_list()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'settings';
        $data['content'] = 'admin/settings/currency/list';
        $data['currencies'] = $this->MCurrencies->get_all();
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Add or edit currency
     *
     * @param  integer  $id
     * @return void
     */
    public function currency_save($id = NULL)
    {
        if ($this->input->post())
        {
            if ($this->input->post('id'))
            {
                $this->MCurrencies->update();
                $this->session->set_flashdata('success', 'Currency updated successfully.');
            }
            else
            {
                $this->MCurrencies->create();
                $this->session->set_flashdata('success', 'Currency created successfully.');
            }
            redirect('settings/currency-list', 'refresh');
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'settings';
            $data['content'] = 'admin/settings/currency/save';
            $data['currency'] = $this->MCurrencies->get_by_id($id);
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    /**
     * Delete currency
     *
     * @param  integer  $id
     * @return void
     */
    public function currency_delete($id)
    {
        $this->MCurrencies->delete($id);
        $this->session->set_flashdata('success', 'Currency deleted successfully.');
        redirect('settings/currency-list', 'refresh');
    }

    //Currency End ---------------

}