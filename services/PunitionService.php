<?php

require_once __DIR__ . '/../services/JsonService.php';

/**
 * Lit et retourne le tableau associatif brut des saisons et punitions
 *
 * @param string $path Chemin du JSON
 * @return array Tableau associatif
 */
function getPunishmentsList(string $path): array
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
function getPunishmentsBySeason(string $path, int $season = 1)
{
    $filteredList = getPunishmentsList($path);

    if (empty($filteredList)) {
        return null;
    }

    return $filteredList[$season];
}

/**
 * Tire une liste de punitions pour une saison aléatoire
 *
 * @param string $path Chemin du JSON
 * @return array|null Liste des punitions de toutes les saisons
 */
function getRandomPunishmentsSeason(string $path)
{
    $filteredList = getPunishmentsList($path);

    if (empty($filteredList)) {
        return null;
    }

    $randomKey = array_rand($filteredList);
    return $filteredList[$randomKey];
}

/**
 * Tire une punition aléatoire à partir d'une saison donnée
 *
 * @param string $path Chemin du JSON
 * @param int $season Numéro de saison
 * @return String punition aléatoire pour cette saison
 */
function getRandomPunishmentFromSeason(string $path,int $season): string
{
    $punishmentList = getPunishmentsBySeason($path,$season);

    $randomKey = array_rand($punishmentList);
    return $punishmentList[$randomKey];
}