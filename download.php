<?php
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=WDC Treatment Data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('Treatment name', 'Treatment type', 'Disease name',));

// fetch the data
$mysqli = new mysqli('127.0.0.1', 'root', 'zm960902', 'project1') or die(mysqli_error($mysqli));
$result = $mysqli->query("SELECT A.tname, A.ttype, B.dename FROM treatment A JOIN disease B ON A.deid = B.deid") or die($mysqli->error);

// loop over the rows, outputting them
while ($row = $result->fetch_assoc()) fputcsv($output, $row);