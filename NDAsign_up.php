<!DOCTYPE html>
<html>
<head>
	<title>Notre Dame Academy</title>
	<link rel="stylesheet" href="mainstyle.css" type="text/css">
</head>

<body>

<div id = "container">
	<div class="header">
		<h1>Notre Dame Academy Class Registration</h1>
	</div>

	<div class="clearfix">
		<div class="column menu">
    		<ul>
				<li><a href="main.php">Home</a></li>
    			<li><a href="NDAlogin.php">Log in</a></li>
				<li><a href="NDAabout.html">About</a></li>
    		</ul>
  		</div>
	</div>
	
	<?php
	if ($_SERVER['REQUEST_METHOD']=='POST'){		
		//retrieve form data
		$error = array();
		
		if (!empty($_POST['uname']))
			$uname = $_POST['uname'];
		else 
			$error[] = "Please enter user name.";
			
		if (!empty($_POST['pword']))
			$pword= ($_POST['pword']);
		else 
			$error[] = "Please enter password.";
			
		if (!empty($_POST['pword2']))
			$pword2= ($_POST['pword2']);
		else 
			$error[] = "Please confirm password.";
			
		if ($pword != $pword2)
			$error[] = "Passwords do not match.";
			
		if (!empty($_POST['fname']))
			$fname = $_POST['fname'];
		else 
			$error[] = "Please enter first name.";
			
		if (!empty($_POST['lname']))
			$lname = $_POST['lname'];
		else 
			$error[] = "Please enter last name.";
			
		if (!empty($_POST['email']))
			$email = $_POST['email'];
		else 
			$error[] = "Please enter email.";		
			
		if (!empty($_POST['role']))
			$role = $_POST['role'];
		else 
			$error[] = "Please enter email.";		
		if(!empty($error)){
			foreach ($error as $msg){
				echo $msg;
				echo '<br>';
			}
		}
		else {
			include("includes/db_connection.php"); 
			// sql to insert data to table
			$sql = "INSERT INTO NDAusers (uname, pword, fname, lname, email, role, status)
					VALUES ('$uname', '$pword', '$fname', '$lname', '$email', '$role', 'blocked')";
			if ($conn->query($sql) === TRUE) {
    			echo "New record created successfully";
			} else {
    			echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$conn->close();	
		}
	}
?>

<h1>Sign Up:</h1>

<form action="" method="post">
	<table>
		<tr>
			<td>User Name: </td>
			<td><input type="text" name="uname" 
				value=<?php if(isset($_POST['uname'])) echo $_POST['uname'] ?>></td>
		</tr>
		<tr>
			<td>Password: </td>
			<td><input type="pword" name="pword"></td>
		</tr>
		<tr>
			<td>Confirm Password: </td>
			<td><input type="pword" name="pword2"></td>
		</tr>
		<tr>
			<td>First Name: </td>
			<td><input type="text" name="fname" 
				value=<?php if(isset($_POST['fname'])) echo $_POST['fname'] ?>></td>
		</tr>
		<tr>
			<td>Last Name: </td>
			<td><input type="text" name="lname" 
				value=<?php if(isset($_POST['lname'])) echo $_POST['lname'] ?>></td>
		</tr>
		<tr>
			<td>Email: </td>
			<td><input type="email" name="email" 
				value=<?php if(isset($_POST['email'])) echo $_POST['email'] ?>></td>
		</tr>
		<tr>
			<td>Role: </td>
			<td><input type="radio" name="role" value = "student">Student<br>
			 <input type="radio" name="role" value = "professor">Professor<br>
		</tr>
	</table>
	
	<p><input type="Submit" value = "Submit">
	
</form>
	
	

	<div class="footer">
  		<p>2017 | Staten Island, New York</p>
	</div>
</div>
</body>
</html>
