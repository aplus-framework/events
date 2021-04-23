<?php namespace Framework\Events;

/**
 * Class Events.
 */
class Events
{
	/**
	 * @var array|callable[]
	 */
	protected static array $listeners = [];

	public static function listen(string $name, callable $callback) : void
	{
		static::$listeners[$name] = $callback;
	}

	public static function trigger(string $name, mixed ...$arguments) : void
	{
		if (empty(static::$listeners[$name])) {
			return;
		}
		static::$listeners[$name](...$arguments);
	}

	public static function remove(string $name) : void
	{
		unset(static::$listeners[$name]);
	}
}
