<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\BusCard;
use App\Models\FlightCard;
use App\Models\TrainCard;
use App\Services\CardSorter;

error_reporting(E_ALL);
ini_set('display_errors', 'On');

echo '<hr />';
echo '<b>Trip 1: Happy path</b><br />';

$cards = array(
    new FlightCard(
        'Stockholm',
        'Amsterdam Schiphol',
        'SK22',
        '18',
        '7B'
    ),
    new BusCard(
        'London',
        'London Heathrow Airport',
        'airport bus'
    ),
    new TrainCard(
        'Amsterdam Schiphol',
        'The Hague',
        'T13',
        '12B'
    ),
    new TrainCard(
        'Birmingham',
        'London',
        'X12',
        '18C'
    ),
    new FlightCard(
        'London Heathrow Airport',
        'Stockholm',
        'BF134',
        '45B',
        '3A'
    ),
);

$sorter = new CardSorter();

foreach ($sorter->describe($cards) as $step) {
    echo "• {$step}<br />\n";
}
echo '<hr />';


echo '<hr />';
echo '<b>Trip 2: broken chain</b>';
echo '<hr />';

$cards = array(
    new FlightCard(
        'Stockholm',
        'Amsterdam Schiphol',
        'SK22',
        '18',
        '7B'
    ),
    new BusCard(
        'London',
        'London Heathrow Airport',
        'airport bus'
    ),
    new TrainCard(
        'Amsterdam Schiphol',
        'The Hague',
        'T13',
        '12B'
    ),
    new TrainCard(
        'Birmingham',
        'London',
        'X12',
        '18C'
    ),
    new FlightCard(
        'London Heathrow Airport',
        'Cape Town Airport South Africa',
        'BF134',
        '45B',
        '3A'
    ),
);

$sorter = new CardSorter();

try {
    foreach ($sorter->describe($cards) as $step) {
        echo "• {$step}<br />\n";
    }
} catch (\Exception $e) {
    print $e->getMessage();
}

echo '<hr />';
echo '<b>Trip 2: No cards</b>';
echo '<hr />';

$cards = array(
);

$sorter = new CardSorter();

try {
    foreach ($sorter->describe($cards) as $step) {
        echo "• {$step}<br />\n";
    }
} catch (\Exception $e) {
    print $e->getMessage();
}

echo '<hr />';
echo '<b>Trip 3: single card</b>';
echo '<hr />';

$cards = array(
    new FlightCard(
        'London Heathrow Airport',
        'Cape Town Airport South Africa',
        'BF134',
        '45B',
        '3A'
    ),
);

$sorter = new CardSorter();

try {
    foreach ($sorter->describe($cards) as $step) {
        echo "• {$step}<br />\n";
    }
} catch (\Exception $e) {
    print $e->getMessage();
}

echo '<hr />';
echo '<b>Trip 4: invalid card(s)</b>';
echo '<hr />';

$cards = array(
    new stdClass(),
);

$sorter = new CardSorter();

try {
    foreach ($sorter->describe($cards) as $step) {
        echo "• {$step}<br />\n";
    }
} catch (\Exception $e) {
    print $e->getMessage();
}
