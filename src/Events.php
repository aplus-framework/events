<?php declare(strict_types=1);
/*
 * This file is part of Aplus Framework Events Library.
 *
 * (c) Natan Felles <natanfelles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Framework\Events;

use JetBrains\PhpStorm\Pure;

/**
 * Class Events.
 *
 * @package events
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
        if ( ! static::isListening($name)) {
            return;
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
