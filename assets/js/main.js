import { openModal, closeModal } from './modal.js';
import {formChange, formSubmit} from "./settingsForm.js";

const playBtn = document.getElementById('playBtn');
const settingBtn = document.getElementById('settingBtn');
const closeBtns = document.querySelectorAll('.js-close-modal');
const overlay = document.getElementById('settingModal');

playBtn.addEventListener('click', () => {
    window.location.reload();
});

settingBtn.addEventListener('click', () => {
    openModal('settingModal');
});

closeBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        closeModal('settingModal');
    });
});

window.addEventListener('click', (event) => {
    if (event.target === overlay) {
        closeModal('settingModal');
    }
});

const seasonSelect = document.getElementById('season-select');
const episodeContainer = document.getElementById('episode-container');
const episodeSelect = document.getElementById('episode-select');
const settingsForm = document.getElementById('settings-form');

if (seasonSelect && episodeContainer && episodeSelect) {
    seasonSelect.addEventListener('change', async () => {
        await formChange();
    });

    settingsForm?.addEventListener('reset', async (event) => {
        event.preventDefault();

        seasonSelect.value = 'random';
        episodeContainer.style.display = 'none';
        episodeSelect.innerHTML = '<option value="random">Aléatoire</option>';
        const response = await fetch(`api/clear_session.php`);
    });
}

if (settingsForm) {
    settingsForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        await formSubmit();
    });
}

