<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MAc_journal_details extends CI_Model {

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
     * Get journal details by id
     *
     * @param  integer  $id
     * @return array    $data
     */
    public function get_by_id($id)
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $this->db->where('id', $id);
        $q = $this->db->get('ac_journal_details');
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

    public function get_by_journal_no($journal_no)
    {
        $data = array();
        $this->db->select('details.*, ac_charts.name as chart_name');
        $this->db->from('ac_journal_details as details');
        $this->db->join('ac_charts', 'details.chart_id = ac_charts.id', 'left');
        $this->db->where('details.company_id', $this->session->user_company);
        $this->db->where('details.journal_no', $journal_no);
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

    public function get_by_chart_id_between_date($chart_ids = NULL, $from = NULL, $to = NULL)
    {
        $data = array();
        $this->db->select('details.*, master.id as journal_id, master.journal_date as journal_date, master.memo as master_memo, charts.name as chart_name, users.name as user_name');
        $this->db->from('ac_journal_details as details');
        $this->db->join('ac_journal_master as master', 'details.journal_no = master.journal_no');
        $this->db->join('ac_charts as charts', 'details.chart_id = charts.id', 'left');
        $this->db->join('users', 'details.created_by = users.id', 'left');
        if ($to)
        {
            $this->db->where('master.journal_date >= ', date_to_db($from));
            $this->db->where('master.journal_date <= ', date_to_db($to));
        }
        else
        {
            $this->db->where('master.journal_date < ', date_to_db($from));
        }
        $this->db->where('details.company_id', $this->session->user_company);
        $this->db->where_in('details.chart_id', $chart_ids);
        $this->db->order_by('master.journal_no', 'ASC');
        $q = $this->db->get();
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $row['ref_journal'] = '';
                $journals = $this->MAc_journal_details->get_by_journal_no($row['journal_no']);
                if ($row['debit'])
                {
                    foreach ($journals as $journal)
                    {
                        if ($journal['credit'])
                        {
                            $row['ref_journal'] .= $journal['chart_name'] . ', ';
                        }
                    }
                }
                else
                {
                    foreach ($journals as $journal)
                    {
                        if ($journal['debit'])
                        {
                            $row['ref_journal'] .= $journal['chart_name'] . ', ';
                        }
                    }
                }
                $data[] = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    public function get_sum_of_chart_id_between_date($chart_ids = NULL, $from = NULL, $to = NULL)
    {
        $data = array();
        $this->db->select('SUM(details.debit) as debit, SUM(details.credit) as credit, charts.name as chart_name, users.name as user_name');
        $this->db->from('ac_journal_details as details');
        $this->db->join('ac_journal_master as master', 'details.journal_no = master.journal_no', 'left');
        $this->db->join('ac_charts as charts', 'details.chart_id = charts.id', 'left');
        $this->db->join('users', 'details.created_by = users.id', 'left');

        if ($to)
        {
            $this->db->where('master.journal_date >= ', date_to_db($from));
            $this->db->where('master.journal_date <= ', date_to_db($to));
        }
        else
        {
            $this->db->where('master.journal_date < ', date_to_db($from));
        }
        $this->db->where('details.company_id', $this->session->user_company);
        $this->db->where_in('details.chart_id', $chart_ids);
        $this->db->group_by('details.chart_id');
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

    public function get_sum_of_chart_id_closing_date($chart_id = NULL, $closing = NULL) {
        $data = array();
        $this->db->select('SUM(details.debit) as debit, SUM(details.credit) as credit, charts.name as chart_name');
        $this->db->from('ac_journal_details as details');
        $this->db->join('ac_journal_master as master', 'details.journal_no = master.journal_no', 'left');
        $this->db->join('ac_charts as charts', 'details.chart_id = charts.id', 'left');
        $this->db->where('details.company_id', $this->session->user_company);
        $this->db->where('master.journal_date <= ', date_to_db($closing));
        $this->db->where('details.chart_id', $chart_id);
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

    // 5 tier accounts
    public function get_balance_sheet($parent_id = 0, $closing = NULL)
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $this->db->where('parent_id', $parent_id);
        $q1 = $this->db->get('ac_charts');
        if ($q1->num_rows() > 0)
        {
            foreach ($q1->result_array() as $row1)
            {
                $balance1 = $this->MAc_journal_details->get_sum_of_chart_id_closing_date($row1['id'], $closing);
                if (count($balance1) > 0)
                {
                    $a1['id'] = $row1['id'];
                    $a1['code'] = $row1['code'];
                    $a1['name'] = $row1['name'];
                    if ($row1['opening'] >= 0)
                    {
                        $a1['debit'] = $row1['opening'] + $balance1['debit'];
                        $a1['credit'] = $balance1['credit'];
                    }
                    else
                    {
                        $a1['debit'] = $balance1['debit'];
                        $a1['credit'] = $row1['opening'] + $balance1['credit'];
                    }
                    $a1['balance'] = $row1['opening'] + $balance1['debit'] - $balance1['credit'];
                }
                $this->db->where('company_id', $this->session->user_company);
                $this->db->where('parent_id', $row1['id']);
                $q2 = $this->db->get('ac_charts');
                if ($q2->num_rows() > 0)
                {
                    unset($a1['child']);
                    foreach ($q2->result_array() as $row2)
                    {
                        $balance2 = $this->MAc_journal_details->get_sum_of_chart_id_closing_date($row2['id'], $closing);
                        if (count($balance2) > 0)
                        {
                            $a2['id'] = $row2['id'];
                            $a2['code'] = $row2['code'];
                            $a2['name'] = $row2['name'];
                            if ($row2['opening'] >= 0)
                            {
                                $a2['debit'] = $row2['opening'] + $balance2['debit'];
                                $a2['credit'] = $balance2['credit'];
                            }
                            else
                            {
                                $a2['debit'] = $balance2['debit'];
                                $a2['credit'] = $row2['opening'] + $balance2['credit'];
                            }
                            $a2['balance'] = $row2['opening'] + $balance2['debit'] - $balance2['credit'];
                        }
                        $this->db->where('company_id', $this->session->user_company);
                        $this->db->where('parent_id', $row2['id']);
                        $q3 = $this->db->get('ac_charts');
                        if ($q3->num_rows() > 0)
                        {
                            unset($a2['child']);
                            foreach ($q3->result_array() as $row3)
                            {
                                $balance3 = $this->MAc_journal_details->get_sum_of_chart_id_closing_date($row3['id'], $closing);
                                if (count($balance3) > 0)
                                {
                                    $a3['id'] = $row3['id'];
                                    $a3['code'] = $row3['code'];
                                    $a3['name'] = $row3['name'];
                                    if ($row3['opening'] >= 0)
                                    {
                                        $a3['debit'] = $row3['opening'] + $balance3['debit'];
                                        $a3['credit'] = $balance3['credit'];
                                    }
                                    else
                                    {
                                        $a3['debit'] = $balance3['debit'];
                                        $a3['credit'] = $row3['opening'] + $balance3['credit'];
                                    }
                                    $a3['balance'] = $row3['opening'] + $balance3['debit'] - $balance3['credit'];
                                }
                                $this->db->where('company_id', $this->session->user_company);
                                $this->db->where('parent_id', $row3['id']);
                                $q4 = $this->db->get('ac_charts');
                                if ($q4->num_rows() > 0)
                                {
                                    unset($a3['child']);
                                    foreach ($q4->result_array() as $row4)
                                    {
                                        $balance4 = $this->MAc_journal_details->get_sum_of_chart_id_closing_date($row4['id'], $closing);
                                        if (count($balance4) > 0)
                                        {
                                            $a4['id'] = $row4['id'];
                                            $a4['code'] = $row4['code'];
                                            $a4['name'] = $row4['name'];
                                            if ($row4['opening'] >= 0)
                                            {
                                                $a4['debit'] = $row4['opening'] + $balance4['debit'];
                                                $a4['credit'] = $balance4['credit'];
                                            }
                                            else
                                            {
                                                $a4['debit'] = $balance4['debit'];
                                                $a4['credit'] = $row4['opening'] + $balance4['credit'];
                                            }
                                            $a4['balance'] = $row4['opening'] + $balance4['debit'] - $balance4['credit'];
                                        }
                                        $this->db->where('company_id', $this->session->user_company);
                                        $this->db->where('parent_id', $row4['id']);
                                        $q5 = $this->db->get('ac_charts');
                                        if ($q5->num_rows() > 0)
                                        {
                                            unset($a4['child']);
                                            foreach ($q5->result_array() as $row5)
                                            {
                                                $balance5 = $this->MAc_journal_details->get_sum_of_chart_id_closing_date($row5['id'], $closing);
                                                if (count($balance5) > 0)
                                                {
                                                    $a5['id'] = $row5['id'];
                                                    $a5['code'] = $row5['code'];
                                                    $a5['name'] = $row5['name'];
                                                    if ($row5['opening'] >= 0)
                                                    {
                                                        $a5['debit'] = $row5['opening'] + $balance5['debit'];
                                                        $a5['credit'] = $balance5['credit'];
                                                    }
                                                    else
                                                    {
                                                        $a5['debit'] = $balance5['debit'];
                                                        $a5['credit'] = $row5['opening'] + $balance5['credit'];
                                                    }
                                                    $a5['balance'] = $row5['opening'] + $balance5['debit'] - $balance5['credit'];
                                                }
                                                $this->db->where('company_id', $this->session->user_company);
                                                $this->db->where('parent_id', $row5['id']);
                                                $q6 = $this->db->get('ac_charts');
                                                if ($q6->num_rows() > 0)
                                                {
                                                    unset($a5['child']);
                                                    foreach ($q6->result_array() as $row6)
                                                    {
                                                        $balance6 = $this->MAc_journal_details->get_sum_of_chart_id_closing_date($row6['id'], $closing);
                                                        if (count($balance6) > 0)
                                                        {
                                                            $a6['id'] = $row6['id'];
                                                            $a6['code'] = $row6['code'];
                                                            $a6['name'] = $row6['name'];
                                                            if ($row6['opening'] >= 0)
                                                            {
                                                                $a6['debit'] = $row6['opening'] + $balance6['debit'];
                                                                $a6['credit'] = $balance6['credit'];
                                                            }
                                                            else
                                                            {
                                                                $a6['debit'] = $balance6['debit'];
                                                                $a6['credit'] = $row6['opening'] + $balance6['credit'];
                                                            }
                                                            $a6['balance'] = $row6['opening'] + $balance6['debit'] - $balance6['credit'];
                                                        }
                                                        $a5['child'][] = $a6;
                                                        unset($a6);
                                                    }
                                                }
                                                $a4['child'][] = $a5;
                                                unset($a5);
                                            }
                                        }
                                        $a3['child'][] = $a4;
                                        unset($a4);
                                    }
                                }
                                $a2['child'][] = $a3;
                                unset($a3);
                            }
                        }
                        $a1['child'][] = $a2;
                        unset($a2);
                    }
                }
                $data[] = $a1;
                unset($a1);
            }
        }

        return $data;
    }

    public function get_between_date($from = NULL, $to = NULL)
    {
        $data = array();
        $this->db->select('SUM(details.debit) as total_debit, SUM(details.credit) as total_credit, charts.name as chart_name, users.name as user_name');
        $this->db->from('ac_journal_details as details');
        $this->db->join('ac_journal_master as master', 'details.journal_no = master.journal_no', 'left');
        $this->db->join('ac_charts as charts', 'details.chart_id = charts.id', 'left');
        $this->db->join('users', 'details.created_by = users.id', 'left');
        $this->db->where('details.company_id', $this->session->user_company);
        $this->db->where('master.journal_date >= ', date_to_db($from));
        $this->db->where('master.journal_date <= ', date_to_db($to));
        $this->db->group_by('details.chart_id');
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

    public function get_all()
    {
        $data = array();
        $q = $this->db->get('ac_journal_details');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $cr_chart = $this->MAc_charts->get_by_id($row['cr_chart_id']);
                $dr_chart = $this->MAc_charts->get_by_id($row['dr_chart_id']);
                $row['cr_chart_name'] = $cr_chart['name'];
                $row['dr_chart_name'] = $dr_chart['name'];
                $data[] = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    public function get_journal($chart, $journal_no)
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $edate = 'journal_date BETWEEN "' . $sdate . '" AND "' . $edate . '"';
        $this->db->where($edate, NULL, FALSE);
        $q = $this->db->get('ac_journal_details');
        if ($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $chart_acc = $this->MAc_charts->get_by_id($row['ac_chart_id']);
                $row['name_acc'] = $chart_acc['name'];
                $data[] = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    public function auto_create($journal_no, $chart_id, $debit = NULL, $credit = NULL)
    {
        $data = array(
            'company_id' => $this->session->user_company,
            'journal_no' => $journal_no,
            'chart_id' => $chart_id,
            'debit' => $debit,
            'credit' => $credit,
            'created' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->user_id
            );
        $this->db->insert('ac_journal_details', $data);
    }

    public function create_by_inventory($journal_no, $chart_id, $debit = NULL, $credit = NULL)
    {
        $data = array(
            'company_id' => $this->session->user_company,
            'journal_no' => $journal_no,
            'chart_id' => $chart_id,
            'debit' => $debit,
            'credit' => $credit,
            'created' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->user_id
            );
        $this->db->insert('ac_journal_details', $data);
    }

    public function create($chart_id, $debit = NULL, $credit = NULL)
    {
        $data = array(
            'company_id' => $this->session->user_company,
            'journal_no' => $this->input->post('journal_no'),
            'chart_id' => $chart_id,
            'debit' => $debit,
            'credit' => $credit,
            'created' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->user_id
            );
        $this->db->insert('ac_journal_details', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('ac_journal_details');
    }

    public function delete_by_journal_no($journal_no)
    {
        $this->db->where('journal_no', $journal_no);
        $this->db->delete('ac_journal_details');
    }

    public function delete_by_cmp($cmp_id)
    {
        $this->db->where('company_id', $cmp_id);
        $this->db->delete('ac_journal_details');
    }

}