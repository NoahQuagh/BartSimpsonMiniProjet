<?php

require_once __DIR__ . '/../services/JsonService.php';
define('PUNISHMENT_FILE',__DIR__.'/../data/punishment.json');

/**
 * Lit et retourne le tableau associatif brut des saisons et punitions
 *
 * @param string $path Chemin du JSON
 * @return array Tableau associatif
 */
function getPunishmentsList(string $path = PUNISHMENT_FILE): array
{
    $data = getJsonFile($path);
    return isset($data['saisons']) && is_array($data['saisons']) ? $data['saisons'] : [];
}


/**
 * Tire une liste de punitions à partir d'une saison donnée
 *
 * @param string $path Chemin du JSON
 * @param int $season Numéro de saison
 * @return array Liste des punitions pour cette saison
 */
function getPunishmentsBySeason(int $season = 1,string $path = PUNISHMENT_FILE): array
{
    $seasonsList = getPunishmentsList($path);
    return isset($seasonsList[$season]) && is_array($seasonsList[$season])
        ? $seasonsList[$season]
        : [];
}

/**
 * Tire une liste de punitions pour une saison aléatoire
 *
 * @param string $path Chemin du JSON
 * @return array|null Liste des punitions de toutes les saisons
 */
function getRandomPunishmentByRandomSeason(string $path = PUNISHMENT_FILE)
{
    $PunishmentsList = getPunishmentsList($path);

    if (empty($PunishmentsList)) {
        return null;
    }

    $randomSeasonKey = array_rand($PunishmentsList);
    $punishmentList = getPunishmentsBySeason($randomSeasonKey,$path);

    $randomKey = array_rand($punishmentList);
    return ['season'=>$randomSeasonKey,'title'=>$randomKey,'punishment'=>$punishmentList[$randomKey]];
}

/**
 * Tire une punition aléatoire à partir d'une saison donnée
 *
 * @param string $path Chemin du JSON
 * @param int $season Numéro de saison
 * @return array punition aléatoire et le titre de l'épisode pour cette saison
 */
function getRandomPunishmentFromSeason(int $season=1,string $path = PUNISHMENT_FILE): array
{
    $punishmentList = getPunishmentsBySeason($season,$path);

    $randomKey = array_rand($punishmentList);
    return ['season'=>$season,'title'=>$randomKey,'punishment'=>$punishmentList[$randomKey]];
}

/**
 * Récupère la liste des saisons disponibles dans le json des punitions
 *
 * @param string $path Chemin du JSON
 * @return int[]|string[] liste des numéros de saison
 */
function getSeasonsList(string $path = PUNISHMENT_FILE)
{
    $punishmentList = getPunishmentsList($path);
    return array_keys($punishmentList);
}