<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_get');
		
	}
	
	public function index()
	{
		$data['latest']		= $this->m_get->limit_by('table_product', 4, 'id', 'asc');
		$data['product']	= $this->m_get->all('table_product')->result();
		$this->template('welcome_message', $data);
	}
}
