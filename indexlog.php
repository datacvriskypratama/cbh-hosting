<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<?php
include 'inc\include.php';
//function needed for omitarray, pretty boring stuff
function strposa($haystack, $needles=array()) {
	$chr = array();
	foreach($needles as $needle) {
		$res = strpos($haystack, $needle);
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

</head><br>
	<?php
	//refreshes page every 5 seconds
	$url=$_SERVER['REQUEST_URI'];
	header("Refresh: 5; URL=$url"); 
	//reads current server log file
	$file = file($server_dir . $server_log);
	//var p is used to limit the number of lines it is going to process from the log file into the webpage, goto line 95 for more info. 
	$p=0;
	//Starts reading each line in the log, stores the line in a variable and proceeds to butcher it for consuming purposes.
	for ($i = count($file)-1; $i > -1; $i--) {
	$newstring = $file[$i];
	// Fix html tags, cuz you dont want people to have fun making your webpage look horrible by talking with html tags.
	$newstring = preg_replace("/</", "&lt;", $newstring);
	$newstring = preg_replace("/>/", "&gt;", $newstring);	
	//Cleans up string
	$startpos = strpos($newstring, ':', 7);  //finds position of the third ':' character
	$newstring = substr_replace($newstring, ']</font>', 6, $startpos-5);  //Replaces bit between time and third ':'
	$newstring = preg_replace("/<\\/font> &lt;/", "</font><font color='lightblue'> [Online] </font>&lt;", $newstring);	
	$newstring = "<font color='pink'>".$newstring;
	$newstring = preg_replace("/\\[Server\\]/", "", $newstring);
	$newstring = preg_replace("/\\[Web\\]/", "<font color='lightblue'>[Web]</font>", $newstring);
	//reads lines for whitelisted people in white-list.txt if exists and changes their name color (only needed for old minecraft servers that dont use JSON.)
	if (file_exists($server_dir . "white-list.txt")) {
		$string = file($server_dir . "white-list.txt");
		
		for ($w = 0; $w < count($string); $w++)
			{
				$change = trim($string[$w]," \t\n\r");
				$newstring = preg_replace("/\b".$change."\b/i", "<font color='lightgreen'>".$change."</font>", $newstring);
			}
		
	}
	//reads lines for opped people in ops.txt if exists and changes their name color (only needed for old minecraft servers that dont use JSON.)
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
	//Give an orange color to admin name, so whenever someone speaks of you, everyone can see you are superimportant.
	$newstring = preg_replace("/\b$admin\b/i", "<font color='orange'>$admin</font>", $newstring);
	//checks omitarray (see include.php) to see which lines to ignore
	if (strposa($newstring, $omitarray) === false)
		{
			//Prints the current line, if it isn't omitted
			echo $newstring.'<br>';
			//Adds to the p variable, which is all about size.
			$p++;
			//how many lines it puts on the page before exiting the loop (could remove this, but if the log is super super big it could have issues and long load times. If you have utilized the omitarray properly and filtered out all unwanted stuff, 200 lines should be more than enough.
			if ($p == $pmax) {
				break;
			}
		}
	}
	?>
</html>	