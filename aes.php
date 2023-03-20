<?php
    function encrypt($plaintext){
        $cipher = "AES-256-CBC";
        $secret = "12345678901234567890123456789012";
        $option = 0;

        $iv = str_repeat("0", openssl_cipher_iv_length($cipher));
        $encrypted = openssl_encrypt($plaintext, $cipher, $secret, $option, $iv);

        return $encrypted;
    }

    function decrypt($ciphertext){
        $cipher = "AES-256-CBC";
        $secret = "12345678901234567890123456789012";
        $option = 0;

        $iv = str_repeat("0", openssl_cipher_iv_length($cipher));
        $decrypted = openssl_decrypt($ciphertext, $cipher, $secret, $option, $iv);

        return $decrypted;
    }
?>