<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

// Ajoutez ces lignes
$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->loadEnv(dirname(__DIR__).'/.env');
$dotenv->overload(dirname(__DIR__).'/.env.local');

// Ajoutez ces lignes pour le débogage


return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};