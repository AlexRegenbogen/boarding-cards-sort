<?php
declare(strict_types=1);

namespace App\Models;

final class FlightCard extends BaseCard
{
    public function __construct(
        string         $from,
        string         $to,
        string         $flightNumber,
        private string $gate,
        string         $seat
    )
    {
        parent::__construct($from, $to, $flightNumber, $seat);
    }

    public function describe(): string
    {
        $parts = [
            "From {$this->from}, take flight {$this->transport} to {$this->to}.",
            "Gate {$this->gate}, seat {$this->seat}."
        ];

        return implode(' ', $parts);
    }
}