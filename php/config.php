<?php 
  function encryptor($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";

    $SECRET_KEY = "35da6adf74e359868271f1b68dec076dbb285b0a4459821bd39e92cc402614a9";
    $SECRET_IV = "35da6adf74e359@868271f1b68de";

    $key = hash('sha256', $SECRET_KEY);
    $iv = substr(hash('sha256', $SECRET_IV), 0, 16);

    if($action == 'encrypt') {
      $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
      $output = base64_encode($output);
    } else if($action == 'decrypt') {
      $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    } else {
      echo 'error';
    }

    return $output;
  }
?>