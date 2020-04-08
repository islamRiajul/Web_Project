<?php
	session_start();
	$email    = "";
	$errors = array();
	$con = mysqli_connect('localhost','root','','ttblog');

	// $email = mysqli_real_escape_string($con, $_POST['email']);
	// $password = $_POST['pass'];

	// $s= "select * from registration where email = '$email' && password = '$password' ";
	// $result = mysqli_query($con, $s);
	// $num = mysqli_num_rows($result);

	// if($num == 1){
	//     $_SESSION['email'] = $email;

	//     header('location:adminProfile.php');
	// }
	// else{
	// 	array_push($errors, "Username or Email is Invalid ");
	//     header('location:login.php');
	// }

	if (isset($_POST['login_user'])) {
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$password = $_POST['pass'];
			if (empty($email)) {
				array_push($errors, "Email is required");
			}
			if (empty($password)) {
				array_push($errors, "Password is required");
			}

			if (count($errors) == 0) {
				// $password = md5($password);
				$query = "SELECT * FROM registration WHERE email='$email' AND password='$password'";
				
				$results = mysqli_query($con, $query);
				$a=mysqli_num_rows($results);

				if ($a == 1) {
					
					$_SESSION['success'] = "You are now logged in";
					$_SESSION['email'] = $email;
					header('location:adminProfile.php');
				}else {
					array_push($errors, "Wrong email/password combination");
				}
			}
		}

	if (isset($_POST['update'])) {
			$name = mysqli_real_escape_string($con, $_POST['name']);
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$bio = mysqli_real_escape_string($con, $_POST['bio']);

			$email = $_SESSION['email'];
			if (empty($name)) {
				array_push($errors, "Name is required");
			}
				// $password = md5($password);
				// $query = "SELECT * FROM registration WHERE email='$email' AND password='$password'";
				$sql = " UPDATE registration SET name='$name' , bio='$bio' WHERE email='$email'";
				$results = mysqli_query($con, $sql);
				header('location:profile.php');
		}