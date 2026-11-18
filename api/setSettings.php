<?php

use core\CookieManager;
use core\SessionManager;

require_once __DIR__ . '/../core/SessionManager.php';
require_once __DIR__ . '/../core/CookieManager.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
    exit;
}

try{
    $session = SessionManager::getInstance();

    $season  = $_POST['season'] ?? 'random';
    $episode = $_POST['episode'] ?? 'random';

    if ($season === 'random' || $season === '') {
        $session->remove('seasonSelect');
        $session->remove('episodeSelect');
    } else {
        $session->set('seasonSelect', (int) $season);

        if ($episode === 'random' || $episode === '') {
            $session->remove('episodeSelect');
        } else {
            $session->set('episodeSelect', trim((string) $episode));
        }
    }

    $cookie = CookieManager::getInstance();

    $line  = $_POST['line'] ?? 15;
    $speed = $_POST['speed'] ?? 1000;

    $cookie->set('line', $line);
    $cookie->set('speed', $speed);


    echo json_encode(['success' => true]);
}catch (Exception $e){
    echo json_encode(['success' => false,'message'=>$e->getMessage()]);
}