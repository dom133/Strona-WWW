<?php
// mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_RAND)
function Encryption($text, $password, $iv)
{
	$aes256Key = hash("SHA256", $password, true);
	srand((double) microtime() * 1000000);
	return fnEncrypt($text, $aes256Key, $iv);
}

function Decryption($text, $password, $iv)
{
	$aes256Key = hash("SHA256", $password, true);
	srand((double) microtime() * 1000000);
	return fnDecrypt($text, $aes256Key, $iv);
}

function fnEncrypt($sValue, $sSecretKey, $iv) {
    return rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $sSecretKey, $sValue, MCRYPT_MODE_CBC, $iv)), "\0\3");
}

function fnDecrypt($sValue, $sSecretKey, $iv) {
    return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $sSecretKey, base64_decode($sValue), MCRYPT_MODE_CBC, $iv), "\0\3");
}
?>