<?php

namespace App\Console;

class Kernel
{
    static public function start($argv)
    {
        if( isset( $argv[1] ) )
        {
            $args = explode(':', $argv[1]);

            if( $args[0] === "do" && isset($args[1]) )
            {
                self::do($args[1], $argv);
            }
            else
            {
                echo "\033[31mInvalid command. Please try it again.\033[37m";
            }
        }
    }

    static public function do($command, $argv)
    {
        $potential_class_name = __NAMESPACE__."\\Commands\\".ucfirst($command);

        if( class_exists( $potential_class_name ) && isset($argv[2]) )
        {
            $instance = new $potential_class_name();
            $instance->start([ $argv[2] ]);
        }
        else
        {
            echo "\033[31mUndefined action or arguments\033[37m";
        }
    }
}
