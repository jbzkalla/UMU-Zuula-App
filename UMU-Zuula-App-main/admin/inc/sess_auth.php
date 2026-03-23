<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Get current URL info
$is_admin_panel = strpos($_SERVER['REQUEST_URI'], '/admin/') !== false;
$is_user_panel = strpos($_SERVER['REQUEST_URI'], '/user/') !== false;
$is_login_page = strpos($_SERVER['REQUEST_URI'], 'login.php') !== false || (isset($_GET['page']) && $_GET['page'] == 'login');

// Check if user is logged in
if(!isset($_SESSION['userdata'])){
    // Not logged in
    if($is_admin_panel && !$is_login_page){
        header('Location: '.base_url.'admin/login.php');
        exit;
    }
    if($is_user_panel){
        header('Location: '.base_url.'?page=login');
        exit;
    }
} else {
    // Logged in - check permissions
    $user_type = $_SESSION['userdata']['login_type']; // 1 = Admin, 2 = User

    if($is_admin_panel && $user_type != 1 && !$is_login_page){
        // Student trying to access Admin
        echo "<script>alert('Access Denied! Administrators only.'); location.replace('".base_url."user/');</script>";
        exit;
    }
    
    if($is_user_panel && $user_type != 2){
        // Admin trying to access User panel (optional: allow it? usually fine, but let's separate)
        // echo "<script>alert('Access Denied! Users only.'); location.replace('".base_url."admin/');</script>";
        // exit;
    }

    if($is_login_page){
        // Already logged in, redirect to respective dashboard
        if($user_type == 1) header('Location: '.base_url.'admin/');
        else header('Location: '.base_url.'user/');
        exit;
    }
}
?>
