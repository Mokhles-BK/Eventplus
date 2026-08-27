<?php
require_once 'Participant.php';
require_once 'Congres.php';
require_once 'Workshop.php';

$congres = new Congres(
    "Congrès International en Informatique",
    "2026-06-15",
    "Sousse, Tunisie",
    100,
    "Intelligence Artificielle",
    "Conférences et ateliers"
);

$workshop = new Workshop(
    "Workshop PHP Orienté Objet",
    "2026-06-14",
    "ISSAT Sousse",
    30,
    "Développement Web PHP 8",
    "Dr. Ikbel Sayahi"
);

$action     = $_POST['action']     ?? '';
$nom        = trim($_POST['nom']        ?? '');
$prenom     = trim($_POST['prenom']     ?? '');
$email      = trim($_POST['email']      ?? '');
$telephone  = trim($_POST['telephone']  ?? '');
$type       = trim($_POST['type']       ?? '');
$evenements = $_POST['evenement']  ?? [];

header('Content-Type: application/json; charset=utf-8');

$participant = new Participant($nom, $prenom, $email, $telephone, $type, $evenements);
$erreurs     = $participant->valider();

if (!empty($erreurs)) {
    echo json_encode(['status' => 'error', 'errors' => $erreurs]);
    exit;
}

// ── Helper ──────────────────────────────────────────────
function isAlreadyRegistered($email, $fichier) {
    if (!file_exists($fichier)) return false;
    foreach (file($fichier, FILE_IGNORE_NEW_LINES) as $ligne) {
        if (strpos($ligne, $email) !== false) return true;
    }
    return false;
}

// ── Bouton S'inscrire ───────────────────────────────────
if ($action === 'inscrire') {
    $messages = [];

    foreach ($evenements as $ev) {
        if ($ev === 'congres') {
            if (isAlreadyRegistered($email, 'participant.txt')) {
                $messages[] = "Déjà inscrit au Congrès ⚠️";
            } else {
                $ok = $congres->ajouterParticipant($participant);
                $messages[] = $ok ? "Inscrit au Congrès ✅" : "Congrès complet ❌";
            }
        }
        if ($ev === 'workshop') {
            if (isAlreadyRegistered($email, 'apprenant.txt')) {
                $messages[] = "Déjà inscrit au Workshop ⚠️";
            } else {
                $ok = $workshop->inscrireApprenant($participant);
                $messages[] = $ok ? "Inscrit au Workshop ✅" : "Workshop complet ❌";
            }
        }
    }

    echo json_encode(['status' => 'success', 'messages' => $messages]);
    exit;
}

// ── Bouton Afficher ─────────────────────────────────────
if ($action === 'afficher') {
    $inscrits   = file_exists('participant.txt') ? file_get_contents('participant.txt') : 'Aucun inscrit.';
    $apprenants = file_exists('apprenant.txt')   ? file_get_contents('apprenant.txt')  : 'Aucun apprenant.';

    echo json_encode([
        'status'   => 'success',
        'congres'  => $inscrits,
        'workshop' => $apprenants
    ]);
    exit;
}