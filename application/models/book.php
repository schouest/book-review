<?php
class book extends CI_Model {

function get_all_users(){
    return $this->db->query("SELECT * FROM users")->result_array();
}

function get_all_authors(){
    return $this->db->query("SELECT * FROM authors")->result_array();
}

function get_all_books(){
    return $this->db->query("SELECT * FROM books")->result_array();
}

function get_all_reviews(){//well, last 3 of them at least
    return $this->db->query("SELECT * FROM reviews LEFT JOIN users ON users.user_id = reviews.user_id LEFT JOIN books ON books.book_id = reviews.book_id ORDER BY date_added DESC LIMIT 3")->result_array();
}
 
function get_user($id){
	return $this->db->query("SELECT * FROM users WHERE user_id = ?", array($id))->row_array();
}

function get_user_bymail($mail){
	return $this->db->query("SELECT * FROM users WHERE email = ?", array($mail))->row_array();
}

function get_book($id){
    return $this->db->query("SELECT * FROM books LEFT JOIN authors ON books.author_id = authors.author_id WHERE book_id = ?", array($id))->row_array();
}

function get_reviews_byid($bookid){
    return $this->db->query("SELECT * FROM reviews LEFT JOIN books ON books.book_id = reviews.book_id LEFT JOIN users ON users.user_id = reviews.user_id WHERE reviews.book_id = ?", array($bookid))->result_array();
}

function get_user_info($id){
    return $this->db->query("SELECT users.user_id, users.name, users.alias, users.email, reviews.date_added, reviews.review_id, books.book_id, books.title  FROM book_rev.users LEFT JOIN reviews ON users.user_id = reviews.user_id LEFT JOIN books ON books.book_id = reviews.book_id WHERE users.user_id = ?", array($id))->result_array();
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

    function add_review($book_id, $user_id, $review_info){
$query = "INSERT INTO reviews (book_id, user_id, rating, txt, date_added) VALUES (?,?,?,?,?)";
         $values = array($book_id, $user_id, $review_info['rating'], $review_info['review'], date("Y-m-d, H:i:s"));
         return $this->db->query($query, $values);
    }

}
?>