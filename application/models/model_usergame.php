<?php
class Model_usergame extends CI_Model {
	function __construct(){
	}
	public function getUsergame($params=array()){
		$this->db->from("usergame");
		$this->db->join('user','usergame.user_id=user.user_id');
		if(isset($params['user_id']) ) $this->db->where('user_id',$params['user_id']);
		if(isset($params['guid']) ) $this->db->where('guid',$params['guid']);
		
		if(isset($params['limit']) && isset($params['offset']) ) $this->db->limit($params['limit'],$params['offset']);
		$query = $this->db->get();
		if(isset($params['count']) ){
			$return = count($query->result_array());
		}else if(isset($params['single']) ){
			$return = $query->row_array();
		}else{
			$return = $query->result_array();
		}
		return $return;
	}
	
	public function insert($insert_data) {
		$this->db->insert('usergame',$insert_data);
		return $this->db->insert_id();
	}
	
	public function update($user_game_id,$insert_data){
		$this->db->where('user_game_id', $user_game_id);
		$this->db->update('usergame', $insert_data);
	}	

	public function delete($params=array()){
		if(isset($params['guid']) ) $this->db->where('guid', $params['guid']);
		if(isset($params['user_id']) ) $this->db->where('user_id', $params['user_id']);
		$this->db->delete('usergame');
	}	
	
}