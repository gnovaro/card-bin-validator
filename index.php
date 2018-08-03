<?php
/**
 * Card BIN code validaton API
 * 6 First digit of the card CREDIT/DEBIT
 * @author Gustavo Novaro
 * @version 1.1.0
 * Usage: index.php?bin=377790
 */
$bins = include('config/bin.php');

$message = array(
    'code'      => 404,
    'message'   => 'Request get parameter ?bin={number} is missing'
);

if(!empty($_GET['bin']))
{
    $bin = filter_var(trim($_GET['bin']));

    if(isset($bins[$bin]))
    {
        $message = $bins[$bin];
    } else {
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
}
header('Content-Type: application/json');
echo json_encode($message);
