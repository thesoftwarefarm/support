<?php

/*
 * Given a json encoded string and a default return value, it attempts to json_decode() the string.
 * If successful, the resulting value is returned; if an error occurs, the specified default return value
 * is returned instead.
 * */

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

/*
 * Returns the MySQL date as a Carbon instance.
 * */
if (!function_exists('carbon_mysql_now')) {

    function carbon_mysql_now()
    {
        $result = (array) DB::selectOne('select now() as now');
        return Carbon::parse($result['now']);
    }
}

if(!function_exists('extract_date_range')) {
    /**
     * Accepted string formats are:
     * "Y-m-d"
     * "Y-m-d to Y-m-d"
     * "Y-m-d H:i to Y-m-d H:i"
     *
     * @param string $string
     * @return object|null
     */
    function extract_date_range($string = "")
    {
        if(empty($string))
            return null;

        if(preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $string, $matches))
        {
            $date = Carbon::parse($matches[0]);

            return (object)[
                'start_date' => $date->copy()->startOfDay(),
                'end_date' => $date->copy()->endOfDay(),
            ];
        }

        if(preg_match('/^([0-9]{4}-[0-9]{2}-[0-9]{2})\sto\s([0-9]{4}-[0-9]{2}-[0-9]{2})$/', $string, $matches))
        {
            return (object)[
                'start_date' => Carbon::parse($matches[1])->startOfDay(),
                'end_date' => Carbon::parse($matches[2])->endOfDay(),
            ];
        }

        if(preg_match('/^([0-9]{4}-[0-9]{2}-[0-9]{2}\s[0-9]{2}:[0-9]{2})\sto\s([0-9]{4}-[0-9]{2}-[0-9]{2}\s[0-9]{2}:[0-9]{2})$/', $string, $matches))
        {
            return (object)[
                'start_date' => Carbon::parse($matches[1]),
                'end_date' => Carbon::parse($matches[2]),
            ];
        }

        return null;
    }
}
