<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class books extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->output->enable_profiler(TRUE);
	}
	public function index()
	{
		if(!empty($this->session->userdata('loggedid'))){
			redirect('mainpage');
		}
		if(null ===($this->session->userdata('loggedid'))){
			$this->session->set_userdata('loggedid',0);
		}
		$this->load->view('index');
	}

	public function view_mainpage(){
		$this->load->model('book');
		if($reviews=$this->book->get_all_reviews()){
			$books=$this->book->get_all_books();

			$this->load->view('mainpage', array('recentreviews' => $reviews, 'allbooks' => $books));
		}
		else{
		redirect('/');
		}
	}

	public function view_addbook(){
		$this->load->model('book');
		if($get_authors= $this->book->get_all_authors()){
			$this->load->view('addbook', array('authors' => $get_authors));
		}
		else{
		redirect('/');
		}
	}

	public function view_user($id){
		$this->load->model('book');
		$get_info= $this->book->get_user_info($id);


		$this->load->view('userview', array('user_info' => $get_info));
	}

	public function view_addreview($id){
		$this->load->model('book');
		if($book=$this->book->get_book($id)){
			$reviews=$this->book->get_reviews_byid($id);
			$this->load->view('review', array('book' => $book, 'reviews' => $reviews));
		}
		else{
			redirect('/');
		}		
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
				$this->session->set_userdata('loggedname',$newuser['name']);
				$this->session->set_userdata('loggedalias',$newuser['alias']);
				redirect('mainpage');
			}				
		}
		else{
		redirect('/');	
		}	
	}

	public function login(){
		$this->load->model('book');
		if($this->book->validate_login($this->input->post()) === FALSE){
			$this->session->set_flashdata('errors', validation_errors());
		}
		$mail = $this->input->post('mail');
		$passcode = $this->input->post('passcode');
		$user= $this->book->get_user_bymail($mail);
		
		if($user)
		{//=success
			$encrypt_pass = md5($passcode);
			if($encrypt_pass == $user['password'])
			{
				$this->session->set_userdata('loggedid',$user['user_id']);
				$this->session->set_userdata('loggedname',$user['name']);
				$this->session->set_userdata('loggedalias',$user['alias']);
				redirect('mainpage');
			}
			$this->session->set_flashdata('errors', 'Invalid Login Credentials');
			/*echo $passcode .'-> ' . $encrypt_pass . ' is not equal to ' . $user['password'] . ' and the salt is ' . $salt;
			die();*/		
		}//=failure
			$this->session->set_flashdata('errors', 'Invalid Login Credentials');
		redirect('/');
	}

	public function logout(){
		$this->session->unset_userdata('loggedname');
		$this->session->unset_userdata('loggedid');
		$this->session->unset_userdata('loggedalias');
		redirect('/');
	}

	public function add_book(){
		$this->load->model('book');
		if(!empty($this->input->post('newauthor'))){
            if($newauthor= $this->book->add_author($this->input->post('newauthor'))){//sql model for add author
            	$author = $this->input->post('newauthor');
            }     
        }
        else{//fall back to dropdown selected previous author
            	$author = $this->input->post('author');       
        }
		if($user=$this->book->add_book($this->input->post())){
			$insert_id = $this->db->insert_id();

			$this->book->add_review($insert_id,$this->session->userdata('loggedid'),$this->input->post());//put in review
			redirect("review/$insert_id");
		}
		redirect('addbook');
	}

	public function add_review($book_id){//add review to previously existing book
		$this->load->model('book');
		$this->book->add_review($book_id,$this->session->userdata('loggedid'),$this->input->post());//put in review
		redirect("review/$book_id");
	}

}