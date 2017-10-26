<?php

require_once __DIR__ . '/controllers/AppController.php';

$app = new AppController();
$app->api_key = '{YOUR_API_KEY}';
$app->actionUploadFiles();
