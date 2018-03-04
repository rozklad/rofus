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

use Rozklad\Rofus\Request\GamblerCheck as GamblerCheckRequest;
use Rozklad\Rofus\Response\GamblerCheck as GamblerCheckResponse;

ini_set('soap.wsdl_cache_enabled', 0);

/*
$wsdl = 'https://rofusdemo.spillemyndigheden.dk/GamblerProject/GamblerService?wsdl';

$trace = true;
$exceptions = false;

$xml = [];
$xml['PersonCPRNumber'] = '2107753055';
$xml['Kontekst'] = '';
$xml['PersonInformation'] = '';

$credentials = getenv('ROFUS_CREDENTIALS') ? getenv('ROFUS_CREDENTIALS') : 'Betbuzz:Nov15&17';
$auth = base64_encode($credentials);
$context = ['http' =>
    [
        'header'  => 'Authorization: Basic '.$auth
    ]
];

try
{
   $client = new SoapClient($wsdl, [
       'trace' => $trace,
       'exceptions' => $exceptions,
       'stream_context' => stream_context_create($context)
   ]);
   $response = $client->GamblerCheck($xml);
   echo '<pre>';
   echo htmlentities($client->__getLastRequest());
   echo '</pre>';
   echo '<pre>';
   dd($response);
   echo '</pre>';
}

catch (Exception $e)
{
   echo "Error!";
   echo $e -> getMessage ();
   echo 'Last response: '. $client->__getLastResponse();
}
*/

$soapWrapper = new Rozklad\Rofus\SoapWrapper;

$soapWrapper->add('Rofus', function($service) {
    $service
        ->wsdl('https://rofusdemo.spillemyndigheden.dk/GamblerProject/GamblerService?wsdl')
        ->trace(true)
        ->exceptions(false)
        ->classmap([
            GamblerCheckRequest::class,
            GamblerCheckResponse::class,
        ]);
});

$response = $soapWrapper->call('Rofus.GamblerCheck', [
    new GamblerCheckRequest('2107753055')
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
