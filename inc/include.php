<?php
$server_name = "KotakCraft";					//Name of your server
$admin = "Admins name";									//Your name / IGN (just changes color in console for the admin name)
$server_dir = "server\\";							//Directory of your Minecraft server files. 
$server_log = "logs\\latest.log";					//location of current server log inside server dir
date_default_timezone_set('Europe/Amsterdam');		//Servers timezone
$username = "Admin";								//Admin username (note: case sensitive)
$password = "Admin";								//Admin password (note: case sensitive)
$pmax = 200;
//pmax = Maximum number of last 'relevant' lines from the log it prints on the main webpage. So even if you dont restart your server for a long ass time and the log gets superbig, it wont take ages for the page to load.
//PS, I've not put a limit to the serverlog.php, since as an admin you might want to see everything. Suppose the log does get superhuge, it might mean it will take too long to load, as such, that page also doesn't automatically refresh. If PHP times out, its time to restart your server. Cuz goddamn the log is huge then.
//--------
//lines that contain the following will be omitted from the console log viewing - Change accordingly if neccesary to clean up the web console
$omitarray = array(
	'Reached end of stream for',
	'UUID of player ',
	'&lt;--[HERE]',
	'] logged in with entity id ',
	' lost connection: TextComponent',
	' lost connection: TranslatableComponent',
	': Unknown command. Try /help for a list of commands',
	'java.io.FileNotFoundException: ',
	'	at ',
	' [Server thread/WARN]:',
	'An unknown error occurred while attempting to perform this command'
);
