<?php

namespace Tests\Mocks;

use App\Services\Cart\Calculator\CalculatorInterface;

class CalculatorMock implements CalculatorInterface
{
    public function getCost($items)
    {
        $total = 0;

        foreach($items as $item) {
            $total += $item->getCount() * $item->getPrice();
        }

        return $total;
    }
}