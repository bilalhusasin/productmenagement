<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MReports extends CI_Model {

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
     * Get inventory summery report
     *
     * @return array    $data
     */
    public function get_inventory_summary()
    {
        $data = array();
        $tmp_date = array();
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        if ($this->input->post('item_id') != 'all')
        {
            $items = array($this->MItems->get_by_id($this->input->post('item_id')));
        }
        else
        {
            $items = $this->MItems->get_all();
        }
        // var_dump($items);

        // Get All Purchase Date
        $this->db->where('purchase_date BETWEEN "' . date_to_db($start_date) . '" AND "' . date_to_db($end_date) . '"');
        $this->db->where('company_id', $this->session->user_company);
        $this->db->group_by('purchase_date');
        $q = $this->db->get('purchase_master');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $inv_date['inv_date'] = $row['purchase_date'];
                $tmp_date[] = $inv_date;
            }
        }

        // Get All Purchase Return Date
        $this->db->where('purchase_return_date BETWEEN "' . date_to_db($start_date) . '" AND "' . date_to_db($end_date) . '"');
        $this->db->where('company_id', $this->session->user_company);
        $this->db->group_by('purchase_return_date');
        $q = $this->db->get('purchase_return_master');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $inv_date['inv_date'] = $row['purchase_return_date'];
                $tmp_date[] = $inv_date;
            }
        }

        // Get All Sales Date
        $this->db->where('sales_date BETWEEN "' . date_to_db($start_date) . '" AND "' . date_to_db($end_date) . '"');
        $this->db->where('company_id', $this->session->user_company);
        $this->db->group_by('sales_date');
        $q = $this->db->get('sales_master');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $inv_date['inv_date'] = $row['sales_date'];
                $tmp_date[] = $inv_date;
            }
        }

        // Get All Sales Return Date
        $this->db->where('sales_return_date BETWEEN "' . date_to_db($start_date) . '" AND "' . date_to_db($end_date) . '"');
        $this->db->where('company_id', $this->session->user_company);
        $this->db->group_by('sales_return_date');
        $q = $this->db->get('sales_return_master');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $inv_date['inv_date'] = $row['sales_return_date'];
                $tmp_date[] = $inv_date;
            }
        }

        // Previous Purchase
        $prev_purchases = $this->MPurchase_master->get_before_date($start_date);
        // Previous Purchase Return
        $prev_purchase_returns = $this->MPurchase_return_master->get_before_date($start_date);
        // Previous Sales
        $prev_sales = $this->MSales_master->get_before_date($start_date);
        // Previous Sales Return
        $prev_sales_returns = $this->MSales_return_master->get_before_date($start_date);

        foreach ($items as $item)
        {
            $ins = 0;
            // Purchase Quantity
            foreach ($prev_purchases as $prev_purchase)
            {
                $purchase_details = $this->MPurchase_details->get_by_purchase_no_item_id($prev_purchase['purchase_no'], $item['id']);
                $ins += $purchase_details['quantity'];
            }
            // Purchase Return Quantity
            foreach ($prev_purchase_returns as $prev_purchase_return)
            {
                $purchase_return_details = $this->MPurchase_return_details->get_by_purchase_return_no_item_id($prev_purchase_return['purchase_return_no'], $item['id']);
                $ins -= $purchase_return_details['quantity'];
            }

            $outs = 0;
            // Sales Quantity
            foreach ($prev_sales as $prev_sale)
            {
                $sales_details = $this->MSales_details->get_by_sales_no_item_id($prev_sale['sales_no'], $item['id']);
                $outs += $sales_details['quantity'];
            }
            // Sales Return Quantity
            foreach ($prev_sales_returns as $prev_sales_return)
            {
                $sales_return_details = $this->MSales_return_details->get_by_sales_return_no_item_id($prev_sales_return['sales_return_no'], $item['id']);
                $outs -= $sales_return_details['quantity'];
            }
            //echo $item['id'] . ' : Ins: ' . $ins . ' Outs: ' . $outs . '<br>';

            $tmp_open['id'] = $item['id'];
            $tmp_open['name'] = $item['name'];
            $tmp_open['open'] = $ins - $outs;
            $open[] = $tmp_open;
            unset($tmp_open);
            // $open[$item['name']] = $ins - $outs;
        }
        //print_r($open); die();
        //var_dump($just_open);
        $inv = array();
        if (count($tmp_date) > 0)
        {
            $sort_date = array_sort($tmp_date, 'inv_date');
            $distinct_date = array_distinct($sort_date, 'inv_date');

            foreach ($distinct_date as $date)
            {
                $inv_date = date_to_ui($date['inv_date']);
                // Get Purchase by date
                $purchases = $this->MPurchase_master->get_by_date($inv_date);
                // Get Purchase Return by date
                $purchase_returns = $this->MPurchase_return_master->get_by_date($inv_date);
                // Get Sales by date
                $sales = $this->MSales_master->get_by_date($inv_date);
                // Get Sales Return by date
                $sales_returns = $this->MSales_return_master->get_by_date($inv_date);

                $tmp_item = array();
                foreach ($open as $key => $item)
                {
                    $purchase_qty = 0;
                    if (count($purchases) > 0)
                    {
                        foreach ($purchases as $purchase)
                        {
                            $tmp_purchase = $this->MPurchase_details->get_by_purchase_no_item_id($purchase['purchase_no'], $item['id']);
                            if ($tmp_purchase)
                            {
                                $purchase_qty += $tmp_purchase['quantity'];
                            }
                        }
                    }
                    $purchase_return_qty = 0;
                    if (count($purchase_returns) > 0)
                    {
                        foreach ($purchase_returns as $purchase_return)
                        {
                            $tmp_purchase_return = $this->MPurchase_return_details->get_by_purchase_return_no_item_id($purchase_return['purchase_return_no'], $item['id']);
                            if ($tmp_purchase_return)
                            {
                                $purchase_return_qty += $tmp_purchase_return['quantity'];
                            }
                        }
                    }
                    $sales_qty = 0;
                    if (count($sales) > 0)
                    {
                        foreach ($sales as $sale)
                        {
                            $tmp_sales = $this->MSales_details->get_by_sales_no_item_id($sale['sales_no'], $item['id']);
                            if ($tmp_sales)
                            {
                                $sales_qty += $tmp_sales['quantity'];
                            }
                        }
                    }
                    $sales_return_qty = 0;
                    if (count($sales_returns) > 0)
                    {
                        foreach ($sales_returns as $sales_return)
                        {
                            $tmp_sales_return = $this->MSales_return_details->get_by_sales_return_no_item_id($sales_return['sales_return_no'], $item['id']);
                            if ($tmp_sales_return)
                            {
                                $sales_return_qty += $tmp_sales_return['quantity'];
                            }
                        }
                    }

                    // Do not add the item if they dont have any transaction
                    if ($item['open'] != 0 || $purchase_qty != 0 || $purchase_return_qty != 0 || $sales_qty != 0 || $sales_return_qty != 0)
                    {
                        $tmp['item_id'] = $item['id'];
                        $tmp['item_name'] = $item['name'];
                        $tmp['open_qty'] = $item['open'];
                        $tmp['purchase_qty'] = $purchase_qty;
                        $tmp['purchase_return_qty'] = $purchase_return_qty;
                        $tmp['sales_qty'] = $sales_qty;
                        $tmp['sales_return_qty'] = $sales_return_qty;
                        $tmp['close_qty'] = $item['open'] + $purchase_qty - $purchase_return_qty - $sales_qty + $sales_return_qty;
                        $tmp_item[] = $tmp;
                        $open[$key]['open'] = $tmp['close_qty'];
                    }

                }
                $tmp_data['date'] = $date['inv_date'];
                $tmp_data['details'] = $tmp_item;
                $inv[] = $tmp_data;
            }
            //print_r($inv); die();
        }
        $data['open'] = isset($open) ? $open : 0;
        $data['inv'] = $inv;
        return $data;
    }

    /**
     * Get current stock balance by item id
     *
     * @param  integer  $item_id
     * @return integer  $stock
     */
    public function get_stock_balance($item_id)
    {
        /** Total purchase quantity */
        $purchase = $this->MPurchase_details->get_total_qty_by_item_id($item_id);

        /** Total purchase return quantity */
        $purchase_return = $this->MPurchase_return_details->get_total_qty_by_item_id($item_id);

        /** Total sales quantity */
        $sales = $this->MSales_details->get_total_qty_by_item_id($item_id);

        /** Total sales return quantity */
        $sales_return = $this->MSales_return_details->get_total_qty_by_item_id($item_id);

        $stock = (int)$purchase - (int)$purchase_return - (int)$sales + (int)$sales_return;

        return $stock;
    }

}
