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


	function create_user($user_info){//salted
if(isset($user_info['passcode'])){
	$salt = bin2hex(openssl_random_pseudo_bytes(22));
	$encrypt_pass = md5($user_info['passcode'] . '' . $salt);
}

$query = "INSERT INTO users (email, password, first_name, last_name, user_level, date_created, date_updated, salt) VALUES (?,?,?,?,?,?,?,?)";
         $values = array($user_info['mail'], $encrypt_pass, $user_info['f_name'], $user_info['l_name'], 1, date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"), $salt); 
         return $this->db->query($query, $values);
}

}
?>