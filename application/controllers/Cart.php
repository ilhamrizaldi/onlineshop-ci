<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        
    }
    
    public function index()
    {
        $data['cart']    = $this->cart->contents();
        $data['total']   = $this->cart->total();
        $this->template('cart', $data);
    }
    /**
     * 
     */
    public function add_cart()
    {
        $id     = $this->post_clean('product_id');
        $name   = $this->post_clean('product_name');
        $price  = $this->post_clean('product_price');
        $qty    = $this->post_clean('quantity');
        if (empty($id) || empty($name) || empty($price) || empty($qty)) {
            $msg    = array('status'=> false, 'alert'=>'Kesalahan Sistem!');
        } else if($qty < 1) {
            $msg    = array('status'=> false, 'alert'=>'Jumlah tidak sesuai!');
        }else {
            $data   = array(
                'id'=> $id,
                'name'=> $name,
                'qty'=> $qty,
                'price'=> $price 
            );
            $this->cart->insert($data);
            $msg    = array('status'=> true, 'alert'=>'Berhasil ditambahkan ke keranjang!');
        }
        $this->output 
        ->set_content_type('aplication/json', 'utf-8')
        ->set_output(json_encode($msg))
        ->_display(); exit;
    }
    public function delete()
    {
        $row_id     = $this->post_clean('row_id');
        if (empty($row_id)) {
            $msg    = array('status'=> false, 'alert'=>'Kesalahan Sistem!');
        } else {
            $data = array(
                'rowid' => $row_id,
                'qty'=> 0 
            );
            $this->cart->update($data);
            $msg    = array('status'=> true, 'alert'=>'Produk telah dihapus!');
        }
        $this->output 
        ->set_content_type('aplication/json', 'utf-8')
        ->set_output(json_encode($msg))
        ->_display(); exit;
    }
    /**
     * Form validation
     */
    private function post_clean($string = null)
    {
        return $this->security->xss_clean($this->input->post($string, true));
    }
}

/* End of file Cart.php */
