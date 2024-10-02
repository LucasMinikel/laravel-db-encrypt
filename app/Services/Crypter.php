<?php

namespace App\Services;


class Crypter
{
    private $key;
    private $cipher = 'AES-256-CBC';
    protected static $iv = '1234567890123456';

    public function __construct()
    {
        $this->key = config('app.encryption_key');
    }

    public function encrypt($data): string
    {
        return openssl_encrypt(
            $data,
            $this->cipher,
            $this->key,
            0,
            self::$iv
        );
    }

    public function decrypt($data): string
    {
        return openssl_decrypt(
            $data,
            $this->cipher,
            $this->key,
            0,
            self::$iv
        );
    }
}
