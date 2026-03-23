<?php
require_once('../config.php');
Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function delete_img(){
		extract($_POST);
		if(is_file($path)){
			if(unlink($path)){
				$resp['status'] = 'success';
			}else{
				$resp['status'] = 'failed';
				$resp['error'] = 'failed to delete '.$path;
			}
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = 'Unkown '.$path.' path';
		}
		return json_encode($resp);
	}
	function save_category(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = htmlspecialchars($this->conn->real_escape_string($v));
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `category_list` where `name` = '{$name}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "category Name already exists.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `category_list` set {$data} ";
		}else{
			$sql = "UPDATE `category_list` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$sid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['sid'] = $sid;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "New Category successfully saved.";
			else
				$resp['msg'] = " Category successfully updated.";
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	function delete_category(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `category_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Category successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function save_inquiry(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id', 'visitor'))){
				if(!empty($data)) $data .=",";
				$v = htmlspecialchars($this->conn->real_escape_string($v));
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `inquiry_list` set {$data} ";
		}else{
			$sql = "UPDATE `inquiry_list` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$resp['status'] = 'success';
			if(empty($id)){
				if(!isset($visitor))
					$resp['msg'] = "New Inquiry successfully saved.";
					else
					$resp['msg'] = "Your Message has been sent successfully. We will reach out using your contact information as soon as we sees your message. Thank you!";
			}else
				$resp['msg'] = " Inquiry successfully updated.";
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	function delete_inquiry(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `inquiry_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Inquiry successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function save_item(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!is_array($_POST[$k]) && !in_array($k,array('id', 'founder'))){
				if(!empty($data)) $data .=",";
				$v = htmlspecialchars($this->conn->real_escape_string($v));
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `item_list` set {$data} ";
		}else{
			$sql = "UPDATE `item_list` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$resp['status'] = 'success';
			$iid = empty($id) ? $this->conn->insert_id : $id;
			$resp['iid'] = $iid;
			$data = "";
			if(!empty($_FILES['image']['tmp_name'])){
				if(!is_dir(base_app."uploads/items"))
					mkdir(base_app."uploads/items");
				$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				$fname = "uploads/items/$iid.png";
				$accept = array('image/jpeg','image/png');
				if(!in_array($_FILES['image']['type'],$accept)){
					$err = "Image file type is invalid";
				}
				if($_FILES['image']['type'] == 'image/jpeg')
					$uploadfile = imagecreatefromjpeg($_FILES['image']['tmp_name']);
				elseif($_FILES['image']['type'] == 'image/png')
					$uploadfile = imagecreatefrompng($_FILES['image']['tmp_name']);
				if(!$uploadfile){
					$err = "Image is invalid";
				}
				list($width,$height) = getimagesize($_FILES['image']['tmp_name']);
				$temp = imagescale($uploadfile,$width,$height);
				if(is_file(base_app.$fname))
				unlink(base_app.$fname);
				$upload =imagepng($temp,base_app.$fname);
				if($upload){
					$this->conn->query("UPDATE `item_list` set `image_path` = CONCAT('{$fname}', '?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$iid}'");
				}
			}
			if(empty($id)){
				if(!isset($founder))
					$resp['msg'] = "New Item Data has been saved successfully.";
					else
					$resp['msg'] = "Found Item Data successfully submitted. We'll review your submmited details first before publishin it to the public.";
			}else
				$resp['msg'] = " Item Data has been updated successfully.";
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	function delete_item(){
		extract($_POST);
		$this->conn->query("DELETE FROM `item_images` where item_id = '{$id}'");
		$this->conn->query("DELETE FROM `claims` where item_id = '{$id}'");
		$del = $this->conn->query("DELETE FROM `item_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Item Data successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function save_page(){
		extract($_POST);
		if(!is_dir(base_app.'pages'))
		mkdir(base_app.'pages');
		if(isset($page['welcome'])){
			$content = $page['welcome'];
			$save = file_put_contents(base_app.'pages/welcome.html', $content);
		}
		if(isset($page['about'])){
			$content = $page['about'];
			$save = file_put_contents(base_app.'pages/about.html', $content);
		}
		$this->settings->set_flashdata('success', "Page Content has been updated successfully");
		return json_encode(['status' => 'success']);
	}
	function save_claim(){
		extract($_POST);
		$user_id = $this->settings->userdata('id');
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = htmlspecialchars($this->conn->real_escape_string($v));
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(!empty($data)) $data .=",";
		$data .= " `user_id`='{$user_id}' ";

		if(empty($id)){
			$sql = "INSERT INTO `claims` set {$data} ";
		}else{
			$sql = "UPDATE `claims` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		if($save){
			$resp['status'] = 'success';
			$cid = empty($id) ? $this->conn->insert_id : $id;
			if(!empty($_FILES['proof_file']['tmp_name'])){
				if(!is_dir(base_app."uploads/claims"))
					mkdir(base_app."uploads/claims");
				$ext = pathinfo($_FILES['proof_file']['name'], PATHINFO_EXTENSION);
				$fname = "uploads/claims/$cid.$ext";
				$move = move_uploaded_file($_FILES['proof_file']['tmp_name'], base_app.$fname);
				if($move){
					$this->conn->query("UPDATE `claims` set `proof_file_path` = '{$fname}' where id = '{$cid}'");
				}
			}
			$this->settings->set_flashdata('success', "Claim successfully submitted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_faq(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `faqs` set {$data} ";
		}else{
			$sql = "UPDATE `faqs` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "New FAQ successfully saved.";
			else
				$resp['msg'] = " FAQ successfully updated.";
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	function delete_faq(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `faqs` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," FAQ successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function save_message(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `messages` set {$data} ";
		}else{
			$sql = "UPDATE `messages` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		if($save){
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_broadcast(){
		extract($_POST);
		$users = $this->conn->query("SELECT id FROM users WHERE `type` = 2");
		$success = 0;
		while($user = $users->fetch_assoc()){
			$uid = $user['id'];
			$sql = "INSERT INTO `notifications` (`user_id`, `title`, `message`) VALUES ('{$uid}', 'System Broadcast', '{$message}')";
			$save = $this->conn->query($sql);
			if($save) $success++;
		}
		if($success > 0){
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = 'Could not send broadcast to any users.';
		}
		return json_encode($resp);
	}
	function delete_claim(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `claims` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Claim successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function delete_conversation(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `messages` where (sender_id = '{$id}' AND receiver_id = 1) OR (sender_id = 1 AND receiver_id = '{$id}')");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Conversation successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'delete_img':
		echo $Master->delete_img();
	break;
	case 'save_category':
		echo $Master->save_category();
	break;
	case 'delete_category':
		echo $Master->delete_category();
	break;
	case 'save_page':
		echo $Master->save_page();
	break;
	case 'save_item':
		echo $Master->save_item();
	break;
	case 'delete_item':
		echo $Master->delete_item();
	break;
	case 'save_inquiry':
		echo $Master->save_inquiry();
	break;
	case 'delete_inquiry':
		echo $Master->delete_inquiry();
	break;
	case 'save_claim':
		echo $Master->save_claim();
	break;
	case 'save_faq':
		echo $Master->save_faq();
	break;
	case 'delete_faq':
		echo $Master->delete_faq();
	break;
	case 'save_message':
		echo $Master->save_message();
	break;
	case 'save_broadcast':
		echo $Master->save_broadcast();
	break;
	case 'delete_claim':
		echo $Master->delete_claim();
	break;
	case 'delete_conversation':
		echo $Master->delete_conversation();
	break;
	default:
		// echo $sysset->index();
		break;
}