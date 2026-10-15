<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\InvestmentRequestStatus;
use App\Enum\InvestmentTypeEnum;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: Investment::class)]
#[ORM\Table(name: 'nexo_investment')]
class Investment
{
        #[ORM\Id]
        #[ORM\Column(type: 'uuid', unique: true)]
        private Uuid $id;

        #[ORM\OneToOne(targetEntity: InvestmentRequest::class)]
        #[ORM\JoinColumn(nullable: true)]
        private ?InvestmentRequest $investmentRequest;

        #[ORM\ManyToOne(targetEntity: Customer::class, inversedBy: 'investments')]
        #[ORM\JoinColumn(nullable: true)]
        private ?Customer $customer;

        #[ORM\ManyToOne(targetEntity: CryptoUniquePlan::class, inversedBy: 'investments')]
        #[ORM\JoinColumn(nullable: true)]
        private ?CryptoUniquePlan $cryptoUniquePlan;

        #[ORM\ManyToOne(targetEntity: CryptoPackagePlan::class, inversedBy: 'investments')]
        #[ORM\JoinColumn(nullable: true)]
        private ?CryptoPackagePlan $cryptoPackagePlan;
        
        #[ORM\Column(enumType: InvestmentTypeEnum::class , unique: true)]
        private ?InvestmentTypeEnum $investmentType;

        #[ORM\Column(type: 'decimal', precision:14, scale:2, nullable: true)]
        private ?string $amount;

        #[ORM\Column(type: 'string', length:50,  nullable: true)]
        private ?string $currency;

        #[ORM\Column(enumType:InvestmentRequestStatus::class, nullable: true)]
        private InvestmentRequestStatus $status;

        #[ORM\Column(type: 'datetime_immutable', nullable: true)]
        private ?\DateTimeImmutable $startDate;

        #[ORM\Column(type: 'datetime', nullable: true)]
        private \DateTime $nextPayoutDate;

        #[ORM\Column(type: 'decimal', precision:14, scale:2, nullable: true)]
        private ?string $totalPayouts;

        #[ORM\Column(type: 'decimal', precision:14, scale:2, nullable: true)]
        private ?string $totalPayoutsReceived;
}