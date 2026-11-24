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

function saveJsonFile(string $path, array $content): bool
{
    $json = json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return $json !== false && file_put_contents($path, $json) !== false;
}
