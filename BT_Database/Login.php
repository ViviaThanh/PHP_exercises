<?php
require_once 'db3010.php'; 

session_start(); 
$message = ''; 

try {
    $db = new DbHelper(); 
} catch (Exception $e) {
    die("Lỗi không thể kết nối CSDL: " . $e->getMessage());
}



if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if (isset($_POST['username']) && isset($_POST['password'])) {
        
        $username_form = $_POST['username'];
        $password_form = $_POST['password'];


        $sql = "SELECT password FROM account WHERE username = ?";
        $params = [$username_form]; 

        $account = $db->select($sql, $params, false); 

       if ($account) {

    // kiểm tra mật khẩu 
    if ($password_form === $account->password) {
        $_SESSION['logged'] = $username_form;
        header("Location: listofusers3010.php");
        exit;
    } else {
        $message = "Sai tên truy cập hoặc mật khẩu";
    }

} else {
    $message = "Sai tên truy cập hoặc mật khẩu";
}

    }
}
?>

<!DOCTYPE html>
<html lang="en">

	<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<title>Login</title>	
	</head>
	<body>
		<?php 	if ($message) : ?>		
			<p style="color: red"><?=$message; ?></p>
		<?php 	endif; ?>		
		<h4> Login form </h2>
		<form method = "POST" action = "Login.php">
			<label for="username"> Username </label>
			<input type="text" name="username" id = "username" required /> <br>
			<label for="password">Password </label>
			<input type="password" name="password" id = "password" required /> <br>
			<button type="submit" name = "login"> Login </button>
		</form>
	
	<script src="js/boostrap.min.js"> </script>
	</body>
</html>