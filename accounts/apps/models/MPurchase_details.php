<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MPurchase_details extends CI_Model {

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
     * Get purchase details by id
     *
     * @param  integer  $id
     * @return array    $data
     */
    public function get_by_id($id)
    {
        $data = array();
        $this->db->where('id', $id);
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('purchase_details');
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
     * Get purchase details by barcode
     *
     * @param  string   $barcode
     * @return array    $data
     */
    public function get_by_barcode($barcode)
    {
        $data = array();
        $this->db->where('barcode', $barcode);
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('purchase_details');
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
     * Get latest purchase details
     *
     * @return array    $data
     */
    public function get_latest()
    {
        $data = array();
        $this->db->order_by('id', 'DESC');
        $this->db->where('company_id', $this->session->user_company);
        $this->db->limit(1);
        $q = $this->db->get('purchase_details');
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
     * Get purchase details by purchase no
     *
     * @param  string   $purchase_no
     * @return array    $data
     */
    public function get_by_purchase_no($purchase_no = 0)
    {
        $data = array();
        $this->db->where('purchase_no', $purchase_no);
        $this->db->where('company_id', $this->session->user_company);
        $this->db->order_by('id', 'DESC');
        $q = $this->db->get('purchase_details');
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
        $q = $this->db->get('purchase_details');
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
     * Get total purchase quantity
     *
     * @param  string   $purchase_no
     * @param  array    $items
     * @return array    $data
     */
    public function get_total_quantity($purchase_no, $items = NULL)
    {
        $this->db->select_sum('quantity');
        $this->db->where('company_id', $this->session->user_company);
        if ($items)
        {
            $this->db->where_in('item_id', $items);
        }
        $this->db->where('purchase_no', $purchase_no);
        $q = $this->db->get('purchase_details');
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
     * Get total purchase price
     *
     * @param  string   $purchase_no
     * @param  array    $items
     * @return array    $data
     */
    public function get_total_price($purchase_no, $items = NULL)
    {
        $this->db->select_sum('total_price');
        if ($items)
        {
            $this->db->where_in('item_id', $items);
        }
        $this->db->where('company_id', $this->session->user_company);
        $this->db->where('purchase_no', $purchase_no);
        $q = $this->db->get('purchase_details');
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
     * Get all purchase details
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
     * Get purchase details by item id
     *
     * @param  integer  $item_id
     * @return array    $data
     */
    public function get_by_item_id($item_id)
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $this->db->where('item_id', $item_id);
        $q = $this->db->get('purchase_details');
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
     * Get purchase details by purchase no and item id
     *
     * @param  string   $purchase_no
     * @param  integer  $item_id
     * @return mixed    $data
     */
    public function get_by_purchase_no_item_id($purchase_no, $item_id)
    {
        $data = NULL;
        $this->db->select('purchase.*, items.name as item_name, items.min_sale_price as item_sale');
        $this->db->from('purchase_details AS purchase');
        $this->db->join('items', 'items.id = purchase.item_id');
        $this->db->where('purchase.purchase_no', $purchase_no);
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
     * Get purchase details by item and purchase no
     *
     * @return array    $data
     */
    public function get_by_item_with_purchase_no()
    {
        $data = array();
        $this->db->distinct();
        $this->db->select('sales_id');
        if ($this->input->post('item_id') != 'all')
        {
            $this->db->where('item_id', $this->input->post('item_id'));
        }
        $sdate = $this->input->post('s_date');
        $edate = $this->input->post('e_date');
        $this->db->where("edate BETWEEN '$sdate' AND '$edate'");
        $this->db->where('company_id', $this->session->user_company);
        $this->db->order_by('id', 'DESC');
        $q = $this->db->get('sales_details');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $data[] = $this->MSales_master->get_by_id($row['sales_id']);
                //$data[] = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Get average cost by item id
     *
     * @param  integer  $item_id
     * @return integer  $avco
     */
    public function get_avco($item_id)
    {
        $this->db->select('SUM(quantity) as total_quantity, SUM(total_price) as total_price');
        $this->db->where('item_id', $item_id);
        $q = $this->db->get('purchase_details');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $data[] = $row;
            }
        }
        if ((int)$data[0]['total_quantity'] > 0)
        {
            $temp = (double)$data[0]['total_price'] / (int)$data[0]['total_quantity'];
            $avco = number_format($temp, 2);
        }
        else
        {
            $avco = 0;
        }

        $q->free_result();
        return $avco;
    }

    /**
     * Add new purchase details
     *
     * @param  string   $purchase_no
     * @return void
     */
    public function create($purchase_no)
    {
        $data = array(
            'company_id' => $this->session->user_company,
            'purchase_no' => $purchase_no,
            'item_id' => $this->input->post('item_id'),
            'quantity' => $this->input->post('quantity'),
            'purchase_price' => $this->input->post('price'),
            'total_price' => (int)$this->input->post('quantity') * (int)$this->input->post('price'),
            'created' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->user_id
        );
        $this->db->insert('purchase_details', $data);
    }

    /**
     * Delete purchase details by purchase no
     *
     * @param  string   $purchase_no
     * @return void
     */
    public function delete_by_purchase_no($purchase_no)
    {
        $this->db->where('purchase_no', $purchase_no);
        $this->db->delete('purchase_details');
    }

    /**
     * Delete purchase details by purchase id
     *
     * @param  integer  $id
     * @return void
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('purchase_details');
        //print_r($this->bd->last_query());
    }

    /**
     * Delete purchase details by company id
     *
     * @param  integer  $company_id
     * @return void
     */
    public function delete_by_cmp($company_id)
    {
        $this->db->where('company_id', $company_id);
        $this->db->delete('purchase_details');
    }

}