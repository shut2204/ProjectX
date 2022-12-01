<?php

namespace service;

class Validate
{


    public static function validateName($name_conf) {
        $pattern = "/\A.{2,255}\z/i";

        return preg_match($pattern, $name_conf);
    }

    public static function validateDate($date) {
        $pattern = "/\A\d{4}-\d\d-\d\d \d\d:\d\d\z/i";

        return preg_match($pattern, $date);
    }

    public static function validateDouble($lat, $long) {
        $pattern = "/\A[+-]?\d+\.?\d*\z/i";

        return preg_match($pattern, $lat) && preg_match($pattern, $long);
    }

}