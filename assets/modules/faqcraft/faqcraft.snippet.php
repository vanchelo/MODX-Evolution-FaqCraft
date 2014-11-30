<?php defined('MODX_BASE_PATH') or die('Error');
/** @var DocumentParser $modx */

if (!isset($modx->faqcraft)) {
    require __DIR__ . '/src/bootstrap.php';

    $modx->faqcraft = new FaqCraft\FaqCraft($modx);
}

$action = !empty($action) ? $action : 'index';
$controller = $modx->faqcraft->controller('front');

return $controller($action);
