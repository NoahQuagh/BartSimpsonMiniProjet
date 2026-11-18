<?php

/**
 * Lit un fichier JSON
 *
 * @param string $path chemin vers le json à récupérer
 * @return mixed json brute récupérer
 */
function getJsonFile(string $path)
{
    $jsonString = file_get_contents($path);
    $data = json_decode($jsonString, true);
    return $data;
}
