<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<?php
include 'inc\include.php';
?>

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="description" content="description" />
	<meta name="keywords" content="keywords" />
	<meta name="author" content="author" />
	<link rel="stylesheet" type="text/css" href="default.css" media="screen" />
	<title><?php echo $server_name; ?></title>
	<script language="JavaScript">
		/* following function calculates the height of the contents of the iframe (log) and adjusts the main page height accordingly. */
		function calcHeight() {
			var the_height =
				document.getElementById('the_iframe').contentWindow.
			document.body.scrollHeight;

			document.getElementById('the_iframe').height =
				the_height;
		}
	</script>
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

			<div class="content">
				<?php
				//some really basic session to insure people have come to this page through admin.php using the correct username and password. Will not echo anything if this isn't done.
				session_start();
				if (isset($_POST["username"]) and isset($_POST["password"])) {
					$_SESSION['username'] = $_POST["username"];
					$_SESSION['password'] = $_POST["password"];
				}
				if ($_SESSION['username'] == $username and $_SESSION['password'] == $password) {
				?>

					<br><br><br>
					<h1>Server Console</h1>
					Server command to execute:
					<form action='serveradmin.php' method='POST'>
						<input type='text' name='command' />
						<input type='submit' value='Enter' />
					</form>
					<br>
					<iframe id="the_iframe" onLoad="calcHeight()" height="1" src="serverlog.php" class="iFrame" frameBorder="0" scrolling="no" seamless></iframe>
				<?php
					//When a command is set, do:
					if (isset($_POST["command"])) {
						//store the command in a variable
						$command = $_POST['command'];
						//open command.txt at the last line
						$file_handle = fopen($server_dir . "command.txt", "a");
						//write the following line (PHP_EOL is a newline marker)
						fwrite($file_handle, "$command" . PHP_EOL);
						//the following line trims the command.txt to make sure no empty lines get in in wrong places, so the script does not 'get stuck' on an empty line.
						file_put_contents($server_dir . "command.txt", preg_replace('~[\r\n]+~', "\r\n", trim(file_get_contents($server_dir . "command.txt"))) . PHP_EOL);
						//close the file
						fclose($file_handle);
					}
				}
				?>
			</div>

			<div class="clearer"><span></span></div>

		</div>

		<div class="footer">

		</div>

	</div>

</body>

</html>