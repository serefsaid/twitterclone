<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tweet extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Main_model');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	}

    function delete($id){
        $tweet = $this->Main_model->delete('tweets',array('id'=>$id));
        if($tweet){
            echo "tweet silindi";
        }else{
            echo "tweet silme başarısız";
        }
    }

    function like($id){
        $likeQuantity = $this->Main_model->get('tweets','like',array('id'=>$id),true);
        $like = $this->Main_model->update('tweets',array('id'=>$id),array('like'=>$likeQuantity->like+1));
    }
}