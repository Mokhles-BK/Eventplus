<?php
class Participant {

    private string $nom;
    private string $prenom;
    private string $email;
    private string $telephone;
    private string $type;
    private array  $ateliers = [];

    public function __construct(
        string $nom,
        string $prenom,
        string $email,
        string $telephone,
        string $type,
        array  $ateliers = []
    ) {
        $this->nom       = $nom;
        $this->prenom    = $prenom;
        $this->email     = $email;
        $this->telephone = $telephone;
        $this->type      = $type;
        $this->ateliers  = $ateliers;
    }

    public function getNom(): string       { return $this->nom; }
    public function getPrenom(): string    { return $this->prenom; }
    public function getEmail(): string     { return $this->email; }
    public function getTelephone(): string { return $this->telephone; }
    public function getType(): string      { return $this->type; }
    public function getAteliers(): array   { return $this->ateliers; }

    public function getNomComplet(): string {
        return $this->prenom . ' ' . $this->nom;
    }

    public function valider(): array {
        $erreurs = [];
        if (empty(trim($this->nom)))    $erreurs[] = "Nom obligatoire.";
        if (empty(trim($this->prenom))) $erreurs[] = "Prénom obligatoire.";
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) $erreurs[] = "Email invalide.";
        if (!in_array($this->type, ['etudiant','chercheur','industriel'])) $erreurs[] = "Type invalide.";
        if (empty($this->ateliers))     $erreurs[] = "Choisissez un événement.";
        return $erreurs;
    }

    public function afficherInfos(): string {
        return "Nom complet : {$this->getNomComplet()}\n"
             . "Email       : {$this->email}\n"
             . "Téléphone   : {$this->telephone}\n"
             . "Type        : {$this->type}\n"
             . "Événements  : " . implode(', ', $this->ateliers) . "\n";
    }
}