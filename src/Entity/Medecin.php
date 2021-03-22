<?php

namespace App\Entity;

use App\Repository\MedecinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MedecinRepository::class)
 */
class Medecin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\ManyToMany(targetEntity=Demande::class, inversedBy="medecins")
     */
    private $demande;

    /**
     * @ORM\OneToMany(targetEntity=Assistant::class, mappedBy="medecin")
     */
    private $assistants;

    public function __construct()
    {
        $this->demande = new ArrayCollection();
        $this->assistants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdmedecin(): ?int
    {
        return $this->idmedecin;
    }

    public function setIdmedecin(int $idmedecin): self
    {
        $this->idmedecin = $idmedecin;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|Demande[]
     */
    public function getDemande(): Collection
    {
        return $this->demande;
    }

    public function addDemande(Demande $demande): self
    {
        if (!$this->demande->contains($demande)) {
            $this->demande[] = $demande;
        }

        return $this;
    }

    public function removeDemande(Demande $demande): self
    {
        $this->demande->removeElement($demande);

        return $this;
    }

    /**
     * @return Collection|Assistant[]
     */
    public function getAssistants(): Collection
    {
        return $this->assistants;
    }

    public function addAssistant(Assistant $assistant): self
    {
        if (!$this->assistants->contains($assistant)) {
            $this->assistants[] = $assistant;
            $assistant->setMedecin($this);
        }

        return $this;
    }

    public function removeAssistant(Assistant $assistant): self
    {
        if ($this->assistants->removeElement($assistant)) {
            // set the owning side to null (unless already changed)
            if ($assistant->getMedecin() === $this) {
                $assistant->setMedecin(null);
            }
        }

        return $this;
    }
}
