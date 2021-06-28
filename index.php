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
<script language="JavaScript">
/* following function calculates the height of the contents of the iframe (log) and adjusts the main page height accordingly. */
function calcHeight()
{
var the_height=
document.getElementById('the_iframe').contentWindow.
document.body.scrollHeight;

document.getElementById('the_iframe').height=
the_height;
}
</script>
</head>
<body onload="document.myform.command.focus();document.myform.player.focus();" style="margin: 0 12%;">

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
				<form action="index.php" method="POST">Execute /list command: <input type='submit' name='list' value='/list'/></form><br>
				<form name="myform" action="index.php" method="POST">
				<?php
				//some really basic session stuff so it remembers peoples names until they exit browser.
				session_start(); 
				if (isset($_POST["player"])) {
					$_SESSION["player"] = $_POST["player"];
				}
				if (isset($_SESSION["player"])) {
				echo '<b>' . $_SESSION["player"] . '</b>:';
				
				} else {
				?>
				name:<input style="position:relative; left:20px;" size="12" maxlength="12" type="text" name="player" pattern=".{3,}" required oninvalid="setCustomValidity('Minimum length is 3 characters')" oninput="setCustomValidity('')" /> <br>message: 
				<?php
				}
				?>
				<input style="position:relative; left:0px;" size="80" maxlength="150" type="text" name="command" pattern=".{3,}" required oninvalid="setCustomValidity('Minimum length is 3 characters')" oninput="setCustomValidity('')" />    
				<input type='submit' value='send'/>         
				</form>	
				<?php
				//If the list button is pressed.
				if (isset($_POST["list"]))
					{
						//open command.txt at the last line
						$file_handle = fopen($server_dir . "command.txt", "a");
						//write the following line (PHP_EOL is a newline marker)
						fwrite($file_handle, "list".PHP_EOL);
						//the following line trims the command.txt to make sure no empty lines get in in wrong places, so the script does not 'get stuck' on an empty line.
						file_put_contents($server_dir . "command.txt", preg_replace( '~[\r\n]+~', "\r\n", trim(file_get_contents($server_dir . "command.txt"))).PHP_EOL);
						//close the file
						fclose($file_handle);		
					}
				//If someone inserted a name and message and pressed send
				if (isset($_POST["command"]) and isset($_SESSION["player"])) 
					{
						//store the playername and message in variables
						$player = $_SESSION["player"];
						$command = $_POST['command'];
						//open command.txt at the last line
						$file_handle = fopen($server_dir . "command.txt", "a");
						//write the following line (PHP_EOL is a newline marker)
						fwrite($file_handle, "say [Web] <$player> $command".PHP_EOL);
						//the following line trims the command.txt to make sure no empty lines get in in wrong places, so the script does not 'get stuck' on an empty line.
						file_put_contents($server_dir . "command.txt", preg_replace( '~[\r\n]+~', "\r\n", trim(file_get_contents($server_dir . "command.txt"))).PHP_EOL);
						//close the file
						fclose($file_handle);
					}
				?>
				<br><iframe id="the_iframe" onLoad="calcHeight()" height="1" src="indexlog.php" class="iFrame" frameBorder="0" scrolling="no" seamless></iframe>
	
			
			</div>


		<div class="clearer"><span></span></div>

		</div>

	<div class="footer">

	</div>

</div>

</body>

</html>