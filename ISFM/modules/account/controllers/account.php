<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Account extends MX_Controller {
    /**
     * This controller is using for controlling account and tranjection
     *
     * Maps to the following URL
     *      http://example.com/index.php/account
     *  - or -  
     *      http://example.com/index.php/account/<method_name>
     */
    function __construct() {
        parent::__construct();
        $this->load->model('accountmodel');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
    }

    //This function is adding now account title
    public function addAccountTitle() {
        if ($this->input->post('submit', TRUE)) {
            $accuntInfo = array(
                'account_title' => $this->db->escape_like_str($this->input->post('accountTitle', TRUE)),
                'category' => $this->db->escape_like_str($this->input->post('type', TRUE)),
                'description' => $this->db->escape_like_str($this->input->post('description', TRUE))
            );
            if ($this->db->insert('account_title', $accuntInfo)) {
                $data['allAccount'] = $this->common->getAllData('account_title');
                $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong>Success ! </strong> Account title added successfully. 
                            </div>';
                $this->load->view('temp/header');
                $this->load->view('addAccountTitle', $data);
                $this->load->view('temp/footer');
            }
        } else {
            $data['allAccount'] = $this->common->getAllData('account_title');
            $this->load->view('temp/header');
            $this->load->view('addAccountTitle', $data);
            $this->load->view('temp/footer');
        }
    }

    //This function is using for show all account title view
    public function allAccount() {
        $this->load->view('temp/header');
        $this->load->view('allAccount', $data);
        $this->load->view('temp/footer');
    }

    //This function will edit Account title information here.
    public function editAccountInfo() {
        $id = $this->input->get('id', TRUE);
        if ($this->input->post('submit', TRUE)) {
            $accuntInfo = array(
                'account_title' => $this->db->escape_like_str($this->input->post('accountTitle', TRUE)),
                'category' => $this->db->escape_like_str($this->input->post('type', TRUE)),
                'description' => $this->db->escape_like_str($this->input->post('description', TRUE))
            );
            $this->db->where('id', $id);
            if ($this->db->update('account_title', $accuntInfo)) {
                $data['allAccount'] = $this->common->getAllData('account_title');
                $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong>Success ! </strong>  Account title\'s information updated successfully. 
                            </div>';
                $this->load->view('temp/header');
                $this->load->view('addAccountTitle', $data);
                $this->load->view('temp/footer');
            }
        } else {
            $data['accountInfo'] = $this->common->getWhere('account_title', 'id', $id);
            $this->load->view('temp/header');
            $this->load->view('editAccount', $data);
            $this->load->view('temp/footer');
        }
    }
   // this function will delete slipe value
    public function slipdel() {
        $id = $this->input->get('sid');
        if ($this->db->delete('slip', array('student_id' => $id))) {
           // $data['classTile'] = $this->common->getAllData('class');
           // $data['fee_item'] = $this->common->getAllData('fee_item');
            $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong> Success! </strong> Item deleted from items list successfully.</strong>
                            </div>';
            $data['slips'] = $this->accountmodel->stud_payment();
            $this->load->view('temp/header');
            $this->load->view('allSlips', $data);
            $this->load->view('temp/footer');
        }
    }



    //This function will delete Account Title.
    public function deleteAccount() {
        $id = $this->input->get('id', TRUE);
        $this->db->delete('account_title', array('id' => $id));
        //After deleteing the account lode all Account info.
        $data['allAccount'] = $this->common->getAllData('account_title');
        $data['message'] = '<div class="alert alert-success alert-dismissable">
                                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                                        <strong>Success ! </strong>  Account title deleted successfully. 
                                                </div>';
        $this->load->view('temp/header');
        $this->load->view('addAccountTitle', $data);
        $this->load->view('temp/footer');
    }

    //This function will show students own due and pay
    public function due_pay() {
        $user = $this->ion_auth->user()->row();
        $user_id = $user->id;
        $student_id = $this->common->student_id($user_id);
        $data['slips'] = $this->accountmodel->own_slips($student_id);
        $this->load->view('temp/header');
        $this->load->view('due_pay', $data);
        $this->load->view('temp/footer');
    }
     //This function will add advance fee recept 
    public function advanceRecept() { 
        if ($this->input->post('submit', TRUE)) { 
            $sid=$this->input->post('student_id', TRUE); 
            $curmonth = date('F');
            $curyear = date('Y');
            $query = $this->db->query("SELECT * FROM advance_fee WHERE student_id = '$sid' AND advance_month= '$curmonth' AND advance_year= '$curyear' AND advance_flag = 0  ORDER BY advance_id DESC LIMIT 1");
            $advancedata=$query->result_array();
            $advance_receipt_num = 'AR'.time();
            if(!empty($advancedata)){
               $tot_adv_amount = $advancedata[0]['total_advance_amount'];
               $advance_date = $advancedata[0]['advance_date'];
                
               $adv_amount= $this->input->post('amount', TRUE); 
               $tot=$tot_adv_amount+$adv_amount; 

               $advance = array(  
                    'student_id' => $this->db->escape_like_str($this->input->post('student_id', TRUE)),
                    'advance_year' => $this->db->escape_like_str($curyear),
                    'advance_month' => $this->db->escape_like_str($curmonth),
                    'advance_receipt_num' => $this->db->escape_like_str($advance_receipt_num),
                    //'student_num' => $this->db->escape_like_str($this->input->post('studentName', TRUE)),
                    'registration_num' => $this->db->escape_like_str($this->input->post('regNumber', TRUE)),
                    //'class_name' => $this->db->escape_like_str($this->input->post('class', TRUE)),
                    'advance_amount' => $this->db->escape_like_str($this->input->post('amount', TRUE)),
                    'total_advance_amount' => $this->db->escape_like_str($tot),
                    'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE))
                );   
                $this->db->insert('advance_fee', $advance); 
                $advance = array(
                    'advance_flag' => $this->db->escape_like_str(1)
                );
                $this->db->where('advance_date', $advance_date);
                $this->db->where('student_id', $sid);
                $this->db->update('advance_fee', $advance);
            } else{  
                $advance = array(  
                    'student_id' => $this->db->escape_like_str($this->input->post('student_id', TRUE)),
                    'advance_year' => $this->db->escape_like_str($curyear),
                    'advance_month' => $this->db->escape_like_str($curmonth),
                    'advance_receipt_num' => $this->db->escape_like_str($advance_receipt_num),
                    //'student_num' => $this->db->escape_like_str($this->input->post('studentName', TRUE)),
                    'registration_num' => $this->db->escape_like_str($this->input->post('regNumber', TRUE)),
                    //'class_name' => $this->db->escape_like_str($this->input->post('class', TRUE)),
                    'advance_amount' => $this->db->escape_like_str($this->input->post('amount', TRUE)),
                    'total_advance_amount' => $this->db->escape_like_str($this->input->post('amount', TRUE)),
                    'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE))
                );   
                $this->db->insert('advance_fee', $advance);
            } 
            $data['advance_fee'] = $this->common->getAllData('advance_fee');
                    $data['message'] = '<div class="alert alert-success alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                    <strong>Success ! </strong>  Advance Fee information Add Successfully. 
                                </div>';
                    $this->load->view('temp/header');
                    $this->load->view('advanceRecept', $data);
                    $this->load->view('temp/footer');
            
        } else { 
            $data['advance_fee'] = $this->common->getAllData('advance_fee');
            $this->load->view('temp/header');
            $this->load->view('advanceRecept', $data);
            $this->load->view('temp/footer');
        }
    }
    //This function will add advance fee recept 
    public function ajaxAdvanceRecept() { 
        $studentId = $this->input->get('q', TRUE);
        $query = $this->common->stuInfoId($studentId);
        if (empty($query)) {
            echo '<div class="form-group">
                    <label class="col-md-2 control-label"></label>
                        <div class="col-md-8">
                        <div class="alert alert-danger">
                            <strong>' . lang('tea_info') . ':</strong> ' . lang('teac_1') . ' <strong>' . $studentId .  '</strong>' . lang('teac_2') . '
                    </div></div></div>';
        } else {
            echo '<div class="row"><div class="col-md-offset-1 col-md-10 stuInfoIdBox">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-4 control-label">' . lang('teac_3') . ' <span class="requiredStar">  *</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="studentName" value="' . $query->student_nam . '" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">' . "Registration Number" . ' <span class="requiredStar">  *</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="regNumber" value="' . $query->registration_number . '" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">' . lang('teac_4') . ' <span class="requiredStar">  *</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="class" value="' . $this->common->class_title($query->class_id) . '" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">' . "Section" . ' <span class="requiredStar">  *</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="section" value="' . $query->section . '" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <img src="assets/uploads/' . $query->student_photo . '" class="img-responsive" alt=""><br>
                    </div>
                </div></div>';
        }
    }
 
    //This function will edit student Advance payment information
    public function editAdvanceReceipt() {
        if ($this->input->post('submit', TRUE)) {
            $sid = $this->input->get('sid'); 
            $advance_date = $this->input->post('advance_date', TRUE);
            $student_id = $this->input->post('student_id', TRUE);
            $reg_number = $this->input->post('reg_number', TRUE);
            $advance_amount = $this->input->post('advance_amount', TRUE);
            $tot_rem_amount = $this->input->post('tot_rem_amount', TRUE);
            $created_by = $this->input->post('created_by', TRUE);
             
            $total_advance_amount =  $tot_rem_amount + $advance_amount;
            $advance_data = array( 
                'advance_amount' => $this->db->escape_like_str($advance_amount),
                'total_advance_amount' => $this->db->escape_like_str($total_advance_amount),
                'created_by' => $this->db->escape_like_str($created_by),
            );
            $this->db->where('student_id', $sid);
            $this->db->where('advance_date', $advance_date);
            if ($this->db->update('advance_fee', $advance_data)) {
                $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong>WOW!</strong> Your Advance data Successfully Update.
                            </div>';
                $data['advance_fee'] = $this->common->getWhere('advance_fee', 'student_id', $sid); 
                $this->load->view('temp/header');
                $this->load->view('advanceRecept', $data);
                $this->load->view('temp/footer');
            }
        } else {
            $sid = $this->input->get('sid'); 
            $adv_date = $this->input->get('adv_date'); 
            $query = $this->db->query("SELECT * FROM advance_fee WHERE student_id = '$sid' AND advance_date = '$adv_date'");
            $data['advance_fee']=$query->result_array(); 
            $data['sid'] = $sid;
            $this->load->view('temp/header');
            $this->load->view('edit_advance_fee', $data);
            $this->load->view('temp/footer');
        }
    } 
    //This function will edit student Advance payment information
    public function viewAdvanceReceipt() {  
            $sid = $this->input->get('sid');
            $adv_date = $this->input->get('adv_date');  
            $query = $this->db->query("SELECT * FROM advance_fee WHERE student_id = '$sid' AND advance_date = '$adv_date'");
            $data['advance_fee']=$query->result_array();
            $data['student_info'] = $this->common->getWhere('student_info', 'student_id', $sid); 
            $data['schoolName'] = $this->common->schoolName();
            $data['currency'] = $this->common->currencyClass(); 
            $this->load->view('temp/header');
            $this->load->view('advanceFeeReceipt', $data);
            $this->load->view('temp/footer'); 
    }
    //This function will delete Account Title.
    public function delAdvanceReceipt() {
        $sid = $this->input->get('sid');
        $adv_date = $this->input->get('adv_date');
        $this->db->delete('advance_fee', array('student_id' => $sid,'advance_date' => $adv_date ));
        //After deleteing this entry lode all Account info.
        $data['advance_fee'] = $this->common->getAllData('advance_fee');
        $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong>Success ! </strong>  Advance  Payment Entry Deleted Successfully. 
                            </div>';
        
        $this->load->view('temp/header');
        $this->load->view('advanceRecept', $data);
        $this->load->view('temp/footer');
    }  
    //This function will delete Account Title.
    public function studentDetailLedger() {
         
        $this->load->view('temp/header');
        $this->load->view('studentDetailLedger');
        $this->load->view('temp/footer');
    }
//This function will add advance fee recept 
     public function ajaxstudentDetailLedger() { 
        $studentId = $this->input->get('q', TRUE); 
        $query = $this->db->query("SELECT Student_nam,student_id FROM student_info WHERE student_id='$studentId'");
        $infodata=$query->result_array();
        if(!empty($infodata)){
            foreach ($infodata as $row1 ) {
                $Student_nam=$row1["Student_nam"];
                $student_id=$row1["student_id"];  
            }
            $slipquery=$this->db->query("SELECT * FROM ( (SELECT vouchers.month_name, vouchers.voucher_number ,vouchers.total_amount , -1 as paid_amount, vouchers.issue_date, NULL as advance_amount FROM vouchers WHERE student_ref_id=$student_id) UNION ALL (SELECT vouchers.month_name, vouchers.voucher_number ,-1 as total_amount, vouchers.paid_amount, vouchers.paid_time as issue_date, NULL as advance_amount FROM vouchers WHERE student_ref_id=$student_id) UNION ALL (SELECT advance_fee.advance_month as month_name, NULL as voucher_number , NULL as total_amount, NULL as paid_amount,advance_fee.advance_date as issue_date, advance_fee.advance_amount FROM advance_fee WHERE student_id=$student_id) ) results ORDER BY issue_date ASC");

            $slipdata=$slipquery->result_array(); 
        if(!empty($slipdata)){
            $count=1; 
            $balance=0;
            $debit=0;
            $credit=0;

            foreach ($slipdata as $row ) {
                $paid=$row["paid_amount"]; 
                if(empty($row["advance_amount"])){
                    if($row["total_amount"]!=-1 ){
                        echo'  
                        <tr>                    
                            <td> '. $count++.'</td>
                            <td> '. $row["issue_date"] .'</td>
                            <td> '. $row["voucher_number"] .' </td>                     
                            <td> Fee Challan -'. $student_id.'  - '. $Student_nam .', Fee Month '. $row["month_name"].' </td>
                            <td> '; echo $row["total_amount"]; $debit = $debit + $row["total_amount"]; echo' </td>
                            <td> 0 </td>
                            <td> '; $balance=$row["total_amount"]+$balance;
                            if($balance<=0){echo abs($balance).' Cr';}else{echo $balance.' Dr';}  echo' </td>
                        </tr>   ';
                    }  else if($row["paid_amount"] > 0){
                    echo'  
                        <tr>                    
                            <td> '. $count++.'</td>
                            <td> '. $row["issue_date"] .'</td>
                            <td> '. $row["voucher_number"] .' </td>                     
                            <td> Amount Received </td>
                            <td> 0 </td>
                            <td> '; echo $row["paid_amount"]; $credit = $credit + $row['paid_amount']; echo' </td>
                            <td> '; $balance=$balance-$row["paid_amount"];  if($balance>=0){echo $balance.' Dr';}else{echo abs($balance).' Cr';} echo' </td>
                        </tr>   ';
                    } 


                } else{
                echo' <tr>                    
                        <td> '. $count++.'</td>
                        <td> '. $row["issue_date"] .'</td>
                        <td> '. $row["voucher_number"] .' </td>                     
                        <td  > Amount Received </td>
                        <td> 0 </td>
                        <td> '; echo $row["advance_amount"]; $credit = $credit + $row['advance_amount']; echo' </td>
                        <td> '; $balance=$balance-$row["advance_amount"]; if($balance>=0){echo $balance.' Dr';}else{echo abs($balance).'  Cr';} echo' </td>
                    </tr>'; 
                }   
            } 
             echo'<tr>                      
                    <th style="text-align:center;" colspan="4"> Total</th>
                    <th> '.$debit.' </th>
                    <th> '.$credit.' </th>
                    <th> </th>
                </tr>';
            } else{
                echo'<tr>                      
                    <th style="text-align:center; color:red;" colspan="6">This Student is Not Available!</th>
                     
                    <th> </th>
                </tr>';

            }
        } else{
            echo'<tr>                      
                    <th style="text-align:center; color:red;" colspan="6">This Student is Not Available!</th>
                     
                    <th> </th>
                </tr>';
        }  
    }
    // This Function fetch previous Pass Students Info
    public function ajaxPreiousPassStudents(){
        $year = $this->input->get('q', TRUE); 
        $query = $this->db->query("SELECT * FROM register_pass WHERE status ='pass' AND year=$year");
        $yearData = $query->result_array(); 
        if(!empty($yearData)){ 
            
            $count = 1;
            foreach ($yearData as $row){   
                echo'<tr>                    
                        <td> '. $count++ .'</td>
                        <td> '. $this->common->class_title($row["class_id"]) .' </td> 
                        <td class="text-uppercase"> '. $row["student_nam"].' </td>
                        <td class="text-uppercase">'. $row["father_name"] .' </td>
                        <td> '.$row["reg_number"] .' </td>
                        <td> '. $row["voucher_number"] .' </td>
                        <td> '; if($row["admission_status"]=="Admitted"){
                                    echo'<span class="label label-sm label-success">'.$row["admission_status"].'</span>';
                                } elseif($row["admission_status"]=="Not Admitted"){
                                    echo'<span class="label label-sm label-danger">'.$row["admission_status"].'</span>';
                                } 
                   echo'</td>
                        <td>'.$row["status"] .' </td>
                        <td> '. $row["actual_tot"] .' </td>
                        <td> '. $row["total"] .' </td>
                        <td> '. $row["disc_tot"] .' </td>
                        <td> '; if($row["paid_status"]=='unpaid'){
                                    echo '<span class="label label-sm label-danger">'. $row["paid_status"] .'</span>';
                                } else {
                                    echo '<span class="label label-sm label-success">'. $row["paid_status"] .'</span>';
                                } 
                    echo'</td>
                    </tr>';
            }
        } else{
             echo'<tr> <td colspan="15" class="text-center text-danger">This Year Data Note Available </td> </tr>';
        }
 
    }
       
    //This function will load single students name and id 
    public function ajaxSnameSid() { 
        $studentId = $this->input->get('q', TRUE);
        $query = $this->db->query("SELECT student_nam,student_id FROM student_info WHERE student_id='$studentId'");
        $infodata=$query->result_array(); 
        if(!empty($infodata)){
            echo'
                <div class="row">
                <div class="col-md-2"> </div>
                <div class="col-md-4 textAlignCenter" >Student Name : '.$infodata[0]['student_nam'].'</div>
                <div class="col-md-4 textAlignCenter" >Student ID : '.$infodata[0]['student_id'].'</div>
                </div>';
        } else{
            echo'<div class="row"><div class="col-md-2"> </div>
                <div class="col-md-8 textAlignCenter text-danger" > <b>This Student is Not Available</b></div></div>'; 
        }
    }
    //This function will load all students trangections slips
    public function allSlips() { 
            $data['slips'] = $this->accountmodel->stud_payment();
            $this->load->view('temp/header');
            $this->load->view('allSlips', $data);
            $this->load->view('temp/footer');
    }

    //this function Show student vocher  
    public function student_vocher(){
        $d_date = $this->input->get('due_date', TRUE);
            $std_id = $this->input->get('student_id', TRUE);
            $class_id = $this->input->get('class_id', TRUE); 
            //$created_by = $this->input->get('u_id', TRUE);
            $voch_no = $this->input->get('voch_no', TRUE);
            $month = $this->input->get('month', TRUE);
            $year = $this->input->get('year', TRUE);

        $due_date=strtotime($d_date); 
        $curr_date = strtotime(date('Y-m-d')); 
       if($due_date >= $curr_date ){ 
              
            $data['voucher'] = $this->accountmodel->vocher($std_id,$class_id,$voch_no,$month,$year); 
            $data['voucher_class'] = $this->accountmodel->vocher_class($class_id,$std_id);  
                $this->load->view('temp/header');
                $this->load->view('student_vocher' , $data);
                $this->load->view('temp/footer');  
        } else{
            $data['due_date']=$d_date;
            $data['std_id']=$std_id;
            $data['class_id']=$class_id;
            $data['voch_no']=$voch_no;
            $data['month']=$month;
            $data['year']=$year;
            $this->load->view('temp/header');
            $this->load->view('extendDueDate', $data);
            $this->load->view('temp/footer'); 
        }
    } 

    //in this function change previous voucher due date
    public function changeDueDate() { 
        $due_date = $this->input->post('due_date', TRUE);
            $std_id = $this->input->post('std_id', TRUE);
            $class_id = $this->input->post('class_id', TRUE);
            $voch_no = $this->input->post('voch_no', TRUE);
            $month = $this->input->post('month', TRUE);
            $year = $this->input->post('year', TRUE);
            $created_by = $this->input->post('created_by', TRUE); 
            $slipdata = array(
                    'due_date' => $this->db->escape_like_str($due_date), 
                    'created_by' => $this->db->escape_like_str($created_by), 
                ); 
                $this->db->where('month', $month);
                $this->db->where('year', $year);
                $this->db->where('voucher_number', $voch_no); 
                $this->db->update('slip', $slipdata);
            $vouhdata = array(
                    'due_date' => $this->db->escape_like_str($due_date), 
                    'created_by' => $this->db->escape_like_str($created_by), 
                ); 
                $this->db->where('month_name', $month);
                $this->db->where('year', $year);
                $this->db->where('voucher_number', $voch_no); 
                $this->db->update('vouchers', $vouhdata); 
            $data['voucher'] = $this->accountmodel->vocher($std_id,$class_id,$voch_no,$month,$year); 
            $data['voucher_class'] = $this->accountmodel->vocher_class($class_id,$std_id);  
                $this->load->view('temp/header');
                $this->load->view('student_vocher' , $data);
                $this->load->view('temp/footer');
    }

    //Show invioce or students tranjection slips details
    public function view_invoice() {
        $slipId = $this->input->get('sid', TRUE);
        $data['invoice'] = $this->accountmodel->invoice($slipId);
        $data['schoolName'] = $this->common->schoolName();
        $data['currency'] = $this->common->currencyClass();
        $data['item'] = $this->common->getAllData('fee_item');
        $this->load->view('temp/header');
        $this->load->view('invoice', $data);
        $this->load->view('temp/footer');
    }

    //Show invioce or students tranjection slips details
    public function view_admi_invoice() {
        $reg_num = $this->input->get('reg_num', TRUE);  
        $query = $this->db->query("SELECT * FROM register_pass WHERE reg_number='$reg_num'");
        $data['infodata']=$query->result_array(); 
        $data['schoolName'] = $this->common->schoolName();
        $data['currency'] = $this->common->currencyClass();
        $data['item'] = $this->common->getAllData('fee_item');
        $this->load->view('temp/header');
        $this->load->view('admi_invoice', $data);
        $this->load->view('temp/footer');
    }

    //This function will pay students fees
    public function fee_pay() {
        if ($this->input->post('submit', TRUE)) {
            $sid = $this->input->get('sid');
            $created_by = $this->input->post('u_id', TRUE);
            $student_id = $this->input->post('student_id', TRUE);
            $voch_no = $this->input->post('voch_no', TRUE);
            $month = $this->input->post('month', TRUE);
            $year = $this->input->post('year', TRUE); 
            $total = $this->input->post('total', TRUE);
            $paid = $this->input->post('paid_amount', TRUE);
            $method = $this->input->post('method', TRUE);
            $account_name = $this->input->post('account_name', TRUE);
            date_default_timezone_set('Asia/Karachi'); 
            $update=date("Y-m-d h:i:s A");
            
            if ($paid > $total || $paid == $total) {
                $due = 0;
                $balance = $paid - $total;
                $status = 'Paid';
                //echo 'a';
            } elseif ($paid < $total) {
                $balance = 0;
                $due = $total - $paid;
                $status = 'Not Clear';
                //echo 'b';
            } 
            $slip_data = array(
               // 'dues' => $this->db->escape_like_str($due),
               // 'total' => $this->db->escape_like_str($total),
                'paid' => $this->db->escape_like_str($paid),
                //'balance' => $this->db->escape_like_str($balance),
                'payment_status' => $this->db->escape_like_str($status),
                'mathod' => $this->db->escape_like_str($method),
                'account_name' => $this->db->escape_like_str($account_name),
                'created_by' => $this->db->escape_like_str($created_by),  
            );  
            $vouchers = array(
                    'paid_amount' => $this->db->escape_like_str($paid),
                    'voucher_status' => $this->db->escape_like_str($status),
                    'created_by' => $this->db->escape_like_str($created_by),
                    'paid_time' => $this->db->escape_like_str($update),   
                );  
            // this array update vouchers table data 
            $query=$this->db->query("SELECT * FROM vouchers WHERE student_ref_id=$student_id AND voucher_number='$voch_no' AND voucher_type='Monthly Fee' AND month_name='$month' AND year='$year'");
            $data1=$query->result_array();
            if(!empty($data1)){ 
                // vouchers table update check  
                $this->db->where('voucher_type', 'Monthly Fee');
                $this->db->where('month_name', $month);
                $this->db->where('year', $year);
                $this->db->where('voucher_number', $voch_no); 
                $this->db->update('vouchers', $vouchers); 
                // slip table update check

                $this->db->where('student_id', $student_id);
                $this->db->where('month', $month);
                $this->db->where('year', $year);
                $this->db->where('voucher_number', $voch_no);
                $this->db->update('slip', $slip_data);

                if ($month==date('F') AND $year==date('Y')) {
                    $data['message'] = '<div class="alert alert-success alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                    <strong>SUCCESS!</strong> Your Transaction Was Successfully Processed.
                                </div>';
                    $data['slips'] = $this->accountmodel->stud_payment();
                    $this->load->view('temp/header');
                    $this->load->view('allSlips', $data);
                    $this->load->view('temp/footer');
                } else{
                    $data['message'] = '<div class="alert alert-success alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                    <strong>SUCCESS!</strong> Your Transaction Was Successfully Processed.
                                </div>';
                    $data['slips'] = $this->accountmodel->stud_payment();
                    $this->load->view('temp/header');
                    $this->load->view('previousPayments' );
                    $this->load->view('temp/footer');

                }
            }   
            
        } else {    
            $d_date = $this->input->get('due_date');
            $sid = $this->input->get('sid');
            $class_id = $this->input->get('class_id');
            $voch_no = $this->input->get('voch_no');
            $month = $this->input->get('month');
            $year = $this->input->get('year');
            
            $due_date=strtotime($d_date); 
            $curr_date = strtotime(date('Y-m-d')); 
            if($due_date >= $curr_date ){ 
                $data['slip_data'] = $this->accountmodel->s_slip_info($sid,$class_id,$voch_no,$month,$year);
                $query1=$this->db->query("SELECT * FROM payment_methods WHERE status='active'");
                $data['pay_method']=$query1->result_array();
                $data['slip_id'] = $sid;
                    $this->load->view('temp/header');
                    $this->load->view('fee_pay', $data);
                    $this->load->view('temp/footer');
            } else{
                $data['due_date']=$d_date;
                $data['std_id']=$sid;
                $data['class_id']=$class_id;
                $data['voch_no']=$voch_no;
                $data['month']=$month;
                $data['year']=$year;
                    $this->load->view('temp/header');
                    $this->load->view('extendDueDate', $data);
                    $this->load->view('temp/footer'); 
            } 
        }
    }

    // this function call ajax for select payment account
    public function ajaxBankResult() {
        $pay_method = $this->input->get('q');  
         
        if($pay_method=="Cash" || $pay_method=="cash") {} 
        else{    
       $query=$this->db->query("SELECT account_name FROM payment_methods WHERE payment_method='$pay_method'"); 
        $data=$query->result_array();
        echo'
            <div class="form-group">
            <label class="col-md-3 control-label">' . "Select Bank Name" . ' <span class="requiredStar"> * </span></label>
            <div class="col-md-5">
                <select onchange="salaryAmount(this.value)" class="form-control" name="account_name" data-validation="required" data-validation-error-msg="' . lang('teac_11') . '">
                    <option value="">' . lang('select') . '</option>';
                foreach($data as $row){
                echo '<option value="'.$row['account_name'].'"> '.$row['account_name'].'</option>';
                }
            echo '</select>
            </div>
            </div>'; 
        }
    }

    //This function will edit student payment information
    public function edit_fee_pay() {
        if ($this->input->post('submit', TRUE)) {
            $sid = $this->input->get('sid');
            $total = $this->input->post('total', TRUE);
            $paid = $this->input->post('paid_amount', TRUE);
            if ($paid > $total || $paid == $total) {
                $due = 0;
                $balance = $paid - $total;
                $status = 'Paid';
                echo 'a';
            } elseif ($paid < $total) {
                $balance = 0;
                $due = $total - $paid;
                $status = 'Not Clear';
                echo 'b';
            }
            $slip_data = array(
                'dues' => $this->db->escape_like_str($due),
                'total' => $this->db->escape_like_str($total),
                'paid' => $this->db->escape_like_str($paid),
                'balance' => $this->db->escape_like_str($balance),
                'payment_status' => $this->db->escape_like_str($status),
                'mathod' => $this->db->escape_like_str($this->input->post('method', TRUE)),
            );
            $this->db->where('student_id', $sid);
            if ($this->db->update('slip', $slip_data)) {
                $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong>WOW!</strong> Your transaction was successfully processed.
                            </div>';
                $data['slips'] = $this->accountmodel->stud_payment();
                $this->load->view('temp/header');
                $this->load->view('allSlips', $data);
                $this->load->view('temp/footer');
            }
        } else {
            $sid = $this->input->get('sid');
            $data['paid_amount'] = $this->accountmodel->paid_amount($sid);
            $data['total'] = $this->accountmodel->s_slip_info($sid);
            $data['slip_id'] = $sid;
            $this->load->view('temp/header');
            $this->load->view('edit_fee_pay', $data);
            $this->load->view('temp/footer');
        }
    }

    
    //This function will give the student information from studentID
    public function studentInfoById() {
        $studentId = $this->input->get('q', TRUE);
        $query = $this->common->stuInfoId($studentId);
        if (empty($query)) {
            echo '<div class="form-group">
                    <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                        <div class="alert alert-danger">
                            <strong>' . lang('tea_info') . ':</strong> ' . lang('teac_1') . ' <strong>' . $studentId . '</strong>' . lang('teac_2') . '
                    </div></div></div>';
        } else {
            echo '<div class="row"><div class="col-md-offset-2 col-md-7 stuInfoIdBox">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-md-4 control-label">' . lang('teac_3') . ' <span class="requiredStar">  </span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="studentName" value="' . $query->student_nam . '" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">' . lang('teac_4') . ' <span class="requiredStar">  </span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="class" value="' . $this->common->class_title($query->class_id) . '" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <img src="assets/uploads/' . $query->student_photo . '" class="img-responsive" alt=""><br>
                    </div>
                </div></div>';
        }
    }

    //This function will work to pay salary to employes
    public function paySalary() {
        if ($this->input->post('submit', TRUE)) {
            $pre_balence = $this->accountmodel->pre_balence();
            $total_amount = $this->input->post('totalSalary', TRUE);
            if ($pre_balence >= $total_amount) {
                $balence = $pre_balence - $total_amount;
                $employId = $this->input->post('employId', TRUE);
                if ($this->input->post('month', TRUE) == 1) {
                    $month = 'January';
                } elseif ($this->input->post('month', TRUE) == 2) {
                    $month = 'February';
                } elseif ($this->input->post('month', TRUE) == 3) {
                    $month = 'March';
                } elseif ($this->input->post('month', TRUE) == 4) {
                    $month = 'April';
                } elseif ($this->input->post('month', TRUE) == 5) {
                    $month = 'May';
                } elseif ($this->input->post('month', TRUE) == 6) {
                    $month = 'Jun';
                } elseif ($this->input->post('month', TRUE) == 7) {
                    $month = 'July';
                } elseif ($this->input->post('month', TRUE) == 8) {
                    $month = 'August';
                } elseif ($this->input->post('month', TRUE) == 9) {
                    $month = 'Septembore';
                } elseif ($this->input->post('month', TRUE) == 10) {
                    $month = 'October';
                } elseif ($this->input->post('month', TRUE) == 11) {
                    $month = 'November';
                } elseif ($this->input->post('month', TRUE) == 12) {
                    $month = 'December';
                }
                $salary = array(
                    'year' => $this->db->escape_like_str(date('Y')),
                    'date' => $this->db->escape_like_str(strtotime(date('d-m-Y'))),
                    'month' => $this->db->escape_like_str($month),
                    'total_amount' => $this->db->escape_like_str($total_amount),
                    'method' => $this->db->escape_like_str($this->input->post('method', TRUE)),
                    'user_id' => $this->db->escape_like_str($employId),
                    'employ_title' => $this->db->escape_like_str($this->input->post('employ_title', TRUE))
                );
                if ($this->db->insert('salary', $salary)) {
                    $entry_info = $this->accountmodel->tran_check(2);
                    if ($entry_info == 'no_entry') {
                        $inco_data = array(
                            'date' => $this->db->escape_like_str(strtotime(date('d-m-Y'))),
                            'acco_id' => $this->db->escape_like_str(2),
                            'category' => $this->db->escape_like_str('Expense'),
                            'amount' => $this->db->escape_like_str($total_amount),
                            'balance' => $this->db->escape_like_str($balence)
                        );
                        $this->db->insert('transection', $inco_data);
                    } else {
                        $inco_data = array(
                            'date' => $this->db->escape_like_str(strtotime(date('d-m-Y'))),
                            'acco_id' => $this->db->escape_like_str(2),
                            'category' => $this->db->escape_like_str('Expense'),
                            'amount' => $this->db->escape_like_str($total_amount + $entry_info[0]['amount']),
                            'balance' => $this->db->escape_like_str($balence)
                        );
                        $row_id = $entry_info[0]['id'];
                        $this->db->where('id', $row_id);
                        $this->db->update('transection', $inco_data);
                    }
                }
                $satSalaryInfo = array(
                    'month' => $this->db->escape_like_str($this->input->post('month', TRUE)),
                );
                $this->db->where('employ_user_id', $employId);
                if ($this->db->update('set_salary', $satSalaryInfo)) {
                    redirect('account/paySalary', 'refresh');
                }
            } else {
                $data['message'] = '<div class="alert alert-block alert-danger fade in">
                                    <button data-dismiss="alert" class="close" type="button"></button>
                                    <h4 class="alert-heading">' . lang('error') . '</h4> ' . lang('teac_5') . '
                            </div>';
                $data['salary_list'] = $this->accountmodel->employee_salary();
                $this->load->view('temp/header');
                $this->load->view('paySalary', $data);
                $this->load->view('temp/footer');
            }
        } else {
            $data['salary_list'] = $this->accountmodel->employee_salary();
            $this->load->view('temp/header');
            $this->load->view('paySalary', $data);
            $this->load->view('temp/footer');
        }
    }
