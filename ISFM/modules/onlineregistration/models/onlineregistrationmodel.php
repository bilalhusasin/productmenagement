<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class onlineregistrationmodel extends CI_Model {
    /**
     * This model is using into the Examination controller
     * Load : $this->load->model('exammodel');
     */
    function __construct() {
        parent::__construct();
        $this->load->dbforge();
    }

     
}
