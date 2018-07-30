<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>register</title>
</head>

<body>
<?php
/*include config file */
include('config.php');

//variable declartion
$username		  ="";
$password		  ="";
$confirm_password ="";
$email			  ="";

//checking input 
if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
  $username = test_input($_POST["username"]);
  $email = test_input($_POST["email"]);
  $password = test_input($_POST["password"]);
  $confirm_password = test_input($_POST["confirm_password"]);
  //$gender = test_input($_POST["gender"]);
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }

// Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }

// Check input errors before inserting in database
    if(empty($password_err) && empty($confirm_password_err))
	{
		$sql = "INSERT INTO register (username, email, password) VALUES ('$username' , '$email' , '$password')";
		if ($conn->query($sql) === TRUE)
 			{
    			echo "New record created successfully";
			}
		else
			{
    			echo "Error: " . $sql . "<br>" . $conn->error;
			}
	}
	else
	{
		  echo "Something went wrong. Please try again later.";
	}
$conn->close();
?>
</body>
</html>