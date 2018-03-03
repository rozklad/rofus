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
        ->clasmap([
            GamblerCheck::class,
            GamblerCheckResponse::class,
        ]);
});

dd('xxx');

$response = $soapWrapper->call('Rofus.GamblerCheck', [
    new GamblerCheck('2107753055')
]);

var_dump($response);