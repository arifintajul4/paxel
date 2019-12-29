<?php
include('config.php');
include('randomNameGenerator.php');
$r = new randomNameGenerator('array');
$names = $r->generateNames(1);
echo "
__________                      .__   
\______   \_____  ___  ___ ____ |  |  
 |     ___/\__  \ \  \/  // __ \|  |  
 |    |     / __ \_>    <\  ___/|  |__
 |____|    (____  /__/\_ \\___  >____/
                \/      \/    \/      
Bot Reff		";
sleep(1);
echo "\n\r";
echo "Jangan Lupa masukkan ref di reff.txt";
echo "\r\nNomor : ";	
$no = trim(fgets(STDIN));
$ref = file_get_contents('reff.txt');
$data = '{"phone":"'.$no.'","referral_code":""}';
$send = curl("https://api.paxel.co/apg/api/v1/me/phone-token?on=register",$data);
$load = json_decode($send, TRUE);
if($load['code'] == 200){
	echo "\r\nOTP Code :";
	$otp = trim(fgets(STDIN));
	sleep(1);
	$dataa = '{"phone":"'.$no.'","token":"'.$otp.'"}';
	$sendd = curl("https://api.paxel.co/apg/api/v1/me/phone-token/validate",$dataa);
	$sendd = json_decode($sendd, TRUE);
	if($sendd['code'] == 200){
		$datta = '{"social_media_id":"","social_media_type":"","first_name":"'.$names[0]['first_name'].'","last_name":"'.$names[0]['last_name'].'","refer_by":"'.$ref.'","phone":"'.$no.'","token":"'.$otp.'","username":"'.$names[0]['first_name'].'99","password":"Avenged@23","email":"","referrer_source":"","campaign":""}';
		$doit = curl("https://api.paxel.co/apg/api/v1/register", $datta);
		if($doit['code'] == 200){
			die('Refferal Success !');
		}
		else{
			die('Reff Gagal!');
		}
	}
	else{
		die('OTP salah');
	}
	
}
elseif($load['code'] == 405){
	die('Nomor Telah Terdaftar');
}
else{
	die('Kirim OTP gagal');
}
?>
