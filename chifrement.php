<?php


// $clef = password_hash($password, PASSWORD_ARGON2I, ['algo' => PASSWORD_BCRYPT]);

// function crypter($donnees, $cle) {
//     $iv = openssl_random_pseudo_bytes(16);
//     $donnees_cryptees = openssl_encrypt($donnees, 'AES-256-CBC', $cle, 0, $iv);
//     return base64_encode($donnees_cryptees . ':' . $iv);
// }

// function decrypter($donnees_cryptees_base64, $cle) {
//     $donnees_cryptees_iv_base64 = base64_decode($donnees_cryptees_base64);
//     list($donnees_cryptees, $iv) = explode(':', $donnees_cryptees_iv_base64);
//     $donnees = openssl_decrypt($donnees_cryptees, 'AES-256-CBC', $cle, 0, $iv); 
//     return $donnees;
// }

function crypter($data)
{
    $password = $_SESSION['pass'];
    $encryptionKey = hash('sha256', $password, true);

    
    $iv = openssl_random_pseudo_bytes(16);
    $encryptedData = openssl_encrypt($data, 'aes-256-cbc', $encryptionKey, OPENSSL_RAW_DATA, $iv);
    $encryptedDataWithIV = $iv . $encryptedData;
    $encryptedDataBase64 = base64_encode($encryptedDataWithIV);
    return $encryptedDataBase64;
}

function decrypter($encryptedData)
{
    $password = $_SESSION['pass'];
    $encryptionKey = hash('sha256', $password, true);
    $encryptedDataWithIV = base64_decode($encryptedData);
    $iv = substr($encryptedDataWithIV, 0, 16);
    $encryptedData = substr($encryptedDataWithIV, 16);
    $decryptedData = openssl_decrypt($encryptedData, 'aes-256-cbc', $encryptionKey, OPENSSL_RAW_DATA, $iv);

    return $decryptedData;
}
