<?php
require_once('../config.php');
Class Users extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	public function save_users(){
		if(empty($_POST['password']))
			unset($_POST['password']);
		else
		$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
		extract($_POST);
		$data = '';
		foreach($_POST as $k => $v){
			if(!in_array($k,array('id', 'cpassword'))){
				if(!empty($data)) $data .=" , ";
				$v = $this->conn->real_escape_string($v);
				$data .= " {$k} = '{$v}' ";
			}
		}
		if(empty($id) && !isset($_POST['type'])){
			if(!empty($data)) $data .=" , ";
			$data .= " `type` = 2 ";
		}
		if(empty($id)){
			$qry = $this->conn->query("INSERT INTO users set {$data}");
			if($qry){
				$id=$this->conn->insert_id;
				$this->settings->set_flashdata('success','User Details successfully saved.');
				foreach($_POST as $k => $v){
					if($k != 'id'){
						if($this->settings->userdata('id') == $id)
						$this->settings->set_userdata($k,$v);
					}
				}
				if(!empty($_FILES['img']['tmp_name'])){
					if(!is_dir(base_app."uploads/avatars"))
						mkdir(base_app."uploads/avatars");
					$ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
					$fname = "uploads/avatars/$id.png";
					$accept = array('image/jpeg','image/png');
					if(!in_array($_FILES['img']['type'],$accept)){
						$err = "Image file type is invalid";
					}
					if($_FILES['img']['type'] == 'image/jpeg')
						$uploadfile = imagecreatefromjpeg($_FILES['img']['tmp_name']);
					elseif($_FILES['img']['type'] == 'image/png')
						$uploadfile = imagecreatefrompng($_FILES['img']['tmp_name']);
					if(!$uploadfile){
						$err = "Image is invalid";
					}
					$temp = imagescale($uploadfile,200,200);
					if(is_file(base_app.$fname))
					unlink(base_app.$fname);
					$upload =imagepng($temp,base_app.$fname);
					if($upload){
						$this->conn->query("UPDATE `users` set `avatar` = CONCAT('{$fname}', '?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$id}'");
						if($this->settings->userdata('id') == $id)
						$this->settings->set_userdata('avatar',$fname."?v=".time());
					}

					
				}
				return 1;
			}else{
				return 2;
			}

		}else{
			$qry = $this->conn->query("UPDATE users set $data where id = {$id}");
			if($qry){
				$this->settings->set_flashdata('success','User Details successfully updated.');
				foreach($_POST as $k => $v){
					if($k != 'id'){
						if($this->settings->userdata('id') == $id)
							$this->settings->set_userdata($k,$v);
					}
				}
				if(!empty($_FILES['img']['tmp_name'])){
					if(!is_dir(base_app."uploads/avatars"))
						mkdir(base_app."uploads/avatars");
					$ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
					$fname = "uploads/avatars/$id.png";
					$accept = array('image/jpeg','image/png');
					if(!in_array($_FILES['img']['type'],$accept)){
						$err = "Image file type is invalid";
					}
					if($_FILES['img']['type'] == 'image/jpeg')
						$uploadfile = imagecreatefromjpeg($_FILES['img']['tmp_name']);
					elseif($_FILES['img']['type'] == 'image/png')
						$uploadfile = imagecreatefrompng($_FILES['img']['tmp_name']);
					if(!$uploadfile){
						$err = "Image is invalid";
					}
					$temp = imagescale($uploadfile,200,200);
					if(is_file(base_app.$fname))
					unlink(base_app.$fname);
					$upload =imagepng($temp,base_app.$fname);
					if($upload){
						$this->conn->query("UPDATE `users` set `avatar` = CONCAT('{$fname}', '?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$id}'");
						if($this->settings->userdata('id') == $id)
						$this->settings->set_userdata('avatar',$fname."?v=".time());
					}

					
				}

				return 1;
			}else{
				return "UPDATE users set $data where id = {$id}";
			}
			
		}
	}
	public function delete_users(){
		extract($_POST);
		$qry = $this->conn->query("DELETE FROM users where id = $id");
		if($qry){
			$this->settings->set_flashdata('success','User Details successfully deleted.');
			if(is_file(base_app."uploads/avatars/$id.png"))
				unlink(base_app."uploads/avatars/$id.png");
			return 1;
		}else{
			return false;
		}
	}
	public function update_password(){
		extract($_POST);
		$id = $this->settings->userdata('id');
		$qry = $this->conn->query("SELECT `password` FROM users where id = '{$id}'");
		$pass = $qry->fetch_array()[0];
		if(!password_verify($oldpassword, $pass)){
			return 2;
		}
		$hashed = password_hash($newpassword, PASSWORD_DEFAULT);
		$update = $this->conn->query("UPDATE users set `password` = '{$hashed}' where id = '{$id}'");
		if($update){
			return 1;
		}else{
			return 0;
		}
	}
}

$users = new users();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
switch ($action) {
	case 'save':
		echo $users->save_users();
	break;
	case 'delete':
		echo $users->delete_users();
	break;
	case 'update_password':
		echo $users->update_password();
	break;
	default:
		// echo $sysset->index();
		break;
}