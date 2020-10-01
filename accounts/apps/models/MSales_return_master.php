<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSales_return_master extends CI_Model {

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
     * Get sales return by id
     *
     * @param  integer  $id
     * @return array    $data
     */
    public function get_by_id($id)
    {
        $data = array();
        $this->db->select('sales_return_master.*, customers.name, customers.address, customers.mobile');
        $this->db->from('sales_return_master');
        $this->db->join('customers', 'sales_return_master.customer_id = customers.id', 'left');
        $this->db->where('sales_return_master.company_id', $this->session->user_company);
        $this->db->where('sales_return_master.id', $id);
        $q = $this->db->get();
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $item_qty = $this->MSales_return_details->get_total_quantity($row['sales_return_no']);
                $row['item_qty'] = $item_qty;
                $amount = $this->MSales_return_details->get_total_price($row['sales_return_no']);
                $row['amount'] = $amount;
                $data = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Get last sales return no
     *
     * @return array    $data
     */
    public function get_last_sales_return_no()
    {
        $data = array();
        $this->db->order_by('sales_return_no', 'DESC');
        $this->db->limit(1);
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('sales_return_master');
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
     * Get latest sales return
     *
     * @return array    $data
     */
    public function get_latest()
    {
        $data = array();
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('sales_return_master');
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
     * Get all sales return
     *
     * @return array    $data
     */
    public function get_all()
    {
        $data = array();
        $this->db->order_by('id', 'DESC');
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('sales_return_master');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                if ($row['customer_id'] == 0)
                {
                    $customer['name'] = 'Annynimous';
                }
                else
                {
                    $customer = $this->MCustomers->get_by_id($row['customer_id']);
                }
                $row['customer_name'] = $customer['name'];
                $item_qty = $this->MSales_return_details->get_total_qty_by_sales_return_no($row['sales_return_no']);
                $row['item_qty'] = $item_qty;
                $amount = $this->MSales_return_details->get_total_price_by_sales_return_no($row['sales_return_no']);
                $row['amount'] = $amount;
                $data[] = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Get all sales return by customer id
     *
     * @param  integer  $customer_id
     * @return array    $data
     */
    public function get_by_customer_id($customer_id)
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $this->db->where('customer_id', $customer_id);
        $q = $this->db->get('sales_return_master');
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
     * Get sales return by sales return no
     *
     * @param  string   $sales_return_no
     * @return array    $data
     */
    public function get_by_sales_return_no($sales_return_no = NULL)
    {
        $data = array();
        $this->db->select('sales_return_master.*, SUM(sales_return_details.quantity) as quantity, customers.name as customer_name, customers.address as customer_address, customers.mobile as customer_mobile');
        $this->db->from('sales_return_master');
        $this->db->join('sales_return_details', 'sales_return_master.sales_return_no = sales_return_details.sales_return_no', 'left');
        $this->db->join('customers', 'sales_return_master.customer_id = customers.id', 'left');
        if ($sales_return_no)
        {
            $this->db->where('sales_return_master.sales_return_no', $sales_return_no);
        }
        $this->db->group_by("sales_return_master.sales_return_no");
        $this->db->order_by('sales_return_master.id', 'ASC');
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
     * Get all sales return before date
     *
     * @param  string   $date
     * @return array    $data
     */
    public function get_before_date($date)
    {
        $data = array();
        $this->db->where('sales_return_date <', date_to_db($date));
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('sales_return_master');
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
     * Get sales return by date
     *
     * @param  string   $date
     * @return array    $data
     */
    public function get_by_date($date)
    {
        $data = array();
        $this->db->where('sales_return_date', date_to_db($date));
        $this->db->where('company_id', $this->session->user_company);
        $q = $this->db->get('sales_return_master');
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
     * Get all sales return between dates
     *
     * @param  array    $items
     * @param  integer  $customer_id
     * @return array    $data
     */
    public function get_all_between_date($items = NULL, $customer_id = NULL)
    {
        $data = array();
        $start_date = date_to_db($this->input->post('start_date'));
        $end_date = date_to_db($this->input->post('end_date'));
        if ($customer_id)
        {
            $this->db->where('customer_id', $customer_id);
        }
        $this->db->where("sales_return_date BETWEEN '$start_date' AND '$end_date'");
        $this->db->where('company_id', $this->session->user_company);
        $this->db->order_by('sales_return_no', 'ASC');
        $q = $this->db->get('sales_return_master');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                if ($items)
                {
                    $row['item_quantity'] = $this->MSales_return_details->get_total_quantity($row['sales_return_no'], $items);
                    $row['total_price'] = $this->MSales_return_details->get_total_price($row['sales_return_no'], $items);
                }
                else
                {
                    $row['item_quantity'] = $this->MSales_return_details->get_total_quantity($row['sales_return_no']);
                    $row['total_price'] = $this->MSales_return_details->get_total_price($row['sales_return_no']);
                }

                $data[] = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Get sales return by customer and between dates
     *
     * @return array    $data
     */
    public function get_by_customer_between_date()
    {
        $data = array();
        $sdate = $this->input->post('s_date');
        $edate = $this->input->post('e_date');
        $this->db->where("sales_return_date BETWEEN '$sdate' AND '$edate'");
        if ($this->input->post('customer_id') != 'all')
        {
            $this->db->where('customer_id', $this->input->post('customer_id'));
        }
        $this->db->where('company_id', $this->session->user_company);
        $this->db->order_by('id', 'DESC');
        $q = $this->db->get('sales_return_master');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                if ($row['customer_id'] == 0)
                {
                    $customer['name'] = 'Annynimous';
                }
                else
                {
                    $customer = $this->MCustomers->get_by_id($row['customer_id']);
                }
                $row['customer_name'] = $customer['name'];
                $user = $this->MUsers->get_by_id($row['user_id']);
                $row['user_name'] = $user['full_name'];
                $item_qty = $this->MSales_return_details->get_total_qty_by_sales_id($row['id']);
                $row['item_qty'] = $item_qty;
                $amount = $this->MSales_return_details->get_total_price_by_sales_id($row['id']);
                $row['amount'] = $amount;
                $data[] = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    /**
     * Get sales return customer
     *
     * @return array    $data
     */
    public function get_sales_customer()
    {
        $data = array();
        $this->db->select('sales_return_master.id, sales_return_master.sales_return_date, customers.full_name');
        $this->db->from('sales_return_master');
        $this->db->join('customers', 'sales_return_master.customer_id=customers.id');
        $this->db->where('sales_return_master.company_id', $this->session->user_company);
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
     * Create new sales return entry
     *
     * @return integer  insert_id
     */
    public function create()
    {
        $data = array(
            'company_id' => $this->session->user_company,
            'sales_return_no' => $this->input->post('sales_return_no'),
            'sales_return_date' => date_to_db($this->input->post('sales_return_date')),
            'customer_id' => $this->input->post('customer_id'),
            'created' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->user_id
        );
        $this->db->insert('sales_return_master', $data);

        return $this->db->insert_id();
    }

    /**
     * Update sales return master by sales return id
     *
     * @return void
     */
    public function update($sales_return_id)
    {
        $data = array(
            'sales_return_no' => $this->input->post('sales_return_no'),
            'sales_return_date' => date_to_db($this->input->post('sales_return_date')),
            'customer_id' => $this->input->post('customer_id'),
            'modified' => date('Y-m-d H:i:s', time()),
            'modified_by' => $this->session->user_id
        );

        $this->db->where('id', $sales_return_id);
        $this->db->update('sales_return_master', $data);
    }

    /**
     * Update sales return tax information by sales return no
     *
     * @param  string   $sales_return_no
     * @return void
     */
    public function update_tax_info($sales_return_no)
    {
        $total_price = $this->MSales_return_details->get_total_price_by_sales_return_no($sales_return_no);
        $settings = $this->MSettings->get_by_company_id($this->session->user_company);
        $tax_percent = $settings['tax_rate'];
        if ($tax_percent > 0)
        {
            $tax_amount = ($total_price * $tax_percent) / 100;
        }
        else
        {
            $tax_amount = 0;
        }

        $data = array(
            'tax_percent' => $tax_percent,
            'tax_amount' => $tax_amount
        );
        $this->db->where('sales_return_no', $sales_return_no);
        $this->db->update('sales_return_master', $data);
    }

    /**
     * Delete sales return master by id
     *
     * @param  integer  $id
     * @return void
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('sales_return_master');
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
        $this->db->delete('sales_return_master');
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
        $this->db->delete('sales_return_master');
    }

}
