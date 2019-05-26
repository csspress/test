<?php
// veritabani bilgileri
$dbhost = "localhost";
$dbuser = "diycraft_usr";
$dbpass = "E6umkSzh";
$dbname = "diycraft_db";

$userip = $_SERVER["REMOTE_ADDR"]; // kullanici ip

$dbconn = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass); // veritabani baglantisi

$query  = $dbconn->prepare("INSERT IGNORE INTO visit (user_ip, visit) VALUES (:user_ip, 1) ON DUPLICATE KEY UPDATE visit = visit + VALUES(visit);"); // kayıt yoksa ekle, kayıt varsa güncelle
$update = $query->execute(array("user_ip" => $userip));

if ($update !== true) {
	echo "Ziyaret guncellenirken hata";
	exit; // işlemi durdur
}

$query = $dbconn->prepare("SELECT visit FROM visit WHERE user_ip = :user_ip LIMIT 1"); // ziyaret sayisini cekiyoruz
$fetch = $query->execute(array("user_ip" => $userip));

if ($fetch !== true) {
	echo "Ziyaret sayisi cekilirken hata";
	exit; // işlemi durdur
}

$visit = $query->fetchColumn();

switch ($visit) { // ziyaret sayisini kontrol ediyoruz
    case 1:
        echo "Bu siteyi ilk ziyaretiniz";
        break;

    case 2: // 2. ziyaret üye olun yazıları
    case 3: // 3. ziyaret üye olun yazıları
    case 4: // 4. ziyaret üye olun yazıları
    case 5: // 5. ziyaret üye olun yazıları
        echo "Daha önceden sitemizi ziyaret ettiniz, lütfen üye olun";
        break;

    default:
        echo "Bu siteyi {$visit}. ziyaretiniz";
        break;
}

$conn=null; // veritabani baglantisini kapattik
