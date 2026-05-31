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
}

class CryptoHelper
{
    use common;
}
