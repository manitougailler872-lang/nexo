<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\LoanStatus;
use App\Repository\LoanRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: LoanRepository::class)]
#[ORM\Table(name: 'nexo_loan')]
class Loan
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;

    private ?string $reference;
    private ?string $amount;
    private ?int $duration;
    private ?string $mensuality;
    private ?LoanStatus $status;

    #[ORM\ManyToOne(targetEntity: Customer::class, inversedBy: 'loans')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Customer $customer;

    #[ORM\ManyToOne(targetEntity: LoanType::class, inversedBy: 'loans')]
    #[ORM\JoinColumn(nullable: true)]
    private ?LoanType $loanType;


}
