<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    /**
     * Class constructor and validate authenticate user
     *
     * @return  void
     */
    public function __construct()
    {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
        if ( ! $this->session->user_id)
        {
            redirect('', 'refresh');
        }
        $this->privileges = $this->MUser_privileges->get_by_ref_user($this->session->user_id);
    }

    /**
     * Dashboard landing
     *
     * @return  void
     */
    public function index()
    {
        $data['title'] = 'POS System';
        $data['menu'] = 'dashboard';
        $data['content'] = 'admin/dashboard';
        $data['privileges'] = $this->privileges;
        $this->load->view('admin/template', $data);
    }

    /** Test Function Start */
    public function xml_write()
    {
        $myFile = "thumbnail.xml";
        $fh = fopen($myFile, 'w') or die("can't open file");

        $data = $this->MUsers->get_all(); //get data from database
        //starting tag for xml
        $stringData = '<?xml version="1.0" encoding="utf-8" ?>' . "\n";
        fwrite($fh, $stringData);
        $stringData = '<thumbnails>' . "\n";
        fwrite($fh, $stringData);

        //loop through each data
        foreach ($data as $key => $value)
        {
            $stringData = '<thumbnail filename="' . $value['fname'] . '" email="' . $value['email'] . '" />' . "\n";
            fwrite($fh, $stringData);
        }

        //closing tag for xml
        $stringData = '</thumbnails>';
        fwrite($fh, $stringData);

        fclose($fh);
    }

    public function csv_import()
    {
        $this->load->library('csvreader');
        $filePath = './database/stock_18_01_12.csv';
        $csvData = $this->csvreader->parse_file($filePath);
        //print_r($csvData);

        foreach ($csvData as $key => $value)
        {
            $this->MPurchase_details->create_by_csv($value);
        }
    }

    /** Test Function End */

}
