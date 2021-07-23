<?php

class User{
	public $conn;
	function __construct(){
		$this->conn=new mysqli("localhost","root","","classproject");
		if($this->conn->connect_error){
			die("There was an error connecting to the database");
		}
	}

	function login($user, $pass){
		$password=md5($pass); //salting password  $password=md5("M0atAK.$pwd."@d10") dont store password in plain text.;
		$q="SELECT * FROM user where email = '$user' && password= '$password' ";
		$res =$this->conn->query($q);

		if($this->conn->error){
			die("there was a query error<br>". $this->conn->error);
		}

		if($res->num_rows > 0){
			return $res->fetch_assoc();
		}
		return false;
	}
	function register($name, $email,$phone, $password,$state_id,$gender){
		$pwd=md5($password);
		$q="INSERT INTO user set name='$name',email='$email',phone='$phone',password='$password',state_id='$state_id',gender='$gender' ";

		$this->conn->query($q);

		//	$result =array('msg'=>'','status'=>false);
		if($this->conn->error){
			//dont display query error tto the user, tell them unavailable
	 		$result['msg']="System error! Query. Please contact web admin";
			$result['status']=false;
			return $result;

		}

		//insert_id brings the lastid
		$user_id=$this->conn->insert_id;
		if($user_id > 0){
			$result['msg']="Successfully registered";
			$result['status']="true";
			return $result;
		}
		//res is called query resource it contains two records no of records /numrow and the details or records itself fetch_assoc.

	}

	function get_user($user_id){
		$result =['status'=>false, 'msg'=>'No message','details'=>[]];
		$q="SELECT * FROM user where id='$user_id'";
		$res=$this->conn->query($q);
		if($this->conn->error){
			$result['msg']="sorry there was a problem retrieving your profile. Please Retry";
			// bad practice dont reveal code error $this->conn->error;
			return $result;

		} $user_details=$res->fetch_assoc();
		if(empty($user_details)){
			$result['msg']="Unrecognized user";
			return $result;
			//print_r($user_details);
		}

		$result['status']=true;
		$result['details']=$res->fetch_assoc();
		return $result;
	} 
	function my_register($details){
		$name=$details['name'];
		$email=$details['email'];
		$phone=$details['phone'];
		$password=md5($details['password']);
		$state_id=$details['state_id'];
		$gender=$details['gender'];

		$query="insert into users set name='$name',email='$email',
		phone='$phone',password='$password', state_id='$state_id',gender='$gender'";
	}

	function update_user($user_details){
		$name =$user_details['name'];
		$email = $user_details['email'];
		$phone = $user_details['phone'];
		$gender = $user_details['gender'];
		$state_id=$user_details['state_id'];
		$user_id=$user_details['user_id'];

		$q="UPDATE user set name='$name',email ='$email', phone='$phone',gender='$gender'
		 state_id='$state_id' WHERE id='$user_id'";

		$res=$this->conn->query($q);
		if($this->conn->error){
			$result['msg']="System Error! Please Retry";
			return $result;
		}

		$result['status']=true;
		$result['msg']="update successful";
		//check if the user tried to update password
		if(!empty($user_details['password'])){
			//if password doesnot march confirm password
			if($user_details['password'] != $user_details['password2']){
				$result['status']=false;
				$result['msg']='your new password does not match confirm password';
			}
			return $result;
		}
		//but if match
		$new_pwd=md5($user_details['password']);

			//always addwhere to  theupdate and the delete
		$updates_pwd_query="UPDATE users set password='$new_pwd' WHERE id='$user_id' ;
		$this->conn->query($updates_pwd_query);
		if($this->conn->error){
			$result['$msg']="System error, please retry";
			return $result;
		}
		return $result;
		


		$result=['status'=>false,'msg'=>'no update done','new_details'=>[]];
		//return result and new details
	
	}
}
?>