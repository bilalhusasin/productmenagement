<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Users extends CI_Controller {

    /**
     * This controller is using for add new users (New Student,Teacher and Parents) in this system 
     *
     * Maps to the following URL
     * 		http://example.com/index.php/users
     * 	- or -  
     * 		http://example.com/index.php/users/<method_name>
     */
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
    }
 
    //This function is using for add new student
    function admission() {
        $class_id = $this->db->escape_like_str($this->input->post('class', TRUE));
        if ($this->input->post('submit', TRUE)) { 
            $username = $this->input->post('first_name') . ' ' . $this->input->post('last_name');        
            //Here is uploading the student's photo.
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '10000';
            $config['max_width'] = '10240';
            $config['max_height'] = '7680';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->do_upload();
            $uploadFileInfo = $this->upload->data();
            $phone = $this->input->post('phoneCode', TRUE) . '' . $this->input->post('phone', TRUE);
            //This array information's are sending to "user" table as a core information as a user this system
            $class_id = $this->db->escape_like_str($this->input->post('class', TRUE));
            $class_title = $this->common->class_title($class_id);
            $guardian_name = $this->input->post('guardian_first_name', TRUE) . ' ' . $this->input->post('guardian_last_name', TRUE);
            $reg_number=$this->input->post('register_number', TRUE);
                //This array information's are sending to "student_info" table.
            $curyear = date('Y');
            $curmonth = date('F');
            $curdate = date('Y-m-d');
                $studentsInfo = array(
                    'year' => $this->db->escape_like_str($curyear),
                    'admi_month' =>$this->db->escape_like_str($curmonth),
                    // 'user_id' => $this->db->escape_like_str($userid),
                    'student_id' => $this->db->escape_like_str($this->input->post('student_id', TRUE)),
                    'roll_number' => $this->db->escape_like_str($this->input->post('roll_number', TRUE)),
                    'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
                    'last_name' => $this->db->escape_like_str($this->input->post('last_name', TRUE)),
                    'student_nam' => $this->db->escape_like_str($username),
                    'birth_date' => $this->db->escape_like_str($this->input->post('birthdate', TRUE)),
                    'place_birth' => $this->db->escape_like_str($this->input->post('place_birth', TRUE)),
                    'class_id' => $this->db->escape_like_str($class_id),
                    'class_title' => $this->db->escape_like_str($class_title),
                    'section' => $this->db->escape_like_str($this->input->post('section', TRUE)),
                    'farther_name' => $this->db->escape_like_str($this->input->post('father_name', TRUE)),
                    'mother_name' => $this->db->escape_like_str($this->input->post('mother_name', TRUE)),
                    'guardian_name' => $this->db->escape_like_str($guardian_name),
                    'guardian_first_name' => $this->db->escape_like_str($this->input->post('guardian_first_name', TRUE)),
                    'guardian_last_name' => $this->db->escape_like_str($this->input->post('guardian_last_name', TRUE)),
                    'guardian_relationship' => $this->db->escape_like_str($this->input->post('guardian_relationship', TRUE)),
                    'guardian_qualification' => $this->db->escape_like_str($this->input->post('guardian_qualification', TRUE)),
                    'gender' => $this->db->escape_like_str($this->input->post('sex', TRUE)),
                    'present_address' => $this->db->escape_like_str($this->input->post('present_address', TRUE)),
                    'permanent_address' => $this->db->escape_like_str($this->input->post('permanent_address', TRUE)),
                    'phone' => $this->db->escape_like_str($phone),
                    'father_occupation' => $this->db->escape_like_str($this->input->post('father_occupation', TRUE)),
                    // 'father_incom_range' => $this->db->escape_like_str($this->input->post('father_incom_range', TRUE)),
                    'mother_occupation' => $this->db->escape_like_str($this->input->post('mother_occupation', TRUE)),
                    'student_photo' => $this->db->escape_like_str($uploadFileInfo['file_name']),
                    'last_class_certificate' => $this->db->escape_like_str($this->input->post('previous_certificate', TRUE)),
                    't_c' => $this->db->escape_like_str($this->input->post('tc', TRUE)),
                    'academic_transcription' => $this->db->escape_like_str($this->input->post('at', TRUE)),
                    'national_birth_certificate' => $this->db->escape_like_str($this->input->post('nbc', TRUE)),
                    'testimonial' => $this->db->escape_like_str($this->input->post('testmonial', TRUE)),
                    'documents_info' => $this->db->escape_like_str($this->input->post('submit_file_information', TRUE)),
                    // 'blood' => $this->db->escape_like_str($this->input->post('blood', TRUE)),
                    'starting_year' => $this->db->escape_like_str($curyear),
                    'registration_number' => $this->db->escape_like_str($this->input->post('register_number', TRUE)),
                    'admission_date' => $this->db->escape_like_str($curdate),
                    //'status' => $this->db->escape_like_str("Active"),
                    'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE)),
                );  
//                $feeTableInfo = array(
//                    'student_id' => $this->db->escape_like_str($this->input->post('student_id', TRUE)),
//                    'year' => date('Y'),
//                    'class_title' => $this->db->escape_like_str($class_title),
//                    'admission' => $this->db->escape_like_str($this->input->post('admission', TRUE)),
//                );
//                $this->db->insert('student_fee_coll', $feeTableInfo);
                //Inserting here "student_info" table's data
                if ($this->db->insert('student_info', $studentsInfo)) {
                    $student_info_id = $this->db->insert_id();
                    $additionalData3 = array(
                        'year' => $this->db->escape_like_str($curyear),
                        'admi_month' =>$this->db->escape_like_str($curmonth),
                        //'user_id' => $this->db->escape_like_str($userid),
                        'roll_number' => $this->db->escape_like_str($this->input->post('roll_number', TRUE)),
                        'student_id' => $this->db->escape_like_str($this->input->post('student_id', TRUE)),
                        'class_title' => $this->db->escape_like_str($class_title),
                        'class_id' => $this->db->escape_like_str($class_id),
                        'section' => $this->db->escape_like_str($this->input->post('section', TRUE)),
                        'student_title' => $this->db->escape_like_str($username),
                        'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE)),
                    );

                    if ($this->db->insert('class_students', $additionalData3)) {
                        $stu_fee_dis = array(   
                        'student_id' => $this->db->escape_like_str($this->input->post('student_id', TRUE)),
                        'roll_number' => $this->db->escape_like_str($this->input->post('roll_number', TRUE)), 
                        'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE)),
                         ); 
                        $this->db->where('reg_number', $reg_number);
                        $this->db->update('student_fee_discount', $stu_fee_dis);
                        $voucherInfo = array(   
                        'student_ref_id' => $this->db->escape_like_str($this->input->post('student_id', TRUE)),  
                        'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE)),
                         ); 
                        $this->db->where('student_ref_id', $reg_number);
                        $this->db->where('voucher_type', 'Admission');
                        $this->db->update('vouchers', $voucherInfo);
                        $pass_data = array(   
                        'admission_status' => $this->db->escape_like_str('Admitted'),  
                        'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE)),
                         ); 
                        $this->db->where('reg_number', $reg_number); 
                        $this->db->update('register_pass', $pass_data);     
                        $studentAmount = $this->common->classStudentAmount($class_id);
                        $clas_info = array(
                            'student_amount' => $this->db->escape_like_str($studentAmount),
                            'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE)),
                        );
                        $this->db->where('id', $class_id);
                        if ($this->db->update('class', $clas_info)) { 
                                $data['success'] = '<div class="alert alert-info alert-dismissable admisionSucceassMessageFont">
                                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                                        <strong>Success!</strong> The student admitted successfully.
                                                    </div>';
                                //Load the admission form again for new student. 
                                $data['s_class'] = $this->common->getAllData('class');
                                $this->load->view('temp/header');
                                $this->load->view('add_new_student', $data);
                                $this->load->view('temp/footer');
                        }
                    }
                }
            
        } else {
            $query = $this->common->countryPhoneCode();
            $data['countryPhoneCode'] = $query->countryPhonCode;
            $data['s_class'] = $this->common->getAllData('class'); 
            //display the create user form
            $this->load->view('temp/header');
            $this->load->view('add_new_student', $data);
            $this->load->view('temp/footer');
        }
    }

    //This function is using for add new student
    /*function admission() {
        $class_id = $this->db->escape_like_str($this->input->post('class', TRUE));
        if ($this->input->post('submit', TRUE)) {
            $tables = $this->config->item('tables', 'ion_auth');
            $username = $this->input->post('first_name') . ' ' . $this->input->post('last_name');
            $email = strtolower($this->input->post('email', TRUE));
            $password = $this->input->post('password', TRUE);
            //Here is uploading the student's photo.
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '10000';
            $config['max_width'] = '10240';
            $config['max_height'] = '7680';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->do_upload();
            $uploadFileInfo = $this->upload->data();
            $phone = $this->input->post('phoneCode', TRUE) . '' . $this->input->post('phone', TRUE);
            //This array information's are sending to "user" table as a core information as a user this system
            $additional_data = array(
                'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
                'last_name' => $this->db->escape_like_str($this->input->post('last_name', TRUE)),
                'phone' => $this->db->escape_like_str($phone),
                'profile_image' => $uploadFileInfo['file_name'],
            );
            $group_ids = array('group_id' => 3);
            $class_id = $this->db->escape_like_str($this->input->post('class', TRUE));
            $class_title = $this->common->class_title($class_id);
            if ($this->ion_auth->register($username, $password, $email, $additional_data, $group_ids)) {
                $userid = $this->common->usersId();
                //This array information's are sending to "student_info" table.
                $studentsInfo = array(
                    'year' => date('Y'),
                    'user_id' => $this->db->escape_like_str($userid),
                    'student_id' => $this->db->escape_like_str($this->input->post('student_id', TRUE)),
                    'roll_number' => $this->db->escape_like_str($this->input->post('roll_number', TRUE)),
                    'class_id' => $this->db->escape_like_str($class_id),
                    'student_nam' => $this->db->escape_like_str($username),
                    'class_title' => $this->db->escape_like_str($class_title),
                    'section' => $this->db->escape_like_str($this->input->post('section', TRUE)),
                    'farther_name' => $this->db->escape_like_str($this->input->post('father_name', TRUE)),
                    'mother_name' => $this->db->escape_like_str($this->input->post('mother_name', TRUE)),
                    'birth_date' => $this->db->escape_like_str($this->input->post('birthdate', TRUE)),
                    'sex' => $this->db->escape_like_str($this->input->post('sex', TRUE)),
                    'present_address' => $this->db->escape_like_str($this->input->post('present_address', TRUE)),
                    'permanent_address' => $this->db->escape_like_str($this->input->post('permanent_address', TRUE)),
                    'phone' => $this->db->escape_like_str($phone),
                    'father_occupation' => $this->db->escape_like_str($this->input->post('father_occupation', TRUE)),
                    'father_incom_range' => $this->db->escape_like_str($this->input->post('father_incom_range', TRUE)),
                    'mother_occupation' => $this->db->escape_like_str($this->input->post('mother_occupation', TRUE)),
                    'student_photo' => $this->db->escape_like_str($uploadFileInfo['file_name']),
                    'last_class_certificate' => $this->db->escape_like_str($this->input->post('previous_certificate', TRUE)),
                    't_c' => $this->db->escape_like_str($this->input->post('tc', TRUE)),
                    'academic_transcription' => $this->db->escape_like_str($this->input->post('at', TRUE)),
                    'national_birth_certificate' => $this->db->escape_like_str($this->input->post('nbc', TRUE)),
                    'testimonial' => $this->db->escape_like_str($this->input->post('testmonial', TRUE)),
                    'documents_info' => $this->db->escape_like_str($this->input->post('submit_file_information', TRUE)),
                    'blood' => $this->db->escape_like_str($this->input->post('blood', TRUE)),
                    'starting_year' => $this->db->escape_like_str(date('Y')),
                    'status' => $this->db->escape_like_str("Active"),
                );
//                $feeTableInfo = array(
//                    'student_id' => $this->db->escape_like_str($this->input->post('student_id', TRUE)),
//                    'year' => date('Y'),
//                    'class_title' => $this->db->escape_like_str($class_title),
//                    'admission' => $this->db->escape_like_str($this->input->post('admission', TRUE)),
//                );
//                $this->db->insert('student_fee_coll', $feeTableInfo);
                //Inserting here "student_info" table's data
                if ($this->db->insert('student_info', $studentsInfo)) {
                    $student_info_id = $this->db->insert_id();
                    $additionalData3 = array(
                        'year' => $this->db->escape_like_str(date('Y')),
                        'user_id' => $this->db->escape_like_str($userid),
                        'roll_number' => $this->db->escape_like_str($this->input->post('roll_number', TRUE)),
                        'student_id' => $this->db->escape_like_str($this->input->post('student_id', TRUE)),
                        'class_title' => $this->db->escape_like_str($class_title),
                        'class_id' => $this->db->escape_like_str($class_id),
                        'section' => $this->db->escape_like_str($this->input->post('section', TRUE)),
                        'student_title' => $this->db->escape_like_str($username),
                    );

                    if ($this->db->insert('class_students', $additionalData3)) {
                        $studentAmount = $this->common->classStudentAmount($class_id);
                        $clas_info = array(
                            'student_amount' => $this->db->escape_like_str($studentAmount)
                        );
                        $this->db->where('id', $class_id);
                        if ($this->db->update('class', $clas_info)) {
                            $student_access = array(
                                'user_id' => $this->db->escape_like_str($userid),
                                'group_id' => $this->db->escape_like_str(3),
                                'das_top_info' => $this->db->escape_like_str(0),
                                'das_grab_chart' => $this->db->escape_like_str(0),
                                'das_class_info' => $this->db->escape_like_str(0),
                                'das_message' => $this->db->escape_like_str(1),
                                'das_employ_attend' => $this->db->escape_like_str(0),
                                'das_notice' => $this->db->escape_like_str(1),
                                'das_calender' => $this->db->escape_like_str(1),
                                'admission' => $this->db->escape_like_str(0),
                                'all_student_info' => $this->db->escape_like_str(0),
                                'stud_edit_delete' => $this->db->escape_like_str(0),
                                'stu_own_info' => $this->db->escape_like_str(1),
                                'teacher_info' => $this->db->escape_like_str(1),
                                'add_teacher' => $this->db->escape_like_str(0),
                                'teacher_details' => $this->db->escape_like_str(0),
                                'teacher_edit_delete' => $this->db->escape_like_str(0),
                                'all_parents_info' => $this->db->escape_like_str(0),
                                'own_parents_info' => $this->db->escape_like_str(1),
                                'make_parents_id' => $this->db->escape_like_str(0),
                                'parents_edit_dlete' => $this->db->escape_like_str(0),
                                'add_new_class' => $this->db->escape_like_str(0),
                                'all_class_info' => $this->db->escape_like_str(0),
                                'class_details' => $this->db->escape_like_str(0),
                                'class_delete' => $this->db->escape_like_str(0),
                                'class_promotion' => $this->db->escape_like_str(0),
                                'assin_optio_sub' => $this->db->escape_like_str(0),
                                'add_class_routine' => $this->db->escape_like_str(0),
                                'own_class_routine' => $this->db->escape_like_str(1),
                                'all_class_routine' => $this->db->escape_like_str(0),
                                'rutin_edit_delete' => $this->db->escape_like_str(0),
                                'attendance_preview' => $this->db->escape_like_str(0),
                                'take_studence_atten' => $this->db->escape_like_str(0),
                                'edit_student_atten' => $this->db->escape_like_str(0),
                                'add_employee' => $this->db->escape_like_str(0),
                                'employee_list' => $this->db->escape_like_str(0),
                                'employ_attendance' => $this->db->escape_like_str(0),
                                'empl_atte_view' => $this->db->escape_like_str(0),
                                'add_subject' => $this->db->escape_like_str(0),
                                'all_subject' => $this->db->escape_like_str(0),
                                'make_suggestion' => $this->db->escape_like_str(0),
                                'all_suggestion' => $this->db->escape_like_str(0),
                                'own_suggestion' => $this->db->escape_like_str(1),
                                'add_exam_gread' => $this->db->escape_like_str(0),
                                'exam_gread' => $this->db->escape_like_str(0),
                                'add_exam_routin' => $this->db->escape_like_str(0),
                                'all_exam_routine' => $this->db->escape_like_str(0),
                                'own_exam_routine' => $this->db->escape_like_str(1),
                                'exam_attend_preview' => $this->db->escape_like_str(0),
                                'approve_result' => $this->db->escape_like_str(0),
                                'view_result' => $this->db->escape_like_str(1),
                                'all_mark_sheet' => $this->db->escape_like_str(0),
                                'own_mark_sheet' => $this->db->escape_like_str(1),
                                'take_exam_attend' => $this->db->escape_like_str(0),
                                'change_exam_attendance' => $this->db->escape_like_str(0),
                                'make_result' => $this->db->escape_like_str(0),
                                'add_category' => $this->db->escape_like_str(0),
                                'all_category' => $this->db->escape_like_str(1),
                                'edit_delete_category' => $this->db->escape_like_str(0),
                                'add_books' => $this->db->escape_like_str(0),
                                'all_books' => $this->db->escape_like_str(1),
                                'edit_delete_books' => $this->db->escape_like_str(0),
                                'add_library_mem' => $this->db->escape_like_str(0),
                                'memb_list' => $this->db->escape_like_str(0),
                                'issu_return' => $this->db->escape_like_str(0),
                                'add_dormitories' => $this->db->escape_like_str(0),
                                'add_set_dormi' => $this->db->escape_like_str(0),
                                'set_member_bed' => $this->db->escape_like_str(0),
                                'dormi_report' => $this->db->escape_like_str(1),
                                'add_transport' => $this->db->escape_like_str(0),
                                'all_transport' => $this->db->escape_like_str(1),
                                'transport_edit_dele' => $this->db->escape_like_str(0),
                                'add_account_title' => $this->db->escape_like_str(0),
                                'edit_dele_acco' => $this->db->escape_like_str(0),
                                'trensection' => $this->db->escape_like_str(0),
                                'fee_collection' => $this->db->escape_like_str(0),
                                'all_slips' => $this->db->escape_like_str(0),
                                'own_slip' => $this->db->escape_like_str(1),
                                'slip_edit_delete' => $this->db->escape_like_str(0),
                                'pay_salary' => $this->db->escape_like_str(0),
                                'creat_notice' => $this->db->escape_like_str(0),
                                'send_message' => $this->db->escape_like_str(0),
                                'vendor' => $this->db->escape_like_str(0),
                                'delet_vendor' => $this->db->escape_like_str(0),
                                'add_inv_cat' => $this->db->escape_like_str(0),
                                'inve_item' => $this->db->escape_like_str(0),
                                'delete_inve_ite' => $this->db->escape_like_str(0),
                                'delete_inv_cat' => $this->db->escape_like_str(0),
                                'inve_issu' => $this->db->escape_like_str(0),
                                'delete_inven_issu' => $this->db->escape_like_str(0),
                                'check_leav_appli' => $this->db->escape_like_str(0),
                                'setting_manage_user' => $this->db->escape_like_str(0),
                                'other_setting' => $this->db->escape_like_str(0),
                                'front_setings' => $this->db->escape_like_str(0),
                            );
                            if ($this->db->insert('role_based_access', $student_access)) {
                                $data['success'] = '<div class="alert alert-info alert-dismissable admisionSucceassMessageFont">
                                                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                                                    <strong>Success!</strong> The student admitted successfully.
                                                            </div>';
                                //Load the admission form again for new student. 
                                $data['s_class'] = $this->common->getAllData('class');
                                $this->load->view('temp/header');
                                $this->load->view('add_new_student', $data);
                                $this->load->view('temp/footer');
                            }
                        }
                    }
                }
            }
        } else {
            $query = $this->common->countryPhoneCode();
            $data['countryPhoneCode'] = $query->countryPhonCode;
            $data['s_class'] = $this->common->getAllData('class');
            //display the create user form
            $this->load->view('temp/header');
            $this->load->view('add_new_student', $data);
            $this->load->view('temp/footer');
        }
    }*/

    // this function perform admission form info
    public function goForAdmissions(){
        $reg_id = $this->input->get('reg_id');  
        $query = $this->common->countryPhoneCode();
        $data['countryPhoneCode'] = $query->countryPhonCode;
        $data['s_class'] = $this->common->getAllData('class'); 
            //display the create user form
            $this->load->view('temp/header');
            $this->load->view('add_new_student', $data);
            $this->load->view('temp/footer');
    }
    
    // ajax call for data fetch add_new_student
    public function get_student_info(){
        $register_number = $_POST['register_number'];

        $reg_paid_status = $this->db->query("SELECT paid_status FROM register_pass WHERE reg_number='$register_number'");
            $data=$reg_paid_status->result_array();;
        
        if($data[0]['paid_status'] == 'Paid'){
            $query = $this->db->query("SELECT * FROM student_info WHERE registration_number='$register_number'")->row();
            if(!empty($query)){
                echo json_encode('This Student Is Already Admitted');
            }else{
                $query1 = $this->db->query("SELECT * FROM register_pass WHERE reg_number='$register_number'")->row();
                echo json_encode($query1);
            }
        }elseif ($data[0]['paid_status'] == 'unpaid'){
            echo json_encode('This Student Has Not Paid Admission Fee');
        }
    }
    //This function add teacher in this function
    function addTeacher() {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }
        if ($this->input->post('submit', TRUE)) {
            $this->load->database();
            $tables = $this->config->item('tables', 'ion_auth');
            $edu_1 = '';
            $edu_2 = '';
            $edu_3 = '';
            $edu_4 = '';
            $edu_5 = '';
            $dd_1 = $this->input->post('dd_1', TRUE);
            if (!empty($dd_1)) {
                $this->form_validation->set_rules('scu_1', 'School/College/University 1st fild', 'required');
                $this->form_validation->set_rules('subj_1', 'Subject  1st fild', 'required');
                $this->form_validation->set_rules('result_1', 'Result  1st fild', 'required');
                $this->form_validation->set_rules('paYear_1', 'Passing year 1st fild', 'required');
                $this->form_validation->set_rules('reg_1', 'Regular/Private 1st fild', 'required');
                $edu_1 = $this->input->post('dd_1', TRUE) . ',' . $this->input->post('scu_1', TRUE) . ',' . $this->input->post('subj_1', TRUE) . ',' . $this->input->post('result_1', TRUE) . ',' . $this->input->post('paYear_1', TRUE). ',' . $this->input->post('reg_1', TRUE);
            }

            $dd_2 = $this->input->post('dd_2', TRUE);
            if (!empty($dd_2)) {
                $this->form_validation->set_rules('scu_2', 'School/College/University 2st fild', 'required');
                $this->form_validation->set_rules('subj_2', 'Result  1st fild', 'required');
                $this->form_validation->set_rules('result_2', 'Result  2st fild', 'required');
                $this->form_validation->set_rules('paYear_2', 'Passing year 2st fild', 'required');
                $this->form_validation->set_rules('reg_2', 'Passing year 1st fild', 'required');
                $edu_2 = $this->input->post('dd_2', TRUE) . ',' . $this->input->post('scu_2', TRUE). ',' . $this->input->post('subj_2', TRUE) . ',' . $this->input->post('result_2', TRUE) . ',' . $this->input->post('paYear_2', TRUE). ',' . $this->input->post('reg_2', TRUE);
            }

            $dd_3 = $this->input->post('dd_3', TRUE);
            if (!empty($dd_3)) {
                $this->form_validation->set_rules('scu_3', 'School/College/University 3st fild', 'required');
                $this->form_validation->set_rules('subj_3', 'Subject  3rd fild', 'required');
                $this->form_validation->set_rules('result_3', 'Result  3rd fild', 'required');
                $this->form_validation->set_rules('paYear_3', 'Passing year 3rd fild', 'required');
                $this->form_validation->set_rules('reg_3', 'Passing year 1st fild', 'required');
                $edu_3 = $this->input->post('dd_3', TRUE) . ',' . $this->input->post('scu_3', TRUE). ',' . $this->input->post('subj_3', TRUE) . ',' . $this->input->post('result_3', TRUE) . ',' . $this->input->post('paYear_3', TRUE). ',' . $this->input->post('reg_3', TRUE);
            }

            $dd_4 = $this->input->post('dd_4', TRUE);
            if (!empty($dd_4)) {
                $this->form_validation->set_rules('scu_4', 'School/College/University 4st fild', 'required');
                $this->form_validation->set_rules('result_4', 'Result  4st fild', 'required');
                $this->form_validation->set_rules('paYear_4', 'Passing year 4st fild', 'required');
                $this->form_validation->set_rules('reg_4', 'Passing year 1st fild', 'required');
                $edu_4 = $this->input->post('dd_4', TRUE) . ',' . $this->input->post('scu_4', TRUE). ',' . $this->input->post('subj_4', TRUE) . ',' . $this->input->post('result_4', TRUE) . ',' . $this->input->post('paYear_4', TRUE). ',' . $this->input->post('reg_4', TRUE);
            }

            $dd_5 = $this->input->post('dd_5', TRUE);
            if (!empty($dd_5)) {
                $this->form_validation->set_rules('scu_5', 'School/College/University 5st fild', 'required');
                $this->form_validation->set_rules('result_5', 'Result  5st fild', 'required');
                $this->form_validation->set_rules('paYear_5', 'Passing year 5st fild', 'required');
                $this->form_validation->set_rules('reg_5', 'Passing year 1st fild', 'required');
                $edu_5 = $this->input->post('dd_5', TRUE) . ',' . $this->input->post('scu_5', TRUE). ',' . $this->input->post('subj_4', TRUE) . ',' . $this->input->post('result_5', TRUE) . ',' . $this->input->post('paYear_5', TRUE). ',' . $this->input->post('reg_5', TRUE);
            }
    //--------------------------------teacher Qualification-----------------------------------------
             $teaqual_1 = '';
            $teaqual_2 = '';
            $teaqual_3 = '';
            $qq_1 = $this->input->post('teaqual_1', TRUE);
            if (!empty($qq_1)) {
                $this->form_validation->set_rules('teaqual_1', 'Teacher Qualification 1st fild', 'required');
                $this->form_validation->set_rules('teayear_1', 'Passing Year  1st fild', 'required');
                $this->form_validation->set_rules('teaspec_1', 'Passing Year  1st fild', 'required');
                $this->form_validation->set_rules('scul_1', 'School/College/University 1st fild', 'required');
                $this->form_validation->set_rules('grade_1', 'Grade 1st fild', 'required');
                $teaqual_1 =$this->input->post('teaqual_1', TRUE) . ',' . $this->input->post('teayear_1', TRUE). ',' . $this->input->post('teaspec_1', TRUE) . ',' . $this->input->post('scul_1', TRUE) .',' . $this->input->post('grade_1', TRUE);
            }

            $qq_2 = $this->input->post('teaqual_2', TRUE);
             if (!empty($qq_2)) {
                $this->form_validation->set_rules('teaqual_2', 'Teacher Qualification 2nd fild', 'required');
                $this->form_validation->set_rules('teayear_2', 'Passing Year  2nd fild', 'required');
                $this->form_validation->set_rules('teaspec_2', 'Passing Year  1st fild', 'required');
                $this->form_validation->set_rules('scul_2', 'School/College/University 2nd fild', 'required');
                $this->form_validation->set_rules('grade_2', 'Grade 1st fild 2nd field', 'required');
                $teaqual_2 = $this->input->post('teaqual_2', TRUE) . ',' . $this->input->post('teayear_2', TRUE). ',' . $this->input->post('teaspec_2', TRUE) . ',' . $this->input->post('scul_2', TRUE) .',' . $this->input->post('grade_2', TRUE);
            }

            $qq_3 = $this->input->post('teaqual_3', TRUE);
            if (!empty($qq_3)) {
                $this->form_validation->set_rules('teaqual_3', 'Teacher Qualification 3rd fild', 'required');
                $this->form_validation->set_rules('teayear_3', 'Passing Year  3rd fild', 'required');
                $this->form_validation->set_rules('teaspec_3', 'Passing Year  1st fild', 'required');
                $this->form_validation->set_rules('scul_3', 'School/College/University 3rd fild', 'required');
                $this->form_validation->set_rules('grade_3', 'Grade 3rd fild', 'required');
                $teaqual_3 = $this->input->post('teaqual_3', TRUE) . ',' . $this->input->post('teayear_3', TRUE) . ',' . $this->input->post('teaspec_3', TRUE) . ',' . $this->input->post('scul_3', TRUE) .',' . $this->input->post('grade_3', TRUE);
            }
 //----------------------------------Serice Trannings---------------------------------------
             $cource_1 = '';
            $cource_2 = '';
            $cource_3 = '';
            $cc_1 = $this->input->post('cource_1', TRUE);
            if (!empty($cc_1)) {
                $this->form_validation->set_rules('cource_1', 'Cource/Workshop Attended 1st fild', 'required');
                $this->form_validation->set_rules('from_1', 'Start Year  1st fild', 'required');
                $this->form_validation->set_rules('toend_1', 'End Year 1st fild', 'required');
                $this->form_validation->set_rules('ins_1', 'School/College/University 1st fild', 'required');
                $cource_1 =$this->input->post('cource_1', TRUE) . ',' . $this->input->post('from_1', TRUE) . ',' . $this->input->post('toend_1', TRUE) . ',' . $this->input->post('ins_1', TRUE);
            }

            $cc_2 = $this->input->post('cource_2', TRUE);
             if (!empty($cc_2)) {
                $this->form_validation->set_rules('cource_2', 'Cource/Workshop Attended 2nd fild', 'required');
                $this->form_validation->set_rules('from_2', 'Start Year  2nd fild', 'required');
                $this->form_validation->set_rules('toend_2', 'End Year 2nd fild', 'required');
                $this->form_validation->set_rules('ins_2', 'School/College/University 3rd fild', 'required');
                $cource_2 = $this->input->post('cource_2', TRUE) . ',' . $this->input->post('from_2', TRUE) . ',' . $this->input->post('toend_2', TRUE) . ',' . $this->input->post('ins_2', TRUE) ;
            }

            $cc_3 = $this->input->post('cource_3', TRUE);
            if (!empty($cc_3)) {
                $this->form_validation->set_rules('cource_3', 'Cource/Workshop Attended 3rd fild', 'required');
                $this->form_validation->set_rules('from_3', 'Start Year  3rd fild', 'required');
                $this->form_validation->set_rules('toend_3', 'End Year 3rd fild', 'required');
                $this->form_validation->set_rules('ins_3', 'School/College/University 3rd fild', 'required');
                $cource_3 = $this->input->post('cource_3', TRUE) . ',' . $this->input->post('from_3', TRUE) . ',' . $this->input->post('toend_3', TRUE) . ',' . $this->input->post('ins_2', TRUE) ;
            }
 //--------------------- Teaching Experience------------------------------------------------------
             $institute_serve_1 = '';
            $institute_serve_2 = '';
            $institute_serve_3 = '';
            $ii_1 = $this->input->post('ins_serve_1', TRUE);
            if (!empty($ii_1)) {
                $this->form_validation->set_rules('ins_serve_1', 'Name Institite with Address 1st fild', 'required');
                $this->form_validation->set_rules('fromt_1', 'Start Year  1st fild', 'required');
                $this->form_validation->set_rules('toendt_1', 'End Year 1st fild', 'required');
                $this->form_validation->set_rules('class_taught_1', 'Classes Tausgh 1st fild', 'required');
                $this->form_validation->set_rules('sub_taught_1', 'Subjects Taught 1st fild', 'required');
                $institute_serve_1 = $this->input->post('ins_serve_1', TRUE) . ',' . $this->input->post('fromt_1', TRUE) . ',' . $this->input->post('toendt_1', TRUE) . ',' . $this->input->post('class_taught_1', TRUE). ',' . $this->input->post('sub_taught_1', TRUE);
            }

            $ii_2 = $this->input->post('ins_serve_2', TRUE);
             if (!empty($ii_2)) {
                $this->form_validation->set_rules('ins_serve_2', 'Name Institite with Address 2nd fild', 'required');
                $this->form_validation->set_rules('fromt_2', 'Start Year  2nd fild', 'required');
                $this->form_validation->set_rules('toendt_2', 'End Year 2nd fild', 'required');
                $this->form_validation->set_rules('class_taught_2', 'Classes Taught 2nd fild', 'required');
                $this->form_validation->set_rules('sub_taught_2', 'Subject Taught 2nd fild', 'required');

                $institute_serve_2 = $this->input->post('ins_serve_2', TRUE) . ',' . $this->input->post('fromt_2', TRUE) . ',' . $this->input->post('toendt_2', TRUE) . ',' . $this->input->post('class_taught_2', TRUE) . ',' . $this->input->post('sub_taught_2', TRUE) ;
            }

            $ii_3 = $this->input->post('ins_serve_3', TRUE);
            if (!empty($ii_3)) {
                $this->form_validation->set_rules('ins_serve_3', 'Name Institite with Address 3rd fild', 'required');
                $this->form_validation->set_rules('fromt_3', 'Start Year  3rd fild', 'required');
                $this->form_validation->set_rules('toendt_3', 'End Year 3rd fild', 'required');
                $this->form_validation->set_rules('class_taught_3', 'Classes Taught 3rd fild', 'required');
                $this->form_validation->set_rules('sub_taught_3', 'School Taught 3rd fild', 'required');
                $institute_serve_3 = $this->input->post('ins_serve_3', TRUE) . ',' . $this->input->post('fromt_3', TRUE) . ',' . $this->input->post('toendt_3', TRUE) . ',' . $this->input->post('class_taught_3', TRUE) . ',' . $this->input->post('sub_taught_3', TRUE);
            }
    //---------------------------------------- Adminstrtive Experience--------------------------------->
             $admin_serve_1 = '';
            $admin_serve_2 = '';
            $admin_serve_3 = '';
            $aa_1 = $this->input->post('ins_servea_1', TRUE);
            if (!empty($ii_1)) {
                $this->form_validation->set_rules('ins_servea_1', 'Administrative Service 1st fild', 'required');
                $this->form_validation->set_rules('froma_1', 'Start Year  1st fild', 'required');
                $this->form_validation->set_rules('toenda_1', 'End Year 1st fild', 'required');
                $this->form_validation->set_rules('posi_1', 'Your Position 1st fild', 'required');
                $admin_serve_1 = $this->input->post('ins_servea_1', TRUE) . ',' . $this->input->post('froma_1', TRUE) . ',' . $this->input->post('toenda_1', TRUE) . ',' . $this->input->post('posi_1', TRUE);
            }

            $aa_2 = $this->input->post('ins_servea_2', TRUE);
             if (!empty($aa_2)) {
                $this->form_validation->set_rules('ins_servea_2', 'Administrative Service 2nd fild', 'required');
                $this->form_validation->set_rules('froma_2', 'Start Year  2nd fild', 'required');
                $this->form_validation->set_rules('toenda_2', 'End Year 2nd fild', 'required');
                $this->form_validation->set_rules('posi_2', 'Your Position  1st fild', 'required');

                $admin_serve_2 = $this->input->post('ins_servea_2', TRUE) . ',' . $this->input->post('froma_2', TRUE) . ',' . $this->input->post('toenda_2', TRUE) . ',' . $this->input->post('posi_2', TRUE) ;
            }

            $aa_3 = $this->input->post('ins_servea_3', TRUE);
            if (!empty($aa_3)) {
                $this->form_validation->set_rules('ins_servea_3', 'Administrative Service 3rd fild', 'required');
                $this->form_validation->set_rules('froma_3', 'Passing Year  3rd fild', 'required');
                $this->form_validation->set_rules('toenda_3', 'End Year 3rd fild', 'required');
                $this->form_validation->set_rules('posi_3', 'Your Position 1st fild', 'required');
               
                $admin_serve_3 =  $this->input->post('ins_servea_3', TRUE) . ',' . $this->input->post('froma_3', TRUE) . ',' . $this->input->post('toenda_3', TRUE) . ',' . $this->input->post('posi_3', TRUE);
            }
      
     //------------------------------------------Refrence ------------------------>
             $orgname_1 = '';
            $orgname_2 = '';
            $orgname_3 = '';
            $oo_1 = $this->input->post('orgname_1', TRUE);
            if (!empty($oo_1)) {
                $this->form_validation->set_rules('orgname_1', 'Organization Name 1st fild', 'required');
                $this->form_validation->set_rules('orgadd_1', 'Organization Address  1st fild', 'required');
                $this->form_validation->set_rules('orgtel_1', 'Organization Telephone 1st fild', 'required');
                $orgname_1 = $this->input->post('orgname_1', TRUE) . ',' . $this->input->post('orgadd_1', TRUE) . ',' . $this->input->post('orgtel_1', TRUE) ;
            }

            $oo_2 = $this->input->post('orgname_2', TRUE);
             if (!empty($oo_2)) {
               $this->form_validation->set_rules('orgname_2', 'Organization Name 1st fild', 'required');
                $this->form_validation->set_rules('orgadd_2', 'Organization address Year  1st fild', 'required');
                $this->form_validation->set_rules('orgtel_2', 'Organization telephone 1st fild', 'required');
                $orgname_2 =  $this->input->post('orgname_2', TRUE) . ',' . $this->input->post('orgadd_2', TRUE) . ',' . $this->input->post('orgtel_2', TRUE) ;
            }

            $oo_3 = $this->input->post('orgname_3', TRUE);
            if (!empty($oo_3)) {
               $this->form_validation->set_rules('orgname_3', 'Organization Name 1st fild', 'required');
                $this->form_validation->set_rules('orgadd_3', 'Organization address   1st fild', 'required');
                $this->form_validation->set_rules('orgtel_3', 'Organization Telephone 1st fild', 'required');
                $orgname_3 =  $this->input->post('orgname_3', TRUE) . ',' . $this->input->post('orgadd_3', TRUE) . ',' . $this->input->post('orgtel_3', TRUE) ;
            }
     //----------------------------------------- Office Use Only---------------------->
            $username = $this->input->post('first_name'); //. ' ' . $this->input->post('last_name');
            $email = strtolower($this->input->post('email', TRUE));
            $password = $this->input->post('password', TRUE);
            $phone = $this->input->post('phoneCode', TRUE) . '' . $this->input->post('phone', TRUE);

            //here is upload the teacher's photo.
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '10000';
            $config['max_width'] = '10240';
            $config['max_height'] = '7680';
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->do_upload();
            $uploadFileInfo = $this->upload->data();
             //here is upload the teacher's other documents pics.
            $config['upload_path'] = './assets/uploads/teachers_documents';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '10000';
            $config['max_width'] = '10240';
            $config['max_height'] = '7680';
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->do_upload1();
            $uploadFileInfo1 = $this->upload->data();
              //here is upload the teacher's other documents pics.
            $config['upload_path'] = './assets/uploads/teachers_documents';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '10000';
            $config['max_width'] = '10240';
            $config['max_height'] = '7680';
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->do_upload2();
            $uploadFileInfo2 = $this->upload->data();
              //here is upload the teacher's other documents pics.
            $config['upload_path'] = './assets/uploads/teachers_documents';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '10000';
            $config['max_width'] = '10240';
            $config['max_height'] = '7680';
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->do_upload3();
            $uploadFileInfo3 = $this->upload->data();

            //This array information's are sending to "user" table as a core information as a user this system.
            $additional_data = array(
                'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
                'cnic' => $this->db->escape_like_str($this->input->post('cnic', TRUE)),
                'phone' => $this->db->escape_like_str($phone),
                'profile_image' => $this->db->escape_like_str($uploadFileInfo['file_name']),
                'password' => $this->db->escape_like_str('password'),
                'leave_status' => $this->db->escape_like_str('Available'),
                'user_status' => $this->db->escape_like_str('Employee')
            );

            $group_ids = array(
                'group_id' => $this->db->escape_like_str(4)
            );
            if ($this->ion_auth->register($username, $password, $email, $additional_data, $group_ids)) {
                //This the next user id in users table. If we " -1 " from it we can get current user id 
                $userid = $this->common->usersId();
                //This array information's are sending to "teachers_info" table.
                $teachersInfo = array(
                    'user_id' => $this->db->escape_like_str($userid),
                    'fullname' => $this->db->escape_like_str($username),
					'dempass' => $this->db->escape_like_str($this->input->post('password', TRUE)),
                    'farther_name' => $this->db->escape_like_str($this->input->post('father_name', TRUE)),
                    'position_applied_for' => $this->db->escape_like_str($this->input->post('applied_posi', TRUE)),
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
                    'teachers_photo' => $this->db->escape_like_str($uploadFileInfo['file_name']),
                    'recommendation' => $this->db->escape_like_str($this->input->post('recommendation', TRUE)),
                    'teachers_degree' => $this->db->escape_like_str($uploadFileInfo1['file_name']),
                    'teachers_cnic' => $this->db->escape_like_str($uploadFileInfo2['file_name']),
                    'teachers_eoib' => $this->db->escape_like_str($uploadFileInfo3['file_name']),
                    'cv' => $this->db->escape_like_str($this->input->post('cv', TRUE)),
                    'educational_certificat' => $this->db->escape_like_str($this->input->post('educational_certificat', TRUE)),
                    'exprieance_certificatte' => $this->db->escape_like_str($this->input->post('exc', TRUE)),
                    'files_info' => $this->db->escape_like_str($this->input->post('submited_info', TRUE)),
                    'phone' => $this->db->escape_like_str($phone),
                );

                $teacher_access = array(
                    'user_id' => $this->db->escape_like_str($userid),
                    'group_id' => $this->db->escape_like_str(4),
                    'das_top_info' => $this->db->escape_like_str(1),
                    'das_grab_chart' => $this->db->escape_like_str(0),
                    'das_class_info' => $this->db->escape_like_str(1),
                    'das_message' => $this->db->escape_like_str(1),
                    'das_employ_attend' => $this->db->escape_like_str(0),
                    'das_notice' => $this->db->escape_like_str(1),
                    'das_calender' => $this->db->escape_like_str(1),
                    'admission' => $this->db->escape_like_str(0),
                    'all_student_info' => $this->db->escape_like_str(1),
                    'stud_edit_delete' => $this->db->escape_like_str(0),
                    'stu_own_info' => $this->db->escape_like_str(0),
                    'teacher_info' => $this->db->escape_like_str(0),
                    'add_teacher' => $this->db->escape_like_str(0),
                    'teacher_details' => $this->db->escape_like_str(0),
                    'teacher_edit_delete' => $this->db->escape_like_str(0),
                    'all_parents_info' => $this->db->escape_like_str(1),
                    'own_parents_info' => $this->db->escape_like_str(0),
                    'make_parents_id' => $this->db->escape_like_str(0),
                    'parents_edit_dlete' => $this->db->escape_like_str(0),
                    'add_new_class' => $this->db->escape_like_str(0),
                    'all_class_info' => $this->db->escape_like_str(1),
                    'class_details' => $this->db->escape_like_str(1),
                    'class_delete' => $this->db->escape_like_str(0),
                    'class_promotion' => $this->db->escape_like_str(0),
                    'assin_optio_sub' => $this->db->escape_like_str(0),
                    'add_class_routine' => $this->db->escape_like_str(0),
                    'own_class_routine' => $this->db->escape_like_str(0),
                    'all_class_routine' => $this->db->escape_like_str(1),
                    'rutin_edit_delete' => $this->db->escape_like_str(0),
                    'attendance_preview' => $this->db->escape_like_str(1),
                    'take_studence_atten' => $this->db->escape_like_str(1),
                    'edit_student_atten' => $this->db->escape_like_str(0),
                    'add_employee' => $this->db->escape_like_str(0),
                    'employee_list' => $this->db->escape_like_str(0),
                    'employ_attendance' => $this->db->escape_like_str(0),
                    'empl_atte_view' => $this->db->escape_like_str(0),
                    'add_subject' => $this->db->escape_like_str(0),
                    'all_subject' => $this->db->escape_like_str(1),
                    'make_suggestion' => $this->db->escape_like_str(1),
                    'all_suggestion' => $this->db->escape_like_str(1),
                    'own_suggestion' => $this->db->escape_like_str(0),
                    'add_exam_gread' => $this->db->escape_like_str(0),
                    'exam_gread' => $this->db->escape_like_str(1),
                    'add_exam_routin' => $this->db->escape_like_str(0),
                    'all_exam_routine' => $this->db->escape_like_str(1),
                    'own_exam_routine' => $this->db->escape_like_str(0),
                    'exam_attend_preview' => $this->db->escape_like_str(1),
                    'approve_result' => $this->db->escape_like_str(0),
                    'view_result' => $this->db->escape_like_str(1),
                    'all_mark_sheet' => $this->db->escape_like_str(1),
                    'own_mark_sheet' => $this->db->escape_like_str(0),
                    'take_exam_attend' => $this->db->escape_like_str(1),
                    'change_exam_attendance' => $this->db->escape_like_str(0),
                    'make_result' => $this->db->escape_like_str(1),
                    'add_category' => $this->db->escape_like_str(0),
                    'all_category' => $this->db->escape_like_str(1),
                    'edit_delete_category' => $this->db->escape_like_str(0),
                    'add_books' => $this->db->escape_like_str(0),
                    'all_books' => $this->db->escape_like_str(1),
                    'edit_delete_books' => $this->db->escape_like_str(0),
                    'add_library_mem' => $this->db->escape_like_str(0),
                    'memb_list' => $this->db->escape_like_str(0),
                    'issu_return' => $this->db->escape_like_str(0),
                    'add_dormitories' => $this->db->escape_like_str(0),
                    'add_set_dormi' => $this->db->escape_like_str(0),
                    'set_member_bed' => $this->db->escape_like_str(0),
                    'dormi_report' => $this->db->escape_like_str(1),
                    'student_reports' => $this->db->escape_like_str(0),
                    'add_transport' => $this->db->escape_like_str(0),
                    'all_transport' => $this->db->escape_like_str(1),
                    'transport_edit_dele' => $this->db->escape_like_str(0),
                    'add_account_title' => $this->db->escape_like_str(0),
                    'edit_dele_acco' => $this->db->escape_like_str(0),
                    'trensection' => $this->db->escape_like_str(0),
                    'fee_collection' => $this->db->escape_like_str(1),
                    'all_slips' => $this->db->escape_like_str(1),
                    'own_slip' => $this->db->escape_like_str(0),
                    'slip_edit_delete' => $this->db->escape_like_str(0),
                    'pay_salary' => $this->db->escape_like_str(0),
                    'creat_notice' => $this->db->escape_like_str(0),
                    'send_message' => $this->db->escape_like_str(1),
                    'vendor' => $this->db->escape_like_str(0),
                    'delet_vendor' => $this->db->escape_like_str(0),
                    'add_inv_cat' => $this->db->escape_like_str(0),
                    'inve_item' => $this->db->escape_like_str(0),
                    'delete_inve_ite' => $this->db->escape_like_str(0),
                    'delete_inv_cat' => $this->db->escape_like_str(0),
                    'inve_issu' => $this->db->escape_like_str(0),
                    'delete_inven_issu' => $this->db->escape_like_str(0),
                    'check_leav_appli' => $this->db->escape_like_str(0),
                    'setting_manage_user' => $this->db->escape_like_str(0),
                    'setting_accounts' => $this->db->escape_like_str(0),
                    'other_setting' => $this->db->escape_like_str(0),
                    'front_setings' => $this->db->escape_like_str(0),
                );
                $this->db->insert('teachers_info', $teachersInfo);
                if ($this->db->insert('role_based_access', $teacher_access)) {
                    //Load the Teachers Information's page after Add New Teacher.
                    redirect('teachers/allTeachers', 'refresh');
                }
            } else {
                $query = $this->common->countryPhoneCode();
                $data['countryPhoneCode'] = $query->countryPhonCode;
                //display the create user form
                $this->load->view('temp/header');
                $this->load->view('add_new_teacher', $data);
                $this->load->view('temp/footer');
            }
        } else {
            $query = $this->common->countryPhoneCode();
            $data['countryPhoneCode'] = $query->countryPhonCode;
            //display the create user form
            $this->load->view('temp/header');
            $this->load->view('add_new_teacher', $data);
            $this->load->view('temp/footer');
        }
    }

    //This function is returning student id and roll number by class title , runing year
    public function student_info() {
        $Class_id = $this->input->get('q', TRUE);
        $query = $this->common->getWhere('class', 'id', $Class_id);
        foreach ($query as $row) {
            $data = $row;
        }
        $Class_code = $data['id'];

        //making here Class Section fild.
        if (!empty($data['section'])) {
            $section = $data['section'];
            $sectionArray = explode(",", $section);

            echo '<div class="form-group">
                        <label class="col-md-3 control-label">Section <span class="requiredStar"> * </span></label>
                        <div class="col-md-6">
                            <select name="section" class="form-control">
                                <option value="">Select one</option>';
            foreach ($sectionArray as $sec) {
                echo '<option value="' . $sec . '">' . $sec . '</option>';
            }
            echo '</select></div>
                    </div>';
        } else {
            $section = 'This class has no section.';
            echo '<div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                        <div class="alert alert-warning">
                                <strong>Info!</strong> ' . $section . '
                        </div></div></div>';
        }

        //making here StudentID Unick number.
        if (strlen($Class_code) == 1) {
            $classId = '0' . $Class_code;
        } elseif (strlen($Class_code) == 2) {
            $classId = $Class_code;
        }
        $roll = $this->common->rollNumber($Class_id);
        if (strlen($roll) == 1) {
            $rollNumber = '000' . $roll;
        } elseif (strlen($roll) == 2) {
            $rollNumber = '00' . $roll;
        } elseif (strlen($roll) == 3) {
            $rollNumber = '0' . $roll;
        } elseif (strlen($roll) == 4) {
            $rollNumber = $roll;
        }
        // $finalStudentId = date("Y") . $classId . $rollNumber;
        $finalStudentId = $classId . $rollNumber;
        echo '<div class="form-group">
                    <label class="col-md-3 control-label">Student\'s ID <span class="requiredStar"> * </span></label>
                    <div class="col-md-6">
                        <input type="text" name="student_id" class="form-control" value="' . $finalStudentId . '" readonly>
                    </div>
                </div>';


        //making here Class Roll Number fild.
        echo '<div class="form-group">
                    <label class="col-md-3 control-label">Roll Number <span class="requiredStar"> * </span></label>
                    <div class="col-md-6">
                        <input type="text" name="roll_number" class="form-control" value="' . $rollNumber . '" readonly>
                    </div>
                </div>';
    }

    //This function is using for add new parents
    function addParents() {
        if ($this->input->post('submit', TRUE)) {
            $username = $this->input->post('first_name') . ' ' . $this->input->post('last_name');
            $email = strtolower($this->input->post('email', TRUE));
            $password = $this->input->post('password', TRUE);
            //Here is uploading the student's photo.
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '10000';
            $config['max_width'] = '10240';
            $config['max_height'] = '7680';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->do_upload();
            $uploadFileInfo = $this->upload->data();
            $this->upload->display_errors('<p>', '</p>');

            $phone =$this->input->post('phone', TRUE);
            $year=date('Y');
            $additional_data = array(
                'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
                'last_name' => $this->db->escape_like_str($this->input->post('last_name', TRUE)),
                'phone' => $this->db->escape_like_str($phone),
                'profile_image' => $this->db->escape_like_str($uploadFileInfo['file_name'])
            );
            $group_ids = array(
                'group_id' => $this->db->escape_like_str(5)
            );
            if ($this->ion_auth->register($username, $password, $email, $additional_data, $group_ids)) {
                //This the next user id in users table. If we " -1 " from it we can get current user id 
                $userid = $this->common->usersId();
                $additionalData1 = array(
                    'year'=>$this->db->escape_like_str($year),
                    'user_id' => $this->db->escape_like_str($userid),
                    'roll_number' => $this->db->escape_like_str($this->input->post('roll_number', TRUE)),
                    'student_id' => $this->db->escape_like_str($this->input->post('studentId', TRUE)),
                    'class_id' => $this->db->escape_like_str($this->input->post('class_id', TRUE)),
                    'class_title' => $this->db->escape_like_str($this->input->post('class_title', TRUE)),
                    'section' => $this->db->escape_like_str($this->input->post('section', TRUE)),
                    'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
                    'last_name' => $this->db->escape_like_str($this->input->post('last_name', TRUE)),
                    'parents_name' => $this->db->escape_like_str($username),
                    'relation' => $this->db->escape_like_str($this->input->post('guardianRelation', TRUE)),
                    'email' => $this->db->escape_like_str($this->input->post('email', TRUE)),
                    'phone' => $this->db->escape_like_str($phone),
                    'photo'=> $this->db->escape_like_str($uploadFileInfo['file_name']),
                    'dempass'=> $this->db->escape_like_str($password)
                );
                $this->db->insert('parents_info', $additionalData1);
                $parents_access = array(
                    'user_id' => $this->db->escape_like_str($userid),
                    'group_id' => $this->db->escape_like_str(5),
                    'das_top_info' => $this->db->escape_like_str(0),
                    'das_grab_chart' => $this->db->escape_like_str(0),
                    'das_class_info' => $this->db->escape_like_str(0),
                    'das_message' => $this->db->escape_like_str(1),
                    'das_employ_attend' => $this->db->escape_like_str(0),
                    'das_notice' => $this->db->escape_like_str(1),
                    'das_calender' => $this->db->escape_like_str(1),
                    'admission' => $this->db->escape_like_str(0),
                    'all_student_info' => $this->db->escape_like_str(0),
                    'stud_edit_delete' => $this->db->escape_like_str(0),
                    'stu_own_info' => $this->db->escape_like_str(1),
                    'teacher_info' => $this->db->escape_like_str(1),
                    'add_teacher' => $this->db->escape_like_str(0),
                    'teacher_details' => $this->db->escape_like_str(0),
                    'teacher_edit_delete' => $this->db->escape_like_str(0),
                    'all_parents_info' => $this->db->escape_like_str(0),
                    'own_parents_info' => $this->db->escape_like_str(1),
                    'make_parents_id' => $this->db->escape_like_str(0),
                    'parents_edit_dlete' => $this->db->escape_like_str(0),
                    'add_new_class' => $this->db->escape_like_str(0),
                    'all_class_info' => $this->db->escape_like_str(0),
                    'class_details' => $this->db->escape_like_str(0),
                    'class_delete' => $this->db->escape_like_str(0),
                    'class_promotion' => $this->db->escape_like_str(0),
                    'assin_optio_sub' => $this->db->escape_like_str(0),
                    'add_class_routine' => $this->db->escape_like_str(0),
                    'own_class_routine' => $this->db->escape_like_str(1),
                    'all_class_routine' => $this->db->escape_like_str(0),
                    'rutin_edit_delete' => $this->db->escape_like_str(0),
                    'attendance_preview' => $this->db->escape_like_str(0),
                    'take_studence_atten' => $this->db->escape_like_str(0),
                    'edit_student_atten' => $this->db->escape_like_str(0),
                    'add_employee' => $this->db->escape_like_str(0),
                    'employee_list' => $this->db->escape_like_str(0),
                    'employ_attendance' => $this->db->escape_like_str(0),
                    'empl_atte_view' => $this->db->escape_like_str(0),
                    'add_subject' => $this->db->escape_like_str(0),
                    'all_subject' => $this->db->escape_like_str(0),
                    'make_suggestion' => $this->db->escape_like_str(0),
                    'all_suggestion' => $this->db->escape_like_str(0),
                    'own_suggestion' => $this->db->escape_like_str(1),
                    'add_exam_gread' => $this->db->escape_like_str(0),
                    'exam_gread' => $this->db->escape_like_str(0),
                    'add_exam_routin' => $this->db->escape_like_str(0),
                    'all_exam_routine' => $this->db->escape_like_str(0),
                    'own_exam_routine' => $this->db->escape_like_str(1),
                    'exam_attend_preview' => $this->db->escape_like_str(0),
                    'approve_result' => $this->db->escape_like_str(0),
                    'view_result' => $this->db->escape_like_str(1),
                    'all_mark_sheet' => $this->db->escape_like_str(0),
                    'own_mark_sheet' => $this->db->escape_like_str(1),
                    'take_exam_attend' => $this->db->escape_like_str(0),
                    'change_exam_attendance' => $this->db->escape_like_str(0),
                    'make_result' => $this->db->escape_like_str(0),
                    'add_category' => $this->db->escape_like_str(0),
                    'all_category' => $this->db->escape_like_str(1),
                    'edit_delete_category' => $this->db->escape_like_str(0),
                    'add_books' => $this->db->escape_like_str(0),
                    'all_books' => $this->db->escape_like_str(1),
                    'edit_delete_books' => $this->db->escape_like_str(0),
                    'add_library_mem' => $this->db->escape_like_str(0),
                    'memb_list' => $this->db->escape_like_str(0),
                    'issu_return' => $this->db->escape_like_str(0),
                    'add_dormitories' => $this->db->escape_like_str(0),
                    'add_set_dormi' => $this->db->escape_like_str(0),
                    'set_member_bed' => $this->db->escape_like_str(0),
                    'dormi_report' => $this->db->escape_like_str(1),
                    'student_reports' => $this->db->escape_like_str(0),
                    'add_transport' => $this->db->escape_like_str(0),
                    'all_transport' => $this->db->escape_like_str(1),
                    'transport_edit_dele' => $this->db->escape_like_str(0),
                    'add_account_title' => $this->db->escape_like_str(0),
                    'edit_dele_acco' => $this->db->escape_like_str(0),
                    'trensection' => $this->db->escape_like_str(0),
                    'fee_collection' => $this->db->escape_like_str(0),
                    'all_slips' => $this->db->escape_like_str(0),
                    'own_slip' => $this->db->escape_like_str(1),
                    'slip_edit_delete' => $this->db->escape_like_str(0),
                    'pay_salary' => $this->db->escape_like_str(0),
                    'creat_notice' => $this->db->escape_like_str(0),
                    'send_message' => $this->db->escape_like_str(0),
                    'vendor' => $this->db->escape_like_str(0),
                    'delet_vendor' => $this->db->escape_like_str(0),
                    'add_inv_cat' => $this->db->escape_like_str(0),
                    'inve_item' => $this->db->escape_like_str(0),
                    'delete_inve_ite' => $this->db->escape_like_str(0),
                    'delete_inv_cat' => $this->db->escape_like_str(0),
                    'inve_issu' => $this->db->escape_like_str(0),
                    'delete_inven_issu' => $this->db->escape_like_str(0),
                    'check_leav_appli' => $this->db->escape_like_str(0),
                    'setting_manage_user' => $this->db->escape_like_str(0),
                    'setting_accounts' => $this->db->escape_like_str(0),
                    'other_setting' => $this->db->escape_like_str(0),
                    'front_setings' => $this->db->escape_like_str(0),
                );
                if ($this->db->insert('role_based_access', $parents_access)) {
                    //check to see if we are creating the user
                    //redirect them back to the admin page
                    $this->session->set_flashdata('message', $this->ion_auth->messages());

                    //redirect("parents/parentsInformation", 'refresh');

                    $data['s_class'] = $this->common->getAllData('class');
                    $data['success'] = '<div class="col-md-12"><div class="alert alert-info alert-dismissable admisionSucceassMessageFont">
                                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                                        <strong>Success!</strong> The parents profile made successfully.
                                                </div></div>';
                    $this->load->view('temp/header');
                    $this->load->view('parents', $data);
                    $this->load->view('temp/footer');
                }
            }
        } else {
            $query = $this->common->countryPhoneCode();
            $data['countryPhoneCode'] = $query->countryPhonCode;
            $data['s_class'] = $this->common->getAllData('class');
            $this->load->view('temp/header');
            $this->load->view('makeProfile', $data);
            $this->load->view('temp/footer');
        }
    }

    //This function will give the student information from studentID
    public function studentInfoById() {
        $studentId = $this->input->get('q', TRUE);
        $query = $this->common->stuInfoId($studentId);
    if (empty($query)) {
            echo '<div class="form-group">
                    <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                        <div class="alert alert-danger">
                            <strong>Info:</strong> This student ID <strong>' . $studentId . '</strong> is not matching in our student\'s list.
                    </div></div></div>';
    } else {
        if(!empty($query)){
            $q=$this->db->query("SELECT student_id FROM student_info WHERE student_id='$studentId' AND status='Schoolleft'");
            $q=$q->result_array();
          if($q){
             echo '<div class="form-group">
                <label class="col-md-3 control-label"></label>
                    <div class="col-md-6">
                    <div class="alert alert-danger">
                        <strong>Info:</strong> This Student ID <strong>' . $studentId . '</strong> Left out Our School.
                </div></div></div>';
          }else{
            $query1=$this->db->query("SELECT student_id FROM parents_info WHERE student_id='$studentId'");
            $data=$query1->result_array();
            if(!empty($data)){
                echo '<div class="form-group">
                <label class="col-md-3 control-label"></label>
                    <div class="col-md-6">
                    <div class="alert alert-danger">
                        <strong>Info:</strong> This Student ID <strong>' . $studentId . '</strong> <br><strong>Parents</strong> information is already access list.
                </div></div></div>';
            }
            else{
                echo '<div class="col-md-9 col-md-offset-1 stuInfoIdBox">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Student\'s Name </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="studentName" value="' . $query->student_nam . '" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Father\'s Name </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="fahtername" value="' . $query->farther_name . '" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Class </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="class_title" value="' . $this->common->class_title($query->class_id) . '" readonly>
                            </div>
                        </div>
                        <input type="hidden" name="class_id" value="' . $query->class_id . '">
                        <input type="hidden" name="roll_number" value="' . $query->roll_number . '">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Section </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="section" value="' . $query->section . '" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> '. lang("par_gafn").' </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="' . $query->guardian_first_name . '" name="first_name" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> '. lang("par_galn").' </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="' . $query->guardian_last_name . '" name="last_name" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Guardian Relation </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="guardianRelation" value="' . $query->guardian_relationship . '" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Guardian Mobile </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="phone" value="' . $query->guardian_mobile . '" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <img src="assets/uploads/' . $query->student_photo . '" class="img-responsive" alt=""><br>
                    </div>
                </div>';
                }
              }
            }    
        }
    }

    //Whene give the student id from the frontend input file.
    //Then this function return student information
