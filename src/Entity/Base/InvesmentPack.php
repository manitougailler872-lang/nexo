<?php

declare(strict_types=1);

namespace App\Entity\Base;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

abstract class InvesmentPack
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $label;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description;

    #[ORM\Column(type: 'decimal', precision:14, scale:2, nullable: true)]
    private ?string $dailyReturnPercent;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $frequencyDays;

    #[ORM\Column(type: 'datetime_immutable',nullable:true)]
    private ?\DateTimeImmutable $creationDate;

    #[ORM\Column(type: 'datetime_immutable',nullable:true)]
    private ?\DateTimeImmutable $modificationDate;

    public function __construct()
    {
        $this->id = Uuid::v7();
        $this->creationDate = $this->modificationDate = new \DateTimeImmutable('now');
    }

    public function getId(): Uuid
    {
        return $this->id;
    }


    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDailyReturnPercent(): ?string
    {
        return $this->dailyReturnPercent;
    }

    public function setDailyReturnPercent(?string $dailyReturnPercent): static
    {
        $this->dailyReturnPercent = $dailyReturnPercent;

        return $this;
    }

    public function getFrequencyDays(): ?string
    {
        return $this->frequencyDays;
    }

    public function setFrequencyDays(?string $frequencyDays): static
    {
        $this->frequencyDays = $frequencyDays;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeImmutable
    {
        return $this->creationDate;
    }

    public function setCreationDate(?\DateTimeImmutable $creationDate): static
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getModificationDate(): ?\DateTimeImmutable
    {
        return $this->modificationDate;
    }

    public function setModificationDate(?\DateTimeImmutable $modificationDate): static
    {
        $this->modificationDate = $modificationDate;

        return $this;
    }

}