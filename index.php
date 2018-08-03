<?php
/**
 * Card BIN code validaton API
 * 6 First digit of the card CREDIT/DEBIT
 * @author Gustavo Novaro
 * @version 1.0.0
 * Usage: index.php?bin=377790
 */
$bins = include('config/bin.php');

if(!empty($_GET['bin']))
{
    $bin = filter_var(trim($_GET['bin']));
    if(!empty($bins[$bin])){
        $message = $bins[$bin];
    }
} else {
    $message = array(
        'code'      => 404,
        'message'   => 'Request get parameter ?bin={number} is missing'
    );
}
header('Content-Type: application/json');
echo json_encode($message);
