<?php
require_once('vendor/autoload.php');

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

// Configuração do WebDriver (no exemplo, usando Chrome)
$host = 'http://localhost:4444/wd/hub'; // Endereço do Selenium Server
$capabilities = Facebook\WebDriver\Remote\DesiredCapabilities::chrome();

// Iniciar a sessão
$driver = RemoteWebDriver::create($host, $capabilities);

// Navegar para uma página
$driver->get('https://www.example.com');

// Interagir com elementos
$element = $driver->findElement(WebDriverBy::name('q'));
$element->sendKeys('PHP Selenium');
$element->submit();

// Fechar o navegador
$driver->quit();