<?php

if (!function_exists('cleanDirectory')) {
    /**
     * Format a given date.
     *
     * @param  string  $date
     * @return string
     */
    function cleanDirectory($path)
    {
        File::cleanDirectory($path);
    }
}
