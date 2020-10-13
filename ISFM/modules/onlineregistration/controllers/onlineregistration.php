<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class onlineregistration extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('onlineregistrationmodel');
    }
    //This function will use for make leave application
    
    public function index(){

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
             
        //$this->load->view('temp/header');
        $this->load->view('onlineRegistration', $data);
        //$this->load->view('temp/footer');
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

            $query1= $this->db->query("SELECT registration_fee FROM fee_structure WHERE session=date('Y')");
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
                $year = date('Y');
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

                // $data['success'] = '<div class="alert alert-success alert-dismissable">
                //                 <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                //                 <strong>Success!</strong> Student Registration Successfully processed.
                //             </div>';
                $this->session->set_userdata(array('msg_type'=>'success'));
                $this->session->set_flashdata('success',"Student Registration Successfully processed."); 
                redirect('onlineregistration/index'); 
        }  
    }
}
