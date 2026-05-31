<?php

namespace keenly\tests\Component;

use keenly\component\MetaTrait;
use PHPUnit\Framework\TestCase;

class MetaTraitTest extends TestCase
{
    public function testAddsCallableMethodsAtRuntime(): void
    {
        $object = new MetaObject();
        $object->addMethod('greet', function ($name) {
            return 'Hello '.$name;
        });

        self::assertSame('Hello Keenly', $object->greet('Keenly'));
    }

    public function testRejectsUnknownMethods(): void
    {
        $this->expectException(\RuntimeException::class);

        (new MetaObject())->missing();
    }
}

class MetaObject
{
    use MetaTrait;
}
