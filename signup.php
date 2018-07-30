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
  $username =		$_POST["username"];
  $email	=		$_POST["email"];
  $role	=			$_POST["role"];
  $password =		$_POST["password"];
  $confirm_password = $_POST["confirm_password"];

// checking username and email already exists or not
$sql_u = "SELECT * FROM sample WHERE username='$username'";
$sql_e = "SELECT * FROM sample WHERE email='$email'";
$res_u = mysqli_query($conn, $sql_u);
$res_e = mysqli_query($conn, $sql_e);

  	/*if (mysqli_num_rows($res_u) > 0)
	{
		echo '<script language="javascript">';
		echo 'window.alert("Sorry... username already taken")';
		echo '</script>';
		//header('location: home.html');
  	}
	 else if(mysqli_num_rows($res_e) > 0)
	 {
  	  echo '<script language="javascript">';
		echo 'window.alert("Email ID Already Exists")';
		echo '</script>'; 
		//header('location: home.html');
  	 }*/


 
// Check input errors before inserting in database
    if( (mysqli_num_rows($res_u)==0) && (mysqli_num_rows($res_e)==0) )
	{
		$sql = "INSERT INTO sample (username, email, password, role) VALUES ('$username' , '$email' , '$password' , '$role')";
		
		if ($conn->query($sql) === TRUE)
 			{
						echo '<script type="text/javascript">
						window.onload = function(){alert("New user added");}</script>';
						header('location: home.html');
			}
		else
			{
    			echo "Error: " . $sql . "<br>" . $conn->error;
			}
	} 

	else {
		//header('location: home.html');
		echo '<script language="javascript">';
		echo 'window.alert("Sorry... username Or email already taken")';
		echo '</script>';
	}
}
	

//$conn->close();
?>
