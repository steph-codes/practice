<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header("location:login.php");
    exit();//die('you need to login to use this page');
}

include('user.php');
$user_obj = new User;
$current_user=$user_obj->get_user($_SESSION['user_id']);
//current_user is an array that contains status, message and user_details inget_user function.

include('state.php');
	$st= new State_class;
	$states=$st->get_states();

if($_POST){
    $update_response=$user_obj->update_user($_POST);
    if($update_response['status']){
        header("location:profile.php?msg=update successful");
    }else{
        $error_msg=$update_response['msg'];
    }
}
//query strings are strings that appear on the URL
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap-4.5.3/css/bootstrap.min.css">
    </head>
    <body>

    <div>
    <?php
    
    ?>
    </div>
    
    <div class="form-group">
    <label class="control-label">Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo $details['name']; ?>"
        placeholder="Name">
    </div>
    <div class="form-group">
    <label class="control-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?php echo $details['email'];?>
        "placeholder="Email">
    </div>
    <div class="form-group">
    <label class="control-label">Phone</label>
        <input type="text" name="phone" value<?php echo $details['phone'];?>" placeholder="Phone">
    </div>
    <div class="form-group">
    <label class="control-label">Gender
        <input type="radio" name="gender" value="m" id="gender-male" <?php if($details['gender']=='m'){echo "checked";} ?>> Female</label>
    </div>

    <div class="form-group">
    <label class="control-label">State</label>
        <select name="state_id" class="form-control">
            <option value="">--Select--</option>
            <?php if(!empty($states)){
                foreach($states as $state_id=>$state_name){
                    echo"<option";
                    if($state_id==$details['state_id']){ echo "selected";}
                    echo"value='$state_id'>$state_name</option>";
                }
            }?>
        </select>
    </div>
    
    </body>
</html>