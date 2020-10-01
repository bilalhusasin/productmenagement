<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MPurchase_return_master extends CI_Model {

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
     * Get purchase return master by id
     *
     * @param  integer  $id
     * @return array    $data
     */
    public function get_by_id($id)
    {
        $data = array();
        $this->db->select('purchase_return_master.*, suppliers.name, suppliers.address, suppliers.contact_person, suppliers.phone_no');
        $this->db->from('purchase_return_master');
        $this->db->join('suppliers', 'purchase_return_master.supplier_id=suppliers.id');
        $this->db->where('purchase_return_master.company_id', $this->session->user_company);
        $this->db->where('purchase_return_master.id', $id);
        $q = $this->db->get();
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $item_qty = $this->MPurchase_return_details->get_total_quantity($row['purchase_return_no']);
                $row['item_qty'] = $item_qty;
                $amount = $this->MPurchase_return_details->get_total_price($row['purchase_return_no']);
                $row['amount'] = $amount;
                $data = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Get purchase return master by purchase return no
     *
     * @param  string   $purchase_return_no
     * @return array    $data
     */
    public function get_by_purchase_return_no($purchase_return_no = NULL)
    {
        $data = array();
        $this->db->select('purchase_return_master.*, SUM(purchase_return_details.quantity) as quantity, suppliers.name as supplier_name, suppliers.address as supplier_address, suppliers.phone_no as supplier_mobile');
        $this->db->from('purchase_return_master');
        $this->db->join('purchase_return_details', 'purchase_return_master.purchase_return_no = purchase_return_details.purchase_return_no', 'left');
        $this->db->join('suppliers', 'purchase_return_master.supplier_id = suppliers.id', 'left');
        if ($purchase_return_no)
        {
            $this->db->where('purchase_return_master.purchase_return_no', $purchase_return_no);
        }
        $this->db->where('purchase_return_master.company_id', $this->session->user_company);
        $this->db->group_by('purchase_return_master.purchase_return_no');
        $this->db->order_by('purchase_return_master.id', 'ASC');
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
     * Get last purchase return no
     *
     * @return array    $data
     */
    public function get_last_purchase_return_no()
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $this->db->order_by('purchase_return_no', 'DESC');
        $this->db->limit(1);
        $q = $this->db->get('purchase_return_master');
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
     * Get latest purchase return
     *
     * @return array    $data
     */
    public function get_latest()
    {
        $data = array();
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $q = $this->db->get('purchase_return_master');
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
     * Get all purchase return master
     *
     * @return array    $data
     */
    public function get_all()
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('purchase_return_master');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $supplier = $this->MSuppliers->get_by_id($row['supplier_id']);
                $qty = $this->MPurchase_return_details->get_total_quantity($row['purchase_return_no']);
                $price = $this->MPurchase_return_details->get_total_price($row['purchase_return_no']);
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
     * Get purchase return master by supplier id
     *
     * @param  integer  $supplier_id
     * @return array    $data
     */
    public function get_by_supplier_id($supplier_id)
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $this->db->where('supplier_id', $supplier_id);
        $q = $this->db->get('purchase_return_master');
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
     * Get purchase return master before date
     *
     * @param  date     $date
     * @return array    $data
     */
    public function get_before_date($date)
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $this->db->where('purchase_return_date <', date_to_db($date));
        $q = $this->db->get('purchase_return_master');
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
     * Get purchase return master by date
     *
     * @param  date     $date
     * @return array    $data
     */
    public function get_by_date($date)
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $this->db->where('purchase_return_date', date_to_db($date));
        $q = $this->db->get('purchase_return_master');
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
     * Get all purchase return master between date by items and supplier id
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
        $this->db->where("purchase_return_date BETWEEN '$start_date' AND '$end_date'");
        if ($supplier_id)
        {
            $this->db->where( 'supplier_id', $supplier_id );
        }
        $this->db->where('company_id', $this->session->user_company);
        $this->db->order_by('purchase_return_no', 'ASC');
        $q = $this->db->get('purchase_return_master');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                //$user = $this->MUsers->get_by_id($row['user_id']);
                //$row['user_name'] = $user['name'];
                if ($items)
                {
                    $row['item_quantity'] = $this->MPurchase_return_details->get_total_quantity($row['purchase_return_no'], $items);
                    $row['total_price'] = $this->MPurchase_return_details->get_total_price($row['purchase_return_no'], $items);
                }
                else
                {
                    $row['item_quantity'] = $this->MPurchase_return_details->get_total_quantity($row['purchase_return_no']);
                    $row['total_price'] = $this->MPurchase_return_details->get_total_price($row['purchase_return_no']);
                }

                $data[] = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Create new purchase return entry
     *
     * @return integer  insert_id
     */
    public function create()
    {
        $data = array(
            'company_id' => $this->session->user_company,
            'supplier_id' => $this->input->post('supplier_id'),
            'purchase_return_no' => $this->input->post('purchase_return_no'),
            'purchase_return_date' => date_to_db($this->input->post('purchase_return_date')),
            'notes' => $this->input->post('notes'),
            'created' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->user_id
            );
        $this->db->insert( 'purchase_return_master', $data );

        return $this->db->insert_id();
    }

    /**
     * Update purchase return by id
     *
     * @param  integer  $id
     * @return void
     */
    public function update($id)
    {
        $data = array(
            'company_id' => $this->session->user_company,
            'supplier_id' => $this->input->post('supplier_id'),
            'purchase_return_no' => $this->input->post('purchase_return_no'),
            'purchase_return_date' => date_to_db($this->input->post('purchase_return_date')),
            'notes' => $this->input->post('notes'),
            'modified' => date('Y-m-d H:i:s', time()),
            'modified_by' => $this->session->user_id
            );
        $this->db->where('id', $id);
        $this->db->update('purchase_return_master', $data);
    }

    /**
     * Delete purchase return by id
     *
     * @param  integer  $id
     * @return void
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('purchase_return_master');
    }

    /**
     * Delete purchase return master by purchase return no
     *
     * @param  string   $purchase_return_no
     * @return void
     */
    public function delete_by_purchase_return_no($purchase_return_no)
    {
        $this->db->where('purchase_return_no', $purchase_return_no);
        $this->db->delete('purchase_return_master');
    }

    /**
     * Delete purchase return master by company id
     *
     * @param  integer  $company_id
     * @return void
     */
    public function delete_by_cmp($company_id)
    {
        $this->db->where('company_id', $company_id);
        $this->db->delete('purchase_return_master');
    }

}