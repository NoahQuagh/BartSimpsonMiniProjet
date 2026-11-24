import { openModal, closeModal } from './modal.js';
import {formChange, formSubmit} from "./settingsForm.js";

const playBtn = document.getElementById('playBtn');
const addBtn = document.getElementById('addBtn');
const settingBtn = document.getElementById('settingBtn');
const closeBtns = document.querySelectorAll('.js-close-modal');
const overlay = document.getElementById('settingModal');
const closeAddModal = document.getElementById('closeAddModalBtn');
const closeAddModalBtn = document.getElementById('closeAddMd');

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

if (addBtn) {
    addBtn.addEventListener('click', () => {
        openModal('addPunishModal');
    });
}

if (closeAddModal) {
    closeAddModal.addEventListener('click', () => {
        closeModal('addPunishModal');
    });
}

if(closeAddModalBtn){
    closeAddModalBtn.addEventListener('click',()=>{
        closeModal('addPunishModal');
    });
}

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

const addForm = document.getElementById('add-form');

if (addForm) {
    addForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        const formData = new FormData(addForm);

        try {
            const response = await fetch('api/add_punishment.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                window.location.reload();
            } else {
                alert(result.message || 'Erreur lors de l\'ajout.');
            }
        } catch (error) {
            console.error('Erreur lors de l\'ajout de la punition :', error);
        }
    });
}
