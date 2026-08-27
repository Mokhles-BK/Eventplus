# EventPlus — Congress Registration Management

Object-oriented PHP mini-app for managing participant registrations to a
scientific congress or workshop, for the fictional platform **EventPlus**.

## Features

- Registration form (HTML + CSS + JS) with client-side validation
  (name/first name regex, email, phone).
- Choice of participant type (Student / Researcher / Industry) and event
  (Congress / Workshop, checkboxes — a participant can register for both).
- Object-oriented PHP class hierarchy:
  - `Evenement` — base class (title, date, location, capacity).
  - `Congres` — extends `Evenement`, adds theme/program, manages the list
    of participants and counts by type.
  - `Workshop` — extends `Evenement`, adds training title/instructor and
    manages the list of attendees.
  - `Participant` — name, first name, email, phone, type, chosen sessions;
    data validation and display.
- `Controller.php` — AJAX (JSON) entry point that receives form data,
  instantiates the classes, and handles registration or display.
- Simple text-file persistence (`participant.txt`, `apprenant.txt`),
  with duplicate detection by email.

## Structure

```
EventPlus/
├── Inscription.html      # Registration form
├── style.css
├── script.js              # Validation + AJAX calls to Controller.php
├── Evenement.php          # Base class
├── Congres.php
├── Workshop.php
├── Participant.php
├── Controller.php         # Backend entry point (JSON)
├── participant.txt        # generated at runtime (git-ignored)
└── apprenant.txt          # generated at runtime (git-ignored)
```

## Running the project

Requires PHP (≥ 7.4, tested with PHP 8 strict types).

```bash
cd EventPlus
php -S localhost:8000
```

Then open [http://localhost:8000/Inscription.html](http://localhost:8000/Inscription.html)
in your browser.
