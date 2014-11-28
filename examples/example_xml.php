<?php

/*
 * Example for usage with distribution platform (xml with downloadlinks) and a custom exlibris
 */

require('../vendor/autoload.php');

use \Icontact\BooXtreamClient\BooXtreamClient;
use \GuzzleHttp\Client;

// Your username and apikey
$username = 'username';
$apikey = 'apikey';

// The epubfile you would like to upload
$epubfile = 'assets/test.epub';

// set the options in an array
$options = [
    'referenceid' => '1234567890',
    'customername' => 'customer',
    'customeremailaddress' => 'customer@example.com',
    'languagecode' => 1033, // 1033 = English
    'downloadlimit' => 3,
    'expirydays' => 30
];

// create a guzzle client with a base_url for the BooXtream service
$Guzzle = new Client();

// create the BooXtream Client
$BooXtream = new BooXtreamClient($Guzzle, $username, $apikey);

// create a request
$BooXtream->createRequest('xml');

// set the epubfile
$BooXtream->setEpubFile($epubfile);

// Add a custom exlibris
$BooXtream->setExlibrisFile('assets/customexlibris.png');

// set the options
$BooXtream->setOptions($options);

// and send
$Response = $BooXtream->send();

// returns an array containing the response
var_dump($Response);
var_dump($Response->getBody()->getContents());
