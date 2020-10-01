<?php

if (!defined('BASEPATH')) {

    exit('No direct script access allowed');

}



class HomeModel extends CI_Model {

    function __construct() {

        parent::__construct();

        $this->load->helper('url');

        $this->load->database();

    }



    //This function will daily present employe info.

    public function presentEmploy() {

        $data = array();

        $date = strtotime(date('d-m-Y'));

        $query = $this->db->query("SELECT id FROM teacher_attendance WHERE date='$date' AND present_or_absent='Present'");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }return count($data);

    }



    //This function will daily present employe info.

    public function absentEmploy() {

        $data = array();

        $date = strtotime(date('d-m-Y'));

        $query = $this->db->query("SELECT id FROM teacher_attendance WHERE date='$date' AND present_or_absent='Absent'");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }return count($data);

    }



    //This function will daily present employe info.

    public function leaveEmploy() {

        $data = array();

        $date = strtotime(date('d-m-Y'));

        $query = $this->db->query("SELECT id FROM users WHERE user_status='Employ' AND leave_status='Leave' AND leave_start<='$date' AND leave_end>='$date'");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }return count($data);

    }



    //This function will show daily attendance percentise

    public function atten_chart() {

        $data = array();

        $query = $this->db->query("SELECT class_title,attendance_percentices_daily FROM class");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }

        return $data;

    }




public function atten_chart_students() {

        $data = array();

        $query = $this->db->query("SELECT count(class_title) as id,
     class_title as count_year
from
     student_info
     where class_title IS NOT NULL
group by
     class_title");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }

        return $data;

    }


    public function atten_chart_students1() {

        $data = array();

        $query = $this->db->query("SELECT count(reg_date) as id,
     reg_date as count_year
from
     registration
group by
     reg_date");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }

        return $data;

    }
public function atten_chart_students_reg() {

        $data = array();

        $query = $this->db->query("SELECT class.class_title as title,  SUM(registration_fee) as sumz from registration INNER JOIN class ON registration.class_id = class.id group by class.class_title");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }

        return $data;

    }

 public function atten_chart_students2() {

        $data = array();

        $query = $this->db->query("SELECT count(month) as id,
     month as count_year
from
     slip
group by
     month");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }

        return $data;

    }

    public function atten_chart_students_admision() {

        $data = array();

        $query = $this->db->query("SELECT SUM(dis_total) as ss,
     month 
from
     slip
     where payment_status='Paid'
group by
     month");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }

        return $data;

    }

    public function atten_chart_students3() {

        $data = array();

 $query = $this->db->query("SELECT class.class_title, count(*) as qty FROM                     slip  INNER JOIN class ON slip.class_id = class.id
                              where slip.discount_persentage !=0 GROUP BY     class_title HAVING count(*)> 1");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }

        return $data;

    }
///// fee receipt data set 1 /////


     public function atten_chart_FeeReciept1() {

        $data = array();

 $query = $this->db->query("SELECT (month) , Sum(dis_total) as sum1 from slip group by month");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }

        return $data;

    }

///// data set to fee receipt /////
public function atten_chart_FeeReciept2() {

        $data = array();

 $query = $this->db->query("SELECT (month) , Sum(dis_total) as sum2 from slip where payment_status ='Paid' group by month");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }

        return $data;

    }

////// leftover students /////

public function atten_chart_leftover() {

        $data = array();

 $query = $this->db->query("SELECT count(id) as idz , year as count_year from left_over_student_info group by year");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }

        return $data;

    }


  public function atten_chart_student_feeStructure() {

        $data = array();

 $query = $this->db->query("SELECT sum(slip.dis_total) as sumz , slip.class_id                       ,class.class_title from slip 
                            INNER JOIN class ON slip.class_id= class.id
                           where slip.payment_status='Paid'
                            group by slip.class_id
                           
                             ");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }

        return $data;

    }

    //This function will return all events

    public function all_event($userId) {

        $data = array();

        $query = $this->db->query("SELECT * FROM calender_events WHERE user_id='$userId' ORDER BY start_date DESC");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }

        return $data;

    }



    //This function will return single events

    public function single_event($eve_id) {

        $data = array();

        $query = $this->db->query("SELECT * FROM calender_events WHERE id='$eve_id'");

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }

        return $data;

    }

}

