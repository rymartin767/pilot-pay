<?php

namespace App\Enums;

enum ReportFleets
{
    // AIRBUS
    
    // BOEING
    case B717;
    case B727;
    case B737;
    case B747;
    case B757;
    case B767;
    case B777;
    case B787;

    public static function generateSelectOptions() : array
    {
        $options = [];
    
        foreach (self::cases() as $case) {
            $options[$case->name] = $case->name;
        }

        return $options;
    }
}