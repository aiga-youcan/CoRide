<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class AiResultCast implements CastsAttributes
{
    /**
     * Decode the stored JSON into an array (or null).
     * Safely handle cases where the raw value is already an array or null.
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (is_null($value) || $value === '') {
            return null;
        }

        if (is_array($value)) {
            return $value;
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }
        }

        // Fallback: return null to avoid Blade errors
        return null;
    }

    /**
     * Ensure the stored value is JSON. Return an array compatible with Eloquent's attribute setter.
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return [$key => null];
        }

        if (is_array($value) || is_object($value)) {
            return [$key => json_encode($value)];
        }

        if (is_string($value)) {
            // If already valid JSON, store as-is
            json_decode($value);
            if (json_last_error() === JSON_ERROR_NONE) {
                return [$key => $value];
            }

            // Otherwise, encode the string
            return [$key => json_encode($value)];
        }

        // Fallback for unexpected types
        return [$key => json_encode($value)];
    }
}
