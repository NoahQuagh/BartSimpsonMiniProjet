<?php

use utils\SessionManager;

require_once __DIR__ . '/services/PunitionService.php';
require_once __DIR__ . '/core/SessionManager.php';


$bys  = getRandomPunishmentFromSeason('data/punishment.json',3);


echo '<pre>';
print_r($bys);
echo '</pre>';