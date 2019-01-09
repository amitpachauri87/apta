<?php 
/*
Template Name:IPN Response
*/
global $wpdb;

$data = $_POST;
$a = explode('@@', $data['custom']); 
$user_id = $a[0];
$post_id = $a[1];

$wpdb->insert('tournament_orders', array(
    'tournanent_id' => $post_id,
    'user_id' => $user_id,
    'transection_id' => $data['txn_id'],
    'price' => $data['mc_gross'],
    'payment_date' => $data['payment_date'],
    'payment_status' => $data['payment_status'],
    'ipn_response' => '',
));