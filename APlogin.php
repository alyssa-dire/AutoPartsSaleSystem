<!DOCTYPE html>
<html>
<head>
	<title>SI Auto Parts Sale System</title>
	<link rel="stylesheet" type="text/css" href="landingPageMAP.css">

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
			
			include("includes/db_connection.php"); 
			
			$q = "SELECT * FROM SI_users WHERE uname = '$uname'";
			
			$result = $conn->query($q); //execute select
			if ($result->num_rows > 0) {
				if ($result->num_rows == 1){
					//one record found. right case.
					$row = $result->fetch_assoc();
	
					if ($row['pword'] == $pword){
						if ($row['status'] == 'approved') {
 
						
							//let user log in
							//set session variable
							session_start();
						
							//set session variables
							$_SESSION['uname'] = $uname;
							$_SESSION['fname'] = $row['fname'];			
							$_SESSION['role'] = $row['role'];				
						
							//check the role
							if($row['role'] == 'manager'){
								header('LOCATION: APmanager.php');
							}
						
							else {
								header('LOCATION: APstaff.php');
							}
						}
						else
							echo "You have not been approved to use the system yet.";
					}
					else {
						echo "Either username or password does not match.";
					}		
				}
				else {
					echo "More than one record found with the same user name. DB corrupted.";
				}

			} 
			else {
				echo "User name not found in database.";
			}
		}
	}

?>
	<div id = "container">
	<div class="header">
		<h1>SI Auto Parts Sale System</h1>
	</div>

	<div class="clearfix">
	
	<div class="column menu">
    		<ul>
				<li><a href="main.php">Home</a></li>
    			<li><a href="APsign_up.php">Sign Up</a></li>
    		</ul>
  		</div>
    		
    		<form action = "" method = "post">
  				<p> User name:</p>
  				<p> <input type = "text" name = "uname">
    			<p> Password:</p>
  				<p> <input type = "pword" name = "pword">	
  				<p> <input type = "submit" value = "Login">
  			</form>		
  			

  		</div>
		
		<div class="footer">
  		<p>&copy 2017 | SI Auto Parts Sale System</p>
	</div>
  		
</body>
</html> 
