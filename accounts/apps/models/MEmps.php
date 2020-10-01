<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MEmps extends CI_Model {

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
     * Get employee by id
     *
     * @param  integer  $id
     * @return array    $data
     */
    public function get_by_id($id)
    {
        $data = array();
        $this->db->select('emps.*, companies.name as company_name, companies.url as company_url');
        $this->db->from('emps');
        $this->db->join('companies', 'emps.company_id = companies.id', 'left');
        $this->db->where('emps.id', $id);
        $this->db->where('emps.company_id', $this->session->user_company);
        $q = $this->db->get();
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
     * Get the latest entry
     *
     * @return array    $data
     */
    public function get_latest()
    {
        $data = array();
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('emps');
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
     * Get all employee
     *
     * @return array    $data
     */
    public function get_all()
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('emps');
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
     * Create new employee
     *
     * @param  string   $code
     * @return void
     */
    public function create($code)
    {
        $data = array(
            'company_id' => $this->session->user_company,
            'code' => $code,
            'name' => $this->input->post('name'),
            'father_name' => $this->input->post('father_name'),
            'mother_name' => $this->input->post('mother_name'),
            'joining' => date_to_db($this->input->post('joining')),
            'present_address' => $this->input->post('present_address'),
            'permanent_address' => $this->input->post('permanent_address'),
            'voter_id' => $this->input->post('voter_id'),
            'department' => $this->input->post('department'),
            'designation' => $this->input->post('designation'),
            'mobile' => $this->input->post('mobile'),
            'email' => $this->input->post('email'),
            'notes' => $this->input->post('notes'),
            'status' => $this->input->post('status'),
            'created' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->user_id
            );
        $this->db->insert('emps', $data);
    }

    /**
     * Update employee information
     *
     * @return void
     */
    public function update()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'father_name' => $this->input->post('father_name'),
            'mother_name' => $this->input->post('mother_name'),
            'joining' => date_to_db($this->input->post('joining')),
            'present_address' => $this->input->post('present_address'),
            'permanent_address' => $this->input->post('permanent_address'),
            'voter_id' => $this->input->post('voter_id'),
            'department' => $this->input->post('department'),
            'designation' => $this->input->post('designation'),
            'mobile' => $this->input->post('mobile'),
            'email' => $this->input->post('email'),
            'notes' => $this->input->post('notes'),
            'status' => $this->input->post('status'),
            'modified' => date('Y-m-d H:i:s', time()),
            'modified_by' => $this->session->user_id
            );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('emps', $data);
    }

    /**
     * Delete employee by id
     *
     * @param  integer  $id
     * @return void
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('emps');
    }

    /**
     * Delete employee by company id
     *
     * @param  integer  $cmp_id
     * @return void
     */
    public function delete_by_cmp($cmp_id)
    {
        $this->db->where('company_id', $cmp_id);
        $this->db->delete('emps');
    }

}