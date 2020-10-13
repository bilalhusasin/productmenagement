<?php



if (!defined('BASEPATH')) {

    exit('No direct script access allowed');

}



class Common extends CI_Model {

 

    function __construct() {

        parent::__construct();

        $this->load->helper('url');

        $this->load->database();

        $this->load->dbforge();

    }

    //This function will return logo link

    public function logoTitle(){

        $data = array();

        $query =  $this->db->query("SELECT logo,school_name FROM configuration");

        foreach($query->result_array() as $row){

            $data[] = $row;

        }

        return $data;

    }

    

    //This function return the last inserted user id.

    function usersId() {

        $query = $this->db->query('SELECT id FROM users ORDER BY id DESC LIMIT 1');

        foreach ($query->result_array() as $row){

            $data = $row['id'];

        }

        return $data;

    }

    

    //This function select user access ability.

    public function user_access($role, $userId) {

        $data = array();

        $query = $this->db->query('SELECT ' . $role . ' FROM role_based_access WHERE user_id=' . $userId . ';')->row();

        foreach ($query as $row) {

            $data = $row;

        }

        if ($data == 1) {

            return TRUE;

        } else {

            return FALSE;

        }

    }

    

    //This function show the class title for class selecting class

    public function selectClass(){

        $data = array();

        $query = $this->db->query('SELECT id,class_title FROM class');

        foreach ($query->result_array() as $row){

            $data[] = $row;

        }

        return $data;

    } 

    

    //Total students will returan this function

    public function totalStudent() {

        $data = array();

        $query = $this->db->get('student_info');

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }return count($data);

    }



     //Total students from registration table will returan this function

    public function totalStudent_reg() {

        $data = array();

        $query = $this->db->get('registration');

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }return count($data);

    }

    

 public function totalAdmission() {

        $data = array();

        $query = $this->db->get('register_pass');

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }return count($data);

    }

    public function total_chalan() {

        $yearz = date("Y");

       $query1 = $this->db->query("SELECT sum(amount) as dd FROM                           slip 

                                   INNER JOIN student_info ON slip.student_id = student_info.student_id

                                   where student_info.status='Active'

                                   AND slip.year = '".$yearz."'

                                         ");

        foreach ($query1->result() as $row) {

            $data1 = $row->dd;

           

        }return ($data1);

    }



    //This function will cheack data table empty or not

    public function emptyCheack($a){

        $query = $this->db->query("SELECT * FROM $a")->row();

        if(empty($query)){

            return TRUE;

        }  else {

            return FALSE;

        }

    }



    //Total teachers will returan this function

    public function totalTeacher() {

        $data = array();

       // $query = $this->db->get('teachers_info');
        $query = $this->db->query("SELECT * FROM `userinfo` WHERE `group_id`=4");
        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }return count($data);

    }





public function totalStds() {

        $data1 = array();

        $query1 = $this->db->query("SELECT (id) FROM student_info WHERE status='Active'");

        foreach ($query1->result_array() as $row) {

            $data1[] = $row;

        }return count($data1);

    }

 public function totalActive() {

        $data1 = array();

        $query1 = $this->db->query("SELECT (id) FROM student_info WHERE status='Active'");

        foreach ($query1->result_array() as $row) {

            $data1[] = $row;

        }return count($data1);

    }

public function total_DeActive() {

        $data1 = array();

        $query1 = $this->db->query("SELECT (id) FROM left_over_student_info ");

        foreach ($query1->result_array() as $row) {

            $data1[] = $row;

        }return count($data1);

    }

public function total_expected() {

        $data1 = 0;

        $query1 = $this->db->query("SELECT sum(registration_fee) as paids FROM registration WHERE status='Paid'");

        foreach ($query1->result() as $row) {

            $data1 = $row->paids;

        }return ($data1);

    }



