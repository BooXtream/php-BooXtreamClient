<?php

/*
 * Example for usage with distribution platform (xml with downloadlinks) and a custom exlibris
 */

require '../vendor/autoload.php';

use GuzzleHttp\Client;
use Icontact\BooXtreamClient\BooXtreamClient;
use Icontact\BooXtreamClient\Options;

// Your username, apikey and BooXtream base url
$credentials = ['username', 'apikey'];

// The epubfile you would like to upload
$epubfile = 'assets/test.epub';

// An optional exlibrisfile
$exlibrisfile = 'assets/customexlibris.png';

// set the options in an array
$options = [
    'referenceid'          => '1234567890',
    'customername'         => 'customer',
    'customeremailaddress' => 'customer@example.com',
    'languagecode'         => 1033, // 1033 = English
    'downloadlimit'        => 3,
    'expirydays'           => 30,
];

// the type of request, in this case it's a request for a downloadlink embedded in xml
$type = 'xml';

try {
    // create a guzzle client
    $Guzzle = new Client();

    // create an options object
    $Options = new Options($options);

    // create the BooXtream Client
    $BooXtream = new BooXtreamClient($type, $Options, $credentials, $Guzzle);

    // set the epubfile
    $BooXtream->setEpubFile($epubfile);

    // Add a custom exlibris
    $BooXtream->setExlibrisFile($exlibrisfile);

    // and send
    $Response = $BooXtream->send();

    // returns a Response object, containing returned xml
    var_dump($Response->getBody()->getContents());
} catch (Exception $e) {
    var_dump($e);
}