/*public function ajaxEmployInfo() {
        $month = $this->input->get('month');
        $query = $this->accountmodel->salaryEmployList($month);
        echo '<div class="form-group">
            <label class="col-md-3 control-label">' . lang('teac_6') . ' <span class="requiredStar"> * </span></label>
            <div class="col-md-9">
                <select onchange="salaryAmount(this.value)" class="form-control" name="employId" data-validation="required" data-validation-error-msg="' . lang('teac_11') . '">
                    <option value="">' . lang('select') . '</option>';
        foreach ($query as $row) {
            echo '<option value="' . $row['employ_user_id'] . '">' . $row['employe_title'] . '</option>';
        }
        echo '</select>
            </div>
        </div>
        <div id="ajaxResult_2"></div>';
    }*/
    //This function will show the employ who will get Government salary
    public function ajaxEmployInfo() {
        $month = $this->input->get('month');
        $query = $this->accountmodel->salaryEmployList($month);
        $queryGroup=$this->db->query("SELECT * FROM groups");
            $qGroup=$queryGroup->result_array();
        echo'
            <div class="form-group">
            <label class="col-md-3 control-label">'."Select Group".'<span class="requiredStar">*</span></label>
            <div class="col-md-9">
                <select onchange="selectGroup(this.value)" class="form-control" name="group_id" data-validation="required" data-validation-error-msg="' . lang('teac_11') . '">
                    <option value="">' . lang('select') . '</option>';
        foreach ($qGroup as $row1) {
            echo '<option value="' . $row1['id'] . '">' . $row1['name']. '</option>';
        }
        echo'</select>
            </div>
        </div>
        <div id="ajaxResult_2"></div>';
           /*<div class="form-group">
            <label class="col-md-3 control-label">' . lang('teac_6') . ' <span class="requiredStar"> * </span></label>
            <div class="col-md-9">
                <select onchange="salaryAmount(this.value)" class="form-control" name="employId" data-validation="required" data-validation-error-msg="' . lang('teac_11') . '">
                    <option value="">' . lang('select') . '</option>';
        foreach ($query as $row) {
            echo '<option value="' . $row['employ_user_id'] . '">' . $row['employe_title'] . '</option>';
        }
        echo '</select>
            </div>
        </div>
        <div id="ajaxResult_3"></div>*/
    }
    //This function will show the employ group 
    public function ajaxselectgroup() {
        $group_id = $this->input->get('gId');
       // echo $group_id;
       /* $query = $this->db->query("SELECT * FROM userinfo WHERE group_id='$group_id' AND status ='Active'");
        $query1=$query->result_array();*/
        //$query = $this->accountmodel->salaryEmployList($month);
        $query = $this->accountmodel->salaryEmployList($group_id);
         
        echo'
             <div class="form-group">
            <label class="col-md-3 control-label">' . lang('teac_6') . ' <span class="requiredStar"> * </span></label>
            <div class="col-md-9">
                <select onchange="salaryAmount(this.value)" class="form-control" name="employId" data-validation="required" data-validation-error-msg="' . lang('teac_11') . '">
                    <option value="">' . lang('select') . '</option>';
        foreach ($query as $row) {
            echo '<option value="' . $row['employ_user_id'] . '">' . $row['employe_title'] . '</option>';
        }
        echo '</select>
            </div>
        </div>
        <div id="ajaxResult_3"></div>'; 
    }    
    //This function will return one employe sallary amount
    public function ajaxSalaryAmount() {
        $uId = $this->input->get('uId'); 
        $query = $this->accountmodel->ajaxSalaryAmount($uId);
        echo '<div class="form-group">
            <label class="col-md-3 control-label"> ' . lang('teac_7') . ' <span class="requiredStar">  </span></label>
            <div class="col-md-9">
                <input type="text" readonly="" placeholder="Readonly" class="form-control" name="totalSalary" value="' . $query . '">
            </div>
        </div><input type="hidden" name="employ_title" value="' . $this->accountmodel->semployTitle($uId) . '">';
    }

    //this function will return employ title via user id
    public function SchEmploTItle() {
        $uId = $this->input->get('uId');
        echo '<input type="hidden" name="employ_title" value="' . $this->accountmodel->semployTitle($uId) . '">';
    }

    //This function will make transection
    public function transection() {
        $date = strtotime(date('d-m-Y'));
        if ($this->input->post('expense', TRUE)) {
            $account_id = $this->input->post('account_id', TRUE);
            $amount = $this->input->post('amount', TRUE);
            $pre_balence = $this->accountmodel->pre_balence();
            if ($pre_balence >= $amount) {
                $balence = $pre_balence - $amount;
                $entry_info = $this->accountmodel->tran_check($account_id);
                if ($entry_info == 'no_entry') {
                    $inco_data = array(
                        'date' => $this->db->escape_like_str($date),
                        'acco_id' => $this->db->escape_like_str($account_id),
                        'category' => $this->db->escape_like_str('Expense'),
                        'amount' => $this->db->escape_like_str($amount),
                        'balance' => $this->db->escape_like_str($balence)
                    );
                    if ($this->db->insert('transection', $inco_data)) {
                        $data['message'] = '<div class="alert alert-block alert-success fade in">
                                            <button data-dismiss="alert" class="close" type="button"></button>
                                            <h4 class="alert-heading">' . lang('success') . ' </h4> ' . lang('teac_8') . ' 
                                    </div>';
                        $data['income'] = $this->accountmodel->income();
                        $data['expanse'] = $this->accountmodel->expanse();
                        $data['inco_title'] = $this->accountmodel->inco_title();
                        $data['expa_title'] = $this->accountmodel->expa_title();
                        $this->load->view('temp/header');
                        $this->load->view('transection', $data);
                        $this->load->view('temp/footer');
                    }
                } else {
                    $inco_data = array(
                        'date' => $this->db->escape_like_str($date),
                        'acco_id' => $this->db->escape_like_str($account_id),
                        'category' => $this->db->escape_like_str('Expense'),
                        'amount' => $this->db->escape_like_str($amount + $entry_info[0]['amount']),
                        'balance' => $this->db->escape_like_str($balence)
                    );
                    $row_id = $entry_info[0]['id'];
                    $this->db->where('id', $row_id);
                    if ($this->db->update('transection', $inco_data)) {
                        $data['message'] = '<div class="alert alert-block alert-success fade in">
                                            <button data-dismiss="alert" class="close" type="button"></button>
                                            <h4 class="alert-heading">' . lang('success') . ' </h4> ' . lang('teac_8') . '
                                    </div>';
                        $data['income'] = $this->accountmodel->income();
                        $data['expanse'] = $this->accountmodel->expanse();
                        $data['inco_title'] = $this->accountmodel->inco_title();
                        $data['expa_title'] = $this->accountmodel->expa_title();
                        $this->load->view('temp/header');
                        $this->load->view('transection', $data);
                        $this->load->view('temp/footer');
                    }
                }
            } else {
                $data['message'] = '<div class="alert alert-block alert-danger fade in">
                                    <button data-dismiss="alert" class="close" type="button"></button>
                                    <h4 class="alert-heading">' . lang('error') . '</h4> ' . lang('teac_9') . '
                            </div>';
                $data['income'] = $this->accountmodel->income();
                $data['expanse'] = $this->accountmodel->expanse();
                $data['inco_title'] = $this->accountmodel->inco_title();
                $data['expa_title'] = $this->accountmodel->expa_title();
                $this->load->view('temp/header');
                $this->load->view('transection', $data);
                $this->load->view('temp/footer');
            }
        } elseif ($this->input->post('income', TRUE)) {
            $account_id = $this->input->post('account_id', TRUE);
            $amount = $this->input->post('amount', TRUE);
            $pre_balence = $this->accountmodel->pre_balence();
            $balence = $pre_balence + $amount;
            $entry_info = $this->accountmodel->tran_check($account_id);
            if ($entry_info == 'no_entry') {
                $inco_data = array(
                    'date' => $this->db->escape_like_str($date),
                    'acco_id' => $this->db->escape_like_str($account_id),
                    'category' => $this->db->escape_like_str('Income'),
                    'amount' => $this->db->escape_like_str($amount),
                    'balance' => $this->db->escape_like_str($balence)
                );
                if ($this->db->insert('transection', $inco_data)) {
                    $data['message_2'] = '<div class="alert alert-block alert-success fade in">
                                            <button data-dismiss="alert" class="close" type="button"></button>
                                            <h4 class="alert-heading">' . lang('success') . ' </h4> ' . lang('teac_10') . '
                                    </div>';
                    $data['income'] = $this->accountmodel->income();
                    $data['expanse'] = $this->accountmodel->expanse();
                    $data['inco_title'] = $this->accountmodel->inco_title();
                    $data['expa_title'] = $this->accountmodel->expa_title();
                    $this->load->view('temp/header');
                    $this->load->view('transection', $data);
                    $this->load->view('temp/footer');
                }
            } else {
                $inco_data = array(
                    'date' => $this->db->escape_like_str($date),
                    'acco_id' => $this->db->escape_like_str($account_id),
                    'category' => $this->db->escape_like_str('Income'),
                    'amount' => $this->db->escape_like_str($amount + $entry_info[0]['amount']),
                    'balance' => $this->db->escape_like_str($balence)
                );
                $row_id = $entry_info[0]['id'];
                $this->db->where('id', $row_id);
                if ($this->db->update('transection', $inco_data)) {
                    $data['message_2'] = '<div class="alert alert-block alert-success fade in">
                                            <button data-dismiss="alert" class="close" type="button"></button>
                                            <h4 class="alert-heading">' . lang('success') . ' </h4> ' . lang('teac_10') . '
                                    </div>';
                    $data['income'] = $this->accountmodel->income();
                    $data['expanse'] = $this->accountmodel->expanse();
                    $data['inco_title'] = $this->accountmodel->inco_title();
                    $data['expa_title'] = $this->accountmodel->expa_title();
                    $this->load->view('temp/header');
                    $this->load->view('transection', $data);
                    $this->load->view('temp/footer');
                }
            }
        } else {
            $data['income'] = $this->accountmodel->income();
            $data['expanse'] = $this->accountmodel->expanse();
            $data['inco_title'] = $this->accountmodel->inco_title();
            $data['expa_title'] = $this->accountmodel->expa_title();
            $this->load->view('temp/header');
            $this->load->view('transection', $data);
            $this->load->view('temp/footer');
        }
    }

    //This function will show expanse list by date range 
    public function exp_list_da_ra() {
        $rngstrt = strtotime($this->input->post('rngstrt', TRUE));
        $rngfin = strtotime($this->input->post('rngfin', TRUE));
        $query = $this->db->query("SELECT * FROM transection WHERE date >='$rngstrt' AND date <= '$rngfin' AND category='Expense'");
        $i = 1;
        foreach ($query->result_array() as $row) {
            echo '<tr>
                    <td>
                        ' . $i . '
                    </td>
                    <td>
                        ' . date("d-m-Y", $row['date']) . '
                    </td>
                    <td>
                        ' . $this->accountmodel->acc_tit_id($row['acco_id']) . '
                    </td>
                    <td>
                        ' . $row['amount'] . '
                    </td>
                    <td>
                        ' . $row['balance'] . '
                    </td>
                </tr>';
            $i++;
        }
    }

    //This function will show expanse list by date range 
    public function inc_list_da_ra() {
        $rngstrt = strtotime($this->input->post('rngstrt', TRUE));
        $rngfin = strtotime($this->input->post('rngfin', TRUE));
        $query = $this->db->query("SELECT * FROM transection WHERE date >='$rngstrt' AND date <= '$rngfin' AND category='Income'");
        $i = 1;
        foreach ($query->result_array() as $row) {
            echo '<tr>
                    <td>
                        ' . $i . '
                    </td>
                    <td>
                        ' . date("d-m-Y", $row['date']) . '
                    </td>
                    <td>
                        ' . $this->accountmodel->acc_tit_id($row['acco_id']) . '
                    </td>
                    <td>
                        ' . $row['amount'] . '
                    </td>
                    <td>
                        ' . $row['balance'] . '
                    </td>
                </tr>';
            $i++;
        }
    } 
    
