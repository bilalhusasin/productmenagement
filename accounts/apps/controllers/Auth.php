<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    /**
     * Class constructor
     *
     * @return  void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * User login
     *
     * @return  void
     */
    public function index()
    {
        if ($this->input->post('email'))
        {
            $this->form_validation->set_rules('email', 'Username', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == TRUE)
            {
                $email = trim($this->input->post('email'));
                $pw = substr(do_hash(trim($this->input->post('password'))), 0, 16);
                $this->MUsers->verify($email, $pw);

                if ($this->session->user_id)
                {
                    redirect('dashboard', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User name and Password mismatch.');
                    redirect('', 'refresh');
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'User name must be your email address and password field can\'t be blank.');
                redirect('', 'refresh');
            }
        }
        else
        {
            $data['title'] = 'Login - POS System';
            $data['menu'] = 'login';
            $data['content'] = 'login';
            $data['version'] = file_get_contents('config.ini');
            $this->load->view('login', $data);
        }
    }

    /**
     * User logout
     *
     * @return  void
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('', 'refresh');
    }

    /**
     * Forgot password
     *
     * @return  void
     */
    public function forgot_password()
    {
        if ($this->input->post('email'))
        {
            // Send reset mail
            $this->form_validation->set_rules('email', 'Username', 'trim|required|valid_email|xss_clean');

            if ($this->form_validation->run() == TRUE)
            {
                $user = $this->MUsers->get_by_email(trim($this->input->post('email')));
                $company = $this->MCompanies->get_by_id($user['company_id']);
                // String helper to generate random code
                $this->load->helper('string');
                $code = random_string('alnum', 32);
                $this->MUsers->update_code($user['id'], $code);

                // Send mail to user's email address
                $config = array(
                    'mailtype' => 'html'
                    );
                $this->email->set_newline("\r\n");
                $this->email->initialize($config);

                $this->email->from($company['email'], $company['name']);
                $this->email->to(trim($this->input->post('email')));
                $this->email->subject('Reset your password');
                $data['code'] = $code;
                $message = $this->load->view('templates/forgot_password', $data, TRUE);
                $this->email->message($message);
                if ($this->email->send())
                {
                    $this->session->set_flashdata('success', 'An email sent to your address with password reset link. Please check your mail and reset your password from that link.');
                }
                else
                {
                    $this->session->set_flashdata('error', 'An Unexpected Problem Occurred, Please Try Again Later.');
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Please re-check your email address.');
            }

            redirect('', 'refresh');
        }
        else
        {
            $data['title'] = 'Forget Password - POS System';
            $data['menu'] = 'forgot';
            $data['content'] = 'forgot';
            $data['version'] = file_get_contents('config.ini');
            $this->load->view('forgot_password', $data);
        }
    }

    /**
     * Reset password
     *
     * @param   string  $code
     * @return  void
     */
    public function reset_password($code)
    {
        $user = $this->MUsers->get_by_code($code);
        if (isset($user['id']))
        {
            if ($this->input->post())
            {
                $this->form_validation->set_rules('password', 'New Password', 'trim|required|xss_clean|matches[passconf]');
                $this->form_validation->set_rules('passconf', 'Confirm Password', 'required');

                if ($this->form_validation->run() == TRUE)
                {
                    $this->MUsers->update_password($user['id']);
                    $this->session->set_flashdata('success', 'Password reset successfully, you can login with your new password now.');
                    redirect('', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Please re-check your password and confirm password filed.');
                    redirect('', 'refresh');
                }
            }
            else
            {
                $data['title'] = 'Reset Password - POS System';
                $data['menu'] = 'reset';
                $data['content'] = 'reset';
                $data['code'] = $code;
                $data['version'] = file_get_contents('config.ini');
                $this->load->view('reset_password', $data);
            }
        }
        else
        {
            $this->session->set_flashdata('error', 'Invalide code, please re-send the password reset mail and try again.');
            redirect('', 'refresh');
        }
    }

}
