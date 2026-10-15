<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\WithDrawStatus;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: InvestmentPayout::class)]
#[ORM\Table(name: 'nexo_investment_withdraw')]
class InvestmentPayout
{
        #[ORM\Id]
        #[ORM\Column(type: 'uuid', unique: true)]
        private Uuid $id;
        
        #[ORM\ManyToOne(targetEntity: Customer::class, inversedBy: 'investWithdraws')]
        #[ORM\JoinColumn(nullable: true)]
        private ?Customer $customer;
        
        #[ORM\Column(type: 'decimal', precision:14, scale:2,  nullable: true)]
        private ?string $amount;

        #[ORM\Column(type: 'string', nullable: true)]
        private ?string $currency;

        #[ORM\Column(type: 'string', nullable: true)]
        private ?string $method;

        #[ORM\Column(type: 'string', nullable: true)]
        private ?CryptoAsset $cryptoAsset;

        #[ORM\Column(type: 'string', nullable: true)]
        private ?string $cryptoAddress;

        #[ORM\Column(type: 'string', length:255,  nullable: true)]
        private ?string $ibanHolder;

        #[ORM\Column(type: 'string', length:500, nullable: true)]
        private ?string $ibanNumber;

        #[ORM\Column(type: 'datetime', nullable: true)]
        private ?\DateTime $requestAt;

        #[ORM\Column(type: 'datetime', nullable: true)]
        private ?\DateTime $processedAt;

        #[ORM\Column(enumType: WithDrawStatus::class, nullable: true)]
        private ?WithDrawStatus $status;

}