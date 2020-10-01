<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Sclass extends MX_Controller {
    /**
     * This controller is use for add class and maintain class
     *
     * Maps to the following URL
     * 		http://example.com/index.php/Sclass
     * 	- or -  
     * 		http://example.com/index.php/Sclass/<method_name>
     */
    function __construct() {
        parent::__construct();
        $this->load->model('classmodel');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
    }
    //This function is useing for add a new class and section.
    public function addClass() {
        if ($this->input->post('submit', TRUE)) {
            $classTitle = $this->input->post('class_title', TRUE);
            $group = $this->input->post('group', TRUE);
            if ($this->input->post('group_2', TRUE)) {
                $group = $this->input->post('group', TRUE) . ',' . $this->input->post('group_2', TRUE);
            }
            if ($this->input->post('group_3', TRUE)) {
                $group = $this->input->post('group', TRUE) . ',' . $this->input->post('group_2', TRUE) . ',' . $this->input->post('group_3', TRUE);
            }
            $section = $this->input->post('section', TRUE);
            if ($this->input->post('section_2', TRUE)) {
                $section = $this->input->post('section', TRUE) . ',' . $this->input->post('section_2', TRUE);
            }
            if ($this->input->post('section_3', TRUE)) {
                $section = $this->input->post('section', TRUE) . ',' . $this->input->post('section_2', TRUE) . ',' . $this->input->post('section_3', TRUE);
            }
            if ($this->input->post('section_4', TRUE)) {
                $section = $this->input->post('section', TRUE) . ',' . $this->input->post('section_2', TRUE) . ',' . $this->input->post('section_3', TRUE) . ',' . $this->input->post('section_4', TRUE);
            }
            if ($this->input->post('section_5', TRUE)) {
                $section = $this->input->post('section', TRUE) . ',' . $this->input->post('section_2', TRUE) . ',' . $this->input->post('section_3', TRUE) . ',' . $this->input->post('section_4', TRUE) . ',' . $this->input->post('section_5', TRUE);
            }
            $capicity = $this->input->post('capicity', TRUE);
            $classCode = $this->input->post('class_code', TRUE);
            $tableData = array(
                'class_title' => $this->db->escape_like_str($classTitle),
                'class_group' => $this->db->escape_like_str($group),
                'section' => $this->db->escape_like_str($section),
                'section_student_capacity' => $this->db->escape_like_str($capicity),
                'classCode' => $this->db->escape_like_str($classCode)
            );
            if ($this->db->insert('class', $tableData)) {
                $data['success'] = '<div class="alert alert-info alert-dismissable admisionSucceassMessageFont">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                            <strong>'.lang('success').'</strong>'.lang('clasc_1').' "' . $classTitle . '" '.lang('clasc_2').'
                                    </div>';
                $data['classInfo'] = $this->common->getAllData('class');
                $this->load->view('temp/header');
                $this->load->view('allClass', $data);
                $this->load->view('temp/footer');
            }
        } else {
            $data['teacher'] = $this->common->getAllData('teachers_info');
            $this->load->view('temp/header');
            $this->load->view('addClassSection', $data);
            $this->load->view('temp/footer');
        }
    }
    
    //This function can edit class information
    public function deleteClass() {
        $id = $this->input->get('id');
        if ($this->db->delete('class', array('id' => $id))) {
            redirect('sclass/allClass/', 'refresh');
        }
    }
    
    //This function is useing for geting all class short information
    public function allClass() {
        $data['classInfo'] = $this->common->getAllData('class');
        $this->load->view('temp/header');
        $this->load->view('allClass', $data);
        $this->load->view('temp/footer');
    }
    
    //This function is useing for a class's full informtion
    public function classDetails() {
        $class_id = $this->input->get('c_id');
        $data['class'] = $this->common->getWhere('class', 'id', $class_id);
        $data['day'] = $this->common->getAllData('config_week_day');
        $data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
        $data['teacher'] = $this->common->getAllData('teachers_info');
        $data['classSection'] = $this->classmodel->totalClassSection($class_id);
        $this->load->view('temp/header');
        $this->load->view('classDetails', $data);
        $this->load->view('temp/footer');
    }
    //This function lode the view for select which class routine add or make
    public function selectClassRoutin() {
        $data['classTile'] = $this->common->getAllData('class');
        $data['day'] = $this->common->getAllData('config_week_day');
        $this->load->view('temp/header');
        $this->load->view('selectClassRoutine', $data);
        $this->load->view('temp/footer');
    }
    //This function is useing for add new class routine
    public function addClassRoutin() {
        $class_id = $this->input->post('class', TRUE);
        $classTitle = $this->common->class_title($class_id);
        //if admin set section for any class then bellow [if(){ condition]  will execute ***(Start)***
        if ($this->input->post('section', TRUE)) {
            $section = $this->input->post('section', TRUE);
            //if admin set "all" section for any class then bellow [if(){ condition]  will execute ***(Start)***
            if ($section == 'all') {
                if ($this->input->post('submit2', TRUE)) {
                    $day = $this->input->post('day', TRUE);
                    $subject = $this->input->post('subject', TRUE);
                    $teacher = $this->input->post('teacher', TRUE);
                    $startTime = $this->input->post('startTime', TRUE);
                    $endTime = $this->input->post('endTime', TRUE);
                    $roomNumber = $this->input->post('roomNumber', TRUE);
                    $tableData = array(
                        'class_id' => $this->db->escape_like_str($class_id),
                        'day_title' => $this->db->escape_like_str($day),
                        'section' => $this->db->escape_like_str($section),
                        'subject' => $this->db->escape_like_str($subject),
                        'subject_teacher' => $this->db->escape_like_str($teacher),
                        'start_time' => $this->db->escape_like_str($startTime),
                        'end_time' => $this->db->escape_like_str($endTime),
                        'room_number' => $this->db->escape_like_str($roomNumber)
                    );
                    $tableData2 = array(
                        'subject_teacher' => $this->db->escape_like_str($teacher),
                    );
                    if ($this->db->insert('class_routine', $tableData) && $this->db->update('class_subject', $tableData2, array('class_id' => $class_id, 'subject_title' => $subject))) {
                        $data['classTile'] = $classTitle;
                        $data['class_id'] = $class_id;
                        $data['day'] = $this->common->getAllData('config_week_day');
                        $data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
                        $data['teacher'] = $this->common->getAllData('teachers_info');
                        $this->load->view('temp/header');
                        $this->load->view('addClassRoutin', $data);
                        $this->load->view('temp/footer');
                    }
                } else {
                    $data['classTile'] = $classTitle;
                    $data['class_id'] = $class_id;
                    $data['day'] = $this->common->getAllData('config_week_day');
                    $data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
                    $data['teacher'] = $this->common->getAllData('teachers_info');
                    $this->load->view('temp/header');
                    $this->load->view('addClassRoutin', $data);
                    $this->load->view('temp/footer');
                }
            }
            //if admin set "Section A or any specific section" for any class then bellow [ealse{ condition]  will execute ***(Start)***
            else {
                if ($this->input->post('submit2', TRUE)) {
                    $day = $this->input->post('day', TRUE);
                    $subject = $this->input->post('subject', TRUE);
                    $teacher = $this->input->post('teacher', TRUE);
                    $startTime = $this->input->post('startTime', TRUE);
                    $endTime = $this->input->post('endTime', TRUE);
                    $roomNumber = $this->input->post('roomNumber', TRUE);
                    $tableData = array(
                        'class_id' => $this->db->escape_like_str($class_id),
                        'day_title' => $this->db->escape_like_str($day),
                        'section' => $this->db->escape_like_str($section),
                        'subject' => $this->db->escape_like_str($subject),
                        'subject_teacher' => $this->db->escape_like_str($teacher),
                        'start_time' => $this->db->escape_like_str($startTime),
                        'end_time' => $this->db->escape_like_str($endTime),
                        'room_number' => $this->db->escape_like_str($roomNumber)
                    );
                    $tableData2 = array(
                        'subject_teacher' => $this->db->escape_like_str($teacher),
                    );
                    if ($this->db->insert('class_routine', $tableData) && $this->db->update('class_subject', $tableData2, array('class_id' => $class_id, 'subject_title' => $subject))) {
                        $data['classTile'] = $classTitle;
                        $data['class_id'] = $class_id;
                        $data['day'] = $this->common->getAllData('config_week_day');
                        $data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
                        $data['teacher'] = $this->common->getAllData('teachers_info');
                        $this->load->view('temp/header');
                        $this->load->view('addClassRoutin', $data);
                        $this->load->view('temp/footer');
                    }
                } else {
                    $data['classTile'] = $classTitle;
                    $data['class_id'] = $class_id;
                    $data['day'] = $this->common->getAllData('config_week_day');
                    $data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
                    $data['teacher'] = $this->common->getAllData('teachers_info');
                    $this->load->view('temp/header');
                    $this->load->view('addClassRoutin', $data);
                    $this->load->view('temp/footer');
                }
            }
        }
        //if admin do not set section for any class then bellow [else{ condition]  will execute ***(Start)***
        else {
            if ($this->input->post('submit2', TRUE)) {
                $day = $this->input->post('day', TRUE);
                $subject = $this->input->post('subject', TRUE);
                $teacher = $this->input->post('teacher', TRUE);
                $startTime = $this->input->post('startTime', TRUE);
                $endTime = $this->input->post('endTime', TRUE);
                $roomNumber = $this->input->post('roomNumber', TRUE);
                $tableData = array(
                    'class_id' => $this->db->escape_like_str($class_id),
                    'day_title' => $this->db->escape_like_str($day),
                    'subject' => $this->db->escape_like_str($subject),
                    'subject_teacher' => $this->db->escape_like_str($teacher),
                    'start_time' => $this->db->escape_like_str($startTime),
                    'end_time' => $this->db->escape_like_str($endTime),
                    'room_number' => $this->db->escape_like_str($roomNumber)
                );
                $tableData2 = array(
                    'subject_teacher' => $this->db->escape_like_str($teacher),
                );
                //$this->db->where(array('class_title' => $classTitle,'subject_title' =>$subject));
                if ($this->db->insert('class_routine', $tableData) && $this->db->update('class_subject', $tableData2, array('class_id' => $class_id, 'subject_title' => $subject))) {
                    $data['classTile'] = $classTitle;
                    $data['class_id'] = $class_id;
                    $data['day'] = $this->common->getAllData('config_week_day');
                    $data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
                    $data['teacher'] = $this->common->getAllData('teachers_info');
                    $this->load->view('temp/header');
                    $this->load->view('addClassRoutin', $data);
                    $this->load->view('temp/footer');
                }
            } else {
                $data['classTile'] = $classTitle;
                $data['class_id'] = $class_id;
                $data['day'] = $this->common->getAllData('config_week_day');
                $data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
                $data['teacher'] = $this->common->getAllData('teachers_info');
                $this->load->view('temp/header');
                $this->load->view('addClassRoutin', $data);
                $this->load->view('temp/footer');
            }
        }
    }

    //This function gives us class section and class info.
    public function ajaxClassInfo() {
        $class_id = $this->input->get('q');
        $query = $this->common->getWhere('class', 'id', $class_id);
        foreach ($query as $row) {
            $data = $row;
        }
 