// Bouton Afficher
document.getElementById('btnAfficher').addEventListener('click', function() {

  const nom    = document.getElementById('nom').value.trim();
  const prenom = document.getElementById('prenom').value.trim();
  const email  = document.getElementById('email').value.trim();
  const tel    = document.getElementById('telephone').value.trim();
  const type   = document.querySelector('input[name="type"]:checked');
  const events = [...document.querySelectorAll('input[name="evenement"]:checked')];

  if (nom === '') { alert('Le nom est obligatoire !'); return; }
  const regexNom = /^[a-zA-ZÀ-ÿ\s\-]+$/;
  if (!regexNom.test(nom)) { alert('Nom invalide !'); return; }
  if (prenom === '') { alert('Le prénom est obligatoire !'); return; }
  if (!regexNom.test(prenom)) { alert('Prénom invalide !'); return; }
  const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!regexEmail.test(email)) { alert('Email invalide !'); return; }
  const regexTel = /^[0-9]{8}$/;
  if (tel !== '' && !regexTel.test(tel)) { alert('Téléphone invalide !'); return; }
  if (!type) { alert('Choisissez un type !'); return; }
  if (events.length === 0) { alert('Choisissez un événement !'); return; }

  const formData = new FormData();
  formData.append('action', 'afficher');
  formData.append('nom', nom);
  formData.append('prenom', prenom);
  formData.append('email', email);
  formData.append('telephone', tel);
  formData.append('type', type.value);
  events.forEach(e => formData.append('evenement[]', e.value));

  fetch('Controller.php', { method: 'POST', body: formData })
    .then(r => r.json())
    .then(data => {
      document.getElementById('resultat').style.display = 'block';
      document.getElementById('resultat').innerHTML = `
        <h3>Inscrits au Congrès</h3>
        <pre>${data.congres}</pre>
        <h3>Inscrits au Workshop</h3>
        <pre>${data.workshop}</pre>
      `;
    });
});

// Bouton S'inscrire
document.getElementById('btnInscrire').addEventListener('click', function() {

  const nom    = document.getElementById('nom').value.trim();
  const prenom = document.getElementById('prenom').value.trim();
  const email  = document.getElementById('email').value.trim();
  const tel    = document.getElementById('telephone').value.trim();
  const type   = document.querySelector('input[name="type"]:checked');
  const events = [...document.querySelectorAll('input[name="evenement"]:checked')];

  if (nom === '') { alert('Le nom est obligatoire !'); return; }
  const regexNom = /^[a-zA-ZÀ-ÿ\s\-]+$/;
  if (!regexNom.test(nom)) { alert('Nom invalide !'); return; }
  if (prenom === '') { alert('Le prénom est obligatoire !'); return; }
  if (!regexNom.test(prenom)) { alert('Prénom invalide !'); return; }
  const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!regexEmail.test(email)) { alert('Email invalide !'); return; }
  const regexTel = /^[0-9]{8}$/;
  if (tel !== '' && !regexTel.test(tel)) { alert('Téléphone invalide !'); return; }
  if (!type) { alert('Choisissez un type !'); return; }
  if (events.length === 0) { alert('Choisissez un événement !'); return; }

  const formData = new FormData();
  formData.append('action', 'inscrire');
  formData.append('nom', nom);
  formData.append('prenom', prenom);
  formData.append('email', email);
  formData.append('telephone', tel);
  formData.append('type', type.value);
  events.forEach(e => formData.append('evenement[]', e.value));

  fetch('Controller.php', { method: 'POST', body: formData })
    .then(r => r.json())
    .then(data => alert(data.messages ? data.messages.join('\n') : 'Inscription réussie !'))
    .catch(() => alert('Erreur de connexion avec le serveur.'));
});