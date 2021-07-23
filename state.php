<?php

class State_class{
	public $conn;
	function __construct(){
		$this->conn=new mysqli("localhost","root","","classproject");
		if($this->conn->connect_error){
			die("There was an error connecting to the database");
		}
	}

	function get_states(){
		$states=[];
		$q="SELECT * FROM states";
		$res=$this->conn->query($q);
		if($res->num_rows>0){
			while($row=$res->fetch_assoc()){
				$state_id=$row['id'];
				$state_name=$row['name'];
				$states[$state_id]=$state_name;
			}
		}
		return $states;
	}
}
?>