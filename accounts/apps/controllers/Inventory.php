<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

    /**
     * Class constructor and validate authenticate user
     *
     * @return  void
     */
    public function __construct()
    {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
        if ( ! $this->session->user_id)
        {
            redirect('', 'refresh');
        }
        $this->privileges = $this->MUser_privileges->get_by_ref_user($this->session->user_id);
    }

    /**
     * Inventory landing
     *
     * @return void
     */
    public function index()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'inventory';
        $data['content'] = 'admin/inventory/home';
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * All sales list
     *
     * @return void
     */
    public function sales_list()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'inventory';
        $data['content'] = 'admin/inventory/sales/list';
        $data['sales'] = $this->MSales_master->get_all();
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Add new sales item or edit sales item by id
     *
     * @param  integer  $id
     * @return void
     */
    public function sales_save($id = NULL)
    {
        if ($this->input->post())
        {
            $item_id = trim($this->input->post('item_id'));
            $sales_no = trim($this->input->post('sales_no'));

            /** Check if the item quantity has stock */
            $stock = $this->MReports->get_stock_balance($item_id);
            if ($this->input->post('quantity') > $stock)
            {
                echo 'invalid';
            }
            else
            {
                $sales = $this->MSales_master->get_by_sales_no($sales_no);
                if (count($sales) > 0)
                {
                    $this->MSales_master->update($sales[0]['id']);
                }
                else
                {
                    $this->MSales_master->create();
                }

                $item = $this->MItems->get_by_id($item_id);
                $this->MSales_details->create($sales_no, $item);
                $msg = $this->sales_table($sales_no);
                //echo json_encode(array ('success' => $msg));
                echo $msg;
            }

        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'inventory';
            $data['content'] = 'admin/inventory/sales/save';
            $sales = $this->MSales_master->get_last_sales_no();
            if (count($sales) > 0)
            {
                $data['sales_no'] = (int) $sales['sales_no'] + 1;
            }
            else
            {
                $data['sales_no'] = 1001;
            }
            $data['customers'] = $this->MCustomers->get_all();
            $data['items'] = $this->MItems->get_all('active');
            if ($id)
            {
                $data['sales'] = $this->MSales_master->get_by_id($id);
                $data['settings'] = $this->MSettings->get_by_id($data['sales']['customer_id']);
                $sales_no = $data['sales']['sales_no'];
                $settings = $this->MSettings->get_by_company_id($this->session->user_company);
                $data['tax_percent'] =  $settings['tax_rate'];
            }
            else
            {
                $sales_no = $data['sales_no'];
                $data['sales'] = NULL;
            }
            /** For the add new customer popup, need optimization using JS */
            $customer = $this->MCustomers->get_latest();
            if (count($customer) > 0)
            {
                $data['code'] = (int) $customer['code'] + 1;
            }
            else
            {
                $data['code'] = 1001;
            }
            $data['details'] = $this->MSales_details->get_by_sales_no($sales_no);
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    public function get_item_price()
    {
        $item = $this->MItems->get_by_id($this->input->post('id'));

        echo $item['min_sale_price'];
    }

    /**
     * Preview sales by sales no
     *
     * @param  integer  $sales_no
     * @return void
     */
    public function sales_preview($sales_no = NULL)
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'inventory';
        $data['content'] = 'admin/inventory/sales/preview';
        $data['master'] = $this->MSales_master->get_by_sales_no($sales_no);
        $data['details'] = $this->MSales_details->get_by_sales_no($sales_no);
        $data['company'] = $this->MCompanies->get_by_id($data['master'][0]['company_id']);
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Print sales by sales no
     *
     * @param  integer  $sales_no
     * @return void
     */
    public function sales_print($sales_no = NULL)
    {
        $data['title'] = 'POS System';
        $data['master'] = $this->MSales_master->get_by_sales_no($sales_no);
        $data['details'] = $this->MSales_details->get_by_sales_no($sales_no);
        $data['company'] = $this->MCompanies->get_by_id($data['master'][0]['company_id']);
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/inventory/sales/print', $data);
    }

    /**
     * Complete sales with accounts journal entry
     *
     * @return void
     */
    public function sales_complete()
    {
        $sales_no = trim($this->input->post('sales_no'));
        $sales_date = date_to_db(trim($this->input->post('sales_date')));

        $sales = $this->MSales_master->get_by_sales_no($sales_no);
        $this->MSales_master->update($sales[0]['id']);
        $this->MSales_master->update_tax_info($sales_no);

        /** Check if previous sales journal exist then Remove sales journal details else make new sales journal master */
        $sales_journal = $this->MAc_journal_master->get_by_doc('Sales', $sales_no);
        if (count($sales_journal) > 0)
        {
            $sales_journal_no = $sales_journal['journal_no'];
            $this->MAc_journal_details->delete_by_journal_no($sales_journal_no);
        }
        else
        {
            $sales_journal_no = $this->MAc_journal_master->get_journal_number();
            $this->MAc_journal_master->create_by_sales($sales_journal_no, $sales_no);
        }

        $settings = $this->MSettings->get_by_company_id($this->session->user_company);
        $total_price = $this->MSales_details->get_total_price_by_sales_no($sales_no);

        /** Calculate COGS */
        $total_cogs = $this->MSales_details->get_total_cogs($sales_no);

        /** Calculate Sales Tax */
        $tax_amount = 0;
        $tax_percent = $settings['tax_rate'];
        if ($tax_percent > 0)
        {
            $tax_amount = ($total_price * $tax_percent) / 100;
        }

        /** Calculate Dues */
        $total_paid = $this->input->post('paid_amount');
        $dues = ((float)$total_price + (float)$tax_amount) - (float)$total_paid;
        /** Discount price calculation */
        // $discount = $this->input->post('discount');
        // $dues = (float)$total_price - (float)$discount - (float)$total_paid;

        /** Sales Journal details entry */
        if ($dues == 0)
        {
            /** Cash debit (gross amount) */
            $this->MAc_journal_details->create_by_inventory($sales_journal_no, $settings['ac_cash'], $total_paid);
            /** Sales revenue credit (net sale amount) */
            $this->MAc_journal_details->create_by_inventory($sales_journal_no, $settings['ac_sales'], NULL, $total_price);
            /** Tax payable credit (tax amount) */
            if ($tax_amount > 0)
            {
                $this->MAc_journal_details->create_by_inventory($sales_journal_no, $settings['ac_tax'], NULL, $tax_amount);
            }
        }
        else
        {
            /** Accounts receivable / Customer account debit (dues amount) */
            $customer = $this->MCustomers->get_by_id($this->input->post('customer_id'));
            $this->MAc_journal_details->create_by_inventory($sales_journal_no, $customer['ac_id'], $dues);
            /** Cash debit (paid amount if any) */
            if ((float)$total_paid != 0)
            {
                $this->MAc_journal_details->create_by_inventory($sales_journal_no, $settings['ac_cash'], $total_paid);
            }
            /** Sales revenue credit (net sale amount) */
            $this->MAc_journal_details->create_by_inventory($sales_journal_no, $settings['ac_sales'], NULL, $total_price);
            /** Tax payable credit (tax amount) */
            if ($tax_amount > 0)
            {
                $this->MAc_journal_details->create_by_inventory($sales_journal_no, $settings['ac_tax'], NULL, $tax_amount);
            }
        }

        /** Check if previous expense journal exist then Remove expense journal details else make new expense journal master */
        $expense_journal = $this->MAc_journal_master->get_by_doc('Expense', $sales_no);
        if (count($expense_journal) > 0)
        {
            $expense_journal_no = $expense_journal['journal_no'];
            $this->MAc_journal_details->delete_by_journal_no($expense_journal_no);
        }
        else
        {
            $expense_journal_no = $this->MAc_journal_master->get_journal_number();
            $this->MAc_journal_master->create_by_doc($expense_journal_no, $sales_date, 'Direct Sales', 'Expense', $sales_no);
        }
        $this->MAc_journal_details->create_by_inventory($expense_journal_no, $settings['ac_cogs'], $total_cogs);
        $this->MAc_journal_details->create_by_inventory($expense_journal_no, $settings['ac_inventory'], NULL, $total_cogs);

        /** Auto Money Receipt if partial or full cash paid */
        if ((float)$total_paid != 0)
        {
            $mr = $this->MAc_money_receipts->get_latest();
            if (count($mr) > 0)
            {
                $mr_no = (int)$mr['mr_no'] + 1;
            }
            else
            {
                $mr_no = 1001;
            }
            $this->MAc_money_receipts->create_by_sales($mr_no, $total_paid, $sales_no);
        }

        echo 'inventory/sales-list';
    }

    /**
     * Delete sales by id
     *
     * @param  integer  $id
     * @return void
     */
    public function sales_delete($id)
    {
        $sales = $this->MSales_master->get_by_id($id);
        /** Remove auto created sales journal */
        $journal = $this->MAc_journal_master->get_by_doc('Sales', $sales['sales_no']);
        if (count($journal) > 0)
        {
            $this->MAc_journal_details->delete_by_journal_no($journal['journal_no']);
            $this->MAc_journal_master->delete_by_journal_no($journal['journal_no']);
        }
        /** Remove auto created money receipt for partial or full cash sales */
        $mr = $this->MAc_money_receipts->get_by_doc('Sales', $sales['sales_no']);
        if (count($mr) > 0)
        {
            $this->MAc_money_receipts->delete($mr['id']);
        }
        /** Remove sales */
        $this->MSales_details->delete_by_sales_no($sales['sales_no']);
        $this->MSales_master->delete($id);
        redirect('inventory/sales-list', 'refresh');
    }

    /**
     * Delete unsaved sales by sales no
     *
     * @return void
     */
    public function sales_unsaved_delete()
    {
        $sales_no = $this->input->post('sales_no');
        /** Remove auto created sales journal */
        $journal = $this->MAc_journal_master->get_by_doc('Sales', $sales_no);
        if (count($journal) > 0)
        {
            $this->MAc_journal_details->delete_by_journal_no($journal['journal_no']);
            $this->MAc_journal_master->delete_by_journal_no($journal['journal_no']);
        }
        /** Remove auto created money receipt for partial or full cash sales */
        $mr = $this->MAc_money_receipts->get_by_doc('Sales', $sales_no);
        if (count($mr) > 0)
        {
            $this->MAc_money_receipts->delete($mr['id']);
        }
        /** Remove sales */
        $this->MSales_details->delete_by_sales_no($sales_no);
        $this->MSales_master->delete_by_sales_no($sales_no);
    }

    /**
     * Delete sales item by item id
     *
     * @return void
     */
    public function sales_item_delete()
    {
        $this->MSales_details->delete($this->input->post('item_id'));
        $msg = $this->sales_table($this->input->post('sales_no'));
        echo $msg;
    }

    /**
     * Generate sales item table by sales no
     *
     * @param  string   $sales_no
     * @return string   $msg
     */
    public function sales_table($sales_no)
    {
        $settings = $this->MSettings->get_by_company_id($this->session->user_company);
        $tax_percent =  $settings['tax_rate'];

        $details = $this->MSales_details->get_by_sales_no($sales_no);

        $msg = '
        <table id="sales_details_table" class="table table-striped table-bordered">
        <thead>
        <tr>
        <th class="left">Item Code</th>
        <th class="left">Item Name</th>
        <th class="center">Quantity</th>
        <th class="center">Sales Price</th>
        <th class="center">Total Price</th>
        <th class="span3 center">Action</th>
        </tr>
        </thead>
        <tbody>';
        $qty = 0;
        $price = 0;
        $tax_amount = 0;
        if (count($details) > 0)
        {
            foreach ($details as $list)
            {
                $msg .= '
                <tr>
                <td>' . $list['item_code'] . '</td>
                <td>' . $list['item_name'] . '</td>
                <td class="center">' . $list['quantity'] . '</td>
                <td class="right">' . number_format($list['sale_price'], 2) . '</td>
                <td class="right">' . number_format($list['quantity'] * $list['sale_price'], 2) . '</td>
                <td class="center">
                <input type="hidden" value="' . $list['id'] . '" /><span class="btn del btn-danger sales_item_delete"><i class="icon-trash icon-white"></i>Delete</span>
                </td>
                </tr>';
                $qty += $list['quantity'];
                $price += $list['quantity'] * $list['sale_price'];
            }
        }
        if ($price > 0)
        {
            $tax_amount = ($tax_percent * $price) / 100;
            $total_amount = $price + $tax_amount;
        }

        $msg .= '</tbody>
        <tfoot>
        <tr>
        <th class="left" colspan="6">Order Totals</th>
        </tr>
        <tr>
        <td colspan="2">&nbsp;</td>
        <td class="center">' . $qty . '</td>
        <td></td>
        <td class="right">' . number_format($price, 2) . '</td>
        <td></td>
        </tr>
        <tr>
        <td colspan="4" class="right">Sales TAX</td>
        <td class="right">' . number_format($tax_amount, 2) . '</td>
        <td></td>
        </tr>
        <!--<tr>
        <td colspan="4" class="right">Discount</td>
        <td class="right"><input type="text" name="discount" id="discount" value=""></td>
        <td></td>
        </tr> -->
        <tr>
        <td colspan="4" class="right">Total Paid Amount</td>
        <td class="right"><input type="text" data-org-amount="' . $total_amount . '" name="paid_amount" id="paid_amount" value="' . $total_amount . '"></td>
        <td></td>
        </tr>
        </tfoot>
        </table>';

        return $msg;
    }

    /**
     * All sales return list
     *
     * @return void
     */
    public function sales_return_list()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'inventory';
        $data['content'] = 'admin/inventory/sales_return/list';
        $data['sales_returns'] = $this->MSales_return_master->get_all();
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Add new sales return item or edit sales return by id
     *
     * @param  integer  $id
     * @return void
     */
    public function sales_return_save($id = NULL)
    {
        if ($this->input->post())
        {
            $item_id = trim($this->input->post('item_id'));
            $sales_return_no = trim($this->input->post('sales_return_no'));

            /** Check if the item quantity can be return */
            $total_sales = $this->MSales_details->get_total_qty_by_item_id($item_id);
            $total_sales_return = $this->MSales_return_details->get_total_qty_by_item_id($item_id);

            if ($this->input->post('quantity') > ($total_sales - $total_sales_return))
            {
                echo 'invalid';
            }
            else
            {
                $sales_return = $this->MSales_return_master->get_by_sales_return_no($sales_return_no);
                if (count($sales_return) > 0)
                {
                    $this->MSales_return_master->update($sales_return[0]['id']);
                }
                else
                {
                    $this->MSales_return_master->create();
                }

                $item = $this->MItems->get_by_id($item_id);
                $this->MSales_return_details->create($sales_return_no, $item);
                $msg = $this->sales_return_table($sales_return_no);
                //echo json_encode(array('success' => $msg));
                echo $msg;
            }
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'inventory';
            $data['content'] = 'admin/inventory/sales_return/save';
            $sales_return = $this->MSales_return_master->get_last_sales_return_no();
            if (count($sales_return) > 0)
            {
                $data['sales_return_no'] = (int)$sales_return['sales_return_no'] + 1;
            }
            else
            {
                $data['sales_return_no'] = 1001;
            }
            $data['customers'] = $this->MCustomers->get_all();
            $data['items'] = $this->MItems->get_all('Active');
            if ($id)
            {
                $data['sales_return'] = $this->MSales_return_master->get_by_id($id);
                $sales_return_no = $data['sales_return']['sales_return_no'];
            }
            else
            {
                $sales_return_no = $data['sales_return_no'];
                $data['sales_return'] = NULL;
            }
            $customer = $this->MCustomers->get_latest();
            if (count($customer) > 0)
            {
                $data['code'] = (int)$customer['code'] + 1;
            }
            else
            {
                $data['code'] = 1001;
            }
            $data['details'] = $this->MSales_return_details->get_by_sales_return_no($sales_return_no);
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    /**
     * Preview sales return by sales return no
     *
     * @param  string   $sales_return_no
     * @return void
     */
    public function sales_return_preview($sales_return_no = NULL)
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'inventory';
        $data['content'] = 'admin/inventory/sales_return/preview';
        $data['master'] = $this->MSales_return_master->get_by_sales_return_no($sales_return_no);
        $data['details'] = $this->MSales_return_details->get_by_sales_return_no($sales_return_no);
        $data['company'] = $this->MCompanies->get_by_id($data['master'][0]['company_id']);
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Print sales return by sales return no
     *
     * @param  integer  $sales_return_no
     * @return void
     */
    public function sales_return_print($sales_return_no = NULL)
    {
        $data['title'] = 'POS System';
        $data['master'] = $this->MSales_return_master->get_by_sales_return_no($sales_return_no);
        $data['details'] = $this->MSales_return_details->get_by_sales_return_no($sales_return_no);
        $data['company'] = $this->MCompanies->get_by_id($data['master'][0]['company_id']);
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/inventory/sales_return/print', $data);
    }

    /**
     * Complete sales return with accounts journal entry
     *
     * @return void
     */
    public function sales_return_complete()
    {
        $sales_return_no = trim($this->input->post('sales_return_no'));
        $sales_return_date = date_to_db(trim($this->input->post('sales_return_date')));

        $sales_return = $this->MSales_return_master->get_by_sales_return_no($sales_return_no);
        $this->MSales_return_master->update($sales_return[0]['id']);
        $this->MSales_return_master->update_tax_info($sales_return_no);

        /** Check if previous sales return journal exist then Remove sales return journal details else make new sales return journal master */
        $sales_return_journal = $this->MAc_journal_master->get_by_doc('Sales Return', $sales_return_no);
        if (count($sales_return_journal) > 0)
        {
            $sales_return_journal_no = $sales_return_journal['journal_no'];
            $this->MAc_journal_details->delete_by_journal_no($sales_return_journal_no);
        }
        else
        {
            $sales_return_journal_no = $this->MAc_journal_master->get_journal_number();
            $this->MAc_journal_master->create_by_doc($sales_return_journal_no, $sales_return_date, 'Sales Return', 'Sales Return', $sales_return_no);
        }

        $settings = $this->MSettings->get_by_company_id($this->session->user_company);
        $total_price = $this->MSales_return_details->get_total_price_by_sales_return_no($sales_return_no);

        /** Calculate COGS */
        $total_cogs = $this->MSales_return_details->get_total_cogs($sales_return_no);

        /** Calculate Sales Tax */
        $tax_amount = 0;
        $tax_percent = $settings['tax_rate'];
        if ($tax_percent > 0)
        {
            $tax_amount = ($total_price * $tax_percent) / 100;
        }

        /** Calculate Dues */
        $total_paid = $this->input->post('paid_amount');
        $dues = ((float)$total_price + (float)$tax_amount) - (float)$total_paid;

        /** Sales Return Journal details entry */
        if ($dues == 0)
        {
            /** Cash credit (gross amount) */
            $this->MAc_journal_details->create_by_inventory($sales_return_journal_no, $settings['ac_cash'], NULL, $total_paid);
            /** Sales revenue debit (net sale amount) */
            $this->MAc_journal_details->create_by_inventory($sales_return_journal_no, $settings['ac_inventory'], $total_price);
            /** Tax payable debit (tax amount) */
            if ($tax_amount > 0)
            {
                $this->MAc_journal_details->create_by_inventory($sales_return_journal_no, $settings['ac_tax'], $tax_amount);
            }
        }
        else
        {
            /** Accounts payable / Customer account credit (dues amount) */
            $customer = $this->MCustomers->get_by_id($this->input->post('customer_id'));
            $this->MAc_journal_details->create_by_inventory($sales_return_journal_no, $customer['ac_id'], NULL, $dues);
            /** Cash credit (paid amount if any) */
            if ((float)$total_paid != 0)
            {
                $this->MAc_journal_details->create_by_inventory($sales_return_journal_no, $settings['ac_cash'], NULL, $total_paid);
            }
            /** Sales revenue debit (net sale amount) */
            $this->MAc_journal_details->create_by_inventory($sales_return_journal_no, $settings['ac_inventory'], $total_sales);
            /** Tax payable debit (tax amount) */
            if ($tax_amount > 0)
            {
                $this->MAc_journal_details->create_by_inventory($sales_return_journal_no, $settings['ac_tax'], $tax_amount);
            }
        }

        /** Check if previous expense journal exist then Remove expense journal details else make new expense journal master */
        // $expense_journal = $this->MAc_journal_master->get_by_doc( 'Expense', $sales_no );
        // if( count($expense_journal) > 0 ){
        //     $expense_journal_no = $expense_journal['journal_no'];
        //     $this->MAc_journal_details->delete_by_journal_no( $expense_journal_no );
        // } else {
        //     $expense_journal_no = $this->MAc_journal_master->get_journal_number();
        //     $this->MAc_journal_master->create_by_doc( $expense_journal_no, $sales_date, 'Direct Sales', 'Expense', $sales_no );
        // }
        // $this->MAc_journal_details->create_by_inventory( $expense_journal_no, $settings['ac_cogs'], $total_sales );
        // $this->MAc_journal_details->create_by_inventory( $expense_journal_no, $settings['ac_inventory'], NULL, $total_sales );

        /** Auto Money Receipt if partial or full cash paid */
        // if ( (float) $total_paid != 0 ) {
        //     $mr = $this->MAc_money_receipts->get_latest();
        //     if (count($mr) > 0) {
        //         $mr_no = (int) $mr['mr_no'] + 1;
        //     } else {
        //         $mr_no = 1001;
        //     }
        //     $this->MAc_money_receipts->create_by_sales( $mr_no, $total_paid, $sales_no );
        // }

        echo 'inventory/sales-return-list';
    }

    /**
     * Delete sales return by id
     *
     * @param  integer  $id
     * @return void
     */
    public function sales_return_delete($id)
    {
        $sales_return = $this->MSales_return_master->get_by_id($id);
        /** Remove auto created sales journal */
        $journal = $this->MAc_journal_master->get_by_doc('Sales Return', $sales_return['sales_return_no']);
        if (count($journal) > 0)
        {
            $this->MAc_journal_details->delete_by_journal_no($journal['journal_no']);
            $this->MAc_journal_master->delete_by_journal_no($journal['journal_no']);
        }
        /** Remove auto created money receipt for partial or full cash sales */
        // $mr = $this->MAc_money_receipts->get_by_doc( 'Sales', $sales['sales_no'] );
        // if( count($mr) > 0 ){
        //     $this->MAc_money_receipts->delete( $mr['id'] );
        // }
        /** Remove sales */
        $this->MSales_return_details->delete_by_sales_return_no($sales_return['sales_return_no']);
        $this->MSales_return_master->delete($id);
        redirect('inventory/sales-return-list', 'refresh');
    }

    /**
     * Delete unsaved sales return by sales return no
     *
     * @return void
     */
    public function sales_return_unsaved_delete()
    {
        $sales_return_no = $this->input->post('sales_return_no');
        /** Remove auto created sales journal */
        $journal = $this->MAc_journal_master->get_by_doc('Sales Return', $sales_return_no);
        if (count($journal) > 0)
        {
            $this->MAc_journal_details->delete_by_journal_no($journal['journal_no']);
            $this->MAc_journal_master->delete_by_journal_no($journal['journal_no']);
        }
        /** Remove sales */
        $this->MSales_return_details->delete_by_sales_return_no($sales_return_no);
        $this->MSales_return_master->delete_by_sales_return_no($sales_return_no);
    }

    /**
     * Delete sales return item by item id
     *
     * @return void
     */
    public function sales_return_item_delete()
    {
        $this->MSales_return_details->delete($this->input->post('item_id'));
        $msg = $this->sales_return_table($this->input->post('sales_return_no'));
        echo $msg;
    }

    /**
     * Generate sales return item table by sales return no
     *
     * @param  string   $sales_return_no
     * @return string   $msg
     */
    public function sales_return_table($sales_return_no)
    {
        $settings = $this->MSettings->get_by_company_id($this->session->user_company);
        $tax_percent =  $settings['tax_rate'];

        $details = $this->MSales_return_details->get_by_sales_return_no($sales_return_no);

        $msg = '
        <table id="sales_return_details_table" class="table table-striped table-bordered">
        <thead>
        <tr>
        <th class="left">Item Code</th>
        <th class="left">Item Name</th>
        <th class="center">Quantity</th>
        <th class="center">Unit Price</th>
        <th class="center">Total Price</th>
        <th class="span3 center">Action</th>
        </tr>
        </thead>';
        $msg .= '<tbody>';
        $qty = 0;
        $price = 0;
        $tax_amount = 0;
        if (count($details) > 0)
        {
            foreach ($details as $list)
            {
                $msg .= '
                <tr>
                <td>' . $list['item_code'] . '</td>
                <td>' . $list['item_name'] . '</td>
                <td class="center">' . $list['quantity'] . '</td>
                <td class="right">' . number_format($list['sale_price'], 2) . '</td>
                <td class="right">' . number_format($list['quantity'] * $list['sale_price'], 2) . '</td>
                <td class="center">
                <input type="hidden" value="' . $list['id'] . '" /><span class="btn del btn-danger sales_return_item_delete"><i class="icon-trash icon-white"></i>Delete</span>
                </td>
                </tr>';
                $qty += $list['quantity'];
                $price += $list['quantity'] * $list['sale_price'];
            }
        }
        if ($price > 0)
        {
            $tax_amount = ($tax_percent * $price) / 100;
            $total_amount = $price + $tax_amount;
        }
        $msg .= '</tbody>
        <tfoot>
        <tr>
        <th class="left" colspan="6">Order Totals</th>
        </tr>
        <tr>
        <td colspan="2">&nbsp;</td>
        <td class="center">' . $qty . '</td>
        <td></td>
        <td class="right">' . number_format($price, 2) . '</td>
        <td></td>
        </tr>
        <tr>
        <td colspan="4" class="right">Sales TAX</td>
        <td class="right">' . number_format($tax_amount, 2) . '</td>
        <td></td>
        </tr>
        <tr>
        <td colspan="4" class="right"> Total Paid Amount</td>
        <td class="right"><input type="text" data-org-amount="' . $total_amount . '" name="paid_amount" id="paid_amount" value="' . $total_amount . '"></td>
        <td></td>
        </tr>
        </tfoot>
        </table>';

        return $msg;
    }

    /**
     * All purchase list
     *
     * @return void
     */
    public function purchase_list()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'inventory';
        $data['content'] = 'admin/inventory/purchase/list';
        $data['purchases'] = $this->MPurchase_master->get_all();
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Add new purchase item or edit purchase item by id
     *
     * @param  integer  $id
     * @return void
     */
    public function purchase_save($id = NULL)
    {
        if ($this->input->post())
        {
            $purchase = $this->MPurchase_master->get_by_purchase_no($this->input->post('purchase_no'));
            if (count($purchase) > 0)
            {
                $this->MPurchase_master->update($purchase[0]['id']);
            }
            else
            {
                $this->MPurchase_master->create();
            }
            /** Add purchase info on details table */
            $this->MPurchase_details->create($this->input->post('purchase_no'));
            /** Update AVCO price in item table */
            $avco = $this->MPurchase_details->get_avco(trim($this->input->post('item_id')));
            $this->MItems->update_field(trim($this->input->post('item_id')), 'avco_price', $avco);
            $msg = $this->purchase_table($this->input->post('purchase_no'));
            echo $msg;
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'inventory';
            $data['content'] = 'admin/inventory/purchase/save';
            $purchase = $this->MPurchase_master->get_last_purchase_no();
            if (count($purchase) > 0)
            {
                $data['purchase_no'] = (int)$purchase['purchase_no'] + 1;
            }
            else
            {
                $data['purchase_no'] = 1001;
            }
            $data['suppliers'] = $this->MSuppliers->get_all();
            $data['items'] = $this->MItems->get_all('active');
            $data['purchase'] = $this->MPurchase_master->get_by_id($id);
            if ($id)
            {
                $purchase_no = $data['purchase']['purchase_no'];
            }
            else
            {
                $purchase_no = $data['purchase_no'];
            }
            $supplier = $this->MSuppliers->get_latest();
            if (count($supplier) > 0)
            {
                $data['code'] = (int)$supplier['code'] + 1;
            }
            else
            {
                $data['code'] = 2001;
            }
            $data['details'] = $this->MPurchase_details->get_by_purchase_no($purchase_no);
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    /**
     * Preview purchase by purchase no
     *
     * @param  integer  $purchase_no
     * @return void
     */
    public function purchase_preview($purchase_no = NULL)
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'inventory';
        $data['content'] = 'admin/inventory/purchase/preview';
        $data['master'] = $this->MPurchase_master->get_by_purchase_no($purchase_no);
        $data['details'] = $this->MPurchase_details->get_by_purchase_no($purchase_no);
        $data['company'] = $this->MCompanies->get_by_id($data['master'][0]['company_id']);
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Print purchase by purchase no
     *
     * @param  integer  $purchase_no
     * @return void
     */
    public function purchase_print($purchase_no = NULL)
    {
        $data['title'] = 'POS System';
        $data['master'] = $this->MPurchase_master->get_by_purchase_no($purchase_no);
        $data['details'] = $this->MPurchase_details->get_by_purchase_no($purchase_no);
        $data['company'] = $this->MCompanies->get_by_id($data['master'][0]['company_id']);
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/inventory/purchase/print', $data);
    }

    /**
     * Complete purchase with accounts journal entry
     *
     * @return void
     */
    public function purchase_complete()
    {
        $purchase = $this->MPurchase_master->get_by_purchase_no($this->input->post('purchase_no'));
        $purchase_no = trim($this->input->post('purchase_no'));
        $this->MPurchase_master->update($purchase[0]['id']);

        /** Check if previous journal exist then Remove journal details else make new journal master */
        $journal = $this->MAc_journal_master->get_by_doc('Purchase', $purchase_no);
        if (count($journal) > 0)
        {
            $journal_no = $journal['journal_no'];
            $this->MAc_journal_details->delete_by_journal_no($journal_no);
        }
        else
        {
            $journal_no = $this->MAc_journal_master->get_journal_number();
            $this->MAc_journal_master->create_by_purchase($journal_no, $purchase_no);
        }

        $settings = $this->MSettings->get_by_company_id($this->session->userdata('user_company'));

        /** Determine Credit or Cash Purchase and make journal */
        $total_purchase = $this->MPurchase_details->get_total_price($purchase_no);
        $total_paid = $this->input->post('paid_amount');
        $dues = (float)$total_purchase - (float)$total_paid;
        if ($dues == 0)
        {
            $this->MAc_journal_details->create_by_inventory($journal_no, $settings['ac_cash'], NULL, $total_purchase);
            $this->MAc_journal_details->create_by_inventory($journal_no, $settings['ac_inventory'], $total_purchase);
        }
        else
        {
            $supplier = $this->MSuppliers->get_by_id($this->input->post('supplier_id'));
            $this->MAc_journal_details->create_by_inventory($journal_no, $supplier['ac_id'], NULL, $dues);
            if ((float)$total_paid != 0)
            {
                $this->MAc_journal_details->create_by_inventory($journal_no, $settings['ac_cash'], NULL, $total_paid);
            }
            $this->MAc_journal_details->create_by_inventory($journal_no, $settings['ac_inventory'], $total_purchase);
        }

        /** Auto Payment Receipt if partial or full cash paid */
        if ((float)$total_paid != 0)
        {
            $payment = $this->MAc_payment_receipts->get_latest();
            if (count($payment) > 0)
            {
                $payment_no = (int)$payment['payment_no'] + 1;
            }
            else
            {
                $payment_no = 1001;
            }
            $this->MAc_payment_receipts->create_by_purchase($payment_no, $total_paid, $purchase_no);
        }

        echo 'inventory/purchase-list';
    }

    /**
     * Delete purchase by id
     *
     * @param  integer  $id
     * @return void
     */
    public function purchase_delete($id)
    {
        $purchase = $this->MPurchase_master->get_by_id($id);
        /** Remove auto created purchase journal */
        $journal = $this->MAc_journal_master->get_by_doc('Purchase', $purchase['purchase_no']);
        if (count($journal) > 0)
        {
            $this->MAc_journal_details->delete_by_journal_no($journal['journal_no']);
            $this->MAc_journal_master->delete_by_journal_no($journal['journal_no']);
        }
        /** Remove auto created payment receipt for partial or full cash purchase */
        $payment = $this->MAc_payment_receipts->get_by_doc('Purchase', $purchase['purchase_no']);
        if (count($payment) > 0)
        {
            $this->MAc_payment_receipts->delete($payment['id']);
        }
        /** Remove purchase */
        $this->MPurchase_details->delete_by_purchase_no($purchase['purchase_no']);
        $this->MPurchase_master->delete($id);
        redirect('inventory/purchase-list', 'refresh');
    }

    /**
     * Delete unsaved purchase by purchase no
     *
     * @return void
     */
    public function purchase_unsaved_delete()
    {
        $purchase_no = $this->input->post('purchase_no');
        /** Remove auto created purchase journal */
        $journal = $this->MAc_journal_master->get_by_doc('Purchase', $purchase_no);
        if (count($journal) > 0)
        {
            $this->MAc_journal_details->delete_by_journal_no($journal['journal_no']);
            $this->MAc_journal_master->delete_by_journal_no($journal['journal_no']);
        }
        /** Remove auto created payment receipt for partial or full cash purchase */
        $payment = $this->MAc_payment_receipts->get_by_doc('Purchase', $purchase_no);
        if (count($payment) > 0)
        {
            $this->MAc_payment_receipts->delete($payment['id']);
        }
        /** Remove purchase */
        $this->MPurchase_details->delete_by_purchase_no($purchase_no);
        $this->MPurchase_master->delete_by_purchase_no($purchase_no);
    }

    /**
     * Delete purchase item by item id
     *
     * @return void
     */
    public function purchase_item_delete()
    {
        /** Delete item from purchase details table */
        $this->MPurchase_details->delete(trim($this->input->post('item_id')));
        /** Update AVCO price in item table */
        $avco = $this->MPurchase_details->get_avco(trim($this->input->post('item_id')));
        $this->MItems->update_field(trim($this->input->post('item_id')), 'avco_price', $avco);

        $msg = $this->purchase_table($this->input->post('purchase_no'));
        echo $msg;
    }

    /**
     * Generate purchase item table by purchase no
     *
     * @param  string   $purchase_no
     * @return string   $msg
     */
    public function purchase_table($purchase_no)
    {
        $details = $this->MPurchase_details->get_by_purchase_no($purchase_no);

        $msg = '
        <table id="data_table" class="table table-bordered table-striped responsive">
        <thead>
        <tr>
        <th class="left">Item Code</th>
        <th class="left">Item Name</th>
        <th class="center">Quantity</th>
        <th class="center">Unit Price</th>
        <th class="center">Total Price</th>
        <th class="span3 center">Action</th>
        </tr>
        </thead>';
        $msg .= '<tbody>';
        $qty = 0;
        $price = 0;
        if (count($details) > 0)
        {
            foreach ($details as $list)
            {
                $msg .= '
                <tr>
                <td>' . $list['item_code'] . '</td>
                <td>' . $list['item_name'] . '</td>
                <td class="center">' . $list['quantity'] . '</td>
                <td class="right">' . number_format($list['purchase_price'], 2) . '</td>
                <td class="right">' . number_format($list['quantity'] * $list['purchase_price'], 2) . '</td>
                <td class="center">
                <input type="hidden" value="' . $list['id'] . '" /><span class="btn btn-danger purchase_item_delete"><i class="icon-trash icon-white"></i>Delete</span>
                </td>
                </tr>';
                $qty += $list['quantity'];
                $price += $list['quantity'] * $list['purchase_price'];
            }
        }
        $msg .= '</tbody>
        <tfoot>
        <tr>
        <th class="left" colspan="6">Order Totals</th>
        </tr>
        <tr>
        <td colspan="2">&nbsp</td>
        <td class="center">' . $qty . '</td>
        <td></td>
        <td class="right">' . number_format($price, 2) . '</td><td></td>
        </tr>
        <tr>
        <td colspan="4" class="right"> Total Paid Amount</td>
        <td class="right"><input type="text" name="paid_amount" id="paid_amount" value="'.$price.'"></td>
        <td></td>
        </tr>
        </tfoot>
        </table>';

        return $msg;
    }

    /**
     * All purchase return list
     *
     * @return void
     */
    public function purchase_return_list()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'inventory';
        $data['content'] = 'admin/inventory/purchase_return/list';
        $data['purchase_returns'] = $this->MPurchase_return_master->get_all();
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Add new purchase return item or edit purchase return item by id
     *
     * @param  integer  $id
     * @return void
     */
    public function purchase_return_save($id = NULL)
    {
        if ($this->input->post())
        {
            $item_id = $this->input->post('item_id');
            $purchase_return_no = $this->input->post('purchase_return_no');

            /** Check if the item quantity can be return */
            $total_purchase = $this->MPurchase_details->get_total_qty_by_item_id($item_id);
            $total_purchase_return = $this->MPurchase_return_details->get_total_qty_by_item_id($item_id);

            if ($this->input->post('quantity') > ($total_purchase - $total_purchase_return))
            {
                echo 'invalid';
            }
            else
            {
                $purchase_return = $this->MPurchase_return_master->get_by_purchase_return_no($purchase_return_no);
                if (count($purchase_return) > 0)
                {
                    $this->MPurchase_return_master->update($purchase_return[0]['id']);
                }
                else
                {
                    $this->MPurchase_return_master->create();
                }
                $this->MPurchase_return_details->create($purchase_return_no);
                $msg = $this->purchase_return_table($purchase_return_no);
                echo $msg;
            }
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'inventory';
            $data['content'] = 'admin/inventory/purchase_return/save';
            $purchase = $this->MPurchase_return_master->get_last_purchase_return_no();
            if (count($purchase) > 0)
            {
                $data['purchase_return_no'] = (int)$purchase['purchase_return_no'] + 1;
            }
            else
            {
                $data['purchase_return_no'] = 1001;
            }
            $data['suppliers'] = $this->MSuppliers->get_all();
            $data['items'] = $this->MItems->get_all('Active');
            $data['purchase_return'] = $this->MPurchase_return_master->get_by_id($id);
            if ($id)
            {
                $purchase_return_no = $data['purchase_return']['purchase_return_no'];
            }
            else
            {
                $purchase_return_no = $data['purchase_return_no'];
            }
            $supplier = $this->MSuppliers->get_latest();
            if (count($supplier) > 0)
            {
                $data['code'] = (int)$supplier['code'] + 1;
            }
            else
            {
                $data['code'] = 2001;
            }
            $data['details'] = $this->MPurchase_return_details->get_by_purchase_return_no($purchase_return_no);
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    /**
     * Preview purchase return by purchase return no
     *
     * @param  string   $purchase_return_no
     * @return void
     */
    public function purchase_return_preview($purchase_return_no = NULL)
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'inventory';
        $data['content'] = 'admin/inventory/purchase_return/preview';
        $data['master'] = $this->MPurchase_return_master->get_by_purchase_return_no($purchase_return_no);
        $data['details'] = $this->MPurchase_return_details->get_by_purchase_return_no($purchase_return_no);
        $data['company'] = $this->MCompanies->get_by_id($data['master'][0]['company_id']);
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Print purchase by purchase no
     *
     * @param  integer  $purchase_return_no
     * @return void
     */
    public function purchase_return_print($purchase_return_no = NULL)
    {
        $data['title'] = 'POS System';
        $data['master'] = $this->MPurchase_return_master->get_by_purchase_return_no($purchase_return_no);
        $data['details'] = $this->MPurchase_return_details->get_by_purchase_return_no($purchase_return_no);
        $data['company'] = $this->MCompanies->get_by_id($data['master'][0]['company_id']);
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/inventory/purchase_return/print', $data);
    }

    /**
     * Complete purchase return
     *
     * @return void
     */
    public function purchase_return_complete()
    {
        $purchase_return = $this->MPurchase_return_master->get_by_purchase_return_no($this->input->post('purchase_return_no'));
        $purchase_return_no = trim($this->input->post('purchase_return_no'));
        $purchase_return_date = trim($this->input->post('purchase_return_date'));
        $this->MPurchase_return_master->update($purchase_return[0]['id']);

        /** Check if previous journal exist then Remove journal details else make new journal master */
        $journal = $this->MAc_journal_master->get_by_doc('Purchase Return', $purchase_return_no);
        if (count($journal) > 0)
        {
            $journal_no = $journal['journal_no'];
            $this->MAc_journal_details->delete_by_journal_no($journal_no);
        }
        else
        {
            $journal_no = $this->MAc_journal_master->get_journal_number();
            $this->MAc_journal_master->create_by_doc($journal_no, $purchase_return_date, 'Purchase Return', 'Purchase Return', $purchase_return_no);
        }

        $settings = $this->MSettings->get_by_company_id($this->session->userdata('user_company'));

        /** Determine Credit or Cash Purchase and make journal */
        $total_purchase = $this->MPurchase_return_details->get_total_price($purchase_return_no);
        $total_paid = $this->input->post('paid_amount');
        $dues = (float)$total_purchase - (float)$total_paid;
        if ($dues == 0)
        {
            $this->MAc_journal_details->create_by_inventory($journal_no, $settings['ac_cash'], $total_purchase);
            $this->MAc_journal_details->create_by_inventory($journal_no, $settings['ac_inventory'], NULL, $total_purchase);
        }
        else
        {
            $supplier = $this->MSuppliers->get_by_id($this->input->post('supplier_id'));
            $this->MAc_journal_details->create_by_inventory($journal_no, $supplier['ac_id'], $dues);
            if ((float)$total_paid != 0)
            {
                $this->MAc_journal_details->create_by_inventory($journal_no, $settings['ac_cash'], $total_paid);
            }
            $this->MAc_journal_details->create_by_inventory($journal_no, $settings['ac_inventory'], NULL, $total_purchase);
        }

        /** Auto Payment Receipt if partial or full cash paid */
        // if ( (float) $total_paid != 0 ) {
        //     $payment = $this->MAc_payment_receipts->get_latest();
        //     if (count($payment) > 0) {
        //         $payment_no = (int) $payment['payment_no'] + 1;
        //     } else {
        //         $payment_no = 1001;
        //     }
        //     $this->MAc_payment_receipts->create_by_purchase( $payment_no, $total_paid, $purchase_return_no );
        // }

        echo 'inventory/purchase-return-list';
    }

    /**
     * Delete purcahse return by id
     *
     * @param  integer  $id
     * @return void
     */
    public function purchase_return_delete($id)
    {
        $purchase = $this->MPurchase_return_master->get_by_id($id);
        /** Remove auto created purchase journal */
        $journal = $this->MAc_journal_master->get_by_doc('Purchase Return', $purchase['purchase_return_no']);
        if (count($journal) > 0)
        {
            $this->MAc_journal_details->delete_by_journal_no($journal['journal_no']);
            $this->MAc_journal_master->delete_by_journal_no($journal['journal_no']);
        }
        /** Remove auto created payment receipt for partial or full cash purchase */
        $payment = $this->MAc_payment_receipts->get_by_doc('Purchase', $purchase['purchase_return_no']);
        if (count($payment) > 0)
        {
            $this->MAc_payment_receipts->delete($payment['id']);
        }
        /** Remove purchase */
        $this->MPurchase_return_details->delete_by_purchase_return_no($purchase['purchase_return_no']);
        $this->MPurchase_return_master->delete($id);
        redirect('inventory/purchase-return-list', 'refresh');
    }

    /**
     * Delete unsaved purcahse return by purchase return no
     *
     * @return void
     */
    public function purchase_return_unsaved_delete()
    {
        $purchase_return_no = $this->input->post("purchase_return_no");
        /** Remove auto created purchase journal */
        $journal = $this->MAc_journal_master->get_by_doc('Purchase Return', $purchase_return_no);
        if (count($journal) > 0)
        {
            $this->MAc_journal_details->delete_by_journal_no($journal['journal_no']);
            $this->MAc_journal_master->delete_by_journal_no($journal['journal_no']);
        }
        /** Remove auto created payment receipt for partial or full cash purchase */
        $payment = $this->MAc_payment_receipts->get_by_doc('Purchase', $purchase_return_no);
        if (count($payment) > 0)
        {
            $this->MAc_payment_receipts->delete($payment['id']);
        }
        /** Remove purchase */
        $this->MPurchase_return_details->delete_by_purchase_return_no($purchase_return_no);
        $this->MPurchase_return_master->delete_by_purchase_return_no($purchase_return_no);
    }

    /**
     * Delete purchase return item by item id
     *
     * @return void
     */
    public function purchase_return_item_delete()
    {
        $this->MPurchase_return_details->delete($this->input->post('item_id'));
        $msg = $this->purchase_return_table( $this->input->post('purchase_return_no'));
        echo $msg;
    }

    /**
     * Generate purchase return item table by purchase return no
     *
     * @param  string   $purchase_return_no
     * @return string   $msg
     */
    public function purchase_return_table($purchase_return_no)
    {
        $details = $this->MPurchase_return_details->get_by_purchase_return_no($purchase_return_no);

        $msg = '
        <table id="data_table" class="table table-bordered table-striped responsive">
        <thead>
        <tr>
        <th class="left">Item Code</th>
        <th class="left">Item Name</th>
        <th class="center">Quantity</th>
        <th class="center">Unit Price</th>
        <th class="center">Total Price</th>
        <th class="span3 center">Action</th>
        </tr>
        </thead>';
        $msg .= '<tbody>';
        $qty = 0;
        $price = 0;
        if (count($details) > 0)
        {
            foreach ($details as $list)
            {
                $msg .= '
                <tr>
                <td>' . $list['item_code'] . '</td>
                <td>' . $list['item_name'] . '</td>
                <td class="center">' . $list['quantity'] . '</td>
                <td class="right">' . number_format($list['purchase_price'], 2) . '</td>
                <td class="right">' . number_format($list['quantity'] * $list['purchase_price'], 2) . '</td>
                <td class="center">
                <input type="hidden" value="' . $list['id'] . '" /><span class="btn btn-danger purchase_return_item_delete"><i class="icon-trash icon-white"></i>Delete</span>
                </td>
                </tr>';
                $qty += $list['quantity'];
                $price += $list['quantity'] * $list['purchase_price'];
            }
        }
        $msg .= '</tbody>
        <tfoot>
        <tr>
        <th class="left" colspan="6">Order Totals</th>
        </tr>
        <tr>
        <td colspan="2">&nbsp</td>
        <td class="center">' . $qty . '</td>
        <td></td>
        <td class="right">' . number_format($price, 2) . '</td><td></td>
        </tr>
        <tr>
        <td colspan="4" class="right"> Total Paid Amount</td>
        <td class="right"><input type="text" name="paid_amount" id="paid_amount"></td>
        <td></td>
        </tr>
        </tfoot>
        </table>';

        return $msg;
    }

    /**
     * All customer list
     *
     * @return void
     */
    public function customer_list()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'inventory';
        $data['content'] = 'admin/inventory/customer/list';
        $data['customers'] = $this->MCustomers->get_all();
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Add new customer or edit customer by id
     *
     * @param  integer  $id
     * @return void
     */
    public function customer_save($id = NULL)
    {
        if ($this->input->post())
        {
            if ($this->input->post('id'))
            {
                $this->MCustomers->update(trim($this->input->post('code')));
            }
            else
            {
                $ac_receivable = $this->MSettings->get_by_company_id($this->session->user_company);
                $chart = $this->MAc_charts->get_by_id($ac_receivable['ac_receivable']);
                $siblings = $this->MAc_charts->get_by_parent_id($ac_receivable['ac_receivable']);
                if (count($siblings) > 0)
                {
                    $ac_code_temp = explode('.', $siblings['code']);
                    $ac_last = count($ac_code_temp) - 1;
                    $ac_new = (int) $ac_code_temp[$ac_last] + 10;
                    $ac_code = $chart['code'] . '.' . $ac_new;
                }
                else
                {
                    $ac_code = $chart['code'] . '.10';
                }

                $ac_id = $this->MAc_charts->account_create($ac_receivable['ac_receivable'], $ac_code, $this->input->post('name'));

                // $customer = $this->MCustomers->get_latest();
                // if ( count( $customer ) > 0 ) {
                //     $code = (int) $customer['code'] + 1;
                // } else {
                //     $code = 1001;
                // }
                $this->MCustomers->create(trim($this->input->post('code')), $ac_id);
            }

            $this->session->set_flashdata('success', 'Customer saved successfully.');
            redirect('inventory/customer-list', 'refresh');
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'inventory';
            $data['content'] = 'admin/inventory/customer/save';
            $customer = $this->MCustomers->get_latest();
            if (count($customer) > 0)
            {
                $data['code'] = (int)$customer['code'] + 1;
            }
            else
            {
                $data['code'] = 1001;
            }
            $data['customer'] = $this->MCustomers->get_by_id($id);
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    /**
     * Add new customer by pop-up
     */
    public function add_new_customer()
    {
        if ($this->input->post())
        {
            $ac_receivable = $this->MSettings->get_by_company_id($this->session->user_company);
            $chart = $this->MAc_charts->get_by_id($ac_receivable['ac_receivable']);
            $siblings = $this->MAc_charts->get_by_parent_id($ac_receivable['ac_receivable']);
            if (count($siblings) > 0)
            {
                $ac_code_temp = explode('.', $siblings['code']);
                $ac_last = count( $ac_code_temp ) - 1;
                $ac_new = (int)$ac_code_temp[$ac_last] + 10;
                $ac_code = $chart['code'] . '.' . $ac_new;
            }
            else
            {
                $ac_code = $chart['code'] . '.10';
            }

            $ac_id = $this->MAc_charts->account_create($ac_receivable['ac_receivable'], $ac_code, $this->input->post('name'));
            $insert_id = $this->MCustomers->create(trim($this->input->post('code')), $ac_id);
            $customers = $this->MCustomers->get_all();
            $html = '';
            foreach ($customers as $customer)
            {
                if ($insert_id == $customer['id'])
                {
                    $html .= '<option value="' . $customer['id'] . '" selected>' . $customer['name'] . '</option>';
                }
                else
                {
                    $html .= '<option value="' . $customer['id'] . '">' . $customer['name'] . '</option>';
                }
            }
            echo $html;
        }
    }

    /**
     * Delete customer by id
     *
     * @param  integer  $id
     * @return void
     */
    public function customer_delete($id)
    {
        $sales = $this->MSales_master->get_by_customer_id($id);
        if (count($sales) > 0)
        {
            $this->session->set_flashdata('error', 'Customer can\'t delete, S/He is in Sales List.');
        }
        else
        {
            $this->MCustomers->delete($id);
        }

        redirect('inventory/customer-list', 'refresh');
    }

    /**
     * All supplier list
     *
     * @return void
     */
    public function supplier_list()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'inventory';
        $data['content'] = 'admin/inventory/supplier/list';
        $data['suppliers'] = $this->MSuppliers->get_all();
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Add new supplier or edit supplier by id
     *
     * @param  integer  $id
     * @return void
     */
    public function supplier_save($id = NULL)
    {
        if ($this->input->post())
        {
            if ($this->input->post('id'))
            {
                $this->MSuppliers->update(trim($this->input->post('code')));
            }
            else
            {
                $ac_payable = $this->MSettings->get_by_company_id($this->session->user_company);
                $chart = $this->MAc_charts->get_by_id($ac_payable['ac_payable']);
                $siblings = $this->MAc_charts->get_by_parent_id($ac_payable['ac_payable']);
                if (count($siblings) > 0)
                {
                    $ac_code_temp = explode('.', $siblings['code']);
                    $ac_last = count($ac_code_temp) - 1;
                    $ac_new = (int) $ac_code_temp[$ac_last] + 10;
                    $ac_code = $chart['code'] . '.' . $ac_new;
                }
                else
                {
                    $ac_code = $chart['code'] . '.10';
                }
                $ac_id = $this->MAc_charts->account_create($ac_payable['ac_payable'], $ac_code, $this->input->post('name'));

                // $supplier = $this->MSuppliers->get_latest();
                // if ( count( $supplier ) > 0 ) {
                //     $code = (int) $supplier['code'] + 1;
                // } else {
                //     $code = 2001;
                // }
                $this->MSuppliers->create(trim($this->input->post('code')), $ac_id);
            }
            $this->session->set_flashdata('message', 'Supplier saved successfully.');
            redirect('inventory/supplier-list', 'refresh');
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'inventory';
            $data['content'] = 'admin/inventory/supplier/save';
            $supplier = $this->MSuppliers->get_latest();
            if (count($supplier) > 0)
            {
                $data['code'] = (int)$supplier['code'] + 1;
            }
            else
            {
                $data['code'] = 2001;
            }
            $data['supplier'] = $this->MSuppliers->get_by_id($id);
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    /**
     * Add new supplier by pop-up
     */
    public function add_new_supplier()
    {
        if ($this->input->post())
        {
            $ac_payable = $this->MSettings->get_by_company_id($this->session->user_company);
            $chart = $this->MAc_charts->get_by_id($ac_payable['ac_payable']);
            $siblings = $this->MAc_charts->get_by_parent_id($ac_payable['ac_payable']);
            if (count($siblings) > 0)
            {
                $ac_code_temp = explode('.', $siblings['code']);
                $ac_last = count($ac_code_temp) - 1;
                $ac_new = (int)$ac_code_temp[$ac_last] + 10;
                $ac_code = $chart['code'] . '.' . $ac_new;
            }
            else
            {
                $ac_code = $chart['code'] . '.10';
            }
            $ac_id = $this->MAc_charts->account_create($ac_payable['ac_payable'], $ac_code, $this->input->post('name'));
            $insert_id = $this->MSuppliers->create(trim($this->input->post('code')), $ac_id);
            $suppliers = $this->MSuppliers->get_all();
            $html = '';
            foreach ($suppliers as $supplier)
            {
                if ($insert_id == $supplier['id'])
                {
                    $html .= '<option value="' . $supplier['id'] . '" selected>' . $supplier['name'] . '</option>';
                }
                else
                {
                    $html .= '<option value="' . $supplier['id'] . '">' . $supplier['name'] . '</option>';
                }
            }
            echo $html;
        }
    }

    /**
     * Delete supplier by id
     *
     * @param  integer $id
     * @return void
     */
    public function supplier_delete($id)
    {
        $purchase = $this->MPurchase_master->get_by_supplier_id($id);
        if (count($purchase) > 0)
        {
            $this->session->set_flashdata('error', 'Supplier can\'t delete, S/He is in Purchase List.');
        }
        else
        {
            $this->MSuppliers->delete($id);
        }

        redirect('inventory/supplier-list', 'refresh');
    }

    /**
     * All item list
     *
     * @return void
     */
    public function item_list()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'inventory';
        $data['content'] = 'admin/inventory/item/list';
        $data['items'] = $this->MItems->get_all();
        $data['privileges'] = $this->privileges;
        $this->load->spark('barcodegen/0.0.1');
        $this->load->view('admin/template', $data);
    }

    /**
     * Add new item or edit item by id
     *
     * @param  integer  $id
     * @return void
     */
    public function item_save($id = NULL)
    {
        if ($this->input->post())
        {
            if ($this->input->post('id'))
            {
                $this->MItems->update();
                $this->session->set_flashdata('success', 'Item updated successfully.');
                redirect('inventory/item-list', 'refresh');
            }
            else
            {
                $this->form_validation->set_rules('code', 'Item Code', 'callback_code_check');
                $this->form_validation->set_rules('name', 'Item Name', 'required');
                $this->form_validation->set_rules('min_sale_price', 'Min. Sale Price', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                    $data['title'] = 'POS System';
                    $data['menu'] = 'inventory';
                    $data['content'] = 'admin/inventory/item/save';
                    $data['item'] = $this->MItems->get_by_id($id);
                    $data['privileges'] = $this->privileges;
                    $this->load->view('admin/template', $data);
                }
                else
                {
                    $this->MItems->create();
                    $this->session->set_flashdata('success', 'Item created successfully.');
                    redirect('inventory/item-list', 'refresh');
                }
            }
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'inventory';
            $data['content'] = 'admin/inventory/item/save';
            $data['item'] = $this->MItems->get_by_id($id);
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    /**
     * Check item code if its duplicate
     *
     * @param  string   $code
     * @return boolean  true/false
     */
    public function code_check($code)
    {
        if( $this->MItems->get_by_code($code))
        {
            $this->form_validation->set_message('code_check', 'Item code can\'t be duplicate. Please choose different item code.');
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * Delete item by id
     *
     * @param  integer  $id
     * @return void
     */
    public function item_delete($id)
    {
        $purchase = $this->MPurchase_details->get_by_item_id($id);
        if (count($purchase) > 0)
        {
            $this->session->set_flashdata('error', 'Item Can\'t delete, It is in Purchase List.');
        }
        else
        {
            $this->MItems->delete($id);
            $this->session->set_flashdata('success', 'Item deleted successfully.');
        }

        redirect('inventory/item_list', 'refresh');
    }

}
