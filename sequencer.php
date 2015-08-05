<?php
/**
 * An ASCII sequencer. This wil take any ASCII string and return
 * the next ASCII character in the sequence
 *
 * DICTIONARY
 *  eot - End Of Table
 *
 * Copyright (c) 2010 Jason D Snider. All rights reserved
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright    Jason Snider 2010. All rights reserved.
 * @link            http://github.com/jason-snider/ASCII-Sequencer
 * @author        Jason Snider <jsnider77@gmail.com>
 * @version       2010-04-12
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class Sequencer
{
    /**
     * (1)Accepts an alpha-numeric string
     * (2)Converts the alpha-numeric string into a series of ASCII values
     * (3)Iterates the ASCII values
     * @example abc->abd
     * @example 15z->160
     * @example zzz->0000
     *
     * @param  $eot string the PK value of the latest entry in the urls table
     * @return $eot the input string + 1 (conceptually atleast (or the new $eot
     */
    function sequence($eot)
    {
        $sequence = true; //Push the button Jetson!
        for($pointer = strlen($eot) - 1; $pointer >= 0; $pointer--){
            $ascii = ord($eot[$pointer]);
            if(!$sequence){
                continue;
            }
            $sequence = false;
            if($ascii == 57){
                /**
                 * In ASCII 56 == 9 and 57 == to some special char which is bad
                 * for URLS. When the iteration says $ascii == 57 we want to set
                 * $pointer = strtolower('a') so we can start to iterate through
                 * the english alphabet
                 */
                $eot[$pointer] = 'a';
            }elseif($ascii == 122){
                /**
                 * In ASCII 122 == z at this point we need to say $pointer=0 and
                 * tell the $sequencer to sequnce the string (ie z->00)
                 */
                $eot[$pointer] = '0';
                $sequence = true;
            }else{
                /**
                 * No sequencing needed, just a small iteration (ie 1->2, c->d,
                 * etc)
                 */
                $eot[$pointer] = chr($ascii + 1);
            }
        }
        //A sequence is needed, prepend a 0 to the sequence string
        if($sequence){
            $eot = "0{$eot}";
        }
        return $eot;
    }
}
