<?php
/**
 * Card BIN / IIN code validaton API
 * 6 First digit of the card CREDIT/DEBIT
 * @author Gustavo Novaro
 * @version 1.2.0
 * Usage: index.php?bin=377790
 */
$bins = include('config/bin.php');

/**
 * Luhn algorithm
 * @param $nun
 * @return int|0
 */
function luhn_test($num) {
    $str = '';
    foreach( array_reverse( str_split( $num ) ) as $i => $c ) $str .= ($i % 2 ? $c * 2 : $c );
    return array_sum( str_split($str) ) % 10 == 0;
}

$code = 404;
$message = array(
    'message'   => 'Request get parameter ?bin={number} is missing'
);

if(!empty($_GET['bin']))
{
    $bin = filter_var(trim($_GET['bin']));

    if(isset($bins[$bin]))
    {
        $code = 200;
        $message = $bins[$bin];
    } else {
        $code = 200;
        $first = substr($bin,0,1);
        $first = intval($first);
        switch($first)
        {
            case 3:
                $brand = 'AMEX';
            break;
            case 4:
                $brand = 'VISA';
            break;
            case 5:
                $brand = 'MASTERCARD';
            break;
        }
        if(!empty($brand))
        {
            $message = array(
                'BRAND'	    => $brand,
                'CVV_LONG'  => ($brand == 'AMEX') ? 4 : 3,
                'CHAR_LONG' => ($brand == 'AMEX') ? 15 : 16
            );
        }
    }
} else {
    $code = 400; //Bad request
}
header('Content-Type: application/json');
http_response_code($code);
echo json_encode($message);
