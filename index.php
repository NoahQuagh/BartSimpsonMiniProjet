<?php

use core\CookieManager;

require_once __DIR__ . '/services/PunitionService.php';
require_once __DIR__ . '/core/SessionManager.php';
require_once __DIR__ . '/core/CookieManager.php';

$cookie = CookieManager::getInstance();
if (!$cookie->has('line')){
    $cookie->set('line', 10);
}
if (!$cookie->has('speed')){
    $cookie->set('speed', 1000);

}

include __DIR__ . '/views/board.php';
