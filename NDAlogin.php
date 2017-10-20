<!DOCTYPE html>
<html>
<head>
	<title>Notre Dame Academy</title>
	<link rel="stylesheet" href="mainstyle.css" type="text/css">
</head>

<body>

<?php
	if ($_SERVER['REQUEST_METHOD']=='POST'){		
		//retrieve form data
		$error = array();
		
		if (!empty($_POST['uname']))
			$uname = $_POST['uname'];
		else 
			$error[] = "Please enter user name.";
			
		if (!empty($_POST['pword']))
			$pword= sha1($_POST['pword']);
		else 
			$error[] = "Please enter password.";
		
		if(!empty($error)){
			foreach ($error as $msg){
				echo $msg;
				echo '<br>';
			}
		}
	
		else {
			//connection to database -->phpMyAdmin
			include("includes/db_connection.php");
			
			$q = "SELECT * FROM Users WHERE uname = '$uname'";
			
			$result = $conn->query($q);
			if($result->num_rows>0){
			if($result->num_rows == 1){
				$row = $result->fetch_assoc();
				
				if($row['pword'] == pword){
					session_start();
					
					//set session variables
					$_SESSION['uname'] = $uname;
					$_SESSION['fname'] = $row['fname'];
					$_SESSION['role'] = $row['role'];
				
					//check the role
					if ($row['role'] == 'professor'){
						header('LOCATION: NDAprofessor.php');
					}
					else {
						header('LOCATION: NDAstudent.php');
					}
					
				}
			
				else{
					echo "Either username or password does not match.";
				}
			}
			else{
				echo "More than one record found with the same user name.";
			}
		}
		else{
			echo "User name not found in database.";
		}
		}
	}
	
?>

<div id = "container">
	<div class="header">
		<h1>Notre Dame Academy Class Registration</h1>
	</div>

	<div class="clearfix">
		<div class="column menu">
    		<ul>
				<li><a href="main.php">Home</a></li>
    			<li><a href="NDAsign_up.php">Sign up</a></li>
				<li><a href="NDAabout.html">About</a></li>
    		</ul>
  		</div>

  		<form action = "" method = "post">
  				<p> User name:</p>
  				<p> <input type = "text" name = "uname">
    			<p> Password:</p>
  				<p> <input type = "password" name = "pword">	
  				<p> <input type = "submit" value = "Login">
  			</form>		
		
	</div>

	<div class="footer">
  		<p>2017 | Staten Island, New York</p>
	</div>
</div>
</body>
</html>
