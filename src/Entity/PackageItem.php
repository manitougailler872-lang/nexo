<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\NexoCryptoAddressRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: NexoCryptoAddressRepository::class)]
#[ORM\Table(name: 'nexo_package_item')]
class PackageItem{

    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;

   #[ORM\ManyToOne(
        targetEntity: CryptoPackagePlan::class,
        inversedBy: 'packages',
        cascade: ['remove']
    )]
    #[ORM\JoinColumn(nullable: true)]
    private ?CryptoPackagePlan $packagePlan = null;

    #[ORM\ManyToOne(
        targetEntity: CryptoAsset::class,
        inversedBy: 'packages',
        cascade: ['remove']
    )]
    #[ORM\JoinColumn(nullable: true)]
    private CryptoAsset $cryptoAsset;

    #[ORM\Column(type: 'decimal', precision: 14, scale: 2)]
    private ?string $allocationPercent;

     public function __construct()
     {
        throw new \Exception('Not implemented');
     }
}