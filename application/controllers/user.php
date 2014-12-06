<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {
	public function __construct(){
		parent::__construct();
		if(Auth::isLoggedIn() ) redirect("user/profile");
	}
	public function profile($user_id=""){
		// if(!Auth::isLoggedIn() ) redirect('home');
		$this->load->model("model_user");
		if($user_id == "") $user_id = $this->session->userdata("user_id");
		$getUser = $this->model_user->getUser(array('user_id'=>$user_id,'single'=>true));
		
		//view
		$data['user'] = $getUser;
		$this->load->view('profile',$data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */