<?php

namespace App\Entity;

use App\Repository\ConstatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ConstatRepository::class)]
class Constat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 12)]
    private ?string $system = null;

    #[ORM\Column(length: 2)]
    private ?string $order_number = null;

    #[ORM\ManyToOne(inversedBy: 'constats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?OT $OT = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isQs = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isEip = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $solutions = null;

    #[ORM\Column(nullable: true)]
    private ?bool $IsDsiChecked = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $analyse = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $impacts = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $solution_selected = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isValidate = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isDTorTOT = null;

    #[ORM\Column(length: 12, nullable: true)]
    private ?string $dt_tot = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isOpenPA = null;

    #[ORM\Column(length: 12, nullable: true)]
    private ?string $PACSTA = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $observation = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $method_analyse = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $method_impact = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $method_solutions = null;

    #[ORM\Column(length: 100)]
    private ?string $writer = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $writer_edf = null;

    #[ORM\Column(length: 100)]
    private ?string $sn3 = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $cdt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $transmissionAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $returnAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $realisationAt = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isSold = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isPending = null;

    #[ORM\Column(nullable: true)]
    private ?bool $IsTransferMethod = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSystem(): ?string
    {
        return $this->system;
    }

    public function setSystem(string $system): static
    {
        $this->system = $system;

        return $this;
    }

    public function getOrderNumber(): ?string
    {
        return $this->order_number;
    }

    public function setOrderNumber(string $order_number): static
    {
        $this->order_number = $order_number;

        return $this;
    }

    public function getOT(): ?OT
    {
        return $this->OT;
    }

    public function setOT(?OT $OT): static
    {
        $this->OT = $OT;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isQs(): ?bool
    {
        return $this->isQs;
    }

    public function setQs(?bool $isQs): static
    {
        $this->isQs = $isQs;

        return $this;
    }

    public function isEip(): ?bool
    {
        return $this->isEip;
    }

    public function setEip(?bool $isEip): static
    {
        $this->isEip = $isEip;

        return $this;
    }

    public function getSolutions(): ?string
    {
        return $this->solutions;
    }

    public function setSolutions(?string $solutions): static
    {
        $this->solutions = $solutions;

        return $this;
    }

    public function isDsiChecked(): ?bool
    {
        return $this->IsDsiChecked;
    }

    public function setDsiChecked(?bool $IsDsiChecked): static
    {
        $this->IsDsiChecked = $IsDsiChecked;

        return $this;
    }

    public function getAnalyse(): ?string
    {
        return $this->analyse;
    }

    public function setAnalyse(?string $analyse): static
    {
        $this->analyse = $analyse;

        return $this;
    }

    public function getImpacts(): ?string
    {
        return $this->impacts;
    }

    public function setImpacts(?string $impacts): static
    {
        $this->impacts = $impacts;

        return $this;
    }

    public function getSolutionSelected(): ?string
    {
        return $this->solution_selected;
    }

    public function setSolutionSelected(?string $solution_selected): static
    {
        $this->solution_selected = $solution_selected;

        return $this;
    }

    public function isValidate(): ?bool
    {
        return $this->isValidate;
    }

    public function setValidate(?bool $isValidate): static
    {
        $this->isValidate = $isValidate;

        return $this;
    }

    public function isDTorTOT(): ?bool
    {
        return $this->isDTorTOT;
    }

    public function setDTorTOT(?bool $isDTorTOT): static
    {
        $this->isDTorTOT = $isDTorTOT;

        return $this;
    }

    public function getDtTot(): ?string
    {
        return $this->dt_tot;
    }

    public function setDtTot(?string $dt_tot): static
    {
        $this->dt_tot = $dt_tot;

        return $this;
    }

    public function isOpenPA(): ?bool
    {
        return $this->isOpenPA;
    }

    public function setOpenPA(?bool $isOpenPA): static
    {
        $this->isOpenPA = $isOpenPA;

        return $this;
    }

    public function getPACSTA(): ?string
    {
        return $this->PACSTA;
    }

    public function setPACSTA(?string $PACSTA): static
    {
        $this->PACSTA = $PACSTA;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): static
    {
        $this->observation = $observation;

        return $this;
    }

    public function getMethodAnalyse(): ?string
    {
        return $this->method_analyse;
    }

    public function setMethodAnalyse(?string $method_analyse): static
    {
        $this->method_analyse = $method_analyse;

        return $this;
    }

    public function getMethodImpact(): ?string
    {
        return $this->method_impact;
    }

    public function setMethodImpact(?string $method_impact): static
    {
        $this->method_impact = $method_impact;

        return $this;
    }

    public function getMethodSolutions(): ?string
    {
        return $this->method_solutions;
    }

    public function setMethodSolutions(?string $method_solutions): static
    {
        $this->method_solutions = $method_solutions;

        return $this;
    }

    public function getWriter(): ?string
    {
        return $this->writer;
    }

    public function setWriter(string $writer): static
    {
        $this->writer = $writer;

        return $this;
    }

    public function getWriterEdf(): ?string
    {
        return $this->writer_edf;
    }

    public function setWriterEdf(?string $writer_edf): static
    {
        $this->writer_edf = $writer_edf;

        return $this;
    }

    public function getSn3(): ?string
    {
        return $this->sn3;
    }

    public function setSn3(string $sn3): static
    {
        $this->sn3 = $sn3;

        return $this;
    }

    public function getCdt(): ?string
    {
        return $this->cdt;
    }

    public function setCdt(?string $cdt): static
    {
        $this->cdt = $cdt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getTransmissionAt(): ?\DateTimeImmutable
    {
        return $this->transmissionAt;
    }

    public function setTransmissionAt(?\DateTimeImmutable $transmissionAt): static
    {
        $this->transmissionAt = $transmissionAt;

        return $this;
    }

    public function getReturnAt(): ?\DateTimeImmutable
    {
        return $this->returnAt;
    }

    public function setReturnAt(?\DateTimeImmutable $returnAt): static
    {
        $this->returnAt = $returnAt;

        return $this;
    }

    public function getRealisationAt(): ?\DateTimeImmutable
    {
        return $this->realisationAt;
    }

    public function setRealisationAt(?\DateTimeImmutable $realisationAt): static
    {
        $this->realisationAt = $realisationAt;

        return $this;
    }

    public function isSold(): ?bool
    {
        return $this->isSold;
    }

    public function setSold(?bool $isSold): static
    {
        $this->isSold = $isSold;

        return $this;
    }

    public function isPending(): ?bool
    {
        return $this->isPending;
    }

    public function setPending(?bool $isPending): static
    {
        $this->isPending = $isPending;

        return $this;
    }

    public function isTransferMethod(): ?bool
    {
        return $this->IsTransferMethod;
    }

    public function setTransferMethod(?bool $IsTransferMethod): static
    {
        $this->IsTransferMethod = $IsTransferMethod;

        return $this;
    }
}
