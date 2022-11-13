<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controller extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Main_model');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function login(){
		
		$username  = $this->input->post('username');
		$password  = $this->input->post('password');
		$user = $this->Main_model->get('users','id,username',array('username'=>$username,'password'=>$password),true);
		$tweets = $this->Main_model->get('tweets','*');
		$setCoookie = setcookie('userID',$user->id,time()+(86000*60),"/");
		$data = array(
			'user' => $user,
			'tweets'=>$tweets
		);
		
		if(!$user){
			echo "kullanıcı adı veya şifre yanlış";
		}else{
			$this->load->view('main',$data);
		}
	}

	public function signUp(){
		$username  = $this->input->post('usernameSign');
		$password  = $this->input->post('passwordSign');
		$user = $this->Main_model->get('users','username',array('username'=>$username),true);
		if(!isset($user->username)){
			$createUser = $this->Main_model->insert('users',array('username'=>$username,'password'=>$password));
			$info = "Kaydınız başarıyla oluşturuldu!";
		}else{
			$info = "Bu kullanıcı adı zaten kullanımda!";
		}
		echo $info;
	}

	public function profile($username){
		$profileOwmer = $this->Main_model->get('users','*',array('username'=>$username),true);
		$tweets = $this->Main_model->get('tweets','*',array('userID'=>$profileOwmer->id));
		
		$data = array(
			'profileOwner' => $profileOwmer,
			'tweets'=>$tweets
		);

		$this->load->view('profile',$data);
	}
}