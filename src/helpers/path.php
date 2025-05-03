<?php

function path()
{
    return new class() {
        function images(string $path)
        {
            if ($path[0] === '/')
                $path = mb_substr($path, 1);
            return $_ENV['APP_URL'] . "/assets/images/{$path}";
        }

        function js(string $path)
        {
            if ($path[0] !== '/')
                $path = "/{$path}";
            return $_ENV['APP_URL']  . "/assets/js{$path}";
        }

        function css(string $path)
        {
            if ($path[0] !== '/')
                $path = "/{$path}";
            return $_ENV['APP_URL'] . "/assets/css{$path}";
        }
    };
}
