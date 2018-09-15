<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AscenseurRepository")
 */
class Ascenseur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $etat;


    /**
     * @ORM\Column(type="boolean")
     */
    public $ledLvl0;

    /**
     * @ORM\Column(type="boolean")
     */
    public $ledLvl1;

    /**
     * @ORM\Column(type="boolean")
     */
    public $ledLvl2;

    /**
     * @ORM\Column(type="boolean")
     */
    public $ledLvl3;

    /**
     * @ORM\Column(type="boolean")
     */
    public $ledErreur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $affichage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getLedLvl0(): ?bool
    {
        return $this->ledLvl0;
    }

    public function setLedLvl0(bool $ledLvl0): self
    {
        $this->ledLvl0 = $ledLvl0;

        return $this;
    }

    public function getLedLvl1(): ?bool
    {
        return $this->ledLvl1;
    }

    public function setLedLvl1(bool $ledLvl1): self
    {
        $this->ledLvl1 = $ledLvl1;

        return $this;
    }

    public function getLedLvl2(): ?bool
    {
        return $this->ledLvl2;
    }

    public function setLedLvl2(bool $ledLvl2): self
    {
        $this->ledLvl2 = $ledLvl2;

        return $this;
    }

    public function getLedLvl3(): ?bool
    {
        return $this->ledLvl3;
    }

    public function setLedLvl3(bool $ledLvl3): self
    {
        $this->ledLvl3 = $ledLvl3;

        return $this;
    }

    public function getLedErreur(): ?bool
    {
        return $this->ledErreur;
    }

    public function setLedErreur(bool $ledErreur): self
    {
        $this->ledErreur = $ledErreur;

        return $this;
    }

    public function getAffichage(): ?string
    {
        return $this->affichage;
    }

    public function setAffichage(string $affichage): self
    {
        $this->affichage = $affichage;

        return $this;
    }
}
