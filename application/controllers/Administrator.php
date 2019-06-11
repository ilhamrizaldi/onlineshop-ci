<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends MY_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_get');
        if (!$this->session->userdata('user_id')) {
            
            redirect('/','refresh');
            
        }
    }
    
    public function index()
    {
        $this->adminlte('admin/index');
    }
    /**
     * Manaage Transaction
     */
    public function data_orders()
    {
        $data['trx'] = $this->m_get->all('table_transaction')->result();
        $this->adminlte('admin/orders', $data);
    }
    /**
     * Create Product
     */
    public function input_product()
    {
       // Brand
       $data['brand']      = $this->m_get->all('table_brand')->result();
       // Category
       $data['category']   = $this->m_get->all('table_category')->result();
       // Product
       $data['product']    = $this->m_get->all('table_product')->result();
       $this->adminlte('admin/product', $data);
    }
    /**
     * Create Category
     */
    public function input_category()
    {
        // Category
       $data['category']   = $this->m_get->all('table_category')->result();
       //
       $this->adminlte('admin/category', $data);
    }
    /**
     * Create Brand
     */
    public function input_brand()
    {
        // Brand
       $data['brand']      = $this->m_get->all('table_brand')->result();
       //
       $this->adminlte('admin/brand', $data);

    }
    /**
     * Manage Page
     */
    public function discovery()
    {
        # code...
    }
}

/* End of file Administrator.php */
