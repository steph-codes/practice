<?php session_start();

	if(!isset($_SESSION['user_id'])){
		header("location:login.php");
		exit();//die('you need to login to use this page');
	}

	include('user.php');
	$user_obj = new User;
	$current_user=$user_obj->get_user($_SESSION['user_id']);
	//current_user is an array that contains status, message and user_details inget_user function.


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
		<?php
			if(isset($_GET['msg'])){
				$msg=$_GET['msg'];
				echo"<div class='alert alert-success col-4'>$msg</div>";
			}
		?>
	</div>

</body>

	<?php
		//if(!current_user['status']) is same as below
		if($current_user['status']==false){
			$error_msg=$current_user['msg'];
			echo"<div class='alert alert-danger'>$erro_msg</div>";
		}else{
			$details=$current_user['details'];
			//this way you dont have to do echo repeatedly, because u didnt close the curly brace.
			?>

	<table class="table table-striped table-hover">
			<tr>
				<th>Name</th><td><?php echo $details['name']; ?></td>
			</tr>
			<tr>
				<th>Email</th><td><?php echo $details['email']; ?></td>
			</tr>
			<tr>
				<th>Phone</th><td><?php echo $details['phone']; ?></td>
			</tr>
			<tr>
				<th>State</th><td><?php echo $details['state_id']; ?></td>
			</tr>
			<tr>
				<th>Gender</th><td><?php echo $details['gender']; ?></td>
			</tr>
			<tr>
				<td colspan="2" class="text-right"><a class='btn btn-warning' href='editprofile.php'>Edit</a></td>
			</tr>
	</table>
	<?php }?> 


	<h1>Your profile comes here later</h1>
	<div class="container mx-auto">
		<h1>Update profile</h1>
			<form action="submit.php" method="POST">
			<input type="text" name="name" class="form-control mt-2" value="" placeholder="Name">
			<br>
			<input type="email" name="mail" class="form-control mt-2" value="" placeholder="Email">
			<br>
			<input type="text" name="phone" class="form-control mt-2" value="" placeholder="phone">
			<br>
			<input type="password" name="pwd" class="form-control mt-2" value="" placeholder="password">
			<br>
			<textarea name="address" class="form-control mt-2"></textarea>
			<br>
			<input type="radio" class="" name="gender" value="" placeholder="">&nbsp; male
			<input type="radio" class="ml-2"name="gender" value="" placeholder="">&nbsp;female
			<br>
			<button type="" class="btn form-control btn-success">update</button>
		</form>

	</div>
</body>
</html>