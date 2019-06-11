<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Controller {

    /**
     * COnstruct
     */
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_get', 'm_crud'));
        
    }
    /**
     * Input brand
     */
    public function input()
    {
        if ($this->validation() == FALSE) {
            $data   = array('status'=> false, 'msg'=> 'Form input have a value!');
        } else {
            if ($this->m_get->check('table_brand', array('name'=> $this->post_clean('name'))) == 1) {
                $data   = array('status'=> false, 'msg'=>'Brand found in the database!');
            } else {
                $query = array(
                    'name' => $this->post_clean('name'),
                    'value'=> slug($this->post_clean('value')) 
                );
                $insert    = $this->m_crud->create('table_brand', $query);
                if ($insert == true) {
                    $data = array('status' => true, 'msg'=> 'Brand successfully inserted!');
                } else {
                    $data = array('status' => false, 'msg'=> 'System Error!');
                }
            }
        }
        $this->output 
        ->set_content_type('aplication/json', 'utf-8')
        ->set_output(json_encode($data))
        ->_display(); exit;
    }
    /**
     * Preview brand
     */
    public function preview()
    {
        $id     = $this->uri->segment(4);
        if($id == null) {
            $data   = array('data'=> 'Please input id!');
          }else{
            $get    = $this->m_get->where('table_brand', array('id'=> $id))->row();
            if ($get == null) {
                $data   = array('data'=> 'There is no data in the database');
            } else {
                $data  = array(
                    'id'=> $get->id,
                    'name'=> $get->name,
                    'value'=> $get->value
                );
            }
          }
          $this->output 
          ->set_content_type('aplication/json', 'utf-8')
          ->set_output(json_encode($data))
          ->_display();exit;
    }
    /**
     * Edit brand
     * @return Json
     */
    public function edit()
    {
        if ($this->validation_edit() == FALSE) {
            $data     = array('status'=> false, 'msg'=> 'Form input have a value');
         } else {
              $id         = $this->post_clean('id');
              $query      = array(
                  'name'=> $this->post_clean('name'),
                  'value'=> slug($this->post_clean('value'))
              );
              $update     = $this->m_crud->update('table_brand', $query, array('id'=> $id));
              if ($update == true) {
                $data     = array('status'=> true, 'msg'=> 'Brand successfully updated!');
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
            $delete     = $this->m_crud->delete('table_brand', array('id'=> $id));
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
        $val        = $this->form_validation;
        $val->set_rules('name', 'brand Name', 'trim|required');
        $val->set_rules('value', 'Value', 'trim|required');
        return $val->run();
    }
    /**
     * Form validation Edit
     * @return Boolean
     */
    private function validation_edit()
    {
        $val        = $this->form_validation;
        $val->set_rules('id', 'brand ID', 'trim|required');
        $val->set_rules('name', 'brand Name', 'trim|required');
        $val->set_rules('value', 'Value', 'trim|required');
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

/* End of file Brand.php */
