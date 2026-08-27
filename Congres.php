<?php
require_once 'Evenement.php';
require_once 'Participant.php';

class Congres extends Evenement {

    private string $theme;
    private string $programme;
    private array  $participants = [];

    public function __construct(
        string $titre,
        string $date,
        string $lieu,
        int    $capaciteMax,
        string $theme,
        string $programme
    ) {
        parent::__construct($titre, $date, $lieu, $capaciteMax);
        $this->theme     = $theme;
        $this->programme = $programme;
    }

    public function ajouterParticipant(Participant $p): bool {
        if ($this->estComplet()) {
            return false;
        }
        $this->participants[] = $p;
        $this->nbParticipants++;

        // Sauvegarder dans participant.txt
        $ligne = $p->getNomComplet() . " | "
               . $p->getEmail()      . " | "
               . $p->getType()       . "\n";
        file_put_contents('participant.txt', $ligne, FILE_APPEND);

        return true;
    }

    public function afficherParticipants(): string {
        if (empty($this->participants)) return "Aucun participant.\n";
        $sortie = "";
        foreach ($this->participants as $i => $p) {
            $sortie .= ($i+1) . ". " . $p->getNomComplet() . " – " . $p->getType() . "\n";
        }
        return $sortie;
    }

    public function compterParType(): array {
        $c = ['etudiant' => 0, 'chercheur' => 0, 'industriel' => 0];
        foreach ($this->participants as $p) $c[$p->getType()]++;
        return $c;
    }

    public function afficherDetails(): string {
        $c = $this->compterParType();
        return parent::afficherDetails()
             . "Thème       : {$this->theme}\n"
             . "Programme   : {$this->programme}\n"
             . "Étudiants   : {$c['etudiant']}\n"
             . "Chercheurs  : {$c['chercheur']}\n"
             . "Industriels : {$c['industriel']}\n";
    }
}