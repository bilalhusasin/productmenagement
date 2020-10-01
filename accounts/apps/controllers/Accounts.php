<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

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
     * Accounts landing
     *
     * @return void
     */
    public function index()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'accounts';
        $data['content'] = 'admin/accounts/home';
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /** Chart of Accounts (A/C Head) Part Start */

    /**
     * All A/C Head list
     *
     * @return void
     */
    public function chart_list()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'accounts';
        $data['content'] = 'admin/accounts/chart/list';
        $data['charts'] = $this->MAc_charts->get_coa_list();
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Add new A/C Head or edit A/C Head by id
     *
     * @param  integer  $id
     * @return void
     */
    public function chart_save($id = NULL)
    {
        if ($this->input->post())
        {
            if ($this->input->post('id'))
            {
                $this->MAc_charts->update();
                $this->session->set_flashdata('success', 'A/C Head updated successfully.');
            }
            else
            {
                $this->MAc_charts->create();
                $this->session->set_flashdata('success', 'A/C Head created successfully.');
            }
            redirect('accounts/chart-list', 'refresh');
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'accounts';
            $data['content'] = 'admin/accounts/chart/save';
            $data['chart'] = $this->MAc_charts->get_by_id($id);
            if ($id)
            {
                $data['ac_chart_tree'] = $this->MAc_charts->get_coa_tree($data['chart']['parent_id']);
            }
            else
            {
                $data['ac_chart_tree'] = $this->MAc_charts->get_coa_tree();
            }
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    /**
     * A/C Head delete by id
     *
     * @param  integer  $id
     * @return void
     */
    public function chart_delete($id)
    {
        $journal = $this->MAc_journal_details->get_by_chart_id_between_date($id, date('d/m/Y'));
        if (count($journal) > 0)
        {
            echo '<script>alert("One or More Journal is recorded with this A/C Head. Remove Them First.");</script>';
            $this->session->set_flashdata('error', 'A/C Head is unable to delete.');
            redirect('accounts/chart-list', 'refresh');
        }
        else
        {
            $this->MAc_charts->delete($id);
            $this->session->set_flashdata('success', 'A/C Head deleted successfully.');
            redirect('accounts/chart-list', 'refresh');
        }
    }

    /** Chart of Accounts (A/C Head) Part End */

    /** Journal Voucher Part Start */

    /**
     * All Journal list
     *
     * @return void
     */
    public function journal_list()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'accounts';
        $data['content'] = 'admin/accounts/journal/list';
        $data['journals'] = $this->MAc_journal_master->get_all();
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Add new journal or edit journal by id
     *
     * @param  integer  $id
     * @return void
     */
    public function journal_save($id = NULL)
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'accounts';
        $data['content'] = 'admin/accounts/journal/save';
        $data['master'] = $this->MAc_journal_master->get_by_id($id);
        if ($id)
        {
            $data['journal_no'] = $data['master']['journal_no'];
            $data['details'] = $this->MAc_journal_details->get_by_journal_no($data['master']['journal_no']);
        }
        else
        {
            $data['journal_no'] = $this->MAc_journal_master->get_journal_number();
            $data['details'] = array();
        }
        $data['charts'] = $this->MAc_charts->get_all();
        $data['ac_chart_tree'] = $this->MAc_charts->get_coa_tree();
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Journal transaction complete
     *
     * @return void
     */
    public function journal_complete()
    {
        $master = $this->MAc_journal_master->get_by_journal_no($this->input->post('journal_no'));
        if (count($master) > 0)
        {
            $this->MAc_journal_master->update($master['id']);
        }
        echo 'accounts/journal-list';
    }

    /**
     * Journal preview
     *
     * @param  integer   $id
     * @return void
     */
    public function journal_preview($id = NULL)
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'accounts';
        $data['content'] = 'admin/accounts/journal/preview';
        $data['master'] = $this->MAc_journal_master->get_by_id($id);
        $data['details'] = $this->MAc_journal_details->get_by_journal_no($data['master']['journal_no']);
        $data['privileges'] = $this->privileges;
        //$this->load->view('admin/accounts/journal/preview', $data);
        $this->load->view('admin/template', $data);
    }

    /**
     * Journal print version
     *
     * @param  integer   $id
     * @return void
     */
    public function journal_print($id = NULL)
    {
        $data['title'] = 'POS System';
        $data['master'] = $this->MAc_journal_master->get_by_id($id);
        $data['details'] = $this->MAc_journal_details->get_by_journal_no($data['master']['journal_no']);
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/accounts/journal/print', $data);
    }

    /**
     * Add debit voucher to journal
     *
     * @return void
     */
    public function debit_add()
    {
        $master = $this->MAc_journal_master->get_by_journal_no($this->input->post('journal_no'));
        if (count($master) > 0)
        {
            $this->MAc_journal_master->update($master['id']);
            $master_id = $master['id'];
        }
        else
        {
            $master_id = $this->MAc_journal_master->create();
        }
        $this->MAc_journal_details->create($this->input->post('debit_chart_id'), $this->input->post('debit_amount'));
        $debit = $this->voucher_table($this->input->post('journal_no'), 'debit');
        echo $debit;
    }

    /**
     * Add credit voucher to journal
     *
     * @return void
     */
    public function credit_add()
    {
        $master = $this->MAc_journal_master->get_by_journal_no($this->input->post('journal_no'));
        if (count($master) > 0)
        {
            $this->MAc_journal_master->update($master['id']);
            $master_id = $master['id'];
        }
        else
        {
            $master_id = $this->MAc_journal_master->create();
        }
        $this->MAc_journal_details->create($this->input->post('credit_chart_id'), NULL, $this->input->post('credit_amount'));
        $credit = $this->voucher_table($this->input->post('journal_no'), 'credit');
        echo $credit;
    }

    /**
     * Delete voucher by type
     *
     * @param  string   $type
     * @return void
     */
    public function delete_voucher($type)
    {
        $this->MAc_journal_details->delete($this->input->post('voucher_id'));
        $details = $this->voucher_table($this->input->post('journal_no'), $type);
        echo $details;
    }

    /**
     * Delete journal by id
     *
     * @param  integer  $id
     * @return void
     */
    public function delete_journal($id)
    {
        $journal = $this->MAc_journal_master->get_by_id($id);
        $this->MAc_journal_details->delete_by_journal_no($journal['journal_no']);
        $this->MAc_journal_master->delete($id);
        redirect('accounts/journal-list', 'refresh');
    }

    /**
     * Delete unsaved journal by journal no
     *
     * @return void
     */
    public function delete_unsaved_journal()
    {
        $journal_no = $this->input->post("journal_no");
        $this->MAc_journal_details->delete_by_journal_no($journal_no);
        $this->MAc_journal_master->delete_by_journal_no($journal_no);
    }

    /**
     * Generate voucher table for journal by journal number and type
     *
     * @param  integer  $journal_no
     * @param  string   $type
     * @return void
     */
    public function voucher_table($journal_no, $type)
    {
        $details = $this->MAc_journal_details->get_by_journal_no($journal_no);
        if ($type == 'debit')
        {
            $result = '<table class="table table-bordered table-striped">
            <thead>
            <tr>
            <th class="center">Debit A/C Head</th>
            <th class="center">Amount</th>
            <th class="center">Memo</th>
            <th class="center">Action</th>
            </tr>
            </thead>
            <tbody>';
            $debit_amount = 0;
            foreach ($details as $list)
            {
                if ($list['debit'])
                {
                    $result .= '<tr>
                    <td>' . $list['chart_name'] . '</td>
                    <td class="center">' . $list['debit'] . '</td>
                    <td class="center">' . $list['memo'] . '</td>
                    <td class="center">
                    <input type="hidden" value="' . $list['id'] . '"><span class="btn del btn-danger debit_voucher_delete"><i class="fa fa-remove"></i> Delete</span>
                    </td>
                    </tr>';
                    $debit_amount += $list['debit'];
                }
            }

            $result .= '</tbody>
            <tfoot>
            <tr>
            <th class="left" colspan="4">&nbsp;</th>
            </tr>
            <tr>
            <th colspan="2">Total </th>
            <th colspan="2" class="right" id="debit_total">' . number_format($debit_amount, 2) . '</th>
            </tr>
            </tfoot>
            </table>';
        }
        elseif ($type == 'credit')
        {
            $result = '<table class="table table-bordered table-striped">
            <thead>
            <tr>
            <th class="center">Debit A/C Head</th>
            <th class="center">Amount</th>
            <th class="center">Memo</th>
            <th class="center">Action</th>
            </tr>
            </thead>
            <tbody>';
            $credit_amount = 0;
            foreach ($details as $list)
            {
                if ($list['credit'])
                {
                    $result .= '<tr>
                    <td>' . $list['chart_name'] . '</td>
                    <td class="center">' . $list['credit'] . '</td>
                    <td class="center">' . $list['memo'] . '</td>
                    <td class="center">
                    <input type="hidden" value="' . $list['id'] . '"><span class="btn del btn-danger credit_voucher_delete"><i class="fa fa-remove"></i> Delete</span>
                    </td>
                    </tr>';
                    $credit_amount += $list['credit'];
                }
            }

            $result .= '</tbody>
            <tfoot>
            <tr>
            <th class="left" colspan="4">&nbsp;</th>
            </tr>
            <tr>
            <th colspan="2">Total </th>
            <th colspan="2" class="right" id="credit_total">' . number_format($credit_amount, 2) . '</th>
            </tr>
            </tfoot>
            </table>';
        }

        return $result;
    }

    /** Journal Voucher Part End */

    /** -------------- Money Receipt Start ------------------ */

    /**
     * All money receipt list
     *
     * @return void
     */
    public function mr_list()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'accounts';
        $data['content'] = 'admin/accounts/mr/list';
        $data['mrs'] = $this->MAc_money_receipts->get_all();
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Money receipt preview
     *
     * @param  integer  $id
     * @return void
     */
    public function mr_preview($id = NULL)
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'accounts';
        $data['content'] = 'admin/accounts/mr/preview';
        $data['details'] = $this->MAc_money_receipts->get_by_id($id);
        $data['customer'] = $this->MCustomers->get_by_id($data['details']['customer_id']);
        $data['emp'] = $this->MEmps->get_by_id($data['details']['emp_id']);
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Money receipt print
     *
     * @param  integer  $id
     * @return void
     */
    public function mr_print($id = NULL)
    {
        $data['title'] = 'POS System';
        $data['details'] = $this->MAc_money_receipts->get_by_id($id);
        $data['customer'] = $this->MCustomers->get_by_id($data['details']['customer_id']);
        $data['emp'] = $this->MEmps->get_by_id($data['details']['emp_id']);
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/accounts/mr/print', $data);
    }

    /**
     * Add new money receipt or edit money receipt by id
     *
     * @param  integer  $id
     * @return void
     */
    public function mr_save($id = NULL)
    {
        if ($this->input->post())
        {
            if ($this->input->post('id') == "")
            {
                $this->MAc_money_receipts->create();
                //Auto journal entry on money receipt entry
                $journal_no = $this->MAc_journal_master->get_journal_number();
                $this->MAc_journal_master->create_by_mr($journal_no, $this->input->post('mr_no'));

                $customer = $this->MCustomers->get_by_id($this->input->post('customer_id'));
                $settings = $this->MSettings->get_by_company_id($this->session->user_company);
                $this->MAc_journal_details->auto_create($journal_no, $customer['ac_id'], NULL, $this->input->post('amount'));
                //Cash debit or bank debit
                if($this->input->post('payment_type') == 'cash')
                {
                    $this->MAc_journal_details->auto_create($journal_no, $settings['ac_cash'], $this->input->post('amount'));
                }
                else
                {
                    $this->MAc_journal_details->auto_create($journal_no, $settings['ac_bank'], $this->input->post('amount'));
                }

            }
            else
            {
                $this->MAc_money_receipts->update();
                //Auto journal update on money receipt update
                $journal = $this->MAc_journal_master->get_by_doc( 'Receive', $this->input->post('mr_no') );
                if (count($journal) > 0)
                {
                    $journal_no = $journal['journal_no'];
                    $this->MAc_journal_details->delete_by_journal_no($journal_no);
                    $customer = $this->MCustomers->get_by_id($this->input->post('customer_id'));
                    $settings = $this->MSettings->get_by_company_id($this->session->user_company);
                    $this->MAc_journal_details->auto_create($journal_no, $customer['ac_id'], NULL, $this->input->post('amount'));
                    //Cash debit or bank debit
                    if($this->input->post('payment_type') == 'cash')
                    {
                        $this->MAc_journal_details->auto_create($journal_no, $settings['ac_cash'], $this->input->post('amount'));
                    }
                    else
                    {
                        $this->MAc_journal_details->auto_create($journal_no, $settings['ac_bank'], $this->input->post('amount'));
                    }
                }
            }

            $this->session->set_flashdata('success', 'Money Receipt saved successfully.');
            redirect('accounts/mr-list', 'refresh');
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'accounts';
            $data['content'] = 'admin/accounts/mr/save';
            $mr = $this->MAc_money_receipts->get_latest();
            if (count($mr) > 0)
            {
                $data['mr_no'] = (int)$mr['mr_no'] + 1;
            }
            else
            {
                $data['mr_no'] = 1001;
            }
            $data['mr'] = $this->MAc_money_receipts->get_by_id($id);
            $data['customers'] = $this->MCustomers->get_all();
            $data['emps'] = $this->MEmps->get_all();
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    /**
     * Delete money receipt by id
     *
     * @param  integer  $id
     * @return void
     */
    public function mr_delete($id)
    {
        $mr = $this->MAc_money_receipts->get_by_id($id);
        //Remove auto created journal
        $journal = $this->MAc_journal_master->get_by_doc('Receive', $mr['mr_no']);
        if (count($journal) > 0)
        {
            $this->MAc_journal_details->delete_by_journal_no($journal['journal_no']);
            $this->MAc_journal_master->delete_by_journal_no($journal['journal_no']);
        }
        //Remove money receipt
        $this->MAc_money_receipts->delete($id);
        redirect('accounts/mr-list', 'refresh');
    }

    /** -------------- Money Receipt End -------------------- */

    /** -------------- Payment Receipt Start ------------------ */

    /**
     * All payment list
     *
     * @return void
     */
    public function payment_list()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'accounts';
        $data['content'] = 'admin/accounts/payment/list';
        $data['payments'] = $this->MAc_payment_receipts->get_all();
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Payment receipt preview
     *
     * @param  integer  $id
     * @return void
     */
    public function payment_preview($id = NULL)
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'accounts';
        $data['content'] = 'admin/accounts/payment/preview';
        $data['details'] = $this->MAc_payment_receipts->get_by_id($id);
        $data['supplier'] = $this->MSuppliers->get_by_id($data['details']['supplier_id']);
        $data['emp'] = $this->MEmps->get_by_id($data['details']['emp_id']);
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /**
     * Payment receipt print
     *
     * @param  integer  $id
     * @return void
     */
    public function payment_print($id = NULL)
    {
        $data['title'] = 'POS System';
        $data['details'] = $this->MAc_payment_receipts->get_by_id($id);
        $data['supplier'] = $this->MSuppliers->get_by_id($data['details']['supplier_id']);
        $data['emp'] = $this->MEmps->get_by_id($data['details']['emp_id']);
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/accounts/payment/print', $data);
    }

    /**
     * Add new payment or edit payment by id
     *
     * @param  integer  $id
     * @return void
     */
    public function payment_save($id = NULL)
    {
        if ($this->input->post())
        {
            if ( $this->input->post('id') == "" )
            {
                $this->MAc_payment_receipts->create();
                //Auto journal entry on payment receipt entry
                $journal_no = $this->MAc_journal_master->get_journal_number();
                $this->MAc_journal_master->create_by_payment($journal_no, $this->input->post('payment_no'));

                $supplier = $this->MSuppliers->get_by_id($this->input->post('supplier_id'));
                $settings = $this->MSettings->get_by_company_id($this->session->user_company);
                $this->MAc_journal_details->auto_create($journal_no, $supplier['ac_id'], $this->input->post('amount'));
                //Cash credit or bank credit
                if ($this->input->post('payment_type') == 'cash')
                {
                    $this->MAc_journal_details->auto_create($journal_no, $settings['ac_cash'], NULL, $this->input->post('amount'));
                }
                else
                {
                    $this->MAc_journal_details->auto_create($journal_no, $settings['ac_bank'], NULL, $this->input->post('amount'));
                }

            }
            else
            {
                $this->MAc_payment_receipts->update();
                //Auto journal update on payment receipt update
                $journal = $this->MAc_journal_master->get_by_doc('Payment', $this->input->post('payment_no'));
                if (count($journal) > 0)
                {
                    $journal_no = $journal['journal_no'];
                    $this->MAc_journal_details->delete_by_journal_no($journal_no);
                    $supplier = $this->MSuppliers->get_by_id($this->input->post('supplier_id'));
                    $settings = $this->MSettings->get_by_company_id($this->session->user_company);
                    $this->MAc_journal_details->auto_create($journal_no, $supplier['ac_id'], $this->input->post('amount'));
                    $this->MAc_journal_details->auto_create($journal_no, $settings['ac_cash'], NULL, $this->input->post('amount'));
                }

            }
            $this->session->set_flashdata('message', 'Customer created');
            redirect('accounts/payment-list', 'refresh');
        }
        else
        {
            $data['title'] = 'POS System';
            $data['menu'] = 'accounts';
            $data['content'] = 'admin/accounts/payment/save';
            $payment = $this->MAc_payment_receipts->get_latest();
            if (count($payment) > 0)
            {
                $data['payment_no'] = (int) $payment['payment_no'] + 1;
            }
            else
            {
                $data['payment_no'] = 1001;
            }
            $data['payment'] = $this->MAc_payment_receipts->get_by_id($id);
            $data['suppliers'] = $this->MSuppliers->get_all();
            $data['emps'] = $this->MEmps->get_all();
            $data['privileges'] = $this->privileges;
            $this->load->view('admin/template', $data);
        }
    }

    /**
     * Payment receipt delete by id
     *
     * @param  integer  $id
     * @return void
     */
    public function payment_delete($id)
    {
        $payment = $this->MAc_payment_receipts->get_by_id($id);
        //Remove auto created journal
        $journal = $this->MAc_journal_master->get_by_doc('Payment', $payment['payment_no']);
        if (count($journal) > 0)
        {
            $this->MAc_journal_details->delete_by_journal_no($journal['journal_no']);
            $this->MAc_journal_master->delete_by_journal_no($journal['journal_no']);
        }
        //Remove payment receipt
        $this->MAc_payment_receipts->delete($id);
        redirect('accounts/payment-list', 'refresh');
    }

    /* -------------- Payment Receipt End -------------------- */

}
