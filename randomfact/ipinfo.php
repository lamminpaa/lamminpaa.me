<?php
require_once '../vendor/autoload.php';
use GeoIp2\Database\Reader;

// This creates the Reader object, which should be reused across
// lookups.
$reader = new Reader(getcwd().'/GeoLite2-City.mmdb');

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
// Replace "city" with the appropriate method for your database, e.g.,
// "country".
try {
    $record = $reader->city($ip);
} catch (Exception $e) {
    $record = $reader->city('8.8.8.8');
}


echo json_encode($record, true);