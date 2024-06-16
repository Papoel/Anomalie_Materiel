<?php

namespace App\Entity;

use App\Entity\Traits\TimestampTrait;
use App\Repository\WorkTaskRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UlidType;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity(repositoryClass: WorkTaskRepository::class)]
#[ORM\Table(name: 'work_tasks')]
class WorkTask
{
    use TimestampTrait;

    #[ORM\Id]
    #[ORM\Column(type: UlidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.ulid_generator')]
    private ?Ulid $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private int $task_number;

    #[ORM\Column(type: Types::STRING, length: 100)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $instruction = null;

    #[ORM\ManyToOne(targetEntity: WorkOrder::class, inversedBy: 'workTasks')]
    private ?WorkOrder $workOrder = null;

    public function getId(): ?Ulid
    {
        return $this->id;
    }

    public function getTaskNumber(): ?int
    {
        return $this->task_number;
    }

    public function setTaskNumber(int $task_number): static
    {
        $this->task_number = $task_number;

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

    public function getInstruction(): ?string
    {
        return $this->instruction;
    }

    public function setInstruction(?string $instruction): static
    {
        $this->instruction = $instruction;

        return $this;
    }

    public function getWorkOrder(): ?WorkOrder
    {
        return $this->workOrder;
    }

    public function setWorkOrder(?WorkOrder $workOrder): static
    {
        $this->workOrder = $workOrder;

        return $this;
    }
}
