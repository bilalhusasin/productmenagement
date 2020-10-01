<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Students extends MX_Controller {

    /**
     * This controller is using for controlling to students
     *
     * Maps to the following URL
     * 		http://example.com/index.php/users
     * 	- or -  
     * 		http://example.com/index.php/users/<method_name>
     */
    function __construct() {
        parent::__construct();
        $this->load->model('studentmodel');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
    }
    //This function is used for get all students in this system.
    public function allStudent() {
        if ($this->input->post('submit', TRUE)) {
            $data['class_id'] = $this->input->post('class', TRUE); 
            //If "class" and "section" fild is not empty the run this condition
            if ($this->input->post('class', TRUE) && $this->input->post('section', TRUE)) {
                //Search student by class,section.
                $class = $this->input->post('class', TRUE);
                $section = $this->input->post('section', TRUE);
                $status = $this->input->post('status', TRUE);
                $data['status']=$status;
            if($status=='Active'){
                 $data['section'] = $section;
                if ($section == 'all') {
                    $data['studentInfo'] = $this->studentmodel->getStudentByClassSection($class, $section);
                    if (!empty($data)) { 
                        //If the class have student then run here.
                        $this->load->view('temp/header');
                        $this->load->view('studentclass', $data);
                        $this->load->view('temp/footer');
                    } else {
                        //If the class have no any student then print the massage in the view.
                        $data['message'] = 'This class is no student.';
                        $this->load->view('temp/header');
                        $this->load->view('studentclass', $data);
                        $this->load->view('temp/footer');
                    }
                } else {
                    $data['studentInfo'] = $this->studentmodel->getStudentByClassSection($class, $section);
                    if (!empty($data)) { 
                        //If the class have student then run here.
                        $this->load->view('temp/header');
                        $this->load->view('studentclass', $data);
                        $this->load->view('temp/footer');
                    } else {
                        //If the class have no any student then print the massage in the view.
                        $data['message'] = lang('stuc_1');
                        $this->load->view('temp/header');
                        $this->load->view('studentclass', $data);
                        $this->load->view('temp/footer');
                    }
                }
            } elseif($status=="Defaulter"){
               $data['section'] = $section;
                if ($section == 'all') { 
                    $data['studentInfo'] = $this->studentmodel->getDeactiveStudentByClassSection($class, $section); 
                    if (!empty($data)) { 
                        //If the class have student then run here.
                        $this->load->view('temp/header');
                        $this->load->view('studentclass', $data);
                        $this->load->view('temp/footer');
                    } else {
                        //If the class have no any student then print the massage in the view.
                        $data['message'] = 'This class is no student.';
                        $this->load->view('temp/header');
                        $this->load->view('studentclass', $data);
                        $this->load->view('temp/footer');
                    }
                } else {
                     $data['studentInfo'] = $this->studentmodel->getDeactiveStudentByClassSection($class, $section); 
                    if (!empty($data)) { 
                        //If the class have student then run here.
                        $this->load->view('temp/header');
                        $this->load->view('studentclass', $data);
                        $this->load->view('temp/footer');
                    } else {
                        //If the class have no any student then print the massage in the view.
                        $data['message'] = lang('stuc_1');
                        $this->load->view('temp/header');
                        $this->load->view('studentclass', $data);
                        $this->load->view('temp/footer');
                    }
                }
            } elseif($status='Schoolleft'){
                $data['section'] = $section;
                if ($section == 'all') { 
                    $data['studentInfo'] = $this->studentmodel->getSchoolLeftStudent($class, $section);
                    if (!empty($data)) { 
                        //If the class have student then run here.
                        $this->load->view('temp/header');
                        $this->load->view('studentclass', $data);
                        $this->load->view('temp/footer');
                    } else {
                        //If the class have no any student then print the massage in the view.
                        $data['message'] = 'This class is no student.';
                        $this->load->view('temp/header');
                        $this->load->view('studentclass', $data);
                        $this->load->view('temp/footer');
                    }
                } else { 
                    $data['studentInfo'] = $this->studentmodel->getSchoolLeftStudent($class, $section);
                    if (!empty($data)) {
                        //If the class have student then run here.
                        $this->load->view('temp/header');
                        $this->load->view('studentclass', $data);
                        $this->load->view('temp/footer');
                    } else {
                        //If the class have no any student then print the massage in the view.
                        $data['message'] = lang('stuc_1');
                        $this->load->view('temp/header');
                        $this->load->view('studentclass', $data);
                        $this->load->view('temp/footer');
                    }
                }

            }
               
            } elseif ($this->input->post('class', TRUE)) {
                //onley search student by class or all student the class.
                $class = $this->input->post('class', TRUE);
                $data['studentInfo'] = $this->studentmodel->getAllStudent($class);
                if (!empty($data)) {
                    //If the class have student then run here.
                    $this->load->view('temp/header');
                    $this->load->view('studentclass', $data);
                    $this->load->view('temp/footer');
                } else {
                    //If the class have no any student then print the massage in the view.
                    $data['message'] = lang('stuc_1');
                    $this->load->view('temp/header');
                    $this->load->view('studentclass', $data);
                    $this->load->view('temp/footer');
                }
            }
        } else {
            //First of all this method run here and load class selecting view.
            $data['s_class'] = $this->common->selectClass();
            $this->load->view('temp/header');
            $this->load->view('slectStudent', $data);
            $this->load->view('temp/footer');
        }
    }
    //This function is used for filtering to get students information
    //Whene class and section gave in the frontend, if the class have section he cane select the section and get student information in the viwe.
    public function section() {
        $class_id = $this->input->get('q');
        $query = $this->db->query("SELECT class_title, section FROM class WHERE id=$class_id");
        foreach ($query->result_array() as $row) {
            $data = $row;
        }
        echo '<input type="hidden" name="class" value="' . $class_id . '">';
        if (!empty($data['section'])) {
            $section = $data['section'];
            $sectionArray = explode(",", $section);
             echo '<div class="form-group">
                        <label class="col-md-3 control-label">Section</label>
                        <div class="col-md-4">
                            <select name="section" class="form-control">
                                <option value="">Select...</option>
                                <option value="all">' . lang('stu_sel_cla_velue_all') . '</option>';
            foreach ($sectionArray as $sec) {
                echo '<option value="' . $sec . '">' . $sec . '</option>';
            }
            echo '</select></div> </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Student Status</label>
                    <div class="col-md-4">
                        <select name="status" class="form-control">
                            <option value="">Select...</option>
                            <option value="Active">' . "Active" . '</option>
                            <option value="Defaulter">' . "Defaulter" . '</option>
                            <option value="Schoolleft">' . "Schoolleft" . '</option>
                        </select>
                    </div> 
                </div> ';
        } else {
            echo '<div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                        <div class="alert alert-warning">
                                <strong>' . lang('stu_sel_cla_no_Info') . '</strong> ' . lang('stu_sel_cla_no_section') . '
                        </div></div></div>';
        }
    } 
    public function ajaxClassSection() {
        $classTitle = $this->input->get('classTitle');
        $query = $this->common->getWhere('class', 'class_title', $classTitle);
        foreach ($query as $row) {
            $data = $row['section'];
        }
        if (!empty($data)) {
            $sectionArray = explode(",", $data);
            echo '<div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-4">
                            <select name="section" class="form-control">
                                <option value="all">' . lang('stu_sel_cla_velue_all') . '</option>';
            foreach ($sectionArray as $sec) {
                echo '<option value="' . $sec . '">' . $sec . '</option>';
            }
            echo '</select></div>
                    </div>';
        } else {
            echo '<div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                        <div class="alert alert-warning">
                                <strong>' . lang('stu_sel_cla_no_Info') . '</strong> ' . lang('stu_sel_cla_no_section') . '
                        </div></div></div>';
        }
    }
    //This function is giving a student's the full information. 
    public function students_details() {
        $id = $this->input->get('id');
        $studentId = $this->input->get('sid');
        $data['studentInfo'] = $this->studentmodel->studentDetails($studentId);
        $data['photo'] = $this->studentmodel->studentPhoto($studentId);
        $this->load->view('temp/header');
        $this->load->view('studentsDetails', $data);
        $this->load->view('temp/footer');
    }
    //This function is use for edit student's informations.
    public function editStudent() {
        $studentClass = $this->input->get('id');
        $studentInfoId = $this->input->get('sid');
        $class_id = $this->input->get('class_id');
        // $userId = $this->input->get('userId');
        
        if ($this->input->post('submit', TRUE)) {
           $status= $this->input->post('status', TRUE);
          if($status=="Active" OR $status=="Defaulter"){
            $username = $this->input->post('first_name', TRUE) . ' ' . $this->input->post('last_name', TRUE);
            /*$additional_data = array(
                'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
                'last_name' => $this->db->escape_like_str($this->input->post('last_name', TRUE)),
                'username' => $this->db->escape_like_str($username),
                'phone' => $this->db->escape_like_str($this->input->post('phone', TRUE)),
                // 'email' => $this->db->escape_like_str($this->input->post('email', TRUE))
            );
            $this->db->where('id', $userId);
            $this->db->update('users', $additional_data); */  
            $studentsInfo = array(
                'student_id' => $this->db->escape_like_str($this->input->post('student_id', TRUE)),
                'class_id' => $this->db->escape_like_str($this->input->post('class', TRUE)),
                'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
                'last_name' => $this->db->escape_like_str($this->input->post('last_name', TRUE)),
                'student_nam' => $this->db->escape_like_str($username), 
                'farther_name' => $this->db->escape_like_str($this->input->post('father_name', TRUE)),
                'mother_name' => $this->db->escape_like_str($this->input->post('mother_name', TRUE)),
                'birth_date' => $this->db->escape_like_str($this->input->post('birthdate', TRUE)),
                'phone' => $this->db->escape_like_str($this->input->post('phone', TRUE)),
                'gender' => $this->db->escape_like_str($this->input->post('sex', TRUE)),
                'present_address' => $this->db->escape_like_str($this->input->post('present_address', TRUE)),
                'permanent_address' => $this->db->escape_like_str($this->input->post('permanent_address', TRUE)),
                'father_occupation' => $this->db->escape_like_str($this->input->post('father_occupation', TRUE)),
               // 'father_incom_range' => $this->db->escape_like_str($this->input->post('father_incom_range', TRUE)),
                'mother_occupation' => $this->db->escape_like_str($this->input->post('mother_occupation', TRUE)),
                'last_class_certificate' => $this->db->escape_like_str($this->input->post('previous_certificate', TRUE)),
                't_c' => $this->db->escape_like_str($this->input->post('tc', TRUE)),
                'academic_transcription' => $this->db->escape_like_str($this->input->post('at', TRUE)),
                'national_birth_certificate' => $this->db->escape_like_str($this->input->post('nbc', TRUE)),
                'testimonial' => $this->db->escape_like_str($this->input->post('testmonial', TRUE)),
                'documents_info' => $this->db->escape_like_str($this->input->post('submit_file_information', TRUE)),
                //'blood' => $this->db->escape_like_str($this->input->post('blood', TRUE)),
                'status' => $this->db->escape_like_str($this->input->post('status', TRUE)),
                'status_reason' => $this->db->escape_like_str($this->input->post('status_reason', TRUE)),
                'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE)),

            ); 
            $this->db->where('student_id', $studentInfoId);
            $this->db->update('student_info', $studentsInfo);
            $additionalData3 = array(
               // 'class_title' => $this->db->escape_like_str($this->input->post('class')),
                'student_title' => $this->db->escape_like_str($username),
                'status' => $this->db->escape_like_str($this->input->post('status', TRUE)),
                'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE)),
                //'section' => $this->db->escape_like_str($this->input->post('section'))
            );
            $this->db->where('student_id', $studentInfoId);
            $this->db->update('class_students', $additionalData3);
            $preStudentsInfo = array(
                'year' => $this->db->escape_like_str($this->input->post('pre_year', TRUE)),
                'first_name' => $this->db->escape_like_str($this->input->post('pre_first_name', TRUE)),
                'last_name' => $this->db->escape_like_str($this->input->post('pre_last_name', TRUE)),
                'student_nam' => $this->db->escape_like_str($this->input->post('pre_stu_name', TRUE)), 
                'farther_name' => $this->db->escape_like_str($this->input->post('pre_father_name', TRUE)),
                'mother_name' => $this->db->escape_like_str($this->input->post('pre_mother_name', TRUE)),
                'birth_date' => $this->db->escape_like_str($this->input->post('pre_birth_date', TRUE)),
                'gender' => $this->db->escape_like_str($this->input->post('pre_gender', TRUE)), 
                'phone' => $this->db->escape_like_str($this->input->post('pre_phone', TRUE)),
                'class_title' => $this->db->escape_like_str($this->input->post('pre_class_title', TRUE)), 
                'class_id' => $this->db->escape_like_str($this->input->post('pre_class_id', TRUE)),
                'section' => $this->db->escape_like_str($this->input->post('pre_sec', TRUE)),
                'student_id' => $this->db->escape_like_str($this->input->post('pre_student_id', TRUE)),
                'roll_number' => $this->db->escape_like_str($this->input->post('pre_roll_number', TRUE)),
                'present_address' => $this->db->escape_like_str($this->input->post('pre_present_address', TRUE)),
                'permanent_address' => $this->db->escape_like_str($this->input->post('pre_permanent_address', TRUE)),  
                'documents_info' => $this->db->escape_like_str($this->input->post('pre_doc_info', TRUE)), 
                'status' => $this->db->escape_like_str($this->input->post('status', TRUE)),
                'status_reason' => $this->db->escape_like_str($this->input->post('status_reason', TRUE)),
                'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE)),

            ); 
            $this->db->insert('student_previous_info', $preStudentsInfo); 
            } else{
                $leftOverStudent = array(
                    'year' => $this->db->escape_like_str($this->input->post('pre_year', TRUE)), 
                    'class_id' => $this->db->escape_like_str($this->input->post('pre_class_id', TRUE)),
                    'class_title' => $this->db->escape_like_str($this->input->post('pre_class_title', TRUE)), 
                    'section' => $this->db->escape_like_str($this->input->post('pre_sec', TRUE)), 
                    'student_id' => $this->db->escape_like_str($this->input->post('pre_student_id', TRUE)),
                    'roll_number' => $this->db->escape_like_str($this->input->post('pre_roll_number', TRUE)),
                    'registration_number' => $this->db->escape_like_str($this->input->post('reg_number', TRUE)),
                    'left_over_status' => $this->db->escape_like_str($this->input->post('status', TRUE)),
                    'left_over_reason' => $this->db->escape_like_str($this->input->post('status_reason', TRUE)),
                    'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE))
                );  
                $this->db->insert('left_over_student_info', $leftOverStudent);
                $student_info = array( 
                    'status' => $this->db->escape_like_str($this->input->post('status', TRUE)),
                    'status_reason' => $this->db->escape_like_str($this->input->post('status_reason', TRUE)),
                    'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE))
                );  
                $this->db->where('student_id', $studentInfoId);
                $this->db->update('student_info', $student_info);
                $class_student = array( 
                    'status' => $this->db->escape_like_str($this->input->post('status', TRUE)), 
                    'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE))
                );  
                $this->db->where('student_id', $studentInfoId);
                $this->db->update('class_students', $class_student);
                $previous_info = array( 
                    'status' => $this->db->escape_like_str($this->input->post('status', TRUE)),
                    'status_reason' => $this->db->escape_like_str($this->input->post('status_reason', TRUE)),
                    'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE))
                );  
                $this->db->where('student_id', $studentInfoId);
                $this->db->update('student_previous_info', $previous_info);

            }
            $data['success'] = '<div class="alert alert-info alert-dismissable admisionSucceassMessageFont">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                    <strong>' . lang('success') . '</strong> ' . lang('stuc_2') . '
                                </div>';
            $data['classStudents'] = $this->common->getWhere('class_students', 'id', $studentClass);
            $data['studentInfo'] = $this->common->getWhere('student_info', 'student_id', $studentInfoId);
            // $data['users'] = $this->common->getWhere('users', 'id', $userId);
            $data['s_class'] = $this->common->getAllData('class');
            $data['section'] = $this->studentmodel->section($class_id);
            $this->load->view('temp/header');
            $this->load->view('slectStudent', $data);
            $this->load->view('temp/footer');
        } else {
            //first here load the edit student view with student's previous value.
            $data['classStudents'] = $this->common->getWhere('class_students', 'id', $studentClass);
           // $data['users'] = $this->common->getWhere('users', 'id', $userId);
            $data['studentInfo'] = $this->common->getWhere('student_info', 'student_id', $studentInfoId);
            
            $data['s_class'] = $this->common->getAllData('class');
            $data['section'] = $this->studentmodel->section($class_id);
            $this->load->view('temp/header');
            $this->load->view('editStudentInfo', $data);
            $this->load->view('temp/footer');
        }
    }
    //This function is use for delete a student.
    public function studentDelete() {
        $id = $this->input->get('di');
        $studentInfoId = $this->input->get('sid');
        echo $id.'check kro ides'. $studentInfoId;
        die;
        if ($this->db->delete('class_students', array('id' => $id)) && $this->db->delete('student_info', array('id' => $studentInfoId))) {
            redirect('students/allStudent');
        }
    }
     //This function will Delete the Student Record
    public function delete(){
        $id = $this->input->get('id');
        $stu = $this->input->get('sid'); 
        $this->db->delete('class_students', array('student_id' => $stu));
        $this->db->delete('student_info', array('student_id' => $stu));

        redirect('students/allStudent', 'refresh');
    }
    //This function will return only logedin students information
    public function studentsInfo() {
        $uid = $this->input->get('uisd');
        $data['studentInfo'] = $this->studentmodel->ownStudentDetails($uid);
        $data['photo'] = $this->studentmodel->ownStudentPhoto($uid);
        $this->load->view('temp/header');
        $this->load->view('studentsDetails', $data);
        $this->load->view('temp/footer');
    }
    public function reason(){
        $status = $this->input->get('q');
        if($status=="Deactive" OR $status=="Defaulter" OR $status=="Schoolleft"){
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
    // this function studentClassPromote in new class
    public function studentClassPromote(){
        if($this->input->post('submit', TRUE)){
           $student_id= $this->input->post('pro_stu_id', TRUE);
            $classPromote = array( 
                'student_title' => $this->db->escape_like_str($this->input->post('st_name', TRUE)), 
                'father_name' => $this->db->escape_like_str($this->input->post('fa_name', TRUE)),
                'mother_name' => $this->db->escape_like_str($this->input->post('mo_name', TRUE)), 
                'student_id' => $this->db->escape_like_str($this->input->post('pro_stu_id', TRUE)),
                'roll_number' => $this->db->escape_like_str($this->input->post('pre_roll_num', TRUE)),
                'reg_number' => $this->db->escape_like_str($this->input->post('reg_number', TRUE)),
                'class_title' => $this->db->escape_like_str($this->input->post('pre_class_title', TRUE)), 
                'class_id' => $this->db->escape_like_str($this->input->post('pre_class_id', TRUE)),
                'section' => $this->db->escape_like_str($this->input->post('pre_section', TRUE)),
                'promotion_reason' => $this->db->escape_like_str($this->input->post('promotion_reason', TRUE)),
                'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE)),
            );
            $this->db->insert('prevoius_class_students', $classPromote);
            $updateClassPromote = array(  
                'student_id' => $this->db->escape_like_str($this->input->post('pro_stu_id', TRUE)),
                'class_title' => $this->db->escape_like_str($this->input->post('class_title', TRUE)), 
                'class_id' => $this->db->escape_like_str($this->input->post('class_id', TRUE)),
                'roll_number' => $this->db->escape_like_str($this->input->post('roll_number', TRUE)),  
                'section' => $this->db->escape_like_str($this->input->post('section', TRUE)),
                'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE)),
            );  
            $this->db->where('student_id', $student_id);
            $this->db->update('student_info', $updateClassPromote);
            $this->db->where('student_id', $student_id);
            $this->db->update('class_students', $updateClassPromote);
            

            $data['success'] = '<div class="alert alert-info alert-dismissable admisionSucceassMessageFont">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                    <strong>' . lang('success') . '</strong> ' . lang('stuc_2') . '
                                </div>';  
            $data['s_class'] = $this->common->getAllData('class');
            $this->load->view('temp/header');
            $this->load->view('studentClassPeromote', $data);
            $this->load->view('temp/footer');

        }else{
            $data['s_class'] = $this->common->getAllData('class');
            $this->load->view('temp/header');
            $this->load->view('studentClassPeromote', $data);
            $this->load->view('temp/footer');
        }
    }
    // this function will return ajax call
    public function ajaxStudendresult(){ 
        $student_id = $this->input->get('q');  
        $query=$this->db->query("SELECT student_id FROM student_info WHERE student_id='$student_id'"); 
        $data=$query->result_array();
        if(!empty($data)){
            $query1=$this->db->query("SELECT * FROM student_info WHERE student_id='$student_id'"); 
            $data1=$query1->result_array(); 
                echo'
                        <input type="hidden" name="st_name" value="'.$data1[0]['student_nam'].'" readonly="">
                        <input type="hidden" name="fa_name" value="'.$data1[0]['farther_name'].'" readonly="">
                        <input type="hidden" name="mo_name" value="'.$data1[0]['mother_name'].'" readonly="">
                <div class="form-group">
                    <label class="col-md-4 control-label">' . "Roll Number" . ' <span class="requiredStar"> * </span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="pre_roll_num" value="'.$data1[0]['roll_number'].'" readonly=""> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">' . "Registration Number" . '<span class="requiredStar"> * </span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="reg_number" value="'.$data1[0]['registration_number'].'" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">'."Class Title".'<span class="requiredStar"> * </span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="pre_class_title" value="'.$data1[0]['class_title'].'" readonly="">
                        <input type="hidden" name="pre_class_id" value="'.$data1[0]['class_id'].'" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">'."Section".'<span class="requiredStar"> * </span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="pre_section" value="'.$data1[0]['section'].'" readonly="">
                    </div>
                </div>'; 
            
        }else{
                echo '<div class="form-group">
                    <label class="col-md- control-label"></label>
                        <div class="col-md-12">
                        <div class="alert alert-danger">
                            <strong>Info:</strong> This Student ID Is Not Matching In Our Student\'s List.
                    </div></div></div>';
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
        $class_title=$this->common->class_title($Class_id);
        //making here Class Section fild.
        if (!empty($data['section'])) {
            $section = $data['section'];
            $sectionArray = explode(",", $section);

            echo '
            <input type="text" name="class_title" value="'.$class_title.'" readonly>
            <div class="form-group">
                <label class="col-md-4 control-label">Section <span class="requiredStar"> * </span></label>
                    <div class="col-md-8">
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
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-8">
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
            $rollNumber = '00' . $roll;
        } elseif (strlen($roll) == 2) {
            $rollNumber = '0' . $roll;
        } elseif (strlen($roll) == 3) {
            $rollNumber = $roll;
        }
        /*$finalStudentId = date("Y") . $classId . $rollNumber; 
        echo '<div class="form-group">
                    <label class="col-md-4 control-label">Student\'s ID <span class="requiredStar"> * </span></label>
                    <div class="col-md-8">
                        <input type="text" name="student_id" class="form-control" value="' . $finalStudentId . '" readonly>
                    </div>
                </div>'; */
        //making here Class Roll Number fild.
        echo '<div class="form-group">
                    <label class="col-md-4 control-label">Roll Number <span class="requiredStar"> * </span></label>
                    <div class="col-md-8">
                        <input type="text" name="roll_number" class="form-control" value="' . $rollNumber . '">
                    </div>
                </div>';
    }
}
