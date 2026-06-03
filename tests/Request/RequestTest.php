<?php

namespace keenly\tests\Request;

use keenly\request\request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    protected function setUp(): void
    {
        $_GET = [];
        $_POST = [];
        $_SERVER = [];
    }

    public function testEscapesNestedQueryParameters(): void
    {
        $_GET = ['filter' => ['name' => '<script>alert(1)</script>']];

        self::assertSame(
            ['name' => '&lt;script&gt;alert(1)&lt;/script&gt;'],
            (new request())->get('filter')
        );
    }

    public function testReturnsPostBodyWhenContentTypeIsMissing(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = ['name' => 'Keenly'];

        self::assertSame(['name' => 'Keenly'], (new request())->post());
    }

    public function testFallsBackSafelyForNonStringMethodOverride(): void
    {
        $_POST = ['_method' => ['DELETE']];

        self::assertSame('POST', (new request())->getMethod());
    }

    public function testRejectsUnknownMethodOverride(): void
    {
        $_POST = ['_method' => 'DROP'];

        self::assertSame('POST', (new request())->getMethod());
    }

    public function testParsesJsonRequestBody(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['CONTENT_TYPE'] = 'application/json; charset=UTF-8';
        $request = new request();
        $request->_rawBody = '{"name":"Keenly"}';

        self::assertSame(['name' => 'Keenly'], $request->post());
    }
}
