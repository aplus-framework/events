<?php namespace Tests\Events;

use Framework\Events\Events;
use PHPUnit\Framework\TestCase;

class EventsTest extends TestCase
{
	protected Events $events;

	public function setup() : void
	{
		$this->events = new Events();
	}

	public function testSample()
	{
		$this->assertEquals(
			'Framework\Events\Events::test',
			$this->events->test()
		);
	}
}
