<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_get');
        
    }
    public function index()
    {
        $search     = $this->input->get('search', true);
        $data['product'] = $this->m_get->search_product($search);
        $this->template('product/list', $data);
    }
    /**
     * Search with category
     * @param $category
     */
    public function category()
    {
       $category        = $this->uri->segment(3);
       $data['product'] = $this->m_get->where('table_product', array('category'=>$category))->result();
       $this->template('product/list', $data);
    }
    /**
     * Search with brand
     * @param $brand
     */
    public function brand()
    {
       $brand        = $this->uri->segment(3);
       $data['product'] = $this->m_get->where('table_product', array('brand'=>$brand))->result();
       $this->template('product/list', $data);
    }
    /**
     * Get detail product
     */
    public function detail()
    {
        $slug               = $this->uri->segment(3);
        $data['detail']     = $this->m_get->where('table_product', array('slug'=>$slug))->result();
        $data['category']   = $this->m_get->all('table_category')->result();
        $this->template('product/detail', $data);
    }

}

/* End of file Controllername.php */
