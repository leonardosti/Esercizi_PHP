// Classifiche
async function loadClassifica(type) {
    const response = await fetch(`/php/classifiche.php?type=${type}`);
    const data = await response.json();

    const tbody = document.getElementById(`classifica-${type}`);
    tbody.innerHTML = data.map(item => type === 'piloti' ? `
        <tr>
            <td>${item.posizione}</td>
            <td>${item.nome} ${item.cognome}</td>
            <td>${item.squadra}</td>
            <td>${item.punti}</td>
        </tr>
    ` : `
        <tr>
            <td>${item.posizione}</td>
            <td>${item.squadra}</td>
            <td style="background-color:${item.colore}"></td>
            <td>${item.punti}</td>
        </tr>
    `).join('');
}

// Inserimento Risultati
document.getElementById('form-risultato').addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = {
        id_gara: document.getElementById('select-gara').value,
        numero: document.getElementById('select-pilota').value,
        posizione: document.querySelector('#form-risultato input[type="number"]').value,
        miglior_giro: '01:30.456'
    };

    try {
        const response = await fetch('/php/inserimento.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(formData)
        });

        const result = await response.json();
        if(result.success) {
            loadClassifica('piloti');
            alert('Risultato salvato!');
        }
    } catch (err) {
        console.error('Errore:', err);
    }
});