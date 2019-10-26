<?php
    include('server.php');
    $errors = array();
    $success_message = "";

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
            array_push($errors, "The passwords do not match");
        }

        //if there are no errors, save user to database
        if (count($errors) == 0) {
            // encrypt password before storing
            $password = md5($password);

            try {
                $sql = "INSERT INTO users(username, email, password) VALUES('$username','$email','$password')";
                $success_message = "Your account has been created";
            } catch(exception $e) {
                array_push($errors, "An error occured. Try again");
            } finally {
                mysqli_query($db, $sql);
                mysqli_close($db);
            }
        }
    }
    
?>