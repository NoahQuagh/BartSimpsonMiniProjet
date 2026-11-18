const seasonSelect = document.getElementById('season-select');
const episodeContainer = document.getElementById('episode-container');
const episodeSelect = document.getElementById('episode-select');
const settingsForm = document.getElementById('settings-form');

export async function formChange (){

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
}

export async function formSubmit(){
    const formData = new FormData(settingsForm);

    try {
        const response = await fetch('api/setSettings.php', {
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
}