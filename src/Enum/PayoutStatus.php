<?php
declare(strict_types=1);
namespace App\Enum;

enum PayoutStatus: string
{
     case SCHEDULER  = 'SCHEDULER';
     case PAID  = 'PAID';
     case CANCELLED = 'CANCELLED';


     public function label() : string {
        return match($this){
            self::SCHEDULER => 'Programmé',
            self::PAID => 'Payé',
            self::CANCELLED => 'Annulé'
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