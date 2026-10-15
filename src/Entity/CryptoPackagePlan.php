<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Base\InvesmentPack;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CryptoUniquePlanRepository;

#[ORM\Entity(repositoryClass: CryptoUniquePlanRepository::class)]
#[ORM\Table(name: 'nexo_crypto_package_plan')]
class CryptoPackagePlan extends InvesmentPack
{
    
}
