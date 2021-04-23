<?php namespace Tests\Events;

use Framework\Events\Events;
use PHPUnit\Framework\TestCase;

class EventsTest extends TestCase
{
	public function testEvent()
	{
		Events::listen('foo', static function ($a) {
			echo 'bar ' . $a;
		});
		\ob_start();
		Events::trigger('foo', 1);
		$contents = \ob_get_clean();
		$this->assertEquals('bar 1', $contents);
		Events::remove('foo');
		$this->expectException(\OutOfBoundsException::class);
		$this->expectExceptionMessage('Undefined event with name "foo"');
		Events::trigger('foo');
	}
}
