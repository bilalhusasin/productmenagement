<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSuppliers extends CI_Model {

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
     * Get supplier by id
     *
     * @param  integer  $id
     * @return void
     */
    public function get_by_id($id)
    {
        $data = array();
        $this->db->where('id', $id);
        $this->db->where('company_id', $this->session->user_company);
        $this->db->limit(1);
        $q = $this->db->get('suppliers');
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
     * Get latest supplier
     *
     * @return void
     */
    public function get_latest()
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $this->db->order_by('code', 'DESC');
        $this->db->limit(1);
        $q = $this->db->get('suppliers');
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
     * Get all suppliers
     *
     * @return void
     */
    public function get_all()
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('suppliers');
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
     * Create new supplier
     *
     * @param  string   $code
     * @param  integer  $ac_id
     * @return void
     */
    public function create($code, $ac_id)
    {
        $data = array(
            'company_id' => $this->session->user_company,
            'code' => $code,
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'phone_no' => $this->input->post('phone_no'),
            'contact_person' => $this->input->post('contact_person'),
            'notes' => $this->input->post('notes'),
            'status' => $this->input->post('status'),
            'ac_id' => $ac_id,
            'created_at' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->user_id
            );
        $this->db->insert('suppliers', $data);

        return $this->db->insert_id();
    }

    /**
     * Update supplier by code
     *
     * @param  string   $code
     * @return void
     */
    public function update($code)
    {
        $data = array(
            'code' => $code,
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'contact_person' => $this->input->post('contact_person'),
            'phone_no' => $this->input->post('phone_no'),
            'notes' => $this->input->post('notes'),
            'status' => $this->input->post('status'),
            'modified_at' => date('Y-m-d H:i:s', time()),
            'modified_by' => $this->session->user_id
            );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('suppliers', $data);
    }

    /**
     * Delete supplier by id
     *
     * @param  integer  $id
     * @return void
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('suppliers');
    }

    /**
     * Delete suppliers by company id
     *
     * @param  integer  $cmp_id
     * @return void
     */
    public function delete_by_cmp($cmp_id)
    {
        $this->db->where('company_id', $cmp_id);
        $this->db->delete('suppliers');
    }

}