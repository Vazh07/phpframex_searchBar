<?php
class logController{
	const isDev = false;

	public static function logIt($logName,$action,$txt){
		if(self::isDev){
			$myfile = fopen($logName.".log", $action) or die("Unable to open file!");
			fwrite($myfile, $txt);
			fclose($myfile);
		}
	} 

}
?>