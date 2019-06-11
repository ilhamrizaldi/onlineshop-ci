<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_get');
    }
    
    /**
     * Login process
     */
    public function login()
    {
        if ($this->session->userdata('user_id')) {
            redirect('administrator','refresh'); 
        } else {
           $this->load->view('auth/login'); 
        }
    }
    /**
     * Process login
     */
    public function login_process()
    {
        
        if ($this->validation() == FALSE) {
            $data    = array('status'=> false, 'msg'=> 'Form input have a value!');
        } else {
            $username = $this->input_clean('username');
            $password = $this->input_clean('password');
            //var_dump($username);exit;
            // Login process
            $query   = $this->m_get->where('table_admin', array('username'=> $username));
            if ($query->num_rows() === 1) {
                $q = $query->row();
                if (password_verify($password, $q->password)) {
                    $session_data   = [
                        'user_id'=> $q->id,
                        'username'=> $q->username,
                    ];
                    $this->session->set_userdata($session_data);
                    $data    = array('status'=> true, 'msg'=> 'Anda akan diarahkan dalam waktu 3 detik!');
                    
                } else {
                    $data    = array('status'=> false, 'msg'=> 'Password Incorrect!');
                }
            } else {
                $data    = array('status'=> false, 'msg'=> 'Account not found!');
            }
        }
        $this->output 
        ->set_content_type('aplication/json', 'utf-8')
        ->set_output(json_encode($data, JSON_HEX_APOS | JSON_HEX_QUOT))
        ->_display(); exit;
        
    }
    public function logout()
    {
       $this->session->unset_userdata('user_id');
       
       redirect('auth/login','refresh');
       
    }
    /**
     * Form validation
     */
    private function validation()
    {
        $val    = $this->form_validation;
        $val->set_rules('username', 'Username', 'trim|required');
        $val->set_rules('password', 'Password', 'trim|required');
        return $val->run();
    }
    /**
     * Input clean
     * @param String 
     * @return Object
     */
    private function input_clean($string = null)
    {
      return $this->security->xss_clean($this->input->post($string, true));
    }
}   

/* End of file Login.php */
