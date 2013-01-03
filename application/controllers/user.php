<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		$this->load->helper('form');
				
			$data = array (
				'page_title' => "Ops Smile Login", 
				'main_content' => 'login_view',
			);
			
			$this->load->view('template', $data); 
	}

	public function login() {
		
		if ($this->input->post()) {
			
			$this->load->model('user_model');

			if ($this->user_model->validateLogin()) {
				
				$this->session->set_userdata('logged_in', TRUE);

				redirect('home');

			} else {
				
				redirect('user');
			}
		} else {
			
			redirect('user');
		}
	}

	public function logout() {
		$this->session->set_userdata('logged_in', FALSE);
		redirect('user');
	}

	public function create() {
		
		if ($this->input->post()) {
			$this->load->model('user_model');
			
			if ($this->user_model->validateCreate()) {

			} else {
				$this->load->helper('form');
				$data = array (
					'page-title' => "Create an account",
					'main_content' => 'create_view',
					);

				$this->load->view('template', $data);	
			}
		
		} else {

			$this->load->helper('form');
			$data = array (
				'page-title' => "Create an account",
				'main_content' => 'create_view',
				);

			$this->load->view('template', $data);
		}
	}

	public function confirm($activate){

		$this->load->model('user_model');

		if ($this->user_model->activate($activate)) {

		}
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */