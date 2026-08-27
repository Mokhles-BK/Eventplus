<?php
class Evenement {

    protected string $titre;
    protected string $date;
    protected string $lieu;
    protected int    $capaciteMax;
    protected int    $nbParticipants = 0;

    public function __construct(string $titre, string $date, string $lieu, int $capaciteMax) {
        $this->titre       = $titre;
        $this->date        = $date;
        $this->lieu        = $lieu;
        $this->capaciteMax = $capaciteMax;
    }

    public function getTitre(): string       { return $this->titre; }
    public function getDate(): string        { return $this->date; }
    public function getLieu(): string        { return $this->lieu; }
    public function getCapaciteMax(): int    { return $this->capaciteMax; }
    public function getNbParticipants(): int { return $this->nbParticipants; }

    public function estComplet(): bool {
        return $this->nbParticipants >= $this->capaciteMax;
    }

    public function afficherDetails(): string {
        return "Titre   : {$this->titre}\n"
             . "Date    : {$this->date}\n"
             . "Lieu    : {$this->lieu}\n"
             . "Places  : {$this->nbParticipants}/{$this->capaciteMax}\n"
             . "Complet : " . ($this->estComplet() ? 'Oui' : 'Non') . "\n";
    }
}