//    public function ajaxStudentInfo() {
//        $classTitle = $this->input->get('q', TRUE);
//        $query = $this->common->getWhere('student_info', 'class', $classTitle);
//        foreach ($query as $row) {
//            $data[] = $row;
//        }
//        if (!empty($data)) {
//            echo '<div class="form-group">
//                        <label class="col-md-3 control-label"></label>
//                        <div class="col-md-6">
//                            <select name="studentID" class="form-control">
//                                <option value="all">Select Student ID</option>';
//            foreach ($data as $sec) {
//                echo '<option value="' . $sec['student_id'] . '">' . $sec['student_nam'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ID - <span>' . $sec['student_id'] . '</span></option>';
//            }
//            echo '</select></div>
//                    </div>';
//        } else {
//            echo '<div class="form-group">
//                    <label class="col-md-3 control-label"></label>
//                        <div class="col-md-6">
//                        <div class="alert alert-danger">
//                            <strong>Info:</strong> This Class has no student.
//                    </div></div></div>';
//        }
//    }

    //This function will add new users in this system as Accountent,Libreament &Drivers etc
    public function addNewUsers() {
        if ($this->input->post('submit', TRUE)) {
            $this->load->database();
            $tables = $this->config->item('tables', 'ion_auth');
            $edu_1 = '';
            $edu_2 = '';
            $edu_3 = '';
            $edu_4 = '';
            $edu_5 = '';
            $dd_1 = $this->input->post('dd_1', TRUE);
            if (!empty($dd_1)) { 
                $edu_1 = $this->input->post('dd_1', TRUE) . ',' . $this->input->post('scu_1', TRUE) . ',' . $this->input->post('result_1', TRUE) . ',' . $this->input->post('paYear_1', TRUE);
            }

            $dd_2 = $this->input->post('dd_2', TRUE);
            if (!empty($dd_2)) { 
                $edu_2 = $this->input->post('dd_2', TRUE) . ',' . $this->input->post('scu_2', TRUE) . ',' . $this->input->post('result_2', TRUE) . ',' . $this->input->post('paYear_2', TRUE);
            }

            $dd_3 = $this->input->post('dd_3', TRUE);
            if (!empty($dd_3)) { 
                $edu_3 = $this->input->post('dd_3', TRUE) . ',' . $this->input->post('scu_3', TRUE) . ',' . $this->input->post('result_3', TRUE) . ',' . $this->input->post('paYear_3', TRUE);
            }

            $dd_4 = $this->input->post('dd_4', TRUE);
            if (!empty($dd_4)) { 
                $edu_4 = $this->input->post('dd_4', TRUE) . ',' . $this->input->post('scu_4', TRUE) . ',' . $this->input->post('result_4', TRUE) . ',' . $this->input->post('paYear_4', TRUE);
            }

            $dd_5 = $this->input->post('dd_5', TRUE);
            if (!empty($dd_5)) {
                $edu_5 = $this->input->post('dd_5', TRUE) . ',' . $this->input->post('scu_5', TRUE) . ',' . $this->input->post('result_5', TRUE) . ',' . $this->input->post('paYear_5', TRUE);
            }

            $username = $this->input->post('first_name') . ' ' . $this->input->post('last_name');
            $email = strtolower($this->input->post('email', TRUE));
            $password = $this->input->post('password', TRUE);
            $phone = $this->input->post('phoneCode', TRUE) . '' . $this->input->post('phone', TRUE);

            //here is upload the teacher's photo.
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '10000';
            $config['max_width'] = '10240';
            $config['max_height'] = '7680';
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->do_upload();
            $uploadFileInfo = $this->upload->data();

            //This array information's are sending to "user" table as a core information as a user this system.
            $additional_data = array(
                'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
                'last_name' => $this->db->escape_like_str($this->input->post('last_name', TRUE)),
                'phone' => $this->db->escape_like_str($phone),
                'profile_image' => $this->db->escape_like_str($uploadFileInfo['file_name']),
                'leave_status' => $this->db->escape_like_str('Available'),
                'user_status' => $this->db->escape_like_str('Employee'),
                'status' => $this->db->escape_like_str($this->input->post('status', TRUE)),
            );

            $group_ids = array(
                'group_id' => $this->db->escape_like_str($this->input->post('group', TRUE))
            );
        $groupId= $this->input->post('group', TRUE);
        $query2 = $this->db->query("SELECT * FROM group_based_access where group_id= $groupId");
        $group_data=$query2->result_array();
            if(empty($group_data)){
                                       echo "Assign the user group roll first";
            } else{ 
                foreach ($group_data as $key) {
                    # code...
                }
                if ($this->ion_auth->register($username, $password, $email, $additional_data, $group_ids)) {
                    //This the next user id in users table. If we " -1 " from it we can get current user id 
                    $userid = $this->common->usersId();
                    //This array information's are sending to "teachers_info" table.
                    $additional_data2 = array(
                        'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
                        'last_name' => $this->db->escape_like_str($this->input->post('last_name', TRUE)),
                        'user_id' => $this->db->escape_like_str($userid),
                        'full_name' => $this->db->escape_like_str($username),
                        'farther_name' => $this->db->escape_like_str($this->input->post('father_name', TRUE)),
                        'dempass' => $this->db->escape_like_str($this->input->post('password', TRUE)),
                        'mother_name' => $this->db->escape_like_str($this->input->post('mother_name', TRUE)),
                        'birth_date' => $this->db->escape_like_str($this->input->post('birthdate', TRUE)),
                        'sex' => $this->db->escape_like_str($this->input->post('sex', TRUE)),
                        'present_address' => $this->db->escape_like_str($this->input->post('present_address', TRUE)),
                        'permanent_address' => $this->db->escape_like_str($this->input->post('permanent_address', TRUE)),
                        'group_id' => $this->db->escape_like_str($this->input->post('group', TRUE)),
                        'employ_id' => $this->db->escape_like_str($this->input->post('employ_id', TRUE)),
                        'emp_roll' => $this->db->escape_like_str($this->input->post('emp_roll', TRUE)), 
                        'working_hour' => $this->db->escape_like_str($this->input->post('workingHoure', TRUE)),
                        'educational_qualification_1' => $this->db->escape_like_str($edu_1),
                        'educational_qualification_2' => $this->db->escape_like_str($edu_2),
                        'educational_qualification_3' => $this->db->escape_like_str($edu_3),
                        'educational_qualification_4' => $this->db->escape_like_str($edu_4),
                        'educational_qualification_5' => $this->db->escape_like_str($edu_5),
                        'users_photo' => $this->db->escape_like_str($uploadFileInfo['file_name']),
                        'cv' => $this->db->escape_like_str($this->input->post('cv', TRUE)),
                        'educational_certificat' => $this->db->escape_like_str($this->input->post('educational_certificat', TRUE)),
                        'exprieance_certificatte' => $this->db->escape_like_str($this->input->post('exc', TRUE)),
                        'files_info' => $this->db->escape_like_str($this->input->post('submited_info', TRUE)),
                        'status' => $this->db->escape_like_str($this->input->post('status', TRUE)),
                        'phone' => $this->db->escape_like_str($phone)
                    );
            
                // New User roll access
            $user_access = array(
                'user_id' => $this->db->escape_like_str($userid),
                'group_id' => $this->db->escape_like_str($this->input->post('group', TRUE)),
                        'das_top_info' => $this->db->escape_like_str($key['das_top_info']),
                        'das_grab_chart' => $this->db->escape_like_str($key['das_grab_chart']),
                        'das_class_info' => $this->db->escape_like_str($key['das_class_info']),
                        'das_message' => $this->db->escape_like_str($key['das_message']),
                        'das_employ_attend' => $this->db->escape_like_str($key['das_employ_attend']),
                        'das_notice' => $this->db->escape_like_str($key['das_notice']),
                        'das_calender' => $this->db->escape_like_str($key['das_calender']),
                        'admission' => $this->db->escape_like_str($key['admission']),
                        'all_student_info' => $this->db->escape_like_str($key['all_student_info']),
                        'stud_edit_delete' => $this->db->escape_like_str($key['stud_edit_delete']),
                        'stu_own_info' => $this->db->escape_like_str($key['stu_own_info']),
                        'teacher_info' => $this->db->escape_like_str($key['teacher_info']),
                        'add_teacher' => $this->db->escape_like_str($key['add_teacher']),
                        'teacher_details' => $this->db->escape_like_str($key['teacher_details']),
                        'teacher_edit_delete' => $this->db->escape_like_str($key['teacher_edit_delete']),
                        'all_parents_info' => $this->db->escape_like_str($key['all_parents_info']),
                        'own_parents_info' => $this->db->escape_like_str($key['own_parents_info']),
                        'make_parents_id' => $this->db->escape_like_str($key['make_parents_id']),
                        'parents_edit_dlete' => $this->db->escape_like_str($key['parents_edit_dlete']),
                        'add_group' => $this->db->escape_like_str($key['add_group']),
                        'group_list' => $this->db->escape_like_str($key['group_list']),
                        'add_employee' => $this->db->escape_like_str($key['add_employee']),
                        'employee_list' => $this->db->escape_like_str($key['employee_list']),
                        'employ_attendance' => $this->db->escape_like_str($key['employ_attendance']),
                        'empl_atte_view' => $this->db->escape_like_str($key['empl_atte_view']),
                        'add_new_class' => $this->db->escape_like_str($key['add_new_class']),
                        'all_class_info' => $this->db->escape_like_str($key['all_class_info']),
                        'class_details' => $this->db->escape_like_str($key['class_details']),
                        'class_delete' => $this->db->escape_like_str($key['class_delete']),
                        'class_promotion' => $this->db->escape_like_str($key['class_promotion']),            
                        'add_class_routine' => $this->db->escape_like_str($key['add_class_routine']),
                        'own_class_routine' => $this->db->escape_like_str($key['own_class_routine']),
                        'all_class_routine' => $this->db->escape_like_str($key['all_class_routine']),
                        'rutin_edit_delete' => $this->db->escape_like_str($key['rutin_edit_delete']),
                        'attendance_preview' => $this->db->escape_like_str($key['attendance_preview']),
                        'take_studence_atten' => $this->db->escape_like_str($key['take_studence_atten']),
                        'edit_student_atten' => $this->db->escape_like_str($key['edit_student_atten']),
                        'add_subject' => $this->db->escape_like_str($key['add_subject']),
                        'all_subject' => $this->db->escape_like_str($key['all_subject']),
                        'assin_optio_sub' => $this->db->escape_like_str($key['assin_optio_sub']),
                        'make_suggestion' => $this->db->escape_like_str($key['make_suggestion']),
                        'all_suggestion' => $this->db->escape_like_str($key['all_suggestion']),
                        'own_suggestion' => $this->db->escape_like_str($key['own_suggestion']),
                        'add_exam_gread' => $this->db->escape_like_str($key['add_exam_gread']),
                        'exam_gread' => $this->db->escape_like_str($key['exam_gread']),
                        'gread_edit_dele' => $this->db->escape_like_str($key['gread_edit_dele']),
                        'add_exam_routin' => $this->db->escape_like_str($key['add_exam_routin']),
                        'all_exam_routine' => $this->db->escape_like_str($key['all_exam_routine']),
                        'dateSheet' => $this->db->escape_like_str($key['dateSheet']),
                        'assets'=>$this->db->escape_like_str($key['assets']),
                        'own_exam_routine' => $this->db->escape_like_str($key['own_exam_routine']),
                        'exam_attend_preview' => $this->db->escape_like_str($key['exam_attend_preview']),
                        'approve_result' => $this->db->escape_like_str($key['approve_result']),
                        'view_result' => $this->db->escape_like_str($key['view_result']),
                        'all_mark_sheet' => $this->db->escape_like_str($key['all_mark_sheet']),
                        'combine_mark_sheet' => $this->db->escape_like_str($key['combine_mark_sheet']),
                        'own_mark_sheet' => $this->db->escape_like_str($key['own_mark_sheet']),
                        'take_exam_attend' => $this->db->escape_like_str($key['take_exam_attend']),
                        'change_exam_attendance' =>$this->db->escape_like_str($key['change_exam_attendance']),
                        'make_result' => $this->db->escape_like_str($key['make_result']),
                        'add_category' => $this->db->escape_like_str($key['add_category']),
                        'all_category' => $this->db->escape_like_str($key['all_category']),
                        'edit_delete_category' => $this->db->escape_like_str($key['edit_delete_category']),
                        'add_books' => $this->db->escape_like_str($key['add_books']),
                        'all_books' => $this->db->escape_like_str($key['all_books']),
                        'edit_delete_books' => $this->db->escape_like_str($key['edit_delete_books']),
                        'add_library_mem' => $this->db->escape_like_str($key['add_library_mem']),
                        'memb_list' => $this->db->escape_like_str($key['memb_list']),
                        'issu_return' => $this->db->escape_like_str($key['issu_return']),
                        'add_dormitories' => $this->db->escape_like_str($key['add_dormitories']),
                        'add_set_dormi' => $this->db->escape_like_str($key['add_set_dormi']),
                        'set_member_bed' => $this->db->escape_like_str($key['set_member_bed']),
                        'dormi_report' => $this->db->escape_like_str($key['dormi_report']),
                        'student_reports' => $this->db->escape_like_str($key['student_reports']),
                        'add_transport' => $this->db->escape_like_str($key['add_transport']),
                        'all_transport' => $this->db->escape_like_str($key['all_transport']),
                        'transport_edit_dele' => $this->db->escape_like_str($key['transport_edit_dele']),
                        'add_account_title' => $this->db->escape_like_str($key['add_account_title']),
                        'edit_dele_acco' => $this->db->escape_like_str($key['edit_dele_acco']),
                        'trensection' => $this->db->escape_like_str($key['trensection']),
                        'fee_collection' => $this->db->escape_like_str($key['fee_collection']),
                        'all_slips' => $this->db->escape_like_str($key['all_slips']),
                        'own_slip' => $this->db->escape_like_str($key['own_slip']),
                        'slip_edit_delete' => $this->db->escape_like_str($key['slip_edit_delete']),
                        'pay_salary' => $this->db->escape_like_str($key['pay_salary']),
                        'creat_notice' => $this->db->escape_like_str($key['creat_notice']),
                        'send_message' => $this->db->escape_like_str($key['send_message']),
                        'vendor' => $this->db->escape_like_str($key['vendor']),
                        'delet_vendor' => $this->db->escape_like_str($key['delet_vendor']),
                        'add_inv_cat' => $this->db->escape_like_str($key['add_inv_cat']),
                        'inve_item' => $this->db->escape_like_str($key['inve_item']),
                        'delete_inve_ite' => $this->db->escape_like_str($key['delete_inve_ite']),
                        'delete_inv_cat' => $this->db->escape_like_str($key['delete_inv_cat']),
                        'inve_issu' => $this->db->escape_like_str($key['inve_issu']),
                        'add_event' => $this->db->escape_like_str($key['add_event']),
                        'calender' => $this->db->escape_like_str($key['calender']),
                        'delete_inven_issu' => $this->db->escape_like_str($key['delete_inven_issu']),
                        'check_leav_appli' => $this->db->escape_like_str($key['check_leav_appli']),
                        'setting_accounts' => $this->db->escape_like_str($key['setting_accounts']),
                        'other_setting' => $this->db->escape_like_str($key['other_setting']),
                        'front_setings' => $this->db->escape_like_str($key['front_setings']),
                        'set_optional' => $this->db->escape_like_str($key['set_optional']),
                        'setting_manage_user' => $this->db->escape_like_str($key['setting_manage_user']),
                        'registration' => $this->db->escape_like_str($key['registration']),
                     );
                    /*  
                    print_r($additional_data2);
                    echo '<br>';
                    print_r($user_access);
                    die;*/
                    $this->db->insert('userinfo', $additional_data2);
                    if ($this->db->insert('role_based_access', $user_access)) {
                        //Load the Teachers Information's page after Add New Teacher.
                        redirect('users/allUserInafo', 'refresh');
                    }
                } else {
                    $query = $this->common->countryPhoneCode();
                    $data['countryPhoneCode'] = $query->countryPhonCode;
                    $query1 = $this->db->query("SELECT * FROM groups where status= 'Active'");
                    $data['groupsname']=$query1->result_array();
                    //display the create user form
                    $this->load->view('temp/header');
                    $this->load->view('addNewUser', $data);
                    $this->load->view('temp/footer');
                }
            }
        } else {
            $query = $this->common->countryPhoneCode();
            $data['countryPhoneCode'] = $query->countryPhonCode;

            $query1 = $this->db->query("SELECT * FROM groups where status= 'Active'");
            $data['groupsname']=$query1->result_array();
            //display the create user form
            $this->load->view('temp/header');
            $this->load->view('addNewUser', $data);
            $this->load->view('temp/footer');
        }
    }

    //This function will take class and give the class exam title and subject
    public function ajaxselectgroup() {
        $groupCode = $this->input->get('q');
        //$data = $this->exammodel->examTitleRes($class_id); 
        if (strlen($groupCode) == 1) {
            $groupId = '0' . $groupCode;
        } elseif (strlen($groupCode) == 2) {
            $groupId = $groupCode;
        }
        $employId = $this->common->employId($groupCode);

        if (strlen($employId) == 1) {
            $empid = '00' . $employId;
        } elseif (strlen($employId) == 2) {
            $empid = '0' . $employId;
        } elseif (strlen($employId) == 3) {
            $empid = $employId;
        }
        $finalId = date("Y") . $groupCode . $empid;
        $query = $this->db->query("SELECT id_sub_title FROM groups where id= $groupCode");
        $data=$query->result_array();
        $sub_title = $data[0]['id_sub_title']; 
        $finalemployId=$sub_title."-".$finalId;  
        if (!empty($groupId)) { 
            echo'<div class="form-group">
                    <label class="col-md-3 control-label"> Employ ID </label>
                    <div class="col-md-6">
                        <input type="text" name="employ_id" onchange="examSubject(this.value)" class="form-control" readonly="" value="'.$finalemployId.'"> 
                    </div>
                </div>';
            //making here emp_id fild.
            echo'<div class="form-group">
                    <label class="col-md-3 control-label"> Employ Roll </label>
                    <div class="col-md-6">
                        <input type="text" name="emp_roll" class="form-control" value="' . $empid . '" readonly>
                    </div>
                </div>';
        }
    }
    
    //This function will Add user group in groups table.
    public function addGroup(){ 
        if ($this->input->post('submit', TRUE)) {
            $grouptitle=$this->input->post('groupTitle', TRUE);
            $idSubTitle=$this->input->post('idSubTitle', TRUE);
            $description=$this->input->post('description', TRUE);
            $status=$this->input->post('status', TRUE);
            $created_by=$this->input->post('created_by', TRUE);

            $data = array(
                'name' => $this->db->escape_like_str($grouptitle),
                'id_sub_title' => $this->db->escape_like_str($idSubTitle),
                'description' => $this->db->escape_like_str($description),
                'status' => $this->db->escape_like_str($status),
                'created_by' => $this->db->escape_like_str($created_by)
            );   
            if($this->db->insert('groups', $data)){
            $data['allgroups'] = $this->common->getAllData('groups');
            $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong>Success ! </strong> Group title added successfully. 
                            </div>';
            $this->load->view('temp/header');
            $this->load->view('addGroup', $data);
            $this->load->view('temp/footer');        
            }
        }
        else{
        $data['allgroups'] = $this->common->getAllData('groups');
        $this->load->view('temp/header');
        $this->load->view('addGroup', $data);
        $this->load->view('temp/footer');
        }
    }
    // This function will Edit user group id & title for groups table.
    public function editGroupInfo() {
        $groupId = $this->input->get('id');

        if ($this->input->post('submit', TRUE)) { 
            $data = array( 
                'name' => $this->db->escape_like_str($this->input->post('groupTitle', TRUE)),
                'id_sub_title' => $this->db->escape_like_str($this->input->post('idSubTitle', TRUE)),
                'description' => $this->db->escape_like_str($this->input->post('description', TRUE)),
                'status' => $this->db->escape_like_str($this->input->post('status', TRUE)),
             );
            $this->db->where('id', $groupId);
            $this->db->update('groups', $data);
            $data['allgroups'] = $this->common->getAllData('groups');
            $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong>Success ! </strong> Group title edit successfully. 
                            </div>';
            $this->load->view('temp/header');
            $this->load->view('addGroup', $data);
            $this->load->view('temp/footer'); 
            
        } else { 
          $data['groupInfo'] = $this->common->getWhere('groups', 'id', $groupId);
            $this->load->view('temp/header');
            $this->load->view('editGroup',$data);
            $this->load->view('temp/footer');
        }
    }
    //This function will Delete user group id & title for groups table.
     public function deleteGroup(){ 
        $groupId = $this->input->get('id'); 

        if($this->db->delete('groups', array('id' => $groupId))){
            $data['allgroups'] = $this->common->getAllData('groups');
            $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong>Success ! </strong> Group Info delete successfully. 
                            </div>';
            $this->load->view('temp/header');
            $this->load->view('addGroup', $data);
            $this->load->view('temp/footer');
        } 

        redirect('users/addGroup', 'refresh');
     }

    //This function will return user group id & title for adding new user.
    public function newUserGrope() {
        $groupId = $this->input->get('q', TRUE);
        if ($groupId == '6') {
            echo '<input type="text" name="group" value="6">';
            echo '<input type="text" name="groupTitle" value="Accountant">';
        } elseif ($groupId == '7') {
            echo '<input type="text" name="group" value="7">';
            echo '<input type="text" name="groupTitle" value="Library Man">';
        } elseif ($groupId == '8') {
            echo '<input type="text" name="group" value="8">';
            echo '<input type="text" name="groupTitle" value="Car Driver">';
        } elseif ($groupId == '9') {
            echo '<input type="text" name="group" value="9">';
            echo '<input type="text" name="groupTitle" value="4th Class Employee">';
        }
    }

    //This function returan all user's informations
    public function allUserInafo() {
        $data = array();
        $data['usersInfo'] = $this->common->getAllData('userinfo');
        $this->load->view('temp/header');
        $this->load->view('allUserInfo', $data);
        $this->load->view('temp/footer');
    }

    //This function returan all user's informations detalis
    public function allUserInafoDetails() {
        $id = $this->input->get('id');
        $userId = $this->input->get('uid');
        $data['userinfo'] = $this->common->getWhere('userinfo', 'id', $id);
        $data['user'] = $this->common->getWhere('users', 'id', $userId);
        $this->load->view('temp/header');
        $this->load->view('allUserInafoDetails', $data);
        $this->load->view('temp/footer');
    }

    //This function is using for editing a teacher informations
    //And admin an select group  
    function edit_user() {
        $userInfoId = $this->input->get('id');
        $userId = $this->input->get('uid');
        $groupId = $this->input->get('gid');
        if ($this->input->post('submit', TRUE)) {
            $edu_1 = '';
            $edu_2 = '';
            $edu_3 = '';
            $edu_4 = '';
            $edu_5 = '';
            if ($this->input->post('dd_1', TRUE)) {
                $edu_1 = $this->input->post('dd_1') . ',' . $this->input->post('scu_1', TRUE) . ',' . $this->input->post('result_1', TRUE) . ',' . $this->input->post('paYear_1', TRUE);
            }
            if ($this->input->post('dd_2', TRUE)) {
                $edu_2 = $this->input->post('dd_2') . ',' . $this->input->post('scu_2', TRUE) . ',' . $this->input->post('result_2', TRUE) . ',' . $this->input->post('paYear_2', TRUE);
            }
            if ($this->input->post('dd_3', TRUE)) {
                $edu_3 = $this->input->post('dd_3') . ',' . $this->input->post('scu_3', TRUE) . ',' . $this->input->post('result_3', TRUE) . ',' . $this->input->post('paYear_3', TRUE);
            }
            if ($this->input->post('dd_4', TRUE)) {
                $edu_4 = $this->input->post('dd_4') . ',' . $this->input->post('scu_4', TRUE) . ',' . $this->input->post('result_4', TRUE) . ',' . $this->input->post('paYear_4', TRUE);
            }
            if ($this->input->post('dd_5', TRUE)) {
                $edu_5 = $this->input->post('dd_5') . ',' . $this->input->post('scu_5', TRUE) . ',' . $this->input->post('result_5', TRUE) . ',' . $this->input->post('paYear_5');
            }
            $username = $this->input->post('first_name') . ' ' . $this->input->post('last_name');
            $status= $this->input->post('status', TRUE);
            if($status=="Active"){
                $sta=1;
            }elseif($status=="Deactive"){
                $sta=0;
            }
            $phone = $this->input->post('phone', TRUE);
           $additional_data = array(
               'username' => $this->db->escape_like_str($username),
               'email' => $this->db->escape_like_str($this->input->post('email', TRUE)),
               'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
               'last_name' => $this->db->escape_like_str($this->input->post('last_name', TRUE)),
               'phone' => $this->db->escape_like_str($phone),
               'active' => $this->db->escape_like_str($sta),
               'status' => $this->db->escape_like_str($status),
           );

           $this->db->where('id', $userId);
           $this->db->update('users', $additional_data);

            $additional_data2 = array(
                'full_name' => $this->db->escape_like_str($username),
                'farther_name' => $this->db->escape_like_str($this->input->post('father_name', TRUE)),
                'mother_name' => $this->db->escape_like_str($this->input->post('mother_name', TRUE)),
                'birth_date' => $this->db->escape_like_str($this->input->post('birthdate', TRUE)),
                'sex' => $this->db->escape_like_str($this->input->post('sex', TRUE)),
                'present_address' => $this->db->escape_like_str($this->input->post('present_address', TRUE)),
                'permanent_address' => $this->db->escape_like_str($this->input->post('permanent_address', TRUE)),
                'group_id' => $this->db->escape_like_str($this->input->post('group_id', TRUE)), 
                'working_hour' => $this->db->escape_like_str($this->input->post('workingHoure', TRUE)),
                'educational_qualification_1' => $this->db->escape_like_str($edu_1),
                'educational_qualification_2' => $this->db->escape_like_str($edu_2),
                'educational_qualification_3' => $this->db->escape_like_str($edu_3),
                'educational_qualification_4' => $this->db->escape_like_str($edu_4),
                'educational_qualification_5' => $this->db->escape_like_str($edu_5),
//                'users_photo' => $this->db->escape_like_str($uploadFileInfo['file_name']),
                'cv' => $this->db->escape_like_str($this->input->post('cv', TRUE)),
                'educational_certificat' => $this->db->escape_like_str($this->input->post('educational_certificat', TRUE)),
                'exprieance_certificatte' => $this->db->escape_like_str($this->input->post('exc', TRUE)),
                'files_info' => $this->db->escape_like_str($this->input->post('submited_info', TRUE)),
                'status' => $this->db->escape_like_str($this->input->post('status', TRUE)),
                'status_reason' => $this->db->escape_like_str($this->input->post('status_reason', TRUE)),
                'phone' => $this->db->escape_like_str($phone),
            );
            $this->db->where('id', $userInfoId);
            $this->db->update('userinfo', $additional_data2);
            redirect('users/allUserInafo', 'refresh');
        } else {
            $data['group_id'] = $this->input->get('gid');

            //get all data about this teacher from the "user" table
            $data['usersInfo'] = $this->common->getWhere('users', 'id', $userId);
            $data['userInfo'] = $this->common->getWhere('userinfo', 'id', $userInfoId);

            //get all groupe information and current group information to view file by "$data" array.
            $data['groups'] = $this->ion_auth->groups()->result_array();
            $data['currentGroups'] = $this->ion_auth->get_users_groups($userId)->result();

            $this->load->view('temp/header');
            $this->load->view('editUserInfo', $data);
            $this->load->view('temp/footer');
        }
    }
    // user status edit reason
    public function reason(){
        $status = $this->input->get('q'); 
        if($status=="Deactive"){
            echo'<div class="form-group">
                    <label class="col-md-3 control-label"> Student Status Reason </label>
                    <div class="col-md-6">
                        <textarea class="form-control" name="status_reason" rows="2"></textarea>
                    </div>
                </div>';
        }elseif($status=="Active"){
            echo'';
        }
    }
    //This function is useing for delete a user.
    public function teacherDelete() {
        $userId = $this->input->get('uid');
        $userInfoId = $this->input->get('id');

        $this->db->delete('userinfo', array('id' => $userInfoId));
        $this->db->delete('users', array('id' => $userId));

        redirect('users/allUserInafo', 'refresh');
    }

    function test() {
        $a = $this->common->usersId();
        echo '<pre>';
        echo $a;
        echo '</pre>';
    }
    // This Funtion will return Registration form and auto genrate registartion number 
    public function registration(){
        $year=date('Y');
        $data = array();
        $query = $this->db->query("SELECT count(*) FROM registration where year= $year");
        $data=$query->result_array(); 
         $count=$data[0]['count(*)']+1;

         $clength= strlen((string)$count);  
          if($clength==1){ 
            $count='000'.(string)$count;

          } elseif($clength==2) {
            $count='00'.(string)$count;
          } elseif($clength==3) {
            $count='0'.(string)$count;
          }else {
            $count=(string)$count;
          } 
        $num=date('Y');
        $tps='TPS';
        $data['auto_reg_number'] =$num.$tps.$count; 
        $data['s_class'] = $this->common->getAllData('class');
        $fee_query= $this->db->query("SELECT registration_fee FROM fee_structure WHERE session=$year");
        $fee=$fee_query->result_array();
        if(!empty($fee)){
            $data['session_fee'] = $fee[0]['registration_fee'];
        } else{
            $data['session_fee'] ="";
        }
             
        $this->load->view('temp/header');
        $this->load->view('registration', $data);
        $this->load->view('temp/footer');
    }

    public function reg_session_fee(){
       $session=$this->input->get('q');
       /*$query = $this->db->query("SELECT registration_fee FROM fee_structure where session= $session");
       $row['session']= $query->num_rows('session');
        echo $row['session'];*/
       $query1= $this->db->query("SELECT registration_fee FROM fee_structure WHERE session='$session'");
            $data=$query1->result_array();
            if(!empty($data)){
            foreach($data as $row){
                $reg_fee=$row['registration_fee'];
            }}
            else{
                $reg_fee="This session registration fee not Add";
            }
       echo '<input type="text" name="registration_fee" value="'.$reg_fee.'" readonly>';
    }
     // student registration function
    public function reg(){
        $class_id = $this->db->escape_like_str($this->input->post('class', TRUE)); 
        if ($this->input->post('submit', TRUE)) {
            $regNumber=$this->input->post('regnum', TRUE);
            $tables   = $this->config->item('tables', 'ion_auth');
            
            $bs_1 = '';
            $bs_2 = '';
            $bs_3 = ''; 
            $bb_1 = $this->input->post('school_nam1', TRUE);
            if (!empty($bb_1)) {
                $this->form_validation->set_rules('school_nam1', '');
                $this->form_validation->set_rules('class1', '');
                $this->form_validation->set_rules('from1', '');
                $bs_1 = $this->input->post('school_nam1', TRUE) .',' . $this->input->post('class1', TRUE) . ',' . $this->input->post('from1', TRUE);
            }

            $bb_2 = $this->input->post('school_nam2', TRUE);
            if (!empty($bb_2)) {
                $this->form_validation->set_rules('school_nam2', 'School/College/University 2st fild', '');
                $this->form_validation->set_rules('class2', 'Result  2st fild', '');
                $this->form_validation->set_rules('from2', 'Passing year 2st fild', '');
                $bs_2 = $this->input->post('school_nam2', TRUE) . ',' . $this->input->post('class2', TRUE) . ',' . $this->input->post('from2', TRUE);
            }

            $bb_3 = $this->input->post('school_nam3', TRUE);
            if (!empty($bb_3)) {
                $this->form_validation->set_rules('school_nam3', 'School/College/University 3st fild', '');
                $this->form_validation->set_rules('class3', 'Result  3st fild', '');
                $this->form_validation->set_rules('from3', 'Passing year 3st fild', '');
                $bs_3 = $this->input->post('school_nam3', TRUE) . ',' . $this->input->post('class3', TRUE) . ',' . $this->input->post('from3', TRUE);
            }
            //This will Enter data for Next tabs
            $scol_uni1 = '';
            $scol_uni2 = '';
            $scol_uni3 = ''; 
            $scol1 = $this->input->post('name1', TRUE);
            if (!empty($scol1)) {
                $this->form_validation->set_rules('name1', '');
                $this->form_validation->set_rules('school1', '');
                $this->form_validation->set_rules('clas1', '');
                $scol_uni1 = $this->input->post('name1', TRUE) .',' . $this->input->post('school1', TRUE) . ',' . $this->input->post('clas1', TRUE);
            }

            $scol2 = $this->input->post('name2', TRUE);
            if (!empty($scol2)) {
                $this->form_validation->set_rules('name2', 'School/College/University 2st fild', '');
                $this->form_validation->set_rules('school2', 'Result  2st fild', '');
                $this->form_validation->set_rules('clas2', 'Passing year 2st fild', '');
                $scol_uni2 = $this->input->post('name2', TRUE) . ',' . $this->input->post('school2', TRUE) . ',' . $this->input->post('clas2', TRUE);
            }

            $scol3 = $this->input->post('name3', TRUE);
            if (!empty($scol3)) {
                $this->form_validation->set_rules('name3', 'School/College/University 3st fild', '');
                $this->form_validation->set_rules('school3', 'Result  3st fild', '');
                $this->form_validation->set_rules('clas3', 'Passing year 3st fild', '');
                $scol_uni3 = $this->input->post('name3', TRUE) . ',' . $this->input->post('school3', TRUE) . ',' . $this->input->post('clas3', TRUE);
            }
            // This Will Insert data of Next tab
            $be_1 = '';
            $be_2 = '';
            $be_3 = ''; 
            $bc_1 = $this->input->post('ch_name1', TRUE);
            if (!empty($bc_1)) {
                $this->form_validation->set_rules('ch_name1', '');
                $this->form_validation->set_rules('cls1', '');
                $this->form_validation->set_rules('regnumb1', '');
                $be_1 = $this->input->post('ch_name1', TRUE) .',' . $this->input->post('cls1', TRUE) . ',' . $this->input->post('regnumb1', TRUE);
            }

            $bc_2 = $this->input->post('ch_name2', TRUE);
            if (!empty($bc_2)) {
                $this->form_validation->set_rules('ch_name2', 'School/College/University 2st fild', '');
                $this->form_validation->set_rules('cls2', 'Result  2st fild', '');
                $this->form_validation->set_rules('regnumb2', 'Passing year 2st fild', '');
                $be_2 = $this->input->post('ch_name2', TRUE) . ',' . $this->input->post('cls2', TRUE) . ',' . $this->input->post('regmunb2', TRUE);
            }

            $bc_3 = $this->input->post('ch_name3', TRUE);
            if (!empty($bc_3)) {
                $this->form_validation->set_rules('ch_name3', 'School/College/University 3st fild', '');
                $this->form_validation->set_rules('cls3', 'Result  3st fild', '');
                $this->form_validation->set_rules('regnumb3', 'Passing year 3st fild', '');
                $be_3 = $this->input->post('ch_name3', TRUE) . ',' . $this->input->post('cls3', TRUE) . ',' . $this->input->post('regnumb3', TRUE);
            }
            $username = $this->input->post('first_name') . ' ' . $this->input->post('last_name');
            $email    = strtolower($this->input->post('email', TRUE));
            $password = $this->input->post('password', TRUE);
            $stat = 'Unpaid';
            //Here is uploading the student's photo.
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '10000';
            $config['max_width'] = '10240';
            $config['max_height'] = '7680';
            $config['encrypt_name'] = TRUE;
            //$config[$username] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->do_upload();
            $uploadFileInfo = $this->upload->data(); 
            $year = date('Y');
            $query1= $this->db->query("SELECT registration_fee FROM fee_structure WHERE session=$year");
            $data=$query1->result_array();
            foreach($data as $row){
                $reg_fee=$row['registration_fee'];
            } 

            $phone = $this->input->post('phoneCode', TRUE) . '' . $this->input->post('phone', TRUE);


            //This array information's are sending to "user" table as a core information as a user this system
                $additional_data = array(
                    'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
                    'last_name' => $this->db->escape_like_str($this->input->post('last_name', TRUE)),
                    'phone' => $this->db->escape_like_str($phone)
                );
                //This array information's are sending to "student_info" table.
                $regnbr=$this->input->post('regnum', TRUE);
                $voucher_number=date("y").''.date("m").''.$regnbr;
                $regdate = date('yy-m-d'); 
                
            while (true){

                $studata = array(
                    'year' => $this->db->escape_like_str($year),                     
                    'class_id' => $this->db->escape_like_str($class_id),
                    'student_nam' => $this->db->escape_like_str($username),
                    'previous_info1' => $this->db->escape_like_str($bs_1),
                    'previous_info2' => $this->db->escape_like_str($bs_2),
                    'previous_info3' => $this->db->escape_like_str($bs_3), 
                    'sibling_info1' => $this->db->escape_like_str($scol_uni1),
                    'sibling_info2' => $this->db->escape_like_str($scol_uni2),
                    'sibling_info3' => $this->db->escape_like_str($scol_uni3), 
                    'sibling_info4' => $this->db->escape_like_str($be_1),
                    'sibling_info5' => $this->db->escape_like_str($be_2),
                    'sibling_info6' => $this->db->escape_like_str($be_3), 
                    'reg_number' => $this->db->escape_like_str($regNumber),
                    'reg_date' => $this->db->escape_like_str($regdate),
                    'due_date' => $this->db->escape_like_str($this->input->post('due_date', TRUE)),
                    'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
                    'last_name' => $this->db->escape_like_str($this->input->post('last_name', TRUE)),
                    'session' => $this->db->escape_like_str($year),
                    'b_form' => $this->db->escape_like_str($this->input->post('bfnumb', TRUE)),
                    //'birth_certificate' => $this->db->escape_like_str($uploadFileInfo1['file_name']),
                    'father_name' => $this->db->escape_like_str($this->input->post('father_name', TRUE)),
                    'father_cnic' => $this->db->escape_like_str($this->input->post('father_cnic', TRUE)),
                    'father_occupation' => $this->db->escape_like_str($this->input->post('father_occupation', TRUE)), 
                    'birth_date' => $this->db->escape_like_str($this->input->post('birthdate', TRUE)),
                    'gender' => $this->db->escape_like_str($this->input->post('sex', TRUE)),
                    'present_address' => $this->db->escape_like_str($this->input->post('address', TRUE)),
                    'phone' => $this->db->escape_like_str($phone),
                    'student_photo' => $this->db->escape_like_str($uploadFileInfo['file_name']),
                    'heard_from1' => $this->db->escape_like_str($this->input->post('nw', TRUE)),
                    'heard_from2' => $this->db->escape_like_str($this->input->post('bb', TRUE)),
                    'heard_from3' => $this->db->escape_like_str($this->input->post('strem', TRUE)),
                    'heard_from4' => $this->db->escape_like_str($this->input->post('flyer', TRUE)),
                    'heard_from5' => $this->db->escape_like_str($this->input->post('mouth', TRUE)),
                    'heard_from6' => $this->db->escape_like_str($this->input->post('other', TRUE)),
                    'status' => $this->db->escape_like_str($stat),    
                    'registration_fee' => $this->db->escape_like_str($reg_fee),
                    'voucher_number' => $this->db->escape_like_str($voucher_number),
                    'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE))
                );               
                    if($this->db->insert('registration', $studata)===false){
                        $regNumber++;
                        $voucher_number++;
                     continue;
                    } else{
                       break;
                    }
            }
                $reg_stud = array(
                    'class_id' => $this->db->escape_like_str($class_id),
                    'student_nam' => $this->db->escape_like_str($username),
                    'status' => $this->db->escape_like_str($stat),
                    'reg_number' => $this->db->escape_like_str($regNumber),
                    'voucher_number' => $this->db->escape_like_str($voucher_number),
                    'session' => $this->db->escape_like_str($year),
                    'registration_fee' => $this->db->escape_like_str($reg_fee), 
                    'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE))
                );  
                $this->db->insert('registered', $reg_stud);

                $voucher_data = array(
                    'voucher_type' => $this->db->escape_like_str('Registration'),
                    'student_ref_id' => $this->db->escape_like_str($regNumber),
                    'voucher_number' => $this->db->escape_like_str($voucher_number),
                    'total_amount' => $this->db->escape_like_str($reg_fee),
                    'month_id' => $this->db->escape_like_str(date("m")),
                    'voucher_status' => $this->db->escape_like_str('unpaid'),
                    'issue_date' => $this->db->escape_like_str($regdate),
                    'due_date' => $this->db->escape_like_str($this->input->post('due_date', TRUE)),
                    'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE))
                );
                $this->db->insert('vouchers', $voucher_data);
                $this->session->set_flashdata('success', '<strong>Success ! </strong>  Student Registration Successfully processed. ');
                redirect('users/reg_stu');
        }  
    }
