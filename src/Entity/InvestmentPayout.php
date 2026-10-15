<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\InvestmentRequestStatus;
use App\Enum\InvestmentTypeEnum;
use App\Enum\PayoutStatus;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: InvestmentPayout::class)]
#[ORM\Table(name: 'nexo_investment_payout')]
class InvestmentPayout
{
        #[ORM\Id]
        #[ORM\Column(type: 'uuid', unique: true)]
        private Uuid $id;
        
        #[ORM\ManyToOne(targetEntity: Investment::class, inversedBy: 'payouts')]
        #[ORM\JoinColumn(nullable: true)]
        private ?Investment $investment;

        #[ORM\Column(type: 'decimal', precision:14, scale:2,  nullable: true)]
        private ?string $percentage;
        
        #[ORM\Column(type: 'decimal', precision:14, scale:2,  nullable: true)]
        private ?string $amount;

        #[ORM\Column(type: 'string', nullable: true)]
        private ?string $currency;

        #[ORM\Column(enumType: PayoutStatus::class , nullable: true)]
        private ?PayoutStatus $status;
 
        #[ORM\Column(type: 'datetime', nullable: true)]
        private ?\DateTime $paidAt;

        #[ORM\Column(type: 'datetime', nullable: true)]
        private ?\DateTime $scheduledAt;

}