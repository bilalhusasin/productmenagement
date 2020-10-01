<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MAc_charts extends CI_Model {

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
     * Get A/C charts by id
     *
     * @param  integer  $id
     * @return array    $data
     */
    public function get_by_id($id)
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $this->db->where('id', $id);
        $q = $this->db->get('ac_charts');
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
     * Get A/C charts by code
     *
     * @param  string   $code
     * @param  integer  $company_id
     * @return array    $data
     */
    public function get_by_code($code, $company_id)
    {
        $data = array();
        $this->db->where('company_id', $company_id);
        $this->db->where('code', $code);
        $q = $this->db->get('ac_charts');
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
     * Get A/C charts by parent id
     *
     * @param  integer  $parent_id
     * @return array    $data
     */
    public function get_by_parent_id($parent_id)
    {
        $data = array();
        $this->db->where('parent_id', $parent_id);
        $this->db->order_by('code', 'DESC');
        $this->db->limit(1);
        $q = $this->db->get('ac_charts');
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
     * Get all A/C charts
     *
     * @return array    $data
     */
    public function get_all()
    {
        $data = array();
        $this->db->where('company_id', $this->session->user_company);
        $this->db->order_by('parent_id', 'asc')->group_by('parent_id,id');
        $q = $this->db->get('ac_charts');
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
     * Get sum of A/C charts by id(s)
     *
     * @param  array    $ids
     * @return array    $data
     */
    public function get_sum_of_chart_id($ids = NULL)
    {
        $data = array();
        $this->db->select('SUM(opening) as opening');
        $this->db->where('company_id', $this->session->user_company);
        $this->db->from('ac_charts');
        $this->db->where_in('id', $ids);
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
     * Get A/C charts by parent id
     *
     * @param  integer  $parent_id
     * @return array    $data
     */
    public function get_with_child($parent_id)
    {
        $data = $this->MAc_charts->get_by_id($parent_id);
        $this->db->order_by('parent_id', 'asc');
        $this->db->where('company_id', $this->session->user_company);
        $this->db->where('parent_id', $parent_id);
        $q = $this->db->get('ac_charts');
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

    // 10 tier COA Tree
    public function get_coa_tree($chart_id = NULL, $parent_id = 0)
    {
        $options = "";
        $this->db->where('company_id', $this->session->user_company);
        $this->db->where('parent_id', $parent_id);
        $q1 = $this->db->get('ac_charts');
        if ($q1->num_rows() > 0)
        {
            foreach ($q1->result_array() as $row1)
            {
                if ($chart_id AND $row1['id'] == $chart_id)
                {
                    $options .= "<option value=" . $row1['id'] . " selected><b>" . $row1['name'] . " (" . $row1['code'] . ")</b></option>\n";
                }
                else
                {
                    $options .= "<option value=" . $row1['id'] . "><b>" . $row1['name'] . " (" . $row1['code'] . ")</b></option>\n";
                }
                $this->db->where('company_id', $this->session->user_company);
                $this->db->where('parent_id', $row1['id']);
                $q2 = $this->db->get('ac_charts');
                if ($q2->num_rows() > 0)
                {
                    foreach ($q2->result_array() as $row2)
                    {
                        if ($chart_id AND $row2['id'] == $chart_id)
                        {
                            $options .= "<option value=" . $row2['id'] . " selected><b>&nbsp;&nbsp;--&nbsp;" . $row2['name'] . " (" . $row2['code'] . ")</b></option>\n";
                        }
                        else
                        {
                            $options .= "<option value=" . $row2['id'] . "><b>&nbsp;&nbsp;--&nbsp;" . $row2['name'] . " (" . $row2['code'] . ")</b></option>\n";
                        }
                        $this->db->where('company_id', $this->session->user_company);
                        $this->db->where('parent_id', $row2['id']);
                        $q3 = $this->db->get('ac_charts');
                        if ($q3->num_rows() > 0)
                        {
                            foreach ($q3->result_array() as $row3)
                            {
                                if ($chart_id AND $row3['id'] == $chart_id)
                                {
                                    $options .= "<option value=" . $row3['id'] . " selected><b>&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;" . $row3['name'] . " (" . $row3['code'] . ")</b></option>\n";
                                }
                                else
                                {
                                    $options .= "<option value=" . $row3['id'] . "><b>&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;" . $row3['name'] . " (" . $row3['code'] . ")</b></option>\n";
                                }
                                $this->db->where('company_id', $this->session->user_company);
                                $this->db->where('parent_id', $row3['id']);
                                $q4 = $this->db->get('ac_charts');
                                if ($q4->num_rows() > 0)
                                {
                                    foreach ($q4->result_array() as $row4)
                                    {
                                        if ($chart_id AND $row4['id'] == $chart_id)
                                        {
                                            $options .= "<option value=" . $row4['id'] . " selected><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;" . $row4['name'] . " (" . $row4['code'] . ")</b></option>\n";
                                        }
                                        else
                                        {
                                            $options .= "<option value=" . $row4['id'] . "><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;" . $row4['name'] . " (" . $row4['code'] . ")</b></option>\n";
                                        }
                                        $this->db->where('company_id', $this->session->user_company);
                                        $this->db->where('parent_id', $row4['id']);
                                        $q5 = $this->db->get('ac_charts');
                                        if ($q5->num_rows() > 0)
                                        {
                                            foreach ($q5->result_array() as $row5)
                                            {
                                                if ($chart_id AND $row5['id'] == $chart_id)
                                                {
                                                    $options .= "<option value=" . $row5['id'] . " selected><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;" . $row5['name'] . " (" . $row5['code'] . ")</b></option>\n";
                                                }
                                                else
                                                {
                                                    $options .= "<option value=" . $row5['id'] . "><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;" . $row5['name'] . " (" . $row5['code'] . ")</b></option>\n";
                                                }
                                                $this->db->where('company_id', $this->session->user_company);
                                                $this->db->where('parent_id', $row5['id']);
                                                $q6 = $this->db->get('ac_charts');
                                                if ($q6->num_rows() > 0)
                                                {
                                                    foreach ($q6->result_array() as $row6)
                                                    {
                                                        if ($chart_id AND $row6['id'] == $chart_id)
                                                        {
                                                            $options .= "<option value=" . $row6['id'] . " selected><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;" . $row6['name'] . " (" . $row6['code'] . ")</b></option>\n";
                                                        }
                                                        else
                                                        {
                                                            $options .= "<option value=" . $row6['id'] . "><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;" . $row6['name'] . " (" . $row6['code'] . ")</b></option>\n";
                                                        }
                                                        $this->db->where('company_id', $this->session->user_company);
                                                        $this->db->where('parent_id', $row6['id']);
                                                        $q7 = $this->db->get('ac_charts');
                                                        if ($q7->num_rows() > 0)
                                                        {
                                                            foreach ($q7->result_array() as $row7)
                                                            {
                                                                if ($chart_id AND $row7['id'] == $chart_id)
                                                                {
                                                                    $options .= "<option value=" . $row7['id'] . " selected><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;" . $row7['name'] . " (" . $row7['code'] . ")</b></option>\n";
                                                                }
                                                                else
                                                                {
                                                                    $options .= "<option value=" . $row7['id'] . "><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;" . $row7['name'] . " (" . $row7['code'] . ")</b></option>\n";
                                                                }
                                                                $this->db->where('company_id', $this->session->user_company);
                                                                $this->db->where('parent_id', $row7['id']);
                                                                $q8 = $this->db->get('ac_charts');
                                                                if ($q8->num_rows() > 0)
                                                                {
                                                                    foreach ($q8->result_array() as $row8)
                                                                    {
                                                                        if ($chart_id AND $row8['id'] == $chart_id)
                                                                        {
                                                                            $options .= "<option value=" . $row8['id'] . " selected><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;" . $row8['name'] . " (" . $row8['code'] . ")</b></option>\n";
                                                                        }
                                                                        else
                                                                        {
                                                                            $options .= "<option value=" . $row8['id'] . "><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;" . $row8['name'] . " (" . $row8['code'] . ")</b></option>\n";
                                                                        }
                                                                        $this->db->where('company_id', $this->session->user_company);
                                                                        $this->db->where('parent_id', $row8['id']);
                                                                        $q9 = $this->db->get('ac_charts');
                                                                        if ($q9->num_rows() > 0)
                                                                        {
                                                                            foreach ($q9->result_array() as $row9)
                                                                            {
                                                                                if ($chart_id AND $row9['id'] == $chart_id)
                                                                                {
                                                                                    $options .= "<option value=" . $row9['id'] . " selected><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;" . $row9['name'] . " (" . $row9['code'] . ")</b></option>\n";
                                                                                }
                                                                                else
                                                                                {
                                                                                    $options .= "<option value=" . $row9['id'] . "><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;" . $row9['name'] . " (" . $row9['code'] . ")</b></option>\n";
                                                                                }
                                                                                $this->db->where('company_id', $this->session->user_company);
                                                                                $this->db->where('parent_id', $row9['id']);
                                                                                $q10 = $this->db->get('ac_charts');
                                                                                if ($q10->num_rows() > 0)
                                                                                {
                                                                                    foreach ($q10->result_array() as $row10)
                                                                                    {
                                                                                        if ($chart_id AND $row10['id'] == $chart_id)
                                                                                        {
                                                                                            $options .= "<option value=" . $row10['id'] . " selected><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;" . $row10['name'] . " (" . $row10['code'] . ")</b></option>\n";
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            $options .= "<option value=" . $row10['id'] . "><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;" . $row10['name'] . " (" . $row10['code'] . ")</b></option>\n";
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $options;
    }

    // 10 tier COA List
    public function get_coa_list($parent_id = 0)
    {
        $options = array();
        $this->db->where('company_id', $this->session->user_company);
        $this->db->where('parent_id', $parent_id);
        $q1 = $this->db->get('ac_charts');
        if ($q1->num_rows() > 0)
        {
            foreach ($q1->result_array() as $row1)
            {
                $options[] = $row1;
                $this->db->where('company_id', $this->session->user_company);
                $this->db->where('parent_id', $row1['id']);
                $q2 = $this->db->get('ac_charts');
                if ($q2->num_rows() > 0)
                {
                    foreach ($q2->result_array() as $row2)
                    {
                        $options[] = $row2;
                        $this->db->where('company_id', $this->session->user_company);
                        $this->db->where('parent_id', $row2['id']);
                        $q3 = $this->db->get('ac_charts');
                        if ($q3->num_rows() > 0)
                        {
                            foreach ($q3->result_array() as $row3)
                            {
                                $options[] = $row3;
                                $this->db->where('company_id', $this->session->user_company);
                                $this->db->where('parent_id', $row3['id']);
                                $q4 = $this->db->get('ac_charts');
                                if ($q4->num_rows() > 0)
                                {
                                    foreach ($q4->result_array() as $row4)
                                    {
                                        $options[] = $row4;
                                        $this->db->where('company_id', $this->session->user_company);
                                        $this->db->where('parent_id', $row4['id']);
                                        $q5 = $this->db->get('ac_charts');
                                        if ($q5->num_rows() > 0)
                                        {
                                            foreach ($q5->result_array() as $row5)
                                            {
                                                $options[] = $row5;
                                                $this->db->where('company_id', $this->session->user_company);
                                                $this->db->where('parent_id', $row5['id']);
                                                $q6 = $this->db->get('ac_charts');
                                                if ($q6->num_rows() > 0)
                                                {
                                                    foreach ($q6->result_array() as $row6)
                                                    {
                                                        $options[] = $row6;
                                                        $this->db->where('company_id', $this->session->user_company);
                                                        $this->db->where('parent_id', $row6['id']);
                                                        $q7 = $this->db->get('ac_charts');
                                                        if ($q7->num_rows() > 0)
                                                        {
                                                            foreach ($q7->result_array() as $row7)
                                                            {
                                                                $options[] = $row7;
                                                                $this->db->where('company_id', $this->session->user_company);
                                                                $this->db->where('parent_id', $row7['id']);
                                                                $q8 = $this->db->get('ac_charts');
                                                                if ($q8->num_rows() > 0)
                                                                {
                                                                    foreach ($q8->result_array() as $row8)
                                                                    {
                                                                        $options[] = $row8;
                                                                        $this->db->where('company_id', $this->session->user_company);
                                                                        $this->db->where('parent_id', $row8['id']);
                                                                        $q9 = $this->db->get('ac_charts');
                                                                        if ($q9->num_rows() > 0)
                                                                        {
                                                                            foreach ($q9->result_array() as $row9)
                                                                            {
                                                                                $options[] = $row9;
                                                                                $this->db->where('company_id', $this->session->user_company);
                                                                                $this->db->where('parent_id', $row9['id']);
                                                                                $q10 = $this->db->get('ac_charts');
                                                                                if ($q10->num_rows() > 0)
                                                                                {
                                                                                    foreach ($q10->result_array() as $row10)
                                                                                    {
                                                                                        $options[] = $row10;
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $options;
    }

    /**
     * Basic setup for new company
     *
     * @param  integer  $company_id
     * @param  integer  $user_id
     * @return void
     */
    public function basic_setup($company_id, $user_id)
    {
        $charts = $this->MAc_default_charts->get_all();
        foreach ($charts as $chart)
        {
            if ($chart['parent_id'] != 0)
            {
                $parent = $this->MAc_default_charts->get_by_id($chart['parent_id']);
                //print_r($parent);
                $parent_coa = $this->MAc_charts->get_by_code($parent['code'], $company_id);
                //print_r($parent_coa);
                $parent_id = $parent_coa['id'];
            }
            else
            {
                $parent_id = 0;
            }
            $data = array(
                'company_id' => $company_id,
                'parent_id' => $parent_id,
                'code' => $chart['code'],
                'name' => $chart['name'],
                'memo' => $chart['memo'],
                'created_at' => date('Y-m-d H:i:s', time()),
                'created_by' => $user_id
            );

            $this->db->insert('ac_charts', $data);
            $switch = $chart['type'];
            switch ($switch) {
                case "Receivable":
                $ac['receivable'] = $this->db->insert_id();
                break;
                case "Payable":
                $ac['payable'] = $this->db->insert_id();
                break;
                case "Cash":
                $ac['cash'] = $this->db->insert_id();
                break;
                case "Bank":
                $ac['bank'] = $this->db->insert_id();
                break;
                case "Sales":
                $ac['sales'] = $this->db->insert_id();
                break;
                case "Purchase":
                $ac['purchase'] = $this->db->insert_id();
                break;
                case "Inventory":
                $ac['inventory'] = $this->db->insert_id();
                break;
                case "COGS":
                $ac['cogs'] = $this->db->insert_id();
                break;
                case "TAX":
                $ac['tax'] = $this->db->insert_id();
                break;
            }
        }
        $this->MSettings->create($company_id, $ac['receivable'], $ac['payable'], $ac['cash'], $ac['bank'], $ac['sales'], $ac['purchase'], $ac['inventory'], $ac['cogs'], $ac['tax']);
    }

    public function account_create($parent_id, $code, $name)
    {
        $data = array(
            'company_id' => $this->session->user_company,
            'parent_id' => $parent_id,
            'code' => $code,
            'name' => $name,
            'created_at' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->user_id
        );
        $this->db->insert('ac_charts', $data);
        return $this->db->insert_id();
    }

    /**
     * Add new A/C chart
     *
     * @return void
     */
    public function create()
    {
        $data = array(
            'company_id' => $this->session->user_company,
            'parent_id' => $this->input->post('parent_id'),
            'code' => $this->input->post('code'),
            'name' => $this->input->post('name'),
            'memo' => $this->input->post('memo'),
            'opening' => $this->input->post('opening'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->user_id
        );
        $this->db->insert('ac_charts', $data);
    }

    /**
     * Update A/C chart
     *
     * @return void
     */
    public function update()
    {
        $data = array(
            'parent_id' => $this->input->post('parent_id'),
            'code' => $this->input->post('code'),
            'name' => $this->input->post('name'),
            'memo' => $this->input->post('memo'),
            'opening' => $this->input->post('opening'),
            'modified_at' => date('Y-m-d H:i:s', time()),
            'modified_by' => $this->session->user_id
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('ac_charts', $data);
    }

    /**
     * Delete A/C chart by id
     *
     * @param  integer  $id
     * @return void
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('ac_charts');
    }

    /**
     * Delete A/C charts by company id
     *
     * @param  integer  $company_id
     * @return void
     */
    public function delete_by_cmp($company_id)
    {
        $this->db->where('company_id', $company_id);
        $this->db->delete('ac_charts');
    }

}