<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class books extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->output->enable_profiler(TRUE);
	}
	public function index()
	{
		if(null ===($this->session->userdata('loggedid'))){
			$this->session->set_userdata('loggedid',0);
		}
		$this->load->view('index');
	}

	public function view_mainpage(){
		$this->load->view('mainpage');
	}

	public function view_addbook(){
		$this->load->view('addbook');
	}

	public function view_user(){
		$this->load->view('userview');
	}

	public function view_addreview(){
		$this->load->view('review');
	}

	public function add_user(){
		$this->load->model('book');
		if($this->book->validate_reg($this->input->post()) === FALSE){
			$this->session->set_flashdata('errors', validation_errors());
			redirect("/");
		}
		if($user=$this->book->add_user($this->input->post())){

			$mail = $this->input->post('mail');
			$newuser= $this->book->get_user_bymail($mail);

			if($newuser){
				$this->session->set_userdata('loggedid',$newuser['user_id']);
				$tempvar = $newuser['name'];
				$this->session->set_userdata('loggedname',$tempvar);
				redirect('/');
			}				
		}
		else{
		redirect('/');	
		}
		
		
	}

	public function login(){
		$this->load->model('book');
		//var_dump($this->input->post());
		die();
		redirect('/');
	}
}