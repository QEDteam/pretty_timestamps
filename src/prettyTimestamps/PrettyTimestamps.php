<?php

namespace PrettyTimestamps;

use Carbon\Carbon;

trait PrettyTimestamps
{
    /*
    |--------------------------------------------------------------------------
    | Model attribute getter methods
    |--------------------------------------------------------------------------
    |
    */
    
    /**
     * Intercept appended attributes ending with _pretty
     *
     * @param $key
     * @param $value
     * @return void
     */
    protected function mutateAttribute($key, $value)
    {
        $needle = '_pretty';
        $reversedNeedle = 'ytterp_';
        if (stripos(strrev($key), $reversedNeedle) === 0) {

            $attribute = str_replace($needle, "", $key);
            if (array_key_exists($attribute, $this->attributes)) {
                return $this->formatTimestamp($this->attributes[$attribute]);
            }
            return null;
        }
        
        return parent::mutateAttribute($key, $value);
    }

    /*
    |--------------------------------------------------------------------------
    | Model custom methods
    |--------------------------------------------------------------------------
    |
    */

    /**
     * Format timestamp
     *
     * @param $timestamp
     * @return void
     */
    protected function formatTimestamp($timestamp = null)
    {
        if (!$timestamp) {
            return null;
        }
        
        // Set variables
        $format = $this->prettyFormat ?? 'Y-m-d H:i:s';
        $timezoneDB = $this->prettyCurrentTimezone ?? config('app.timezone');
        $timezoneNew = $this->prettyNewTimezone ?? 'UTC';

        // Try parsing timestamp
        try {
            $timestamp = Carbon::parse($timestamp, $timezoneDB);
        } catch (\Exception $e) {
            return null;
        }

        // Return formated timestamp
        return $timestamp->setTimezone($timezoneNew)->format($format);
    }
}