<?php
class book extends CI_Model {

function get_all_users(){
    return $this->db->query("SELECT * FROM users")->result_array();
}
 
function get_user($id){
	return $this->db->query("SELECT * FROM users WHERE user_id = ?", array($id))->row_array();
}

function get_user_bymail($mail){
	return $this->db->query("SELECT * FROM users WHERE email = ?", array($mail))->row_array();
}


	function validate_reg($post){
$this->load->library('form_validation');
        $this->form_validation->set_rules('name', "Name", 'required|trim|alpha');
        $this->form_validation->set_rules('alias', "Alias", 'required|trim|alpha');
        $this->form_validation->set_rules('mail', "Email", 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('passcode', 'Password', 'required|trim|matches[cpasscode]|min_length[8]');
        $this->form_validation->set_rules('cpasscode', 'Confirm Password','trim');

        if($this->form_validation->run() === FALSE){
            return FALSE;
        }
        else{
                    return TRUE;
        }    	
	}

	function validate_login($post){
$this->load->library('form_validation');
        $this->form_validation->set_rules('mail', "Email", 'required|valid_email');
        $this->form_validation->set_rules('passcode', 'Password', 'required|trim');

        if($this->form_validation->run() === FALSE){
            return FALSE;
        }
        else{
                    return TRUE;
        }
}  

	function add_user($user_info){//unsalted
$encrypt_pass = md5($user_info['passcode']);
$query = "INSERT INTO users (email, password, name, alias, date_created) VALUES (?,?,?,?,?)";
         $values = array($user_info['mail'], $encrypt_pass, $user_info['name'], $user_info['alias'], date("Y-m-d, H:i:s")); 
         return $this->db->query($query, $values);
	}


    function add_author($author_name){
$query = "INSERT INTO authors (name, date_created) VALUES (?,?)";
         $values = array($author_name, date("Y-m-d, H:i:s"));

        return $this->db->query($query, $values);
    }

    function add_book($book_info){
        if(!empty($book_info['newauthor'])){
            $book_id = $this->db->insert_id();//new author id from last entered auto increment
        }
        else{
            $book_id = $book_info['author'];//old author id from form
        }
    $query = "INSERT INTO books (title, author_id, date_created) VALUES (?,?,?)";
        $values = array($book_info['title'], $book_id, date("Y-m-d, H:i:s"));
        return $this->db->query($query, $values);
    }

}
?>