import { openModal, closeModal } from './modal.js';

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
        const selectedSeason = seasonSelect.value;

        if (selectedSeason === 'random') {
            episodeContainer.style.display = 'none';
            episodeSelect.innerHTML = '<option value="random">Aléatoire</option>';
            return;
        }

        episodeContainer.style.display = 'block';
        episodeSelect.innerHTML = '<option value="random">Chargement...</option>';

        try {
            const response = await fetch(`api/getEpisodes.php?season=${encodeURIComponent(selectedSeason)}`);
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }

            const episodes = await response.json();

            episodeSelect.innerHTML = '<option value="random">Aléatoire</option>';
            episodes.forEach(ep => {
                const option = document.createElement('option');
                option.value = ep.title;
                option.textContent = ep.title;
                if (ep.selected) {
                    option.selected = true;
                }
                episodeSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Erreur chargement épisodes :', error);//todo
            episodeSelect.innerHTML = '<option value="random">Aléatoire</option>';
        }
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

        const formData = new FormData(settingsForm);

        try {
            const response = await fetch('api/setPunishment.php', {
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                throw new Error(`Erreur HTTP : ${response.status}`);
            }

            const result = await response.json();

            if (result.success) {
                window.location.reload();
            }
        } catch (error) {
            console.error('Erreur lors de l\'enregistrement des paramètres :', error);//todo
        }
    });
}

