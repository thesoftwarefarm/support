<?php

/*
 * Given a json encoded string and a default return value, it attempts to json_decode() the string.
 * If successful, the resulting value is returned; if an error occurs, the specified default return value
 * is returned instead.
 * */
if(!function_exists('from_json')) {

    function from_json($json_encoded_string, $default_return = [], $assoc = false)
    {
        $decoded = json_decode($json_encoded_string, $assoc);

        if((json_last_error() !== JSON_ERROR_NONE))
        {
            $decoded = $default_return;
        }

        return $decoded;
    }
}