<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class User_model extends CI_Model {  
  
    public function __construct()  
    {  
        // Call the Model constructor  
        parent::__construct(); 
    }  

    public function validateCreate() {
      
      $this->load->library('form_validation');
      $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[255]|xss_clean');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[10]|matches[password2]');
      $this->form_validation->set_rules('question', 'Question', 'trim|required|min_length[3]|max_length[255]|xss_clean');
      $this->form_validation->set_rules('answer', 'Answer', 'trim|required|min_length[3]|max_length[255]|xss_clean');
      $this->form_validation->set_rules('password2', 'Password2', 'trim|required|min_length[5]|max_length[10]');
      $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
    
      if ($this->form_validation->run() == true) {
        $this->insertUser();
      } else {
        return false;
      } 
    }

    public function insertUser() {
      
      $this->load->library('encrypt');
      
      $data = array (
        'name'=>$this->input->post('name'),
        'email'=>$this->input->post('email'),
        'password'=>$this->encrypt->sha1($this->input->post('password')),
        'question'=>$this->input->post('question'),
        'answer'=>$this->encrypt->sha1($this->input->post('answer')),
        'active'=>'0' 
      );
      
      if($this->db->insert('user', $data) == true) {
        
        $word = array_merge(range('a', 'z'), range('A', 'Z'), range('1', '20s'));
        shuffle($word);
        $hash = substr(implode($word), 0, 20);

        $data = array (
          'user_id' => $this->db->insert_id(),
          'hash' => $hash,
        );

        $this->db->insert('user_check', $data);
        $this->sendEmail($hash);
      
      } else {
        return false;
      }
    }

    public function sendEmail($hash) {

      $this->load->library('email');
      $this->email->from($_POST['email'], $_POST['email']);
      $this->email->to($_POST['email']);           
      $this->email->subject('confirm');
      $this->email->message('<a href="'.base_url().'user/confirm/'.$hash.'">confirm</a>');  
      $this->email->send();
      
    }

    public function activate($activate) {

      $this->db->select('user_id');
      $this->db->where('hash', $activate);
      $query = $this->db->get('user_check');

      if ($query->num_rows() == 1)  {  
        
        $user_id = $query->row();
        $data = array ('active' => '1');  
        $this->db->where('user_id', $user_id->user_id);
        $this->db->update('user', $data);

      } else {  
        
        show_error('Database is empty!');   
      
      }

    }

    public function validateLogin() {
      
      $this->load->library('encrypt');

      $email = $this->input->post('email');
      $password = $this->encrypt->sha1($this->input->post('password'));

      $query = $this->db->get_where('user', array('email' => $email, 'password' => $password, 'active' => '1'));

      return ($query->num_rows() == 1) ? true : false;

    }
  
  	
} 