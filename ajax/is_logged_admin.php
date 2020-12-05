<?php	
	session_start();
	if (!isset($_SESSION['user_login_admin_status']) AND $_SESSION['user_login_admin_status'] != 1) {
        header("location: ./admin/loginAdmin.php");
		exit;
    }