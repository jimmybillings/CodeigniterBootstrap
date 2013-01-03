<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Home_model extends CI_Model {  
  
    public function __construct()  
    {  
        // Call the Model constructor  
        parent::__construct(); 
    }  

    public function validateform() {
      
      $this->load->library('form_validation');
      $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[255]|xss_clean');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[10]|matches[password2]');
      $this->form_validation->set_rules('password2', 'Password2', 'trim|required|min_length[5]|max_length[10]');
      $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
    
      if ($this->form_validation->run() == true) {
        $this->insert_user();
      } else {
        return false;
      } 
    }

    public function insert_user() {

      $data = array (
        'name'=>$this->input->post('name'),
        'email'=>$this->input->post('email'),
        'password'=>$this->input->post('password'), 
      );
      if($this->db->insert('user', $data) == true) {
        $this->send_email();
      } else {
        return false;
      }
    }

    public function send_email() {

      $this->load->library('email');
      $this->email->from($_POST['email'], $_POST['email']);
      $this->email->to($_POST['email']);           
      $this->email->subject('confirm');
      $this->email->message($_POST['body']);  
      $this->email->send();
      
    }
  
  	
}  