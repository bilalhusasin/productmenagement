<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MItems extends CI_Model {

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
     * Get item by id
     *
     * @param  integer  $id
     * @return array    $data
     */
    public function get_by_id($id)
    {
        $data = array();
        $this->db->where('id', $id);
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('items');
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
     * Get latest item
     *
     * @return array    $data
     */
    public function get_latest()
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $q = $this->db->get('items');
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
     * Get item by code
     *
     * @param  string   $code
     * @return array    $data
     */
    public function get_by_code($code)
    {
        $data = array();
        $this->db->where('code', $code);
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('items');
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
     * Get item by name
     *
     * @param  string   $name
     * @return array    $data
     */
    public function get_by_name($name)
    {
        $data = array();
        $this->db->where('name', $name);
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('items');
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
     * Get all items
     *
     * @param  string   $status
     * @return array    $data
     */
    public function get_all($status = NULL)
    {
        $data = array();
        if ($status)
        {
            $this->db->where('status', $status);
        }
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('items');
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
     * Get all item as relative array for dropdown
     *
     * @param  string   $status
     * @return array    $data
     */
    public function get_all_dropdown($status = NULL)
    {
        if ($status)
        {
            $this->db->where('status', $status);
        }
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('items');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $data[$row['id']] = $row['name'];
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Create item
     *
     * @return void
     */
    public function create()
    {
        $data = array(
            'company_id' => $this->session->user_company,
            'code' => $this->input->post('code'),
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'min_sale_price' => $this->input->post('min_sale_price'),
            're_order' => $this->input->post('re_order'),
            'status' => $this->input->post('status'),
            'created' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->user_id
            );
        $this->db->insert('items', $data);
    }

    /**
     * Update item
     *
     * @return void
     */
    public function update()
    {
        $data = array(
            'code' => $this->input->post('code'),
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'min_sale_price' => $this->input->post('min_sale_price'),
            're_order' => $this->input->post('re_order'),
            'status' => $this->input->post('status'),
            'modified' => date('Y-m-d H:i:s', time()),
            'modified_by' => $this->session->user_id
            );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('items', $data);
    }

    /**
     * Update item field by id
     *
     * @param  integer  $id
     * @param  string   $field
     * @param  midex    $value
     * @return void
     */
    public function update_field($id, $field, $value)
    {
        $data = array(
            $field => $value,
            'modified' => date('Y-m-d H:i:s', time()),
            'modified_by' => $this->session->user_id
            );
        $this->db->where('id', $id);
        $this->db->update('items', $data);
    }

    /**
     * Delete item by id
     *
     * @param  integer  $id
     * @return void
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('items');
    }

    /**
     * Delete item by company id
     *
     * @param  integer  $cmp_id
     * @return void
     */
    public function delete_by_cmp($cmp_id)
    {
        $this->db->where('company_id', $cmp_id);
        $this->db->delete('items');
    }

}
