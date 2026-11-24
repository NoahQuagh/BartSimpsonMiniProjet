<div id="addPunishModal" class="modal-overlay" style="display: none;">
    <div class="modal-box">

        <div class="modal-header">
            <h3>Créer une nouvelle punition</h3>
            <button type="button" class="modal-close-btn js-close-modal" id="closeAddMd" aria-label="Fermer">
                <i class="ti ti-x" aria-hidden="true"></i>
            </button>
        </div>

        <div class="modal-body">
            <form method="POST" id="add-form">
                <label for="custom_title">Titre</label>
                <input type="text" name="custom_title" id="custom_title" required>

                <label for="custom_punishment">Punition</label>
                <input type="text" name="custom_punishment" id="custom_punishment" required>
            </form>
        </div>

        <div class="modal-footer">
            <button type="button" id="closeAddModalBtn" class="modal-btn btn-cancel js-close-modal">Fermer</button>
            <button type="submit" form="add-form" class="modal-btn btn-confirm">Valider</button>
        </div>

    </div>
</div>