public function totalPaid() {

        $data1 = array();

        $query1 = $this->db->query("SELECT (id) FROM registration WHERE status='Paid'");

        foreach ($query1->result_array() as $row) {

            $data1[] = $row;

        }return count($data1);

    }

    public function Reg_amount() {

        $data1 = 0;

        $query1 = $this->db->query("SELECT sum(paid) as paids FROM registration WHERE status='Paid'");

        foreach ($query1->result() as $row) {

            $data1 = $row->paids;

        }return ($data1);

    }

    public function total_UnPaid() {

        $data1 = array();

        $query1 = $this->db->query("SELECT (id) FROM registration WHERE status='Unpaid'");

        foreach ($query1->result_array() as $row) {

            $data1[] = $row;

        }return count($data1);

    }

//////// Discount & not ////



public function given_discount() {

       // $data1 = array();

    $yearz = date("Y");

        $query1 = $this->db->query("SELECT sum(discount) as dd FROM                           slip 

                                    where year = '".$yearz."'

                                  ");

        foreach ($query1->result() as $row) {

            $data1 = $row->dd;

           

        }return ($data1);

    }



      public function with_discount() {

        $data1 = array();

        $query1 = $this->db->query("SELECT id FROM  student_fee_discount 

                                    ");

        

        foreach ($query1->result_array() as $row) {

            $data1[] = $row;

        }return count($data1);

    }







public function tota_paid_amount() {

    $yearz = date("Y");

         $query1 = $this->db->query("SELECT sum(dis_total) as dd FROM                           slip

                                       

                                        INNER JOIN student_info ON slip.student_id = student_info.student_id

                                   where student_info.status='Active'

                                    AND slip.payment_status='Paid'

                                     AND slip.year = '".$yearz."'

                                         



                                        ");

        foreach ($query1->result() as $row) {

            $data1 = $row->dd;

           

        }return ($data1);

    }

public function tota_unpaid_amount() {

    $yearz = date("Y");

         $query1 = $this->db->query("SELECT sum(dis_total) as dd FROM                           slip

                                      INNER JOIN student_info ON slip.student_id = student_info.student_id

                                   where student_info.status='Active'

                                    AND slip.payment_status='Unpaid' 

                                    AND slip.year = '".$yearz."'");

        foreach ($query1->result() as $row) {

            $data1 = $row->dd;

           

        }return ($data1);

    }

    /// deactie student's receiveables ////

    public function total_unpaid_amount() {

         $query1 = $this->db->query("SELECT sum(dis_total) as dd FROM                           slip  INNER JOIN student_info ON                         slip.student_id = student_info.student_id

                                       WHERE slip.payment_status='Unpaid' AND student_info.status= 'schoolleft'");

        foreach ($query1->result() as $row) {

            $data1 = $row->dd;

           

        }return ($data1);

    }                                   





public function count_paid_per() {

     $data1 = array();

         $query1 = $this->db->query("Select payment_status, (Count(payment_status)* 100 / (Select Count(*) From slip)) as Score From slip WHERE payment_status='paid'");

        foreach ($query1->result_array() as $row) {

            $data1 = $row;

           

        }

        return ($data1['Score']);

    }





public function count_unpaid_per() {

     $data1 = array();

         $query1 = $this->db->query("Select payment_status, (Count(payment_status)* 100 / (Select Count(*) From slip)) as Score From slip WHERE payment_status='unpaid'");

        foreach ($query1->result_array() as $row) {

            $data1 = $row;

           

        }

        return ($data1['Score']);

    }







public function count_paid() {

     $data1 = array();

         $query1 = $this->db->query("SELECT *  FROM slip

                                       WHERE payment_status = 'Paid' ");

        foreach ($query1->result_array() as $row) {

            $data1 = $row;

           

        }return count($query1->result_array());

    }







    public function count_unpaid() {

     $data1 = array();

         $query1 = $this->db->query("SELECT *  FROM slip

                                       WHERE payment_status = 'Unpaid' ");

        foreach ($query1->result_array() as $row) {

            $data1 = $row;

           

        }return count($query1->result_array());

    }





public function Total_with_discount() {

    $yearz = date("Y");

       $query1 = $this->db->query("SELECT sum(dis_total) as dd FROM                           slip 

                                   INNER JOIN student_info ON slip.student_id = student_info.student_id

                                   where student_info.status='Active'

                                   AND slip.year = '".$yearz."'

                                           ");

        foreach ($query1->result() as $row) {

            $data1 = $row->dd;

           

        }return ($data1);

    }





    public function without_discount() {

        $data1 = array();

    

        $query1 = $this->db->query("SELECT id FROM   slip 

                              

                              where discount =0");

        foreach ($query1->result_array() as $row) {

            $data1[] = $row;

        }return count($data1);

    }



//// get total collected  fees from slip table ////

 public function get_sum() {

        $data1 = array();

        $query1 = $this->db->query("SELECT  admission_disc FROM register_pass");

      // $data1=$query1->result_array();

        foreach ($query1->result_array() as $row) {

            $data1[] = $row['admission_disc'];

        }return (array_sum($data1));

    } 









    //Total parents will returan this function

    public function totalParents() {

        $data = array();

        $query = $this->db->get('parents_info');

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }return count($data);

    }



    //Today total Attend student will returan this function

    public function totalAttendStudent() {

        $day = date("m/d/y");

        $date = strtotime($day);

        $data = array();

        $query = $this->db->get_where('daily_attendance', array('date' => $date, 'present_or_absent' => 'P'));

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }return count($data);

    }



    //This function will return time and date as a string

    public function iceTime() {

        $data = array();

        $query = $this->db->query('SELECT time_zone FROM configuration');

        foreach ($query->result_array() as $row) {

            $data = $row['time_zone'];

        }

        $datestring = "<i class=\"fa fa-clock-o\"></i> %h:%i %a  <i class=\"fa fa-calendar\"></i>  %d %M, %Y ";

        $now = now();

        $timezone = $data;

        $time = gmt_to_local($now, $timezone);

        echo mdate($datestring, $time);

    }



    //This function will return only class title by class id from class table.

    public function class_title($class_id){

        $data = array();

        $query = $this->db->query("SELECT class_title FROM class WHERE id=$class_id")->row();

            return $query->class_title;

    }

    //This function will return only class title by class id from class table.

    public function group_title($grup_id){

        $data = array();

        $query = $this->db->query("SELECT name FROM groups WHERE id=$grup_id")->row();

            return $query->name;

    }

    public function class_id($sid){

        $data = array();

        $query = $this->db->query("SELECT class_id FROM registered WHERE id=$sid")->row();

            return $query->class_id;

    }

    

    

    //This function will show student title by student id

    public function student_title($student_id){

//        $data = array();

        $query = $this->db->query("SELECT student_nam FROM student_info WHERE student_id=$student_id")->row();

            return $query->student_nam;

    }

    //This function will show student status by student id

    public function student_status($student_id){

//        $data = array();

        $query = $this->db->query("SELECT status FROM student_info WHERE student_id=$student_id")->row();

            return $query->status;

    }

    

    //This function will return student ID by user ID

    public function student_id($user_id){

        if($this->ion_auth->in_group(3)){

            $query = $this->db->query("SELECT student_id FROM student_info WHERE user_id=$user_id")->row();

            return $query->student_id;

        }elseif ($this->ion_auth->in_group(5)) {

            $query = $this->db->query("SELECT student_id FROM parents_info WHERE user_id=$user_id")->row();

            return $query->student_id;

        }

    }

    

    //class's short information will give this function 

    public function classInfo(){

        $data = array();

        $query = $this->db->query("SELECT class_title,student_amount,attendance_percentices_daily,attend_percentise_yearly FROM class");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }return $data;

    }



   public function studentInfo()

{

    $stu_data = array();

        $query = $this->db->query("SELECT * FROM student_info");

        foreach ($query->result_array() as $row) {

            $stu_data[] = $row;

        }return $stu_data;



}



 public function student_regInfo()

{

    $stu_data = array();

        $query = $this->db->query("SELECT * FROM registration

                                     INNER JOIN class ON registration.class_id = class.id

                                     ");

        foreach ($query->result_array() as $row) {

            $stu_data[] = $row;

        }return $stu_data;



}





public function student_Admission()

{

    $stu_data = array();

        $query = $this->db->query("SELECT register_pass.discount_reasons as disc,register_pass.discount_persentage as disc_per,register_pass.reg_number,register_pass.admission_fee,register_pass.annual_found , register_pass.total,

         (register_pass.admission_fee + register_pass.annual_found)as amount,student_info.student_id , student_info.class_title, student_info.section, student_info.student_nam,student_info.farther_name,student_info.registration_number,student_info.admission_date 

            FROM student_info 

              INNER JOIN register_pass ON student_info.registration_number = register_pass.reg_number

            ");





        foreach ($query->result_array() as $row) {

            $stu_data[] = $row;

        }return $stu_data;



}





public function fee_struct()

{

    $stu_data = array();

        $query = $this->db->query("

                        SELECT  slip.year,slip.student_id,student_info.class_title, student_info.section, student_info.student_nam,student_info.farther_name,slip.payment_status,slip.month, slip.dis_total  

              

          FROM slip

                                   INNER JOIN student_info ON slip.student_id = student_info.student_id

                                   LEFT JOIN student_fee_discount ON slip.student_id = student_fee_discount.student_id

                                    ");



        foreach ($query->result_array() as $row) {

            $stu_data[] = $row;

        }return $stu_data;



}







public function student_discounts_reasons()

{

    $stu_data = array();

        $query = $this->db->query("

                        SELECT fee_discount.discount_reason as disc,fee_discount.tution_discount as disc_per,fee_discount.admission_discount,

                        student_fee_discount.year as disc_year,  student_info.student_id,student_info.class_title, student_info.section, student_info.student_nam,student_info.farther_name 

              

          FROM student_fee_discount

                                   INNER JOIN student_info ON student_fee_discount.student_id = student_info.student_id

                                   LEFT JOIN fee_discount ON student_fee_discount.discount_id = fee_discount.id



                                    ");



        foreach ($query->result_array() as $row) {

            $stu_data[] = $row;

        }return $stu_data;



}





public function student_chalan_receipt()

{

    $month=date("F");

    $stu_data = array();

        $query = $this->db->query("SELECT * FROM ( (SELECT student_info.student_id, student_info.student_nam ,student_info.class_title, student_info.section, student_info.phone, vouchers.voucher_number,vouchers.month_name,vouchers.year,vouchers.total_amount, vouchers.paid_amount, vouchers.issue_date as advance_date FROM vouchers INNER JOIN student_info ON vouchers.student_ref_id = student_info.student_id) UNION ALL (SELECT advance_fee.student_id, student_info.student_nam , student_info.class_title, student_info.section, student_info.phone, NULL as voucher_number, advance_fee.advance_month as month_name, advance_fee.advance_year as year, 0 as total_amount, advance_fee.advance_amount as paid_amount, advance_fee.advance_date FROM advance_fee INNER JOIN student_info ON advance_fee.student_id = student_info.student_id ) ) results ORDER BY `results`.`month_name` ASC");



        foreach ($query->result_array() as $row) {

            $stu_data[] = $row;

        }return $stu_data;



}



public function student_chalanz()

{

    $month=date("F");

    $stu_data = array();

        $query = $this->db->query("SELECT student_info.student_id, student_info.student_nam ,class.class_title, student_info.section, slip.amount, slip.ac_charges,slip.paid, slip.discount,slip.tution_fee,slip.voucher_number,slip.year, slip.month,slip.payment_status,  slip.dis_total FROM slip 
            INNER JOIN student_info ON slip.student_id = student_info.student_id 
            INNER JOIN class ON slip.class_id = class.id

                                    ");



        foreach ($query->result_array() as $row) {

            $stu_data[] = $row;

        }return $stu_data;



}











public function student_chalan()

{

    $month=date("F");

    $stu_data = array();

        $query = $this->db->query("SELECT student_info.student_id, student_info.student_nam ,student_info.class_title, student_info.section, student_info.phone, SUM(slip.amount+ slip.dues)as amount,slip.voucher_number,slip.year, slip.payment_status,slip.dues , slip.tution_fee,slip.discount,COUNT(DISTINCT month) as month FROM slip INNER JOIN student_info ON slip.student_id = student_info.student_id where slip.payment_status='unpaid' AND student_info.status = 'Active' GROUP BY student_info.student_id ORDER by slip.due_date DESC



                                   

                                    ");



        foreach ($query->result_array() as $row) {

            $stu_data[] = $row;

        }return $stu_data;



}

public function student_chalan1()

{

    $stu_data = array();

        $query = $this->db->query("SELECT student_info.student_id, student_info.student_nam , student_info.farther_name ,student_info.class_title, student_info.section,student_info.year,SUM(slip.dis_total) as dis_total,left_over_student_info.date_of_leaving,left_over_student_info.left_over_reason FROM left_over_student_info INNER JOIN slip ON left_over_student_info.student_id = slip.student_id INNER JOIN student_info ON left_over_student_info.student_id = student_info.student_id where slip.payment_status='unpaid'

            GROUP BY student_info.student_id ORDER BY student_info.student_id ASC 

                                    ");



        foreach ($query->result_array() as $row) {

            $stu_data[] = $row;

        }return $stu_data;



}





    function studentInfoId() {

        $maxid = 0;

        $row = $this->db->query('SELECT MAX(id) AS `maxid` FROM `student_info`')->row();

        if ($row) {

            $maxid = $row->maxid;

        }return $maxid;

    }



    public function getAllData($a) {

        $data = array();

        $query = $this->db->get($a);

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }return $data;

    }



    public function getWhere($a, $b, $c) {

        $data = array();

        $query = $this->db->get_where($a, array($b => $c));

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }return $data;

    }



    public function getWhere22($a, $b, $c, $d, $e) {

        $data = array();

        $query = $this->db->get_where($a, array($b => $c, $d => $e));

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }return $data;

    }



    //THis function is take class title and make unic Roll nomber that class.

    //And return that roll number.

    public function rollNumber($a) {

        $query2 = $this->db->get_where('class_students', array('class_id' => $a));

        $qq = array();

        foreach ($query2->result_array() as $aa) {

            $qq[] = $aa;

        }

        $a = $qq;

        //return $a;

        $b = array();

        foreach ($a as $row) {

            $b[] = $row['roll_number'];

        }$c = $b;

        //return max($c);

        if (empty($a)) {

            $d = 1;

            return $d;

        } else {

            $c;

            $e = max($c);

            $e++;

            return $e;

        }

    }

    //THis function is take group id  and make unic Employ ID that User.

    //And return that employ Id.

    public function employId($a) {

        $query2 = $this->db->get_where('userinfo', array('group_id' => $a));

        $qq = array();

        foreach ($query2->result_array() as $aa) {

            $qq[] = $aa;

        }

        $a = $qq;

        //return $a;

        $b = array();

        foreach ($a as $row) {

            $b[] = $row['emp_roll'];

        }$c = $b;

        //return max($c);

        if (empty($a)) {

            $d = 1;

            return $d;

        } else {

            $c;

            $e = max($c);

            $e++;

            return $e;

        }

    }



    //This function will return total student amount in a class

    public function classStudentAmount($id) {

        $data = array();

        $query = $this->db->get_where('class', array('id' => $id));

        foreach ($query->result_array() as $row) {

            $data = $row;

        }

        $b = $data['student_amount'];

        $c = $b + 1;

        return $c;

    }



    //This function is using for the get all and Teacher's notice by SQL where query.

    public function getTeacherNotice() {

        $data = array();

        $query = $this->db->query("SELECT * FROM notice_board WHERE receiver='teacher' OR receiver='all'");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }return $data;

    }



    //This function is using for the get all and student's notice by SQL where query.

    public function getStudentNotice() {

        $data = array();

        $query = $this->db->query("SELECT * FROM notice_board WHERE receiver='student' OR receiver='all'");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }return $data;

    }



    //This function is using for the get all Employe's and Accountends's notice by SQL where query.

    public function getEANotice() {

        $data = array();

        $query = $this->db->query("SELECT * FROM notice_board WHERE receiver='all'");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }return $data;

    }



    //This function return school name

    public function schoolName() {

        $data = array();

        $query = $this->db->get('configuration');

        foreach ($query->result_array() as $row) {

            $data = $row['school_name'];

        }return $data;

    }



    //This function return currency class name

    public function currencyClass() {

        $data = array();

        $query = $this->db->get('configuration');

        foreach ($query->result_array() as $row) {

            $data = $row['currenct'];

        }return $data;

    }

    

    //This function will returan students information by id 

    public function stuInfoId($a){

        $query = $this->db->query("SELECT * FROM student_info WHERE student_id = $a")->row();

        return $query;

    }

    

    //This function will returan country code

    public function countryPhoneCode(){

        $query = $this->db->query("SELECT countryPhonCode FROM configuration")->row();

        return $query;

    }

    

    //This function will return teacher's list

    public function teacherAttendance(){

        $data = array();

        $year = date('Y');

        $date = strtotime(date("d-m-Y"));

        $query = $this->db->query("SELECT employ_title,present_or_absent,attend_time FROM teacher_attendance WHERE date=$date AND year = $year");

        foreach ($query->result_array() as $row){

            $data[] = $row;

        }

        return $data;

    }

    

    //This function will return class exam term

    public function examTerm($a){

        $preExamTerm = array();

        $query = $this->db->query("SELECT exam_term FROM set_fees WHERE class_id = '$a'");

        foreach ($query->result_array() as $row){

            $preExamTerm = $row['exam_term'];

        }

        if($preExamTerm == 0){

            $nextExamTerm = $preExamTerm + 1;

            return $nextExamTerm;

        }  elseif ($preExamTerm == 1) {

            $nextExamTerm = $preExamTerm + 1;

            return $nextExamTerm;

        }  elseif ($preExamTerm == 2) {

            $nextExamTerm = $preExamTerm + 1;

            return $nextExamTerm;

        }  else {

            $nextExamTerm = 1;

            return $nextExamTerm;         

        }

    }

    

    //This function will return fee amount from configaration by class

    public function feeAmount($col,$classTitle){

        $data = array();

        $query = $this->db->query("SELECT $col FROM set_fees WHERE class_title = '$classTitle'");

//      return $query->$col;

        foreach ($query->result_array() as $row){

            $data = (int) $row[$col];

        }

        $value = $data;

        return $value;

    }

    

    //This function will return only have any entry by this current date

    public function cashBookyes($table){

        $data = array();

        $date = strtotime(date('d-m-Y'));

        $query =  $this->db->query("SELECT id FROM $table WHERE date=$date ORDER BY id DESC LIMIT 1");

        foreach ($query->result_array() as $row){

            $data = $row['id'];

        }

        if(!empty($data)){

            return $data;

//            return TRUE;

        }  else {

            return FALSE;

        }

    }

    

    //This function will return cash book item previous value

    public function cashBookItem($si,$table){

        $data = array();

        $date = strtotime(date('d-m-Y'));

        $query =  $this->db->query("SELECT $si FROM $table WHERE date=$date ORDER BY id DESC LIMIT 1");

        foreach ($query->result_array() as $row){

            $data = $row["$si"];

        }

        return $data;

    }

    

    //This function will return only class list from "class" table.

    public function classList(){

        $data = array();

        $query = $this->db->query("SELECT class_title FROM class");

        foreach ($query->result_array() as $row){

            $data[] = $row['class_title'];

        }return $data;

    }

    

    //This function will return final exam by it's class name 

    public function finalExam($classTitle){

        $data =array();

//        $query  = $this->db->query("SELECT id FROM add_exam WHERE class_title='$classTitle' AND final='Final' AND publish='Publish'");

        $query  = $this->db->query("SELECT id FROM add_exam WHERE class_title='$classTitle' AND final='Final'");

        foreach ($query->result_array() as $row){

            $data[] = $row['id'];

        }

        return $data;

    }

    

    //This function will return class potional subjects

    public function class_os($class_title)

    {

        $data = array();

        $query = $this->db->query("SELECT id,subject_title FROM class_subject WHERE class_title='$class_title' AND optional = 1");

        foreach ($query->result_array() as $row)

        {

            $data[] = $row;

        }

        return $data;

    }

    //This function will show user group name

    public function group_name($gid){

        $data = array();

        $query = $this->db->query("SELECT name FROM groups WHERE id=$gid");

        foreach ($query->result_array() as $row){

            $group_name = $row['name'];

        }

        return $group_name;

    }

    // This fnction will show registration number according to class id

    public function vouch($id){

        $query = $this->db->query("SELECT reg_number FROM registration WHERE id=$id")->row();

        return $query->reg_number;

    }

   //

   public function reg($id){

    $query = $this->db->query("SELECT reg_number FROM registration WHERE id=$id")->row();

    return $query->reg_number;

   }

   // This will get Account id from Accout title

    public function accountit($account_id) {

        $data = array();

        $query = $this->db->query("SELECT id FROM account_title WHERE id=$account_id")->row();

       return $query->id;

    }

     //This function will chack that is ther any tranjection submited today or not.

    public function tran_check($account_id) {

        $d = date('d-m-Y');

        $date = strtotime($d);

        $data = array();

        $query = $this->db->query("SELECT id,amount FROM transection WHERE date = $date AND acco_id=$account_id");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }

        if (!empty($data)) {

            return $data;

        } else {

            return 'no_entry';

        }

    }

     //This function will return Total amount in a transuctio slip

    //This function was used in "paySalary()"

    public function pre_balence() {

        $data = array();

        $query = $this->db->query("SELECT * FROM transection ORDER BY id DESC LIMIT 1");

        foreach ($query->result_array() as $row) {

            $data[] = $row['balance'];

        }

        if (!empty($data)) {

            return $data[0];

        } else {

            return 0;

        }

    }

     public function reg_data($class_id){

        $data = array();

        $query = $this->db->query("SELECT reg_number FROM registration WHERE class_id = $class_id")->row();

        return $query->reg_number;

    }

    //This Function Will Return Data From registration

    public function name_data($class_id){

        $data = array();

        $query = $this->db->query("SELECT student_nam FROM registration WHERE class_id = $class_id")->row();

        return $query->student_nam;

    }

    public function reggs($sid){

        $data = array();

        $query = $this->db->query("SELECT reg_number FROM registered WHERE id=$sid")->row();

        return $query->reg_number;

    }

    public function stat($sid){

        $data = array();

        $query = $this->db->query("SELECT status FROM registered WHERE id=$sid")->row();

        return $query->status;

    }



    public function pass_student() {

        $year= date('Y');

        $query = $this->db->query("SELECT * FROM register_pass WHERE status ='pass' AND year=$year");

        foreach ($query->result_array() as $row){

            $data[] = $row;

        }

        return $data;

    }

    public function get_admission_fee() {

        //$data = array();

        $query = $this->db->query("SELECT admission_fee FROM fee_structure")->row();

        return $query->admission_fee;

    }

    public function get_annual_found() {

        //$data = array();

        $query = $this->db->query("SELECT annual_fund FROM fee_structure")->row();

        return $query->annual_fund;

    }



////////// ajax respose methods /////



//////  single column search   //////

    public function single_col($col,$val)

{

    $stu_data = array();

    if($col=="month")

        {$query = $this->db->query("SELECT student_info.student_id, student_info.student_nam                         ,student_info.class_title, student_info.section, slip.voucher_number                          ,slip.month, slip.tution_fee, slip.total, slip.discount,slip.dis_total FROM slip

                                   INNER JOIN student_info ON slip.student_id = student_info.student_id

                                   where slip.month LIKE '".$val."%'

                                    ");

       }



       else if ($col=="student") {

           $query = $this->db->query("SELECT student_info.student_id, student_info.student_nam                         ,student_info.class_title, student_info.section, slip.voucher_number                          ,slip.month, slip.tution_fee, slip.total, slip.discount,slip.dis_total FROM slip

                                   INNER JOIN student_info ON slip.student_id = student_info.student_id

                                   where slip.student_id= '".$val."'

                                    ");

       }



 else if ($col=="class") {

           $query = $this->db->query("SELECT student_info.student_id, student_info.student_nam                         ,student_info.class_title, student_info.section, slip.voucher_number                          ,slip.month, slip.tution_fee, slip.total, slip.discount,slip.dis_total FROM slip

                                   INNER JOIN student_info ON slip.student_id = student_info.student_id

                                   where student_info.class_title LIKE '".$val."%'

                                    ");

       }





       else if ($col=="chalan") {

           $query = $this->db->query("SELECT student_info.student_id, student_info.student_nam                         ,student_info.class_title, student_info.section,                      slip.voucher_number  ,slip.month, slip.tution_fee, slip.total,                    slip.discount,slip.dis_total FROM slip

                                   INNER JOIN student_info ON slip.student_id = student_info.student_id

                                   where slip.voucher_number LIKE '".$val."%'

                                    ");

       }



else if ($col=="section") {

           $query = $this->db->query("SELECT student_info.student_id, student_info.student_nam                         ,student_info.class_title, student_info.section,                      slip.voucher_number  ,slip.month, slip.tution_fee, slip.total,                    slip.discount,slip.dis_total FROM slip

                                   INNER JOIN student_info ON slip.student_id = student_info.student_id

                                   where student_info.section LIKE '".$val."%'

                                    ");

       }       



        foreach ($query->result_array() as $row) {

            $stu_data[] = $row;

        }return $stu_data;



}



///////   double column search  //////



public function double_value($col1,$val1,$col2,$val2)

{

    $stu_data = array();

    if($col1=="class" && $col2== "section")

        {$query = $this->db->query("SELECT student_info.student_id, student_info.student_nam                         ,student_info.class_title, student_info.section, slip.voucher_number                          ,slip.month, slip.tution_fee, slip.total, slip.discount,slip.dis_total FROM slip

                                   INNER JOIN student_info ON slip.student_id = student_info.student_id

                                   where student_info.class_title LIKE '".$val1."%'

                                          AND student_info.section LIKE '".$val2."%'

                                    ");

       }



       else if ($col=="student") {

           $query = $this->db->query("SELECT student_info.student_id, student_info.student_nam                         ,student_info.class_title, student_info.section, slip.voucher_number                          ,slip.month, slip.tution_fee, slip.total, slip.discount,slip.dis_total FROM slip

                                   INNER JOIN student_info ON slip.student_id = student_info.student_id

                                   where slip.student_id= '".$val."'

                                    ");

       }



 else if ($col=="class") {

           $query = $this->db->query("SELECT student_info.student_id, student_info.student_nam                         ,student_info.class_title, student_info.section, slip.voucher_number                          ,slip.month, slip.tution_fee, slip.total, slip.discount,slip.dis_total FROM slip

                                   INNER JOIN student_info ON slip.student_id = student_info.student_id

                                   where student_info.class_title LIKE '".$val."%'

                                    ");

       }





       else if ($col=="chalan") {

           $query = $this->db->query("SELECT student_info.student_id, student_info.student_nam                         ,student_info.class_title, student_info.section,                      slip.voucher_number  ,slip.month, slip.tution_fee, slip.total,                    slip.discount,slip.dis_total FROM slip

                                   INNER JOIN student_info ON slip.student_id = student_info.student_id

                                   where slip.voucher_number LIKE '".$val."%'

                                    ");

       }



else if ($col=="section") {

           $query = $this->db->query("SELECT student_info.student_id, student_info.student_nam                         ,student_info.class_title, student_info.section,                      slip.voucher_number  ,slip.month, slip.tution_fee, slip.total,                    slip.discount,slip.dis_total FROM slip

                                   INNER JOIN student_info ON slip.student_id = student_info.student_id

                                   where student_info.section LIKE '".$val."%'

                                    ");

       }       



        foreach ($query->result_array() as $row) {

            $stu_data[] = $row;

        }return $stu_data;



}
}