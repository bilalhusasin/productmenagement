<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MCurrencies extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_by_id($id)
    {
        $data = array();
        $this->db->where('id', $id);
        $q = $this->db->get('currencies');
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
        $this->db->order_by('fullname', 'ASC');
        $q = $this->db->get('currencies');
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
            'shortname' => $this->input->post('shortname'),
            'fullname' => $this->input->post('fullname'),
            'symbol' => $this->input->post('symbol'),
            'status' => $this->input->post('status'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->userdata('user_id')
            );
        $this->db->insert('currencies', $data);

        return $this->db->insert_id();
    }

    public function update()
    {
        $data = array(
            'shortname' => $this->input->post('shortname'),
            'fullname' => $this->input->post('fullname'),
            'symbol' => $this->input->post('symbol'),
            'status' => $this->input->post('status'),
            'modified_at' => date('Y-m-d H:i:s', time()),
            'modified_by' => $this->session->userdata('user_id')
            );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('currencies', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('currencies');
    }

}