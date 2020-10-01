<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class AccountModel extends CI_Model {
    /**
     * This model is using into the students controller
     * Load : $this->load->model('account');
     */
    function __construct() {
        parent::__construct();
        $this->load->dbforge();
    }
    //"SELECT * FROM slip  where month = '$month' GROUP BY student_id  ORDER BY id DESC"
       /* SELECT `id`,`year`,`month`,`date`,`class_id`,`student_id`,`item_id`, max(amount),`dues`,`advance`,`total`,`issue_date`,`due_date`,`paid`,`balance`,`edit_by`,`status`,`mathod`,`voucher_number` FROM slip where month = 'January' Group BY student_id*/
       /*SELECT `id`,`year`,`month`,`date`,`class_id`,`student_id`,`item_id`,`annual_fee`,`tution_fee`,`discount`,`dis_tution_fee`,`ac_charges`, max(amount) as amount,`dues`,`advance`,`total`,`dis_total`,`discount`,`issue_date`,`due_date`,`paid`,`balance`,`edit_by`,`payment_status`,`mathod`,`voucher_number` FROM slip where month = '$month' Group BY student_id*/
    //This function will return all students paments information
    public function stud_payment() {
        $month = date('F');
        $year = date('Y');
        $data = array();
        $query = $this->db->query("SELECT * FROM slip where month = '$month' AND year='$year'");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    //This function will return full invoice information
    public function invoice($slipId) {
        $data = array();
        $query = $this->db->query("SELECT * FROM slip WHERE student_id=$slipId");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }
    //This function will return full vocher information
    public function vocher($std_id,$class_id,$voch_no,$month,$year) {
        $data = array(); 
        //$pre_month=date(strtotime($month), strtotime('previous month')); 
        $pre_month = date('F',strtotime($month)-2592000);
        $query = $this->db->query("SELECT * FROM slip WHERE student_id='$std_id' AND class_id='$class_id' AND voucher_number='$voch_no' AND month='$month' AND year='$year' ");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        } 
        
        $query1 = $this->db->query("SELECT * FROM slip WHERE student_id='$std_id' AND class_id='$class_id' AND month='$pre_month' AND year='$year'");
        foreach ($query1->result_array() as $row1) {
            $data[] = $row1;
        }
        
        return $data;
    }
    //This function will return full vocher information
    /*public function vocher_class($class_id) {
        $data = array();
        $query = $this->db->query("SELECT * FROM fee_item WHERE class_id=$class_id");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        } 
        
        return $data;
    }*/

    //This function will return full vocher information
    public function vocher_class($class_id,$std_id) {
        
        $data = array();
        $year1 = $this->accountmodel->get_year($class_id,$std_id);
        if($year = $year1){
        $query = $this->db->query("SELECT * FROM fee_item WHERE class_id=$class_id AND session='$year1'");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }  
        return $data;
    }
    else{
        $query = $this->db->query("SELECT * FROM fee_item WHERE class_id=$class_id");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        } 
        
        return $data;
    }
       
    }
    //This Function wILL Return Year From Class_Studets
    public function get_year($class_id,$std_id){
        $data = array();
        $query = $this->db->query("SELECT year FROM class_students WHERE student_id=$std_id AND class_id=$class_id")->row();
        return $query->year;

    } 
    //This function will return all income account title list
    public function inco_title() {
        $data = array();
        $query = $this->db->query("SELECT * FROM account_title WHERE category='Income'");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    //This function will return all income account title list
    public function expa_title() {
        $data = array();
        $query = $this->db->query("SELECT * FROM account_title WHERE category='Expense'");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
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

    //This function will reaturn only maximam slip_number
    function maxSlip() {
        $maxid = 0;
        $row = $this->db->query('SELECT MAX(slip_number) AS `maxid` FROM `slip_number`')->row();
        if ($row) {
            $maxid = $row->maxid;
        }return $maxid + 1;
    }

    //This function will chack that is ther any tranjection submited today or not.
    public function tran_check($acco_id) {
        $d = date('d-m-Y');
        $date = strtotime($d);
        $data = array();
        $query = $this->db->query("SELECT id,amount FROM transection WHERE date = $date AND acco_id=$acco_id");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        if (!empty($data)) {
            return $data;
        } else {
            return 'no_entry';
        }
    }

    /*//This function will return all employ who will get government salary
    public function salaryEmployList($month) {
        $data = array();
        $query = $this->db->query("SELECT employe_title,employ_user_id FROM set_salary WHERE month<'$month'");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }*/
    //This function will return all employ who will get government salary
    public function salaryEmployList($group_id) {
        $data = array();
        $query = $this->db->query("SELECT employe_title,employ_user_id FROM set_salary WHERE group_id='$group_id' "); //month<'$month'
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    //This function will return one employ salary info
    public function ajaxSalaryAmount($uId) {
        $query = $this->db->query("SELECT total FROM set_salary WHERE employ_user_id='$uId'");
        foreach ($query->result_array() as $row) {
            $salary = $row['total'];
        }
        return $salary;
    }

    //This function will return all employ list which are paid from government
    public function employee_salary() {
        $data = array();
        $query = $this->db->query("SELECT * FROM salary");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    //This function will return employ's previous advanced taken amount
    public function preAdvance($uid) {
        $data = array();
        $query = $this->db->query("SELECT advanced_taken FROM set_salary WHERE employ_user_id=$uid");
        foreach ($query->result_array() as $row) {
            $data = $row['advanced_taken'];
        }
        return $data;
    }

    //This function will show employe title
    public function semployTitle($uid) {
        $data = array();
        $query = $this->db->query("SELECT employe_title FROM set_salary WHERE employ_user_id=$uid");
        foreach ($query->result_array() as $row) {
            $data = $row['employe_title'];
        }
        return $data;
    }

    //This funtion will return all income's data from transection table
    public function income() {
        $data = array();
        $query = $this->db->query("SELECT * FROM transection WHERE category='Income' AND id !=1");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    //This function will return account title by id
    public function acc_tit_id($acco_id) {
        $data = array();
        $query = $this->db->query("SELECT account_title FROM account_title WHERE id =$acco_id");
        foreach ($query->result_array() as $row) {
            $data = $row['account_title'];
        }
        return $data;
    }

    //This funtion will return all income's data from transection table
    public function expanse() {
        $data = array();
        $query = $this->db->query("SELECT * FROM transection WHERE category='Expense' AND id !=2");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    //This function will return only one trangection information by trangection id
    public function single_tran($id) {
        $data = array();
        $query = $this->db->query("SELECT * FROM transection WHERE id='$id'");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    //This function will return only transection id list 
    public function id_list($id) {
        $data = array();
        $query = $this->db->query("SELECT id FROM transection WHERE id>'$id'");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    //This function will return all class's id and title
    public function all_class() {
        $m = date('F');
        $data = array();
        $query = $this->db->query("SELECT id FROM class");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }return $data;
    }
    /*public function all_class() {
        $m = date('F');
        $data = array();
        $query = $this->db->query("SELECT id FROM class WHERE month_fee != '$m'");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }return $data;
    }*/

    //This function will return total month fee end of the month
    //This function will return total month fee end of the month
    public function total_fee($class_id) {
        $data = array();
        $year = date('Y');
        $query = $this->db->query("SELECT id,annual_fund,tution_fee,ac_charges FROM fee_item WHERE session=$year AND class_id=$class_id");
        foreach ($query->result_array() as $row) {

            $data[] = $row;
        }return $data;
    }

    //This function will return all students id
    public function all_students($class_id) {
         $data = array();
        $year = date('Y');
        $curMonth = date('F'); 
        $query = $this->db->query("SELECT student_id FROM class_students WHERE class_id=$class_id AND (status='Active' OR status='Defaulter') AND year=$year AND admi_month!='$curMonth'");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }return $data;
    }

    //This function will return student's last month due amount
    public function dues($student_id) {
        $data = 0;
        $year = date('Y');
        $query = $this->db->query("SELECT dues FROM slip WHERE year=$year AND student_id=$student_id ORDER BY id DESC LIMIT 1");
        foreach ($query->result_array() as $row) {
            $data = $row['dues'];
        }
        if ($data > 0) {
            return $data;
        } else {
            $data = 0;
            return $data;
        }
    }
    //This function will return advanced paid amount for students fee
    /*public function advance($student_id) {
        $data = 0;
        $year = date('Y');
        $query = $this->db->query("SELECT balance FROM slip WHERE year=$year AND student_id=$student_id ORDER BY id DESC LIMIT 1"); 
        foreach ($query->result_array() as $row) {
            $balancedata = $row['balance'];
        }
         
        if ($data > 0) {
            return $data;
        } else {
            $data = 0;
            return $data;
        }
        return $data;
    }*/

    //This function will return advanced paid amount for students fee
    public function advance($student_id) {
        $data = 0;
        $year = date('Y');
        $query = $this->db->query("SELECT balance FROM slip WHERE year=$year AND student_id=$student_id ORDER BY id DESC LIMIT 1");
        $querydata=$query->result_array();
        if(empty($querydata)){
           $balancedata=0; 
        } else {  
            $balancedata=$querydata[0]['balance'];  
        }  
        $query1 = $this->db->query("SELECT total_advance_amount,advance_date FROM advance_fee WHERE advance_year=$year AND student_id=$student_id AND advance_flag = 0 ORDER BY advance_id DESC LIMIT 1"); 
        $querydata1=$query1->result_array();
        if(empty($querydata1)){
           $advancedata=0; 
        } else {  
            $advancedata=$querydata1[0]['total_advance_amount'];
            $advance_date=$querydata1[0]['advance_date']; 
            $advance = array(
                    'advance_flag' => $this->db->escape_like_str(1)
            );
            $this->db->where('advance_date', $advance_date);
            $this->db->where('student_id', $student_id);
            $this->db->update('advance_fee', $advance); 
        }  
        $data= $balancedata + $advancedata;
        
        /*if ($data > 0) {
            return $data;
        } else {
            $data = 0;
            return $data;
        }*/
        return $data;
    } 

    //This function will return item title by item id
    public function item_title($a) {
        $query = $this->db->query("SELECT title FROM fee_item WHERE id=$a");
        foreach ($query->result_array() as $row) {
            $data = $row['title'];
        }return $data;
    }
 //This function will return Due Date
    public function due_date($class_id) {
        $query = $this->db->query("SELECT due_date FROM fee_item WHERE class_id=$class_id");
        foreach ($query->result_array() as $row) {
            $data = $row['due_date'];
        }return $data;
    }
 //This function will return Issu Date
    public function issu_date($class_id) {
        $query = $this->db->query("SELECT issue_date FROM fee_item WHERE class_id=$class_id");
        foreach ($query->result_array() as $row) {
            $data = $row['issue_date'];
        }return $data;
    }

    //This function will show item fee amount by item id
    public function item_amount($a) {
        $query = $this->db->query("SELECT amount FROM fee_item WHERE id=$a");
        foreach ($query->result_array() as $row) {
            $data = $row['amount'];
        }return $data;
    }

    /*SELECT `id`,`year`,`month`,`date`,`class_id`,`student_id`,`item_id`, max(amount) as amount,`dues`,`advance`,`total`,`issue_date`,`due_date`,`paid`,`balance`,`edit_by`,`status`,`mathod`,`voucher_number` FROM slip where month = '$month' Group BY student_id*/

    //This function will return payment slip info
    public function s_slip_info($sid,$class_id,$voch_no,$month,$year) {
        /*$query = $this->db->query("SELECT max(amount) as amount,dis_total FROM slip WHERE student_id=$s_id");
        foreach ($query->result_array() as $row) {
            $data = $row['dis_total'];
        }return $data;*/ 
        $query = $this->db->query("SELECT * FROM slip WHERE student_id='$sid' AND class_id='$class_id' AND voucher_number='$voch_no' AND month='$month' AND year='$year'");
        foreach ($query->result_array() as $row) {
            $data = $row;
        }return $data;
    }

    //This function will return paid amount
    public function paid_amount($s_id) {
        $query = $this->db->query("SELECT paid FROM slip WHERE student_id=$s_id");
        foreach ($query->result_array() as $row) {
            $data = $row['paid'];
        }
        return $data;
    }

    //This function will return student's own slip
    public function own_slips($student_id) {
        $data = array();
        $year = date('Y');
        $query = $this->db->query("SELECT * FROM slip WHERE year=$year AND student_id=$student_id");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }return $data;
    }

}
