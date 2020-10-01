<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Examination extends MX_Controller {

    /**
     * This controller is using for 
     *
     * Maps to the following URL
     * 		http://example.com/index.php/examination
     * 	- or -  
     * 		http://example.com/index.php/examination/<method_name>
     */
    function __construct() {
        parent::__construct();
        $this->lang->load('auth');
        $this->load->library('form_validation');
        $this->load->model('exammodel');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
    }
    //This function load all exam grade and point
    public function examGread() {
        $data['grade'] = $this->common->getAllData('exam_grade');
        $this->load->view('temp/header');
        $this->load->view('examGread', $data);
        $this->load->view('temp/footer');
    }
    //THis function add new exam grade
    public function addExamGread() {
        if ($this->input->post('submit', TRUE)) {
            $gradeName = $this->input->post('gradeName', TRUE);
            $gradePoint = $this->input->post('gradePoint', TRUE);
            $numberFrom = $this->input->post('numberFrom', TRUE);
            $nameTo = $this->input->post('nameTo', TRUE);

            $data = array(
                'grade_name' => $this->db->escape_like_str($gradeName),
                'point' => $this->db->escape_like_str($gradePoint),
                'number_form' => $this->db->escape_like_str($numberFrom),
                'number_to' => $this->db->escape_like_str($nameTo)
            );
            $this->db->insert('exam_grade', $data);

            redirect('examination/examGread', 'refresh');
        } else {
            $this->load->view('temp/header');
            $this->load->view('addExamGrade');
            $this->load->view('temp/footer');
        }
    }
    //This function will edit exam grade and point
    public function editGrade() {
        $id = $this->input->get('id');
        if ($this->input->post('submit', TRUE)) {
            $gradeName = $this->input->post('gradeName', TRUE);
            $gradePoint = $this->input->post('gradePoint', TRUE);
            $numberFrom = $this->input->post('numberFrom', TRUE);
            $nameTo = $this->input->post('nameTo', TRUE);

            $editData = array(
                'grade_name' => $this->db->escape_like_str($gradeName),
                'point' => $this->db->escape_like_str($gradePoint),
                'number_form' => $this->db->escape_like_str($numberFrom),
                'number_to' => $this->db->escape_like_str($nameTo)
            );

            $this->db->where('id', $id);
            if ($this->db->update('exam_grade', $editData)) {
                redirect('examination/examGread', 'refresh');
            }
        } else {
            $data['gradInfo'] = $this->common->getWhere('exam_grade', 'id', $id);
            $this->load->view('temp/header');
            $this->load->view('editGrade', $data);
            $this->load->view('temp/footer');
        }
    }
    //This function can delete exam grade in this system
    public function deleteGrade() {
        $id = $this->input->get('id');
        if ($this->db->delete('exam_grade', array('id' => $id))) {
            redirect('examination/examGread', 'refresh');
        }
    }
    //This function is using for decleration new examination for nay class.
//This function is using for decleration new examination for nay class.
    public function addExam() {
        $data['s_class'] = $this->common->getAllData('class');
        if ($this->input->post('submit', TRUE)) {
            $examTitle = $this->input->post('examTitle', TRUE);
            $startDate = $this->input->post('startDate', TRUE);
            $weekdays = $this->input->post('weekdays', TRUE);
            $class_id = $this->input->post('class_id', TRUE);
            $section = $this->input->post('section', TRUE);
            $totleTime = $this->input->post('totleTime', TRUE);
            $examInfo = array(
                'year' => $this->db->escape_like_str(date('Y')),
                'exam_title' => $this->db->escape_like_str($examTitle),
                'start_date' => $this->db->escape_like_str($startDate),
                'day' => $this->db->escape_like_str($weekdays),
                'class_id' => $this->db->escape_like_str($class_id),
                'section' => $this->db->escape_like_str($section),
                'total_time' => $this->db->escape_like_str($totleTime),
                'publish' => $this->db->escape_like_str('Not Publish'),
                'final' => $this->db->escape_like_str($this->input->post('final', TRUE)),
                'status' => $this->db->escape_like_str('NoResult')
            );
            //Here is adding an exam information into database
            if ($this->db->insert('add_exam', $examInfo)) {
                $data['successMessage'] = '<div class="alert alert-success">
                                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                                <strong>' . lang('success') . '</strong> ' . lang('exac_1') . '" ' . $examTitle . ' " ' . lang('exac_2') . ' "' . $this->common->class_title($class_id) . '" '." and Section ".$section.' '. lang('exac_3') . '
                                        </div>';
                $data['examInfo'] = $this->common->getAllData('add_exam');
                $data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
                $data['weeklyDay'] = $this->common->getAllData('config_week_day');
                $this->load->view('temp/header');
                $this->load->view('addRutinSubject', $data);
                $this->load->view('temp/footer');
            }
        } else {
            $this->load->view('temp/header');
            $this->load->view('addExamRutine', $data);
            $this->load->view('temp/footer');
        }
    }
    //This function will perfome display class section
    public function ajaxSelectClass(){
        $class_id = $this->input->get('q');
        $query = $this->common->getWhere('class', 'id', $class_id);
        foreach ($query as $row) {
            $data = $row;
        }
        echo '<input type="hidden" name="class" value="' . $class_id . '" readonly>';
        if (!empty($data['section'])) {
            $section = $data['section'];
            $sectionArray = explode(",", $section);
           /* $i = 0;
            foreach ($sectionArray as $se) {
                $i++;
            }
            for ($a = 1; $a <= $i; $a++) {
                }
            $b = $a - 1;*/
                echo '<div class="form-group">
                        <label class="col-md-3 control-label">'.lang('clasc_3').'<span class="requiredStar"> * </span></label>
                        <div class="col-md-6">
                            <select name="section" class="form-control" data-validation="required" data-validation-error-msg="">
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
    //This function will complete an exam routine after decletration that exam.
    public function completExamRoutin() {
        if ($this->input->post('submit', TRUE)) {
            $examId = $this->input->post('examId', TRUE);
            $class_id = $this->input->post('class_id', TRUE); 
            //this is the 1st subject's informations for this exam rutine
            if ($this->input->post('examSubjectFild', TRUE)) {
                $examDate = $this->input->post('examDate', TRUE);
                $day = $this->input->post('day', TRUE);
                $subject = $this->input->post('subject', TRUE);
                $subjectCode = $this->input->post('subjectCode', TRUE);
                $romeNo = $this->input->post('romeNo', TRUE);
                $starTima = $this->input->post('starTima', TRUE);
                $endTima = $this->input->post('endTima', TRUE);
                $examShift = $this->input->post('examShift', TRUE);
                $routine = array(
                    'exam_id' => $this->db->escape_like_str($examId),
                    'class_id' => $this->db->escape_like_str($class_id),
                    'exam_date' => $this->db->escape_like_str($examDate),
                    'exam_day' => $this->db->escape_like_str($day),
                    'exam_subject' => $this->db->escape_like_str($subject),
                    //'subject_code' => $this->db->escape_like_str($subjectCode),
                    'rome_number' => $this->db->escape_like_str($romeNo),
                    'start_time' => $this->db->escape_like_str($starTima),
                    'end_time' => $this->db->escape_like_str($endTima),
                    'exam_shift' => $this->db->escape_like_str($examShift),
                    'status' => $this->db->escape_like_str('NoResult')
                );
                //insert this subject information into the database.
                $this->db->insert('exam_routine', $routine);
            }
            //this is the 2nd subject's informations for this exam rutine
            if ($this->input->post('examSubjectFild_2', TRUE)) {
                $examDate = $this->input->post('examDate_2', TRUE);
                $day = $this->input->post('day_2', TRUE);
                $subject = $this->input->post('subject_2', TRUE);
                $subjectCode = $this->input->post('subjectCode_2', TRUE);
                $romeNo = $this->input->post('romeNo_2', TRUE);
                $starTima = $this->input->post('starTima_2', TRUE);
                $endTima = $this->input->post('endTima_2', TRUE);
                $examShift = $this->input->post('examShift_2', TRUE);
                $routine = array(
                    'exam_id' => $this->db->escape_like_str($examId),
                    'class_id' => $this->db->escape_like_str($class_id),
                    'exam_date' => $this->db->escape_like_str($examDate),
                    'exam_day' => $this->db->escape_like_str($day),
                    'exam_subject' => $this->db->escape_like_str($subject),
                    //'subject_code' => $this->db->escape_like_str($subjectCode),
                    'rome_number' => $this->db->escape_like_str($romeNo),
                    'start_time' => $this->db->escape_like_str($starTima),
                    'end_time' => $this->db->escape_like_str($endTima),
                    'exam_shift' => $this->db->escape_like_str($examShift),
                    'status' => $this->db->escape_like_str('NoResult')
                );
                //insert this subject information into the database.
                $this->db->insert('exam_routine', $routine);

            }
            //this is the 3rd subject's informations for this exam rutine
            if ($this->input->post('examSubjectFild_3', TRUE)) {
                $examDate = $this->input->post('examDate_3', TRUE);
                $day = $this->input->post('day_3', TRUE);
                $subject = $this->input->post('subject_3', TRUE);
                $subjectCode = $this->input->post('subjectCode_3', TRUE);
                $romeNo = $this->input->post('romeNo_3', TRUE);
                $starTima = $this->input->post('starTima_3', TRUE);
                $endTima = $this->input->post('endTima_3', TRUE);
                $examShift = $this->input->post('examShift_3', TRUE);
                $routine = array(
                    'exam_id' => $this->db->escape_like_str($examId),
                    'class_id' => $this->db->escape_like_str($class_id),
                    'exam_date' => $this->db->escape_like_str($examDate),
                    'exam_day' => $this->db->escape_like_str($day),
                    'exam_subject' => $this->db->escape_like_str($subject),
                    //'subject_code' => $this->db->escape_like_str($subjectCode),
                    'rome_number' => $this->db->escape_like_str($romeNo),
                    'start_time' => $this->db->escape_like_str($starTima),
                    'end_time' => $this->db->escape_like_str($endTima),
                    'exam_shift' => $this->db->escape_like_str($examShift),
                    'status' => $this->db->escape_like_str('NoResult')
                );
                //insert this subject information into the database.
                $this->db->insert('exam_routine', $routine);
            }
            //this is the 4th subject's informations for this exam rutine
            if ($this->input->post('examSubjectFild_4', TRUE)) {
                $examDate = $this->input->post('examDate_4', TRUE);
                $day = $this->input->post('day_4', TRUE);
                $subject = $this->input->post('subject_4', TRUE);
                $subjectCode = $this->input->post('subjectCode_4', TRUE);
                $romeNo = $this->input->post('romeNo_4', TRUE);
                $starTima = $this->input->post('starTima_4', TRUE);
                $endTima = $this->input->post('endTima_4', TRUE);
                $examShift = $this->input->post('examShift_4', TRUE);
                $routine = array(
                    'exam_id' => $this->db->escape_like_str($examId),
                    'class_id' => $this->db->escape_like_str($class_id),
                    'exam_date' => $this->db->escape_like_str($examDate),
                    'exam_day' => $this->db->escape_like_str($day),
                    'exam_subject' => $this->db->escape_like_str($subject),
                    //'subject_code' => $this->db->escape_like_str($subjectCode),
                    'rome_number' => $this->db->escape_like_str($romeNo),
                    'start_time' => $this->db->escape_like_str($starTima),
                    'end_time' => $this->db->escape_like_str($endTima),
                    'exam_shift' => $this->db->escape_like_str($examShift),
                    'status' => $this->db->escape_like_str('NoResult')
                );
                //insert this subject information into the database.
                $this->db->insert('exam_routine', $routine);
            }
            //this is the 5th subject's informations for this exam rutine
            if ($this->input->post('examSubjectFild_5', TRUE)) {
                $examDate = $this->input->post('examDate_5', TRUE);
                $day = $this->input->post('day_5', TRUE);
                $subject = $this->input->post('subject_5', TRUE);
                $subjectCode = $this->input->post('subjectCode_5', TRUE);
                $romeNo = $this->input->post('romeNo_5', TRUE);
                $starTima = $this->input->post('starTima_5', TRUE);
                $endTima = $this->input->post('endTima_5', TRUE);
                $examShift = $this->input->post('examShift_5', TRUE);
                $routine = array(
                    'exam_id' => $this->db->escape_like_str($examId),
                    'class_id' => $this->db->escape_like_str($class_id),
                    'exam_date' => $this->db->escape_like_str($examDate),
                    'exam_day' => $this->db->escape_like_str($day),
                    'exam_subject' => $this->db->escape_like_str($subject),
                    //'subject_code' => $this->db->escape_like_str($subjectCode),
                    'rome_number' => $this->db->escape_like_str($romeNo),
                    'start_time' => $this->db->escape_like_str($starTima),
                    'end_time' => $this->db->escape_like_str($endTima),
                    'exam_shift' => $this->db->escape_like_str($examShift),
                    'status' => $this->db->escape_like_str('NoResult')
                );
                //insert this subject information into the database.
                $this->db->insert('exam_routine', $routine);
            }
            //this is the 6th subject's informations for this exam rutine
            if ($this->input->post('examSubjectFild_6', TRUE)) {
                $examDate = $this->input->post('examDate_6', TRUE);
                $day = $this->input->post('day_6', TRUE);
                $subject = $this->input->post('subject_6', TRUE);
                $subjectCode = $this->input->post('subjectCode_6', TRUE);
                $romeNo = $this->input->post('romeNo_6', TRUE);
                $starTima = $this->input->post('starTima_6', TRUE);
                $endTima = $this->input->post('endTima_6', TRUE);
                $examShift = $this->input->post('examShift_6', TRUE);
                $routine = array(
                    'exam_id' => $this->db->escape_like_str($examId),
                    'exam_date' => $this->db->escape_like_str($examDate),
                    'exam_day' => $this->db->escape_like_str($day),
                    'exam_subject' => $this->db->escape_like_str($subject),
                    //'subject_code' => $this->db->escape_like_str($subjectCode),
                    'rome_number' => $this->db->escape_like_str($romeNo),
                    'start_time' => $this->db->escape_like_str($starTima),
                    'end_time' => $this->db->escape_like_str($endTima),
                    'exam_shift' => $this->db->escape_like_str($examShift),
                    'status' => $this->db->escape_like_str('NoResult')
                );
                //insert this subject information into the database.
                $this->db->insert('exam_routine', $routine);
            }
            //this is the 7th subject's informations for this exam rutine
            if ($this->input->post('examSubjectFild_7', TRUE)) {
                $examDate = $this->input->post('examDate_7', TRUE);
                $day = $this->input->post('day_7', TRUE);
                $subject = $this->input->post('subject_7', TRUE);
                $subjectCode = $this->input->post('subjectCode_7', TRUE);
                $romeNo = $this->input->post('romeNo_7', TRUE);
                $starTima = $this->input->post('starTima_7', TRUE);
                $endTima = $this->input->post('endTima_7', TRUE);
                $examShift = $this->input->post('examShift_7', TRUE);
                $routine = array(
                    'exam_id' => $this->db->escape_like_str($examId),
                    'class_id' => $this->db->escape_like_str($class_id),
                    'exam_date' => $this->db->escape_like_str($examDate),
                    'exam_day' => $this->db->escape_like_str($day),
                    'exam_subject' => $this->db->escape_like_str($subject),
                    //'subject_code' => $this->db->escape_like_str($subjectCode),
                    'rome_number' => $this->db->escape_like_str($romeNo),
                    'start_time' => $this->db->escape_like_str($starTima),
                    'end_time' => $this->db->escape_like_str($endTima),
                    'exam_shift' => $this->db->escape_like_str($examShift),
                    'status' => $this->db->escape_like_str('NoResult')
                );
                //insert this subject information into the database.
                $this->db->insert('exam_routine', $routine);
            }
            //this is the 8th subject's informations for this exam rutine
            if ($this->input->post('examSubjectFild_8', TRUE)) {
                $examDate = $this->input->post('examDate_8', TRUE);
                $day = $this->input->post('day_8', TRUE);
                $subject = $this->input->post('subject_8', TRUE);
                $subjectCode = $this->input->post('subjectCode_8', TRUE);
                $romeNo = $this->input->post('romeNo_8', TRUE);
                $starTima = $this->input->post('starTima_8', TRUE);
                $endTima = $this->input->post('endTima_8', TRUE);
                $examShift = $this->input->post('examShift_8', TRUE);
                $routine = array(
                    'exam_id' => $this->db->escape_like_str($examId),
                    'class_id' => $this->db->escape_like_str($class_id),
                    'exam_date' => $this->db->escape_like_str($examDate),
                    'exam_day' => $this->db->escape_like_str($day),
                    'exam_subject' => $this->db->escape_like_str($subject),
                    //'subject_code' => $this->db->escape_like_str($subjectCode),
                    'rome_number' => $this->db->escape_like_str($romeNo),
                    'start_time' => $this->db->escape_like_str($starTima),
                    'end_time' => $this->db->escape_like_str($endTima),
                    'exam_shift' => $this->db->escape_like_str($examShift),
                    'status' => $this->db->escape_like_str('NoResult')
                );
                //insert this subject information into the database.
                $this->db->insert('exam_routine', $routine);
            }
            //this is the 9th subject's informations for this exam rutine
            if ($this->input->post('examSubjectFild_9', TRUE)) {
                $examDate = $this->input->post('examDate_9', TRUE);
                $day = $this->input->post('day_9', TRUE);
                $subject = $this->input->post('subject_9', TRUE);
                $subjectCode = $this->input->post('subjectCode_9', TRUE);
                $romeNo = $this->input->post('romeNo_9', TRUE);
                $starTima = $this->input->post('starTima_9', TRUE);
                $endTima = $this->input->post('endTima_9', TRUE);
                $examShift = $this->input->post('examShift_9', TRUE);
                $routine = array(
                    'exam_id' => $this->db->escape_like_str($examId),
                    'class_id' => $this->db->escape_like_str($class_id),
                    'exam_date' => $this->db->escape_like_str($examDate),
                    'exam_day' => $this->db->escape_like_str($day),
                    'exam_subject' => $this->db->escape_like_str($subject),
                    //'subject_code' => $this->db->escape_like_str($subjectCode),
                    'rome_number' => $this->db->escape_like_str($romeNo),
                    'start_time' => $this->db->escape_like_str($starTima),
                    'end_time' => $this->db->escape_like_str($endTima),
                    'exam_shift' => $this->db->escape_like_str($examShift),
                    'status' => $this->db->escape_like_str('NoResult')
                );
                //insert this subject information into the database.
                $this->db->insert('exam_routine', $routine);
            }
            //this is the 10th subject's informations for this exam rutine
            if ($this->input->post('examSubjectFild_10', TRUE)) {
                $examDate = $this->input->post('examDate_10', TRUE);
                $day = $this->input->post('day_10', TRUE);
                $subject = $this->input->post('subject_10', TRUE);
                $subjectCode = $this->input->post('subjectCode_10', TRUE);
                $romeNo = $this->input->post('romeNo_10', TRUE);
                $starTima = $this->input->post('starTima_10', TRUE);
                $endTima = $this->input->post('endTima_10', TRUE);
                $examShift = $this->input->post('examShift_10', TRUE);
                $routine = array(
                    'exam_id' => $this->db->escape_like_str($examId),
                    'class_id' => $this->db->escape_like_str($class_id),
                    'exam_date' => $this->db->escape_like_str($examDate),
                    'exam_day' => $this->db->escape_like_str($day),
                    'exam_subject' => $this->db->escape_like_str($subject),
                    //'subject_code' => $this->db->escape_like_str($subjectCode),
                    'rome_number' => $this->db->escape_like_str($romeNo),
                    'start_time' => $this->db->escape_like_str($starTima),
                    'end_time' => $this->db->escape_like_str($endTima),
                    'exam_shift' => $this->db->escape_like_str($examShift),
                    'status' => $this->db->escape_like_str('NoResult')
                );
                //insert this subject information into the database.
                $this->db->insert('exam_routine', $routine);
            }
            //this is the 11th subject's informations for this exam rutine
            if ($this->input->post('examSubjectFild_11', TRUE)) {
                $examDate = $this->input->post('examDate_11', TRUE);
                $day = $this->input->post('day_11', TRUE);
                $subject = $this->input->post('subject_11', TRUE);
                $subjectCode = $this->input->post('subjectCode_11', TRUE);
                $romeNo = $this->input->post('romeNo_11', TRUE);
                $starTima = $this->input->post('starTima_11', TRUE);
                $endTima = $this->input->post('endTima_11', TRUE);
                $examShift = $this->input->post('examShift_11', TRUE);
                $routine = array(
                    'exam_id' => $this->db->escape_like_str($examId),
                    'class_id' => $this->db->escape_like_str($class_id),
                    'exam_date' => $this->db->escape_like_str($examDate),
                    'exam_day' => $this->db->escape_like_str($day),
                    'exam_subject' => $this->db->escape_like_str($subject),
                    //'subject_code' => $this->db->escape_like_str($subjectCode),
                    'rome_number' => $this->db->escape_like_str($romeNo),
                    'start_time' => $this->db->escape_like_str($starTima),
                    'end_time' => $this->db->escape_like_str($endTima),
                    'exam_shift' => $this->db->escape_like_str($examShift),
                    'status' => $this->db->escape_like_str('NoResult')
                );
                //insert this subject information into the database.
                $this->db->insert('exam_routine', $routine);
            }
            //this is the 12th subject's informations for this exam rutine
            if ($this->input->post('examSubjectFild_12', TRUE)) {
                $examDate = $this->input->post('examDate_12', TRUE);
                $day = $this->input->post('day_12', TRUE);
                $subject = $this->input->post('subject_12', TRUE);
                $subjectCode = $this->input->post('subjectCode_12', TRUE);
                $romeNo = $this->input->post('romeNo_12', TRUE);
                $starTima = $this->input->post('starTima_12', TRUE);
                $endTima = $this->input->post('endTima_12', TRUE);
                $examShift = $this->input->post('examShift_12', TRUE);
                $routine = array(
                    'exam_id' => $this->db->escape_like_str($examId),
                    'class_id' => $this->db->escape_like_str($class_id),
                    'exam_date' => $this->db->escape_like_str($examDate),
                    'exam_day' => $this->db->escape_like_str($day),
                    'exam_subject' => $this->db->escape_like_str($subject),
                    //'subject_code' => $this->db->escape_like_str($subjectCode),
                    'rome_number' => $this->db->escape_like_str($romeNo),
                    'start_time' => $this->db->escape_like_str($starTima),
                    'end_time' => $this->db->escape_like_str($endTima),
                    'exam_shift' => $this->db->escape_like_str($examShift),
                    'status' => $this->db->escape_like_str('NoResult')
                );
                //insert this subject information into the database.
                $this->db->insert('exam_routine', $routine);
            }
            //this is the 13th subject's informations for this exam rutine
            if ($this->input->post('examSubjectFild_13', TRUE)) {
                $examDate = $this->input->post('examDate_13', TRUE);
                $day = $this->input->post('day_13', TRUE);
                $subject = $this->input->post('subject_13', TRUE);
                $subjectCode = $this->input->post('subjectCode_13', TRUE);
                $romeNo = $this->input->post('romeNo_13', TRUE);
                $starTima = $this->input->post('starTima_13', TRUE);
                $endTima = $this->input->post('endTima_13', TRUE);
                $examShift = $this->input->post('examShift_13', TRUE);
                $routine = array(
                    'exam_id' => $this->db->escape_like_str($examId),
                    'class_id' => $this->db->escape_like_str($class_id),
                    'exam_date' => $this->db->escape_like_str($examDate),
                    'exam_day' => $this->db->escape_like_str($day),
                    'exam_subject' => $this->db->escape_like_str($subject),
                    //'subject_code' => $this->db->escape_like_str($subjectCode),
                    'rome_number' => $this->db->escape_like_str($romeNo),
                    'start_time' => $this->db->escape_like_str($starTima),
                    'end_time' => $this->db->escape_like_str($endTima),
                    'exam_shift' => $this->db->escape_like_str($examShift),
                    'status' => $this->db->escape_like_str('NoResult')
                );
                //insert this subject information into the database.
                $this->db->insert('exam_routine', $routine);
            }
            //this is the 14th subject's informations for this exam rutine
            if ($this->input->post('examSubjectFild_14', TRUE)) {
                $examDate = $this->input->post('examDate_14', TRUE);
                $day = $this->input->post('day_14', TRUE);
                $subject = $this->input->post('subject_14', TRUE);
                $subjectCode = $this->input->post('subjectCode_14', TRUE);
                $romeNo = $this->input->post('romeNo_14', TRUE);
                $starTima = $this->input->post('starTima_14', TRUE);
                $endTima = $this->input->post('endTima_14', TRUE);
                $examShift = $this->input->post('examShift_14', TRUE);
                $routine = array(
                    'exam_id' => $this->db->escape_like_str($examId),
                    'class_id' => $this->db->escape_like_str($class_id),
                    'exam_date' => $this->db->escape_like_str($examDate),
                    'exam_day' => $this->db->escape_like_str($day),
                    'exam_subject' => $this->db->escape_like_str($subject),
                    //'subject_code' => $this->db->escape_like_str($subjectCode),
                    'rome_number' => $this->db->escape_like_str($romeNo),
                    'start_time' => $this->db->escape_like_str($starTima),
                    'end_time' => $this->db->escape_like_str($endTima),
                    'exam_shift' => $this->db->escape_like_str($examShift),
                    'status' => $this->db->escape_like_str('NoResult')
                );
                //insert this subject information into the database.
                $this->db->insert('exam_routine', $routine);
            }
            //this is the 15th subject's informations for this exam rutine
            if ($this->input->post('examSubjectFild_15', TRUE)) {
                $examDate = $this->input->post('examDate_15', TRUE);
                $day = $this->input->post('day_15', TRUE);
                $subject = $this->input->post('subject_15', TRUE);
                $subjectCode = $this->input->post('subjectCode_15', TRUE);
                $romeNo = $this->input->post('romeNo_15', TRUE);
                $starTima = $this->input->post('starTima_15', TRUE);
                $endTima = $this->input->post('endTima_15', TRUE);
                $examShift = $this->input->post('examShift_15', TRUE);
                $routine = array(
                    'exam_id' => $this->db->escape_like_str($examId),
                    'class_id' => $this->db->escape_like_str($class_id),
                    'exam_date' => $this->db->escape_like_str($examDate),
                    'exam_day' => $this->db->escape_like_str($day),
                    'exam_subject' => $this->db->escape_like_str($subject),
                    //'subject_code' => $this->db->escape_like_str($subjectCode),
                    'rome_number' => $this->db->escape_like_str($romeNo),
                    'start_time' => $this->db->escape_like_str($starTima),
                    'end_time' => $this->db->escape_like_str($endTima),
                    'exam_shift' => $this->db->escape_like_str($examShift),
                    'status' => $this->db->escape_like_str('NoResult')
                );
                //insert this subject information into the database.
                $this->db->insert('exam_routine', $routine);
            }
            $data['rutineInfo'] = $this->common->getWhere('exam_routine', 'exam_id', $examId);
            $data['examInfo'] = $this->common->getWhere('add_exam', 'id', $examId);
            $data['schoolName'] = $this->common->schoolName();
            $this->load->view('temp/header');
            $this->load->view('rutineSuccess', $data);
            $this->load->view('temp/footer');
        }
    }
    //This function can delete exam and exam routine
    public function deleteExamAndRoutine() {
        $examId = $this->input->get('examId', TRUE);
        if ($this->db->delete('add_exam', array('id' => $examId))) {
            if ($this->db->delete('exam_routine', array('exam_id' => $examId))) {
                redirect('examination/allExamRutine', 'refresh');
            }
        }
    }
    //This function will select that which exam routine 
    public function allExamRutine() {
        $data['s_class'] = $this->common->getAllData('class');
        $this->load->view('temp/header');
        $this->load->view('selectAllRoutine', $data);
        $this->load->view('temp/footer');
    }
    public function completeDateSheet() {
         $data['sheet'] = $this->common->getAllData('exam_date_sheet');
        $this->load->view('temp/header');
        $this->load->view('completeDateSheet', $data);
        $this->load->view('temp/footer');
    }
    public function deleteDateSheet() {
        $data['sheet'] = $this->db->empty_table('exam_date_sheet');
         $this->load->view('temp/header');
        $this->load->view('completeDateSheet',$data);
        $this->load->view('temp/footer');
    }
    public function dateSheet() {
         if ($this->input->post('submit', TRUE)) {
            //$this->load->database();
            $examDate = $this->input->post('examDate', TRUE);
            $tables = $this->config->item('tables', 'ion_auth');
            $play = '';
            $dd_1 = $this->input->post('subject_playgroup', TRUE);
            if (!empty($dd_1)) {
                $this->form_validation->set_rules('subject_playgroup_1', 'must Unique', 'required', 'is_unique');
                $nurs = $this->input->post('subject_playgroup', TRUE) . ',' . $this->input->post('subject_playgroup_1', TRUE) . ',' . $this->input->post('subject_playgroup_2', TRUE);
                
           }
            $nurs = '';
            $dd_2 = $this->input->post('subject_nursery', TRUE);
            if (!empty($dd_2)) {
                $this->form_validation->set_rules('subject_nursery_1', 'must Unique', 'required', 'is_unique');
                $nursery = $this->input->post('subject_nursery', TRUE) . ',' . $this->input->post('subject_nursery_1', TRUE). ',' . $this->input->post('subject_nursery_2', TRUE);
            }
                $prep = '';
                $tables = $this->config->item('tables', 'ion_auth');
            $dd_3 = $this->input->post('subject_prep', TRUE);
            if (!empty($dd_3)) {
                $this->form_validation->set_rules('subject_prep_1', 'must Unique', 'required', 'is_unique');
                $prep = $this->input->post('subject_prep', TRUE) . ',' . $this->input->post('subject_prep_1', TRUE). ',' . $this->input->post('subject_prep_2', TRUE);
            }
                $one = '';
            $dd_4 = $this->input->post('subject_one', TRUE);
            if (!empty($dd_4)) {
                $this->form_validation->set_rules('subject_one_1', 'must Unique', 'required', 'is_unique');
                $one = $this->input->post('subject_one', TRUE) . ',' . $this->input->post('subject_one_1', TRUE). ',' . $this->input->post('subject_one_2', TRUE);
            }
                $two = '';
            $dd_5 = $this->input->post('subject_two', TRUE);
            if (!empty($dd_5)) {
                $this->form_validation->set_rules('subject_two_1', 'must Unique', 'required', 'is_unique');
                $two = $this->input->post('subject_two', TRUE) . ',' . $this->input->post('subject_two_1', TRUE). ',' . $this->input->post('subject_two_2', TRUE);
            }
                $three = '';
            $dd_6 = $this->input->post('subject_three', TRUE);
            if (!empty($dd_6)) {
                $this->form_validation->set_rules('subject_three_1', 'must Unique', 'required', 'is_unique');
                $three = $this->input->post('subject_three', TRUE) . ',' . $this->input->post('subject_three_1', TRUE). ',' . $this->input->post('subject_three_2', TRUE);
            }
                $four = '';
            $dd_7 = $this->input->post('subject_four', TRUE);
            if (!empty($dd_7)) {
                $this->form_validation->set_rules('subject_four_1', 'must Unique', 'required', 'is_unique');
                $four = $this->input->post('subject_four', TRUE) . ',' . $this->input->post('subject_four_1', TRUE). ',' . $this->input->post('subject_four_2', TRUE);
            }
                $five = '';
            $dd_8 = $this->input->post('subject_five', TRUE);
            if (!empty($dd_8)) {
                $this->form_validation->set_rules('subject_five_1', 'must Unique', 'required', 'is_unique');
                $five = $this->input->post('subject_five', TRUE) . ',' . $this->input->post('subject_five_1', TRUE). ',' . $this->input->post('subject_five_2', TRUE);
            }
                $six = '';
            $dd_9 = $this->input->post('subject_six', TRUE);
            if (!empty($dd_9)) {
                $this->form_validation->set_rules('subject_six_1', 'must Unique', 'required', 'is_unique');
                $six = $this->input->post('subject_six', TRUE) . ',' . $this->input->post('subject_six_1', TRUE). ',' . $this->input->post('subject_six_2', TRUE);
            }
                $seven = '';
            $dd_10 = $this->input->post('subject_seven', TRUE);
            if (!empty($dd_10)) {
                $this->form_validation->set_rules('subject_seven_1', 'must Unique', 'required', 'is_unique');
                $seven = $this->input->post('subject_seven', TRUE) . ',' . $this->input->post('subject_seven_1', TRUE). ',' . $this->input->post('subject_seven_2', TRUE);
            }
                $routine = array(
                    
                    'exam_date' => $this->db->escape_like_str($examDate),
                    'playgroup' => $this->db->escape_like_str($play),
                    'nursery' => $this->db->escape_like_str($nurs),
                    'prep' => $this->db->escape_like_str($prep),
                    'one' => $this->db->escape_like_str($one),
                    'two' => $this->db->escape_like_str($two),
                    'three' => $this->db->escape_like_str($three),
                    'four' => $this->db->escape_like_str($four),
                    'five' => $this->db->escape_like_str($five),
                    'six' => $this->db->escape_like_str($six),
                    'seven' => $this->db->escape_like_str($seven),
                );
                //insert this subject information into the database.
                $this->db->insert('exam_date_sheet', $routine);
          // $data['sheet'] = $this->common->getAllData('exam_date_sheet');
            $this->load->view('temp/header');
            $this->load->view('dateSheet');
            $this->load->view('temp/footer');
        }
        else{
        //$data['sheet'] = $this->common->getAllData('exam_date_sheet');
        $query = $this->db->query("SELECT subject_title FROM class_subject where class_id = 1");
        $data['sheet1']= $query->result_array();

        /*$query = $this->db->query("SELECT subject FROM class_routine where class_id = 2");
        $data['sheet2']= $query->result_array();
        $query = $this->db->query("SELECT subject FROM class_routine where class_id = 3");
        $data['sheet3']= $query->result_array();
        $query = $this->db->query("SELECT subject FROM class_routine where class_id = 4");
        $data['sheet4']= $query->result_array();
        $query = $this->db->query("SELECT subject FROM class_routine where class_id = 5");
        $data['sheet5']= $query->result_array();
        $query = $this->db->query("SELECT subject FROM class_routine where class_id = 6");
        $data['sheet6']= $query->result_array();
        $query = $this->db->query("SELECT subject FROM class_routine where class_id = 7");
        $data['sheet7']= $query->result_array();
        $query = $this->db->query("SELECT subject FROM class_routine where class_id = 8");
        $data['sheet8']= $query->result_array();
        $query = $this->db->query("SELECT subject FROM class_routine where class_id = 9");
        $data['sheet9']= $query->result_array();
        $query = $this->db->query("SELECT subject FROM class_routine where class_id = 10");
        $data['sheet10']= $query->result_array();
        $query = $this->db->query("SELECT subject FROM class_routine where class_id = 11");
        $data['sheet11']= $query->result_array();
        $query = $this->db->query("SELECT subject FROM class_routine where class_id = 12");
        $data['sheet12']= $query->result_array();*/

        //$query = $this->db->query("SELECT exam_date FROM class_routine Group By exam_date");
        // $data['sheet']= $query->result_array();
        // $data['examInfo'] = $this->common->getAllData('add_exam');

        $this->load->view('temp/header');
        $this->load->view('dateSheet', $data);
        $this->load->view('temp/footer');
        }
    }
    //This function load class's section and exam title which is declard previously by class title.
    public function ajaxClassSectionExam() {
        $class_id = $this->input->get('q');
        $query1 = $this->db->query("SELECT section FROM class where id = $class_id");
            $section = $query1->result_array(); 
            
                $section1 =$section[0]['section'];
            if (!empty($section1)) {    
                $class_section = explode(",", $section1);
                echo'<div class="form-group">
                        <label class="col-md-3 control-label"> Class Section <span class="requiredStar"> * </span></label>
                        <div class="col-md-6">
                            <select name="section" id="section" class="form-control" required="required" onchange="selectSection()">
                              <option value=""> Select...</option>';
                foreach ($class_section as $cl_sec) {
                        echo' <option value="'.$cl_sec.'">'.$cl_sec.'</option>';
                        }
                echo'       </select>
                        </div>
                    </div>';
            } else {
                echo '<div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                        <div class="alert alert-warning">
                                <strong>' . lang('exac_info').'</strong>'." This class has no any Section added." .' 
                        </div></div></div>';
            }
    }
    public function ajaxSelectExam(){
        $class_id = $this->input->get('class_id');
        $section = $this->input->get('section');
        $year = date('Y');
        $query = $this->db->query("SELECT * FROM add_exam WHERE class_id='$class_id' AND section='$section' AND year=$year");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        if (!empty($data)) {
            echo '<div class="form-group">
                        <label class="col-md-3 control-label">' . lang('exac_4') . '<span class="requiredStar"> * </span></label>
                        <div class="col-md-6">
                            <select name="examId" class="form-control">
                            <option value="">Select...</option> ';
            foreach ($data as $sec) {
                echo '<option value="' . $sec['id'] . '">' . $sec['exam_title'] . '</option>';
            }
            echo '</select></div>
                    </div>';
        } else {
            echo '<div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                        <div class="alert alert-warning">
                                <strong>' . lang('exac_info') . '</strong> ' . lang('exac_5') . ' 
                        </div></div></div>';
        }
    }
    //This function load class's exam title which is declard previously by class title.
    public function ajaxClassExam() {
        $class_id = $this->input->get('q');
        $year = date('Y');
        $query = $this->db->query("SELECT * FROM add_exam WHERE class_id='$class_id' AND year=$year");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        if (!empty($data)) {
            echo '<div class="form-group">
                        <label class="col-md-3 control-label">' . lang('exac_4') . '<span class="requiredStar"> * </span></label>
                        <div class="col-md-6">
                            <select name="examId" class="form-control">
                            <option value="">Select...</option> ';
            foreach ($data as $sec) {
                echo '<option value="' . $sec['id'] . '">' . $sec['exam_title'] . '</option>';
            }
            echo '</select></div>
                    </div>';
        } else {
            echo '<div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                        <div class="alert alert-warning">
                                <strong>' . lang('exac_info') . '</strong> ' . lang('exac_5') . ' 
                        </div></div></div>';
        }
    }
    //This function show a success message when an Exam added and made this exam routine fully, with full rutine.
    public function routinView() {
        if ($this->input->post('submit', TRUE) && $this->input->post('examId', TRUE)) {
            $class_id = $this->input->post('class', TRUE);
            $section = $this->input->post('section', TRUE);
            $examId = $this->input->post('examId', TRUE);
            
            $query = $this->db->query("SELECT * FROM add_exam WHERE class_id='$class_id' AND section='$section' AND id='$examId'"); 
            foreach ($query->result_array() as $row) {
                $abc[] = $row;
            } 
            $query1 = $this->db->query("SELECT * FROM exam_routine WHERE class_id='$class_id' AND exam_id='$examId'");
                if(!empty($query)){
                foreach ($query1->result_array() as $row1) {
                    $xyz[] = $row1;
                }
                }
                elseif(empty($query)) {
                    $xyz[]="";
                }
            $data['examInfo'] = $abc;
            $data['rutineInfo'] = @$xyz; 
            //$data['rutineInfo'] = $this->common->getWhere('exam_routine', 'exam_id', $examId);
            //$data['examInfo'] = $this->common->getWhere('add_exam', 'id', $examId);
            $data['schoolName'] = $this->common->schoolName();
            $this->load->view('temp/header');
            $this->load->view('rutineSuccess', $data);
            $this->load->view('temp/footer');
        
         
        } else {
            $data['exam_alert'] = "Please Select <b>Class, Section </b> and <b>Examination</b> First. Try Again.";
            $this->load->view('temp/header');
            $this->load->view('examRoutineFail', $data);
            $this->load->view('temp/footer');
        }
    }
    //This function is using for select class and students for exam attendance.
    public function selectExamAttendance() {
        $data['s_class'] = $this->common->getAllData('class');
        $this->load->view('temp/header');
        $this->load->view('selectExamAttendance', $data);
        $this->load->view('temp/footer');
    }
    //This function is using for taking students by class title for exam attendence
    public function examAttendance() {
        $date = date("Y/m/d");
        if ($this->input->post('submit', TRUE)) {
            $examId = $this->input->get('id');
            $examTitle = $this->exammodel->examTitle($examId);
            $examSubject = $this->exammodel->examSubject($examId, $date);
            //Whene submit the attendence information after takeing the attendence
            $i = $this->input->post('in_velu', TRUE);
            $class_id = $this->input->post('class_id', TRUE);
            for ($x = 1; $x <= $i; $x++) {
                $roll = $this->input->post("roll_$x", TRUE);
                $name = $this->input->post("studentName_$x", TRUE);
                $present = $this->input->post("action_$x", TRUE);
                $userId = $this->input->post("userId_$x", TRUE);
                $studentInfoId = $this->input->post("studentInfoId_$x", TRUE);
                $section = $this->input->post("section_$x", TRUE);
                $data = array(
                    'date' => $this->db->escape_like_str($date),
                    'exam_title' => $this->db->escape_like_str($examTitle),
                    'exam_subject' => $this->db->escape_like_str($examSubject),
                    'user_id' => $this->db->escape_like_str($userId),
                    'student_id' => $this->db->escape_like_str($studentInfoId),
                    'roll_no' => $this->db->escape_like_str($roll),
                    'class_id' => $this->db->escape_like_str($class_id),
                    'section' => $this->db->escape_like_str($section),
                    'attendance' => $this->db->escape_like_str($present),
                    'student_title' => $this->db->escape_like_str($name),
                );
                //insert the $data information into "daily_attendance" database.
                $this->db->insert('exam_attendanc', $data);
            }
            //Whene Exam Attendance was full compleate then lode this page
            $data['previerAttendance'] = $this->exammodel->previewAttendance($class_id, $examTitle, $examSubject, $section);
            $data['classTitle'] = $this->common->class_title($class_id);
            $this->load->view('temp/header');
            $this->load->view('viewExamAttendance', $data);
            $this->load->view('temp/footer');
        } else {
            $class_id = $this->input->post('class', TRUE);
            $section = $this->input->post('section', TRUE);
            $examId = $this->input->post('examId', TRUE); 
            $examTitle = $this->exammodel->examTitle($examId); 
            $check = $this->exammodel->checkExam($examId, $date);
            if ($check == 'Have An Exam') {
                //Here is loding student for exam attendance.
                //Get here students and informations by class title.
                $queryData = array();
                //$query = $this->db->get_where('class_students', array('class_id' => $class_id, 'section'=>$section));
                $query = $this->db->query("SELECT * FROM class_students WHERE class_id='$class_id' AND section='$section' AND (status='Active' OR status='Defaulter')");
                foreach ($query->result_array() as $row) {
                    $queryData[] = $row;
                }
                $data['students'] = $queryData;
                $data['examId'] = $examId;
                $data['examTitle'] = $examTitle;
                $data['examSubject'] = $this->exammodel->examSubject($examId, $date);
                $data['classTitle'] = $this->common->class_title($class_id);
                if (!empty($data['students'])) {
                    $this->load->view('temp/header');
                    $this->load->view('examAttendance', $data);
                    $this->load->view('temp/footer');
                } else {
                    echo $classTitle . 'has no any student.';
                }
            } elseif ($check == 'No Any Exam') {
                $info['classTitle'] = $this->common->class_title($class_id);
                $this->load->view('temp/header');
                $this->load->view('attendanceFaild', $info);
                $this->load->view('temp/footer');
            }
        }
    }
    //This function load's exam attendance view
    public function viewExamAttendance() {
        if ($this->input->post('submit', TRUE)) {
            $classTitle = $this->input->post('class', TRUE);
            $section = $this->input->post('section', TRUE);
            $examTitle = $this->input->post('examTitle', TRUE);
            $subjectTitle = $this->input->post('subjectTitle', TRUE);
            $data['classTitle'] = $classTitle;
            $data['previerAttendance'] = $this->exammodel->previewAttendance($classTitle, $examTitle, $subjectTitle, $section);
            $this->load->view('temp/header');
            $this->load->view('viewExamAttendance', $data);
            $this->load->view('temp/footer');
        } else {
            $data['s_class'] = $this->common->getAllData('class');
            $this->load->view('temp/header');
            $this->load->view('allExamAttendanceView', $data);
            $this->load->view('temp/footer');
        }
    }
    //This function load class's section and exam title which is declard previously by class title.
    public function ajaxClassSection() {
        $class_id = $this->input->get('q');
        $query1 = $this->db->query("SELECT section FROM class where id = $class_id");
            $section = $query1->result_array(); 
            
                $section1 =$section[0]['section'];
            if (!empty($section1)) {    
                $class_section = explode(",", $section1);
                echo'<div class="form-group">
                        <label class="col-md-3 control-label"> Class Section <span class="requiredStar"> * </span></label>
                        <div class="col-md-6">
                            <select name="section" id="section" class="form-control" required="required" onchange="selectSection()">
                              <option value=""> Select...</option>';
                foreach ($class_section as $cl_sec) {
                        echo' <option value="'.$cl_sec.'">'.$cl_sec.'</option>';
                        }
                echo'       </select>
                        </div>
                    </div>';
            } else {
                echo '<div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                        <div class="alert alert-warning">
                                <strong>' . lang('exac_info').'</strong>'." This class has no any Section added." .' 
                        </div></div></div>';
            }
    }
    //This function is called by ajax from view
    public function ajaxAttendanceView() {
        $class_id = $this->input->get('class_id');
        $section = $this->input->get('section');
        $year = date('Y');
        $query = $this->db->query("SELECT * FROM add_exam WHERE class_id='$class_id' AND section='$section' AND year=$year");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        if (!empty($data)) {
            echo '<div class="form-group">
                        <label class="col-md-3 control-label">' . lang('exac_4') . '<span class="requiredStar"> * </span></label>
                        <div class="col-md-6">
                            <select name="examTitle" class="form-control">
                             <option value="">Select...</option>';
            foreach ($data as $sec) {
                echo '<option value="' . $sec['exam_title'] . '">' . $sec['exam_title'] . '</option>';
            }
            echo '</select></div>
                        </div>';
            $subject = $this->common->getWhere('class_subject', 'class_id', $class_id);
            if (!empty($subject)) {
                echo '<div class="form-group">
                    <label class="col-md-3 control-label">' . lang('exac_8') . ' <span class="requiredStar"> * </span></label>
                        <div class="col-md-6">
                        <select name="subjectTitle" class="form-control">
                        <option value="">Select...</option>';
                        foreach ($subject as $sub) {
                            echo '<option value="' . $sub['subject_title'] . '">' . $sub['subject_title'] . '</option>';
                        }
                        echo '</select></div>
                                    </div>';
                    } else {
                        echo '<div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-6">
                                    <div class="alert alert-warning">
                                            <strong>' . lang('exac_info') . '</strong> ' . lang('exac_9') . '
                                    </div></div></div>';
                    }
        } else {
            echo '<div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                        <div class="alert alert-warning">
                                <strong>' . lang('exac_info') . '</strong> ' . lang('exac_7') . '
                        </div></div></div>';
        }  
    }
    //The exam attendance can edit by this function.
    public function editExamAttendance() {
        $id = $this->input->get('id');
        if ($this->input->post('submit', TRUE)) {
            $updateInfo = array(
                'attendance' => $this->db->escape_like_str($this->input->post('action', TRUE))
            );
            $this->db->where('id', $id);
            if ($this->db->update('exam_attendanc', $updateInfo)) {
                redirect('examination/viewExamAttendance', 'refresh');
            }
        }
        $data['examAttendanceInf'] = $this->common->getWhere('exam_attendanc', 'id', $id);
        $this->load->view('temp/header');
        $this->load->view('editExamAttendance', $data);
        $this->load->view('temp/footer');
    }
    //Here is first time select class for result.
    public function makingResult() {
        if ($this->input->post('submit', TRUE)) {
            if($this->input->post('class_id', TRUE) && $this->input->post('examID', TRUE) && $this->input->post('subjRutID', TRUE)){
            $class_id = $this->input->post('class_id', TRUE);
            $data['class_id'] = $class_id;
            $data['examId'] = $this->input->post('examID', TRUE);
            $data['subjectTitle'] = $this->input->post('examSubjectTitle', TRUE);
            $data['examRUtinID'] = $this->input->post('subjRutID', TRUE);
            $data['teacherInfo'] = $this->exammodel->teacherInfo($this->input->post('teacherUserId', TRUE));
            
            $queryData = array();
            //$query = $this->db->get_where('class_students', array('class_id' => $class_id));
            $query = $this->db->query("SELECT * FROM class_students WHERE class_id='$class_id' AND (status='Active' OR status='Defaulter')");
            foreach ($query->result_array() as $row) {
                $queryData[] = $row;
            }

            $data['students'] = $queryData;

            $data['gread'] = $this->common->getAllData('exam_grade');
            $this->load->view('temp/header');
            $this->load->view('makingResult', $data);
            $this->load->view('temp/footer');
        } 
        else{ 
            echo "Please select class, examination and subject first for making result. Try again.";
        }
    }else {
            $data['s_class'] = $this->exammodel->getClassTitle();
            $this->load->view('temp/header');
            $this->load->view('selectClassResult', $data);
            $this->load->view('temp/footer');
        }
    }
    //This function will take class and give the class exam title and subject
    public function ajaxClassResult() {
        $class_id = $this->input->get('q');
        $data = $this->exammodel->examTitleRes($class_id);
        if (!empty($data)) {
            echo '<div class="form-group">
                        <label class="col-md-3 control-label">' . lang('exac_4') . ' <span class="requiredStar"> * </span></label>
                        <div class="col-md-6">
                            <select onchange="examSubject(this.value)" name="examID" class="form-control" data-validation="required" data-validation-error-msg="">
                            <option value="">' . lang('select') . '</option>';
            foreach ($data as $sec) {
                echo '<option value="' . $sec['id'] . '">' . $sec['exam_title'] . '</option>';
            }
            echo '</select></div>
                        </div><div id="ajaxResult_2"></div>';
        } else {
            echo '<div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                        <div class="alert alert-warning">
                                <strong>' . lang('exac_info') . '</strong> ' . lang('exac_10') . '
                        </div></div></div>';
        }
    }
    //This function will show via ajax examination subject which are not compleated result
    public function ajaxExamSubject() {
        $examID = $this->input->get('erid');
        $subject = $this->exammodel->examResSubject($examID);
        if (!empty($subject)) {
            echo '<div class="form-group">
                        <label class="col-md-3 control-label">' . lang('exac_8') . ' <span class="requiredStar"> * </span></label>
                        <div class="col-md-6">
                            <select onchange="examSubjectTitle(this.value)" name="subjRutID" class="form-control" data-validation="required" data-validation-error-msg="">
                            <option value="">' . lang('select') . '</option>';
            foreach ($subject as $sub) {
                echo '<option value="' . $sub['id'] . '">' . $sub['exam_subject'] . '</option>';
            }
            echo '</select></div>
                        </div><div id="ajaxResult_3"></div>';
        } else {
            echo '<div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                        <div class="alert alert-warning">
                                <strong>' . lang('exac_info') . '</strong> ' . lang('exac_11') . '
                        </div></div></div>';
        }
    }
    //This function will returan exam subject title 
    public function ajaxExamSubTitle() {
        $examId = $this->input->get('erid');
        $query = $this->db->query("SELECT exam_subject FROM exam_routine WHERE id='$examId'");
        foreach ($query->result_array() as $row) {
            $data = $row['exam_subject'];
            echo '<input type="hidden" name="examSubjectTitle" value="' . $row['exam_subject'] . '">';
        }
    }
    //This function will submit result from teacher.
    public function submitResult() {
        $i = $this->input->post('ivalue', TRUE);
        $examID = $this->input->post('examId', TRUE);
        $examTitle = $this->exammodel->examTitle($examID);
        $examRuId = $this->input->post('examRutinID', TRUE);
        $examSubject = $this->exammodel->examSubjectTitle($examRuId);
        $class_id = $this->input->post('class_id', TRUE);
        $teacherName = $this->input->post('teacherName', TRUE);
        //here is checking this subject is optionakl or not
        $date = date('d/m/Y');
        for ($a = 1; $a <= $i; $a++) {
            $rollNumber = $this->input->post("rollNumber_$a", TRUE);
            $result = $this->input->post("result_$a", TRUE);
            $greadInfo = $this->input->post("gread_$a", TRUE);
            
            $grade = explode(",", $greadInfo);
            $resultInfo = array(
                'exam_id' => $this->db->escape_like_str($examID),
                'exam_title' => $this->db->escape_like_str($examTitle),
                'class_id' => $this->db->escape_like_str($class_id),
                'student_name' => $this->db->escape_like_str($this->input->post("studentTitle_$a", TRUE)),
                'student_id' => $this->db->escape_like_str($this->input->post("studentId_$a", TRUE)),
                'roll_number' => $this->db->escape_like_str($this->input->post("rollNumber_$a", TRUE)),
                'exam_subject' => $this->db->escape_like_str($examSubject),
                'result' => $this->db->escape_like_str($this->input->post("result_$a", TRUE)),
                'mark' => $this->db->escape_like_str($this->input->post("obtainMark_$a", TRUE)),
                'total_mark' => $this->db->escape_like_str($this->input->post("totalMark_$a", TRUE)),
                'remark' => $this->db->escape_like_str($this->input->post("remark_$a", TRUE)),
                'grade' => $this->db->escape_like_str($grade[0]),
                //'point' => $this->db->escape_like_str($grade[1]),
            );
            $this->db->insert('result_shit', $resultInfo);
        }
        $submitInfo = array(
            'class_id' => $this->db->escape_like_str($class_id),
            'exam_title' => $this->db->escape_like_str($examTitle),
            'exam_id' => $this->db->escape_like_str($examID),
            'date' => $this->db->escape_like_str($date),
            'subject' => $this->db->escape_like_str($examSubject),
            'submited' => $this->db->escape_like_str(0),
            'teacher' => $this->db->escape_like_str($teacherName),
        );
        $subjectStatus = array(
            'status' => $this->db->escape_like_str('Result')
        );
        $this->db->where('id', $examRuId);
        $this->db->update('exam_routine', $subjectStatus);
        if ($this->db->insert('result_submition_info', $submitInfo)) {
            $data['examTitle'] = $examTitle;
            $data['examSubject'] = $examSubject;
            $data['teacherName'] = $teacherName;
            $data['class_id'] = $class_id;
            $this->load->view('temp/header');
            $this->load->view('submitMessage', $data);
            $this->load->view('temp/footer');
        }
    }
    //This function work only for admin.
    //He can view how many result shit was submited for aprove by admin.
    public function aproveShitView() {
        $data['shitList'] = $this->common->getWhere('result_submition_info', 'submited', 0);
        $data['classAction'] = $this->common->getWhere('result_action', 'status', 'Not Complete');
        $this->load->view('temp/header');
        $this->load->view('aproveShitView', $data);
        $this->load->view('temp/footer');
    }
    //This function can exes only admin and he can edit and Approve exam rtesult shit
    public function checkResultShit() {
        $id = $this->input->get('id', TRUE);
        $query = $this->common->getWhere('result_submition_info', 'id', $id);
        $examTitle = $query[0]['exam_title'];
        $class_id = $query[0]['class_id'];
        $subject = $query[0]['subject'];
        $data['examId'] = $id;
        $data['examTitle'] = $query[0]['exam_title'];
        $data['class_id'] = $class_id;
        $data['teacher'] = $query[0]['teacher'];
        $data['subject'] = $query[0]['subject'];
        $data['resultShit'] = $this->exammodel->checkResultShit($class_id, $examTitle, $subject);
        $this->load->view('temp/header');
        $this->load->view('checkResultShit', $data);
        $this->load->view('temp/footer');
    }
    //This function will edit student's result,number and grade,point
    public function editResult() {
        $id = $this->input->get('id');
        if ($this->input->post('submit', TRUE)) {
            $updateData = array(
                'result' => $this->db->escape_like_str($this->input->post('result', TRUE)),
                'mark' => $this->db->escape_like_str($this->input->post('mark', TRUE)),
                'point' => $this->db->escape_like_str($this->input->post('point', TRUE)),
                'grade' => $this->db->escape_like_str($this->input->post('gread', TRUE))
            );
            $this->db->where('id', $id);
            if ($this->db->update('result_shit', $updateData)) {
                redirect('examination/aproveShitView', 'refresh');
            }
        } else {
            $data['gread'] = $this->common->getAllData('exam_grade');
            $data['previousResult'] = $this->common->getWhere('result_shit', 'id', $id);
            $this->load->view('temp/header');
            $this->load->view('editResult', $data);
            $this->load->view('temp/footer');
        }
    }
    //This function will approuve result shit which is sent from teacher.
    public function approuveResultShit() {
        $id = $this->input->get('id');
        $data = array(
            'submited' => $this->db->escape_like_str(1)
        );
        $this->db->where('id', $id);
        if ($this->db->update('result_submition_info', $data)) {
            $query = $this->common->getWhere('result_submition_info', 'id', $id);
            foreach ($query as $row) {
                $rowInfo = $row;
            }
            $class_id = $rowInfo['class_id'];
            $examTitle = $rowInfo['exam_title'];
            $examId = $rowInfo['exam_id'];
            $subject = $rowInfo['subject'];
            $approuveSubject = $this->exammodel->approuveSubjectAmount($class_id, $examTitle);
            $classSubject = $this->exammodel->classSubjectAmount($class_id);
            //By this if conditation we are chacking that all subjects result was submited or not
            //When all subjects result is submited in that time insert the informations in "result_action" table then it will ready for final calculation.
            if ($approuveSubject == $classSubject) {
                $actionArrayt = array(
                    'class_id' => $this->db->escape_like_str($class_id),
                    'exam_title' => $this->db->escape_like_str($examTitle),
                    'exam_id' => $this->db->escape_like_str($examId),
                    'status' => $this->db->escape_like_str('Not Complete')
                );
                if ($this->db->insert('result_action', $actionArrayt)) {
                    redirect('examination/aproveShitView', 'refresh');
                }
            } else {
                redirect('examination/aproveShitView', 'refresh');
            }
        }
    }
    //This function will make finalresult for class students
    public function finalResult() {
        $examActionId = $this->input->get('id');
        $class_id = $this->input->get('class');
        $examTitle = $this->input->get('exam');
        $examId = $this->input->get('examId');
        //Here taking a students list by class title
        $studentQuery = $this->common->getWhere('class_students', 'class_id', $class_id);
        foreach ($studentQuery as $row) {
            $studentId = $row['student_id'];
            $absent = $this->exammodel->absent($studentId);
            if ($absent == 0) {
                $fail = $this->exammodel->fail($studentId);
                if ($fail == 0) {
                    $classSubject = $this->exammodel->classSubjectAmount($class_id);
                    $finalPoint = $this->exammodel->pointAverage($studentId, $classSubject);
                    $gradeAverage = $this->exammodel->averageGrade($finalPoint);
                    $totalMark = $this->exammodel->totalMark($studentId);
                    $finalResultArray = array(
                        'class_id' => $this->db->escape_like_str($class_id),
                        'exam_id' => $this->db->escape_like_str($examId),
                        'exam_title' => $this->db->escape_like_str($examTitle),
                        'student_id' => $this->db->escape_like_str($studentId),
                        'student_name' => $this->db->escape_like_str($row['student_title']),
                        'final_grade' => $this->db->escape_like_str($gradeAverage),
                        'point' => $this->db->escape_like_str($finalPoint),
                        'total_mark' => $this->db->escape_like_str($totalMark),
                        'status' => $this->db->escape_like_str('Pass'),
                    );
                    $this->db->insert('final_result', $finalResultArray);
                } else {
                    $classSubject = $this->exammodel->classSubjectAmount($class_id);
                    $pointAverage = $this->exammodel->pointAverage($studentId, $classSubject);
                    $gradeAverage = $this->exammodel->averageGrade($pointAverage);
                    $totalMark = $this->exammodel->totalMark($studentId);
                    $finalResultArray = array(
                        'class_id' => $this->db->escape_like_str($class_id),
                        'exam_id' => $this->db->escape_like_str($examId),
                        'exam_title' => $this->db->escape_like_str($examTitle),
                        'student_id' => $this->db->escape_like_str($studentId),
                        'student_name' => $this->db->escape_like_str($row['student_title']),
                        'final_grade' => $this->db->escape_like_str($gradeAverage),
                        'point' => $this->db->escape_like_str($pointAverage),
                        'total_mark' => $this->db->escape_like_str($totalMark),
                        'status' => $this->db->escape_like_str('Fail'),
                        'fail_amount' => $this->db->escape_like_str($fail)
                    );
                    $this->db->insert('final_result', $finalResultArray);
                }
            } else {
                $finalResultArray = array(
                    'class_id' => $this->db->escape_like_str($class_id),
                    'exam_id' => $this->db->escape_like_str($examId),
                    'exam_title' => $this->db->escape_like_str($examTitle),
                    'student_id' => $this->db->escape_like_str($studentId),
                    'student_name' => $this->db->escape_like_str($row['student_title']),
                    'final_grade' => $this->db->escape_like_str('--'),
                    'point' => $this->db->escape_like_str('--'),
                    'total_mark' => $this->db->escape_like_str('--'),
                    'status' => $this->db->escape_like_str('Absent'),
                    'fail_amount' => $this->db->escape_like_str('--')
                );
                $this->db->insert('final_result', $finalResultArray);
            }
        }
        $examActionArray = array(
            'status' => $this->db->escape_like_str('Complete'),
            'publish' => $this->db->escape_like_str('Not Publish')
        );
        $this->db->where('id', $examActionId);
        if ($this->db->update('result_action', $examActionArray)) {
            $data['massage'] = '<br><div class="alert alert-success">
                                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                                <strong>' . lang('success') . '</strong> ' . lang('exac_12') . ' "' . $examTitle . '" ' . lang('exac_13') . ' "' . $this->common->class_title($class_id) . '"' . lang('exac_14') . '<br>
                                                <strong>' . lang('exac_info') . ' </strong>' . lang('exac_15') . '   
                                        </div>';
            $data['shitList'] = $this->common->getWhere('result_submition_info', 'submited', 0);
            $data['classAction'] = $this->common->getWhere('result_action', 'status', 'Not Complete');
            $this->load->view('temp/header');
            $this->load->view('aproveShitView', $data);
            $this->load->view('temp/footer');
        }
    }
    //This function select class for results 
    public function selectResult() {
        $data['result'] = $this->exammodel->publish('Complete', 'Publish');
        $this->load->view('temp/header');
        $this->load->view('selectResult', $data);
        $this->load->view('temp/footer');
    }
    //This function will show details result in a class 
    public function fullResult() {
        $class_id = $this->input->get('class');
        $examTitle = $this->input->get('exam');
        $data['result'] = $this->exammodel->finalResultShow($class_id, $examTitle);
        $data['class'] = $class_id;
        $data['examTitle'] = $examTitle;
        $this->load->view('temp/header');
        $this->load->view('fullResult', $data);
        $this->load->view('temp/footer');
    }
    //By this function admin can publish exam result in day.
    public function publishResult() {
        $query = $this->exammodel->publish('Complete', 'Not Publish');
        foreach ($query as $row) {
            $id = $row['id'];
            $examTitle = $row['exam_title'];
            $class_id = $row['class_id'];
            $array = array(
                'publish' => $this->db->escape_like_str('Publish')
            );
            $this->db->where('id', $id);
            if ($this->db->update('result_action', $array)) {
                $this->db->update('add_exam', $array, array('exam_title' => $this->db->escape_like_str($examTitle), 'class_id' => $this->db->escape_like_str($class_id)));
            }
        }
        redirect('examination/selectResult', 'refresh');
    }
    //This function will select studentfor know mark shit
    public function selectClassMarksheet() {
        if ($this->input->post('submit', TRUE)) {
            if ($this->input->post('examId', TRUE) && $this->input->post('studentId', TRUE)) {
                $class_id = $this->input->post('class_id', TRUE);
                $examId = $this->input->post('examId', TRUE);
                $section = $this->input->post('section', TRUE);
                $studentId = $this->input->post('studentId', TRUE);

                /*echo $class_id."<br>";
                echo $examId."<br>";
                echo $section."<br>";
                echo $studentId."<br>";
                die();*/

                 
                $data['markshit']  = $this->exammodel->markshit($examId, $class_id, $section, $studentId);
                $data['examTitle'] = $this->exammodel->examTitle($examId);
                $data['studentId'] = $studentId;
                $data['section']   = $section;
                //$data['studentName'] = $this->input->post('studentTitle', TRUE);
                $stuid = $this->input->post('studentId', TRUE);
                $data['studentName'] = $this->exammodel->studentname($stuid);

                $query = $this->db->query("SELECT remark FROM result_shit where student_id = $studentId");
                $data['rem']= $query->result_array(); 

                $this->load->view('temp/header');
                $this->load->view('marksheet', $data);
                $this->load->view('temp/footer');
            } else {
                echo lang('exac_16');
            }
        } else {
            $data['class'] = $this->common->getAllData('class');
            $this->load->view('temp/header');
            $this->load->view('selectClassMarksheet', $data);
            $this->load->view('temp/footer');
        }
    }
    
 
    //This function will called by ajax from view for load class markshit
    public function ajaxClassMarkshit() {
        $class_id = $this->input->get('q');
        $query = $this->exammodel->examTitleForMarkshit($class_id);
        foreach ($query as $row) {
            $data[] = $row;
        }
 
        if (!empty($data)) {
            echo '  <div class="form-group">
                        <label class="col-md-3 control-label">' . lang('exac_4') . ' <span class="requiredStar"> * </span></label>
                        <div class="col-md-6">
                            <select name="examId" class="form-control" required="required">
                              <option value=""> Select Exam title</option>
                            ';
            foreach ($data as $sec) {
                echo '<option value="' . $sec['id'] . '">' . $sec['exam_title'] . '</option>';
            }
            echo '</select></div>
                        </div>';

    
            $query = $this->db->query("SELECT section FROM class where id = $class_id");

                $section = $query->result_array(); 
                         $section1 =$section[0]['section'];
                $class_section = explode(",", $section1);
                echo'<div class="form-group">
                        <label class="col-md-3 control-label"> Class Section <span class="requiredStar"> * </span></label>
                        <div class="col-md-6">
                            <select name="section" onchange="selectSection(this.value)" class="form-control" required="required">
                              <option value=""> Select Section title</option>';
                foreach ($class_section as $cl_sec) {
                        echo' <option value="'.$cl_sec.'">'.$cl_sec.'</option>';
                        }
                echo'       </select>
                        </div>
                    </div>';

            /*$student = $this->common->getWhere('class_students', 'class_id', $class_id);
            if (!empty($student)) {
                echo '<div class="form-group">
                            <label class="col-md-3 control-label">' . lang('exac_17') . ' <span class="requiredStar"> * </span></label>
                            <div class="col-md-6">
                                <select name="studentId" class="form-control" required="required">
                                 <option value="">Select Student Name</option>
                                ';
                foreach ($student as $stu) {
                    echo '<option value="' . $stu['student_id'] . '">' . $stu['student_title'] . '</option>';
                }
                echo '</select></div>
                    <input type="text" name="studentTitle" value="' . $data['student_title'] . '">
                            </div>';
            } else {
                echo '<div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                            <div class="alert alert-warning">
                                    <strong>' . lang('exac_info') . '</strong> ' . lang('exac_9') . '
                            </div></div></div>';
            }*/
        } else {
            echo '<div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                        <div class="alert alert-warning">
                                <strong>' . lang('exac_info') . '</strong> ' . lang('exac_18') . '
                        </div></div></div>';
        }
    }
    public function ajaxselectsection() {
        $section = $this->input->get('q');
         
        if (!empty($section)) { 
             $student = $this->common->getWhere('class_students', 'section', $section);
           if (!empty($student)) {
                echo '<div class="form-group">
                            <label class="col-md-3 control-label">' . lang('exac_17') . ' <span class="requiredStar"> * </span></label>
                            <div class="col-md-6">
                                <select name="studentId" class="form-control" required="required">
                                 <option value="">Select Student Name</option>
                                ';
                foreach ($student as $stu) {
                    echo '<option value="' . $stu['student_id'] . '">' . $stu['student_title'] . '</option>';
                }
                echo '</select></div>
                    <input type="hidden" name="studentTitle" value="' . $data['student_title'] . '"> 
                            </div>';
            }  
           else {
            echo'  <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <div class="alert alert-warning">
                                <strong>' . lang('exac_info') . '</strong> ' . "This class any Section was not Found." . '
                            </div>
                        </div>
                    </div>';
            } 
        }  
    }
    //This function will select studentfor know mark shit
    public function combineClassMarksheet() {
        if ($this->input->post('submit', TRUE)) {
            // $this->input->post('examId', TRUE) &&
            if  ($this->input->post('studentId', TRUE)) {
                $class_id = $this->input->post('class_id', TRUE);
                $section = $this->input->post('section', TRUE);
                // $examId = $this->input->post('examId', TRUE);
                $studentId = $this->input->post('studentId', TRUE);
                ////
                $data['class_id']= $class_id;
                $data['section']= $section;
               //  $data['examId']= $examId;
                $data['studentId']= $studentId;
                ///
                $data['markshit'] = $this->exammodel->overallmarkshit($class_id, $studentId); // $examId, 
             //   $data['examTitle'] = $this->exammodel->examTitle($examId);
                $data['studentId'] = $studentId;
                $data1 =array();
                $query=$this->db->query("SELECT DISTINCT exam_title FROM `result_shit` where class_id= $class_id");
                $sub = $query->result_array();
                foreach($sub as $exam_title){
                    $subj = $exam_title['exam_title'];
                $query =$this->db->query("SELECT * FROM result_shit WHERE class_id=$class_id AND student_id=$studentId AND exam_title='$subj'") ;
                $row = $query->result_array();
                $data1[$subj] = $row;
                } 
                 $data['results']=$data1;
                /*$query =$this->db->query("SELECT * FROM result_shit WHERE class_id=$class_id AND student_id=$studentId AND exam_title='Test Exam 1'") ;
                $row = $query->result_array();
                $data['first'] = $row;

                $query1 =$this->db->query("SELECT * FROM result_shit WHERE class_id=$class_id AND student_id=$studentId AND exam_title='second trem'") ;
                $row = $query1->result_array();
                $data['second'] = $row;
                
                $query2 =$this->db->query("SELECT * FROM result_shit WHERE class_id=$class_id AND student_id=$studentId AND exam_title='final term'") ;
                $row = $query2->result_array();
                $data['final'] = $row;*/
                 
                /*$query =$this->db->query("SELECT * FROM result_shit WHERE class_id=$class_id AND student_id=$studentId AND exam_title='second trem'") ;
                $row = $query->result_array();
                $data['sem'] = $row;*/
                //$data['studentName'] = $this->input->post('studentTitle', TRUE);
                $stuid = $this->input->post('studentId', TRUE);
                $data['studentName'] = $this->exammodel->studentname($stuid);
                $this->load->view('temp/header');
                $this->load->view('combinemarksheet', $data);
                $this->load->view('temp/footer');
            } else {
                echo lang('exac_16');
            }
        } else {
            $data['class'] = $this->common->getAllData('class');
            $this->load->view('temp/header');
            $this->load->view('combineClassMarksheet', $data);
            $this->load->view('temp/footer');
        }
    }
    //This function will called by ajax from view for load class markshit
    public function combineajaxClassMarkshit() {
        $class_id = $this->input->get('q');
        $query = $this->exammodel->examTitleForMarkshit($class_id);
        foreach ($query as $row) {
            $data[] = $row;
        }
         
         if (!empty($data)) {
                $query = $this->db->query("SELECT section FROM class where id = $class_id");

                $section = $query->result_array(); 
                         $section1 =$section[0]['section'];
                $class_section = explode(",", $section1);
                echo'<div class="form-group">
                        <label class="col-md-3 control-label"> Class Section <span class="requiredStar"> * </span></label>
                        <div class="col-md-6">
                            <select name="section" onchange="selectSection(this.value)" class="form-control" required="required">
                              <option value=""> Select Section title</option>';
                foreach ($class_section as $cl_sec) {
                        echo' <option value="'.$cl_sec.'">'.$cl_sec.'</option>';
                        }
                echo'       </select>
                        </div>
                    </div>';  

        } else {
            echo '<div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                        <div class="alert alert-warning">
                                <strong>' . lang('exac_info') . '</strong> ' . lang('exac_18') . '
                        </div></div></div>';
        }
    }
    public function ajaxcombineselectSection() {
        $section = $this->input->get('q');
         
        if (!empty($section)) { 
             $student = $this->common->getWhere('class_students', 'section', $section);
           if (!empty($student)) {
                echo '<div class="form-group">
                            <label class="col-md-3 control-label">' . lang('exac_17') . ' <span class="requiredStar"> * </span></label>
                            <div class="col-md-6">
                                <select name="studentId" class="form-control" required="required">
                                 <option value="">Select Student Name</option>
                                ';
                foreach ($student as $stu) {
                    echo '<option value="' . $stu['student_id'] . '">' . $stu['student_title'] . '</option>';
                }
                echo '</select></div>
                    <input type="hidden" name="studentTitle" value="' . $data['student_title'] . '"> 
                            </div>';
            }  
           else {
            echo'  <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <div class="alert alert-warning">
                                <strong>' . lang('exac_info') . '</strong> ' . "This class any Section was not Found." . '
                            </div>
                        </div>
                    </div>';
            } 
        }  
    }
    public function selectClassSection(){
        if ($this->input->post('submit', TRUE)) {
            $class_id = $this->input->post('class_id', TRUE);
            $section = $this->input->post('section', TRUE);
            $exam_id = $this->input->post('exam_id', TRUE);
         
        $data['fullResult']  = $this->exammodel->fullResult($class_id, $section, $exam_id);
        $query1=$this->db->query("SELECT DISTINCT exam_subject FROM `result_shit` where class_id= $class_id AND exam_id=$exam_id");
        $data['sub'] = $query1->result_array();

        $query=$this->db->query("SELECT total_mark FROM `result_shit` where class_id= $class_id AND exam_id=$exam_id AND section= '$section' group BY exam_subject");
        $data['tmark'] = $query->result_array();

        $data['class_id']=$class_id;
        $data['section']=$section;
            $this->load->view('temp/header');
            $this->load->view('completeFullClassResult', $data);
            $this->load->view('temp/footer');
        }
        else{
            $data['class'] = $this->common->getAllData('class');
            $this->load->view('temp/header');
            $this->load->view('selectClassSection',$data);
            $this->load->view('temp/footer');
        }
    }
    public function ajaxClsSection(){
       $class_id = $this->input->get('q');
          
         if (!empty($class_id)) {
                $query = $this->db->query("SELECT section FROM class where id = $class_id");
                $section = $query->result_array(); 
                         $section1 =$section[0]['section'];
                $class_section = explode(",", $section1);
                echo'<div class="form-group">
                        <label class="col-md-3 control-label"> Class Section <span class="requiredStar"> * </span></label>
                        <div class="col-md-6">
                            <select name="section" onchange="selectSection(this.value)" class="form-control" required="required">
                              <option value=""> Select Section title</option>';
                foreach ($class_section as $cl_sec) {
                        echo' <option value="'.$cl_sec.'">'.$cl_sec.'</option>';
                        }
                echo'       </select>
                        </div>
                    </div>';  
            $query = $this->exammodel->examTitleForMarkshit($class_id);
                foreach ($query as $row) {
                    $data[] = $row;
                }
                echo'<div class="form-group">
                        <label class="col-md-3 control-label"> Select Exam Term <span class="requiredStar"> * </span></label>
                        <div class="col-md-6">
                            <select name="exam_id" class="form-control" required="required">
                              <option value=""> Select Section title</option>';
                foreach ($data as $sec) {
                echo '<option value="' . $sec['id'] . '">' . $sec['exam_title'] . '</option>';
                }
                echo'       </select>
                        </div>
                    </div>'; 

        } else {
            echo '<div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-6">
                        <div class="alert alert-warning">
                                <strong>' . lang('exac_info') . '</strong> ' . lang('exac_18') . '
                        </div>
                    s</div>
                </div>';
        }
    }
     
    //This function will select student's own marksheet
    public function sel_ow_ma() {
        if ($this->input->post('submit', TRUE)) {
            if ($this->input->post('examId', TRUE)) {
                $class_id = $this->input->post('class_id', TRUE);
                $examId = $this->input->post('examId', TRUE);
                $user = $this->ion_auth->user()->row();
                $userId = $user->id;
                $studentId = $this->exammodel->student_id($userId);
                $data['markshit'] = $this->exammodel->markshit($examId, $class_id, $studentId);
                $data['examTitle'] = $this->exammodel->examTitle($examId);
                $data['studentId'] = $studentId;
                $data['studentName'] = $this->input->post('studentTitle', TRUE);
                $this->load->view('temp/header');
                $this->load->view('ow_marksheet', $data);
                $this->load->view('temp/footer');
            } else {
                echo lang('exac_16');
            }
        } else {
            $data['class'] = $this->common->getAllData('class');
            $this->load->view('temp/header');
            $this->load->view('sel_ow_ma', $data);
            $this->load->view('temp/footer');
        }
    }
    //This function will called by ajax from view for load class markshit
    public function ajax_ow_ma() {
        $class_id = $this->input->get('q');
        $query = $this->exammodel->examTitleForMarkshit($class_id);
        foreach ($query as $row) {
            $data[] = $row;
        }
        if (!empty($data)) {
            echo '<div class="form-group">
                        <label class="col-md-3 control-label">' . lang('exac_4') . ' <span class="requiredStar"> * </span></label>
                        <div class="col-md-6">
                            <select name="examId" class="form-control">
                            <option value="">Select...</option>';
            foreach ($data as $sec) {
                echo '<option value="' . $sec['id'] . '">' . $sec['exam_title'] . '</option>';
            }
            echo '</select></div>
                        </div>';
        } else {
            echo '<div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                        <div class="alert alert-warning">
                                <strong>' . lang('exac_info') . '</strong> ' . lang('exac_18') . '
                        </div></div></div>';
        }
    }

     public function editexam(){
        $id = $this->input->get('id');
        $class_id = $this->input->get('class_id');

         
            $data['routine'] = $this->common->getWhere('exam_routine', 'id', $id);
            $data['subject'] = $this->common->getWhere('class_subject', 'class_id', $class_id);
            $this->load->view('temp/header');
            $this->load->view('edit_routine_subject', $data);
            $this->load->view('temp/footer');
    }
    public function updatexam(){

        if($this->input->post('submit', TRUE)){
            $examDate = $this->input->post('examDate', TRUE);
            $id = $this->input->post('id', TRUE);
                $subject = $this->input->post('subject', TRUE);
                $examId = $this->input->post('exam_id', TRUE);
                $oral = $this->input->post('oral_date', TRUE);
                $class_id = $this->input->post('class_id', TRUE);
                $day = $this->input->post('day', TRUE);
                $romeNo = $this->input->post('romeNo', TRUE);
                $starTima = $this->input->post('starTima', TRUE);
                $endTima = $this->input->post('endTima', TRUE);
                $examShift = $this->input->post('examShift', TRUE);
                $type = $this->input->post('type', TRUE);
                $routine1 = array(
                    'exam_id' => $this->db->escape_like_str($examId),
                    'class_id' => $this->db->escape_like_str($class_id),
                    'exam_date' => $this->db->escape_like_str($examDate),
                    'exam_subject' => $this->db->escape_like_str($subject),
                    'oral_date' => $this->db->escape_like_str($oral),
                    'day' => $this->db->escape_like_str($day),
                    'rome_number' => $this->db->escape_like_str($romeNo),
                    'start_time' => $this->db->escape_like_str($starTima),
                    'end_time' => $this->db->escape_like_str($endTima),
                    'exam_shift' => $this->db->escape_like_str($examShift),
                    'type' => $this->db->escape_like_str($type),
                    'status' => $this->db->escape_like_str('NoResult')
                ); 

                $this->db->where('id', $id);
                $this->db->update('exam_routine', $routine1);
                
                redirect('examination/allExamRutine', 'refresh');
            }else{
                redirect('examination/editexam', 'refresh');
            }
    }
    public function ajaxoraldate(){
        $oral = $this->input->get('q');
        if ($oral == 'oral') {
            echo' <div class="col-md-2 classGroupInput">
                    <input type="date" class="form-control" name="oral_date" data-validation="required" data-validation-error-msg="">
                                                </div>';
        }
    }
    public function ajaxoraldate2(){
        $oral = $this->input->get('q');
        if ($oral == 'oral') {
            echo' <div class="col-md-2 classGroupInput">
                    <input type="date" class="form-control" name="oral_date_2" data-validation="required" data-validation-error-msg="">
                                                </div>';
        }
    }
    public function ajaxoraldate3(){
        $oral = $this->input->get('q');
        if ($oral == 'oral') {
            echo' <div class="col-md-2 classGroupInput">
                    <input type="date" class="form-control" name="oral_date_3" data-validation="required" data-validation-error-msg="">
                                                </div>';
        }
    }
    public function ajaxoraldate4(){
        $oral = $this->input->get('q');
        if ($oral == 'oral') {
            echo' <div class="col-md-2 classGroupInput">
                    <input type="date" class="form-control" name="oral_date_4" data-validation="required" data-validation-error-msg="">
                                                </div>';
        }
    }
    public function ajaxoraldate5(){
        $oral = $this->input->get('q');
        if ($oral == 'oral') {
            echo' <div class="col-md-2 classGroupInput">
                    <input type="date" class="form-control" name="oral_date_5" data-validation="required" data-validation-error-msg="">
                                                </div>';
        }
    }
    public function ajaxoraldate6(){
        $oral = $this->input->get('q');
        if ($oral == 'oral') {
            echo' <div class="col-md-2 classGroupInput">
                    <input type="date" class="form-control" name="oral_date_6" data-validation="required" data-validation-error-msg="">
                                                </div>';
        }
    }
    public function ajaxoraldate7(){
        $oral = $this->input->get('q');
        if ($oral == 'oral') {
            echo' <div class="col-md-2 classGroupInput">
                    <input type="date" class="form-control" name="oral_date_7" data-validation="required" data-validation-error-msg="">
                                                </div>';
        }
    }
    public function ajaxoraldate8(){
        $oral = $this->input->get('q');
        if ($oral == 'oral') {
            echo' <div class="col-md-2 classGroupInput">
                    <input type="date" class="form-control" name="oral_date_8" data-validation="required" data-validation-error-msg="">
                                                </div>';
        }
    }
    public function ajaxoraldate9(){
        $oral = $this->input->get('q');
        if ($oral == 'oral') {
            echo' <div class="col-md-2 classGroupInput">
                    <input type="date" class="form-control" name="oral_date_9" data-validation="required" data-validation-error-msg="">
                                                </div>';
        }
    }
    public function ajaxoraldate10(){
        $oral = $this->input->get('q');
        if ($oral == 'oral') {
            echo' <div class="col-md-2 classGroupInput">
                    <input type="date" class="form-control" name="oral_date_10" data-validation="required" data-validation-error-msg="">
                                                </div>';
        }
    }
    public function ajaxoraldate11(){
        $oral = $this->input->get('q');
        if ($oral == 'oral') {
            echo' <div class="col-md-2 classGroupInput">
                    <input type="date" class="form-control" name="oral_date_11" data-validation="required" data-validation-error-msg="">
                                                </div>';
        }
    }
    public function ajaxoraldate12(){
        $oral = $this->input->get('q');
        if ($oral == 'oral') {
            echo' <div class="col-md-2 classGroupInput">
                    <input type="date" class="form-control" name="oral_date_12" data-validation="required" data-validation-error-msg="">
                                                </div>';
        }
    }
    public function ajaxoraldate13(){
        $oral = $this->input->get('q');
        if ($oral == 'oral') {
            echo' <div class="col-md-2 classGroupInput">
                    <input type="date" class="form-control" name="oral_date_13" data-validation="required" data-validation-error-msg="">
                                                </div>';
        }
    }
    public function ajaxoraldate14(){
        $oral = $this->input->get('q');
        if ($oral == 'oral') {
            echo' <div class="col-md-2 classGroupInput">
                    <input type="date" class="form-control" name="oral_date_14" data-validation="required" data-validation-error-msg="">
                                                </div>';
        }
    }
    public function ajaxoraldate15(){
        $oral = $this->input->get('q');
        if ($oral == 'oral') {
            echo' <div class="col-md-2 classGroupInput">
                    <input type="date" class="form-control" name="oral_date_15" data-validation="required" data-validation-error-msg="">
                                                </div>';
        }
    }
}
