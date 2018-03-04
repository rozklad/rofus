<?php

/**
 * Rofus
 *
 * @package  Rozklad/Rofus
 * @author   bitterend <info@bitterend.io>
 */

/*
|--------------------------------------------------------------------------
| Autoload
|--------------------------------------------------------------------------
|
| Autoload dependencies of the project.
|
*/

require __DIR__.'/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run the example
|--------------------------------------------------------------------------
|
| Run sample task for the soap.
|
*/

use Rozklad\Rofus\Request\GamblerCheck;
use Rozklad\Rofus\Response\GamblerCheck as GamblerCheckResponse;

$soapWrapper = new Rozklad\Rofus\SoapWrapper;

$soapWrapper->add('Rofus', function($service) {
    $service
        ->wsdl('https://rofusdemo.spillemyndigheden.dk/GamblerProject/GamblerService?wsdl')
        ->trace(true)
        ->exceptions(false)
        ->classmap([
            GamblerCheck::class,
            GamblerCheckResponse::class,
        ]);
});

$response = $soapWrapper->call('Rofus.GamblerCheck', [
    new GamblerCheck('2107753055')
]);

$soapWrapper->client('Rofus', function($service) {
    echo "====== REQUEST HEADERS =====" . PHP_EOL;
    echo '<pre>';
    var_dump(htmlentities($service->__getLastRequestHeaders()));
    echo '</pre>';
    echo "========= REQUEST ==========" . PHP_EOL;
    echo '<pre>';
    var_dump(htmlentities($service->__getLastRequest()));
    echo '</pre>';
    echo "========= RESPONSE =========" . PHP_EOL;
    echo '<pre>';
    var_dump(htmlentities($service->__getLastResponse()));
    echo '</pre>';
});


echo '<pre>';
var_dump($response);
echo '</pre>';