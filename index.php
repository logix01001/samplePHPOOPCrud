<?php

require_once 'Init/init.php';

$db = new Database();
//Create
//print_r($db->getAllCustomer());
/*
$db->table('customer')->insert(
[
'CustomerName' => 'Jerome',

'CustomerAddress' => 'Cavite City',

'CustomerContact' => '222222-2222',

'Username'=>'logix',

'Password'=>'lynadmin'

]);
*/


//Read

//print_r($db->table('customer')->get());

//print_r($db->findEID(2));
/*

Update
print_r($db->table('customer')->where('Username','028731')->update(
['CustomerAddress'=>'Cavite City','CustomerContact'=>'123456-6879']
));*/


//Delete

//print_r($db->findEIDDelete(4));



