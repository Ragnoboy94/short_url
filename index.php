<?php
require_once 'core/Database.php';
require_once 'core/Controller.php';
require_once 'core/View.php';
require_once 'core/Model.php';
require_once 'controllers/UrlController.php';
require_once 'models/UrlModel.php';

$url = $_GET['url'] ?? '';

// Инициализация контроллера
$controller = new UrlController();


$urlParts = explode('/', $url);


if (empty($urlParts[0])) {

    $controller->showForm();
} elseif ($urlParts[0] === 'api' && isset($urlParts[1])) {

    $controller->apiShortenUrl();
} elseif ($urlParts[0] === 'urlController' && $urlParts[1] === 'shortenUrl') {

    $controller->shortenUrl();
} else {

    $controller->redirectUrl($url);
}