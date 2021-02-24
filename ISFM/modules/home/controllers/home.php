<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Home extends MX_Controller {
/**
* Index Page for this controller.
*
* Maps to the following URL
        *       http://example.com/index.php/home
    *   - or -
        *       http://example.com/index.php/home/index
*/
function __construct() {
    parent::__construct();
    $this->load->model('common');
    $this->load->model('homeModel');
    $this->load->helper('file');
    $this->load->helper('form');
    if (!$this->ion_auth->logged_in()) {
        redirect('auth/login');
    }
}
//This function will show the users dashboard
public function index() {
$user = $this->ion_auth->user()->row();
$id = $user->id;
$data['massage'] = $this->common->getWhere('massage', 'receiver_id', $id);
$data['totalStudent'] = $this->common->totalStudent();
$data['totalTeacher'] = $this->common->totalTeacher();
$data['totalParents'] = $this->common->totalParents();
$data['totalAttendStudent'] = $this->common->totalAttendStudent();
$data['teacherAttendance'] = $this->common->teacherAttendance();
$data['presentEmploy'] = $this->homeModel->presentEmploy();
$data['absentEmploy'] = $this->homeModel->absentEmploy();
$data['leaveEmploy'] = $this->homeModel->leaveEmploy();
$data['event'] = $this->homeModel->all_event($id);
$data['notice'] = $this->common->getAllData('notice_board');
$data['classAttendance'] = $this->homeModel->atten_chart();
$data['classInfo'] = $this->common->classInfo();
if ($this->ion_auth->is_student()) {
//Whice notice is created for student these notice can see both students and parents.
$query = $this->common->getWhere('student_info', 'user_id', $id);
foreach ($query as $row) {
$class_id = $row['class_id'];
}
$data['class_id'] = $class_id;
$data['day'] = $this->common->getAllData('config_week_day');
$data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
$data['teacher'] = $this->common->getAllData('teachers_info');
}
$this->load->view('temp/header', $data);
$this->load->view('dashboard', $data);
$this->load->view('temp/footer');
}
public function Student() {
    $user = $this->ion_auth->user()->row();
    $id = $user->id;
    $data['massage'] = $this->common->getWhere('massage', 'receiver_id', $id);
    $data['totalStudent'] = $this->common->totalStudent();
    $data['Active_stds'] = $this->common->totalActive();
    $data['Deactive_stds'] = $this->common->total_DeActive();
    $data['totalAttendStudent'] = $this->common->totalAttendStudent();
    $data['teacherAttendance'] = $this->common->teacherAttendance();
    $data['presentEmploy'] = $this->homeModel->presentEmploy();
    $data['absentEmploy'] = $this->homeModel->absentEmploy();
    $data['leaveEmploy'] = $this->homeModel->leaveEmploy();
    $data['event'] = $this->homeModel->all_event($id);
    $data['notice'] = $this->common->getAllData('notice_board');
    $data['date_wise_students'] = $this->homeModel->atten_chart_students();
    $data['stdInfo'] = $this->common->studentInfo();
        if ($this->ion_auth->is_student()) {
        //Whice notice is created for student these notice can see both students and parents.
        $query = $this->common->getWhere('student_info', 'user_id', $id);
        foreach ($query as $row) {
        $class_id = $row['class_id'];
        }
    $data['class_id'] = $class_id;
    $data['day'] = $this->common->getAllData('config_week_day');
    $data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
    $data['teacher'] = $this->common->getAllData('teachers_info');
    }
    $this->load->view('temp/header', $data);
    $this->load->view('Student', $data);
    $this->load->view('temp/footer');
}
// this function using manage studentInfoReporst in php 
public function studentInfoReporst() {
    $user = $this->ion_auth->user()->row();
    $id = $user->id;
    $data['massage'] = $this->common->getWhere('massage', 'receiver_id', $id);
    $data['totalStudent'] = $this->common->totalStudent();
    $data['Active_stds'] = $this->common->totalActive();
    $data['Deactive_stds'] = $this->common->total_DeActive();
    $data['stdInfo'] = $this->common->studentInfo();   
    $data['classTile'] = $this->common->getAllData('class');
        if ($this->ion_auth->is_student()) {
        //Whice notice is created for student these notice can see both students and parents.
        $query = $this->common->getWhere('student_info', 'user_id', $id);
        foreach ($query as $row) {
        $class_id = $row['class_id'];
        }
    $data['class_id'] = $class_id; 
    }
    $this->load->view('temp/header', $data);
    $this->load->view('studentInfoReport', $data);
    $this->load->view('temp/footer');
}

public function ajaxStudentInfoReport(){
    $classId = $this->input->get('c_Name');
    $classSection = $this->input->get('c_Section');
    $status = $this->input->get('status');
    $classSession = $this->input->get('classSession');

    $date = date('Y-m-d');
    
    // this query count total filter count
    $query = $this->db->query("SELECT * FROM student_info WHERE year = $classSession AND class_id = $classId AND section LIKE '%$classSection' AND status LIKE '%$status' ORDER BY `id`  ASC");
    $stdInfo = $query->result_array();

    echo'<div class="col-md-12 col-sm-12 p-3 display" > 
        <div class="col-md-3 text-center" >
            <img src="assets/admin/layout/img/smlogo.png" alt="logo" width="150px"> 
        </div>
        <div class="col-md-9 text-center">  
            <h4 >Student Information Report</h4>
        </div> 
        <div class="portlet ">
              
            <div class="portlet-body">
                <table id="sample_1" class="table" >
                    <thead>
                        <tr> 
                            <th> Class Name: '. $this->common->class_title($classId) .' </th>
                            <th> Class Section: '. $classSection.' </th>  
                            <th> Date: '. $date .' </th>  
                        </tr>
                    </thead> 
                </table>
            </div> 
        </div>
    </div>
    <div class="col-md-12 col-sm-12 p-5">
        <div class="portlet purple box">
            <div class="portlet-title no-print">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Student Receiveables information
                </div>
                <div class="tools">
                    <a class="collapse" href="javascript:;">
                    </a>
                    <a class="reload" href="javascript:;">
                    </a>
                </div>
            </div>
            <div class="portlet-body"> 
                <table id="sample_12" onbeforeprint="printtable()" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr> 
                            <th> Sr # </th>
                            <th> Student ID </th>
                            <th> Year </th>
                            <th> Registration Number </th>
                            <th> Student Name </th>
                            <th> Father Name </th>
                            <th> Class </th>
                            <th> Section </th>
                            <th> status </th>
                            <th> Admission Date </th>
                            <th> Cell No </th>
                            <th> Address </th> 
                        </tr>
                    </thead> 
                    <tbody>'; 
                $count=1; 
                foreach ($stdInfo as $value) {  
                echo'<tr>
                        <td>'. $count++ .'</td>
                        <td>'. $value["student_id"] .'</td>
                        <td>'. $value["year"] .'</td>
                        <td>'. $value["registration_number"] .'</td>
                        <td>'. $value["student_nam"] .'</td>
                        <td>'. $value["farther_name"] .'</td>
                        <td>'. $value["class_title"] .'</td>
                        <td>'. $value["section"] .'</td>
                        <td>'. $value["status"] .'</td>
                        <td>'. $value["admission_date"] .'</td>
                        <td>'. $value["phone"] .'</td>
                        <td>'. $value["present_address"] .'</td>
                    </tr>'; 
                }  
                echo'</tbody>  
                </table>
            </div>
        </div>
    </div>';  
}

public function ajaxStudentInfoReportTillData(){
    $classId = $this->input->post('className');
    $classSection = $this->input->post('classSection');
    $status = $this->input->post('status'); 
    $classSession = $this->input->post('classSession');  
    
    // this query count totall student of given class
    $tstudent = $this->db->query("SELECT count(*) as total FROM student_info WHERE year = $classSession AND class_id = $classId AND section Like '%$classSection' ORDER BY `id` ASC");
        foreach ($tstudent->result() as $row) {
            $data['totalamount'] = $row->total;       
        } 
    // this query count total ACTIVE student of given class
    $ac_student = $this->db->query("SELECT count(*) as active FROM student_info WHERE year = $classSession AND class_id = $classId AND section LIKE '%$classSection' AND status = 'Active' ORDER BY `id` ASC");
        foreach ($ac_student->result() as $row) {
            $data['activeStudent'] = $row->active;       
        }
    // this query count total DEACTIVE student of given class
    $destudent = $this->db->query("SELECT count(*) as deactive FROM student_info WHERE year = $classSession AND class_id = $classId AND section LIKE '%$classSection' AND status = 'Deactive' ORDER BY `id` ASC");
        foreach ($destudent->result() as $row) {
            $data['deactiveStudent'] = $row->deactive;       
        }
    // this query count total School Left student of given class
    $schoolleft = $this->db->query("SELECT count(*) as schoolleft FROM student_info WHERE year = $classSession AND class_id = $classId AND section LIKE '%$classSection' AND status = 'Schoolleft' ORDER BY `id` ASC");
        foreach ($schoolleft->result() as $row) {
            $data['schoolLeft'] = $row->schoolleft;       
        } 
    // this query count total Defaulter student of given class
    $deflter = $this->db->query("SELECT count(*) as defaulter FROM student_info WHERE year = $classSession AND class_id = $classId AND section LIKE '%$classSection' AND status = 'Defaulter' ORDER BY `id` ASC");
        foreach ($deflter->result() as $row) {
            $data['Defaulter'] = $row->defaulter;       
        }   
echo json_encode($data);

                    //echo $persentage;                            
}
// this function manage current student strength report
public function currentStudentStrength(){
    $user = $this->ion_auth->user()->row();
    $id = $user->id; 
    $data['totalStudent'] = $this->common->totalStudent();
    $data['activeStudent'] = $this->common->activeStudent(); 
    $data['leftoverStudent'] = $this->common->total_DeActive();
    $data['maleStudent'] = $this->common->maleStudent();
    $data['femaleStudent'] = $this->common->femaleStudent();
    $data['stdInfo'] = $this->common->studentInfo();  

    $data['classTile'] = $this->common->getAllData('class');
         
    $this->load->view('temp/header', $data);
    $this->load->view('currentStudentStrength', $data);
    $this->load->view('temp/footer');                                            
}
// this function is used to get all data of given class id and class section
public function ajaxCurrentStudentStrength(){
    $classId = $this->input->get('className');
    $classSection = $this->input->get('classSection'); 
    $date = date('Y-m-d');
    $male = array();
    $female = array();
    // this query count total male students of given class and section
    $query = $this->db->query("SELECT * FROM student_info WHERE class_id = $classId AND section LIKE '%$classSection' AND status= 'Active' AND gender = 'Male'");
    foreach ($query->result_array() as $row) {
        $male[] = $row;       
    }
    $malestudent = count($male);
    // this query count total female students of given class and section
    $query = $this->db->query("SELECT * FROM student_info WHERE class_id = $classId AND section LIKE '%$classSection' AND status= 'Active' AND gender = 'Female'");
    foreach ($query->result_array() as $row) {
        $female[] = $row;       
    }
    $femalestudent = count($female);
    // this query count total filter count
    $query = $this->db->query("SELECT * FROM student_info WHERE class_id = $classId AND section LIKE '%$classSection' AND status = 'Active' ORDER BY `id`  ASC");
    $stdInfo = $query->result_array();

    echo'<div class="col-md-12 col-sm-12 p-3 display" > 
        <div class="col-md-3 text-center" >
            <img src="assets/admin/layout/img/smlogo.png" alt="logo" width="150px"> 
        </div>
        <div class="col-md-9 text-center">  
            <h4 >Student Information Report</h4>
        </div> 
        <div class="portlet ">
              
            <div class="portlet-body">
                <table id="sample_1" class="table" >
                    <thead>
                        <tr> 
                            <th> Class Name: '. $this->common->class_title($classId) .' </th>
                            <th> Class Section: '. $classSection.' </th>  
                            <th> Date: '. $date .' </th> 
                            <th> Male Student: '. $malestudent .' </th>
                            <th> Female Student: '. $femalestudent .' </th>
                            <th> Total Active Student: '. $total = ($malestudent + $femalestudent) .' </th> 
                        </tr>
                    </thead> 
                </table>
            </div> 
        </div>
    </div>
    <div class="col-md-12 col-sm-12 p-5">
        <div class="portlet purple box">
            <div class="portlet-title no-print">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Student Receiveables information
                </div>
                <div class="tools">
                    <a class="collapse" href="javascript:;">
                    </a>
                    <a class="reload" href="javascript:;">
                    </a>
                </div>
            </div>
            <div class="portlet-body"> 
                <table id="sample_12" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr> 
                            <th> Sr.# </th>  
                            <th> Registration Number </th>
                            <th> Student ID </th> 
                            <th> Student Name </th>
                            <th> Father Name </th>
                            <th> Class </th>
                            <th> Section </th> 
                            <th> Gender </th> 
                            <th> Phone Number </th> 
                            <th> Present Address </th> 
                            <th> Status </th>
                        </tr>
                    </thead> 
                    <tbody>'; 
                $count=1; 
                foreach ($stdInfo as $value) {  
                echo'<tr>
                        <td>'. $count++ .'</td>
                        <td>'. $value["registration_number"] .'</td>
                        <td>'. $value["student_id"] .'</td>
                        <td>'. $value["student_nam"] .'</td>
                        <td>'. $value["farther_name"] .'</td>
                        <td>'. $value["class_title"] .'</td> 
                        <td>'. $value["section"] .'</td>
                        <td>'. $value['gender'] .'</td> 
                        <td>'. $value["phone"] .'</td>
                        <td>'. $value["present_address"] .'</td> 
                        <td>'. $value["status"] .'</td> 
                    </tr>'; 
                }  
                echo'</tbody>  
                </table>
            </div>
        </div>
    </div>'; 
}
// this function is used to get tills data of given class id and class section 
public function ajaxCurrentStudentStrengthTillData(){
    $classId = $this->input->post('className');  
    $classSection = $this->input->post('classSection');  
    
    // this query count total student of given class and session
    $query = $this->db->query("SELECT count(*) as totalStudent FROM student_info WHERE class_id = $classId AND section LIKE '%$classSection' ");   
    foreach ($query->result() as $row) {
        $data['totalStudent'] = $row->totalStudent;       
    }
     
    // this query count total active students of given class section 
    $query = $this->db->query("SELECT count(*) as activeStudent FROM student_info WHERE class_id = $classId AND section LIKE '%$classSection' AND status= 'Active' ");
    foreach ($query->result() as $row) {
        $data['activeStudent'] = $row->activeStudent;       
    }
    // this query count total male students of given class and section
    $query = $this->db->query("SELECT count(*) as maleStudent FROM student_info WHERE class_id = $classId AND section LIKE '%$classSection' AND status= 'Active' AND gender = 'Male'");
    foreach ($query->result() as $row) {
        $data['maleStudent'] = $row->maleStudent;       
    }
    // this query count total female students of given class and section
    $query = $this->db->query("SELECT count(*) as femaleStudent FROM student_info WHERE class_id = $classId AND section LIKE '%$classSection' AND status= 'Active' AND gender = 'Female'");
    foreach ($query->result() as $row) {
        $data['femaleStudent'] = $row->femaleStudent;       
    }
     
    echo json_encode($data);
}


public function Student_reg() {
    $user = $this->ion_auth->user()->row();
    $id = $user->id;
    $data['massage'] = $this->common->getWhere('massage', 'receiver_id', $id);
    $data['totalStudent'] = $this->common->totalStudent_reg();
    $data['total_paid'] = $this->common->totalPaid();
    $data['get_total'] = $this->common->total_expected();
    $data['Active_stds'] = $this->common->Reg_amount();
    $data['Deactive_stds'] = $this->common->total_Unpaid();
    $data['totalAttendStudent'] = $this->common->totalAttendStudent();
    $data['teacherAttendance'] = $this->common->teacherAttendance();
    $data['presentEmploy'] = $this->homeModel->presentEmploy();
    $data['absentEmploy'] = $this->homeModel->absentEmploy();
    $data['leaveEmploy'] = $this->homeModel->leaveEmploy();
    $data['event'] = $this->homeModel->all_event($id);
    $data['notice'] = $this->common->getAllData('notice_board');
    $data['date_wise_students'] = $this->homeModel->atten_chart_students_reg();
    $data['stdInfo'] = $this->common->student_regInfo();
    if ($this->ion_auth->is_student()) {
        //Whice notice is created for student these notice can see both students and parents.
        $query = $this->common->getWhere('student_info', 'user_id', $id);
        foreach ($query as $row) {
            $class_id = $row['class_id'];
        }
        $data['class_id'] = $class_id;
        $data['day'] = $this->common->getAllData('config_week_day');
        $data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
        $data['teacher'] = $this->common->getAllData('teachers_info');
    }
    $this->load->view('temp/header', $data);
    $this->load->view('Student_reg', $data);
    $this->load->view('temp/footer');
}

// this function use student registration info
public function studentRegiserReport() {
    $user = $this->ion_auth->user()->row();
    $id = $user->id;
    $data['totalStudent'] = $this->common->totalStudent_reg();
    $data['paid_registration_fee'] = $this->common->totalPaid();
    $data['unpaid_registration_fee'] = $this->common->total_Unpaid();
    $data['total_paid_reg_fee'] = $this->common->Reg_amount();
    $data['aspected_total'] = $this->common->total_expected();
    $data['classTile'] = $this->common->getAllData('class');
    $data['stdInfo'] = $this->common->student_regInfo();
    $data['date_wise_students'] = $this->homeModel->atten_chart_students_reg();
     
    $this->load->view('temp/header', $data);
    $this->load->view('studentRegistrationReport', $data);
    $this->load->view('temp/footer');
}
// this function return register student record 
public function ajaxStudentRegisterReport(){
    $classId = $this->input->get('className');  
    $classSession = $this->input->get('classSession');

    $date = date('Y-m-d'); 
    //this query get all data aganst given class id and class session
    if(empty($classId)){ 
        $query = $this->db->query("SELECT * FROM registration WHERE session = '$classSession' "); 
        $reg_data = $query->result_array();
    } else{ 
        $query = $this->db->query("SELECT * FROM registration WHERE session = '$classSession' AND class_id = '$classId' ");
        $reg_data = $query->result_array();
    }

    
    if(empty($reg_data)){
            echo '<hr><div class="col-md-12 col-sm-12">
                    <div class="alert alert-danger">
                      <strong>Alert!</strong> Record Not Availabe.
                    </div>
                </div>';
    }else{
        echo '<div class="col-md-12 col-sm-12 p-3 display" > 
            <div class="col-md-3 text-center" >
                <img src="assets/admin/layout/img/smlogo.png" alt="logo" width="150px"> 
            </div>
            <div class="col-md-9 text-center">  
                <h4 >Student Information Report</h4>
            </div> 
            <div class="portlet ">
                  
                <div class="portlet-body">
                    <table id="sample_1" class="table" >
                        <thead>
                            <tr> 
                                <th> Class Name: '; if(empty($classId)){}else{ echo $this->common->class_title($classId);} echo' </th>
                                <th> Class Session: '. $classSession.' </th>  
                                <th> Date: '. $date .' </th>  
                            </tr>
                        </thead> 
                    </table>
                </div> 
            </div>
        </div>
        <div class="col-md-12 col-sm-12 p-5">
            <div class="portlet purple box">
                <div class="portlet-title no-print">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Student Registration information
                    </div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;">
                        </a>
                        <a class="reload" href="javascript:;">
                        </a>
                    </div>
                </div>
                <div class="portlet-body"> 
                    <table id="sample_12" onbeforeprint="printtable()" class="table table-striped table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th> Sr.#</th>
                                <th> Date</th>
                                <th> Session</th>
                                <th> Student Reg</th>
                                <th> Student Name</th>
                                <th> Father Name</th>
                                <th> Father CNIC</th>
                                <th> Class</th>
                                <th> Gender</th>
                                <th> Amount</th>
                            </tr>
                        </thead> 
                        <tbody>';
                    $count=1; 
                    $sum = 0;
                    foreach ($reg_data as $row) {
                        $sum = $sum + $row["total"];                  
                    echo'<tr>
                            <td>'. $count++ .'</td>
                            <td>'. $row["reg_date"] .'</td>
                            <td>'. $row["session"] .'</td>
                            <td>'. $row["reg_number"] .'</td>
                            <td>'. $row["student_nam"] .'</td>
                            <td>'. $row["father_name"] .'</td>
                            <td>'. $row["father_cnic"] .'</td>
                            <td>'. $this->common->class_title($row["class_id"])  .'</td>
                            <td>'. $row["gender"] .'</td>
                            <td>'. $row["total"] .'</td> 
                        </tr>';
                    }  
                    echo'<tr> 
                            <th colspan="9" style="text-align:center;">Total </th> 
                            <th > '. $sum.' </th>
                        </tr>
                        </tbody>  
                    </table>
                </div>
            </div>
        </div>';
    }
      
}


// this function ajax call StudentRegistrationReport
public function ajaxStudentRegisterReportTillData(){
    $classId = $this->input->post('className');  
    $classSession = $this->input->post('classSession'); 
     
    // this query count of register student of given class and session
    if(empty($classId)){
        $query = $this->db->query("SELECT count(*) as total FROM registration WHERE session = $classSession");
    } else {
        $query = $this->db->query("SELECT count(*) as total FROM registration WHERE session = $classSession AND class_id = $classId ");   
    }
        foreach ($query->result() as $row) {
            $data['totalRegisterStudent'] = $row->total;       
        }
    
    // this query count total paid vouchers of given class and session 
    if(empty($classId)){
        $query = $this->db->query("SELECT count(*) as paid_student FROM registration WHERE session = $classSession AND status= 'Paid' "); 
    }else{
        $query = $this->db->query("SELECT count(*) as paid_student FROM registration WHERE session = $classSession AND class_id = $classId AND status= 'Paid' ");
    }
        foreach ($query->result() as $row) {
            $data['totalPaidRegisterStudent'] = $row->paid_student;       
        }
    // this query count total Unpaid vouchers of given class and session 
    if(empty($classId)){
        $query = $this->db->query("SELECT count(*) as unpaid_student FROM registration WHERE session = $classSession AND status= 'Unpaid' ");
    } else{
        $query = $this->db->query("SELECT count(*) as unpaid_student FROM registration WHERE session = $classSession AND class_id = $classId AND status= 'Unpaid' ");
    }
        foreach ($query->result() as $row) {
            $data['totalUnpaidRegisterStudent'] = $row->unpaid_student;       
        }
    // this query sum of paid vouchers of given class and session
    if(empty($classId)){
        $query = $this->db->query("SELECT sum(paid) as total_paid FROM registration WHERE session = $classSession AND status= 'Paid' ");
    } else{ 
        $query = $this->db->query("SELECT sum(paid) as total_paid FROM registration WHERE session = $classSession AND class_id = $classId AND status= 'Paid' ");
    }
        foreach ($query->result() as $row) {
            $data['totalPaidAmount'] = $row->total_paid;       
        }
    // this query sum of Unpaid vouchers of given class and session
    if(empty($classId)){
        $query = $this->db->query("SELECT sum(registration_fee) as registration_fee FROM registration WHERE session = $classSession ");
    }else{ 
        $query = $this->db->query("SELECT sum(registration_fee) as registration_fee FROM registration WHERE session = $classSession AND class_id = $classId ");
    }
        foreach ($query->result() as $row) {
            $data['totalRegistrationFee'] = $row->registration_fee;       
        }
    echo json_encode($data);
                                                    
}
/////
public function Admission() {
    $user = $this->ion_auth->user()->row();
    $id = $user->id;
    $data['massage'] = $this->common->getWhere('massage', 'receiver_id', $id);
    $data['totalStudent'] = $this->common->totalAdmission();
    $data['Active_stds'] = $this->common->with_discount();
    $data['Deactive_stds'] = $this->common->without_discount();
    $data['totalAttendStudent'] = $this->common->totalAttendStudent();
    $data['teacherAttendance'] = $this->common->teacherAttendance();
    $data['presentEmploy'] = $this->homeModel->presentEmploy();
    $data['absentEmploy'] = $this->homeModel->absentEmploy();
    $data['leaveEmploy'] = $this->homeModel->leaveEmploy();
    $data['event'] = $this->homeModel->all_event($id);
    $data['notice'] = $this->common->getAllData('notice_board');
    $data['date_wise_students'] = $this->homeModel->atten_chart_students_admision();
    $data['stdInfo'] = $this->common->student_Admission();
    $data['total_collection']=$this->common->get_sum();
    if ($this->ion_auth->is_student()) {
    //Whice notice is created for student these notice can see both students and parents.
        $query = $this->common->getWhere('student_info', 'user_id', $id);
        foreach ($query as $row) {
            $class_id = $row['class_id'];
        }
        $data['class_id'] = $class_id;
        $data['day'] = $this->common->getAllData('config_week_day');
        $data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
        $data['teacher'] = $this->common->getAllData('teachers_info');
    }
    $this->load->view('temp/header', $data);
    $this->load->view('Admission', $data);
    $this->load->view('temp/footer');
}
public function studentAdmission() {
    $user = $this->ion_auth->user()->row();
    $id = $user->id;
    // current year total admissions counter
    $data['totalStudent'] = $this->common->totalAdmission();
    // current year discounted admission counter
    $data['Active_stds'] = $this->common->with_discount();
    // current year with out discounted admission counter
    $data['Deactive_stds'] = $this->common->without_discount();
    // total amount of current year students
    $data['total_collection']=$this->common->get_sum();
    // total amount of current year students
    $data['actual_total']=$this->common->get_actual_sum();
    // get all class title using class table
    $data['classTile'] = $this->common->getAllData('class');


    // get current year student info 
    $data['stdInfo'] = $this->common->student_Admission();


    //$data['massage'] = $this->common->getWhere('massage', 'receiver_id', $id);
    
     
    //$data['date_wise_students'] = $this->homeModel->atten_chart_students_admision();
     
    $this->load->view('temp/header', $data);
    $this->load->view('studentAdmission', $data);
    $this->load->view('temp/footer');
}

// ajax call for studentAdmission
public function ajaxStudentAdmission(){
    $classId = $this->input->get('className');  
    $classSession = $this->input->get('classSession');
    $classSection = $this->input->get('classSection');
    $month = $this->input->get('month');
    $date = date('Y-m-d');  
    if(empty($classId)){
        $query = $this->db->query("SELECT register_pass.discount_reasons as disc,register_pass.discount_persentage as disc_per,register_pass.reg_number,register_pass.reg_date,register_pass.admission_fee,register_pass.annual_found , register_pass.total,(register_pass.admission_fee + register_pass.annual_found)as amount,student_info.student_id , student_info.class_title, student_info.section, student_info.student_nam,student_info.farther_name,student_info.registration_number,student_info.admission_date FROM student_info INNER JOIN register_pass ON student_info.registration_number = register_pass.reg_number WHERE student_info.year = $classSession AND register_pass.year = $classSession AND student_info.admi_month LIKE '%$month'");
        $reg_data = $query->result_array();
    } else{
        $query = $this->db->query("SELECT register_pass.discount_reasons as disc,register_pass.discount_persentage as disc_per,register_pass.reg_number,register_pass.reg_date,register_pass.admission_fee,register_pass.annual_found , register_pass.total,(register_pass.admission_fee + register_pass.annual_found)as amount,student_info.student_id , student_info.class_title, student_info.section, student_info.student_nam,student_info.farther_name,student_info.registration_number,student_info.admission_date FROM student_info INNER JOIN register_pass ON student_info.registration_number = register_pass.reg_number WHERE student_info.year = $classSession AND register_pass.year = $classSession AND student_info.class_id = $classId AND register_pass.class_id = $classId AND student_info.section LIKE '%$classSection' AND student_info.admi_month LIKE '%$month'");
        $reg_data = $query->result_array();
    }
    

    if(empty($reg_data)){
        echo '<hr><div class="col-md-12 col-sm-12">
                <div class="alert alert-danger">
                  <strong>Alert!</strong> Record Not Availabe.
                </div>
            </div>';
    }else{
        echo '<div class="col-md-12 col-sm-12 p-3 display" > 
            <div class="col-md-3 text-center" >
                <img src="assets/admin/layout/img/smlogo.png" alt="logo" width="150px"> 
            </div>
            <div class="col-md-9 text-center">  
                <h4 >Student Information Report</h4>
            </div> 
            <div class="portlet ">
                  
                <div class="portlet-body">
                    <table id="sample_1" class="table" >
                        <thead>
                            <tr> 
                                <th> Class Name: '; if(empty($classId)){}else{ echo $this->common->class_title($classId);} echo' </th>
                                <th> Class Session: '. $classSession .' </th>
                                <th> Admission Month: '. $month .' </th>
                                <th> Date: '. $date .' </th>  
                            </tr>
                        </thead> 
                    </table>
                </div> 
            </div>
        </div>
        <div class="col-md-12 col-sm-12 p-5">
            <div class="portlet purple box">
                <div class="portlet-title no-print">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Student Registration information
                    </div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;">
                        </a>
                        <a class="reload" href="javascript:;">
                        </a>
                    </div>
                </div>
                <div class="portlet-body"> 
                    <table id="sample_1" onbeforeprint="printtable()" class="table table-striped table-bordered table-hover" >
                        <thead>
                            <tr> 
                                <th> Sr.# </th>
                                <th> Admission/Fee Challan Date </th>
                                <th> Registration Date </th>
                                <th> Student ID </th> 
                                <th> Student Name </th>
                                <th> Father Name </th>
                                <th> Class </th>
                                <th> Section </th> 
                                <th> Discount Reason </th>
                                <th> Admission Discount % </th>
                                <th> Admission Fee </th>
                                <th> Annual Fee </th>
                                <th> Total Fee </th>
                                <th> Net Total </th>
                            </tr>
                        </thead> 
                        <tbody>';
                    $count=1; 
                    foreach ($reg_data as $row) {                  
                    echo'<tr>
                            <td>'. $count++ .'</td>
                            <td>'. $row['admission_date'] .'</td>
                            <td>'. $row['reg_date'] .'</td>
                            <td>'. $row['student_id'] .'</td>
                            <td>'. $row['student_nam'] .'</td>
                            <td>'. $row['farther_name'] .'</td>
                            <td>'. $row['class_title'] .'</td>
                            <td>'. $row['section'] .'</td>
                            <td>'. $row['disc'] .'</td>
                            <td>'. $row['disc_per'].'%' .'</td>
                            <td>'. $row['admission_fee'] .'</td>
                            <td>'. $row['annual_found'] .'</td>
                            <td>'. $row['amount'] .'</td>
                            <td>'. $row['total'] .'</td>
                        </tr>';
                    }  
                        '</tbody>  
                    </table>
                </div>
            </div>
        </div>';
    }       
}
// tills data of student admission of select session and class
public function ajaxStudentAdmissionTillData(){
    $classId = $this->input->post('className');  
    $classSession = $this->input->post('classSession'); 
    $classSection = $this->input->post('classSection');
    $month = $this->input->post('month');

    //   count total admission of given session and class 
    if(empty($classId)){
        $query = $this->db->query("SELECT count(*) as totalAdmission FROM student_info INNER JOIN register_pass ON student_info.registration_number = register_pass.reg_number WHERE student_info.year = $classSession AND register_pass.year = $classSession AND student_info.admi_month LIKE '%$month'");
    }else{
        $query = $this->db->query("SELECT count(*) as totalAdmission FROM student_info INNER JOIN register_pass ON student_info.registration_number = register_pass.reg_number WHERE student_info.year = $classSession AND register_pass.year = $classSession AND student_info.class_id = $classId AND register_pass.class_id = $classId AND student_info.section LIKE '%$classSection' AND student_info.admi_month LIKE '%$month'");
    }
   foreach ($query->result() as $row) {
        $data['totalAdmission'] = $row->totalAdmission;       
    }
    // current year discounted admission counter
    if(empty($classId)){
        $query = $this->db->query("SELECT count(*) as withdiscount FROM student_info INNER JOIN student_fee_discount ON student_info.registration_number = student_fee_discount.reg_number WHERE student_info.year = $classSession AND student_fee_discount.year = $classSession AND student_info.admi_month LIKE '%$month'");
    } else{
        $query = $this->db->query("SELECT count(*) as withdiscount FROM student_info INNER JOIN student_fee_discount ON student_info.registration_number = student_fee_discount.reg_number WHERE student_info.year = $classSession AND student_fee_discount.year = $classSession AND student_info.class_id = $classId AND student_info.section LIKE '%$classSection' AND student_info.admi_month LIKE '%$month'");
    }
    foreach ($query->result() as $row) {
        $data['withdiscount'] = $row->withdiscount;       
    }
    // current year with Out discounted admission counter
    // if(empty($classId)){
    //     $query = $this->db->query("SELECT count(id) as withOutDiscount FROM student_info WHERE discount_cat = 0 AND year = $classSession ");
    // } else{
    //     $query = $this->db->query("SELECT count(id) as withOutDiscount FROM student_info WHERE discount_cat = 0 AND year = $classSession AND class_id = $classId AND section LIKE '%$classSection'");
    // }
    // foreach ($query->result() as $row) {
    //     $data['withOutDiscount'] = $row->withOutDiscount;       
    // }
    // total amount of current year students
    if(empty($classId)){
        $query = $this->db->query("SELECT sum(register_pass.total) as dis_total FROM student_info INNER JOIN register_pass ON student_info.registration_number = register_pass.reg_number WHERE student_info.year =$classSession AND register_pass.year =$classSession AND student_info.admi_month LIKE '%$month'");
    }else{
        $query = $this->db->query("SELECT sum(register_pass.total) as dis_total FROM student_info INNER JOIN register_pass ON student_info.registration_number = register_pass.reg_number WHERE student_info.year =$classSession AND register_pass.year =$classSession AND student_info.class_id =$classId AND register_pass.class_id =$classId AND student_info.section LIKE '%$classSection' AND student_info.admi_month LIKE '%$month'");
    }
    foreach ($query->result() as $row) {
        $data['dis_total'] = $row->dis_total;       
    }
    //
    if(empty($classId)){
        $query = $this->db->query("SELECT sum(register_pass.admission_fee + register_pass.annual_found)as amount FROM student_info INNER JOIN register_pass ON student_info.registration_number = register_pass.reg_number WHERE student_info.year = $classSession AND register_pass.year = $classSession AND student_info.admi_month LIKE '%$month'");
    } else{
        $query = $this->db->query("SELECT sum(register_pass.admission_fee + register_pass.annual_found)as amount FROM student_info INNER JOIN register_pass ON student_info.registration_number = register_pass.reg_number WHERE student_info.year = $classSession AND register_pass.year = $classSession AND student_info.class_id = $classId AND register_pass.class_id = $classId AND student_info.section LIKE '%$classSection' AND student_info.admi_month LIKE '%$month'");
    }
    foreach ($query->result() as $row) {
        $data['amount'] = $row->amount;       
    }
    echo json_encode($data);
}  
public function discount_reason() {
$user = $this->ion_auth->user()->row();
$id = $user->id;
$data['massage'] = $this->common->getWhere('massage', 'receiver_id', $id);
$data['totalStudent'] = $this->common->totalAdmission();
$data['Active_stds'] = $this->common->with_discount();
$data['calculate_disc'] = $this->common->given_discount();
$data['Deactive_stds'] = $this->common->without_discount();
$data['totalAttendStudent'] = $this->common->totalAttendStudent();
$data['teacherAttendance'] = $this->common->teacherAttendance();
$data['presentEmploy'] = $this->homeModel->presentEmploy();
$data['absentEmploy'] = $this->homeModel->absentEmploy();
$data['leaveEmploy'] = $this->homeModel->leaveEmploy();
$data['event'] = $this->homeModel->all_event($id);
$data['notice'] = $this->common->getAllData('notice_board');
/*$data['date_wise_students'] = $this->homeModel->atten_chart_students3();
*/
$data['stdInfo'] = $this->common->student_discounts_reasons();
$data['total_collection']=$this->common->get_sum();
if ($this->ion_auth->is_student()) {
//Whice notice is created for student these notice can see both students and parents.
$query = $this->common->getWhere('student_info', 'user_id', $id);
foreach ($query as $row) {
$class_id = $row['class_id'];
}
$data['class_id'] = $class_id;
$data['day'] = $this->common->getAllData('config_week_day');
$data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
$data['teacher'] = $this->common->getAllData('teachers_info');
}
$this->load->view('temp/header', $data);
$this->load->view('discount_reason', $data);
$this->load->view('temp/footer');
}
public function Student_fee() {
$user = $this->ion_auth->user()->row();
$id = $user->id;
$data['massage'] = $this->common->getWhere('massage', 'receiver_id', $id);
$data['totalStudent'] = $this->common->totalAdmission();
$data['Active_stds'] = $this->common->with_discount();
$data['Deactive_stds'] = $this->common->without_discount();
$data['totalAttendStudent'] = $this->common->totalAttendStudent();
$data['teacherAttendance'] = $this->common->teacherAttendance();
$data['presentEmploy'] = $this->homeModel->presentEmploy();
$data['absentEmploy'] = $this->homeModel->absentEmploy();
$data['leaveEmploy'] = $this->homeModel->leaveEmploy();
$data['event'] = $this->homeModel->all_event($id);
$data['notice'] = $this->common->getAllData('notice_board');
$data['date_wise_students'] = $this->homeModel->atten_chart_student_feeStructure();
$data['stdInfo'] = $this->common->fee_struct();
$data['total_collection']=$this->common->get_sum();
if ($this->ion_auth->is_student()) {
//Whice notice is created for student these notice can see both students and parents.
$query = $this->common->getWhere('student_info', 'user_id', $id);
foreach ($query as $row) {
$class_id = $row['class_id'];
}
$data['class_id'] = $class_id;
$data['day'] = $this->common->getAllData('config_week_day');
$data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
$data['teacher'] = $this->common->getAllData('teachers_info');
}
$this->load->view('temp/header', $data);
$this->load->view('Student_fee', $data);
$this->load->view('temp/footer');
}
public function Chalan_reports() {
    $user = $this->ion_auth->user()->row();
    $id = $user->id;
    $data['massage'] = $this->common->getWhere('massage', 'receiver_id', $id);
    $data['totalStudent'] = $this->common->total_chalan();
    $data['Active_stds'] = $this->common->Total_with_discount();
    $data['Deactive_stds'] = $this->common->without_discount();
    $data['total_paid'] = $this->common->tota_paid_amount();
    $data['total_unpaid'] = $this->common->tota_unpaid_amount();
    $data['presentEmploy'] = $this->homeModel->presentEmploy();
    $data['absentEmploy'] = $this->homeModel->absentEmploy();
    $data['leaveEmploy'] = $this->homeModel->leaveEmploy();
    $data['event'] = $this->homeModel->all_event($id);
    $data['notice'] = $this->common->getAllData('notice_board');
    /* $data['date_wise_students'] = $this->homeModel->atten_chart_students3();
    */
    $data['stdInfo'] = $this->common->student_chalanz();
    $data['total_collection']=$this->common->get_sum();
    if ($this->ion_auth->is_student()) {
        //Whice notice is created for student these notice can see both students and parents.
        $query = $this->common->getWhere('student_info', 'user_id', $id);
        foreach ($query as $row) {
            $class_id = $row['class_id'];
        }
        $data['class_id'] = $class_id;
        $data['day'] = $this->common->getAllData('config_week_day');
        $data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
        $data['teacher'] = $this->common->getAllData('teachers_info');
    }
    $this->load->view('temp/header', $data);
    $this->load->view('Chalan_reports', $data);
    $this->load->view('temp/footer');
}
public function studentChalanReport(){
    $user = $this->ion_auth->user()->row();
    $id = $user->id;
    // get all class title using class table
    $data['classTile'] = $this->common->getAllData('class');
    // get all vouchers of current month and current year
    $data['stdInfo'] = $this->common->student_chalanz();
    //$data['massage'] = $this->common->getWhere('massage', 'receiver_id', $id);
    $data['total_chalan_amount'] = $this->common->total_chalan();
    $data['Total_with_discount'] = $this->common->Total_with_discount();
    // $data['Deactive_stds'] = $this->common->without_discount();
    $data['total_paid'] = $this->common->tota_paid_amount();
    $data['total_unpaid'] = $this->common->tota_unpaid_amount(); 

    $this->load->view('temp/header', $data);
    $this->load->view('studentChalanReport', $data);
    $this->load->view('temp/footer');
}
// ajax get all data of student fee chalan vouchers
    public function ajaxStudentChalanReport(){
        $year = $this->input->get('year');
        $monthName = $this->input->get('monthName'); 
        $classId = $this->input->get('className');
        $classSection = $this->input->get('classSection');  
        $date = date('Y-m-d');   
        if(empty($classId)){
            $query = $this->db->query("SELECT student_info.student_id, student_info.student_nam ,student_info.class_title, student_info.section, slip.discount_id, slip.amount, slip.ac_charges,slip.paid, slip.discount,slip.tution_fee,slip.voucher_number,slip.year, slip.month,slip.payment_status,  slip.dis_total FROM slip INNER JOIN student_info ON slip.student_id = student_info.student_id WHERE  slip.month = '$monthName' AND slip.year= $year");
        } else{
            $query = $this->db->query("SELECT student_info.student_id, student_info.student_nam ,student_info.class_title, student_info.section, slip.discount_id, slip.amount, slip.ac_charges,slip.paid, slip.discount,slip.tution_fee,slip.voucher_number,slip.year, slip.month,slip.payment_status,  slip.dis_total FROM slip INNER JOIN student_info ON slip.student_id = student_info.student_id WHERE  slip.month = '$monthName' AND slip.year= $year AND slip.class_id = $classId AND student_info.section LIKE '%$classSection'");
        }

            $stdInfo = $query->result_array();  
        if(empty($stdInfo)){
            echo '<hr><div class="col-md-12 col-sm-12">
                    <div class="alert alert-danger">
                      <strong>Alert!</strong> Record Not Availabe.
                    </div>
                </div>';
        }
        else{                               
        echo'<div class="col-md-12 col-sm-12 p-3 display" > 
            <div class="col-md-3 text-center" >
                <img src="assets/admin/layout/img/smlogo.png" alt="logo" width="150px"> 
            </div>
            <div class="col-md-9 text-center">  
                <h4 >Student Fee Chalan Report </h4>
            </div> 
            <div class="portlet ">
                  
                <div class="portlet-body">
                    <table id="sample_1" class="table" >
                        <thead>
                            <tr> 
                                <th> Session: '. $year .' </th>
                                <th> Month Name: '. $monthName .' </th> 
                                <th> Class Name: '. $classId .' </th>
                                <th> Class Section: '. $classSection.' </th>  
                                <th> Date: '. $date.' </th>  
                            </tr>
                        </thead> 
                    </table>
                </div> 
            </div>
        </div>    
        <div class="col-md-12 col-sm-12 p-5">
            <div class="portlet purple box">
                <div class="portlet-title no-print">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Student Chalan Report
                    </div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"> </a>
                        <a class="reload" href="javascript:;"> </a>
                    </div>
                </div>
                <div class="portlet-body"> 
                    <table id="sample_12" onbeforeprint="printtable()" class="table table-striped table-bordered table-hover" >
                        <thead>
                            <tr> 
                                <th>Sr #</th>
                                <th>Chalan No</th>
                                <th>Chalan Month</th>
                                <th>Chalan Year</th>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Discount Title</th>
                                <th>Discount Percentage</th>
                                <th>Tuition Fee</th>
                                <th>AC Charges</th>
                                <th>Total</th>
                                <th>Discount</th>
                                <th>Grand Total</th>
                                <th>Paid Amount</th> 
                            </tr>
                        </thead> 
                        <tbody>'; 
                        $count = 1;   
                        foreach ($stdInfo as $value) {   
                        echo' <tr> 
                                <td>'. $count++ .'</td>
                                <td>'. $value['voucher_number'] .'</td>
                                <td>'. $value['month'] .'</td>
                                <td>'. $value['year'] .'</td>
                                <td>'. $value['student_id'] .'</td>
                                <td>'. $value['student_nam'] .'</td>
                                <td>'. $value['class_title'] .'</td>
                                <td>'. $value['section'] .'</td>
                                <td>'; 
                                    if($value['discount_id'] == 0){ echo "No Discount";}else{
                                    echo $this->common->discount_cod($value['discount_id']); }
                            echo'</td>
                                <td>';                    
                                    if($value['discount_id'] == 0){ echo "No Discount";}else{
                                    echo $this->common->dis_per($value['discount_id'])."%"; }
                            echo'</td>
                                <td>'. $value['tution_fee'] .'</td>
                                <td>'. $value['ac_charges'] .'</td>
                                <td>'. $value['amount'] .'</td>
                                <td>'. $value['discount'] .'</td>
                                <td>'. $value['dis_total'] .'</td>
                                <td>'. $value['paid'] .'</td> 
                            </tr>';
                        }  
                    echo'</tbody>  
                    </table>
                </div>
            </div>
        </div>'; 
        }
    }
//  this function get ajaxStudentChalanReportTillData till counter in different querys
    public function ajaxStudentChalanReportTillData(){
        $year = $this->input->post('year');
        $monthName = $this->input->post('monthName');          
        $classId = $this->input->post('className');  
        $classSection = $this->input->post('classSection');

        // $nmonth = date('m',strtotime($monthName)); 
        // $date = date('Y-m-d');

        if(empty($classId)){
            $query = $this->db->query("SELECT sum(amount) as dd FROM slip INNER JOIN student_info ON slip.student_id = student_info.student_id where student_info.status='Active' AND slip.year = $year AND slip.month = '$monthName' ");
        } else{
            $query = $this->db->query("SELECT sum(amount) as dd FROM slip INNER JOIN student_info ON slip.student_id = student_info.student_id where student_info.status='Active' AND slip.year = $year AND slip.month = '$monthName' AND slip.class_id= $classId AND student_info.section LIKE '%$classSection' ");
        }  
            foreach ($query->result() as $row) {
                $data['totalAmount'] = $row->dd;
            }
        if(empty($classId)){
            $query = $this->db->query("SELECT sum(dis_total) as dd FROM slip INNER JOIN student_info ON slip.student_id = student_info.student_id where student_info.status='Active' AND slip.year = $year AND month = '$monthName'");
        } else{
            $query = $this->db->query("SELECT sum(dis_total) as dd FROM slip INNER JOIN student_info ON slip.student_id = student_info.student_id where student_info.status='Active' AND slip.year = $year AND slip.month = '$monthName' AND slip.class_id = $classId AND student_info.section LIKE '%$classSection' ");
        }  
            foreach ($query->result() as $row) {
                $data['discounteTotal'] = $row->dd;
            }
        if(empty($classId)){
            $query = $this->db->query("SELECT sum(dis_total) as dd FROM slip INNER JOIN student_info ON slip.student_id = student_info.student_id where student_info.status='Active' AND slip.payment_status='Paid' AND slip.year = $year AND slip.month = '$monthName'");
        } else{
            $query = $this->db->query(" SELECT sum(dis_total) as dd FROM slip INNER JOIN student_info ON slip.student_id = student_info.student_id where student_info.status='Active' AND slip.payment_status='Paid' AND slip.year = $year AND slip.month = '$monthName' AND slip.class_id = $classId AND student_info.section LIKE '%$classSection' ");
        }  
            foreach ($query->result() as $row) {
                $data['totalPaid'] = $row->dd;
            }
        if(empty($classId)){
            $query = $this->db->query("SELECT sum(dis_total) as dd FROM slip INNER JOIN student_info ON slip.student_id = student_info.student_id where student_info.status='Active' AND slip.payment_status='Unpaid' AND slip.year = $year AND slip.month = '$monthName'");
        } else{
            $query = $this->db->query(" SELECT sum(dis_total) as dd FROM slip INNER JOIN student_info ON slip.student_id = student_info.student_id where student_info.status='Active' AND slip.payment_status='Unpaid' AND slip.year = $year AND slip.month = '$monthName' AND slip.class_id = $classId AND student_info.section LIKE '%$classSection' ");
        }  
            foreach ($query->result() as $row) {
                $data['totalUnpaid'] = $row->dd;
            }        
 
            
        echo json_encode($data);  
    }
// this function manage royaltyFeePayableReport report querys
    public function royaltyFeePayableReport(){
        $user = $this->ion_auth->user()->row();
    // $id = $user->id;
    // // get all class title using class table common function
    $data['classTile'] = $this->common->getAllData('class');
    // // get all vouchers of current month and current year common function
    $data['stdInfo'] = $this->common->royaltyChalaninfo(); 
    $data['total_paid'] = $this->common->tota_paid_amount();

    $mRoyaltyVar = ($this->common->tota_paid_amount() /100*10);
    // set float value
    $data['royaltymonthlyfee'] = number_format((float)$mRoyaltyVar, 2, '.', '');
    $data['admission_paid'] = $this->common->totalAdmissionAmount(); 
    $aRoyaltyVar = ($this->common->totalAdmissionAmount() /100*10);
    // set float value
    $data['royaltyAdmissionFee'] = number_format((float)$aRoyaltyVar, 2, '.', '');
 
        $this->load->view('temp/header', $data);
        $this->load->view('royaltyFeePayableReport', $data);
        $this->load->view('temp/footer');
    }

// 
    public function ajaxRoyalityFeePayableReport(){
        $year = $this->input->get('year');
        $monthName = $this->input->get('monthName'); 
        $classId = $this->input->get('className');
        $classSection = $this->input->get('classSection');  
        $voucherName = $this->input->get('voucherName');  
        $date = date('Y-m-d');


        $nmonth = date('m',strtotime($monthName)); 
        // echo $year.'<br>'. $monthName.'<br>' . $classId .'<br>' . $classSection .'<br>' .$voucherName .'<br>' .$date;  
        if($voucherName == 'Admission'){
            if(empty($classId)){                           
                $query = $this->db->query("SELECT student_info.student_id, student_info.student_nam,student_info.class_title, student_info.section, student_info.discount_cat, vouchers.student_ref_id, vouchers.year, vouchers.month_name, vouchers.voucher_number, vouchers.voucher_type, vouchers.total_amount, vouchers.paid_amount, vouchers.voucher_status FROM vouchers INNER JOIN student_info ON vouchers.student_ref_id = student_info.student_id WHERE vouchers.year= $year AND vouchers.month_name = '$monthName' AND vouchers.voucher_type = 'Admission' AND vouchers.voucher_status = 'Paid'");
            } else{
                $query = $this->db->query("SELECT student_info.student_id, student_info.student_nam,student_info.class_title, student_info.section, student_info.discount_cat, vouchers.student_ref_id, vouchers.year, vouchers.month_name, vouchers.voucher_number, vouchers.voucher_type, vouchers.total_amount, vouchers.paid_amount, vouchers.voucher_status FROM vouchers INNER JOIN student_info ON vouchers.student_ref_id = student_info.student_id WHERE YEAR(vouchers.paid_time)= $year AND MONTH(vouchers.paid_time) = $nmonth AND student_info.class_id = $classId AND student_info.section LIKE '%$classSection' AND vouchers.voucher_type = 'Admission' AND vouchers.voucher_status = 'Paid'");
            }
            $stdInfo = $query->result_array();
             
        } else if($voucherName == 'Monthly Fee') {
            if(empty($classId)){                           
                $query = $this->db->query("SELECT student_info.student_id, student_info.student_nam,student_info.class_title, student_info.section, student_info.discount_cat, vouchers.student_ref_id, vouchers.year, vouchers.month_name, vouchers.voucher_number, vouchers.voucher_type, vouchers.total_amount, vouchers.paid_amount, vouchers.voucher_status FROM vouchers INNER JOIN student_info ON vouchers.student_ref_id = student_info.student_id WHERE YEAR(vouchers.paid_time)= $year AND MONTH(vouchers.paid_time) = $nmonth AND vouchers.voucher_type = 'Monthly Fee' AND vouchers.voucher_status = 'Paid'" );
            } else{
                $query = $this->db->query("SELECT student_info.student_id, student_info.student_nam,student_info.class_title, student_info.section, student_info.discount_cat, vouchers.student_ref_id, vouchers.year, vouchers.month_name, vouchers.voucher_number, vouchers.voucher_type, vouchers.total_amount, vouchers.paid_amount, vouchers.voucher_status FROM vouchers INNER JOIN student_info ON vouchers.student_ref_id = student_info.student_id WHERE YEAR(vouchers.paid_time)= $year AND MONTH(vouchers.paid_time) = $nmonth AND student_info.class_id = $classId AND student_info.section LIKE '%$classSection' AND vouchers.voucher_type = 'Monthly Fee' AND vouchers.voucher_status = 'Paid'");
            }
            $stdInfo = $query->result_array();  
        }
        if(empty($stdInfo)){
            echo '<hr><div class="col-md-12 col-sm-12">
                    <div class="alert alert-danger">
                      <strong>Alert!</strong> Record Not Availabe.
                    </div>
                </div>';
        }
        else{                               
        echo'<div class="col-md-12 col-sm-12 p-3 display" > 
                <div class="col-md-3 text-center" >
                    <img src="assets/admin/layout/img/smlogo.png" alt="logo" width="150px"> 
                </div>
                <div class="col-md-9 text-center">  
                    <h4 >Student Fee Chalan Report </h4>
                </div> 
                <div class="portlet ">
                      
                    <div class="portlet-body">
                        <table id="sample_1" class="table" >
                            <thead>
                                <tr> 
                                    <th> Session: '. $year .' </th>
                                    <th> Month Name: '. $monthName .' </th>
                                    <th> Month Name: '. $voucherName .' </th> 
                                    <th> Class Name: '. $classId .' </th>
                                    <th> Class Section: '. $classSection.' </th>  
                                    <th> Date: '. $date.' </th>  
                                </tr>
                            </thead> 
                        </table>
                    </div> 
                </div>
            </div>    
            <div class="col-md-12 col-sm-12 p-5">
                <div class="portlet purple box">
                    <div class="portlet-title no-print">
                        <div class="caption">
                            <i class="fa fa-cogs"></i>Student Chalan Report
                        </div>
                        <div class="tools">
                            <a class="collapse" href="javascript:;"> </a>
                            <a class="reload" href="javascript:;"> </a>
                        </div>
                    </div>
                    <div class="portlet-body"> 
                        <table id="sample_12" onbeforeprint="printtable()" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr> 
                                    <th>Sr #</th>
                                    <th>Chalan No</th>
                                    <th>Chalan Year</th>
                                    <th>Chalan Month</th>
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Class</th>
                                    <th>Section</th> 
                                    <th>Vouchers Type</th>
                                    <th>Discount Title</th>
                                    <th>Discount Percentage</th>  
                                    <th>Voucher Amount</th>
                                    <th>Paid Amount </th>
                                    <th>Voucher Status</th>  
                                </tr>
                            </thead> 
                            <tbody>'; 
                            $count = 1;   
                            $sum = 0;
                            $paidAmount = 0;
                            foreach ($stdInfo as $value) {  
                                $sum = $sum + $value['total_amount'];
                                $paidAmount = $paidAmount + $value['paid_amount'];
                            echo' <tr> 
                                    <td>'. $count++ .'</td>
                                    <td>'. $value['voucher_number'] .'</td>
                                    <td>'. $value['year'] .'</td>
                                    <td>'. $value['month_name'] .'</td> 
                                    <td>'. $value['student_id'] .'</td>
                                    <td>'. $value['student_nam'] .'</td>
                                    <td>'. $value['class_title'] .'</td>
                                    <td>'. $value['section'] .'</td>
                                    <td>'. $value['voucher_type'].'</td>
                                    <td>'. $this->common->discount_cod($value['discount_cat']).'</td> 
                                    <td>'. $this->common->admission_dis_per($value['discount_cat']).'%' .'</td> 
                                    <td>'. $value['total_amount'].'</td>
                                    <td>'. $value['paid_amount'].'</td>
                                    <td>'. $value['voucher_status'].' </td> 
                                </tr>';
                            }  
                        echo'</tbody> 
                                <tr>
                                    <td colspan="11" rowspan="" headers=""> Total </td>
                                    <td >'. $sum .'</td>
                                    <td >'. $paidAmount .'</td>
                                    <td ></td>
                                </tr>    
                        </table>
                    </div>
                </div>
            </div>'; 
        }
    }
    //get till data of ajaxRoyalityFeePayableReportTillData
    public function ajaxRoyalityFeePayableReportTillData(){

        $year = $this->input->post('year');
        $monthName = $this->input->post('monthName');          
        $classId = $this->input->post('className');  
        $classSection = $this->input->post('classSection');
        // use this function get month id
        $numberMonth = date('m',strtotime($monthName));

        if(empty($classId)){
            $query = $this->db->query("SELECT sum(vouchers.paid_amount) as dd FROM vouchers INNER JOIN student_info ON vouchers.student_ref_id = student_info.student_id where student_info.status='Active' AND vouchers.voucher_status='Paid' AND YEAR(vouchers.paid_time) = $year AND MONTH(vouchers.paid_time) = $numberMonth AND vouchers.voucher_type = 'Monthly Fee'");
        } else{
            $query = $this->db->query("SELECT sum(vouchers.paid_amount) as dd FROM vouchers INNER JOIN student_info ON vouchers.student_ref_id = student_info.student_id where student_info.status='Active' AND vouchers.voucher_status='Paid' AND YEAR(vouchers.paid_time) = $year AND MONTH(vouchers.paid_time) = $numberMonth AND student_info.class_id= $classId AND student_info.section LIKE '%$classSection' AND vouchers.voucher_type = 'Monthly Fee' ");
        }  
            foreach ($query->result() as $row) {
                $data['totalPaid'] = $row->dd;
            }

         

        if(empty($classId)){
            $query = $this->db->query("SELECT sum(vouchers.paid_amount) as dd FROM vouchers INNER JOIN student_info ON vouchers.student_ref_id = student_info.student_id where student_info.status='Active' AND vouchers.voucher_status='Paid' AND YEAR(vouchers.paid_time) = $year AND MONTH(vouchers.paid_time) = $numberMonth AND vouchers.voucher_type = 'Admission'");
        } else{
            $query = $this->db->query("SELECT sum(vouchers.paid_amount) as dd FROM vouchers INNER JOIN student_info ON vouchers.student_ref_id = student_info.student_id where student_info.status='Active' AND vouchers.voucher_status='Paid' AND YEAR(vouchers.paid_time) = $year AND MONTH(vouchers.paid_time) = $numberMonth AND student_info.class_id= $classId AND student_info.section LIKE '%$classSection' AND vouchers.voucher_type = 'Admission' ");
        }  
            foreach ($query->result() as $row) {
                $data['admissionTotal'] = $row->dd;
            }
             
        echo json_encode($data); 

    }

public function FeeReceipt_reports() {
$user = $this->ion_auth->user()->row();
$id = $user->id;
$data['massage'] = $this->common->getWhere('massage', 'receiver_id', $id);
$data['totalStudent'] = $this->common->totalAdmission();
$data['Active_stds'] = $this->common->with_discount();
$data['Deactive_stds'] = $this->common->without_discount();
$data['totalAttendStudent'] = $this->common->totalAttendStudent();
$data['count_paid'] = $this->common->count_paid_per();
$data['count_unpaid'] = $this->common->count_unpaid_per();
$data['absentEmploy'] = $this->homeModel->absentEmploy();
$data['leaveEmploy'] = $this->homeModel->leaveEmploy();
$data['event'] = $this->homeModel->all_event($id);
$data['notice'] = $this->common->getAllData('notice_board');
$data['total_discount1'] = $this->homeModel->atten_chart_FeeReciept1();
$data['total_discount2'] = $this->homeModel->atten_chart_FeeReciept2();
$data['stdInfo'] = $this->common->student_chalan_receipt();
$data['total_collection']=$this->common->get_sum();
if ($this->ion_auth->is_student()) {
//Whice notice is created for student these notice can see both students and parents.
$query = $this->common->getWhere('student_info', 'user_id', $id);
foreach ($query as $row) {
$class_id = $row['class_id'];
}
$data['class_id'] = $class_id;
$data['day'] = $this->common->getAllData('config_week_day');
$data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
$data['teacher'] = $this->common->getAllData('teachers_info');
}
$this->load->view('temp/header', $data);
$this->load->view('FeeReceipt_reports', $data);
$this->load->view('temp/footer');
}
    public function Student_receiveables() {
        $user = $this->ion_auth->user()->row();
        $id = $user->id;
        $data['massage'] = $this->common->getWhere('massage', 'receiver_id', $id);
        $data['totalStudent'] = $this->common->total_chalan();
        $data['totalReceiveable'] = $this->common->tota_unpaid_amount();
        $data['Active_stds'] = $this->common->with_discount();
        $data['Deactive_stds'] = $this->common->tota_paid_amount();
        $data['totalAttendStudent'] = $this->common->totalAttendStudent();
        $data['count_paid'] = $this->common->count_paid();
        $data['count_unpaid'] = $this->common->count_unpaid();
         
        $data['stdInfo'] = $this->common->student_chalan();
        $data['total_collection']=$this->common->get_sum();
        if ($this->ion_auth->is_student()) {
            //Whice notice is created for student these notice can see both students and parents.
            $query = $this->common->getWhere('student_info', 'user_id', $id);
            foreach ($query as $row) {
                $class_id = $row['class_id'];
            }
            $data['class_id'] = $class_id;
            $data['day'] = $this->common->getAllData('config_week_day');
            $data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
            $data['teacher'] = $this->common->getAllData('teachers_info');
        }
        $this->load->view('temp/header', $data);
        $this->load->view('Student_receiveables', $data);
        $this->load->view('temp/footer');
    }
    public function studentReceiveAbles() {
        $user = $this->ion_auth->user()->row();
        $id = $user->id;
        $data['massage'] = $this->common->getWhere('massage', 'receiver_id', $id);
        $data['totalStudent'] = $this->common->total_chalan(); 
        $data['totalReceiveable'] = $this->common->tota_unpaid_amount();
        $data['Active_stds'] = $this->common->with_discount();
        $data['Deactive_stds'] = $this->common->tota_paid_amount();
        $data['totalAttendStudent'] = $this->common->totalAttendStudent();
        $data['count_paid'] = $this->common->count_paid();
        $data['count_unpaid'] = $this->common->count_unpaid(); 
         
         
        $data['stdInfo'] = $this->common->student_chalan();

        $data['classTile'] = $this->common->getAllData('class');  
        // $data['classTile'] = $this->common->classList();

        $data['total_collection']=$this->common->get_sum();
        if ($this->ion_auth->is_student()) {
            //Whice notice is created for student these notice can see both students and parents.
            $query = $this->common->getWhere('student_info', 'user_id', $id);
            foreach ($query as $row) {
                $class_id = $row['class_id'];
            }
            $data['class_id'] = $class_id;
            $data['day'] = $this->common->getAllData('config_week_day');
            $data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
            $data['teacher'] = $this->common->getAllData('teachers_info');
        }
        $this->load->view('temp/header', $data);
        $this->load->view('studentReceiveAbles', $data);
        $this->load->view('temp/footer');
    } 

    //This function gives us class section and class info.
    public function ajaxClassSectionApp() {
        $classTitle = $this->input->get('q'); 
        $query = $this->common->getWhere('class', 'id', $classTitle);
        foreach ($query as $row) {
            $data = $row;
        }

        if (!empty($data['section'])) {
            $section = $data['section'];
            $sectionArray = explode(",", $section);
            echo ' 
                    <option value="">'.lang('select').'</option>';
            foreach ($sectionArray as $sec) {
                echo '<option value="' . $sec . '">' . $sec . '</option>';
            }
            echo '</select></div></div>';
             
        } else {
            echo '<div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                        <div class="alert alert-warning">
                                <strong>'.lang('clasc_5').'</strong> '.lang('clasc_6').'
                        </div></div></div>';
        }
    }
    public function commonFilter(){
        $classId = $this->input->get('c_Name');
        $classSection = $this->input->get('c_Section');
        $studentName = $this->input->get('s_Name');
        $monthId = $this->input->get('m_Id'); 
        $date = date('Y-M-d');
     
        
        if(empty($classId)) {
            $query = $this->db->query("SELECT student_info.student_id, student_info.student_nam ,student_info.class_title, student_info.section, student_info.phone, SUM(slip.dis_total)as amount,slip.voucher_number,slip.year, slip.payment_status,slip.dues , slip.tution_fee,slip.discount, COUNT(slip.month) as month FROM slip INNER JOIN student_info ON slip.student_id = student_info.student_id where slip.payment_status='unpaid' AND student_info.status = 'Active'  GROUP BY student_info.student_id ORDER by slip.due_date DESC");
                $cId = $classId;
        } else{
            $query = $this->db->query("SELECT * from (SELECT student_info.student_id, student_info.student_nam ,student_info.class_title, student_info.section, student_info.phone, SUM(slip.dis_total)as amount,slip.voucher_number,slip.year, slip.payment_status,slip.dues , slip.tution_fee,slip.discount, COUNT(slip.month) as month FROM slip INNER JOIN student_info ON slip.student_id = student_info.student_id where (slip.payment_status='unpaid' AND student_info.status = 'Active') AND (student_info.class_id LIKE '$classId' AND student_info.section LIKE '%$classSection' AND student_info.student_nam LIKE '%$studentName' ) GROUP BY student_info.student_id ORDER by slip.due_date DESC) as temp where temp.month like '%$monthId'"); 
                $cId = $this->common->class_title($classId);
        }
        $stdInfo = $query->result_array(); 
echo'
    <div class="col-md-12 col-sm-12 p-3 display" > 
        <div class="col-md-3 text-center" >
            <img src="assets/admin/layout/img/smlogo.png" alt="logo" width="150px"> 
        </div>
        <div class="col-md-9 text-center">  
            <h4 >Student Receiveables  Report</h4>
        </div> 
        <div class="portlet ">
              
            <div class="portlet-body">
                <table id="sample_1" class="table" >
                    <thead>
                        <tr> 
                            <th> Class Name: '. $cId .' </th>
                            <th> Class Section: '. $classSection.' </th> 
                            <th> Student Name: '. $studentName.' </th>
                            <th> No of Months Overdue: '. $monthId.' </th> 
                            <th> Date: '. $date.' </th>  
                        </tr>
                    </thead> 
                </table>
            </div> 
        </div>
    </div>
    <div class="col-md-12 col-sm-12 p-5">
        <div class="portlet purple box">
            <div class="portlet-title no-print">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Student Receiveables information
                </div>
                <div class="tools">
                    <a class="collapse" href="javascript:;">
                    </a>
                    <a class="reload" href="javascript:;">
                    </a>
                </div>
            </div>
            <div class="portlet-body"> 
                <table id="sample_12" onbeforeprint="printtable()" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr> 
                            <th>Sr #</th>
                            <th>Student ID</th> 
                            <th>Student Name</th>
                            <th>Contact#</th> 
                            <th>Class</th>
                            <th>Section</th> 
                            <th>Amount</th>
                            <th>No of Months Overdue</th> 
                        </tr>
                    </thead> 
                    <tbody>'; 
                $count=1;
                $sum=0;
                foreach ($stdInfo as $row) { 
                             $sum=$sum+$row['amount'];               
                    echo'<tr>
                            <td>'. $count++ .' </td> 
                            <td>'. $row['student_id'] .'</td>
                            <td>'. $row['student_nam'] .'</td>
                            <td>'. $row['phone'] .'</td>
                            <td>'. $row['class_title'] .'</td>
                            <td>'. $row['section'] .'</td>
                            <td>'. $row['amount'] .' </td> 
                            <td> 
                            <a href="" id="'.$row['student_id'].'" data-toggle="modal" data-target="#myModal" onclick ="stdDrildown(this.id)"  >'. $row['month'] .' 
                                            </a>
                            </td> 
                        </tr>';
                }
                echo'</tbody> 
                        <tr>
                            <td colspan="6" style="text-align:right; font-weight:bold; padding-right:30px; fontsize: 18px;">Total Amount</td>
                              
                            <td style="font-weight:bold; fontsize: 18px;" id="abc">'.$sum.' </td>
                            <td ></td>
                        </tr> 
                </table>
            </div>
        </div>
    </div>';  
         
    }
    // this function return student receivable information
    public function ajaxCommonFilterTillData(){
        $classId = $this->input->post('className');
        $classSection = $this->input->post('classSection');
        $studentName = $this->input->post('studentName');
        $monthId = $this->input->post('monthid'); 
        // this query count total paid and unpaid vouchers amount
        $totalAmount = $this->db->query("SELECT sum(slip.dis_total) as dd FROM slip join student_info on slip.student_id = student_info.student_id where (student_info.class_id LIKE '$classId' AND student_info.section LIKE '%$classSection' AND student_info.student_nam LIKE '%$studentName') AND student_info.status = 'Active' "); 
        foreach ($totalAmount->result() as $row) {
            $data['totalamount'] = $row->dd;       
        } 
        // this query count total paid voucher and sum of paid vouchers
        $query1 = $this->db->query("SELECT sum(slip.dis_total) as dd, count(slip.dis_total) as count  FROM slip join student_info on slip.student_id = student_info.student_id where (student_info.class_id LIKE '$classId' AND student_info.section LIKE '%$classSection' AND student_info.student_nam LIKE '%$studentName') AND ((slip.payment_status = 'Unpaid' OR slip.payment_status = 'unpaid') AND student_info.status = 'Active') "); 
        foreach ($query1->result() as $row) {
            $data['data1'] = $row->dd;
            $data['unpaid'] = $row->count;      
        }
        // this query count total unpaid voucher and sum of un paid voucher
        $totalPay = $this->db->query("SELECT sum(slip.dis_total) as dd, count(slip.dis_total) as count FROM slip join student_info on slip.student_id = student_info.student_id where (student_info.class_id LIKE '$classId' AND student_info.section LIKE '%$classSection' AND student_info.student_nam LIKE '%$studentName') AND ((slip.payment_status = 'Paid' OR slip.payment_status = 'paid' ) AND student_info.status = 'Active') "); 
        foreach ($totalPay->result() as $row) {
            $data['totalPaid'] = $row->dd;
            $data['paid'] = $row->count;        
        }
        echo json_encode($data);
    }
// student drildown ajax function value
    public function ajaxStdDrildown(){
        $stuId = $this->input->get('std');
        $query = $this->db->query("SELECT student_info.student_id, student_info.student_nam ,student_info.class_title, student_info.section, slip.amount,slip.dis_total, slip.dues, slip.voucher_number,slip.year, slip.payment_status,slip.ac_charges , slip.tution_fee,slip.discount,slip.month FROM slip INNER JOIN student_info ON slip.student_id = student_info.student_id where (slip.payment_status='unpaid' AND student_info.status = 'Active') AND (student_info.student_id=$stuId) ORDER by slip.year,slip.voucher_number ASC ");
        $drildown = $query->result_array(); 
    echo'
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"><b>Number Of Voucher Detail</b></h4>
                   
                    <table class="table table-striped table-bordered table-hover table-responsive p-5">
                        <thead>
                            <tr> 
                                <th>Sr #</th>
                                <th>Voucher Number</th>
                                <th>Student ID</th> 
                                <th>Student Name</th> 
                                <th>Class</th>
                                <th>Section</th>
                                <th>year</th> 
                                <th>month</th>
                                <th>Tuition Fee</th>
                                <th>AC Charges</th>
                                <th>Amount</th>
                                <th>Discount</th>
                                <th>Total Payable</th>  
                            </tr>
                        </thead> 
                        <tbody>';  
                        $count = 1;
                        $sum = 0;
                        foreach ($drildown as $row) { 
                            $sum=$sum+$row['dis_total'];
                            echo'<tr>
                                <td> '. $count++.' </td>
                                <td> '. $row['voucher_number'] .' </td> 
                                <td> '. $row['student_id'] .'</td>
                                <td> '. $row['student_nam'] .'</td>
                                <td> '. $row['class_title'] .'</td>
                                <td> '. $row['section'] .'</td>
                                <td> '. $row['year'] .'</td>
                                <td> '. $row['month'] .'</td>
                                <td> '. $row['tution_fee'] .'</td> 
                                <td> '. $row['ac_charges'] .'</td>  
                                <td> '. $row['amount'] .' </td> 
                                <td> '. $row['discount'] .'</td>
                                <td> '. $row['dis_total'] .' </td> 
                            </tr>';
                     } 
                        echo'<tr> 
                                <td colspan="12" text-align="center">Total </td> 
                                <td > '. $sum.' </td>
                            </tr>
                        </tbody> 
                    </table> 
                </div> 
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>';
    }

public function Leftover() {
    $user = $this->ion_auth->user()->row();
    $id = $user->id;
    $data['massage'] = $this->common->getWhere('massage', 'receiver_id', $id);
    $data['totalStudent'] = $this->common->totalAdmission();
    $data['totalReceiveable'] = $this->common->totalActive();
    $data['Active_stds'] = $this->common->with_discount();
    $data['Deactive_stds'] = $this->common->total_DeActive();
     
    $data['date_wise_students'] = $this->homeModel->atten_chart_leftover();

    $data['stdInfo'] = $this->common->student_chalan1();

    $data['total_collection'] = $this->common->get_sum();

    if ($this->ion_auth->is_student()) {
        //Whice notice is created for student these notice can see both students and parents.
        $query = $this->common->getWhere('student_info', 'user_id', $id);
        foreach ($query as $row) {
            $class_id = $row['class_id'];
        }
        $data['class_id'] = $class_id;
        $data['day'] = $this->common->getAllData('config_week_day');
        $data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
        $data['teacher'] = $this->common->getAllData('teachers_info');
    }
    $this->load->view('temp/header', $data);
    $this->load->view('Leftover', $data);
    $this->load->view('temp/footer');
}

// this funtion get all data of leftover Students using given class id and class section
public function leftoverStudents(){
    $user = $this->ion_auth->user()->row();
    $id = $user->id; 
    $data['totalStudent'] = $this->common->totalStudent();
    $data['activeStudent'] = $this->common->activeStudent(); 
    $data['leftoverStudent'] = $this->common->total_DeActive();
    $data['maleStudent'] = $this->common->maleStudent();
    $data['femaleStudent'] = $this->common->femaleStudent(); 

    $data['classTile'] = $this->common->getAllData('class');

    $data['stdInfo'] = $this->common->leftoverStudent();
    $this->load->view('temp/header');
    $this->load->view('leftoverStudents', $data);
    $this->load->view('temp/footer');
}

// this function is used to get leftover students data using given class name and section
public function ajaxLeftoverStudent(){
    $classId = $this->input->get('className');
    $classSection = $this->input->get('classSection'); 
    $date = date('Y-mm-dd');
    $query = $this->db->query("SELECT student_info.student_id, student_info.registration_number, student_info.student_nam, student_info.farther_name, student_info.class_title, student_info.section, student_info.year, SUM(slip.dis_total) as dis_total, slip.payment_status, left_over_student_info.date_of_leaving,left_over_student_info.left_over_reason,COUNT(DISTINCT month) as month FROM left_over_student_info INNER JOIN slip ON left_over_student_info.student_id = slip.student_id INNER JOIN student_info ON left_over_student_info.student_id = student_info.student_id WHERE student_info.class_id= $classId AND student_info.section LIKE '%$classSection' AND slip.payment_status = 'unpaid' GROUP BY student_info.student_id ORDER BY student_info.student_id ASC ");
    $data = $query->result_array();
    //print_r($data);                                   
    echo'<div class="col-md-12 col-sm-12 p-3 display" > 
        <div class="col-md-3 text-center" >
            <img src="assets/admin/layout/img/smlogo.png" alt="logo" width="150px"> 
        </div>
        <div class="col-md-9 text-center">  
            <h4>Leftover Students Information</h4>
        </div> 
        <div class="portlet ">
              
            <div class="portlet-body">
                <table id="sample_1" class="table" >
                    <thead>
                        <tr> 
                            <th> Class Name: '. $classId .' </th>
                            <th> Class Section: '. $classSection.' </th>  
                            <th> Date: '. $date.' </th>  
                        </tr>
                    </thead> 
                </table>
            </div> 
        </div>
    </div>
    <div class="col-md-12 col-sm-12 p-5">
        <div class="portlet purple box">
            <div class="portlet-title no-print">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Leftover Students Information
                </div>
                <div class="tools">
                    <a class="collapse" href="javascript:;">
                    </a>
                    <a class="reload" href="javascript:;">
                    </a>
                </div>
            </div>
            <div class="portlet-body"> 
                <table id="sample_12" onbeforeprint="printtable()" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr> 
                            <th> Sr.# </th>  
                            <th> Registration Number </th>
                            <th> Student ID </th> 
                            <th> Student Name </th>
                            <th> Father Name </th>
                            <th> Class </th>
                            <th> Section </th> 
                            <th> Year </th> 
                            <th> Out Standing Balance </th> 
                            <th> Period </th>
                            <th> Payment Status</th>
                            <th> School Leaving Date </th>
                            <th> Leaving Reason </th>
                        </tr>
                    </thead> 
                    <tbody>'; 
                    $count = 1; 
                    foreach ($data as $value) {  
                    echo' <tr>
                            <td>'. $count++ .'</td> 
                            <td>'. $value['registration_number'] .'</td>
                            <td>'. $value['student_id'] .'</td>
                            <td>'. $value['student_nam'] .'</td>
                            <td>'. $value['farther_name'] .'</td>
                            <td>'. $value['class_title'] .'</td>
                            <td>'. $value['section'] .'</td>
                            <td>'. $value['year'] .'</td> 
                            <td>'. $value['dis_total'] .'</td> 
                            <td><a href="" id="'.$value['student_id'].'" data-toggle="modal" data-target="#myModal" onclick ="leftoverDrildown(this.id)"  >'. $value['month'] .'</a></td>
                            <td>'. $value['payment_status'] .'</td>
                            <td>'. $value['date_of_leaving'] .'</td>
                            <td>'. $value['left_over_reason'] .'</td>
                        </tr>';
                    } 
                echo'</tbody>  
                </table>
            </div>
        </div>
    </div>'; 
}
// function update all tills counter value 
public function ajaxLeftoverStudentsTillData(){
    $classId = $this->input->post('className');  
    $classSection = $this->input->post('classSection');  
    
    // this query count total student of given class and session
    $query = $this->db->query("SELECT count(*) as totalStudent FROM student_info WHERE class_id = $classId AND section LIKE '%$classSection' ");   
    foreach ($query->result() as $row) {
        $data['totalStudent'] = $row->totalStudent;       
    }
     
    // this query count total active students of given class section 
    $query = $this->db->query("SELECT count(*) as activeStudent FROM student_info WHERE class_id = $classId AND section LIKE '%$classSection' AND status= 'Active' ");
    foreach ($query->result() as $row) {
        $data['activeStudent'] = $row->activeStudent;       
    }
     
    echo json_encode($data);
}
// this function left over students info showing on drilldown
public function ajaxleftoverDrildown(){
    $stuId = $this->input->get('std');
    $query = $this->db->query("SELECT student_info.student_id, student_info.student_nam ,student_info.class_title, student_info.section, slip.amount,slip.dis_total, slip.dues, slip.voucher_number,slip.year, slip.payment_status,slip.ac_charges , slip.tution_fee,slip.discount,slip.month FROM slip INNER JOIN student_info ON slip.student_id = student_info.student_id where (slip.payment_status='unpaid' AND student_info.status = 'Schoolleft') AND (student_info.student_id=$stuId) ORDER by slip.year,slip.voucher_number ASC ");
    $drildown = $query->result_array(); 
    echo'
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"><b>Number Of Voucher Detail</b></h4>
                   
                    <table class="table table-striped table-bordered table-hover table-responsive p-5">
                        <thead>
                            <tr> 
                                <th>Sr #</th>
                                <th>Voucher Number</th>
                                <th>Student ID</th> 
                                <th>Student Name</th> 
                                <th>Class</th>
                                <th>Section</th>
                                <th>year</th> 
                                <th>month</th>
                                <th>Tuition Fee</th>
                                <th>AC Charges</th>
                                <th>Amount</th>
                                <th>Discount</th>
                                <th>Total Payable</th>  
                            </tr>
                        </thead> 
                        <tbody>';  
                        $count = 1;
                        $sum = 0;
                        foreach ($drildown as $row) { 
                            $sum=$sum+$row['dis_total'];
                            echo'<tr>
                                <td> '. $count++.' </td>
                                <td> '. $row['voucher_number'] .' </td> 
                                <td> '. $row['student_id'] .'</td>
                                <td> '. $row['student_nam'] .'</td>
                                <td> '. $row['class_title'] .'</td>
                                <td> '. $row['section'] .'</td>
                                <td> '. $row['year'] .'</td>
                                <td> '. $row['month'] .'</td>
                                <td> '. $row['tution_fee'] .'</td> 
                                <td> '. $row['ac_charges'] .'</td>  
                                <td> '. $row['amount'] .' </td> 
                                <td> '. $row['discount'] .'</td>
                                <td> '. $row['dis_total'] .' </td> 
                            </tr>';
                     } 
                        echo'<tr> 
                                <td colspan="12" text-align="center">Total </td> 
                                <td > '. $sum.' </td>
                            </tr>
                        </tbody> 
                    </table> 
                </div> 
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>';
}

// this function is used get siblings information from student info and discount info

public function siblingStudent (){
    $user = $this->ion_auth->user()->row();
    $id = $user->id; 
    $data['totalStudent'] = $this->common->totalStudent();
    $data['activeStudent'] = $this->common->activeStudent(); 
    $data['siblingtotal'] = $this->common->siblingTotal();
    // $data['maleStudent'] = $this->common->maleStudent();
    // $data['femaleStudent'] = $this->common->femaleStudent(); 

    $data['classTile'] = $this->common->getAllData('class');

    $data['stdInfo'] = $this->common->studentInfo();

    $this->load->view('temp/header');
    $this->load->view('siblingStudents', $data);
    $this->load->view('temp/footer');
}

// this function is used to get Sibling students data using given Father cnic number,  class name and section
public function ajaxSiblingStudent(){
    $f_cnic = $this->input->get('f_cnic');
    $classId = $this->input->get('className');
    $classSection = $this->input->get('classSection'); 
    // echo $f_cnic. $classId . $classSection;
    $date = date('Y-mm-dd');
    if(empty($classId)){
        $query = $this->db->query("SELECT * FROM `student_info` WHERE father_cnic = '$f_cnic' ORDER BY `id`  DESC ");
        $stdInfo = $query->result_array();
        $arr = array(); 
        foreach ($stdInfo as $key => $item) {
           $arr[$item['father_cnic']][$key] = $item;
          
        } 
    } else{
        $query = $this->db->query("SELECT * FROM `student_info` WHERE father_cnic LIKE '%$f_cnic' AND class_id = $classId AND section LIKE '%$classSection'  ORDER BY `id`  DESC ");
        $stdInfo = $query->result_array();
        $arr = array(); 
        foreach ($stdInfo as $key => $item) {
           $arr[$item['father_cnic']][$key] = $item;
          
        }
    }   
    if(empty($arr)){
        echo '<hr><div class="col-md-12 col-sm-12">
                <div class="alert alert-danger">
                  <strong>Alert!</strong> Record Not Availabe.
                </div>
            </div>';
    }
    else{                               
    echo'<div class="col-md-12 col-sm-12 p-3 display" > 
        <div class="col-md-3 text-center" >
            <img src="assets/admin/layout/img/smlogo.png" alt="logo" width="150px"> 
        </div>
        <div class="col-md-9 text-center">  
            <h4 >Sibling Students Information Report</h4>
        </div> 
        <div class="portlet ">
              
            <div class="portlet-body">
                <table id="sample_1" class="table" >
                    <thead>
                        <tr> 
                            <th> Father CNIC: '. $f_cnic .' </th>
                            <th> Class Name: '. $classId .' </th>
                            <th> Class Section: '. $classSection.' </th>  
                            <th> Date: '. $date.' </th>  
                        </tr>
                    </thead> 
                </table>
            </div> 
        </div>
    </div>
    <div class="col-md-12 col-sm-12 p-5">
        <div class="portlet purple box">
            <div class="portlet-title no-print">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Sibling Students Information
                </div>
                <div class="tools">
                    <a class="collapse" href="javascript:;">
                    </a>
                    <a class="reload" href="javascript:;">
                    </a>
                </div>
            </div>
            <div class="portlet-body"> 
                <table id="sample_12" onbeforeprint="printtable()" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr> 
                            <th> Sr.# </th>  
                            <th> Registration Number </th>
                            <th> Student ID </th> 
                            <th> Student Name </th>
                            <th> Father Name </th>
                            <th> Father CNIC </th>
                            <th> Class </th>
                            <th> Section </th>
                            <th> Discount </th> 
                            <th> Year </th>  
                            <th> Parmanent Address</th>
                        </tr>
                    </thead> 
                    <tbody>'; 
                    $count = 1; 
                foreach($arr as $data){
                    foreach ($data as $value) {  
                    echo' <tr>
                            <td>'. $count++ .'</td> 
                            <td>'. $value['registration_number'] .'</td>
                            <td>'. $value['student_id'] .'</td>
                            <td>'. $value['student_nam'] .'</td>
                            <td>'. $value['farther_name'] .'</td>
                            <td><a href="" id="'. $value['father_cnic'].'" data-toggle="modal" data-target="#myModal" onclick ="siblingDrildown(this.id)"  >'. $value['father_cnic'].'
                                            </a></td>
                            <td>'. $value['class_title'] .'</td>
                            <td>'. $value['section'] .'</td>
                            <td>'. $this->common->discount_cod($value['discount_cat']) .'</td>
                            <td>'. $value['year'] .'</td> 
                            <td>'. $value['permanent_address'] .'</td> 
                        </tr>';
                    } 
                }
                echo'</tbody>  
                </table>
            </div>
        </div>
    </div>'; 
    }
}
// function update all tills counter value 
public function ajaxSiblingStudentsTillData(){
    $f_cnic = $this->input->post('f_cnic'); 
    $classId = $this->input->post('className');  
    $classSection = $this->input->post('classSection');  
    
    // // this query count total student of given class and session
    if(empty($classId)){
        $query = $this->db->query("SELECT count(*) as totalStudent FROM student_info");
    }else{
        $query = $this->db->query("SELECT count(*) as totalStudent FROM student_info WHERE class_id = $classId AND section LIKE '%$classSection' "); 
    }
        foreach ($query->result() as $row) {
            $data['totalStudent'] = $row->totalStudent;       
        }
     
    // // this query count total active students of given class section 
    if(empty($classId)){
        $query = $this->db->query("SELECT count(*) as activeStudent FROM student_info WHERE status= 'Active' ");
    } else{
        $query = $this->db->query("SELECT count(*) as activeStudent FROM student_info WHERE class_id = $classId AND section LIKE '%$classSection' AND status= 'Active' ");
    }
        foreach ($query->result() as $row) {
            $data['activeStudent'] = $row->activeStudent;       
        }

    if(empty($classId)){
        $query = $this->db->query("SELECT count(*) as siblingStudent FROM student_info WHERE father_cnic = '$f_cnic' AND status= 'Active' ");
    } else {
        $query = $this->db->query("SELECT count(*) as siblingStudent FROM student_info WHERE father_cnic = '$f_cnic' AND class_id = $classId AND section LIKE '%$classSection' AND status= 'Active' ");    
    }
        foreach ($query->result() as $row) {
            $data['siblingStudent'] = $row->siblingStudent;       
        }   
    echo json_encode($data);
}
// this function left over students info showing on drilldown
public function ajaxsiblingDrildown(){
    $cnic = $this->input->get('f_cnic');
    $query = $this->db->query("SELECT * FROM student_info WHERE father_cnic = '$cnic' ");
    $drildown = $query->result_array(); 
    echo'
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"><b>Number Of Voucher Detail</b></h4>
                   
                    <table class="table table-striped table-bordered table-hover table-responsive p-5">
                        <thead>
                            <tr> 
                                <th> Sr.# </th>  
                                <th> Registration Number </th>
                                <th> Student ID </th> 
                                <th> Student Name </th>
                                <th> Father Name </th>
                                <th> Father CNIC</th>
                                <th> Class </th>
                                <th> Section </th> 
                                <th> Discount </th> 
                                <th> Year </th>
                                <th> Address </th>    
                            </tr>
                        </thead> 
                        <tbody>';  
                        $count = 1; 
                        foreach ($drildown as $row) {  
                            echo'<tr>
                                <td> '. $count++.' </td>
                                <td> '. $row['registration_number'] .' </td> 
                                <td> '. $row['student_id'] .'</td>
                                <td> '. $row['student_nam'] .'</td>
                                <td> '. $row['farther_name'] .'</td>
                                <td> '. $row['father_cnic'] .'</td>
                                <td> '. $row['class_title'] .'</td>
                                <td> '. $row['section'] .'</td>
                                <td> '. $this->common->discount_cod($row['discount_cat']) .'</td>
                                <td> '. $row['year'] .'</td> 
                                <td> '. $row['permanent_address'] .'</td>
                            </tr>';
                     } 
                echo'   </tbody> 
                    </table> 
                </div> 
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>';
}
// 
public function feeRecoveryReport(){

    $user = $this->ion_auth->user()->row();
    $id = $user->id; 
    $data['totalStudent'] = $this->common->totalStudent();
    $data['activeStudent'] = $this->common->activeStudent();  

    $data['paidVouchers'] = $this->common->paidVouchers(); 

    $data['classTile'] = $this->common->getAllData('class');

    $data['totalPaid'] = $this->common->currentMonthTotalPaid();

    $data['onlineTotalPaid'] = $this->common->currentMonthOnlineTotalPaid();
    $data['overDue'] = $this->common->currentMonthOverDue();
    $data['totalFee'] = $this->common->currentMonthTotalFee();
    $data['onlineOverDue'] = $this->common->currentMonthonlineOverDue();

    $this->load->view('temp/header');
    $this->load->view('feeRecoveryReport', $data);
    $this->load->view('temp/footer');
}

// this function is used to get Sibling students data using given Father cnic number,  class name and section
public function ajaxRecoveryReport(){
    $year = $this->input->get('year');
    $monthName = $this->input->get('monthName');
    $mathodName = $this->input->get('mathodName');
    $classId = $this->input->get('className');
    $classSection = $this->input->get('classSection'); 
    //echo $year. $mathodName . "<br>".$monthName. $classId . $classSection;
    $date = date('Y-m-d');
 
    if($mathodName == 'Cash'){
      if(empty($classId)){
        $query = $this->db->query("SELECT sum(slip.dis_total) as total, date(vouchers.paid_time) as paidDate FROM slip INNER JOIN vouchers ON slip.student_id = vouchers.student_ref_id WHERE slip.year = $year AND vouchers.year = $year AND slip.month = '$monthName' AND vouchers.month_name = '$monthName' AND slip.payment_status = 'Paid' AND vouchers.voucher_status = 'Paid' AND (slip.mathod = '$mathodName') GROUP BY date(vouchers.paid_time)");
      } else{
        $query = $this->db->query("SELECT sum(slip.dis_total) as total, date(vouchers.paid_time) as paidDate,student_info.section FROM slip INNER JOIN vouchers ON slip.student_id = vouchers.student_ref_id INNER JOIN student_info ON slip.student_id = student_info.student_id WHERE slip.year = 2021 AND vouchers.year = 2021 AND slip.month = 'February' AND vouchers.month_name = 'February' AND slip.payment_status = 'Paid' AND vouchers.voucher_status = 'Paid' AND (slip.mathod = '$mathodName') AND slip.class_id = '$classId' AND student_info.section LIKE '%$classSection' GROUP BY date(vouchers.paid_time)");
      }
        $stdInfo = $query->result_array(); 
        
    } else{
      if(empty($classId)){
        $query = $this->db->query("SELECT sum(slip.dis_total) as total, date(vouchers.paid_time) as paidDate FROM slip INNER JOIN vouchers ON slip.student_id = vouchers.student_ref_id WHERE slip.year = $year AND vouchers.year = $year AND slip.month = '$monthName' AND vouchers.month_name = '$monthName' AND slip.payment_status = 'Paid' AND vouchers.voucher_status = 'Paid' AND (slip.mathod = 'BANK' OR slip.mathod = 'CreditCard' OR slip.mathod = 'Mobility Banking') GROUP BY date(vouchers.paid_time)");
      } else{
        $query = $this->db->query("SELECT sum(slip.dis_total) as total, date(vouchers.paid_time) as paidDate,student_info.section FROM slip INNER JOIN vouchers ON slip.student_id = vouchers.student_ref_id INNER JOIN student_info ON slip.student_id = student_info.student_id WHERE slip.year = 2021 AND vouchers.year = 2021 AND slip.month = 'February' AND vouchers.month_name = 'February' AND slip.payment_status = 'Paid' AND vouchers.voucher_status = 'Paid' AND (slip.mathod = 'Bank' OR slip.mathod = 'CreditCard' OR slip.mathod = 'Mobility Banking') AND slip.class_id = '$classId' AND student_info.section LIKE '%$classSection' GROUP BY date(vouchers.paid_time)");
      }
        $stdInfo = $query->result_array(); 
                
    }   
    if(empty($stdInfo)){
        echo '<hr><div class="col-md-12 col-sm-12">
                <div class="alert alert-danger">
                  <strong>Alert!</strong> Record Not Availabe.
                </div>
            </div>';
    }
    else{                               
    echo'<div class="col-md-12 col-sm-12 p-3 display" > 
        <div class="col-md-3 text-center" >
            <img src="assets/admin/layout/img/smlogo.png" alt="logo" width="150px"> 
        </div>
        <div class="col-md-9 text-center">  
            <h4 >Daily Recovery Report </h4>
        </div> 
        <div class="portlet ">
              
            <div class="portlet-body">
                <table id="sample_1" class="table" >
                    <thead>
                        <tr> 
                            <th> Session: '. $year .' </th>
                            <th> Month Name: '. $monthName .' </th>
                            <th> Payment Method: '. $mathodName .' </th>
                            <th> Class Name: '. $classId .' </th>
                            <th> Class Section: '. $classSection.' </th>  
                            <th> Date: '. $date.' </th>  
                        </tr>
                    </thead> 
                </table>
            </div> 
        </div>
    </div>    
    <div class="col-md-12 col-sm-12 p-5">
        <div class="portlet purple box">
            <div class="portlet-title no-print">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Daily Recovery Report
                </div>
                <div class="tools">
                    <a class="collapse" href="javascript:;">
                    </a>
                    <a class="reload" href="javascript:;">
                    </a>
                </div>
            </div>
            <div class="portlet-body"> 
                <table id="sample_12" onbeforeprint="printtable()" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr> 
                            <th> Sr.# </th>  
                            <th> Current Date </th>
                            <th> Current Month </th> 
                            <th> OverDue </th>  
                            <th> Grand Total </th>
                            <th> Month To Date </th>  
                        </tr>
                    </thead> 
                    <tbody>'; 
                    $count = 1;  
                    @$sum = 0;
                    foreach ($stdInfo as $value) { 
                    if($mathodName == 'Cash')
                        { $overDue = $this->common->getCashOverDue($value['paidDate']);}
                    else{ $overDue = $this->common->getOnlineOverDue($value['paidDate']);} 
                    echo' <tr>
                            <td>'; echo $count++ .'</td> 
                            <td>'; echo $value['paidDate'] .'</td>
                            <td>'; echo $value['total']  .'</td>
                            <td>'; echo $overDue .' </td>
                            <td>'; echo $grandTotal = $value['total'] + $overDue . '</td>
                            <td>'; echo @$sum = (@$sum + $grandTotal) .'</td>  
                        </tr>';
                    }  
                echo'</tbody>  
                </table>
            </div>
        </div>
    </div>'; 
    }
}
 
// 
    public function ajaxRecoveryReportTillData(){
        $year = $this->input->post('year');
        $monthName = $this->input->post('mName');
        $mathodName = $this->input->post('mathName');         
        $classId = $this->input->post('clName');  
        $classSection = $this->input->post('clSection');

        $nmonth = date('m',strtotime($monthName));

        $date = date('Y-m-d');

        if(empty($classId)){
            $query = $this->db->query("SELECT count(vouchers.student_ref_id) as count FROM `vouchers` INNER JOIN student_info on vouchers.student_ref_id = student_info.student_id WHERE voucher_status='Paid' AND MONTH(`paid_time`) = $nmonth AND YEAR(`paid_time`) = $year");
        } else{
            $query = $this->db->query("SELECT count(vouchers.student_ref_id) as count FROM `vouchers` INNER JOIN student_info on vouchers.student_ref_id = student_info.student_id WHERE voucher_status='Paid' AND MONTH(`paid_time`) = $nmonth AND YEAR(`paid_time`) = $year AND student_info.class_id = $classId AND student_info.section LIKE '%$classSection'");
        }  
            foreach ($query->result() as $row) {
                $data['paidVoucher'] = $row->count;
            }
        if($mathod = 'Cash'){
            $query = $this->db->query("SELECT sum(dis_total) as totalPaid FROM slip WHERE year = $year AND month = '$monthName' AND payment_status = 'Paid' AND mathod = '$mathodName'");

            $query1 = $this->db->query("SELECT sum(slip.dis_total) as overDue FROM slip INNER JOIN vouchers ON slip.student_id = vouchers.student_ref_id WHERE slip.month != '$monthName' AND vouchers.month_name != '$monthName' AND slip.payment_status = 'Paid' AND vouchers.voucher_status = 'Paid' AND slip.mathod = 'Cash' AND MONTH(vouchers.paid_time) = $nmonth ");
                foreach ($query1->result() as $row) {
                    $data['overDue'] = $row->overDue;
                }

        } else{
            $query = $this->db->query("SELECT sum(paid) as totalPaid FROM slip WHERE year = $year AND month = '$monthName' AND payment_status = 'Paid' AND (mathod = 'Bank' OR mathod = 'CreditCard' OR mathod = 'Mobility Banking')");

            $query1 = $this->db->query("SELECT sum(slip.dis_total) as overDue FROM slip INNER JOIN vouchers ON slip.student_id = vouchers.student_ref_id WHERE slip.month != '$monthName' AND vouchers.month_name != '$monthName' AND slip.payment_status = 'Paid' AND vouchers.voucher_status = 'Paid' AND (slip.mathod = 'Cash') ");

                foreach ($query1->result() as $row) {
                    $data['overDue'] = $row->overDue;
                }
        }
            
        foreach ($query->result() as $row) {
                $data['totalPaid'] = $row->totalPaid;
            }

        if(empty($classId)){
            $query = $this->db->query("SELECT sum(dis_total) as dis_total FROM slip WHERE year = $year AND month = '$monthName'");
        } else{
            $query = $this->db->query("SELECT sum(dis_total) as dis_total FROM slip INNER JOIN student_info ON slip.student_id = student_info.student_id WHERE slip.year = $year AND slip.month = '$monthName' AND student_info.class_id=$classId AND slip.class_id=$classId AND student_info.section LIKE '%$classSection'  ");
        }
        foreach ($query->result() as $row) {
            $data['totalFee'] = $row->dis_total;
        }

        echo json_encode($data);                                           
    }
//////////////// ajax functions part //////
public function ind_value()
{
$column = $this->input->post('col');
$value = $this->input->post('val');

echo json_encode($this->common->single_col($column,$value));
}
public function double_value()
{
/*$column = $this->input->post('col1');
$value = $this->input->post('val1');
$column2 = $this->input->post('col2');
$value2 = $this->input->post('val2');
*/echo "sjdfisdhkfhdkjhkdjsf";

//echo json_encode($this->common->double_col($column,$value, $column2,$value2));
}
//    public function index() {
//        $user = $this->ion_auth->user()->row();
//        $id = $user->id;
//        $data['massage'] = $this->common->getWhere('massage', 'receiver_id', $id);
//        $data['totalStudent'] = $this->common->totalStudent();
//        $data['totalTeacher'] = $this->common->totalTeacher();
//        $data['totalParents'] = $this->common->totalParents();
//        $data['totalAttendStudent'] = $this->common->totalAttendStudent();
//        $data['teacherAttendance'] = $this->common->teacherAttendance();
//        $data['presentEmploy'] = $this->homeModel->presentEmploy();
//        $data['absentEmploy'] = $this->homeModel->absentEmploy();
//        $data['leaveEmploy'] = $this->homeModel->leaveEmploy();
//        $data['event'] = $this->homeModel->all_event($id);
//        if ($this->ion_auth->is_admin()) {
//            $data['notice'] = $this->common->getAllData('notice_board');
//            $data['classAttendance'] = $this->homeModel->atten_chart();
//            $data['classInfo'] = $this->common->classInfo();
//        } elseif ($this->ion_auth->is_teacher()) {
//            //If this user have teacher's previlize, he can view only that notice whice notice is created for only teacher.
//            $data['notice'] = $this->common->getTeacherNotice();
//            $data['classInfo'] = $this->common->classInfo();
//        } elseif ($this->ion_auth->is_student()) {
//            //Whice notice is created for student these notice can see both students and parents.
//            $data['notice'] = $this->common->getStudentNotice();
//            $query = $this->common->getWhere('student_info', 'user_id', $id);
//            foreach ($query as $row) {
//                $class_id = $row['class_id'];
//            }
//            $data['class_id'] = $class_id;
//            $data['day'] = $this->common->getAllData('config_week_day');
//            $data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
//            $data['teacher'] = $this->common->getAllData('teachers_info');
//        } elseif ($this->ion_auth->is_parents()) {
//            //Whice notice is created for student these notice can see both students and parents.
//            $data['notice'] = $this->common->getStudentNotice();
//        }
//        $this->load->view('temp/header', $data);
//        $this->load->view('dashboard', $data);
//        $this->load->view('temp/footer');
//    }
    //
    public function profileView() {
        $user = $this->ion_auth->user()->row();
        $data['userprofile'] = $this->common->getWhere('users', 'id', $user->id);
        if ($this->input->post('submit', TRUE)) {
            $data_up = array(
            'first_name' => $this->db->escape_like_str($this->input->post('firstName', TRUE)),
            'last_name' => $this->db->escape_like_str($this->input->post('lastName', TRUE)),
            'username' => $this->db->escape_like_str($this->input->post('userName', TRUE)),
            'phone' => $this->db->escape_like_str($this->input->post('mobileNumber', TRUE)),
            'email' => $this->db->escape_like_str($this->input->post('email', TRUE)),
            //'password' => $this->db->escape_like_str($this->input->post('new_confirm', TRUE)),
        );
            $this->db->where('id', $user->id);
            if ($this->db->update('users', $data_up)) {
                redirect('home/profileView', 'refresh');
            }
        } else {
            $this->load->view('temp/header');
            $this->load->view('profileView', $data);
            $this->load->view('temp/footer');
        }
    }
public function profileImage() {
$user = $this->ion_auth->user()->row();
if ($this->ion_auth->is_admin()) {
if (empty($user->profile_image)) {
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
$data_update = array(
'profile_image' => $this->db->escape_like_str($uploadFileInfo['file_name'])
);
$this->db->where('id', $user->id);
if ($this->db->update('users', $data_update)) {
redirect('home/profileView', 'refresh');
}
} else {
$path = 'assets/uploads/' . $user->profile_image;
//$userprofile = $this->common->getWhere('users', 'id',$user->id);
if (unlink($path)) {
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
$data_update = array(
'profile_image' => $this->db->escape_like_str($uploadFileInfo['file_name'])
);
$this->db->where('id', $user->id);
if ($this->db->update('users', $data_update)) {
redirect('home/profileView', 'refresh');
}
} else {
echo lang('desc_1');
}
}
} elseif ($this->ion_auth->is_teacher()) {
if (empty($user->profile_image)) {
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
$data_update = array(
'profile_image' => $this->db->escape_like_str($uploadFileInfo['file_name'])
);
$this->db->where('id', $user->id);
if ($this->db->update('users', $data_update)) {
redirect('home/profileView', 'refresh');
}
} else {
$path = 'assets/uploads/' . $user->profile_image;
//$userprofile = $this->common->getWhere('users', 'id',$user->id);
if (unlink($path)) {
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
$data_update = array(
'profile_image' => $this->db->escape_like_str($uploadFileInfo['file_name'])
);
$this->db->where('id', $user->id);
if ($this->db->update('users', $data_update)) {
$data_update_2 = array(
'teachers_photo' => $this->db->escape_like_str($uploadFileInfo['file_name'])
);
$this->db->where('user_id', $user->id);
if ($this->db->update('teachers_info', $data_update_2)) {
redirect('home/profileView', 'refresh');
}
}
} else {
echo lang('desc_1');
}
}
} elseif ($this->ion_auth->is_student()) {
if (empty($user->profile_image)) {
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
$data_update = array(
'profile_image' => $this->db->escape_like_str($uploadFileInfo['file_name'])
);
$this->db->where('id', $user->id);
if ($this->db->update('users', $data_update)) {
redirect('home/profileView', 'refresh');
}
} else {
$path = 'assets/uploads/' . $user->profile_image;
//$userprofile = $this->common->getWhere('users', 'id',$user->id);
if (unlink($path)) {
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
$data_update = array(
'profile_image' => $this->db->escape_like_str($uploadFileInfo['file_name'])
);
$this->db->where('id', $user->id);
if ($this->db->update('users', $data_update)) {
$data_update_3 = array(
'student_photo' => $this->db->escape_like_str($uploadFileInfo['file_name'])
);
$this->db->where('user_id', $user->id);
if ($this->db->update('student_info', $data_update_3)) {
redirect('home/profileView', 'refresh');
}
}
} else {
echo lang('desc_1');
}
}
} elseif ($this->ion_auth->is_parents()) {
if (empty($user->profile_image)) {
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
$data_update = array(
'profile_image' => $this->db->escape_like_str($uploadFileInfo['file_name'])
);
$this->db->where('id', $user->id);
if ($this->db->update('users', $data_update)) {
redirect('home/profileView', 'refresh');
}
} else {
$path = 'assets/uploads/' . $user->profile_image;
//$userprofile = $this->common->getWhere('users', 'id',$user->id);
if (unlink($path)) {
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
$data_update = array(
'profile_image' => $this->db->escape_like_str($uploadFileInfo['file_name'])
);
$this->db->where('id', $user->id);
if ($this->db->update('users', $data_update)) {
redirect('home/profileView', 'refresh');
}
} else {
echo lang('desc_1');
}
}
}
}
//Thid function will show the calender with event
public function calender() {
$user = $this->ion_auth->user()->row();
$userId = $user->id;
if ($this->input->post('submit', TRUE)) {
$title = $this->input->post('title', TRUE);
$start_date = $this->input->post('start_date', TRUE);
$end_date = $this->input->post('end_date', TRUE);
$color = $this->input->post('color', TRUE);
$url = $this->input->post('url', TRUE);
$event_info = array(
'title' => $this->db->escape_like_str($title),
'start_date' => $this->db->escape_like_str($start_date),
'end_date' => $this->db->escape_like_str($end_date),
'color' => $this->db->escape_like_str($color),
'url' => $this->db->escape_like_str($url),
'user_id' => $userId
);
if ($this->db->insert('calender_events', $event_info)) {
redirect('home/calender', 'refresh');
}
} else {
$data['event'] = $this->homeModel->all_event($userId);
$this->load->view('temp/header');
$this->load->view('calender', $data);
$this->load->view('temp/footer');
}
}
public function addEvent() {
$user = $this->ion_auth->user()->row();
$userId = $user->id;
if ($this->input->post('submit', TRUE)) {
$title = $this->input->post('title', TRUE);
$start_date = $this->input->post('start_date', TRUE);
$end_date = $this->input->post('end_date', TRUE);
$color = $this->input->post('color', TRUE);
$url = $this->input->post('url', TRUE);
$user = $this->ion_auth->user()->row();
$userId = $user->id;
$event_info = array(
'title' => $this->db->escape_like_str($title),
'start_date' => $this->db->escape_like_str($start_date),
'end_date' => $this->db->escape_like_str($end_date),
'color' => $this->db->escape_like_str($color),
'url' => $this->db->escape_like_str($url),
'user_id' => $this->db->escape_like_str($userId)
);
if ($this->db->insert('calender_events', $event_info)) {
redirect('home/addEvent', 'refresh');
}
} else {
$data['event'] = $this->homeModel->all_event($userId);
$this->load->view('temp/header');
$this->load->view('events', $data);
$this->load->view('temp/footer');
}
}
//This function will edit events information
public function edit_event() {
if ($this->input->post('submit', TRUE)) {
$eve_id = $this->input->post('eve_id', TRUE);
$title = $this->input->post('title', TRUE);
$start_date = $this->input->post('start_date', TRUE);
$end_date = $this->input->post('end_date', TRUE);
$color = $this->input->post('color', TRUE);
$url = $this->input->post('url', TRUE);
$user = $this->ion_auth->user()->row();
$userId = $user->id;
$event_info = array(
'title' => $this->db->escape_like_str($title),
'start_date' => $this->db->escape_like_str($start_date),
'end_date' => $this->db->escape_like_str($end_date),
'color' => $this->db->escape_like_str($color),
'url' => $this->db->escape_like_str($url),
'user_id' => $this->db->escape_like_str($userId)
);
$this->db->where('id', $eve_id);
if ($this->db->update('calender_events', $event_info)) {
redirect('home/addEvent', 'refresh');
}
} else {
$event_id = $this->input->get('eve_id');
$data['event'] = $this->homeModel->single_event($event_id);
$this->load->view('temp/header');
$this->load->view('edit_event', $data);
$this->load->view('temp/footer');
}
}
public function iceTime() {
$time = $this->common->iceTime();
}
//This function will delete clender event
public function delete_event() {
$id = $this->input->get('eve_id');

if ($this->db->delete('calender_events', array('id' => $id))) {
$data['event'] = $this->homeModel->all_event($userId);
$data['message'] = '<div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    <strong>Success!</strong> The event was deleted successfully.
                            </div>';
$this->load->view('temp/header');
$this->load->view('events', $data);
$this->load->view('temp/footer');
}
}
}