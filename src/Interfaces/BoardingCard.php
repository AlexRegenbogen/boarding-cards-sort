<?php
declare(strict_types=1);

namespace App\Interfaces;

interface BoardingCard
{
    public function from(): string;

    public function to(): string;

    public function describe(): string;
}