<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Parents extends CI_Controller {
    /**
     * This controller is using for 
     *
     * Maps to the following URL
     * 		http://example.com/index.php/parents
     * 	- or -  
     * 		http://example.com/index.php/parents/<method_name>
     */
    function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
    } 
    //This function lode a view where is select class for know about parents infomation
    public function parentsInformation() {
        if ($this->input->post('submit', TRUE)) {
            if(!empty($this->input->post('class_id', TRUE) AND $this->input->post('section', TRUE))){
                $class_id = $this->input->post('class_id', TRUE); 
                $section = $this->input->post('section', TRUE);
                $data['section']=$section;
                $data['classTitle'] = $this->common->class_title($class_id);
                $query = $this->db->query("SELECT `guardian_cnic` FROM student_info WHERE class_id=$class_id AND section= '$section'" ); 
                foreach ($query->result_array() as $row) {
                    $g_cnic = $row['guardian_cnic'];
                } 
                /*$data['parents'] = $this->common->getWhere('parents_info', 'class_id', $class_id, 'section',$section);*/
               $data['parents'] = $this->common->getWhere('parents_info', 'parents_cnic', $g_cnic);
                $this->load->view('temp/header');
                $this->load->view('parentsInformation', $data);
                $this->load->view('temp/footer');
            } else{
                        
                echo '<script type="text/javascript">'; 
                echo 'window.alert("Please Select Class Name and Class Section First");';  
                echo '</script>';
                redirect("parents/parentsInformation", 'refresh');
            }

        } else {
            $data['s_class'] = $this->common->getAllData('class');
            $this->load->view('temp/header');
            $this->load->view('parents', $data);
            $this->load->view('temp/footer');
        }
    }
    //This function is used for filtering to get students information(which class and which section if the section in that class)
    //If any one want to select class section for get that section's parents thene he can call this ajax function from view file.
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
    public function ajaxClassSection() {
        $classTitle = $this->input->get('q');
        $query = $this->common->getWhere('class', 'class_title', $classTitle);
        foreach ($query as $row) {
            $data = $row;
        }
        echo '<input type="hidden" name="class" value="' . $classTitle . '">';
        if (!empty($data['section'])) {
            $section = $data['section'];
            $sectionArray = explode(",", $section);
            echo '<div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-4">
                            <select name="section" class="form-control">
                                <option value="all">' . lang('parc_1') . '</option>';
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
                                <strong>' . lang('parc_2') . '</strong> ' . lang('parc_3') . '
                        </div></div></div>';
        }
    }
    //This function will update the parents information.
    public function editParentsInfo() {  
        //$userID = $this->input->get('puid');
        //$parentsInfoId = $this->input->get('painid');
        if ($this->input->post('submit', TRUE)) {
            $p_cnic = $this->input->post('p_cnic', TRUE);
            $username = $this->input->post('first_name', TRUE) . ' ' . $this->input->post('last_name', TRUE);
            $additional_data = array(
                'username' => $this->db->escape_like_str($username),
                'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
                'last_name' => $this->db->escape_like_str($this->input->post('last_name', TRUE)),
                'user_cnic' => $this->db->escape_like_str($p_cnic),
                'phone' => $this->db->escape_like_str($this->input->post('phone', TRUE)),
                'email' => $this->db->escape_like_str($this->input->post('email', TRUE))
            );
            /*echo "<pre>";
            print_r($additional_data);
            echo "</pre>";*/
            $this->db->where('user_cnic', $p_cnic);
            $this->db->update('users', $additional_data);
            $additionalData1 = array(
                'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
                'last_name' => $this->db->escape_like_str($this->input->post('last_name', TRUE)),
                'parents_name' => $this->db->escape_like_str($username),
                'parents_cnic' => $this->db->escape_like_str($p_cnic),
                'relation' => $this->db->escape_like_str($this->input->post('guardianRelation', TRUE)),
                'email' => $this->db->escape_like_str($this->input->post('email', TRUE)),
                'phone' => $this->db->escape_like_str($this->input->post('phone', TRUE)),
            );
            /*echo "<pre>";
            print_r($additionalData1);
            echo "</pre>";
            die;*/
            $this->db->where('parents_cnic', $p_cnic);
            $this->db->update('parents_info', $additionalData1);
            $data['s_class'] = $this->common->getAllData('class');
            $data['success'] = '<br><div class="col-md-12"><div class="alert alert-info alert-dismissable admisionSucceassMessageFont">
                                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                                <strong>' . lang('success') . '</strong>' . lang('parc_4') . '
                                        </div></div>';
            $this->load->view('temp/header');
            $this->load->view('parents', $data);
            $this->load->view('temp/footer');
        } else {
            $p_cnic = $this->input->get('p_cnic'); 
            $data['info'] = $this->common->getWhere('parents_info', 'parents_cnic', $p_cnic);
            $this->load->view('temp/header');
            $this->load->view('editParents', $data);
            $this->load->view('temp/footer');
        }
    }
    public function viewParentsInfo() {
            $pcnic = $this->input->get('p_cnic');
           // $pid = $this->input->get('painid');
           // $section_name = $this->input->get('section');
            
            $query= $this->db->query("SELECT * FROM student_info WHERE guardian_cnic='$pcnic'");
            $data['student_info']=$query->result_array();

            $query= $this->db->query("SELECT * FROM parents_info WHERE parents_cnic='$pcnic'");
            $data['perants_info']=$query->result_array();
           // $data['info'] = $this->common->getWhere('parents_info', 'id', $parentsInfoId);
            //$data['user_id'] = $pid;
            //$data['section'] = $section_name;
            $this->load->view('temp/header');
            $this->load->view('viewParents', $data);
            $this->load->view('temp/footer');
       
    }
    //This function is using for delete any parents profile.
    public function deleteParents() {
        $userID = $this->input->get('puid');
        $p_cnic = $this->input->get('p_cnic');
         
        $this->db->delete('users', array('user_cnic' => $p_cnic));
        $this->db->delete('parents_info', array('parents_cnic' => $p_cnic));
        $this->db->delete('role_based_access', array('user_id' => $userID));

        redirect("parents/parentsInformation", 'refresh');
    }
} 
