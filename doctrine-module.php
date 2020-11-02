<?php
ini_set('display_errors', true);
chdir(__DIR__);
require 'vendor/autoload.php';
require 'config/doctrine.php';
/** @var \Interop\Container\ContainerInterface $container */
$container = require 'config/container.php';
/** @var \Zend\Expressive\Application $app */
//$app = $container->get(\Zend\\Application::class);
//print_r($app);
$cli = $container->get('doctrine.cli');
exit($cli->run());