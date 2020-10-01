<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MAc_default_charts extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_by_id($id)
    {
        $data = array();
        $this->db->where('id', $id);
        $q = $this->db->get('ac_default_charts');
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

    public function get_all()
    {
        $data = array();
        $this->db->order_by('parent_id', 'asc')->group_by('parent_id,id');
        $q = $this->db->get('ac_default_charts');
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
        $this->db->where('parent_id', $parent_id);
        $q1 = $this->db->get('ac_default_charts');
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
                $this->db->where('parent_id', $row1['id']);
                $q2 = $this->db->get('ac_default_charts');
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
                        $this->db->where('parent_id', $row2['id']);
                        $q3 = $this->db->get('ac_default_charts');
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
                                $this->db->where('parent_id', $row3['id']);
                                $q4 = $this->db->get('ac_default_charts');
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
                                        $this->db->where('parent_id', $row4['id']);
                                        $q5 = $this->db->get('ac_default_charts');
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
                                                $this->db->where('parent_id', $row5['id']);
                                                $q6 = $this->db->get('ac_default_charts');
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
                                                        $this->db->where('parent_id', $row6['id']);
                                                        $q7 = $this->db->get('ac_default_charts');
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
                                                                $this->db->where('parent_id', $row7['id']);
                                                                $q8 = $this->db->get('ac_default_charts');
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
                                                                        $this->db->where('parent_id', $row8['id']);
                                                                        $q9 = $this->db->get('ac_default_charts');
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
                                                                                $this->db->where('parent_id', $row9['id']);
                                                                                $q10 = $this->db->get('ac_default_charts');
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
        $this->db->where('parent_id', $parent_id);
        $q1 = $this->db->get('ac_default_charts');
        if ($q1->num_rows() > 0)
        {
            foreach ($q1->result_array() as $row1)
            {
                $options[] = $row1;
                $this->db->where('parent_id', $row1['id']);
                $q2 = $this->db->get('ac_default_charts');
                if ($q2->num_rows() > 0)
                {
                    foreach ($q2->result_array() as $row2)
                    {
                        $options[] = $row2;
                        $this->db->where('parent_id', $row2['id']);
                        $q3 = $this->db->get('ac_default_charts');
                        if ($q3->num_rows() > 0)
                        {
                            foreach ($q3->result_array() as $row3)
                            {
                                $options[] = $row3;
                                $this->db->where('parent_id', $row3['id']);
                                $q4 = $this->db->get('ac_default_charts');
                                if ($q4->num_rows() > 0)
                                {
                                    foreach ($q4->result_array() as $row4)
                                    {
                                        $options[] = $row4;
                                        $this->db->where('parent_id', $row4['id']);
                                        $q5 = $this->db->get('ac_default_charts');
                                        if ($q5->num_rows() > 0)
                                        {
                                            foreach ($q5->result_array() as $row5)
                                            {
                                                $options[] = $row5;
                                                $this->db->where('parent_id', $row5['id']);
                                                $q6 = $this->db->get('ac_default_charts');
                                                if ($q6->num_rows() > 0)
                                                {
                                                    foreach ($q6->result_array() as $row6)
                                                    {
                                                        $options[] = $row6;
                                                        $this->db->where('parent_id', $row6['id']);
                                                        $q7 = $this->db->get('ac_default_charts');
                                                        if ($q7->num_rows() > 0)
                                                        {
                                                            foreach ($q7->result_array() as $row7)
                                                            {
                                                                $options[] = $row7;
                                                                $this->db->where('parent_id', $row7['id']);
                                                                $q8 = $this->db->get('ac_default_charts');
                                                                if ($q8->num_rows() > 0)
                                                                {
                                                                    foreach ($q8->result_array() as $row8)
                                                                    {
                                                                        $options[] = $row8;
                                                                        $this->db->where('parent_id', $row8['id']);
                                                                        $q9 = $this->db->get('ac_default_charts');
                                                                        if ($q9->num_rows() > 0)
                                                                        {
                                                                            foreach ($q9->result_array() as $row9)
                                                                            {
                                                                                $options[] = $row9;
                                                                                $this->db->where('parent_id', $row9['id']);
                                                                                $q10 = $this->db->get('ac_default_charts');
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

    public function create()
    {
        $data = array(
            'parent_id' => $this->input->post('parent_id'),
            'code' => $this->input->post('code'),
            'name' => $this->input->post('name'),
            'memo' => $this->input->post('memo'),
            'type' => $this->input->post('type'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'created_by' => $this->session->userdata('user_id')
            );
        $this->db->insert('ac_default_charts', $data);
    }

    public function update()
    {
        $data = array(
            'parent_id' => $this->input->post('parent_id'),
            'code' => $this->input->post('code'),
            'name' => $this->input->post('name'),
            'memo' => $this->input->post('memo'),
            'type' => $this->input->post('type'),
            'modified_at' => date('Y-m-d H:i:s', time()),
            'modified_by' => $this->session->userdata('user_id')
            );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('ac_default_charts', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('ac_default_charts');
    }

}
