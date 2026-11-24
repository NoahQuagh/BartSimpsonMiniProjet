<?php

use core\SessionManager;

require_once __DIR__ . '/../services/PunitionService.php';
require_once __DIR__ . '/../core/SessionManager.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
    exit;
}

$title      = trim((string) ($_POST['custom_title'] ?? ''));
$punishment = trim((string) ($_POST['custom_punishment'] ?? ''));

if ($title === '' || $punishment === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Le titre et la punition sont obligatoires.']);
    exit;
}

$customSeason = 0;

if (!addCustomPunishment($title, $punishment, $customSeason)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Impossible de sauvegarder la punition.']);
    exit;
}

$session = SessionManager::getInstance();
$session->set('seasonSelect', $customSeason);
$session->set('episodeSelect', $title);

echo json_encode(['success' => true]);