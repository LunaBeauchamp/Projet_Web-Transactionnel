<?php
require_once(__DIR__.'/../bd/connexion.inc.php');
global $connexion;

$data = [
    'item_name' => $_POST['item_name'],
    'item_number' => $_POST['item_number'],
    'payment_status' => $_POST['payment_status'],
    'payment_amount' => $_POST['mc_gross'],
    'payment_currency' => $_POST['mc_currency'],
    'txn_id' => $_POST['txn_id'],
    'receiver_email' => $_POST['receiver_email'],
    'payer_email' => $_POST['payer_email'],
    'custom' => $_POST['custom'],
];

    $stmt = $connexion->prepare('INSERT INTO payments VALUES(?, ?, ?, ?, ?)');
    $stmt->bind_param(
        'sdsss',$data['txn_id'],$data['payment_amount'],$data['payment_status'],$data['item_number'],date('Y-m-d H:i:s'));
    $stmt->execute();
?>