//this function will show student fee voucher
    public function vouch(){ 
        $regnum = $this->input->get('regnum');  
        $data['voucher'] = $this->common->getWhere('registration', 'reg_number',$regnum);
        $this->load->view('temp/header');
        $this->load->view('account/admission_vocher', $data);
        $this->load->view('temp/footer');     
    }
//This Will Return Admission Fees Voucher
    public function admi_fee_vouch(){ 
        $reg_num = $this->input->get('r_num');  
        $data['voucher'] = $this->common->getWhere('register_pass', 'reg_number',$reg_num); 
        $this->load->view('temp/header');
        $this->load->view('account/admission_fee_vocher', $data);
        $this->load->view('temp/footer'); 
    }

///This Will Return Degistered Students
            public function reg_stu(){ 
                $data['sit'] = $this->common->getAllData('account_title');
                $data['stu'] = $this->common->getAllData('registered');
                $this->load->view('temp/header');
                $this->load->view('registered' , $data);
                $this->load->view('temp/footer');
            }
            //This will delete Registered User
            public function reg_delete(){
                $reg_num = $this->input->get('reg_num');
               $this->db->delete('registered', array('reg_number' => $reg_num));
               $this->db->delete('registration', array('reg_number' => $reg_num)); 
               redirect('users/reg_stu', 'refresh');
            }

