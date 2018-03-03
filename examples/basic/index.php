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

var_dump(class_exists('Rozklad\Rofus\Client'));
