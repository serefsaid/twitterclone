<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tweet extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Main_model');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	}
	public function tweet(){
		$tweet = $this->input->post('tweet');
		$userID = $this->input->post('userID');
		$tweet = $this->Main_model->insert('tweets',array('tweet'=>$tweet,'userID'=>$userID));
		if($tweet){
			$sent = 0;
		}else{
			$sent = 1;
		}
		echo $sent;
	}

    function delete($id){
        $tweet = $this->Main_model->delete('tweets',array('id'=>$id));
        header('main.php');
    }

    function like($id){
        $likeQuantity = $this->Main_model->get('tweets','like',array('id'=>$id),true);
        $like = $this->Main_model->update('tweets',array('id'=>$id),array('like'=>$likeQuantity->like+1));
    }
}