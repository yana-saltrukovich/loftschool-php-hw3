<?php
//$xmlPath = 'data.xml';
$xml = simplexml_load_file('data.xml');
print_r($xml);
echo 'Номер заказа - '.$xml['PurchaseOrderNumber'];