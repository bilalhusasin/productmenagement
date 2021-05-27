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

 //This function return the last inserted user id.

    function usersId() {

        $query = $this->db->query('SELECT id FROM users ORDER BY id DESC LIMIT 1');

        foreach ($query->result_array() as $row){

            $data = $row['id'];

        }

        return $data;

    }
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

// get all data of 
    public function getAllData($a) {
        $data = array();
        $query = $this->db->get($a);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }return $data;
    }

// get all data of single id
public function getWhere($a, $b, $c) {

        $data = array();

        $query = $this->db->get_where($a, array($b => $c));

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }return $data;

    }




    //This function will return logo link
  
   

    
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
     //This function will show user group name

    public function group_name($gid){

        $data = array();

        $query = $this->db->query("SELECT name FROM groups WHERE id=$gid");

        foreach ($query->result_array() as $row){

            $group_name = $row['name'];

        }

        return $group_name;

    }
    
    public function group_title($grup_id){

        $data = array();

        $query = $this->db->query("SELECT name FROM groups WHERE id=$grup_id")->row();

            return $query->name;

    }
}