//This function will make students month end slip by auto calculation
    public function end_stu_calcu() {
        $class = $this->accountmodel->all_class();
        foreach ($class as $row) {
            $class_id = $row['id'];
            $m_t_fee = $this->accountmodel->total_fee($class_id);
            $tot=0;
            if (!empty($m_t_fee)) {
                $crntdate =date('Y-m-d');
                $crntMonth =date('F'); //September
                $crntYear =date('Y');
                
                foreach ($m_t_fee as $row1) {
                    $item_id[] = $row1['id'];
                if($crntMonth=='January'){
                    $tot  += $row1['annual_fund'];
                } else{
                    $tot+=0;
                }  
                   // this $tot varible total value store
                    $tot  += $row1['tution_fee'];
                    $tot  += $row1['ac_charges'];
                  // only for tution fee
                    $tutionfee=$row1['tution_fee'];
                }  
                $id_text = implode(",", $item_id);
                //$amount = array_sum($money); 
                $all_student = $this->accountmodel->all_students($class_id);
                foreach ($all_student as $row2) {

                    $student_id = $row2['student_id'];
                    
                    $dis_stu=$this->db->query("SELECT discount_id,tution_discount FROM student_fee_discount WHERE student_id='$student_id'");
                    $dis_result=$dis_stu->result_array();
                      
                    if (!empty($dis_result)){
                        $discount_id = $dis_result[0]['discount_id'];
                        $discount = $tutionfee*$dis_result[0]['tution_discount']/100;
                        $dis_tution = $tutionfee-$discount;
                        // payable total fee
                        $dis_total_payable=($tot-$tutionfee)+$dis_tution;
                      
                    } else{
                        $discount_id = 0;
                        $discount="0";
                        $dis_tution=$tutionfee;
                        $dis_total_payable=($tot-$tutionfee)+$dis_tution;
                    }
                    $dues = $this->accountmodel->dues($student_id);
                    if ($dues != 0) {
                        $total = $tot;
                        $dis_total_payable = $tot + $dues;
                        $dues = 0;
                    } else {
                        $total = $tot;
                    }
                    $advance = $this->accountmodel->advance($student_id);
                    date_default_timezone_set("Asia/Karachi");
                    $date_time = date('Y-m-d H:i:s a', time());
                    $status = 'Unpaid';
                    $mathod = '';
                    $paid = 0;
                    $balanec = 0;
                    $paid_time = '';
                    $paid_amount = 0;
                    if ($advance != 0) {
                        if ($dis_total_payable > $advance) {
                            $dis_total_payable -= $advance;
                            $paid = $advance;
                            $mathod = 'Advance';
                            $status = 'Not Clear';
                            $paid_amount = $advance;
                            $paid_time = $date_time;
                        } elseif ($advance == $dis_total_payable) {
                            $balanec = 0;
                            $paid = $dis_total_payable;
                            $status = 'Paid';
                            $mathod = 'Advance';
                            $paid_amount = $dis_total_payable;
                            $paid_time = $date_time;
                        } elseif ($dis_total_payable < $advance) {
                            $paid = $dis_total_payable;
                            $balanec = $advance - $dis_total_payable;
                            $status = 'Paid';
                            $mathod = 'Advance';
                            $paid_amount = $dis_total_payable;
                            $paid_time = $date_time;
                        }
                    } 
                    
                    if($crntMonth=='January'){
                        $annual_fund=$row1['annual_fund'];
                    } else{
                        $annual_fund=0;
                    }
                    //$annual_fund=$row1['annual_fund'];
                    $tution_fee=$row1['tution_fee'];
                    $ac_charges=$row1['ac_charges'];
                    $due_date = $this->accountmodel->due_date($class_id);
                    $issu_date = $this->accountmodel->issu_date($class_id);
                    $y=date("y");
                    $m=date("m");
                    $voucher_number= $y.''.$m.''.$student_id;

                    $user = $this->ion_auth->user()->row(); 
                    $userId = $user->id;
                    $data = array(
                        'year' => $this->db->escape_like_str($crntYear),
                        'month' => $this->db->escape_like_str($crntMonth),
                        'date' => $this->db->escape_like_str($crntdate),
                        'class_id' => $this->db->escape_like_str($class_id),
                        'student_id' => $this->db->escape_like_str($student_id),
                        'item_id' => $this->db->escape_like_str($id_text),
                        'annual_fee' => $this->db->escape_like_str($annual_fund), 
                        'tution_fee' => $this->db->escape_like_str($tution_fee),
                        'ac_charges' => $this->db->escape_like_str($ac_charges), 
                        'amount' => $this->db->escape_like_str($total),
                        'dues' => $this->db->escape_like_str($dues),
                        'advance' => $this->db->escape_like_str($advance),
                        'total' => $this->db->escape_like_str($total),
                        'dis_tution_fee' => $this->db->escape_like_str($dis_tution),
                        'dis_total' => $this->db->escape_like_str($dis_total_payable),
                        'discount' => $this->db->escape_like_str($discount),
                        'paid' => $this->db->escape_like_str($paid),
                        'balance' => $this->db->escape_like_str($balanec), 
                        'issue_date' => $this->db->escape_like_str($crntdate),
                        //'due_date' => $this->db->escape_like_str($due_date),
                        'payment_status' => $this->db->escape_like_str($status),
                        'mathod' => $this->db->escape_like_str($mathod),
                        'voucher_number' => $this->db->escape_like_str($voucher_number),
                        'discount_id' => $this->db->escape_like_str($discount_id),
                        'created_by' => $this->db->escape_like_str($userId),
                    );    

                    $query1=$this->db->query("SELECT id FROM slip WHERE student_id='$student_id' AND month='$crntMonth' AND year='$crntYear'");
                    $result=$query1->result_array();
                   
                if($result){
                    continue;
                } else{
                    $voucher_data = array(
                        'voucher_type' => $this->db->escape_like_str('Monthly Fee'),
                        'student_ref_id' => $this->db->escape_like_str($student_id),
                        'voucher_number' => $this->db->escape_like_str($voucher_number),
                        'total_amount' => $this->db->escape_like_str($dis_total_payable),
                        'paid_amount' => $this->db->escape_like_str($paid_amount),
                        'year' => $this->db->escape_like_str($crntYear),
                        'month_name' => $this->db->escape_like_str($crntMonth),
                        'month_id' => $this->db->escape_like_str(date('m')),
                        'voucher_status' => $this->db->escape_like_str($status),
                        'paid_time' => $this->db->escape_like_str($paid_time),
                        'created_by' => $this->db->escape_like_str($userId),
                        'issue_date' => $this->db->escape_like_str($crntdate),
                       // 'due_date' => $this->db->escape_like_str($due_date),
                    );
                    $this->db->insert('vouchers', $voucher_data);
                    $this->db->insert('slip', $data);
                }
                }
                $item_id = array();
                $money = array();
                $class_com = array(
                    'month_fee' => $this->db->escape_like_str($crntMonth)
                );
                $this->db->where('id', $class_id);
                $this->db->update('class', $class_com);
            }
        }  
        //if($alert==true){echo"<script>alert('already add');</script>";}
          $data['slips'] = $this->accountmodel->stud_payment();
        $this->load->view('temp/header');
        $this->load->view('allSlips', $data);
        $this->load->view('temp/footer');
    } 

    // this function load previous Payments page
    public function previousPayments(){ 
        $month = date('F');  
        $year = date('Y');                     
        //$query=$this->db->query("SELECT * FROM slip WHERE month!= '$month' AND year='$year' AND payment_status!='Paid' ");
        $query=$this->db->query("SELECT * FROM slip WHERE month!= '$month' AND payment_status!='Paid' ");
        $data['slip_unpaid']=$query->result_array();
            $this->load->view('temp/header');
            $this->load->view('previousPayments', $data);
            $this->load->view('temp/footer');
    }
    
    // this function load single student previous Payments page
    public function ajaxPreviousPayments(){
        $sid = $this->input->get('q');
        $month = date('F');
        $year = date('Y');
        $query=$this->db->query("SELECT * FROM slip WHERE student_id='$sid' AND month!= '$month' AND payment_status!='Paid' ");
        $slip_unpaid=$query->result_array();
       $count=1;
        foreach ($slip_unpaid as $row) { 
         echo'  
            <tr>                    
                <td> '. $count++ .'</td>
                <td> '. $row['year'] .'</td>
                <td> '. $row['month'].'</td>
                <td> '. $row['due_date'].'</td>
                <td> '. $this->common->class_title($row['class_id']).'</td>
                <td> '. $row['student_id'].'</td>
                <td> '. $row['voucher_number'].'</td>
                <td> '. $this->common->student_title($row['student_id']).'</td>  
                <td> '. $row['total'].'</td>
                <td> '. $row['dis_total'].'</td>
                <td> '. $row['discount'].'</td>
                <td> '. $row['dues'].'</td>
                <td> '. $row['balance'].'</td>
                <td> '. $row['paid'].'</td>
                <td> '. $row['mathod'].'</td> 
                <td>';
                echo'<span class="label label-sm label-danger">'. $row['payment_status'] .'</span>';
            echo'</td>  
                <td>';
                echo '<a href="index.php/account/student_vocher?student_id='. $row['student_id']. '&class_id='. $row['class_id'].'&voch_no='.$row['voucher_number'].'&month='.$row['month'].'&year='.$row['year']. '&due_date='.$row['due_date']. '">'."Generate Monthly Fee Voucher".' </a>';
            echo'</td>
                <td > ';  
                echo'<a class="btn btn-xs default" href="index.php/account/fee_pay?sid='.$row['student_id'].'&class_id='.$row['class_id'].'&voch_no='.$row['voucher_number'].'&month='.$row['month'].'&year='.$row['year'].'&due_date='.$row['due_date'].'" title="Take Payment"><i class="fa fa-money"></i></a>';
                '</td> 
            </tr>';
        }
    }

