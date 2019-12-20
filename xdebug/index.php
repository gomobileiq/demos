<?php

class Strings
{
    static function fix_string($a)
    {
        return $a;
        // echo
        //     xdebug_call_class().
        //     "::".
        //     xdebug_call_function().
        //     " is called at ".
        //     xdebug_call_file().
        //     ":".
        //     xdebug_call_line();
    }
}

$name = Strings::fix_string( 'Derick' );

print $name;

