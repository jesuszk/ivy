<?php


function request()
{
    return new class {
        function all(): array
        {
            if ($this->type() === 'POST')
                return $_POST;
            return $_GET;
        }

        function emptyToNull(array $array)
        {
            $return = [];
            foreach ($array as $key => $r) {
                if (empty($r)) {
                    $return[$key] = null;
                } else {
                    $return[$key] = $r;
                }
            }
            return $return;
        }

        function type(): string
        {
            return $_SERVER['REQUEST_METHOD'];
        }

        function get(string $key): mixed
        {
            if ($this->type() === 'POST')
                return $_POST[$key] ?? null;
            return $_GET[$key] ?? null;
        }

        function has(string $key): bool
        {
            if ($this->type() === 'POST')
                return isset($_POST[$key]);
            return isset($_GET[$key]);
        }
    };
}
