<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\LoanTypeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: LoanTypeRepository::class)]
#[ORM\Table(name: 'nexo_loan_type')]
class LoanType
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;

    #[ORM\Column(type: 'string', length:255,  nullable: true)]
    private ?string $label;

    #[ORM\Column(type: 'string', length:255,  nullable: true)]
    private ?string $description;

    #[ORM\Column(type: 'string', length:255,  nullable: true)]
    private ?string $code;

    #[ORM\Column(type: 'string', length:50,  nullable: true)]
    private ?string $currency;

    #[ORM\Column(type: 'decimal', length:255,  nullable: true)]
    private ?string $taeg;

    #[ORM\Column(type: 'decimal', length:255,  nullable: true)]
    private ?string $information;

    #[ORM\Column(type: 'decimal', length:255,  nullable: true)]
    private ?string $minAmount;

    #[ORM\Column(type: 'decimal', length:255,  nullable: true)]
    private ?string $maxAmount;

    #[ORM\Column(type: 'decimal', length:255,  nullable: true)]
    private ?string $minMonth;

    #[ORM\Column(type: 'decimal', length:255,  nullable: true)]
    private ?string $maxMonth;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $active;

}