// this function load discount page
    public function discount(){
        $reg_num = $this->input->get('reg_id');
        
           // $data['status'] = $this->common->pass_student();
        //$data['dis'] = $this->common->getAllData('fee_structure');
        $data['stu'] = $this->common->getWhere('register_pass', 'reg_number', $reg_num);
        $query=$this->db->query("SELECT * FROM fee_discount WHERE status='active'");
        $data['fee_discount']=$query->result_array();
            $this->load->view('temp/header');
            $this->load->view('discount', $data);
            $this->load->view('temp/footer');
    }

    // this function set monthly discount
    public function monthlyReviseFee(){
        $student_id = $this->input->get('student_id');
        if ($this->input->post('submit', TRUE)) {  
            $student_id = $this->input->get('student_id', TRUE);
            $class_id   = $this->input->get('class_id', TRUE);
            $section    = $this->input->get('section', TRUE); 
            $loan_reasons = $this->input->post('loan_reasons', TRUE); 
            $revise_fee = $this->input->post('revise_fee', TRUE);  
            $tution_fee = $this->input->post('tution_fee', TRUE); 
            $dis_tut_fee = $this->input->post('dis_tut_fee', TRUE); 
            $after_revise_fee = $this->input->post('after_revise_fee', TRUE); 
            $af_dis_total = $this->input->post('af_dis_total', TRUE);  
            $year = $this->input->post('year', TRUE);
            $month = $this->input->post('month', TRUE); 
              
            $reviseFee_data = array(
                'student_id' => $this->db->escape_like_str($student_id), 
                'class_id'   => $this->db->escape_like_str($class_id),
                'section'    => $this->db->escape_like_str($section),  
                'month' => $this->db->escape_like_str($month),  
                'loan_amount' => $this->db->escape_like_str($revise_fee),  
                'loan_reason' => $this->db->escape_like_str($loan_reasons),
                'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE)),     
            );
            $this->db->insert('fee_loan', $reviseFee_data); 
            $slip_data = array( 
                'dis_tution_fee' => $this->db->escape_like_str($after_revise_fee),
                'dis_total' => $this->db->escape_like_str($af_dis_total),
                'revise_loan'  => $this->db->escape_like_str($revise_fee),
                'dues'  => $this->db->escape_like_str($revise_fee), 
                'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE))
            ); 
            $this->db->where('student_id', $student_id);
            $this->db->where('class_id', $class_id); 
            $this->db->where('year', $year); 
            $this->db->where('month', $month); 
            if ($this->db->update('slip', $slip_data)) {
               // $data['stu'] = $this->common->getWhere('register_pass', 'reg_number', $reg_num);
                $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong>Success ! </strong>  Revise Student Fee Updated Successfully. 
                            </div>';
                $data['slips'] = $this->accountmodel->stud_payment();
        $this->load->view('temp/header');
        $this->load->view('allSlips', $data);
        $this->load->view('temp/footer');
            }
        } 
        else{
        $student_id = $this->input->get('student_id');
        $class_id = $this->input->get('class_id');
        $u_id = $this->input->get('u_id'); 
        $data['an_fee'] = $this->input->get('an_fee');
        $data['tu_fee'] = $this->input->get('tu_fee');
        $data['dis_total'] = $this->input->get('dis_total');
        $data['fee_dis'] = $this->input->get('fee_dis');
        $data['dis_tu_fee'] = $this->input->get('dis_tu_fee');
        $data['ac_char'] = $this->input->get('ac_char');
        $data['year'] = $this->input->get('year');
        $data['month'] = $this->input->get('month');
         
        $data['stu_info'] = $this->common->getWhere('student_info', 'student_id', $student_id); 
        /*$query=$this->db->query("SELECT * FROM fee_discount WHERE status='active'");
        $data['fee_discount']=$query->result_array(); */
            $this->load->view('temp/header');
            $this->load->view('monthlyReviseFee', $data);
            $this->load->view('temp/footer');
        }
    }

    // this function pay admission fee 
    public function admi_fee_pay(){
        if($this->input->post('submit', TRUE)){ 
            $sid = $this->input->get('id');    
            $reg_fee = $this->input->post('total', TRUE);
            $created_by = $this->input->post('u_id', TRUE);
            $reg_num = $this->input->post('regnum', TRUE);
            $total = $this->input->post('total', TRUE);
            $paid = $this->input->post('paid_amount', TRUE);
            $method = $this->input->post('method', TRUE);
            $account_name = $this->input->post('account_name', TRUE); 
            date_default_timezone_set('Asia/Karachi'); 
            $update=date("Y-m-d h:i:s A");

            $amount = $reg_fee;
            $month = date('F');
            $year = date('Y');
            $stu = 'Paid';
            $cash = 'cash';
            if ($paid > $total || $paid == $total) {
                $balance = $paid - $total;
                $status = 'Paid';
                //echo 'a';
            } elseif ($paid < $total) {
                $balance = 0;
                $due = $total - $paid;
                $status = 'Unpaid';
                //echo 'b';
            }
             /*
            $regs = $this->common->reg_data($class_id);
            $name = $this->common->name_data($class_id);
            $patty = array(
                'class_id' => $this->db->escape_like_str($class_id),
                'name' => $this->db->escape_like_str($name),
                'reg_number' => $this->db->escape_like_str($regs),
                'status' => $this->db->escape_like_str($stu),
                'cash' => $this->db->escape_like_str($amount),
                'voucher_type' => $this->db->escape_like_str('Admission'),
            );
*/          
            $register_pass = array(
               // 'total' => $this->db->escape_like_str($total),
                'paid' => $this->db->escape_like_str($paid),
                'paid_status' => $this->db->escape_like_str($status),
                'method' => $this->db->escape_like_str($method),
                'account_name' => $this->db->escape_like_str($account_name),
                'created_by' => $this->db->escape_like_str($created_by), 
            );
    // this array update vouchers table data 
            $query=$this->db->query("SELECT * FROM vouchers WHERE student_ref_id='$reg_num' AND voucher_type='Admission'");
            $data1=$query->result_array();
            if(!empty($data1)){
            $vouchers = array(
                'voucher_status' => $this->db->escape_like_str('Paid'),
                'created_by' => $this->db->escape_like_str($created_by),
                'paid_time' => $this->db->escape_like_str($update), 
            );
            $this->db->where('student_ref_id', $reg_num);
            $this->db->where('voucher_type', 'Admission');
            $this->db->update('vouchers', $vouchers);
           
            //$this->db->insert('patty_cash', $patty);
            $this->db->where('reg_number', $reg_num);
            $this->db->update('register_pass', $register_pass); 

            $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong>WOW!</strong> Your transaction was successfully processed.
                            </div>';
             
            $data['status'] = $this->common->pass_student();
            $this->load->view('temp/header');
            $this->load->view('pass_student', $data);
            $this->load->view('temp/footer');

        }
    }else{
        $reg_num = $this->input->get('reg_id');
        $data['admi_fee'] = $this->input->get('admi_fee'); 
        $query1=$this->db->query("SELECT * FROM payment_methods WHERE status='active'");
        $data['pay_method']=$query1->result_array(); 

        $data['slip_id'] = $reg_num;
        $this->load->view('temp/header');
        $this->load->view('admission_fee_pay', $data);
        $this->load->view('temp/footer');
        }
    }

