<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<?php
include 'inc\include.php';

?>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
<meta name="description" content="description"/>
<meta name="keywords" content="keywords"/> 
<meta name="author" content="author"/> 
<link rel="stylesheet" type="text/css" href="default.css" media="screen"/>
<title><?php echo $server_name; ?></title>
</head>
<body style="margin: 0 12%;">

<div class="container">

	<div class="header">
		<a href="index.php"><span><?php echo $server_name; ?></span></a>
	</div>

	<div class="stripes"><span></span></div>
	
	<div class="nav">
		<a href="index.php">Console</a>
		<a href="admin.php">Admin</a>
		<div class="clearer"><span></span></div>
	</div>

	<div class="stripes"><span></span></div>

	<div class="main">
	
		<div class="left">
			<div class="content">
			
				<h1>Login</h1>
				</br></br></br>
					<form action="serveradmin.php" method="post">
					<p>User:     </p>
					<input type="text" name="username"><br><br>
					<p>Password: </p>
					<input type="password" name="password"><br><br>
					<input type="submit">
					</form>
				</br></br>
			
			</div>
		</div>

		<div class="right">
		</div>

		<div class="clearer"><span></span></div>

	</div>

	<div class="footer">

	</div>

</div>

</body>

</html>