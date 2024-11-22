<?php
define('_DIR_ROOT', __DIR__);

// Xử lý http root
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $web_root = 'https://'.$_SERVER['HTTP_HOST'].'/CourseWebProgramming-TechShop';
} else {
    $web_root = 'http://'.$_SERVER['HTTP_HOST'].'/CourseWebProgramming-TechShop';
}

define('_WEB_ROOT', $web_root);


require_once 'configs/routes.php';
require_once 'core/Route.php';
require_once 'configs/app.php';
require_once 'core/Controller.php'; 