// this function set discount for admission and annuak fee
   public function  fee_discount(){
        $reg_num = $this->input->get('reg_num'); 
        $reason=$this->input->post('discount_persentage', TRUE);
        $disreason = substr($reason, strpos($reason, "_") + 1);  
        //Extract the numbers using the preg_match_all function.
        preg_match_all('!\d+!', $reason, $num); 
        //find the array in 0 0 index
        $percentage=$num[0][0]; 
        if ($this->input->post('submit', TRUE)) { 
            $discount_fee = array(
                'admission_fee' => $this->db->escape_like_str($this->input->post('after_dis_admi_fe', TRUE)),
                'annual_found' => $this->db->escape_like_str($this->input->post('after_dis_annual', TRUE)),
                'discount_reasons' => $this->db->escape_like_str($disreason),
                'discount_persentage' => $this->db->escape_like_str($percentage),
                'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE)), 
            );  
            $this->db->where('reg_number', $reg_num);
            if ($this->db->update('register_pass', $discount_fee)) {
               // $data['stu'] = $this->common->getWhere('register_pass', 'reg_number', $reg_num);
                $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong>Success ! </strong>  Discount Information Updated Successfully. 
                            </div>';
                $data['status'] = $this->common->pass_student();
                $this->load->view('temp/header');
                $this->load->view('pass_student', $data);
                $this->load->view('temp/footer');
            }
        }      
    }

    //This Function will return Patty cash
    public function patty_cash(){
        $data['stu'] = $this->common->getAllData('patty_cash');
            $this->load->view('temp/header');
            $this->load->view('patty_cash', $data);
            $this->load->view('temp/footer'); 
    }
    //This Function will return Patty cash
    public function addpaymentMethod(){
        if($this->input->post('submit', TRUE)){
            $addpayMethod = array(
                'payment_method' => $this->db->escape_like_str($this->input->post('pay_method', TRUE)),
                'account_name' => $this->db->escape_like_str($this->input->post('account_name', TRUE)),
                'account_number' => $this->db->escape_like_str($this->input->post('account_number', TRUE)),
                'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE)),
                'status' => $this->db->escape_like_str("active"),
            );
            
            if ($this->db->insert('payment_methods', $addpayMethod)) { 
                $data['pay_method'] = $this->common->getAllData('payment_methods');
                $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong>Success ! </strong>  Payment Method Added Successfully. 
                            </div>';
                
                $this->load->view('temp/header');
                $this->load->view('addpaymentmethod', $data);
                $this->load->view('temp/footer');
            }
        }
        else{
            $data['pay_method'] = $this->common->getAllData('payment_methods'); 
            $this->load->view('temp/header');
            $this->load->view('addpaymentmethod', $data);
            $this->load->view('temp/footer'); 
        }
    } 
    //this function will use edit payment method
    public function edit_pay_method(){
        $id = $this->input->get('id');
        if($this->input->post('submit', TRUE)){
            $id = $this->input->post('id', TRUE);

            $editpayMethod = array( 
                 
                'payment_method' => $this->db->escape_like_str($this->input->post('pay_method', TRUE)),
                'account_name' => $this->db->escape_like_str($this->input->post('account_name', TRUE)),
                'account_number' => $this->db->escape_like_str($this->input->post('account_number', TRUE)),
                'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE)),
                'status' => $this->db->escape_like_str($this->input->post('status', TRUE)),
            );   
            $this->db->where('id', $id);
            if ($this->db->update('payment_methods', $editpayMethod)) {  
                $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong>Success ! </strong>  Payment Method Updated Successfully. 
                            </div>'; 
                $data['pay_method'] = $this->common->getAllData('payment_methods'); 
                $this->load->view('temp/header');
                $this->load->view('addpaymentmethod', $data);
                $this->load->view('temp/footer');
            }
        }
        else{
            $id = $this->input->get('id');
            $data['pay_method'] = $this->common->getWhere('payment_methods', 'id', $id); 
            $this->load->view('temp/header');
            $this->load->view('edit_pay_method', $data);
            $this->load->view('temp/footer'); 
        }
    }
    //This function will delete Account Title.
    public function delete_pay_method() {
        $id = $this->input->get('id', TRUE);
        $this->db->delete('payment_methods', array('id' => $id));
        //After deleteing the account lode all Account info.
        $data['pay_method'] = $this->common->getAllData('payment_methods');
        $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong>Success ! </strong>  Payment Method Deleted Successfully. 
                            </div>';
        $this->load->view('temp/header');
        $this->load->view('addpaymentmethod', $data);
        $this->load->view('temp/footer');
    }
    //This Function add fee discount
    public function addfeediscount(){
        $year= date('Y');
        if($this->input->post('submit', TRUE)){
        
            $fee_discount = array( 
                'session_discount' => $this->db->escape_like_str($year),
                'discount_reason' => $this->db->escape_like_str($this->input->post('dis_reason', TRUE)),
                'admission_discount' => $this->db->escape_like_str($this->input->post('admi_dis', TRUE)),
                //'annual_discount' => $this->db->escape_like_str($this->input->post('ann_dis', TRUE)),
                'tution_discount' => $this->db->escape_like_str($this->input->post('tu_dis', TRUE)),
                //'ac_discount' => $this->db->escape_like_str($this->input->post('ac_dis', TRUE)), 
                'status' => $this->db->escape_like_str("active"),
                'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE)), 
            );    
            if ($this->db->insert('fee_discount', $fee_discount)) {  
                $data['class'] = $this->common->getAllData('class');
                $data['fee_discount'] = $this->common->getWhere('fee_discount', 'session_discount', $year);  
               /* $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong>Success ! </strong>  Discount Reason Added Successfully. 
                            </div>'; */
                /*$this->load->view('temp/header');
                $this->load->view('addfeediscount', $data);
                $this->load->view('temp/footer');*/ 
                $this->session->set_flashdata('success', '<strong>Success ! </strong>  Discount Reason Added Successfully. ');
                 
                redirect('account/addfeediscount');
            }
        }
        else{ 
            $data['class'] = $this->common->getAllData('class');
            $data['fee_discount'] = $this->common->getWhere('fee_discount', 'session_discount', $year); 
            $data['special_fee_dis'] = $this->common->getWhere('special_fee_discount', 'session_discount', $year);
            $this->load->view('temp/header');
            $this->load->view('addfeediscount', $data);
            $this->load->view('temp/footer'); 
        }
    }

    // this function use set student discount after admission 
    public function set_student_discount(){
        $year= date('Y');
        if($this->input->post('submit', TRUE)){
            $dis_id=$this->input->post('dis_reason', TRUE);
            $q = $this->common->getWhere('fee_discount', 'id', $dis_id);  
            $reason= $q[0]['discount_reason'];
            $tution_dis= $q[0]['tution_discount'];  
            $fee_discount = array( 
                'year' => $this->db->escape_like_str($year),
                'student_id' => $this->db->escape_like_str($this->input->post('student_id', TRUE)), 
                'roll_number' => $this->db->escape_like_str($this->input->post('roll_number', TRUE)),
                'reg_number' => $this->db->escape_like_str($this->input->post('reg_number', TRUE)),
                'discount_reason' => $this->db->escape_like_str($reason),
                //'annual_discount' => $this->db->escape_like_str($annual_dis),
                'tution_discount' => $this->db->escape_like_str($tution_dis),
                //'ac_discount' => $this->db->escape_like_str($ac_dis),
                'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE)),
            );   
            if ($this->db->insert('student_fee_discount', $fee_discount)) { 
                $data['stu_fee_dis'] = $this->common->getAllData('student_fee_discount');
                $query=$this->db->query("SELECT * FROM fee_discount WHERE status='active'");
                $data['fee_discount']=$query->result_array();
                $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong>Success ! </strong>Student Discount Added Successfully. 
                            </div>'; 
                $this->load->view('temp/header');
                $this->load->view('set_student_fee_discount', $data);
                $this->load->view('temp/footer');
            } 
        }
        else{ 
            $data['stu_fee_dis'] = $this->common->getAllData('student_fee_discount');
            $query=$this->db->query("SELECT * FROM fee_discount WHERE session_discount='$year' AND status='active'");
            $data['fee_discount']=$query->result_array();
            $this->load->view('temp/header');
            $this->load->view('set_student_fee_discount', $data);
            $this->load->view('temp/footer'); 
        }
    }
    // this function return student registration and roll number
    public function ajaxStudendresult(){
        $student_id = $this->input->get('q');  
        $query=$this->db->query("SELECT student_id FROM student_fee_discount WHERE student_id='$student_id'"); 
        $data=$query->result_array();
        if(empty($data)){
            $query1=$this->db->query("SELECT roll_number FROM class_students WHERE student_id='$student_id'"); 
            $data1=$query1->result_array();
            if (empty($data1)) {
                $student_id = $this->input->get('q'); 
                echo '<div class="form-group">
                    <label class="col-md- control-label"></label>
                        <div class="col-md-12">
                        <div class="alert alert-danger">
                            <strong>Info:</strong> This student ID <strong>'.$student_id.'</strong> is not matching in our student\'s list.
                    </div></div></div>';
            } else{ 
                $student_id = $this->input->get('q');
            $query2=$this->db->query("SELECT registration_number FROM student_info WHERE student_id='$student_id'"); 
            $data2=$query2->result_array();
                echo'<div class="form-group">
                    <label class="col-md-4 control-label">' . "Roll Number" . ' <span class="requiredStar"> * </span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="roll_number" value="'.$data1[0]['roll_number'].'" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">' . "Registration Number" . ' <span class="requiredStar"> * </span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="reg_number" value="'.$data2[0]['registration_number'].'" readonly="">
                    </div>
                </div>'; 
            }
        }else{
                echo '<span class="text-danger">This Student Discount Already is Given</span>';
        }
         
    }
    //this function will use edit student discount  
    public function editStudentDiscount(){  
        if($this->input->post('submit', TRUE)){ 
            $reg_number = $this->input->post('reg_number', TRUE);  
            $editReason = array(  
                'reg_number' => $this->db->escape_like_str($this->input->post('reg_number', TRUE)),
                'discount_id' => $this->db->escape_like_str($this->input->post('reason_id', TRUE)),
                'discount_reason' => $this->db->escape_like_str($this->input->post('reason', TRUE)),
                'admission_discount' => $this->db->escape_like_str($this->input->post('admi_dis', TRUE)), 
                'tution_discount' => $this->db->escape_like_str($this->input->post('tu_dis', TRUE)), 
                'discount_status' => $this->db->escape_like_str($this->input->post('discount_status', TRUE)), 
                'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE))
            );  
            $this->db->where('reg_number', $reg_number);
            if ($this->db->update('student_fee_discount', $editReason)) {  
                $data['stu_fee_dis'] = $this->common->getAllData('student_fee_discount');
                $query=$this->db->query("SELECT * FROM fee_discount WHERE status='active'");
                $data['fee_discount']=$query->result_array();
                $data['message'] = '<div class="alert alert-success alert-dismissable text-capitalize">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong>Success ! </strong> Student discount Updated Successfully. 
                            </div>';    
                $this->load->view('temp/header');
                $this->load->view('set_student_fee_discount', $data);
                $this->load->view('temp/footer'); 
            }
            //redirect('account/addfeediscount', 'refresh');
        }
        else{
            $reg_num = $this->input->get('reg_num');
            $data['fee_discount'] = $this->common->getAllData('fee_discount');
            $data['student_dis'] = $this->common->getWhere('student_fee_discount', 'reg_number', $reg_num); 
            $this->load->view('temp/header');
            $this->load->view('editStudentDiscount', $data);
            $this->load->view('temp/footer'); 
        }
    }

