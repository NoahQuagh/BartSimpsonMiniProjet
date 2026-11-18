<?php

use core\SessionManager;

require_once __DIR__ . '/../core/SessionManager.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
    exit;
}

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

echo json_encode(['success' => true]);