<?php

namespace SHOP\Admin\Library;

class Encryption {

    private $key = 'shop-crm';

    public function encode($data) {
        $result = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($this->key), $data, MCRYPT_MODE_CBC, md5(md5($this->key))));
        return $result;
    }

    public function decode($data) {
        $result = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($this->key), base64_decode($data), MCRYPT_MODE_CBC, md5(md5($this->key))), "\0");
        return $result;
    }

}
