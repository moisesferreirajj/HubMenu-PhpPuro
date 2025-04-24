<?php

require_once __DIR__.'/Core/Core.php';
require_once __DIR__ . '/Router/Routes.php';

$core = new Core();
$core->run($routes);