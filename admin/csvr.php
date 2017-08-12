<?
$csv = array_map('str_getcsv', file('../history.csv'));
print_r($csv);
?>