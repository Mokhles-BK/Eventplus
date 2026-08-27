# EventPlus — Gestion des inscriptions à un congrès

Mini-module PHP orienté objet permettant de gérer les inscriptions de participants
à un congrès scientifique ou à un workshop, pour la plateforme fictive **EventPlus**.

## Fonctionnalités

- Formulaire d'inscription (HTML + CSS + JS) avec validation côté client
  (regex nom/prénom, email, téléphone).
- Choix du type de participant (Étudiant / Chercheur / Industriel) et de
  l'événement (Congrès / Workshop, cases à cocher — un participant peut
  s'inscrire aux deux).
- Hiérarchie de classes PHP orientée objet :
  - `Evenement` — classe mère (titre, date, lieu, capacité).
  - `Congres` — hérite de `Evenement`, ajoute thème/programme, gère la liste
    des participants et le comptage par type.
  - `Workshop` — hérite de `Evenement`, ajoute formation/formateur et gère
    la liste des apprenants.
  - `Participant` — nom, prénom, email, téléphone, type, ateliers choisis ;
    validation des données et affichage.
- `Controller.php` — point d'entrée AJAX (JSON) qui reçoit les données du
  formulaire, instancie les classes et déclenche l'inscription ou l'affichage.
- Persistance simple par fichiers texte (`participant.txt`, `apprenant.txt`),
  avec détection des doublons par email.

## Structure

```
EventPlus/
├── Inscription.html      # Formulaire
├── style.css
├── script.js              # Validation + appels AJAX vers Controller.php
├── Evenement.php          # Classe mère
├── Congres.php
├── Workshop.php
├── Participant.php
├── Controller.php         # Point d'entrée backend (JSON)
├── participant.txt        # généré à l'exécution (ignoré par git)
└── apprenant.txt          # généré à l'exécution (ignoré par git)
```

## Lancer le projet

Nécessite PHP (≥ 7.4, testé avec les types stricts de PHP 8).

```bash
cd EventPlus
php -S localhost:8000
```

Puis ouvrir [http://localhost:8000/Inscription.html](http://localhost:8000/Inscription.html)
dans le navigateur.
