<?php

namespace keenly\tests\Security;

use keenly\common;
use PHPUnit\Framework\TestCase;

class CommonCryptoTest extends TestCase
{
    public function testEncryptsAndDecryptsVersionedPayload(): void
    {
        $payload = CryptoHelper::OpensslEncryption('keenly', 'test-key');

        self::assertSame('keenly', CryptoHelper::OpensslDecrypt($payload, 'test-key'));
    }

    public function testRejectsTamperedPayload(): void
    {
        $payload = base64_decode(CryptoHelper::OpensslEncryption('keenly', 'test-key'));
        $payload[strlen($payload) - 1] = chr(ord($payload[strlen($payload) - 1]) ^ 1);

        self::assertNull(CryptoHelper::OpensslDecrypt(base64_encode($payload), 'test-key'));
    }

    public function testDecryptsVersionTwoPayloadsForCompatibility(): void
    {
        $cipher = 'AES-256-CBC';
        $iv = str_repeat('a', openssl_cipher_iv_length($cipher));
        $ciphertext = openssl_encrypt('keenly', $cipher, 'test-key', OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext, 'test-key', true);
        $payload = base64_encode('v2:'.$iv.$hmac.$ciphertext);

        self::assertSame('keenly', CryptoHelper::OpensslDecrypt($payload, 'test-key'));
    }
}

class CryptoHelper
{
    use common;
}
