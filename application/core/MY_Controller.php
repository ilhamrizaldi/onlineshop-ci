<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $CI;

    
    public function __construct()
    {
        parent::__construct();
        $this->CI   = &get_instance();
        $this->CI->load->model('m_get');
        $this->CI->load->library('cart');
        
    }
    /**
     * Template E-Commerce
     */
    public function template($content, $data = null)
    {
       // Brand
       $data['brand']     = $this->CI->m_get->all('table_brand')->result();
       // Category
       $data['category']  = $this->CI->m_get->all('table_category')->result();
       // Views
       $data['jcart']     = count($this->CI->cart->contents());
       $view['header']    = $this->load->view('_partials/header', $data);
       $view['navbar']    = $this->load->view('_partials/navbar', $data);
       //$view['panel']     = $this->load->view('_partials/panel', $data);
       $view['content']   = $this->load->view($content, $data);
       $view['footer']    = $this->load->view('_partials/footer', $data);
       
        
    }
    /**
     * Template AdminLTE
     */
    public function adminlte($content, $data = null)
    {
       $view['head']      = $this->load->view('_admin/head', $data);
       $view['header']    = $this->load->view('_admin/header', $data);
       $view['sidebar']   = $this->load->view('_admin/sidebar', $data);
       $view['content']   = $this->load->view($content, $data);
       $view['footer']    = $this->load->view('_admin/footer', $data);
    }
}

/* End of file MY_Controller.php */
