<?php 
$string = '[{ "unicode" : "1f910" }, { "unicode" : "1f5e3" }, { "unicode" : "1f4a9" }]';
$array = json_decode($string);
$count = 1;
$final = array();
foreach ($array as $item) {
    $final['unicode_'.$count] = $item->unicode;
    $count++;
}
print_r($final); die;