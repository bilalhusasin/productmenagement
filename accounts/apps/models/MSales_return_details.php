<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSales_return_details extends CI_Model {

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
     * Get sales return details by id
     *
     * @param  integer  $id
     * @return array    $data
     */
    public function get_by_id($id)
    {
        $data = array();
        $this->db->where('id', $id);
        $q = $this->db->get('sales_return_details');
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
     * Get sales return details by sales return no and item id
     *
     * @param  string   $sales_return_no
     * @param  integer  $item_id
     * @return mixed    $data
     */
    public function get_by_sales_return_no_item_id($sales_return_no, $item_id)
    {
        $data = NULL;
        $this->db->select('sales.*, items.name as item_name, items.min_sale_price as item_sale');
        $this->db->from('sales_return_details AS sales');
        $this->db->join('items', 'items.id = sales.item_id');
        $this->db->where('sales.sales_return_no', $sales_return_no);
        $this->db->where('sales.item_id', $item_id);
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
     * Get sales return details by sales return no
     *
     * @param  string   $sales_return_no
     * @return array    $data
     */
    public function get_by_sales_return_no($sales_return_no)
    {
        $data = array();
        $this->db->where('sales_return_no', $sales_return_no);
        $this->db->order_by('id', 'DESC');
        $q = $this->db->get('sales_return_details');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $item = $this->MItems->get_by_id($row['item_id']);
                $row['item_code'] = $item['code'];
                $row['item_name'] = $item['name'];
                $row['item_price'] = $item['min_sale_price'];
                $data[] = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Get total price by sales return no
     *
     * @param  string   $sales_return_no
     * @return mixed    $data
     */
    public function get_total_price_by_sales_return_no($sales_return_no)
    {
        $data = NULL;
        $this->db->select_sum('price_total');
        $this->db->where('sales_return_no', $sales_return_no);
        $q = $this->db->get('sales_return_details');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $data = $row['price_total'];
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Get total quantity by sales return no
     *
     * @param  string   $sales_return_no
     * @return mixed    $data
     */
    public function get_total_qty_by_sales_return_no($sales_return_no)
    {
        $data = NULL;
        $this->db->select_sum('quantity');
        $this->db->where('sales_return_no', $sales_return_no);
        $q = $this->db->get('sales_return_details');
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
        $q = $this->db->get('sales_return_details');
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

    public function get_by_item_between_date()
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
        $this->db->where("sales_return_date BETWEEN '$sdate' AND '$edate'");
        $this->db->order_by('id', 'DESC');
        $q = $this->db->get('sales_return_details');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $data[] = $this->MSales_return_master->get_by_id($row['sales_id']);
                //$data[] = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    public function get_total_quantity($sales_return_no, $items = NULL)
    {
        $this->db->select_sum('quantity');
        if ($items)
        {
            $this->db->where_in('item_id', $items);
        }
        $this->db->where('sales_return_no', $sales_return_no);
        $q = $this->db->get('sales_return_details');
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

    public function get_total_price($sales_return_no, $items = NULL)
    {
        $this->db->select_sum('price_total');
        if ($items)
        {
            $this->db->where_in('item_id', $items);
        }
        $this->db->where('sales_return_no', $sales_return_no);
        $q = $this->db->get('sales_return_details');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $data = $row['price_total'];
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Get total sales return Cost Of Good Sold (COGS)
     *
     * @param  integer  $sales_return_no
     * @param  array    $items
     * @return array    $data
     */
    public function get_total_cogs($sales_return_no, $items = NULL)
    {
        $this->db->select_sum('cogs_total');
        if ($items)
        {
            $this->db->where_in('item_id', $items);
        }
        $this->db->where('sales_return_no', $sales_return_no);
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('sales_return_details');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $data = $row['cogs_total'];
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Create new sales return details
     *
     * @param  string   $sales_return_no
     * @param  array    $item
     * @return integer  insert_id
     */
    public function create($sales_return_no, $item)
    {
        if ($this->input->post('price'))
        {
            $price = $this->input->post('price');
            $price_total = $price * $this->input->post('quantity');
        }
        else
        {
            $price = $item['min_sale_price'];
            $price_total = $price * $this->input->post('quantity');
        }

        /** Get item AVCO price **/
        $avco_price = $this->MItems->get_by_id($item['id']);
        $cogs_total = $avco_price['avco_price'] * (int)$this->input->post('quantity');

        $data = array(
            'company_id' => $this->session->user_company,
            'sales_return_no' => $sales_return_no,
            'sales_return_date' => date_to_db($this->input->post('sales_return_date')),
            'item_id' => $item['id'],
            'sale_price' => $price,
            'quantity' => $this->input->post('quantity'),
            'price_total' => $price_total,
            'cogs_total' => $cogs_total,
            'created_at' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->user_id
            );

        $this->db->insert('sales_return_details', $data);

        return $this->db->insert_id();
    }

    /**
     * Delete sales return by sales return no
     *
     * @param  string   $sales_return_no
     * @return void
     */
    public function delete_by_sales_return_no($sales_return_no)
    {
        $this->db->where('sales_return_no', $sales_return_no);
        $this->db->delete('sales_return_details');
    }

    /**
     * Delete sales return by id
     *
     * @param  integer  $id
     * @return void
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('sales_return_details');
    }

    /**
     * Delete sales return by company id
     *
     * @param  integer  $company_id
     * @return void
     */
    public function delete_by_cmp($company_id)
    {
        $this->db->where('company_id', $company_id);
        $this->db->delete('sales_return_details');
    }

}