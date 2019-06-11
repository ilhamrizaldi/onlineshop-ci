<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends MY_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('m_crud');
        
        
    }
    
    public function index()
    {
        $data['total']   = $this->cart->total();
        $data['order']   = $this->cart->contents();
        $this->template('checkout', $data);
    }
    public function process()
    {
        if ($this->validation() == FALSE) {

            $this->session->set_flashdata('');
            redirect('checkout','refresh');

        } else {
            $inv        = rand(1000,999999);
            $name       = strtoupper($this->post_clean('name'));
            $hp         = $this->post_clean('hp');
            $alamat     = $this->post_clean('alamat');
            $pos        = $this->post_clean('pos');
            $note       = $this->post_clean('note');
            // -------------------- Data Order ------------------\\
            $cart       = $this->cart->contents();
            $tbl_order  = array();
            foreach ($cart as $key => $row) {
                $prd_name   = $row['name'];
                $prd_price  = $row['price'];
                $prd_qty    = $row['qty'];
                $total      = $this->cart->total();
                $tbl_order  = array('product_name'=> $prd_name, 'product_price'=> $prd_price, 'product_qty'=> $prd_qty, 'total'=> $total, 'invoice'=> $inv);
                $save       = $this->m_crud->create('table_orders', $tbl_order);
            }
            $tbl_trx    = array('invoice'=> $inv, 'customer'=> $name, 'total'=> $this->cart->total(), 'status'=> 'waiting', 'date'=> date('d F Y'));
            $tbl_cus    = array('invoice'=> $inv, 'name'=> $name, 'hp'=> $hp, 'alamat'=> $alamat, 'pos'=> $pos);
            $save       = $this->m_crud->create('table_customer', $tbl_cus);
            $save       = $this->m_crud->create('table_transaction', $tbl_trx);
            if ($save == true) {
                $msg  = "XSHOP: Hi ".$name." , pesanan anda sudah kami terima, silahkan transfer ke rekening BCA 1234567890 an Hanya Contoh dengan nominal Rp ".number_format($this->cart->total(), 0, '.', '.')."";
                sms($msg, $hp);
                $this->cart->destroy();
                redirect('checkout/success/'.$inv,'refresh');
                
            } else {
                
                redirect('/','refresh');
                
            }
        }
        
    }
    /**
     * 
     */
    public function success()
    {
        $inv    = $this->uri->segment(3);
        if ($inv == null) {
            
            redirect('checkout','refresh');
            
        } else {

             $data['alamat']     = $this->m_get->where('table_customer', array('invoice'=> $inv))->result();
             $data['barang']     = $this->m_get->where('table_orders', array('invoice'=> $inv))->result();
            
             $this->template('success', $data);
        }
    }
    /**
     * 
     */
    public function struk()
    {
        $inv    = $this->uri->segment(3);
        if ($inv == null) {
            
            redirect('/','refresh');
            
        } else {
            $data['customer']       = $this->m_get->where('table_customer', array('invoice'=> $inv))->result();
            $data['orders']         = $this->m_get->where('table_orders', array('invoice'=> $inv))->result();
            $data['trx']            = $this->m_get->where('table_transaction', array('invoice'=> $inv))->result();
            $data['total']          = $this->m_get->where('table_orders',  array('invoice'=> $inv))->row();
            if ($data['orders'] == null) {
                
                redirect('/','refresh');
                
            } else {
                   $this->load->library('pdf');

	   			   $this->pdf->setPaper('A4', 'potrait');
	    		   $this->pdf->filename = "invoice-ID".$inv.".pdf";
				   $this->pdf->load_view('struk', $data);
            }
        }
    }
    /**
     * Validation
     */
    private function validation()
    {
        $val    = $this->form_validation;
        $val->set_rules('name', 'Nama Lengkap', 'trim|required');
        $val->set_rules('hp', 'Nomer Handphone', 'trim|required');
        $val->set_rules('alamat', 'Alamat Lengkap', 'trim|required');
        $val->set_rules('pos', 'Kode POS', 'trim|required');

        return $val->run();
    }
    /**
     * Post CLean 
     */
    private function post_clean($string = null)
    {
        return $this->security->xss_clean($this->input->post($string, true));
    }
}

/* End of file Checkout.php */
