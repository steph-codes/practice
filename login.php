<?php
if ($_POST) {
	include('user.php');
	$obj = new User;
	$logged= $obj->login($_POST['mail'],$_POST['pwd']);
	if(!$logged){
		$report ="<div class='alert alert-danger'>Invalid Login. Please Retry</div>";
		
	}else{
		//$report ="<div class='alert alert-success'>Login is valid</div>";
		$_SESSION['user_email']=$logged['mail'];
		$_SESSION['user_name']=$logged['name'];
		$_SESSION['user_id']=$logged['id'];
		header("location:profile.php?msg=Successfully logged in");
	}
}
	
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="bootstrap-4.5.3/css/bootstrap.min.css">
</head>
<body>

	
	<div class="container mx-auto">

		<div class="col">
		<?php
			if(!empty($report)){
				echo $report;
			}
		?>
		</div>

		<div class="col">
		<?php
			if(!empty($_GET['msg'])){
				$msg=$_GET['msg'];
				echo "<h5>$msg</h5>";
			}
		?>
		</div>

		<h1>Login</h1>
			<form action="" method="POST">
			
			<input type="email" name="mail" class="form-control mt-2" value="" placeholder="Email">
			<br>
			
			<input type="password" name="pwd" class="form-control mt-2" value="" placeholder="password">
			<br>
			<br>
			<button type="" class="btn form-control btn-success">update</button>
			</form>

		<h5>Already have account?</h5>
		<h5><a href="register.php" class="btn btn-dark">Register</a></h5>

	</div>
</body>
</html>