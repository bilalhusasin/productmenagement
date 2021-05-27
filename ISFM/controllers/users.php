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
 
 
    //This function will add new admin users in this system  
    public function addNewUsers() {
        if ($this->input->post('submit', TRUE)) { 

            $username = $this->input->post('name');
            $email = strtolower($this->input->post('email', TRUE));
            $password = $this->input->post('password', TRUE); 
 
            //This array information's are sending to "user" table as a core information as a user this system.
            $additional_data = array(
                'first_name' => $this->db->escape_like_str($this->input->post('name', TRUE)),    
            );

            $group_ids = array(
                'group_id' => $this->db->escape_like_str($this->input->post('group', TRUE))
            );

                if ($this->ion_auth->register($username, $password, $email, $additional_data, $group_ids)) {
                    //This the next user id in users table. If we " -1 " from it we can get current user id 
                    $userid = $this->common->usersId();
                    //This array information's are sending to "teachers_info" table.
                    $additional_data2 = array(
                        'first_name' => $this->db->escape_like_str($this->input->post('name', TRUE)), 
                        'full_name' => $this->db->escape_like_str($username),
                        'user_id' => $this->db->escape_like_str($userid), 
                        'dempass' => $this->db->escape_like_str($this->input->post('password', TRUE)), 
                        'group_id' => $this->db->escape_like_str($this->input->post('group', TRUE)),
                        'employ_id' => $this->db->escape_like_str($this->input->post('employ_id', TRUE)),
                        'emp_roll' => $this->db->escape_like_str($this->input->post('emp_roll', TRUE)), 
                    ); 

                    $this->db->insert('userinfo', $additional_data2);
                    //Load the Teachers Information's page after Add New Teacher.
                    redirect('users/allUserInafo', 'refresh');
                   
                } else {
                    
                     // this query get all active groups data 
                    $query1 = $this->db->query("SELECT * FROM groups where status= 'Active'");
                    $data['groupsname']=$query1->result_array();
                    //display the create user form
                    $this->load->view('temp/header');
                    $this->load->view('addNewUser', $data);
                    $this->load->view('temp/footer');
                }
           
        } else { 
             // this query get all active groups data 
            $query1 = $this->db->query("SELECT * FROM groups where status= 'Active'");
            $data['groupsname']=$query1->result_array();
            //display the create user form
            $this->load->view('temp/header');
            $this->load->view('addNewUser', $data);
            $this->load->view('temp/footer');
        }
    }

    //This function is genrate and return employ id and employ roll id
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
    
    //This function will Add  new user group in groups table.
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
 
     
}
