<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    /**
     * Class constructor and validate authenticate user
     *
     * @return  void
     */
    public function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
        if ( ! $this->session->user_id)
        {
            redirect('', 'refresh');
        }
        $this->privileges = $this->MUser_privileges->get_by_ref_user($this->session->user_id);
    }

    /**
     * Report landing
     *
     * @return void
     */
    public function index()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'report';
        $data['content'] = 'admin/reports/home';
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Purchase report landing
     *
     * @return void
     */
    public function purchase()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'report';
        $data['content'] = 'admin/reports/inventory/purchase_master';
        $data['items'] = $this->MItems->get_all();
        $data['suppliers'] = $this->MSuppliers->get_all();
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Purchase report details
     *
     * @return void
     */
    public function purchase_report()
    {
        if ($this->input->post())
        {
            /** Individual item and individual supplier */
            if ($this->input->post('item_id') != 'all' && $this->input->post('supplier_id') != 'all')
            {
                $items = array($this->input->post('item_id'));
                $supplier_id = $this->input->post('supplier_id');
                $data['purchase'] = $this->MPurchase_master->get_all_between_date($items, $supplier_id);
            }
            /** Individual item and all supplier */
            elseif ($this->input->post('item_id') != 'all' && $this->input->post('supplier_id') == 'all')
            {
                $items = array($this->input->post('item_id'));
                $data['purchase'] = $this->MPurchase_master->get_all_between_date($items);
            }
            /** All item from individual supplier */
            elseif ($this->input->post('item_id') == 'all' && $this->input->post('supplier_id') != 'all')
            {
                $data['purchase'] = $this->MPurchase_master->get_all_between_date(NULL, $this->input->post('supplier_id'));
            }
            /** All item from all supplier */
            else
            {
                $data['purchase'] = $this->MPurchase_master->get_all_between_date();
            }
            $data['title'] = 'POS System';
            $data['start_date'] = $this->input->post('start_date');
            $data['end_date'] = $this->input->post('end_date');
            $this->load->view('admin/reports/inventory/purchase_details', $data);
            if ($this->input->post('report_type') == 'pdf')
            {
                $html = $this->load->view('admin/reports/inventory/purchase_details', $data, TRUE);
                $pdfFile = "purchase.pdf";
                $this->load->library('m_pdf');
                $pdf = $this->m_pdf->load();
                $pdf->AddPage('L', '', '', '', '', '', '', '', '', '', '');
                $pdf->use_kwt = TRUE;
                $pdf->WriteHTML($html);
                $pdf->output($pdfFile, "D");
            }
        }
        else
        {
            redirect('report/purchase', 'refresh');
        }
    }

    /**
     * Purchase return landing
     *
     * @return void
     */
    public function purchase_return()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'report';
        $data['content'] = 'admin/reports/inventory/purchase_return_master';
        $data['items'] = $this->MItems->get_all();
        $data['suppliers'] = $this->MSuppliers->get_all();
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Purchase return details
     *
     * @return void
     */
    public function purchase_return_report()
    {
        if ($this->input->post())
        {
            /** Individual item and individual supplier */
            if ($this->input->post('item_id') != 'all' && $this->input->post('supplier_id') != 'all')
            {
                $items = array($this->input->post('item_id'));
                $supplier_id = $this->input->post('supplier_id');
                $data['purchase'] = $this->MPurchase_return_master->get_all_between_date($items, $supplier_id);
            }
            /** Individual item and all supplier */
            elseif ($this->input->post('item_id') != 'all' && $this->input->post('supplier_id') == 'all')
            {
                $items = array($this->input->post('item_id'));
                $data['purchase'] = $this->MPurchase_return_master->get_all_between_date($items);
            }
            /** All item from individual supplier */
            elseif ($this->input->post('item_id') == 'all' && $this->input->post('supplier_id') != 'all')
            {
                $data['purchase'] = $this->MPurchase_return_master->get_all_between_date(NULL, $this->input->post('supplier_id'));
            }
            /** All item from all supplier */
            else
            {
                $data['purchase'] = $this->MPurchase_return_master->get_all_between_date();
            }
            $data['title'] = 'POS System';
            $data['start_date'] = $this->input->post('start_date');
            $data['end_date'] = $this->input->post('end_date');
            $this->load->view('admin/reports/inventory/purchase_return_details', $data);
            if ($this->input->post('report_type') == 'pdf')
            {
                $html = $this->load->view('admin/reports/inventory/purchase_return_details', $data, TRUE);
                $pdfFile = "purchase_return.pdf";
                $this->load->library('m_pdf');
                $pdf = $this->m_pdf->load();
                $pdf->AddPage('L', '', '', '', '', '', '', '', '', '', '');
                $pdf->use_kwt = TRUE;
                $pdf->WriteHTML($html);
                $pdf->output($pdfFile, "D");
            }
        }
        else
        {
            redirect('report/purchase-return', 'refresh');
        }
    }

    /**
     * Sales report landing
     *
     * @return void
     */
    public function sales()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'report';
        $data['content'] = 'admin/reports/inventory/sales_master';
        $data['items'] = $this->MItems->get_all();
        $data['customers'] = $this->MCustomers->get_all();
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Sales report details
     *
     * @return void
     */
    public function sales_report()
    {
        if ($this->input->post())
        {
            /** Individual item and individual customer */
            if ($this->input->post('item_id') != 'all' && $this->input->post('customer_id') != 'all')
            {
                $items = array($this->input->post('item_id'));
                $customer_id = $this->input->post('customer_id');
                $data['sales'] = $this->MSales_master->get_all_between_date($items, $customer_id);
            }
            /** Individual item and all customer */
            elseif ($this->input->post('item_id') != 'all' && $this->input->post('customer_id') == 'all')
            {
                $items = array($this->input->post('item_id'));
                $data['sales'] = $this->MSales_master->get_all_between_date($items);
            }
            /** All item and individual customer */
            elseif ($this->input->post('item_id') == 'all' && $this->input->post('customer_id') != 'all')
            {
                $data['sales'] = $this->MSales_master->get_all_between_date(NULL, $this->input->post('customer_id'));
            }
            /** All item and all customer */
            else
            {
                $data['sales'] = $this->MSales_master->get_all_between_date();
            }
            $data['title'] = 'POS System';
            $data['start_date'] = $this->input->post('start_date');
            $data['end_date'] = $this->input->post('end_date');
            $this->load->view('admin/reports/inventory/sales_details', $data);
            if ($this->input->post('report_type') == 'pdf')
            {
                $html = $this->load->view('admin/reports/inventory/sales_details', $data, TRUE);
                $pdfFile = "sales.pdf";
                $this->load->library('m_pdf');
                $pdf = $this->m_pdf->load();
                $pdf->AddPage('L', '', '', '', '', '', '', '', '', '', '');
                $pdf->use_kwt = TRUE;
                $pdf->WriteHTML($html);
                $pdf->output($pdfFile, "D");
            }
        } else {
            redirect( 'report/sales', 'refresh' );
        }

    }

    /**
     * Sales return landing
     *
     * @return void
     */
    public function sales_return()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'report';
        $data['content'] = 'admin/reports/inventory/sales_return_master';
        $data['items'] = $this->MItems->get_all();
        $data['customers'] = $this->MCustomers->get_all();
        $data['privileges'] = $this->privileges;
        $this->load->view( 'admin/template', $data );
    }

    /**
     * Sales return report details
     *
     * @return void
     */
    public function sales_return_report()
    {
        if ($this->input->post())
        {
            if ($this->input->post('item_id') != 'all' && $this->input->post('customer_id') != 'all')
            {
                $items = array($this->input->post('item_id'));
                $customer_id = $this->input->post('customer_id');
                $data['sales'] = $this->MSales_return_master->get_all_between_date($items, $customer_id);
            }
            elseif ($this->input->post('item_id') != 'all' && $this->input->post('customer_id') == 'all')
            {
                $items = array($this->input->post('item_id'));
                $data['sales'] = $this->MSales_return_master->get_all_between_date($items);
            }
            elseif ($this->input->post('item_id') == 'all' && $this->input->post('customer_id') != 'all')
            {
                $data['sales'] = $this->MSales_return_master->get_all_between_date(NULL, $this->input->post('customer_id'));
            }
            else
            {
                $data['sales'] = $this->MSales_return_master->get_all_between_date();
            }
            $data['title'] = 'POS System';
            $data['start_date'] = $this->input->post('start_date');
            $data['end_date'] = $this->input->post('end_date');
            $this->load->view('admin/reports/inventory/sales_return_details', $data);
            if ($this->input->post('report_type') == 'pdf')
            {
                $html = $this->load->view('admin/reports/inventory/sales_return_details', $data, TRUE);
                $pdfFile = "sales.pdf";
                $this->load->library('m_pdf');
                $pdf = $this->m_pdf->load();
                $pdf->AddPage('L', '', '', '', '', '', '', '', '', '', '');
                $pdf->use_kwt = TRUE;
                $pdf->WriteHTML($html);
                $pdf->output($pdfFile, "D");
            }
        }
        else
        {
            redirect('report/sales-return', 'refresh');
        }
    }

    //Sales Return Report End---------------
    //
    //Inventory Report Start----------------

    public function inventory()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'report';
        $data['content'] = 'admin/reports/inventory/inventory_master';
        $data['items'] = $this->MItems->get_all();
        $data['suppliers'] = $this->MSuppliers->get_all();
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    public function inventory_report()
    {
        if ($this->input->post())
        {
            $data['title'] = 'POS System';
            $data['start_date'] = $this->input->post('start_date');
            $data['end_date'] = $this->input->post('end_date');
            $data['company'] = $this->MCompanies->get_by_id($this->session->user_company);
            if ( $this->input->post('item_id') != 'all')
            {
                $data['items'] = array($this->MItems->get_by_id($this->input->post('item_id')));
            }
            else
            {
                $data['items'] = $this->MItems->get_all();
            }

            $data['reports'] = $this->MReports->get_inventory_summary();

            if ($this->input->post('report_type') == 'pdf')
            {
                $html = $this->load->view('admin/reports/inventory/inventory_details_pdf', $data, TRUE);
                $pdfFile = "inventory.pdf";
                $this->load->library('m_pdf');
                $pdf = $this->m_pdf->load();
                $pdf->AddPage('L', '', '', '', '', '', '', '', '', '', '');
                $pdf->use_kwt = TRUE;
                $pdf->WriteHTML($html);
                $pdf->output($pdfFile, "D");
            }
            else
            {
                $this->load->view('admin/reports/inventory/inventory_details', $data);
            }
        }
        else
        {
            redirect('report/inventory', 'refresh');
        }
    }

    //Inventory Report End---------------
    //
    //Others Report Start----------------

    public function transaction_all()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'report';
        $data['content'] = 'admin/reports/transaction_all';
        $data['transactions'] = $this->MSales_master->get_all();
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/dashboard', $data);
    }

    //Others Report End----------------

    public function get_item()
    {
        $result = '<option value="all">All</option>';
        if ($this->input->post('manufacturer_id') != "")
        {
            $data = $this->MItems->get_all($this->input->post('manufacturer_id'));
            foreach ($data as $key => $value)
            {
                $result .= '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
            }
        }

        echo $result;
    }

    //Sales Collection Dues Report Start--------------

    public function sales_collection_dues()
    {
        if ($this->input->post())
        {
            $data['start_date'] = $this->input->post('start_date');
            $data['end_date'] = $this->input->post('end_date');
            $data['reports'] = $this->MReports->get_sales_collection_dues();
            $this->load->view('admin/reports/sales_collection_dues_details', $data);
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'report';
            $data['content'] = 'admin/reports/sales_collection_dues_master';
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    //Sales Collection Dues Report End--------------
    //
    //Accounts Report Start--------------

    public function ledger()
    {
        if ($this->input->post())
        {
            $data['title'] = 'POS System';
            $data['start_date'] = $this->input->post('start_date');
            $data['end_date'] = $this->input->post('end_date');
            $data['chart_name'] = $this->MAc_charts->get_by_id($this->input->post('chart_id'));
            $charts = $this->MAc_charts->get_coa_list($this->input->post('chart_id'));
            $chart_ids[] = $this->input->post('chart_id');
            foreach ($charts as $chart)
            {
                $chart_ids[] = $chart['id'];
            }
            //print_r($chart_ids);
            $data['opening_sum'] = $this->MAc_charts->get_sum_of_chart_id($chart_ids);
            $data['previous'] = $this->MAc_journal_details->get_by_chart_id_between_date($chart_ids, $this->input->post('start_date'));
            $data['charts'] = $this->MAc_journal_details->get_by_chart_id_between_date($chart_ids, $this->input->post('start_date'), $this->input->post('end_date'));
            $this->load->view('admin/reports/accounts/ledger_details', $data);
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'report';
            $data['content'] = 'admin/reports/accounts/ledger_master';
            $data['charts'] = $this->MAc_charts->get_coa_tree();
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    public function trial_balance()
    {
        if ($this->input->post())
        {
            $data['title'] = 'POS System';
            $data['start_date'] = $this->input->post('start_date');
            $data['end_date'] = $this->input->post('end_date');
            $data['trial_balance'] = $this->MAc_journal_details->get_between_date($this->input->post('start_date'), $this->input->post('end_date'));
            $this->load->view('admin/reports/accounts/trial_balance_details', $data);
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'report';
            $data['content'] = 'admin/reports/accounts/trial_balance_master';
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    public function balance_sheet()
    {
        if ($this->input->post())
        {
            $data['title'] = 'POS System';
            $data['closing_date'] = $this->input->post('closing_date');
            $asset = $this->MAc_charts->get_by_code('10', $this->session->user_company);
            $data['assets'] = $this->MAc_journal_details->get_balance_sheet($asset['id'], $this->input->post('closing_date'));
            $liability = $this->MAc_charts->get_by_code('20', $this->session->user_company);
            $data['liabilities'] = $this->MAc_journal_details->get_balance_sheet($liability['id'], $this->input->post('closing_date'));
            $equity = $this->MAc_charts->get_by_code('30', $this->session->user_company);
            $data['equities'] = $this->MAc_journal_details->get_balance_sheet($equity['id'], $this->input->post('closing_date'));

            $this->load->view('admin/reports/accounts/balance_sheet_details', $data);
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'report';
            $data['content'] = 'admin/reports/accounts/balance_sheet_master';
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    public function test_asset()
    {
        $data['assets'] = $this->MAc_journal_details->get_balance_sheet(1, '09/30/2013');
        $data['liabilities'] = $this->MAc_journal_details->get_balance_sheet(2, '09/30/2013');
        $data['equities'] = $this->MAc_journal_details->get_balance_sheet(3, '09/30/2013');
        $this->load->view('admin/reports/accounts/balance_sheet_details_1', $data);

        //$data = $this->MAc_journal_details->get_sum_of_chart_id_closing_date(8, '09/30/2013');
        //print_r($data);
    }

    /**
     * Income statement details
     *
     * @return void
     */
    public function income_statement()
    {
        if ($this->input->post())
        {
            $data['title'] = 'POS System';
            $data['start_date'] = $this->input->post('start_date');
            $data['end_date'] = $this->input->post('end_date');

            $reveniue_chart = $this->MAc_charts->get_by_code('40', $this->session->user_company);
            $reveniue_chart_ids[] = $reveniue_chart['id'];
            $reveniue_charts = $this->MAc_charts->get_coa_list($reveniue_chart['id']);
            foreach ($reveniue_charts as $reveniue_chart)
            {
                $reveniue_chart_ids[] = $reveniue_chart['id'];
            }
            $data['reveniues'] = $this->MAc_journal_details->get_sum_of_chart_id_between_date($reveniue_chart_ids, $this->input->post('start_date'), $this->input->post('end_date'));

            $expense_chart = $this->MAc_charts->get_by_code('50', $this->session->user_company);
            $expense_chart_ids[] = $expense_chart['id'];
            $expense_charts = $this->MAc_charts->get_coa_list($expense_chart['id']);
            $cogs_chart = $this->MAc_charts->get_by_code('60', $this->session->user_company);
            $expense_chart_ids[] = $cogs_chart['id'];
            foreach ($expense_charts as $expense_chart)
            {
                $expense_chart_ids[] = $expense_chart['id'];
            }
            $data['expenses'] = $this->MAc_journal_details->get_sum_of_chart_id_between_date($expense_chart_ids, $this->input->post('start_date'), $this->input->post('end_date'));

            $this->load->view('admin/reports/accounts/income_statement_details', $data);
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'report';
            $data['content'] = 'admin/reports/accounts/income_statement_master';
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    /**
     * Bills receivable details
     *
     * @return void
     */
    public function bills_receivable()
    {
        if ($this->input->post())
        {
            $data['title'] = 'POS System';
            $data['start_date'] = $this->input->post('start_date');
            $data['end_date'] = $this->input->post('end_date');
            $settings = $this->MSettings->get_by_company_id($this->session->user_company);
            //var_dump($settings);
            $charts = $this->MAc_charts->get_coa_list($settings['ac_receivable']);
            $chart_ids[] = $settings['ac_receivable'];
            foreach ($charts as $chart)
            {
                $chart_ids[] = $chart['id'];
            }
            $data['opening_sum'] = $this->MAc_charts->get_sum_of_chart_id($chart_ids);
            $data['previous'] = $this->MAc_journal_details->get_by_chart_id_between_date($chart_ids, $this->input->post('start_date'));
            $data['charts'] = $this->MAc_journal_details->get_by_chart_id_between_date($chart_ids, $this->input->post('start_date'), $this->input->post('end_date'));
            $this->load->view('admin/reports/accounts/bills_receivable_details', $data);
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'report';
            $data['content'] = 'admin/reports/accounts/bills_receivable_master';
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    /**
     * Bills payable details
     *
     * @return void
     */
    public function bills_payable()
    {
        if ($this->input->post())
        {
            $data['title'] = 'POS System';
            $data['start_date'] = $this->input->post('start_date');
            $data['end_date'] = $this->input->post('end_date');
            $settings = $this->MSettings->get_by_company_id($this->session->user_company);
            //var_dump($settings);
            $charts = $this->MAc_charts->get_coa_list($settings['ac_payable']);
            $chart_ids[] = $settings['ac_payable'];
            foreach ($charts as $chart)
            {
                $chart_ids[] = $chart['id'];
            }
            $data['opening_sum'] = $this->MAc_charts->get_sum_of_chart_id($chart_ids);
            $data['previous'] = $this->MAc_journal_details->get_by_chart_id_between_date($chart_ids, $this->input->post('start_date'));
            $data['charts'] = $this->MAc_journal_details->get_by_chart_id_between_date($chart_ids, $this->input->post('start_date'), $this->input->post('end_date'));
            $this->load->view('admin/reports/accounts/bills_payable_details', $data);
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'report';
            $data['content'] = 'admin/reports/accounts/bills_payable_master';
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    /**
     * Cash book details
     *
     * @return void
     */
    public function cash_book()
    {
        if ($this->input->post())
        {
            $data['title'] = 'POS System';
            $data['start_date'] = $this->input->post('start_date');
            $data['end_date'] = $this->input->post('end_date');
            $settings = $this->MSettings->get_by_company_id($this->session->user_company);
            //var_dump($settings);
            $charts = $this->MAc_charts->get_coa_list($settings['ac_cash']);
            $chart_ids[] = $settings['ac_cash'];
            foreach ($charts as $chart)
            {
                $chart_ids[] = $chart['id'];
            }
            $data['opening_sum'] = $this->MAc_charts->get_sum_of_chart_id($chart_ids);
            $data['previous'] = $this->MAc_journal_details->get_by_chart_id_between_date($chart_ids, $this->input->post('start_date'));
            $data['charts'] = $this->MAc_journal_details->get_by_chart_id_between_date($chart_ids, $this->input->post('start_date'), $this->input->post('end_date'));
            $this->load->view('admin/reports/accounts/cash_book_details', $data);
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'report';
            $data['content'] = 'admin/reports/accounts/cash_book_master';
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    /**
     * Bank book details
     *
     * @return void
     */
    public function bank_book()
    {
        if ($this->input->post())
        {
            $data['title'] = 'POS System';
            $data['start_date'] = $this->input->post('start_date');
            $data['end_date'] = $this->input->post('end_date');
            $settings = $this->MSettings->get_by_company_id($this->session->user_company);
            $charts = $this->MAc_charts->get_coa_list($settings['ac_bank']);
            $chart_ids[] = $settings['ac_bank'];
            foreach ($charts as $chart)
            {
                $chart_ids[] = $chart['id'];
            }
            $data['opening_sum'] = $this->MAc_charts->get_sum_of_chart_id($chart_ids);
            $data['previous'] = $this->MAc_journal_details->get_by_chart_id_between_date($chart_ids, $this->input->post('start_date'));
            $data['charts'] = $this->MAc_journal_details->get_by_chart_id_between_date($chart_ids, $this->input->post('start_date'), $this->input->post('end_date'));
            $this->load->view('admin/reports/accounts/bank_book_details', $data);
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'report';
            $data['content'] = 'admin/reports/accounts/bank_book_master';
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

}