<?php

require_once __DIR__.'/../core/SessionManager.php';

require_once __DIR__ . '/../services/PunitionService.php';

header('Content-Type: application/json; charset=utf-8');

$season = isset($_GET['season']) ? (int) $_GET['season'] : 0;

if ($season <= 0) {
    echo json_encode([]);
    exit;
}

$seasonData = getPunishmentsBySeason($season);

if (!is_array($seasonData) || empty($seasonData)) {
    echo json_encode([]);
    exit;
}

$session = \core\SessionManager::getInstance();
$selectedEpisode = $session->get('episodeSelect');

$episodes = array_map(function ($episodeTitle) use ($selectedEpisode) {
    return [
        'title'    => $episodeTitle,
        'selected' => ($episodeTitle === $selectedEpisode)
    ];
}, array_keys($seasonData));

echo json_encode($episodes, JSON_UNESCAPED_UNICODE);