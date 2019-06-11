<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_get', 'm_crud'));
        
    }
    public function edit()
    {
        if ($this->validation_edit() == FALSE) {
            $data     = array('status'=> false, 'msg'=> 'Form input have a value');
         } else {
              $inv         = $this->post_clean('invoice');
              $query      = array(
                  'status'=> $this->post_clean('status'),
                  'note'=> $this->post_clean('note')
              );
              $update     = $this->m_crud->update('table_transaction', $query, array('invoice'=> $inv));
              if ($update == true) {
                $data     = array('status'=> true, 'msg'=> 'Transaction successfully updated!');
              } else {
                $data     = array('status'=> false, 'msg'=> 'System Error!');
              }
         }
         $this->output 
          ->set_content_type('aplication/json', 'utf-8')
          ->set_output(json_encode($data))
          ->_display();exit;
    }
    /**
     * 
     */
    public function preview()
    {
        $inv     = $this->uri->segment(4);
        if($inv == null) {
            $data   = array('data'=> 'Please input id!');
          }else{
            $get    = $this->m_get->where('table_transaction', array('invoice'=> $inv))->row();
            if ($get == null) {
                $data   = array('data'=> 'There is no data in the database');
            } else {
                $data  = array(
                    'invoice'=> $get->invoice,
                    'status'=> $get->status,
                    'note'=> $get->note
                );
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
            $inv        = $this->security->xss_clean($this->input->post('id'));
            $delete     = $this->m_crud->delete('table_transaction', array('invoice'=> $inv));
            $delete     = $this->m_crud->delete('table_orders', array('invoice'=> $inv));
            $delete     = $this->m_crud->delete('table_customer', array('invoice'=> $inv));
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
     * Form validation Edit
     * @return Boolean
     */
    private function validation_edit()
    {
        $val        = $this->form_validation;
        $val->set_rules('invoice', 'Invoice ID', 'trim|required');
        $val->set_rules('status', 'Status', 'trim|required');
        $val->set_rules('note', 'Note', 'trim|required');
        return $val->run();
    }
    /**
     * Input post clean
     * @param $string
     * @return Boolean
     */
    private function post_clean($string = null)
    {
        return $this->security->xss_clean($this->input->post($string, true));
    }

}

/* End of file Orders.php */
