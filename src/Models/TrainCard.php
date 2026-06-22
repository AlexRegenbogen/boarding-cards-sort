<?php
declare(strict_types=1);

namespace App\Models;

final class TrainCard extends BaseCard
{
    public function describe(): string
    {
        return "Take train {$this->transport} from {$this->from} to {$this->to}. {$this->seatText()}";
    }
}