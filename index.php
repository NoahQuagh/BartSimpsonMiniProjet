<?php

use utils\SessionManager;

$data = getJsonFile('assets/punishment.json');
SessionManager::getInstance()->set('punishmentList',$data);


