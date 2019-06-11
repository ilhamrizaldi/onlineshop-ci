<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_get', 'm_crud'));
        
    }
    
   /**
    * Product input
    * @return Json
    */
   public function input()
   {
      if ($this->validation() == FALSE) {
          $data     = array('status'=> false, 'msg'=> 'Form input have a value');
      } else {
          // Image 
          $config['upload_path']   = './assets/images/product/';
          $config['allowed_types'] = 'jpg|png';
          $config['max_size']      = '100';
          $config['max_width']     = '1024';
          $config['max_height']    = '768';
          $this->load->library('upload', $config);
      // Kondisi 
          if (!$this->upload->do_upload('image')) {
            $error      = $this->upload->display_errors();
            $data       = array('status'=> false, 'msg'=> $error);
          } else if ($this->post_clean('stock') < 0){
            $data       = array('status'=> false, 'msg'=> 'Stock minimum 1');
          } else if($this->m_get->check('table_product', array('name'=>$this->post_clean('name'))) == 1) {
            $data       = array('status'=> false, 'msg'=> 'Name found in the database');
          } else if($this->post_clean('status') != 'ready' AND $this->post_clean('status') != 'sold') {
            $data       = array('status'=> false, 'msg'=> 'Status incorrect!');
          } else {
                $query    = array(
                    'slug'=> slug($this->post_clean('name')),
                    'name'=> $this->post_clean('name'),
                    'price'=> $this->post_clean('price'),
                    'category'=> $this->post_clean('category'),
                    'image'=> $this->upload->data('file_name'),
                    'description'=> $this->post_clean('description'),
                    'brand'=> $this->post_clean('brand'),
                    'stock'=> $this->post_clean('stock'),
                    'view'=> '0',
                    'status'=> $this->post_clean('status')
                );
                $insert   = $this->m_crud->create('table_product', $query);
                if ($insert == true) {
                  $data       = array('status'=> true, 'msg'=> 'Product successfully uploaded!');
                } else {
                  $data       = array('status'=> false, 'msg'=> 'System Error!');
                }
            }
      }
      $this->output 
      ->set_content_type('aplication/json', 'utf-8')
      ->set_output(json_encode($data))
      ->_display();exit;
   }
   /**
    * Preview data before edit
    * @return Json
    */
   public function preview()
   {
        $id    = $this->uri->segment(4);
        
        if ($id == null) {
          $data   = array('data'=> 'Please input id!');
        }else{
          $get    = $this->m_get->where('table_product', array('id'=> $id))->row();
          if ($get == null) {
              $data   = array('data'=> 'There is no data in the database');
          } else {
              $data  = array(
                  'id'=> $get->id,
                  'price'=> $get->price,
                  'stock'=> $get->stock,
                  'status'=> $get->status,
                  'desc'=> $get->description
              );
          }
        }
        $this->output 
        ->set_content_type('aplication/json', 'utf-8')
        ->set_output(json_encode($data))
        ->_display();exit;
    }
    /**
     * Edit Data
     * @return Json
     */
    public function edit()
    {
       if ($this->validation_edit() == FALSE) {
          $data     = array('status'=> false, 'msg'=> 'Form input have a value');
       } else {
          if ($this->post_clean('status') != 'ready' AND $this->post_clean('status') != 'sold') {
            $data       = array('status'=> false, 'msg'=> 'Status incorrect!');
          } else if($this->post_clean('stock') < 0){
            $data       = array('status'=> false, 'msg'=> 'Stock minimum 1');
          } else {
            $id         = $this->post_clean('id');
            $query      = array(
                'price'=> $this->post_clean('price'),
                'stock'=> $this->post_clean('stock'),
                'status'=> $this->post_clean('status'),
                'description'=> $this->post_clean('desc')
            );
            $update     = $this->m_crud->update('table_product',$query, array('id'=> $id));
            if ($update == true) {
              $data     = array('status'=> true, 'msg'=> 'Product successfully updated!');
            } else {
              $data     = array('status'=> false, 'msg'=> 'System Error!');
            }
          }
       }
       $this->output 
        ->set_content_type('aplication/json', 'utf-8')
        ->set_output(json_encode($data))
        ->_display();exit;
    }
    /**
     * Delete ID
     * @param $id
     * @return Json
     */
    public function delete()
    {
        $this->form_validation->set_rules('id', 'ID', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data    = array('status'=> false, 'msg'=> 'Please fill in the input form!');
        } else {
            $id         = $this->security->xss_clean($this->input->post('id'));
            $get_img    = $this->m_get->where('table_product', array('id'=> $id))->row();
            $delete     = $this->m_crud->delete('table_product', array('id'=> $id));
            $delete     = unlink(FCPATH."/assets/images/product/".$get_img->image);
            if ($delete == true) {
                $data = array('status'=> true, 'msg'=> 'Data Successfully Deleted!');
            } else {
                $data = array('status'=> false, 'msg'=> 'System Error!');
            }
        }
        $this->output 
        ->set_content_type('aplication/json','utf-8')
        ->set_output(json_encode($data))
        ->_display();
        exit;
    }
   /**
    * Form validation
    * @return Boolean
    */
    private function validation()
    {
        $val    = $this->form_validation;
        $val->set_rules('name', 'Name Product', 'trim|required');
        $val->set_rules('category', 'Category', 'trim|required');
        $val->set_rules('brand', 'Brand', 'trim|required');
        $val->set_rules('stock', 'Stock', 'trim|required');
        $val->set_rules('status', 'Status', 'trim|required');
        $val->set_rules('description', 'Description', 'trim|required');
        return $val->run();
    }
    /**
     * Validation edit
     */
    private function validation_edit()
    {
      $val  = $this->form_validation;
      $val->set_rules('id', 'ID Product', 'trim|required');
      $val->set_rules('price', 'Price', 'trim|required');
      $val->set_rules('stock', 'Stock', 'trim|required');
      $val->set_rules('status', 'Status', 'trim|required');
      $val->set_rules('desc', 'Description', 'trim|required');
      return $val->run();
    }
    /**
     * Post Clean
     */
    private function post_clean($string = null)
    {
        return $this->security->xss_clean($this->input->post($string, true));
    }
}

/* End of file Product.php */
