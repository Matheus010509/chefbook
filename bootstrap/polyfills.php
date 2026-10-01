<?php

if (! function_exists('mb_split')) {
    function mb_split(string $pattern, string $string, int $limit = -1): array|false
    {
        $regex = '~'.str_replace('~', '\~', $pattern).'~u';

        $parts = @preg_split($regex, $string, $limit);

        return $parts === false ? false : $parts;
    }
}