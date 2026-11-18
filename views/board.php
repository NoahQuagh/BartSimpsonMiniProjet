<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/style/style.css">
  <link rel="stylesheet" href="assets/style/modal.css">
  <link rel="icon" href="" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <script src="https://kit.fontawesome.com/0acb75a9e8.js" crossorigin="anonymous"></script>
  <title>Les punitions de Bart</title>
</head>
<body>

<main>
  <h1>La punition de la semaine</h1>

  <section id="display">
      <div id="board">
          <article id="content"></article>
          <img src="../assets/img/BS.png" alt="Bart Simpson">
      </div>
  </section>

  <section id="parameters">
    <h2>Choisis la saison</h2>
    <button id="settingBtn"><i class="ti ti-settings-2"></i></button>
    <h2>Punis moi !</h2>
    <button id="playBtn"><i class="ti ti-player-play"></i></button>
    <?php require "views/modal.php"; ?>
  </section>
</main>

<footer> Exercice PHP</footer>

<script type="module"  src="assets/js/main.js"></script>
<script>
    const board = document.getElementById("board");

    function writeLine(line) {
        const newLine = document.createElement("p");
        newLine.textContent = line;
        content.appendChild(newLine);
    }

    function writeTitle(title) {
        const episode = document.createElement("span");
        episode.textContent = title;
        board.appendChild(episode);
    }

    <?php
    $hasSeasonSelect=\core\SessionManager::getInstance()->has('seasonSelect');
    $hasEpisodeSelect=\core\SessionManager::getInstance()->has('episodeSelect');

    if($hasSeasonSelect && !empty($hasSeasonSelect)) {

      $season=\core\SessionManager::getInstance()->get('seasonSelect');

      if($hasEpisodeSelect && !empty($hasEpisodeSelect)){
        $episode = \core\SessionManager::getInstance()->get('episodeSelect');
        $punishment = getPunishmentsBySeason($season)[$episode];
      }else{
        $rawPunishment = getRandomPunishmentFromSeason($season);

        $episode = $rawPunishment['title'];
        $punishment = $rawPunishment['punishment'];
      }

    } else {
      $rawRandomPunishment=getRandomPunishmentByRandomSeason();

      $season = $rawRandomPunishment['season'];
      $episode = $rawRandomPunishment['title'];
      $punishment = $rawRandomPunishment['punishment'];
    }

    for ($i = 0; $i < 8; $i++) {
      echo 'setTimeout(function() { writeLine("' . $punishment . '"); }, ' . ($i * 1000) . ');';
    }
    ?>
    setTimeout(function() { writeTitle("<?php echo 'Saison '.$season . ' - ' . $episode; ?>"); }, 8 * 1000);

</script>
</body>
</html>