<?php

function getBcRound($number, $precision = 0)
    {
        $precision = ($precision < 0)
                   ? 0
                   : (int) $precision;
        if (strcmp(bcadd($number, '0', $precision), bcadd($number, '0', $precision+1)) == 0) {
            return bcadd($number, '0', $precision);
        }
        if (getBcPresion($number) - $precision > 1) {
            $number = getBcRound($number, $precision + 1);
        }
        $t = '0.' . str_repeat('0', $precision) . '5';
        return $number < 0
               ? bcsub($number, $t, $precision)
               : bcadd($number, $t, $precision);
    }
   
    function getBcPresion($number) {
        $dotPosition = strpos($number, '.');
        if ($dotPosition === false) {
            return 0;
        }
        return strlen($number) - strpos($number, '.') - 1;
    }


var_dump(getBcRound('5.0445', 3) == number_format('5.0445', 3));
?>
