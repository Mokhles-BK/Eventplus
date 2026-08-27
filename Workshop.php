<?php
require_once 'Evenement.php';
require_once 'Participant.php';

class Workshop extends Evenement {

    private string $intituleFormation;
    private string $nomFormateur;
    private array  $participants = [];

    public function __construct(
        string $titre,
        string $date,
        string $lieu,
        int    $capaciteMax,
        string $intituleFormation,
        string $nomFormateur
    ) {
        parent::__construct($titre, $date, $lieu, $capaciteMax);
        $this->intituleFormation = $intituleFormation;
        $this->nomFormateur      = $nomFormateur;
    }

    public function inscrireApprenant(Participant $p): bool {
        if ($this->estComplet()) {
            return false;
        }
        $this->participants[] = $p;
        $this->nbParticipants++;

        // Sauvegarder dans apprenant.txt
        $ligne = $p->getNomComplet() . " | "
               . $p->getEmail()      . " | "
               . $p->getTelephone()  . "\n";
        file_put_contents('apprenant.txt', $ligne, FILE_APPEND);

        return true;
    }

    public function afficherParticipants(): string {
        if (empty($this->participants)) return "Aucun apprenant.\n";
        $sortie = "";
        foreach ($this->participants as $i => $p) {
            $sortie .= ($i+1) . ". " . $p->getNomComplet() . " – " . $p->getEmail() . "\n";
        }
        return $sortie;
    }

    public function afficherDetails(): string {
        return parent::afficherDetails()
             . "Formation : {$this->intituleFormation}\n"
             . "Formateur : {$this->nomFormateur}\n";
    }
}
