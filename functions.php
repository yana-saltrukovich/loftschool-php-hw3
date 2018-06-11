<?php
$xml = simplexml_load_file('data.xml');

echo 'Номер заказа - ' . $xml[PurchaseOrderNumber];
echo '<br/>';
echo 'Дата заказа - ' . $xml[OrderDate];
echo '<br/>';
echo '<pre>';
echo '</pre>';
echo '<br/>';
echo 'Имя заказчика - ' . $xml->Address[0]->Name;
echo '<br/>';
echo 'Улица\дом - ' . $xml->Address[0]->Street;
echo '<br/>';
echo 'Город - ' . $xml->Address[0]->City;
echo '<br/>';
echo 'Штат - ' . $xml->Address[0]->State;
echo '<br/>';
echo 'Пометки - ' . $xml->DeliveryNotes[0];
echo '<br/>';
foreach ($xml->Items->item as $item) {
    echo '<br/>';
    echo '----------------------------------<br/>';
    echo 'Номер партии ' . $item[PartNumber] . '<br/>';
    echo 'Наименование ' . $item->ProductName . '<br/>';
    echo 'Количество ' . $item->Quantity . '<br/>';
    echo 'Цена ' . $item->USPrice . '<br/>';
    echo 'Дата доставки ' . $item->ShipDate . '<br/>';
}

//Задание №2

$cart = array(
    "orderID" => 12345,
    "shopperName" => "Ivan Ivanov",
    "shopperEmail" => "ivanov@example.com",
    "contents" => array(
        array(
            "productID" => 34,
            "productName" => "Some stuff",
            "quantity" => 1
        ),
        array(
            "productID" => 56,
            "productName" => "Super some stuff etc",
            "quantity" => 3
        )
    ),
    "orderCompleted" => true
);
$json_text = json_encode($cart);
$fp = fopen('output.json', 'w');
file_put_contents('output.json', $json_text);
fclose($fp);
echo 'File saved<br/></br>';
$changer = mt_rand(0, 1);
if ($changer == 1) {
    $oldname = '12345';
    $name = '45345';
    $oldname = trim($oldname);
    $newname = trim($name);
    $file = file_get_contents('output.json');
    $task1 = json_decode($file, TRUE);
    foreach ($task1 as $key => $value) {
        if ($oldname == $value) {
            $task1[$key] = $newname;
        }
    }
    file_put_contents('output2.json', json_encode($task1));
    unset($task1);
} else {
    echo "<br/>Nothing changed!</br>";
    $file = file_get_contents('output.json');
    $task1 = json_decode($file, TRUE);
    file_put_contents('output2.json', json_encode($task1));
    unset($task1);
}
echo "Reading file output2.json</br></br>";
$readFromFiles = file_get_contents('output2.json') or die('ошибка');
echo $readFromFiles;
$SourceFile = file_get_contents('output.json');
$SecondFile = file_get_contents('output2.json');
$task1O = json_decode($SourceFile, TRUE);
$task1S = json_decode($SecondFile, TRUE);
echo "<br>";
$result = array_diff($task1O, $task1S);
echo "<br><br>Some difference between files here! <br>";
echo "------------------------------------<br>";
print_r($result);

// Задание №3

$arr = array();
for ($i = 0; $i < 50; $i++) {
    $arr[$i] = mt_rand(0, 100);
}
echo "<pre>";
var_dump($arr);
echo "</pre>";
$fp = fopen('test.csv', 'w');
fputcsv($fp, $arr);
fclose($fp);
echo 'File saved<br>';
$csvArray = array();
$task2 = fopen("test.csv", "r");
while (!feof($task2)) {
    $a[] = fgetcsv($task2, 1024, ";");
}
echo 'Lets Watch<br>';
print_r($a);
echo '<br>Read some data<br>';
$csvPath = 'test.csv';
$task2 = fopen($csvPath, "r");
if ($task2) {
    $res = array();
    while (($csvData = fgetcsv($task2, 1000, ",")) !== FALSE) {
        $res[] = $csvData;
    }
    echo '<pre>';
    print_r($res);
}
echo 'All data red<br>';
$summa = 0;
foreach ($res as $item) {
    foreach ($item as $x) {
        if ($x % 2 == 0) {
            $summa = $summa + $x;
            echo $summa . "<br>";
        } else {
        }
    }
}
echo '<br><br>';
echo 'Сумма четных чисел = ' . $summa . '<br><br>';

//Задание №4


$link = "https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $link);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
$output = curl_exec($ch);
curl_exec($ch);
$info = curl_getinfo($ch);
echo "<br>";
echo "<pre>";
echo "</pre>";
$task3 = json_decode($output, TRUE);
echo "<pre>";
//echo $task3;
echo "</pre>";
curl_close($ch);
