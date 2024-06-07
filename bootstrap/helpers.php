<?php

use Illuminate\Support\Env;

if (! function_exists('data_path')) {
    /**
     * Get the data path.
     *
     * @param  string  $path
     * @return string
     */
    function data_path(string $path = ''): string
    {
        return app()->basePath($path ? $path : 'data');
    }
}

if (! function_exists('env_or_throw')) {
    /**
     * Get the value of a required environment variable.
     *
     * @param  string  $key
     * @return mixed
     *
     * @throws \RuntimeException
     */
    function env_or_throw(string $key): mixed
    {
        return Env::getOrFail($key);
    }
}

if (! function_exists('env_or_fail')) {
    /**
     * Get the value of a required environment variable.
     *
     * @param  string  $key
     * @return mixed
     *
     * @throws \RuntimeException
     */
    function env_or_fail(string $key): mixed
    {
        return Env::getOrFail($key);
    }
}
