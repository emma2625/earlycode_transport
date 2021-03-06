<?php
    require_once '../includes/sessions.php';
    require_once 'db-connect.php';
    if (!isset($_POST['register'])) {
        $_SESSION['errormessage'] = "Please Log in or create an Account";
        header('Location: ../../auth');
    }
    else{
        $firstName = $_POST['fname'];
        $middleName = $_POST['mname'];
        $lastName = $_POST['lname'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm = $_POST['cpassword'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $phone = $_POST['phone'];
        $role = 'user';
        $date = date('Y-m-d');

        $sql = "SELECT email FROM users WHERE email = '$email'";
        $query = mysqli_query($connection,$sql);
        if (mysqli_num_rows($query) < 1) {
            $_SESSION['errormessage'] = "This email already exist ";
            header('Location: ../../auth');
        }
        // Check the password length
        elseif(strlen($password) < 6){
            $_SESSION['errormessage'] = "Password must be greater than 6 characters ";
            header('Location: ../../auth');
        }
        // Confirm passsword
        elseif($password != $confirm){
            $_SESSION['errormessage'] = "Passwords do not match";
            header('Location: ../../auth');
        }else{
            // Encrypt our password
            $password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users(first_name,middle_name,last_name,gender,dob,email,user_password,user_address,city,user_state,zip_code,phone,user_role,date_created) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            // Initialise Connection 
            $stmt = mysqli_stmt_init($connection);
            // Prepare Statement
            mysqli_stmt_prepare($stmt,$sql);
            // Bind Parameters
            mysqli_stmt_bind_param($stmt,'ssssssssssssss',$firstName,$middleName,$lastName,$gender,$dob,$email,$password,$address,$city,$state,$zip,$phone,$role,$date);
            // Execute Statement
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['successmessage'] = "Registration Successfull";
                header('Location: ../../auth');
            }else{
                $_SESSION['errormessage'] = "Something went wrong";
                header('Location: ../../auth');
            }
        }
        
    }