<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Teachers extends MX_Controller {

    /**
     * This controller is using for control teachers work
     * 
     * Maps to the following URL
     * 		http://example.com/index.php/teachers
     * 	- or -  
     * 		http://example.com/index.php/teachers/<method_name>
     */
    function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $this->load->model('teachermodel');
    }

    //This function gives all teacher's short informattion in a table view
    public function allTeachers() {
        $data['teacher'] = $this->teachermodel->allTeachers();
        $this->load->view('temp/header');
        $this->load->view('teachers', $data);
        $this->load->view('temp/footer');
    }

    //This function gives all details about any teacher
    public function teacherDetails() {
        $id = $this->input->get('id');
        $userId = $this->input->get('uid');
        $data['teacher'] = $this->common->getWhere('teachers_info', 'id', $id);
        $data['user'] = $this->common->getWhere('users', 'id', $userId);
        $this->load->view('temp/header');
        $this->load->view('teacherDetails', $data);
        $this->load->view('temp/footer');
    }
    //This function is using for editing a teacher informations
    //And admin an select group  
    function edit_teacher() {
        $userId = $this->input->get('uid');
        $teacherId = $this->input->get('id');
        if ($this->input->post('submit', TRUE)) {
            $edu_1 = '';
            $edu_2 = '';
            $edu_3 = '';
            $edu_4 = '';
            $edu_5 = '';
            if ($this->input->post('dd_1', TRUE)) {
                $edu_1 = $this->input->post('dd_1') . ',' . $this->input->post('scu_1', TRUE) . ',' . $this->input->post('result_1', TRUE) . ',' . $this->input->post('paYear_1', TRUE) . ',' . $this->input->post('reg_1', TRUE);
            }
            if ($this->input->post('dd_2', TRUE)) {
                $edu_2 = $this->input->post('dd_2') . ',' . $this->input->post('scu_2', TRUE) . ',' . $this->input->post('result_2', TRUE) . ',' . $this->input->post('paYear_2', TRUE). ',' . $this->input->post('reg_2', TRUE);
            }
            if ($this->input->post('dd_3', TRUE)) {
                $edu_3 = $this->input->post('dd_3') . ',' . $this->input->post('scu_3', TRUE) . ',' . $this->input->post('result_3', TRUE) . ',' . $this->input->post('paYear_3', TRUE) . ',' . $this->input->post('reg_3', TRUE);
            }
            if ($this->input->post('dd_4', TRUE)) {
                $edu_4 = $this->input->post('dd_4') . ',' . $this->input->post('scu_4', TRUE) . ',' . $this->input->post('result_4', TRUE) . ',' . $this->input->post('paYear_4', TRUE) . ',' . $this->input->post('reg_4', TRUE);
            }
            if ($this->input->post('dd_5', TRUE)) {
                $edu_5 = $this->input->post('dd_5') . ',' . $this->input->post('scu_5', TRUE) . ',' . $this->input->post('result_5', TRUE) . ',' . $this->input->post('paYear_5'). ',' . $this->input->post('reg_5', TRUE);
            }

    //--------------------------------teacher Qualification-----------------------------------------
             $teaqual_1 = '';
            $teaqual_2 = '';
            $teaqual_3 = '';
            if ($this->input->post('teaqual_1', TRUE)) {
                $teaqual_1 =  $this->input->post('teaqual_1', TRUE) . ',' . $this->input->post('teayear_1', TRUE) . ',' . $this->input->post('scul_1', TRUE)  . ',' . $this->input->post('grade_1', TRUE);
            }
            if ($this->input->post('teaqual_2', TRUE)) {
                $teaqual_2 = $this->input->post('teaqual_2', TRUE) . ',' . $this->input->post('teayear_2', TRUE) . ',' . $this->input->post('scul_2', TRUE)  . ',' . $this->input->post('grade_2', TRUE);
            }
           if ($this->input->post('teaqual_3', TRUE)) {
                $teaqual_3 = $this->input->post('teaqual_3', TRUE) . ',' . $this->input->post('teayear_3', TRUE) . ',' . $this->input->post('scul_3', TRUE)  . ',' . $this->input->post('grade_3', TRUE);
            }
 //----------------------------------Serice Trannings---------------------------------------
             $cource_1 = '';
            $cource_2 = '';
            $cource_3 = '';
            if ($this->input->post('cource_1', TRUE)) {
                $cource_1 =  $this->input->post('cource_1', TRUE) . ',' . $this->input->post('from_1', TRUE) . ',' . $this->input->post('toend_1', TRUE)  . ',' . $this->input->post('ins_1', TRUE);
            }
             if ($this->input->post('cource_2', TRUE)) {
                $cource_2 =  $this->input->post('cource_2', TRUE) . ',' . $this->input->post('from_2', TRUE) . ',' . $this->input->post('toend_2', TRUE)  . ',' . $this->input->post('ins_2', TRUE);
            }
             if ($this->input->post('cource_3', TRUE)) {
                $cource_3 =  $this->input->post('cource_3', TRUE) . ',' . $this->input->post('from_3', TRUE) . ',' . $this->input->post('toend_3', TRUE)  . ',' . $this->input->post('ins_3', TRUE);
            }
           
 //--------------------- Teaching Experience------------------------------------------------------
             $institute_serve_1 = '';
            $institute_serve_2 = '';
            $institute_serve_3 = '';
             if ($this->input->post('ins_serve_1', TRUE)) {
                $institute_serve_1 = $this->input->post('ins_serve_1', TRUE) . ',' . $this->input->post('fromt_1', TRUE) . ',' . $this->input->post('toendt_1', TRUE)  . ',' . $this->input->post('class_taught_1', TRUE) . ',' . $this->input->post('sub_taught_1', TRUE);
            }
            if ($this->input->post('ins_serve_2', TRUE)) {
                $institute_serve_2 = $this->input->post('ins_serve_2', TRUE) . ',' . $this->input->post('fromt_2', TRUE) . ',' . $this->input->post('toendt_2', TRUE)  . ',' . $this->input->post('class_taught_2', TRUE) . ',' . $this->input->post('sub_taught_2', TRUE);
            }
             if ($this->input->post('ins_serve_3', TRUE)) {
                $institute_serve_3 = $this->input->post('ins_serve_3', TRUE) . ',' . $this->input->post('fromt_3', TRUE) . ',' . $this->input->post('toendt_3', TRUE)  . ',' . $this->input->post('class_taught_3', TRUE) . ',' . $this->input->post('sub_taught_3', TRUE);
            }
           
    //---------------------------------------- Adminstrtive Experience--------------------------------->
             $admin_serve_1 = '';
            $admin_serve_2 = '';
            $admin_serve_3 = '';
            if ($this->input->post('ins_servea_1', TRUE)) {
                $admin_serve_1 = $this->input->post('ins_servea_1', TRUE) . ',' . $this->input->post('froma_1', TRUE) . ',' . $this->input->post('toenda_1', TRUE)  . ',' . $this->input->post('posi_1', TRUE);
            }
             if ($this->input->post('ins_servea_2', TRUE)) {
                $admin_serve_2 = $this->input->post('ins_servea_2', TRUE) . ',' . $this->input->post('froma_2', TRUE) . ',' . $this->input->post('toenda_2', TRUE)  . ',' . $this->input->post('posi_2', TRUE);
            }
             if ($this->input->post('ins_servea_3', TRUE)) {
                $admin_serve_3 = $this->input->post('ins_servea_3', TRUE) . ',' . $this->input->post('froma_3', TRUE) . ',' . $this->input->post('toenda_3', TRUE)  . ',' . $this->input->post('posi_3', TRUE);
            }
           
      
     //------------------------------------------Refrence ------------------------>
             $orgname_1 = '';
            $orgname_2 = '';
            $orgname_3 = '';
              if ($this->input->post('orgname_1', TRUE)) {
                $orgname_1 = $this->input->post('orgname_1', TRUE) . ',' . $this->input->post('orgadd_1', TRUE) . ',' . $this->input->post('orgtel_1', TRUE) ;
            }
             if ($this->input->post('orgname_2', TRUE)) {
                $orgname_2 = $this->input->post('orgname_2', TRUE) . ',' . $this->input->post('orgadd_2', TRUE) . ',' . $this->input->post('orgtel_2', TRUE) ;
            }
             if ($this->input->post('orgname_3', TRUE)) {
                $orgname_3 = $this->input->post('orgname_3', TRUE) . ',' . $this->input->post('orgadd_3', TRUE) . ',' . $this->input->post('orgtel_3', TRUE) ;
            }
          
          //------------------------------------------------------------------------
            $username = strtolower($this->input->post('first_name', TRUE)) . ' ' . strtolower($this->input->post('last_name', TRUE));
            $additional_data = array(
                'username' => $this->db->escape_like_str($username),
                'email' => $this->db->escape_like_str($this->input->post('email', TRUE)),
                'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
                'last_name' => $this->db->escape_like_str($this->input->post('last_name', TRUE)),
                'phone' => $this->db->escape_like_str($this->input->post('phone', TRUE)),
            );
            $this->db->where('id', $userId);
            $this->db->update('users', $additional_data);
           $teachersInfo = array(
                   
                    'fullname' => $this->db->escape_like_str($username),
                    'farther_name' => $this->db->escape_like_str($this->input->post('father_name', TRUE)),
                    'position_applied_for' => $this->db->escape_like_str($this->input->post('applied', TRUE)),
                    'subject_teach' => $this->db->escape_like_str($this->input->post('sub1', TRUE)),
                    'classes_teach' => $this->db->escape_like_str($this->input->post('cls', TRUE)),
                    'birth_date' => $this->db->escape_like_str($this->input->post('birthdate', TRUE)),
                    'sex' => $this->db->escape_like_str($this->input->post('sex', TRUE)),
                    'married' => $this->db->escape_like_str($this->input->post('married', TRUE)),
                    'divorced' => $this->db->escape_like_str($this->input->post('divorced', TRUE)),
                    'widow_widower' => $this->db->escape_like_str($this->input->post('widow', TRUE)),
                    'spouse_name' => $this->db->escape_like_str($this->input->post('spouse_name', TRUE)),
                    'spouse_qualification' => $this->db->escape_like_str($this->input->post('spouse_qualification', TRUE)),
                    'spouse_profession' => $this->db->escape_like_str($this->input->post('spouse_profession', TRUE)),
                    'number_of_children' => $this->db->escape_like_str($this->input->post('no_children', TRUE)),
                    'elder_child_age' => $this->db->escape_like_str($this->input->post('elder_child', TRUE)),
                    'young_child_age' => $this->db->escape_like_str($this->input->post('young_child', TRUE)), 
                    'nationality' => $this->db->escape_like_str($this->input->post('nationality', TRUE)),
                    'religion' => $this->db->escape_like_str($this->input->post('religion', TRUE)),
                    'sect' => $this->db->escape_like_str($this->input->post('sect', TRUE)),
                    'place_of_birth' => $this->db->escape_like_str($this->input->post('place_birth', TRUE)),
                    'country' => $this->db->escape_like_str($this->input->post('country', TRUE)),                   
                     'present_address' => $this->db->escape_like_str($this->input->post('present_address', TRUE)),
                    'permanent_address' => $this->db->escape_like_str($this->input->post('permanent_address', TRUE)),
                    
                    'work_place' => $this->db->escape_like_str($this->input->post('work_place', TRUE)),
                    'phone' => $this->db->escape_like_str($this->input->post('tel', TRUE)),
                    'working_hour' => $this->db->escape_like_str($this->input->post('workingHoure', TRUE)),
                    'applied_before' => $this->db->escape_like_str($this->input->post('applied', TRUE)),
                    'educational_qualification_1' => $this->db->escape_like_str($edu_1),
                    'educational_qualification_2' => $this->db->escape_like_str($edu_2),
                    'educational_qualification_3' => $this->db->escape_like_str($edu_3),
                    'educational_qualification_4' => $this->db->escape_like_str($edu_4),
                    'educational_qualification_5' => $this->db->escape_like_str($edu_5),
                    'extra_activity' => $this->db->escape_like_str($this->input->post('extra_activity', TRUE)),
                    'teacher_qualification_1' => $this->db->escape_like_str($teaqual_1),
                    'teacher_qualification_2' => $this->db->escape_like_str($teaqual_2),
                    'teacher_qualification_3' => $this->db->escape_like_str($teaqual_3),
                    'msword' => $this->db->escape_like_str($this->input->post('msword', TRUE)),
                    'msexcel' => $this->db->escape_like_str($this->input->post('excel', TRUE)),
                    'power_point' => $this->db->escape_like_str($this->input->post('powerp', TRUE)),
                    'internet' => $this->db->escape_like_str($this->input->post('internet', TRUE)),
                    'course_1' => $this->db->escape_like_str($cource_1),
                    'course_2' => $this->db->escape_like_str($cource_2),
                    'course_3' => $this->db->escape_like_str($cource_3),
                    'institute_served_1' => $this->db->escape_like_str($institute_serve_1),
                    'institute_served_2' => $this->db->escape_like_str($institute_serve_2),
                    'institute_served_3' => $this->db->escape_like_str($institute_serve_3),
                    'activity_1' => $this->db->escape_like_str($this->input->post('a', TRUE)),
                    'activity_2' => $this->db->escape_like_str($this->input->post('b', TRUE)),
                    'activity_3' => $this->db->escape_like_str($this->input->post('c', TRUE)),
                    'administrative_service_1' => $this->db->escape_like_str($admin_serve_1),
                    'administrative_service_2' => $this->db->escape_like_str($admin_serve_2),
                    'administrative_service_3' => $this->db->escape_like_str($admin_serve_3),
                    'organization_name_1' => $this->db->escape_like_str($orgname_1),
                    'organization_name_2' => $this->db->escape_like_str($orgname_2),
                    'organization_name_3' => $this->db->escape_like_str($orgname_3),
                    
                    'recommendation' => $this->db->escape_like_str($this->input->post('recommendation', TRUE)),
                    
                   
                    'cv' => $this->db->escape_like_str($this->input->post('cv', TRUE)),
                    'educational_certificat' => $this->db->escape_like_str($this->input->post('educational_certificat', TRUE)),
                    'exprieance_certificatte' => $this->db->escape_like_str($this->input->post('exc', TRUE)),
                    'files_info' => $this->db->escape_like_str($this->input->post('submited_info', TRUE)),
                    
                );
            $this->db->where('id', $teacherId);
            $this->db->update('teachers_info', $teachersInfo);
            $data['teacher'] = $this->common->getAllData('teachers_info');
            $this->load->view('temp/header');
            $this->load->view('teachers', $data);
            $this->load->view('temp/footer');
        } else {
            //get all data about this teacher from the "user" table
            $data['userInfo'] = $this->common->getWhere('users', 'id', $userId);
            $data['teacherInfo'] = $this->common->getWhere('teachers_info', 'id', $teacherId);
            //get all groupe information and current group information to view file by "$data" array.
            $data['groups'] = $this->ion_auth->groups()->result_array();
            $data['currentGroups'] = $this->ion_auth->get_users_groups($userId)->result();
            $this->load->view('temp/header');
            $this->load->view('editTeacher', $data);
            $this->load->view('temp/footer');
        }
    }
    //This function is use for delete a teacher.
    public function teacherDelete() {
        $teacherId = $this->input->get('id');
        $userId = $this->input->get('uid');
        $this->db->delete('teachers_info', array('id' => $teacherId));
        $this->db->delete('users', array('id' => $userId));
        redirect('teachers/allTeachers', 'refresh');
    }
}
