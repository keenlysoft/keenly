<?php

namespace keenly\tests\Component;

use keenly\component\Di;
use PHPUnit\Framework\TestCase;

class DiTest extends TestCase
{
    public function testResolvesAndCachesClassInstances(): void
    {
        $di = new Di();
        $di->set('service', ExampleService::class, ['keenly']);

        $service = $di->get('service');

        self::assertInstanceOf(ExampleService::class, $service);
        self::assertSame('keenly', $service->name);
        self::assertSame($service, $di->get('service'));
    }

    public function testClearsRegisteredValues(): void
    {
        $di = new Di();
        $di->set('value', 42);
        self::assertSame(42, $di->get('value'));

        $di->clear();
        self::assertNull($di->get('value'));
    }
}

class ExampleService
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}
