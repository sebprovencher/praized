<?php
/**
 * Praized Cipher Library
 * 
 * Simple salted cipher library to encrypt and decrypt information as needed (Note: your security mileage may vary).
 *
 * @version 2.0
 * @package Praized
 * @subpackage Cipher
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

if ( ! class_exists('PraizedCipher') ) {
    /**
     * Praized Cipher Library: Class
     * 
     * @package Praized
	 * @subpackage Cipher
     * @since 0.1
     */
    class PraizedCipher {
        /**
         * Encryption/decryption key generator 
         *
         * @param string $extraSalt Optional salt, but very much desirable for increased security
         * @return string Secure key
         * @since 0.1
         */
	    function _key($extraSalt = '') {
			$salt = serialize($extraSalt);
	        
			if ( ($pguid = php_logo_guid()) && ($zguid = zend_logo_guid()) )
			    $salt .= $pguid . $zguid;
			else
			    $salt .= serialize(ini_get_all());
	        
			if ( function_exists('sha1') )
			    return sha1($_SERVER["REMOTE_ADDR"] . $salt );
			else
			    return md5($_SERVER["REMOTE_ADDR"] . $salt );
		}
		
		/**
		 * Encryption method
		 *
		 * @param mixed $data Data to be encrypted, accepts strings, objects, etc (serializes)
		 * @param string $extraSalt Optional salt, but very much desirable for increased security
		 * @return string
         * @since 0.1
		 */
		function encrypt($data, $extraSalt = '') {
		    $result = '';
		    $string = serialize($data);
		    $key = self::_key($extraSalt);
            for($i=0; $i<strlen($string); $i++) {
                $char = substr($string, $i, 1);
                $keychar = substr($key, ($i % strlen($key))-1, 1);
                $char = chr(ord($char)+ord($keychar));
                $result.=$char;
            }
            return base64_encode($result);
		}
		
		/**
		 * Decryption method
		 *
		 * @param string $string Data as previously encrypted by self::encrypt()
		 * @param string $extraSalt Optional salt, but very much desirable for increased security
		 * @return mixed
         * @since 0.1
		 */
		function decrypt($string, $extraSalt = '') {
		    $result = '';
		    $key = self::_key($extraSalt);
            $string = base64_decode($string);
            for($i=0; $i<strlen($string); $i++) {
                $char = substr($string, $i, 1);
                $keychar = substr($key, ($i % strlen($key))-1, 1);
                $char = chr(ord($char)-ord($keychar));
                $result.=$char;
            }
            return unserialize($result); 
		}
	}
}
?>