// This Function Will return Edit Registration form
    public function editregstu(){ 
        if ($this->input->post('submit', TRUE)) {
            $tables   = $this->config->item('tables', 'ion_auth');
            
            $bs_1 = '';
            $bs_2 = '';
            $bs_3 = ''; 
            $bb_1 = $this->input->post('school_nam1', TRUE);
            if (!empty($bb_1)) {
                $this->form_validation->set_rules('school_nam1', '');
                $this->form_validation->set_rules('class1', '');
                $this->form_validation->set_rules('from1', '');
                $bs_1 = $this->input->post('school_nam1', TRUE) .',' . $this->input->post('class1', TRUE) . ',' . $this->input->post('from1', TRUE);
            }

            $bb_2 = $this->input->post('school_nam2', TRUE);
            if (!empty($bb_2)) {
                $this->form_validation->set_rules('school_nam2', 'School/College/University 2st fild', '');
                $this->form_validation->set_rules('class2', 'Result  2st fild', '');
                $this->form_validation->set_rules('from2', 'Passing year 2st fild', '');
                $bs_2 = $this->input->post('school_nam2', TRUE) . ',' . $this->input->post('class2', TRUE) . ',' . $this->input->post('from2', TRUE);
            }

            $bb_3 = $this->input->post('school_nam3', TRUE);
            if (!empty($bb_3)) {
                $this->form_validation->set_rules('school_nam3', 'School/College/University 3st fild', '');
                $this->form_validation->set_rules('class3', 'Result  3st fild', '');
                $this->form_validation->set_rules('from3', 'Passing year 3st fild', '');
                $bs_3 = $this->input->post('school_nam3', TRUE) . ',' . $this->input->post('class3', TRUE) . ',' . $this->input->post('from3', TRUE);
            }
            //This will Enter data for Next tabs
            $scol_uni1 = '';
            $scol_uni2 = '';
            $scol_uni3 = ''; 
            $scol1 = $this->input->post('name1', TRUE);
            if (!empty($scol1)) {
                $this->form_validation->set_rules('name1', '');
                $this->form_validation->set_rules('school1', '');
                $this->form_validation->set_rules('clas1', '');
                $scol_uni1 = $this->input->post('name1', TRUE) .',' . $this->input->post('school1', TRUE) . ',' . $this->input->post('clas1', TRUE);
            }

            $scol2 = $this->input->post('name2', TRUE);
            if (!empty($scol2)) {
                $this->form_validation->set_rules('name2', 'School/College/University 2st fild', '');
                $this->form_validation->set_rules('school2', 'Result  2st fild', '');
                $this->form_validation->set_rules('clas2', 'Passing year 2st fild', '');
                $scol_uni2 = $this->input->post('name2', TRUE) . ',' . $this->input->post('school2', TRUE) . ',' . $this->input->post('clas2', TRUE);
            }

            $scol3 = $this->input->post('name3', TRUE);
            if (!empty($scol3)) {
                $this->form_validation->set_rules('name3', 'School/College/University 3st fild', '');
                $this->form_validation->set_rules('school3', 'Result  3st fild', '');
                $this->form_validation->set_rules('clas3', 'Passing year 3st fild', '');
                $scol_uni3 = $this->input->post('name3', TRUE) . ',' . $this->input->post('school3', TRUE) . ',' . $this->input->post('clas3', TRUE);
            }
            // This Will Insert data of Next tab
            $be_1 = '';
            $be_2 = '';
            $be_3 = ''; 
            $bc_1 = $this->input->post('ch_name1', TRUE);
            if (!empty($bc_1)) {
                $this->form_validation->set_rules('ch_name1', '');
                $this->form_validation->set_rules('cls1', '');
                $this->form_validation->set_rules('regnumb1', '');
                $be_1 = $this->input->post('ch_name1', TRUE) .',' . $this->input->post('cls1', TRUE) . ',' . $this->input->post('regnumb1', TRUE);
            }

            $bc_2 = $this->input->post('ch_name2', TRUE);
            if (!empty($bc_2)) {
                $this->form_validation->set_rules('ch_name2', 'School/College/University 2st fild', '');
                $this->form_validation->set_rules('cls2', 'Result  2st fild', '');
                $this->form_validation->set_rules('regnumb2', 'Passing year 2st fild', '');
                $be_2 = $this->input->post('ch_name2', TRUE) . ',' . $this->input->post('cls2', TRUE) . ',' . $this->input->post('regmunb2', TRUE);
            }

            $bc_3 = $this->input->post('ch_name3', TRUE);
            if (!empty($bc_3)) {
                $this->form_validation->set_rules('ch_name3', 'School/College/University 3st fild', '');
                $this->form_validation->set_rules('cls3', 'Result  3st fild', '');
                $this->form_validation->set_rules('regnumb3', 'Passing year 3st fild', '');
                $be_3 = $this->input->post('ch_name3', TRUE) . ',' . $this->input->post('cls3', TRUE) . ',' . $this->input->post('regnumb3', TRUE);
            } 
            $username = $this->input->post('first_name') . ' ' . $this->input->post('last_name');
            $email    = strtolower($this->input->post('email', TRUE));
            $password = $this->input->post('password', TRUE);
            //Here is uploading the student's photo.
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '10000';
            $config['max_width'] = '10240';
            $config['max_height'] = '7680';
            $config['encrypt_name'] = TRUE;
            // $config[$username] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->do_upload();
            $uploadFileInfo = $this->upload->data(); 
            $phone = $this->input->post('phoneCode', TRUE) . '' . $this->input->post('phone', TRUE);
            //This array information's are sending to "user" table as a core information as a user this system
            $reg_number=$this->input->post('regnum', TRUE);
            $additional_data = array(
                'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
                'last_name' => $this->db->escape_like_str($this->input->post('last_name', TRUE)),
                'phone' => $this->db->escape_like_str($phone),
               );
                //This array information's are sending to "student_info" table.
                $studata = array(  
                    'year' =>  $this->db->escape_like_str($this->input->post('session', TRUE)),     
                    'class_id' => $this->db->escape_like_str($this->input->post('class_id', TRUE)),
                    'student_nam' => $this->db->escape_like_str($username),
                    'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
                    'last_name' => $this->db->escape_like_str($this->input->post('last_name', TRUE)),
                    'phone' => $this->db->escape_like_str($phone),
                    'previous_info1' => $this->db->escape_like_str($bs_1),
                    'previous_info2' => $this->db->escape_like_str($bs_2),
                    'previous_info3' => $this->db->escape_like_str($bs_3), 
                    'sibling_info1' => $this->db->escape_like_str($scol_uni1),
                    'sibling_info2' => $this->db->escape_like_str($scol_uni2),
                    'sibling_info3' => $this->db->escape_like_str($scol_uni3), 
                    'sibling_info4' => $this->db->escape_like_str($be_1),
                    'sibling_info5' => $this->db->escape_like_str($be_2),
                    'sibling_info6' => $this->db->escape_like_str($be_3), 
                    //'reg_number' => $this->db->escape_like_str($this->input->post('regnum', TRUE)),
                    //'reg_date' => $this->db->escape_like_str($this->input->post('date', TRUE)),
                    'due_date' => $this->db->escape_like_str($this->input->post('due_date', TRUE)),
                    'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
                    'last_name' => $this->db->escape_like_str($this->input->post('last_name', TRUE)),
                    'session' => $this->db->escape_like_str($this->input->post('session', TRUE)),
                    'b_form' => $this->db->escape_like_str($this->input->post('bfnumb', TRUE)),
                    //'birth_certificate' => $this->db->escape_like_str($uploadFileInfo1['file_name']),
                    'father_name' => $this->db->escape_like_str($this->input->post('father_name', TRUE)),
                    'father_cnic' => $this->db->escape_like_str($this->input->post('father_cnic', TRUE)),
                    'father_occupation' => $this->db->escape_like_str($this->input->post('father_occupation', TRUE)), 
                    'birth_date' => $this->db->escape_like_str($this->input->post('birthdate', TRUE)),
                    'gender' => $this->db->escape_like_str($this->input->post('sex', TRUE)),
                    'present_address' => $this->db->escape_like_str($this->input->post('address', TRUE)),
                    'phone' => $this->db->escape_like_str($phone),
                    'student_photo' => $this->db->escape_like_str($uploadFileInfo['file_name']),
                    'heard_from1' => $this->db->escape_like_str($this->input->post('nw', TRUE)),
                    'heard_from2' => $this->db->escape_like_str($this->input->post('bb', TRUE)),
                    'heard_from3' => $this->db->escape_like_str($this->input->post('strem', TRUE)),
                    'heard_from4' => $this->db->escape_like_str($this->input->post('flyer', TRUE)),
                    'heard_from5' => $this->db->escape_like_str($this->input->post('mouth', TRUE)),
                    'heard_from6' => $this->db->escape_like_str($this->input->post('other', TRUE))    
                );  
  
                $this->db->where('reg_number', $reg_number);
                $this->db->update('registration', $studata); 
                $reg_dat = array(
                    'class_id' => $this->db->escape_like_str($this->input->post('class_id', TRUE)), 
                    'session' =>  $this->db->escape_like_str($this->input->post('session', TRUE)),      
                    'student_nam' => $this->db->escape_like_str($username),
                ); 
                $this->db->where('reg_number', $reg_number);
                $this->db->update('registered', $reg_dat);
                $data['success'] = '<div class="alert alert-info alert-dismissable admisionSucceassMessageFont">
                                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                                    <strong>' . lang('success') . '</strong> ' . lang('stuc_2') . '
                                            </div>';
                //$data['voucher'] = $this->common->getAllData('registration');
                redirect('users/reg_stu', 'refresh');
            } else{ 
                $reg_num = $this->input->get('reg_num');
                $data['voucher'] = $this->common->getWhere('registration', 'reg_number', $reg_num); 
                $data['s_class'] = $this->common->getAllData('class');
            //$this->db->where('class_id', $class_id);
            //$data['voucher'] = $this->common->getAllData('registration');
            $this->load->view('temp/header');
            $this->load->view('editregstu', $data);
            $this->load->view('temp/footer');
        }
    }
