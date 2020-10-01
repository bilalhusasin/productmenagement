<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MPurchase_master extends CI_Model {

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
     * Get purchase master by id
     *
     * @param  integer  $id
     * @return void
     */
    public function get_by_id($id)
    {
        $data = array();
        $this->db->select('purchase_master.*, suppliers.name, suppliers.address, suppliers.contact_person, suppliers.phone_no');
        $this->db->from('purchase_master');
        $this->db->join('suppliers', 'purchase_master.supplier_id=suppliers.id');
        $this->db->where('purchase_master.company_id', $this->session->user_company);
        $this->db->where('purchase_master.id', $id);
        $q = $this->db->get();
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $item_qty = $this->MPurchase_details->get_total_quantity($row['purchase_no']);
                $row['item_qty'] = $item_qty;
                $amount = $this->MPurchase_details->get_total_price($row['purchase_no']);
                $row['amount'] = $amount;
                $data = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Get purchase master by purchase no
     *
     * @param  string   $purchase_no
     * @return array    $data
     */
    public function get_by_purchase_no($purchase_no = NULL)
    {
        $data = array();
        $this->db->select('purchase_master.*, SUM(purchase_details.quantity) as quantity, suppliers.name as supplier_name, suppliers.address as supplier_address, suppliers.phone_no as supplier_mobile');
        $this->db->from('purchase_master');
        $this->db->join('purchase_details', 'purchase_master.purchase_no = purchase_details.purchase_no', 'left');
        $this->db->join('suppliers', 'purchase_master.supplier_id = suppliers.id', 'left');
        if ($purchase_no)
        {
            $this->db->where('purchase_master.purchase_no', $purchase_no);
        }
        $this->db->where('purchase_master.company_id', $this->session->user_company);
        $this->db->group_by("purchase_master.purchase_no");
        $this->db->order_by('purchase_master.id', 'ASC');
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

    /**
     * Get last purchase no
     *
     * @return array    $data
     */
    public function get_last_purchase_no()
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $this->db->order_by('purchase_no', 'DESC');
        $this->db->limit(1);
        $q = $this->db->get('purchase_master');
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
     * Get latest purchase master
     *
     * @return array    $data
     */
    public function get_latest()
    {
        $data = array();
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $q = $this->db->get('purchase_master');
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
     * Get all purchase master list
     * --Need to optimize the sql--
     *
     * @return array    $data
     */
    public function get_all()
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('purchase_master');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $supplier = $this->MSuppliers->get_by_id($row['supplier_id']);
                $qty = $this->MPurchase_details->get_total_quantity($row['purchase_no']);
                $price = $this->MPurchase_details->get_total_price($row['purchase_no']);
                $row['supplier_name'] = $supplier['name'];
                $row['total_qty'] = $qty;
                $row['total_price'] = $price;
                $data[] = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Get purchase master by supplier by
     *
     * @param  integer  $supplier_id
     * @return array    $data
     */
    public function get_by_supplier_id($supplier_id)
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $this->db->where('supplier_id', $supplier_id);
        $q = $this->db->get('purchase_master');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $data = $row;
            }
        }

        return $data;
    }

    /**
     * Get purchase master before date
     *
     * @param  date     $date
     * @return array    $data
     */
    public function get_before_date($date)
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $this->db->where('purchase_date <', date_to_db($date));
        $q = $this->db->get('purchase_master');
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
     * Get purchase master by date
     *
     * @param  date     $date
     * @return array    $data
     */
    public function get_by_date($date)
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $this->db->where('purchase_date', date_to_db($date));
        $q = $this->db->get('purchase_master');
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
     * Get all purchase master between date
     *
     * @param  array    $items
     * @param  integer  $supplier_id
     * @return array    $data
     */
    public function get_all_between_date($items = NULL, $supplier_id = NULL)
    {
        $data = array();
        $start_date = date_to_db($this->input->post('start_date'));
        $end_date = date_to_db($this->input->post('end_date'));
        $this->db->where("purchase_date BETWEEN '$start_date' AND '$end_date'");
        if ($supplier_id)
        {
            $this->db->where('supplier_id', $supplier_id);
        }
        $this->db->where('company_id', $this->session->user_company);
        $this->db->order_by('purchase_no', 'ASC');
        $q = $this->db->get('purchase_master');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                //$user = $this->MUsers->get_by_id($row['user_id']);
                //$row['user_name'] = $user['name'];
                if ($items)
                {
                    $row['item_quantity'] = $this->MPurchase_details->get_total_quantity($row['purchase_no'], $items);
                    $row['total_price'] = $this->MPurchase_details->get_total_price($row['purchase_no'], $items);
                }
                else
                {
                    $row['item_quantity'] = $this->MPurchase_details->get_total_quantity($row['purchase_no']);
                    $row['total_price'] = $this->MPurchase_details->get_total_price($row['purchase_no']);
                }

                $data[] = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Create new purchase master entry
     *
     * @return integer  insert_id
     */
    public function create()
    {
        $data = array(
            'company_id' => $this->session->user_company,
            'supplier_id' => $this->input->post('supplier_id'),
            'purchase_no' => $this->input->post('purchase_no'),
            'purchase_date' => date_to_db($this->input->post('purchase_date')),
            'notes' => $this->input->post('notes'),
            'created' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->user_id
            );
        $this->db->insert('purchase_master', $data);

        return $this->db->insert_id();
    }

    /**
     * Update purchase master
     *
     * @param  integer  $id
     * @return void
     */
    public function update($id)
    {
        $data = array(
            'company_id' => $this->session->user_company,
            'supplier_id' => $this->input->post('supplier_id'),
            'purchase_no' => $this->input->post('purchase_no'),
            'purchase_date' => date_to_db($this->input->post('purchase_date')),
            'notes' => $this->input->post('notes'),
            'modified' => date('Y-m-d H:i:s', time()),
            'modified_by' => $this->session->user_id
            );
        $this->db->where('id', $id);
        $this->db->update('purchase_master', $data);
    }

    /**
     * Delete purchase master by id
     *
     * @param  integer  $id
     * @return void
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('purchase_master');
    }

    /**
     * Delete purchase master by purchase no
     *
     * @param  string   $purchase_no
     * @return void
     */
    public function delete_by_purchase_no($purchase_no)
    {
        $this->db->where('purchase_no', $purchase_no);
        $this->db->delete('purchase_master');
    }

    /**
     * Delete purchase master by company id
     *
     * @param  integer  $company_id
     * @return void
     */
    public function delete_by_cmp($company_id)
    {
        $this->db->where('company_id', $company_id);
        $this->db->delete('purchase_master');
    }

}