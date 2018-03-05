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
| Essentials
|--------------------------------------------------------------------------
|
| Register used libraries and do needed preparations.
|
*/

use Rozklad\Rofus\Request\GamblerCheck as GamblerCheckRequest;
use Rozklad\Rofus\Response\GamblerCheck as GamblerCheckResponse;
use Rozklad\Rofus\Request\GamblerCSRPValidation as GamblerCSRPValidationRequest;
use Rozklad\Rofus\Response\GamblerCSRPValidation as GamblerCSRPValidationResponse;

ini_set('soap.wsdl_cache_enabled', 0);

define('ROFUS_CREDENTIALS', 'Username:Password');
define('ROFUS_USERNAME', 'Username');
define('ROFUS_PASSWORD', 'Password');

$credentials = defined('ROFUS_CREDENTIALS') ? ROFUS_CREDENTIALS : '';
$auth = base64_encode($credentials);
$context = [
    'http' =>
    [
        'header'  => 'Authorization: Basic '.$auth
    ]
];

/*
|--------------------------------------------------------------------------
| Soap Wrapper
|--------------------------------------------------------------------------
|
| Create Soap Wrapper
| - 1210653014 - PersonIsNotRegistered - should not pass validation
| - 1110664016 - PersonIsRegisteredTemporarily
| - 1110910017 - PersonIsRegisteredIndefinitely
|
*/

$soapWrapper = new Rozklad\Rofus\SoapWrapper;

$soapWrapper->add('Rofus', function($service) use ($context) {
    $service
        ->wsdl('https://rofusdemo.spillemyndigheden.dk/GamblerProject/GamblerService?wsdl')
        ->trace(true)
        ->exceptions(false)
        ->setOption('stream_context', stream_context_create($context))
        ->classmap([
            GamblerCSRPValidationRequest::class,
            GamblerCSRPValidationResponse::class,
            GamblerCheckRequest::class,
            GamblerCheckResponse::class,
        ]);
});

/*
|--------------------------------------------------------------------------
| GamblerCSRPValidation
|--------------------------------------------------------------------------
|
| Validate given CSRP
|
*/

$response = $soapWrapper->call('Rofus.GamblerCSRPValidation', [
    new GamblerCSRPValidationRequest('1210653014')
]);

echo '<pre>';
var_dump($response);
echo '</pre>';

// Working with response
if ($response->GamblerStatus->GamblerCPRStatus === 'CPRIsNotRegistered') {
    // If this is true, given CPR is not valid, it's not in the system
    echo '<h2 style="color: red;">Not in the system</h2>';
}

/*
|--------------------------------------------------------------------------
| GamblerCheck
|--------------------------------------------------------------------------
|
| Check status of CSRP in Rofus registry
|
*/

$response = $soapWrapper->call('Rofus.GamblerCheck', [
    new GamblerCheckRequest('1210653014')
]);

echo '<pre>';
var_dump($response);
echo '</pre>';
