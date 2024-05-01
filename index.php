<?php

date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$db = new SQLite3('myDB.db');
$db->query("INSERT INTO myTable (Time, Date, OS, Browser) values ('".date("h:i:sa")."', '".date("d-m-Y")."', '".getOS()."', '".getBrowser()."')");

echo "<html>
<body bgcolor='lime'>
</br>
<center><h1><font color='red' size='100%'>Hi Shuva, Your Server is working fine.</font></h1>
<form method='post'>
	<input type='submit' name='ClearBtn' value='Clear Record' />
</form>
</center>
<center><table border='1'>
<tr>
	<th><font color='Red'>OS</font></th>
	<th><font color='green'>Browser</font></th>
	<th><font color='blue'>Time</font></th>
	<th><font color='blue'>Date</font></th>
</tr>";

$results = $db->query('SELECT * FROM myTable');
while ($row = $results->fetchArray()) {  
	echo "<tr>
		<td><center>".$row['OS']."</center></td>
		<td><center>".$row['Browser']."</center></td>
		<td><center>".$row['Time']."</center></td>
		<td><center>".$row['Date']."</center></td>
	</tr>";
}

echo "</table></center></body>
</html>";

if(array_key_exists('ClearBtn', $_POST)) {
		$db->query('DELETE FROM myTable');
	}

/*#################################################################*/

function getOS() { 

	$user_agent = $_SERVER['HTTP_USER_AGENT'];

	$os_platform =   "Not_Determine";
	$os_array =   array(
		'/windows nt 10/i'      =>  'Windows 10',
		'/windows nt 6.3/i'     =>  'Windows 8.1',
		'/windows nt 6.2/i'     =>  'Windows 8',
		'/windows nt 6.1/i'     =>  'Windows 7',
		'/windows nt 6.0/i'     =>  'Windows Vista',
		'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
		'/windows nt 5.1/i'     =>  'Windows XP',
		'/windows xp/i'         =>  'Windows XP',
		'/windows nt 5.0/i'     =>  'Windows 2000',
		'/windows me/i'         =>  'Windows ME',
		'/win98/i'              =>  'Windows 98',
		'/win95/i'              =>  'Windows 95',
		'/win16/i'              =>  'Windows 3.11',
		'/macintosh|mac os x/i' =>  'Mac OS X',
		'/mac_powerpc/i'        =>  'Mac OS 9',
		'/linux/i'              =>  'Linux',
		'/ubuntu/i'             =>  'Ubuntu',
		'/iphone/i'             =>  'iPhone',
		'/ipod/i'               =>  'iPod',
		'/ipad/i'               =>  'iPad',
		'/android/i'            =>  'Android',
		'/blackberry/i'         =>  'BlackBerry',
		'/webos/i'              =>  'Mobile'
	);

	foreach ( $os_array as $regex => $value ) { 
		if ( preg_match($regex, $user_agent ) ) {
			$os_platform = $value;
		}
	}   
	return $os_platform;
}

function getBrowser() {
	$user_agent = $_SERVER['HTTP_USER_AGENT'];

	$browser        = "Not_Determine";
	$browser_array  = array(
		'/msie/i'       =>  'Internet Explorer',
		'/firefox/i'    =>  'Firefox',
		'/safari/i'     =>  'Safari',
		'/chrome/i'     =>  'Chrome',
		'/edge/i'       =>  'Edge',
		'/opera/i'      =>  'Opera',
		'/netscape/i'   =>  'Netscape',
		'/maxthon/i'    =>  'Maxthon',
		'/konqueror/i'  =>  'Konqueror',
		'/mobile/i'     =>  'Handheld Browser'
	);

	foreach ( $browser_array as $regex => $value ) { 
		if ( preg_match( $regex, $user_agent ) ) {
			$browser = $value;
		}
	}
	return $browser;
}

/*#################################################################*/

?>