<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use Nette\Configurator;
use Symfony\Component\Console\Application;

date_default_timezone_set('Europe/Prague');

$configurator = new Configurator();
$configurator->defaultExtensions = [];
$configurator->setDebugMode(TRUE);
$configurator->setTempDirectory(__DIR__ . '/../tmp');
$configurator->addConfig(__DIR__ . '/../conf/config.neon');
if (is_file(__DIR__ . '/../conf/config.local.neon')) {
	$configurator->addConfig(__DIR__ . '/../conf/config.local.neon');
}
$container = $configurator->createContainer();

$application = $container->getByType(Application::class);
$application->run();
