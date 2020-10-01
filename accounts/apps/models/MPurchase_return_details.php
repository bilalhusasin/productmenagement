<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MPurchase_return_details extends CI_Model {

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
     * Get purchase return details by id
     * --can optimize using join query
     *
     * @param  integer  $id
     * @return array    $data
     */
    public function get_by_id($id)
    {
        $data = array();
        $this->db->where('id', $id);
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('purchase_return_details');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $item = $this->MItems->get_by_id($row['item_id']);
                $row['item_name'] = $item['name'];
                $data = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Get purchase return details by barcode
     *
     * @param  string   $barcode
     * @return array    $data
     */
    public function get_by_barcode($barcode)
    {
        $data = array();
        $this->db->where('barcode', $barcode);
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('purchase_return_details');
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
     * Get latest purchase return details
     *
     * @return array    $data
     */
    public function get_latest()
    {
        $data = array();
        $this->db->order_by('id', 'DESC');
        $this->db->where('company_id', $this->session->user_company);
        $this->db->limit(1);
        $q = $this->db->get('purchase_return_details');
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
     * Get purchase return details by purchase return no
     * --can optimize using join query
     *
     * @param  integer  $purchase_return_no
     * @return array    $data
     */
    public function get_by_purchase_return_no($purchase_return_no = 0)
    {
        $data = array();
        $this->db->where('purchase_return_no', $purchase_return_no);
        $this->db->where('company_id', $this->session->user_company);
        $this->db->order_by('id', 'DESC');
        $q = $this->db->get('purchase_return_details');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $item = $this->MItems->get_by_id($row['item_id']);
                $row['item_code'] = $item['code'];
                $row['item_name'] = $item['name'];
                $data[] = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Get total quantity by item id
     *
     * @param  integer  $item_id
     * @return mixed    $data
     */
    public function get_total_qty_by_item_id($item_id)
    {
        $data = NULL;
        $this->db->select_sum('quantity');
        $this->db->where('item_id', $item_id);
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('purchase_return_details');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $data = $row['quantity'];
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Get total purchase return quantity by purchase return no
     *
     * @param  string   $purchase_return_no
     * @param  array    $items
     * @return integer  $data
     */
    public function get_total_quantity($purchase_return_no, $items = NULL)
    {
        $this->db->select_sum('quantity');
        $this->db->where('company_id', $this->session->user_company);
        if ($items)
        {
            $this->db->where_in('item_id', $items);
        }
        $this->db->where('purchase_return_no', $purchase_return_no);
        $q = $this->db->get('purchase_return_details');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $data = $row['quantity'];
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Get total purchase return price by purchase return no
     *
     * @param  string   $purchase_return_no
     * @param  array    $items
     * @return integer  $data
     */
    public function get_total_price($purchase_return_no, $items = NULL)
    {
        $this->db->select_sum('total_price');
        if ($items)
        {
            $this->db->where_in('item_id', $items);
        }
        $this->db->where('company_id', $this->session->user_company);
        $this->db->where('purchase_return_no', $purchase_return_no);
        $q = $this->db->get('purchase_return_details');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $data = $row['total_price'];
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Get all purchase return details
     * --can optimize using join query
     *
     * @return array    $data
     */
    public function get_all()
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('items');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $company = $this->MCompanies->get_by_id($row['company_id']);
                $row['company'] = $company['name'];
                $data[] = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Get purchase return details by item id
     *
     * @param  integer  $item_id
     * @return array    $data
     */
    public function get_by_item_id($item_id)
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $this->db->where('item_id', $item_id);
        $q = $this->db->get('purchase_return_details');
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
     * Get purchase return details by purchase return no and item id
     *
     * @param  string   $purchase_return_no
     * @param  integer  $item_id
     * @return array    $data
     */
    public function get_by_purchase_return_no_item_id($purchase_return_no, $item_id)
    {
        $data = NULL;
        $this->db->select('purchase.*, items.name as item_name, items.min_sale_price as item_sale');
        $this->db->from('purchase_return_details AS purchase');
        $this->db->join('items', 'items.id = purchase.item_id');
        $this->db->where('purchase.purchase_return_no', $purchase_return_no);
        $this->db->where('purchase.item_id', $item_id);
        $this->db->where('purchase.company_id', $this->session->user_company);
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
     * Create purchase return master by purchase return no
     *
     * @param  string   $purchase_return_no
     * @return void
     */
    public function create($purchase_return_no)
    {
        $data = array(
            'company_id' => $this->session->user_company,
            'purchase_return_no' => $purchase_return_no,
            'item_id' => $this->input->post('item_id'),
            'quantity' => $this->input->post('quantity'),
            'purchase_price' => $this->input->post('price'),
            'total_price' => (int)$this->input->post('quantity') * (int)$this->input->post('price'),
            'created' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->user_id,
            );
        $this->db->insert('purchase_return_details', $data);
    }

    /**
     * Delete by purchase return no
     *
     * @param  string   $purchase_return_no
     * @return void
     */
    public function delete_by_purchase_return_no($purchase_return_no)
    {
        $this->db->where('purchase_return_no', $purchase_return_no);
        $this->db->delete('purchase_return_details');
    }

    /**
     * Delete by id
     *
     * @param  integer  $id
     * @return void
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('purchase_return_details');
    }

    /**
     * Delete by company id
     *
     * @param  integer  $company_id
     * @return void
     */
    public function delete_by_cmp($company_id)
    {
        $this->db->where('company_id', $company_id);
        $this->db->delete('purchase_return_details');
    }

}