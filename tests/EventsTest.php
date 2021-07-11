<?php
/*
 * This file is part of The Framework Events Library.
 *
 * (c) Natan Felles <natanfelles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\Events;

use Framework\Events\Events;
use PHPUnit\Framework\TestCase;

final class EventsTest extends TestCase
{
    public function testEvent() : void
    {
        self::assertFalse(Events::isListening('foo'));
        Events::listen('foo', static function ($a) : void {
            echo 'bar ' . $a;
        });
        self::assertTrue(Events::isListening('foo'));
        \ob_start();
        Events::trigger('foo', 1);
        $contents = \ob_get_clean();
        self::assertSame('bar 1', $contents);
        Events::remove('foo');
        self::assertFalse(Events::isListening('foo'));
        $this->expectException(\OutOfBoundsException::class);
        $this->expectExceptionMessage('Undefined event with name "foo"');
        Events::trigger('foo');
    }
}
