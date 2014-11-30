<?php
/** @var DocumentParser $modx */
define('MODX_API_MODE', true);

include_once dirname(dirname(dirname(dirname(__FILE__)))) . '/index.php';

require __DIR__ . '/src/bootstrap.php';

$modx->db->connect();
if (empty($modx->config)) {
    $modx->getSettings();
}

$pathInfo = getControllerAction($_SERVER['PATH_INFO']);

if (!$pathInfo) die;

$modx->invokeEvent('OnWebPageInit');

$faqcraft = new FaqCraft\FaqCraft($modx);
$controller = $faqcraft->controller($pathInfo['controller']);

return $controller($pathInfo['action']);
