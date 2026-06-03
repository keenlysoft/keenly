<?php

namespace keenly\tests\Routes;

use keenly\routes\routes;
use PHPUnit\Framework\TestCase;

class RoutesTest extends TestCase
{
    /**
     * @dataProvider validPaths
     */
    public function testAcceptsSafeCatchAllSegments(array $path): void
    {
        self::assertTrue($this->isValidPath($path));
    }

    /**
     * @dataProvider invalidPaths
     */
    public function testRejectsUnsafeCatchAllSegments(array $path): void
    {
        self::assertFalse($this->isValidPath($path));
    }

    public function testRejectsInternalControllerActions(): void
    {
        self::assertFalse($this->isCallableAction(new RouteControllerFixture(), '_internal'));
        self::assertFalse($this->isCallableAction(new RouteControllerFixture(), '__construct'));
        self::assertTrue($this->isCallableAction(new RouteControllerFixture(), 'index'));
    }

    public function validPaths(): array
    {
        return [
            [['index']],
            [['admin', 'user_list']],
            [['admin', 'user', 'show2']],
        ];
    }

    public function invalidPaths(): array
    {
        return [
            [[]],
            [['admin', '../config']],
            [['admin', 'user-name']],
            [['admin', 'user', 'show', 'extra']],
        ];
    }

    private function isValidPath(array $path): bool
    {
        $method = new \ReflectionMethod(routes::class, 'isValidPath');
        if (PHP_VERSION_ID < 80100) {
            $method->setAccessible(true);
        }

        return $method->invoke(null, $path);
    }

    private function isCallableAction(object $controller, string $action): bool
    {
        $method = new \ReflectionMethod(routes::class, 'isCallableAction');
        if (PHP_VERSION_ID < 80100) {
            $method->setAccessible(true);
        }

        return $method->invoke(null, $controller, $action);
    }
}

class RouteControllerFixture
{
    public function index(): void
    {
    }

    public function _internal(): void
    {
    }
}
