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
    $data['stdInfo'] = $this->common->studentInfo();   
    $data['classTile'] = $this->common->getAllData('class');

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
    $this->load->view('studentInfoReport', $data);
    $this->load->view('temp/footer');
}

public function ajaxStudentInfoReport(){
    $classId = $this->input->get('c_Name');
    $classSection = $this->input->get('c_Section');
    $status = $this->input->get('status');

    $date = date('Y-m-d');
    
    // this query count total filter count
    $query = $this->db->query("SELECT * FROM student_info WHERE class_id = $classId AND section LIKE '%$classSection' AND status LIKE '%$status' ORDER BY `id`  ASC");
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
    
    // this query count totall student of given class
    $tstudent = $this->db->query("SELECT count(*) as total FROM student_info WHERE class_id = $classId AND section Like '%$classSection' ORDER BY `id` ASC");
        foreach ($tstudent->result() as $row) {
            $data['totalamount'] = $row->total;       
        } 
    // this query count total ACTIVE student of given class
    $ac_student = $this->db->query("SELECT count(*) as active FROM student_info WHERE class_id = $classId AND section LIKE '%$classSection' AND status = 'Active' ORDER BY `id` ASC");
        foreach ($ac_student->result() as $row) {
            $data['activeStudent'] = $row->active;       
        }
    // this query count total DEACTIVE student of given class
    $destudent = $this->db->query("SELECT count(*) as deactive FROM student_info WHERE class_id = $classId AND section LIKE '%$classSection' AND status = 'Deactive' ORDER BY `id` ASC");
        foreach ($destudent->result() as $row) {
            $data['deactiveStudent'] = $row->deactive;       
        }
    // this query count total School Left student of given class
    $schoolleft = $this->db->query("SELECT count(*) as schoolleft FROM student_info WHERE class_id = $classId AND section LIKE '%$classSection' AND status = 'Schoolleft' ORDER BY `id` ASC");
        foreach ($schoolleft->result() as $row) {
            $data['schoolLeft'] = $row->schoolleft;       
        } 
    // this query count total Defaulter student of given class
    $deflter = $this->db->query("SELECT count(*) as defaulter FROM student_info WHERE class_id = $classId AND section LIKE '%$classSection' AND status = 'Defaulter' ORDER BY `id` ASC");
        foreach ($deflter->result() as $row) {
            $data['Defaulter'] = $row->defaulter;       
        }  
        // total persentage of active student
        // $percent = ($activeStudent/$totalamount*100);
        // $persentage = number_format((float)$percent, 2, '.', '');
        // $data['persentage'] = '$persentage';
echo json_encode($data);

                    //echo $persentage;                            
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
        $data['presentEmploy'] = $this->homeModel->presentEmploy();
        $data['absentEmploy'] = $this->homeModel->absentEmploy();
        $data['leaveEmploy'] = $this->homeModel->leaveEmploy();
        $data['event'] = $this->homeModel->all_event($id);
        $data['notice'] = $this->common->getAllData('notice_board');
        /* $data['date_wise_students'] = $this->homeModel->atten_chart_students3();
        */
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
        $data['presentEmploy'] = $this->homeModel->presentEmploy();
        $data['absentEmploy'] = $this->homeModel->absentEmploy();
        $data['leaveEmploy'] = $this->homeModel->leaveEmploy();
        $data['event'] = $this->homeModel->all_event($id);
        $data['notice'] = $this->common->getAllData('notice_board');
        /* $data['date_wise_students'] = $this->homeModel->atten_chart_students3();
        */
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
     
        
        if(empty($classId)){
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
    echo'  <!-- Modal -->
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
$data['totalAttendStudent'] = $this->common->totalAttendStudent();
$data['count_paid'] = $this->common->total_unpaid_amount();
$data['count_unpaid'] = $this->common->count_unpaid();
$data['presentEmploy'] = $this->homeModel->presentEmploy();
$data['absentEmploy'] = $this->homeModel->absentEmploy();
$data['leaveEmploy'] = $this->homeModel->leaveEmploy();
$data['event'] = $this->homeModel->all_event($id);
$data['notice'] = $this->common->getAllData('notice_board');
$data['date_wise_students'] = $this->homeModel->atten_chart_leftover();
$data['stdInfo'] = $this->common->student_chalan1();
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
$this->load->view('Leftover', $data);
$this->load->view('temp/footer');
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