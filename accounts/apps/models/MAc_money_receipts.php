<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MAc_money_receipts extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_by_id($id)
    {
        $data = array();
        $this->db->where('id', $id);
        $this->db->where('company_id', $this->session->userdata('user_company'));
        $q = $this->db->get('ac_money_receipts');
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

    public function get_by_doc($doc_type, $doc_no)
    {
        $data = array();
        $this->db->where('doc_type', $doc_type);
        $this->db->where('doc_no', $doc_no);
        $this->db->where('company_id', $this->session->userdata('user_company'));
        $q = $this->db->get('ac_money_receipts');
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

    public function get_latest()
    {
        $data = array();
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $this->db->where('company_id', $this->session->userdata('user_company'));
        $q = $this->db->get('ac_money_receipts');
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
        $this->db->select('receipts.*, emps.name as emp_name');
        $this->db->from('ac_money_receipts as receipts');
        $this->db->join('emps', 'receipts.emp_id=emps.id', 'left');
        $this->db->where('receipts.company_id', $this->session->userdata('user_company'));
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

    public function create()
    {
        $data = array(
            'company_id' => $this->session->userdata('user_company'),
            'customer_id' => $this->input->post('customer_id'),
            'emp_id' => $this->input->post('emp_id'),
            'mr_no' => $this->input->post('mr_no'),
            'mr_date' => date_to_db($this->input->post('mr_date')),
            'amount' => $this->input->post('amount'),
            'payment_type' => $this->input->post('payment_type'),
            'memo' => $this->input->post('memo'),
            'status' => 'Active',
            'created' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->userdata('user_id')
            );
        $this->db->insert('ac_money_receipts', $data);
    }

    public function create_by_sales($mr_no, $amount, $sales_no)
    {
        $data = array(
            'company_id' => $this->session->userdata('user_company'),
            'customer_id' => $this->input->post('customer_id'),
            'emp_id' => 0,
            'mr_no' => $mr_no,
            'mr_date' => date_to_db($this->input->post('sales_date')),
            'amount' => $amount,
            'payment_type' => 'cash',
            'memo' => 'Paid on Sales',
            'doc_type' => 'Sales',
            'doc_no' => $sales_no,
            'status' => 'Active',
            'created' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->userdata('user_id')
            );
        $this->db->insert('ac_money_receipts', $data);
    }

    public function update()
    {
        $data = array(
            'customer_id' => $this->input->post('customer_id'),
            'emp_id' => $this->input->post('emp_id'),
            'mr_no' => $this->input->post('mr_no'),
            'mr_date' => date_to_db($this->input->post('mr_date')),
            'amount' => $this->input->post('amount'),
            'payment_type' => $this->input->post('payment_type'),
            'memo' => $this->input->post('memo'),
            'status' => 'Active',
            'modified' => date('Y-m-d H:i:s', time()),
            'modified_by' => $this->session->userdata('user_id')
            );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('ac_money_receipts', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('ac_money_receipts');
    }

    public function delete_by_cmp($cmp_id)
    {
        $this->db->where('company_id', $cmp_id);
        $this->db->delete('ac_money_receipts');
    }

}