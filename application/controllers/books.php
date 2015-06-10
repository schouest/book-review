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
		//var_dump($this->input->post());
		
		redirect('/');
	}

	public function login(){
		//var_dump($this->input->post());
		die();
		redirect('/');
	}
}