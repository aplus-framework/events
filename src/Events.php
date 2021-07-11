<?php declare(strict_types=1);
/*
 * This file is part of The Framework Events Library.
 *
 * (c) Natan Felles <natanfelles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Framework\Events;

use JetBrains\PhpStorm\Pure;
use OutOfBoundsException;

/**
 * Class Events.
 */
class Events
{
    /**
     * @var array<string,callable>
     */
    protected static array $listeners = [];

    public static function listen(string $name, callable $callback) : void
    {
        static::$listeners[$name] = $callback;
    }

    public static function trigger(string $name, mixed ...$arguments) : void
    {
        if (empty(static::$listeners[$name])) {
            throw new OutOfBoundsException('Undefined event with name "' . $name . '"');
        }
        static::$listeners[$name](...$arguments);
    }

    public static function remove(string $name) : void
    {
        unset(static::$listeners[$name]);
    }

    #[Pure]
    public static function isListening(string $name) : bool
    {
        return isset(static::$listeners[$name]);
    }
}
