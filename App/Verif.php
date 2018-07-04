<?php
namespace App;

class Verif
{
    public static function filterName($field)
    {
        $field = \filter_var(\trim($field), FILTER_SANITIZE_STRING);
        if (!empty($field)) {
            if (\filter_var($field, FILTER_VALIDATE_REGEXP, ["options"=>["regexp"=>"/^[a-zA-Z]+$/"]]));
            return htmlspecialchars($field);
        }
    }
    public static function filterEmail($field)
    {
        $field = \filter_var(\trim($field), FILTER_SANITIZE_EMAIL);
        if (\filter_var($field, FILTER_VALIDATE_EMAIL)!== false) {
            return \htmlspecialchars($field);
        }
    }
    public static function filterString($field)
    {
        $field = \filter_var(\trim($field), FILTER_SANITIZE_STRING);
        if (!empty($field)) {
            return $field;
        }
    }
    public static function filterBool($field)
    {
        $field = \filter_var(\trim($field), FILTER_VALIDATE_BOOLEAN);
        if (!empty($field)) {
            return \htmlspecialchars($field);
        }
    }
    public static function filterInt($field)
    {
        $field = \filter_var(\trim($field), FILTER_VALIDATE_INT);
        if (!empty($field)) {
            return \htmlspecialchars($field);
        }
    }
}
