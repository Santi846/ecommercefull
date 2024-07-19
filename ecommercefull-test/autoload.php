<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = new Meli\Configuration();
$servers = $config->getHostSettings();
// Auth URLs Options by country

// 1:  "https://auth.mercadolibre.com.ar"
// 2:  "https://auth.mercadolivre.com.br"
// 3:  "https://auth.mercadolibre.com.co"
// 4:  "https://auth.mercadolibre.com.mx"
// 5:  "https://auth.mercadolibre.com.uy"
// 6:  "https://auth.mercadolibre.cl"
// 7:  "https://auth.mercadolibre.com.cr"
// 8:  "https://auth.mercadolibre.com.ec"
// 9:  "https://auth.mercadolibre.com.ve"
// 10: "https://auth.mercadolibre.com.pa"
// 11: "https://auth.mercadolibre.com.pe"
// 12: "https://auth.mercadolibre.com.do"
// 13: "https://auth.mercadolibre.com.bo"
// 14: "https://auth.mercadolibre.com.py"

// Use the correct auth URL
$config->setHost($servers[1]["url"]);

// Or Print all URLs
print_r($servers);

// Or Print or Put the following URL in your browser window to obtain authorization:
//
// http://auth.mercadolibre.com.ar/authorization?response_type=code&client_id=$APP_ID&redirect_uri=$YOUR_URL
?>