<?php

namespace App\Utils;


class CalculatePercentage
{
    /**
     * Calculate the percentage of a part relative to a whole.
     *
     * @param float $part The part value.
     * @param float $whole The whole value.
     * @return float The calculated percentage.
     */
    public static function calculate(float $part, float $whole): float
    {
        if ($whole == 0 || $part == 0) {
            return 0; 
        }
            
        return ($part / $whole) * 100;
    }
}