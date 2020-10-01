<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MUser_privileges extends CI_Model {

    public $tablename;

    /**
     * Class constructor and validate authenticate user
     *
     * @return  void
     */
    public function __construct()
    {
        parent::__construct();
        $this->tablename = 'user_privileges';
    }

    public function get_by_id($id)
    {
        $data = array();
        $this->db->where('id', $id);
        $this->db->limit(1);
        $q = $this->db->get($this->tablename);
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

    public function get_by_ref_user($ref_user)
    {
        $data = array();
        $this->db->where('ref_user', $ref_user);
        $this->db->limit(1);
        $q = $this->db->get($this->tablename);
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
        if ($this->session->user_type != 'Admin')
        {
            $this->db->where('company_id', $this->session->user_company);
        }
        $q = $this->db->get($this->tablename);
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

    public function create()
    {
        $data = array(
            'company_id' => $this->session->user_company,
            'ref_user' => $this->input->post('ref_user'),
            'inventory_menu' => $this->input->post('inventory_menu'),
            'sales' => $this->input->post('sales'),
            'sales_return' => $this->input->post('sales_return'),
            'purchase' => $this->input->post('purchase'),
            'purchase_return' => $this->input->post('purchase_return'),
            'supplier' => $this->input->post('supplier'),
            'item' => $this->input->post('item'),
            'customer' => $this->input->post('customer'),
            'hr_menu' => $this->input->post('hr_menu'),
            'employee' => $this->input->post('employee'),
            'accounts_menu' => $this->input->post('accounts_menu'),
            'journal' => $this->input->post('journal'),
            'ac_head' => $this->input->post('ac_head'),
            'money_receipt' => $this->input->post('money_receipt'),
            'payment_receipt' => $this->input->post('payment_receipt'),
            'report_menu' => $this->input->post('report_menu'),
            'purchase_report' => $this->input->post('purchase_report'),
            'purchase_return_report' => $this->input->post('purchase_return_report'),
            'sales_report' => $this->input->post('sales_report'),
            'sales_return_report' => $this->input->post('sales_return_report'),
            'inventory_report' => $this->input->post('inventory_report'),
            'ledger_report' => $this->input->post('ledger_report'),
            'trial_balance_report' => $this->input->post('trial_balance_report'),
            'balance_sheet_report' => $this->input->post('balance_sheet_report'),
            'income_statement_report' => $this->input->post('income_statement_report'),
            'bills_receivable_report' => $this->input->post('bills_receivable_report'),
            'bills_payable_report' => $this->input->post('bills_payable_report'),
            'cash_book_report' => $this->input->post('cash_book_report'),
            'bank_book_report' => $this->input->post('bank_book_report'),
            'settings_menu' => $this->input->post('settings_menu'),
            'basic_settings' => $this->input->post('basic_settings'),
            'currency_settings' => $this->input->post('currency_settings'),
            'company_settings' => $this->input->post('company_settings'),
            'default_ac_head_settings' => $this->input->post('default_ac_head_settings'),
            'user_menu' => $this->input->post('user_menu'),
            'user_section' => $this->input->post('user_section'),
            'created' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->user_id
            );
        $this->db->insert($this->tablename, $data);
    }

    public function update()
    {
        $data = array(
            'company_id' => $this->session->user_company,
            'ref_user' => $this->input->post('ref_user'),
            'inventory_menu' => $this->input->post('inventory_menu'),
            'sales' => $this->input->post('sales'),
            'sales_return' => $this->input->post('sales_return'),
            'purchase' => $this->input->post('purchase'),
            'purchase_return' => $this->input->post('purchase_return'),
            'supplier' => $this->input->post('supplier'),
            'item' => $this->input->post('item'),
            'customer' => $this->input->post('customer'),
            'hr_menu' => $this->input->post('hr_menu'),
            'employee' => $this->input->post('employee'),
            'accounts_menu' => $this->input->post('accounts_menu'),
            'journal' => $this->input->post('journal'),
            'ac_head' => $this->input->post('ac_head'),
            'money_receipt' => $this->input->post('money_receipt'),
            'payment_receipt' => $this->input->post('payment_receipt'),
            'report_menu' => $this->input->post('report_menu'),
            'purchase_report' => $this->input->post('purchase_report'),
            'purchase_return_report' => $this->input->post('purchase_return_report'),
            'sales_report' => $this->input->post('sales_report'),
            'sales_return_report' => $this->input->post('sales_return_report'),
            'inventory_report' => $this->input->post('inventory_report'),
            'ledger_report' => $this->input->post('ledger_report'),
            'trial_balance_report' => $this->input->post('trial_balance_report'),
            'balance_sheet_report' => $this->input->post('balance_sheet_report'),
            'income_statement_report' => $this->input->post('income_statement_report'),
            'bills_receivable_report' => $this->input->post('bills_receivable_report'),
            'bills_payable_report' => $this->input->post('bills_payable_report'),
            'cash_book_report' => $this->input->post('cash_book_report'),
            'bank_book_report' => $this->input->post('bank_book_report'),
            'settings_menu' => $this->input->post('settings_menu'),
            'basic_settings' => $this->input->post('basic_settings'),
            'currency_settings' => $this->input->post('currency_settings'),
            'company_settings' => $this->input->post('company_settings'),
            'default_ac_head_settings' => $this->input->post('default_ac_head_settings'),
            'user_menu' => $this->input->post('user_menu'),
            'user_section' => $this->input->post('user_section'),
            'modified' => date('Y-m-d H:i:s', time()),
            'modified_by' => $this->session->userdata('user_id')
            );

        $this->db->where('ref_user', $this->input->post('ref_user'));
        $this->db->update($this->tablename, $data);
    }

    public function delete_by_ref_user($ref_user)
    {
        $this->db->where('ref_user', $ref_user);
        $this->db->delete($this->tablename);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->tablename);
    }

    public function power_user($company_id, $ref_user)
    {
        $data = array(
            'company_id' => $company_id,
            'ref_user' => $ref_user,
            'inventory_menu' => 1,
            'sales' => 1,
            'sales_return' => 1,
            'purchase' => 1,
            'purchase_return' => 1,
            'supplier' => 1,
            'item' => 1,
            'customer' => 1,
            'hr_menu' => 1,
            'employee' => 1,
            'accounts_menu' => 1,
            'journal' => 1,
            'ac_head' => 1,
            'money_receipt' => 1,
            'payment_receipt' => 1,
            'report_menu' => 1,
            'purchase_report' => 1,
            'purchase_return_report' => 1,
            'sales_report' => 1,
            'sales_return_report' => 1,
            'inventory_report' => 1,
            'ledger_report' => 1,
            'trial_balance_report' => 1,
            'balance_sheet_report' => 1,
            'income_statement_report' => 1,
            'bills_receivable_report' => 1,
            'bills_payable_report' => 1,
            'cash_book_report' => 1,
            'bank_book_report' => 1,
            'settings_menu' => 1,
            'basic_settings' => 1,
            'currency_settings' => 1,
            'company_settings' => 1,
            'default_ac_head_settings' => 1,
            'user_menu' => 1,
            'user_section' => 1,
            'created' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->user_id
            );
        $this->db->insert($this->tablename, $data);
    }

    public function delete_by_cmp($cmp_id)
    {
        $this->db->where('company_id', $cmp_id);
        $this->db->delete($this->tablename);
    }

}