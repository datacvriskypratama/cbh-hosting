<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<?php
include 'inc\include.php';
//function needed for omitarray, pretty boring stuff
function strposa($haystack, $needles=array(), $offset=0) {
	$chr = array();
	foreach($needles as $needle) {
		$res = strpos($haystack, $needle, $offset);
		if ($res !== false) $chr[$needle] = $res;
	}
	if(empty($chr)) return false;
	return min($chr);
}
?>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
<meta name="description" content="description"/>
<meta name="keywords" content="keywords"/> 
<meta name="author" content="author"/> 
<link rel="stylesheet" type="text/css" href="default.css" media="screen"/>
<title><?php echo $server_name; ?></title>

</head>

	<form action='serverlog.php' method='POST'>  
	<input type='submit' value='Refresh log'/>         
	</form>
	<br>
	
	<?php
	//reads current server log file
	$file = file($server_dir . $server_log);
	for ($i = count($file)-1; $i > -1; $i--) {
	$newstring = $file[$i];
	// Fix html tags
	$newstring = preg_replace("/</", "&lt;", $newstring);
	$newstring = preg_replace("/>/", "&gt;", $newstring);
	//Cleans up string
	$startpos = strpos($newstring, ':', 7);  //finds position of the third ':' character
	$newstring = substr_replace($newstring, ']</font>', 6, $startpos-5);  //Replaces bit between time and third ':'
	$newstring = preg_replace("/<\\/font> &lt;/", "</font><font color='lightblue'> [Online] </font>&lt;", $newstring);	
	$newstring = "<font color='pink'>".$newstring;
	$newstring = preg_replace("/\\[Server\\]/", "", $newstring);
	$newstring = preg_replace("/\\[Web\\]/", "<font color='lightblue'>[Web]</font>", $newstring);
	//reads lines for whitelisted people in white-list.txt if exists and changes their name color
	if (file_exists($server_dir . "white-list.txt")) {
		$string = file($server_dir . "white-list.txt");
		
		for ($w = 0; $w < count($string); $w++)
			{
				$change = trim($string[$w]," \t\n\r");
				$newstring = preg_replace("/\b".$change."\b/i", "<font color='lightgreen'>".$change."</font>", $newstring);
			}
		
	}
	//reads lines for opped people in ops.txt if exists and changes their name color
	if (file_exists($server_dir . "ops.txt")) {
		$string = file($server_dir . "ops.txt");
		
		for ($w = 0; $w < count($string); $w++)
			{
				$change = trim($string[$w]," \t\n\r");
				$newstring = preg_replace("/\b".$change."\b/i", "<font color='green'>".$change."</font>", $newstring);
			}
		
	}
	//reads lines for whitelisted people in whitelist.json if exists and changes their name color
	if (file_exists($server_dir . "whitelist.json")) {
		$string = file_get_contents($server_dir . "whitelist.json");
					$json_a = json_decode($string, true);
			foreach ($json_a as $instance => $person) {
				$newstring = preg_replace("/\b".$person['name']."\b/i", "<font color='lightgreen'>".$person['name']."</font>", $newstring);
			}
	}
	//reads lines for opped people in ops.json if exists and changes their name color
	if (file_exists($server_dir . "ops.json")) {
		$string = file_get_contents($server_dir . "ops.json");
					$json_a = json_decode($string, true);
			foreach ($json_a as $instance => $person) {
				$newstring = preg_replace("/\b".$person['name']."\b/i", "<font color='green'>".$person['name']."</font>", $newstring);
			}
	}
	//Give an orange color to admin name
	$newstring = preg_replace("/\b$admin\b/i", "<font color='orange'>$admin</font> ", $newstring);
	//checks omitarray to see which lines to ignore
	if (strposa($newstring, $omitarray) === false)
		{
			//Prints the final line, if it wasn't completely emptied
			echo $newstring.'<br>';
		}
	}
	?>
	<table><tr><td style='vertical-align:top;padding-right: 1cm;'><font color='lightgreen'><h1>Whitelisted:</h1>
	<?php
	if (file_exists($server_dir . "white-list.txt")) {
		$file = file($server_dir . "white-list.txt");
		for ($i = 0; $i < count($file); $i++) {
			if ($file[$i] == $admin) {
				echo "<font color='orange'>".$file[$i]."</font><BR>";
			} else {
				echo $file[$i]."<BR>";
			}
		}
	}
	if (file_exists($server_dir . "whitelist.json")) {
		$string = file_get_contents($server_dir . "whitelist.json");
		$json_a = json_decode($string, true);
		foreach ($json_a as $instance => $person) {
			if ($person['name'] == $admin) {
				echo "<font color='orange'>".$person['name']."</font><BR>";
			} else {
				echo $person['name']."<BR>";
			}
		}
	}
	?>
	</font></td><td style='vertical-align: top;'><font color='green'><h1>Operators:</h1>
	<?php
	if (file_exists($server_dir . "ops.txt")) {
		$file = file($server_dir . "ops.txt");
		for ($i = 0; $i < count($file); $i++) {
			if ($file[$i] == $admin) {
				echo "<font color='orange'>".$file[$i]."</font><BR>";
			} else {
				echo $file[$i]."<BR>";
			}
		}
	}
	if (file_exists($server_dir . "ops.json")) {
		$string = file_get_contents($server_dir . "ops.json");
		$json_a = json_decode($string, true);
		foreach ($json_a as $instance => $person) {
			if ($person['name'] == $admin) {
				echo "<font color='orange'>".$person['name']."</font><BR>";
			} else {
				echo $person['name']."<BR>";
			}
		}
	}
	?></font></td></tr></table>
</html>	