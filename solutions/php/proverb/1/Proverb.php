<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

class Proverb
{
    public function recite(array $list) : array
    {
        $ans = [];
        if (count($list) == 0) {
            return $ans;
        }
        
        if (count($list) == 1){
            $ans[] = "And all for the want of a " . $list[0] . ".";
            return $ans; 
        }

        if (count($list) == 2){
            $ans[] = 'For want of a ' . $list[0] . ' the ' . (string)$list[1] . ' was lost.';
            $ans[] = "And all for the want of a " . $list[0] . ".";
            return $ans;
        } 
        
        for($i = 0; $i < count($list) - 1; $i++){
            $ans[] = 'For want of a ' . (string)$list[$i] . ' the ' . (string)$list[$i+1] . ' was lost.';
        }
        $ans[] = "And all for the want of a " . (string)$list[0] . "."; 
        return $ans;
    }
}
