<?php
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Load session library
        $this->load->library('session');
        
        // Load the captcha helper
        $this->load->helper('captcha');

		$this->load->model('login_model');
		// $this->load->library('form');
		$this->load->library('form_validation');
	}

	function index(){
		// $this->load->helper('captcha');

		$vals = array(
			'img_path' => './captcha/',
			'img_url' => base_url().'captcha/',
			'expiration' => 50000,
			'word_lenght' => 5,
			'font_size' => 25,
			'img_width' => 180,
			'img_height' => 40
		);

		$cap = create_captcha($vals);
		$data['captcha'] = $cap['image'];
		$this->session->set_userdata('captchaWord', $cap['word']);

		$this->load->view('layout/header');
		$this->load->view('login_view',$data);
		$this->load->view('layout/footer');
	}

	function form_user(){
		// $this->load->helper('captcha');

		$vals = array(
			'img_path' => './captcha/',
			'img_url' => base_url().'captcha/',
			'expiration' => 50000,
			'word_lenght' => 5,
			'font_size' => 25,
			'img_width' => 180,
			'img_height' => 40
		);

		$cap = create_captcha($vals);
		$data['captcha'] = $cap['image'];
		$this->session->set_userdata('captchaWord', $cap['word']);

		$this->load->view('layout/header');
		$this->load->view('register',$data);
		$this->load->view('layout/footer');
	}

	function add_user()
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		// $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|callback_matching_captcha');

		// var_dump($_POST);
		// exit();
		if($this->form_validation->run()){
			$name = $_POST['name'];
			$email = $_POST['email'];
			$username = $_POST['username'];
			$password = sha1($_POST['password']);

			$data = array(
				// 'id' => $column_id,
	            'username' => $username,
	            'password' => $password,
	            'email' => $email,
	            'name' => $name
	            
			);
			$this->login_model->create_user($data);
			redirect(base_url().'login');
		}else{
			$this->form_user();
		}

	}

	function get_user_by_id(){
		$id = $_POST['user'];
		$data['user_data'] = $this->login_model->get_single_user($id);

		echo json_encode($data['user_data']);
	}

	function form_edit_user(){
		// var_dump($_POST);
		$id = $_POST['id'];
		$user_data = $this->login_model->get_single_user($id);
		// var_dump($data);
		// exit();
		// $this->load->view('edit_user',$data);

		// $id = $_POST['employee'];
	 //    $employee = $this->excel_export_model->get_single_employee($id);;
	    // echo var_dump($employee[0]->id);
	    // echo $employee[0]->birthday;

    	$id = $user_data[0]->id;
        $name = $user_data[0]->name;
        $username = $user_data[0]->username;
        // $password = $user_data[0]->password;
        $email = $user_data[0]->email;

	    echo "<div id='user-detail-content'>
	    		<input type='hidden' name='id-user' id='id-user' class='form-control' value='$id' />
	    		<div class='form-group col-md-12'>                               
	            	<label>Enter Your Name</label>  
	            	<input type='text' name='name' id='name' class='form-control' value='$name' required/> 
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Enter Username</label>  
	            	<input type='text' name='username' id='username' class='form-control' value='$username' required/> 
	            </div>
            	
	            <div class='form-group col-md-12'>                               
	            	<label>Enter Your Email</label>  
	            	<input type='email' name='email' id='email' class='form-control' value='$email' disabled/> 
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Enter Password</label>  
	            	<input type='password' name='password' id='password' class='form-control' value='' required/> 
	            </div>

	            <input type='hidden' name='id_employee' id='id_employee' class='form-control' value='$id' /> 
        	</div>";
        exit();

	}

	function edit_user(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		// $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|callback_matching_captcha');

		// var_dump($_POST);
		// exit();
		if($this->form_validation->run()){
			$id = $_POST['id'];
			$name = $_POST['name'];
			$email = $_POST['email'];
			$username = $_POST['username'];
			$password = sha1($_POST['password']);

			$data = array(
				// 'id' => $id,
	            'username' => $username,
	            'password' => $password,
	            'email' => $email,
	            'name' => $name
	            
			);
			$this->login_model->update_user($id,$data);
			redirect(base_url().'login');
		}else{
			$this->form_user();
		}
	}

	function refresh_captcha(){
		$this->load->helper('captcha');
		$vals = array(
			'img_path' => './captcha/',
			'img_url' => base_url().'captcha/',
			'expiration' => 50000,
			'word_lenght' => 5,
			'font_size' => 25,
			'img_width' => 180,
			'img_height' => 40
		);

		$data = create_captcha($vals);
		$this->session->set_userdata('captchaWord', $data['word']);
		echo $data['image'];
		// echo 'hahahahha';
	}

	function matching_captcha($str){
		if(strtolower($str) != strtolower($this->session->userdata('captchaWord'))){
			$this->form_validation->set_message('matching_captcha', 'The {field} did not matching');
			return false;
		}else{
			return true;
		}
	}

	function login(){
		$data['error'] = 0;
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		// $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|callback_matching_captcha');

		if($this->form_validation->run()){
			$data['username'] = $this->input->post('username', true);
			$data['password'] = $this->input->post('password', true);

			if ($_POST) {
				$this->load->model('login_model');
				$username = $data['username'];
				$password = $data['password'];
				$user = $this->login_model->login($username,$password);

				// var_dump($user);
				if ($user != null ) {
					$this->session->set_userdata('userID', $user['id']);
					redirect(base_url());
				}

				redirect(base_url().'login');

				// $this->load->view('layout/header');
				// $this->load->view('login_view');
				// $this->load->view('layout/footer');
			}
		}else{
			$this->index();
		}
		
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'login');
	}
}