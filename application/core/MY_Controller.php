<?php defined('BASEPATH') or die('No direct script access.');

class MY_Controller extends CI_Controller {
	var $data;
	var $configpagination;
	var $per_page = 8;
	public function __construct(){
		parent::__construct();
		
		//pagination area
		$config = array();
		/* $config['full_tag_open'] = '<ul class="list-inline list-unstyled">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = '<i class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i>';
		$config['first_tag_open'] = '<li class="prev">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>';
		$config['last_tag_open'] = '<li class="next">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '<i class="fa fa-angle-right"></i>';
		$config['next_tag_open'] = '<li class="next">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>'; */
		$this->configpagination = $config;
		
		unset($config);
	}
}