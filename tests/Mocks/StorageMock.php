<?php

namespace Tests\Mocks;

use App\Services\Cart\Storage\StorageInterface;

class StorageMock implements StorageInterface
{
    private $items = [];

    public function load()
    {
        return $this->items;
    }

    public function save($items)
    {
        $this->items = $items;
    }
}