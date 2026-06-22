<?php
declare(strict_types=1);

namespace App\Models;

use App\Interfaces\BoardingCard as BoardingCardInterface;

abstract class BaseCard implements BoardingCardInterface
{
    public function __construct(
        protected string  $from,
        protected string  $to,
        protected string  $transport,
        protected ?string $seat = null
    )
    {
    }

    public function from(): string
    {
        return $this->from;
    }

    public function to(): string
    {
        return $this->to;
    }

    protected function seatText(): string
    {
        return $this->seat ? "Sit in seat {$this->seat}." : "No seat assignment.";
    }
}