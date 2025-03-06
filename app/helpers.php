<?php

if (!function_exists('encryptData')) {
    /**
     * Crypte une données donnée à l'aide de la clé de chiffrement donnée.
     *
     * Le chiffrement utilise la méthode AES-256-CBC avec un
     * vecteur d'initialisation.Le vecteur d'initialisation est concaténé pour
     * Les données chiffrées après un séparateur '::' puis la base64 ont codé.
     *
     * @param  string  $data  Les données à crypter.
     * @return string        Les données cryptées.
     */
    function encryptData($data)
    {
        $encryption_key = env('ENCRYPTION_KEY', '');
        $iv_length = openssl_cipher_iv_length('aes-256-cbc');
        $iv = openssl_random_pseudo_bytes($iv_length);
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
        return base64_encode($encrypted . '::' . base64_encode($iv));
    }
}

if (!function_exists('decryptData')) {
    /**
     * Décripte une données donnée à l'aide de la clé de chiffrement donnée.
     *
     * La méthode inverse de encryptData.
     *
     * @param  string  $data  Les données à déchiffrer.
     * @return string|false  Les données déchiffrées ou FALSE si la déchiffrement
     *                       échoue.
     */
    function decryptData($data)
    {
        $encryption_key = env('ENCRYPTION_KEY', '');
        $data = base64_decode($data);
        $parts = explode('::', $data, 2);
        if (count($parts) !== 2) {
            return false;
        }
        [$encrypted_data, $iv] = $parts;
        $iv = base64_decode($iv);
        if (strlen($iv) !== openssl_cipher_iv_length('aes-256-cbc')) {
            return false;
        }
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
    }
}