// this function return ajaxcall discount and roll number
    public function ajaxSelectReason(){
        $disReason = $this->input->get('q'); 
       // $reason=$this->input->post('dis_reason', TRUE);
        $reason = substr($disReason, strpos($disReason, "_") + 1);   
        //Extract the numbers using the preg_match_all function.
        preg_match_all('!\d+!', $disReason, $num); 
                        //find the array in 0 0 index
        $reason_id=$num[0][0]; 
        $query=$this->db->query("SELECT * FROM fee_discount WHERE id='$reason_id'"); 
            $data=$query->result_array();
        echo'<div class="form-group">
                <input type="hidden" name="reason_id" value="'.$reason_id.'">
                <input type="hidden" name="reason" value="'.$reason.'">
                <label class="col-md-5 control-label">Admission Discount</label>
                <div class="col-md-7">
                    <input type="text" name="admi_dis" value="'.$data[0]["admission_discount"].'" class="form-control" readonly="">
                </div>
            </div> 
            <div class="form-group">
                <label class="col-md-5 control-label">Tution Discount</label>
                <div class="col-md-7">
                    <input type="text" name="tu_dis" value="'.$data[0]["tution_discount"].'" class="form-control" readonly="">
                </div>
            </div> ';   
    }

    //this function will use edit discount reason 
    public function edit_dis_reason(){
        $year= date('Y');
        $id = $this->input->get('id');  
        if($this->input->post('submit', TRUE)){
            $id = $this->input->post('id', TRUE);  
            $editdiscount = array( 
                'session_discount' => $this->db->escape_like_str($year), 
                'discount_reason' => $this->db->escape_like_str($this->input->post('dis_reason', TRUE)),
                'admission_discount' => $this->db->escape_like_str($this->input->post('admi_dis', TRUE)),
                //'annual_discount' => $this->db->escape_like_str($this->input->post('ann_dis', TRUE)), 
                'tution_discount' => $this->db->escape_like_str($this->input->post('tu_dis', TRUE)),
                //'ac_discount' => $this->db->escape_like_str($this->input->post('ac_dis', TRUE)),
                'status' => $this->db->escape_like_str($this->input->post('status', TRUE)), 
                'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE)),
               // 'last_update' => $this->db->escape_like_str($update),
            );  
            $this->db->where('id', $id);
            if ($this->db->update('fee_discount', $editdiscount)) {  
                $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong>Success ! </strong>  discount Reason Updated Successfully. 
                            </div>';  
                $data['fee_discount'] = $this->common->getWhere('fee_discount', 'session_discount', $year); 
                $this->load->view('temp/header');
                $this->load->view('addfeediscount', $data);
                $this->load->view('temp/footer'); 
            }
            //redirect('account/addfeediscount', 'refresh');
        }
        else{
            $id = $this->input->get('id');
            $data['fee_discount'] = $this->common->getWhere('fee_discount', 'id', $id); 
            $this->load->view('temp/header');
            $this->load->view('edit_fee_discount', $data);
            $this->load->view('temp/footer'); 
        }
    }
    //This function will delete Discount Reason Title.
    public function delete_discount_per() {
        $id = $this->input->get('id', TRUE);
        $this->db->delete('fee_discount', array('id' => $id));
        //After deleteing the discount reason lode all reason info.
        $data['fee_discount'] = $this->common->getAllData('fee_discount');
        $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong>Success ! </strong>  Payment Method Deleted Successfully. 
                            </div>';
        $this->load->view('temp/header');
        $this->load->view('addfeediscount', $data);
        $this->load->view('temp/footer');
    } 

    // this function use set student Special discount
    public function addSpecialDiscount(){
        if($this->input->post('submit', TRUE)){
            $special_discount = array( 
                'session_discount' => $this->db->escape_like_str($this->input->post('year', TRUE)),
                'special_dis_reason' => $this->db->escape_like_str($this->input->post('first_dis_reason', TRUE)),
                'discount_type' => $this->db->escape_like_str($this->input->post('class', TRUE)),
                //'special_admi_dis' => $this->db->escape_like_str($this->input->post('first_admi_dis', TRUE)), 
                'special_tution_dis' => $this->db->escape_like_str($this->input->post('first_tu_dis', TRUE)),
                'special_dis_month' => $this->db->escape_like_str($this->input->post('first_disc_month', TRUE)), 
                'status' => $this->db->escape_like_str('Active'),  
                'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE)), 
            );  
           if ($this->db->insert('special_fee_discount', $special_discount)) {  
               // $data['fee_discount'] = $this->common->getWhere('fee_discount', 'session_discount', $year);   
                $this->session->set_flashdata('success', '<strong>Success ! </strong> Special Discount Reason Added Successfully. ');
                redirect('account/addfeediscount');
            }
        }
    }
     //this function will use edit Special discount reason 
    public function edit_Special_discount(){
        $year= date('Y');  
        if($this->input->post('submit', TRUE)){
            $spl_id = $this->input->post('spl_id', TRUE);  
            $editdiscount = array( 
                'session_discount' => $this->db->escape_like_str($year), 
                'special_dis_reason' => $this->db->escape_like_str($this->input->post('first_dis_reason', TRUE)),
                'discount_type' => $this->db->escape_like_str($this->input->post('class', TRUE)),
                'special_tution_dis' => $this->db->escape_like_str($this->input->post('first_tu_dis', TRUE)), 
                'special_dis_month' => $this->db->escape_like_str($this->input->post('first_disc_month', TRUE)), 
                'status' => $this->db->escape_like_str($this->input->post('status', TRUE)), 
                'created_by' => $this->db->escape_like_str($this->input->post('created_by', TRUE)), 
            );   
            $this->db->where('spl_id', $spl_id);
            if ($this->db->update('special_fee_discount', $editdiscount)) {  
                // $data['fee_discount'] = $this->common->getWhere('fee_discount', 'session_discount', $year);   
                $this->session->set_flashdata('success', '<strong>Success ! </strong> Special Discount Reason Edit Successfully. ');
                redirect('account/addfeediscount');
            }
            //redirect('account/addfeediscount', 'refresh');
        }
        else{
            $id = $this->input->get('spl_id');
            $data['class'] = $this->common->getAllData('class');
            $data['special_discount'] = $this->common->getWhere('special_fee_discount', 'spl_id', $id); 
            $this->load->view('temp/header');
            $this->load->view('edit_special_discount', $data);
            $this->load->view('temp/footer'); 
        }
    }

}
