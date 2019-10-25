<?php 

$username = "";
$email = "";
$errors = array();


// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'registration') or die();

// if the register button is clicked
if(isset($_POST['register'])){
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

	// ensure that form fields are filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($email)) {
		array_push($errors, "Email is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}
	if($password != $password_2){
		array_push($errors, "The psswords do not match");

		//if there are no errors, save user to database
		if (count($errors) == 0) {
          $password = md5($password); // encrypt password before storing

			$sql = "INSERT INTO users(username, email, password)
			 VALUES('$username','$email','$password')";

			mysqli_query($db, $sql);
			mysqli_close($db);

		}
	}
}

?>