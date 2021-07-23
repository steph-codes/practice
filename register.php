
<?php
	if($_POST){
		if(empty($_POST['pwd']) || $_POST['pwd']!= $_POST['pwd2']){
			$error_msg="password not match";
		}
		if(empty($error_msg)){
			include('user.php');
			$obj = new User;
			$new_user = $obj->register($_POST['name'],$_POST['mail'],$_POST['phone'],$_POST['pwd'],
			$_POST['state_id'],$_POST['gender']);
		
			if($new_user['status']==false){
				$error_msg=$new_user['msg'];
			}
			else{
			header("location:login.php?msg='successfully registered. Please Login' ");
		}
	}
}

	include('state.php');
	$st= new State_class;
	$states=$st->get_states();

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
	
	<div class="container">
		<?php if(!empty($error_msg)){
			echo "<div class='alert alert-danger'>". $error_msg . "</div>";
		}
		?>
		<h1>Register</h1>
			<form action="" method="POST">
			<input type="text" name="name" class="form-control mt-2" value="" placeholder="Name">
			<br>
			<input type="email" name="mail" class="form-control mt-2" value="" placeholder="Email">
			<br>
			<input type="text" name="phone" class="form-control mt-2" value="" placeholder="phone">
			<br>
			<input type="password" name="pwd" class="form-control mt-2" value="" placeholder="password">
			<br>
			<input type="password" name="pwd2" class="form-control mt-2" value="" placeholder="Re-type password">
			<br>
			<select name="state_id" >
				<option value="">--select--</option>
				<?php
					if(!empty($states)){
						foreach($states as $id=>$name){
							echo"<option value='$id'>$name</option>";
						}
					}
				?>
			</select>
			<br>
			<input type="radio" class="" name="gender" value="" placeholder="">male
			<input type="radio" class=""name="gender" value="" placeholder="">female
			<br>
			<button type="" class="btn form-control btn-primary">REGISTER</button>
		</form>
		<h5>Already have account?</h5> <a href="login.php" class="btn btn-dark">Login</a>
	</div>
</body>
</html>