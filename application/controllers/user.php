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

	public function forgotpassword() {

		if ($this->input->post()) {
			$this->db->select('question');
	      	$this->db->where('email', $this->input->post('email'));
	      	$query = $this->db->get('user');

	      	if ($query->num_rows() == 1)  {  
        
        		echo json_encode($query->row());
        	} else {
        		echo json_encode('james');
        	}
		}

	}

	public function checkquestion() {
		
		$this->load->library('encrypt');      	

		if ($this->input->post()) {

			$this->db->select('user_id, email, answer');
			$this->db->where('answer', $this->encrypt->sha1($this->input->post('answer')));
			$query = $this->db->get('user');

			if ($query->num_rows() == 1)  {  
        
        		echo json_encode($query->row());
        	} else {
        		return false;
        	}
		}
	}

	public function updatepassword() {

		$this->load->library('encrypt'); 

		if ($this->input->post()) {

			$password = $this->encrypt->sha1($this->input->post('password'));
			$user = $this->input->post('user_id');
			$email = $this->input->post('emailchange');

        	$data = array ('password' => $password);  
        	$this->db->where('user_id', $user);
        	$this->db->update('user', $data);
		}

	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */