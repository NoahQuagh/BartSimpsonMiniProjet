<h1>La punition de la semaine</h1>
<section id="display">
    <div id="board">
        <article id="content"></article>
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
            $hasSeasonSelect=\utils\SessionManager::getInstance()->has('seasonSelect');
            if($hasSeasonSelect && !empty($hasSeasonSelect)) {
                $season=\utils\SessionManager::getInstance()->get('seasonSelect');
                $episodeAleatoire = getRandomPunishmentFromSeason($season);
            } else {
                $episodeAleatoire=getRandomPunishmentByRandomSeason();
                $season=$episodeAleatoire['season'];
            }
            $episode = $episodeAleatoire['title'];
            $punition = $episodeAleatoire['punishment'];
            for ($i = 0; $i < 8; $i++) {
                echo 'setTimeout(function() { writeLine("' . $punition . '"); }, ' . ($i * 1000) . ');';
            }
            ?>
            setTimeout(function() { writeTitle("<?php echo 'Saison '.$season . ' - ' . $episode; ?>"); }, 8 * 1000);

        </script>
        <img src="../assets/img/BS.png" alt="Bart Simpson">
    </div>
</section>