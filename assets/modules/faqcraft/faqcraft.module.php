<?php defined('IN_MANAGER_MODE') or die('Error');
/** @var DocumentParser $modx */

require __DIR__ . '/src/bootstrap.php';

$faqcraft = new FaqCraft\FaqCraft($modx);
$controller = $faqcraft->controller('module');
$action = isset($_GET['action']) ? (string) $_GET['action'] : 'index';

echo $controller($action);
