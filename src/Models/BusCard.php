<?php
declare(strict_types=1);

namespace App\Models;

final class BusCard extends BaseCard
{
    public function describe(): string
    {
        return "Take the {$this->transport} from {$this->from} to {$this->to}. {$this->seatText()}";
    }
}