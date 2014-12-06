<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Game extends MY_Controller {
	public function __construct(){
		parent::__construct();
		if(!Auth::isLoggedIn() ) redirect("home");
	}
	public function roomlist($offset=0){ // list of available game room
		$this->load->model("model_gameroom");
		$embedString = "";
		$topic_difficulty = "";
		if($this->input->get('d') ){
			$params['topic_difficulty'] = trim($this->input->get('d'));
			$topic_difficulty = $this->input->type('d');
			$embedString = "?d=".$topic_difficulty;
		}
		$params['count'] = true;
		$count = $this->model_gameroom->getRoom($params);
		$config = $this->configpagination;
		$config['base_url']       = site_url('game/roomlist');
		$config['uri_segment']    = 3;
		$config['total_rows']     = $count;
		$config['per_page']       = $this->per_page;
		$config['num_links']      = 5;
		$this->load->library('pagination', $config);
		$data['pagination']     = $this->pagination->create_links();
		$data['pagination']     = embedSuffixInPaging($embedString,$data['pagination']);
		unset($params['count']);
		$params['offset'] = $offset;
		$params['limit'] = $this->per_page;
		$getRoom = $this->model_gameroom->getRoom($params);
		
		//view
		$data['room'] = $getRoom; // join with user table already and topic
		$data['no_node'] = true;
		$data['topic_difficulty'] = $topic_difficulty; //for filtering. if empty, then no filter.

		$this->load->view("roomlist",$data);
	}
	
	public function createroom(){
		$this->load->model("model_gameroom");
		$this->load->model("model_topic");
		$error_message = "";
		if($this->input->post() ){
			$config = array(
				array(
                     'field'   => 'name',
                     'label'   => 'Name',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'topic_id',
                     'label'   => 'Topic',
                     'rules'   => 'trim|required'
                  )
            );
			$this->form_validation->set_rules($config); 
			if ($this->form_validation->run()){
				$insert_data['name'] = $this->input->post('name');	
				$insert_data['status'] = 'N';
				$insert_data['topic_id'] = $this->input->post('topic_id');
				$insert_data['created_by_user_id'] = $this->session->userdata("user_id");
				$insert_data['created_date'] = date("Y-m-d H:i:s");
				$room_id = $this->model_gameroom->insert($insert_data);
				redirect('game/in_room/'.$room_id);
			}else{
				$error_message = validation_error();
			}
		}
		$getTopic = $this->model_topic->getTopic();
		//view
		$data['topic'] = $getTopic; 
		$data['no_node'] = true;
		$data['error_message'] = $error_message; // check if it is empty or not
		$this->load->view("",$data);
	}
	public function in_room($room_id=""){
		if($room_id == "") redirect('home');
		//check if room_id is exist
		$this->load->model("model_gameroom");
		$this->load->model("model_usergame");
		$getRoom = $this->model_gameroom->getRoom(array('guid'=>$room_id,'status'=>'N','single'=>true));
		if(count($getRoom) == 0) redirect('home');
		//save player to database so we know who in the room
		//check first if it is in the room or not before
		$getUsergame = $this->model_usergame->getUsergame(array('guid'=>$room_id,'user_id'=>$this->session->userdata('user_id')));
		if(count($getUsergame) == 0){
			//save
			$insert_data['user_id'] = $this->session->userdata("user_id");
			$insert_data['guid'] = $room_id;
			$this->model_usergame->insert($insert_data);
		}
		//get all players in the room
		$getUsergame = $this->model_usergame->getUsergame(array('guid'=>$room_id));
		//view
		$data['room'] = $getRoom; // join with user table already and topic
		$data['user_game'] = $getUsergame; // join with user table already and topic
		$data['error_message'] = $error_message; // check if it is empty or not
		$this->load->view("",$data);
	}
	public function refresh_room($guid=""){ //refresh the room to get the updated players in room
		if($guid == "") redirect('home');
		//check if room_id is exist
		$this->load->model("model_gameroom");
		$this->load->model("model_usergame");
		$getRoom = $this->model_gameroom->getRoom(array('guid'=>$guid,'status'=>'N','single'=>true,'not_join_topic'=>true,'not_join_user'=>true));
		if(count($getRoom) == 0) redirect('home');
		//get all players in the room
		$getUsergame = $this->model_usergame->getUsergame(array('guid'=>$guid));
		$json = array();
		$i = 0;
		foreach($getUsergame as $ug){
			$json[$i] = $ug;
			$json[$i]['is_creator'] = false;
			if($ug['user_id'] == $getRoom['created_by_user_id']) $json[$i]['is_creator'] = true;
			$i++;
		}
		echo json_encode($json);
	}
	
	public function cancelroom($guid=""){ // called using ajax. after calling this, parse the return string, and emit to nodejs to refresh the page from all players or redirect user to main. the current use is always redirected
		if($guid == "") redirect('home');
		$this->load->model("model_gameroom");
		$this->load->model("model_usergame");
		$getRoom = $this->model_gameroom->getRoom(array('guid'=>$guid,'status'=>'N','single'=>true,'not_join_topic'=>true,'not_join_user'=>true));
		if(count($getRoom) == 0) redirect('home');
		if($this->session->userdata("user_id") == $getRoom['created_by_user_id']){
			// delete all players
			$this->model_usergame->delete(array('guid'=>$guid));
			// emit to redirect all players
			echo "redirect";
		}else{
			// delete this player
			$this->model_usergame->delete(array('guid'=>$guid,'user_id'=>$this->session->userdata('user_id')));
			// emit to refresh the page by ajax (refresh_room)
			echo "refresh";
		}
	}

	public function result($guid=""){ // result page
		if($guid == "") redirect('home');
		//check if room_id is exist
		$this->load->model("model_gameroom");
		$this->load->model("model_usergame");
		$getRoom = $this->model_gameroom->getRoom(array('guid'=>$guid,'status'=>'E','single'=>true,'not_join_user'=>true));
		if(count($getRoom) == 0) redirect('home');
		//get all players in the room
		$getUsergame = $this->model_usergame->getUsergame(array('guid'=>$guid));
		$players = array();
		$i = 0;
		foreach($getUsergame as $ug){
			$players[$i] = $ug;
			$players[$i]['is_creator'] = false;
			if($ug['user_id'] == $getRoom['created_by_user_id']) $players[$i]['is_creator'] = true;
			$i++;
		}
		
		//view
		$data['room'] = $getRoom; // join with user table already and topic
		$data['user_game'] = $players; // join with user table already and topic
		$this->load->view("",$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */