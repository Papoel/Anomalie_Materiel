<?php

namespace App\Entity;

use App\Entity\Traits\TimestampTrait;
use App\Repository\WorkOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UlidType;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity(repositoryClass: WorkOrderRepository::class)]
#[ORM\Table(name: 'work_orders')]
class WorkOrder
{
    use TimestampTrait;
    #[ORM\Id]
    #[ORM\Column(type: UlidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.ulid_generator')]
    private ?Ulid $id = null;

    #[ORM\Column(type: Types::STRING, length: 8)]
    private ?string $order_number = null;

    #[ORM\Column(type: Types::STRING, length: 100)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::STRING, length: 6)]
    private ?string $project = null;

    #[ORM\Column(length: 255, nullable: true)] // TODO: Création ENUM work_order_state
    private ?string $state = null;

    /**
     * @var Collection<int, WorkTask>
     */
    #[ORM\OneToMany(targetEntity: WorkTask::class, mappedBy: 'workOrder')]
    private Collection $workTasks;

    public function __construct()
    {
        $this->workTasks = new ArrayCollection();
    }

    public function getId(): ?Ulid
    {
        return $this->id;
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

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getProject(): ?string
    {
        return $this->project;
    }

    public function setProject(string $project): static
    {
        $this->project = $project;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): static
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return Collection<int, WorkTask>
     */
    public function getWorkTasks(): Collection
    {
        return $this->workTasks;
    }

    public function addWorkTask(WorkTask $workTask): static
    {
        if (!$this->workTasks->contains($workTask)) {
            $this->workTasks->add($workTask);
            $workTask->setWorkOrder($this);
        }

        return $this;
    }

    public function removeWorkTask(WorkTask $workTask): static
    {
        if ($this->workTasks->removeElement($workTask)) {
            // set the owning side to null (unless already changed)
            if ($workTask->getWorkOrder() === $this) {
                $workTask->setWorkOrder(null);
            }
        }

        return $this;
    }
}
