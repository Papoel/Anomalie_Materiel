<?php

namespace App\Entity;

use App\Repository\OTRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OTRepository::class)]
class OT
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 8)]
    private ?string $number = null;

    #[ORM\Column(type: Types::STRING, length: 100)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::STRING, length: 6)]
    private ?string $projet = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $instruction = null;

    #[ORM\OneToMany(targetEntity: TOT::class, mappedBy: 'oT', cascade: ['persist', 'remove'])]
    private Collection $tots;

    /**
     * @var Collection<int, Constat>
     */
    #[ORM\OneToMany(targetEntity: Constat::class, mappedBy: 'OT')]
    private Collection $constats;

    public function __construct()
    {
        $this->tots = new ArrayCollection();
        $this->constats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): static
    {
        $this->number = $number;
        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;
        return $this;
    }

    public function getProjet(): ?string
    {
        return $this->projet;
    }

    public function setProjet(string $projet): static
    {
        $this->projet = $projet;
        return $this;
    }

    public function getInstruction(): ?string
    {
        return $this->instruction;
    }

    public function setInstruction(?string $instruction): static
    {
        $this->instruction = $instruction;
        return $this;
    }

    /**
     * @return Collection<int, TOT>
     */
    public function getTots(): Collection
    {
        return $this->tots;
    }

    public function addTot(TOT $tot): static
    {
        if (!$this->tots->contains($tot)) {
            $this->tots->add($tot);
            $tot->setOT($this);
        }

        return $this;
    }

    public function removeTot(TOT $tot): static
    {
        if ($this->tots->removeElement($tot)) {
            if ($tot->getOT() === $this) {
                $tot->setOT(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Constat>
     */
    public function getConstats(): Collection
    {
        return $this->constats;
    }

    public function addConstat(Constat $constat): static
    {
        if (!$this->constats->contains($constat)) {
            $this->constats->add($constat);
            $constat->setOT($this);
        }

        return $this;
    }

    public function removeConstat(Constat $constat): static
    {
        if ($this->constats->removeElement($constat)) {
            // set the owning side to null (unless already changed)
            if ($constat->getOT() === $this) {
                $constat->setOT(null);
            }
        }

        return $this;
    }
}
