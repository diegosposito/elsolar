<?php

class Encriptar {

	/**
	 * Returns an encrypted & utf8-encoded
	 */
	static public function encrypt($pure_string, $encryption_key) {
	    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
	    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
	    return $encrypted_string;
	}

	/**
	 * Returns decrypted original string
	 */
	static public function decrypt($encrypted_string, $encryption_key) {
	    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
	    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
	    return utf8_decode($decrypted_string);
	}

}

?>