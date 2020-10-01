<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MAc_payment_receipts extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_by_id($id)
    {
        $data = array();
        $this->db->where('id', $id);
        $this->db->where('company_id', $this->session->userdata('user_company'));
        $q = $this->db->get('ac_payment_receipts');
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
        $q = $this->db->get('ac_payment_receipts');
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
        $q = $this->db->get('ac_payment_receipts');
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
        $this->db->from('ac_payment_receipts as receipts');
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
            'supplier_id' => $this->input->post('supplier_id'),
            'emp_id' => $this->input->post('emp_id'),
            'payment_no' => $this->input->post('payment_no'),
            'payment_date' => date_to_db($this->input->post('payment_date')),
            'amount' => $this->input->post('amount'),
            'payment_type' => $this->input->post('payment_type'),
            'memo' => $this->input->post('memo'),
            'status' => 'Active',
            'created' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->userdata('user_id')
            );
        $this->db->insert('ac_payment_receipts', $data);
    }

    public function create_by_purchase($payment_no, $amount, $purchase_no)
    {
        $data = array(
            'company_id' => $this->session->userdata('user_company'),
            'supplier_id' => $this->input->post('supplier_id'),
            'emp_id' => 0,
            'payment_no' => $payment_no,
            'payment_date' => date_to_db($this->input->post('purchase_date')),
            'amount' => $amount,
            'payment_type' => 'cash',
            'memo' => 'Paid on Purchase',
            'doc_type' => 'Purchase',
            'doc_no' => $purchase_no,
            'status' => 'Active',
            'created' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->userdata('user_id')
            );
        $this->db->insert('ac_payment_receipts', $data);
    }

    public function update()
    {
        $data = array(
            'supplier_id' => $this->input->post('supplier_id'),
            'emp_id' => $this->input->post('emp_id'),
            'payment_no' => $this->input->post('payment_no'),
            'payment_date' => date_to_db($this->input->post('payment_date')),
            'amount' => $this->input->post('amount'),
            'payment_type' => $this->input->post('payment_type'),
            'memo' => $this->input->post('memo'),
            'status' => 'Active',
            'modified' => date('Y-m-d H:i:s', time()),
            'modified_by' => $this->session->userdata('user_id')
            );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('ac_payment_receipts', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('ac_payment_receipts');
    }

    public function delete_by_cmp($cmp_id)
    {
        $this->db->where('company_id', $cmp_id);
        $this->db->delete('ac_payment_receipts');
    }

}