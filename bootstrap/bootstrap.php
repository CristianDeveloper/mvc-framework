<?php 

/**
 * PSR-4 Autoloader
 */

require_once __DIR__ . '/../vendor/autoload.php';

$app = new \Core\App(['basePath' => '/mvc-framework/public']);

require_once __DIR__ . '/../app/routes.php';

$app->run();
