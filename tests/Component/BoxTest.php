<?php

namespace keenly\tests\Component;

use keenly\component\Box;
use PHPUnit\Framework\TestCase;

class BoxTest extends TestCase
{
    public function testStoresCallsAndDeletesBoundClosures(): void
    {
        $box = new Box();

        self::assertTrue($box->add('sum', function ($left, $right) {
            return $left + $right;
        }, 2, 3));
        self::assertSame(5, $box->call('sum'));
        self::assertArrayHasKey('sum', $box->all());
        self::assertTrue($box->del('sum'));
        self::assertNull($box->call('sum'));
    }

    public function testRejectsNonCallableValues(): void
    {
        self::assertFalse((new Box())->add('invalid', 'not-a-callable'));
    }
}
