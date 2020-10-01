<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MCompanies extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_by_id($id)
    {
        $data = array();
        $this->db->where('id', $id);
        $q = $this->db->get('companies');
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
        //$data = array();
        $this->db->where('id', $id);
        $q = $this->db->get('companies');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $data = $row['full_name'];
            }
        }

        $q-Si>free_result();
        return $data;
    }

    public function get_latest()
    {
        $data = array();
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $q = $this->db->get('companies');
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
        $q = $this->db->get('companies');
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

    public function get_all_dropdown()
    {
        $q = $this->db->get('companies');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $data[$row['id']] = $row['full_name'];
            }
        }
        else
        {
            $data['0'] = 'No Customer Added';
        }

        $q->free_result();
        return $data;
    }

    public function create()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'area' => $this->input->post('area'),
            'city' => $this->input->post('city'),
            'zip' => $this->input->post('zip'),
            'country' => $this->input->post('country'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            'contact_person' => $this->input->post('contact_person'),
            'mobile_no' => $this->input->post('mobile_no'),
            'currency_id' => $this->input->post('currency_id'),
            'currency_symbol_position' => $this->input->post('currency_symbol_position'),
            'status' => $this->input->post('status'),
            'created' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->userdata('user_id')
            );
        $this->db->insert('companies', $data);

        return $this->db->insert_id();
    }

    public function add_logo($logo, $company_id)
    {
        $data = array('logo' => $logo);
        $this->db->where('id', $company_id);
        $this->db->update('companies', $data);
    }

    public function update()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'area' => $this->input->post('area'),
            'city' => $this->input->post('city'),
            'zip' => $this->input->post('zip'),
            'country' => $this->input->post('country'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            'contact_person' => $this->input->post('contact_person'),
            'mobile_no' => $this->input->post('mobile_no'),
            'currency_id' => $this->input->post('currency_id'),
            'currency_symbol_position' => $this->input->post('currency_symbol_position'),
            'status' => $this->input->post('status'),
            'modified' => date('Y-m-d H:i:s', time()),
            'modified_by' => $this->session->userdata('user_id')
            );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('companies', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('companies');
    }

}
