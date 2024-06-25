<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait TimestampTrait
{
    public const TIMEZONE = 'Europe/Paris';

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    public \DateTimeImmutable $created_at;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    public ?\DateTimeImmutable $updated_at = null;

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->created_at = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): void
    {
        $timezone = new \DateTimeZone(timezone: self::TIMEZONE);
        $this->updated_at = new \DateTimeImmutable(timezone: $timezone);
    }
}
