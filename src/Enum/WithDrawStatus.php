<?php
declare(strict_types=1);
namespace App\Enum;

enum WithDrawStatus: string
{
     case PENDING  = 'PENDING';
     case PROCESSING  = 'PROCESSING';
     case COMPLETED  = 'COMPLETED';
     case REJECTED  = 'REJECTED';
     case CANCELED  = 'CANCELED';
   
     public function label() : string {
        return match($this){
            self::PENDING => 'En attente',
            self::PROCESSING => 'Programmé',
            self::REJECTED => 'Rejeté',
            self::CANCELED => 'Annulé',
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