//This function Will Return Registration Payment Page
    public function reg_pay(){ 
        if ($this->input->post('submit', TRUE)) {
            $sid = $this->input->get('id');    
            $reg_fee = $this->input->post('total', TRUE);
            $created_by = $this->input->post('u_id', TRUE);
            $reg_num = $this->input->post('regnum', TRUE);
            $total = $this->input->post('total', TRUE);
            $paid = $this->input->post('paid_amount', TRUE);
            $method = $this->input->post('method', TRUE);
            $account_name = $this->input->post('account_name', TRUE);
            $class_id = $this->common->class_id($sid);
            $regss = $this->common->reggs($sid);
            date_default_timezone_set('Asia/Karachi'); 
            $update=date("Y-m-d h:i:s A");

            $amount = $reg_fee;
            $month = date('F');
            $year = date('Y');
            $stu = 'Paid';
            $cash = 'cash';
            if ($paid > $total || $paid == $total) {
                $balance = $paid - $total;
                $status = 'Paid';
                //echo 'a';
            } elseif ($paid < $total) {
                $balance = 0;
                $due = $total - $paid;
                $status = 'Unpaid';
                //echo 'b';
            }
            $dadata = array(
                'class_id' => $this->db->escape_like_str($class_id),
                'amount' => $this->db->escape_like_str($amount),
                'total' => $this->db->escape_like_str($total),
                'year' => $this->db->escape_like_str($year),
                'month' => $this->db->escape_like_str($month),
                'status' => $this->db->escape_like_str($stu),
                'mathod' => $this->db->escape_like_str($method),
            );
            $regs = $this->common->reg_data($class_id);
            $name = $this->common->name_data($class_id);
            $patty = array(
                'class_id' => $this->db->escape_like_str($class_id),
                'name' => $this->db->escape_like_str($name),
                'reg_number' => $this->db->escape_like_str($regs),
                'status' => $this->db->escape_like_str($stu),
                'cash' => $this->db->escape_like_str($amount),
                'voucher_type' => $this->db->escape_like_str('Registration'),
                'created_by' => $this->db->escape_like_str($created_by),
            );

            $slip_data = array(
                'total' => $this->db->escape_like_str($total),
                'paid' => $this->db->escape_like_str($paid),
                'status' => $this->db->escape_like_str($status),
                'mathod' => $this->db->escape_like_str($method),
                'account_name' => $this->db->escape_like_str($account_name),
                'created_by' => $this->db->escape_like_str($created_by),
            );
    // this array update vouchers table data 
            $query=$this->db->query("SELECT * FROM vouchers WHERE student_ref_id='$reg_num' AND voucher_type='Registration'");
            $data1=$query->result_array();
            if(!empty($data1)){
            $vouchers = array(
                'voucher_status' => $this->db->escape_like_str('Paid'),
                'created_by' => $this->db->escape_like_str($created_by),
                'paid_time' => $this->db->escape_like_str($update),
                
            );
            $this->db->where('student_ref_id', $reg_num);
            $this->db->where('voucher_type', 'Registration');
            $this->db->update('vouchers', $vouchers);
           
            $this->db->insert('patty_cash', $patty);
            $this->db->where('reg_number', $reg_num);
            $this->db->update('registration', $slip_data);

            $this->db->where('reg_number', $reg_num);
            $this->db->update('registered', $slip_data);

            $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong>WOW!</strong> Your transaction was successfully processed.
                            </div>';
            $data['sit'] = $this->common->getAllData('account_title');
            $data['stu'] = $this->common->getAllData('registered');
            $this->load->view('temp/header');
            $this->load->view('registered', $data);
            $this->load->view('temp/footer');
        }
            
        } else {
            $sid = $this->input->get('id');
            $data['regfee'] = $this->input->get('regfee');
            $data['regnum'] = $this->input->get('regnum');

            $this->db->where('account_title', 'Registration Fee');
            $data['sit'] = $this->common->getAllData('account_title');
            $query1=$this->db->query("SELECT * FROM payment_methods WHERE status='active'");
            $data['pay_method']=$query1->result_array();
            //$data['pay_method'] = $this->common->getAllData('payment_mehtods');
            $data['slip_id'] = $sid;
            $this->load->view('temp/header');
            $this->load->view('account/reg_pay', $data);
            $this->load->view('temp/footer');
        }
    }
    //This Function will insert data to transection to add balance
     
    public function sub_total(){
        $date = strtotime(date('d-m-Y'));
        if ($this->input->post('income', TRUE)) {
            $account_id = $this->input->post('account_id', TRUE);
            $amount = $this->input->post('amount', TRUE);
            $pre_balence = $this->common->pre_balence();
            $balence = $pre_balence + $amount;
            $entry_info = $this->common->tran_check($account_id);
            if ($entry_info == 'no_entry') {
                $inco_data = array(
                    'date' => $this->db->escape_like_str($date),
                    'acco_id' => $this->db->escape_like_str($account_id),
                    'category' => $this->db->escape_like_str('Income'),
                    'amount' => $this->db->escape_like_str($amount),
                    'balance' => $this->db->escape_like_str($balence)
                );
                if ($this->db->insert('transection', $inco_data)) {
                    $this->db->where('account_title', 'Registration Fee');
                    redirect('users/reg_stu', 'refresh');
                }
            } else {
                $inco_data = array(
                    'date' => $this->db->escape_like_str($date),
                    'acco_id' => $this->db->escape_like_str($account_id),
                    'category' => $this->db->escape_like_str('Income'),
                    'amount' => $this->db->escape_like_str($amount + $entry_info[0]['amount']),
                    'balance' => $this->db->escape_like_str($balence)
                );
                $row_id = $entry_info[0]['id'];
                $this->db->where('id', $row_id);
                $this->db->update('transection', $inco_data);
                $this->db->where('account_title', 'Registration Fee');
                redirect('users/reg_stu', 'refresh');
                }
            }
     }


