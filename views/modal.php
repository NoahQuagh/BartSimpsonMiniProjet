<?php
$session = \core\SessionManager::getInstance();
$savedSeason  = $session->get('seasonSelect');
$savedEpisode = $session->get('episodeSelect');
$hasSavedSeason = ($savedSeason !== null && $savedSeason !== '');
?>

<div id="settingModal" class="modal-overlay" style="display: none;">
  <div class="modal-box">

    <div class="modal-header">
      <h3>Choisir une punition</h3>
      <button type="button" class="modal-close-btn js-close-modal" aria-label="Fermer">
        <i class="ti ti-x" aria-hidden="true"></i>
      </button>
    </div>

    <div class="modal-body">
      <form method="POST" id="settings-form">
        <label for="season-select">Saison</label>
        <select name="season" id="season-select">
          <option value="random">Aléatoire</option>
          <?php foreach (getSeasonsList() as $saisonNb): ?>
            <option value="<?= htmlspecialchars((string) $saisonNb) ?>" <?= ((string) $saisonNb === (string) $savedSeason) ? 'selected' : '' ?>>
              Saison <?= htmlspecialchars((string) $saisonNb) ?>
            </option>
          <?php endforeach; ?>
        </select>

        <div id="episode-container" style="display: <?= $hasSavedSeason ? 'block' : 'none' ?>;">
          <label for="episode-select">Épisode</label>
          <select name="episode" id="episode-select">
            <option value="random">Aléatoire</option>
            <?php if ($hasSavedSeason): ?>
              <?php foreach (array_keys(getPunishmentsBySeason((int) $savedSeason)) as $epTitle): ?>
                <option value="<?= htmlspecialchars($epTitle) ?>" <?= ($epTitle === $savedEpisode) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($epTitle) ?>
                </option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>

        <button type="submit">Valider</button>
        <button type="reset">Oublier mon choix</button>
      </form>
    </div>

    <div class="modal-footer">
      <button type="button" class="modal-btn btn-cancel js-close-modal">Fermer</button>
      <button type="submit" form="settings-form" class="modal-btn btn-confirm risk">Confirmer</button>
    </div>

  </div>
</div>