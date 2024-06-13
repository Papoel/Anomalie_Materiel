<?php

namespace App\Entity;

use App\Entity\Traits\TimestampTrait;
use App\Repository\ConstatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UlidType;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity(repositoryClass: ConstatRepository::class)]
#[ORM\Table(name: 'constats')]
class Constat
{
    use TimestampTrait;

    #[ORM\Id]
    #[ORM\Column(type: UlidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.ulid_generator')]
    private ?Ulid $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $reference = null;

    #[ORM\Column(length: 12)]
    private ?string $functional_marker = null;

    #[ORM\Column(length: 75)]
    private ?string $equipment_label = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $proposed_solutions = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $detection_date = null;

    #[ORM\Column(length: 50)]
    private ?string $writer = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $edf_control_name = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $edf_control_date = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $analysis = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $potential_impacts = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $retained_solutions = null;

    #[ORM\Column(length: 50)]
    private ?string $sn3_name = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $sn3_date = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $transmission_date = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_transmitted_method = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $validation = null;

    #[ORM\Column(length: 12, nullable: true)]
    private ?string $dt_tot_number = null;

    #[ORM\Column(length: 12, nullable: true)]
    private ?string $pa_csta_number = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $validation_responsable = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $validation_date = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $observations = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $implementation_responsable = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $implementation_date = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $method_analysis_confirmation = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $method_impact_protection_interests = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $method_retained_solutions = null;

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getFunctionalMarker(): ?string
    {
        return $this->functional_marker;
    }

    public function setFunctionalMarker(string $functional_marker): static
    {
        $this->functional_marker = $functional_marker;

        return $this;
    }

    public function getEquipmentLabel(): ?string
    {
        return $this->equipment_label;
    }

    public function setEquipmentLabel(string $equipment_label): static
    {
        $this->equipment_label = $equipment_label;

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

    public function getProposedSolutions(): ?string
    {
        return $this->proposed_solutions;
    }

    public function setProposedSolutions(string $proposed_solutions): static
    {
        $this->proposed_solutions = $proposed_solutions;

        return $this;
    }

    public function getDetectionDate(): ?\DateTimeImmutable
    {
        return $this->detection_date;
    }

    public function setDetectionDate(\DateTimeImmutable $detection_date): static
    {
        $this->detection_date = $detection_date;

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

    public function getEdfControlName(): ?string
    {
        return $this->edf_control_name;
    }

    public function setEdfControlName(?string $edf_control_name): static
    {
        $this->edf_control_name = $edf_control_name;

        return $this;
    }

    public function getEdfControlDate(): ?\DateTimeImmutable
    {
        return $this->edf_control_date;
    }

    public function setEdfControlDate(?\DateTimeImmutable $edf_control_date): static
    {
        $this->edf_control_date = $edf_control_date;

        return $this;
    }

    public function getAnalysis(): ?string
    {
        return $this->analysis;
    }

    public function setAnalysis(string $analysis): static
    {
        $this->analysis = $analysis;

        return $this;
    }

    public function getPotentialImpacts(): ?string
    {
        return $this->potential_impacts;
    }

    public function setPotentialImpacts(string $potential_impacts): static
    {
        $this->potential_impacts = $potential_impacts;

        return $this;
    }

    public function getRetainedSolutions(): ?string
    {
        return $this->retained_solutions;
    }

    public function setRetainedSolutions(?string $retained_solutions): static
    {
        $this->retained_solutions = $retained_solutions;

        return $this;
    }

    public function getSn3Name(): ?string
    {
        return $this->sn3_name;
    }

    public function setSn3Name(string $sn3_name): static
    {
        $this->sn3_name = $sn3_name;

        return $this;
    }

    public function getSn3Date(): ?\DateTimeImmutable
    {
        return $this->sn3_date;
    }

    public function setSn3Date(\DateTimeImmutable $sn3_date): static
    {
        $this->sn3_date = $sn3_date;

        return $this;
    }

    public function getTransmissionDate(): ?\DateTimeImmutable
    {
        return $this->transmission_date;
    }

    public function setTransmissionDate(?\DateTimeImmutable $transmission_date): static
    {
        $this->transmission_date = $transmission_date;

        return $this;
    }

    public function isTransmittedMethod(): ?bool
    {
        return $this->is_transmitted_method;
    }

    public function setTransmittedMethod(?bool $is_transmitted_method): static
    {
        $this->is_transmitted_method = $is_transmitted_method;

        return $this;
    }

    public function getValidation(): ?string
    {
        return $this->validation;
    }

    public function setValidation(?string $validation): static
    {
        $this->validation = $validation;

        return $this;
    }

    public function getDtTotNumber(): ?string
    {
        return $this->dt_tot_number;
    }

    public function setDtTotNumber(?string $dt_tot_number): static
    {
        $this->dt_tot_number = $dt_tot_number;

        return $this;
    }

    public function getPaCstaNumber(): ?string
    {
        return $this->pa_csta_number;
    }

    public function setPaCstaNumber(?string $pa_csta_number): static
    {
        $this->pa_csta_number = $pa_csta_number;

        return $this;
    }

    public function getValidationResponsable(): ?string
    {
        return $this->validation_responsable;
    }

    public function setValidationResponsable(?string $validation_responsable): static
    {
        $this->validation_responsable = $validation_responsable;

        return $this;
    }

    public function getValidationDate(): ?\DateTimeImmutable
    {
        return $this->validation_date;
    }

    public function setValidationDate(?\DateTimeImmutable $validation_date): static
    {
        $this->validation_date = $validation_date;

        return $this;
    }

    public function getObservations(): ?string
    {
        return $this->observations;
    }

    public function setObservations(?string $observations): static
    {
        $this->observations = $observations;

        return $this;
    }

    public function getImplementationResponsable(): ?string
    {
        return $this->implementation_responsable;
    }

    public function setImplementationResponsable(?string $implementation_responsable): static
    {
        $this->implementation_responsable = $implementation_responsable;

        return $this;
    }

    public function getImplementationDate(): ?\DateTimeImmutable
    {
        return $this->implementation_date;
    }

    public function setImplementationDate(?\DateTimeImmutable $implementation_date): static
    {
        $this->implementation_date = $implementation_date;

        return $this;
    }

    public function getMethodAnalysisConfirmation(): ?string
    {
        return $this->method_analysis_confirmation;
    }

    public function setMethodAnalysisConfirmation(?string $method_analysis_confirmation): static
    {
        $this->method_analysis_confirmation = $method_analysis_confirmation;

        return $this;
    }

    public function getMethodImpactProtectionInterests(): ?string
    {
        return $this->method_impact_protection_interests;
    }

    public function setMethodImpactProtectionInterests(?string $method_impact_protection_interests): static
    {
        $this->method_impact_protection_interests = $method_impact_protection_interests;

        return $this;
    }

    public function getMethodRetainedSolutions(): ?string
    {
        return $this->method_retained_solutions;
    }

    public function setMethodRetainedSolutions(?string $method_retained_solutions): static
    {
        $this->method_retained_solutions = $method_retained_solutions;

        return $this;
    }
}
