# EventPlus — Gestion des inscriptions à un congrès (TP5)

Mini-module PHP orienté objet permettant de gérer les inscriptions de participants
à un congrès scientifique ou à un workshop, pour la plateforme fictive **EventPlus**.

> TP réalisé dans le cadre du cours *Développement Web* — ISSAT Sousse, LSI-A2
> (Enseignante : Dr. Ikbel Sayahi)

## Fonctionnalités

- Formulaire d'inscription (HTML + CSS + JS) avec validation côté client
  (regex nom/prénom, email, téléphone).
- Choix du type de participant (Étudiant / Chercheur / Industriel) et de
  l'événement (Congrès / Workshop, cases à cocher — un participant peut
  s'inscrire aux deux).
- Hiérarchie de classes PHP orientée objet :
  - `Evenement` — classe mère abstraite-like (titre, date, lieu, capacité).
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
TP5/
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
cd TP5
php -S localhost:8000
```

Puis ouvrir [http://localhost:8000/Inscription.html](http://localhost:8000/Inscription.html)
dans le navigateur.

## Limites connues / pistes d'amélioration

- La capacité maximale des événements (`estComplet()`) n'est pas vérifiée de
  façon fiable : `Controller.php` recrée des instances de `Congres` et
  `Workshop` à chaque requête, donc le compteur `nbParticipants` repart à
  zéro en mémoire à chaque appel, même si les fichiers `.txt` persistent
  les inscriptions. Pour un vrai contrôle de capacité, il faudrait
  recharger le nombre d'inscrits depuis les fichiers au démarrage du
  contrôleur.
- Pas de base de données : la persistance par fichiers texte est adaptée à
  un TP mais pas à un usage réel (pas de verrouillage concurrent, pas de
  requêtage).
