<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Base\InvesmentPack;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CryptoUniquePlanRepository;
use Override;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CryptoUniquePlanRepository::class)]
#[ORM\Table(name: 'nexo_crypto_unique_plan')]
class CryptoUniquePlan extends InvesmentPack
{
    #[ORM\OneToOne(mappedBy: 'cryptoUniquePlans', targetEntity: CryptoAsset::class)]
    private CryptoAsset $cryptoAsset;

    #[Override]
    public function __construct()
    {
        parent::__construct();
    }

    public function getCryptoAsset(): ?CryptoAsset
    {
        return $this->cryptoAsset;
    }

    public function setCryptoAsset(?CryptoAsset $cryptoAsset): static
    {
        $this->cryptoAsset = $cryptoAsset;
        return $this;
    }
}
