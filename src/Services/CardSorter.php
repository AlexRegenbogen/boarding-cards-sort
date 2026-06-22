<?php
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\BoardingCard;
use App\Models\BaseCard;
use RuntimeException;

final class CardSorter
{
    /**
     * @param BoardingCard[] $cards
     * @return BoardingCard[]
     */
    public function sort(array $cards): array
    {
        $fromMap = [];
        $destinations = [];

        if (count($cards) !== count(array_filter($cards, [$this, 'isCard']))) {
            throw new RuntimeException("One or more cards are not extending BaseCard");
        }

        foreach ($cards as $card) {
            if (isset($fromMap[$card->from()])) {
                throw new RuntimeException("Duplicate departure point: {$card->from()}");
            }

            $fromMap[$card->from()] = $card;
            $destinations[$card->to()] = true;
        }

        $start = null;

        foreach ($cards as $card) {
            if (!isset($destinations[$card->from()])) {
                $start = $card->from();
                break;
            }
        }

        if ($start === null) {
            throw new RuntimeException("Could not find journey start.");
        }

        $sorted = [];

        while (isset($fromMap[$start])) {
            $card = $fromMap[$start];
            $sorted[] = $card;
            $start = $card->to();
        }


        if (count($sorted) !== count($cards)) {
            throw new RuntimeException("Cards do not form one continuous journey.");
        }

        return $sorted;
    }

    public function isCard(mixed $card): bool
    {
        return ($card instanceof BaseCard);
    }

    /**
     * @param BoardingCard[] $cards
     * @return string[]
     */
    public function describe(array $cards): array
    {
        $sorted = $this->sort($cards);

        $steps = array_map(
            fn(BoardingCard $card) => $card->describe(),
            $sorted
        );

        $steps[] = "You have arrived at your final destination.";

        return $steps;
    }
}