<?php
declare(strict_types=1);
namespace App\Enum;

enum InvestmentTypeEnum: string
{
     case UNIQUE  = 'UNIQUE';
     case PACKAGE  = 'PACKAGE';
   
     public function label() : string {
        return match($this){
            self::UNIQUE => 'Annulé',
            self::PACKAGE => 'En attente',
        };
     }

     public static function getChoices(): array {
        $out = [];
        foreach(self::cases() as $case){
            $out[$case->label()] = $case->value;
        }
        return $out;
     }
}