//This Will Return Degistered Students
    public function reg_student(){
        $year=date('Y');
        $this->db->where('account_title', 'Registration Fee');
        $data['sit'] = $this->common->getAllData('account_title');
        // $data['stu'] = $this->common->getAllData('registration');
        $query=$this->db->query("SELECT * FROM registration WHERE status='Paid' AND (result_status='' OR result_status='fail')"); 
        $data['stu']=$query->result_array();
        $query=$this->db->query("SELECT * FROM fee_discount WHERE status='Active' AND session_discount='$year'");      
        $data['fee_dis']=$query->result_array();
        $this->load->view('temp/header');
        $this->load->view('reg_student' , $data);
        $this->load->view('temp/footer');
    }
            // This Will Empty the whole table for registered students to ad new data for the students
    /*public function empty(){
        $query = $this->db->query("SELECT status FROM registered where status= 'Unpaid'");
        $row= $query->num_rows();
       if($row>0)
       {
        echo "please pay registration fee to proceed ";
       }else
        {
            $this->db->where('status', 'Paid');
            $this->db->delete('registered');
            redirect('users/reg_stu', 'refresh');       
        }   
    }*/
    // this function well use R student pass  and fail functionality
    public function reg_admission(){  
                if ($this->input->post('submit', TRUE)) {
                     $i = $this->input->post('in_velu', TRUE);
                for ($x = 1; $x <= $i; $x++) {
                $status = "";
                if ($this->input->post("status_$x", TRUE)) {
                    if ($this->input->post("status_$x", TRUE) === 'pass') {
                        $status = "pass";
                    } elseif($this->input->post("status_$x", TRUE) === 'fail') {
                        $status = "fail";
                    } else{
                        $status = "";
                    }
                    //$status=$this->input->post("status_$x", TRUE);
                } 
                $reason=$this->input->post("dis_reason_$x", TRUE);  
                $query=$this->db->query("SELECT * FROM fee_discount WHERE id='$reason'"); 
                $data=$query->result_array(); 
                $dis_id = "";
                $dis_reason = "";
                $admission_dis=0;
                $tution_dis=0;
                foreach($data as $row){
                    $dis_id=$row['id'];
                    $dis_reason=$row['discount_reason'];
                    $admission_dis=$row['admission_discount']; 
                    $tution_dis=$row['tution_discount'];  
                }    
                $class_id = $this->input->post("class_id_$x", TRUE);  
                $query1=$this->db->query("SELECT * FROM class_fee_structure WHERE class_id=$class_id"); 
                $data1=$query1->result_array();
                foreach($data1 as $row1){ 
                    $tution_fee=$row1['tution_fee'];
                    $ac_charges=$row1['ac_charges'];    
                }    
                // discounted tution fee 
                $dis_tut_fee=($tution_fee*$tution_dis)/100;
                $dis_tution_fee=$tution_fee-$dis_tut_fee; 
                $admission_fee=$this->common->get_admission_fee(); 
                $annual_found=$this->common->get_annual_found(); 
                // discounted admission fee 
                $dis_fee=$admission_fee*$admission_dis/100;
                $dis_admission_fee=$admission_fee-$dis_fee;  
                $disc_tot=$dis_tut_fee+$dis_fee;
                // this $total_admi_tot variable amount store on voucherstable
                $actual_total=$admission_fee+$annual_found+$tution_fee+$ac_charges; 
                $total_admi_tot=$dis_admission_fee+$annual_found+$dis_tution_fee+$ac_charges;  
                $classTitle = $this->input->post("class_title", TRUE);
                $reg_id = $this->input->post("reg_id_$x", TRUE);
                $reg_year = $this->input->post("reg_year_$x", TRUE);
                $user_id = $this->input->post("user_id_$x", TRUE);
                $class_id = $this->input->post("class_id_$x", TRUE); 
                $class_title = $this->input->post("class_title_$x", TRUE); 
                $student_name = $this->input->post("satudentName_$x", TRUE);
                $register_num = $this->input->post("register_num_$x", TRUE); 
               // $dis_reason=$this->input->post("dis_reason_$x", TRUE); 
                $reg_date = $this->input->post("reg_date_$x", TRUE);
                $due_date = $this->input->post("due_date_$x", TRUE);
                $first_name = $this->input->post("first_name_$x", TRUE);
                $last_name = $this->input->post("last_name_$x", TRUE);
                $session = $this->input->post("session_$x", TRUE);
                $b_form = $this->input->post("b_form_$x", TRUE);
                $fatherName = $this->input->post("fatherName_$x", TRUE);
                $father_cnic = $this->input->post("father_cnic_$x", TRUE);
                $father_occupation = $this->input->post("father_occupation_$x", TRUE);
                $birth_date = $this->input->post("birth_date_$x", TRUE);
                //$sex = $this->input->post("sex_$x", TRUE);
                $present_address = $this->input->post("present_address_$x", TRUE);
                $phone = $this->input->post("phone_$x", TRUE);                
                $classTitle = $this->input->post("class_title", TRUE);
                $created_by = $this->input->post("created_by_$x", TRUE);
                $voucher_number = $this->input->post("vouch_num_$x", TRUE);
                $gender = $this->input->post("gender_$x", TRUE);
               
            $pass_data = array(
                    'reg_id' => $this->db->escape_like_str($reg_id),
                    'year' => $this->db->escape_like_str($reg_year),
                    'month' => $this->db->escape_like_str(date('F')),
                    'user_id' => $this->db->escape_like_str($user_id),
                    'class_id' => $this->db->escape_like_str($class_id),
                    'class_title' => $this->db->escape_like_str($class_title),
                    'student_nam' => $this->db->escape_like_str($student_name),
                    'reg_number' => $this->db->escape_like_str($register_num),  
                    'voucher_number' => $this->db->escape_like_str($voucher_number),
                    'reg_date' => $this->db->escape_like_str($reg_date),
                    'due_date' => $this->db->escape_like_str($due_date),
                    'first_name' => $this->db->escape_like_str($first_name),
                    'last_name' => $this->db->escape_like_str($last_name),
                    'session' => $this->db->escape_like_str($session),
                    'b_form' => $this->db->escape_like_str($b_form),
                    'father_name' => $this->db->escape_like_str($fatherName),
                    'father_cnic' => $this->db->escape_like_str($father_cnic),
                    'father_occupation' => $this->db->escape_like_str($father_occupation),
                    'birth_date' => $this->db->escape_like_str($birth_date), 
                    'gender' => $this->db->escape_like_str($gender), 
                    'present_address' => $this->db->escape_like_str($present_address),
                    'phone' => $this->db->escape_like_str($phone),
                    'status' => $this->db->escape_like_str($status),
                    'admission_fee' => $this->db->escape_like_str($admission_fee),
                    'admission_disc' => $this->db->escape_like_str($dis_fee),
                    'admission_fee_disc' => $this->db->escape_like_str($dis_admission_fee),
                    'annual_found' => $this->db->escape_like_str($annual_found), 
                    'tution_fee' => $this->db->escape_like_str($tution_fee),
                    'tution_disc' => $this->db->escape_like_str($dis_tut_fee),  
                    'tution_fee_dis' => $this->db->escape_like_str($dis_tution_fee),
                    'ac_charges' => $this->db->escape_like_str($ac_charges),
                    'actual_tot' => $this->db->escape_like_str($actual_total), 
                    'total' => $this->db->escape_like_str($total_admi_tot), 
                    'disc_tot' => $this->db->escape_like_str($disc_tot),
                    'discount_reasons' => $this->db->escape_like_str($dis_id), 
                    'created_by' => $this->db->escape_like_str($created_by), 
                );    
                $fee_discount = array(  
                    'year' => $this->db->escape_like_str(date('Y')),   
                    'reg_number' => $this->db->escape_like_str($register_num),
                    'discount_id' => $this->db->escape_like_str($dis_id),
                    'discount_reason' => $this->db->escape_like_str($dis_reason),
                    'admission_discount' => $this->db->escape_like_str($admission_dis), 
                    'tution_discount' => $this->db->escape_like_str($tution_dis), 
                    'created_by' => $this->db->escape_like_str($created_by), 
                );    
                /*$fail_data = array(
                    'reg_id' => $this->db->escape_like_str($reg_id),
                    'year' => $this->db->escape_like_str($reg_year),
                    'month' => $this->db->escape_like_str(date('F')),
                    'user_id' => $this->db->escape_like_str($user_id),
                    'class_id' => $this->db->escape_like_str($class_id),
                    'student_nam' => $this->db->escape_like_str($student_name),
                    'reg_number' => $this->db->escape_like_str($register_num),  
                    'voucher_number' => $this->db->escape_like_str($voucher_number),
                    'reg_date' => $this->db->escape_like_str($reg_date),
                    'due_date' => $this->db->escape_like_str($due_date),
                    'first_name' => $this->db->escape_like_str($first_name),
                    'last_name' => $this->db->escape_like_str($last_name),
                    'session' => $this->db->escape_like_str($session),
                    'b_form' => $this->db->escape_like_str($b_form),
                    'father_name' => $this->db->escape_like_str($fatherName),
                    'father_cnic' => $this->db->escape_like_str($father_cnic),
                    'father_occupation' => $this->db->escape_like_str($father_occupation),
                    'birth_date' => $this->db->escape_like_str($birth_date),
                    'present_address' => $this->db->escape_like_str($present_address),
                    'phone' => $this->db->escape_like_str($phone),
                    'status' => $this->db->escape_like_str($status),  
                    'created_by' => $this->db->escape_like_str($created_by),    
                );  */
                $status_data = array(
                    'result_status' => $this->db->escape_like_str($status),
                    'created_by' => $this->db->escape_like_str($created_by),      
                );    
                $voucher_data = array(
                    'voucher_type' => $this->db->escape_like_str('Admission'),
                    'student_ref_id' => $this->db->escape_like_str($register_num),
                    'voucher_number' => $this->db->escape_like_str($voucher_number),
                    'total_amount' => $this->db->escape_like_str($total_admi_tot),
                    'month_id' => $this->db->escape_like_str(date('m')),
                    'month_name' => $this->db->escape_like_str(date('F')),
                    'voucher_status' => $this->db->escape_like_str('unpaid'),
                    'created_by' => $this->db->escape_like_str($created_by),
                );  
                $this->db->insert('vouchers', $voucher_data); 
                //insert the $status_data information into "registration" database.
                $this->db->where('reg_number', $register_num);
                $this->db->update('registration', $status_data);
                //insert the $pass_data information into "register_pass" database.
                   
                    if($status=="pass"){ 
                       $this->db->insert('student_fee_discount', $fee_discount);
                       $this->db->insert('register_pass', $pass_data);
                    }/* else if($status =="fail"){
                       $this->db->insert('register_pass', $fail_data);
                   } */
                }    
                redirect('users/pass_student', 'refresh');
            }  
         }
// this function get and display  pass student data 
        public function pass_student(){
            $data['status'] = $this->common->pass_student();
            $this->load->view('temp/header');
            $this->load->view('pass_student', $data);
            $this->load->view('temp/footer');
        } 
    // this function ajax  call for display pay methods
    public function ajaxBankResult() { 
        $pay_method = $this->input->get('q');  
         
        if($pay_method=="Cash" || $pay_method=="cash") {} 
        else{    
        $query=$this->db->query("SELECT account_name FROM payment_methods WHERE payment_method='$pay_method'"); 
        $data=$query->result_array();
        echo'
            <div class="form-group">
            <label class="col-md-3 control-label">' . "Select Bank Name" . ' <span class="requiredStar"> * </span></label>
            <div class="col-md-5">
                <select onchange="salaryAmount(this.value)" class="form-control" name="account_name" data-validation="required" data-validation-error-msg="' . lang('teac_11') . '">
                    <option value="">' . lang('select') . '</option>';
                foreach($data as $row){
                echo '<option value="'.$row['account_name'].'"> '.$row['account_name'].'</option>';
                }
            echo '</select>
            </div>
            </div>'; 
        }
    }  
}
