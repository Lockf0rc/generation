<?php
/**
 * PHPStringShortener
 *
 * A simple string shortener class to demonstrate how to shorten strings, such
 * as URLs using Base62 encoding.
 *
 * @author Matthias Kerstner <matthias@kerstner.at>
 * @uses PDO
 * @link https://www.kerstner.at/phpStringShortener
 */
 
require_once 'PhpStringShortener.php';
 
$cmd = isset($_GET['cmd']) ? $_GET['cmd'] : null;
 
if ($cmd !== null) {
    try {
        if ($cmd == 'get') {
            $hash = isset($_GET['hash']) ? $_GET['hash'] : null;
 
            if (!$hash) {
                die('No hash specified');
            }
 
            $phpSS = new PhpStringShortener();
            $string = $phpSS->getStringByHash($hash);
 
            
            echo "hash: $hash => $string";
            
            exit;
        } else if ($cmd == 'add') {
            $string = isset($_GET['string']) ? $_GET['string'] : null;
 
            if (!$string) {
                die('No string specified');
            }
 
            $phpSS = new PhpStringShortener();
            $hash = $phpSS->addHashByString($string);
 
            die('Your hash for ' . $string . ' is: ' . $hash);
        }
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
?>