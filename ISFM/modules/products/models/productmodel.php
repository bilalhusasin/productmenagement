<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Productmodel extends CI_Model {
    /**
     * This model is using into the product controller
     * Load : $this->load->model('productmodel');
     */
    function __construct() {
        parent::__construct();
        $this->load->dbforge();
    }

    // this function get all table data 
    public function getAllData($a) {
       
        $data = array();
       
        $query = $this->db->get($a);
       
        foreach ($query->result_array() as $row) {
       
            $data[] = $row;
       
        }return $data;
    }
// this function single product data
    public function getWhere($a, $b, $c) {

        $data = array();

        $query = $this->db->get_where($a, array($b => $c));

        foreach ($query->result_array() as $row) {

            $data[] = $row;

        }return $data;

    }
    //This function will return only category title by category id from add_product_category table.

    public function category_title($cate_id){

        $data = array();
        if($this->db->where('id', $cate_id)){
        $query = $this->db->query("SELECT category_name FROM add_product_category WHERE id=$cate_id")->row();
            return $query->category_name;
        }
    }
   
}
