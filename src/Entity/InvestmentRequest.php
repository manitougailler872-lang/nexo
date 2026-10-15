<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\InvestmentRequestStatus;
use App\Enum\InvestmentTypeEnum;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: Investment::class)]
#[ORM\Table(name: 'nexo_investment_request')]
class InvestmentRequest
{
        #[ORM\Id]
        #[ORM\Column(type: 'uuid', unique: true)]
        private Uuid $id;
        
        #[ORM\ManyToOne(targetEntity: Customer::class, inversedBy: 'investRequests')]
        #[ORM\JoinColumn(nullable: true)]
        private ?Customer $customer;
        
        #[ORM\Column(enumType: InvestmentTypeEnum::class , nullable: true)]
        private ?InvestmentTypeEnum $investmentType;

        #[ORM\Column(type:'string', nullable:false)]
        private ?string $planId;

        #[ORM\Column(type:'decimal', precision:14, scale:2)]
        private ?string $amount;

        #[ORM\Column(type:'string', nullable: true)]
        private ?string $currency;

        #[ORM\Column(enumType: InvestmentRequestStatus::class , nullable: true)]
        private ?InvestmentRequestStatus $status;
        
        #[ORM\Column(type: 'datetime_immutable', nullable: true)]
        private ?\DateTimeImmutable $createdAt;

        #[ORM\Column(type: 'datetime_immutable', nullable: true)]
        private ?\DateTimeImmutable $updatedAt;
}