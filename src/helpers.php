<?php

use Illuminate\Container\Container;
use Illuminate\Contracts\Bus\Dispatcher;

if (!function_exists('dispatch_closure')) {
    function dispatch_closure(Closure $closure, $connection = null, $queue = null, $delay = null)
    {
        $job = new \Tusimo\ClosureJob\ClosureJob($closure);
        if ($connection) {
            $job->onConnection($connection);
        }
        if ($queue) {
            $job->onQueue($queue);
        }
        if ($delay) {
            $job->delay($delay);
        }
        dispatch($job);
    }
}


if (! function_exists('dispatch')) {
    /**
     * Dispatch a job to its appropriate handler.
     *
     * @param  mixed  $job
     * @return mixed
     */
    function dispatch($job)
    {
        return app(Dispatcher::class)->dispatch($job);
    }
}


if (! function_exists('app')) {
    function app($make = null)
    {
        if (is_null($make)) {
            return Container::getInstance();
        }

        return Container::getInstance()->make($make);
    }
}