<html>
<head>
	<title>Staff Home Page</title>
</head>

<body>

<div id = "container">

		<?php
			session_start();
			if(!isset($_SESSION['uname'])) 
				header('LOCATION: APlogin.php');
			else {
			    $uname = $_SESSION['uname'];
			    $fname = $_SESSION['fname'];
			}
			
		?>
		<h1>Welcome, <?php echo   $fname ?></h1>
		
		<p>
		SI Auto Parts Sales System is run out of Staten Island, New York.</p>

		
	</div>

	
	
	</div>
</body>
</html>