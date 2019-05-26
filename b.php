<?php
function Yonlendir($url,$zaman = 0){
if($zaman != 0){
header("Refresh: $zaman; url=$url");
}
else header("Location: $url");
}
function ggg(){ 
 if(getenv("HTTP_CLIENT_IP")) { 
 $ip = getenv("HTTP_CLIENT_IP"); 
 } elseif(getenv("HTTP_X_FORWARDED_FOR")) { 
 $ip = getenv("HTTP_X_FORWARDED_FOR"); 
 if (strstr($ip, ',')) { 
 $tmp = explode (',', $ip); 
 $ip = trim($tmp[0]); 
 } 
 } else { 
 $ip = getenv("REMOTE_ADDR"); 
 } 
 return $ip; 
}  



$http_lang = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
      switch ($http_lang) {
        case 'en':
          echo "yabanci";
          break;
        case 'tr':
          //Yonlendir("http://seoprogramlari.com");

          break;
        default:
          echo "yok";
      }






if(strlen(strstr($_SERVER['HTTP_USER_AGENT'],"Pinterest")) <= 0 ){ 
$aaa = FALSE;
$ip_adresi=ggg();  


$dosya = fopen('ip.txt', 'r');

while(!feof($dosya)){
    $yazi[$sayac] = fgets($dosya);
    if (!$yazi[$sayac]==$ip_adresi){
        $aaa = TRUE;
        
    }
}
 

fclose($dosya);




if ($aaa == TRUE) {

echo "dahaoncegeldi";
    
}

else{

echo "ilk";

$kayit = fopen("ip.txt", "a");
fputs($kayit, "$ip_adresi\n");
fclose($kayit);
}
}
else{}
?>